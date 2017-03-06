<?php


namespace Api\Model;

use Think\Model;

class GroupModel extends Model
{
    public function getGroupType($id)
    {
        $Group = D('Group/GroupType')->where(array('id'=>$id))->find();
        $Group['GroupSecond'] = D('Group/GroupType')->where(array('status' => 1, 'pid' => $id))->select();
        return $Group;
    }

    public function getGroup($id){
        $Group = D('Group/Group')->where(array('id'=>$id))->find();
        $Group['background']=getThumbImageById($Group['background']);
        if($Group['background']==false){
            $Group['background']=null;
        }

        if($Group['logo']==0){
            $Group['logo']=null;
        }else{
            $Group['logo']=render_picture_path_without_root(getThumbImageById($Group['logo']));
        }



        if (D('Group/GroupMember')->where(array('group_id' => $id, 'uid' => is_login(), 'status' => 1))->find()) {
            $Group['is_join'] = '1';
        } else {
            if (D('Group/GroupMember')->where(array('group_id' => $id, 'uid' => is_login(), 'status' => 0))->find()) {
                $Group['is_join'] = '-1';
            } else {
                $Group['is_join'] = '0';
            }
        }
        $Group['member_count'] = D('Group/GroupMember')->where(array('group_id' => $id,'status' => 1))->count();
        $Group['post_count'] = D('Group/GroupPost')->where(array('group_id' => $id,'status' => 1))->count();
        $Group['create_time'] = friendlyDate($Group['create_time']);
        $Group['title'] = op_t($Group['title']);
        $Group['detail'] = op_t($Group['detail']);
        $Group['user']= D('Api/User')->getUserReduceInfo($Group['uid']);
        return $Group;
    }

    public function getPost($id){
        $Post= D('Group/GroupPost')->where(array('id'=>$id,'status'=>1))->find();

        $Post['create_time'] = friendlyDate($Post['create_time']);
        $Post['title'] = op_t($Post['title']);
        $Post['content'] = fmatDtlContent($Post['content']);
        $Group=D('Group/Group')->where(array('id'=>$Post['group_id']))->find();
        $Post['share_url']='http://'.$_SERVER['HTTP_HOST'].'/index.php?s=/group/index/detail/id/'.$id.'.html';
        $Post['group_title'] = $Group['title'];
        $Post['last_reply_time'] = friendlyDate($Post['last_reply_time']);
        $Post['update_time'] = friendlyDate($Post['update_time']);
        $Post['user'] =D('Api/User')->getUserSimpleInfo($Post['uid']);
        $Post['supportCount'] = D('support')->where(array('appname' => 'Group', 'row' => $Post['id'], 'table' => 'post'))->count();
        $Post['BookmarkCount']=D('Group/GroupBookmark')->where(array('post_id' => $id))->count();
        if(D('Group/GroupBookmark')->where(array('post_id' => $id, 'uid' => is_login()))->find()){
            $Post['is_collect'] = '1';
        }else{
            $Post['is_collect'] = '0';
        }
        if (D('support')->where(array('appname' => 'Group', 'row' => $Post['id'], 'uid' => is_login(), 'table' => 'post'))->find()) {
            $Post['is_support'] = '1';
        } else {
            $Post['is_support'] = '0';
        }
        return $Post;
    }

    public function getMember($id){
        $Post= D('Group/GroupPost')->where(array('id'=>$id,'status'=>1))->find();
        $Post['create_time'] = friendlyDate($Post['create_time']);
        $Post['title'] = op_t($Post['title']);
        $Post['content'] = op_t($Post['content']);
        $Post['last_reply_time'] = friendlyDate($Post['last_reply_time']);
        $Post['update_time'] = friendlyDate($Post['update_time']);
        $Post['user'] =D('Api/User')-> getUserSimpleInfo( $Post['uid']);
        $Post['supportCount'] = D('support')->where(array('appname' => 'Group', 'row' => $Post['id'], 'table' => 'post'))->count();
        if (D('support')->where(array('appname' => 'Group', 'row' => $Post['id'], 'uid' => is_login(), 'table' => 'post'))->find()) {
            $Post['is_support'] = '1';
        } else {
            $Post['is_support'] = '0';
        }
        return $Post;
    }

}