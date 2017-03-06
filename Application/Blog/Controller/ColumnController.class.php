<?php
namespace Blog\Controller;
use Think\Controller;
use Addons\Recommend\RecommendAddon;
class ColumnController extends Controller{

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
        }
        $map['status']=1;
        list($list,$totalCount) = D("Ucenter/project")->getListByPage($map,$page,$order,'*',modC('BLOG_PAGE_NUM',20,'Blog_project'));
        foreach($list as &$val){
            $val['user']=query_user(array('avatar64', 'nickname', 'space_url', 'space_link'),$val['uid']);
            $val['description']=msubstr($val['description'],0,150);
            $val['logo_url'] = get_pic_src(M('picture')->where('id=' . $val['logo'])->field('path')->getField('path'));
            $val['first_document'] = M("blog")->field('id','title')->where('doc_project_id='.$val['id'].' and doc_parent_id=0')->order('doc_sort ASC,create_time ASC')->limit(1)->getField('id');
        }
        unset($val);    
        $hotcolumn=$this->_hotcolumn();
        $this->assign("hotcolumn",$hotcolumn);
        $this->assign("tree",$tree);
        $this->assign('list', $list);
        $this->assign('totalCount',$totalCount);
        $current= ($current==''?'home':$current);
        $this->assign('cid',$cid);
        $this->assign('tab',$current);
        $this->display();
    }
    /**
     * 显示文档
     * @param int $doc_id
     * @return 
     * @throws AuthorizationException
     */
    public function show($id=0)
    {
        $doc = M("blog")->where("id=".$id)->find();
        if($doc){
            $doc_detail=M("blog_detail")->where("blog_id=".$doc['id'])->find();
            if(empty($doc_detail['content']) === false){
                $doc["content"] = $doc_detail['content'];
            }else{
                $doc["content"] ='';
            }
        }
        $project = M('blog_project')->where("id=".$doc['doc_project_id'])->find();
        $tree=D("Ucenter/Project")->getProjectHtmlTree($doc['doc_project_id'],$id);
        
        /*
        $this->data['project'] = Project::getProjectFromCache($doc->project_id);
        $this->data['tree'] = Project::getProjectHtmlTree($doc->project_id,$doc->doc_id);
        $this->data['title'] = $doc->doc_name;

        if(empty($doc->doc_content) === false){
            $this->data['body'] = Document::getDocumnetHtmlFromCache($doc_id);
        }else{
            $this->data['body'] = '';
        }
        if($this->request->ajax()){
            unset($this->data['member']);
            unset($this->data['project']);
            unset($this->data['tree']);
            $this->data['doc_title'] = $doc->doc_name;
            return $this->jsonResult(0,$this->data);
        }*/
        $this->assign('tree',$tree);
        $this->assign('project',$project);
        $this->assign('doc',$doc);
        $this->display();
    }

    /**
     * 显示文档
     * @param int $doc_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws AuthorizationException
     */
    /*public function show($doc_id)
    {
        $doc_id = intval($doc_id);
        if($doc_id <= 0){
            abort(404);
        }

        $doc = Document::getDocumentFromCache($doc_id);

        if(empty($doc) ){
            abort(404);
        }
        $project = Project::getProjectFromCache($doc->project_id);

        if(empty($project)){
            abort(404);
        }

        $permissions = Project::hasProjectShow($project->project_id,$this->member_id);

        //校验是否有权限访问文档
        if($permissions === 0){
            abort(404);
        }elseif($permissions === 2){
            $role = session_project_role($project->project_id);
            if(empty($role)){
                $this->data = $project;
                return view('home.password',$this->data);
            }
        }

        $this->data['project'] = Project::getProjectFromCache($doc->project_id);

        $this->data['tree'] = Project::getProjectHtmlTree($doc->project_id,$doc->doc_id);
        $this->data['title'] = $doc->doc_name;

        if(empty($doc->doc_content) === false){
            $this->data['body'] = Document::getDocumnetHtmlFromCache($doc_id);
        }else{
            $this->data['body'] = '';
        }

        if($this->request->ajax()){
            unset($this->data['member']);
            unset($this->data['project']);
            unset($this->data['tree']);
            $this->data['doc_title'] = $doc->doc_name;


            return $this->jsonResult(0,$this->data);
        }

        return view('home.kancloud',$this->data);
    }*/


    public function experts($page=1){
        $category = I('category',0,'intval');
        $current='';
        if($category){
            $now_category=$this->blogCategoryModel->find($category);
            $cid=$now_category['pid']==0?$now_category['id']:$now_category['pid'];
            $current='category_' . $cid;
            $map['category']=$category;
            $map['status']=1;
             $experts=$this->_experts($map,$page,$order,'*',modC('BLOG_PAGE_NUM',20,'Blog'));
        }else{
            $map="doc_project_id>0 and FROM_UNIXTIME(create_time)>DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
            $experts=$this->_experts($map,$page,$order,'uid,count(*) as count',modC('BLOG_PAGE_NUM',20,'Blog'));
        }
        
        $hotexperts=$this->_hotexperts();
        $newexperts=$this->_newexperts();
        /*栏目分类*/
        $tree = $this->blogCategoryModel->getTree(0,true,array('status' => 1));
        $this->assign("tree",$tree);
        $this->assign("experts",$experts);
        $this->assign('totalCount',count($experts));
        $this->assign("hotexperts",$hotexperts);
        $this->assign("newexperts",$newexperts);
        $current= ($current==''?'home':$current);
        $this->assign('category',$category);
        $this->assign('tab',$current);
        $this->display();
    }
    /*
     *排行榜
     */
    public function ranking(){
        $blogWeekRank=$this->_blogWeekRank();
        $articleRank=$this->_articleWeekRank();
        $commentWeekRank=$this->_commentWeekRank();
        $projectWeekRank=$this->_projectWeekRank();
        $hotBlog=$this->_hotBlog();
        $originalBlogRank=$this->_originalBlogRank();
        $this->assign("hotBlog",$hotBlog);
        $this->assign("articleRank",$articleRank);
        $this->assign("blogWeekRank",$blogWeekRank);
        $this->assign("commentWeekRank",$commentWeekRank);
        $this->assign("projectWeekRank",$projectWeekRank);
        $this->assign("originalBlogRank",$originalBlogRank);
        $this->display();
    }


     /*
     *个人博客总阅读数周排行榜
     */
    private function _blogWeekRank(){
        $result=json_decode(S("_blogWeekRank"),true);
        if(empty($result)){
            $Model = new \Think\Model();
            $sql="SELECT uid,count(comment) as comments,count(view) as views FROM `os_blog` WHERE status=1 and FROM_UNIXTIME(create_time)>DATE_SUB(CURDATE(), INTERVAL 1 WEEK) group by uid order by views desc limit 0,10";
            $result=$Model->query($sql);
            if($result){
                foreach($result as &$val){
                 $userinfo=query_user(array('avatar128','nickname','uid', 'space_url',), $val['uid']);
                 $val['nickname']=$userinfo['nickname'];
                 $val['space_url']=$userinfo['space_url'];
                 $val['avatar128']=$userinfo['avatar128'];
                 $val['comment_count']=$val['comments'];
                 $val['view_count']=$val['views'];
                }
                 S("_blogWeekRank",json_encode($result),array('type'=>'file','expire'=>259200));
            }
        }
        return $result;
    }

    /*
     *文章阅读周排行榜
     */
    private function _articleWeekRank(){
        $result=json_decode(S("_articleWeekRank"),true);
        if(empty($result)){
            $Model = new \Think\Model();
            $sql="SELECT id,title,view FROM `os_blog` WHERE status=1 and FROM_UNIXTIME(create_time)>DATE_SUB(CURDATE(), INTERVAL 1 WEEK) order by view desc limit 0,10";
            $result=$Model->query($sql);
            if($result){
                S("_articleWeekRank",json_encode($result),array('type'=>'file','expire'=>86400));
            }
        }
        return $result;
    }
    /*
     *文章评论周排行榜
     */
    private function _commentWeekRank(){
        $result=json_decode(S("_commentWeekRank"),true);
        if(empty($result)){
            $Model = new \Think\Model();
            $sql="SELECT id,title,comment  FROM `os_blog` WHERE status=1 and FROM_UNIXTIME(create_time)>DATE_SUB(CURDATE(), INTERVAL 1 WEEK) order by comment desc limit 0,10";
            $result=$Model->query($sql);
            if($result){
                foreach($result as &$val){
                $userinfo=query_user(array('avatar128','nickname','uid', 'space_url',), $val['uid']);
                 $val['nickname']=$userinfo['nickname'];
                 $val['space_url']=$userinfo['space_url'];
                 $val['avatar128']=$userinfo['avatar128'];
                }
             S("_commentWeekRank",json_encode($result),array('type'=>'file','expire'=>86400));
            }
        }
        return $result;
    }
    /*
     *受欢迎的专栏周排行榜
     */
    private function _projectWeekRank(){
        $result=json_decode(S("_projectWeekRank"),true);
        if(empty($result)){
            $result=M("blog_project")->field("uid,project_name,view,logo")->where("doc_count >0")->order("view desc")->limit(10)->select();
            if($result){   
                foreach ($result as &$val) {
                    $val['logo_url'] = get_pic_src(M('picture')->where('id=' . $val['logo'])->field('path')->getField('path'));
                }   
                S("_projectWeekRank",json_encode($result),array('type'=>'file','expire'=>86400));
            }
        }
        return $result;
    }
    /*
     *受欢迎的博客排行榜
     */
    private function _hotBlog(){
        $result=json_decode(S("_hotBlogRank"),true);
        if(empty($result)){
            $Model = new \Think\Model();
            $sql="SELECT uid,count(view) as view_count FROM `os_blog` WHERE status=1  GROUP BY uid order by view_count desc";
            $result=$Model->query($sql);
            if($result){   
                foreach ($result as &$val) {
                    $userinfo=query_user(array('avatar128','nickname','uid', 'space_url',), $val['uid']);
                    $val['nickname']=$userinfo['nickname'];
                    $val['space_url']=$userinfo['space_url'];
                    $val['avatar128']=$userinfo['avatar128'];
                }   
                S("_hotBlogRank",json_encode($result),array('type'=>'file','expire'=>86400));
            }
        }
        return $result;
    }
    /*
     * 原创周博客排行榜
     */
    private function _originalBlogRank(){
        $result=json_decode(S("_originalBlogRank"),true);
        if(empty($result)){
            $Model = new \Think\Model();
            $sql="SELECT id,title,count(*) as count FROM `os_blog` WHERE blog_type=1 and status=1 and FROM_UNIXTIME(create_time)>DATE_SUB(CURDATE(), INTERVAL 1 WEEK) order by count desc limit 0,10";
            $result=$Model->query($sql);
            if($result){
                foreach($result as &$val){
                $userinfo=query_user(array('avatar128','nickname','uid', 'space_url',), $val['uid']);
                 $val['nickname']=$userinfo['nickname'];
                 $val['space_url']=$userinfo['space_url'];
                 $val['avatar128']=$userinfo['avatar128'];
                }
             S("_originalBlogRank",json_encode($result),array('type'=>'file','expire'=>86400));
            }
        }
        return $result;
    }
    /*
     *上1周发文章数量来排序专家
     */
    private function _experts($map, $page = 1, $order = 'count desc', $field = '*', $r = 20){
        $string=md5($map.$page.$order.$field.$r); 
        $result=json_decode(S($string),true);
        if(empty($result)){
            $Model = new \Think\Model();
            //$sql="SELECT uid,count(*) as count FROM `os_blog` WHERE doc_project_id>0 and FROM_UNIXTIME(create_time)>DATE_SUB(CURDATE(), INTERVAL 1 WEEK)  GROUP BY uid order by count desc";
            //$result=$Model->query($sql);
            if(!empty($map['category'])){
                $result=M("rank_user")->where($map)->page($page, $r)->order($order)->field($field)->select();
            }else{
                $result=M("blog")->where($map)->group("uid")->page($page, $r)->order($order)->field($field)->select();
            }
            if($result){
                foreach($result as &$val){
                 $val=query_user(array( 'avatar128','uid', 'space_url',), $val['uid']);
                 $rank_user=M("rank_user")->where("uid=".$val['uid'])->find();
                 $val['truename']=$rank_user["truename"];
                 $val['job']=$rank_user["job"];
                 $val['city']=$rank_user["city"];
                 $blog_sql="SELECT COUNT(*) as count ,COUNT(`view`) as views FROM os_blog WHERE uid=".$val['uid'];
                 $blog_info= $Model->query($blog_sql);
                 $val['blog']=$blog_info[0]['count'];
                 $val['views']=$blog_info[0]['views'];
                }
            }
            S($string,json_encode($result),array('type'=>'file','expire'=>86400));
        }
        return $result;
    }
    
    /*
     * 热门专家
     * 暂时以发表文章数来排序
     */
    private function _hotexperts(){
        $result=json_decode(S("_hotexperts"),true);
        if(empty($result)){
            $Model = new \Think\Model();
            $sql="SELECT uid,count(*) as count FROM `os_blog` WHERE doc_project_id>0 GROUP BY uid order by count desc limit 0,6";
            $result=$Model->query($sql);
            foreach($result as &$val){
                $val=query_user(array( 'avatar128','uid', 'space_url',), $val['uid']);
                $rank_user=M("rank_user")->where("uid=".$val['uid'])->find();
                $val['truename']=$rank_user["truename"];
            }
            S('_hotexperts',json_encode($result),array('type'=>'file','expire'=>86400));
        }
        return $result;
    }

    /*
     * 最新加入的专家
     */
    private function _newexperts(){
        $rank_id=1;//博客专家
        $result=json_decode(S("_newexperts"),true);
        if(empty($result)){
            $result=M("rank_user")->where("status=1 and rank_id=".$rank_id)->order("create_time desc")->limit(4)->select();
            foreach($result as &$val){
                $val=query_user(array( 'avatar128','uid', 'space_url',), $val['uid']);
                $rank_user=M("rank_user")->where("uid=".$val['uid'])->find();
                $val['truename']=$rank_user["truename"];
            }
            S('_newexperts',json_encode($result),array('type'=>'file','expire'=>86400));
        }
        return $result;
    }

    /*
     * 热门专栏
     */
    private function _hotcolumn(){
        $result=json_decode(S("_hotcolumn"),true);
        if(empty($result)){
            $result=M("blog_project")->where("doc_count>10")->order("view desc")->limit(4)->select();
            foreach($result as &$val){
                $val['logo_url'] = get_pic_src(M('picture')->where('id=' . $val['logo'])->field('path')->getField('path'));
            }
            S('_hotcolumn',json_encode($result),array('type'=>'file','expire'=>86400));
        }
        return $result;
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