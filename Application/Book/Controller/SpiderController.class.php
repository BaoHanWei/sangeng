<?php
namespace Book\Controller;
use Think\Controller;
use Common\Model\ContentHandlerModel;
//暂时停用
class SpiderController extends Controller {
    
    function index(){
		$charset='UTF-8';
		if ($charset="UTF-8") {
			 header("Content-type: text/html; charset=utf-8");
		}else{
			 header("Content-type: text/html; charset=GB2312");
		}
		set_time_limit(0);
		require_once("./ThinkPHP/Library/OT/Spider/QueryList.class.php");//导入采集封装类
	    $url='http://www.w3cschool.cn/weixinapp/';//要采集的url
	    /*先采集全部*/
	    $title='.dd-item a';
	    $href='.dd-item a';
		$reg = array("title"=>array($title,"text"),"url"=>array($href,"href"));
		$rang='';
		$hj  = new \QueryList($url,$reg,$rang);
		$array= $hj->jsonArr;
		$parentResult=array('微信小程序 框架','逻辑层(App Service)','视图层(View)','微信小程序 WXML','微信小程序 组件','','','','','','','','','');
		
		print_r($arr);die;
    	$this->display();
    }


  //采集demo
  public function demo(){
  	//采集OSC的代码分享列表，标题 链接 作者
	$url = "http://www.oschina.net/code/list";
	$reg = array("title"=>array(".code_title a:eq(0)","text"),"url"=>array(".code_title a:eq(0)","href"),"author"=>array("img","title"));
	$rang = ".code_list li";
	$hj = new QueryList($url,$reg,$rang);
	$arr = $hj->jsonArr;
	print_r($arr);
	//如果还想采当前页面右边的 TOP40活跃贡献者 图像，得到JSON数据,可以这样写
	$reg = array("portrait"=>array(".hot_top img","src"));
	$hj->setQuery($reg);
	$json = $hj->getJSON();
	echo $json . "<hr/>";
	 
	//采OSC内容页内容
	$url = "http://www.oschina.net/code/snippet_186288_23816";
	$reg = array("title"=>array(".QTitle h1","text"),"con"=>array(".Content","html"));
	$hj = new QueryList($url,$reg);
	$arr = $hj->jsonArr;
	print_r($arr);
	 
	//就举这么多例子吧，是不是用来做采集很方便
  }



}