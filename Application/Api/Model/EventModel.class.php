<?php


namespace Api\Model;

use Think\Model;

class EventModel extends Model
{

    public function getEvent($id,$mid){

        $Event = D('Event/Event')->where(array('id'=>$id,'status'=>1))->find();
        $Title= D('Event/EventType')->where(array('id'=>$Event['type_id'],'status'=>1))->find();
        $Event['type_title']=$Title['title'];
        if (!$Event) {
            $this->apiError('活动不存在！');
        }
        $uids = D('Event/EventAttend')->where(array('event_id' => $id))->select();
//        foreach ($uids as $k => $v) {
//            $Event['member'][$k] = query_user(array('uid', 'username', 'nickname','avatar128','signature'), $v['uid']);
//        }
        $ids = D('Event/EventAttend')->where(array('event_id' => $id, 'uid' =>$mid))->find();
        $uids = getSubByKey($uids, 'uid');

        if (in_array($mid, $uids)) {
            $Event['is_Attend'] = '1';
        } else {
            $Event['is_Attend'] = '0';
        }
        if ($ids['status'] == 0) {
            $Event['is_pass'] = '0';
        } else {
            $Event['is_pass'] = '1';
        }
        $Event['explain'] = fmatDtlContent($Event['explain']);
        if ($Event['cover_id'] == 0) {
            $Event['cover_url'] = '';
        } else {
            $Event['cover_url']['ori'] = render_picture_path_without_root(get_cover($Event['cover_id'], 'path'));
            $Event['cover_url']['thumb'] = render_picture_path_without_root(getThumbImageById($Event['cover_id'], 120, 120));
            $Event['cover_url']['banana'] = render_picture_path_without_root(getThumbImageById($Event['cover_id'], 400, 292));
        }
        $Event['user'] = D('Api/User')->getUserSimpleInfo($Event['uid']);
        if ($Event['deadline'] < time()) {
            $Event['is_deadline'] = '1';
        } else {
            $Event['is_deadline'] = '0';
        }
        if ($Event['eTime'] < time()) {
            $Event['is_end'] = '1';
        } else {
            $Event['is_end'] = '0';
        }
        $Event['share_url']='http://'.$_SERVER['HTTP_HOST'].'/index.php?s=/event/index/detail/id/'.$id.'.html';
        $Event['deadline'] = time_format($Event['deadline']);
        $Event['create_time'] = friendlyDate($Event['create_time']);
        $Event['update_time'] = friendlyDate($Event['update_time']);
        $Event['sTime'] =date("Y-m-d",$Event['sTime']);
        $Event['eTime'] =date("Y-m-d",$Event['eTime']);
        return $Event;
    }

}