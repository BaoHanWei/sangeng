<?php


namespace Api\Controller;


class PeopleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    /***获取人群显示角色选项卡列表
     * @author:wsy
     */
    public function peopleType()
    {
        $role_tab = modC('SHOW_ROLE_TAB', '', 'People');
        if ($role_tab) {
            $role_list = json_decode($role_tab, true);
            $result = array();
            foreach($role_list as $val){
                if($val['data-id'] == 'enable'){
                    $result = $val['items'];
                }
            }
            unset($val);
            $this->apiSuccess('返回成功', $result);
        } else {
            $this->apiError('角色功能未开启');
        }
    }

    /**获取指定角色组用户信息
     * @modify 胡佳雨 <hjy@ourstu.com>.
     */
    public function peopleList()
    {
        $mid = $this->isLogin();
        $map = $this->setMap();
        $aRole = I_POST('role', 'intval');
        $aPage = I_POST('page', 'intval');
        $aCount = 10;
        if (empty($aPage)) {
            $aPage = 1;
        }
        if (!empty($aRole)) {
            $map['show_role'] = $aRole;
        }
//      $role_tab=modC('SHOW_ROLE_TAB','','People');
        $role_list = D('Role')->where(array('status' => 1))->field('id')->select();
        $role_list = (array)getSubByKey($role_list, 'id');
        if ($aRole && !in_array($aRole, $role_list)) {
            $this->apiError('角色分组错误');
        }
        $map['status'] = 1;
        $map['last_login_time'] = array('neq', 0);
        $peoples = D('Member')->where($map)->order('last_login_time desc')->page($aPage, $aCount)->field('uid')->select();

        $userConfigModel = D('Ucenter/UserConfig');
        foreach ($peoples as $key => &$v) {
            $v['user'] = D('Api/User')->getNormUserInfo($v['uid'], $mid);
            if($v['user']['is_self'] == 1){
                unset($peoples[$key]);
                continue;
            }
            //获取用户封面id
            $where = getUserConfigMap('user_cover', '', $v['uid']);
            $where['role_id'] = 0;
            $cover = $userConfigModel->where($where)->find();
            $v['cover_id'] = $cover['value'];
            $v['cover_path'] = render_picture_path_without_root(getThumbImageById($cover['value'], 273, 80));
        }
        unset($v);
        $this->apiSuccess('返回成功', $peoples);
    }

    private function setMap()
    {
        $nickname = I_POST('keywords', 'op_t');
        $map = array();
        $map['status'] = 1;
        $map['last_login_time'] = array('neq', 0);

        if ($nickname != '') {
            !isset($_GET['keywords']) && $_GET['keywords'] = $_POST['keywords'];
            $map['nickname'] = array('like', '%' . $nickname . '%');
            unset($v);
        }
        return $map;
    }


    public function nearbyPeople()
    {

//deg2rad — 将角度转换为弧度
//rad2deg() - 将弧度数转换为相应的角度数
        $mid = $this->requireIsLogin();
        $lat = I_POST('lat', 'text');
        $lng = I_POST('lng', 'text');
        $user = query_user(array('lat', 'lng', 'last_confirm_ time'), $mid);
        $num = 10;
        $page = I_POST('page', 'intval');
        if (empty($page)) {
            $page = 1;
        }
//        dump($user['last_confirm_ time'] < time());
        if ($user['last_confirm_ time'] < time()) {
            $data['lat'] = $lat;
            $data['uid'] = $mid;
            $data['lng'] = $lng;
            $data['last_confirm_time'] = time();
            if (D('User/UserLocation')->where(array('uid' => $mid))->find()) {
                M('UserLocation')->where(array('uid' => $mid))->save($data);
            } else {
                M('UserLocation')->add($data);
            }

        }
        $distance = I_POST('distance', 'text');
        if (empty($distance)) {
            $distance = 1;
        }

        //单位是KM 2表示为2千米距离
        $radius = 6371.393; //代为是KM地球半径
        $dlng = rad2deg(2 * asin(sin($distance / (2 * $radius)) / cos($lat)));
        $dlat = rad2deg($distance * 10 / $radius);//计算实际搜索的四边形的四个边界范围
        $lng_left = round($lng - $dlng, 6);
        $lng_right = round($lng + $dlng, 6);
        $lat_top = round($lat + $dlat, 6);
        $lat_bottom = round($lat - $dlat, 6);
        //  将上述获取的边界范围带入到sql语句中用于查询：
        $mo = M('UserLocation')->where(array("lng>={$lng_left} and lng<={$lng_right} and lat>={$lat_bottom} and lat<={$lat_top}"))->select();

        if ($mo) {
            $array_asc = array();
            foreach ($mo as $key => $value) {
                $array_asc[$key] = $value;
                $array_asc[$key]['distance'] = ($this->GetDistance($value['lat'], $value['lng'], $lat, $lng)) * 1000;
                $array_asc[$key]['user'] = D('Api/User')->getUserReduceInfo($value['uid']);
            }
            $user = array();
            foreach ($array_asc as $key => $v) {
//                $name=D('member')->where(array('uid'=>$value['id']))->find();
//                $info[]=$name['nickname'].' &nbsp;' . $value['lng'] . ' , &nbsp;' . $value['lat'].'距离： ' . $value['distance'];
//                dump($v['user']);
//                dump($v);
//                dump($value['user']);
//                if($limit){
//                    if($value['distance']>=$limit){
//                        unset($array_asc[$key]);
//                    }
//                }
                $user[$key]['user'] = $v['user'];
                $user[$key]['distance'] = $v['distance'];
                if ($v['uid'] == $mid) {
                    unset($user[$key]);
                }
                if ($distance) {
                    if ($user[$key]['distance'] >= $distance * 1000) {
                        unset($user[$key]);
                    }
                }
            }
            unset($v);
            $user = $this->arraySortByKey($user, 'distance', true);
            $array = array_slice($user, ($page - 1) * $num, $num);
            if ($array) {
                $this->apiSuccess('返回成功', $array);
            } else {
                $this->apiError('暂无数据');
            }
        }else{
            $this->apiError('暂无数据');
        }
    }


    /**
     *  * 计算两个经纬度之间的距离
     *  * @param float $latitude1
     * @param float $longitude1
     *  * @param float $latitude2
     *  * @param float $longitude2
     *  * @return float(千米)
     */
    protected function GetDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $EARTH_RADIUS = 6371.393;
        $radLat1 = $latitude1 * M_PI / 180.0;
        $radLat2 = $latitude2 * M_PI / 180.0;
        $a = $radLat1 - $radLat2;
        $b = ($longitude1 * M_PI / 180.0) - ($longitude2 * M_PI / 180.0);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * $EARTH_RADIUS;
        return round($s, 3);
    }
//    /**     * 处理二维数组排序     */
//    protected function array2_sort($keyword, $arr)
//    {
//        $sort_array = array();
//        foreach ($arr as $key => $val) {
//            $sort_array[] = array($keyword => $arr[$key][$keyword], 'key' => $key,);
//        }
//        sort($sort_array);
//        $new_arr = array();
//        foreach ($sort_array as $key => $val) {
//            $new_arr[] = $arr[$val['key']];
//        }
//        return $new_arr;
//    }
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

    public function clearNear()
    {
        $mid = $this->requireIsLogin();
        M('UserLocation')->where(array('uid' => $mid))->save(array('lat' => 0, 'lng' => 0));
        $this->apiSuccess('清除成功');
    }
}