<?php
namespace Tutorial\Controller;
use Think\Controller;
class IndexController extends BaseController
{


    public function _initialize()
    {
        parent::_initialize();
        $myInfo = query_user(array('avatar128', 'avatar64', 'nickname', 'uid', 'space_url'), is_login());
        $this->assign('myInfo', $myInfo);
    }

    public function index()
    {
        if (is_login()) {
            redirect(U('my'));
        } else {
            redirect(U('discover'));
        }
    }


    public function tutorials()
    {
        $result=D("TutorialType")->getTutorialTypes();
        foreach ($result['parent'] as $key => &$value) {
           $value['list']=$this->getListByCate($value['id']);
        }
        $this->assignTutorialTypes();
        $this->setTitle(L('_GROUP_HOME_'));
        $this->assign('current', 'tutorials');
        $this->assign('result', $result['parent']);
        $this->display();
    }

    private function getListByCate($cate){
        $tutorial_list = M("Tutorial")->where(array('status' =>1 , 'type_id'=>$cate))->order('member_count desc')->select();
        return $tutorial_list;
    }
    
    private function tutorial_opt($aKeyword=""){

        $aPage = I('get.page', 1, 'intval');
        $r = 20;
        $aOrder = I('get.order', 'create_time', 'text');
        $aReverse = I('get.reverse', 'desc', 'text');
        $aCate = I('get.cate', 0, 'intval');
        $aUid = I('get.uid', 0, 'intval');
        if ($aOrder == 'activity') {
            $this->assign('order', L('_SORT_BY_ACTIVITY_'));
        } elseif ($aOrder == 'member') {
            //todo 根据成员数排序
            $Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
            $count = $Model->query("SELECT tutorial_id,count(tutorial_id) as count from opensns_tutorial_member tutorial by tutorial_id order by count desc");
            $ids = getSubByKey($count, 'tutorial_id');
            $ids = implode(',', $ids);
            $aOrder = "find_in_set( id ,'" . $ids . "') ";
            $this->assign('order', L('_SORT_BY_MEMBER_'));
        } else {
            $aOrder = 'create_time';
            $this->assign('order', L('_SORT_BY_TIME_'));
        }
        if (!empty($aCate)) {
            $gid = D('TutorialType')->where('pid=' . $aCate)->field('id')->select();
            $gids = getSubByKey($gid, 'id');
            $gids[] = $aCate;
            $param['where']['type_id'] = array('in', $gids);

            $this->assign('name', get_type_name($aCate));

            $this->assign('tutorial_cate', $aCate);
            $this->assign('keyword', array(0 => 'cate', 1 => $aCate));
            $this->setTitle('{$name}');
        }
        if (!empty($aKeyword)) {
            $param['where']['title'] = array('like', '%' . $aKeyword . '%');
            $this->assign('name', $aKeyword);
            $this->assign('keyword', array(0 => 'keywords', 1 => $aKeyword));
        }
        if ($aUid != 0) {
            $param['where']['uid'] = $aUid;
            $this->assign('name', get_nickname($aUid) . L('_OF_GROUP_'));
            $this->assign('keyword', array(0 => 'uid', 1 => $aUid));
        }
        $param['where']['status'] = 1;
        $param['page'] = $aPage;
        $param['count'] = $r;
        $param['order'] = $aOrder . ' ' . $aReverse;
        $param['field'] = 'id';
        $tutorial_list = D('Tutorial/Tutorial')->getList($param);

        //获取总数
        $totalCount = D('Tutorial/Tutorial')->where($param['where'])->count();
        $this->assign('totalCount', $totalCount);
        $this->assign('r', $r);
        $this->assign('tutorial_list', $tutorial_list);
        $this->assignTutorialTypes();

    }

    public function tutorial()
    {
        $aId = I('get.id', 0, 'intval');
        $aPage = I('get.page', 1, 'intval');
        $aOrder = I('get.order', '', 'text');
        $aType = I('get.type', 'post', 'text');
        $aTitle = I('post.title', '', 'text');
        $aCate = I('get.cate', 0, 'intval');
        $r = 20;

        $this->requireTutorialExists($aId);

        D('TutorialMember')->setLastView($aId);
        $this->assignNotice($aId);
        if (!empty($aOrder)) {
            $aType = 'post';
            if ($aOrder == 'ctime') {
                $this->assign('order', 0);
                $aOrder = 'create_time desc';
            } else if ($aOrder == 'reply') {
                $aOrder = 'last_reply_time desc';
                $this->assign('order', 1);
            }
        }
        // 按名称查询帖子
        if (!empty($aTitle)) {
            $aType = 'post';
            $map['title'] = array('like', "%{$aTitle}%");
            $this->assign('search_key', $aTitle);
        }
        //按分类查询帖子
        if (!empty($aCate)) {
            $aType = 'post';
            $map['cate_id'] = $aCate;
        }
        //读取置顶列表
        $list_top = D('TutorialPost')->getList(array('where' => 'status=1 AND is_top=1 and tutorial_id=' . $aId, 'order' => $aOrder));
        foreach ($list_top as &$v) {
            $v = D('TutorialPost')->getPost($v);
            $v['tutorial'] = D('Tutorial')->getTutorial($v['tutorial_id']);
        }
        unset($v);
        //帖子页面显示
        if ($aType == 'post') {
            $r = 10;
            //读取帖子列表
            $map['status'] = 1;
            $map['tutorial_id'] = $aId;
            empty($aOrder) && $aOrder = 'create_time desc';
            $list = D('TutorialPost')->getList(array('where' => $map, 'order' => $aOrder, 'page' => $aPage, 'count' => $r));
            $totalCount = D('TutorialPost')->where($map)->count();
        }
        if ($aType == 'new') {
            $map = array('tutorial_id' => $aId);
            $list = D('TutorialDynamic')->getList(array('where' => $map, 'order' => 'create_time desc', 'page' => $aPage, 'count' => $r));
            $totalCount = D('TutorialDynamic')->where($map)->count();
        }

        //member页面显示
        if ($aType == 'member') {
            $map = array('tutorial_id' => $aId, 'status' => 1);
            $list = D('TutorialMember')->where($map)->order('position desc , create_time asc')->page($aPage, 30)->cache(true, 60)->select();
            foreach ($list as &$user) {
                $user['user'] = query_user(array('avatar128', 'uid', 'nickname', 'fans', 'following', 'weibocount', 'space_url', 'title'), $user['uid']);
            }
            $totalCount = D('TutorialMember')->where($map)->count();
        }
        $this->assign('list', $list);
        $this->assign('totalCount', $totalCount);
        //显示页面
        $this->assign('tutorial_id', $aId);
        if ($aId != 0) {
            $this->assignTutorial($aId);
            $this->setTitle('{$tutorial.title}');

        } else {
            $this->setTitle(L('_MODULE_'));
            $this->assign('tutorial', array('title' => L('_GROUP_GROUP_')));
        }
        $this->assign('list_top', $list_top);
        $this->assignPostCategory($aId);
        $this->assign('r', $r);
        $this->assign('type', $aType);
        $this->display();
    }

    public function select()
    {

        $posts = D('TutorialPost')->where(array('is_top' => 1, 'status' => 1))->findPage();

        $supportModel = D('Common/Support');
        foreach ($posts['data'] as &$v) {

            $v['support_count'] = $supportModel->getSupportCount('Tutorial', 'post', $v['id']);
        }
        unset($v);
        $this->assign('posts', $posts);
        $tutorialModel = D('Tutorial');
        $tutorial_in_ids = D('TutorialMember')->getTutorialIds(array('where' => array('uid' => is_login(), 'status' => 1)));
        $tutorials = $tutorialModel->field('id')->order('rand()')->where(array('status' => 1))->limit(15)->select();
        foreach ($tutorials as &$v) {
            $v = $tutorialModel->getTutorial($v['id']);
            if(in_array($v['id'],$tutorial_in_ids))
                $v['flag']=true;
            else
                $v['flag']=false;
        }
        $this->assign('tutorials', $tutorials);


        $this->assign('current', 'select');
        $this->display();
    }

    public function discover()
    {
        $tutorialModel = D('Tutorial');
        $tutorial_ids = $tutorialModel->where(array('status' => 1))->field('id')->select();
        $tutorial_ids = getSubByKey($tutorial_ids, 'id');
        $posts = D('TutorialPost')->where(array('status' => 1, 'tutorial_id' => array('in', $tutorial_ids)))->order('create_time desc')->findPage(15);

        $supportModel = D('Common/Support');
        foreach ($posts['data'] as &$v) {
            $v['tutorial'] = $tutorialModel->getTutorial($v['tutorial_id']);
            $v['support_count'] = $supportModel->getSupportCount('Tutorial', 'post', $v['id']);
        }
        unset($v);
        $this->assign('posts', $posts);

        $tutorial_in_ids = D('TutorialMember')->getTutorialIds(array('where' => array('uid' => is_login(), 'status' => 1)));
        $tutorials = $tutorialModel->field('id')->order('rand()')->where(array('status' => 1))->limit(15)->select();

        foreach ($tutorials as &$v) {
            $v = $tutorialModel->getTutorial($v['id']);
            if(in_array($v['id'],$tutorial_in_ids))
                $v['flag']=true;
            else
                $v['flag']=false;

        }
        $this->assign('tutorials', $tutorials);


        $this->assign('current', 'discover');
        $this->display();
    }

    public function create()
    {
        if (IS_POST) {
            $aTutorialId = I('post.tutorial_id', 0, 'intval');
            $aTutorialType = I('post.tutorial_type', 0, 'intval');
            $aTitle = I('post.title', '', 'text');
            $aDetail = I('post.detail', '', 'text');
            $aLogo = I('post.logo', 0, 'intval');
            $aType = I('post.type', 0, 'intval');
            $aBackground = I('post.background', 0, 'intval');
            $aMemberAlias = I('post.member_alias', L('_MEMBER_'), 'text');



            if (empty($aTitle)) {
                $this->error(L('_ERROR_GROUP_NAME_'));
            }
            if (utf8_strlen($aTitle) > 20) {
                $this->error(L('_ERROR_TITLE_LENGTH_'));
            }
            if ($aTutorialType == -1) {
                $this->error(L('_ERROR_CATEGORY_'));
            }
            if (empty($aDetail)) {
                $this->error(L('_ERROR_INTRO_'));
            }
            $model = D('Tutorial');
            $isEdit = $aTutorialId ? true : false;
            if ($isEdit) {
                $this->requireLogin();
                $this->requireTutorialExists($aTutorialId);
                $this->checkActionLimit('edit_tutorial', 'Tutorial', $aTutorialId, is_login(), true);
                $this->checkAuth('Tutorial/Index/editTutorial', get_tutorial_admin($aTutorialId), L('_AUTHORITY_EDIT_NOT_'));
            } else {

                $this->requireLimit();

                $this->checkActionLimit('add_tutorial', 'Tutorial', 0, is_login(), true);
                $this->checkAuth('Tutorial/Index/addTutorial', -1, L('_AUTHORITY_ADD_NOT_'));
            }
            $need_verify = modC('GROUP_NEED_VERIFY', 0, 'GROUP');

            if ($isEdit) {
                $data = array('id' => $aTutorialId, 'type_id' => $aTutorialType, 'title' => $aTitle, 'detail' => $aDetail, 'logo' => $aLogo, 'type' => $aType, 'background' => $aBackground, 'member_alias' => $aMemberAlias);
                $data['status'] = $need_verify ? 0 : 1;
                $result = $model->editTutorial($data);
                $tutorial_id = $aTutorialId;
            } else {
                $data = array('type_id' => $aTutorialType, 'title' => $aTitle, 'detail' => $aDetail, 'logo' => $aLogo, 'type' => $aType, 'uid' => is_login(), 'background' => $aBackground, 'member_alias' => $aMemberAlias);
                $data['status'] = $need_verify ? 0 : 1;
                $result = $model->createTutorial($data);
                if (!$result) {
                    $this->error(L('_ERROR_CREATE_GROUP_') . $model->getError());
                }
                $tutorial_id = $result;
                //向TutorialMember表添加创建者成员
                D('TutorialMember')->addMember(array('uid' => is_login(), 'tutorial_id' => $tutorial_id, 'status' => 1, 'position' => 3));
            }
            if ($need_verify) {
                $message = L('_TIP_CREATE_GROUP_SUCCESS_');
                // 发送消息
                D('Message')->sendMessage(1,L('_CREATE_GROUP_AUDIT_'), get_nickname(is_login()) . L('_CREATED_GROUP_1_')."【{$aTitle}】".L('_CREATED_GROUP_2_'),  'admin/tutorial/unverify');
                $this->success($message, U('tutorial/index/index'));
            }

            // 发送微博
            if (D('Module')->checkInstalled('Weibo')) {
                $postUrl = "http://$_SERVER[HTTP_HOST]" . U('Tutorial/Index/tutorial', array('id' => $tutorial_id));
                if ($isEdit && check_is_in_config('edit_tutorial', modC('GROUP_SEND_WEIBO', 'add_tutorial,edit_tutorial', 'GROUP'))) {
                    D('Weibo/Weibo')->addWeibo(is_login(), L('_I_CHANGE_GROUP_')."【" . $aTitle . "】：" . $postUrl);
                }
                if (!$isEdit && check_is_in_config('add_tutorial', modC('GROUP_SEND_WEIBO', 'add_tutorial,edit_tutorial', 'GROUP'))) {
                    D('Weibo/Weibo')->addWeibo(is_login(), L('_I_CREATE_GROUP_')."【" . $aTitle . "】：" . $postUrl);
                }

            }

            //显示成功消息
            $message = $isEdit ? L('_EDIT_SUCCESS_') : L('_PUBLISH_SUCCESS_');
            $url = $isEdit ? 'refresh' : U('tutorial/index/tutorial', array('id' => $tutorial_id));
            $this->success($message, $url);
        } else {

            $this->requireLimit();

            $this->requireLogin();
            $this->assignTutorialAllType();
            $this->setTitle(L('_CREATE_GROUP_'));
            $this->display();
        }
    }

    private function requireLimit(){
        $model = D('Tutorial');
        $limit = modC('GROUP_LIMIT', 5, 'GROUP');
        $count = $model->getUserTutorialCount(is_login());
        if($count >= $limit){
            $this->error(L('_GROUP__NUMBER_TOP_').$limit);
        }
    }
    public function my()
    {

        $aPage = I('get.page', 1, 'intval');
        $r = 20;
        $this->requireLogin();
        $tutorialModel = D('Tutorial');
        $tutorial_ids = D('TutorialMember')->getTutorialIds(array('where' => array('uid' => is_login(), 'status' => 1)));
        $myattend = $tutorialModel->getList(array('where' => array('id' => array('in', $tutorial_ids), 'status' => 1), 'page' => $aPage, 'count' => $r, 'order' => 'uid = ' . is_login() . ' desc ,uid asc'));
        foreach ($myattend as &$v) {
            $v = $tutorialModel->getTutorial($v);
        }
        unset($v);
        $posts = D('TutorialPost')->where(array('tutorial_id' => array('in', $tutorial_ids), 'status' => 1))->order('create_time desc')->findPage(10);

        $supportModel = D('Common/Support');
        foreach ($posts['data'] as &$v) {
            $v['tutorial'] = $tutorialModel->getTutorial($v['tutorial_id']);
            $v['support_count'] = $supportModel->getSupportCount('Tutorial', 'post', $v['id']);
        }

        $this->assign('posts', $posts);


        $this->assign('r', $r);
        $this->assign('tutorials', $myattend);
        $this->assign('current', 'my');
        $this->setTitle(L('_MY_').L('_MODULE_'));
        $this->display();
    }

    public function mytutorial()
    {
        $aPage = I('get.page', 1, 'intval');
        $r = 20;
        $this->requireLogin();
        $tutorial_ids = D('TutorialMember')->getTutorialIds(array('where' => array('uid' => is_login(), 'status' => 1)));
        $myattend = D('Tutorial')->getList(array('where' => array('id' => array('in', $tutorial_ids), 'status' => 1), 'page' => $aPage, 'count' => $r, 'order' => 'uid = ' . is_login() . ' desc ,uid asc'));


        $totalCount = D('Tutorial')->where(array('id' => array('in', $tutorial_ids), 'status' => 1))->count();
        $this->assign('totalCount', $totalCount);
        $this->assign('r', $r);
        $this->assign('mytutorial', $myattend);
        $this->assign('current', 'my');
        $this->setTitle(L('_MY_').L('_MODULE_'));
        $this->display();
    }


    public function detail()
    {
        $aId = I('get.id', 0, 'intval');
        $aPage = I('get.page', 1, 'intval');
        $r = 10;
        $post = D('TutorialPost')->getPost($aId);

        $post['tutorial'] = D('Tutorial')->getTutorial($post['tutorial_id']);
        $post['content'] = D('ContentHandler')->displayHtmlContent($post['content']);
        $post['content'] = limit_picture_count($post['content']);

        $this->assignNotice($post['tutorial_id']);
        //检测群组、帖子是否存在
        if (!$post || !tutorial_is_exist($post['tutorial_id'])) {
            $this->error(L('_POST_NOT_FOUND_'));
        }
        //增加浏览次数
        D('TutorialPost')->where(array('id' => $aId))->setInc('view_count');
        //读取回复列表
        $map = array('post_id' => $aId, 'status' => 1);
        $replyList = D('TutorialPostReply')->getList(array('where' => $map, 'order' => 'create_time asc', 'page' => $aPage, 'count' => $r));
        $replyTotalCount = D('TutorialPostReply')->where($map)->count();
        //显示页面
        $this->assign('tutorial_id', $post['tutorial_id']);
        $this->assign('post', $post);
        $this->setTitle('{$post.title|op_t} '.L('_POST_BAR_'));
        $this->assign('page', $aPage);
        $this->assign('r', $r);
        $this->assign('replyList', $replyList);
        $this->assign('replyTotalCount', $replyTotalCount);
        $this->assignTutorial($post['tutorial_id']);
        $this->display();
    }


    public function edit()
    {

        $aTutorialId = I('get.tutorial_id', 0, 'intval');
        $aPostId = I('get.post_id', 0, 'intval');
        //判断是不是为编辑模式
        $isEdit = $aPostId ? true : false;
        //如果是编辑模式的话，读取帖子，并判断是否有权限编辑


        if ($isEdit) {
            $this->requireLogin();
            $this->requirePostExists($aPostId);
            $this->checkAuth('Tutorial/Index/edit', get_post_admin($aPostId), L('_YOU_EDIT_LIMIT_'));
            $post = D('TutorialPost')->getPost($aPostId);
        } else {
            if (is_joined($aTutorialId) != 1) {
                $this->error(L('_YOU_POST_LIMIT_'));
            }
            $this->checkAuth('Tutorial/Index/addPost', -1, L('_YOU_ADD_LIMIT_'));
            $post = array('tutorial_id' => $aTutorialId);
        }
        //获取群组id
        $aTutorialId = $aTutorialId ? intval($aTutorialId) : $post['tutorial_id'];
        $this->assignPostCategory($aTutorialId);
        $this->assignTutorial($aTutorialId);
        $this->assign('tutorial_id', $aTutorialId);
        $this->setTitle('{$title}');
        $this->assign('title', $isEdit ? L('_EDIT_POST_') : L('_PUBLISH_POST_'));
        $this->assign('post', $post);
        $this->assign('isEdit', $isEdit);
        $this->display();
    }


    public function doEdit()
    {
        $aPostId = I('post.post_id', 0, 'intval');
        $aTutorialId = I('post.tutorial_id', 0, 'intval');
        $aTitle = I('post.title', '', 'text');


        $aContent = I('post.content', '', 'filter_content');
        $aCategory = I('post.category', 0, 'intval');

        if (is_joined($aTutorialId) != 1) {
            $this->error(L('_YOU_EDIT_LIMIT_'));
        }

        //判断是不是编辑模式
        $isEdit = $aPostId ? true : false;
        //如果是编辑模式，确认当前用户能编辑帖子
        $this->requireLogin();
        $this->requireTutorialExists($aTutorialId);

        if ($isEdit) {
            $this->requirePostExists($aPostId);
            $this->checkActionLimit('edit_tutorial_post', 'TutorialPost', $aPostId, is_login(), true);
            $this->checkAuth('Tutorial/Index/edit', get_post_admin($aPostId), L('_YOU_EDIT_LIMIT_'));

        } else {
            $this->checkActionLimit('add_tutorial_post', 'TutorialPost', 0, is_login(), true);
            $this->checkAuth('Tutorial/Index/addPost', -1,L('_YOU_ADD_LIMIT_'));
        }


        if (empty($aTutorialId)) {
            $this->error(L('_PLEASE_TITLE_'));
        }
        if (empty($aTitle)) {
            $this->error(L('_PLEASE_TITLE_'));
        }
        if (empty($aContent)) {
            $this->error(L('_PLEASE_CONTENT_'));
        }


        $model = D('TutorialPost');
        $cover = get_pic($aContent);
        $cover = $cover == null ? '' : $cover;
        $len = modC('SUMMARY_LENGTH', 50);
        if ($isEdit) {
            $data = array('id' => $aPostId, 'title' => $aTitle, 'summary' => mb_substr(text($aContent), 0, $len, 'utf-8'), 'cover' => $cover, 'content' => $aContent, 'parse' => 0, 'tutorial_id' => $aTutorialId, 'cate_id' => $aCategory);
            $result = $model->editPost($data);
            //添加到最新动态
            $dynamic['tutorial_id'] = $aTutorialId;
            $dynamic['uid'] = is_login();
            $dynamic['type'] = 'update_post';
            $dynamic['row_id'] = $aPostId;
            D('TutorialDynamic')->addDynamic($dynamic);
            if (!$result) {
                $this->error(L('_EDIT_FAIL_') . $model->getError());
            }
        } else {
            $data = array('uid' => is_login(), 'title' => $aTitle, 'summary' => mb_substr(text($aContent), 0, $len, 'utf-8'), 'cover' => $cover, 'content' => $aContent, 'parse' => 0, 'tutorial_id' => $aTutorialId, 'cate_id' => $aCategory);
            $result = $model->createPost($data);
            if (!$result) {
                $this->error(L('_PUBLISH_FAIL_'));
            }
            $aPostId = $result;
            //添加到最新动态
            $dynamic['tutorial_id'] = $aTutorialId;
            $dynamic['uid'] = is_login();
            $dynamic['type'] = 'post';
            $dynamic['row_id'] = $aPostId;
            D('TutorialDynamic')->addDynamic($dynamic);
            //增加活跃度
            D('Tutorial')->where(array('id' => $aTutorialId))->setInc('activity');
            D('TutorialMember')->where(array('tutorial_id' => $aTutorialId, 'uid' => is_login()))->setInc('activity');
        }

        //实现发布帖子发布图片微博(公共内容)
        $tutorial = D('Tutorial')->getTutorial($aTutorialId);
        $this->sendWeibo($aPostId, $isEdit, $tutorial);
        //显示成功消息
        $message = $isEdit ? L('_EDIT_SUCCESS_') : L('_PUBLISH_SUCCESS_') . cookie('score_tip');
        $this->success($message, U('Tutorial/Index/detail', array('id' => $aPostId)));
    }


    protected function sendWeibo($aPostId, $isEdit, $tutorial)
    {
        if (D('Module')->checkInstalled('Weibo')) {
            $postUrl =  U('Tutorial/Index/detail', array('id' => $aPostId),false,true);

            $post = D('TutorialPost')->getPost($aPostId);

            $type = 'feed';
            $feed_data = array();
            //解析并成立图片数据
            $arr = array();
            preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/", $post['content'], $arr); //匹配所有的图片
            if (!empty($arr[0])) {
                $feed_data['attach_ids'] = array();
                $dm = __ROOT__; //前缀图片多余截取

                $max = count($arr[1]) > 9 ? 9 : count($arr[1]);
                for ($i = 0; $i < $max; $i++) {
                    $tmparray = strpos($arr[1][$i], $dm);
                    $is_local = !is_bool($tmparray);
                    if ($is_local) {
                        $path = cut_str($dm, $arr[1][$i], 'l');
                        $result_id = D('Home/Picture')->where(array('path' => $path))->getField('id');
                    } else {
                        $path = $arr[1][$i];
                        $result_id = D('Home/Picture')->where(array('path' => $path))->getField('id');
                    }

                    if (!$result_id) {
                        $dr = '';
                        if (is_bool(strpos($path, 'http://'))) {
                            $dr = 'local';
                        }
                        $result_id = D('Home/Picture')->add(array('type' => $dr, 'path' => $path, 'url' => $path, 'status' => 1, 'create_time' => time()));
                    }

                    $feed_data['attach_ids'][] = $result_id;
                }
                $feed_data['attach_ids'] = implode(',', $feed_data['attach_ids']);
            }

            $feed_data['attach_ids'] != false && $type = "image";
            if (D('Common/Module')->isInstalled('Weibo')) { //安装了微博模块
                if ($isEdit && check_is_in_config('edit_tutorial_post', modC('GROUP_POST_SEND_WEIBO', 'add_tutorial_post,edit_tutorial_post', 'GROUP'))) {
                    D('Weibo/Weibo')->addWeibo(is_login(), L('_AT_GROUP_')."【{$tutorial['title']}】".L('_UPDATE_A_POST_')."【" . $post['title'] . "】：" . $postUrl, $type, $feed_data);
                }
                if (!$isEdit && check_is_in_config('add_tutorial_post', modC('GROUP_POST_SEND_WEIBO', 'add_tutorial_post,edit_tutorial_post', 'GROUP'))) {
                    D('Weibo/Weibo')->addWeibo(is_login(), L('_AT_GROUP_')."【{$tutorial['title']}】".L('_PUBLISH_A_POST_')."【" . $post['title'] . "】：" . $postUrl, $type, $feed_data);
                }
            }
        }
    }

    public function doBookmark()
    {

        $aPostId = I('get.post_id', 0, 'intval');
        $aFlag = I('get.flag', 0, 'intval');
        //确认用户已经登录
        $this->requireLogin();

        $this->requirePostExists($aPostId);
        $this->checkAuth(null, -1, L('_AUTHORITY_COLLECT_'));


        //写入数据库
        if ($aFlag) {
            $result = D('TutorialBookmark')->addBookmark(is_login(), $aPostId);
            if (!$result) {
                $this->error(L('_COLLECT_FAIL_'));
            }
        } else {
            $result = D('TutorialBookmark')->removeBookmark(is_login(), $aPostId);
            if (!$result) {
                $this->error(L('_CANCEL_FAIL_'));
            }
        }
        //返回成功消息
        if ($aFlag) {
            $this->success(L('_COLLECT_SUCCESS_'));
        } else {
            $this->success(L('_CANCEL_SUCCESS_'));
        }
    }

    public function recommend()
    {
        $aPostId = I('get.post_id', 0, 'intval');
        $aTop = I('get.top', 1, 'intval');
        $aTop && $aTop = 1;

        $tutorial_id = $this->getTutorialIdByPost($aPostId);
        $this->requirePostExists($aPostId);
        $this->checkAuth(null, get_tutorial_admin($tutorial_id), L('_AUTHORITY_SET_TOP_'));

        $res = D('TutorialPost')->where(array('id' => $aPostId, 'status' => 1))->setField('is_top', $aTop);

        if ($res) {
            S('tutorial_post_' . $aPostId, null);
            $this->success(L('_OPERATE_SUCCESS_'));
        } else {
            $this->error(L('_OPERATE_FAIL_'));
        }
    }


    public function delPostReply()
    {
        $ReplyId = I('post.reply_id', 0, 'intval');
        $this->requireLogin();
        $this->checkAuth(null, get_reply_admin($ReplyId), L('_AUTHORITY_DELETE_'));

        $res = D('TutorialPostReply')->delPostReply($ReplyId);
        if ($res) {
            $this->success(L('_OPERATE_SUCCESS_'));
        } else {
            $this->error(L('_OPERATE_FAIL_'));
        }

    }


    public function doSendLzlReply()
    {
        $aToFReplyId = I('post.to_f_reply_id', 0, 'intval');
        $aToReplyId = I('post.to_reply_id', 0, 'intval');
        $aContent = I('post.content', '', 'text');
        $model = D('TutorialLzlReply');
        $reply = D('TutorialPostReply')->getReply($aToFReplyId);
        $lzl = $model->getLzlReply($aToReplyId);
        //确认用户已经登录
        $this->requireLogin();
        $this->checkActionLimit('add_tutorial_lzl_reply', 'TutorialLzlReply', 0, is_login(), true);
        $this->checkAuth(null, -1);


        if (empty($aContent)) {
            $this->error(L('_CONTENT_EMPTY_'));
        }


        //写入数据库
        $data['post_id'] = $reply['post_id'];
        $data['to_f_reply_id'] = $aToFReplyId;
        $data['to_reply_id'] = $aToReplyId;
        $data['content'] = $aContent;
        $data['uid'] = is_login();
        $data['to_uid'] = $lzl['uid'] ? $lzl['uid'] : $reply['uid'];
        $result = $model->addLzlReply($data);
        M('TutorialPost')->where(array('id' => $data['post_id']))->setInc('reply_count');
        //增加活跃度
        $tutorial_id = $this->getTutorialIdByPost($reply['post_id']);
        D('Tutorial')->where(array('id' => $tutorial_id))->setInc('activity');
        D('TutorialMember')->where(array('tutorial_id' => $tutorial_id, 'uid' => is_login()))->setInc('activity');

        if (!$result) {
            $this->error(L('_RELEASE_FAIL_') . $model->getError());
        }

        //发送评论
        $res['data'] = $result;
        $res['html'] = R('Detail/lzlReplyHtml', array('lzl_id' => $res['data']), 'Widget');
        $res['status'] = 1;
        $res['info'] = L('_REPLY_SUCCESS_') . cookie('score_tip');
        $this->ajaxReturn($res);
    }

    public function lzlList()
    {
        $aToFReplyId = I('post.reply_id', 0, 'intval');
        $aPage = I('post.page', 1, 'intval');
        $r = modC('GROUP_LZL_SHOW_COUNT', 5, 'GROUP');

        $order = modC('GROUP_LZL_REPLY_ORDER', 0, 'GROUP') == 1 ? 'create_time asc' : 'create_time desc';

        $lzlModel = D('TutorialLzlReply');
        $map['to_f_reply_id'] = $aToFReplyId;
        $map['status'] = 1;
        $list = $lzlModel->getList(array('where' => $map, 'order' => $order, 'page' => $aPage, 'count' => $r));

        $totalCount = $lzlModel->where($map)->count();
        $this->assign('lzl_list', $list);

        $data['to_f_reply_id'] = $aToFReplyId;
        $pageCount = ceil($totalCount / $r);
        $html = getPageHtml('tutorial_lzl_page', $pageCount, $data, $aPage);
        $this->assign('html', $html);

        $resutl = $this->fetch('lzllist');
        $this->ajaxReturn($resutl);
    }


    public function loadLzl()
    {
        $aReplyId = I('post.reply_id', 0, 'intval');
        $html = R('LzlReply/lzlHtml', array('reply_id' => $aReplyId), 'Widget');
        $this->ajaxReturn($html);
    }


    public function delLzlReply()
    {

        $aId = I('post.id', 0, 'intval');
        $this->requireLogin();

        $this->checkAuth(null, get_lzl_admin($aId));

        $res = D('TutorialLzlReply')->delLzlReply($aId);

        if ($res) {
            $this->success(L('_DELETE_SUCCESS_'));
        } else {
            $this->error(L('_DELETE_FAIL_'));
        }
    }


    // todo 帖子列表，用于搜索等
    public function posts()
    {
        $aPostCate = I('get.post_cate', 0, 'intval');
        if (!empty($aPostCate)) {
            $where['cate_id'] = $aPostCate;
            $this->assign('name', get_post_category($aPostCate));
            $this->assign('postCate', $aPostCate);
        }
        $where['status'] = 1;
        $post_list = D('Tutorial/TutorialPost')->getList(array('where' => $where));
        $this->assign('list', $post_list);
        $this->assignPostCategory();
        $this->display();
    }


    public function editReply()
    {
        $aReplyId = I('reply_id', 0, 'intval');
        $this->requireLogin();

        $this->checkAuth(null, get_reply_admin($aReplyId));
        if (IS_POST) {
            $this->checkActionLimit('edit_tutorial_reply', 'TutorialPostReply', $aReplyId, is_login(), true);
            $aContent = I('post.content', '', 'filter_content');
            $groipReplyModel = D('TutorialPostReply');
            $post = $groipReplyModel->getReply($aReplyId);

            $data['id'] = $aReplyId;
            $data['content'] = $aContent;
            $data['update_time'] = time();


            $res = $groipReplyModel->editReply($data);
            if ($res) {

                $this->success(L('_EDIT_REPLY_SUCCESS_'), U('Tutorial/Index/detail', array('id' => $post['post_id'])));
            } else {
                $this->error(L("_EDIT_REPLY_FAIL_"));
            }
        } else {
            if ($aReplyId) {
                $reply = D('TutorialPostReply')->getReply($aReplyId);
            } else {
                $this->error(L('_ERROR_PARAM_'));
            }
            $this->setTitle(L('_TITLE_EDIT_REPLY_'));
            //显示页面
            $this->assign('reply', $reply);
            $this->display();
        }

    }


    public function doReply()
    {
        $aPostId = I('get.post_id', 0, 'intval');
        $aContent = I('post.content', '', 'filter_content');

        // 获取群组ID
        $tutorial_id = $this->getTutorialIdByPost($aPostId);
        $this->requireLogin();
        $this->checkActionLimit('add_tutorial_reply', 'TutorialPostReply', 0, is_login(), true);
        $this->checkAuth();

        //添加到数据库
        $model = D('TutorialPostReply');
        $data['post_id'] = $aPostId;
        $data['content'] = $aContent;
        $data['uid'] = is_login();
        $result = $model->addReply($data);

        //添加到最新动态
        $dynamic['tutorial_id'] = $tutorial_id;
        $dynamic['uid'] = is_login();
        $dynamic['type'] = 'reply';
        $dynamic['row_id'] = $result;
        D('TutorialDynamic')->addDynamic($dynamic);
        //增加活跃度

        M('Tutorial')->where(array('id' => $tutorial_id))->setInc('activity');
        M('TutorialPost')->where(array('id' => $data['post_id']))->setInc('reply_count');
        M('TutorialMember')->where(array('tutorial_id' => $tutorial_id, 'uid' => is_login()))->setInc('activity');
        if (!$result) {
            $this->error(L('_REPLY_FAIL_') . $model->getError());
        }
        //显示成功消息
        $this->success(L('_REPLY_SUCCESS_') . cookie('score_tip'), 'refresh');

    }


    public function attend()
    {
        $aTutorialId = I('tutorial_id', 0, 'intval');
        $this->requireTutorialExists($aTutorialId);
        $this->requireLogin();
        $this->checkAuth();

        //判断是否已经加入
        if (is_joined($aTutorialId) == 1) {
            $this->error(L('_HAS_IN_THIS_GROUP_'));
        }
        // 已经加入但还未审核
        if (is_joined($aTutorialId) == 2) {
            $this->error('please_wait_for_audit');
        }
        $uid = is_login();
        $tutorial = D('Tutorial')->getTutorial($aTutorialId);

        //要存入数据库的数据
        $data['tutorial_id'] = $aTutorialId;
        $data['uid'] = $uid;
        $data['position'] = 1;
        $info = '';
        if ($tutorial['type'] == 1) {
            // 群组为私有的。
            $data['status'] = 0;
            $res = D('TutorialMember')->addMember($data);
            $info = L('_WAIT_ADMIN_AUDIT_');
            // 发送消息
            D('Message')->sendMessage($tutorial['uid'], L('_JOIN_GROUP_AUDIT_'),get_nickname($uid) . L('_ASK_FOR_GROUP_')."【{$tutorial['title']}】", 'tutorial/Manage/member', array('tutorial_id' => $aTutorialId, 'status' => 0), $uid);
        } else {
            // 群组为公共的
            $data['status'] = 1;
            $res = D('TutorialMember')->addMember($data);
            //添加到最新动态
            $dynamic['tutorial_id'] = $aTutorialId;
            $dynamic['uid'] = $uid;
            $dynamic['type'] = 'attend';
            D('TutorialDynamic')->addDynamic($dynamic);
        }
        if ($res) {
            D('Tutorial')->where(array('id'=>$aTutorialId))->setInc('member_count');
            S('tutorial_is_join_' . $aTutorialId . '_' . $uid, null);
            S('tutorial_member_count_' . $tutorial['id'], null);
            $this->success(L('_SUCCESS_JOIN_') . $info, 'refresh');
        } else {
            $this->error(L('_FAIL_JOIN_'));
        }

    }


    public function quit()
    {
        $aTutorialId = I('tutorial_id', 0, 'intval');
        $this->requireLogin();
        $this->requireTutorialExists($aTutorialId);
        $this->checkAuth();
        $uid = is_login();

        // 判断是否是创建者，创建者无法退出
        $tutorial = D('Tutorial')->getTutorial($aTutorialId);
        if ($tutorial['uid'] == $uid) {
            $this->error(L('_CREATOR_CANNOT_QUIT_'));
        }
        // 判断是否在该群组内
        if (is_joined($aTutorialId) == 0) {
            $this->error(L('_NOT_IN_GROUP_'));
        }

        $res = D('TutorialMember')->delMember(array('tutorial_id' => $aTutorialId, 'uid' => $uid));
        if ($res) {
            //添加到最新动态
            $dynamic['tutorial_id'] = $aTutorialId;
            $dynamic['uid'] = $uid;
            $dynamic['type'] = 'quit';
            D('TutorialDynamic')->addDynamic($dynamic);

            D('Tutorial')->where(array('id'=>$aTutorialId))->setDec('member_count');

            S('tutorial_is_join_' . $aTutorialId . '_' . $uid, null);
            S('tutorial_member_count_' . $tutorial['id'], null);
            $this->success(L('_SUCCESS_QUIT_'), 'refresh');
        } else {
            $this->error(L('_FAIL_QUIT_'));
        }
    }

    public function tutorialInvite()
    {
        $aTutorialId = I('tutorial_id', 0, 'intval');
        $this->checkAuth();
        if (IS_POST) {

            $uids = I('post.uids');
            $tutorial = D('Tutorial')->getTutorial($aTutorialId);
            foreach ($uids as $uid) {
                D('Message')->sendMessage($uid, '', get_nickname(is_login()) . L('_INVITE_TO_GROUP_')."【{$tutorial['title']}】  <a class='ajax-post' href='" . U('tutorial/index/attend', array('tutorial_id' => $aTutorialId)) . "'>".L('_INVITE_TO_GROUP_')."</a>",  'tutorial/index/tutorial', array('id' => $aTutorialId), is_login());
            }

            $result = array('status' => 1, 'info' => L('_SUCCESS_INVITE_'));
            $this->ajaxReturn($result);
        } else {
            $friendList = D('Follow')->getAllFriends(is_login());
            $friendIds = getSubByKey($friendList, 'follow_who');
            $friends = array();
            foreach ($friendIds as $v) {
                $friends[$v] = query_user(array('avatar128', 'avatar64', 'nickname', 'uid', 'space_url'), $v);
            }
            $this->assign('friends', $friends);
            $this->assign('tutorial_id', $aTutorialId);
            $this->display();
        }
    }

    ////////////////////////////---------------------------------------华丽的分割线-----------------------------------/////////////////////////////


    public function search($page = 1, $uid = 0)
    {
        $_REQUEST['keywords'] = op_t($_REQUEST['keywords']);
        $_GET['keywords'] = $_REQUEST['keywords'];
        $type = op_t($_REQUEST['type']);
        $this->assign('choice',$type==""?'post':$type);

        if( $type== 'post' || $type==""){

        if ($uid != 0) {
            $where['uid'] = $uid;
            $this->assign('tip', $uid);
        } else {
            //读取帖子列表
            $map['title'] = array('like', "%{$_REQUEST['keywords']}%");
            $map['content'] = array('like', "%{$_REQUEST['keywords']}%");
            $map['_logic'] = 'OR';
            $where['_complex'] = $map;
            $where['status'] = 1;
        }
        $list = D('TutorialPost')->where($where)->order('last_reply_time desc')->page($page, 10)->select();
        $totalCount = D('TutorialPost')->where($where)->count();
        foreach ($list as &$post) {
            $post['colored_title'] = str_replace('"', '', str_replace($_REQUEST['keywords'], '<span style="color:red">' . $_REQUEST['keywords'] . '</span>', op_t(strip_tags($post['title']))));
            $post['colored_content'] = str_replace('"', '', str_replace($_REQUEST['keywords'], '<span style="color:red">' . $_REQUEST['keywords'] . '</span>', op_t(strip_tags($post['content']))));
            $post['tutorial'] =D('Tutorial/Tutorial')->getTutorial($post['tutorial_id']);

        }
        unset($post);
            //显示页面
            $this->assign('list', $list);
            $this->assign('totalCount', $totalCount);
            $this->display();
        }
        else{

            $this->tutorial_opt($_GET['keywords']);
            $this->setTitle(L('_GROUP_HOME_'));
            $this->assign('current', '');
            $this->display('tutorials');
        }
    }


    public function deletePost()
    {
        $aPostId=I('id',0,'intval');
        $postModel=D('TutorialPost');
        $map=array('id'=>$aPostId,'status'=>1);
        $post=$postModel->where($map)->find();
        if(!$post){
            $this->ajaxReturn(array('status'=>0,'info'=>L('_POST_NOT_EXIST_'),'url'=>U('Tutorial/Index/tutorials')));
        }
        $this->checkAuth('Tutorial/Index/deletePost',get_admin_ids($aPostId,3,0),L('_AUTHORITY_DELETE_LIMIT_'));
        $res=$postModel->where($map)->setField('status',-1);
        if($res){
            S('tutorial_post_'.$aPostId,null); //删除缓存
            $this->ajaxReturn(array('status'=>1,'info'=>L('_DELETE_SUCCESS_'),'url'=>U('Tutorial/Index/tutorial',array('id'=>$post['tutorial_id']))));
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>L('_DELETE_FAIL_').$postModel->getError()));
        }
    }


}