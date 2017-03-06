<?php
/**
 * Created by PhpStorm.
 * User: Yixiao Chen
 * Date: 2015/5/5 0005
 * Time: 上午 9:47
 *{:U('Weibo/Index/index',array('type'=>$tab))}
 */

namespace Weibo\Controller;


use Think\Controller;

class BaseController extends  Controller{

    public function _initialize(){
        $sub_menu =
            array(
                'left' =>
                    array(
                        array('tab' => 'index', 'title' => "首页", 'href' =>  U('index/index')),
                        array('tab' => 'hot', 'title' => L('_HOT_').L('_MODULE_'), 'href' => U('index/index',array('type'=>'hot'))),
                        array('tab' => 'topic', 'title' =>L('_HOT_TOPIC_'), 'href' => U('topic/topic')),
                        array('tab' => 'topic', 'title' =>"我的关注", 'href' => U('index/index',array('type'=>'concerned'))),
                        array('tab' => 'topic', 'title' =>"我的喜欢", 'href' => U('index/index',array('type'=>'fav'))),
                    ),
                'right'=>array(
                    array('type'=>'search', 'input_title' => L('_INPUT_KEYWORDS_'),'input_name'=>'keywords','from_method'=>'post', 'action' =>U('Weibo/index/search')),
                )
            );
        $this->assign('sub_menu', $sub_menu);
        $this->assign('current', 'index');
    }
}