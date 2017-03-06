<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-28
 * Time: 下午01:33
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Book\Controller;


use Think\Controller;
use Common\Model\ContentHandlerModel;

class IndexController extends Controller{

    protected $bookModel;
    protected $bookCategoryModel;
    protected $bookSectionModel;

    function _initialize()
    {
        $this->bookModel = D('Book/Book');
        $this->bookCategoryModel = D('Book/BookCategory');
        $this->bookSectionModel=D('Book/BookSection');

        $tree = $this->bookCategoryModel->getTree(0,true,array('status' => 1));
        $this->assign('tree', $tree);
        $menu_list =
        array(
            'left' =>
            array(
                array('tab' => 'home', 'title' => '精选教程', 'href' =>  U('Book/index/index')),
                array('tab' => 'manual', 'title' => '入门教程', 'href' => U('Book/index/manual')),
                array('tab' => 'open', 'title' =>'开源教程', 'href' => U('Book/index/open')),
               // array('tab' => 'allbook', 'title' =>'全部教程', 'href' => U('Book/index/allbook')),
                array('tab' => 'mybook', 'title' =>'我的教程', 'href' => U('Ucenter/Book/index')),
            ),
            'right'=>array(
                array('type'=>'search', 'input_title' => L('_INPUT_TIP_'),'input_name'=>'keywords','from_method'=>'post', 'action' =>U('Book/index/index')),
            )
        );
        $this->assign('tab','home');
        $this->assign('sub_menu', $menu_list);
    }

    public function index()
    {
        $this->assign('current','home');
        $map_cate['status']=1;
        $map_cate['pid']=0;
        $category=$this->bookCategoryModel->getCategoryList($map_cate);
        $bookList=array();
        $map['create_time']=array('lt',time());
        $map['is_show']=1;
        $map['status']=1;
        $map['cate_ids']=array('LIKE','%3%');
        foreach($category as $val){
            $map_cate['pid']=$val['id'];
            $cat_ids=$this->bookCategoryModel->getCategoryList($map_cate);
            if(count($cat_ids)){
                $cat_ids=array_column($cat_ids,'id');
                $map['category_id']=array('in',array_merge(array($val['id']),$cat_ids));
            }else{
                $map['category_id']=$val['id'];
            }
            $val['books']=$this->bookModel->getList($map);
            $bookList[]=$val;
            /*if(count($val['books'])){
                $bookList[]=$val;
            }*/
        }
        //print_r($bookList);
        $this->assign('bookList',$bookList);
        $this->assign('category',$category);
        $this->display();
    }
    //入门教程
    public function manual()
    {
        $this->assign('current','home');
        $map_cate['status']=1;
        $map_cate['pid']=0;
        $category=$this->bookCategoryModel->getCategoryList($map_cate);
        $bookList=array();
        $map['create_time']=array('lt',time());
        $map['is_show']=1;
        $map['status']=1;
        $map['cate_ids']=array('LIKE','%1%');
        foreach($category as $val){
            $map_cate['pid']=$val['id'];
            $cat_ids=$this->bookCategoryModel->getCategoryList($map_cate);
            if(count($cat_ids)){
                $cat_ids=array_column($cat_ids,'id');
                $map['category_id']=array('in',array_merge(array($val['id']),$cat_ids));
            }else{
                $map['category_id']=$val['id'];
            }
            $val['books']=$this->bookModel->getList($map);
            $bookList[]=$val;
            /*if(count($val['books'])){
                $bookList[]=$val;
            }*/
        }
        //print_r($bookList);
        $this->assign('bookList',$bookList);
        $this->assign('category',$category);
        $this->display();
    }

    //开源教程
    public function open()
    {
        $this->assign('current','home');
        $map_cate['status']=2;
        $map_cate['pid']=0;
        $category=$this->bookCategoryModel->getCategoryList($map_cate);
        $bookList=array();
        $map['create_time']=array('lt',time());
        $map['is_show']=1;
        $map['status']=1;
        $map['cate_ids']=array('LIKE','%2%');
        foreach($category as $val){
            $map_cate['pid']=$val['id'];
            $cat_ids=$this->bookCategoryModel->getCategoryList($map_cate);
            if(count($cat_ids)){
                $cat_ids=array_column($cat_ids,'id');
                $map['category_id']=array('in',array_merge(array($val['id']),$cat_ids));
            }else{
                $map['category_id']=$val['id'];
            }
            $val['books']=$this->bookModel->getList($map);
            $bookList[]=$val;
            /*if(count($val['books'])){
                $bookList[]=$val;
            }*/
        }
        //print_r($bookList);
        $this->assign('bookList',$bookList);
        $this->assign('category',$category);
        $this->display();
    }

    public function bookList($page=1,$r=20)
    {
        $category = I('category',0,'intval');
        $current='';
        if($category){
            $this->_category($category);
            $cates=$this->bookCategoryModel->getCategoryList(array('pid'=>$category,'status'=>1));
            if(count($cates)){
                $cates=array_column($cates,'id');
                $cates=array_merge(array($category),$cates);
                $map['category_id']=array('in',$cates);
            }else{
                $map['category_id']=$category;
            }
            $now_category=$this->bookCategoryModel->find($category);
            $cid=$now_category['pid']==0?$now_category['id']:$now_category['pid'];
            $current='category_' . $cid;
        }
        $current= ($current==''?'home':$current);
        $this->assign('current',$current);

        $map['create_time']=array('lt',time());
        $map['is_show']=1;
        $map['status']=1;
        list($bookList,$totalCount)=$this->bookModel->getListByPage($map,$page,'sort asc,see asc','*',$r);
        $this->assign('bookList',$bookList);
        $this->assign('totalCount',$totalCount);
        $this->display();
    }

    public function read()
    {
        $aBookId=I('id',0,'intval');
        $aSectionId=I('section_id',0,'intval');//文章id
        if($aBookId){
            $book=$this->bookModel->getBookTree($aBookId);
            if(!$book){
                $this->error(L('_THE_TUTORIAL_DOES_NOT_EXIST_OR_HAS_BEEN_DISABLED_WITH_EXCLAMATION_'));
            }
            $this->assign('book',$book);
            $this->setTitle('{$book.title}-'.L('_TUTORIAL_'));
            $this->setKeywords('{$book.keywords}');
            $this->setDescription('{$book.summary}');
            $this->assign('share_title',$book['title']);
            $this->assign('book_id',$aBookId);
            $this->assign('book_section',$book);
        }elseif($aSectionId){
            $book_section=$this->bookSectionModel->getData($aSectionId);
            if(!$book_section){
                $this->error(L('_THIS_SECTION_DOES_NOT_EXIST_OR_HAS_BEEN_DISABLED_WITH_EXCLAMATION_'));
            }
            $book=$this->bookModel->getBookTree($book_section['book_id']);
            if(!$book){
                $this->error(L('_THE_TUTORIAL_DOES_NOT_EXIST_OR_HAS_BEEN_DISABLED_WITH_EXCLAMATION_'));
            }
            $this->assign('book',$book);
            $this->setTitle('{$book.title}-{$book_section.title}-'.L('_TUTORIAL_'));
            $this->setKeywords('{$book.keywords}，{$book_section.keywords}');
            $this->setDescription('{$book.summary}  {$book_section.summary}');
            $this->assign('share_title',$book['title'].$book_section['title']);
            $this->assign('section_id',$aSectionId);
            $this->assign('book_section',$book_section);
        }else{
            $this->error(L('_PARAMETER_ERROR_WITH_EXCLAMATION_'));
        }
        if(check_read_auth($book['role_ids'])===0){
            $this->error(L('_THE_USER_CAN_READ_THE_DOCUMENT_WITH_PERIOD_PARAM_',array('role'=>get_role_info($book['role_ids']))));
        }
        $this->bookModel->where(array('id'=>$book['id']))->setInc('see');
        if($book_section){
            $this->bookSectionModel->where(array('id'=>$aSectionId))->setInc('see');
        }
        $this->display();
    }

    public function loadSection()
    {
        $aSectionId=I('post.section_id',0,'intval');
        $section=$this->bookSectionModel->getData($aSectionId);
        if(!$section){
            $res['status']=0;
            $res['info']=L('_PARAMETER_ERROR_WITH_EXCLAMATION_NOT_EXIST_');
            $this->ajaxReturn($res);
        }
        $this->bookSectionModel->where(array('id'=>$aSectionId))->setInc('see');
        $share_title=$this->bookModel->where(array('id'=>$section['book_id']))->getField('title');
        $share_title.=$section['title'];
        $this->assign('share_title',$share_title);
        $this->assign('book_section',$section);
        $this->assign('section_id',$aSectionId);
        $this->display(T('Application://Book@Index/_content'));
    }

    /**
     * 编辑章节内容
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function editSection()
    {
        $aSectionId=I('section_id',0,'intval');
        if(IS_POST){
            $this->checkAuth('Book/index/editSection',-1,L('_YOU_DONT_HAVE_AN_EDIT_SECTION_WITH_EXCLAMATION_'));
            $map['section_id']=I('post.section_id',0,'intval');
            $content=$_POST['content'];
            $detailModel=D('BookDetail');
            $contentHandler = new ContentHandlerModel();
            $content = $contentHandler->filterHtmlContent($content);
            if($detailModel->where($map)->count()){
                $res=$detailModel->where($map)->setField('content',$content);
            }else{
                $map['content']=$content;
                $res=$detailModel->add($map);
            }
            if($res){
                $msg['status']=1;
                $msg['url']=U('Book/Index/read',array('section_id'=>$map['section_id']));
            }else{
                $msg['status']=0;
                $msg['info']=L('_OPERATION_FAILED_WITH_EXCLAMATION_').$detailModel->geterror();
            }
            $this->ajaxReturn($msg);
        }else{
            if(!check_auth('Book/index/editSection')){
                $result['status']=0;
                $result['info']=L('_YOU_DONT_HAVE_AN_EDIT_SECTION_WITH_EXCLAMATION_');
                $this->ajaxReturn($result);
            }
            if($aSectionId){
                $book_section=$this->bookSectionModel->getData($aSectionId);
                if(!$book_section){
                    $result['status']=0;
                    $result['info']=L('_THIS_SECTION_DOES_NOT_EXIST_OR_HAS_BEEN_DISABLED_WITH_EXCLAMATION_');
                    $this->ajaxReturn($result);
                }
                $book=$this->bookModel->getBookTree($book_section['book_id']);
                if(!$book){
                    $result['status']=0;
                    $result['info']=L('_THE_TUTORIAL_DOES_NOT_EXIST_OR_HAS_BEEN_DISABLED_WITH_EXCLAMATION_');
                    $this->ajaxReturn($result);
                }
                $this->assign('book',$book);
                $this->setTitle('{$book.title}-{$book_section.title}-'.L('_TUTORIAL_EDIT_'));
                $this->setKeywords('{$book.keywords}，{$book_section.keywords}');
                $this->setDescription('{$book.summary}  {$book_section.summary}');
                $this->assign('section_id',$aSectionId);
                $this->assign('book_section',$book_section);
            }else{
                $this->error(L('_PARAMETER_ERROR_WITH_EXCLAMATION_'));
            }

            $this->display(T('Application://Book@Index/edit'));
        }
    }

    private function _category($id=0)
    {
        $now_category=$this->bookCategoryModel->getTree($id,'id,title,pid,sort',array('status'=>1));
        $this->assign('now_category',$now_category);
        return $now_category;
    }
} 