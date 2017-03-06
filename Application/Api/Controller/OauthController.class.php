<?php


namespace Api\Controller;


class OauthController extends BaseController
{

    private $authResult = array();
    private $type = '';
    private $pushInfo = array();

    public function __construct()
    {
        parent::__construct();
        $aType = I_POST('type', 'text');
        $this->type = $this->getType($aType);

        $aAuthResult = I_POST('auth_result', 'text');
        $aAuthResult = json_decode($aAuthResult,true);
        $this->authResult =  D('Api/Oauth')->getToken($aAuthResult,$this->type);
        $this->pushInfo['cid'] = I_POST('cid','text');
        $this->pushInfo['token'] = I_POST('token','text');
    }

    /**验证用户的同步登陆信息
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    public function oauth(){
        $map = array('type_uid' => $this->authResult['openid'], 'type' => $this->type);
        $uid = M('sync_login')->where($map)->getField('uid');
        if($uid){
            $this->loginWithoutpwd($uid);
        }else{
            $this->apiError('没有同步信息',202);
        }
    }

    /**获取用户账号绑定信息
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    public function getSync(){
        $mUid = $this->requireIsLogin();
        $map = array('uid'=>$mUid,'status'=>1);
        $result = M('sync_login')->where($map)->select();
        if($result){
            $this->apiSuccess('返回成功',$result);
        }else{
            $this->apiError('返回失败');
        }
    }

    /**绑定/解除用户同步绑定信息
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    public function setSync(){
        $mUid = $this->requireIsLogin();

        $aBind = I_POST('bind','text');
        $syncMod = M('sync_login');
        if($aBind == 'bind'){
            $map = array('type'=> $this->type,'type_uid'=> $this->authResult['openid']);
            $syncInfo = $syncMod->where($map)->find();
            if(!$syncInfo){
                $this->authResult['is_sync'] = 1;
                $result = $this->addSyncLoginData($mUid);
                if ($result) {
                    $this->apiSuccess('返回成功',$result);
                } else {
                    $this->apiError('绑定失败');
                }
            }else{
                $this->apiError('已被绑定');
            }
        }elseif($aBind == 'unbind') {
            $map = array('uid' => $mUid, 'type' => $this->type);
            $result = $syncMod->where($map)->delete();
            if ($result) {
                $this->apiSuccess('返回成功');
            } else {
                $this->apiError('返回失败');
            }
        }else{
            $this->apiError('参数错误');
        }
    }

    /**同步绑定本地账号
     * @author ??
     */
    public function sync()
    {

        $aUserInfo = I_POST('user_info', 'text');
        $aBindInfo = I_POST('bind_info', 'text');
        $type = $this->type;
        $uid = null;
        $aUserInfo = json_decode($aUserInfo,true);

        $aBindInfo = json_decode($aBindInfo,true);
        $user_info = D('Api/Oauth')->$type($aUserInfo);

        $map = array('type_uid' => $this->authResult['openid'], 'type' => $type);
        $uid = D('sync_login')->where($map)->getField('uid');

        if (empty($aBindInfo)) {
            //不绑定帐号
            if ($uid) {
                //同步表中存在数据
                $user = UCenterMember()->where(array('id' => $uid))->count();
                if (empty($user)) {
                    D('sync_login')->where($map)->delete();
                    $uid = $this->addData($user_info);
                }
            } else {
                $uid = $this->addData($user_info);
            }

        } else {
            //绑定帐号
            if($uid){
                //兼容以前的同步登陆，会把以前保存的用户数据删掉，使用新的绑定账号数据
                M('Member')->where(array('id' => $uid))->delete();
                M('sync_login')->where($map)->delete();
            }

            $aUsername = I_POST('username','text');
            $aPassword = I_POST('password','text');
            $this->authResult['is_sync'] = 1;
            check_username($aUsername, $email, $mobile, $aUnType);
            $lgUid = UCenterMember()->login($aUsername, $aPassword, $aUnType);
            if($lgUid > 0){
                $uid = $lgUid;
                $this->addSyncLoginData($uid);
            }else{
                $this->apiError('账号或者密码错误');
            }
        }

        $this->loginWithoutpwd($uid);
    }


    /**
     * loginWithoutpwd  使用uid直接登陆，不使用帐号密码
     * @param $uid
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    private function loginWithoutpwd($uid)
    {
        if (0 < $uid) { //UC登陆成功
            /* 登陆用户 */
            if ($return = D('Api/Account')->login($uid,$this->pushInfo)) { //登陆用户

                $this->apiSuccess($return, D('Api/User')->getUserInfo($uid));
            } else {
                $this->apiError('登录失败');
            }
        }
    }

    private function getType($type)
    {
        switch ($type) {
            case 'qq';
                $rs = 'qq';
                break;
            case 'weixin';
                $rs = 'weixin';
                break;
            case 'sina';
                $rs = 'sina';
                break;
            case 'sinaweibo';
                $rs = 'sina';
                break;
            default:
                $rs = '';
        }
        return $rs;
    }


    /**
     * addSyncLoginData  增加sync_login表中数据
     * @param $uid
     * @return mixed
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    private function addSyncLoginData($uid)
    {
        $data['uid'] = $uid;
        $data['type_uid'] = $this->authResult['openid'];
        $data['oauth_token'] = $this->authResult['access_token'];
        $data['oauth_token_secret'] = $this->authResult['openid'];
        $data['type'] = $this->type;
        $data['status'] = 1;
        $data['is_sync'] = $this->authResult['is_sync']?1:0;
        $syncModel = D('sync_login');

        if (!($syncModel->where($data)->count())) {
            $id = $syncModel->add($data);
            $data['id'] = $id;
            return $data;
        }
        return true;
    }


    private function addData($user_info)
    {
        $ucenterModer = UCenterMember();
        $uid = $ucenterModer->addSyncData();
        D('Member')->addSyncData($uid, $user_info);
        $ucenterModer->initRoleUser(1, $uid); //初始化角色用户
        // 记录数据到sync_login表中
        $this->addSyncLoginData($uid);
        $this->saveAvatar($user_info['head'], $uid);
        return $uid;
    }


    /**
     * saveAvatar  保存头像到本地
     * @param $url
     * @param $oid
     * @param $uid
     * @param $type
     * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
     */
    private function saveAvatar($url, $uid)
    {
        $driver = modC('PICTURE_UPLOAD_DRIVER', 'local', 'config');

        if ($driver == 'local') {
            mkdir('./Uploads/Avatar/' . $uid, 0777, true);
            $img = file_get_contents($url);
            $filename = './Uploads/Avatar/' . $uid . '/crop.jpg';
            file_put_contents($filename, $img);
            $data['path'] = '/' . $uid . '/crop.jpg';
        } else {
            $name = get_addon_class($driver);
            $class = new $name();
            $path = '/Uploads/Avatar/' . $uid . '/crop.jpg';
            $res = $class->uploadRemote($url, 'Uploads/Avatar/' . $uid . '/crop.jpg');
            if ($res !== false) {
                $data['path'] = $res;
            }
        }
        $data['uid'] = $uid;
        $data['create_time'] = time();
        $data['status'] = 1;
        $data['is_temp'] = 0;
        $data['driver'] = $driver;
        D('avatar')->add($data);
    }


    ///-------------------------------------------


}