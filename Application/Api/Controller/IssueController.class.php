<?php


namespace Api\Controller;


class IssueController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    //返回专辑分类信息
    public function getIssueModules()
    {
        $IssueModules = D('Issue/Issue')->where(array('status' => 1, 'pid' => 0))->order('create_time desc')->select();
        foreach ($IssueModules as &$v) {
            $v['Issues'] = D('Issue/Issue')->where(array('status' => 1, 'pid' => $v['id']))->select();
            $v['create_time'] = friendlyDate($v['create_time']);
            $v['update_time'] = friendlyDate($v['update_time']);
            foreach ($v['Issues'] as &$i) {
                $i['create_time'] = friendlyDate($i['create_time']);
                $i['update_time'] = friendlyDate($i['update_time']);
            }
        }
        unset($v);
        $this->apiSuccess('返回成功', $IssueModules);
    }


    //返回某个板块的专辑列表
    public function getIssueList()
    {
        $aPage = I_POST('page','intval');
        $aIssueId = I('get.id','','intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $issueModel = D('Api/Issue');
        $list = array();
        if ($aIssueId) {
            $typeList = D('Issue')->where("id=%d OR pid=%d", array($aIssueId, $aIssueId))->select();
            foreach ($typeList as &$value) {
                $tmpList = D('Issue/IssueContent')->getList(array('field' => 'id', 'order' => 'create_time desc', 'page' => $aPage, 'where' => array('issue_id' => $value['id'], 'status' => 1)));
                $list = array_merge($list,$tmpList)?array_merge($list,$tmpList):array();
            }
        } else {
            $list = D('Issue/IssueContent')->getList(array('field' => 'id', 'order' => 'create_time desc', 'page' => $aPage, 'where' => array('status' => 1)));
        }

        foreach ($list as &$e) {
            $e = $issueModel->getIssue($e);
        }
        unset($e);

        $this->apiSuccess('返回成功', $list);
    }

// 返回某个专辑的详情
    public function getIssueDetail()
    {

        $aId = I('get.id','','intval');
        $map['status'] = 1;
        $aId && $map['id'] = $aId;
        $issueModel = D('Api/Issue');
        if ($aId) {
            if (!D('Issue/IssueContent')->where($map)->find()) {
                $this->apiError('无此专辑');
            } else {
                $IssueDetail = $issueModel->getIssue($aId);
                $this->apiSuccess('返回成功', $IssueDetail);
            }
        } else {
            $this->apiError('请选择专辑');
        }
    }


// 返回某个专辑的评论列表
    public function getIssueComments()
    {

        $aPage = I_POST('page', 1, 'intval');
        $aRowId = I('get.id','', 'intval');
        if (!D('Issue/IssueContent')->where(array('id' => $aRowId))->find()) {
            $this->apiError('专辑不存在');
        }
        $issueModel = D('Api/Issue');
        $IssueComments = D('Issue/LocalComment')->getList(array('field' => 'id', 'order' => 'create_time desc', 'page' => $aPage, 'where' => array('app' => 'issue', 'mod' => 'issueContent', 'row_id' => $aRowId, 'status' => 1)));
        foreach ($IssueComments as &$v) {
            $v = $issueModel->getComment($v);

        }
        unset($v);
        if ($IssueComments) {
            $this->apiSuccess('返回成功', $IssueComments);
        } else {
            $this->apiError('目前该专辑无评论');
        }

    }

// 给专辑回复
    public function sendIssueComment()
    {
        $mid = $this->requireIsLogin(); //当前用户uid
        $aRowId = I('get.id','','intval');
        $aContent = I_POST('content','op_t');
        $aApp = 'Issue';
        $aMod = 'issueContent';

        if (!D('Issue/IssueContent')->where(array('id' => $aRowId))->find()) {
            $this->apiError('专辑不存在');
        }
        $data = array('uid' => $mid, 'row_id' => $aRowId, 'parse' => 0, 'mod' => $aMod, 'app' => $aApp, 'content' => $aContent, 'status' => '1', 'create_time' => time());

        $data = D('Issue/LocalComment')->create($data);
        if (!$data) return false;
        $result = D('Issue/LocalComment')->add($data);

        D('Issue/IssueContent')->where(array('status' => 1, 'id' => $aRowId))->setInc('reply_count');

        $issueModel = D('Api/Issue');
        $reply = $issueModel->getComment($result);
        $this->apiSuccess('回复成功', $reply);
    }

    public function delIssue()
    {
        $mid = $this->requireIsLogin();
        $aRowId = I_POST('row_id', 'intval');
        $aId = I('get.id', 'intval');

        $aApp = 'Issue';
        $aMod = 'issueContent';
        if (!D('Issue/IssueContent')->where(array('id' => $aRowId))->find()) {
            $this->apiError('专辑已不存在');
        }
        $Comment = D('LocalComment')->where(array('status' => '1', 'id' => $aId, 'app' => $aApp, 'mod' => $aMod))->find();
        if (!$Comment) {
            $this->apiError('回复不存在');
        }
        if ($Comment['uid'] == $mid || is_administrator($mid)) {
            $res = D('LocalComment')->where(array('uid' => $mid, 'id' => $aId, 'status' => '1'))->setField('status', -1);
            D('Issue/IssueContent')->where(array('status' => 1, 'id' => $aRowId))->setDec('reply_count');
            if ($res) {
                $this->apiSuccess('删除成功');
            } else {
                $this->apiError('删除操作失败!');
            }
        } else {
            $this->apiError('您无权限进行删除操作!');
        }
    }

//专辑投稿

    public function sendIssue()
    {
        $mid = $this->requireIsLogin(); //当前用户uid
        $aIssue_id = I_POST('issue_id', 'intval');
        $aId = I('get.id', '', 'intval');
        $aCover_id = I_POST('cover_id', 'intval');
        $aTitle = I_POST('title', 'op_t');
        $aUrl = I_POST('url', 'op_h');
        $aContent = I_POST('content', 'op_h');
        $attach_id = I_POST('attach_id', 'op_t');
        $attach_ids = explode(',', $attach_id);

        if (!$aCover_id) {
            $this->apiError('请上传封面。');
        }
        if ($aTitle == '') {
            $this->apiError('请输入标题。');
        }
        if ($aIssue_id == 0) {
            $this->apiError('请选择分类。');
        }
        if ($aContent == '') {
            $this->apiError('请输入内容。');
        }
        if ($aUrl == '') {
            $this->apiError('请输入网址。');
        }
        foreach ($attach_ids as $k => $v) {
            $aContent .= "<p><img src='" . get_cover($v, 'path') . "'/></p>";
        }
        unset($v);

        $aContent = str_replace("\\", '', $aContent);
        $isEdit = $aId ? true : false;
        $this->requireIssueAllowPublish($aIssue_id);
        $issueModel = D('Api/Issue');
        if ($isEdit) {
            $content_temp = D('IssueContent')->find($aId);
            if (!check_auth('editIssueContent')) { //不是管理员则进行检测
                if ($content_temp['uid'] != $mid) {
                    $this->apiError('不可操作他人的内容。');
                }
            }

            $data = array('id' => intval($aId), 'uid' => $content_temp['uid'], 'title' => $aTitle, 'content' => $aContent, 'parse' => 0, 'cover_id' => intval($aCover_id), 'issue_id' => intval($aIssue_id), 'url' => op_t($aUrl));
            $result = D('Issue/IssueContent')->where(array('id' => $aId))->save($data);
            if (!$result) {
                $this->apiError('编辑失败');
            } else {
                $this->apiSuccess('编辑成功。', $issueModel->getIssue($aId));
            }
        } else {
            if (modC('NEED_VERIFY',0,'ISSUE') && !is_administrator($mid)) //需要审核且不是管理员
            {
                $content['status'] = 0;
                $tip = '但需管理员审核通过后才会显示在列表中，请耐心等待。';
                $user = query_user(array('nickname'), $mid);
                $admin_uids = explode(',', C('USER_ADMINISTRATOR'));
                foreach ($admin_uids as $admin_uid) {
                    D('Common/Message')->sendMessage($admin_uid, $title = '专辑投稿提醒', "{$user['nickname']}向专辑投了一份稿件，请到后台审核。", 'Admin/Issue/verify', array(), $mid, 2);

                }
            }
            $data = array('uid' => $mid, 'title' => $aTitle, 'content' => $aContent, 'parse' => 0, 'cover_id' => intval($aCover_id), 'issue_id' => intval($aIssue_id), 'url' => op_t($aUrl));

            $data = D('Issue/IssueContent')->create($data);
            if (!$data) return false;
            $result = D('Issue/IssueContent')->add($data);

            if (!$result) {
                $this->apiError('发表失败');
            }
            $aId = $result;
            //返回成功消息
            $row = $issueModel->getIssue($aId);
            $this->apiSuccess('发表成功', $row);
        }
    }
    /******************************************************************************华丽丽的分割线**私有*********************************************************************************************************/
    //验证是否允许登陆 板块拥有权限 用户组是否拥有权限
    private function requireIssueAllowPublish($aIssue_id)
    {
        $this->requireIssueExists($aIssue_id);


        $this->requireIssueAllowCurrentUserGroup($aIssue_id);
    }

    private function requireIssueExists($aIssue_id)
    {
        if (!$this->isIssueExists($aIssue_id)) {
            $this->apiError('专辑不存在');
        }
    }

    private function isIssueExists($aIssue_id)
    {

        $issue = D('Issue/Issue')->where(array('id' => $aIssue_id, 'status' => 1));
        return $issue ? true : false;
    }

    private function requireIssueAllowCurrentUserGroup($aIssue_id)
    {

        if (!$this->isIssueAllowCurrentUserGroup($aIssue_id)) {
            $this->apiError('该板块不允许发帖');

        }
    }

    private function isIssueAllowCurrentUserGroup($aIssue_id)
    {
        $mid = $this->requireIsLogin();
//如果是超级管理员，直接允许
        if ($mid == 1) {
            return true;
        }

//如果专辑不属于任何板块，则允许发帖
        if (intval($aIssue_id) == 0) {
            return true;
        }

//读取专辑的基本信息
        /* $issue = D('Issue/Issue')->where(array('id' => $aIssue_id))->find();
        $userGroups = explode(',', $issue['allow_post']);
        dump($userGroups);*/

//读取所在的用户组
        $list = M('AuthGroupAccess')->where(array('uid' => $mid))->select();
        foreach ($list as &$e) {
            $e = $e['group_id'];
        }

//判断用户组是否有权限
        /*  $list = array_intersect($list, $userGroups);  */
        return $list ? true : false;

    }

}