<?php


namespace Api\Model;

use Think\Model;

class ForumModel extends Model
{


    public function getForumList($map_type = array('status' => 1),$mid)
    {
        if (empty($forum_list)) {
            //读取板块列表
            $forum_list = D('Forum/Forum')->where($map_type)->order('sort asc')->select();
            $forumPostModel = D('ForumPost');
            $forumPostReplyModel = D('ForumPostReply');
            foreach ($forum_list as &$f) {
                $map['status'] = 1;
                $map['forum_id'] = $f['id'];
                if(D('Forum/ForumFollow')->where(array('uid'=>$mid,'forum_id'=>$f['id']))->find()){
                    $f['is_follow']=1;
                }else{
                    $f['is_follow']=0;
                }
                $f['background'] = $f['background'] ?render_picture_path_without_root(getThumbImageById($f['background'], 800, 'auto')) : C('TMPL_PARSE_STRING.__IMG__') . '/default_bg.jpg';
                $f['logo'] = $f['logo'] ? render_picture_path_without_root(getThumbImageById($f['logo'], 128, 128)) : C('TMPL_PARSE_STRING.__IMG__') . '/default_logo.png';
                $f['topic_count'] = $forumPostModel->where($map)->count();
                $post_id = $forumPostModel->where(array('forum_id' => $f['id']))->field('id')->select();
                $p_id = getSubByKey($post_id, 'id');
                $map['post_id'] = array('in', implode(',', $p_id));
                $f['total_count'] = $f['topic_count'] + $forumPostReplyModel->where($map)->count();// + $forumLzlReplyModel->where($map)->count();
            }
            unset($f);
        }
        return $forum_list;
    }



    public function  getPosts($id,$post_ids)
    {
        $post = D('Forum/ForumPost')->where(array('id' => $id, 'status' => 1))->find();
        $post['support_count'] = D('support')->where(array('appname' => 'Forum', 'table' => 'post', 'row' => $post['id'],))->count();
        if (empty($post['support_count'])) {
            $post['is_supported'] = '0';
        } else {
            $post['is_supported'] = '1';
        }
        $post['content'] = fmatDtlContent($post['content']);
        $post['share_url']='http://'.$_SERVER['HTTP_HOST'].'/index.php?s=/forum/index/detail/id/'.$id.'.html';
        $post['user'] = D('Api/User')->getUserSimpleInfo($post['uid']);
        $post['last_reply_time'] = friendlyDate($post['last_reply_time']);
        $post['create_time'] = friendlyDate($post['create_time']);
        $post['update_time'] = friendlyDate($post['update_time']);
        if (empty($arr[1])) {
            $post['type'] = 'text';
        } else {
            $post['type'] = 'image';
        }
        if (in_array($post['id'], $post_ids)) {
            $post['is_support'] = '1';
        } else {
            $post['is_support'] = '0';
        }

        return $post;
    }

    public function  getSimplePosts($id,$mid)
    {
        $post = D('Forum/ForumPost')->where(array('id' => $id, 'status' => 1))->find();
        $post['support_count'] = D('support')->where(array('appname' => 'Forum', 'table' => 'post', 'row' => $post['id'],))->count();
        if (empty($post['support_count'])) {
            $post['is_supported'] = '0';
        } else {
            $post['is_supported'] = '1';
        }
        $forum = D('Forum/Forum')->where(array('id' => $post['forum_id']))->find();
        $arr = array();
        $post['img_list']='';
        preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/", $post['content'], $arr);
        foreach ($arr[0] as $k => $c) {
            $post['img_list'][]=render_picture_path_without_root($arr[1][$k]);
        }


        $post['forum']['id'] = $post['forum_id'];
        $post['forum']['title'] = $forum['title'];
        $post['user'] = D('Api/User')->getUserSimpleInfo($post['uid']);
        $post['last_reply_time'] = friendlyDate($post['last_reply_time']);
        $post['create_time'] = friendlyDate($post['create_time']);
        $post['update_time'] = friendlyDate($post['update_time']);
        $post['content']=text($post['content']);
        if (empty($arr[1])) {
            $post['type'] = 'text';
        } else {
            $post['type'] = 'image';
        }
        return $post;
    }
    public function  getComment($id,$mid)
    {
        $Reply =D('Forum/ForumPostReply')->where(array('id' => $id, 'status' => 1))->find();
        $Reply['content'] = fmatDtlContent($Reply['content']);
        $Reply['user'] =  D('Api/User')->getUserSimpleInfo($Reply['uid']);
        if (in_array($Reply['uid'], $mid)) {
            $Reply['is_landlord'] = '1';
        } else {
            $Reply['is_landlord'] = '0';
        }
        $Reply['toReplyList'] = D('Forum/ForumLzlReply')->where(array('to_f_reply_id' => $Reply['id'],'is_del'=>0))->limit(3)->select();
        $Reply['lzl_reply_count'] = D('Forum/ForumLzlReply')->where(array('to_f_reply_id'=>$Reply['id'],'is_del'=>0))->count();
        if (empty($Reply['toReplyList'])) {
            $Reply['toReplyList'] = array();
        }
        foreach ($Reply['toReplyList'] as $key=>&$val) {
            $val['user'] =  D('Api/User')->getUserSimpleInfo($val['uid']);
            if (in_array($val['uid'], $mid)) {
                $val['is_landlord'] = '1';
            } else {
                $val['is_landlord'] = '0';
            }
            $val['ctime'] =friendlyDate($val['ctime']);
        }
        unset($val);
        $Reply['create_time'] =friendlyDate($Reply['create_time']);
        $Reply['update_time'] =friendlyDate($Reply['update_time']);
        return $Reply;
    }


}