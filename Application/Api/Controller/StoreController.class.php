<?php


namespace Api\Controller;


class StoreController extends BaseController
{
    public function getCategory()
    {
        $aId = I_POST('id','intval');
        if($aId===0||empty($aId)){
            $tree = D('Api/Store')->getTree();
        }else{
            $tree = D('Api/Store')->getTree($aId,true);
        }
        $this->apiSuccess('返回成功', $tree);
    }


    public function getGoods()
    {
        $mid=is_login();
        $aId = I('get.id', '', 'intval');
        $aPage = I_POST('page', 'intval');
        $aOrder = I_POST('order', 'text');
        $aShopId = I_POST('shop_id', 'intval');
//        $price=I_POST('price','intval');
        if (empty($aOrder)) {
            $aOrder = 'create';
        }
        if (empty($aPage)) {
            $aPage = 1;
        }
        $num=10;
        if ($aId) {
            $Goods = D('Api/StoreGoods')->getList(array('field' => 'id', 'where' => array('id' => $aId, 'status' => 1), 'page' => $aPage));
        } else {

            switch ($aOrder) {
                case 'create':
                    $map = 'create_time desc';
                    break;
                case 'sell':
                    $map = 'sell desc';
                    break;
                case 'price1':
                    $map = 'price desc';
                    break;
                case 'price2':
                    $map = 'price asc';
                    break;
                case 'reputation':
                    $rep = 1;
                    break;
            }
            $aCate = I_POST('cate', 'intval');
            if($aShopId){
                $Goods = D('Api/StoreGoods')->getList(array('field' => 'id', 'where' => array('status' => 1,'shop_id'=>$aShopId), 'page' => $aPage, 'order' => $map));
            }else{
                if ($aCate) {
                    $type = D('Store/StoreCategory')->where(array('id' => $aCate))->find();
                    if ($type['pid'] == 0) {
                        $Goods = D('Api/StoreGoods')->getList(array('field' => 'id', 'where' => array('status' => 1, 'cat1' => $aCate), 'page' => $aPage, 'order' => $map));
                    } else {
                        $Goods = D('Api/StoreGoods')->getList(array('field' => 'id', 'where' => array('status' => 1, 'cat2' => $aCate), 'page' => $aPage, 'order' => $map));
                    }
                } else {
                    $Goods = D('Api/StoreGoods')->getList(array('field' => 'id', 'where' => array('status' => 1), 'page' => $aPage, 'order' => $map));
                }
            }
        }

        foreach ($Goods as &$g) {
            $g = D('Api/Store')->getGoodsInfo($g);
        }
        if($rep==1){
            $Goods = $this->arraySortByKey($Goods, 'res_count', false);
            $Goods= array_slice($Goods, ($aPage - 1) * $num, $num);
        }

        if (!$Goods) {
            $this->apiError('暂时没有商品');
        }
        $this->apiSuccess('返回成功', $Goods);
    }

    public function getShopList()
    {
        $aId = I('get.id', '', 'intval');
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        if ($aId) {
            $Shop = D('Api/StoreShop')->getList(array('field' => 'id', 'where' => array('id' => $aId, 'status' => 1), 'page' => $aPage));
        } else {
            $Shop = D('Api/StoreShop')->getList(array('field' => 'id', 'where' => array('status' => 1), 'page' => $aPage));
        }

        foreach ($Shop as &$g) {
            $g = D('Api/Store')->getShopInfo($g);
        }
        if (!$Shop) {
            $this->apiError('暂时没有商店');
        }
        $this->apiSuccess('返回成功', $Shop);
    }

//我的订单
    public function getOrder()
    {
        $mid = $this->requireIsLogin();
        $order_id=I_POST('order_id','intval');

        $aPage = I_POST('page', 'intval');

        if (empty($aPage)) {
            $aPage = 1;
        }
        if($order_id){
           $Order = D('Api/StoreOrder')->getList(array('field' => 'id', 'where' => array('id'=>$order_id, 'uid' => $mid)));
        }else{
           $condition = I_POST('condition', 'intval');

            if(empty($condition)){
                $condition=0;
            }
           $Order = D('Api/StoreOrder')->getList(array('field' => 'id', 'where' => array('uid' => $mid,'condition'=>$condition), 'page' => $aPage));
        }

        foreach ($Order as $k=>&$g) {
            $g = D('Api/Store')->getOrderById($g);

        }

        if (!$Order) {
            $this->apiError('暂时没有订单');
        }

            $this->apiSuccess('返回成功', $Order);



    }



        //个人中心

    public function center(){
        $mid = $this->requireIsLogin();
        $center['car_count']=M('store_order_car')->where(array('uid'=>$mid))->count();
        $center['order_count']=M('store_order')->where(array('uid'=>$mid))->count();
        $center['overdue_order_count']=M('store_order')->where(array('uid'=>$mid,'condition'=>-1))->count();
        $center['unpaid_order_count']=M('store_order')->where(array('uid'=>$mid,'condition'=>0))->count();
        $center['paid_order_count']=M('store_order')->where(array('uid'=>$mid,'condition'=>1))->count();
        $center['send_order_count']=M('store_order')->where(array('uid'=>$mid,'condition'=>2))->count();
        $center['finished_order_count']=M('store_order')->where(array('uid'=>$mid,'condition'=>3))->count();
        $center['order_count']=M('store_order')->where(array('uid'=>$mid))->count();
        $center['fav_count']=M('store_fav')->where(array('uid'=>$mid))->count();
        $center['currency'] = D('Api/Store')->getCurrency($mid);
        $center['user']= D('Api/User')->getUserReduceInfo($mid);
        $this->apiSuccess('返回成功', $center);
    }

//得到商品所有评价
    public function getResponse()
    {
        $id = I_POST('id','intval');
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $num=10;
        $list= D('Api/Store')->response($id);
        $list = $this->arraySortByKey($list, 'response_time', false);
        $array= array_slice($list, ($aPage - 1) * $num, $num);
        if (!$array) {
            $this->apiError('暂时没有评论');
        }
        $this->apiSuccess('返回成功', $array);
    }


    public function search()
    {
        $aKey = I_POST('key','op_t');

        $map['title'] = array('like', '%' . $aKey . '%');
        $Good = D('Store/StoreGoods')->where($map)->select();
        foreach ($Good as &$g) {
            $g = D('Api/Store')->getGoodsInfo($g['id']);
        }
        if (!$Good) {
            $this->apiError('暂时没有商品');
        }
        $this->apiSuccess('返回成功', $Good);

    }
//得到我的购物车
    public function getMyCar()
    {
        $mid = $this->requireIsLogin();
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }

        $MyCar = D('Api/StoreOrderCar')->where(array('status' => 1, 'uid' => $mid))->page($aPage)->select();
        foreach ($MyCar as $key => &$g) {
            $g['goods_detail'] = D('Api/Store')->getGoodsInfo($g['goods_id']);
        }
        if (!$MyCar) {
            $this->apiError('您的购物车中暂时空无一物');
        }
        $this->apiSuccess('返回成功', $MyCar);
    }


//得到我的收藏
    public function getMyFav()
    {
        $mid = $this->requireIsLogin();
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $list = D('Store/Store_fav')->where(array('status' => 1, 'uid' => $mid))->page($aPage)->select();

        foreach ($list as &$li) {
            $li = D('Api/Store')->getGoodsInfo($li['info_id']);
        }
        unset($li);

        if (!$list) {
            $this->apiError('您的收藏中暂时空无一物');
        }
        $this->apiSuccess('返回成功', $list);
    }

//得到广告
    public function getAdv()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $list = D('Store/Store_adv')->where(array('status' => 1))->page($aPage)->select();
        foreach ($list as &$li) {
            $li['image_url']['ori'] = render_picture_path_without_root(get_cover($li['image'], 'path'));
            $li['image_url']['thumb'] = render_picture_path_without_root(getThumbImageById($li['image'], 100, 100));
            $li['image_url']['banana'] = render_picture_path_without_root(getThumbImageById($li['image'], 400, 292));
        }
        unset($li);
        if (!$list) {
            $this->apiError('目前没有广告');
        }
        $this->apiSuccess('返回成功', $list);
    }
//创建店铺
    public function createShop()
    {
        $mid = $this->requireIsLogin();
        $this->ApiCheckAuth('Store/Center/createShop', -1, '你没有开店权限！');
        $aId = I('get.id', '', 'intval');
        $shopModel = D('Store/StoreShop');
        if ($aId != 0) {
            $shop = $shopModel->find($aId);
            if ($shop['uid'] != get_uid()) {
                $this->error('抱歉，您无编辑该店铺的权限。');
            }
            $this->checkActionLimit('store_edit', 'store', $aId, $mid);
        }

        $aTitle = I_POST('title', 'op_t,trim');
        $aSummary = I_POST('summary', 'op_t,trim');
        $aLogo = I_POST('logo', 'intval');
        $aPosition = I_POST('position', 'op_t');

        if (modC('NEED_VERIFY_STORE', 0) && !is_administrator()) //需要审核且不是管理员
        {
            $shop['status'] = 2;
            $tip = '但需管理员审核通过后才会显示在列表中，请耐心等待。';
            $user = D('Api/User')->getUserReduceInfo($mid);
            D('Common/Message')->sendMessage(explode(',', C('USER_ADMINISTRATOR')), $title = '店铺创建提醒', "{$user['nickname']}创建了一个店铺，请到后台审核。", 'store/center/shop', array(), $mid, 2);
        }
        $shop['id'] = $aId;
        $shop['title'] = $aTitle;
        $shop['summary'] = $aSummary;
        $shop['logo'] = $aLogo;
        $shop['position'] = $aPosition;
        $shop['uid'] = $mid;
        $shop = $shopModel->create($shop);
        if (!$shop) {
            $this->apiError($shopModel->getError());
        }
        if ($aId) {
            $shopModel->save($shop);
            action_log('store_edit', 'store', $aId, $mid);
            $this->apiSuccess('店铺保存设置成功。');
        } else {
            $shopModel->add($shop);
            $this->apiSuccess('店铺创建成功。' . $tip);
        }
    }

//发送评价
    public function sendResponse()
    {
        $mid = $this->requireIsLogin();
        $order_id=I_POST('id', 'intval');
        $response=I_POST('response', 'text');
        $content=I_POST('content', 'text');

        $order = D('Store/StoreOrder')->find($order_id);

        if ($order['uid'] != $mid) {
            $this->apiError ( '修改评价失败，越权操作。');
        }
        //状态检测

        if ($order['condition'] != 3) {
            $this->apiError('修改评价失败，订单状态有误。');
        }


        //超时检测
        $lasts = modC('COMMENT_TIME', 604800, 'store');
        if (intval($order['response_time']) != 0) {
            if (time() - $order['response_time'] > $lasts) {
                $this->apiError('修改评价失败，已经超出可修改时间。');
            }
        }

        //从参数来获取到状态。
        switch ($response) {
            case 'good':
                $order['response'] = 1;
                break;
            case 'normal':
                $order['response'] = 0;
                break;
            case 'bad':
                $order['response'] = -1;
                break;
            default:
                $order['response'] = 0;
        }
        $data['content'] = $content;
        $data['response_time'] = time();
        $rs = D('Store/StoreOrder')->where(array('id'=>$order_id))->save($data);
        if ($rs) {
            $shop = $this->getShopFromOrder($order);
            D('Common/Message')->sendMessage($shop['uid'], $title = '微店订单评价通知', $content = '【微店】买家已修改评价' . $order['id'] . '！', 'store/center/sold',array(), $mid);
//            $list['title']='微店';
//            $list['content']= '【微店】买家已修改评价' . $order['id'] . '！';
//            $list['message']='微店订单评价通知';
//            $list['order_id']=$order_id;
//            $list['message_type']='store';
//            $arr=array($shop['uid']);
//            $data['cids']=D('Api/User')->getUserCID($arr);
//            D('Api/Igt')->pushMessageToSingle(4,$data);
            $this->apiSuccess('修改评价成功。');
        } else {
            $this->apiError('修改评价失败，数据更改错误。');
        }

    }



//收藏
    public function doFav()
    {
        $mid = $this->requireIsLogin();
        $goods = I_POST('id', 'intval');
        if (!D('Api/store')->checkFav($mid, $goods)) {
            //未收藏，就收藏
            if (D('Api/store')->doFav($mid, $goods)) {
                $this->apiSuccess('收藏成功');
            };
        } else {
            $this->apiError('操作失败，该商品已收藏');
        }

    }


//取消收藏
    public function endFav()
    {
        $mid = $this->requireIsLogin();
        $goods = I_POST('id', 'intval');
        if (D('Api/store')->checkFav($mid, $goods)) {
            if (D('Api/store')->doDisFav($mid, $goods)) {
                $this->apiSuccess('取消收藏成功');
            } else {
                $this->apiError('操作失败');
            }
        } else {
            $this->apiError('操作失败，该商品并未收藏');
        }
    }


//下单
    public function pay()
    {

        $mid = $this->requireIsLogin();
        $this->ApiCheckAuth('Store/Center/pay', -1, '你没有下单权限！');
        $this->checkActionLimit('store_pay', 'store', null, $mid);
        $aGoodsId = I_POST('goods_id', 'op_t');
        if ($aGoodsId == '') {
            $this->apiError('请选择商品。');
        }
        $goodsId = explode(',', $aGoodsId);

        $aCount = I_POST('count', 'op_t');
        $goodsCount = explode(',', $aCount);
        if ($aCount == '') {
            $this->apiError('商品数量必须选择。');
        }
        $transId = I_POST('trans_id', 'intval');
        $map['uid'] = $mid;

        if ($transId == '') {
            $this->apiError('请选择送货地址');
        }

        $order['create_time'] = time();
        $order['uid'] = $mid;
        $order['r_id'] = $transId;
        $order['condition'] = ORDER_CON_WAITFORPAY;
        $rs = D('Api/Store')->addOrder($order, $goodsId, $goodsCount);

        if ($rs[0]) {
            action_log('store_pay', 'store', null, $mid);
            M('store_order_car')->where(array('uid'=>$mid))->delete();
            $this->apiSuccess('下单成功。',$rs[1]);
        } else {
            $this->apiError('下单失败');
        }
    }

//取消订单
    public function endOrder()
    {
        $mid = $this->requireIsLogin();
        $aId = I_POST('id','floatval');
        $order = D('Api/store')->getOrderById($aId);
        if(!$order){
            $this->apiError('订单不存在');
        }
        if ($order['uid'] != $mid&&$order['s_uid'] != $mid) {
            $this->apiError('该订单不是您的。无法取消。');
        }
        if($order['condition'] != 0){
            $this->apiError('该订单已经生效无法取消。');
        }
        if($order['uid'] == $mid){
            $order = M('store_order')->where(array('id'=>$aId,'uid'=>$mid))->setField('condition', -1);
        }
        if($order['s_uid'] == $mid){
            $order = M('store_order')->where(array('id'=>$aId,'s_uid'=>$mid))->setField('condition', -1);
        }
            if($order){
                $this->apiSuccess('订单取消成功');
            }else{
                $this->apiError('订单取消失败');
            }
    }



    //确认收货
    public function doneOrder()
    {
        $mid = $this->requireIsLogin();
        $aId = I_POST('id','floatval');
            //确保订单无误
            if ($aId == 0) {
                $this->apiError('订单不存在。');
            }
            $order = M('store_order')->where(array('id'=>$aId))->find();

            //权限检测
            if ($order['uid'] != $mid) {
                $this->apiError('您无权确认收货。');

            }

            //订单检测
            if ($order['condition'] != 2) {
                $this->apiError('订单状态不正确。') ;
            }

            if ($order) {
                //修改订单状态
                $data['condition'] = 3;
                $r = M('store_order')->where(array('uid'=>$mid,'id'=>$aId))->save($data);
                if ($r) {
                    //给卖家加钱
                    $rs = D('Api/Store')->adjust( $this->getFinalPrice($order), $order['s_uid']);
                    if ($rs) {

                        D('Ucenter/Score')->addScoreLog($order['s_uid'],  $this->getFinalPrice($order), modC('CURRENCY_TYPE', '4', 'Store'), 'inc','recharge_order',$aId,get_nickname($order['s_uid']).'收到了'.get_nickname($mid).'付的款');

                        $shopModel = D('Store/StoreShop');
                        $shop = $shopModel->where(array('uid' => $order['s_uid']))->find();
                        D('Common/Message')->sendMessage($shop['uid'], $title = '微店订单确认收货通知', $content = '【微店】订单' . $order['id'] . '买家已确认收货，赶紧查查款项吧！', 'store/center/sold',array(), $mid);
//                        $list['title']='微店';
//                        $list['content']= '【微店】订单' . $order['id'] . '买家已确认收货，赶紧查查款项吧！';
//                        $list['message']='微店订单确认收货通知';
//                        $list['order_id']=$aId;
//                        $list['message_type']='store';
//                        $arr=array($shop['uid']);
//                        $data['cids']=D('Api/User')->getUserCID($arr);
//                        D('Api/Igt')->pushMessageToSingle(4,$data);

                       $this->apiSuccess('确定成功！',$rs) ;
                    } else {

                        $this->apiError('给卖家转账失败。');

                    }
                } else {
                    $this->apiError('状态修改失败。');
                }
            }
    }

//加入购物车
    public function addCar()
    {
        $mid = $this->requireIsLogin();
        $data['uid']= $mid;
        $data['create_time']= time();
        $data['goods_id']= I_POST('goods_id','intval');
        $data['count']= I_POST('count', 'intval');
        if(empty($data['goods_id'])){
            $this->apiError('请选择商品');
        }
        if(empty($data['count'])){
            $data['count']=1;
        }
       $res= D('Store/StoreOrder')->where(array('id' => $data['goods_id']))->find();
        if($res['uid']==$mid){
            $this->apiError('商品是您发布的不能放入购物车');
        }
        $old = D('Store/StoreOrderCar')->where(array('uid' => $mid, 'goods_id' => $data['goods_id']))->find();

        if ($old) {
            D('Store/StoreOrderCar')->where(array('uid' => $mid, 'goods_id' => $data['goods_id']))->save(array('create_time' => time(), 'count' => $old['count'] +  $data['count']));
            $info= D('Store/StoreOrderCar')->where(array('id'=>$old['id']))->find();
        } else {
          $id=  D('Store/StoreOrderCar')->add(array('uid' => $mid, 'goods_id' =>$data['goods_id'], 'create_time' => time(), 'count' => $data['count']));
            $info= D('Store/StoreOrderCar')->where(array('id'=>$id))->find();
        }
        $this->apiSuccess('添加购物车成功',$info);
    }


    //移除购物车
    public function removeCar()
    {
        $mid = $this->requireIsLogin();
        $id=I_POST('goods_id','intval');
        if(empty($id)){
            $this->apiError('请选择购物车内的商品');
        }
       $info= D('Store/StoreOrderCar')->where(array('goods_id'=>$id))->find();

        if($info['uid']!=$mid){
            $this->apiError('不是本人操作 不能进行购物车操作！');
        }
        D('Store/StoreOrderCar')->where(array('id'=>$info['id']))->delete();
        $this->apiSuccess('移除操作成功');
    }

    /**页面 最终付款
     * @auth 陈一枭
     */
    //付款
    public function payOut()
    {
        $aId = I('get.id', 0, 'floatval');
        if ($aId != 0) {
            if ($this->payOk($aId)) {
                $good_ids = D('Store/StoreItem')->field('good_id')->where(array('order_id' => $aId))->find();
                $good_id = $good_ids['good_id'];
                $good_model = D('Store/StoreGoods');
                $shop_ids = $good_model->field('shop_id')->where(array('id' => $good_id))->find();
                $shop_id = $shop_ids['shop_id'];
                D('Store/StoreShop')->where(array('id' => $shop_id))->setInc('order_count');
                D('Store/StoreShop')->where(array('id' => $shop_id))->setInc('sell');

                $this->apiSuccess('支付成功。', D('Api/store')->getOrderById($aId));
            } else {
                $this->apiError('未支付成功');
            }
        } else {
            $this->apiError('订单信息获取错误。');
        }
    }

    private function payOk($order_id)
    {
        $mid = $this->requireIsLogin();
        $order = D('Api/store')->getOrderById($order_id);

        if ($order['uid'] != $mid) {
            $this->apiError('该订单不是您的。无法付款。');
        }
        if ($order['condition'] != 0) {
            $this->apiError('该订单不是未支付状态。');
        }
        $cost = $this->getFinalPrice($order);

        if (D('Api/store')->pay($cost, $mid)) {
            D('Ucenter/Score')->addScoreLog($mid, $cost, modC('CURRENCY_TYPE', '4', 'Store'), 'dec', 'recharge_order', $order_id, get_nickname($mid) . '在微店支付了订单');

            $order['condition'] = 1; //置为已支付
            $order['pay_time'] = time();
            if (D('Store/StoreOrder')->where(array('id' => $order_id))->save($order)) {
                //设置店铺销量
                $shopModel = D('Store/StoreShop');
                $shop = $this->getShopFromOrder($order);
                $shopModel->where(array('id' => $shop['id']))->setInc('order_count', 1);
                //给店主发信息
                D('Common/Message')->sendMessage($shop['uid'], $title = '微店订单付款通知', $content = '【微店】订单' . $order['id'] . '已付款，赶紧发货吧！', 'store/center/sold', array(), $mid);
//                $list['title']='微店';
//                $list['content']='【微店】订单' . $order['id'] . '已付款，赶紧发货吧！';
//                $list['message']='微店订单付款通知';
//                $list['order_id']=$order_id;
//                $list['message_type']='store';
//                $arr=array($shop['uid']);
//                $data['cids']=D('Api/User')->getUserCID($arr);
//                D('Api/Igt')->pushMessageToSingle(4,$data);
                
                return true;
            } else {
                $this->apiError('设置订单付款状态失败。');
                return false;
            }
        } else {
            $this->apiError('余额不足。');
            return false;
        }
    }


    private function getShopFromOrder($order)
    {
        $shopModel = D('Store/StoreShop');
        $shop = $shopModel->where(array('uid' => $order['s_uid']))->find();
        return $shop;
    }


    /**通过item[] 形式取出调价后的实际价格
     * @param $good
     * @return mixed
     */
    private function getFinalPrice($order)
    {
        return $order['total_cny'] + $order['adj_cny'];
    }

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

    /**
     * 获取用户配送信息列表
     */
    public function getTransList(){
        $mUid = $this->requireisLogin();
        $result = M('storeTrans')->where(array('uid'=>$mUid,'status'=>1))->order('is_default desc')->select();
        if ($result) {
            $this->apiSuccess('返回成功!', $result);
        }else{
            $this->apiError('没有配送地址信息');
        }
    }

    /**
     * 删除用户的配送地址信息
     */
    public function delTrans(){
        $this->requireisLogin();
        $transId = I_POST('id','intval');
        $result = M('storeTrans')->where(array('id'=>$transId))->setField('status',0);
        if ($result) {
            $this->apiSuccess('删除成功!');
        }else{
            $this->apiError('删除失败');
        }
    }

    /**
     * 编辑或者修改用户的配送信息
     */
    public function setTransInfo(){
        $mUid = $this->requireisLogin();
        $transId = I_POST('id','','intval');
        $phoneNum = I_POST('phone');
        $zipCode = I_POST('zip_code');
        $contact = I_POST('contact');
        $address = I_POST('address');
        $isDefault = I_POST('is_default');

        if(empty($phoneNum)){
            $this->apiError('请填写正确的手机号码');
        }if(empty($contact)){
            $this->apiError('请填写联系人');
        }if(empty($address)){
            $this->apiError('请填写正确的送货地址');
        }

        $transMod = M('storeTrans');
        //设置唯一默认配送地址
        if(!$transId || $isDefault){
            $transMod->where(array('uid'=>$mUid,'is_default'=>1))->setField('is_default',0);
        }
        $transInfo = $transMod->create();
        $transInfo['uid'] = $mUid;
        $transInfo['phone'] = $phoneNum;
        $transInfo['zipCode'] = $zipCode;
        $transInfo['contact'] = $contact;
        $transInfo['address'] = $address;
        $transInfo['is_default'] = $isDefault;
        $transInfo['update_time'] = time();
        $transInfo['status'] = 1;

        if($transId){
            $result = $transMod->where(array('id' => $transId))->save($transInfo);
            if($result){
                $data = $transMod->where(array('id'=>$transId))->find();
                $this->apisuccess('修改成功！',$data);
            }else {
                $this->apiError('修改失败');
            }

        }else{
            $transInfo['create_time'] = time();
            $transId = $transMod->add($transInfo);
            $data = $transMod->where(array('id'=>$transId))->find();
            if ($data) {
                $this->apiSuccess('创建地址成功！',$data);
            }
            $this->apiError('创建地址失败！');
        }
    }
}