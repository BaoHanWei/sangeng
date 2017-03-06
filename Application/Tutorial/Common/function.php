<?php
function is_joined($tutorial_id)
{
    return D('Tutorial/TutorialMember')->getIsJoin(is_login(),$tutorial_id);
}

function get_tutorial_name($tutorial_id){
    $tutorial =  D('Tutorial')->getTutorial($tutorial_id);
    return $tutorial['title'];
}

function tutorial_is_exist($tutorial_id){
    $tutorial =  D('Tutorial')->getTutorial($tutorial_id);
    return $tutorial ? true : false;
}

function post_is_exist($post_id){
    $post =  D('TutorialPost')->getPost($post_id);
    return $post ? true : false;
}

function get_tutorial_type($tutorial_id){
    $tutorial =  D('Tutorial')->getTutorial($tutorial_id);
    return get_type_name($tutorial['type_id']);

}

function get_type_name($type_id){
    $type =  D('TutorialType')->getTutorialType($type_id);
    return $type['title'];

}

function get_post_category($id){
    $cate =  D('TutorialPostCategory')->getPostCategory($id);
    return $cate['title'];
}


function get_lou($k)
{
    $lou = array(
        2 => L('_SOFA_'),
        3 => L('_BENCH_'),
        4 => L('_FLOOR_')
    );
    !empty($lou[$k]) && $res = $lou[$k];
    empty($lou[$k]) && $res = $k . L('_LOU_');
    return $res;
}

function check_is_bookmark($post_id){
    return D('TutorialBookmark')->exists(is_login(), $post_id);
}


function get_tutorial_admin($tutorial_id){
    return get_admin_ids($tutorial_id,4,1);
}

function get_post_admin($post_id){
    return get_admin_ids($post_id,3,1);
}

function get_reply_admin($reply_id){
    return get_admin_ids($reply_id,2,1);
}


function get_lzl_admin($lzl_id){
    return get_admin_ids($lzl_id,1,1);
}


function get_tutorial_creator($tutorial_id){
    $tutorial = D('Tutorial')->getTutorial($tutorial_id);
    return $tutorial['uid'];

}



function filter_post_content($content){
    $content = op_h($content);
    $content = limit_picture_count($content);
    $content = op_h($content);
    return $content;
}

function limit_picture_count($content){
  return   D('ContentHandler')->limitPicture($content,modC('tutorial_POST_IMG_COUNT',10,'tutorial'));
}

/**
 * 权限检测时获取要排除的uids(群创建者、群组管理员、自己)
 * @param int $id
 * @param int $type
 * @param int $with_self 是否包含记录的uid
 * @return array|int|mixed
 * @author 郑钟良<zzl@ourstu.com>
 */
function get_admin_ids($id=0,$type=0,$with_self=1)
{
    $uid=0;
    switch($type){
        case '1'://根据贴子楼中楼回复id查询排除者id
            $lzl_reply=M('TutorialLzlReply')->find($id);
            $uid=$lzl_reply['uid'];
            $post_id=$lzl_reply['post_id'];
            break;
        case '2'://根据贴子回复id查询排除者id
            $reply = M('TutorialPostReply')->find($id);
            $uid=$reply['uid'];
            $post_id=$reply['post_id'];
            break;
        case '3'://根据贴子id查询排除者id
            $post_id=$id;
            break;
        case '4'://根据群组 id查询排除者id
            $tutorial_id=$id;
            break;
        default:
            return -1;
    }
    if($post_id){
        $post=M('TutorialPost')->where(array('id' => $post_id, 'status' => 1))->find();
        $tutorial_id=$post['tutorial_id'];
        if(!$uid){
            $uid=$post['uid'];
        }
    }
    $expect_ids=D('TutorialMember')->getTutorialAdmin($tutorial_id);
    $tutorial=M('Tutorial')->find($tutorial_id);
    if($uid&&$with_self&&$uid!=$tutorial['uid']){
        $expect_ids[]=$uid;
    }
    return $expect_ids;
}