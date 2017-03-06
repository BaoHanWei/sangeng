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
    
    <!--顶部导航之后的钩子，调用公告等-->
<?php echo hook('afterTop');?>
<!--顶部导航之后的钩子，调用公告等 end-->
    <div id="main-container" class="container">
        <div class="row">
            
    <link href="/Application/Ucenter/Static/css/center.css" type="text/css" rel="stylesheet">
    <section>
        <div class="col-xs-12 col-sm-offset-1 register clearfix" style="margin-top: 50px;margin-bottom: 110px;background-color: white;padding: 10px;">
            <div class="col-xs-12" style="margin-bottom:10px;"><h1 style="font-size: 18px;color: #333333;"><?php echo L('_REGISTER_WELCOME_'); echo modC('WEB_SITE_NAME',L('_OPENSNS_'),'Config');?></h1></div>

            <style>
                input {
                    display: inline-block;
                }
            </style>
            <?php if($step == 'start'): ?><div class="col-xs-6" style="float:left">
                    <form action="<?php echo U('register');?>" method="post">
                        <ul id="reg_nav" class="nav nav-tabs" style="margin-bottom: 20px;">
                            <?php if(check_reg_type('username')){ ?>
                            <li <?php if($regSwitch[0] == 'username'): ?>class="active"<?php endif; ?>><a href="#username_reg" data-toggle="tab"><?php echo L('_REGISTER_USERNAME_');?></a></li>
                            <?php } ?>
                            <?php if(check_reg_type('email')){ ?>
                            <li <?php if($regSwitch[0] == 'email'): ?>class="active"<?php endif; ?>><a href="#email_reg" data-toggle="tab"><?php echo L('_REGISTER_EMAIL_');?></a></li>
                            <?php } ?>
                            <?php if(check_reg_type('mobile')){ ?>
                            <li <?php if($regSwitch[0] == 'mobile'): ?>class="active"<?php endif; ?>><a href="#mobile_reg" data-toggle="tab"><?php echo L('_REGISTER_PHONE_');?></a></li>
                            <?php } ?>
                        </ul>

                        <div class="tab-content">
                            <?php if(isset($invite_user)){ ?>
                                <div class="alert alert-info" style="padding: 5px;margin-bottom: 10px;letter-spacing: 2px;"><?php echo L('_USER_');?> <?php echo ($invite_user['nickname']); ?> <?php echo L('_REGISTER_INVITE_'); echo C('WEB_SITE');?>，<?php echo L('_REGISTER_INFORMATION_FILL_OUT_');?>~</div>
                                <input type="hidden" name="code" value="<?php echo ($code); ?>">
                            <?php }else{ ?>
                                <?php if($open_invite_register): ?><div class="alert alert-info" style="padding: 5px;margin-bottom: 10px;letter-spacing: 2px;"><?php echo L('_USER_INVITE_FIRST_');?><strong><a data-type="ajax" data-url="<?php echo U('Ucenter/Member/inCode');?>" data-title="<?php echo L('_INVITE_CODE_INPUT_');?>" data-toggle="modal"><?php echo L('_INVITE_CODE_INPUT_');?></a></strong>，<?php echo L('_REGISTER_INFORMATION_FILL_OUT_');?>~</div><?php endif; ?>
                            <?php } ?>
                            <?php if(count($role_list)==1): ?><input id="name" type="hidden" name="role" value="<?php echo ($role_list[0]['id']); ?>">
                                <?php else: ?>
                                <div class="form-group">
                                    <input id="name" type="hidden" name="role" value="<?php echo ($role_list[0]['id']); ?>">
                                    <label for="role" class=".sr-only col-xs-12" style="display: none"></label>
                                    <div class="clearfix"></div>
                                    <ul id="role-list" class="nav nav-justified nav-pills">
                                        <?php if(is_array($role_list)): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><li><a onclick="$('#name').val(<?php echo ($role["id"]); ?>);$('#role-list li').removeClass('active');$(this).parent().addClass('active');"><i class="icon-user"></i> <?php echo ($role["title"]); ?> </a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                    <script>
                                        $(function(){
                                            $('#role-list li').first().addClass('active');
                                        })
                                    </script>
                                    <span class="help-block"><?php echo L('_REGISTER_IDENTITY_SELECT_');?></span>
                                </div><?php endif; ?>
                            <?php if(is_array($regSwitch)): $i = 0; $__LIST__ = $regSwitch;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$regSwitch): $mod = ($i % 2 );++$i; switch($regSwitch): case "username": ?><!--用户名注册-->
                                        <div class="tab-pane  <?php if($key == 0): ?>active in<?php endif; ?>" id="username_reg">
                                            <div class="form-group">
                                                <label for="username" class=".sr-only col-xs-12" style="display: none"></label>
                                                <input type="text" id="username" onblur="setNickname(this);" class="form-control form_check" check-type="Username" check-url="<?php echo U('ucenter/member/checkAccount');?>"
                                                       placeholder="<?php echo L('_PLACEHOLDER_USERNAME_INPUT_');?>"  value="" name="username">

                                                <input type="hidden" name="reg_type" value="username">
                                                <span class="help-block"><?php echo L('_USERNAME_INPUT_LIMIT_');?></span>

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <!--用户名注册end--><?php break;?>
                                    <?php case "email": ?><!--邮箱注册-->
                                        <div class="tab-pane <?php if($key == 0): ?>active in<?php endif; ?>" id="email_reg">

                                            <div class="form-group">
                                                <label for="username" class=".sr-only col-xs-12" style="display: none"></label>
                                                <input type="text" id="email" class="form-control form_check" check-type="UserEmail" check-url="<?php echo U('ucenter/member/checkAccount');?>" <?php if($key != 0): ?>disabled="disabled"<?php endif; ?>
                                                       placeholder="<?php echo L('_PLACEHOLDER_EMAIL_INPUT_');?>" value="" name="username">
                                                <input type="hidden" name="reg_type" value="email" <?php if($key != 0): ?>disabled="disabled"<?php endif; ?>>
                                                <span class="help-block"><?php echo L('_EMAIL_INPUT_');?></span>

                                                <div class="clearfix"></div>
                                            </div>
                                            <?php if(modC('EMAIL_VERIFY_TYPE', 0, 'USERCONFIG') == 2){ ?>
                                            <div class="form-group">
                                                <label for="verifyCode3" class=".sr-only col-xs-12"
                                                       style="display: none"></label>

                                                <div class="col-xs-4" style="padding: 0px;">
                                                    <input type="text" id="verifyCode3" class="form-control" placeholder="验证码"
                                                           errormsg="请填写正确的验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                                                    <span class="help-block">输入验证码</span>
                                                </div>
                                                <div class="col-xs-8 lg_lf_fm_verify">
                                                    <img class="verifyimg reloadverify img-responsive" alt="点击切换"
                                                         src="<?php echo U('verify',array('id'=>3));?>"
                                                         style="cursor:pointer;">
                                                </div>
                                                <div class="col-xs-12 Validform_checktip text-warning lg_lf_fm_tip"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control pull-left" placeholder="<?php echo L('_VERIFY_CODE_');?>" <?php if($key != 0): ?>disabled="disabled"<?php endif; ?> name="reg_verify"
                                                       style="width: 100px">

                                                <a class="lh32 " data-role="getVerify" style="margin-left: 10px"><?php echo L('_EMAIL_VERIFY_');?></a>
                                                <span class="help-block"><?php echo L('_VERIFY_CODE_INPUT_');?></span>

                                                <div class="clearfix"></div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <!--邮箱注册end--><?php break;?>
                                    <?php case "mobile": ?><!--手机注册-->
                                        <div class="tab-pane <?php if($key == 0): ?>active in<?php endif; ?>" id="mobile_reg">

                                            <div class="form-group">
                                                <label for="username" class=".sr-only col-xs-12" style="display: none"></label>

                                                <input type="text" id="mobile" class="form-control form_check" check-type="UserMobile" check-url="<?php echo U('ucenter/member/checkAccount');?>" <?php if($key != 0): ?>disabled="disabled"<?php endif; ?>
                                                       placeholder="<?php echo L('_PLACEHOLDER_PHONE_');?>" .
                                                errormsg="<?php echo L('_ERROR_PHONE_INPUT_');?>" value="" name="username">

                                                <input type="hidden" name="reg_type" value="mobile" <?php if($key != 0): ?>disabled="disabled"<?php endif; ?>>
                                                <span class="help-block"><?php echo L('_PHONE_INPUT_');?></span>

                                                <div class="clearfix"></div>
                                            </div>

                                            <?php if(modC('MOBILE_VERIFY_TYPE', 0, 'USERCONFIG') == 1){ ?>



                                            <div class="form-group">
                                                <label for="verifyCode2" class=".sr-only col-xs-12"
                                                       style="display: none"></label>

                                                <div class="col-xs-4" style="padding: 0px;">
                                                    <input type="text" id="verifyCode2" class="form-control" placeholder="验证码"
                                                           errormsg="请填写正确的验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                                                    <span class="help-block">输入验证码</span>
                                                </div>
                                                <div class="col-xs-8 lg_lf_fm_verify">
                                                    <img class="verifyimg reloadverify img-responsive" alt="点击切换"
                                                         src="<?php echo U('verify',array('id'=>2));?>"
                                                         style="cursor:pointer;">
                                                </div>
                                                <div class="col-xs-12 Validform_checktip text-warning lg_lf_fm_tip"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control pull-left" placeholder="<?php echo L('_VERIFY_CODE_');?>" name="reg_verify" <?php if($key != 0): ?>disabled="disabled"<?php endif; ?>
                                                       style="width: 100px">
                                                <a class="btn btn-default " data-role="getVerify" style="margin-left: 10px"><?php echo L('_PHONE_VERIFY_');?></a>
                                                <span class="help-block"><?php echo L('_VERIFY_CODE_INPUT_');?></span>

                                                <div class="clearfix"></div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <!--手机注册end--><?php break; endswitch; endforeach; endif; else: echo "" ;endif; ?>
                            <div class="form-group">
                                <label for="nickname" class=".sr-only col-xs-12" style="display: none"></label>
                                <input type="text" id="nickname" class="form-control form_check" check-type="Nickname"  check-url="<?php echo U('ucenter/member/checkNickname');?>" placeholder="请输入昵称" value="" name="nickname">

                                <span class="help-block">输入昵称，只允许中文、字母和数字和下划线</span>

                                <div class="clearfix"></div>
                            </div>

                            <div class="form-group">
                                <div class="password_block" style="position: relative;display: table;border-collapse: separate;">
                                    <input type="password" id="inputPassword" class="form-control" check-length="6,30"  placeholder="请输入密码"  name="password">

                                    <div class="input-group-addon" style="border-radius:7px;">
                                        <a style="width: 100%;height: 100%" href="javascript:void(0);" onclick="change_show(this)">show</a>
                                    </div>
                                </div>
                                <span class="help-block">请输入密码，6-30位字符</span>

                                <div class="clearfix"></div>
                            </div>
                            <?php if(check_verify_open('reg')): ?><div class="form-group">
                                    <label for="verifyCode" class=".sr-only col-xs-12"
                                           style="display: none"></label>

                                    <div class="col-xs-4" style="padding: 0px;">
                                        <input type="text" id="verifyCode" class="form-control" placeholder="验证码"
                                               errormsg="请填写正确的验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                                        <span class="help-block">输入验证码</span>
                                    </div>
                                    <div class="col-xs-8 lg_lf_fm_verify">
                                        <img class="verifyimg reloadverify img-responsive" alt="点击切换"
                                             src="<?php echo U('verify');?>"
                                             style="cursor:pointer;">
                                    </div>
                                    <div class="col-xs-12 Validform_checktip text-warning lg_lf_fm_tip"></div>
                                    <div class="clearfix"></div>
                                </div><?php endif; ?>
                            <div style="float: left;vertical-align: bottom;margin-top: 12px;color: #848484;">
                                已有账户， <a href="<?php echo U('Ucenter/Member/login');?>" title="" style="color: #03B38B;">登录</a>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">提 交</button>
                        </div>
                    </form>
                </div>
                <div class="col-xs-4 login-other" style="float:left">
                    <div class="hd"><strong>使用其他帐号直接登录</strong></div>
                    <div class="bd">
                        <ul class="other-account">
                            <li><a class="qq" href="/oauth/index/type/qq.html" "="">腾讯QQ登录</a></li>
                            <li><a class="tencent" href="/oauth/index/type/tencent.html" "="">腾讯微博登录</a></li>
                            <li><a class="t163" href="/oauth/index/type/t163.html" "="">网易微博登录</a></li>
                            <li><a class="sina" href="/oauth/index/type/sina.html" "="">新浪微博登录</a></li>
                         </ul>
                    </div>
              </div><?php endif; ?>
            <?php if($step != 'start' and $step != 'finish'): echo W('RegStep/view'); endif; ?>
            <?php if($step == 'finish'): ?><div class="col-xs-12" style="font-size: 16px;margin-top: 30px;">
                    <span>感谢您注册 <?php echo modC('WEB_SITE_NAME','OpenSNS开源社交系统','Config');?> ，希望你玩的愉快！ <a href="<?php echo U('Ucenter/Config/index');?>" title="完善个人资料" style="color:#3f88bf">完善个人资料</a> 或 <a
                            href="<?php echo U('home/Index/index');?>" title="前往首页" style="color:#3f88bf">前往首页</a></span>
                </div><?php endif; ?>
        </div>
    </section>

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



    <script type="text/javascript">
        var step="<?php echo ($step); ?>";
        if (MID == 0&&step=='start') {
            $(document)
                    .ajaxStart(function () {
                        $("button:submit").addClass("log-in").attr("disabled", true);
                    })
                    .ajaxStop(function () {
                        $("button:submit").removeClass("log-in").attr("disabled", false);
                    });
            $("form").submit(function () {
                toast.showLoading();
                var self = $(this);
                $.post(self.attr("action"), self.serialize(), success, "json");
                return false;

                function success(data) {
                    if (data.status) {
                        //toast.success(data.info, '温馨提示');
                        setTimeout(function () {
                            window.location.href = data.url
                        }, 10);
                    } else {
                        toast.error(data.info, '温馨提示');
                        //self.find(".Validform_checktip").text(data.info);
                        //刷新验证码
                        $(".reloadverify").click();
                    }
                    toast.hideLoading();
                }
            });

            function change_show(obj) {
                if ($(obj).text().trim() == 'show') {
                    $(obj).html('hide');
                    $(obj).parents('.password_block').find('input').attr('type', 'text');
                } else {
                    $(obj).html('show');
                    $(obj).parents('.password_block').find('input').attr('type', 'password');
                }
            }


            function setNickname(obj) {
                var text = jQuery.trim($(obj).val());
                if (text != null && text != '') {
                    $('#nickname').val(text);
                }
            }

            $(function () {

                $(".reloadverify").click(function () {
                    var $this = $(this);
                    var verifyimg = $this.attr("src");
                    if (verifyimg.indexOf('?') > 0) {
                        $this.attr("src", verifyimg + '&random=' + Math.random());
                    } else {
                        $this.attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
                    }
                });
            });



            $(function () {
                $("[data-role='getVerify']").click(function () {
                    var $this = $(this);
                    toast.showLoading();
                    var account = $this.parents('.tab-pane').find('[name="username"]').val();
                    var type = $this.parents('.tab-pane').find('[name="reg_type"]').val();
                    var verify = $this.parents('.tab-pane').find('[name="verify"]').val();

                    if(account == ''){
                        toast.error('请输入帐号');
                        toast.hideLoading();
                        return false;
                    }
                    if(verify == ''){
                        toast.error('请输入验证码');
                        toast.hideLoading();
                        return false;
                    }

                    $.post("<?php echo U('ucenter/verify/sendVerify');?>", {account: account, type: type, action: 'member',verify:verify}, function (res) {
                        if (res.status) {
                            DecTime.obj = $this
                            DecTime.time = "<?php echo modC('SMS_RESEND','60','USERCONFIG');?>";
                            $this.attr('disabled',true)
                            DecTime.dec_time();

                            toast.success(res.info);
                        }
                        else {
                            toast.error(res.info);
                        }
                        toast.hideLoading();
                    })
                })
                $('#reg_nav li a').click(function(){
                    $('.tab-pane').find('input').attr('disabled',true);
                    $('.tab-pane').eq($("#reg_nav li a").index(this)).find('input').attr('disabled',false);
                })
                $("[type='submit']").click(function () {
                    $(this).parents('form').submit();
                })
                 $('[href="#<?php echo ($type); ?>_reg"]').click()
            })
        }

        var DecTime = {
            obj:0,
            time:0,
            dec_time : function(){
                if(this.time > 0){
                    this.obj.text(this.time--+'S')
                    setTimeout("DecTime.dec_time()",1000)
                }else{
                    this.obj.text("<?php echo L('_EMAIL_VERIFY_');?>")
                    this.obj.attr('disabled',false)
                }

            }
        }

    </script>
    <link href="/Application/Core/Static/css/form_check.css" rel="stylesheet" type="text/css">
    <script src='/Application/Core/Static/js/form_check.js'></script>
    <script>
        // 验证密码长度
        $(function(){
            $('#inputPassword').after('<div class=" show_info" ></div>');
            $('#inputPassword').blur(function(){

                var obj =$('#inputPassword');
                var str =  obj.val().replace(/\s+/g, "");
                var html = '';
                if (str.length == 0) {
                    html = '<div class="send red"><div class="arrow"></div>'+"<?php echo L('_EMPTY_CANNOT_');?>"+'</div>';
                } else {
                    if (typeof (obj.attr('check-length')) != 'undefined') {
                        var strs = new Array(); //定义一数组
                        strs = obj.attr('check-length').split(","); //字符分割
                        if (strs[1]) {
                            if (strs[1] < str.length || str.length < strs[0]) {
                                html = '<div class="send red"><div class="arrow"></div>'+"<?php echo L('_LENGTH_ILLEGAL_');?>"+'</div>';
                            }
                        }
                        else {
                            if (strs[0] < str.length) {
                                html = '<div class="send red"><div class="arrow"></div>'+"<?php echo L('_LENGTH_ILLEGAL_');?>"+'</div>';
                            }
                        }
                    }
                    obj.parent().find('.show_info').html(html);
                }
            })
        })
    </script>

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