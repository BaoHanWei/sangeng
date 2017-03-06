<?php

namespace Tutorial\Model;
use Think\Model;

class TutorialTypeModel extends Model {
    protected $tableName='tutorial_type';

    public function getTutorialTypes(){
        $parent = $this->where(array('status' => 1,'pid'=>0))->order('sort asc')->select();
        $child =array();
        foreach($parent as $v){
            $child[$v['id']] = $this->where(array('status' => 1,'pid'=>$v['id']))->order('sort asc')->select();
        }
        return array('parent'=>$parent,'child'=>$child);
    }


    public function getTutorialType($id){
        $type = S('tutorial_type_'.$id);
        if(empty($type)){
            $type =  $this->where(array('id'=>$id,'status'=>1))->find();
            S('tutorial_type_'.$id,$type,300);
        }
         return $type;
    }
}