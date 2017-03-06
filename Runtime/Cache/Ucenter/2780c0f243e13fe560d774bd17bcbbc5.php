<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php echo hook('syncMeta');?>
<?php $oneplus_seo_meta = get_seo_meta($vars,$seo); ?>
<?php if($oneplus_seo_meta['title']): ?><title><?php echo ($oneplus_seo_meta['title']); ?></title>
    <?php else: ?>
    <title><?php echo modC('WEB_SITE_NAME',L('_OPEN_SNS_'),'Config');?></title><?php endif; ?>
<?php if($oneplus_seo_meta['keywords']): ?><meta name="keywords" content="<?php echo ($oneplus_seo_meta['keywords']); ?>"/><?php endif; ?>
<?php if($oneplus_seo_meta['description']): ?><meta name="description" content="<?php echo ($oneplus_seo_meta['description']); ?>"/><?php endif; ?>
<!-- zui -->
<link href="/Public/zui/css/zui.css" rel="stylesheet">
<link href="/Public/zui/css/zui-theme.css" rel="stylesheet">
<link href="/Public/css/core.css" rel="stylesheet"/>
<link type="text/css" rel="stylesheet" href="/Public/js/ext/magnific/magnific-popup.css"/>
<script src="/Public/js.php?f=js/jquery-2.0.3.min.js,js/com/com.functions.js,js/com/com.toast.class.js,js/com/com.ucard.js,js/core.js"></script>

    <link href="/Application/Ucenter/Static/css/center.css" rel="stylesheet" type="text/css"/>
    <link href="/Application/Ucenter/Static/css/usercenter.css" rel="stylesheet" type="text/css"/>

<!--合并前的js-->
<?php $config = api('Config/lists'); C($config); $count_code=C('COUNT_CODE'); ?>
<script type="text/javascript">
    var ThinkPHP = window.Think = {
        "ROOT": "", //当前网站地址
        "APP": "", //当前项目地址
        "PUBLIC": "/Public", //项目公共目录地址
        "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
        "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
        "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
        'URL_MODEL': "<?php echo C('URL_MODEL');?>",
        'WEIBO_ID': "<?php echo C('SHARE_WEIBO_ID');?>"
    }
    var cookie_config={
        "prefix":"<?php echo C('COOKIE_PREFIX');?>"
    }
    var Config={
        'GET_INFORMATION':<?php echo modC('GET_INFORMATION',1,'Config');?>,
        'GET_INFORMATION_INTERNAL':<?php echo modC('GET_INFORMATION_INTERNAL',10,'Config');?>*1000
    }
    var weibo_comment_order = "<?php echo modC('COMMENT_ORDER',0,'WEIBO');?>";
</script>
<script src="/Public/lang.php?module=<?php echo strtolower(MODULE_NAME);?>&lang=<?php echo LANG_SET;?>"></script>
<script src="/Public/expression.php"></script>
<!-- Bootstrap库 -->
<!--
<?php $js[]=urlencode('/static/bootstrap/js/bootstrap.min.js'); ?>
&lt;!&ndash; 其他库 &ndash;&gt;
<script src="/Public/static/qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="/Public/Core/js/ext/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/Public/static/jquery.iframe-transport.js"></script>
-->
<!--CNZZ广告管家，可自行更改-->
<!--<script type='text/javascript' src='http://js.adm.cnzz.net/js/abase.js'></script>-->
<!--CNZZ广告管家，可自行更改end-->
<!-- 自定义js -->
<!--<script src="/Public/js.php?get=<?php echo implode(',',$js);?>"></script>-->
<script>
    //全局内容的定义
    var _ROOT_ = "";
    var MID = "<?php echo is_login();?>";
    var MODULE_NAME="<?php echo MODULE_NAME; ?>";
    var ACTION_NAME="<?php echo ACTION_NAME; ?>";
    var CONTROLLER_NAME ="<?php echo CONTROLLER_NAME; ?>";
    var initNum = "<?php echo modC('WEIBO_NUM',140,'WEIBO');?>";
    function adjust_navbar(){
        $('#sub_nav').css('top',$('#nav_bar').height());
        $('#main-container').css('padding-top',$('#nav_bar').height()+$('#sub_nav').height()+20)
    }
</script>
<audio id="music" src="" autoplay="autoplay"></audio>
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>
</head>
<body>
	<!-- 头部 -->
	<script src="/Public/js/com/com.talker.class.js"></script>
<?php if((is_login()) ): ?><div id="talker">

    </div><?php endif; ?>

<?php D('Common/Member')->need_login(); ?>
<!--[if lt IE 8]>
<div class="alert alert-danger" style="margin-bottom: 0"><?php echo L('_TIP_BROWSER_DEPRECATED_1_');?> <strong><?php echo L('_TIP_BROWSER_DEPRECATED_2_');?></strong>
    <?php echo L('_TIP_BROWSER_DEPRECATED_3_');?> <a target="_blank"
                                          href="http://browsehappy.com/"><?php echo L('_TIP_BROWSER_DEPRECATED_4_');?></a>
    <?php echo L('_TIP_BROWSER_DEPRECATED_5_');?>
</div>
<![endif]-->
<?php $unreadMessage=D('Common/Message')->getHaventReadMeassageAndToasted(is_login()); ?>
<div id="nav_bar" class="nav_bar">
    <!-- <div class="container" > -->
        <nav class="" id="nav_bar_container">
            <?php $logo = get_cover(modC('LOGO',0,'Config'),'path'); $logo = $logo?$logo:'/Public/images/logo.png'; ?>

            <a class="navbar-brand logo" href="<?php echo U('Home/Index/index');?>"><img src="<?php echo ($logo); ?>"/></a>

            <div class="" id="nav_bar_main">

                <ul class="nav navbar-nav navbar-left">
                    <?php $__NAV__ = D('Channel')->lists(true);$__NAV__ = list_to_tree($__NAV__, "id", "pid", "_"); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav['_']) != ""): ?><li class="dropdown">
                                <a title="<?php echo ($nav["title"]); ?>" class="dropdown-toggle nav_item" data-toggle="dropdown"
                                   href="#"><i class="icon-<?php echo ($nav["icon"]); ?> app-icon"></i> <?php echo ($nav["title"]); ?> <i class="icon-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if(is_array($nav["_"])): $i = 0; $__LIST__ = $nav["_"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subnav): $mod = ($i % 2 );++$i;?><li role="presentation"><a role="menuitem" tabindex="-1"
                                                                   style="color:<?php echo ($subnav["color"]); ?>"
                                                                   href="<?php echo (get_nav_url($subnav["url"])); ?>"
                                                                   target="<?php if(($subnav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><i
                                                class="icon-<?php echo ($subnav["icon"]); ?>"></i> <?php echo ($subnav["title"]); ?>
                                        </a>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                            <?php else: ?>
                            <li class="<?php if((get_nav_active($nav["url"])) == "1"): ?>active<?php else: endif; ?>">
                                <a title="<?php echo ($nav["title"]); ?>" href="<?php echo (get_nav_url($nav["url"])); ?>"
                                   target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><i
                                        class="icon-<?php echo ($nav["icon"]); ?> app-icon "></i>
                                    <span style="font-size:15px;color:<?php echo ($nav["color"]); ?>;"><?php echo ($nav["title"]); ?></span>
                                    <span class="label label-badge rank-label" title="<?php echo ($nav["band_text"]); ?>"
                                          style="background: <?php echo ($nav["band_color"]); ?> !important;color:white !important;"><?php echo ($nav["band_text"]); ?></span>
                                </a>
                            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(modC('OPEN_IM',1,'Config')): ?><li>
                            <?php if(is_login()): ?><a class="" onclick="talker.show()"><i class="icon-chat-dot" style="font-size:16px;color:#fff;"> </i>
                                    <i id="friend_has_new"
                                    <?php $map_mid=is_login(); $modelTP=D('talk_push'); $has_talk_push=$modelTP->where("(uid = ".$map_mid." and status = 1) or (uid =
                                        ".$map_mid." and status =
                                        0)")->count(); $has_message_push=D('talk_message_push')->where("uid= ".$map_mid." and (status=1 or
                                        status=0)")->count(); if($has_talk_push || $has_message_push){ ?>
                                    style="display: inline-block"
                                    <?php } ?>
                                    ></i>
                                </a>
                                <?php else: ?>
                                <a onclick="toast.error(<?php echo L('_PANEL_LIMIT_');?>)"> <i class="icon-chat-dot"> </i>
                                </a><?php endif; ?>
                        </li><?php endif; ?>
                    <!--登陆面板-->
                    <?php if(is_login()): ?><li class="dropdown">
                            <div></div>
                            <a id="nav_info" class="dropdown-toggle text-left" data-toggle="dropdown">
                                <span class="icon-bell" style="font-size:16px;color:#fff"></span><span id="nav_bandage_count"
                                <?php if(count($unreadMessage) == 0): ?>style="display: none"<?php endif; ?>
                                class="label label-badge label-success"><?php echo count($unreadMessage);?></span>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <li>
                                    <div class="clearfix header">
                                        <div class="col-xs-6 nav_align_left"><span
                                                id="nav_hint_count"><?php echo count($unreadMessage);?></span> <?php echo L('_UNREAD_');?>
                                        </div>
                                    </div>
                                </li>
                                <li class="info-list">
                                    <div class="list-wrap">
                                        <ul id="nav_message" class="dropdown-menu-list scroller  list-data"
                                            style="width: auto;">
                                            <?php if(count($unreadMessage) == 0): ?><div style="font-size: 18px;color: #ccc;font-weight: normal;text-align: center;line-height: 150px">
                                                    <?php echo L('_NO_MESSAGE_');?>
                                                </div>
                                                <?php else: ?>
                                                <?php if(is_array($unreadMessage)): $i = 0; $__LIST__ = $unreadMessage;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><li>
                                                        <a data-url="<?php echo ($message["content"]["web_url"]); ?>"
                                                           onclick="Notify.readMessage(this,<?php echo ($message["id"]); ?>)">
                                                            <h3 class="margin-top-0"><i class="icon-bell"></i>
                                                                <?php echo ($message["content"]["title"]); ?></h3>

                                                            <p> <?php echo ($message["content"]["content"]); ?></p>
                                                        <span class="time">

                                                         <?php echo ($message["ctime"]); ?>

                                                        </span>
                                                        </a>
                                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>

                                        </ul>
                                    </div>
                                </li>
                                <li class="footer text-right">
                                    <div class="btn-group">
                                        <button onclick="Notify.setAllReaded()" class="btn btn-sm  "><i
                                                class="icon-check"></i> <?php echo L('_ALL_HAS_READ_');?>
                                        </button>
                                        <a class="btn  btn-sm  " href="<?php echo U('ucenter/Message/message');?>">
                                            <?php echo L('_VIEW_NEWS_');?>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a title="<?php echo L('_EDIT_INFO_');?>" href="<?php echo U('ucenter/Config/index');?>"><i
                                    class="icon-cog" style="font-size:16px;color:#fff"></i></a>
                        </li>
                        <li class="top_spliter"></li>
                        <li class="dropdown">
                            <?php $common_header_user = query_user(array('nickname')); ?>
                            <a role="button" class="dropdown-toggle dropdown-toggle-avatar" data-toggle="dropdown">
                                <?php echo ($common_header_user["nickname"]); ?>&nbsp;<i style="font-size: 12px"
                                                                       class="icon-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu text-left" role="menu">
                                <?php $user_nav=S('common_user_nav'); if($user_nav===false){ $user_nav=D('UserNav')->order('sort asc')->where('status=1')->select(); S('common_user_nav',$user_nav); } ?>

                                <?php if(is_array($user_nav)): $i = 0; $__LIST__ = $user_nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a style="color:<?php echo ($vo["color"]); ?>"
                                           target="<?php if(($vo["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"
                                           href="<?php echo get_nav_url($vo['url']);?>"><span
                                            class="icon-<?php echo ($vo["icon"]); ?>"></span>&nbsp;&nbsp;<?php echo ($vo["title"]); ?> <span
                                            class="label label-badge rank-label" title="<?php echo ($vo["band_text"]); ?>"
                                            style="background: <?php echo ($vo["band_color"]); ?> !important;color:white !important;"><?php echo ($vo["band_text"]); ?></span></a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

                                <?php $register_type=modC('REGISTER_TYPE','normal','Invite'); $register_type=explode(',',$register_type); if(in_array('invite',$register_type)){ ?>
                                <li><a href="<?php echo U('ucenter/Invite/invite');?>"><span
                                        class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;<?php echo L('_INVITE_FRIENDS_');?></a>
                                </li>
                                <?php } ?>

                                <?php echo hook('personalMenus');?>
                                <?php if(check_auth('Admin/Index/index')): ?><li><a href="<?php echo U('Admin/Index/index');?>" target="_blank"><span
                                            class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;<?php echo L('_MANAGE_BACKGROUND_');?></a>
                                    </li><?php endif; ?>
                                <li><a event-node="logout"><span
                                        class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;<?php echo L('_LOGOUT_');?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="top_spliter "></li>
                        <?php else: ?>


                        <li class="top_spliter "></li>
                        <?php $open_quick_login=modC('OPEN_QUICK_LOGIN', 0, 'USERCONFIG'); $register_type=modC('REGISTER_TYPE','normal','Invite'); $register_type=explode(',',$register_type); $only_open_register=0; if(in_array('invite',$register_type)&&!in_array('normal',$register_type)){ $only_open_register=1; } ?>
                        <script>
                            var OPEN_QUICK_LOGIN = "<?php echo ($open_quick_login); ?>";
                            var ONLY_OPEN_REGISTER = "<?php echo ($only_open_register); ?>";
                        </script>
                        <li class="">
                            <a data-login="do_login"><?php echo L('_LOGIN_');?></a>
                        </li>
                        <li class="">
                            <a data-role="do_register" data-url="<?php echo U('Ucenter/Member/register');?>"><?php echo L('_REGISTER_');?></a>
                        </li>
                        <li class="spliter "></li><?php endif; ?>
                </ul>

            </div>
            <!--导航栏菜单项-->

        </nav>
    <!-- </div> -->
</div>
<!--换肤插件钩子-->
<?php echo hook('setSkin');?>
<!--换肤插件钩子 end-->
<div id="tool" class="tool ">
    <?php echo hook('tool');?>
    <?php if(check_auth('Core/Admin/View')): ?><!--  <a href="javascript:;" class="admin-view"></a>--><?php endif; ?>
    <a  id="go-top" href="javascript:;" class="go-top "></a>

</div>
<?php if(is_login()&&(get_login_role_audit()==2||get_login_role_audit()==0)){ ?>
<div id="top-role-tip" class="alert alert-danger">
    <?php echo L('_TIP_ROLE_NOT_AUDITED1_');?> <strong><?php echo L('_TIP_ROLE_NOT_AUDITED2_');?></strong><?php echo L('_TIP_ROLE_NOT_AUDITED3_');?>
    <a target="_blank" href="<?php echo U('ucenter/config/role');?>"><?php echo L('_TIP_ROLE_NOT_AUDITED4_');?></a>
</div>
<script>
    $(function () {
        $('#top-role-tip').css('margin-top', $('#nav_bar').height() + 15);
        $('#top-role-tip').css('margin-bottom', -$('#nav_bar').height()+15);
    });
</script>
<?php } ?>




	<!-- /头部 -->
	<!-- 主体 -->
	<div class="main-wrapper" id="container">
    
    <br/>
    <div class="space-banner">
    	<!-- <div class="uc_top_bg">
    <?php if($user_info['cover_id']): ?><img class="uc_top_img_bg" src="<?php echo ($user_info['cover_path']); ?>" style="width: 100%;height: 100%">
        <?php else: ?>
        <img class="uc_top_img_bg" src="/Application/Ucenter/Static/images/user_top_default_bg.jpg" style="width: 100%;height: 100%"><?php endif; ?>
    <?php if(is_login() && $user_info['uid'] == is_login()): ?><div class="change_cover"><a data-type="ajax" data-url="<?php echo U('Ucenter/Public/changeCover');?>" data-toggle="modal" data-title="<?php echo L('_UPLOAD_PERSONAL_COVER_');?>" style="color: white;"><img class="img-responsive" src="/Application/Core/Static/images/fractional.png"></a>
        </div><?php endif; ?>
</div> -->
<div class="row uc_info container" style="margin:0 auto;height:180px;">
    <div class="col-xs-3" style="padding-top:21px;float:left;height:100%;width:160px">
     	<a href="<?php echo ($user_info["space_url"]); ?>" title="">
            <img src="<?php echo ($user_info["avatar128"]); ?>" class="avatar-img img-responsive top_img"/>
        </a>      
    </div>
    <div class="col-xs-6" style="padding-top:21px;float:left;height:100%;">
        <div class="uc_main_info">
            <div class="uc_m_t_12 uc_m_b_12 uc_uname">
                <span class="nickname" style="cursor:pointer">
                    <!-- <a ucard="<?php echo ($user_info["uid"]); ?>" href="<?php echo ($user_info["space_url"]); ?>" title=""> --><?php echo (htmlspecialchars($user_info["nickname"])); ?><!--</a>-->
                </span>
                <span>
                       <?php echo W('Common/UserRank/render',array($user_info['uid']));?>
            	</span>
            	<span class="address"><?php if(in_array($user_info['province'],array('北京市','天津市','重庆市','上海市'))){ echo ($user_info["city"]); ?> - <?php echo ($user_info["district"]); ?>
	            	<?php }else{ ?>
	            	<?php if(!empty($user_info['province'])){ echo ($user_info["province"]); ?> - <?php echo ($user_info["city"]); ?> - <?php echo ($user_info["district"]); }else{ ?>地球 - 中国某个旮旯角<?php } ?>
	            	<?php } ?>
            	</span>
            </div>
            <div class="uc_m_b_12 text-more" style="width: 100%"><?php echo L('_SIGNATURE_'); echo L('_COLON_');?>
	            <span>
	                <?php if($user_info['signature'] == ''): echo L('_NO_IDEA_');?>
	                    <?php else: ?>
	                    <attr title="<?php echo ($user_info["signature"]); ?>"><?php echo ($user_info["signature"]); ?></attr><?php endif; ?>
	            </span>
            </div>
            <div class="uc_m_b_12"><span><?php echo L('_GRADE_'); echo L('_COLON_'); echo ($user_info["title"]); ?></span> <?php if(is_login() && $user_info['uid'] == get_uid()): ?><a href="<?php echo U('ucenter/config/index');?>" target="_blank" class="btn btn-default btn-green-border btn-edit no-select"><i class="icon-svg icon-pen-green"></i>编辑个人资料</a><?php endif; ?></div>
            <div class="uc_m_b_12">
            <?php if(is_login() && $user_info['uid'] != get_uid()): ?><div class="uc_follow" style="margin-top:10px;">
	                <button type="button" class="btn btn-default btn-green-border" style="width:65px;margin-right:15px" onclick="talker.start_talk(<?php echo ($user_info['uid']); ?>)"
	                       style="margin-right:15px; "><?php echo L('_CHAT_');?>
	                </button>
	                <?php echo W('Common/Follow/follow',array('follow_who'=>$user_info['uid']));?>
	            </div>
	    	<?php else: ?>
	    		<span style="color:#999">加入于 <?php echo (date("Y/m/d",$user_info["reg_time"])); ?></span><?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-xs-4" style="padding-top:45px;float:left;height:100%;">
    	<div style="width:100%;margin-left:130px;height:70%">
              <div class="col-xs-3 text-center" style="font-size:16px;">
                  <a href="<?php echo U('Ucenter/Index/fans',array('uid'=>$user_info['uid']));?>" title="<?php echo L('_FANS_NUMBER_');?>" style="font-size:36px;color:#4eaa4c;font-weight:600"><?php echo ($user_info["fans"]); ?></a><br><?php echo L('_FANS_');?>
              </div>
              <div class="col-xs-3 text-center" style="font-size:16px;">
                  <a href="<?php echo U('Ucenter/Index/following',array('uid'=>$user_info['uid']));?>" title="<?php echo L('_FOLLOWERS_NUMBER_');?>" style="font-size:36px;color:#4eaa4c;font-weight:600"><?php echo ($user_info["following"]); ?></a><br><?php echo L('_FOLLOWERS_');?>
              </div>
              <div class="col-xs-3 text-center" style="font-size:16px;">
                  <a href="<?php echo U('Ucenter/Index/following',array('uid'=>$user_info['uid']));?>" title="<?php echo L('_FOLLOWERS_NUMBER_');?>" style="font-size:36px;color:#4eaa4c;font-weight:600"><?php echo ($user_info["score"]); ?></a><br><?php echo L('_POINT_');?>
              </div>
          </div>
          <?php if(is_login() && $user_info['uid'] != get_uid()): ?><div class="text-center" style="margin-left:30px;">
	          		<p><span style="color:#999">加入于 <?php echo (date("Y/m/d",$user_info["reg_time"])); ?></span><span style="color:#999;padding-left:5px;">最后登录： <?php echo (date("Y/m/d H:i",$user_info["last_login_time"])); ?></span></p>
	          </div><?php endif; ?>
    </div>
</div>
    </div>

    <!--顶部导航之后的钩子，调用公告等-->
<?php echo hook('afterTop');?>
<!--顶部导航之后的钩子，调用公告等 end-->
    <div id="main-container" class="container">
        <div class="row">
            
    <div class="col-xs-12 usercenter">
        <div class="uc">
        	<div class="col-xs-3">
        		<?php if(is_login() && $user_info['uid'] == get_uid()): ?><a href="<?php echo U('ucenter/collection/index');?>" class="favorite" id="favorites-pjax">
        <i class="icon-svg icon-favorite-star-white"></i>我的收藏夹
      </a><?php endif; ?>
<div class="panels-default panel-skills">
  <div class="panels-heading">
        <span class="title">常用操作</span>
          <?php if(is_login() && $user_info['uid'] == get_uid()): ?><a href="<?php echo U('Ucenter/Message/message');?>" class="btn-link" target="_blank">更多</a><?php endif; ?>
     </div>
  <!--导航栏-->
        <ul class="nav nav-pills nav-stacked" style="margin-top:7px;">
          <li id="side_collection">
                <a href="<?php echo U('Ucenter/Collection/index');?>">
                      <?php if($uid == is_login()): echo L('_I_'); else: echo L('_TA_'); endif; ?>的回答<span class=" pull-right"></span>
                </a>
            </li>
            <li id="side_message">
                <a href="<?php echo U('Ucenter/Message/message');?>">
                      <?php if($uid == is_login()): echo L('_I_'); else: echo L('_TA_'); endif; ?>的提问<span class="pull-right"></span>
                </a>
            </li>
            <li id="side_invite">
              <?php if($uid == get_uid()): ?><a href="<?php echo U('Ucenter/Blog/index');?>"><?php echo L('_I_');?>的博客<span class="pull-right"></span></a>
               <?php else: ?> 
                <a href="<?php echo U('Ucenter/Blog/index/',array('uid'=>$uid));?>"><?php echo L('_TA_');?>的博客<span class="pull-right"></span></a><?php endif; ?>  
            </li>
        </ul>
</div>
    <div class="panels-default panel-skills">
    <div class="panels-heading">
        <span class="title">职位技能</span>
         <?php if(is_login() && $user_info['uid'] == get_uid()): ?><a href="<?php echo U('ucenter/config/tag');?>" class="btn-link" target="_blank">完善信息</a><?php endif; ?>
     </div>
    <div class="panels-body">
      <?php if($user_info['tags']!=''): ?><div class="skills-item">
          <div class="title">开发平台</div>
          <p>
            <?php if(is_array($user_info['tags'])): $i = 0; $__LIST__ = $user_info['tags'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i; if($tag['pid']==1){ ?>
                <span><a href="<?php echo U('people/index/index',array('tag'=>$tag['id']));?>" style="color:#4f80a1"><?php echo ($tag["title"]); ?></a></span>&nbsp;&nbsp;&nbsp;
              <?php } endforeach; endif; else: echo "" ;endif; ?>
          </p>
      </div>
         <div class="skills-item">
           <div class="title">专长领域</div>
            <p>
            <?php if(is_array($user_info['tags'])): $i = 0; $__LIST__ = $user_info['tags'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i; if($tag['pid']==19){ ?>
              <span><a href="<?php echo U('people/index/index',array('tag'=>$tag['id']));?>" style="color:#4f80a1"><?php echo ($tag["title"]); ?></a></span>&nbsp;&nbsp;&nbsp;
              <?php } endforeach; endif; else: echo "" ;endif; ?>
            </p>
        </div>
      <?php else: ?>
      <div class="uc_link_info">
        <p style="text-align: center; font-size: 16px;color:#999999"><br><br>暂无完善技能信息～ <br><br><br></p>
      </div><?php endif; ?>
     </div>
</div>
				<div>
    <div class="uc_link_block clearfix panels-default">
        <div class="uc_link_top clearfix panels-heading">
            <div class="uc_title title">
                <?php if($uid == is_login()): echo L('_I_'); else: echo L('_TA_'); endif; echo L('_DE_FOLLOWER_');?>(<?php echo ((isset($follow_totalCount) && ($follow_totalCount !== ""))?($follow_totalCount):0); ?>)
            </div>
            <div class="uc_fl_right uc_more_link"><a href="<?php echo U('following',array('uid'=>$uid));?>" class="btn-link"><?php echo L('_MORE_');?></a></div>
        </div>
        <div class="uc_link_info">
            <?php if(is_array($follow_default)): $i = 0; $__LIST__ = $follow_default;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fl): $mod = ($i % 2 );++$i;?><div class="col-xs-3">
                    <dl>
                        <a href="<?php echo ($fl["user"]["space_url"]); ?>">
                            <dt><img style="width: 45px;height: 45px" ucard="<?php echo ($fl["user"]["uid"]); ?>" src="<?php echo ($fl["user"]["avatar64"]); ?>" class="avatar-img img-responsive">
                            </dt>
                            <dd ucard="<?php echo ($fl["user"]["uid"]); ?>" class="text-more" style="width: 100%"><?php echo ($fl["user"]["nickname"]); ?></dd>
                        </a>
                    </dl>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(count($follow_default) == 0): ?><p style="text-align: center; font-size: 16px;color:#999999">
                <br><br>
                <?php echo L('_FOLLOWER_NOTHING_'); echo L('_WAVE_');?>
                <br><br><br>
            </p><?php endif; ?>
        </div>
    </div>
    <div class="uc_link_block clearfix panels-default" style="margin-top: 10px;">
        <div class="uc_link_top clearfix panels-heading">
            <div class="uc_title title">
                <?php if($uid == is_login()): echo L('_I_'); else: echo L('_TA_'); endif; echo L('_DE_FANS_');?>(<?php echo ((isset($fans_totalCount) && ($fans_totalCount !== ""))?($fans_totalCount):0); ?>)
            </div>
            <div class="uc_fl_right uc_more_link"><a href="<?php echo U('fans',array('uid'=>$uid));?>" class="btn-link"><?php echo L('_MORE_');?></a></div>
        </div>
        <div class="uc_link_info">
            <?php if(is_array($fans_default)): $i = 0; $__LIST__ = $fans_default;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fs): $mod = ($i % 2 );++$i;?><div class="col-xs-3">
                    <dl>
                        <a href="<?php echo ($fs["user"]["space_url"]); ?>">
                            <dt><img style="width: 45px;height: 45px"  ucard="<?php echo ($fs["user"]["uid"]); ?>" src="<?php echo ($fs["user"]["avatar64"]); ?>" class="avatar-img img-responsive">
                            </dt>
                            <dd ucard="<?php echo ($fs["user"]["uid"]); ?>" class="text-more" style="width: 100%"><?php echo ($fs["user"]["nickname"]); ?></dd>
                        </a>
                    </dl>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(count($fans_default) == 0): ?><p style="text-align: center; font-size: 16px;color:#999999">
                <br><br>
                <?php echo L('_FANS_NOTHING_'); echo L('_WAVE_');?>
                <br><br><br>
            </p><?php endif; ?>
        </div>
    </div>
</div>
        	</div>
        	 <div class="col-xs-9 main-article">
                    <div style="margin-top:20px;width:100%">
	                    <div class="row">
                        	<div class="way_nav">
								<h3 style="margin-left:30%;font-weight:600;line-height: 50px"><?php echo ($rankInfo["title"]); ?>申请表</h3>
                        	</div>
                    		<div style="margin-left:20px">
                                <form class="form-horizontal ajax-form" role="form" action="<?php echo U('Ucenter/Index/verify');?>" method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo ($data["id"]); ?>"/>
                                    <input type="hidden" name="uid" value="<?php echo ($data["uid"]); ?>"/>
                                    <input type="hidden" name="rank_id" value="<?php echo ($rankInfo["id"]); ?>">
                                    <input type="hidden" name="rank_user_id" value="<?php echo ($data["id"]); ?>">
                                    <div class="form-group has-feedback">
                                        <label for="title" class="col-xs-1 control-label" style="width: 10%">真实姓名</label>
                                        <div class="col-xs-8">
                                            <input id="title" name="truename" class="form-control form_check" check-type="Text" value="<?php echo ($data["truename"]); ?>" placeholder="请填写真实姓名"/>
                                        </div>
                                    </div>
                                   <div class="form-group has-feedback">
                                        <label for="QQ" class="col-xs-1 control-label" style="width: 10%">常用QQ</label>
                                        <div class="col-xs-8">
                                            <input id="QQ" name="qq" class="form-control form_check" check-type="QQ" value="<?php echo ($data["qq"]); ?>" placeholder="务必填写常用QQ"/>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="city" class="col-xs-1 control-label" style="width: 10%">所在城市</label>
                                        <div class="col-xs-8">
                                            <input id="city" name="city" class="form-control form_check" check-type="Text" value="<?php echo ($data["city"]); ?>" placeholder="请填写所在城市"/>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="company" class="col-xs-1 control-label" style="width: 10%">所在公司</label>
                                        <div class="col-xs-8">
                                            <input id="company" name="company" class="form-control form_check" check-type="Text" value="<?php echo ($data["company"]); ?>" placeholder="请填写所在公司"/>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="technology" class="col-xs-1 control-label" style="width: 10%">擅长技术</label>
                                        <div class="col-xs-8">
                                            <input id="technology" name="technology" class="form-control form_check" check-type="Text" value="<?php echo ($data["technology"]); ?>" placeholder="务必填写最擅长的5种技术,以英文,隔开"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reason" class="col-xs-1 control-label" style="width: 10%">申请理由</label>

                                        <div class="col-xs-10">
                                            <?php $config="toolbars:[['source','|','bold','italic','underline','fontsize','forecolor','fontfamily','backcolor','|','link','emotion','scrawl','attachment','insertvideo','insertimage','insertcode','wordimage']]"; ?>
                                            </php>
                                            <?php echo W('Common/Ueditor/editor',array('myeditor_edit','reason',$data['detail']['reason'],'700px','250px',$config));?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-xs-1" style="width: 10%">
                                            <button type="submit" class="btn btn-primary " href="javascript:;"><?php echo L('_SUBMIT_');?>
                                            </button>
                                        </div>
                                        <div class="col-xs-8">
                                            <button onclick="history.go(-1);" class="btn btn-default " href="javascript:;"><?php echo L('_RETURN_');?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    	</div>
                </div>
             </div>
        </div>
    </div>
    <link href="/Application/Core/Static/css/form_check.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/Application/Core/Static/js/form_check.js"></script>
    <script type="text/javascript">
    $(function (e) {
        $("#title").focus();
    })
    </script>>

        </div>
    </div>
</div>
	<!-- /主体 -->
	<!-- 底部 -->
	<div class="footer-bar" id="footer" style="padding: 30px 0 15px 0;background-color: #2a2c31;text-align: center;color: #999;">
    <div class="row text-center" style="background-color:#2a2c31">
            <p>
				<a href="" style="color:#fff">关于我们</a> |
				<a href="" style="color:#fff">联系我们</a> |
				<a href="" style="color:#fff">免责声明</a> |
				<a href="" style="color:#fff">加入我们</a>
			</p>
            <div class="col-xs-12" style="color:#fff">Copyright ©2016-2018 PHP之道 <?php echo modC('ICP',L('_NOT_SET_NOW_'),'Config');?> </div>
            <?php echo ($count_code); ?>
    </div>
</div>
<!-- jQuery (ZUI中的Javascript组件依赖于jQuery) -->
<!-- 为了让html5shiv生效，请将所有的CSS都添加到此处 -->
<link type="text/css" rel="stylesheet" href="/Public/static/qtip/jquery.qtip.css"/>
<!--<script type="text/javascript" src="/Public/js/com/com.notify.class.js"></script>-->
<!-- 其他库-->
<!--<script src="/Public/static/qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="/Public/js/ext/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/Public/static/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="/Public/js/ext/magnific/jquery.magnific-popup.min.js"></script>-->
<!--<script type="text/javascript" src="/Public/js/ext/placeholder/placeholder.js"></script>
<script type="text/javascript" src="/Public/js/ext/atwho/atwho.js"></script>
<script type="text/javascript" src="/Public/zui/js/zui.js"></script>-->
<link type="text/css" rel="stylesheet" href="/Public/js/ext/atwho/atwho.css"/>
<script src="/Public/js.php?t=js&f=js/com/com.notify.class.js,static/qtip/jquery.qtip.js,js/ext/slimscroll/jquery.slimscroll.min.js,js/ext/magnific/jquery.magnific-popup.min.js,js/ext/placeholder/placeholder.js,js/ext/atwho/atwho.js,zui/js/zui.js&v=<?php echo ($site["sys_version"]); ?>.js"></script>
<script type="text/javascript" src="/Public/static/jquery.iframe-transport.js"></script>
<script src="/Public/js/ext/lazyload/lazyload.js"></script>


<!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
    
</div>
<script type="text/javascript">
/*window.onload = function(){
var containerHeight = document.getElementById("container").scrollHeight;//实际高度，实际有多高就多高，与当前网页高度无关
var footer = document.getElementById("footer")
var allHeight = document.documentElement.clientHeight;//层在当浏览器屏幕的高度，非该层的实际高度。
if(containerHeight < allHeight){
	if($("#footer").hasClass("navbar-fixed-bottom")==false){
		$("#footer").addClass("navbar-fixed-bottom");
	}
}
}*/
</script>

	<!-- /底部 -->
</body>
</html>