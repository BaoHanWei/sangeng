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

    <link href="/Application/Weibo/Static/css/topic.css" rel="stylesheet"/>
    <link href="/Application/Weibo/Static/css/weibo.css" rel="stylesheet"/>

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
    
    <?php echo W('Common/SubMenu/render',array($sub_menu,$tab,array('icon'=>'quote-left'),''));?>

    <!--顶部导航之后的钩子，调用公告等-->
<?php echo hook('afterTop');?>
<!--顶部导航之后的钩子，调用公告等 end-->
    <div id="main-container" class="container">
        <div class="row">
            
<div class="topics">
<div id="topic">
<div class="top-jg"></div>
<div class="top">
    <div class="data">
        <div class="fudg">
            <div class="portrait"><img
                    src="<?php if($topic["logo"] != 0): echo (getthumbimagebyid($topic["logo"],180,180)); else: ?>/Application/Weibo/Static/images/topicavatar.png<?php endif; ?>"
                    width="180" height="180"></div>
        </div>
        <div class="fudg">
            <div class="huati">#<?php echo ($topic["name"]); ?>#</div>
            <div class="gzfx">
                <!--         <div class="hjgfb public-cursor public-background hjgfb1">关注</div>-->
                <a class="hjgfb public-cursor" target="_blank" id="topic_shareBtn"><?php echo L('_SHARE_');?></a>
                <script>
                    $(function () {
                        var wb_shareBtn = document.getElementById("topic_shareBtn")
                        wb_url = document.URL, //获取当前页面地址，也可自定义例：wb_url = "http://www.bluesdream.com"
                                wb_appkey = "",
                                wb_title = document.title,
                                wb_ralateUid = "<?php echo C('SHARE_WEIBO_ID');?>",
                                wb_pic = "",
                                wb_language = "zh_cn";
                        wb_shareBtn.setAttribute("href", "http://service.weibo.com/share/share.php?url=" + wb_url + "&appkey=" + wb_appkey + "&title=" + wb_title + "&pic=" + wb_pic + "&ralateUid=" + wb_ralateUid + "&language=" + wb_language + "");
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<div class="content">
<div class="public-left conhjg">
    <div class="border line2">
        <div class="line2-lefd col-xs-6" style="width: 50%">
            <div class="numder"><?php echo ($topic["read_count"]); ?></div>
            <div class="beizu"><?php echo L('_READ_');?></div>
        </div>
        <div class="line2-lefd col-xs-6 text-center" style="width: 50%">
            <div class="numder"><?php echo ($total_count); ?></div>
            <div class="beizu"><?php echo L('_COMMENT_');?></div>
        </div>
        <!--   <div class="line2-lefd">
               <div class="numder"><?php echo ((isset($total_sub) && ($total_sub !== ""))?($total_sub):0); ?></div>
               <div class="beizu">粉丝</div>
           </div>-->
    </div>
    <div class="border">
        <div class="recommended">
            <h4 class="name"><?php echo L('_PRESENTER_TOPIC_');?></h4>
            <?php if(($host["status"]) == "1"): ?><div class="original ">
                    <img name="" src="<?php echo ($host["avatar128"]); ?>" style="border-radius: 50%;" width="80" height="80">

                    <div class="jshgv">
                        <a class="named" href="<?php echo ($host["space_url"]); ?>">
                            <?php echo ($host["nickname"]); ?>
                            <?php if(is_array($host["rank_link"])): $i = 0; $__LIST__ = $host["rank_link"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rank): $mod = ($i % 2 );++$i;?><img src="<?php echo ($rank["logo_url"]); ?>" title="<?php echo ($rank["title"]); ?>" alt="<?php echo ($rank["title"]); ?>"
                                     style="width: 16px;height: 16px;vertical-align: middle;margin-left: 2px;"><?php endforeach; endif; else: echo "" ;endif; ?>
                        </a>

                        <div class="shumin">
                            <?php if($user_info['signature'] == ''): echo L('_NO_IDEA_');?>
                                <?php else: ?>
                                <attr title="<?php echo ($user_info["signature"]); ?>"><?php echo ($user_info["signature"]); ?></attr><?php endif; ?>
                        </div>
                        <?php if(is_login() && $host['uid'] != get_uid()): ?><p class="text-right">
                                <?php echo W('Common/Follow/follow',array('follow_who'=>$host['uid']));?>
                            </p>

                            <?php else: ?>
                            <?php if($host['uid'] == get_uid()): ?><p class="text-right"><a class="btn btn-primary" disabled="disabled" style="color:#fff"><?php echo L('_SELF_');?></a></p><?php endif; endif; ?>
                    </div>
                </div>
                <div class="margin_bottom_10"></div>
                <div class="statement"><?php echo L('_STATEMENT_');?></div><?php endif; ?>
            <?php if(($host["status"]) == "0"): ?><div class="clearfix margin_bottom_10 ">
                    <div class="col-md-4">
                        <img class="avatar-img" src="/Application/Weibo/Static/images/nobody.jpg"/>
                    </div>
                    <div class="col-md-8">
                        <h5><a><?php echo L('_WAIT_FOR_YOU_');?></a></h5>
                        <div>
                            <p>
                                <?php if(check_auth('Weibo/Topic/beAdmin')): ?><button class="btn btn-danger" onclick="to_be_number_one(<?php echo ($topic['id']); ?>)"><?php echo L('_PRESENT_RUSH_');?>
                                    </button><?php endif; ?>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger margin_bottom_0"><?php echo L('_RULE_PRESENTER_');?></div>
                <?php else: endif; ?>
        </div>
    </div>
    <?php if($topic['qrcode'] != 0): ?><!-- <div class="border public-clear">
            <h4 class="shaoshao"><?php echo L('_TOPIC_TWO_DIMENSION_CODE_');?></h4>

            <div class="shayh">
                <img src="<?php echo (getthumbimagebyid($topic["qrcode"],220,220)); ?>" width="220" height="220">
            </div>
        </div> --><?php endif; ?>
    <?php if(check_auth('Weibo/Topic/editTopic',$topic['uadmin']) and is_login()): ?><div class="common_block_border">
            <h4 class="common_block_title"><?php echo L('_ADMIN_PANEL_');?></h4>
            <div class="clearfix">
                <div class="clearfix col-md-12 margin_bottom_10">
                    <form role="form" action="<?php echo U('editTopic');?>" method="post" class="ajax-form">
                        <div class="form-group">
                            <div class="margin_bottom_10"><?php echo L('_TIP_PRESENTER_SETTINGS_');?></div>
                            <input name="id" type="hidden" value="<?php echo ($topic["id"]); ?>">
                            <style>
                                .web_uploader_picture_list img {
                                    width: 180px;
                                    height: 180px;
                                    margin-top: 10px;
                                }
                                #web_uploader_picture_list_qrcode img {
                                    width: 220px;
                                    height: 220px;
                                }
                            </style>
                            <label for="avatar"><?php echo L('_TOPIC_PIC_');?>(180px*180px)</label>

                            <div>
                                <?php echo W('Common/UploadImage/render',array(array('id'=>'avatar','name'=>'logo','value'=>$topic['logo'])));?>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="qrcode"><?php echo L('_TOPIC_TWO_DIMENSION_CODE_');?>(220px*220px)</label>

                            <div>
                                <?php echo W('Common/UploadImage/render',array(array('id'=>'qrcode','name'=>'qrcode','width'=>'100','height'=>'100','value'=>$topic['qrcode'])));?>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="intro"><?php echo L('_TOPIC_LEAD_');?></label>
                            <textarea class="form-control" id="intro" name="intro" placeholder="<?php echo L('_PLACEHOLDER_TOPIC_LEAD_');?>"><?php echo ($topic['intro']); ?></textarea>
                        </div>
                        <?php if(check_auth('Weibo/Topic/editTopic')): ?><div class="margin_bottom_10"><?php echo L('_TIP_ADMIN_SETTINGS_');?></div>
                            <div class="form-group">
                                <label for="intro"><?php echo L('_PRESENTER_UID_');?></label>
                                <input type="text" class="form-control" id="uadmin" name="uadmin" placeholder="<?php echo L('_PLACEHOLDER_INPUT_PRESENTER_UID_');?>"
                                       value="<?php echo ($topic['uadmin']); ?>">
                            </div>
                            <div class="form-group">
                                <?php if(($topic["is_top"]) == "1"): ?><input type="checkbox" value="1" id="top" name="is_top" checked><label for="top"><?php echo L('_TOPIC_RECOMMEND_YES_OR_NOT_');?></label>
                                    <?php else: ?>
                                    <input type="checkbox" value="1" id="top" name="is_top"><label
                                        for="top"><?php echo L('_TOPIC_RECOMMEND_YES_OR_NOT_');?></label><?php endif; ?>
                            </div><?php endif; ?>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <?php echo L('_SETTINGS_');?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div><?php endif; ?>
</div>
<div class="public-right coghgf ">
    <div class="batem margin_bottom_10"><?php echo L('_LEAD_'); echo L('_COLON_'); echo ((isset($topic["intro"]) && ($topic["intro"] !== ""))?($topic["intro"]):L('_TOPIC_RECOMMEND_')); ?></div>
    <div class="row">
        <?php if(is_login()): if(is_login() && check_auth('Weibo/Index/doSend')): ?><div class="row">
        <div class="col-xs-12">
            <div class="col-md-2 col-sm-2 col-xs-12 text-center" style="position: relative">

                <br/>

            </div>
            <div class="col-xs-12">
                <div class="weibo_content weibo_post_box">

                    <p class="pull-left">
                        <if condition="modC('SHOW_TITLE',1)">
                            <small class="font_grey">【<?php echo ($self["title"]); ?>】</small><?php endif; ?>
                        <a ucard="<?php echo ($self["uid"]); ?>"
                           href="<?php echo ($self["space_url"]); ?>" class="user_name"> <?php echo (htmlspecialchars($self["nickname"])); ?>
                        </a>
                        <?php if(is_array($self['rank_link'])): $i = 0; $__LIST__ = $self['rank_link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i; if($vl['is_show']): ?><img src="<?php echo ($vl["logo_url"]); ?>" title="<?php echo ($vl["title"]); ?>" alt="<?php echo ($vl["title"]); ?>"
                                     class="rank_html"/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </p>
                    <div class="pull-right show_num_quick"><?php echo L('_TIP_REMAIN_INPUT_'); echo modC('WEIBO_NUM',140,'WEIBO'); echo L('_GE_WORDS_');?></div>
                    <div class="weibo_content_p">
                        <div class="row">
                            <div class="col-xs-12">
                                <p><textarea class="form-control weibo_content_quick" id="weibo_content"
                                             style="height: 6em;"
                                             placeholder="<?php echo L('_PLACEHOLDER_SOMETHING_TO_WRITE_');?>" onfocus="startCheckNum_quick($(this))"
                                             onblur="endCheckNum_quick()">#<?php echo ($topic['name']); ?>#</textarea></p>

                                <a href="javascript:" onclick="insertFace($(this))"><img class="weibo_type_icon"
                                                                                         src="/Application/Core/Static/images/bq.png"/></a>

                                <?php if(modC('CAN_IMAGE',1)): ?><a href="javascript:" id="insert_image" onclick="insert_image.insertImage(this)">
                                        <img class="weibo_type_icon" src="/Application/Weibo/Static/images/image.png"/>
                                    </a><?php endif; ?>

                                <?php echo hook('weiboType');?>
                                <p class="pull-right">
                                    <input type="submit" value="<?php echo L('_PUBLISH_');?> Ctrl+Enter" data-role="send_weibo" class="btn btn-primary" data-url="<?php echo U('Weibo/Index/doSend');?>"/>
                                </p>
                            </div>
                        </div>
                        <div id="emot_content" class="emot_content"></div>
                        <div id="hook_show" class="emot_content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        send_weibo();
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
    </script><?php endif; ?>

        </if>
        <div id="weibo_list" style="padding:0 10px;">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i; echo W('WeiboDetail/detail',array('weibo'=>$weibo)); endforeach; endif; else: echo "" ;endif; ?>

        </div>
        <div class="text-right">
            <?php echo getPagination($total_count,30);?>
        </div>
    </div>
</div>
</div>
</div>
</div>

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



    <script src="/Application/Weibo/Static/js/weibo.js"></script>
    <script>
        var SUPPORT_URL = "<?php echo addons_url('Support://Support/doSupport');?>";
        $(function () {
             weibo_bind();
        });
    </script>
    <link rel="stylesheet" href="/Application/Weibo/Static/css/photoswipe.css">
    <link rel="stylesheet" href="/Application/Weibo/Static/css/default-skin/default-skin.css">
    <script src="/Application/Weibo/Static/js/photoswipe.min.js"></script>
    <script src="/Application/Weibo/Static/js/photoswipe-ui-default.min.js"></script>

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