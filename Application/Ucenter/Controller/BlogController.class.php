<?php

namespace Ucenter\Controller;
class BlogController extends BaseController{
    
    public function index($type='newblog',$page=1,$search='')
    {
        $this->requireLogin();
        $category=M("blog_user_category")->where("uid=".get_uid())->order("sort asc")->select();
        $this->assign('category',$category);
        $totalCount=0;
        if(!empty($search)){
            $search=array("like","%".trim($search)."%");
        }
        $catid=I('get.catid','','intval');
        $list=$this->_getList($type,$totalCount,$page,15,$search,$catid);
        $this->assign('totalCount', $totalCount);
        $this->assign('list', $list);
        //设置Tab
        $this->assign('type', $type);
        $this->assign('catid', $catid);
        $this->setTitle(L('_MY_FAVORITES_'));
        $this->display();
    }
    public function edit(){
        $this->requireLogin();
        $blog_category=M('blog_category')->where("status=1")->order("sort asc")->select();
        $category=M("blog_user_category")->where("uid=".get_uid())->order("addtime desc")->select();//博客分类
        $this->assign('category',$category);
        $this->assign('blog_category',$blog_category);
        $this->display();
    }
    public function blog_catalogs(){
        $this->requireLogin();
        $category=M("blog_user_category")->where("uid=".get_uid())->order("sort asc")->select();
        $this->assign('category',$category);
        $this->defaultTabHash('blog_catalogs');
        $this->display();
    }
    public function add_blog_catalog(){
        if (is_login()) {
            if (IS_POST) {
                $data['sort']=I('post.sort','','intval');
                $data['uid'] =get_uid();
                $data['title']=I('post.title','','text');
                $data['addtime']=time();
                $data['count']=0;
                $data['status']=1;
                $catalog_info=M("blog_user_category")->where("uid=".get_uid()." and title='".$data['title']."'")->find();
                if(!$catalog_info){
                    $result=M("blog_user_category")->add($data);
                    if($result){
                        $info['status']=1;
                        $info['data']['title']=$data['title'];
                        $info['data']['id']=$result;
                    }else {
                        $info['status']=0;
                        $info['info']=M("blog_user_category")->getError();
                    }
                    $this->ajaxReturn($info);
                }else {
                    $data['status']=0;
                    $data['info']="已经存在该分类";
                    $this->ajaxReturn($data);
                }
            }else{
                $data['status']=0;
                $data['info']="非法操作";
                $this->ajaxReturn($data);
            }
        }else{
            $data['status']=0;
            $data['info']="必须登录才能操作";
            $this->ajaxReturn($data);
        }
        
    }
    public function edit_blog_catalog(){
        if (is_login()) {
            if (IS_POST) {
                $data['sort']=I('post.sort','','intval');
                $data['title']=I('post.title','','text');
                $id=I('post.id','','intval');
                $uid=get_uid();
                $catalog_info=M("blog_user_category")->where("uid=".get_uid()." and title='".$data['title']."' and id!=".$id)->find();
                if(!$catalog_info){
                    $result=M("blog_user_category")->where("id=".$id." and uid=".$uid)->save($data);
                    if($result){
                        $info['status']=1;
                        $info['data']['title']=$data['title'];
                        $info['data']['id']=$result;
                    }else {
                        $info['status']=0;
                        $info['info']="修改失败";
                    }
                    $this->ajaxReturn($info);
                }else {
                    $data['status']=0;
                    $data['info']="已经存在该分类";
                    $this->ajaxReturn($data);
                }
            }else{
                $data['status']=0;
                $data['info']="非法操作";
                $this->ajaxReturn($data);
            }
        }else{
            $data['status']=0;
            $data['info']="必须登录才能操作";
            $this->ajaxReturn($data);
        }
    }
    
    public function del_blog_catalog(){
        if (is_login()) {
            if (IS_POST) {
                $id=I('post.id',0,'intval');
                $uid=get_uid();
                if($id){
                    $catalog_info=M("blog_user_category")->where("id=".$id." and uid=".$uid)->delete();
                    if($catalog_info){
                       $data['status']=1;
                    }else {
                        $data['status']=0;
                        $data['info']=M("blog_user_category")->getError();
                    }
                    $this->ajaxReturn($data);
                }else{
                    $data['status']=0;
                    $data['info']="非法操作";
                    $this->ajaxReturn($data);
                }
            }
        }else{
            $data['status']=0;
            $data['info']="必须登录才能操作";
            $this->ajaxReturn($data);
        }
    }
    
    
    public function edit_blog_catalogs(){
        $this->requireLogin();
        $id=I('id',0,'intval');
        if($id){
            $catalog_info=M("blog_user_category")->where("id=".$id)->find();
            $result=M("blog_user_category")->where("uid=".get_uid())->order("sort asc")->select();
            $this->assign('category',$result);
            $this->assign('catalog_info',$catalog_info);
            $this->defaultTabHash('blog_catalogs');
            $this->display();
        }else{
            $this->error("非法请求");
        }
    }
    public function editBlog()
    {
       $this->requireLogin();
        if(IS_POST){
            $this->_doEdit();
        }else{
            $aId=I('id',0,'intval');
            if($aId){
            $data=M("Blog")->field("os_blog.*,os_blog_detail.*,os_blog_user_category.title as user_category,os_blog_category.title as blog_category")->join("LEFT JOIN os_blog_detail on os_blog_detail.blog_id=os_blog.id")->join(" LEFT JOIN os_blog_user_category on os_blog_user_category.id=os_blog.cid")->join("LEFT JOIN os_blog_category on os_blog_category.id=os_blog.category")->where("os_blog.id=".$aId)->find();
            $title="编辑博客";
            $blog_category=M('blog_category')->where("status=1")->order("sort asc")->select();
            $category=M("blog_user_category")->where("uid=".get_uid())->order("addtime desc")->select();//博客分类
            $this->assign('category',$category);
            $this->assign('blog_category',$blog_category);
            $this->assign('data',$data);
            $this->assign('title',$title);
            }
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
            $data['uid']=get_uid();
            $data['status']=1;
            $data['category']=I('post.category',0,'intval');
            $category=M("blog_category")->where(array('status'=>1,'id'=>$data['category']))->find();
            if(!$category){
                $result['status']=0;
                $result['info']="不存在该系统分类";
                $this->ajaxReturn($result);
            }
            $data['cid']=I('post.cid',0,'intval');
            $user_category=M("blog_user_category")->where(array('status'=>1,'uid'=>$data['uid'],'id'=>$data['cid']))->find();
            if(!$user_category){
                $result['status']=0;
                $result['info']="不存在该博客分类";
                $this->ajaxReturn($result);
            }
            $data['tags']=I('post.tags','','text');
            $data['title']=I('post.title','','text');
            $data['is_top']=I('post.is_top','','intval');
            $data['is_private']=I('post.is_private','','intval');
            $data['description']=I('post.description','','text');
            $data['is_official_top']=I('post.is_official_top','','intval');
            $data['blog_type']=I('post.blog_type','','intval');
            $data['origin_url']=I('post.origin_url','','text');
            $data['is_comment']=I('post.is_comment','','intval');
            $data['is_recommend']=I('post.is_recommend','','intval');
            $data['content']=I('post.content','','text');
            $data['markdown_template']=I('post.markdown_template','','text');
            $old_cid=I('post.old_cid','','intval');
            if(!mb_strlen($data['title'],'utf-8')){
                $result['status']=0;
                $result['info']="博客标题不能为空";
                $this->ajaxReturn($result);
            }
            if(!mb_strlen($data['content'],'utf-8')){
                $result['status']=0;
                $result['info']="博客内容不能为空";
                $this->ajaxReturn($result);
            }
            $res=D('Blog/blog')->editData($data);
            if($res){
                $this->do_blog_user_category(array('cid'=>$old_cid,'type'=>'del'));
                $this->do_blog_user_category(array('cid'=>$data['cid'],'type'=>'add'));
                $result['status']=1;
                $result['info']="博客更新成功";
                $result['jump_url']=U('Blog/Index/detail',array('id'=>$aId));
                $this->ajaxReturn($result);
            }else{
                $result['status']=0;
                $result['info']="博客更新失败";
                $this->ajaxReturn($result);
            }
        }else{
            $data['uid']=get_uid();
            $data['praise']=$data['view']=$data['comment']=$data['collection']=0;
            $data['status']=1;
            $data['category']=I('post.category',0,'intval');
            $category=M("blog_category")->where(array('status'=>1,'id'=>$data['category']))->find();
            if(!$category){
                $result['status']=0;
                $result['info']="不存在该系统分类";
                $this->ajaxReturn($result);
            }
            $data['cid']=I('post.cid',0,'intval');
            $user_category=M("blog_user_category")->where(array('status'=>1,'uid'=>$data['uid'],'id'=>$data['cid']))->find();
            if(!$user_category){
                $result['status']=0;
                $result['info']="不存在该博客分类";
                $this->ajaxReturn($result);
            }
        }
        $data['tags']=I('post.tags','','text');
        $data['title']=I('post.title','','text');
        $data['is_top']=I('post.is_top',0,'intval');
        $data['is_private']=I('post.is_private',0,'intval');
        $data['description']=I('post.description','','text');
        $data['is_official_top']=I('post.is_official_top',0,'intval');
        $data['blog_type']=I('post.blog_type',1,'intval');
        $data['origin_url']=I('post.origin_url','','text');
        $data['is_comment']=I('post.is_comment',1,'intval');
        $data['is_recommend']=I('post.is_recommend',0,'intval');
        $data['content']=I('post.content','','text');
        $data['markdown_template']=I('post.markdown_template','','text');
        die;
        if(!mb_strlen($data['title'],'utf-8')){
            $result['status']=0;
            $result['info']="博客标题不能为空";
            $this->ajaxReturn($result);
        }
        if(!mb_strlen($data['content'],'utf-8')){
            $result['status']=0;
            $result['info']="博客内容不能为空";
            $this->ajaxReturn($result);
        }
        $res=D('Blog/blog')->editData($data);
        if($res){
            $this->do_blog_user_category(array('cid'=>$data['cid'],'type'=>'add'));
            $aId=$res;
            $result['status']=1;
            $result['info']="博客发布成功";
            $result['jump_url']=U('Blog/Index/detail',array('id'=>$aId));
            $this->ajaxReturn($result);
        }else{
            $result['status']=0;
            $result['info']="博客发布失败";
            $this->ajaxReturn($result);
        }
    }
    /**
     * 删除博客
     */
    public  function delBlog(){
        $map['id']=I('post.id',0,'intval');
        $map['uid']=get_uid();
        $data['status']=3;
        $cid=I('post.cid',0,'intval');
        $info=M("Blog")->where($map)->save($data);
        if($info){
            $this->do_blog_user_category(array('cid'=>$cid,'type'=>'del'));
            $result['status']=1;
            $result['info']="博客删除成功";
            $this->ajaxReturn($result);
        }else{
            $result['status']=0;
            $result['info']="博客删除失败";
            $this->ajaxReturn($result);
        }
    }
    /**
     * 更新博客该分类下的文章总数
     */
    private function do_blog_user_category($data){
        $map['id']=$data['cid'];
        if($data['type']=='add'){
            $result=M('blog_user_category')->where($map)->setInc('count',1);
        }else{
            $result=M('blog_user_category')->where($map)->setDec('count',1);
        }
        return $result;
    }
    public function _getList($type='newblog',&$totalCount=0,$page=1,$r=15,$search,$catid)
    {
        $map['uid']=is_login();
        if(!empty($catid)){
            $map['cid']=$catid;
        }
        switch ($type) {
            case 'newblog':
                $model=D('Blog');
                $map['status']=1;
                $list=$model->where($map)->page($page,$r)->order('update_time desc')->select();
                $totalCount=$model->where($map)->count();
                break;
           case 'hotblog':
               $model=D('Blog');
               $map['status']=1;
               $list=$model->where($map)->page($page,$r)->order('view desc')->select();
               $totalCount=$model->where($map)->count();
               break;
           case 'search':
               $model=D('Blog');
               $map['status']=1;
               $map['title']=$search;
               $list=$model->where($map)->page($page,$r)->order('view desc')->select();
               $totalCount=$model->where($map)->count();
               break;
            default:
                $this->error(L('_ERROR_ILLEGAL_OPERATE_').L('_EXCLAMATION_'));
               break;
        }
        return $list;
    }
    
} 