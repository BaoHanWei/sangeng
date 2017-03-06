<?php


namespace Api\Model;

use Think\Model;

class IssueModel extends Model
{
    public function getIssue($id)
    {
        $Issue = D('Issue/IssueContent')->where(array('id' => $id, 'status' => 1))->find();
        if (!empty($Issue)) {
            $Issue['content'] = fmatDtlContent($Issue['content']);
            $Issue['user'] =  D('Api/User')->getUserReduceInfo($Issue['uid']);
            $Issue['cover_url'] = get_one_pic($Issue['cover_id'],400);
            $Issue['create_time'] = friendlyDate($Issue['create_time']);
            $Issue['update_time'] = friendlyDate($Issue['update_time']);
            $IssueTitle = D('Issue/Issue')->where(array('id' => $Issue['issue_id'], 'status' => 1))->find();
            $Issue['Issue_title']=$IssueTitle['title'];
            $Issue['share_url']='http://'.$_SERVER['HTTP_HOST'].'/index.php?s=/issue/index/issuecontentdetail/id/'.$id.'.html';
            $Issue['support_count'] = D('support')->where(array('appname' => 'Issue', 'table' => 'issue_content', 'row' => $Issue['id'],))->count();
            if (empty($Issue['support_count'])) {
                $Issue['is_supported'] = '0';
            } else {
                $Issue['is_supported'] = '1';
            }
            $follow = D('Follow')->where(array('who_follow' => is_login(), 'follow_who' =>$Issue['uid']))->find();
            $Issue['is_following'] = $follow ? 1 : 0;
            $IssueModules = D('Issue/Issue')->where(array('id' => $IssueTitle['pid'], 'status' => 1))->find();

            $IssueTitle['Modules_id']=$IssueModules['id'];
        }
        return $Issue;
    }

    public function getComment($id)
    {
        $IssueComments=D('Issue/LocalComment')->where(array('id' => $id))->find();
        $uid = D('Issue/IssueContent')->where(array('id' => $IssueComments['row_id']))->field('uid')->select();

        $uid = array_column($uid, 'uid');
        $arr = array();
        preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/", $IssueComments['content'], $arr); //匹配所有的图片
        $IssueComments['imgList'] = $arr[1];
        $IssueComments['content'] = op_t($IssueComments['content']);

        if($IssueComments['uid']==0){
            $IssueComments['user']['avatar128'] =null;
            $IssueComments['user']['uid'] =0;
            $IssueComments['user']['nickname'] ='游客';
        }else{
            $IssueComments['user'] =  D('Api/User')->getUserReduceInfo($IssueComments['uid']);
        }
        $IssueComments['create_time'] = friendlyDate($IssueComments['create_time']);
        if (in_array($IssueComments['uid'], $uid)) {
            $IssueComments['is_landlord'] = '1';
        } else {
            $IssueComments['is_landlord'] = '0';
        }
        return $IssueComments;
    }


}