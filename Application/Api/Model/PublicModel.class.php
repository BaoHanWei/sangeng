<?php


namespace Api\Model;


use Think\Model;

class PublicModel extends Model
{
    public function getRank($type,$page)
    {

        $time = get_some_day(0);
        $time_yesterday = get_some_day(1);
        $memberModel = D('Member');
        $count=10;
        if(empty($type)){
            $type='today';
        }
        switch ($type) {
            case 'today' ://今天
                $list = D('Checkin/Checkin')->where(array('create_time' => array('egt', $time)))->order('create_time asc')->page($page,$count)->select();
                break;
            case 'con' ://连签
                $uids = D('Checkin/Checkin')->where(array('create_time' => array('egt', $time_yesterday)))->field('uid')->select();
                $uids = getSubByKey($uids, 'uid');
                $list = $memberModel->where(array('uid' => array('in', $uids)))->field('uid,con_check')->order('con_check desc,uid asc')->page($page,$count)->select();
                break;
            case 'total' ://累签
                $list = $memberModel->where(array('total_check' => array('gt', 0)))->field('uid,total_check')->order('total_check desc,uid asc')->page($page,$count)->select();
                break;
        }
        foreach ($list as &$v) {
            $v['user'] = D('Api/User')->getUserSimpleInfo($v['uid']);
            $v['create_time']=friendlyDate($v['create_time']);
        }
        unset($v);
        return $list;
    }


}