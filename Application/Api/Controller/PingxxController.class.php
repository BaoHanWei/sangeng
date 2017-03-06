<?php


namespace Api\Controller;


class PingxxController extends BaseController
{
    public function getParams($order_id,$channel,$aSubject,$aBody){
        $order = D('Api/Store')->getOrderById($order_id);


        if($order['condition'] == 1){
            $this->apiError('该订单已经支付');
        }
        if($order['uid'] != is_login()){
            $this->apiError('不是您的订单');
        }
        return array('channel'=>$channel,'body'=>$aBody,'subject'=>$aSubject,'amount'=>$this->getAmount($order));
    }


    public function getAmount($order){

        $finally =$order['total_cny'] + $order['adj_cny'];
        $score_id=modC('CURRENCY_TYPE',4,'Store');
        $fields_config = modC('RE_FIELD', "", 'Pingxx');
        $fields = json_decode($fields_config,true);
        $type = array_search_key($fields,'FIELD',$score_id);
        !$type && $type['UNIT'] =1;
        return number_format($finally/$type['UNIT'], 2, ".", "");
    }


    public function pay()
    {

        require_once('./Application/Pingxx/Lib/Pingxx/init.php');

       $this->requireIsLogin();
        $channel = I_POST('channel');
        if(empty($channel)){
            $channel='alipay_wap';
        }
        $sub=modC('WEB_SITE_NAME', 'OpenSNS开源社交系统', 'Config').'微店在线支付';
        $aSubject = I_POST('subject');
//        if(empty($aSubject)){
//            $aSubject=$sub;
//        }
        $body='通过'.$this->get_pay_method($channel).'进行微店商品在线支付';
        $aBody = I_POST('body');
        if(empty($aBody)){
            $aBody=$body;
        }
        $mod = I_POST('mod');
        $orderNo = I_POST('order_id');
        $alipay_open_id=I_POST('alipay_open_id');
        $link =M('order_link')->where(array('order_id' => $orderNo))->find();
        if($mod == 'store'){
            $data = $this->getParams($link['order_id'],$channel,$aSubject,$aBody);
        }else{
            $data = array('channel'=>$channel,'body'=>$aBody,'subject'=>$aSubject,'amount'=>M($link['model'])->where(array('id'=>$link['order_id']))->getField('amount'));
        }

        $channel = $data['channel'];
        $subject = $data['subject'];
        $body = $data['body'];
        $amount = $data['amount'];
        //$extra 在使用某些渠道的时候，需要填入相应的参数，其它渠道则是 array() .具体见以下代码或者官网中的文档。其他渠道时可以传空值也可以不传。
        $extra = array();

        // $redirect_url = U('pingxx/pingxx1/payCallback','',true,true);
        $redirect_url = 'http://' . str_replace('//', '/', $_SERVER['HTTP_HOST'] . __ROOT__ . '/pingxx/callback') . '.php';

        switch ($channel) {
            case 'alipay_wap':
                $extra = array(
                    'success_url' =>$redirect_url,
                    'cancel_url' => $redirect_url
                );
                break;
            case 'alipay':
                $extra = array(
                    'extern_token'=>$alipay_open_id,
                );
                break;
        }
        \Pingpp\Pingpp::setApiKey(modC('SECRET_KEY', '', 'Pingxx'));

        try {
            $assign = array(
                'subject' => $aSubject,
                'body' => $aBody,
                'amount' => $amount * 100,
                'order_no' => $orderNo,
                'currency' => 'cny',
                'extra' => $extra,
                'channel' => $channel,
                'client_ip' => $_SERVER['REMOTE_ADDR'],
                'app' => array('id' => modC('APP_ID', '', 'Pingxx'))
            );

          $ch=  \Pingpp\Charge::create($assign);
            $this->apiSuccess(json_decode($ch));
        } catch (\Pingpp\Error\Base $e) {
            header('Status: ' . $e->getHttpStatus());
            $this->apiError($e->getHttpBody());
            //echo($e->getHttpBody());
        }
    }

    function get_pay_method($method){
        switch ($method) {
            case 'alipay':
                return '支付宝手机';
            case 'alipay_qr':
                return '支付宝扫码';
            case 'alipay_wap':
                return '支付宝移动网页';
        }
        return '';
    }

    /**
     * 验证网站是否开启了充值功能，并返回配置信息
     */
    public function checkRecharge(){
        if(modC('OPEN_RECHARGE', 0, 'Pingxx')){
            $exchange = modC('RE_FIELD', "", 'Pingxx');
            $rcAmount = modC('RECHARGE_AMOUNT', "", 'Pingxx');
            $is_free = modC('CAN_INPUT', "", 'Pingxx');
            $rcAmount = explode("\n", str_replace("\r", '', $rcAmount));
            $typeModel = M('ucenter_score_type');
            $exchange = json_decode($exchange,true);
            foreach($exchange as $key=>$value){
                $exchange[$key]['type_info'] = $typeModel->find($value['FIELD']);
            }
            $result['exchange'] = $exchange;    //充值兑换率
            $result['rc_amount'] = $rcAmount;    //固定充值的面额
            $result['is_free'] = $is_free;    //是否开启自由充值
            if($is_free){
                $min_amount = modC('MIN_AMOUNT', "", 'Pingxx');
                $result['min_amount'] = $min_amount;      //自由充值的最小充值金额
            }
            $this->apiSuccess('充值功能已经开启',$result);
        }else{
            $this->apiError('网站没有开启充值功能');
        }
    }

    /**
     *生成一个充值订单
     */
    public function createRechOrder(){
        $muid = $this->requireIsLogin();
        $this->checkActionLimit('create_order', 'PingxxOrder', 0, is_login());

        $rechTyp = I_POST('recharge_type', '', 'intval');
        $aAmount = I_POST('amount', 0, 'floatval');
        $channel = I_POST('channel', '', 'op_t');

        $aAmount = number_format($aAmount, 2, ".", "");
        $minAmount = modC('MIN_AMOUNT', 0, 'pingxx');
        if ($aAmount <= 0) {
            $this->apiError('充值金额不符合');
        }
        $canInput = modC('CAN_INPUT', 1, 'pingxx');
        if ($aAmount <= $minAmount && $canInput && $minAmount != 0) {
            $this->apiError('充值金额不符合');
        }
        $method = modC('METHOD', 'alipay_pc_direct', 'pingxx');
        if (!check_is_in_config($channel, $method)) {
            $this->apiError('不支持的支付方式');
        }

        $data['field'] = $rechTyp;
        $data['amount'] = $aAmount;
        $data['method'] = $channel;
        $data['uid'] = $muid;
        $order_id = D('Pingxx/PingxxOrder')->addOrder($data);
        if ($order_id) {
            $result = M('pingxxOrder')->find($order_id);
            D('order_link')->add(array('order_id'=>$order_id,'model'=>'pingxx_order','app'=>'pingxx','method'=>$channel));
            $this->apiSuccess('订单提交成功',$result);
        }else{
            $this->apiError('订单提交失败');
        }
    }
}