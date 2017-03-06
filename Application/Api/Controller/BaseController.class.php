<?php


namespace Api\Controller;

use Think\Controller\RestController;
use Admin\Model\AuthRuleModel;

class BaseController extends RestController
{
    protected $appKey;
    protected $appVersion;
    protected $openId;
    protected $accessToken;

    public function __construct()
    {

        parent::__construct();
        header('Access-Control-Allow-Origin:*');
        $this->appKey = md5(base64_encode(modC('ACCESS_TOKEN','OpenSNS','Api')));
        $this->appVersion = modC('APP_VERSION','','Api');
        //todo 安全性验证

        $aToken = I_POST('access_token');
        $open_id = I_POST('open_id');
        
        //  var_dump($this->appKey);        
        // var_dump($aToken);
        // exit;
        
        if ($aToken != $this->appKey) {
            $this->apiReturn(4001, '无效的access_token');
        }
        if($this->appVersion){             //版本控制
            $aVersion = I_POST('version');
            $this->appVersion = (int)str_replace('.','', $this->appVersion);
            $aVersion = (int)str_replace('.','', $aVersion);
            if(!$aVersion || $aVersion < $this->appVersion ){
                $this->apiError( '不支持的版本号，请升级最新客户端');
            }
        }
        $this->accessToken = $aToken;

        $this->openId = $open_id;
    }


    public function getToken()
    {
        return md5(base64_encode('opensns'));
    }

    public function parseOpenId()
    {
        $str = api_decode($this->openId);
        $return = array();
        $array = explode('|', $str);
        $return['uid'] = $array[0];
        $return['username'] = $array[1];
        $return['last_login_time'] = $array[2];
        $return['role_id'] = $array[3];
        $return['audit'] = $array[4];
        return $return;
    }

    public function isLogin()
    {
        if (empty($this->openId)) {
            return 0;
        } else {
            $auth = $this->parseOpenId();
            return $auth['uid'];
        }
    }


    public function requireIsLogin(){
        $uid = $this->isLogin();
        if(!$uid){
            $this->apiError('请先登录！');
        }
        return $uid;
    }



    public  function ApiCheckAuth($rule ='',$except_uid =-1,$msg = ''){
        $type = AuthRuleModel::RULE_URL;
        $mid = $this->isLogin();
        if (is_administrator($mid)) {
            return true;//管理员允许访问任何页面
        }
        if ($except_uid != -1) {
            if (!is_array($except_uid)) {
                $except_uid = explode(',', $except_uid);
            }
            if (in_array($mid, $except_uid)) {
                return true;
            }
        }
        $rule = empty($rule) ? MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME : $rule;
        // 检测是否有该权限
        if (!M('auth_rule')->where(array('name' => $rule, 'status' => 1))->find()) {
            $this->apiError(empty($msg)?'您无操作权限。':$msg);
        }
        static $Auth = null;
        if (!$Auth) {
            $Auth = new \Think\Auth();
        }
        if (!$Auth->check($rule, $mid, $type)) {
            $this->apiError(empty($msg)?'您无操作权限。':$msg);
        }
        return true;
    }

}