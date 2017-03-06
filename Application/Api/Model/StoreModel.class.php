<?php


namespace Api\Model;


use Think\Model;

class StoreModel extends Model
{
    public function getTree($id = 0, $field = true){
        /* 获取当前分类信息 */
        if($id){
            $info = D('Store/Category')->find($id);
            $id   = $info['id'];
        }
        /* 获取所有分类 */
        $map  = array('status' => array('gt', -1));
        $list = D('Store/Category')->field($field)->where($map)->order('sort')->select();
        $list =$this->list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'child', $root = $id);
        /* 获取返回数据 */
        if(isset($info)){ //指定分类则返回当前分类极其子分类
            $info['child'] = $list;
        } else { //否则返回所有分类
            $info = $list;
        }
        return $info;
    }
    function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                if(empty($list[$key]['child'])){
                    $list[$key]['child']=null;
                }
                $refer[$data[$pk]] =& $list[$key];

            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];


                } else {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];

                        if($parent ==null){
                            $parent[$child][] =null;
                        }else{
                            $parent[$child][] =& $list[$key];
                        }
                    }
                }
            }
        }

        return $tree;
    }
    public function getGoodsInfo($id)
    {
        $goods = D('Store/StoreGoods')->where(array('id' => $id))->find();
        $goods['title'] = text($goods['title']);
        $shop=D('Store/StoreShop')->where(array('id'=>$goods['shop_id']))->find();
        $goods['shop_title']=$shop['title'];
        if (!D('Store/StoreFav')->where(array('info_id'=>$id,'uid'=>is_login()))->find()) {
            //未收藏，就收藏
            $goods['is_fav']=0;
        } else {
            $goods['is_fav']=1;
        }
        $response= $this->response($id);
        $Count=0;
        foreach($response as &$r){
           if($r['response']==1||$r['response']==0){
               $Count++;
           }
        }
        $responseCount=count($response);
        if($responseCount==0) {
            $goods['res_count'] = 100;
        }else{
            $goods['res_count']=$Count/$responseCount*100;
        }

        $goods['share_url']='http://'.$_SERVER['HTTP_HOST'].'/store/index/info/info_id/'.$id.'.html';
        $goods['fav_num']= D('Store/StoreFav')->where(array('info_id'=>$id))->count();
        $goods['goods_icon']['ori']=render_picture_path_without_root(get_cover($goods['cover_id'], 'path'));
        $goods['goods_icon']['thumb'] = render_picture_path_without_root(getThumbImageById($goods['cover_id'], 100, 100));
        $goods['goods_icon']['banana']= render_picture_path_without_root(getThumbImageById($goods['cover_id'], 400 ,292));
        $goods['gallary_list']=array();
        $list=json_decode($goods['gallary'],true);

        foreach($list as &$g){
            $goods['gallary_list'][]=render_picture_path_without_root(get_cover($g['id'], 'path'));
        }
        $goods['update_time'] = time_format($goods['update_time']);
        $goods['create_time'] = time_format($goods['create_time']);
        return $goods;
    }

    public function getShopInfo($id)
    {
        $Shop = D('Store/StoreShop')->where(array('id' => $id))->find();
        $Shop['title'] = text($Shop['title']);
        $Shop['position'] = text($Shop['position']);
        $Shop['logo_url']['ori']=render_picture_path_without_root(get_cover($Shop['logo'], 'path'));
        $Shop['logo_url']['thumb'] = render_picture_path_without_root(getThumbImageById($Shop['logo'], 100, 100));
        $Shop['update_time'] = time_format($Shop['update_time']);
        $Shop['create_time'] = time_format($Shop['create_time']);
        $Shop['user'] = D('Api/User')-> getUserReduceInfo($Shop['uid']);
        $Shop['goods_num'] = D('Store/StoreGoods')->where(array('shop_id'=>$id))->count();
        return $Shop;
    }

    public function getOrderInfo($id)
    {
        $Order = D('Store/StoreOrder')->where(array('id' => $id))->find();
        $Order['content'] =text($Order['content']);
        $Order['update_time'] = time_format($Order['update_time']);
        $Order['create_time'] = time_format($Order['create_time']);
        return $Order;
    }


    public function doFav($mid, $info_id)
    {
        $fav['uid'] = $mid;
        $fav['cTime'] = time();
        $fav['info_id'] = $info_id;
        if (D('Store/StoreFav')->add($fav)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function doDisFav($mid, $info_id)
    {
        $fav['uid'] = $mid;
        $fav['info_id'] = $info_id;
        if (D('Store/StoreFav')->where($fav)->delete()) {
            return 1;
        } else {
            return 0;
        }
    }

    public  function checkFav($mid, $info_id)
    {
        $map['uid'] = $mid;
        $map['info_id'] = $info_id;
        return D('Store/StoreFav')->where($map)->count();
    }

    public function addOrder($order, $good_ids, $good_counts)
    {

        $hint = '';
        //要对订单进行拆分

        $goods = array(); //商品组
            foreach ($good_ids as $key => $v) {
            $good=$this->getById(intval($v));
            $good['count'] = intval($good_counts[$key]);
            //对每个商品进行遍历，按照uid分配商品组
            $goods[$good['uid']][] = $good;

        }
        //对商品组分别创建订单

        foreach ($goods as $key => $v) {
            $sum = $this->comput_sum_good($v);
            $t_order = $order; //临时订单
            $t_order['id'] =doubleval(time().create_rand(4,'num'));
            $t_order['total_cny'] = $sum['cny'];
            $t_order['total_count'] = $sum['count'];
            $t_order['s_uid'] = $key; //卖家ID
            $shop = $this->getByShopId($v[0]['shop_id']);

            $rs = D('Store/StoreOrder')->add($t_order);

            if ($rs == 0) {
                return array(false, $this->getError());
            }
            M('order_link')->add(array('order_id'=>$t_order['id'],'model'=>'store_order','app'=>'store'));
            //给店主发信息
            D('Common/Message')->sendMessage($shop['uid'], $content = '【微店】订单' . $t_order['id'] . '已创建，等待买家付款！', $title = '微店下单通知', 'store/center/sold',array(), is_login());
//            $list['title']='微店';
//            $list['content']='【微店】订单' . $t_order['id'] . '已创建，等待买家付款！';
//            $list['message']='微店下单通知';
//            $list['order_id']=$t_order['id'];
//            $list['message_type']='store';
//            $arr=array($shop['uid']);
//            $data['cids']=D('Api/User')->getUserCID($arr);
//            D('Api/Igt')->pushMessageToSingle(4,$data);
            //添加订单完成，添加商品
            foreach ($v as $k => $g) {
                $t_good['good_id'] = $g['id'];
                $t_good['h_price'] = $g['price'];
                $t_good['cTime'] = time();
                $t_good['h_name'] = $g['title'];
                $t_good['h_pic'] = $g['cover_id'];
                $t_good['order_id'] =$t_order['id'];
                $t_good['count'] = $g['count'];
                $orders[]=$t_order['id'];
                $rs_good = D('Store/StoreItem')->add($t_good);
                D('Store/StoreGoods')->where('id=' . $g['id'])->setField('sell', $g['sell'] + $g['count']);
                if ($rs_good == 0) {
                    return array(false, $this->getError());
                }
            }
        }
        return array(true, $orders);

    }

    public function response($id){

        $Comment= M('store_item')->where(array('good_id'=>$id))->select();
        $list=array();
        foreach ($Comment as $key => &$g) {
            $g = M('store_order')->where(array('id'=>$g['order_id'],'condition'=>3))->find();
            $list[$key]['content']=$Comment[$key]['content'];
            $list[$key]['response_time']=time_format($Comment[$key]['response_time']);
            $list[$key]['response']=$Comment[$key]['response'];
            $list[$key]['user']=D('Api/User')->getUserReduceInfo($Comment[$key]['uid']);
            if ($Comment[$key]['content'] == null) {
                unset($list[$key]);
            }
        }
        return $list;
    }





    private  function comput_sum_good($goods)
    {
        $sum['cny'] = 0;
        $sum['count'] = 0;
        foreach ($goods as $k => $v) {
            $sum['cny'] += $v['price'] * $v['count'];
            $sum['count'] += $v['count'];
        }
        return $sum;
    }
   private function getById($id)
    {

        $map['id'] = $id;
        $info = D('Store/StoreGoods')->find($id);

        $info['data'] = $this->getByInfoId($id);
        return $info;
    }

    public function getOrderById($order_id)
    {
        $order = D('Store/StoreOrder')->find($order_id);
        $order['user'] = query_user(array('nickname'), $order['uid']);
        $order['s_user'] = query_user(array('nickname'), $order['s_uid']);
        if(!$order['r_phone']){
            $transInfo = M('storeTrans')->find($order['r_id']);
            $order['r_name'] = $transInfo['contact'];
            $order['r_phone'] = $transInfo['phone'];
            $order['r_code'] = $transInfo['zip_code'];
            $order['r_pos'] = $transInfo['address'];
        }
        $map_item['order_id'] = $order_id;
        $order['items'] = D('Store/StoreItem')->where($map_item)->limit(999)->select();
        foreach ($order['items'] as $k => $v) {
            $order['items'][$k]['good']=$this->getGoodsInfo($v['good_id']);
        }
        return $order;
    }

    public function getByInfoId($info_id)
    {
        $map['info_id'] = $info_id;

        $data = array();
        $dataRows = D('Store/StoreData')->where($map)->order('data_id asc')->select();
        foreach ($dataRows as $v) {
            $profile = D('Store/StoreField')->where('id=' . $v['field_id'])->find();
            $data[$profile['name']]['data'][] = $v['value'];
            $data[$profile['name']]['field'] = $profile;
            $data[$profile['name']]['values'] = $values = json_decode($profile['option'], true);
        }
        return $data;
    }

    private function getByShopId($id)
    {
        $shop = D('Store/StoreShop')->find($id);
        if ($shop)
            $shop['user'] = D('Api/User')->getUserInfo($shop['uid']);
        return $shop;
    }

    /**
     * 获取微店交易积分值
     * @param int $uid
     * @return mixed
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function getCurrency($uid = 0)
    {
        !$uid && $uid = is_login();
        $score_id = modC('CURRENCY_TYPE', 4, 'Store');
        $scoreModel = D('Ucenter/Score');
        $currency = $scoreModel->getUserScore($uid, $score_id);
        return $currency;
    }

    /**
     * 获取微店交易积分类型
     * @return mixed
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function getCurrency_info()
    {
        $score_id = modC('CURRENCY_TYPE', 4, 'Store');
        $scoreModel = D('Ucenter/Score');
        $currency = $scoreModel->getType($score_id);
        return $currency;
    }

    /**付款
     * @param int $price
     * @param int $uid
     * @return bool
     * @auth 陈一枭
     */
    public function pay($price = 0, $uid = 0)
    {
        $info = $this->getCurrency_info();
        if ($price <= 0) {
            $this->error = '支付' . $info['title'] . '小于0' . $info['unit'];
            return false;
        }
        $currency = $this->getCurrency($uid);
        $hasLeft = $currency - $price;
        if ($hasLeft >= 0) {
            return $this->adjust(-$price, $uid);
        } else {
            return false;
        }

    }

    /**
     * 调整积分，允许增减
     * @param int $amount
     * @param int $uid
     * @return bool
     * @auth 陈一枭
     */
    public function adjust($amount = 0, $uid = 0)
    {
        if ($uid == 0) {
            $uid = is_login();
        }
        if ($amount == 0) {
            $this->error = '调整数值为0';
            return false;
        }
        $this->mField = 'score' . modC('CURRENCY_TYPE', '4', 'Store');
        $result = D('Member')->where(array('uid' => $uid))->setInc($this->mField, $amount);

        if ($result) {
            return true;
        } else {
            $this->error = '设置货币失败。';
            return false;
        }
    }

}