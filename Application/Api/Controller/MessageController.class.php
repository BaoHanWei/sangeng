<?php


namespace Api\Controller;

class  MessageController extends BaseController
{

//获取消息列表
    public function message()
    {
        $mid = $this->requireIsLogin();
        $aPage = I_POST('page', 'op_t');
        $aCount = I_POST('count', 'op_t');

        $tab = I_POST('tab', 'text');

        if (empty($tab)) {
            $tab = 'unread';
        }
        if (empty($aPage)) {
            $aPage = 1;
        }
        if (empty($aCount)) {
            $aCount = 10;
        }
        $map['to_uid'] = $mid;
        switch ($tab) {
            case 'unread'://未读消息
                $map['is_read'] = '0';
                $messages = D('Message')->where($map)->order('create_time desc')->page($aPage, $aCount)->select();
                foreach ($messages as &$v) {
                    $mapl['id'] = $v['content_id'];
                    $v['content'] = D('MessageContent')->where(array('status' => 1, $mapl))->order('create_time desc')->find();
                    $v['content']= $this->getContent($v['content_id']);

                }
                break;

            case 'all'://全部消息
                $messages = D('Message')->where($map)->order('create_time desc')->page($aPage, $aCount)->select();
                foreach ($messages as &$v) {
                    $mapl['id'] = $v['content_id'];

                    $v['content'] = D('MessageContent')->where(array('status' => 1, $mapl))->order('create_time desc')->find();
                    $v['content']= $this->getContent($v['content_id']);

                }
                break;

            case 'system'://系统消息
                $messages = D('Message')->where($map)->order('create_time desc')->page($aPage, $aCount)->select();
                foreach ($messages as &$v) {
                    $mapl['id'] = $v['content_id'];
                    $mapl['type'] = 0;
                    $v['content'] = D('MessageContent')->where(array('status' => 1, $mapl))->order('create_time desc')->find();
                    $v['content']= $this->getContent($v['content_id']);
                }
                break;

            case 'user'://用户消息
                $messages = D('Message')->where($map)->order('create_time desc')->page($aPage, $aCount)->select();
                foreach ($messages as &$v) {
                    $mapl['id'] = $v['content_id'];
                    $mapl['type'] = 1;
                    $v['content'] = D('MessageContent')->where(array('status' => 1, $mapl))->order('create_time desc')->select();
                    $v['content']= $this->getContent($v['content_id']);

                }
                break;
//                $key =>
            case 'app'://应用消息
                $messages = D('Message')->where($map)->order('create_time desc')->page($aPage, $aCount)->select();
                foreach ($messages as $key => &$v) {


                    $v['content']= $this->getContent($v['content_id']);

//                    $v['content']['args'] = json_decode($v['content']['args'], true);
                    if ($v['content'] == null) {
                        unset($messages[$key]);
                    }
                }
                break;
        }
//dump($messages);exit;


        foreach ($messages as &$o) {
            if ($o['from_uid'] != 0) {
                $o['from_user'] = D('Api/User')->getUserInfo($o['from_uid']);
            }
            $o['create_time']=friendlyDate($o['create_time']);
            $o['last_toast']=friendlyDate($o['last_toast']);
            $arr = 'Book,Cat,Event,Forum,Group,Mob,News,Paper,People,Question,Rcard,Recharge,Shop,Ucenter,User,Weibo,Weixin,weibo,book,cat,event.forum,group,mob,news,paper,people,question,rcard,recharge,shop,ucenter,user,weibo';
            $keys = explode(',', $arr);

            foreach ($keys as $key => &$l) {
                if (strpos($o['content']['url'], $l) !== false) {
                    $o['model'] = strtolower($keys[$key]);
                }
            }
            if (!$o['model']) {
                $o['model'] = 'ucenter';
            }
        }
        if (!$messages) {
            $this->apiError('返回失败');
        }
        $this->apiSuccess('返回成功', $messages);

    }

    public function setAllReaded()
    {
        $uid = $this->requireIsLogin();
        $id = I_POST('id','intval');
        if($id){
            $messages = D('message')->where(array('to_uid='=> $uid, 'is_read'=>0 ,'id'=>$id))->setField('is_read', 1);
        }else{

            $messages = D('message')->where(array('to_uid='=> $uid, 'is_read'=>0))->setField('is_read', 1);
        }

        if ($messages) {
            $this->apiSuccess('设置成功');
        } else {
            $this->apiError('设置失败');
        }
    }


    /**获取所有信息分类*/
    public function getMessageType()
    {
        $type = D('message_content')->where(array('status' => 1))->field('type')->select();
        $types = array_column($type, 'type');
        $MessageType = array_unique($types);
        $list = array('list' => $MessageType);
        $this->apiSuccess('返回成功', $list);
    }
    public function getContent($id)
    {
        $content = S('message_content_' . $id);
        if (empty($content)) {
            $content = D('message_content')->find($id);
            if($content){
                $content['args'] = json_decode($content['args'],true);
                $content['args_json'] = json_encode($content['args']) ;
            }
            S('message_content_' . $id, $content, 60 * 60);
        }

        return $content;
    }
}