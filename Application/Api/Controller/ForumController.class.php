<?php


namespace Api\Controller;


class ForumController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function forumType()
    {
        $types = D('Forum/ForumType')->where(array('status' => 1))->select();

        $this->apiSuccess('返回成功', $types);
    }

    public function forum()
    {

        $mid = is_login();
        $aPage = I_POST('page', 'intval');


        if (empty($aPage)) {
            $aPage = 1;
        }

        $aTypeId = I_POST('type_id', 'intval');//板块id
        $aForumId = I_POST('forum_id', 'intval');

        if ($aForumId) {
            $types = D('Forum/Forum')->where(array('status' => 1, 'id' => $aForumId))->find();
        } else {
            if ($aTypeId) {
                $types = D('Api/Forum')->getForumList(array('status' => 1, 'type_id' => $aTypeId), $mid);
            } else {
                $types = D('Api/Forum')->getForumList(array('status' => 1), $mid);
            }
        }
        if (!$types) {
            $this->apiError('无论坛板块显示');
        }
        if ($aForumId) {

            $forumPostModel = D('ForumPost');
            $forumPostReplyModel = D('ForumPostReply');

            $map['status'] = 1;
            $map['forum_id'] = $types['id'];

            if (D('Forum/ForumFollow')->where(array('uid' => $mid, 'forum_id' => $types['id']))->find()) {
                $types['is_follow'] = 1;
            } else {
                $types['is_follow'] = 0;
            }
            $types['background'] = $types['background'] ? render_picture_path_without_root(getThumbImageById($types['background'], 800, 'auto')) : C('TMPL_PARSE_STRING.__IMG__') . '/default_bg.jpg';
            $types['logo'] = $types['logo'] ? render_picture_path_without_root(getThumbImageById($types['logo'], 128, 128)) : C('TMPL_PARSE_STRING.__IMG__') . '/default_logo.png';
            $types['topic_count'] = $forumPostModel->where($map)->count();
            $post_id = $forumPostModel->where(array('forum_id' => $types['id']))->field('id')->select();
            $p_id = getSubByKey($post_id, 'id');
            $map['post_id'] = array('in', implode(',', $p_id));
            $types['total_count'] = $types['topic_count'] + $forumPostReplyModel->where($map)->count();
            $types['title'] = op_t($types['title']);
            $type = D('Forum/ForumType')->where(array('id' => $types['type_id']))->find();
            $types['type_title'] = $type['title'];

            $this->apiSuccess('返回成功', $types);

        } else {
            foreach ($types as &$t) {
                $t['title'] = op_t($t['title']);
                $type = D('Forum/ForumType')->where(array('id' => $t['type_id']))->find();
                $t['type_title'] = $type['title'];
            }
            $this->apiSuccess('返回成功', $types);
        }


    }

    public function getPosts()
    {
        $mid = $this->isLogin();
        $aPage = I_POST('page', 'intval');
        $aForumId = I_POST('forum_id', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $order = I_POST('order', 'op_t');
        if ($order == 'ctime') {
            $order = 'create_time desc';
        } else if ($order == 'reply') {
            $order = 'last_reply_time desc';
        } else {
            $order = 'create_time desc';//默认的
        }
        $map['status'] = 1;

        $order = 'is_top desc ,' . $order;
        if ($aForumId) {
            $map['forum_id'] = $aForumId;
            $postList = D('Forum/ForumPost')->getList(array('field' => 'id', 'page' => $aPage, 'where' => $map, 'order' => $order));
        } else {
            $postList = D('Forum/ForumPost')->getList(array('field' => 'id', 'page' => $aPage, 'where' => $map, 'order' => $order));
        }
        $ForumPostModel = D('Api/Forum');
        foreach ($postList as &$t) {
            $t = $ForumPostModel->getSimplePosts($t);
        }
        if (!$postList) {
            $this->apiError('找不到帖子');
        }
        $this->apiSuccess('返回成功', $postList);
    }

    public function getPost()
    {
        $mid = $this->isLogin();
        $aId = I('get.id', '', 'intval');
        $ForumPostModel = D('Api/Forum');
        $post_ids = D('support')->where(array('appname' => 'Forum', 'table' => 'post', 'uid' => $mid))->field('row')->select();
        $post_ids = array_column($post_ids, 'row');
        $post = $ForumPostModel->getPosts($aId, $post_ids);
        $this->apiSuccess('返回成功', $post);
    }

    public function getRecommendPost()
    {
        $mid = $this->isLogin();

        $text = modC('SUGGESTION_POSTS', '', 'forum');
        $keys = explode('|', $text);

        foreach ($keys as $key => &$v) {
            $post = D('Forum/ForumPost')->where(array('id' => $v, 'status' => 1))->find();
            if (!$post) {
                unset($keys[$key]);
            }
            $v = D('Api/Forum')->getSimplePosts($v);
        }
        if (!$keys) {
            $this->apiError('无推荐帖子');
        }
        $this->apiSuccess('返回成功', $keys);
    }

    public function getTopPost()
    {
        $mid = $this->isLogin();
        $aOrder = I_POST('order', 'text');

        if ($aOrder == 'ctime') {
            $aOrder = 'create_time desc';
        } else if ($aOrder == 'reply') {
            $aOrder = 'last_reply_time desc';
        } else {
            $aOrder = 'last_reply_time desc';//默认的
        }
        $aId = I_POST('id', 'intval');//论坛id

        $ForumPostModel = D('Api/Forum');
        if (empty($aId)) {
            $list_top = D('Forum/ForumPost')->where(array('status' => 1, 'is_top' => 2))->order($aOrder)->select();
        } else {
//            array('status' => 1, 'is_top' => 2)
            $list_top = D('Forum/ForumPost')->where(array('status' => 1, 'is_top' => array('gt', '0'), 'forum_id' => $aId))->order($aOrder)->select();
        }
        foreach ($list_top as &$v) {
            $v = $ForumPostModel->getSimplePosts($v['id']);
        }
        if (!$list_top) {
            $this->apiError('无置顶帖子');
        } else {
            $this->apiSuccess('返回成功', $list_top);
        }

    }

    public function sendPost()
    {
        $mid = $this->requireIsLogin();
        $aForumId = I_POST('forum_id', 'intval');
        $aPostId = I_POST('get.id', '', 'intval');
        $aContent = I_POST('content','');

        $aTitle = I_POST('title', 'text');
        $aSendWeibo = I_POST('sendWeibo', 'intval');
        if (strlen($aContent) < 20) {
            $this->apiError('内容不得少于20个字');
        }
        if (empty($aTitle)) {
            $this->apiError('请输入标题');
        }

        $ForumPostModel = D('Api/Forum');
        $data['uid'] = $mid;
        $data['content'] = $aContent;
        $data['status'] = 1;
        $data['forum_id'] = $aForumId;
        $data['create_time'] = time();
        $data['update_time'] = time();
        $data['title'] = $aTitle;
        $isEdit = $aPostId ? true : false;
        if ($isEdit) {
        $this->ApiCheckAuth('Forum/Index/editPost', get_expect_ids(0, 0, $aPostId, 0, 1), '无权编辑');
    } else {
        $this->ApiCheckAuth('Forum/Index/addPost', -1, '无权发布');
        $this->checkActionLimit('forum_add_post', 'Forum', null, $mid);
    }

        $this->requireForumAllowPublish($aForumId);

        if ($aPostId) {

            if (!D('Forum/ForumPost')->where(array('status' => 1, 'id' => $aPostId, 'forum_id' => $aForumId))->find()) {
                $this->apiError('帖子不存在');
            }
            $result = D('Forum/ForumPost')->save($data);
            if (!$result) {
                $this->apiError('编辑失败');
            }
            action_log('forum_edit_post', 'Forum', $aPostId, $mid);
        } else {
            $result = D('Forum/ForumPost')->add($data);
            if (!$result) {
                $this->apiError('发布失败');
            }
            action_log('forum_add_post', 'Forum', $result, $mid);
            $post_id = $result;
        }

        //实现发布帖子发布图片微博(公共内容)
        $type = 'feed';
        $feed_data = array();
        //解析并成立图片数据
        $arr = array();
        preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/", $data['content'], $arr); //匹配所有的图片

        if (!empty($arr[0])) {

            $feed_data['attach_ids'] = '';
            $dm = "http://$_SERVER[HTTP_HOST]" . __ROOT__; //前缀图片多余截取
            $max = count($arr['1']) > 9 ? 9 : count($arr['1']);
            for ($i = 0; $i < $max; $i++) {
                if (isset($result_id)) {
                    unset($result_id);
                }
                $tmparray = strpos($arr['1'][$i], $dm);
                if (!is_bool($tmparray)) {
                    $path = mb_substr($arr['1'][$i], strlen($dm), strlen($arr['1'][$i]) - strlen($dm));
                    $result_id = D('Home/Picture')->where(array('path' => $path))->getField('id');
                } else {
                    if (strlen(__ROOT__) > 0) {//zzl兼容二级域名
                        $tmparray = strpos($arr['1'][$i], __ROOT__);
                        if (!is_bool($tmparray)) {
                            $path = mb_substr($arr['1'][$i], strlen(__ROOT__), strlen($arr['1'][$i]) - strlen(__ROOT__));
                            $result_id = D('Home/Picture')->where(array('path' => $path))->getField('id');
                            if (!$result_id) {
                                $result_id = D('Home/Picture')->add(array('path' => $path, 'url' => $path, 'status' => 1, 'create_time' => time()));
                            }
                        }
                    }
                    if (!isset($result_id) || !$result_id) {
                        $path = $arr['1'][$i];
                        $result_id = D('Home/Picture')->where(array('path' => $path))->getField('id');
                        if (!$result_id) {
                            $result_id = D('Home/Picture')->add(array('path' => $path, 'url' => $path, 'status' => 1, 'create_time' => time()));
                        }
                    }
                }
                $feed_data['attach_ids'] = $feed_data['attach_ids'] . ',' . $result_id;
            }
            $feed_data['attach_ids'] = substr($feed_data['attach_ids'], 1);
        }

        $feed_data['attach_ids'] != false && $type = "image";
        if (D('Common/Module')->isInstalled('Weibo')) { //安装了微博模块
            if ($aSendWeibo) {
                //开始发布微博

                if ($isEdit) {
                    D('Weibo/Weibo')->addWeibo($mid, '编辑帖子' . "【" . $aTitle . "】：" . U('detail', array('id' => $aPostId), null, true), $type, $feed_data);
                } else {

                    D('Weibo/Weibo')->addWeibo($mid, '发布帖子' . "【" . $aTitle . "】：" . U('detail', array('id' => $post_id), null, true), $type, $feed_data);
                }
            }
        }
        $post = $ForumPostModel->getPosts($post_id);
        $this->apiSuccess('发布成功', $post);
    }

    public function getFollowPost()
    {
        $uid = $this->requireIsLogin();
        $aId = I_POST('id', 'intval');
        if (empty($aId)) {
            $this->apiError('关注的版块ID不合法。');
        }
        $data['forum_id'] = $aId;
        $data['uid'] = $uid;
        if ($data['uid'] == 0) {
            $this->apiError('关注者UID错误。');
        }
        $had = M('ForumFollow')->where($data)->find();
        if ($had) {
            M('ForumFollow')->delete($had['id']);
        } else {
            M('ForumFollow')->add($data);
        }
        $hads = M('ForumFollow')->where($data)->find();
        if (!$hads) {
            $this->apiError('取消关注成功');
        } else {
            $this->apiSuccess('关注成功！');
        }
    }


    //收藏帖子
    public function collectionPost()
    {
        $mid =is_login();
        $aPostId = I_POST('post_id', 'intval');

        //查询数据库内是否已收藏
        $result = D('Forum/ForumBookmark')->where(array('post_id' => $aPostId, 'uid' => $mid))->find();
        if ($result) {
            $this->apiError('帖子已收藏');
        } else {
            //写入数据库
            $data['post_id'] = $aPostId;
            $data['uid'] = $mid;
            $data['create_time'] = time();
            $result = D('Forum/ForumBookmark')->add($data);
        }
        //返回成功消息
        $collection = D('Forum/ForumBookmark')->where(array('post_id' => $result))->find();
        $this->apiSuccess('收藏成功', $collection);
    }


    //给帖子回复
    public function sendPostComment()
    {
        $mid = $this->requireIsLogin();
        $aPostId = I_POST('post_id', 'intval');
        if (!$aPostId) {
            $this->apiError('帖子不存在');
        }
        $aContent = I_POST('content', 'op_t');
        $data['uid'] = $mid;
        $data['content'] = $aContent;
        $data['status'] = 1;
        $data['post_id'] = $aPostId;
        $data['create_time'] = time();
        $data['update_time'] = time();
        $uid = D('Forum/ForumPost')->where(array('id' => $aPostId))->field('uid')->select();
        $this->ApiCheckAuth('Forum/Index/doReply', $uid['uid'], '无权评论');
        //确认有权限评论 end

        $this->checkActionLimit('forum_post_reply', 'Forum', null, $mid);
        $uid = array_column($uid, 'uid');

        $result = D('Forum/ForumPostReply')->add($data);
        action_log('add_post_reply', 'ForumPostReply', $result, $mid);
        $postModel = D('ForumPost');

        $postModel->where(array('id' => $aPostId))->setInc('reply_count');

        //更新最后回复时间
        $postModel->where(array('id' => $aPostId))->setField('last_reply_time', time());
        $post = $postModel->find($aPostId);
        D('Forum')->where(array('id' => $post['forum_id']))->setField('last_reply_time', time());

        $this->sendReplyMessage($mid, $aPostId, $aContent, $result);
//        $list['title']='论坛';
//        $list['content']= get_nickname( $mid) . '回复了您的帖子：' . $aContent;
//        $list['message']='帖子回复';
//        $list['forum']=$aPostId;
//        $list['message_type']='forum_post_comment';
//        $arr=array($mid);
//        $list['cids']=D('Api/User')->getUserCID($arr);
//        D('Api/Igt')->pushMessageToSingle(4,$list);
        $reply = D('Api/Forum')->getComment($result, $uid);

        if (in_array($reply['uid'], $uid)) {
            $val['is_landlord'] = '1';
        } else {
            $val['is_landlord'] = '0';
        }
        $this->apiSuccess('返回成功', $reply);
    }

    //给评论回复
    public function sendComment()
    {
        $mid = $this->requireIsLogin();

        $aToReplyId = I_POST('to_reply_id', 'intval');
        $aContent = I_POST('content', 'text');

        if ($aToReplyId) {
            $LzlReply = D('Forum/ForumLzlReply')->where(array('id' => $aToReplyId))->find();
            $data ['post_id'] = $LzlReply['post_id'];
            $data ['to_f_reply_id'] = $LzlReply['to_f_reply_id'];
            $data ['content'] = $aContent;
            $data ['uid'] = $mid;
            $data ['to_uid'] = $LzlReply['uid'];
            $data ['ctime'] = time();
            $data ['to_reply_id'] = $aToReplyId;
            $result = D('Forum/ForumLzlReply')->add($data);
            if (!$result) {
                $this->apiError('发布失败');
            }
            //增加帖子的回复数
            D('Forum/ForumPost')->where(array('id' => $LzlReply['post_id']))->setInc('reply_count');
            //更新最后回复时间
            D('Forum/ForumPost')->where(array('id' => $LzlReply['post_id']))->setField('last_reply_time', time());

            $Reply = D('Forum/ForumLzlReply')->where(array('id' => $result,))->find();

            $Reply ['ctime'] = friendlyDate($Reply ['ctime']);
            $Reply ['user'] = query_user(array('uid', 'username', 'nickname', 'avatar128'));

            $this->apiSuccess('返回成功', $Reply);
        } else {

            $aToFReplyId = I_POST('to_f_reply_id', 0, 'intval');

            $LzlReply = D('Forum/ForumPostReply')->where(array('id' => $aToFReplyId))->find();

            $data ['post_id'] = $LzlReply['post_id'];
            $data ['to_f_reply_id'] = $aToFReplyId;
            $data ['content'] = $aContent;
            $data ['uid'] = $mid;
            $data ['to_uid'] = $LzlReply['uid'];
            $data ['ctime'] = time();
            $data ['to_reply_id'] = 0;
            $result = D('Forum/ForumLzlReply')->add($data);
            if (!$result) {
                $this->apiError('发布失败');
            }
            //增加帖子的回复数
            D('Forum/ForumPost')->where(array('id' => $LzlReply['post_id']))->setInc('reply_count');
            //更新最后回复时间
            D('Forum/ForumPost')->where(array('id' => $LzlReply['post_id']))->setField('last_reply_time', time());

            $Reply = D('Forum/ForumLzlReply')->where(array('id' => $result))->find();
            $Reply ['ctime'] = friendlyDate($Reply ['ctime']);
            $Reply ['user'] = D('Api/User')->getUserSimpleInfo($Reply['uid']);
            $this->apiSuccess('返回成功', $Reply);
        }
    }

    // 返回某个帖子的评论列表
    public function getPostComments()
    {
        $aPage = I_POST('page', 'intval');

        $aId = I('get.id', '', 'intval');
        $map['status'] = 1;
        $aId && $map['post_id'] = $aId;
        $replyList = D('Forum/ForumPostReply')->getList(array('field' => 'id', 'page' => $aPage, 'where' => $map, 'order' => 'create_time asc'));
        $uid = D('Forum/ForumPost')->where(array('id' => $aId))->field('uid')->select();
        $uid = array_column($uid, 'uid');

        foreach ($replyList as &$v) {
            $v = D('Api/Forum')->getComment($v, $uid);
        }
        unset($v);
        $this->apiSuccess('返回成功', $replyList);
    }


    public function getCommentList()
    {
        $aPage = I('page', 1, 'intval');
        $aPostId = I('get.id', 'intval');
        $aId = I_POST('to_f_reply_id', 'intval');
        $map['status'] = 1;
        $aId && $map['to_f_reply_id'] = $aId;
        $uid = D('Forum/ForumPost')->where(array('id' => $aPostId))->field('uid')->select();
        $uid = array_column($uid, 'uid');

        $LzlPost = D('Forum/ForumLzlReply')->where(array('to_f_reply_id' => $aId, 'is_del' => 0))->page($aPage, 10)->select();

        foreach ($LzlPost as &$v) {

            $v['user'] = D('Api/User')->getUserSimpleInfo($v['uid']);
            if (in_array($v['uid'], $uid)) {
                $v['is_landlord'] = '1';
            } else {
                $v['is_landlord'] = '0';
            }
            $v['ctime'] = friendlyDate($v['ctime']);
        }
        unset($v);
        $this->apiSuccess('返回成功', $LzlPost);
    }

    /******************************************************************************华丽丽的分割线**私有*********************************************************************************************************/
    private function requireForumAllowPublish($forum_id)
    {
        $this->requireForumExists($forum_id);
        $this->requireIsLogin();
        $this->requireForumAllowCurrentUserGroup($forum_id);
    }

    private function requireForumExists($forum_id)
    {
        if (!$this->isForumExists($forum_id)) {
            $this->apiError('论坛不存在');
        }
    }

    private function isForumExists($forum_id)
    {
        $forum_id = intval($forum_id);
        $forum = D('Forum')->where(array('id' => $forum_id, 'status' => 1));
        return $forum ? true : false;
    }

    private function requireForumAllowCurrentUserGroup($forum_id)
    {
        $forum_id = intval($forum_id);
        if (!$this->isForumAllowCurrentUserGroup($forum_id)) {
            $this->apiError('您无权在该板块发布');
        }
    }

    private function isForumAllowCurrentUserGroup($forum_id)
    {

        $mid = $this->isLogin();
        $forum_id = intval($forum_id);
        //如果是超级管理员，直接允许
        if ($mid == 1) {
            return true;
        }
        //如果帖子不属于任何板块，则允许发帖
        if (intval($forum_id) == 0) {
            return true;
        }
        //读取论坛的基本信息
        $forum = D('Forum')->where(array('id' => $forum_id))->find();
        $userGroups = explode(',', $forum['allow_user_group']);

        //读取用户所在的用户组
        $list = M('AuthGroupAccess')->where(array('uid' => $mid))->select();
        foreach ($list as &$e) {
            $e = $e['group_id'];
        }


        //判断用户组是否有权限
        $list = array_intersect($list, $userGroups);
        return $list ? true : false;
    }

}