<?php


namespace Api\Controller;


class NewsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getCategory()
    {
        $aPage = I_POST('page', 'intval');
        $aId = I_POST('id', 'intval');
        if ($aId) {
            $category = D('News/NewsCategory')->where(array('status' => 1, 'pid' => $aId))->page($aPage)->select();
        } else {
            $category = D('News/NewsCategory')->where(array('status' => 1, 'pid' => 0))->page($aPage)->select();

            foreach ($category as &$g) {
                $g['NewsSecond'] = D('News/NewsCategory')->where(array('status' => 1, 'pid' => $g['id']))->select();

                $g['create_time'] = friendlyDate($g['create_time']);
            }
            unset($g);
        }
        $this->apiSuccess('返回成功', $category);
    }


    //所有的资讯列表
    public function getNewsAll()
    {
        $aPage = I_POST('page', 'intval');


        if (empty($aPage)) {
            $aPage = 1;
        }
        $aCate = I_POST('id', 'intval');

        $map['dead_line'] = array('gt', time());
        $map['status'] = 1;
        $NewsModel = D('Api/News');
        $order_field = modC('NEWS_ORDER_FIELD', 'create_time', 'News');
        $order_type = modC('NEWS_ORDER_TYPE', 'desc', 'News');
        $order = 'sort desc,' . $order_field . ' ' . $order_type;
        if (empty($aCate)) {
            $News = $NewsModel->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => $map));
            if(!$News){
                $this->apiError('当前无可查看资讯');
            }

        } else {
            $first = D('News/NewsCategory')->where(array('id' => $aCate, 'status' => 1))->find();

            if ($first['pid'] == 0) {
                $second = D('News/NewsCategory')->where(array('pid' => $first['id'], 'status' => 1))->field('id')->select();
                $ids = array();
                foreach ($second as &$s) {
                    $ids = array_merge($ids, array_column($s, 'id'));
                }
                $map2 = array_merge($ids, array($first['id']));
                $map2['category'] = array('in', $map2);
                $map2['dead_line'] = array('gt', time());
                $map2['status'] = 1;
                $News = $NewsModel->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => $map2));
            } else {
                $map3['category'] = $first['id'];
                $map3['dead_line'] = array('gt', time());
                $map3['status'] = 1;
                $News = $NewsModel->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => $map3));
            }
        }
        foreach ($News as &$v) {
            $v = $NewsModel->getDetail($v);
        }
        unset($v);
        $this->apiSuccess('返回成功', $News);
    }

    //个人的资讯列表
    public function getMyNewsAll()
    {
        $aUid = I_POST('uid', 'intval');
        if(!$aUid){
            $mid = $this->isLogin();
            $aUid = $mid;
      }

        $aStatus = I_POST('status', 'intval');
        $aOverdue = I_POST('overdue', 'intval');
        $aPage = I_POST('page', 'intval');
        $aCount = 10;
        if (empty($aPage)) {
            $aPage = 1;
        }
        if ($aOverdue == 1) {
            $map2['dead_line'] = array('egt', time());
        } else {
            $map2['dead_line'] = array('elt', time());
        }

        $map1['status'] = $aStatus;
        if (empty($aStatus)) {
            if (empty($aOverdue)) {
                $News = D('News/News')->where(array('uid' => $aUid))->page($aPage,$aCount)->order('create_time desc')->select();
            } else {
                $News = D('News/News')->where(array('uid' => $aUid, $map2))->page($aPage,$aCount)->order('create_time desc')->select();
            }
        } else {
            if (empty($aOverdue)) {
                $News = D('News/News')->where(array('uid' => $aUid, $map1))->page($aPage,$aCount)->order('create_time desc')->select();
            } else {
                $News = D('News/News')->where(array('uid' => $aUid, $map1, $map2))->page($aPage,$aCount)->order('create_time desc')->select();
            }
        }
        foreach ($News as &$c) {
            if ($c['cover'] == 0) {

                $c['cover_url']='';
            }else{
                $c['cover_url']['ori']= render_picture_path_without_root(get_cover($c['cover'], 'path'));
                $c['cover_url']['thumb']= render_picture_path_without_root(getThumbImageById($c['cover'], 100, 100));
            }
            if ($c['dead_line'] <= time()) {
                $c['approval'] = '已过期';
            } else {
                $c['approval'] = '未过期';
            }
            $c['dead_line'] = time_format($c['dead_line']);
            $c['create_time'] = friendlyDate($c['create_time']);
            $c['update_time'] = friendlyDate($c['update_time']);
            $c['user']= D('Api/User')->getUserReduceInfo($c['uid']);
        }
        unset($c);


        $this->apiSuccess('返回成功', $News);
    }

    //推荐的资讯列表
    public function getRecommendNews(){
        $pos= I_POST('position', 'intval');
        $limit = 5;
        $category = null;
        $field='id';
        $map = $this->listMap($category, 1, $pos);
        $order='sort desc,view desc';
        $NewsModel = D('Api/News');

        $News = $NewsModel->field($field)->where($map)->order($order)->limit($limit)->select();

        foreach ($News as &$c) {
            $c = $NewsModel->getDetail($c['id']);
        }
        unset($c);
        /* 读取数据 */
        if(!$News){
            $this->apiError('无推荐资讯');
        }
        $this->apiSuccess('返回成功', $News);
    }

    /**
     * 设置where查询条件
     * @param  number  $category 分类ID
     * @param  number  $pos      推荐位
     * @param  integer $status   状态
     * @return array             查询条件
     */
    private function listMap($category, $status = 1, $pos = null){
        /* 设置状态 */
        $map = array('status' => $status);

        /* 设置分类 */
        if(!is_null($category)){
            $cates=D('News/NewsCategory')->getCategoryList(array('pid'=>$category,'status'=>1));
            $cates=array_column($cates,'id');
            $map['category']=array('in',array_merge(array($category),$cates));
        }
        $map['dead_line'] = array('gt',time());

        /* 设置推荐位 */
        if(is_numeric($pos)){
            $map[] = "position & {$pos} = {$pos}";
        }
        return $map;
    }
    /*热门资讯*/
    public function getHotNewsAll()
    {

        $aCate = I('get.id', 0, 'intval');
        if (empty($aCate)) {
            $News = D('News/News')->where(array('status' => 1))->limit(10)->order('view desc')->select();
        } else {
            $first = D('News/NewsCategory')->where(array('id' => $aCate, 'status' => 1))->find();
            if ($first['pid'] == 0) {
                $second = D('News/NewsCategory')->where(array('pid' => $first['id'], 'status' => 1))->field('id')->select();
                $ids = array();
                foreach ($second as &$s) {
                    $ids = array_merge($ids, array_column($s, 'id'));
                }
                $map = array_merge($ids, array($first['id']));
                $map['category'] = array('in', $map);
                $News = D('News/News')->where(array($map, 'status' => 1))->limit(10)->order('view desc')->select();
            } else {
                $News = D('News/News')->where(array('category' => $aCate, 'status' => 1))->limit(10)->order('view desc')->select();

            }
        }

        foreach ($News as &$c) {
            if ($c['cover'] == 0) {

                $c['cover_url']='';
            }else{
                $c['cover_url']['ori']= render_picture_path_without_root(get_cover($c['cover'], 'path'));
                $c['cover_url']['thumb']= render_picture_path_without_root(getThumbImageById($c['cover'], 100, 100));
                $c['cover_url']['banana']= render_picture_path_without_root(thumb($c['cover'], 400 ,292));
            }
            $c['dead_line'] = time_format($c['dead_line']);
            $c['create_time'] = friendlyDate($c['create_time']);
            $c['update_time'] = friendlyDate($c['update_time']);
            $c['user']= D('Api/User')->getUserReduceInfo($c['uid']);
        }
        unset($c);


        $this->apiSuccess('返回成功', $News);
    }

    //资讯详情
    public function getNewsDetail()
    {
        $aId = I('get.id', '', 'intval');
        if (!$aId) {
            $this->apiError('请选择资讯');
        }
        $News = D('News/News')->where(array('status' => 1, 'id' => $aId))->find();
        if (!$News) {
            $this->apiError('数据库无此资讯');
        }
        $newsModel = D('Api/News');
        $NewsDetail = $newsModel->getDetail($aId);
        $NewsArticle = D('News/NewsDetail')->where(array('status' => 1, 'news_id' => $aId))->find();
        $NewsDetail['content'] = fmatDtlContent($NewsArticle['content']);
        $this->apiSuccess('返回成功', $NewsDetail);
    }

    // 返回某个资讯的评论列表
    public function getNewsComments()
    {

        $aPage = I_POST('page', 'intval');
        $aCount = 10;
        $aRowId = I('get.id', '', 'intval');

        if (empty($aPage)) {
            $aPage = 1;
        }

        if (!D('News')->where(array('id' => $aRowId))->find()) {
            $this->apiError('活动不存在');
        }
        $uid = D('News')->where(array('id' => $aRowId))->field('uid')->select();
        $uid = array_column($uid, 'uid');

        $NewsComments = D('LocalComment')->where(array('app' => 'News', 'mod' => 'index', 'row_id' => $aRowId, 'status' => 1))->page($aPage, $aCount)->order('create_time asc')->select();
        foreach ($NewsComments as &$v) {
            $v['user']= D('Api/User')->getUserReduceInfo($v['uid']);
            $v['create_time'] = friendlyDate($v['create_time']);
            if (in_array($v['uid'], $uid)) {
                $v['is_landlord'] = '1';
            } else {
                $v['is_landlord'] = '0';
            }
        }
        unset($v);

        $this->apiSuccess('返回成功', $NewsComments);
    }

    /*发送资讯评论*/
    public function sendNewsComment()
    {
        $mid = $this->requireIsLogin();
        $aRowId = I('get.id', '', 'intval');
        $aContent = I_POST('content', 'op_t');
        $aApp = 'News';
        $aMod = 'index';

        if (!D('News')->where(array('id' => $aRowId))->find()) {
            $this->apiError('专辑不存在');
        }
        if (!$aContent) {
            $this->apiError('请输入回复内容');
        }
        $data = array('uid' => $mid, 'row_id' => $aRowId, 'parse' => 0, 'mod' => $aMod, 'app' => $aApp, 'content' => $aContent, 'status' => '1', 'create_time' => time());

        $data = D('LocalComment')->create($data);

        if (!$data) return false;

        $result = D('LocalComment')->add($data);

        D('News')->where(array('status' => 1, 'id' => $aRowId))->setInc('comment');
        $uid = D('News/News')->where(array('id' => $aRowId))->field('uid')->select();
        $uid = array_column($uid, 'uid');
        $reply = D('LocalComment')->where(array('id' => $result))->find();
        $reply['create_time'] = friendlyDate($reply['create_time']);
        $reply ['user'] = D('Api/User')->getUserReduceInfo($reply['uid']);
        if (in_array($reply['uid'], $uid)) {
            $reply['is_landlord'] = '1';
        } else {
            $reply['is_landlord'] = '0';
        }
        $replys = array($reply);
        $this->apiSuccess('返回成功', $replys);
    }

    public function delNewsComment()
    {

        $mid = $this->requireIsLogin();
        $aRowId = I_POST('row_id', 'intval');
        $aId = I('get.id', 'intval');

        $aApp = 'News';
        $aMod = 'index';
        if (!D('News/News')->where(array('id' => $aRowId))->find()) {
            $this->apiError('资讯不存在');
        }
        $Comment = D('LocalComment')->where(array('status' => '1', 'id' => $aId, 'app' => $aApp, 'mod' => $aMod))->find();
        if (!$Comment) {
            $this->apiError('回复不存在');
        }
        if ($Comment['uid'] == $mid || is_administrator($mid)) {
            $res = D('LocalComment')->where(array('uid' => $mid, 'id' => $aId, 'status' => '1'))->setField('status', -1);
            D('News')->where(array('status' => 1, 'id' => $aRowId))->setDec('comment');
            if ($res) {
                $this->apiSuccess('删除成功');
            } else {
                $this->apiError('删除操作失败!');
            }
        } else {
            $this->apiError('无权限操作!');
        }
    }


    public function sendNews()
    {
        $mid = $this->requireIsLogin();

        $aId = I('get.id', '', 'intval');
        $title = $aId ? "编辑" : "新增";
        $NewsModel = D('Api/News');
        if ($aId) {
            $data = $NewsModel->getData($aId);
            $this->ApiCheckAuth('News/Index/edit', $data['uid'], '你没有编辑该资讯权限！');
            if ($data['status'] == 1) {
                $this->apiError('该资讯已被审核，不能被编辑！');
            }
        } else {
            $this->ApiCheckAuth('News/Index/add', -1, '你没有投稿权限！');
        }
        $aId && $data['id'] = $aId;
        $data['uid'] = $mid;
        $data['title'] = I_POST('title', 'text');
        $data['content'] = I_POST('content', 'text');
        $data['category'] = I_POST('category', 'intval');
        $data['description'] = I_POST('description', 'text');
        $data['cover'] = I_POST('cover', 'intval');
        $data['collection'] = I_POST('collection', 'intval');
        $data['dead_line'] = I_POST('dead_line', 'text');
        if ($data['dead_line'] == '') {
            $data['dead_line'] = 2147483640;
        } else {
            $data['dead_line'] = strtotime($data['dead_line']);
        }
        $data['source'] = I_POST('source', 'text');

        $position = I('position', 'text');
        $position = explode(',', $position);
        $data['sort'] = $data['position'] = $data['view'] = $data['comment'] = $data['collection'] = 0;
        foreach ($position as $val) {
            $data['position'] += intval($val);
        }
        $category = D('News/NewsCategory')->where(array('status' => 1, 'id' => $data['category']))->find();
        if ($category) {
            if ($category['can_post']) {
                if ($category['need_audit'] && !check_auth('Admin/News/setNewsStatus')) {
                    $data['status'] = 2;
                } else {
                    $data['status'] = 1;
                }
            } else {
                $this->apiError('该分类不能投稿！');
            }
        } else {
            $this->apiError('该分类不存在或被禁用！');
        }
        $data['template'] = '';

        $this->_checkOk($data);
        $result = $NewsModel->editData($data);
        if($result){
            if ($aId) {
                $News = D('News/News')->where(array('id' => $aId))->find();
                if (!$News) {
                    $this->apiError('数据库无此资讯');
                }
            } else {
                $News = D('News/News')->where(array('id' => $result))->find();
                if($News['status']== 2){
                    $this->apiSuccess('发布成功，请等待管理员审核通过！');
                }else{
                    $this->apiSuccess('发布成功');
                }
            }

        }


        $NewsArticle = D('News/NewsDetail')->where(array('news_id' => $News['id']))->find();
        $News['cover_url'] = get_cover($News['cover'], 'path');
        $News['create_time'] = friendlyDate($News['create_time']);
        $News['update_time'] = friendlyDate($News['update_time']);
        $News['dead_line'] = time_format($News['dead_line']);
        $News['user'] = query_user(array('uid', 'username', 'nickname', 'avatar128'), $News['uid']);


        $News['content'] = $NewsArticle['content'];

        if ($result) {
            $this->apiSuccess($title . '发表成功！', $News);
        } else {
            $this->apiError($title . '失败！');
        }
    }

    function _checkOk($data = array())
    {
        if (!mb_strlen($data['title'], 'utf-8')) {
            $this->apiError('标题不能为空！');
        }
        if (mb_strlen($data['content'], 'utf-8') < 20) {
            $this->apiError('内容不能少于20个字！');
        }
        return true;
    }
}