<?php
namespace Blog\Controller;
use Think\Controller;
use Addons\Recommend\RecommendAddon;
class IndexController extends Controller{

    protected $blogModel;
    protected $blogDetailModel;
    protected $blogCategoryModel;
    protected $blogArticleCategoryModel;

    function _initialize()
    {
        if(isset($_POST['keywords'])){
            $_GET['keywords']=json_encode(trim($_POST['keywords']));
        }
        $keywords=$_GET['keywords'];
        $this->blogModel = D('Blog/Blog');
        $this->blogDetailModel = D('Blog/BlogDetail');
        $this->blogCategoryModel = D('Blog/BlogCategory');
        $sub_menu =
        array(
            'left' =>
            array(
                array('tab' => 'home', 'title' => '博客首页', 'href' =>  U('Blog/index/index')),
                array('tab' => 'column', 'title' => '博客专栏', 'href' => U('Blog/column/index')),
                array('tab' => 'experts', 'title' =>'博客专家', 'href' => U('Blog/column/experts')),
                array('tab' => 'ranking', 'title' =>'博客排行榜', 'href' => U('Blog/column/ranking')),
                array('tab' => 'myblog', 'title' =>'我的博客', 'href' => U('Ucenter/blog/index')),
            ),
            'right'=>array(
                array('type'=>'search', 'input_title' => L('_INPUT_TIP_'),'input_name'=>'keywords','from_method'=>'post', 'action' =>U('Blog/index/index')),
            )
        );
        $sub_menu['first']=array( 'title' => L('_BLOG_'));
        $this->assign('tab','home');
        $this->assign('sub_menu', $sub_menu);
    }

    public function index($page=1)
    {
        if(json_decode($_GET['keywords'])!=''){
            $keywords=json_decode($_GET['keywords']);
            $this->assign('search_keywords',$keywords);
            $map['title|description']=array('like','%'.$keywords.'%');
        }else{
            $_GET['keywords']=null;
        }
        /*最新推荐、今日热门、本周热门、最新博客*/
        $ordertype=I('ordertype','recommend','text');
        switch ($ordertype)
        {
            case todayhot:
                $startTime=time()-86400;
                $endTime=time();
                $map['create_time']=array(array('egt',$startTime),array('elt',$endTime),'AND');
                $order='view desc,create_time desc';
              break;  
            case weekhot:
                $startTime=time()-86400*7;
                $endTime=time();
                $map['create_time']=array(array('egt',$startTime),array('elt',$endTime),'AND');
                $order='view desc,create_time desc';
              break;
           case newblog:
              $map['status']=1;
              $order_field=modC('BLOG_ORDER_FIELD','create_time','Blog');
              $order_type=modC('BLOG_ORDER_TYPE','desc','Blog');
              $order='create_time desc,'.$order_field.' '.$order_type;
              break;
            default://默认为推荐 
               $map['is_recommend']=1;
               $order_field=modC('BLOG_ORDER_FIELD','create_time','Blog');
               $order_type=modC('BLOG_ORDER_TYPE','desc','Blog');
               $order='create_time desc,'.$order_field.' '.$order_type;
        }
        /*栏目分类*/
        $tree = $this->blogCategoryModel->getTree(0,true,array('status' => 1));
        /* 博客分类 */
        $category = I('category',0,'intval');
        $current='';
        if($category){
            $this->_category($category);
            $cates=$this->blogCategoryModel->getCategoryList(array('pid'=>$category,'status'=>1));
            if(count($cates)){
                $cates=array_column($cates,'id');
                $cates=array_merge(array($category),$cates);
                $map['category']=array('in',$cates);
            }else{
                $map['category']=$category;
            }
            $now_category=$this->blogCategoryModel->find($category);
            $cid=$now_category['pid']==0?$now_category['id']:$now_category['pid'];
            $current='category_' . $cid;
            unset($map['is_recommend']);
        }
        $map['status']=1;
        /* 获取当前分类下资讯列表 */
        list($list,$totalCount) = $this->blogModel->getListByPage($map,$page,$order,'*',modC('BLOG_PAGE_NUM',20,'Blog'));
        foreach($list as &$val){
            $val['user']=query_user(array('avatar64', 'nickname', 'space_url', 'space_link'),$val['uid']);
            $val['description']=msubstr($val['description'],0,150);
        }
        unset($val);        
        /* 模板赋值并渲染模板 */
        $this->assign('tree', $tree);
        $this->assign('list', $list);
        $this->assign('category', $category);
        $this->assign('ordertype', $ordertype);
        $this->assign('totalCount',$totalCount);
        $current= ($current==''?'home':$current);
        $this->assign('cid',$cid);
        $this->assign('tab',$current);
        $this->display();
    }


    public function my($page=1)
    {
        $this->_needLogin();
        $map['uid']=get_uid();
        /* 获取当前分类下资讯列表 */
        list($list,$totalCount) = $this->blogModel->getListByPage($map,$page,'update_time desc','*',modC('BLOG_PAGE_NUM',20,'Blog'));
        foreach($list as &$val){
            if($val['dead_line']<=time()){
                $val['audit_status']= '<span style="color: #7f7b80;">'.L('_EXPIRE_').'</span>';
            }else{
                if($val['status']==1){
                    $val['audit_status']='<span style="color: green;">'.L('_AUDIT_SUCCESS_').'</span>';
                }elseif($val['status']==2){
                    $val['audit_status']='<span style="color:#4D9EFF;">'.L('_AUDIT_READY_').'</span>';
                }elseif($val['status']==-1){
                    $val['audit_status']='<span style="color: #b5b5b5;">'.L('_AUDIT_FAIL_').'</span>';
                }
            }

        }
        unset($val);
        /* 模板赋值并渲染模板 */
        $this->assign('list', $list);
        $this->assign('totalCount',$totalCount);

        $this->assign('tab','myBlog');
        $this->display();
    }

    public function detail()
    {
        $aId=I('id',0,'intval');

        /* 标识正确性检测 */
        if (!($aId && is_numeric($aId))) {
            $this->error(L('_ERROR_ID_'));
        }

        $info=$this->blogModel->getData($aId);
        if($info['dead_line']<=time()&&!check_auth('Blog/Index/edit',$info['uid'])){
            $this->error(L('_ERROR_EXPIRE_'));
        }
        $author=query_user(array('uid','space_url','nickname','avatar64','signature'),$info['uid']);
        $author['blog_count']=$this->blogModel->where(array('uid'=>$info['uid']))->count();
        /* 获取模板 */
        if (!empty($info['detail']['template'])) { //已定制模板
            $tmpl = 'Index/tmpl/'.$info['detail']['template'];
        } else { //使用默认模板
            $tmpl = 'Index/tmpl/detail';
        }

        $this->_category($info['category']);

        /* 更新浏览数 */
        $map = array('id' => $aId);
        $this->blogModel->where($map)->setInc('view');
        /* 模板赋值并渲染模板 */
        $this->assign('author',$author);
        $this->assign('info', $info);
        $this->setTitle('{$info.title|text} —— '.L("_MODULE_"));
        $this->setDescription('{$info.description|text} ——'.L("_MODULE_"));
        $this->display($tmpl);
    }

    public function edit()
    {
        $this->_needLogin();
        if(IS_POST){
            $this->_doEdit();
        }else{
            $aId=I('id',0,'intval');
            if($aId){
                $data=$this->blogModel->getData($aId);
                if(!check_auth('Blog/Index/edit',-1)){
                    if($data['uid']==is_login()){
                        if($data['status']==1){
                            $this->error(L('_ERROR_EDIT_DENY_'));
                        }
                    }else{
                        $this->error(L('_ERROR_EDIT_LIMIT_'));
                    }
                }
                $this->assign('data',$data);
            }else{
                $this->checkAuth('Blog/Index/add',-1,L('_ERROR_CONTRIBUTION_LIMIT_'));
            }
            $title=$aId?L('_EDIT_'):L('_ADD_');
            $category=$this->blogCategoryModel->getCategoryList(array('status'=>1,'can_post'=>1),1);
            $this->assign('category',$category);
            $this->assign('title',$title);
        }
        $this->assign('tab','create');
        $this->display();
    }

    private function _doEdit()
    {
        $aId=I('post.id',0,'intval');
        $data['category']=I('post.category',0,'intval');

        if($aId){
            $data['id']=$aId;
            $now_data=$this->blogModel->getData($aId);
            if(!check_auth('Blog/Index/edit',-1)){
                if($now_data['uid']==is_login()){
                    if($now_data['status']==1){
                        $this->error(L('_ERROR_EDIT_DENY_'));
                    }
                }else{
                    $this->error(L('_ERROR_EDIT_LIMIT_'));
                }
            }
            $category=$this->blogCategoryModel->where(array('status'=>1,'id'=>$data['category']))->find();
            if($category){
                if($category['can_post']){
                    if($category['need_audit']&&!check_auth('Admin/Blog/setBlogStatus')){
                        $data['status']=2;
                    }else{
                        $data['status']=1;
                    }
                }else{
                    $this->error(L('_ERROR_CONTRIBUTION_DENY_'));
                }
            }else{
                $this->error(L('_ERROR_NONE_'));
            }
            $data['template']=$now_data['detail']['template']?:'';
        }else{
            $this->checkAuth('Blog/Index/add',-1,L('_ERROR_CONTRIBUTION_LIMIT_'));
            $this->checkActionLimit('add_blog','Blog',0,is_login(),true);
            $data['uid']=get_uid();
            $data['sort']=$data['position']=$data['view']=$data['comment']=$data['collection']=0;
            $category=$this->blogCategoryModel->where(array('status'=>1,'id'=>$data['category']))->find();
            if($category){
                if($category['can_post']){
                    if($category['need_audit']&&!check_auth('Admin/Blog/setBlogStatus')){
                        $data['status']=2;
                    }else{
                        $data['status']=1;
                    }
                }else{
                    $this->error(L('_ERROR_CONTRIBUTION_DENY_'));
                }
            }else{
                $this->error(L('_ERROR_NONE_'));
            }
            $data['template']='';
        }
        $data['title']=I('post.title','','text');
        $data['cover']=I('post.cover',0,'intval');
        $data['description']=I('post.description','','text');
        $data['dead_line']=I('post.dead_line','','text');
        if($data['dead_line']==''){
            $data['dead_line']=2147483640;
        }else{
            $data['dead_line']=strtotime($data['dead_line']);
        }
        $data['source']=I('post.source','','text');
        $data['content']=I('post.content','','filter_content');

        if(!mb_strlen($data['title'],'utf-8')){
            $this->error(L('_TIP_TITLE_EMPTY_'));
        }
        if(mb_strlen($data['content'],'utf-8')<20){
            $this->error(L('_TIP_CONTENT_LENGTH_'));
        }

        $res=$this->blogModel->editData($data);
        $title=$aId?L('_EDIT_'):L('_ADD_');
        if($res){
            if(!$aId){
                $aId=$res;
                if($category['need_audit']&&!check_auth('Admin/Blog/setBlogStatus')){
                    $this->success($title.L('_TIP_SUCCESS_').cookie('score_tip').L('_TIP_AUDIT_'),U('Blog/Index/detail',array('id'=>$aId)));
                }
            }
            $this->success($title.L('_TIP_SUCCESS_').cookie('score_tip'),U('Blog/Index/detail',array('id'=>$aId)));
        }else{
            $this->error($title.L('_TIP_FAIL_').$this->blogModel->getError());
        }
    }

    

    private function _category($id=0)
    {
        $now_category=$this->blogCategoryModel->getTree($id,'id,title,pid,sort',array('status'=>1));
        $this->assign('now_category',$now_category);
        return $now_category;
    }
    
    private function _needLogin()
    {
        if(!is_login()){
            $this->error(L('_TIP_LOGIN_'));
        }
    }
} 