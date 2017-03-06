<?php


namespace Api\Controller;


class CheckController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }


    public function checking(){
        $aAction = I_POST('action');
        if(method_exists($this,$aAction) && !is_bool(strpos($aAction,'check'))){
            $this->$aAction();
        }else{
            $this->apiError($aAction.'方法不存在');
        }

    }


    public function checkAccount(){
        $aAccount = I('post.account', '', 'op_t');
        $aType = I('post.type', '', 'op_t');
        if (empty($aAccount) || empty($aType)) {
            $this->apiError('参数错误！');
        }

        check_username($aAccount, $email, $mobile, $aUnType);
        $mUcenter = UCenterMember();
        switch ($aType) {
            case 'username':
                empty($aAccount) && $this->apiError('用户名格式不正确！');
                $length = mb_strlen($aAccount, 'utf-8'); // 当前数据长度
                if ($length < modC('USERNAME_MIN_LENGTH',2,'USERCONFIG') || $length > modC('USERNAME_MAX_LENGTH',32,'USERCONFIG')) {
                    $this->apiError('用户名长度在'.modC('USERNAME_MIN_LENGTH',2,'USERCONFIG').'-'.modC('USERNAME_MAX_LENGTH',32,'USERCONFIG').'之间');
                }


                $id = $mUcenter->where(array('username' => $aAccount))->getField('id');
                if ($id) {
                    $this->apiError('该用户名已经存在！');
                }
                preg_match("/^[a-zA-Z0-9_]{".modC('USERNAME_MIN_LENGTH',2,'USERCONFIG').",".modC('USERNAME_MAX_LENGTH',32,'USERCONFIG')."}$/", $aAccount, $result);
                if (!$result) {
                    $this->apiError('只允许字母和数字和下划线！');
                }
                break;
            case 'email':
                empty($email) && $this->apiError('邮箱格式不正确！');
                $length = mb_strlen($email, 'utf-8'); // 当前数据长度
                if ($length < 4 || $length > 32) {
                    $this->apiError('邮箱长度在4-32之间');
                }

                $id = $mUcenter->where(array('email' => $email))->getField('id');
                if ($id) {
                    $this->apiError('该邮箱已经存在！');
                }
                break;
            case 'mobile':
                empty($mobile) && $this->apiError('手机格式不正确！');
                $id = $mUcenter->where(array('mobile' => $mobile))->getField('id');
                if ($id) {
                    $this->apiError('该手机号已经存在！');
                }
                break;
        }
        $this->apiSuccess('验证成功');
    }




    public function checkNickname()
    {
        $aNickname = I_POST('nickname');

        if (empty($aNickname)) {
            $this->apiError('参数错误！');
        }

        $length = mb_strlen($aNickname, 'utf-8'); // 当前数据长度
        if ($length < modC('NICKNAME_MIN_LENGTH',2,'USERCONFIG') || $length > modC('NICKNAME_MAX_LENGTH',32,'USERCONFIG')) {
            $this->apiError('昵称长度在'.modC('NICKNAME_MIN_LENGTH',2,'USERCONFIG').'-'.modC('NICKNAME_MAX_LENGTH',32,'USERCONFIG').'之间');
        }

        $memberModel = D('member');
        $uid = $memberModel->where(array('nickname' => $aNickname))->getField('uid');
        if ($uid) {
            $this->apiError('该昵称已经存在！');
        }
        preg_match('/^(?!_|\s\')[A-Za-z0-9_\x80-\xff\s\']+$/', $aNickname, $result);
        if (!$result) {
            $this->apiError('只允许中文、字母和数字和下划线！');
        }

        $this->apiSuccess('验证成功');
    }




}