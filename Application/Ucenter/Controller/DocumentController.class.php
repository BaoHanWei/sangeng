<?php

namespace Ucenter\Controller;
class DocumentController extends BaseController{
    
    /**
     * 文档编辑首页
     * @param $id
     * @return 
     */
    public function index($id){
        $this->_checkAuth();
        if(empty($id) or $id <= 0){
            $this->error("非法操作", U('Home/Index/index'));
        }
        $project = M("blog_project")->where("uid=".is_login()." and id=".$id)->find();
        if(empty($project)){
            $this->error("非法操作", U('Home/Index/index'));
        }
        $jsonArray = D("project")->getProjectTree($id);
        if(empty($jsonArray) === false){
            $jsonArray[0]['state']['selected'] = true;
            $jsonArray[0]['state']['opened'] = true;
        }
        $this->assign('project',$project);
        $this->assign('json',json_encode($jsonArray,JSON_UNESCAPED_UNICODE));
        $this->display();
    }
    /**
     * 获取文档编辑内容
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function content($id)
    {
        $data=json_decode(S("content_".$id),true);
        if(empty($data)){
            if (empty($id) or $id <= 0) {
               $data['errcode']=40301;
               $data['message']="文档不存在";
               $this->ajaxReturn($data);
            }

            $doc = M("blog_detail")->join("os_blog on os_blog.id=os_blog_detail.blog_id")->where("blog_id=".$id)->find();
            if (empty($doc)) {
                $data['errcode']=40301;
                $data['message']="文档不存在";
                $this->ajaxReturn($data);
            }
            $data['errcode']=0;
            $data['message']='OK';
            $data['data']['doc']['doc_id'] = $doc['blog_id'];
            $data['data']['doc']['name'] = $doc['title'];
            $data['data']['doc']['project_id'] = $doc['doc_project_id'];
            $data['data']['doc']['parent_id'] = $doc['doc_parent_id'];
            $data['data']['doc']['content'] = $doc['content'];
            S("content_".$id,json_encode($data),array('type'=>'file','expire'=>259200));
        }
        $this->ajaxReturn($data);
    }

   /**
     * 保存文档
     */
    public function save()
    {
        $project_id = I('project_id',0,'intval');
        if(IS_POST){
            $document = null;
            $content = I('editormd-markdown-doc','',"text");
            //如果是保存文档内容
            if(!empty($content)){
                $doc_id = I('doc_id',0,'intval');
                if($doc_id <= 0){
                    $data=array();
                    $data['errcode']=40301;
                    $data['message']="文档不存在";
                    $this->ajaxReturn($data);
                }
                $document = M("blog")->where("id=".$doc_id)->find();
                if(empty($document)){
                    $data=array();
                    $data['errcode']=40301;
                    $data['message']="文档不存在";
                    $this->ajaxReturn($data);
                }
                //如果没有编辑权限
                ;
                if(empty(M('blog_project')->where("id=".$document['doc_project_id']." and uid=".is_login())->find())){
                    $data=array();
                    $data['errcode']=40301;
                    $data['message']="权限不足";
                    $this->ajaxReturn($data);
                }   
                //如果文档内容没有变更
                $res=M("blog_detail")->field("content")->where("blog_id=".$doc_id)->find();
                if(strcasecmp(md5($content),md5($res['content'])) === 0) {
                    $data=array();
                    $data['errcode']=0;
                    $data['message']="";
                    $data['data']=array('doc_id' => $doc_id, 'parent_id' => $document['doc_parent_id'], 'name' => $document['title']);;
                    $this->ajaxReturn($data);
                }
                $document['content'] = $content;
                $document['doc_modify_at'] = is_login();
            }else {
                //如果是新建文档
                $project = M("blog_project")->where("uid=".is_login()." and id=".$project_id)->find();
                if(empty($project)){
                    $data=array();
                    $data['errcode']=40301;
                    $data['message']="文档不存在";
                    $this->ajaxReturn($data);
                }
                $doc_id = I('id',0,"intval");
                $parentId =I('parentId',0,"intval");
                $name = I('documentName','',"text");
                $sort = I('sort',0,"intval");
                //文档名称不能为空
                if (empty($name)) {
                    $data=array();
                    $data['errcode']=40303;
                    $data['message']="文档名称不能为空";
                    $this->ajaxReturn($data);
                }
                //查看是否存在指定的文档
                if ($doc_id > 0) {
                    $document = M("blog")->where('doc_project_id='.$project_id)->where('id='.$doc_id)->find();
                    if (empty($document)) {
                        $data=array();
                        $data['errcode']=40301;
                        $data['message']="文档不存在";
                        $this->ajaxReturn($data);
                    }
                }
                //判断父文档是否存在
                if ($parentId > 0) {
                    $parentDocument = M("blog")->where('doc_project_id='.$project_id)->where('id='.$parentId)->find();
                    if (empty($parentDocument)) {
                        $data=array();
                        $data['errcode']=40301;
                        $data['message']="文档不存在";
                        $this->ajaxReturn($data);
                    }
                }
                if($doc_id > 0) {
                    //查看是否有重名文档
                    $doc = M("blog")->field("id")->where('project_id='.$project_id." and title=".$name." and id!=".$doc_id)->find();
                    if (empty($doc) === false) {
                        $data=array();
                        $data['errcode']=40304;
                        $data['message']="同名文档已存在";
                        $this->ajaxReturn($data);
                    }
                }else{
                    //查看是否有重名文档
                    $doc = M("blog")->field("id")->where('project_id='.$project_id." and title=".$name)->find();
                    if (empty($doc) === false) {
                        $data=array();
                         $data['errcode']=40304;
                         $data['message']="同名文档已存在";
                         $this->ajaxReturn($data);
                    }
                }
                if (empty($document) === false and $document['doc_parent_id'] == $parentId and strcasecmp($document['title'], $name) === 0 and $sort <= 0) {

                    $data=array();
                    $data['errcode']=0;
                    $data['data']['id']=$doc_id;
                    $data['data']['parent_id']=$parentId;
                    $data['data']['name']=$name;
                    $this->ajaxReturn($data);
                }
                $info=array();
                $info['doc_project_id']=$project_id;
                $info['title']         =$name;
                $info['doc_parent_id'] =$parentId;
                $info['uid']=is_login();
                if ($doc_id <= 0) {
                    $info['create_at']=is_login();
                    $sort = M("blog")->field("doc_sort")->where('doc_parent_id='.$parentId)->order('doc_sort DESC')->find();
                    $sort = ($sort ? $sort['doc_sort'] : -1) + 1;
                }else{
                    $info['doc_modify_at'] = is_login();
                }
                if($sort > 0) {
                    $info['doc_sort'] = $sort;
                }
            }
            if($doc_id <= 0){
                $doc_id=M("blog")->add($info);
                if($doc_id==false){
                    $data=array();
                    $data['errcode']=500;
                    $data['message']="添加失败";
                    $this->ajaxReturn($data);
                }
            }else{
                $info['update_time']=time();
                $info['doc_modify_at']=is_login();
                if(M("blog")->where("id=".$doc_id)->save($info)==false){
                    $data=array();
                    $data['errcode']=500;
                    $data['message']="保存失败";
                    $this->ajaxReturn($data);
                }else{
                     if(!empty($document['content'])){
                        if(M("blog_detail")->where("blog_id=".$doc_id)->find()){
                            $blog_detail['content']=$document['content'];
                            $result=M("blog_detail")->where("blog_id=".$doc_id)->save($blog_detail);
                            if(!$result){
                                $data=array();
                                $data['errcode']=500;
                                $data['message']="保存失败";
                                $this->ajaxReturn($data);
                            }
                        }else{
                            $blog_detail['content']=$document['content'];
                            $blog_detail['blog_id']=$doc_id;
                            $result=M("blog_detail")->add($blog_detail);
                            if(!$result){
                                $data=array();
                                $data['errcode']=500;
                                $data['message']="保存失败";
                                $this->ajaxReturn($data);
                            }
                        }
                        
                    }
                }
            }
            $data['data']   = array('doc_id' => $doc_id.'','parent_id' => ($info['doc_parent_id'] == 0 ? '#' : $info['doc_parent_id'] .''),'name' => $info['title']);
            $data['errcode']=0;
            $data['message']="";
            $this->ajaxReturn($data);
        }
    }

    /**
     * 删除文档
     * @param int $doc_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $doc_id = intval($id);

        if($doc_id <= 0){
            $data=array();
            $data['errcode']=40301;
            $data['message']="文档不存在";
            $this->ajaxReturn($data);
        }

        $doc = M("blog")->where("id=".$doc_id)->find();
        //如果文档不存在
        if(empty($doc)){
            $data=array();
            $data['errcode']=40301;
            $data['message']="文档不存在";
            $this->ajaxReturn($data);
        }
        //判断是否有编辑权限
        $document = M("blog")->where("id=".$doc_id)->find();
        if(empty(M('blog_project')->where("id=".$document['doc_project_id']." and uid=".is_login())->find())){
            $data=array();
            $data['errcode']=40301;
            $data['message']="权限不足";
            $this->ajaxReturn($data);
        }   
        $result=M("blog")->where("id=".$doc_id)->delete();
        if($result){
            $data=array();
            $data['errcode']=0;
            $data['message']="";
            $this->ajaxReturn($data);
        }else{
            $data=array();
            $data['errcode']=500;
            $data['message']="err";
            $this->ajaxReturn($data);
        }
    }

   /**
     * 检查权限校验是否为博客专家
     * @param $id
     * @return 
     */
    private function _checkAuth(){
        $uid=is_login();
        $rankInfo=M("rank_user")->join("os_rank on os_rank_user.rank_id=os_rank.id")->field("os_rank_user.id")->where("title='博客专家' and os_rank_user.status=1 and os_rank_user.uid=".$uid)->find();
        if(is_login && !empty($rankInfo)){
            return true;
        }else{
            $data=array();
            $data['errcode']=40301;
            $data['message']="权限不足";
            $this->ajaxReturn($data);
        }
    }

   /**
     * 文件上传
     */
    public function upload()
    {
        $allowExt = ["jpg", "jpeg", "gif", "png"];
        //如果上传的是图片
        if(isset($_FILES['editormd-image-file'])){
            //如果没有开启图片上传
            if(!isset($_ENV['UPLOAD_IMAGE_ENABLE'])){
                $data['success'] = 0;
                $data['message'] = '没有开启图片上传功能';
                $this->ajaxReturn($data);
            }
            $file = $this->request->file('editormd-image-file');
            $allowExt = explode('|',env('UPLOAD_IMAGE_EXT','jpg|jpeg|gif|png'));
        }elseif(isset($_FILES['editormd-file-file'])){
            //如果没有开启文件上传
            if(!env('UPLOAD_FILE_ENABLE','0')){
                $data['success'] = 0;
                $data['message'] = '没有开启文件上传功能';
                $this->ajaxReturn($data);
            }
            $file = $this->request->file('editormd-file-file');
            $allowExt = explode('|',env('UPLOAD_FILE_EXT','txt|doc|docx|xls|xlsx|ppt|pptx|pdf|7z|rar'));
        }
        $dirPath = public_path('uploads/' . date('Ym'));
        //如果目标目录不能创建
        if (!is_dir($dirPath) && !mkdir($dirPath)) {
            $data['success'] = 0;
            $data['message'] = '上传目录没有创建文件夹权限';
            $this->ajaxReturn($data);
        }
        //如果目标目录没有写入权限
        if(is_dir($dirPath) && !is_writable($dirPath)) {
            $data['success'] = 0;
            $data['message'] = '上传目录没有写入权限';
            $this->ajaxReturn($data);
        }

        //校验文件
        if(isset($file) && $file->isValid()){
            $ext = $file -> getClientOriginalExtension(); //上传文件的后缀
            //判断是否是图片
            if(empty($ext) or in_array(strtolower($ext),$allowExt) === false){
                $data['success'] = 0;
                $data['message'] = '不允许的文件类型';

                return $this->response->json($data);
            }
            //生成文件名
            $fileName = uniqid() . '_' . dechex(microtime(true)) .'.'.$ext;
            try{
                $path = $file->move('uploads/' . date('Ym'),$fileName);

                $webPath = '/' . $path->getPath() . '/' . $fileName;

                $data['success'] = 1;
                $data['message'] = 'ok';
                $data['alt'] = $file->getClientOriginalName();
                $data['url'] = url($webPath);
                if(isset($_FILES['editormd-file-file'])){
                    $data['icon'] = resolve_attachicons($ext);
                }

                return $this->response->json($data);

            }catch (Exception $ex){
                $data['success'] = 0;
                $data['message'] = $ex->getMessage();

                return $this->response->json($data);
            }

        }
        $data['success'] = 0;
        $data['message'] = '文件校验失败';
        return $this->response->json($data);
    }
    
} 