<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-28
 * Time: 下午01:31
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Admin\Controller;


use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminSortBuilder;
use Admin\Builder\AdminTreeListBuilder;
use Common\Model\ContentHandlerModel;

class BookController extends AdminController
{

    protected $bookModel;
    protected $bookCategoryModel;
    protected $bookSectionModel;

    function _initialize()
    {
        parent::_initialize();
        $this->bookModel = D('Book/Book');
        $this->bookCategoryModel = D('Book/BookCategory');
        $this->bookSectionModel=D('Book/BookSection');
        import_lang('Book');
    }

    /**
     * 教程分类
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function bookCategory()
    {
        //显示页面
        $builder = new AdminTreeListBuilder();

        $tree = $this->bookCategoryModel->getTree(0, 'id,title,sort,pid,status');

        $builder->title(L('_TUTORIAL_BOOK_CLASSIFICATION_MANAGEMENT_'))
            ->suggest(L('_IF_THERE_IS_A_TUTORIAL_YOU_CANNOT_DELETE_THE_CATEGORY_'))
            ->buttonNew(U('Book/add'))
            ->data($tree)
            ->display();
    }

    /**分类编辑
     * @param int $id
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function add($id = 0)
    {
        $title=$id?L('_EDIT_'):L('_NEW_');
        if (IS_POST) {
            if ($this->bookCategoryModel->editData()) {
                $this->success($title.L('_SUCCESS_WITH_PERIOD_'), U('Book/bookCategory'));
            } else {
                $this->error($title.'失败!'.$this->bookCategoryModel->getError());
            }
        } else {
            $builder = new AdminConfigBuilder();

            if ($id != 0) {
                $data = $this->bookCategoryModel->find($id);
            }else{
                $data['pid']=I('pid',0,'intval');
            }
            $builder->title($title.L('_CLASSIFICATION_'))
                ->data($data)
                ->keyId()
                ->keyText('title', L('_TITLE_'))
                ->keyInteger('sort',L('_SORT_'))->keyDefault('sort',0)
                ->keyStatus()->keyDefault('status',1)
                ->keyHidden('pid','')->keyDefault('pid',0)
                ->buttonSubmit(U('Book/add'))->buttonBack()
                ->display();
        }

    }

    /**
     * 设置教程分类状态：删除=-1，禁用=0，启用=1
     * @param $ids
     * @param $status
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function setStatus($ids, $status)
    {
        !is_array($ids)&&$ids=explode(',',$ids);
        if($status==-1){
            $map_cate['pid']=array('in',$ids);
            $map_cate['status']=array('gt',-1);
            $child_ids=$this->bookCategoryModel->where($map_cate)->field('id')->select();
            if(count($child_ids)){
                $child_ids=array_column($child_ids,'id');
                $ids=array_merge($ids,$child_ids);
            }
            $map['category_id']=array('in',$ids);
            $map['status']=array('gt',-1);
            $count=$this->bookModel->where($map)->count();
            if($count){
                $this->error(L('_THERE_IS_A_TUTORIAL_IN_THE_CATEGORY_OR_SUB_CATEGORY._PLEASE_REMOVE_THE_TUTORIAL_'));
            }
        }
        $builder = new AdminListBuilder();
        $builder->doSetStatus('BookCategory', $ids, $status);
    }

    //分类管理end


    //教程start
    /**
     * 教程列表
     * @param int $page
     * @param int $r
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function index($page=1,$r=20)
    {
        $optOrder=array(
            array('id'=>'id','value'=>L('_ID_DECLINE_')),
            array('id'=>'sort','value'=>L('_SORT_INCREMENT_')),
            array('id'=>'create_time','value'=>L('_CREATE_TIME_LAPSE_')),
            array('id'=>'see','value'=>L('_READING_VOLUME_DECLINE_'))
        );
        $aOrder=I('order','id','text');
        if($aOrder=='sort'){
            $order=$aOrder.' asc';
        }else{
            $order=$aOrder.' desc';
        }
        $map['status']=array('neq',-1);
        list($list,$totalCount)=$this->bookModel->getListByPage($map,$page,$order,'*',$r);
        foreach($list as $key=>$val){
            $val[$key]['title']='【'.$val['category'].'】'.$val['title'];
        }
        unset($val);
        $builder=new AdminListBuilder();
        $builder->title(L('_TUTORIAL_LIST_'))
            ->data($list)
            ->buttonNew(U('Book/editBook'))
            ->setStatusUrl(U('Book/setBookStatus'))
            ->buttonEnable()->buttonDisable()->buttonDelete()->buttonSort(U('Book/sortBook'),L('_SORT_'))
            ->setSelectPostUrl(U('Admin/Book/index'))
            ->select('排序&nbsp;&nbsp;','order','select','','','',$optOrder)
            ->keyId()
            ->keyLink('title',L('_TITLE_'),'Book/Index/read?id=###')
            ->keyDoActionEdit('Book/editBook?id=###')
            ->keyDoAction('Book/sections?book_id=###',L('_CHAPTER_'))
            ->keyDoAction('Book/editSections?book_id=###',L('_EDIT_CHAPTER_'))
            ->keyDoAction('Book/copyBook?id=###',L('_COPY_TUTORIAL_'))
            ->keyText('sort',L('_SORT_'))
            ->keyText('see',L('_READING_'))
            ->keyText('category',L('_CLASSIFICATION_'))
            ->keyText('is_show',L('_DRAFT_NORMAL_WITH_SLASH_'))
            ->keyUid()
            ->keyCreateTime()->keyStatus()
            ->pagination($totalCount,$r)
            ->display();
    }

    /**
     * 复制教程
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function copyBook()
    {
        $aBookId=I('id',0,'intval');
        $book=$this->bookModel->getData($aBookId);
        if(!$book){
            $this->error(L('_THIS_TUTORIAL_DOES_NOT_EXIST_WITH_EXCLAMATION_'));
        }
        $res=$this->bookModel->copyBook($aBookId);
        if($res){
            $this->success(L('_COPY_SUCCESS_WITH_EXCLAMATION_'));
        }else{
            $this->error(L('_REPLICATION_FAILURE_WITH_EXCLAMATION_'));
        }
    }

    /**
     * 对教程进行排序
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function sortBook($ids = null)
    {
        if (IS_POST) {
            $builder =new AdminSortBuilder();
            $builder->doSort('Book', $ids);
        } else {
            $map['status'] = array('egt', 0);
            if($ids!=null){
                !is_array($ids)&&$ids=explode(',',$ids);
                $map['id']=array('in',$ids);
            }
            $list = $this->bookModel->getList($map, 'id,title,sort', 'sort asc');
            foreach ($list as $key => $val) {
                $list[$key]['title'] = $val['title'];
            }
            $builder = new AdminSortBuilder;
            $builder->meta_title = L('_TUTORIAL_SORT_');
            $builder->data($list);
            $builder->buttonSubmit(U('sortBook'))->buttonBack();
            $builder->display();
        }
    }

    public function setBookStatus($ids,$status=1)
    {
        !is_array($ids)&&$ids=explode(',',$ids);
        $builder = new AdminListBuilder();
        $builder->doSetStatus('Book', $ids, $status);
    }

    /**
     * 编辑教程
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function editBook()
    {
        $aId=I('id',0,'intval');
        $title=$aId?L('_EDIT_'):L('_NEW_');
        if(IS_POST){
            $aId&&$data['id']=$aId;
            $data['uid']=I('post.uid',get_uid(),'intval');
            $data['title']=I('post.title','','text');
            $data['img']=I('post.img',0,'intval');
            $data['keywords']=I('post.keywords',L('_TUTORIAL_'),'text');
            $data['category_id']=I('post.category_id',0,'intval');
            $data['summary']=I('post.summary','','text');
            $data['is_show']=I('post.is_show',0,'intval');
            $data['create_time']=I('post.create_time',time(),'intval');
            $data['see']=I('post.see',0,'intval');
            $data['sort']=I('post.sort',0,'intval');
            $data['role_ids']=I('post.role_ids',array());
            foreach($data['role_ids'] as &$val){
                $val='['.$val.']';
            }
            unset($val);
            $data['role_ids']=implode(',',$data['role_ids']);
            $data['cate_ids']=I('post.cate_ids',array());
            $data['cate_ids']=implode(',',$data['cate_ids']);
            $data['status']=I('post.status',1,'intval');
            if(!mb_strlen($data['title'],'utf-8')){
                $this->error(L('_TITLE_CAN_NOT_BE_EMPTY_WITH_EXCLAMATION_'));
            }
            $result=$this->bookModel->editData($data);
            if($result){
                $aId=$aId?$aId:$result;
                $this->success($title.L('_SUCCESS_WITH_EXCLAMATION_'),U('Book/editBook',array('id'=>$aId)));
            }else{
                $this->error($title.L('_FAILURE_WITH_EXCLAMATION_'),$this->bookModel->getError());
            }
        }else{
            $roleOptions = D('Role')->selectByMap(array('status' => array('gt', -1)), 'id asc', 'id,title');
            if($aId){
                $data=$this->bookModel->getData($aId);
            }
            $category=$this->bookCategoryModel->getCategoryList(array('status'=>array('gt',-1)),1);
            $options=array(0=>L('_NO_CLASSIFICATION_'));
            foreach($category as $val){
                $options[$val['id']]=$val['title'];
            }
            $builder=new AdminConfigBuilder();
            $bookOptions=array(array('id' =>1,'title'=>'入门教程'),array('id' =>2,'title'=>'开源教程'),array('id' =>3,'title'=>'精选教程'));
            $builder->title($title.L('_TUTORIAL_'))
                ->data($data)
                ->keyId()
                ->keyInteger('uid',L('_AUTHOR_UID_'))->keyDefault('uid',get_uid())
                ->keyText('title',L('_TITLE_'))
                ->keySingleImage('img',L('_COVER_'))
                ->keyText('keywords','关键词，以‘，’分割')
                ->keySelect('category_id',L('_CLASSIFICATION_'),'',$options)
                ->keyTextArea('summary',L('_INTRODUCTION_'))
                ->keyChosen('cate_ids', '教程标签','前端展示分类',$bookOptions)
                ->keyChosen('role_ids', L('_CAN_VIEW_THE_TUTORIALS_IDENTITY_'), L('_DO_NOT_CHOOSE_TO_SHOW_THAT_ALL_USERS_CAN_VIEW_THE_TUTORIAL_'), $roleOptions)
                ->keyRadio('is_show',L('_STATUS_'),'',array(0=>L('_DRAFT_'),1=>L('_NORMAL_')))
                ->keyCreateTime('create_time',L('_RELEASE_TIME_'),L('_SUPPORT_DELAYED_RELEASE_THAT_IS_TIME_IS_SET_FOR_THE_FUTURE_'))
                ->keyInteger('see',L('_READING_'))
                ->keyInteger('sort',L('_SORT_'))->keyDefault('sort',0)
                ->keyStatus()->keyDefault('status',1)
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
    //教程end
    //章节start
    /**
     * 章节列表
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function sections()
    {
        $aBookId=I('get.book_id',0,'intval');
        $aSectionId=I('get.id',0,'intval');
        if($aBookId){
            $book=$this->bookModel->getData($aBookId);
            if(!$book){
                $this->error(L('_THE_TUTORIAL_DOES_NOT_EXIST_OR_HAS_BEEN_DELETED_WITH_EXCLAMATION_'));
            }
            $title=$book['title'];
            $map['status']=array('neq',-1);
            $map['book_id']=$aBookId;
            $map['pid']=0;
            $list=$this->bookSectionModel->getlist($map);
        }elseif($aSectionId){
            $section=$this->bookSectionModel->getData($aSectionId);
            if(!$section){
                $this->error(L('_THE_SECTION_DOES_NOT_EXIST_OR_HAS_BEEN_DELETED_WITH_EXCLAMATION_'));
            }
            $title='';
            $title=$this->bookSectionModel->getTitle($aSectionId,$title);
            $map['status']=array('neq',-1);
            $map['book_id']=$section['book_id'];
            $map['pid']=$aSectionId;
            $list=$this->bookSectionModel->getlist($map);
        }else{
            $this->error(L('_PLEASE_CHOOSE_A_CHAPTER_OR_TUTORIAL_WITH_EXCLAMATION_'));
        }

        foreach($list as &$val){
            if(!$val['type']){
                $val['sections_link']='<a href="'.U('Book/sections',array('id'=>$val['id'])).'">章节</a>&nbsp;&nbsp;<a href="'.U('Book/editSections',array('id'=>$val['id'])).'">编辑章节</a>';
                $val['type_title']=L('_CHAPTER_');
            }else{
                $val['type_title']=L('_ARTICLE_');
            }
            if(!$val['is_show']){
                $val['is_show']=L('_DRAFT_');
            }else{
                $val['is_show']=L('_NORMAL_');
            }
        }
        unset($val);
        $builder=new AdminListBuilder();
        $builder->title(op_t($title))
            ->data($list);
        if($aBookId){
            $builder->button(L('_EDIT_THIS_LAYER_SECTION_'),array('href'=>U('Book/editSections',array('book_id'=>$aBookId))));
        }else{
            $builder->button(L('_EDIT_THIS_LAYER_SECTION_'),array('href'=>U('Book/editSections',array('id'=>$aSectionId))));
        }
        $builder->setStatusUrl(U('Book/setSectionStatus'))
            ->buttonEnable()->buttonDisable()->buttonDelete()
            ->ajaxButton(U('Book/changeSectionType'),array('type'=>1),L('_TURN_TO_THE_ARTICLE_TYPE_'))->ajaxButton(U('Book/changeSectionType'),array('type'=>0),L('_TURN_TO_CHAPTER_TYPE_'))
            ->buttonSort(U('Book/sortSections',array('pid'=>$map['pid'],'book_id'=>$map['book_id'])),L('_SORT_'))
            ->keyId()
            ->keyText('type_title',L('_TYPE_'))
            ->keyLink('title',L('_TITLE_'),'Book/Index/read?section_id=###')
            ->keyText('sections_link',L('_SECTION_OPERATION_'))
            ->keyDoActionEdit('Book/editSection?id=###')
            ->keyDoAction('Book/copySection?id=###',L('_COPY_'))
            ->keyBool('open_child',L('_START_SUB_CHAPTER_'))
            ->keyText('keywords',L('_KEY_WORDS_'))
            ->keyText('is_show',L('_DRAFT_NORMAL_WITH_SLASH_'))
            ->keyUid()
            ->keyStatus()
            ->keyCreateTime()
            ->display();
    }

    /**
     * 复制章节
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function copySection()
    {
        $aSectionId=I('id',0,'intval');
        $section=$this->bookSectionModel->getData($aSectionId);
        if(!$section){
            $this->error(L('_THIS_TUTORIAL_DOES_NOT_EXIST_WITH_EXCLAMATION_'));
        }
        $res=$this->bookSectionModel->copySection($aSectionId);
        if($res){
            $this->success(L('_COPY_SUCCESS_WITH_EXCLAMATION_'));
        }else{
            $this->error(L('_REPLICATION_FAILURE_WITH_EXCLAMATION_'));
        }
    }

    /**
     * 对教程进行排序
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function sortSections($ids = null,$pid=0,$book_id=0)
    {
        if (IS_POST) {
            $builder =new AdminSortBuilder();
            $builder->doSort('BookSection', $ids);
        } else {
            if($ids!=null){
                !is_array($ids)&&$ids=explode(',',$ids);
                $map['id']=array('in',$ids);
            }
            $map['pid']=$pid;
            $map['book_id']=$book_id;
            $map['status'] = array('egt', 0);
            $list = $this->bookSectionModel->getList($map, 'id,title,sort', 'sort asc');
            foreach ($list as $key => $val) {
                $list[$key]['title'] = $val['title'];
            }
            $builder = new AdminSortBuilder;
            $builder->meta_title = L('_TUTORIAL_SORT_');
            $builder->data($list);
            $builder->buttonSubmit(U('sortSections'))->buttonBack();
            $builder->display();
        }
    }

    public function changeSectionType($ids,$type=0)
    {
        !is_array($ids)&&$ids=explode(',',$ids);
        $map['id']=array('in',$ids);
        $res=$this->bookSectionModel->where($map)->setField('type',$type);
        if($res){
            $this->success(L('_OPERATION_SUCCESS_WITH_EXCLAMATION_'));
        }else{
            $this->error(L('_OPERATION_FAILED_WITH_EXCLAMATION_'));
        }
    }

    /**
     * 批量编辑章节
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function editSections()
    {
        if(IS_POST){
            $data_list=$_POST;
            $aBookId=I('post.book_id',0,'intval');
            $aSectionId=I('post.section_id',0,'intval');
            if($aBookId){
                $other_info=array(
                    'book_id'=>$aBookId,
                    'pid'=>0
                );
            }elseif($aSectionId){
                $data=$this->bookSectionModel->getData($aSectionId);
                if(!$data||$data['status']==-1){
                    $this->error(L('_THE_PARENT_CLASS_DOES_NOT_EXIST_OR_HAS_BEEN_DISABLED_WITH_EXCLAMATION_'));
                }
                $other_info=array(
                    'book_id'=>$data['book_id'],
                    'pid'=>$aSectionId
                );
            }else{
                $this->error(L('_NO_PARENT_CLASS_TUTORIAL_OR_CHAPTER_WITH_EXCLAMATION_'));
            }
            $section_list=$exist_ids=array();
            foreach($data_list['id'] as $key=>$val){
                if($data_list['title'][$key]!=''&&$val!=''){
                    $exist_ids[]=$val;
                }
                if($data_list['title'][$key]!=''){
                    $section=array(
                        'id'=>intval($val),
                        'title'=>text($data_list['title'][$key]),
                        'sort'=>intval($data_list['sort'][$key]),
                        'type'=>intval($data_list['type'][$key]),
                        'uid'=>intval($data_list['uid'][$key])?intval($data_list['uid'][$key]):get_uid(),
                        'keywords'=>text($data_list['keywords'][$key]),
                        'is_show'=>intval($data_list['is_show'][$key]),
                        'create_time'=>intval($data_list['create_time'][$key]),
                        'status'=>1,
                        'open_child'=>intval($data_list['open_child'][$key])
                    );
                    $section=array_merge($section,$other_info);
                    $section_list[]=$section;
                }
            }
            list($res,$ids)=$this->bookSectionModel->editDataList($section_list);
            $this->bookSectionModel->where(array('id'=>array('not in',$ids),'book_id'=>$other_info['book_id'],'pid'=>$other_info['pid']))->setField('status',-1);
            if($res){
                $this->success(L('_OPERATION_SUCCESS_WITH_EXCLAMATION_'),U('Book/sections',array('book_id'=>$aBookId,'id'=>$aSectionId)));
            }else{
                $this->success(L('_EDIT_FAILED_WITH_EXCLAMATION_').$this->bookSectionModel->getError());
            }
        }else{
            $aBookId=I('get.book_id',0,'intval');
            $aSectionId=I('get.id',0,'intval');
            if($aBookId){
                $book=$this->bookModel->getData($aBookId);
                if(!$book){
                    $this->error(L('_THE_TUTORIAL_DOES_NOT_EXIST_OR_HAS_BEEN_DELETED_WITH_EXCLAMATION_'));
                }
                $title=$book['title'];
                $map['status']=array('neq',-1);
                $map['book_id']=$aBookId;
                $map['pid']=0;
                $list=$this->bookSectionModel->getlist($map);
            }elseif($aSectionId){
                $section=$this->bookSectionModel->getData($aSectionId);
                if(!$section){
                    $this->error(L('_THE_SECTION_DOES_NOT_EXIST_OR_HAS_BEEN_DELETED_WITH_EXCLAMATION_'));
                }
                $title='';
                $title=$this->bookSectionModel->getTitle($aSectionId,$title);
                $map['status']=array('neq',-1);
                $map['book_id']=$section['book_id'];
                $map['pid']=$aSectionId;
                $list=$this->bookSectionModel->getlist($map);
            }else{
                $this->error(L('_PLEASE_CHOOSE_A_CHAPTER_OR_TUTORIAL_WITH_EXCLAMATION_'));
            }


            $this->assign('title',$title);
            $this->assign('list',$list);
            $this->assign('book_id',$aBookId);
            $this->assign('section_id',$aSectionId);
            $this->display(T('Application://Book@Admin/editsections'));
        }
    }

    /**
     * 设置章节状态
     * @param $ids
     * @param int $status
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function setSectionStatus($ids,$status=1)
    {
        !is_array($ids)&&$ids=explode(',',$ids);
        $builder = new AdminListBuilder();
        $builder->doSetStatus('BookSection', $ids, $status);
    }

    public function editSection()
    {
        $aSectionId=I('id',0,'intval');
        $oldSection=$this->bookSectionModel->getData($aSectionId);
        $title=$oldSection['type']?'编辑文章： '.$oldSection['title']:'编辑章节： '.$oldSection['title'];
        if(!$oldSection){
            $this->error(L('_THIS_CHAPTER_DOES_NOT_EXIST_AND_CANNOT_BE_EDITED_WITH_EXCLAMATION_'));
        }
        if(IS_POST){
            $data['id']=$aSectionId;
            $data['uid']=I('post.uid',get_uid(),'intval');
            $data['title']=I('post.title','','text');
            $data['pid']=I('post.pid',0,'intval');
            $data['keywords']=I('post.keywords','','text');
            $data['summary']=I('post.summary','','text');
            $data['is_show']=I('post.is_show',1,'intval');
            $data['sort']=I('post.sort',0,'intval');
            $data['create_time']=I('post.create_time',time(),'intval');
            $data['status']=I('post.status',1,'intval');
            $data['book_id']=$oldSection['book_id'];
            $data['color']=I('post.color','','text');
            if(!$oldSection['type']){
                $data['open_child']=I('post.open_child',1,'intval');
            }
            if(mb_strlen($data['title'],'utf-8')<=0){
                $this->error(L('_TITLE_CAN_NOT_BE_EMPTY_WITH_EXCLAMATION_'));
            }
            $res_section=$this->bookSectionModel->editData($data);
            if($oldSection['type']){
                $detail['section_id']=$aSectionId;
                $detailModel=D('BookDetail');
                $exist=$detailModel->where($detail)->find();
                $detail['content']=$_POST['content'];
                $contentHandler = new ContentHandlerModel();
                $detail['content'] = $contentHandler->filterHtmlContent($detail['content']);
                if($exist){
                    $detail['id']=$exist['id'];
                    $res_detail=$detailModel->save($detail);
                }else{
                    $res_detail=$detailModel->add($detail);
                }
            }
            if($res_section||$res_detail){
                $this->success(L('_OPERATION_SUCCESS_WITH_EXCLAMATION_'));
            }else{
                if($oldSection['type']){
                    $this->error('编辑失败！操作章节表时报 '.$this->bookSectionModel->getError().L('_WRONG;_THE_OPERATION_OF_THE_ARTICLE_FOR_DETAILS_OF_THE_TIMES_').$detailModel->getError().L('_WRONG_WITH_PERIOD_'));
                }else{
                    $this->error(L('_EDIT_FAILED_WITH_EXCLAMATION_').$this->bookSectionModel->getError());
                }
            }
        }else{
            $options=$this->bookSectionModel->getSectionOptions($oldSection['book_id'],$aSectionId);
            $builder=new AdminConfigBuilder();
            $builder->title($title);
            $builder->data($oldSection)
                ->keyId()
                ->keyUid('uid',L('_AUTHOR_UID_'))
                ->keyTitle('title',L('_TITLE_'))
                ->keySelect('pid',L('_FATHER_CLASS_'),'',$options)
                ->keyText('keywords',L('_KEY_WORDS_'))
                ->keyTextArea('summary',L('_INTRODUCTION_'));
            if($oldSection['type']){
                $builder->keyEditor('content',L('_CONTENT_'),'','all',array('width' => '850px', 'height' => '400px'));
            }else{
                $builder->keyBool('open_child',L('_START_SUB_CHAPTER_'));
            }
            $builder->keyRadio('is_show',L('_RELEASE_STATUS_'),'',array('0'=>L('_DRAFT_'),'1'=>L('_NORMAL_')))
                ->keyInteger('sort',L('_SORT_'))
                ->keyColor('color',L('_TEXT_COLOR_'))
                ->keyCreateTime()
                ->keyStatus()
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
}