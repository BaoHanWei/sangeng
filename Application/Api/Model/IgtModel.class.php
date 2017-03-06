<?php

/**
 * Created by PhpStorm.
 * User: 胡佳雨
 */
namespace Api\Model;

use Think\Model;


require_once(VENDOR_PATH . 'igetui/IGtPush.php');
require_once(VENDOR_PATH . 'protobuf/pbmessage.php');
require_once(VENDOR_PATH . 'exception/RequestException.php');
require_once(VENDOR_PATH . 'igetui/IGtReq.php');
require_once(VENDOR_PATH . 'igetui/IGtMessage.php');
require_once(VENDOR_PATH . 'igetui/IGtAppMessage.php');
require_once(VENDOR_PATH . 'igetui/IGtListMessage.php');
require_once(VENDOR_PATH . 'igetui/IGtSingleMessage.php');
require_once(VENDOR_PATH . 'igetui/IGtAPNPayload.php');
require_once(VENDOR_PATH . 'igetui/IGtTarget.php');
require_once(VENDOR_PATH . 'igetui/template/IGtBaseTemplate.php');
require_once(VENDOR_PATH . 'igetui/template/IGtLinkTemplate.php');
require_once(VENDOR_PATH . 'igetui/template/IGtNotificationTemplate.php');
require_once(VENDOR_PATH . 'igetui/template/IGtTransmissionTemplate.php');
require_once(VENDOR_PATH . 'igetui/template/IGtNotyPopLoadTemplate.php');
require_once(VENDOR_PATH . 'igetui/template/IGtAPNTemplate.php');

/*推送的配置文件*/
define('ITGSWITCH', modC('IGT_OPEN',0,'Api'));        //是否开启了推送功能
define('APPID', modC('IGT_APPID','','Api'));
define('APPKEY', modC('IGT_APPKEY','','Api'));
define('MASTERSECRET', modC('IGT_MASTERSECRET','','Api'));
define('HOST', 'http://sdk.open.api.igexin.com/apiex.htm');


class IgtModel extends Model
{

//所有推送接口均支持四个消息模板，依次为通知弹框下载模板，通知链接模板，通知打开app模板，透传模板
//注：IOS离线推送需通过APN进行转发，需填写pushInfo字段，目前仅不支持通知弹框下载功能

    //通知弹框下载模板
    function IGtNotyPopLoadTemplate(){
        $template =  new \IGtNotyPopLoadTemplate();

        $template ->set_appId(APPID);//应用appid
        $template ->set_appkey(APPKEY);//应用appkey
        //通知栏
        $template ->set_notyTitle("个推");//通知栏标题
        $template ->set_notyContent("个推最新版点击下载");//通知栏内容
        $template ->set_notyIcon("");//通知栏logo
        $template ->set_isBelled(true);//是否响铃
        $template ->set_isVibrationed(true);//是否震动
        $template ->set_isCleared(true);//通知栏是否可清除
        //弹框
        $template ->set_popTitle("弹框标题");//弹框标题
        $template ->set_popContent("弹框内容");//弹框内容
        $template ->set_popImage("");//弹框图片
        $template ->set_popButton1("下载");//左键
        $template ->set_popButton2("取消");//右键
        //下载
        $template ->set_loadIcon("");//弹框图片
        $template ->set_loadTitle("地震速报下载");
        $template ->set_loadUrl("http://dizhensubao.igexin.com/dl/com.ceic.apk");
        $template ->set_isAutoInstall(false);
        $template ->set_isActived(true);
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息

        return $template;
    }

    //通知链接模板
    function IGtLinkTemplate(){
        $template =  new \IGtLinkTemplate();
        $template ->set_appId(APPID);//应用appid
        $template ->set_appkey(APPKEY);//应用appkey
        $template ->set_title("请输入通知标题");//通知栏标题
        $template ->set_text("请输入通知内容");//通知栏内容
        $template ->set_logo("");//通知栏logo
        $template ->set_isRing(true);//是否响铃
        $template ->set_isVibrate(true);//是否震动
        $template ->set_isClearable(true);//通知栏是否可清除
        $template ->set_url("http://www.igetui.com/");//打开连接地址
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //iOS推送需要设置的pushInfo字段
//        $apn = new IGtAPNPayload();
//        $apn->alertMsg = "alertMsg";
//        $apn->badge = 11;
//        $apn->actionLocKey = "启动";
//    //        $apn->category = "ACTIONABLE";
//    //        $apn->contentAvailable = 1;
//        $apn->locKey = "通知栏内容";
//        $apn->title = "通知栏标题";
//        $apn->titleLocArgs = array("titleLocArgs");
//        $apn->titleLocKey = "通知栏标题";
//        $apn->body = "body";
//        $apn->customMsg = array("payload"=>"payload");
//        $apn->launchImage = "launchImage";
//        $apn->locArgs = array("locArgs");
//
//        $apn->sound=("test1.wav");;
//        $template->set_apnInfo($apn);
        return $template;
    }

    //通知打开app模板
    function IGtNotificationTemplate($data){
        $template =  new \IGtNotificationTemplate();
        $template->set_appId(APPID);//应用appid
        $template->set_appkey(APPKEY);//应用appkey
        $template->set_transmissionType(2);//透传消息类型,收到消息是否立即启动应用：1为立即启动，2则广播等待客户端自启动
        $template->set_transmissionContent("这里是透传消息");//透传内容
        $template->set_isRing(true);//是否响铃
        $template->set_isVibrate(true);//是否震动
        $template->set_isClearable(true);//通知栏是否可清除
        $template->set_title($data['title']);//通知栏标题
        $template->set_text($data['content']);//通知栏内容
        $template->set_logo('http://upload.opensns.cn/Uploads_Avatar_7082_572b049f121c6.png?imageMogr2/crop/!110x110a0a0/thumbnail/128x128!');//通知栏logo
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //iOS推送需要设置的pushInfo字段
//        $apn = new \IGeTui\IGtAPNPayload();
//        $apn->alertMsg = "alertMsg";
//        $apn->badge = 11;
//        $apn->actionLocKey = "启动";
//            $apn->category = "ACTIONABLE";
//            $apn->contentAvailable = 1;
//        $apn->locKey = "通知栏内容";
//        $apn->title = "通知栏标题";
//        $apn->titleLocArgs = array("titleLocArgs");
//        $apn->titleLocKey = "通知栏标题";
//        $apn->body = "body";
//        $apn->customMsg = array("payload"=>"payload");
//        $apn->launchImage = "launchImage";
//        $apn->locArgs = array("locArgs");
//
//        $apn->sound=("test1.wav");;
//        $template->set_apnInfo($apn);
        return $template;
    }

    //透传消息模板
    function IGtTransmissionTemplate($data){
        $template =  new \IGtTransmissionTemplate();
        $template->set_appId(APPID);//应用appid
        $template->set_appkey(APPKEY);//应用appkey
        $template->set_transmissionType(2);//透传消息类型
        $template->set_transmissionContent($data);//透传内容
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //APN简单推送
//        $template = new IGtAPNTemplate();
//        $apn = new IGtAPNPayload();
//        $alertmsg=new SimpleAlertMsg();
//        $alertmsg->alertMsg="";
//        $apn->alertMsg=$alertmsg;
////        $apn->badge=2;
////        $apn->sound="";
//        $apn->add_customMsg("payload","payload");
//        $apn->contentAvailable=1;
//        $apn->category="ACTIONABLE";
//        $template->set_apnInfo($apn);
//        $message = new IGtSingleMessage();

        //APN高级推送
//        $apn = new IGtAPNPayload();
//        $alertmsg=new DictionaryAlertMsg();
//        $alertmsg->body="body";
//        $alertmsg->actionLocKey="ActionLockey";
//        $alertmsg->locKey="LocKey";
//        $alertmsg->locArgs=array("locargs");
//        $alertmsg->launchImage="launchimage";
////        IOS8.2 支持
//        $alertmsg->title="Title";
//        $alertmsg->titleLocKey="TitleLocKey";
//        $alertmsg->titleLocArgs=array("TitleLocArg");
//
//        $apn->alertMsg=$alertmsg;
//        $apn->badge=7;
//        $apn->sound="";
//        $apn->add_customMsg("payload","payload");
//        $apn->contentAvailable=1;
//        $apn->category="ACTIONABLE";
//        $template->set_apnInfo($apn);

        //PushApn老方式传参
//    $template = new IGtAPNTemplate();
//          $template->set_pushInfo("", 10, "", "com.gexin.ios.silence", "", "", "", "");

        return $template;
    }

//服务端推送接口，支持三个接口推送
//1.PushMessageToSingle接口：支持对单个用户进行推送
//2.PushMessageToList接口：支持对多个用户进行推送，建议为50个用户
//3.pushMessageToApp接口：对单个应用下的所有用户进行推送，可根据省份，标签，机型过滤推送

    /**单推接口案例(当推送的目标不是很多时建议也使用单推)
     * @param array $uidList 用户第列表
     * @param object $data 推送数据
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    function pushMessageToSingle($uidList,$data){
        if(ITGSWITCH){      //判断是否开启推送服务
            $igt = new \IGeTui(HOST,APPKEY,MASTERSECRET);
            $template =  $this->IGtTransmissionTemplate($data);
            $cidList = array();
            $tidList = array();  //android的cid和tid相同，而IOS的tid和cid不相同
            foreach($uidList as $uid){
                $user = M('UserLocation')->where(array('uid'=>$uid))->find();
                array_push($cidList,$user['ClientID']);
                array_push($tidList,$user['token']);
            }
            //个推信息体
            $message = new \IGtSingleMessage();

            $message->set_isOffline(true);//是否离线
            $message->set_offlineExpireTime(3600*1000*12);//离线时间
            $message->set_data($template);//设置推送消息类型
            //$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
            //接收方
            foreach($cidList as $cid){
                $target = new \IGtTarget();
                $target->set_appId(APPID);
                $target->set_clientId($cid);
                try {
                    $rep = $igt->pushMessageToSingle($message, $target);//在线发送成功
                }catch(\RequestException $e){
                    $requstId =$e->getRequestId();
                    $rep = $igt->pushMessageToSingle($message, $target,$requstId);      //不在线时
                }
            }
        }
    }

    /**
     * @param array $uidList
     * @param object $data
     * @throws \Exception
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    function pushMessageToList($uidList,$data){
        putenv("needDetails=true");
        $igt = new \IGeTui(HOST,APPKEY,MASTERSECRET);
        //$igt = new IGeTui('',APPKEY,MASTERSECRET);//此方式可通过获取服务端地址列表判断最快域名后进行消息推送，每10分钟检查一次最快域名
        //消息模版：
        // 1.TransmissionTemplate:透传功能模板
        // 2.LinkTemplate:通知打开链接功能模板
        // 3.NotificationTemplate：通知透传功能模板
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板

        $template = $this->IGtTransmissionTemplate($data);
//        $template = IGtLinkTemplateDemo();
        //$template = IGtNotificationTemplateDemo();
        //$template = IGtTransmissionTemplateDemo();

        //个推信息体
        $message = new \IGtListMessage();
        $message->set_isOffline(true);//是否离线
        $message->set_offlineExpireTime(3600*12*1000);//离线时间
        $message->set_data($template);//设置推送消息类型
        $message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
        $contentId = $igt->getContentId($message);
        //接收方1
        $target1 = new \IGtTarget();
        $target1->set_appId(APPID);
        $target1->set_clientId('1662bac9a84320dcdbbd0d6fd5da46af');

//        $target2 = new \IGtTarget();
//        $target2->set_appId(APPID);
//        $target2->set_clientId('a7a876f369c6af840c92bd5a53973ac0');

        $targetList[] = $target1;
        $rep = $igt->pushMessageToList($contentId, $targetList);
    }


    //IOS单推
    public function pushAPN()
    {
        //APN简单推送
        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
        $template = new \IGtAPNTemplate();
        $apn = new \IGeTui\IGtAPNPayload();
        $alertmsg = new \IGeTui\SimpleAlertMsg();
        $alertmsg->alertMsg = "";
        $apn->alertMsg = $alertmsg;
//        $apn->badge=2;
        $apn->sound = "";
        $apn->add_customMsg("payload", "payload");
        $apn->contentAvailable = 1;
        $apn->category = "ACTIONABLE";
        $template->set_apnInfo($apn);
        $message = new \IGtSingleMessage();

        //APN高级推送
        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
        $template = new \IGtAPNTemplate();
        $apn = new \IGeTui\IGtAPNPayload();
        $alertmsg = new \IGeTui\DictionaryAlertMsg();
        $alertmsg->body = "body";
        $alertmsg->actionLocKey = "ActionLockey";
        $alertmsg->locKey = "LocKey";
        $alertmsg->locArgs = array("locargs");
        $alertmsg->launchImage = "launchimage";
//        IOS8.2 支持
        $alertmsg->title = "Title";
        $alertmsg->titleLocKey = "TitleLocKey";
        $alertmsg->titleLocArgs = array("TitleLocArg");

        $apn->alertMsg = $alertmsg;
        $apn->badge = 7;
        $apn->sound = "test1.wav";
        $apn->add_customMsg("payload", "payload");
        $apn->contentAvailable = 1;
        $apn->category = "ACTIONABLE";
        $template->set_apnInfo($apn);
        $message = new \IGtSingleMessage();

        //PushApn老方式传参
//    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//    $template = new IGtAPNTemplate();
//    $template->set_pushInfo("actionLocKey", 6, "body", "", "payload", "locKey", "locArgs", "launchImage",1);
//    $message = new IGtSingleMessage();
////
//    $message->set_data($template);
        $ret = $igt->pushAPNMessageToSingle(APPID, DEVICETOKEN, $message);
        return $ret;
    }

    //IOS群推
    public function pushAPNL()
    {

        //APN简单推送
//        $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//        $template = new IGtAPNTemplate();
//        $apn = new IGtAPNPayload();
//        $alertmsg=new SimpleAlertMsg();
//        $alertmsg->alertMsg="";
//        $apn->alertMsg=$alertmsg;
////        $apn->badge=2;
////        $apn->sound="";
//        $apn->add_customMsg("payload","payload");
//        $apn->contentAvailable=1;
//        $apn->category="ACTIONABLE";
//        $template->set_apnInfo($apn);
//        $message = new IGtSingleMessage();

        //APN高级推送
        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
        $template = new \IGtAPNTemplate();
        $apn = new \IGeTui\IGtAPNPayload();
        $alertmsg = new \DictionaryAlertMsg();
        $alertmsg->body = "body";
        $alertmsg->actionLocKey = "ActionLockey";
        $alertmsg->locKey = "LocKey";
        $alertmsg->locArgs = array("locargs");
        $alertmsg->launchImage = "launchimage";
//        IOS8.2 支持
        $alertmsg->title = "Title";
        $alertmsg->titleLocKey = "TitleLocKey";
        $alertmsg->titleLocArgs = array("TitleLocArg");
        $apn->alertMsg = $alertmsg;

        $apn->badge = 7;
        $apn->sound = "com.gexin.ios.silence";
        $apn->add_customMsg("payload", "payload");
//        $apn->contentAvailable=1;
//        $apn->category="ACTIONABLE";
        $template->set_apnInfo($apn);
        $message = new \IGtSingleMessage();

        //PushApn老方式传参
//    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//    $template = new IGtAPNTemplate();
//    $template->set_pushInfo("", 4, "", "", "", "", "", "");
//    $message = new IGtSingleMessage();

        //多个用户推送接口
        putenv("needDetails=true");
        $listmessage = new \IGtListMessage();
        $listmessage->set_data($template);
        $contentId = $igt->getAPNContentId(APPID, $listmessage);
        //$deviceTokenList = array("3337de7aa297065657c087a041d28b3c90c9ed51bdc37c58e8d13ced523f5f5f");
        $deviceTokenList = array(DEVICETOKEN);
        $ret = $igt->pushAPNMessageToList(APPID, $contentId, $deviceTokenList);
        return $ret;
    }

//用户状态查询
    public function getUserStatus($CID)
    {
        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
        $rep = $igt->getClientIdStatus(APPID, $CID);
        return $rep;
    }

//推送任务停止
    public function stoptask($pushId)
    {
        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
        $igt->stop($pushId);
    }

    //通过服务端设置ClientId的标签
    public function setTag($CID)
    {
        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
        $tagList = array('', '中文', 'English');
        $rep = $igt->setClientTag(APPID, $CID, $tagList);
        return $rep;
    }

    public function getUserTags($CID)
    {
        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
        $rep = $igt->getUserTags(APPID, $CID);
        return $rep;
    }


//
//服务端推送接口，支持三个接口推送
//1.PushMessageToSingle接口：支持对单个用户进行推送
//2.PushMessageToList接口：支持对多个用户进行推送，建议为50个用户
//3.pushMessageToApp接口：对单个应用下的所有用户进行推送，可根据省份，标签，机型过滤推送
//

////单推接口
//    public function pushMessageToSingle($templateType, $data)
//    {
//        //$igt = new IGeTui(HOST,APPKEY,MASTERSECRET);
//        $igt = new \IGeTui(NULL, APPKEY, MASTERSECRET, false);
//
//        //消息模版：
//
//        // 1.TransmissionTemplate:透传功能模板
//        // 2.LinkTemplate:通知打开链接功能模板11111
//        // 3.NotificationTemplate：通知透传功能模板
//        // 4.NotyPopLoadTemplate：通知弹框下载功能模板111
//        switch ($templateType) {
//            case '1':
//                $notyTitle = $data['title'];//通知栏标题
//                $notyContent = $data['message'];//通知栏内容
//                $notyIcon = '';//通知栏logo
//                $popTitle =$data['title'];//弹框标题
//                $popContent = $data['content'];//弹框内容
//                $popImage = '';//弹框图片
//                $popButton1 = '下载';//左键
//                $popButton2 = '取消';//右键
//                $loadIcon = '';//下载框图片
//                $loadTitle = $data['title'];//下载框图片
//                $loadUrl = 'http://dizhensubao.igexin.com/dl/com.ceic.apk';//下载框图片
//                $template = $this->IGtNotyPopLoadTemplate($notyTitle, $notyContent, $notyIcon, $isBelled = true, $isVibrationed = true, $isCleared = true, $popTitle, $popContent, $popImage, $popButton1, $popButton2, $loadIcon, $loadTitle, $loadUrl, $isAutoInstall = false, $isActived = true);
//                break;
//            case '2':
//                $title = $data['title'];
//                $text = $data['content'];
//                $logo = '';
//                $url = '';
//                $template = $this->IGtLinkTemplate($title, $text, $logo, $isRing = true, $isVibrate = true, $isClearable = true, $url);
//                break;
//            case '3':
//                $transmissionContent = $data['content'];
//                $title = $data['title'];
//                $text = $data['message'];
//                $logo = '';
//                $template = $this->IGtNotificationTemplate($transmissionType = '1', $transmissionContent, $title, $text, $logo, $isRing = true, $isVibrate = true, $isClearable = true);
//                break;
//            case '4':
//                $transmissionContent = $data;
//                $template = $this->IGtTransmissionTemplate($transmissionType = '1', $transmissionContent);
//                break;
//        }
//
//        //个推信息体
//        foreach ($data['cids'] as $key => &$d) {
//            if (!empty($d['token'])) {
//
//                if ($d['token'] != $d['cid']) {
//                    $message = new \IGtSingleMessage();
//                    $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
//                    $template = new \IGtAPNTemplate();
//                    $apn = new \IGeTui\IGtAPNPayload();
//                    $alertmsg = new \IGeTui\DictionaryAlertMsg();
//                    $alertmsg->body = $data;
//                    $alertmsg->actionLocKey = "ActionLockey";
//                    $alertmsg->locKey = "LocKey";
//                    $alertmsg->locArgs = array("locargs");
//                    $alertmsg->launchImage = "launchimage";
////        IOS8.2 支持
//                    $alertmsg->title = $data['title'];
//                    $alertmsg->titleLocKey = "TitleLocKey";
//                    $alertmsg->titleLocArgs = array("TitleLocArg");
//                    $apn->alertMsg = $alertmsg;
//                    $apn->badge = 7;
//                    $apn->sound = "test1.wav";
//                    $apn->add_customMsg("payload", $data);
//                    $apn->contentAvailable = 1;
//                    $apn->category = "ACTIONABLE";
//                    $template->set_apnInfo($apn);
//                    $message->set_data($template);
//                    $rep = $igt->pushAPNMessageToSingle(APPID, $d['token'], $message);
//
//
//                    return $rep;
//
//
//                } else {
//
//
//                    $message = new \IGtSingleMessage();
//                    $message->set_isOffline(true);//是否离线
//                    $message->set_offlineExpireTime(3600 * 12 * 1000);//离线时间
//                    $message->set_data($template);//设置推送消息类型
////                   $message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
//                    //接收方
//                    $target = new \IGtTarget();
//                    $target->set_appId(APPID);
//                    $target->set_clientId('a18d0210c085f3835df46a8cdceb4b2f');
////                    $target->set_clientId($d['cid']);
////                  $target->set_alias(Alias);
//
//                    try {
//                        $rep = $igt->pushMessageToSingle($message, $target);
//
//                        return $rep;
//                    } catch (\RequestException  $e) {
//                        $requstId = $e . getRequestId();
//                        $rep = $igt->pushMessageToSingle($message, $target, $requstId);
//
//                        return $rep;
//                    }
//                }
//            }
//        }
//        unset($d);
//
//
//    }
//
//    public function pushMessageToSingleBatch($templateType, $data)
//    {
//        putenv("gexin_pushSingleBatch_needAsync=false");
//
//        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
//        $batch = new \IGtBatch(APPKEY, $igt);
//        $batch->setApiUrl(HOST);
//        $CID = I_POST('cid');
//        //$igt->connect();
//        //消息模版：
//        // 1.TransmissionTemplate:透传功能模板
//        // 2.LinkTemplate:通知打开链接功能模板
//        // 3.NotificationTemplate：通知透传功能模板
//        // 4.NotyPopLoadTemplate：通知弹框下载功能模板
//
//        //$template = IGtNotyPopLoadTemplateDemo();
//        //$template = IGtLinkTemplateDemo();
//        //$template = IGtNotificationTemplateDemo();
//        switch ($templateType) {
//            case '1':
//                $notyTitle = $data['title'];//通知栏标题
//                $notyContent = $data['message'];//通知栏内容
//                $notyIcon = '';//通知栏logo
//                $popTitle = '';//弹框标题
//                $popContent = $data['content'];//弹框内容
//                $popImage = '';//弹框图片
//                $popButton1 = '继续';//左键
//                $popButton2 = '关闭';//右键
//                $loadIcon = '';//下载框图片
//                $loadTitle = '';//下载框图片
//                $loadUrl = '';//下载框图片
//                $template = $this->IGtNotyPopLoadTemplate($notyTitle, $notyContent, $notyIcon, $isBelled = true, $isVibrationed = true, $isCleared = true, $popTitle, $popContent, $popImage, $popButton1, $popButton2, $loadIcon, $loadTitle, $loadUrl, $isAutoInstall = false, $isActived = true);
//                break;
//            case '2':
//                $title = $data['title'];
//                $text = $data['message'];
//                $logo = '';
//                $url = '';
//                $template = $this->IGtLinkTemplate($title, $text, $logo, $isRing = true, $isVibrate = true, $isClearable = true, $url);
//
//                break;
//            case '3':
//                $transmissionContent = $data['content'];
//                $title = $data['title'];
//                $text = $data['message'];
//                $logo = '';
//                $template = $this->IGtNotificationTemplate($transmissionType = '1', $transmissionContent, $title, $text, $logo, $isRing = true, $isVibrate = true, $isClearable = true);
//
//                break;
//            case '4':
//                $transmissionContent = $data['content'];
//                $template = $this->IGtTransmissionTemplate($transmissionType = '1', $transmissionContent);
//
//                break;
//        }
//
//
//        //个推信息体
//        $message = new \IGtSingleMessage();
//        $message->set_isOffline(true);//是否离线
//        $message->set_offlineExpireTime(12 * 1000 * 3600);//离线时间
//        $message->set_data($template);//设置推送消息类型
////      $message->set_PushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
//
//        $target = new \IGtTarget();
//        $target->set_appId(APPID);
//        $target->set_clientId($CID);
//        $batch->add($message, $target);
//        try {
//            $rep = $batch->submit();
//            return $rep;
//        } catch (\Exception $e) {
//            $rep = $batch->retry();
//            return $rep;
//        }
//    }
//
////多推接口
//    function pushMessageToList($templateType, $data)
//    {
//        putenv("gexin_pushList_needDetails=true");
//        putenv("gexin_pushList_needAsync=true");
//        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
//        //消息模版：
//        // 1.TransmissionTemplate:透传功能模板
//        // 2.LinkTemplate:通知打开链接功能模板111111
//        // 3.NotificationTemplate：通知透传功能模板
//        // 4.NotyPopLoadTemplate：通知弹框下载功能模板11111
//
//        switch ($templateType) {
//            case '1':
//                $notyTitle = $data['title'];//通知栏标题
//                $notyContent = $data['message'];//通知栏内容
//                $notyIcon = '';//通知栏logo
//                $popTitle =$data['title'];//弹框标题
//                $popContent = $data['content'];//弹框内容
//                $popImage = '';//弹框图片
//                $popButton1 = '下载';//左键
//                $popButton2 = '取消';//右键
//                $loadIcon = '';//下载框图片
//                $loadTitle = $data['title'];//下载框图片
//                $loadUrl = 'http://dizhensubao.igexin.com/dl/com.ceic.apk';//下载框图片
//                $template = $this->IGtNotyPopLoadTemplate($notyTitle, $notyContent, $notyIcon, $isBelled = true, $isVibrationed = true, $isCleared = true, $popTitle, $popContent, $popImage, $popButton1, $popButton2, $loadIcon, $loadTitle, $loadUrl, $isAutoInstall = false, $isActived = true);
//                break;
//            case '2':
//                $title = $data['title'];
//                $text =$data['message'];
//                $logo = $data['logo'];
//                $url = 'http://dizhensubao.igexin.com/dl/com.ceic.apk';
//                $template = $this->IGtLinkTemplate($title, $text, $logo, $isRing = true, $isVibrate = true, $isClearable = true, $url);
//                break;
//            case '3':
//                $transmissionContent = $data['content'];
//                $title = $data['title'];
//                $text = $data['message'];
//                $logo = '';
//                $template = $this->IGtNotificationTemplate($transmissionType = '1', $transmissionContent, $title, $text, $logo, $isRing = true, $isVibrate = true, $isClearable = true);
//                break;
//            case '4':
//                $transmissionContent = $data;
//                $template = $this->IGtTransmissionTemplate($transmissionType = '1', $transmissionContent);
//                break;
//        }
//        //个推信息体
////        foreach ($data['cids'] as $key => &$d) {
//
////            if (!empty($d['token'])) {
////
////                if ($d['token'] != $d['cid']) {
////
////                    $deviceTokenList[] = $d['token'];
////                } else {
////                    $clientList[] = $d['cid'];
////                }
////            }
//
//
//
//
//
//
//
//
////        }
////        if ($deviceTokenList) {
////            dump(222);
////            dump($deviceTokenList);
////            putenv("needDetails=true");
////            $listmessage = new \IGtListMessage();
////            $listmessage->set_data($template);
////            $contentId = $igt->getAPNContentId(APPID, $listmessage);
////            $rep = $igt->pushAPNMessageToList(APPID, $contentId, $deviceTokenList);
////
////            return $rep;
////        }
//
////        if ($clientList) {
//
//            $message = new \IGtListMessage();
//            $message->set_isOffline(true);//是否离线
//            $message->set_offlineExpireTime(3600 * 12 * 1000);//离线时间
//            $message->set_data($template);//设置推送消息类型
////    $message->set_PushNetWorkType(1);	//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
//            $contentId = $igt->getContentId($message);
////            $contentId = $igt->getContentId($message, "toList任务别名功能");    //根据TaskId设置组名，支持下划线，中文，英文，数字
//
//            //接收方1
//            $target1 = new \IGtTarget();
//            $target1->set_appId(APPID);
//
//            foreach ($data['cids'] as $key => &$d){
//                $target1->set_clientId($d['cid']);
//                $clientList[] = $target1;
//                $rep = $igt->pushMessageToList($contentId, $clientList);
//            }
//
//            return $rep;
////        }
//    }
//
////群推接口
//    function pushMessageToApp($templateType, $data)
//    {
//        $igt = new \IGeTui(HOST, APPKEY, MASTERSECRET);
//
//        switch ($templateType) {
//            case '1':
//                $notyTitle = $data['title'];//通知栏标题
//                $notyContent = $data['message'];//通知栏内容
//                $notyIcon = '';//通知栏logo
//                $popTitle = '';//弹框标题
//                $popContent = $data['content'];//弹框内容
//                $popImage = '';//弹框图片
//                $popButton1 = '确定';//左键
//                $popButton2 = '取消';//右键
//                $loadIcon = '';//下载框图片
//                $loadTitle = '';//下载框图片
//                $loadUrl = '';//下载框图片
//                $template = $this->IGtNotyPopLoadTemplate($notyTitle, $notyContent, $notyIcon, $isBelled = true, $isVibrationed = true, $isCleared = true, $popTitle, $popContent, $popImage, $popButton1, $popButton2, $loadIcon, $loadTitle, $loadUrl, $isAutoInstall = false, $isActived = true);
//
//                break;
//            case '2':
//                $title = '';
//                $text = '';
//                $logo = '';
//                $url = '';
//                $template = $this->IGtLinkTemplate($title, $text, $logo, $isRing = true, $isVibrate = true, $isClearable = true, $url);
//                break;
//            case '3':
//                $transmissionContent = $data['content'];
//                $title = $data['title'];
//                $text = $data['message'];
//                $logo = '';
//                $template = $this->IGtNotificationTemplate($transmissionType = '1', $transmissionContent, $title, $text, $logo, $isRing = true, $isVibrate = true, $isClearable = true);
//                break;
//            case '4':
//                $transmissionContent = $data;
//                $template = $this->IGtTransmissionTemplate($transmissionType = '1', $transmissionContent);
//                break;
//        }
//        //个推信息体
//        //基于应用消息体
//        $message = new \IGtAppMessage();
//        $message->set_isOffline(true);
//        $message->set_offlineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
//        $message->set_data($template);
//
//        $appIdList = array(APPID);
//        $phoneTypeList = array('ANDROID');
//        $provinceList = array('浙江');
//        $tagList = array('haha');
//        //用户属性
//        //$age = array("0000", "0010");
//
//
//        //$cdt = new AppConditions();
//        // $cdt->addCondition(AppConditions::PHONE_TYPE, $phoneTypeList);
//        // $cdt->addCondition(AppConditions::REGION, $provinceList);
//        //$cdt->addCondition(AppConditions::TAG, $tagList);
//        //$cdt->addCondition("age", $age);
//
//        $message->set_appIdList($appIdList);
//        //$message->set_conditions($cdt->getCondition());
//
//        $rep = $igt->pushMessageToApp($message, "任务组名");
//        return $rep;
//    }

}