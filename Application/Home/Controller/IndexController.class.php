<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

use Think\Controller;


/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends Controller
{

    //系统首页
    public function index()
    {
        /*if(is_login()){
        }
        hook('homeIndex');
        $default_url = C('DEFUALT_HOME_URL');//获得配置，如果为空则显示聚合，否则跳转
        if ($default_url != ''&&strtolower($default_url)!='home/index/index') {
            redirect(get_nav_url($default_url));
        }
        $show_blocks = get_kanban_config('BLOCK', 'enable', array(), 'Home');
        $this->assign('showBlocks', $show_blocks);
        $enter = modC('ENTER_URL', '', 'Home');
        $this->assign('enter', get_nav_url($enter));
        $sub_menu['left']= array(array('tab' => 'home', 'title' => L('_SQUARE_'), 'href' =>  U('index'))//,array('tab'=>'rank','title'=>'排行','href'=>U('rank'))
        );
        $this->assign('sub_menu', $sub_menu);
        $this->assign('current', 'home');*/
        $recommendNews=$this->_recommendNews();//推荐资讯
        $slideIndex=$this->_slideIndex();//首页轮播图
        $newNews=$this->_newNews();//最新资讯
        $hotNews=$this->_hotNews();//热门资讯
        if (is_login() && check_auth('Weibo/Index/doSend')) {
            $this->assign('show_post', true);
        }
        $weibo=$this->_weibo();
        $hotTopic=$this->_hotTopic();
        $hotComment=$this->_hotComment();
        $hotEvent=$this->_hotEvent();
        $tutorialList=$this->_tutorialList();
        //$newBook=$this->_newBook();
        $signUser=$this->signUser();
        $this->assign('recommendNews',$recommendNews);
        $this->assign('slideIndex',$slideIndex);
        $this->assign('newNews',$newNews);
        $this->assign('hotNews',$hotNews);
        $this->assign('weibo',$weibo);
        $this->assign('hotTopic',$hotTopic['data']);
        $this->assign('hotComment',$hotComment);
        $this->assign('hotEvent',$hotEvent);
        $this->assign('tutorialList',$tutorialList);
        $this->assign('newBook',$newBook);
        $this->assign('signUser',$signUser);
        $this->display();
    }
    protected function _initialize()
    {
        /*读取站点配置*/
        $config = api('Config/lists');
        C($config); //添加配置
        if (!C('WEB_SITE_CLOSE')) {
            $this->error(L('_ERROR_WEBSITE_CLOSED_'));
        }
    }

    
    //推荐用户
    private function _recommendUser(){
        $result=json_decode(S("recommendUserToIndex"),true);
        if(empty($result)){
            $result=M("member")->field()->join("os_avatar on os_avatar.uid=os_member.uid")->where("status=1")->order("last_login_time desc")->limit(20)->select();
            foreach ($result as $key => &$value) {
                $value=query_user(array('avatar128', 'nickname', 'uid', 'space_url'), $value['uid']);
            }
            S("recommendUserToIndex",json_encode($result),array('type'=>'file','expire'=>86400));
        }
        return $result;
    }
    //活跃用户
    private function signUser(){
        $result=M("member")->field()->join("os_avatar on os_avatar.uid=os_member.uid")->where("status=1")->order("last_login_time desc")->limit(20)->select();
        foreach ($result as $key => &$value) {
            $value=query_user(array('avatar128', 'nickname', 'uid', 'space_url'), $value['uid']);
        }
        return $result;
    }
    //最新问题
    private function _newQuestionList(){
        $result=json_decode(S("tutorialListToIndex"),true);
        if(empty($result)){
            $result=M("question")->where("status=1")->limit(10)->order("create_time asc")->select();
            S("tutorialListToIndex",json_encode($result),array('type'=>'file','expire'=>180));
        }
        return $result;
    }
    //最新教程
    private function _newBook(){
        $result=json_decode(S("_newBookToIndex"),true);
        if(empty($result)){
            $map['create_time']=array('lt',time());
            $map['is_show']=1;
            $map['status']=1;
            $map['cate_ids']=array('LIKE','%3%');
            $order='sort asc,create_time desc';
            $result=D('Book/Book')->getList($map,1,$order);
            S("_newBookToIndex",json_encode($result),array('type'=>'file','expire'=>86400));
        }
        return $result;
    }
    //推荐教程
    private function _tutorialList(){
        $result=json_decode(S("tutorialListToIndex"),true);
        if(empty($result)){
            $result=M("book")->where("status=1 and is_show=1")->limit(20)->order("sort asc")->select();
            S("tutorialListToIndex",json_encode($result),array('type'=>'file','expire'=>86400));
        }
        return $result;
    }
    //热门活动
    private function _hotEvent(){
        $result=json_decode(S("_hotEventToIndex"),true);
        if(empty($result)){
            $result=M("event")->where("status=1 and unix_timestamp()<deadline")->limit(5)->order("deadline desc,create_time desc")->select();
            S("_hotEventToIndex",json_encode($result),array('type'=>'file','expire'=>3600));
        }
        return $result;
    }
    //热门评论
    private function _hotComment(){
        $result=json_decode(S("_hotCommentToIndex"),true);
        if(empty($result)){
            $start_time=time();
            $end_time=time()-86400*7;
            $result=M("news")->where("status=1 and create_time > ".$end_time." and create_time<".$start_time)->limit(5)->order("comment desc,create_time desc")->select();
            S("_hotCommentToIndex",json_encode($result),array('type'=>'file','expire'=>600));
        }
        return $result;
    }
    //热门话题
    private function _hotTopic(){
        //一个月内的热门话题
        $h = 24 * 28;
        $topics = D('Weibo/Topic')->getHot($h, 5, 1);
        return $topics;
    }
    
    //获取微博最新10条数据
    private function _weibo(){
        //查询条件
        $param = array();
        $weiboModel = D('Weibo/Weibo');
        $param['field'] = 'id';
        $param['limit'] = 6;
        //$param = $this->filterWeibo($aType, $param);
        $param['where']['status'] = 1;
        $param['where']['is_top'] = 0;
        $param['order'] = 'create_time desc';
        //查询
        $list = $weiboModel->getWeiboList($param);
        for ($i=0;$i<count($list);$i++){
            $reusult[$i]=$weiboModel->getWeiboDetail($list[$i]);
        }
        return $reusult;
    }
    
    //资讯推荐
    private function _recommendNews(){
        $result=json_decode(S("_recommendNewsToIndex"),true);
        if(empty($result)){
            $result=M("news")->where("position in (1,3,7) and status=1")->limit(5)->order("sort asc,create_time desc")->select();
            S("_recommendNewsToIndex",json_encode($result),array('type'=>'file','expire'=>600));
        }
        return $result;
    }
    //最新资讯
    private function _newNews(){
        $result=json_decode(S("_newNewsToIndex"),true);
        if(empty($result)){
            $result=M("news")->where("status=1")->limit(14)->order("create_time desc")->select();
            foreach($result as &$val){
                $val['category_name']=mb_substr(M('news_category')->where('id='.$val['category'])->field('title')->getField('title'),0,3,'utf-8');
            }
            S("_newNewsToIndex",json_encode($result),array('type'=>'file','expire'=>600));
        }
        return $result;
    }
    //热门资讯
    private function _hotNews(){
        //$result=json_decode(S("_hotNewsToIndex"),true);
        if(empty($result)){
            $start_time=time();
            $end_time=time()-86400*7;
            $result=M("news")->where("cover>0 and status=1 and create_time > ".$end_time." and create_time<".$start_time)->limit(7)->order("view desc")->select();
            foreach($result as &$val){
                $val['img']=get_pic_src(M('picture')->where('id='.$val['cover'])->field('path')->getField('path'));
            }
            S("_hotNewsToIndex",json_encode($result),array('type'=>'file','expire'=>600));
        }
        return $result;
    }
    //首页轮播图
    private function _slideIndex(){
        $result=json_decode(S("_slideIndex"),true);
        if(empty($result)){
            $result=M("adv")->where("pos_id =9 and unix_timestamp()>start_time and unix_timestamp()< end_time")->order("sort asc")->limit(5)->select();
            foreach ($result as &$val) {
                $info=json_decode($val['data'],true);
                $val['img']=get_pic_src(M('picture')->where('id=' . $info['pic'])->field('path')->getField('path'));
                $val['target']=$info["target"];
            }
            S("_slideIndex",json_encode($result),array('type'=>'file','expire'=>3600));
        }
        return $result;
    }
}