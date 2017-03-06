<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-28
 * Time: 下午3:11
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Book\Model;


use Think\Model;

class BookModel extends Model{

    public function editData($data)
    {
        if($data['id']){
            $data['update_time']=time();
            $res=$this->save($data);
        }else{
            $data['create_time']=$data['update_time']=time();
            $res=$this->add($data);
        }
        return $res;
    }

    public function getData($id){
        $data=$this->find($id);
        if($data){
            $data['category']=D('BookCategory')->where(array('id'=>$data['category_id']))->getField('title');
            $data['role_ids']=str_replace('[','',$data['role_ids']);
            $data['role_ids']=str_replace(']','',$data['role_ids']);
            $data['role_ids']=explode(',',$data['role_ids']);
        }
        return $data;
    }

    public function getListByPage($map,$page=1,$order='sort asc,update_time desc',$field='*',$r=20)
    {
        $totalCount=$this->where($map)->count();
        if($totalCount){
            $list=$this->where($map)->page($page,$r)->order($order)->field($field)->select();
            $bookCategoryModel=D('BookCategory');
            foreach($list as &$val){
                $val['category']=$bookCategoryModel->where(array('id'=>$val['category_id']))->getField('title');
            }
            unset($val);
        }
        return array($list,$totalCount);
    }

    public function getList($map,$field='*',$order='sort asc,see asc')
    {
        $lists = $this->where($map)->field($field)->order($order)->select();
        $bookCategoryModel=D('BookCategory');
        foreach($lists as &$val){
            $val['category']=$bookCategoryModel->where(array('id'=>$val['category_id']))->getField('title');
        }
        unset($val);
        return $lists;
    }

    public function getBookTree($id)
    {
        $book=$this->where(array('id'=>$id,'status'=>1,'is_show'=>1,'create_time'=>array('lt',time())))->find();
        if($book){
            $book['tree']=D('Book/BookSection')->getSectionTree($id);
        }
        return $book;
    }

    //复制教程 start
    public function copyBook($id)
    {
        $data=$this->find($id);
        unset($data['id']);
        $res=$this->add($data);
        if(!$res){
            return false;
        }
        $result=$this->_copySection($id,$res);
        return $result;
    }

    private function _copySection($old_book_id,$new_book_id)
    {
        $map['status']=array('gt',-1);
        $map['book_id']=$old_book_id;
        $map['pid']=0;
        $sectionModel=D('Book/BookSection');
        $sections=$sectionModel->where($map)->order('sort asc')->select();
        $sectionDetailModel=D('BookDetail');
        foreach($sections as $val){
            $old_section_id=$val['id'];
            unset($val['id']);
            $val['book_id']=$new_book_id;
            $new_section_id=$sectionModel->add($val);
            if($val['type']){
                $section_content=$sectionDetailModel->where(array('section_id'=>$old_section_id))->find();
                if($section_content){
                    $section_content['section_id']=$new_section_id;
                    unset($section_content['id']);
                    $sectionDetailModel->add($section_content);
                }
            }else{
                $this->_copyChildSection($old_section_id,$new_section_id,$new_book_id);
            }
        }
        return true;
    }

    private function _copyChildSection($old_section_id,$new_section_id,$new_book_id)
    {
        $map['status']=array('gt',-1);
        $map['pid']=$old_section_id;
        $sectionModel=D('Book/BookSection');
        $sections=$sectionModel->where($map)->order('sort asc')->select();
        $sectionDetailModel=D('BookDetail');
        foreach($sections as $val){
            $now_old_section_id=$val['id'];
            unset($val['id']);
            $val['book_id']=$new_book_id;
            $val['pid']=$new_section_id;
            $now_new_section_id=$sectionModel->add($val);
            if($val['type']){
                $section_content=$sectionDetailModel->where(array('section_id'=>$now_old_section_id))->find();
                if($section_content){
                    $section_content['section_id']=$now_new_section_id;
                    unset($section_content['id']);
                    $sectionDetailModel->add($section_content);
                }
            }else{
                $this->_copyChildSection($now_old_section_id,$now_new_section_id,$new_book_id);
            }
        }
        return true;
    }
    //复制教程 end
}