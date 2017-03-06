<?php


namespace Api\Controller;


class EventController extends BaseController
{
    /* 获取当前分类信息 */
    public function getEventModules()
    {
        $aPage = I('page', 1, 'intval');

        $EventModules = D('Event/EventType')->where(array('status' => 1, 'pid' => 0))->page($aPage, 10)->order('create_time asc')->select();
        foreach ($EventModules as &$e) {
            $e['EventSecond'] = D('Event/EventType')->where(array('status' => 1, 'pid' => $e['id']))->select();
        }
        unset($e);
        $this->apiSuccess('返回成功', $EventModules);
    }


    /* 获取某一个分类的活动信息 */
    public function getEventsAll()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aId = I_POST('type_id', 'intval');
        $map['status'] = 1;

        $EventModel = D('Api/Event');
        $mid = $this->isLogin();
        if ($aId) {
            $map['type_id'] = $aId;
            $event = D('Event/Event')->getList(array('field' => 'id', 'page' => $aPage, 'where' => $map));
        } else {
            $event = D('Event/Event')->getList(array('field' => 'id', 'page' => $aPage, 'where' => $map));
        }

        foreach ($event as &$v) {
            $v = $EventModel->getEvent($v, $mid);
        }
        unset($v);
        if($event){
            $this->apiSuccess('返回成功', $event);
        }else{
            $this->apiError('没有活动数据');
        }

    }

    public function getRecommend()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $EventModel = D('Api/Event');
        $mid = $this->isLogin();
        $map['is_recommend'] = 1;
        $rand_event = D('Event/Event')->getList(array('field' => 'id', 'page' => $aPage, 'where' => $map, 'limit' => 2, 'order' => 'rand()'));
        foreach ($rand_event as &$v) {
            $v = $EventModel->getEvent($v, $mid);
        }
        unset($v);
        if (!$rand_event) {
            $this->apiError('没有推荐活动');
        }

        $this->apiSuccess('返回成功', $rand_event);
    }

    /* 获取我的活动信息 */
    public function getWeEvents()
    {
        $mid = $this->requireisLogin();
        $aPage = I_POST('page', 'intval');
        $lora = I_POST('lora', 'text');//我加入的活动 不填则是我创建的活动
        $type_id = I_POST('type_id', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        if ($type_id != 0) {
            $map['type_id'] = $type_id;
        }
        $map['status'] = 1;
        $order = 'create_time desc,signCount desc';
        if ($lora == 'attend') {
            $attend = D('event_attend')->where(array('uid' => $mid))->select();
            $enentids = getSubByKey($attend, 'event_id');
            $map['id'] = array('in', $enentids);
        } else {
            $map['uid'] = $mid;
        }
        $content = D('Event/Event')->where($map)->order($order)->page($aPage,10)->select();
        foreach ($content as &$v) {
            $v['user'] = D('Api/User')->getUserSimpleInfo($v['uid']);
            $type = $this->getType($v['type_id']);
            $v['type_title']=$type['title'];
            $v['check_isSign'] = D('event_attend')->where(array('uid' => $mid, 'event_id' => $v['id']))->select();
            $ids = D('Event/EventAttend')->where(array('event_id' => $v['id'], 'uid' =>$mid))->find();
            if ($ids['status'] == 0) {
                $v['is_pass'] = '0';
            } else {
                $v['is_pass'] = '1';
            }
            if($v['deadline']>time()){
                $v['is_deadline']=0;
            }else{
                $v['is_deadline']=1;
            }
            if($v['eTime']>time()){
                $v['is_end']=0;
            }else{
                $v['is_end']=1;
            }
            $v['eTime']= date("Y-m-d",$v['eTime']);
            $v['sTime']= date("Y-m-d",$v['sTime']);
            $v['deadline']= time_format($v['deadline']);
            if ($v['cover_id'] == 0) {
                $v['cover_url'] = '';
            } else {
                $v['cover_url']['ori'] = render_picture_path_without_root(get_cover($v['cover_id'], 'path'));
                $v['cover_url']['thumb'] = render_picture_path_without_root(getThumbImageById($v['cover_id'], 120, 120));
                $v['cover_url']['banana'] = render_picture_path_without_root(getThumbImageById($v['cover_id'], 400, 292));
            }
        }
        unset($v);
        if($content){
            $this->apiSuccess('返回成功', $content);
        }else {
            $this->apiError('没有活动数据');
        }
    }


    /* 获取参与活动的人信息 */
    public function getPeopleInfoEvents()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aEventId = I('get.id', '', 'intval');
        $map['status'] = 1;
        $map['event_id']=$aEventId;
        if (!D('Event/Event')->where($map)->find()) {
            $this->apiError('活动不存在！');
        }
        $event = D('Event/EventAttend')->where(array( 'page' => $aPage, 'event_id'=>$aEventId))->select();
        if ($event) {
            foreach ($event as &$v) {
                $v['user'] = query_user(array('uid', 'username', 'nickname', 'avatar128'), $v['uid']);
            }
        } else {
            $this->apiError('此活动暂无人参加');
        }
        $this->apiSuccess('返回成功', $event);
    }

    /*活动详情*/
    public function eventDetail()
    {
        $mid = $this->isLogin();
        $aId = I('get.id', '', 'intval');

        $Event = D('Api/Event')->getEvent($aId, $mid);
        if (!$Event) {
            $this->apiError('活动不存在！');
        }

        $this->apiSuccess('返回成功', $Event);
    }


    /* 参加活动报名*/
    public function joinEvents()
    {
        $mid = $this->requireIsLogin();
        $aEventId = I_POST('event_id', 'intval');
        $map['status'] = 1;
        $aEventId && $map['event_id'] = $aEventId;
        $aName = I_POST('name', 'op_h');
        $aPhone = I_POST('phone', 'op_t');
        $Event = D('Event/Event')->where(array('id' => $aEventId))->find();

        if (!$Event) {
            $this->apiError('活动不存在！');
        }
        if ($Event['deadline'] < time()) {
            $this->apiError('报名已经截止。');
        }
        if (!$mid) {
            $this->apiError('请登陆后再报名。');
        }
        if (!$aEventId) {
            $this->apiError('参数错误。');
        }
        if (trim(op_t($aName)) == '') {
            $this->apiError('请输入姓名。');
        }
        if (trim($aPhone) == '') {
            $this->apiError('请输入手机号码。');
        }
        $dope = D('event_attend')->where(array('uid' => $mid, 'event_id' => $aEventId))->select();
        if (!$dope) {
            $data['uid'] = $mid;
            $data['event_id'] = $aEventId;
            $data['name'] = $aName;
            $data['phone'] = $aPhone;
            $data['create_time'] = time();
            $data['status'] = 0;
            $news = D('Event/Event_attend')->add($data);
            if ($news) {
                $dope = D('event_attend')->where(array('uid' => $mid, 'event_id' => $aEventId))->select();
                D('Common/Message')->sendMessageWithoutCheckSelf($dope['uid'], get_nickname( $mid) . '报名参加了活动[' . $Event['title'] . ']，请速去审核！', '报名通知', U('Event/Index/member', array('id' => $aEventId)), $mid);
                D('Event/Event')->where(array('id' => $aEventId))->setInc('signCount');
//                $list['title']='活动';
//                $list['content']=get_nickname( $mid) . '报名参加了活动[' . $Event['title'] . ']，请速去审核！';
//                $list['message']='报名通知';
//                $list['event_id']=$aEventId;
//                $list['message_type']='event';
//                $arr=array($Event['uid']);
//                $list['cids']=D('Api/User')->getUserCID($arr);
//                D('Api/Igt')->pushMessageToSingle(4,$list);
                $this->apisuccess('报名成功。');
            } else {
                $this->apiError('报名失败。');
            }
        } else {
            $this->apiError('您已经报过名了。');
        }
    }


    /* 删除活动报名*/
    public function endJoin()
    {
        $mid = $this->requireIsLogin();
        $aEventId = I_POST('event_id', 'intval');
        $event_content = D('Event')->where(array('status' => 1, 'id' => $aEventId))->find();
        if (!$event_content) {
            $this->apiError('您还未报过名了。');
        }

        $check = D('event_attend')->where(array('uid' => $mid, 'event_id' => $aEventId))->find();
        if ($mid == $event_content['uid']) {
            $this->apiError('活动发起者不能退出报名');
        } else {
            $res = D('event_attend')->where(array('uid' => $mid, 'event_id' => $aEventId))->delete();
        }

        if ($res) {
            if ($check['status']) {
                D('Event')->where(array('id' => $aEventId))->setDec('attentionCount');
            }
            D('Event')->where(array('id' => $aEventId))->setDec('signCount');

            D('Common/Message')->sendMessageWithoutCheckSelf($event_content['uid'], '取消报名通知',get_nickname( $mid) . '取消了对活动[' . $event_content['title'] . ']的报名', 'Event/Index/detail', array('id' => $aEventId));
//            $list['title']='活动';
//            $list['content']=get_nickname( $mid) . '取消了对活动[' . $event_content['title'] . ']的报名';
//            $list['message']='取消报名通知';
//            $list['event_id']=$aEventId;
//            $list['message_type']='event';
//            $arr=array($event_content['uid']);
//            $list['cids']=D('Api/User')->getUserCID($arr);
//            D('Api/Igt')->pushMessageToSingle(4,$list);
            $this->apiSuccess('删除成功');
        } else {
            $this->apiError('删除失败');
        }
    }


    // 返回某个活动的评论列表
    public function getEventComments()
    {

        $aPage = I_POST('page', 'intval');
        $aRowId = I_POST('row_id', 'intval');
        if (!D('Event/Event')->where(array('id' => $aRowId))->find()) {
            $this->apiError('活动不存在');
        }
        $uid = D('Event/Event')->where(array('id' => $aRowId))->field('uid')->select();
        $uid = array_column($uid, 'uid');
        $arr = array();
        $IssueComments = D('Event/LocalComment')->where(array('app' => 'Event', 'mod' => 'event', 'row_id' => $aRowId, 'status' => 1))->page($aPage, 10)->order('create_time desc')->select();

        foreach ($IssueComments as &$v) {
            preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/", $v['content'], $arr); //匹配所有的图片
            $v['imgList'] = $arr[1];
            $v['content'] = op_t($v['content']);
            $v['user'] = D('Api/User')->getUserSimpleInfo($v['uid']);
            $v['create_time'] = friendlyDate($v['create_time']);

            if (in_array($v['uid'], $uid)) {
                $v['is_landlord'] = '1';
            } else {
                $v['is_landlord'] = '0';
            }
        }
        unset($v);
        $list = array('list' => $IssueComments);
        $this->apiSuccess('返回成功', $list);

    }

    /*发送活动评论*/
    public function sendEventComment()
    {
        $mid = $this->requireisLogin();
        $aRowId = I_POST('row_id', 'intval');
        $aContent = I_POST('content', 'op_h');
        $aApp = 'Event';
        $aMod = 'event';
        if (!D('Event/Event')->where(array('id' => $aRowId))->find()) {
            $this->apiError('活动不存在');
        }
        if (!$aContent) {
            $this->apiError('请填写评论信息！');
        }
        $data = array('uid' => $mid, 'row_id' => $aRowId, 'parse' => 0, 'mod' => $aMod, 'app' => $aApp, 'content' => text($aContent), 'status' => '1', 'create_time' => time());
        $result = D('LocalComment')->add($data);
        D('Event/Event')->where(array('status' => 1, 'id' => $aRowId))->setInc('reply_count');
        $reply = D('LocalComment')->where(array('id' => $result))->find();
        $reply['content'] = text($reply['content']);
        $reply ['user'] = D('Api/User')->getUserSimpleInfo($reply['uid']);
        $this->apiSuccess('返回成功', $reply);
    }

    /*提前关闭*/
    public function endEvents()
    {
        $mid = $this->requireisLogin();
        $aEvent_id = I('get.id','','intval');
        $Event = D('Event/Event')->where(array('id' => $aEvent_id))->find();

        if (!$Event) {
            $this->apiError('活动不存在！');
        }
        //判断是否有权限提前关闭活动
        if ($Event['uid'] == $mid || is_administrator($mid)){
            $news = D('Event/Event')->where(array('status' => 1, 'id' => $aEvent_id))->setField('eTime', time());
            if ($news) {
                $this->apiSuccess('提前关闭成功！');
            } else {
                $this->apiError('提前关闭失败！');
            }
        } else {
            $this->apiError('非活动发起者操作！');
        }
    }

    /* 删除活动*/
    public function deleteEvents()
    {
        $mid = $this->requireisLogin();
        $aEventId = I('get.id','', 'intval');
        $Events = D('Event/Event')->where(array('id' => $aEventId))->find();
        if (!$Events) {
            $this->apiError('活动不存在！');
        }
        if ($Events['uid'] == $mid || is_administrator($mid)) {
            $res = D('Event/Event')->where(array('status' => 1, 'id' => $aEventId))->setField('status', 0);
            if ($res) {
                $this->apisuccess('删除成功！');
            } else {
                $this->apiError('操作失败！');
            }
        } else {
            $this->apiError('非活动发起者操作！');
        }
    }


    public function delCommont()
    {
        $mid = $this->requireIsLogin();
        $aId= I_POST('id', 'intval');
        $aRowId = I_POST('row_id', 'intval');
        $aApp = 'Event';
        $aMod = 'event';
        $res=  D('LocalComment')->where(array('row_id' => $aRowId,'id'=>$aId))->find();
        if (!$res) {
            $this->apiError('活动不存在');
        }
        if ($mid!=$res['uid'] && !is_administrator($mid)) {
            $this->apiError('您无权删除');
        }
        $result = D('LocalComment')->where(array('id'=>$aId,'uid' => $mid, 'row_id' => $aRowId, 'parse' => 0, 'mod' => $aMod, 'app' => $aApp))->delete();
        if ($result) {
            $this->apisuccess('删除成功！');
        } else {
            $this->apiError('操作失败！');
        }
    }


    /* 发起或者编辑活动*/
    public function addEvents()
    {
        $mid = $this->requireisLogin();
        $aStime = I_POST('sTime');
        $aDeadline = I_POST('deadline');
        $aAddress = I_POST('address', 'op_h');
        $aExplain = I_POST('explain', 'op_h');
        $aTypeId = I_POST('type_id', 'intval');
        $aTitle = I_POST('title', 'op_t');
        $aCover_id = I_POST('cover_id', 'intval');
        $aEtime = I_POST('eTime');
        $aLimitCount = I_POST('limitCount', 'intval');
        $aId = I('get.id', '', 'intval');


        if (!$aCover_id) {
            $this->apiError('请上传封面。');
        }
        if (!$aLimitCount) {
            $this->apiError('请输入限制人数。');
        }
        if (trim(op_t($aTitle)) == '') {
            $this->apiError('请输入标题。');
        }
        if ($aTypeId == 0) {
            $this->apiError('请选择分类。');
        }
        if (trim(op_h($aExplain)) == '') {
            $this->apiError('请输入内容。');
        }
        if (trim(op_h($aAddress)) == '') {
            $this->apiError('请输入地点。');
        }
        if (trim(op_h($aAddress)) == '') {
            $this->apiError('请输入地点。');
        }
        if ($aStime < $aDeadline) {
            $this->apiError('报名截止不能大于活动开始时间');
        }
        if ($aDeadline == '') {
            $this->apiError('请输入截止日期');
        }
        if ($aStime > $aEtime) {
            $this->apiError('活动开始时间不能大于活动结束时间');
        }
        $data = D('Event/Event')->create();
        $data['explain'] = $aExplain;
        $data['title'] = $aTitle;
        $data['sTime'] = strtotime($aStime);
        $data['eTime'] =strtotime($aEtime);
        $data['cover_id'] = $aCover_id;
        $data['deadline'] =  strtotime($aDeadline);
        $data['type_id'] = $aTypeId;
        $data['address'] = $aAddress;
        $data['limitCount'] = $aLimitCount;
        $data['create_time'] = time();
        $data['update_time'] = time();
        $data['uid'] = $mid;
        //根据id查看是否已有活动
        if ($aId) {
            $contentAlready = D('Event/Event')->find($aId);
            $this->ApiCheckAuth('Event/Index/edit', $contentAlready['uid'], '无权编辑');
            $this->checkActionLimit('add_event', 'event', $aId, $mid, true);
            $content['uid'] = $contentAlready['uid']; //权限矫正，防止被改为管理员
            $result = D('Event/Event')->where(array('id' => $aId))->save($data);
            if (D('Common/Module')->isInstalled('Weibo')) { //安装了微博模块
                //同步到微博
                $postUrl = "http://$_SERVER[HTTP_HOST]" . U('Event/Index/detail', array('id' => $result));

                $weiboModel = D('Weibo/Weibo');
                $weiboModel->addWeibo("我发布了一个新的活动【" . $aTitle . "】：" . $postUrl);
            }
            if ($result) {
                $this->apisuccess('编辑成功。');
            } else {
                $this->apiError('编辑失败。', '');
            }
        } else {
            $this->ApiCheckAuth('Event/Index/add', -1, '无权发布');
            $this->checkActionLimit('add_event', 'event', 0, $mid, true);
            if (modC('NEED_VERIFY', 0, 'event') && !is_administrator($mid)) //需要审核且不是管理员
            {
                $data['status'] = 0;
                $user = query_user(array('username', 'nickname'), $mid);
                D('Common/Message')->sendMessage(C('USER_ADMINISTRATOR'), "{$user['nickname']}发布了一个活动，请到后台审核。", $title = '活动发布提醒', 'Admin/Event/verify', array(), $mid, 2);

            } else {
                $data['status'] = 1;
            }
            $data['attentionCount'] = 1;
            $data['signCount'] = 1;
            $aId = D('Event/Event')->add($data);
            if (D('Common/Module')->isInstalled('Weibo')) { //安装了微博模块
                //同步到微博
                $postUrl = "http://$_SERVER[HTTP_HOST]" . U('Event/Index/detail', array('id' => $aId));

                $weiboModel = D('Weibo/Weibo');
                $weiboModel->addWeibo("我发布了一个新的活动【" . $aTitle . "】：" . $postUrl);
            }
            $adinfo['uid'] = $mid;
            $adinfo['event_id'] = $aId;
            $adinfo['create_time'] = time();
            $adinfo['status'] = 1;
            D('event_attend')->add($adinfo);

            $NewEvent = M('Event')->find($aId);

            if (!$NewEvent) {
                $this->apiError('活动发布失败。');
            }
            if ($NewEvent['status'] == 1) {
                $this->apiSuccess('活动发布成功 。', $NewEvent);
            }
            if ($NewEvent['status'] == 0) {
                $this->apiSuccess('活动发布成功。但需管理员审核通过后才会显示在列表中，请耐心等待。');
            }
        }
    }

    public function shenhe($tip)
    {
        $mid = $this->requireIsLogin();
        $aEventId = I_POST('id', 'intval');

        $event_content = D('Event')->where(array('status' => 1, 'id' => $aEventId))->find();
        if (!$event_content) {
            $this->apierror('活动不存在！');
        }
        if ($event_content['uid'] == $mid) {
            $res = D('Event/EventAttend')->where(array('uid' => $mid, 'event_id' => $aEventId))->setField('status', $tip);
            if ($tip) {
                D('Event/Event')->where(array('id' => $aEventId))->setInc('attentionCount');
                D('Common/Message')->sendMessageWithoutCheckSelf($mid, get_nickname( $mid) . '已经通过了您对活动' . $event_content['title'] . '的报名请求', '审核通知', U('Event/Index/detail', array('id' => $aEventId)), $mid);
//                $list['title']='活动';
//                $list['content']= get_nickname( $mid) . '已经通过了您对活动' . $event_content['title'] . '的报名请求';
//                $list['message']='审核通知';
//                $list['event_id']=$aEventId;
//                $list['message_type']='event';
//                $arr=array($mid);
//                $list['cids']=D('Api/User')->getUserCID($arr);
//                D('Api/Igt')->pushMessageToSingle(4,$list);

            } else {
                D('Event/Event')->where(array('id' => $aEventId))->setDec('attentionCount');
                D('Common/Message')->sendMessageWithoutCheckSelf($mid, get_nickname( $mid) . '取消了您对活动[' . $event_content['title'] . ']的报名请求', '取消审核通知', U('Event/Index/member', array('id' => $aEventId)), $mid);
//                $list['title']='活动';
//                $list['content']=get_nickname( $mid) . '取消了您对活动[' . $event_content['title'] . ']的报名请求';
//                $list['message']='取消审核通知';
//                $list['event_id']=$aEventId;
//                $list['message_type']='event';
//                $arr=array($mid);
//                $list['cids']=D('Api/User')->getUserCID($arr);
//                D('Api/Igt')->pushMessageToSingle(4,$list);
            }
            if ($res) {
                $this->apisuccess('操作成功');
            } else {
                $this->apierror('操作失败！');
            }
        } else {
            $this->apierror('操作失败，非活动发起者操作！');
        }
    }

    private function getType($type_id)
    {
        $type = D('EventType')->where('id=' . $type_id)->find();
        return $type;
    }
}