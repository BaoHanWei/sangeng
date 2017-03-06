<?php


namespace Api\Controller;


use Paper\Model\PaperCategoryModel;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function info()
    {
        $mid = $this->isLogin();
        $aId = I('get.id');
        if (!D('Member')->where(array('status' => 1,'id'=>$aId))->find()) {
            $this->apiError('查无此人');
        }
        $info = D('User')->getUserInfo($aId, $mid);

        $this->apiReturn($info);
    }

    /**
     * 获取用户信息(直接在数据库查找的数据)
     * 主要用户获取即时变动数据
     */
    public function userData(){
        $uid = I_POST('id');
        $result = M('Member')->where(array('status' => 1,'uid'=>$uid))->find();
        if($result){
            $this->apiSuccess('返回成功',$result);
        }else{
            $this->apiError('不存在的用户');
        }
    }

    /**
     * 获取积分类型
     */
    public function scoreType(){
        $result = M('ucenter_score_type')->where(array('status' => 1))->select();
        if($result){
            $this->apiSuccess('返回成功',$result);
        }else{
            $this->apiError('不存在的用户');
        }
    }

    public function UsersInfo()
    {

        $aIds= I_POST('id');
        $aIds=explode(',',$aIds);
        foreach($aIds as $d){
            $user[] = D('Api/User')->getInfo($d);
        }


        $this->apiReturn($user);
    }


    public function uploadAvatar()
    {
        $uid = $this->isLogin();
        $aData = I_POST('data');
        $aExt = I_POST('ext');

        if ($aData == '' || $aData == 'undefined') {
            $this->apiError('参数错误');
        }
        if (!$uid) {
            $this->apiError('open_id有误');
        }
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $aData, $result)) {
            $base64_body = substr(strstr($aData, ','), 1);
            empty($aExt) && $aExt = $result[2];
        } else {
            $base64_body = $aData;
        }

        if(!in_array($aExt,array('jpg','gif','png','jpeg'))){
            $this->ajaxReturn(array('status'=>0,'info'=>'非法操作'));
        }
        $hasPhp=base64_decode($base64_body);
        if (strpos($hasPhp, '<?php') !==false) {
            $this->ajaxReturn(array('status' => 0, 'info' => '非法操作'));
        }

        //不存在则上传并返回信息
        $driver = modC('PICTURE_UPLOAD_DRIVER','local','config');
        $driver = check_driver_is_exist($driver);
        $pictureModel = M('Avatar');
        $saveName = uniqid();
        $savePath = '/Uploads/Avatar';
        $path = '/' . $uid . '/' . $saveName . '.' . $aExt;

        if($driver == 'local'){
            //本地上传
            del_dir('.' . $savePath . '/' . $uid);  //删除文件夹下原来的文件
            mkdir('.' . $savePath . '/' . $uid . '/', 0777);
            $data = base64_decode($base64_body);
            $rs = file_put_contents('.' . $savePath . $path, $data);
        }else{
            $rs = false;
            //使用云存储
            $name = get_addon_class($driver);
            if (class_exists($name)) {
                $class = new $name();
                if (method_exists($class, 'uploadBase64')) {
                    $path = $class->uploadBase64($base64_body,$path);
                    $rs = true;
                }
            }
        }

        if ($rs) {
            $pic['uid'] = $uid;
            $pic['type'] = $driver;
            $pic['path'] = $path;
            $pic['status'] = 1;
            $pic['create_time'] = time();
            if (!$pictureModel->where(array('uid' => $uid))->save($pic)) {
                $pictureModel->add($pic);
            }
            clean_query_user_cache($uid,'avatars');
            $this->apiSuccess('上传头像成功',D('User')->getAvatar($uid));
        } else {
            $this->apiError('上传头像失败');
        }
    }

    public function FollowFansList()
    {
        $uid = I('get.id', '', 'intval');
        $type = I_POST('type', 'intval');
        $aPage = I_POST('page', 'intval');
        $aCount = 10;
        if (empty($aPage)) {
            $aPage = 1;
        }
        $uid = isset($uid) ? $uid : $uid;
        $list = null;
        //我的粉丝
        if ($type == 1) {
            $map['follow_who'] = $uid;
            $list = D('Follow')->where($map)->field('who_follow')->order('create_time desc')->page($aPage, $aCount)->select();
            if (!$list) {
                $this->apiError('没有数据');
            }
            foreach ($list as $key => &$user) {
                $user = D('Api/User')->getUserInfo($user['who_follow'],$uid);
                if ($user['uid'] == $uid) {
                    unset($list[$key]);
                }
            }
            unset($user);
        }
        if ($type == 2) {
            //我关注的
            $map_follow['who_follow'] = $uid;
            $list = D('Follow')->where($map_follow)->field('follow_who')->order('create_time desc')->page($aPage, $aCount)->select();
            if (!$list) {
                $this->apiError('没有数据');
            }
            foreach ($list as &$user) {
                $user = D('Api/User')->getUserInfo($user['follow_who'],$uid);
            }
            unset($user);
        }
        //我的好友（互相关注的用户判定为好友）
        if ($type == 3) {
            $map['follow_who'] = $uid;
            $list = D('Follow')->where($map)->field('who_follow')->order('create_time desc')->select();
            foreach ($list as $key => &$v) {
                $v = D('Api/User')->getFriendUserInfo($v['who_follow'],$uid);
                if ($v['is_following'] != $v['is_followed']) {
                    unset($list[$key]);
                }
            }
            $all_topic = $this->arraySortByKey($list, 'id', false);
            $list = array_slice($all_topic, ($aPage - 1) * $aCount, 10);
        }
        if($list){
            $this->apiSuccess('返回成功', $list);
        }else{
            $this->apiError('获取数据失败');
        }
    }

    public function doFollow()
    {
        $mid = $this->requireIsLogin();
        $aFollowWho = I_POST('follow_who', 'intval');
        if (!$mid) {
            $this->apiError('需要登录');
        }
        if ($aFollowWho == $mid) {
            $this->apiError('不能关注自己');
        }
        $FollowWho = D('Member')->where(array('uid' => $aFollowWho))->find();
        if (!$FollowWho) {
            $this->apiError('没有该用户');
        }
        $result = D('Follow')->where(array('follow_who' => $aFollowWho, 'who_follow' => $mid))->find();
        if ($result) {
            $this->apiError('该用户已被您关注');
        }
        $data['follow_who'] = $aFollowWho;
        $data['who_follow'] = $mid;
        $data['create_time'] = time();
        $result = D('Follow')->add($data);

        if ($result) {
            $result = D('Follow')->find($result);
            $this->apiSuccess('关注成功', $result);
        } else {
            $this->apiError('关注失败');
        }
    }

    public function endFollow()
    {
        $mid = $this->requireIsLogin();
        $aFollowWho = I_POST('follow_who', 'intval');
        if (!D('Follow')->where(array('follow_who' => $aFollowWho, 'who_follow' => $mid))->find()) {
            $this->apiError('该用户您并未关注');
        }
        $result = D('Follow')->where(array('follow_who' => $aFollowWho, 'who_follow' => $mid))->delete();
        if ($result) {
            $this->apiSuccess('取消关注成功');
        }
    }


    public function setField()
    {
        $mid = $this->requireIsLogin();
        //获取用户编号
        $uid = $mid;
        //将需要修改的字段填入数组
        $aField = I_POST('name','text');
        $aFieldDate = I_POST('data','text');
        $fields = array();
        $res=D('Field/FieldSetting')->where(array('field_name'=>$aField))->find();
        if ($aField !== null) $fields['id'] = $res['id'];
        if(D('field')->where(array('field_id' => $fields['id'], 'uid' => $uid))->getField('field_data')!==null){
            $data = array('field_data' => $aFieldDate, 'changeTime' => time());
            $setFields = D('field')->where(array('field_id' => $fields['id'], 'uid' => $uid))->save($data);
        }else{
            $role= M('UserRole')->where(array('uid'=>$mid))->getField('role_id');
            $data = array('field_data' => $aFieldDate, 'changeTime' => time(),'role_id'=>$role, 'createTime' => time(),'field_id' => $fields['id'], 'uid' => $uid);
            $setFields = D('field')->add($data);
        }
        if (!$setFields) {
            $this->apiError('修改失败');
        }
        $this->apiSuccess('修改成功');
    }


    /*修改用户基本信息*/

    public function setProfile()
    {
        $mid = $this->requireIsLogin();

        //获取用户编号
        $aSex = I_POST('sex','intval');

        $aSignature = I_POST('signature','text');
        $aNickname = I_POST('nickname','text');
        $aProvince = I_POST('province','text');
        $aCitye = I_POST('city','text');
        $aDistrict = I_POST('district','text');
        $uid = $mid;
        //将需要修改的字段填入数组
        $fields = array();
        if (!empty($aSignature)){$fields['signature'] = $aSignature;}
        if (!empty($aNickname )){
            $fields['nickname'] = $aNickname;
        }

        if (empty($aSex)){
            $fields['sex'] = 0;
        }else{
            $fields['sex'] = $aSex;
        }
        if (!empty($aProvince)){
            $aPro_code = D('District')->where(array('name' => $aProvince))->find();
            $fields['pos_province'] = $aPro_code['id'];
        }
        if (!empty($aCitye)){
            $aCitye_code = D('District')->where(array('name' => $aCitye))->find();
            $fields['pos_city'] = $aCitye_code['id'];
        }
        if (!empty($aDistrict)){
            $aDistrict_code = D('District')->where(array('name' => $aDistrict))->find();
            $fields['pos_district'] = $aDistrict_code['id'];
        }
        foreach ($fields as $key => $field) {
            clean_query_user_cache($uid, $key); //删除缓存
        }
        //将字段分割成两部分，一部分属于ucenter，一部分属于home
        $split = $this->splitUserFields($fields);
        $home = $split['home'];
        $ucenter = $split['ucenter'];
        //分别将数据保存到不同的数据表中
        if ($home) {
            $home['uid'] = $uid;
            $result = D('Member')->where(array('uid' => $home['uid']))->save($home);
            if (!$result) {
                $this->apiError('设置失败，请检查输入格式!');
            }
        }
        if ($ucenter) {
            $ucenter['id'] = $uid;
            $result = D('UcenterMember')->where(array('id' => $ucenter['id']))->save($ucenter);
            if (!$result) {
                $this->apiError('设置失败，请检查输入格式!');
            }
        }
        //返回成功信息
        $this->apiSuccess("设置成功!");
    }

    /*获取用户扩展信息*/
    public function getExpandInfo($uid = null)
    {
        $profile_group_list = $this->_profile_group_list($uid);
        if ($profile_group_list) {
            $info_list = $this->_info_list($profile_group_list[0]['id'], $uid);
            $this->apiSuccess('返回成功', $info_list);
            $this->apiSuccess('返回成功', $profile_group_list[0]['id']);
            return $profile_group_list;
        }
        foreach ($profile_group_list as &$v) {
            $v['fields'] = $this->_getExpandInfo($v['id']);
        }
        return $profile_group_list;
    }


    /*扩展信息分组列表*/
    public function _profile_group_list($uid = null)
    {
        $profile_group_list = array();
        $fields_list = $this->getRoleFieldIds($uid);
        if ($fields_list) {
            $fields_group_ids = D('FieldSetting')->where(array('id' => array('in', $fields_list), 'status' => '1'))->field('profile_group_id')->select();
            if ($fields_group_ids) {
                $fields_group_ids = array_unique(array_column($fields_group_ids, 'profile_group_id'));
                $map['id'] = array('in', $fields_group_ids);

                if (isset($uid) && $uid != $this->isLogin()) {
                    $map['visiable'] = 1;
                }
                $map['status'] = 1;
                $profile_group_list = D('field_group')->where($map)->order('sort asc')->select();
            }
        }
        return $profile_group_list;
    }

    /*分组下的字段信息及相应内容*/
    public function _info_list($id = null, $uid = null)
    {
        $fields_list = $this->getRoleFieldIds($uid);
        $info_list = null;

        if (isset($uid) && $uid != $this->isLogin()) {
            //查看别人的扩展信息
            $field_setting_list = D('field_setting')->where(array('profile_group_id' => $id, 'status' => '1', 'visiable' => '1', 'id' => array('in', $fields_list)))->order('sort asc')->select();

            if (!$field_setting_list) {
                return null;
            }
            $map['uid'] = $uid;
        } else if ($this->isLogin()) {
            $field_setting_list = D('field_setting')->where(array('profile_group_id' => $id, 'status' => '1', 'id' => array('in', $fields_list)))->order('sort asc')->select();

            if (!$field_setting_list) {
                return null;
            }
            $map['uid'] =$this->isLogin();
        } else {
            $this->apiError('请先登录！');
        }
        foreach ($field_setting_list as $val) {
            $map['field_id'] = $val['id'];
            $field = D('field')->where($map)->find();
            $val['field_content'] = $field;
            $info_list[$val['id']] = $val;
            unset($map['field_id']);
        }

        return $info_list;
    }

    private function getRoleFieldIds($uid = null)
    {
        $role_id = get_role_id($uid);
        $fields_list = S('Role_Expend_Info_' . $role_id);
        if (!$fields_list) {
            $map_role_config = getRoleConfigMap('expend_field', $role_id);
            $fields_list = D('RoleConfig')->where($map_role_config)->getField('value');
            if ($fields_list) {
                $fields_list = explode(',', $fields_list);
                S('Role_Expend_Info_' . $role_id, $fields_list, 600);
            }
        }
        return $fields_list;
    }


    /*显示某一扩展分组信息*/
    public function _getExpandInfo($profile_group_id = null)
    {
        $res = D('field_group')->where(array('id' => $profile_group_id, 'status' => '1'))->find();
        if (!$res) {
            return array();
        }
        $info_list = $this->_info_list($profile_group_id);

        return $info_list;
    }


    /**
     * 根据数组中的某个键值大小进行排序，仅支持二维数组
     * @param array $array 排序数组
     * @param string $key 键值
     * @param bool $asc 默认正序
     * @return array 排序后数组
     */
    public function arraySortByKey(array $array, $key, $asc = true)
    {
        $result = array();
        // 整理出准备排序的数组
        foreach ($array as $k => &$v) {
            $values[$k] = isset($v[$key]) ? $v[$key] : '';
        }
        unset($v);
        // 对需要排序键值进行排序
        $asc ? asort($values) : arsort($values);
        // 重新排列原有数组
        foreach ($values as $k => $v) {
            $result[$k] = $array[$k];
        }

        return $result;
    }


    public function array_gets($array, $fields)
    {
        $result = array();
        foreach ($fields as $e) {
            if (array_key_exists($e, $array)) {
                $result[$e] = $array[$e];
            }
        }
        return $result;
    }

    public function splitUserFields($data)
    {
        $result = array();
        $home_fields = array('nickname', 'sex', 'name', 'signature','pos_province','pos_city','pos_district');
        $result['home'] = $this->array_gets($data, $home_fields);
        $ucenter_fields = array('email', 'password');
        $result['ucenter'] = $this->array_gets($data, $ucenter_fields);
        return $result;
    }
}