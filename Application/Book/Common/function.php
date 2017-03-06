<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-8-11
 * Time: 上午11:19
 * @author 郑钟良<zzl@ourstu.com>
 */

/**
 * 根据book表的role_ids字段判断用户有无阅读权限
 * @param $role_ids
 * @return int
 * @author 郑钟良<zzl@ourstu.com>
 */
function check_read_auth($role_ids){
    if($role_ids==''){
        return 2;//无需权限
    }
    if(!is_array($role_ids)){
        $role_ids=str_replace('[','',$role_ids);
        $role_ids=str_replace(']','',$role_ids);
        $role_ids=explode(',',$role_ids);
    }
    if(!count($role_ids)){
        return 2;//无需权限
    }

    $map['role_id']=array('in',$role_ids);
    $map['uid']=is_login();
    $map['status']=1;
    if(D('UserRole')->where($map)->count()){
        return 1;//有权限阅读
    }else{
        return 0;//无权限阅读
    }
}

/**
 * 根据book表的role_ids字段获取角色信息
 * @param $role_ids
 * @return mixed
 * @author 郑钟良<zzl@ourstu.com>
 */
function get_role_info($role_ids){
    if(!is_array($role_ids)){
        $role_ids=str_replace('[','',$role_ids);
        $role_ids=str_replace(']','',$role_ids);
        $role_ids=explode(',',$role_ids);
    }
    $map['id']=array('in',$role_ids);
    $map['status']=1;
    $list=D('Role')->where($map)->select();
    $info='';
    foreach($list as $val){
        $info.='['.$val['title'].']';
    }
    return $info;
}

/**
 * 根据book表的role_ids字段获取角色列表
 * @param $role_ids
 * @return mixed
 * @author 郑钟良<zzl@ourstu.com>
 */
function get_role_list($role_ids){
    if(!is_array($role_ids)){
        $role_ids=str_replace('[','',$role_ids);
        $role_ids=str_replace(']','',$role_ids);
        $role_ids=explode(',',$role_ids);
    }
    $map['id']=array('in',$role_ids);
    $map['status']=1;
    $list=D('Role')->where($map)->select();
    return $list;
}
