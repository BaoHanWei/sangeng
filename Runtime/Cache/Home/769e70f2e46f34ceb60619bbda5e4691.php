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
<!--Style-->
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
    <link href="/Application/Home/Static/css/index.css" type="text/css" rel="stylesheet">
    <link href="/Application/Home/Static/css/public_index.css" type="text/css" rel="stylesheet">
    <?php D('Member')->need_login(); ?>
</head>
<body>
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
            <div class="" id="nav_bar_main">
                <a class="navbar-brand logo" href="<?php echo U('Home/Index/index');?>"><img src="<?php echo ($logo); ?>"/></a>
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
                <div style="clear: both;"></div>>
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




<div class="header_nav">
<!--头部导航开始-->
    <div class="header clearfix ">
        <h1 class="logo fl"><a href="http://www.hiapk.com/" title="安卓网www.hiapk.com">安卓网www.hiapk.com</a></h1>
        <div class="mainnav fl">
            <ul class="clearfix">
                <li>
                <a href="http://news.hiapk.com/" target="_blank"><b>资讯</b></a>
                <a href="http://news.hiapk.com/brands/" target="_blank">手机圈</a>
                <a href="http://news.hiapk.com/internet/" target="_blank">互联</a>
                <a href="http://news.hiapk.com/tech/" target="_blank">科技</a><br>

                <a href="http://mobile.hiapk.com/" target="_blank"><b>手机</b></a>
                <a href="http://mobile.hiapk.com/evaluate/" target="_blank">评测室</a>
                <a href="http://product.hiapk.com/" target="_blank">手机大全</a>
                </li>
                <li>
                <a href="http://game.hiapk.com/" target="_blank"><b>游戏</b></a>
                <a href="http://game.hiapk.com/syzq/" target="_blank">专区</a>
                <a href="http://game.hiapk.com/handbook/" target="_blank">攻略</a>
                <a href="http://hao.hiapk.com/" target="_blank">礼包</a><br>

                <a href="http://app.hiapk.com/" target="_blank"><b>软件</b></a>
                <a href="http://app.hiapk.com/category/" target="_blank">最新</a>
                <a href="http://app.hiapk.com/essential/" target="_blank">必备</a>
                <a href="http://app.hiapk.com/apps/" target="_blank">排行</a>
                </li>
                <li>
                <a href="http://vr.hiapk.com/" target="_blank"><b>VR频道</b></a>
                <a href="http://vr.hiapk.com/news/" target="_blank">VR资讯</a>
                <a href="http://vr.hiapk.com/videos/" target="_blank">VR视频</a><br>

                <a href="http://bbs.hiapk.com/" target="_blank"><b>论坛</b></a>
                <a href="http://bbs.hiapk.com/forum-474-1.html" target="_blank">活动</a>
                <a href="http://apk.hiapk.com/" target="_blank"><b>安卓市场</b></a>
                </li>
                <li>
                <a href="http://pic.hiapk.com/" target="_blank"><b>图库</b></a>
                <a href="http://pic.hiapk.com/sjbizhi/fl/" target="_blank">壁纸</a>
                <a href="http://joy.hiapk.com/" target="_blank">乐翻</a>
                <a href="http://pic.hiapk.com/jc/" target="_blank">内涵</a><br>

                <a href="http://news.hiapk.com/column/" target="_blank"><b>专栏</b></a>
                <a href="http://news.hiapk.com/column/days/" target="_blank">安卓日报</a>
                <a href="http://news.hiapk.com/column/geek/" target="_blank">Geek说</a>

                </li>
                <li>
                <a href="http://guide.hiapk.com/" target="_blank"><b>教程</b></a>
                <a href="http://guide.hiapk.com/jichu/" target="_blank">基础</a>
                <a href="http://guide.hiapk.com/jinjie/" target="_blank">进阶</a>
                <a href="http://guide.hiapk.com/meihua/" target="_blank">美化</a><br>

                <a href="http://rom.hiapk.com/" target="_blank"><b>刷机</b></a>
                <a href="http://rom.hiapk.com/roms/" target="_blank">ROM</a>
                <a href="http://rom.hiapk.com/drive/" target="_blank">驱动</a>
                <a href="http://rom.hiapk.com/root/" target="_blank">Root</a>
                </li>
            </ul>
        </div>
    </div>
    <!--头部位置导航结束-->
</div>
<div class="wrapper" style="min-height:800px;">
    <div class="recommend mt30 clearfix">
        <ul class="fl recommend_tab" id="tabHnadle8">
            <li class="on">用户推荐</li>
            <li class="">活跃用户</li>
        </ul>
        <div class="fl search">
            <div class="fl search_drop">
            <span id="search_drop" class="dropon">全部</span>
            <ul class="search_title" id="search_title" style="display: none;">
                <li class="on">全部</li> 
                <li>游戏</li>
                <li>软件</li>
                <li>教程</li>
                <li>机型</li>
                <li>资讯</li>
            </ul>
            </div>
            <input type="text" class="fl st_box" autocomplete="off" value="输入您要搜索的内容" name="0">
            <input type="submit" class="fl st_baidu" value="搜百度">
            <div class="fl st_bor"><span></span></div>
            <input type="submit" class="fl st_btn" value="搜站内">
        </div>
        <div class="fr funzone">
            <p class="weixin">微信<em style="display: none;"><img src="http://p3.image.hiapk.com/uploads/images/index/weixin.jpg"><i></i></em></p>
            <p class="weibo"><a href="http://weibo.com/hiapkbbs" target="_blank">微博</a><em style="display: none;"><img src="http://p3.image.hiapk.com/uploads/images/index/weibo.jpg"><i></i></em></p>
            <p class="client"><a href="http://www.hiapk.com/client/" target="_blank">客户端</a><em style="display: none;"><img src="http://p3.image.hiapk.com/uploads/images/index/kehud.jpg"><i></i></em></p>
        </div>
    </div>
    <div class="mt20 recommend_con" id="tabBody8">
        <div class="recom_apk con" style="display: block;">
            <ul class="clearfix">
                <?php if(is_array($signUser)): $i = 0; $__LIST__ = $signUser;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo ($vo["space_url"]); ?>">
                            <img class="lazy" width="45" height="45" alt=" " src="<?php echo ($vo["avatar64"]); ?>"  style="display: block;"><span><?php echo ($vo["nickname"]); ?> </span>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="recom_apk con" style="display: none;">
            <ul class="fl img_li_d clearfix">
                <?php if(is_array($signUser)): $i = 0; $__LIST__ = $signUser;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo ($vo["space_url"]); ?>">
                            <img class="lazy" width="45" height="45" alt=" " src="<?php echo ($vo["avatar64"]); ?>"  style="display: block;"><span><?php echo ($vo["nickname"]); ?> </span>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <!--头条+轮播开始-->
    <div class="mt20 clearfix">
        <div class="headline w385 overh fl">
            <?php if(is_array($recommendNews)): $i = 0; $__LIST__ = $recommendNews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h2>
                    <a title="<?php echo ($vo["title"]); ?>" href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a>
                </h2>
                <p class="mb10 clearfix">
                    <span><a title="<?php echo ($vo["description"]); ?>" href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>">
                    <?php echo mb_substr(text($vo['description']), 0, 30, 'utf-8'); ?>...</a>
                </p><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="w765 fr">
            <!-- 轮播 -->
            <div class="slide pr">
                <a class="prev" href="javascript:void(0);" style="display: none;">&lt;</a>
                <a class="next" href="javascript:void(0);" style="display: none;">&gt;</a>
                <ul class="slide_con clearfix" id="tabBody1">
                    <?php if(is_array($slideIndex)): $i = 0; $__LIST__ = $slideIndex;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($key==0){echo "style='display: list-item;'";}else{echo "style='display: none;'";} ?>>
                            <a  href="<?php echo ($vo["url"]); ?>" target="<?php echo ($vo["target"]); ?>"><img width="765" height="332" alt="<?php echo ($vo["title"]); ?>" src="<?php echo ($vo["img"]); ?>"><strong class="tit"><?php echo ($vo["title"]); ?></strong></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    
                </ul>
                <ul class="slide_tab pa clearfix" id="tabHnadle1">
                    <?php if(is_array($slideIndex)): $i = 0; $__LIST__ = $slideIndex;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($key==0){echo "class='on'";}else{echo "class=''";} ?>></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <!-- /轮播 -->
        </div>
    </div>
    <!--头条+轮播结束-->
    <div class="mt30 clearfix">
        <div class="w385 fl newhot">
        <ul class="newhot_tab clearfix" id="tabHnadle9">
        <li class="on">最新</li>
        <li class="">热门</li>
        </ul>
        <div class="mt5 newhot_con" id="tabBody9">
        <div class="con newhot_new" style="display: block;">
            <ul class="txt_li_t mt15 clearfix">
                <?php if(is_array($newNews)): $i = 0; $__LIST__ = array_slice($newNews,0,7,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($key==0){ ?>
                        <li class="hx"><a title="<?php echo ($vo["title"]); ?>" href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li>
                    <?php }else{ ?>
                        <li><a class="type" href="<?php echo U('News/index/index',array('category'=>$vo['category']));?>"><?php echo ($vo["category_name"]); ?></a><a title="<?php echo ($vo["title"]); ?>" href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li>
                    <?php } endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="txt_li_t mt15 clearfix">
                <?php if(is_array($newNews)): $i = 0; $__LIST__ = array_slice($newNews,7,7,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($key==7){ ?>
                        <li class="hx"><a title="<?php echo ($vo["title"]); ?>" href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li>
                    <?php }else{ ?>
                        <li><a class="type" href="<?php echo U('News/index/index',array('category'=>$vo['category']));?>"><?php echo ($vo["category_name"]); ?></a><a title="<?php echo ($vo["title"]); ?>" href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li>
                    <?php } endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="con" style="display: none;">
            <ul class="img_li_s clearfix">
                <?php if(is_array($hotNews)): $i = 0; $__LIST__ = $hotNews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <a title="<?php echo ($vo["title"]); ?>" href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>">
                            <img class="lazy" src="<?php echo ($vo["img"]); ?>" alt="<?php echo ($vo["title"]); ?>" width="77" height="58" style="display: block;">
                            <b><?php echo ($vo["title"]); ?></b>
                            <span><?php echo mb_substr(text($vo['description']), 0, 30, 'utf-8'); ?>...</span>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        </div>
        </div>
        <div class="w765 fr">
        <div class="fl w375">
        <div class="azzb">
        <div class="azzb_con" id="tabBody_azzb">
            <?php if(is_array($hotTopic)): $i = 0; $__LIST__ = $hotTopic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="con" <?php if($key==0){ ?> style="display: block;" <?php }else{ ?> style="display: none;" <?php } ?> >
                    <div class="box_tit box_tit2 clearfix">
                        <h4 class="fl">热门话题</h4>
                        <a class="fr more" href="<?php echo U('Weibo/topic/topic');?>">查看更多</a>
                    </div>
                    <a class="title" href="<?php echo U('Weibo/topic/index?topk='.urlencode($vo['name']));?>"><i></i>#<?php echo ($vo["name"]); ?>#</a>
                    <p class="clearfix info"><?php echo mb_substr(text($vo['intro']), 0, 56, 'utf-8'); ?>...<a style="color:#3EB158"  href="<?php echo U('Weibo/topic/index?topk='.urlencode($vo['name']));?>">[详情]</a></p>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="azzb_tab clearfix" id="tabHnadle_azzb">
            <?php if(is_array($hotTopic)): $i = 0; $__LIST__ = $hotTopic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a <?php if($key==0){ ?> class="on" <?php }else{ ?> class="" <?php } ?> href="javascript:;"></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        </div>
        <div class="mt20 rmhd">
            <div class="box_tit box_tit2 clearfix">
                <h4 class="fl">热门活动</h4>
                <a class="fr more" href="<?php echo U('Event/index/index');?>">活动版块</a>
            </div>
            <div class="con mt20 pr">
                <a class="rmhd_prev" href="javascript:;" id="rmhd_prev">&lt;</a>
                <a class="rmhd_next" href="javascript:;" id="rmhd_next">&gt;</a>
                <div class="rmhd_slide" id="rmhd_slide">
                    <ul style="width: 2250px;">
                        <?php if(is_array($hotEvent)): $i = 0; $__LIST__ = $hotEvent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a target="_blank" href="<?php echo U('Event/Index/detail',array('id'=>$vo['id']));?>"><img class="lazy" width="375" height="179" alt="{vo.title}" src="<?php echo (getthumbimagebyid($vo["cover_id"],320,210)); ?>"  style="display: inline;"><strong><?php echo ($vo["title"]); ?></strong></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt20 pljj">
            <div class="box_tit box_tit2 clearfix">
                <h4 class="fl">热门评论</h4>
                <a class="fr more"  href="<?php echo U('News/index/index');?>">查看更多</a>
            </div>
            <?php if(is_array($hotComment)): $i = 0; $__LIST__ = $hotComment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="pljj_con" id="tabBody_pljj">
                    <div class="con" <?php if($key==0){ ?> style="display: block;" <?php }else{ ?> style="display: none;" <?php } ?>>
                    <a class="title"  href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>"><i></i><?php echo ($vo["title"]); ?></a>
                    <p class="clearfix info">评论(<span class="cy_cmt_participate"><?php echo ($vo["view"]); ?></span>人查看，<span class="cy_cmt_count"><?php echo ($vo["comment"]); ?></span>条评论，<span><?php echo ($vo["collection"]); ?></span>人收藏)</p>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="pljj_tab clearfix" id="tabHnadle_pljj">
                <?php if(is_array($hotComment)): $i = 0; $__LIST__ = $hotComment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a <?php if($key==0){ ?> class="on" <?php }else{ ?> class="" <?php } ?> href="javascript:;"></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        </div>
        <div class="fr w350">
            <?php if($show_post): ?><div class="weibo_content weibo_post_box">

        <p class="pull-left">
            <?php echo modC('WEIBO_INFO',L('_TIP_SOMETHING_TO_SAY_'));?>
        </p>
        <div class="pull-right show_num_quick"><?php echo L('_TIP_REMAIN_INPUT_'); echo modC('WEIBO_NUM',140,'WEIBO'); echo L('_GE_WORDS_');?></div>
        <div class="weibo_content_p">
            <div class="row">
                <div class="col-xs-12">
                    <p><textarea class="form-control weibo_content_quick" id="weibo_content" style="height: 6em;border-radius:1px"
                                 placeholder="<?php echo L('_PLACEHOLDER_SOMETHING_TO_WRITE_');?>" onfocus="startCheckNum_quick($(this))"
                                 onblur="endCheckNum_quick()"></textarea></p>
                    <a href="javascript:" onclick="insertFace($(this))">
                        <img class="weibo_type_icon" src="/Application/Core/Static/images/bq.png" style="margin-top:5px" />
                    </a>
                    <?php if(modC('CAN_IMAGE',1)): ?><a href="javascript:" id="insert_image" onclick="insert_image.insertImage(this)">
                        <img class="weibo_type_icon" src="/Application/Weibo/Static/images/image.png" style="margin-top:5px"/>
                    </a><?php endif; ?>
                    <?php if(modC('CAN_TOPIC',1)): ?><a href="javascript:" onclick="insert_topic.InsertTopic(this)">
                        <img class="weibo_type_icon" src="/Application/Weibo/Static/images/topic.png" style="margin-top:5px"/>
                    </a><?php endif; ?>
                    <?php echo hook('weiboType');?>
                    <p class="pull-right">
                        <input type="submit" value="<?php echo L('_PUBLISH_');?>"  data-role="send_weibo" class="btn btn-primary btn-lg" style="border:none;width: 70px;padding:4px;background-color:#3EB158" data-url="<?php echo U('Weibo/Index/doSend');?>"/>
                    </p>
                </div>
            </div>
            <div id="emot_content" class="emot_content"></div>
            <div id="hook_show" class="emot_content"></div>
        </div>
    </div>
    <script>
        var ID_setInterval;
        function checkNum_quick(obj) {
            var value = obj.val();
            var value_length = value.length;
            var can_in_num = initNum - value_length;
            if (can_in_num < 0) {
                value = value.substr(0, initNum);
                obj.val(value);
                can_in_num = 0;
            }
            var html = "<?php echo L('_TIP_REMAIN_INPUT_');?>" + can_in_num + "<?php echo L('_GE_WORDS_');?>";
            $('.show_num_quick').html(html);
        }
        function startCheckNum_quick(obj) {
            ID_setInterval = setInterval(function () {
                checkNum_quick(obj);
            }, 250);
        }
        function endCheckNum_quick() {
            clearInterval(ID_setInterval);
        }
    </script>
    <script type="text/javascript" charset="utf-8" src="/Public/js/ext/webuploader/js/webuploader.js"></script>
    <link href="/Public/js/ext/webuploader/css/webuploader.css" type="text/css" rel="stylesheet"><?php endif; ?>



            <div id="weibo_list">
                <?php if(is_array($weibo)): $i = 0; $__LIST__ = $weibo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i;?><div class="box tweet">
    <a class="box-fl" href="<?php echo ($weibo["user"]["space_url"]); ?>" target="_blank" title="<?php echo ($weibo["user"]["nickname"]); ?>">
        <figure>
            <img class="tweet-uimg" src="<?php echo ($weibo["user"]["avatar32"]); ?>">
        </figure>
    </a>
    <div class="box-aw">
        <p class="tweet-content wrap"><span class="tweet-user"><a href="<?php echo ($weibo["user"]["space_url"]); ?>" target="_blank" title="<?php echo ($weibo["user"]["nickname"]); ?>" style="color:#3879D9"><?php echo ($weibo["user"]["nickname"]); ?></a>：<?php echo ($weibo["content"]); ?></p>
        <div class="box vertical justify toolbox">
            <span><?php echo (friendlydate($weibo["create_time"])); ?><a class="commened" href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>" target="_blank" style="padding-left:8px">(<?php echo ($weibo["comment_count"]); ?>评)</a>&nbsp;</span>
            <a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>" style="font-size:12px;padding-left:8px;color: #9B9B9B;">(<?php echo ($weibo["repost_count"]); ?>赞)</a>
           <a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>" style="font-size:12px;padding-left:8px;color: #9B9B9B;">查看</a>
        </div>
    </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>


            </div>
        </div>
        </div>
    </div>
    <!--资讯+微博模块结束-->
    <!--通栏广告开始-->
    <!--通栏广告结束-->
    <!--教程频道开始-->
    <div class="mt20 clearfix">
        <div class="fl w790">
            <div class="col_tit clearfix">
            <h3><a target="_blank" href="http://game.hiapk.com/"><span class="green">教程</span>频道</a></h3>
            <p class="col_tit_tag">
            <a target="_blank" href="http://game.hiapk.com/lab/newgames/">新游</a>
            <a target="_blank" href="http://game.hiapk.com/lab/pic/">评测</a>
            <a target="_blank" href="http://game.hiapk.com/lab/test/">试玩</a>
            <a target="_blank" href="http://game.hiapk.com/chanye/cy/">产业</a>
            <a target="_blank" href="http://game.hiapk.com/chanye/sj/">数据</a>
            </p>
            </div>
            <div class="mt20 clearfix">
                <div class="tutorial-item">
                    <?php if(is_array($tutorialList)): $i = 0; $__LIST__ = $tutorialList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="" class="tutorial-box" title="<?php echo ($vo["title"]); ?>">
                        <img src="<?php echo (getthumbimagebyid($vo["img"],320,210)); ?>" alt="<?php echo ($vo["title"]); ?>" title="<?php echo ($vo["title"]); ?>">                  
                        <h3><?php echo ($vo["title"]); ?></h3>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
        <div class="fr w350 hao">
            <div class="col_tit clearfix">
                <h3><a target="_blank" href="http://hao.hiapk.com/">游戏礼包</a></h3>
                <a class="fr more" target="_blank" href="http://hao.hiapk.com/">发号中心</a>
            </div>
            <div class="mt20 hao_list">
                <div class="tutorial-item">
                    <?php if(is_array($tutorialList)): $i = 0; $__LIST__ = $tutorialList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="" class="tutorial-box" title="<?php echo ($vo["title"]); ?>">
                            <img src="<?php echo (getthumbimagebyid($vo["img"],320,210)); ?>" alt="<?php echo ($vo["title"]); ?>" title="<?php echo ($vo["title"]); ?>">                  
                            <h3><?php echo ($vo["title"]); ?></h3>
                            </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!--教程频道结束-->
    <!--问答频道开始-->
    <div class="mt20 clearfix">
        <div class="fl w790">
            <div class="col_tit clearfix">
                <h3><a target="_blank" href="http://game.hiapk.com/"><span class="green">问答</span>频道</a></h3>
                <p class="col_tit_tag">
                <a target="_blank" href="http://game.hiapk.com/lab/newgames/">新游</a>
                <a target="_blank" href="http://game.hiapk.com/lab/pic/">评测</a>
                <a target="_blank" href="http://game.hiapk.com/lab/test/">试玩</a>
                <a target="_blank" href="http://game.hiapk.com/chanye/cy/">产业</a>
                <a target="_blank" href="http://game.hiapk.com/chanye/sj/">数据</a>
                </p>
            </div>
            <div class="mt20 clearfix">
                <div class="question_list">
                    <?php if(is_array($tutorialList)): $i = 0; $__LIST__ = $tutorialList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
        <div class="fr w350 hao">
            <div class="col_tit clearfix">
                <h3><a target="_blank" href="http://hao.hiapk.com/">热门标签</a></h3>
                <a class="fr more" target="_blank" href="http://hao.hiapk.com/">发号中心</a>
            </div>
            <div class="mt20 hao_list">
                <div class="tutorial-item">
                    <?php if(is_array($tutorialList)): $i = 0; $__LIST__ = $tutorialList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="" class="tutorial-box" title="<?php echo ($vo["title"]); ?>">
                            <img src="<?php echo (getthumbimagebyid($vo["img"],320,210)); ?>" alt="<?php echo ($vo["title"]); ?>" title="<?php echo ($vo["title"]); ?>">                  
                            <h3><?php echo ($vo["title"]); ?></h3>
                            </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!--问答频道结束-->
    <!--博客系统开始-->
    <div class="mt20 clearfix">
        <div class="fl w790">
        <div class="col_tit clearfix">
        <h3><a target="_blank" href="http://vr.hiapk.com/"><span class="green">VR</span>频道</a></h3>
        </div>
        <div class="mt20 clearfix">
        <div class="fl w385">
        <div class="smzdm_c pr">
            <div id="tabHnadle_vr" style="display:none;">
                <a class=""></a>
                <a class="on"></a>
                <a class=""></a>
                <a class=""></a>
                <a class=""></a>
            </div>
            <a class="prev_vr" href="javascript:void(0);">&lt;</a>
            <a class="next_vr" href="javascript:void(0);">&gt;</a>
            <ul class="w385 img_li clearfix" id="tabBody_vr">
                
                <li style="display: none;"><a target="_blank" href="http://vr.hiapk.com/business/s58b39c2dad92.html"><img class="lazy" width="385" height="220" alt="《Hardlight Suit》将开启众筹" src="http://img.qt.baidu.com/hiapk_vr/201702/27/58b39c5eabb61.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/27/58b39c5eabb61.jpg" style="display: block;"><strong>《Hardlight Suit》将开启众筹</strong></a></li>
                
                <li style="display: list-item;"><a target="_blank" href="http://vr.hiapk.com/business/s58ae9cca1673.html"><img class="lazy" width="385" height="220" alt="Steam VR应用营收堪忧" src="http://img.qt.baidu.com/hiapk_vr/201702/23/58ae9cdb28cb8.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/23/58ae9cdb28cb8.jpg" style="display: block;"><strong>Steam VR应用营收堪忧</strong></a></li>
                
                <li style="display: none;"><a target="_blank" href="http://vr.hiapk.com/business/s58aa944e0085.html"><img class="lazy" width="385" height="220" alt="NBA发行虚拟现实应用" src="http://img.qt.baidu.com/hiapk_vr/201702/20/58aa94a2ec5b7.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/20/58aa94a2ec5b7.jpg"><strong>NBA发行虚拟现实应用</strong></a></li>
                
                <li style="display: none;"><a target="_blank" href="http://vr.hiapk.com/business/s58a5104a1186.html"><img class="lazy" width="385" height="220" alt="Next VR直播17年NBA" src="http://img.qt.baidu.com/hiapk_vr/201702/16/58a510cb2ce68.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/16/58a510cb2ce68.jpg"><strong>Next VR直播17年NBA</strong></a></li>
                
                <li style="display: none;"><a target="_blank" href="http://vr.hiapk.com/business/s58a2c42328a0.html"><img class="lazy" width="385" height="220" alt="百度风投首投AR公司8i" src="http://img.qt.baidu.com/hiapk_vr/201702/14/58a2c48dcc69d.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/14/58a2c48dcc69d.jpg"><strong>百度风投首投AR公司8i</strong></a></li>
                
            </ul>
        </div>
        <div class="mt30 smzdm_d" id="tabBody4">
            <div class="con clearfix" style="display: block;">
            <div class="fl pic"><a target="_blank" href="http://vr.hiapk.com/devices/reviews/s58a50bde4262.html"><img class="lazy" width="160" height="120" alt="Oculus Rift房间尺度定位追踪存在问题" src="http://img.qt.baidu.com/hiapk_vr/201702/16/focus_58a50bd9949bb.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/16/focus_58a50bd9949bb.jpg" style="display: inline;"></a></div>
            <div class="fr detail">
            <h5><a target="_blank" href="http://vr.hiapk.com/devices/reviews/s58a50bde4262.html">Oculus Rift定位追踪</a></h5>
            <p>正在努力改进核心软件</p>
            </div>
            </div>
            <div class="con clearfix" style="display: none;">
            <div class="fl pic"><a target="_blank" href="http://vr.hiapk.com/devices/tutorials/s589435e8813e.html"><img class="lazy" width="160" height="120" alt="在任意安卓Nougat手机运行Daydream" src="http://img.qt.baidu.com/hiapk_vr/201702/03/focus_589435e3a4417.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/03/focus_589435e3a4417.jpg" style="display: inline;"></a></div>
            <div class="fr detail">
            <h5><a target="_blank" href="http://vr.hiapk.com/devices/tutorials/s589435e8813e.html">Nougat手机运行Daydream</a></h5>
            <p>支持数量将会继续增加</p>
            </div>
            </div>
            <div class="con clearfix" style="display: none;">
            <div class="fl pic"><a target="_blank" href="http://vr.hiapk.com/devices/reviews/s58784042b78f.html"><img class="lazy" width="160" height="120" alt="松下VR头显体验 搭配220FOV 6K分辨率" src="http://img.qt.baidu.com/hiapk_vr/201701/13/focus_5878402fc7643.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201701/13/focus_5878402fc7643.jpg" style="display: inline;"></a></div>
            <div class="fr detail">
            <h5><a target="_blank" href="http://vr.hiapk.com/devices/reviews/s58784042b78f.html">松下VR头显体验</a></h5>
            <p>产品将在2018年发货</p>
            </div>
            </div>
            <div class="con clearfix" style="display: none;">
            <div class="fl pic"><a target="_blank" href="http://vr.hiapk.com/devices/reviews/s58744059da27.html"><img class="lazy" width="160" height="120" alt="华硕ZenFone AR评测 首款同时对应Daydream和Tango手机" src="http://img.qt.baidu.com/hiapk_vr/201701/10/focus_5874403289b51.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201701/10/focus_5874403289b51.jpg" style="display: inline;"></a></div>
            <div class="fr detail">
            <h5><a target="_blank" href="http://vr.hiapk.com/devices/reviews/s58744059da27.html">华硕ZenFone AR评测 </a></h5>
            <p>采用金属面板</p>
            </div>
            </div>
            <div class="con clearfix" style="display: none;">
            <div class="fl pic"><a target="_blank" href="http://vr.hiapk.com/devices/reviews/s5847ad4796a2.html"><img class="lazy" width="160" height="120" alt="Oculus Touch评测：手部临在感来袭" src="http://img.qt.baidu.com/hiapk_vr/201612/07/focus_5847ad42420b6.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201612/07/focus_5847ad42420b6.jpg" style="display: inline;"></a></div>
            <div class="fr detail">
            <h5><a target="_blank" href="http://vr.hiapk.com/devices/reviews/s5847ad4796a2.html">Oculus Touch评测</a></h5>
            <p>沉浸感变得更强</p>
            </div>
            </div>
            
        </div>
        <div class="smzdm_tab">
        <ul class="clearfix" id="tabHnadle4">
            <li class="on"><em>◆</em><span>16日</span></li>
            <li class=""><em>◆</em><span>03日</span></li>
            <li class=""><em>◆</em><span>13日</span></li>
            <li class=""><em>◆</em><span>10日</span></li>
            <li class=""><em>◆</em><span>07日</span></li>
        </ul>
        </div>
        </div>
        <div class="fr w375">
            <ul class="txt_li_t clearfix">
                
                <li class="hx"><a title="新冲击感应VR组件《Hardlight Suit》即将开启众筹" target="_blank" href="http://vr.hiapk.com/business/s58b39c2dad92.html">新冲击感应VR组件《Hardlight Suit》即将开启众筹</a></li>
                
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="用VR来安抚孩子的情绪 恐惧感大幅度降低" target="_blank" href="http://vr.hiapk.com/business/s58b39be34b2a.html">用VR来安抚孩子的情绪 恐惧感大幅度降低</a></li>
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="索尼GDC技术演示 让虚拟角色更像真人" target="_blank" href="http://vr.hiapk.com/business/s58b39b8b43c4.html">索尼GDC技术演示 让虚拟角色更像真人</a></li>
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="ZeniMax向法院申请限制Oculus Rift的销售" target="_blank" href="http://vr.hiapk.com/business/s58afa638de64.html">ZeniMax向法院申请限制Oculus Rift的销售</a></li>
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="OptiTrack Active推出全新的VR追踪系统" target="_blank" href="http://vr.hiapk.com/business/s58afa5460e90.html">OptiTrack Active推出全新的VR追踪系统</a></li>
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="三星推出全新高级移动应用处理器 提升VR性能" target="_blank" href="http://vr.hiapk.com/business/s58afa456d62e.html">三星推出全新高级移动应用处理器 提升VR性能</a></li>
                
            </ul>
            <ul class="txt_li_t mt10 clearfix">
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="Zappar完成375万美元融资 中国游戏发行商乐逗参投" target="_blank" href="http://vr.hiapk.com/business/s58afa3ae35a1.html">Zappar完成375万美元融资 中国游戏发行商乐逗参投</a></li>
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="高通与厉动达成协议 手势交互将接入835移动平台" target="_blank" href="http://vr.hiapk.com/business/s58afa34abcfb.html">高通与厉动达成协议 手势交互将接入835移动平台</a></li>
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="SteamVR定位技术开发者套件的预售今日正式开启" target="_blank" href="http://vr.hiapk.com/business/s58afa3076321.html">SteamVR定位技术开发者套件的预售今日正式开启</a></li>
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="HTC Vive向开发者开放订阅服务 采取四六分成制" target="_blank" href="http://vr.hiapk.com/business/s58afa29ac642.html">HTC Vive向开发者开放订阅服务 采取四六分成制</a></li>
                
                <li><!--<a class="type" href="http://vr.hiapk.com/business/" target="_blank"></a>-->·  <a title="高通宣布推出全新VR头显参考设计 价格未知" target="_blank" href="http://vr.hiapk.com/business/s58af88ba931e.html">高通宣布推出全新VR头显参考设计 价格未知</a></li>
                
            </ul>
        </div>
        </div>
        </div>
        <div class="fr w350">
            <div class="col_tit clearfix">
                <h3><a target="_blank" href="http://vr.hiapk.com/videos/">视频中心</a></h3>
                <a class="fr more" target="_blank" href="http://vr.hiapk.com/videos/">查看更多</a>
            </div>
            <div class="mt20 smzdm_share">
                <ul class="img_li clearfix">
                <li><a target="_blank" href="http://vr.hiapk.com/videos/others/s58aa9ae5ddf9.html"><img class="lazy" width="165" height="124" alt="NBA为谷歌DayDream VR平台带来原创内容" src="http://img.qt.baidu.com/hiapk_vr/201702/20/focus_58aa9ae28dc1f.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/20/focus_58aa9ae28dc1f.jpg" style="display: block;"><strong>NBA VR原创内容</strong></a></li>
                <li><a target="_blank" href="http://vr.hiapk.com/videos/others/s589a68cb6a13.html"><img class="lazy" width="165" height="124" alt="与艺术合一 VR带你走进《蒙娜丽莎》的世界" src="http://img.qt.baidu.com/hiapk_vr/201702/08/focus_589a68c92ac88.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/08/focus_589a68c92ac88.jpg" style="display: block;"><strong>VR带你走进《蒙娜丽莎》</strong></a></li>
                
                <li><a target="_blank" href="http://vr.hiapk.com/videos/others/s58996c0dbba2.html"><img class="lazy" width="165" height="124" alt="开发者自制HoloLens版《传送门》 家里变成游戏场地" src="http://img.qt.baidu.com/hiapk_vr/201702/07/focus_58996c09f31f5.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/07/focus_58996c09f31f5.jpg" style="display: block;"><strong>HoloLens版《传送门》</strong></a></li>
                
                <li><a target="_blank" href="http://vr.hiapk.com/videos/others/s5899257903b6.html"><img class="lazy" width="165" height="124" alt="R18游戏《VR女友》新预告公布 黑丝变装福利不停" src="http://img.qt.baidu.com/hiapk_vr/201702/07/focus_5899257512849.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/07/focus_5899257512849.jpg" style="display: block;"><strong>R18游戏《VR女友》新预告公布</strong></a></li>
                
                <li><a target="_blank" href="http://vr.hiapk.com/videos/others/s58983090d46a.html"><img class="lazy" width="165" height="124" alt="黑客结合HTC Vive和HoloLens头盔创造“混合现实”" src="http://img.qt.baidu.com/hiapk_vr/201702/06/focus_5898308def92c.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/06/focus_5898308def92c.jpg" style="display: block;"><strong>结合HTC Vive和HoloLens头盔</strong></a></li>
                
                <li><a target="_blank" href="http://vr.hiapk.com/videos/others/s58982f1878c9.html"><img class="lazy" width="165" height="124" alt="亲身”体验，SpaceX为超级高铁发布360度演示视频" src="http://img.qt.baidu.com/hiapk_vr/201702/06/focus_58982f165da35.jpg" data-original="http://img.qt.baidu.com/hiapk_vr/201702/06/focus_58982f165da35.jpg" style="display: block;"><strong>超级高铁360度演示视频</strong></a></li>
                
                </ul>
            </div>
        </div>
    </div>
    <!--博客系统结束-->
    <!--友链开始-->
    <div class="wrapper link mt30 clearfix">
        <div class="link_tit">
            <a class="fr more" target="_blank" href="http://www.hiapk.com/about/links.html">更多链接/申请加入</a>
            <h3>友情链接</h3>
        </div>
        <div class="link_con clearfix">
            <div class="link_list clearfix">
                <strong>友情链接</strong>
                <div class="link_div">
                    <div id="partner" class="partner_con">
                        <ul class="clearfix" style="width: 1540px;">
                            <li><a title="vr论坛" target="_blank" href="&#9;http://bbs.ivr.baidu.com/">vr论坛</a></li>
                            <li><a title="百度Crab服务平台" target="_blank" href="http://crab.baidu.com/">百度Crab服务平台</a></li>
                            <li><a title="雷锋网" target="_blank" href="&#9;http://www.leiphone.com/">雷锋网</a></li>
                            <li><a title="亿智蘑菇" target="_blank" href="&#9;http://www.yzmg.com/">亿智蘑菇</a></li>
                            <li><a title="91助手" target="_blank" href="&#9;http://zs.91.com/">91助手</a></li>
                            <li><a title="苹果助手" target="_blank" href="&#9;http://www.pgzs.com/">苹果助手</a></li>
                            <li><a title="前瞻网" target="_blank" href="http://www.qianzhan.com">前瞻网</a></li>
                            <li><a title="太平洋电脑网" target="_blank" href="http://mobile.pconline.com.cn/">太平洋电脑网</a></li>
                            <li><a title="北斗星手机网" target="_blank" href="http://www.139shop.com/">北斗星手机网</a></li>
                            <li><a title="手机中国" target="_blank" href="http://www.cnmo.com/">手机中国</a></li>                                                                       
                        </ul>
                    </div>
                    <div class="link_arrow"> <a class="link_right" href="#" id="partnerPrev">←</a> <a class="link_left" href="#" id="partnerNext">→</a> </div>
                </div>
            </div>
        </div>
    </div>
    <!--友链结束-->

</div>
<!-- /头部 -->
<!-- 主体 -->
<!-- /主体 -->
<!-- 底部 -->
<script type="text/javascript" src="http://hit.stat.hiapk.com/templets/default/v1/Index/script/marquee.js"></script>
<script type="text/javascript" src="http://hit.stat.hiapk.com/templets/default/v1/Index/script/index_v4.1.js"></script> 
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