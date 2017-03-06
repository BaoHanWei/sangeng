<?php

namespace Tutorial\Model;
use Think\Model;

class TutorialPostCategoryModel extends Model {
    protected $tableName='tutorial_post_category';

    public function getPostCategory($id){
        $cate = S('tutorial_post_category_'.$id);
        if(empty($cate)){
            $cate =  $this->where(array('id'=>$id,'status'=>1))->find();
            S('tutorial_post_category_'.$id,$cate,60*5);
        }
         return $cate;
    }
}