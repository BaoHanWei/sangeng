<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2015-11-8
 * Time: 13:56:58
 */
namespace Api\Controller;


class ShopController extends BaseController
{
    /* 获取当前分类信息 */
    public function getShopCategory()
    {
        $Category = D('Api/Shop')->getType();

        $this->apiSuccess('返回成功', $Category);
    }

    /*获取最热和最新*/
    public function  getIndex()
    {
        $aType = I_POST('type', 'text');
        switch ($aType) {
            case 'new':
                $map['is_new'] = 1;
                $map['status'] = 1;
                $goods_list = D('shop')->where($map)->order('changetime desc')->select();
                break;
            case 'hot':
                //热销商品
                $hot_num = modC('SHOP_HOT_SELL_NUM', 10, 'Shop');
                $map_hot['sell_num'] = array('egt', $hot_num);
                $map_hot['status'] = 1;
                $goods_list = D('shop')->where($map_hot)->order('sell_num desc')->select();
                break;
        }
        foreach ($goods_list as &$g) {
            $g = D('Api/Shop')->getGoodsInfo($g['id']);
        }
        if ($goods_list) {
            $this->apiError('暂时没有符合条件的商品');
        }

        $this->apiSuccess('返回成功', $goods_list);

    }

    /* 获取商品信息 */
    public function  getGoodsList()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aId = I_POST('id', 'intval');

        if ($aId) {

            $goods = D('Shop/Shop')->where(array('category_id' => $aId, 'status' => 1))->page($aPage, 10)->select();

//        $goods = D('Shop/Shop')->getList(array('field' => 'id', 'where'=>$where, 'page' => $aPage));
        } else {

            $goods = D('Shop/Shop')->where(array('status' => 1))->page($aPage, 10)->select();

        }

        foreach ($goods as &$g) {
            $g = D('Api/Shop')->getGoodsInfo($g['id']);
        }
        if (!$goods) {
            $this->apiError('暂时没有商品');
        }
        $this->apiSuccess('返回成功', $goods);
    }

    /* 兑换 */
    public function consigneeInfo()
    {
        $mid = $this->requireIsLogin();
        $aId = I_POST('id', 'intval');//商品id
        $num = 1;
        $address_id = I_POST('address_id', 'intval');
        $aAddress = I_POST('address', 'text');
        $aZipcode = I_POST('zipcode', 'intval');
        $aName = I_POST('name', 'text');
        $aPhone = I_POST('phone', 'text');
        $map['status'] = 1;
        $aId && $map['id'] = $aId;
        $goods = D('Shop/Shop')->where($map)->find();


        if($goods['goods_num']<$num){
            $this->apiError('购买失败,商品存货不足');
        }
        $ScoreModel = D('Api/Shop');
        $score_type = modC('SHOP_SCORE_TYPE', '1', 'Shop');
        $money_type = $ScoreModel->getType(array('id' => $score_type));
        $money_need = $num * $goods['money_need'];
        $my_money = query_user('score' . $score_type);
        if ($money_need > $my_money) {
            $this->apiError('商品所需积分超出所拥有的积分！');
        }
        $data['uid'] = $mid;
        $data['phone'] = $aPhone;
        $data['address'] = $aAddress;
        $data['zipcode'] = $aZipcode;
        $data['name'] = $aName;
        $data['create_time'] = time();

        if ($aName == '' || !preg_match("/^[\x{4e00}-\x{9fa5}]+$/u", $aName)) {
            $this->apiError('请输入正确的名字');
        }
        if ($aAddress == '') {
            $this->apiError('收货地址不能为空');
        }
        if ($aZipcode == '' || strlen($aZipcode) != 6 || !is_numeric($aZipcode)) {
            $this->apiError('请输入正确的邮政编码');
        }
        if ($aPhone == '' || !preg_match("/^1[3458][0-9]{9}$/", $aPhone)) {
            $this->apiError('手机号码格式有误');
        }

        $shop_address['phone'] = $aPhone;
        $shop_address['address'] = $aAddress;
        $shop_address['zipcode'] = $aZipcode;
        $shop_address['name'] = $aName;

        if ($address_id) {
            $address_save = D('shop_address')->where(array('id' => $address_id))->save($shop_address);
            if ($address_save) {
                D('Shop/ShopAddress')->where(array('id' => $address_id))->setField('change_time', time());
            }
            $data['address_id'] = $address_id;
        } else {
            $shop_address['uid'] = is_login();
            $shop_address['create_time'] = time();
            $data['address_id'] = D('Shop/ShopAddress')->add($shop_address);
        }
        //验证结束

        $data['goods_id'] = $aId;
        $data['goods_num'] = $num;
        $data['status'] = 0;
        $data['uid'] = $mid;
        $data['createtime'] = time();

        $ScoreModel->setUserScore(array($mid), $money_need, $score_type, 'dec', 'shop', $aId, get_nickname($mid) . '购买了商品');

        $res = D('shop_buy')->add($data);


        if ($res) {
            //商品数量减少,已售量增加
            D('shop')->where('id=' . $aId)->setDec('goods_num', $num);
            D('shop')->where('id=' . $aId)->setInc('sell_num', $num);
            //发送系统消息
            $message = $goods['goods_name'] . '购买成功，请等待发货。';
            D('Common/Message')->sendMessageWithoutCheckSelf(is_login(), '购买通知成功', $message, 'Shop/Index/myGoods', array('status' => '0'));
//            $list['title']='积分商城';
//            $list['content']= $message;
//            $list['message']='购买成功';
//            $list['good_id']=$aId;
//            $list['message_type']='shop';
//            $arr=array(is_login());
//            $data['cids']=D('Api/User')->getUserCID($arr);
//            D('Api/Igt')->pushMessageToSingle(4,$data);
            //商城记录
            $shop_log['message'] = '用户' . '[' . $mid . ']' . get_nickname(is_login()) . '在' . time_format($data['createtime']) . '购买了商品' . '<a href="index.php?s=/Shop/Index/goodsDetail/id/' . $goods['id'] . '.html" target="_black">' . $goods['goods_name'] . '</a>';
            $shop_log['uid'] = $mid;
            $shop_log['create_time'] = $data['createtime'];
            D('shop_log')->add($shop_log);
             $type=array('pay_score'=>'score'.$score_type);
            $message=array('message'=>$message);
//            action_log('shop_goods_buy', 'shop', $aId, is_login());
            $this->apiSuccess('兑换成功',$message,$type);
//            $this->apiSuccess('购买成功！花费了' . $money_need . $money_type['title'], $_SERVER['HTTP_REFERER'], $shop_log['uid']);
        } else {
            $this->apiError('购买失败');
        }
    }

    /*我的订单*/
    public function myOrders()
    {
        $mid = $this->requireIsLogin();
        $aType = I_POST('type', 'text');
        if (empty($aType)) {
            $aType = 'uncompleted';
        }
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $where['uid'] = $mid;
        switch ($aType) {
            case 'uncompleted':
                $where['status'] = 0;
                $list = D('Shop/ShopBuy')->where($where)->page($aPage, 10)->select();

                break;
            case 'completed':
                $where['status'] = 1;
                $list = D('Shop/ShopBuy')->where($where)->page($aPage, 10)->select();
                break;
        }

        foreach ($list as $key => &$v) {
            $v['goods_detail'] = D('Api/shop')->getGoodsInfo($v['goods_id']);
            $v['createtime']=friendlyDate($v['createtime']);
        }
        if ($list) {
            $this->apiSuccess('返回成功', $list);
        } else {
            $this->apiError('暂时啥都没有！');
        }
    }

    /*商品详情*/
    public function getGoodsDetail()
    {
        $aId = I_POST('id', 'intval');
        $goods = D('Api/Shop')->getGoodsInfo($aId);
        if ($goods) {
            $this->apiSuccess('返回成功', $goods);
        } else {
            $this->apiError('没有找到该商品');
        }
    }

    /*商品回复*/
    public function getGoodsComment()
    {
        $aId = I_POST('id', 'intval');
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $Comment = D('LocalComment')->getList(array('field' => 'id', 'order' => 'create_time desc', 'page' => $aPage, 'where' => array('app' => 'shop', 'mod' => 'goodsDetail', 'row_id' => $aId, 'status' => 1)));
        foreach ($Comment as &$v) {
            $v = D('Api/Shop')->getComment($v);
        }
        unset($v);
        if (!$Comment) {
            $Comment = null;
        }
        $list = array('list' => $Comment);
        $this->apiSuccess('返回成功', $list);

    }

    /*商品回复*/
    public function sendGoodsComment()
    {
        $mid = is_login();
        $aId = I_POST('id', 'intval');
        $aContent = I_POST('content', 'text');

        $app = 'Shop';
        $mod = 'goodsDetail';
        $data['row_id'] = $aId;
        $data['mod'] = $mod;
        $data['app'] = $app;
        $data['status'] = 1;
        $data['uid'] = $mid;
        $data['content'] = $aContent;
        $data['create_time'] = time();
        $Comment = D('LocalComment')->add($data);

        $Comments = D('Api/Shop')->getComment($Comment);

        if ($Comments) {
            $this->apiSuccess('评论成功', $Comments);
        } else {
            $this->apiError('评论失败');
        }
    }

    /*删除商品回复*/
    public function delGoodsComment()
    {
        $aId = I_POST('id', 'intval');
        $mid = $this->requireIsLogin();
        $Comment = D('LocalComment')->where(array('app' => 'shop', 'mod' => 'goodsDetail', 'row_id' => $aId, 'status' => 1))->find();

        if ($Comment) {
            if ($mid != $Comment['uid'] && !is_administrator($mid)) {
                $this->apiError('您无权删除');
            } else {
                D('LocalComment')->where(array('id' => $Comment['id']))->setField('status', -1);
                $this->apiSuccess('删除成功');
            }
        } else {
            $this->apiError('没有找到该点评');

        }
    }
}
