<?php


namespace Api\Controller;


class CatController extends BaseController
{
    //得到所有分类
    public function getCatType()
    {
        $aPage = I_POST('page', 1, 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aCount = I('count', 10, 'intval');
        $CatType = M('CatEntity')->where(array('status' => 1))->page($aPage,$aCount)->select();
        foreach ($CatType as &$c) {
            $c['app_icon'] = get_cover($c['app_icon'],'path');
            foreach ($c as &$a) {
                $a=op_t($a);
            }
            unset($a);
        }
        unset($c);
        if($CatType){
            $this->apiSuccess('返回成功', $CatType);
        }else{
            $this->apiError('没有分类数据');
        }
    }

    //得到某一分类下的信息
    public function getCatList()
    {
        $aId = I_POST('id','intval');
        $aPage=I_POST('page','intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $order='create_time desc';
        $isRecom = 1;
        if($aId){
            $CatType = D('Cat/CatEntity')->where(array('status' => 1,'id'=>$aId))->find();
            if(!$CatType){
                $this->apiError('没有该分类');
            }
            $CatList = M('CatInfo')->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => array('status' => 1, 'entity_id' => $aId)));
        }else{
            $CatList = M('CatInfo')->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => array('status' => 1)));
        }
        foreach ($CatList as &$c) {
            $c = D('Api/Cat')->getDetail($c);
        }
        if($CatList){
            $this->apiSuccess('返回成功', $CatList);
        }else{
            $this->apiError('该分类下无信息数据');
        }
    }

    public function sendInfo(){
        $mid = $this->requireIsLogin();
        $this->ApicheckAuth('Cat/Center/doSendInfo',-1,'你没有发送消息的权限！');
        $recStr = I_POST('receiver','text');
        $array = explode(' ', str_replace('@', '', $recStr));
        $array = array_unique($array);
        $send['send_uid'] =  $mid;
        $send['create_time'] = time();
        $send['content'] = I_POST('content','op_t');
        $rs = 1;
        $user_info=query_user(array('nickname'));
        $tip = "用户{$user_info['nickname']}在分类信息中给你发了消息，附言：".$send['content'];
        foreach ($array as $v) {
            if ($array != '') {
                $v = trim($v);
                $v = str_replace("\r", '', $v);
                $user = D('member')->where(array('nickname' => $v))->find();
                if ($user) {
                    $t_send = $send;
                    $t_send['rec_uid'] = $user['uid'];
                    $rs = $rs && D('cat_send')->add($t_send);
                    //发送消息
                    /**
                     * @param $to_uid 接受消息的用户ID
                     * @param string $content 内容
                     * @param string $title 标题，默认为  您有新的消息
                     * @param $url 链接地址，不提供则默认进入消息中心
                     * @param $int $from_uid 发起消息的用户，根据用户自动确定左侧图标，如果为用户，则左侧显示头像
                     * @param int $type 消息类型，0系统，1用户，2应用
                     */
                    D('Common/Message')->sendMessage($user['uid'],"分类信息发送消息", $tip , 'Cat/Center/rec',array(), get_uid(), 1);
                }
            }
        }
        if ($rs) {
            action_log('cat_center_send_info','cat_center');
            $this->apiSuccess('发送成功。');
        } else {
            $this->apiError('发送失败。');
        }

    }

    //获取我的信箱
    public function getMail(){

        $mid = $this->requireIsLogin();
        $order='create_time desc';
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $mailList = M('CatSend')->where(array('rec_uid'=>$mid))->page($aPage,10)->order($order)->select();
        foreach ($mailList as $key=>&$c) {
            $c['create_time'] = time_format($c['create_time']);
            $c['cat_info'] =  D('Api/Cat')->getDetail($c['info_id']);
            if($c==null){
                unset($mailList[$key]);
            }
        }

        if ($mailList) {
            $this->apiSuccess('获取成功！',$mailList);
        } else {
            $this->apiError('获取失败！');
        }

    }

    //分类信息中心
    public function getUcData(){
        $mid = $this->requireIsLogin();
        $CatFav = M('CatFav');
        $CatSend = M('CatSend');
        $info['uid'] = $mid;
        $info['fav_count'] = $CatFav->where(array('uid'=>$mid))->count();
        $info['send_count'] = M('CatInfo')->where(array('uid'=>$mid))->count();
        $info['rec_count'] = $CatSend->where(array('rec_uid'=>$mid))->count();
        if ($info) {
            $this->apiSuccess('获取成功！',$info);
        } else {
            $this->apiError('获取失败！');
        }
    }

    //得到某一个详细信息
    public function getCatDetail()
    {
        $aId = I_POST('id','intval');
        $CatInfo = D('Api/Cat')->getDetail($aId);
        if(!$CatInfo){
            $this->apiError('没有该信息');
        }
        $this->apiSuccess('返回成功', $CatInfo);
    }

    //打分
    public function doScore()
    {
        $mid = $this->requireIsLogin();
        $aScore= I_POST('score', 'floatval');
        $this->ApiCheckAuth('Cat/Index/doScore', -1, '你没有打分的权限！');
        $info_id = I_POST('id','intval');
        if(!$info_id){
            $this->apiError('请选择打分目标。');
        }
        $rate['info_id'] = $info_id;
        $info =M('CatInfo')->find($info_id);

        if ($info['uid'] == $mid) {
            $this->apiError('不能给自己打分。');
        }
        $rate['uid'] = $mid;
        $map = $rate;
        if (M('CatRate')->where($map)->count()) {
            $this->apiError('已经打过分。');
        }

        if ($aScore > 5 || $aScore< 0) {
            $this->apiError('分数有误。');
        }
        $rate['score'] =$aScore;
        $rate['create_time'] = time();
        $rs = M('CatRate')->add($rate);


        if ($rs) {
            $map_rate['info_id'] = $info_id;
            $count = M('CatRate')->where($map_rate)->Avg('score');
            $map_info['id'] =$info_id;
            M('CatInfo')->where($map_info)->setField('rate', $count);

            $this->apiSuccess('打分成功。');
        } else {
            $this->apiError('打分失败。');
        }
    }


    //收藏
    public function doFav()
    {
        $mid = $this->requireIsLogin();
        $aId=I_POST('id','intval');
   if(empty($aId)){
       $this->apiError('请选择一个信息进行操作');
   }
        $this->ApiCheckAuth('Cat/Index/doFav', -1, '你没有收藏分类信息的权限！');
        if (!D('Cat/Fav')->checkFav($mid, intval($aId))) {
            //未收藏，就收藏
            if (D('Api/Cat')->doFav($mid,$aId)) {
                $this->apiSuccess('收藏成功');
            };
        } else {
            //已收藏，就取消收藏
            $this->apiError('您已经收藏过此信息  无法重复收藏');
        }
        $this->apiError('操作失败');
    }
// 取消收藏
    public function disFav()
    {
        $mid = $this->requireIsLogin();
        $aId=I_POST('id','intval');
        if(empty($aId)){
            $this->apiError('请选择一个信息进行操作');
        }
        if (!D('Cat/Fav')->checkFav($mid, intval($aId))) {
            $this->apiError('您并没有收藏此信息 无法取消收藏！');
        } else {
            //已收藏，就取消收藏
            if (D('Api/Cat')->doDisFav($mid,$aId)) {
                $this->apiSuccess('取消收藏成功');
            };
        }
        $this->apiError('操作失败');
    }

    //删除信息
    public function delInfo()
    {
        $mid= $this->requireIsLogin();
        $aId=I_POST('id','intval');
        $map['info_id'] =$aId;
        $info = M('CatInfo')->find($map['info_id']);
        if(!$info){
            $this->apiError('信息不存在！');
        }
        if($info['uid']== $mid||is_administrator($mid)){
            $rs = D('cat_info')->where(array('id'=>$aId))->delete();
            if ($rs) {
                D('cat_data')->where($map)->delete();
                D('cat_com')->where($map)->delete();
                D('cat_fav')->where($map)->delete();
            }
            if ($rs) {
                $this->apiSuccess('删除成功！');
            } else {
                $this->apiError('删除失败！');
            }
        }else{
            $this->apiError('您无权限进行删除操作!');
        }

    }
    //推荐信息
    public function getRecomList()
    {
        $aType=I_POST('type','intval');
        $aPage=I_POST('page','intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $order='create_time desc';
        if($aType){
            $CatType = D('Cat/CatEntity')->where(array('status' => 1,'id'=>$aType))->find();
            if(!$CatType){
                $this->apiError('没有该分类');
            }
            $CatList = M('CatInfo')->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => array('status' => 1,'recom'=>1, 'entity_id' => $aType)));
        }else{
            $CatList = M('CatInfo')->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => array('status' => 1,'recom'=>1)));
        }
        foreach ($CatList as &$c) {
            $c=  D('Api/Cat')->getDetail($c);
        }
        if($CatList){
            $this->apiSuccess('返回成功', $CatList);
        }else{
            $this->apiError('该分类下无推荐信息数据');
        }
    }

    //我的收藏信息
    public function getWeFav()
    {
        $mid = $this->requireIsLogin();
        $order='cTime desc';
        $aPage = I_POST('page', 'intval');
        $aEntity_id = I_POST('entity_id', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }

        $FavList=M('CatFav')->where(array('uid'=>$mid,'status'=>1))->page($aPage,10)->order($order)->select();
        foreach ($FavList as $key=>&$c) {
            $c=  D('Api/Cat')->getDetail($c['info_id']);
            if($c==null){
               unset($FavList[$key]);
            }
            if($aEntity_id){
                if($c[$key]['entity_id']==$aEntity_id){
                    $c[]=$c[$key];
                }
            }
        }

        if ($FavList) {
            $this->apiSuccess('获取成功！',$FavList);
        } else {
            $this->apiError('获取失败！');
        }
    }
    //我的发布
    public function getWeSend()
    {
        $mid = $this->requireIsLogin();
        $order='create_time desc';
        $aEntity_id = I_POST('entity_id', 'intval');
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        if($aEntity_id){
            $CatList = M('CatInfo')->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => array('status' => 1, 'uid' => $mid,'entity_id'=>$aEntity_id)));
        }else{
            $CatList = M('CatInfo')->getList(array('field' => 'id', 'order' => $order, 'page' => $aPage, 'where' => array('status' => 1, 'uid' => $mid)));
        }
        foreach ($CatList as &$c) {
            $c= D('Api/Cat')->getDetail($c);
        }
        if ($CatList) {
            $this->apiSuccess('获取成功！',$CatList);
        } else {
            $this->apiError('获取失败！');
        }
    }

    //回复列表
    public function getReply()
    {
        $aPage = I_POST('page', 'intval');
        $aCount = 10;
        $aRowId = I('get.id', '', 'intval');

        if (empty($aPage)) {
            $aPage = 1;
        }

        if (!D('CatInfo')->where(array('id' => $aRowId))->find()) {
            $this->apiError('信息不存在');
        }
        $uid = D('CatInfo')->where(array('id' => $aRowId))->field('uid')->select();
        $uid = array_column($uid, 'uid');

        $CatComments = M('LocalComment')->where(array('app' => 'cat', 'mod' => 'index', 'row_id' => $aRowId, 'status' => 1))->page($aPage, $aCount)->order('create_time asc')->select();
        foreach ($CatComments as &$v) {
            $v['user']= D('Api/User')->getInfo($v['uid']);
            $v['create_time'] = friendlyDate($v['create_time']);
            if (in_array($v['uid'], $uid)) {
                $v['is_landlord'] = '1';
            } else {
                $v['is_landlord'] = '0';
            }
        }
        unset($v);

        $this->apiSuccess('返回成功', $CatComments);
    }


    /*发送评论*/
    public function sendCatReply()
    {
        $mid = $this->requireIsLogin();
        $aRowId = I('get.id', '', 'intval');
        $aContent = I_POST('content', 'op_t');
        $aApp = 'cat';
        $aMod = 'index';
        if (!D('CatInfo')->where(array('id' => $aRowId))->find()) {
            $this->apiError('信息不存在');
        }
        if (!$aContent) {
            $this->apiError('请输入回复内容');
        }
        $data = array('uid' => $mid, 'row_id' => $aRowId, 'parse' => 0, 'mod' => $aMod, 'app' => $aApp, 'content' => $aContent, 'status' => '1', 'create_time' => time());
        $data = D('LocalComment')->create($data);
        if (!$data) return false;
        $result = D('LocalComment')->add($data);
        $uid = M('CatInfo')->where(array('id' => $aRowId))->find();
        $reply = D('LocalComment')->where(array('id' => $result))->find();
        $reply['create_time'] = friendlyDate($reply['create_time']);
        $reply ['user'] = D('Api/User')->getInfo($reply['uid']);
        if ($mid==$uid['uid']) {
            $reply['is_landlord'] = '1';
        } else {
            $reply['is_landlord'] = '0';
        }
        $replys = array($reply);
        $this->apiSuccess('返回成功', $replys);
    }


//删除评论
    public function delCatReply()
    {
        $mid = $this->requireIsLogin();
        $aRowId = I_POST('row_id', 'intval');
        $aId = I('get.id', 'intval');

        $aApp = 'cat';
        $aMod = 'index';
        if (!M('CatInfo')->where(array('id' => $aRowId))->find()) {
            $this->apiError('资讯不存在');
        }
        $Comment =M('LocalComment')->where(array('status' => '1', 'id' => $aId, 'app' => $aApp, 'mod' => $aMod))->find();
        if (!$Comment) {
            $this->apiError('回复不存在');
        }
        if ($Comment['uid'] == $mid || is_administrator($mid)) {
            $res = M('LocalComment')->where(array('uid' => $mid, 'id' => $aId, 'status' => '1'))->setField('status', -1);
            if ($res) {
                $this->apiSuccess('删除成功');
            } else {
                $this->apiError('删除操作失败!');
            }
        } else {
            $this->apiError('无权限操作!');
        }
    }


//我收到的信息
    public function myReceive()
    {
        $mid = $this->requireIsLogin();
        $aRowId = I_POST('row_id','intval');
        $aId = I('get.id','intval');
        $aApp = 'cat';
        $aMod = 'index';
        if (!M('CatInfo')->where(array('id' => $aRowId))->find()) {
            $this->apiError('资讯不存在');
        }
        $Comment =M('LocalComment')->where(array('status' => '1', 'id' => $aId, 'app' => $aApp, 'mod' => $aMod))->find();
        if (!$Comment) {
            $this->apiError('回复不存在');
        }
        if ($Comment['uid'] == $mid || is_administrator($mid)) {
            $res = M('LocalComment')->where(array('uid' => $mid, 'id' => $aId, 'status' => '1'))->setField('status', -1);
            if ($res) {
                $this->apiSuccess('删除成功');
            } else {
                $this->apiError('删除操作失败!');
            }
        } else {
            $this->apiError('无权限操作!');
        }
    }

    public function addCat()
    {
        $mid = $this->requireIsLogin();
        $entity_id = I_POST('entity_id', 0, 'intval');
        $aOverTime = I_POST('over_time', '', 'op_t');
        $entity = D('cat_entity')->find($entity_id);
        if(!$mid){
            $this->apiError('请登陆后操作');
        }
        $info['title'] = I_POST('title', '', 'op_t');
        if ($info['title'] == '') {
            $this->apiError('必须输入标题');

        }
        if (mb_strlen($info['title'], 'utf-8') > 40) {
            $this->apiError('标题过长。');
        }
        $info['create_time'] = time();

        $this->checkAuth('Cat/Index/addInfo',-1,'你没有发布信息的权限！');
        $this->checkActionLimit('cat_add_info','cat_info');
        //新增逻辑
        $info['entity_id'] = $entity_id;
        $info['uid'] = $mid;
        if ($entity['need_active'] && !is_administrator()) {
            $info['status'] = 2;
        } else {
            $info['status'] = 1;
        }
        if (isset($_POST['over_time'])) {
            $info['over_time'] = strtotime($aOverTime);
        }

        $rs_info = D('cat_info')->add($info);
        if($rs_info){
            action_log('cat_add_info','cat_info');
        }

        $rs_data = 1;

        if ($rs_info != 0) //如果info保存成功
        {
            unset($_POST['method']);
            unset($_POST['access_token']);
            unset($_POST['open_id']);
            $dataModel = D('Cat/Data');
            foreach ($_POST as $key => $v) {
                if ($key != 'entity_id' && $key != 'over_time' && $key != 'ignore' && $key != 'info_id' && $key != 'title' && $key != '__hash__' && $key != 'file') {
                    if (is_array($v)) {
                        $rs_data = $rs_data && $dataModel->addData($key, implode(',', $v), $rs_info, $entity_id);
                    } else {
                        $v = filter_content($v);
                        $rs_data = $rs_data && $dataModel->addData($key, $v, $rs_info, $entity_id);
                    }
                }
                if ($rs_data == 0) {
                    $this->apiError('参数不合法，发布失败');
                }
            }
            if ($rs_info && $rs_data) {
                if ($entity['need_active']) {
                    $this->apiSuccess('发布成功,请耐心等待管理员审核!');
                } else {
                    if ($entity['show_nav']) {
                        if(D('Common/Module')->isInstalled('Weibo')){//安装了微博模块
                            $postUrl = "http://$_SERVER[HTTP_HOST]" . U('cat/index/info', array('info_id' => $rs_info), null, true);
                            $weiboModel=D('Weibo/Weibo');
                            $weiboModel->addWeibo("我发布了一个新的 " . $entity['alias'] . "信息 【" . $info['title'] . "】：" . $postUrl);
                        }
                    }
                    $this->apiSuccess('发布成功!');
                }

            }
        } else {
            $this->apiError('发布失败');
        }

    }

}