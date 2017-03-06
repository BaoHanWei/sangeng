<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-8-6
 * Time: 上午10:12
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Book\Model;


use Think\Model;
use Common\Model\ContentHandlerModel;

class BookSectionModel extends Model{

    /**
     * 获取章节列表
     * @param array $map
     * @return array|bool|mixed
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function getList($map=array())
    {
        $list=$this->where($map)->order('sort asc')->select();
        return $list;
    }

    /**
     * 获取章节
     * @param $id
     * @return mixed
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function getData($id)
    {
        $data=$this->find($id);
        if($data['type']==1){
            $data['content']=M('BookDetail')->where(array('section_id'=>$id))->getField('content');
            $contentHandler = new ContentHandlerModel();
            $data['content'] = $contentHandler->displayHtmlContent($data['content']);
        }
        return $data;
    }

    /**
     * 编辑章节
     * @param $data
     * @return bool
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function editData($data)
    {
        $res=$this->save($data);
        return $res;
    }

    /**
     * 批量编辑章节
     * @param $list
     * @return bool
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function editDataList($list)
    {
        $ids=array();
        foreach($list as $val){
            if($val['id']){
                $this->save($val);
                $ids[]=$val['id'];
            }else{
                $res=$this->add($val);
                if($res){
                    $ids[]=$res;
                }else{
                    return array(false,$ids);
                }
            }
        }
        return array(true,$ids);
    }

    /**
     * 根据章节id获取导航标题
     * @param $id
     * @param $title
     * @return string
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function getTitle($id,&$title)
    {
        $section=$this->getData($id);
        if($section['pid']==0){
            $book=D('Book')->where(array('id'=>$section['book_id']))->find();
            if($title==''){
                $title='<a href="'.U('Book/sections',array('book_id'=>$book['id'])).'">'.$book['title'].'</a>  >>  '.$section['title'];
            }else{
                $title='<a href="'.U('Book/sections',array('book_id'=>$book['id'])).'">'.$book['title'].'</a>  >>  '.'<a href="'.U('Book/sections',array('id'=>$section['id'])).'">'.$section['title'].'</a>  >>  '.$title;
            }
            return $title;
        }else{
            if($title==''){
                $title=$section['title'];
            }else{
                $title='<a href="'.U('Book/sections',array('id'=>$section['id'])).'">'.$section['title'].'</a>  >>  '.$title;
            }
            $title=$this->getTitle($section['pid'],$title);
            return $title;
        }
    }

    public function  getSectionTree($book_id)
    {
        $map['status']=1;
        $map['is_show']=1;
        $map['create_time']=array('lt',time());
        $map['book_id']=$book_id;
        $map['pid']=0;
        $tree=$this->where($map)->order('sort asc')->select();
        return $tree;
    }

    /**
     * 获取书的章节列表
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function getSectionOptions($book_id=0,$now_id=0)
    {
        $map['status']=1;
        $map['book_id']=$book_id;
        $map['pid']=0;
        $map['type']=0;
        $map['id']=array('neq',$now_id);
        $sections=$this->where($map)->order('sort asc')->select();
        $list=array('0'=>'顶级');
        foreach($sections as $val){
            $list[$val['id']]=$val['title'];
            $this->getChild($val['id'],$book_id,$now_id,$list);
        }
        return $list;
    }

    private function getChild($pid,$book_id,$now_id,&$list,$html='-')
    {
        $map['status']=1;
        $map['book_id']=$book_id;
        $map['pid']=$pid;
        $map['type']=0;
        $map['id']=array('neq',$now_id);
        $sections=$this->where($map)->order('sort asc')->select();
        foreach($sections as $val){
            $list[$val['id']]=$html.$val['title'];
            $this->getChild($val['id'],$book_id,$now_id,$list,$html.'-');
        }
        return;
    }

    //复制章节 start
    public function copySection($id)
    {
        $data=$this->find($id);
        unset($data['id']);
        $res=$this->add($data);
        if(!$res){
            return false;
        }
        $result=$this->_copyChildSection($id,$res);
        return $result;
    }

    private function _copyChildSection($old_section_id,$new_section_id)
    {
        $map['status']=array('gt',-1);
        $map['pid']=$old_section_id;
        $sections=$this->where($map)->order('sort asc')->select();
        $sectionDetailModel=D('BookDetail');
        foreach($sections as $val){
            $now_old_section_id=$val['id'];
            unset($val['id']);
            $val['pid']=$new_section_id;
            $now_new_section_id=$this->add($val);
            if($val['type']){
                $section_content=$sectionDetailModel->where(array('section_id'=>$now_old_section_id))->find();
                if($section_content){
                    $section_content['section_id']=$now_new_section_id;
                    unset($section_content['id']);
                    $sectionDetailModel->add($section_content);
                }
            }else{
                $this->_copyChildSection($now_old_section_id,$now_new_section_id);
            }
        }
        return true;
    }
    //复制章节 end
} 