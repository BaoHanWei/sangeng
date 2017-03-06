<?php
namespace Tutorial\Model;

use Think\Model;

class TutorialMemberModel extends Model
{
    protected $tableName = 'tutorial_member';

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('activity', '0', self::MODEL_INSERT),
    );

    public function addMember($data)
    {
        $data = $this->create($data);
        $res = $this->add($data);
        return $res;
    }

    public function delMember($map)
    {
          return $this->where($map)->delete();
    }

    public function setPosition($uid, $tutorial_id, $position)
    {
        $res = $this->where(array('uid' => $uid, 'tutorial_id' => $tutorial_id))->setField('position', $position);
        return $res;
    }


    public function setStatus($uid, $tutorial_id, $status)
    {
        $res = $this->where(array('uid' => $uid, 'tutorial_id' => $tutorial_id))->save(array('status'=>$status,'update_time'=>time()));
        return $res;
    }

    public function getIsJoin($uid, $tutorial_id)
    {
        $status = S('tutorial_is_join_' . $tutorial_id . '_' . $uid);
        if (is_bool($status)) {
            $check = $this->where(array('tutorial_id' => $tutorial_id, 'uid' => $uid))->find();
            if (!$check) {
                //未加入群组
                $status = 0;
            } else {
                if ($check['status'] == 1) {
                    // 已加入群组并已审核
                    $status = 1;
                } else {
                    //未审核
                    $status = 2;
                }
            }
            S('tutorial_is_join_' . $tutorial_id . '_' . $uid, $status, 60 * 60);
        }
        return $status;
    }

    public function setLastView($tutorial_id)
    {
        $this->where(array('tutorial_id' => $tutorial_id, 'uid' => is_login()))->setField('last_view', time());

    }


    public function getMember($uid, $tutorial_id)
    {
        $member = $this->where(array('tutorial_id' => $tutorial_id, 'uid' => $uid, 'status' => 1))->cache('tutorial_member_' . $tutorial_id . '_' . $uid, 60 * 5)->find();
        return $member;
    }

    public function getMemberById($id)
    {
        $member = $this->where(array('id' => $id, 'status' => 1))->find();
        return $member;
    }


    public function getTutorialIds($param)
    {
        !empty($param['field']) && $this->field($param['field']);
        !empty($param['where']) && $this->where($param['where']);
        !empty($param['limit']) && $this->limit($param['limit']);
        empty($param['order']) && $param['order'] = 'create_time desc';
        !empty($param['page']) && $this->page($param['page'], empty($param['count']) ? 10 : $param['count']);
        $this->order($param['order']);
        $list = $this->select();
        $list = getSubByKey($list, 'tutorial_id');
        return $list;
    }

    public function getTutorialAdmin($tutorial_id){
        $uids =$this->where(array('tutorial_id'=>$tutorial_id,'position'=>array('egt',2),'status'=>1))->field('uid')->order('position desc')->select();

        return getSubByKey($uids,'uid');
    }

}