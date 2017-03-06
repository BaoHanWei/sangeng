<?php


namespace Api\Controller;


class WeiboController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    /**发送微博
     *
     */
    public function sendWeibo()
    {
        $mid = $this->requireIsLogin(); //当前用户uid
        $aContent = I_POST('content');
        $aFrom = I_POST('from', 'text');
        $aExtra = I_POST('extra', 'text');
        $aFrom = get_from($aFrom);
        $aType = I_POST('type', 'text');
        //权限判断
        $this->ApiCheckAuth('Weibo/Index/doSend', -1, '您无微博发布权限。');

        if (empty($aContent)) {
            $this->apiError('发布内容不能为空。');
        }
        if(mb_strlen($aContent,'utf-8')>modC('WEIBO_NUM', 140, 'WEIBO')){
            $this->apiError('微博内容过长');
        }
        // 行为限制
        $return = check_action_limit('add_weibo', 'weibo', 0, $mid, true);
        if ($return && !$return['state']) {
            $this->apiError($return['info']);
        }
        $content=parse_at_app_users($aContent);

        // todo 判断各种类型参数的判断
        $feed_data = json_decode($aExtra, true);
        switch ($aType) {
            case 'image':
                if (empty($feed_data['attach_ids'])) {
                    $this->apiError('请上传图片！');
                }
                break;
            default :
                break;
        }
        // 执行发布，写入数据库
        $data = array('from' => $aFrom, 'uid' => $mid, 'create_time' => time(), 'type' => $aType, 'status' => 1, 'content' => $aContent, 'data' => serialize($feed_data),);
        $weiboModel = D('Api/Weibo');
        $weiboModel->addTopic($aContent);
        $weibo_id = $weiboModel->sendWeibo($data);
        if (!$weibo_id) {
            $this->apiError('添加数据库失败！');
        }
        //行为日志

        action_log('add_weibo', 'weibo', $weibo_id,  $this->isLogin());
        //处理@信息并发送消息
        $atUsers = get_at_uids($aContent);

        $my_username = get_nickname( $mid);
        $title = $my_username . '@了您';
        foreach ($atUsers as &$uid) {
            $message = '内容：' . $content;
            $messageType = 1;
            D('Common/Message')->sendMessage($uid, $title, $message, 'Weibo/Index/weiboDetail', array('id' => $weibo_id), $mid, $messageType);
        }

        //@的推送功能
        $atUsers = array_filter($atUsers);
        $pushData['content'] = 'weibo';
        $pushData['payload'] = array('type' => 'os_at','info' => $weibo_id,'content' => json_encode(fmat_at_text($aContent)));
        D('Igt')->pushMessageToSingle($atUsers,$pushData);     //使用的单推方法

        clean_query_user_cache($mid, array('weibocount'));

        // 向关注的人推送
        $fuids= M('Follow')->where(array('follow_who'=>$mid))->select();
        $fuids = array_column($fuids,'who_follow');
        $intersectArr = array_intersect($atUsers,$fuids);
        $fuids = array_diff($fuids,$intersectArr);      //如果前面@过的用户，这里则不推送

        $pushData['content'] = 'weibo';
        $pushData['payload'] = array('type' => 'os_send','info' => $weibo_id,'content' => json_encode($aContent));
        D('Igt')->pushMessageToSingle($fuids,$pushData);     //使用的单推方法

        $weibo = $weiboModel->getWeibo($weibo_id,$mid);
        if($weibo){
            $this->apiSuccess('发布微博成功',$weibo);
        }else
        {
            $this->apiError('发布失败');
        }
    }

    //获取单条微博数据
    public function getWeibo()
    {
        $mid = $this->isLogin();
        $aId = I('get.id');
        $weiboModel = D('Api/Weibo');
        $weibo = $weiboModel->getWeibo($aId,$mid);
        $this->apiSuccess($weibo);
    }

    //获取微博列表数据
    public function getWeiboList()
    {
        $aPage = I_POST('page', 'intval');
        $type=I_POST('type', 'text');
        $mid = $this->isLogin();

        if (empty($aPage)) {
            $aPage = 1;
        }
        $weiboModel = D('Api/Weibo');

        $order= 'create_time desc';
        switch ($type) {
            case 'we':
                // 获取我关注的微博
                $follow_who_ids = D('Follow')->where(array('who_follow' => $mid))->field('follow_who')->select();

                if ($follow_who_ids) {
                    $follow_who_ids = array_column($follow_who_ids, 'follow_who'); //简化数组操作。
                    $follow_who_ids = array_merge($follow_who_ids, array($mid)); //加上自己的微博
                    $map['uid'] = array('in', $follow_who_ids);
                } else {
                    $map['uid'] = $mid;
                } //获取微博列表
                $list = $weiboModel->getList(array('field' => 'id', 'order' =>$order, 'page' => $aPage, 'where' => array('status' => 1,'is_top'=>0, $map))); //我关注的人的微博
                break;
            case 'all':
                //获取全部微博列表
                $list = $weiboModel->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => array('status' => 1,'is_top'=>0)));
                break;
            case 'hot':
                $hot_left = modC('HOT_LEFT', 3);
                $time_left = get_some_day($hot_left);
                $param['create_time'] = array('gt', $time_left);
                $param['status'] = 1;
                $param['is_top'] = 0;
                $weiboModel = D('Api/Weibo');
                //获取微博列表
                $list = $weiboModel->getList(array('field' => 'id', 'where' => $param, 'page' => $aPage, 'order' => 'comment_count desc'));
                break;
            default:
                //获取全部微博列表
                $list = $weiboModel->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => array('status' => 1,'is_top'=>0)));
        }
        //获取每个微博详情
        foreach ($list as &$e) {
            $e = $weiboModel->getWeibo($e,$mid);
        }
        unset($e);
        if(!$list){
            $this->apiError('当前无更多微博');
        }
        $top_list= $weiboModel->getWeiboTopList($mid);
        if($top_list==false){
            $top_list=array();
        }
        //返回微博列表
        $this->apiSuccess($list,$top_list);
    }

    //获取指定用户微博列表数据
    public function getUserWeiboList()
    {
        $aPage = I_POST('page', 'intval');
        $mid = $this->isLogin();
        $uid =  I_POST('uid', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $weiboModel = D('Api/Weibo');
        $order= 'create_time desc';
            $list = $weiboModel->getList(array('field' => 'id', 'order' =>$order, 'page' => $aPage, 'where' => array('status' => 1,'uid'=>$uid,))); //用户的微博
        //获取每个微博详情
        foreach ($list as &$e) {
            $e = $weiboModel->getWeibo($e,$mid);
        }
        unset($e);
        if(!$list){
            $this->apiError('当前无更多微博');
        }
        //返回微博列表
        $this->apiSuccess($list);
    }

    //删除微博
    public function deleteWeibo()
    {
        $mid = $this->requireIsLogin();
        $aId = I('get.id', 0, 'intval');
        if (empty($aId)) {
            $this->apiError('参数错误');
        }
        $weiboModel = D('Api/Weibo');
        //从数据库中删除微博、以及附属评论
        $result = $weiboModel->where(array('id' => $aId, 'status' => 1))->find();
        if (!$result) {
            $this->apiError('找不到此微博');
        }
        //权限判断
        $this->ApiCheckAuth('Weibo/Index/doDelWeibo', $result['uid'], '您无删除微博评论权限。');

        $res = $weiboModel->delWeibo($aId,$mid);
        if (!$res) {
            $this->apiError('删除失败');
        } else {
            D('Weibo/WeiboComment')->where(array('weibo_id' => $aId))->setField('status', -1);
            action_log('del_weibo', 'weibo', $aId, $mid);
            $this->apiSuccess('删除成功');
        }
    }

    //微博评论功能
    public function sendComment()
    {
        $mid = $this->requireIsLogin();

        $aContent = I_POST('content', 'text'); //说点什么的内容
        $aWeiboId = I_POST('weibo_id', 'intval'); //要评论的微博的ID
        $aCommentId = I_POST('to_comment_id', 'intval');
        $weiboModel = D('Api/Weibo');
        if (empty($aContent)) {
            $this->apiError('评论内容不能为空。');
        }

        $this->ApiCheckAuth('Weibo/Index/doComment', -1, '您无微博评论权限。');
        $return = check_action_limit('add_weibo_comment', 'weibo_comment', 0, $mid, true); //行为限制
        if ($return && !$return['state']) {
            $this->apiError($return['info']);
        }

        $comment_id = $weiboModel->sendComment($aWeiboId, $aContent, $aCommentId, $mid); //发布评论
        if (!$comment_id) {
            $this->apiError('添加数据库失败！');
        }

        //行为日志
        action_log('add_weibo_comment', 'weibo_comment', $comment_id, $mid);

        //通知微博作者
        $weibo = $weiboModel->getWeibo($aWeiboId);
        $weiboModel->sendCommentMessage($weibo['uid'], $aWeiboId, "评论内容：$aContent", $mid);


        //通知回复的人

        $toComment = $weiboModel->getComment($aCommentId);
        if ($toComment['uid'] != $weibo['uid']) {
            $weiboModel->sendCommentMessage($toComment['uid'], $aWeiboId, "回复内容：$aContent", $mid);
        }
        $userList = get_at_uids($aContent);
        $weiboModel->sendAtMessage($userList, $aWeiboId, $aContent, $mid);

        //推送功能
        $userList = array_merge(array($weibo['uid']),$userList,array($toComment['uid']));
        $userList = array_filter($userList);
        $pushData['content'] = 'weibo';
        $pushData['payload'] = array('type' => 'os_reply','info' => $weibo['id'],'content' => json_encode(fmat_at_text($aContent)));
        D('Igt')->pushMessageToSingle($userList,$pushData);     //使用的单推方法

        // 返回数据给客户端
        $comment = $weiboModel->getComment($comment_id);
        $this->apiSuccess('返回成功。', $comment);
    }

    /*删除评论*/
    public function deleteComment()
    {
        $aCommentId = I('get.id', 'intval');

        $mid = $this->requireIsLogin();
        $weiboModel = D('Api/Weibo');
        $comment = $weiboModel->getComment($aCommentId);

        // 权限判断
        $this->ApiCheckAuth('Weibo/Index/doDelComment', $comment['uid'], '您无删除微博评论权限。');

        $result = $weiboModel->delComment($aCommentId);
        if (!$result) {
            $this->apiError('删除失败');
        }
        action_log('del_weibo_comment', 'weibo_comment', $aCommentId, $mid);
        $this->apiSuccess('删除成功');

    }

    public function weiboTopic()
    {
        $aType = I_POST('type','intval');

        $aPage = I_POST('page','intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        if ($aType == 1) {
            $h = 24;
        }else{
            $h = 24 * 7;
        }
        $topicModel = D('Api/Weibo');
        $topics = $topicModel->getHot($h, 10, $aPage);

        $this->apiSuccess('返回成功',$topics);
    }

    public function getTopic()
    {
        $aId = I('get.id','intval');
        $topic=D('Weibo/weiboTopic')->where(array('status'=>1,'id'=>$aId))->find();
        $weiboModel = M('Weibo');
        $map['content'] = array('like', "%#{$topic['name']}#%");
        $topic['weibos'] = $weiboModel->where($map)->count();
        $topic['logo_url'] = array();
        if (is_numeric($topic['logo'])) {

            $topic['logo_url']['ori'] = render_picture_path_without_root(get_cover($topic['logo'], 'path'));
            $topic['logo_url']['thumb'] = render_picture_path_without_root(getThumbImageById($topic['logo'], 100, 100));
        } else {
            $topic['logo_url']['ori'] = null;
            $topic['logo_url']['thumb'] = null;
        }
        $topic['user'] = D('Api/User')->getUserInfo($topic['uadmin']);
        $this->apiSuccess('返回成功',$topic);
    }

    public function getTopicDetail()
    {
        $mid = $this->isLogin();
        $aPage = I_POST('page','intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aId = I('get.id','intval');
        $topic=D('Weibo/weiboTopic')->where(array('status'=>1,'id'=>$aId))->find();
        D('Weibo/weiboTopic')->where(array('status'=>1,'id'=>$aId))->setInc('read_count');
        if(!$topic){
            $this->apiError('这个话题可能已被删除或屏蔽');
        }

        $map['content'] = array('like', "%#{$topic['name']}#%");
        $map['status']=1;
        $weiboModel = D('Api/Weibo');
        $weibos = $weiboModel->getList(array('field' => 'id', 'order' => 'create_time desc', 'page' => $aPage, 'where' => $map));
        foreach ($weibos as &$e) {
            $e = $weiboModel->getWeibo($e,$mid);
        }
        unset($e);
        $this->apiSuccess('返回成功',$weibos);
    }

    public function getComment()
    {
        $aId = I('get.id', 'intval');
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $order = modC('COMMENT_ORDER', 0, 'WEIBO') == 1 ? 'create_time asc' : 'create_time desc';
        $weiboModel = D('Api/Weibo');
        $weiboCommentModel = D('Api/WeiboComment');
        $Comment = $weiboCommentModel->getList(array('field' => 'id', 'where' => array('status' => 1, 'weibo_id' => $aId), 'order' =>$order, 'page' => $aPage));

        foreach ($Comment as &$e) {
            $e = $weiboModel->getComment($e);
        }
        unset($e);
        //返回微博列表
        $this->apiSuccess('获取成功', $Comment);
    }

    /*转发微博，需要登录*/
    public function sendRepost()
    {
        $mid = $this->requireIsLogin();
        $aContent = I_POST('content', 'text'); //说点什么的内容
        $aSourceId = I_POST('source_id', 'intval'); //获取该微博源ID
        $aWeiboId = I_POST('weibo_id', 'intval'); //要转发的微博的ID
        $aBeComment = I_POST('becomment', 0, 'intval');
        $aFrom = I_POST('from', 'text');
        $aFrom = get_from($aFrom);
        $aType = 'repost';

        if (empty($aContent)) {
            $this->apiError('转发内容不能为空');
        }
        if(strlen($aContent)>modC('WEIBO_NUM', 140, 'WEIBO')){
            $this->apiError('微博内容过长');
        }

        $this->ApiCheckAuth('Weibo/Index/doSendRepost', -1, '您无微博转发权限。');

        $return = check_action_limit('add_weibo', 'weibo', 0, $mid, true);
        if ($return && !$return['state']) {
            $this->apiError($return['info']);
        }
        $weiboModel = D('Api/Weibo');

        $feed_data = array();
        $sourse = $weiboModel->getWeibo($aSourceId);

        $feed_data['source'] = $sourse;
        $feed_data['sourceId'] = $aSourceId;
        //发送微博
        $data = array('from' => $aFrom, 'uid' => $mid, 'create_time' => time(), 'type' => $aType, 'status' => 1, 'content' => $aContent, 'data' => serialize($feed_data),);
        $weibo_id = $weiboModel->sendWeibo($data);

        if ($aBeComment) {
            $weiboModel->sendComment($aWeiboId, $aContent, 0, $mid);
        }
        if ($weibo_id) {
            $weiboModel->where(array('id' => $aSourceId))->setInc('repost_count');
            $aWeiboId != $aSourceId && $weiboModel->where(array('id' => $aWeiboId))->setInc('repost_count');
            S('weibo_' . $aWeiboId, null);
            S('weibo_' . $aSourceId, null);
        }
        $user = query_user(array('nickname'), $mid);
        $toUid = $weiboModel->where(array('id' => $aWeiboId))->getField('uid');
        D('Common/Message')->sendMessage($toUid, $user['nickname'] . '转发了您的微博！', '转发提醒', 'Weibo/Index/weiboDetail', array('id' => $weibo_id), $mid, 1);

        //微博转发推送
        $pushData['content'] = 'weibo';
        $pushData['payload'] = array('type' => 'os_forward','info' => $weibo_id,'content' => json_encode($aContent));
        D('Igt')->pushMessageToSingle(array($toUid),$pushData);     //使用的单推方法


        $weibo = $weiboModel->getWeibo($weibo_id,$mid);

        //返回成功结果
        $this->apiSuccess('转发成功', $weibo);
    }

    //微博置顶操作
    public function setTop()
    {
        $aId = I('get.id', 'intval');
        $mid = $this->requireIsLogin();
        $this->ApiCheckAuth('Weibo/Index/setTop', -1, '置顶失败，您不具备管理权限。');

        $weiboModel = D('Weibo');
        $weibo = $weiboModel->find($aId);
        if (!$weibo) {
            $this->apiError('置顶失败，微博不存在。');
        }
        if ($weibo['is_top'] == 0) {
            if ($weiboModel->where(array('id' => $aId))->setField('is_top', 1)) {
                action_log('set_weibo_top', 'weibo', $aId, $mid);
                S('weibo_' . $aId, null);

                $this->apiSuccess('置顶成功。');
            } else {
                $this->apiError('置顶失败。');
            };
        } else {
            if ($weiboModel->where(array('id' => $aId))->setField('is_top', 0)) {
                action_log('set_weibo_down', 'weibo', $aId, $mid);
                S('api_weibo_' . $aId, null);
                $this->apiSuccess('取消置顶成功。');
            } else {
                $this->apiError('取消置顶失败。');
            };
        }
    }

    /*****获取配置项
     * **
     */
    /*获取字数*/
    public function weiboConfig()
    {
        $config = array();
        $config['limit'] = modC('WEIBO_NUM', 140, 'WEIBO');
        $config['info'] = modC('WEIBO_INFO', '有什么新鲜事想告诉大家?', 'WEIBO');
        $config['is_topic'] = modC('CAN_TOPIC', 1, 'WEIBO');
        $config['is_image'] = modC('CAN_IMAGE', 1, 'WEIBO');
        $config['tab_config'] = get_kanban_config('WEIBO_DEFAULT_TAB', 'enable', array('all', 'concerned', 'hot'), 'WEIBO');
        $this->apiSuccess('微博字数限制获取成功。', $config);
    }


}