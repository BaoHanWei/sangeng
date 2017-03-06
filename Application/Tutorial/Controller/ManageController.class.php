<?php
namespace Tutorial\Controller;
use Think\Controller;

class ManageController extends BaseController
{

    private $tutorialId = '';

    public function _initialize()
    {

        $aTutorialId = I('tutorial_id', 0, 'intval');
        $this->tutorialId = $aTutorialId;
        parent::_initialize();
        //判断是否有权限编辑
        if(!is_login()){
            $this->error(L('_FIRST_LOGIN_'));
        }
        $this->checkAuth('Tutorial/Manager/*',get_tutorial_admin($this->tutorialId),L('_AUTHORITY_RUIN_'));
        $this->assignNotice($this->tutorialId);
        $this->assign('tutorial_id', $this->tutorialId);
        unset($e);
        $myInfo = query_user(array('avatar128', 'avatar64', 'nickname', 'uid', 'space_url'), is_login());
        $this->assign('myInfo', $myInfo);
        //赋予贴吧列表

        $this->assign('current', 'mytutorial');

    }


    public function index()
    {
        $this->assignTutorial($this->tutorialId);
        $this->assignTutorialAllType();
        $this->setTitle(L('_GROUP_MANAGE_EDIT_'));
        $this->display();
    }

    public function member()
    {
        $aPage = I('get.page', 1, 'intval');
        $aStatus = I('get.status', 1, 'intval');
        $this->assignTutorial($this->tutorialId);
        $member = D('TutorialMember')->where(array('tutorial_id' => $this->tutorialId, 'status' => $aStatus))->page($aPage, 10)->select();
        $totalCount = D('TutorialMember')->where(array('tutorial_id' => $this->tutorialId, 'status' => $aStatus))->count();
        foreach ($member as &$v) {
            $v['user'] = query_user(array('avatar128', 'avatar64', 'nickname', 'uid', 'space_url'), $v['uid']);
        }
        $this->assign('member', $member);
        $this->assign('status', $aStatus);
        $this->assign('totalCount', $totalCount);
        $this->assign('sh_count', D('TutorialMember')->where(array('tutorial_id' => $this->tutorialId, 'status' => 1))->count());
        $this->assign('wsh_count', D('TutorialMember')->where(array('tutorial_id' => $this->tutorialId, 'status' => 0))->count());
        $this->setTitle(L("_GROUP_MANAGE_MEMBER_"));
        $this->display();
    }


    public function notice()
    {
        $this->assignTutorial($this->tutorialId);
        if (IS_POST) {
            $aNotice = I('post.notice', '', 'text');
            $data['tutorial_id'] = $this->tutorialId;
            $data['content'] = $aNotice;
            dump( $data['tutorial_id']);
            dump($data['content']);exit;
            $res = D('TutorialNotice')->addNotice($data);
            if ($res) {
                $this->success(L('_ADD_SUCCESS_'), 'refresh');
            } else {
                $this->error(L('_ADD_FAIL_'));
            }
        } else {

            $this->assign('tutorial_id', $this->tutorialId);
            $this->setTitle(L('_GROUP_MANAGE_NOTICE_'));
            $this->display();
        }
    }

    public function category()
    {
        $this->assignTutorial($this->tutorialId);
        $this->assignTutorialTypes();
        $this->setTitle(L('_GROUP_MANAGE_CATEGORY_'));
        $cate = D('TutorialPostCategory')->where(array('tutorial_id' => $this->tutorialId, 'status' => 1))->select();
        $this->assign('cate', $cate);
        $this->display();
    }


    public function dismiss()
    {
        $this->checkAuth('Tutorial/Manager/dismiss',get_tutorial_creator($this->tutorialId),L('_LIMIT_DISMISS_'));
        $res = D('Tutorial')->delTutorial($this->tutorialId);
        $map=D('TutorialPost')->where(array('tutorial_id'=>$this->tutorialId,'status'=>1))->setField(array('status'=>-1));
        if ($res && $map) {
            $this->success(L('_DISMISS_SUCCESS_'), U('tutorial/index/index'));
        } else {
            $this->error(L('_DISMISS_FAIL_'));
        }
    }


    public function receiveMember()
    {
        $aUid = I('post.uid', 0, 'intval');
        $res = D('TutorialMember')->setStatus($aUid, $this->tutorialId, 1);
        $dynamic['tutorial_id'] = $this->tutorialId;
        $dynamic['uid'] = $aUid;
        $dynamic['type'] = 'attend';
        $dynamic['create_time'] = time();
        D('TutorialDynamic')->add($dynamic);
        if ($res) {
            $tutorial = D('Tutorial')->getTutorial($this->tutorialId);
            D('Message')->sendMessage($aUid,L('_GROUP_AUDIT_SUCCESS_'), get_nickname(is_login()) . L('_TIP_JOIN_GROUP_1_')."【{$tutorial['title']}】".L('_TIP_JOIN_GROUP_2_'),  'tutorial/index/tutorial', array('id' => $this->tutorialId), is_login());
            S('tutorial_member_count_' . $tutorial['id'],null);
            S('tutorial_is_join_' . $tutorial['id'] . '_' . $aUid, null);
            $this->success(L('_AUDIT_SUCCESS_'), 'refresh');
        } else {
            $this->error(L('_AUDIT_FAIL_'));
        }
    }


    public function removeTutorialMember()
    {
        $aUid = I('post.uid', 0, 'intval');
        $res = D('TutorialMember')->where(array('uid' => $aUid, 'tutorial_id' => $this->tutorialId))->delete();
        $dynamic['tutorial_id'] = $this->tutorialId;
        $dynamic['uid'] = $aUid;
        $dynamic['type'] = 'remove';
        $dynamic['create_time'] = time();
        D('TutorialDynamic')->add($dynamic);
        if ($res) {
            $tutorial = D('Tutorial')->getTutorial($this->tutorialId);
            D('Message')->sendMessage($aUid,L('_GROUP_REMOVE_'), get_nickname(is_login()) .L('_TIP_GROUP_REMOVED_')."【{$tutorial['title']}】", 'tutorial/index/tutorial', array('id' => $this->tutorialId), is_login());
            S('tutorial_member_count_' . $tutorial['id'],null);
            S('tutorial_is_join_' . $tutorial['id'] . '_' . $aUid, null);
            $this->success(L('_DELETE_SUCCESS_'), 'refresh');
        } else {
            $this->error(L('_DELETE_FAIL_'));
        }
    }


    public function editCate()
    {
        $aCateId = I('post.cate_id', 0, 'intval');
        $aTitle = I('post.title', '', 'text');

        if (empty($aTitle)) {
            $this->error(L('_CATEGORY_NAME_CANNOT_EMPTY_'));
        }
        if ($aCateId == 0) {
            $res = D('TutorialPostCategory')->add(array('tutorial_id' => $this->tutorialId, 'title' => $aTitle, 'create_time' => time(), 'status' => 1, 'sort' => 0));
            if (!$res) {
                $this->error(L('_ADD_CATEGORY_FAIL_'));
            }
            $this->success(L('_ADD_CATEGORY_SUCCESS_'), 'refresh');
        } else {
            $res = D('TutorialPostCategory')->where(array('id' => $aCateId))->save(array('title' => $aTitle));
            if (!$res) {
                $this->error(L('_EDIT_CATEGORY_SUCCESS_'));
            }
            $this->success(L('_EDIT_CATEGORY_SUCCESS_'), 'refresh');
        }
    }


    public function delCate()
    {
        $aCateId = I('post.cate_id', 0, 'intval');
        $res = D('TutorialPostCategory')->where(array('id' => $aCateId))->setField('status', 0);
        if (!$res) {
            $this->error(L('_DELETE_CATEGORY_FAIL_'));
        }
        $this->success(L('_DELETE_CATEGORY_SUCCESS_'), 'refresh');
    }


}