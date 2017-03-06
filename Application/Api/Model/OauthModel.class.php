<?php


namespace Api\Model;

use Think\Model;

class OauthModel extends Model
{

    public function qq($data){
        if($data['ret'] == 0){
            $userInfo['type'] = 'QQ';
            $userInfo['name'] = $data['nickname'];
            $userInfo['nick'] = $data['nickname'];
            $userInfo['head'] = $data['figureurl_qq_2'];
            $userInfo['sex'] = $data['gender']=='男'? 0:1;
            return $userInfo;
        } else {
            return("获取腾讯QQ用户信息失败：{$data['msg']}");
        }
    }


    public function sina($data){
        if($data['error_code'] == 0){
            $userInfo['type'] = 'SINA';
            $userInfo['name'] = $data['name'];
            $userInfo['nick'] = $data['screen_name'];
            $userInfo['head'] = $data['avatar_large'];
            if($data['gender'] == 'm'){
                $userInfo['sex'] = 1;
            }else if($data['gender'] == 'f'){
                $userInfo['sex'] = 2;
            }else{
                $userInfo['sex'] = 0;
            }
            $userInfo['profile_url'] = 'http://weibo.com/'.$data['profile_url'];

            return $userInfo;
        } else {
            return("获取新浪微博用户信息失败：{$data['error']}");
        }
    }


    public function weixin($data){
        if($data['ret'] == 0){
            $userInfo['type'] = 'WEIXIN';
            $userInfo['name'] = $data['nickname'];
            $userInfo['nick'] = $data['nickname'];
            $userInfo['head'] = $data['headimgurl'];
            $userInfo['sex'] = $data['sex']=='1'? 1:2;
            return $userInfo;
        } else {
            return("获取微信用户信息失败：{$data['errmsg']}");
        }
    }


    public function getToken($data,$type){
        switch($type){
            case 'qq' :   $return = array('openid'=>$data['openid'],'access_token'=>$data['access_token']);
                break;
            case 'weixin' : $return = array('openid'=>$data['unionid']?$data['unionid']:$data['openid'],'access_token'=>$data['access_token']);
                break;
            case 'sina' :  $return = array('openid'=>$data['uid'],'access_token'=>$data['token']);
                break;
            default: $return ='';break;
        }

        return $return;


    }



}