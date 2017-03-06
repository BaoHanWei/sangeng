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

class UserModel extends Model
{
    public function getUserInfo($uid, $mid)
    {
        $titleModel = D('Ucenter/Title');
        $memberInfo = query_user(array('uid', 'title', 'nickname', 'email', 'mobile', 'rank_link', 'score1','score2','score3','score4', 'fans','sex', 'following', 'signature', 'pos_province', 'pos_city', 'pos_district'), $uid);
        $memberInfo['level'] = $titleModel->getCurrentTitleInfo($uid);
//        $province=$memberInfo['pos_province'];
//        $city=$memberInfo['pos_city'];
//        $district=$memberInfo['pos_district'];
//        $memberInfo['pos']=$this->getPos($province,$city,$district);
        $score_type = modC('SHOP_SCORE_TYPE', '1', 'Shop');
        $memberInfo['now_shop_score']=$memberInfo['score'.$score_type];
        $memberInfo['province'] = $this->getPos($memberInfo['pos_province']);
        $memberInfo['city'] = $this->getPos($memberInfo['pos_city']);
        $memberInfo['district'] = $this->getPos($memberInfo['pos_district']);
        $avatar = $this->getAvatar($uid);

        $userTagLinkModel = D('Ucenter/UserTagLink');
        $myTags = $userTagLinkModel->getUserTag($uid);
        if($mid==$uid){
            $memberInfo['is_self'] = 1;
        }else{
            $memberInfo['is_self'] = 0;
        }
        $userGroup = M('auth_group_access')->where(array('uid'=>$uid))->select();
        $user_group = array();
        if($userGroup){
            foreach($userGroup as $key=>$value){
                $user_group[$key] = $value['group_id'];
            }
        }
        $memberInfo['user_group'] = $user_group;
        $memberInfo['is_admin'] = is_administrator($uid);
        $memberInfo['message_unread_count']=D('Message')->where(array('to_uid'=>$uid,'is_read'=>0))->count();
        $memberInfo = array_merge($memberInfo, $avatar, array('tags' => $myTags ? $myTags : array()));
        //是否关注、是否被关注
        $memberInfo['expand_info'] = $this->getExpandInfo($uid, $memberInfo['expand_info']);
        $follow = D('Follow')->where(array('who_follow' => $mid, 'follow_who' => $uid))->find();
        $memberInfo['is_following'] = $follow ? 1 : 0;
        $follow = D('Follow')->where(array('who_follow' => $uid, 'follow_who' => $mid))->find();
        $memberInfo['is_followed'] = $follow ? 1 : 0;
        return $memberInfo;
    }

    public function getUserSimpleInfo($uid)
    {
        $memberInfo = query_user(array('uid', 'nickname','title','rank_link','avatar128'), $uid);
        $memberInfo['avatar128'] = $this->parseAvatar($memberInfo['avatar128']);
        return $memberInfo;
    }


    public function getUserCID($uids)
    {
        $CIDS= M('UserLocation')->where(array('uid'=>array('in',$uids)))->select();
        foreach($CIDS as &$b){
            $b=array('cid'=>$b['ClientID'],'token'=>$b['token']);
        }
        unset($b);
        return $CIDS;
    }

    public function getUserReduceInfo($uid)
    {
        $memberInfo = query_user(array('uid', 'nickname','title','avatar128'), $uid);
        $memberInfo['avatar128'] = $this->parseAvatar($memberInfo['avatar128']);
        return $memberInfo;
    }

    public function getInfo($uid)
    {
        $memberInfo = query_user(array('uid', 'nickname','avatar128'), $uid);
        $memberInfo['avatar128'] = $this->parseAvatar($memberInfo['avatar128']);
        return $memberInfo;
    }
    public function parseAvatar($avatar)
    {
        $avatar = strpos($avatar,'Uploads/Avatar')?$avatar:str_replace('Uploads/Avatar','',$avatar);
        return is_bool(strpos($avatar, 'http://')) ? 'http://' . str_replace('//', '/', $_SERVER['HTTP_HOST'] . '/' . $avatar) : $avatar;
    }

    /**获取头像老接口
     * @param $uid
     * @return array|null
     */
    public function getAvatar($uid)
    {
        $memberInfo = query_user(array('avatar256', 'avatar128', 'avatar64', 'avatar32', 'avatar512'), $uid);
        $memberInfo['avatar32'] = $this->parseAvatar($memberInfo['avatar32']);
        $memberInfo['avatar64'] = $this->parseAvatar($memberInfo['avatar64']);
        $memberInfo['avatar128'] = $this->parseAvatar($memberInfo['avatar128']);
        $memberInfo['avatar256'] = $this->parseAvatar($memberInfo['avatar256']);
        $memberInfo['avatar512'] = $this->parseAvatar($memberInfo['avatar512']);
        return $memberInfo;
    }

    /**获取头像新接口
     * @param $uid
     * @return \ArrayObject
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    public function getHead($uid)
    {
        $avatarArr = query_user(array( 'avatar128','avatar512'), $uid);
        $headArr['avatar128'] = $this->parseAvatar($avatarArr['avatar128']);
        $headArr['avatar512'] = $this->parseAvatar($avatarArr['avatar512']);
        return $headArr;
    }

    public function getExpandInfo($uid, $result)
    {

        $map['status'] = 1;
        $field_group = D('field_group')->where($map)->select();
        $field_group_ids = array_column($field_group, 'id');
        $map['profile_group_id'] = array('in', $field_group_ids);
        $fields_list = D('field_setting')->where($map)->getField('id,field_name,form_type,visiable');
        $fields_list = array_combine(array_column($fields_list, 'field_name'), $fields_list);
        $map_field['uid'] = $uid;
        foreach ($fields_list as $key => $val) {
            $map_field['field_id'] = $val['id'];
            $field_data = D('field')->where($map_field)->getField('field_data');
            if ($field_data == null || $field_data == '') {
                $fields_list[$key]['data'] = $field_data;
            } else {
                if ($val['form_type'] == "checkbox") {
                    $field_data = explode('|', $field_data);
                }
                $fields_list[$key]['data'] = $field_data;
            }
        }
        $result = $fields_list;
        return $result;

    }


    public function getPos($pos_code)
    {
        $pos = D('District')->where(array('id' => $pos_code))->find();
        $pos=$pos['name'];
        return $pos;

    }

    /**比getUserInfo少一些字段的个人信息获取函数
     * @param $uid      String|int 查询目标uid
     * @param $mUid     String|int 登录者ID
     * @return array|null
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    public function getNormUserInfo($uid,$mUid=0){
        $titleModel = D('Ucenter/Title');
        $memberInfo = query_user(array('uid', 'title', 'nickname', 'email', 'mobile', 'rank_link', 'fans','sex', 'following', 'signature', 'pos_province', 'pos_city', 'pos_district'), $uid);
        $memberInfo['level'] = $titleModel->getCurrentTitleInfo($uid);
        $memberInfo['province'] = $this->getPos($memberInfo['pos_province']);
        $memberInfo['city'] = $this->getPos($memberInfo['pos_city']);
        $memberInfo['district'] = $this->getPos($memberInfo['pos_district']);
        $avatar = $this->getAvatar($uid);
        $userGroup = M('auth_group_access')->where(array('uid'=>$uid))->select();
        $user_group = array();
        if($userGroup){
            foreach($userGroup as $key=>$value){
                $user_group[$key] = $value['group_id'];
            }
        }
        $memberInfo['user_group'] = $user_group;
        $memberInfo['is_admin'] = is_administrator($uid);
        $memberInfo = array_merge($memberInfo, $avatar);
        if($mUid){
            //是否关注、是否被关注
            $follow = D('Follow')->where(array('who_follow' => $mUid, 'follow_who' => $uid))->find();
            $memberInfo['is_following'] = $follow ? 1 : 0;
            $follow = D('Follow')->where(array('who_follow' => $uid, 'follow_who' => $mUid))->find();
            $memberInfo['is_followed'] = $follow ? 1 : 0;
            if($mUid==$uid){
                $memberInfo['is_self'] = 1;
            }else{
                $memberInfo['is_self'] = 0;
            }
        }
        return $memberInfo;
    }

    /**获取好友信息
     * @param $uid      String|int 查询目标uid
     * @param $mUid     String|int 登录者ID
     * @return array|null
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    public function getFriendUserInfo($uid,$mUid=0){
        $titleModel = D('Ucenter/Title');
        $memberInfo = query_user(array('uid', 'title', 'nickname', 'email', 'rank_link', 'fans','sex', 'following', 'signature', 'pos_province', 'pos_city', 'pos_district'), $uid);
        $memberInfo['level'] = $titleModel->getCurrentTitleInfo($uid);
        $avatarArr = $this->getHead($uid);
        $userGroup = M('auth_group_access')->where(array('uid'=>$uid))->select();
        $user_group = array();
        if($userGroup){
            foreach($userGroup as $key=>$value){
                $user_group[$key] = $value['group_id'];
            }
        }
        $memberInfo['user_group'] = $user_group;
        $memberInfo['is_admin'] = is_administrator($uid);
        $memberInfo = array_merge($memberInfo, $avatarArr);
        return $memberInfo;
    }


} 