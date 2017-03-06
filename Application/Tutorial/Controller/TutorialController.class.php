<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-11
 * Time: PM5:41
 */

namespace Admin\Controller;

use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminSortBuilder;
use Think\Model;
use Weibo\Api\WeiboApi;

class TutorialController extends AdminController
{

    function _initialize()
    {
        parent::_initialize();
        import_lang('Tutorial');
    }


    public function config()
    {
        $admin_config = new AdminConfigBuilder();
        if (IS_POST) {
            S('GROUP_SHOW_DATA', null);
            S('GROUP_POST_SHOW_DATA', null);
        }
        $data = $admin_config->handleConfig();
        $admin_config->title(L('_GROUP_BASIC_SETTINGS_'))
            ->keyBool('GROUP_NEED_VERIFY', L('_AUDIT_CREATE_GROUP_'), L('_AUDIT_DEFAULT_NO_NEED_'))
            ->keyText('GROUP_POST_IMG_COUNT', L('_POST_SHOW_IMAGE_NUMBER_'), L('_POST_SHOW_IMAGE_NUMBER_DEFAULT_'))

            ->keyCheckBox('GROUP_SEND_WEIBO', L('_GROUP_TO_TWITTER_SWITCH_'), '', array('add_tutorial' => L('_GROUP_CREATE_'), 'edit_tutorial' => L('_GROUP_EDIT_')))
            ->keyBool('GROUP_AUDIT_SEND_WEIBO', L('_AUDIT_GROUP_TWITTER_'), '')
            ->keyText('GROUP_LIMIT', L('_GROUP_CREATE_NUMBER_PER_'), L('_GROUP_CREATE_NUMBER_PER_DEFAULT_'))
            ->keyCheckBox('GROUP_POST_SEND_WEIBO', L('_GROUP_TO_TWITTER_SWITCH_'), '', array('add_tutorial_post' => L('_POST_ADD_'), 'edit_tutorial_post' => L('_POST_EDIT_')))
            ->keyRadio('GROUP_LZL_REPLY_ORDER', L('_DOUBLE_DECK_SORT_'), '', array(0 => L('_DOUBLE_DECK_SORT_TIME_DESC_'), 1 => L('_DOUBLE_DECK_SORT_TIME_ASC_')))
            ->keyText('GROUP_LZL_SHOW_COUNT', L('_DOUBLE_DECK_SHOW_NUMBER_'))

            ->buttonSubmit('', L('_SAVE_'))->data($data)

            ->keyDefault('GROUP_LIMIT', 5)
            ->keyDefault('GROUP_NEED_VERIFY', 0)
            ->keyDefault('GROUP_POST_IMG_COUNT', 10)
            ->keyDefault('GROUP_SEND_WEIBO', 'add_tutorial,edit_tutorial')
            ->keyDefault('GROUP_POST_SEND_WEIBO', 'add_tutorial_post,edit_tutorial_post')
            ->keyDefault('GROUP_LZL_REPLY_ORDER', 1)
            ->keyDefault('GROUP_LZL_SHOW_COUNT', 5)
            ->tutorial(L('_GROUP_SETTINGS_'), 'GROUP_NEED_VERIFY,GROUP_SEND_WEIBO,GROUP_AUDIT_SEND_WEIBO,GROUP_LIMIT')
            ->tutorial(L('_POST_SETTINGS_'), 'GROUP_POST_IMG_COUNT,GROUP_POST_SEND_WEIBO')
            // ->tutorial('回复设置','')
            ->tutorial(L('_DOUBLE_DECK_SETTINGS_'), 'GROUP_LZL_REPLY_ORDER,GROUP_LZL_SHOW_COUNT')

            ->keyText('GROUP_SHOW_TITLE', L('_TITLE_NAME_'), L('_TITLE_IN_HOME_'))->keyDefault('GROUP_SHOW_TITLE', L('_GROUP_RECOMMEND_'))
            ->keyText('GROUP_SHOW', L('_BLOCK_SHOW_'),L('_BLOCK_SHOW_TIP_'))
            ->keyText('GROUP_SHOW_CACHE_TIME', L('_CACHE_TIME_'), L('_TIP_CACHE_TIME_'))->keyDefault('GROUP_SHOW_CACHE_TIME', '600')

            ->keyText('GROUP_POST_SHOW_TITLE', L('_TITLE_NAME_'), L('_TITLE_IN_HOME_'))->keyDefault('GROUP_POST_SHOW_TITLE', L('_GROUP_HOT_TOPIC_'))
            ->keyText('GROUP_POST_SHOW_NUM', L('_POST_SHOWS_'))->keyDefault('GROUP_POST_SHOW_NUM', 5)
            ->keyRadio('GROUP_POST_ORDER', L('_POST_SORT_FIELD_'), '', array('create_time' => L('_CREATE_TIME_'), 'update_time' => L('_UPDATE_TIME_'), 'last_reply_time' => L('_LAST_REPLY_TIME_'), 'view_count' => L('_VIEWS_'), 'reply_count' => L('_REPLIES_')))->keyDefault('GROUP_POST_ORDER', 'last_reply_time')
            ->keyRadio('GROUP_POST_TYPE', L('_POST_SORT_MODE_'), '', array('asc' => L('_ASC_'), 'desc' => L('_DESC_')))->keyDefault('GROUP_POST_TYPE', 'desc')
            ->keyText('GROUP_POST_CACHE_TIME', L('_CACHE_TIME_'), L('_TIP_CACHE_TIME_'))->keyDefault('GROUP_POST_CACHE_TIME', '600')

            ->tutorial(L('_HOME_DISPLAY_BOARD_SETTING_'), 'GROUP_SHOW_TITLE,GROUP_SHOW,GROUP_SHOW_CACHE_TIME')
            ->tutorial(L('_HOME_DISPLAY_POST_SETTINGS_'), 'GROUP_POST_SHOW_TITLE,GROUP_POST_SHOW_NUM,GROUP_POST_ORDER,GROUP_POST_TYPE,NEWS_SHOW_CACHE_TIME');
        $admin_config->display();
    }

    public function index()
    {
        redirect(U('tutorial'));
    }

    public function tutorial()
    {


        $aPage = I('get.page', 1, 'intval');
        $aTypeId = I('get.type_id', 0, 'intval');
        $r = 20;

        //读取数据
        $map = array('status' => 1);
        if ($aTypeId != 0) {
            $map['type_id'] = $aTypeId;
        }
        $model = M('Tutorial');
        $list = $model->where($map)->page($aPage, $r)->order('sort asc')->select();
        $totalCount = $model->where($map)->count();
        //显示页面
        $builder = new AdminListBuilder();
        $builder
            ->title(L('_GROUP_MANAGER_'))
            ->buttonNew(U('Tutorial/editTutorial'))
            ->setStatusUrl(U('Tutorial/setTutorialStatus'))->buttonDisable('', L('_AUDIT_UNSUCCESS_'))->buttonDelete()
            ->buttonSort(U('Tutorial/sortTutorial'))
            ->keyId()->keyLink('title', L('_TITLE_'), 'Tutorial/post?tutorial_id=###')
            ->keyCreateTime()->keyText('post_count', L('_POST_COUNT_'))->keyStatus()->keyDoActionEdit('editTutorial?id=###')
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }


    public function unverify()
    {
        $aPage = I('get.page', 1, 'intval');
        $aTypeId = I('get.type_id', 0, 'intval');
        $r = 20;
        //读取数据
        $map = array('status' => 0);
        if ($aTypeId != 0) {
            $map['type_id'] = $aTypeId;
        }
        $model = M('Tutorial');
        $list = $model->where($map)->page($aPage, $r)->order('sort asc')->select();
        $totalCount = $model->where($map)->count();
        //显示页面
        $builder = new AdminListBuilder();
        $builder
            ->title(L('_GROUP_MANAGER_'))
            ->setStatusUrl(U('Tutorial/setTutorialStatus'))->buttonEnable(U('Tutorial/setTutorialStatus', array('tip' => 'verify')), L('_AUDIT_SUCCESS_'))->buttonDelete()
            ->keyId()->keyLink('title', L('_TITLE_'), 'Tutorial/post?tutorial_id=###')
            ->keyCreateTime()->keyText('post_count', L('_POST_COUNT_'))->keyStatus()->keyDoActionEdit('editTutorial?id=###')
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function tutorialType()
    {
        //读取数据
        $map = array('status' => array('GT', -1), 'pid' => 0);

        $model = M('TutorialType');
        $list = $model->where($map)->order('sort asc')->select();

        foreach ($list as $k => $v) {
            $child = $model->where(array('pid' => $v['id'], 'status' => 1))->order('sort asc')->select();
            //获取数组中第一父级的位置
            $key_name = array_search($v, $list);
            foreach ($child as $key => $val) {
                $val['title'] = '------' . $val['title'];
                //在父级后面添加数组
                array_splice($list, $key_name + 1, 0, array($val));
            }
        }

        foreach ($list as &$type) {
            $type['tutorial_count'] = D('Tutorial')->where(array('type_id' => $type['id']))->count();
        }
        unset($type);
        //显示页面
        $builder = new AdminListBuilder();
        $builder
            ->title(L('_GROUP_CATEGORY_CONTROL_'))
            ->buttonNew(U('Tutorial/editTutorialType'))
            ->setStatusUrl(U('Tutorial/setTutorialTypeStatus'))->buttonEnable()->buttonDisable()->buttonDelete()
            ->buttonSort(U('Tutorial/sortTutorialType'))
            ->keyId()->keyLink('title', L('_TITLE_'), 'Tutorial/tutorial?type_id=###')
            ->keyCreateTime()->keyText('tutorial_count', L('_GROUP_COUNT_'))->keyStatus()->keyDoActionEdit('editTutorialType?id=###')
            ->data($list)
            ->display();
    }

    public function setTutorialTypeStatus($ids, $status)
    {
        $builder = new AdminListBuilder();

        $builder->doSetStatus('TutorialType', $ids, $status);

    }


    public function editTutorialType()
    {
        $aId = I('id', 0, 'intval');
        if (IS_POST) {
            if ($aId != 0) {
                $data = D('TutorialType')->create();
                $res = D('TutorialType')->save($data);
            } else {
                $data = D('TutorialType')->create();
                $res = D('TutorialType')->add($data);
            }
            if ($res) {
                $this->success(($aId == 0 ?  L('_ADD_'): L('_EDIT_')) . L('_SUCCESS_'));
            } else {
                $this->error(($aId == 0 ?  L('_ADD_'): L('_EDIT_')) . L('_FAIL_'));
            }

        } else {
            $builder = new AdminConfigBuilder();

            $types = M('TutorialType')->where(array('pid' => 0))->select();
            $opt = array();
            foreach ($types as $type) {
                $opt[$type['id']] = $type['title'];
            }


            if ($aId != 0) {
                $wordCate1 = D('TutorialType')->find($aId);
            } else {
                $wordCate1 = array('status' => 1, 'sort' => 0);
            }
            $builder->title(L('_CATEGORY_ADD_'))->keyId()->keyText('title', L('_TITLE_'))->keySelect('pid', L('_CATEGORY_FATHER_'), L('_CATEGORY_FATHER_SELECT_'), array('0' =>L('_CATEGORY_TOP_') ) + $opt)
                ->keyStatus()->keyCreateTime()->keyText('sort', L('_SORT_'))
                ->data($wordCate1)
                ->buttonSubmit(U('Tutorial/editTutorialType'))->buttonBack()->display();
        }
    }


    public function sortTutorialType($ids = null)
    {
        if (IS_POST) {
            $builder = new AdminSortBuilder();
            $builder->doSort('TutorialType', $ids);
        } else {
            $map['status'] = array('egt', 0);
            $list = D('TutorialType')->where($map)->order("sort asc")->select();
            foreach ($list as $key => $val) {
                $list[$key]['title'] = $val['title'];
            }
            $builder = new AdminSortBuilder();
            $builder->meta_title = L('_GROUPS_SORT_');
            $builder->data($list);
            $builder->buttonSubmit(U('sortTutorialType'))->buttonBack();
            $builder->display();
        }
    }

    public function tutorialTrash()
    {
        $aPage = I('get.page', 1, 'intval');
        $r = 20;
        //读取回收站中的数据
        $map = array('status' => '-1');
        $model = M('Tutorial');
        $list = $model->where($map)->page($aPage, $r)->order('sort asc')->select();
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder
            ->title(L('_GROUP_TRASH_'))->buttonDeleteTrue(U('tutorialClear'))
            ->setStatusUrl(U('Tutorial/setTutorialStatus'))->buttonRestore()
            ->keyId()->keyLink('title', L('_TITLE_'), 'Tutorial/post?tutorial_id=###')
            ->keyCreateTime()->keyText('post_count', L('_POST_COUNT_'))
            ->data($list)
            ->pagination($totalCount, $r)

            ->display();
    }

    public function tutorialClear($ids)
    {
        $builder = new AdminListBuilder();
        $builder->doDeleteTrue('Tutorial', $ids);
    }

    /**
     * sortTutorial 群组排序页面
     * @author:xjw129xjt xjt@ourstu.com
     */
    public function sortTutorial($ids = null)
    {
        if (IS_POST) {
            $builder = new AdminSortBuilder();
            $builder->doSort('Tutorial', $ids);
        } else {
            //读取群组列表
            $list = M('Tutorial')->where(array('status' => array('EGT', 0)))->order('sort asc')->select();

            //显示页面
            $builder = new AdminSortBuilder();
            $builder->title(L('_GROUP_SORT_'))
                ->data($list)
                ->buttonSubmit(U('sortTutorial'))->buttonBack()
                ->display();
        }

    }


    /**
     * setTutorialStatus  设置群组状态
     * @param $ids
     * @param $status
     * @author:xjw129xjt xjt@ourstu.com
     */
    public function setTutorialStatus($ids, $status)
    {
        $ids = is_array($ids) ? $ids : array($ids);

        foreach ($ids as $v) {
            $title = D('Tutorial/Tutorial')->where(array('id' => $v))->field('title,uid')->find();
            if (I('get.tip') == 'verify') {
                if (modC('GROUP_AUDIT_SEND_WEIBO', 1, 'Tutorial')) {
                    $postUrl = "http://$_SERVER[HTTP_HOST]" . U('Tutorial/Index/tutorial', array('id' => $v));
                    if (D('Common/Module')->isInstalled('Weibo')) { //安装了微博模块
                        D('Weibo/weibo')->addWeibo(is_login(), L('_TIP_AUDIT_GROUP_PRE_')."【" . $title['title'] . "】".L('_TIP_AUDIT_GROUP_SU_') .L('_COLON_'). $postUrl);
                    }
                    // 发送消息
                }
                D('Message')->sendMessageWithoutCheckSelf($title['uid'],L('') , L('_TIP_AUDIT_GROUP_SUCCESS_')."【" . $title['title'] . "】".L('_TIP_AUDIT_GROUP_SU_'), 'Tutorial/Index/tutorial', array('id' => $v));
            }
            if($status == 0){
                D('Message')->sendMessageWithoutCheckSelf($title['uid'], L(''), L('_TIP_AUDIT_GROUP_FAIL_')."【" . $title['title'] . "】".L('_TIP_AUDIT_GROUP_SU_').L("_AUDIT_GROUP_NOTIFICATION_SU_"));
            }

        }


        foreach ($ids as $v) {
            S('tutorial_' . $v, null);
        }
        S('tutorial_post_exist_ids', null);
        S('tutorial_exist_ids', null);
        $builder = new AdminListBuilder();
        $builder->doSetStatus('Tutorial', $ids, $status);
    }


    public function editTutorial($id = 0)
    {

        if (IS_POST) {
            $aId = I('post.id', 0, 'intval');
            $aTitle = I('post.title', '', 'text');
            $aCreateTime = I('post.create_time', 0, 'intval');
            $aStatus = I('post.status', 0, 'intval');
            $aAllowUserTutorial = I('post.allow_user_tutorial', 0, 'intval');
            $aLogo = I('post.logo', 0, 'intval');
            $aTypeId = I('post.type_id', 0, 'intval');
            $aDetail = I('post.detail', '', 'text');
            $aType = I('post.type', 0, 'intval');
            $aMemberAlias = I('post.member_alias', '', 'text');

            $isEdit = $aId ? true : false;
            //生成数据
            $data = array('title' => $aTitle, 'create_time' => $aCreateTime, 'status' => $aStatus, 'allow_user_tutorial' => $aAllowUserTutorial, 'logo' => $aLogo, 'type_id' => $aTypeId, 'detail' => $aDetail, 'type' => $aType, 'member_alias' => $aMemberAlias);
            //写入数据库
            $model = M('Tutorial');
            if ($isEdit) {
                $data['id'] = $aId;
                $data = $model->create($data);
                $result = $model->where(array('id' => $aId))->save($data);

            } else {
                $data = $model->create($data);
                $data['uid'] = 1;
                $result = $model->add($data);
                if (!$result) {
                    $this->error(L('_ERROR_CREATE_FAIL_'));
                }
            }
            S('tutorial_list', null);
            //返回成功信息
            $this->success($isEdit ? L('_SUCCESS_EDIT_') : L('_SUCCESS_SAVE_'));
        } else {
            $aId = I('get.id', 0, 'intval');
            //判断是否为编辑模式
            $isEdit = $aId ? true : false;
            //如果是编辑模式，读取群组的属性
            if ($isEdit) {
                $tutorial = M('Tutorial')->where(array('id' => $aId))->find();
            } else {
                $tutorial = array('create_time' => time(), 'post_count' => 0, 'status' => 1);
            }
            $tutorialType = D('TutorialType')->where(array('status' => 1, 'pid' => 0))->limit(100)->select();
            foreach ($tutorialType as $k => $v) {
                $child = D('TutorialType')->where(array('pid' => $v['id'], 'status' => 1))->order('sort asc')->select();
                //获取数组中第一父级的位置
                $key_name = array_search($v, $tutorialType);
                foreach ($child as $key => $val) {
                    $val['title'] = '------' . $val['title'];
                    //在父级后面添加数组
                    array_splice($tutorialType, $key_name + 1, 0, array($val));
                }
            }
            foreach ($tutorialType as $type) {
                $opt[$type['id']] = $type['title'];
            }
            //显示页面
            $builder = new AdminConfigBuilder();
            $builder
                ->title($isEdit ?  L('_GROUP_EDIT_'):L('') )
                ->keyId()->keyTitle()->keyTextArea('detail',L('_GROUP_INTRO_') )
                ->keyRadio('type',L('_GROUP_TYPE_') ,L('_TIP_GROUP_TYPE_') , array(0 =>L('_GROUP_PUBLIC_') , 1 =>L('_GROUP_PRIVATE_') ))
                ->keySelect('type_id', L('_CATEGORY_'), L('_TIP_CATEGORY_SELECT_'), $opt)
                /* ->keyMultiUserTutorial('allow_user_tutorial', '允许发帖的权限组')*/
                ->keyStatus()
                ->keySingleImage('logo', L('_GROUP_LOGO_'), L('_TIP_GROUP_LOGO_'))->keyText('member_alias',L('_GROUP_MEMBER_NICKNAME_') )->keyCreateTime()
                ->data($tutorial)
                ->buttonSubmit(U('editTutorial'))->buttonBack()
                ->display();
        }
    }


    public function post()
    {
        $aPage = I('get.page', 1, 'intval');
        $aTutorialId = I('get.tutorial_id', 0, 'intval');
        $aTitle = I('get.title', '', 'text');
        $aContent = I('get.content', '', 'text');
        $r = 20;

        $tutorials = D('tutorial')->where(array('status' => 1))->field('id')->cache('tutorial_exist_ids', 60 * 5)->select();
        $tutorial_ids = getSubByKey($tutorials, 'id');

        //读取文章数据
        $map = array('status' => array('EGT', 0), 'tutorial_id' => array('in', $tutorial_ids));
        if ($aTitle != '') {
            $map['title'] = array('like', '%' . $aTitle . '%');
        }
        if ($aContent != '') {
            $map['content'] = array('like', '%' . $aContent . '%');
        }
        if ($aTutorialId) $map['tutorial_id'] = $aTutorialId;
        $model = M('TutorialPost');
        $list = $model->where($map)->order('last_reply_time desc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();

        foreach ($list as &$v) {
            if ($v['is_top'] == 1) {
                $v['top'] = L('_STICK_IN_BLOCK_');
            } else if ($v['is_top'] == 2) {
                $v['top'] = L('_STICK_GLOBAL_');
            } else {
                $v['top'] = L('_STICK_NOT_');
            }
        }
        //读取群组基本信息
        if ($aTutorialId) {
            $tutorial = D('Tutorial/Tutorial')->getTutorial($aTutorialId);
            $tutorialTitle = ' - ' . $tutorial['title'];
        } else {
            $tutorialTitle = '';
        }
        //显示页面
        $builder = new AdminListBuilder();
        $builder->title(L('_POST_MANAGEMENT_') . $tutorialTitle)
            ->setStatusUrl(U('Tutorial/setPostStatus'))->buttonEnable()->buttonDisable()->buttonDelete()
            ->keyId()->keyLink('title', L('_TITLE_'), 'Tutorial/reply?post_id=###')
            ->keyCreateTime()->keyUpdateTime()->keyTime('last_reply_time', L('_LAST_REPLY_TIME_'))->keyText('top', L('_STICK_YES_OR_NOT_'))->keyStatus()->keyDoActionEdit('tutorial/index/edit?post_id=###')
            ->setSearchPostUrl(U('post'))->search(L('_TITLE_'), 'title')->search(L('_CONTENT_'), 'content')
            ->data($list)
            ->pagination($totalCount, $r)

            ->display();
    }

    public function postTrash()
    {
        $aPage = I('get.page', 1, 'intval');
        $r = 20;
        //读取文章数据
        $map = array('status' => -1);
        $model = M('TutorialPost');
        $list = $model->where($map)->order('last_reply_time desc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title(L('_POST_TRASH_'))
            ->setStatusUrl(U('Tutorial/setPostStatus'))->buttonRestore()->buttonDeleteTrue(U('postClear'))
            ->keyId()->keyLink('title',L('_TITLE_') , 'Tutorial/reply?post_id=###')
            ->keyCreateTime()->keyUpdateTime()->keyTime('last_reply_time',L('_LAST_REPLY_TIME_') )->keyBool('is_top', L('_STICK_YES_OR_NOT_'))
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function postClear($ids)
    {
        $builder = new AdminListBuilder();
        $builder->doDeleteTrue('TutorialPost', $ids);
    }

    /**
     * setPostStatus  设置帖子状态
     * @param $ids
     * @param $status
     * @author:xjw129xjt xjt@ourstu.com
     */
    public function setPostStatus($ids, $status)
    {
        $builder = new AdminListBuilder();
        $ids = is_array($ids) ? $ids : array($ids);
        foreach ($ids as $v) {
            S('tutorial_post_' . $v, null);
        }
        S('tutorial_post_exist_ids', null);
        S('tutorial_exist_ids', null);
        $builder->doSetStatus('TutorialPost', $ids, $status);
    }


    public function reply()
    {
        //读取回复列表

        $aPage = I('get.page', 1, 'intval');
        $aPostId = I('get.post_id', 0, 'intval');
        $aUid = I('get.uid', 0, 'intval');
        $aKeyword = I('get.keyword', '', 'text');
        $r = 20;

        $tutorials = D('tutorial')->where(array('status' => 1))->field('id')->cache('tutorial_exist_ids', 60 * 5)->select();
        $tutorial_ids = getSubByKey($tutorials, 'id');
        $posts = D('tutorial_post')->where(array('status' => 1, 'tutorial_id' => array('in', $tutorial_ids)))->field('id')->cache('tutorial_post_exist_ids', 60 * 5)->select();
        $post_ids = getSubByKey($posts, 'id');

        $map = array('status' => array('EGT', 0), 'post_id' => array('in', $post_ids));
        $aKeyword != '' && $map['content'] = array('like', '%' . $aKeyword . '%');
        $aUid != 0 && $map['uid'] = $aUid;
        if ($aPostId) $map['post_id'] = $aPostId;
        $model = M('TutorialPostReply');
        $list = $model->where($map)->order('create_time asc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();

        foreach ($list as &$v) {
            $v['uname'] = get_nickname($v['uid']);
            $post = D('Tutorial/TutorialPost')->getPost($v['post_id']);
            $v['post_title'] = $post['title'];
            $v['show'] = L('_DOUBLE_VIEW_REPLIES_');
        }
        //显示页面
        $builder = new AdminListBuilder();
        $builder->title(L('_REPLY_CONTROL_'))
            ->setStatusUrl(U('setReplyStatus'))->buttonEnable()->buttonDisable()->buttonDelete()
            ->keyId()
            ->keyLinkByFlag('post_title', L('_POST_TITLE_'), 'tutorial/index/detail?id=###&#{$id}', 'post_id')
            ->keyText('uname', L('_PUBLISHER_'))->keyCreateTime()
            ->keyUpdateTime()->keyStatus()
            ->keyLink('show', L('_DOUBLE_DECK_'), 'Admin/Tutorial/lzlreply?id=###')->keyDoActionEdit('tutorial/index/editreply?reply_id=###')
            ->data($list)
            ->setSearchPostUrl(U('reply'))->search(L('_USER_ID_'), 'uid')->search(L('_KEYWORD_'), 'keyword')
            ->pagination($totalCount, $r)
            ->display();
    }

    public function replyTrash()
    {

        $aPage = I('get.page', 1, 'intval');
        $r = 20;

        //读取回复列表
        $map = array('status' => -1);
        $model = M('TutorialPostReply');
        $list = $model->where($map)->order('create_time asc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();
        foreach ($list as &$v) {
            $v['uname'] = get_nickname($v['uid']);

            $v['show'] = L('_DOUBLE_VIEW_REPLIES_');
        }
        //显示页面
        $builder = new AdminListBuilder();
        $builder->title(L('_REPLY_TRASH_'))
            ->setStatusUrl(U('setReplyStatus'))->buttonRestore()->buttonDeleteTrue(U('postReplyClear'))
            ->keyId()->keyTruncText('content', L('_CONTENT_'), 50)->keyText('uname', L('_PUBLISHER_'))->keyCreateTime()->keyUpdateTime()->keyStatus()->keyLink('show', L('_DOUBLE_DECK_'), 'Admin/Tutorial/lzlreplyTrash?id=###')
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function postReplyClear($ids)
    {
        $builder = new AdminListBuilder();
        $builder->doDeleteTrue('TutorialPostReply', $ids);
    }


    public function setReplyStatus($ids, $status)
    {
        $builder = new AdminListBuilder();
        $builder->doSetStatus('TutorialPostReply', $ids, $status);
    }


    public function postType()
    {
        $aPage = I('get.page', 1, 'intval');
        $r = 20;
        //读取数据
        $map = array('status' => array('GT', -1));
        $model = M('TutorialPostCategory');
        $list = $model->where($map)->page($aPage, $r)->order('tutorial_id asc, sort asc')->select();
        $totalCount = $model->where($map)->count();
        foreach ($list as &$cate) {
            $tutorial = D('Tutorial')->where(array('id' => $cate['tutorial_id']))->find();
            $cate['tutorial_name'] = $tutorial['title'];
            $cate['post_count'] = D('TutorialPost')->where(array('cate_id' => $cate['id']))->count();
        }
        unset($cate);
        //显示页面
        $builder = new AdminListBuilder();
        $builder
            ->title(L('_GROUP_CATEGORY_CONTROL_'))
            ->buttonNew(U('Tutorial/editPostCate'))
            ->setStatusUrl(U('Tutorial/setTutorialPostCateStatus'))->buttonEnable()->buttonDisable()->buttonDelete()
            /*  ->buttonSort(U('Tutorial/sortPostCate'))*/
            ->keyId()->keyText('tutorial_name', L('_GROUP_BELONG_TO_'))->keyText('title', L('_TITLE_'))
            ->keyCreateTime()->keyText('post_count', L('_GROUP_COUNT_'))->keyStatus()->keyDoActionEdit('editPostCate?id=###')
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function setTutorialPostCateStatus($ids, $status)
    {

        $builder = new AdminListBuilder();
        $builder->doSetStatus('TutorialPostCategory', $ids, $status);

    }

    public function editPostCate()
    {
        $aId = I('id', 0, 'intval');
        if (IS_POST) {
            $data = D('TutorialPostCategory')->create();
            if ($aId != 0) {
                $res = D('TutorialPostCategory')->save($data);
            } else {
                $res = D('TutorialPostCategory')->add($data);
            }
            if ($res) {
                $this->success(($aId == 0 ?  L('_ADD_'): L('_EDIT_')) . L('_SUCCESS_'));
            } else {
                $this->error(($aId == 0 ?  L('_ADD_'): L('_EDIT_')) . L('_FAIL_'));
            }

        } else {
            $builder = new AdminConfigBuilder();

            $tutorials = D('Tutorial')->where(array('status' => 1))->select();
            foreach ($tutorials as $tutorial) {
                $opt[$tutorial['id']] = $tutorial['title'];
            }

            if ($aId != 0) {
                $wordCate1 = D('TutorialPostCategory')->find($aId);
            } else {
                $wordCate1 = array('status' => 1, 'sort' => 0);
            }
            $builder->title(L('_CATEGORY_ADD_'))->keyId()->keySelect('tutorial_id', L('_GROUP_BELONG_TO_'), '', $opt)->keyText('title', L('_TITLE_'))
                ->keyStatus()->keyCreateTime()
                ->data($wordCate1)
                ->buttonSubmit(U('Tutorial/editPostCate'))->buttonBack()->display();
        }
    }

    public function sortPostCate($ids = null)
    {
        if (IS_POST) {
            $builder = new AdminSortBuilder();
            $builder->doSort('TutorialPostCategory', $ids);
        } else {
            $map['status'] = array('egt', 0);
            $list = D('TutorialPostCategory')->where($map)->order("sort asc")->select();
            foreach ($list as $key => $val) {
                $list[$key]['title'] = $val['title'];
            }
            $builder = new AdminSortBuilder();
            $builder->meta_title = L('_GROUPS_SORT_');
            $builder->data($list);
            $builder->buttonSubmit(U('sortPostCate'))->buttonBack();
            $builder->display();
        }
    }


    public function lzlreply()
    {
        $aPage = I('get.page', 1, 'intval');
        $aId = I('get.id', 0, 'intval');
        $aUid = I('get.uid', 0, 'intval');
        $aKeyword = I('get.keyword', '', 'text');
        $r = 20;
        //读取回复列表
        $map = array('status' => array('EGT', 0));
        $aKeyword != '' && $map['content'] = array('like', '%' . $aKeyword . '%');
        $aUid != 0 && $map['uid'] = $aUid;
        if ($aId) $map['to_f_reply_id'] = $aId;
        $model = M('TutorialLzlReply');
        $list = $model->where($map)->order('create_time asc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();
        foreach ($list as &$v) {
            $v['uname'] = get_nickname($v['uid']);
        }
        //显示页面
        $builder = new AdminListBuilder();
        $builder->title(L('_DOUBLE_DECK_REPLIES_CONTROL_'))
            ->setStatusUrl(U('setLzlReplyStatus'))->buttonEnable()->buttonDisable()->buttonDelete()
            ->keyId()->keyTruncText('content', L('_CONTENT_'), 50)->keyText('uname',L('_PUBLISHER_') )->keyTime('create_time',L('_CREATE_TIME_') )->keyStatus()->keyDoActionEdit('editLzlReply?id=###')
            ->data($list)
            ->setSearchPostUrl(U('lzlreply', array('id' => $aId)))->search(L('_USER_ID_'), 'uid')->search(L('_KEYWORD_'), 'keyword')
            ->pagination($totalCount, $r)
            ->display();
    }

    public function lzlreplyTrash()
    {
        $aPage = I('get.page', 1, 'intval');
        $aId = I('get.id', 0, 'intval');
        $r = 20;

        //读取回复列表
        $map = array('status' => -1);
        if ($aId) $map['to_f_reply_id'] = $aId;
        $model = M('TutorialLzlReply');
        $list = $model->where($map)->order('create_time asc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();
        foreach ($list as &$v) {
            $v['uname'] = get_nickname($v['uid']);
        }
        //显示页面
        $builder = new AdminListBuilder();
        $builder->title(L('_REPLY_TRASH_'))
            ->setStatusUrl(U('setLzlReplyStatus'))->buttonRestore()->buttonDeleteTrue(U('lzlClear'))
            ->keyId()->keyTruncText('content', L('_CONTENT_'), 50)->keyText('uname', L('_PUBLISHER_'))->keyCreateTime()->keyUpdateTime()->keyStatus()
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function lzlClear($ids)
    {
        $builder = new AdminListBuilder();
        $builder->doDeleteTrue('TutorialLzlReply', $ids);
    }

    public function setLzlReplyStatus($ids, $status)
    {
        $builder = new AdminListBuilder();
        $builder->doSetStatus('TutorialLzlReply', $ids, $status);

    }


    public function editLzlReply()
    {
        $aId = I('id', 0, 'intval');
        if (IS_POST) {
            $aContent = I('post.content', '', 'text');
            $aCreateTime = I('post.create_time', 0, 'intval');
            $aStatus = I('post.status', 0, 'intval');
            //判断是否为编辑模式
            $isEdit = $aId ? true : false;

            //写入数据库
            $data = array('content' => $aContent, 'create_time' => $aCreateTime, 'status' => $aStatus);
            $model = M('TutorialLzlReply');
            if ($isEdit) {
                $result = $model->where(array('id' => $aId))->save($data);
            } else {
                $result = $model->add($data);
            }

            //如果写入出错，则显示错误消息
            if (!$result) {
                $this->error($isEdit ? L('_FAIL_EDIT_') : L('_ERROR_CREATE_FAIL_'));
            }

            //返回成功消息
            $this->success($isEdit ? L('_SUCCESS_EDIT_') : L('_TIP_CREATE_SUCCESS_'), U('lzlreply'));
        } else {
            //判断是否为编辑模式
            $isEdit = $aId ? true : false;

            //读取回复内容
            if ($isEdit) {
                $model = M('TutorialLzlReply');
                $reply = $model->where(array('id' => $aId))->find();
            } else {
                $reply = array('status' => 1);
            }

            //显示页面
            $builder = new AdminConfigBuilder();
            $builder->title($isEdit ? L('_REPLY_EDIT_') : L('_REPLY_CREATE_'))
                ->keyId()->keyTextArea('content', L('_CONTENT_'))->keyTime('create_time', L('_CREATE_TIME_'))->keyStatus()
                ->data($reply)
                ->buttonSubmit(U('editLzlReply'))->buttonBack()
                ->display();
        }

    }


}
