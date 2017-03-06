<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-29
 * Time: 下午5:22
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Api\Model;

use Think\Model;

class AccountModel extends Model
{
    public function login($uid,$pos){

        $time = time();
        $user = D('Member')->field(true)->find($uid);
        if (!$user['last_login_role']) {
            $user['last_login_role'] = $user['show_role'];
        }

        /* 更新登录信息 */
        $data = array(
            'uid' => $user['uid'],
            'login' => array('exp', '`login`+1'),
            'last_login_time' => $time,
            'last_login_ip' => get_client_ip(1),
            'last_login_role' => $user['last_login_role'],
        );
        $re['ClientID']=$pos['cid'];
        $re['token']=$pos['token'];
        $re['uid']=$user['uid'];
        if(M('UserLocation')->where(array('uid'=>$user['uid']))->find()){
            M('UserLocation')->where(array('uid'=>$user['uid']))->save($re);
        }else{
            M('UserLocation')->add($re);
        }
        D('Member')->save($data);

        //判断角色用户是否审核

        $map['uid'] = $user['uid'];
        $map['role_id'] = $user['last_login_role'];
        $audit = D('UserRole')->where($map)->getField('status');
        //判断角色用户是否审核 end

        /*记录登录SESSION和COOKIES*/
        $auth = array(
            'uid' => $user['uid'],
            'username' => get_username($user['uid']),
            'last_login_time' => $user['last_login_time'],
            'role_id' => $user['last_login_role'],
            'audit' => $audit,
        );
        $return['open_id'] = api_encode(implode('|', $auth));
        $return['auth'] = $auth;
        $return['timestamp'] = $time;
        return  $return;
    }
} 