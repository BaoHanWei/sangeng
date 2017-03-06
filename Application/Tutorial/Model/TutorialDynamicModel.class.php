<?php
namespace Tutorial\Model;
use Think\Model;

class TutorialDynamicModel extends Model
{
    protected $tableName = 'tutorial_dynamic';

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
    );

    public function addDynamic($data)
    {
        $data = $this->create($data);
        $res = $this->add($data);
        return $res;
    }


    public function getDynamic($id){
        $dynamic = $this->where(array('id'=>$id,'status'=>1))->cache('tutorial_dynamic_'.$id,60*5)->find();
        return $dynamic;
    }

}