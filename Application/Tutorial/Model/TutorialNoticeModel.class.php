<?php
namespace Tutorial\Model;
use Think\Model;

class TutorialNoticeModel extends Model {


    protected $tableName='tutorial_notice';
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
    );

    public  function getNotice($tutorial_id)
    {
        $notice = $this->where('tutorial_id=' . $tutorial_id)->cache('tutorial_notice_'.$tutorial_id,60*60)->find();
        return $notice;
    }

    public function addNotice($data){
        $data = $this->create($data);
        if(!$data) return false;
        $result = $this->add($data,array(),true);
        if(!$result) {
            return false;
        }

        S('tutorial_notice_'.$data['tutorial_id'],null);
        return $result;
    }

}