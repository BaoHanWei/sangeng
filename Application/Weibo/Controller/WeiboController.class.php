<?php

namespace Admin\Controller;

use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;

class WeiboController extends AdminController
{


    public function config()
    {
        $builder = new AdminConfigBuilder();
        $data = $builder->callback('configCallback')->handleConfig();

        $data['SHOW_TITLE'] = $data['SHOW_TITLE'] == null ? 1 : $data['SHOW_TITLE'];
        $data['HIGH_LIGHT_AT'] = $data['HIGH_LIGHT_AT'] == null ? 1 : $data['HIGH_LIGHT_AT'];
        $data['HIGH_LIGHT_TOPIC'] = $data['HIGH_LIGHT_TOPIC'] == null ? 1 : $data['HIGH_LIGHT_TOPIC'];
        $data['CAN_IMAGE'] = $data['CAN_IMAGE'] == null ? 1 : $data['CAN_IMAGE'];
        $data['CAN_TOPIC'] = $data['CAN_TOPIC'] == null ? 1 : $data['CAN_TOPIC'];
        $data['WEIBO_INFO'] = $data['WEIBO_INFO'] ? $data['WEIBO_INFO'] : L('_TIP_WEIBO_INFO_') . L('_QUESTION_');
        $data['WEIBO_NUM'] = $data['WEIBO_NUM'] ? $data['WEIBO_NUM'] : 140;
        $data['SHOW_COMMENT'] = $data['SHOW_COMMENT'] == null ? 1 : $data['SHOW_COMMENT'];
        $data['ACTIVE_USER'] = $data['ACTIVE_USER'] == null ? 1 : $data['ACTIVE_USER'];
        $data['ACTIVE_USER_COUNT'] = $data['ACTIVE_USER_COUNT'] ? $data['ACTIVE_USER_COUNT'] : 6;
        $data['NEWEST_USER'] = $data['NEWEST_USER'] == null ? 1 : $data['NEWEST_USER'];
        $data['NEWEST_USER_COUNT'] = $data['NEWEST_USER_COUNT'] ? $data['NEWEST_USER_COUNT'] : 6;

        $tab = array(
            array('data-id' => 'all', 'title' => L('_ALL_WEBSITE_FOLLOW_')),
            array('data-id' => 'concerned', 'title' => L('_MY_FOLLOW_')),
            array('data-id' => 'hot', 'title' => L('_HOT_WEIBO_')),
            array('data-id' => 'fav', 'title' => L('_MY_FAV_')),
        );
        $default = array(array('data-id' => 'enable', 'title' => L('_ENABLE_'), 'items' => $tab), array('data-id' => 'disable', 'title' => L('_DISABLE_'), 'items' => array()));

        $data['WEIBO_DEFAULT_TAB'] = $builder->parseKanbanArray($data['WEIBO_DEFAULT_TAB'], $tab, $default);

        $scoreTypes = D('Ucenter/Score')->getTypeList(array('status' => 1));
        foreach ($scoreTypes as $val) {
            $types[$val['id']] = $val['title'];
        }


        $data['WEIBO_SHOW_TITLE1'] = $data['WEIBO_SHOW_TITLE1'] ? $data['WEIBO_SHOW_TITLE1'] : L('_NEWEST_WEIBO_');
        $data['WEIBO_SHOW_COUNT1'] = $data['WEIBO_SHOW_COUNT1'] ? $data['WEIBO_SHOW_COUNT1'] : 5;
        $data['WEIBO_SHOW_ORDER_FIELD1'] = $data['WEIBO_SHOW_ORDER_FIELD1'] ? $data['WEIBO_SHOW_ORDER_FIELD1'] : 'create_time';
        $data['WEIBO_SHOW_ORDER_TYPE1'] = $data['WEIBO_SHOW_ORDER_TYPE1'] ? $data['WEIBO_SHOW_ORDER_TYPE1'] : 'desc';
        $data['WEIBO_SHOW_CACHE_TIME1'] = $data['WEIBO_SHOW_CACHE_TIME1'] ? $data['WEIBO_SHOW_CACHE_TIME1'] : '600';


        $data['WEIBO_SHOW_TITLE2'] = $data['WEIBO_SHOW_TITLE2'] ? $data['WEIBO_SHOW_TITLE2'] : L('_HOT_WEIBO_');
        $data['WEIBO_SHOW_COUNT2'] = $data['WEIBO_SHOW_COUNT2'] ? $data['WEIBO_SHOW_COUNT2'] : 5;
        $data['WEIBO_SHOW_ORDER_FIELD2'] = $data['WEIBO_SHOW_ORDER_FIELD2'] ? $data['WEIBO_SHOW_ORDER_FIELD2'] : 'comment_count';
        $data['WEIBO_SHOW_ORDER_TYPE2'] = $data['WEIBO_SHOW_ORDER_TYPE2'] ? $data['WEIBO_SHOW_ORDER_TYPE2'] : 'desc';
        $data['WEIBO_SHOW_CACHE_TIME2'] = $data['WEIBO_SHOW_CACHE_TIME2'] ? $data['WEIBO_SHOW_CACHE_TIME2'] : '600';
        $order = array('create_time' => L('_DELIVER_TIME_'), 'comment_count' => L('_COMMENT_COUNT_'));

        $builder->keyText('WEIBO_SHOW_TITLE1', L('_TITLE_NAME_'), L('_HOME_BLOCK_TITLE_'));
        $builder->keyText('WEIBO_SHOW_COUNT1', L('_WEIBO_COUNT_SHOW_'), '');
        $builder->keyRadio('WEIBO_SHOW_ORDER_FIELD1', L('_SORT_VALUE_'), L('_TIP_SORT_TYPE_'), $order);
        $builder->keyRadio('WEIBO_SHOW_ORDER_TYPE1', L('_SORT_TYPE_'), L('_TIP_SORT_TYPE_'), array('desc' => L('_COUNTER_'), 'asc' => L('_DIRECT_')));
        $builder->keyText('WEIBO_SHOW_CACHE_TIME1', L('_CACHE_TIME_'), L('_TIP_CACHE_TIME_'));

        $builder->keyText('WEIBO_SHOW_TITLE2', L('_TITLE_NAME_'), L('_HOME_BLOCK_TITLE_'));
        $builder->keyText('WEIBO_SHOW_COUNT2', L('_WEIBO_COUNT_SHOW_'), '');
        $builder->keyRadio('WEIBO_SHOW_ORDER_FIELD2', L('_SORT_VALUE_'), L('_TIP_SORT_TYPE_'), $order);
        $builder->keyRadio('WEIBO_SHOW_ORDER_TYPE2', L('_SORT_TYPE_'), L('_TIP_SORT_TYPE_'), array('desc' => L('_COUNTER_'), 'asc' => L('_DIRECT_')));
        $builder->keyText('WEIBO_SHOW_CACHE_TIME2', L('_CACHE_TIME_'), L('_TIP_CACHE_TIME_'));


        $builder->title(L('_WEIBO_BASIC_SETTINGS_'))
            ->data($data)
            ->keySwitch('SHOW_TITLE', L('_RANK_SHOW_IN_LEFT_'))
            ->keyBool('WEIBO_BR', L('_CONTENT_TYPE_OPEN_'), L('_SUPPORT_ENTER_SPACE_'))
            ->keySwitch('HIGH_LIGHT_AT', L('_HIGHLIGHT_AT_SOMEBODY_'))
            ->keySwitch('HIGH_LIGHT_TOPIC', L('_HIGHLIGHT_WEIBO_TOPIC_'))
            ->keyText('WEIBO_INFO', L('_WEIBO_POST_BOX_UP_LEFT_CONTENT_'))
            ->keyText('WEIBO_NUM', L('_WEIBO_WORDS_LIMIT_'))
            ->keyText('HOT_LEFT', L('_HOT_WEIBO_RULE_'))->keyDefault('HOT_LEFT', 3)
            ->keySwitch('CAN_IMAGE', L('_INSERT_PICTURE_TYPE_OPEN_CLOSE_'))
            ->keySwitch('CAN_TOPIC', L('_INSERT_TOPIC_TYPE_OPEN_CLOSE_'))
            ->keyRadio('COMMENT_ORDER', L('_WEIBO_COMMENTS_LIST_ORDER_'), '', array(0 => L('_TIME_COUNTER_'), 1 => L('_TIME_DIRECT_')))
            ->keyRadio('SHOW_COMMENT', L('_WEIBO_COMMENTS_LIST_DEFAULT_SHOW_HIDE_'), '', array(0 => L('_HIDE_'), 1 => L('_SHOW_')))
            //->keySelect('WEIBO_DEFAULT_TAB', '微博默认显示标签', '', array('all'=>'全站微博','concerned'=>'我的关注','hot'=>'热门微博'))
            ->keyKanban('WEIBO_DEFAULT_TAB', L('_WEIBO_SIGN_DEFAULT_'))
            ->keySwitch('ACTIVE_USER', L('_ACTIVE_USER_SWITCH_'))
            ->keySelect('ACTIVE_USER_ORDER', L('_ACTIVE_USER_SORT_'), '', $types)
            ->keyText('ACTIVE_USER_COUNT', L('_ACTIVE_USER_SHOW_NUMBER_'), '')
            ->keyText('USE_TOPIC', L('_TOPIC_USUAL_'), L('_SHOW_IN_BUTTON_LEFT_'))
            ->keySwitch('NEWEST_USER', L('_USER_SWITCH_NEWEST_'))
            ->keyText('NEWEST_USER_COUNT', L('_USER_SHOW_NUMBER_NEWEST_'), '')
            ->keyDefault('WEIBO_BR', 0)
            ->group(L('_BASIC_SETTINGS_'), 'SHOW_TITLE,WEIBO_NUM,WEIBO_BR,WEIBO_DEFAULT_TAB,HIGH_LIGHT_AT,HIGH_LIGHT_TOPIC,WEIBO_INFO,HOT_LEFT')
            ->group(L('_SETTINGS_TYPE_'), 'CAN_IMAGE,CAN_TOPIC')
            ->group(L('_SETTINGS_COMMENTS_'), 'COMMENT_ORDER,SHOW_COMMENT')
            ->group(L('_SETTINGS_RIGHT_SIDE_'), 'ACTIVE_USER,ACTIVE_USER_ORDER,ACTIVE_USER_COUNT,NEWEST_USER,NEWEST_USER_COUNT')
            ->group(L('_SETTINGS_TOPIC_'), 'USE_TOPIC')
            ->group(L('_HOME_BLOCK_LEFT_'), 'WEIBO_SHOW_TITLE1,WEIBO_SHOW_COUNT1,WEIBO_SHOW_ORDER_FIELD1,WEIBO_SHOW_ORDER_TYPE1,WEIBO_SHOW_CACHE_TIME1')
            ->group(L('_HOME_BLOCK_RIGHT_'), 'WEIBO_SHOW_TITLE2,WEIBO_SHOW_COUNT2,WEIBO_SHOW_ORDER_FIELD2,WEIBO_SHOW_ORDER_TYPE2,WEIBO_SHOW_CACHE_TIME2')
            ->buttonSubmit();


        $builder->display();
    }

    public function configCallback()
    {
        S('weibo_latest_user_top', null);
        S('weibo_latest_user_new', null);
    }


    public function weibo()
    {
        $aPage = I('page', 1, 'intval');
        $aContent = I('content', '', 'op_t');
        $r = 20;
        $map = array('status' => array('EGT', 0));
        $model = M('Weibo');
        $aContent && $map['content'] = array('like', '%' . $aContent . '%');

        $list = $model->where($map)->order('create_time desc')->page($aPage, $r)->select();
        unset($li);
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $attr['class'] = 'btn ajax-post';
        $attr['target-form'] = 'ids';
        $attr1 = $attr;
        $attr1['url'] = $builder->addUrlParam(U('setWeiboTop'), array('top' => 1));
        $attr0 = $attr;
        $attr0['url'] = $builder->addUrlParam(U('setWeiboTop'), array('top' => 0));

        $builder->title(L('_WEIBO_MANAGER_'))
            ->setStatusUrl(U('setWeiboStatus'))->buttonEnable()->buttonDisable()->buttonDelete()->button(L('_STICK_'), $attr1)->button(L('_STICK_CANCEL_'), $attr0)
            ->keyId()->keyLink('content', L('_CONTENT_'), 'comment?weibo_id=###')->keyUid()->keyCreateTime()->keyStatus()
            ->keyDoActionEdit('editWeibo?id=###')->keyMap('is_top', L('_STICK_'), array(0 => L('_STICK_NOT_'), 1 => L('_STICK_')))
            ->search(L('_CONTENT_'), 'content')
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();


    }


    public function setWeiboTop($ids, $top)
    {
        foreach ($ids as $id) {
            D('Weibo')->where(array('id' => $id))->setField('is_top', $top);
            S('weibo_' . $id, null);
        }

        $this->success(L('_SUCCESS_SETTING_'), $_SERVER['HTTP_REFERER']);
    }

    public function weiboTrash()
    {
        $aPage = I('page', 1, 'intval');
        $r = 20;
        $builder = new AdminListBuilder();
        $builder->clearTrash('Weibo');
        //读取微博列表
        $map = array('status' => -1);
        $model = M('Weibo');
        $list = $model->where($map)->order('id desc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();

        //显示页面

        $builder->title('微博回收站')
            ->setStatusUrl(U('setWeiboStatus'))->buttonRestore()->buttonClear('Weibo')
            ->keyId()->keyLink('content', L('_CONTENT_'), 'comment?weibo_id=###')->keyUid()->keyCreateTime()
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function setWeiboStatus($ids, $status)
    {
        $builder = new AdminListBuilder();
        $builder->doSetStatus('Weibo', $ids, $status);
    }

    public function editWeibo()
    {
        $aId = I('id', 0, 'intval');
        $aContent = I('post.content', '', 'op_t');
        $aCreateTime = I('post.create_time', time(), 'intval');
        $aStatus = I('post.status', 1, 'intval');

        $model = M('Weibo');
        if (IS_POST) {
            //写入数据库
            $data = array('content' => $aContent, 'create_time' => $aCreateTime, 'status' => $aStatus);

            $result = $model->where(array('id' => $aId))->save($data);
            S('weibo_' . $aId, null);
            if (!$result) {
                $this->error(L('_FAIL_EDIT_'));
            }

            //返回成功信息
            $this->success(L('_SUCCESS_EDIT_'), U('weibo'));
        } else {
            //读取微博内容
            $weibo = $model->where(array('id' => $aId))->find();

            //显示页面
            $builder = new AdminConfigBuilder();
            $builder->title(L('_WEIBO_EDIT_'))
                ->keyId()->keyTextArea('content', L('_CONTENT_'))->keyCreateTime()->keyStatus()
                ->buttonSubmit(U('editWeibo'))->buttonBack()
                ->data($weibo)
                ->display();
        }
    }


    public function comment()
    {
        $aWeiboId = I('weibo_id', 0, 'intval');
        $aPage = I('page', 1, 'intval');
        $r = 20;
        //读取评论列表
        $map = array('status' => array('EGT', 0));
        if ($aWeiboId) $map['weibo_id'] = $aWeiboId;
        $model = M('WeiboComment');
        $list = $model->where($map)->order('id desc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();
        //显示页面
        $builder = new AdminListBuilder();
        $builder->title(L('_REPLY_MANAGER_'))
            ->setStatusUrl(U('setCommentStatus'))->buttonEnable()->buttonDisable()->buttonDelete()
            ->keyId()->keyText('content', L('_CONTENT_'))->keyUid()->keyCreateTime()->keyStatus()->keyDoActionEdit('editComment?id=###')
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function commentTrash()
    {
        $aPage = I('page', 1, 'intval');
        $r = 20;
        $builder = new AdminListBuilder();
        $builder->clearTrash('WeiboComment');
        //读取评论列表
        $map = array('status' => -1);
        $model = M('WeiboComment');
        $list = $model->where($map)->order('id desc')->page($aPage, $r)->select();
        $totalCount = $model->where($map)->count();
        //显示页面
        $builder->title(L('_REPLY_TRASH_'))
            ->setStatusUrl(U('setCommentStatus'))->buttonRestore()->buttonClear('WeiboComment')
            ->keyId()->keyText('content', L('_CONTENT_'))->keyUid()->keyCreateTime()
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function setCommentStatus($ids, $status)
    {
        foreach ($ids as $id) {
            $comemnt = D('Weibo/WeiboComment')->getComment($id);
            if ($status == 1) {
                D('Weibo/Weibo')->where(array('id' => $comemnt['weibo_id']))->setInc('comment_count');
            } else {
                D('Weibo/Weibo')->where(array('id' => $comemnt['weibo_id']))->setDec('comment_count');
            }
            S('weibo_' . $comemnt['weibo_id'], null);
        }


        $builder = new AdminListBuilder();
        $builder->doSetStatus('WeiboComment', $ids, $status);
    }

    public function editComment()
    {
        $aId = I('id', 0, 'intval');

        $aContent = I('post.content', '', 'op_t');
        $aCreateTime = I('post.create_time', time(), 'intval');
        $aStatus = I('post.status', 1, 'intval');

        $model = M('WeiboComment');
        if (IS_POST) {
            //写入数据库
            $data = array('content' => $aContent, 'create_time' => $aCreateTime, 'status' => $aStatus);
            $result = $model->where(array('id' => $aId))->save($data);
            S('weibo_comment_' . $aId);
            if (!$result) {
                $this->error(L('_ERROR_EDIT_'));
            }
            //显示成功消息
            $this->success(L('_SUCCESS_EDIT_'), U('comment'));
        } else {
            //读取评论内容
            $comment = $model->where(array('id' => $aId))->find();
            //显示页面
            $builder = new AdminConfigBuilder();
            $builder->title(L('_EDIT_COMMENTS_'))
                ->keyId()->keyTextArea('content', L('_CONTENT_'))->keyCreateTime()->keyStatus()
                ->data($comment)
                ->buttonSubmit(U('editComment'))->buttonBack()
                ->display();
        }
    }


    public function topic()
    {
        $aPage = I('page', 1, 'intval');
        $aName = I('name', '', 'op_t');
        $r = 20;
        $model = M('WeiboTopic');
        $aName && $map['name'] = array('like', '%' . $aName . '%');

        $list = $model->where($map)->order('id asc')->page($aPage, $r)->select();
        unset($li);
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $attr['class'] = 'btn ajax-post';
        $attr['target-form'] = 'ids';
        $attr1 = $attr;
        $attr1['url'] = $builder->addUrlParam(U('setTopicTop'), array('top' => 1));
        $attr0 = $attr;
        $attr0['url'] = $builder->addUrlParam(U('setTopicTop'), array('top' => 0));

        $attr_del = $attr;
        $attr_del['url'] = $builder->addUrlParam(U('delTopic'), array());

        $builder->title(L('_TOPIC_MANAGER_'))
            ->button(L('_RECOMMEND_'), $attr1)->button(L('_RECOMMEND_CANCEL_'), $attr0)
            ->button(L('_DELETE_'), $attr_del)
            ->keyId()
            ->keyLink('name', L('_CONTENT_'), 'weibo?content=%23{$name}%23')
            ->keyUid()
            ->keyText('logo', L('_LOGO_'))
            ->keyText('intro', L('_LEADER_WORDS_'))
            ->keyText('qrcode', L('_QR_CODE_'))
            ->keyText('uadmin', L('_TOPIC_ADMIN_'))
            ->keyText('read_count', L('_VIEWS_'))
            ->keyMap('is_top', L('_RECOMMEND_YES_OR_NOT_'), array(0 => L('_RECOMMEND_NOT_'), 1 => L('_RECOMMEND_')))
            ->search(L('_NAME_'), 'name')
            ->data($list)
            ->pagination($totalCount, $r)
            ->display();
    }

    public function setTopicTop($ids, $top)
    {
        M('WeiboTopic')->where(array('id' => array('in', $ids)))->setField('is_top', $top);
        S('topic_rank', null, 60);
        $this->success(L('_SUCCESS_SETTING_'), $_SERVER['HTTP_REFERER']);
    }

    public function delTopic($ids)
    {

        M('WeiboTopic')->where(array('id' => array('in', $ids)))->delete();
        S('topic_rank', null, 60);
        $this->success(L('_SUCCESS_DELETE_'), $_SERVER['HTTP_REFERER']);
    }


}
