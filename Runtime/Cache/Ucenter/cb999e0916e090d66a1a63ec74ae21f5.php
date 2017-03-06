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
    <link href="/Application/Ucenter/Static/css/center.css" type="text/css" rel="stylesheet">
</head>
<body>
<!-- 头部 -->
<!-- /头部 -->
<!-- 主体 -->

    <div class="main-wrapper" id="container">
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




        <br/>
        <!--顶部导航之后的钩子，调用公告等-->
<?php echo hook('afterTop');?>
<!--顶部导航之后的钩子，调用公告等 end-->
        <div id="main-container" class="container user-config" style="margin-top: 60px">
            <div class="row">
                <div class=" col-xs-3 sidebar" style="width: 280px">
                    <div>
                        <div class="user-info-panel text-center margin_bottom_10">
                            <div>
                                <a href="<?php echo ($self["space_url"]); ?>" target="_blank"><img class="avatar-img" src="<?php echo ($self["avatar128"]); ?>"></a>
                            </div>
                            <div style="margin-top:10px;">
                                <a class="nickname" href="<?php echo ($self["space_url"]); ?>" style="color:#333"><?php echo ($self["nickname"]); ?></a>
                                <a href="<?php echo ($self["space_url"]); ?>" target="_blank">
                                	<i class="icon-svg icon-home"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div style="width: 200px;margin-left: 35px;">   
                        <nav class="menu" data-toggle="menu">
                            <!-- <a class="btn btn-success btn-lg" href="<?php echo ($self["space_url"]); ?>"><i class="icon-user"></i>
                                <?php echo L('_PERSONAL_PAGE_');?></a> -->
                            <ul class="nav nav-primary side-menu">
                                <li id="info"><a href="<?php echo U('index');?>"><i class="icon-th"></i>
                                    <?php echo L('_SETTINGS_DATA_');?></a></li>
                                <li id="tag"><a href="<?php echo U('tag');?>"><i class="icon-tag"></i> <?php echo L('_USER_TAG_');?></a></li>
                                <li id="avatar"><a href="<?php echo U('avatar');?>"><i class="icon-user"></i>
                                    <?php echo L('_AVATAR_MODIFY_');?></a></li>
                                <li id="password"><a href="<?php echo U('password');?>"><i class="icon-lock"></i>
                                    <?php echo L('_PASSWORD_MODIFY_');?></a></li>
                                <?php if(($can_show_role) == "1"): ?><li id="role"><a href="<?php echo U('role');?>"><i class="icon-group"></i>
                                        <?php echo L('_SETTINGS_IDENTITY_');?></a></li><?php endif; ?>
                                <li id="score"><a href="<?php echo U('score');?>"><i class="icon-bar-chart"></i> <?php echo L('_SCORE_MY_');?></a>
                                </li>
                                <li id="other"><a href="<?php echo U('other');?>"><i class="icon-list-ul"></i> <?php echo L('_OTHER_');?></a>
                                </li>
                            </ul>
                        </nav>
                        <script>
                            $("#<?php echo ($tab); ?>").addClass('active');
                        </script>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div id="usercenter-content-td ">
                        <div class="container-fluid common_block_border" style="min-height: 600px">
                            

    <div id="center">
        <div id="center_base" class="with-padding" style="padding: 20px">
            <ul class="nav nav-secondary">
                <li class="active"><a href="#base" data-toggle="tab"> <?php echo L('_PERSONAL_TAB_SELECT_');?></a></li>
             </ul>
            <div class="row">
                <div class="col-xs-12" style="margin-top:15px;margin-left:5px;">
                <div class="FormSection">
					<strong style="font-size:15px;font-weight:400">我是一名：</strong>
					<select id="resume_industry" name="job">
						<option value="程序员" <?php if($my_other_tags['job']=='程序员'){echo "selected='selected'";} ?>>程序员</option>
						<option value="高级程序员" <?php if($my_other_tags['job']=='高级程序员'){echo "selected='selected'";} ?>>高级程序员</option>
						<option value="技术主管" <?php if($my_other_tags['job']=='技术主管'){echo "selected='selected'";} ?>>技术主管</option>
						<option value="产品经理" <?php if($my_other_tags['job']=='产品经理'){echo "selected='selected'";} ?>>产品经理</option>
						<option value="网页/平面设计" <?php if($my_other_tags['job']=='网页/平面设计'){echo "selected='selected'";} ?>>网页/平面设计</option>
						<option value="部门经理" <?php if($my_other_tags['job']=='部门经理'){echo "selected='selected'";} ?>>部门经理</option>
						<option value="QA/测试工程师" <?php if($my_other_tags['job']=='QA/测试工程师'){echo "selected='selected'";} ?>>QA/测试工程师</option>
						<option value="系统管理员" <?php if($my_other_tags['job']=='系统管理员'){echo "selected='selected'";} ?>>系统管理员</option>
						<option value="数据库管理员" <?php if($my_other_tags['job']=='数据库管理员'){echo "selected='selected'";} ?>>数据库管理员</option>
						<option value="售前工程师" <?php if($my_other_tags['job']=='售前工程师'){echo "selected='selected'";} ?>>售前工程师</option>
						<option value="个人站长" <?php if($my_other_tags['job']=='个人站长'){echo "selected='selected'";} ?>>个人站长</option>
						<option value="CTO(技术副总裁)" <?php if($my_other_tags['job']=='CTO(技术副总裁)'){echo "selected='selected'";} ?>>CTO(技术副总裁)</option>
						<option value="人事招聘" <?php if($my_other_tags['job']=='人事招聘'){echo "selected='selected'";} ?>>人事招聘</option>
						<option value="iOS工程师" <?php if($my_other_tags['job']=='iOS工程师'){echo "selected='selected'";} ?>>iOS工程师</option>
						<option value="Android工程师" <?php if($my_other_tags['job']=='Android工程师'){echo "selected='selected'";} ?>>Android工程师</option>
						<option value="UI设计师" <?php if($my_other_tags['job']=='UI设计师'){echo "selected='selected'";} ?>>UI设计师</option>
						<option value="前端工程师" <?php if($my_other_tags['job']=='前端工程师'){echo "selected='selected'";} ?>>前端工程师</option>
						<option value="后端工程师" <?php if($my_other_tags['job']=='后端工程师'){echo "selected='selected'";} ?>>后端工程师</option>
						<option value="产品经理" <?php if($my_other_tags['job']=='产品经理'){echo "selected='selected'";} ?>>产品经理</option>
						<option value="运营/编辑" <?php if($my_other_tags['job']=='运营/编辑'){echo "selected='selected'";} ?>>运营/编辑</option>
						<option value="其他" <?php if($my_other_tags['job']=='其他'){echo "selected='selected'";} ?>>其他</option>
						<option value="项目经理" <?php if($my_other_tags['job']=='项目经理'){echo "selected='selected'";} ?>>项目经理</option>
						<option value="架构师" <?php if($my_other_tags['job']=='架构师'){echo "selected='selected'";} ?>>架构师</option>
						<option value="运维" <?php if($my_other_tags['job']=='运维"'){echo "selected='selected'";} ?>>运维</option>
						<option value="CEO" <?php if($my_other_tags['job']=='CEO'){echo "selected='selected'";} ?>>CEO</option>
					</select>
					<strong style="font-size:15px;font-weight:400">工作年限：</strong>
					<select id="resume_workyear" name="work_years">
						<option value="在读学生" <?php if($my_other_tags['work_years']=='在读学生'){echo "selected='selected'";} ?>>在读学生</option>
						<option value="应届毕业生" <?php if($my_other_tags['work_years']=='应届毕业生'){echo "selected='selected'";} ?>>应届毕业生</option>
						<option value="1 年" <?php if($my_other_tags['work_years']=='1 年'){echo "selected='selected'";} ?>>1 年</option>
						<option value="2 年" <?php if($my_other_tags['work_years']=='2 年'){echo "selected='selected'";} ?>>2 年</option>
						<option value="3 年" <?php if($my_other_tags['work_years']=='3 年'){echo "selected='selected'";} ?>>3 年</option>
						<option value="4 年" <?php if($my_other_tags['work_years']=='4 年'){echo "selected='selected'";} ?>>4 年</option>
						<option value="5 年" <?php if($my_other_tags['work_years']=='5 年'){echo "selected='selected'";} ?>>5 年</option>
						<option value="6 年" <?php if($my_other_tags['work_years']=='6 年'){echo "selected='selected'";} ?>>6 年</option>
						<option value="7 年" <?php if($my_other_tags['work_years']=='7 年'){echo "selected='selected'";} ?>>7 年</option>
						<option value="8 年" <?php if($my_other_tags['work_years']=='8 年'){echo "selected='selected'";} ?>>8 年</option>
						<option value="9 年" <?php if($my_other_tags['work_years']=='9 年'){echo "selected='selected'";} ?>>9 年</option>
						<option value="10 年" <?php if($my_other_tags['work_years']=='10 年'){echo "selected='selected'";} ?>>10 年</option>
						<option value="127 年"<?php if($my_other_tags['work_years']=='127 年'){echo "selected='selected'";} ?>>10年以上</option>
					</select>
					</div>
                    <?php if(!empty($tag_list)): if(is_array($tag_list)): $i = 0; $__LIST__ = $tag_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag_group): $mod = ($i % 2 );++$i;?><div class="tag-select-block clearfix">
                                <div class="select-cate"><?php echo ($tag_group["title"]); ?>：</div>
                                <div class="select-option">
                                    <?php if(is_array($tag_group['tag_list'])): $i = 0; $__LIST__ = $tag_group['tag_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="one_tag"><a class="btn btn-default" data-role="add_tag" data-id="<?php echo ($tag["id"]); ?>" data-i="<?php echo ($tag_group["id"]); ?>"><?php echo ($tag["title"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
                        <div style="text-align: center;font-size: 22px;color: #B3B3B3;">
                            <p>
                                <br/>
                                <span><?php echo L('_PERSONAL_TAB_NONE_'); echo L('_WAVE_');?></span>
                                <br/>
                            </p>
                        </div><?php endif; ?>
                    <div class="tag-select-block clearfix">
                        <div class="select-cate">个人标签<?php echo L('_COLON_');?></div>
                        <div class="select-option my-tag-block">
                            <div data-role="my_tag_block">
                                <?php if(is_array($my_tag)): $i = 0; $__LIST__ = $my_tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="one_tag"><span class="btn btn-default"><?php echo ($tag["title"]); ?> <a class="icon-remove" data-role="remove_tag" data-id="<?php echo ($tag["id"]); ?>" data-i="<?php echo ($tag["pid"]); ?>"></a></span></div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                       <div style="margin-left:100px;margin-top:5px;">备注：开发平台最多选<strong style="color:#4EAA4C"> 5 </strong>个,专长领域最多选<strong style="color:#4EAA4C"> 3 </strong>个</div>
                    </div>
                    <div class="tag-select-block clearfix">
                    	<input type="hidden" class="number_1" value="<?php echo ($my_other_tags["number_1"]); ?>">
                    	<input type="hidden" class="number_2" value="<?php echo ($my_other_tags["number_2"]); ?>">
                        <div class="select-option">
                            <button class="btn btn-primary" data-role="set-tag"><?php echo L('_SAVE_');?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $(window).resize(function () {
                $("#main-container").css("min-height", $(window).height() - 343);
            }).resize();
        })
    </script>

<!-- /主体 -->
<!-- 底部 -->
</div>
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



    <script>
        var tag_ids="<?php echo ($my_tag_ids); ?>";
        $(function(){
            $('[data-role="add_tag"]').click(function(){
                var parentId=$(this).attr('data-i');
                if(addtagLimit(parentId)==false){
                	return false;
                }
                var attachId=$(this).attr('data-id');
                var already_show=upHiddenVal('add',attachId);
                if(already_show==0){
                    var title=$(this).html();
                    $('[data-role="my_tag_block"]').append('<div class="one_tag"><span class="btn btn-default">'+title+' <a class="icon-remove" data-role="remove_tag" data-id="'+attachId+'" data-i="'+parentId+'"></a></span></div>');
                    bind_remove();
                }
            });
            bind_remove();
            $('[data-role="set-tag"]').click(function(){
            	var number_1=$(".number_1").val();
            	var number_2=$(".number_2").val();
            	var job=$("#resume_industry").val();
                var work_years=$("#resume_workyear").val();
                $.post(U('Ucenter/Config/tag'),{tag_ids:tag_ids,number_1:number_1,number_2:number_2,job:job,work_years:work_years},function(msg){
                    if(msg.status){
                        toast.success("<?php echo L('_SUCCESS_SETTINGS_'); echo L('_EXCLAMATION_');?>");
                        setTimeout(function(){
                            location.reload();
                        },1500);
                    }else{
                        handleAjax(msg);
                    }
                },'json');
            });
        })
        function bind_remove(){
            $('[data-role="remove_tag"]').unbind('click');
            $('[data-role="remove_tag"]').click(function(){
                var attachId=$(this).attr('data-id');
                var parentId=$(this).attr('data-i');
                deltagLimit(parentId);
                upHiddenVal('del',attachId);
                $(this).parents('.one_tag').remove();
            });
        }
        function upHiddenVal(type, attachId) {
            var attachArr = tag_ids.split(',');
            var newArr = [];
            var already_show=0;

            for (var i in attachArr) {
                if (attachArr[i] !== '' && attachArr[i] !== attachId.toString()) {
                    newArr.push(attachArr[i]);
                }
                if(attachArr[i] === attachId.toString()){
                    already_show=1;
                }
            }
            type === 'add' && newArr.push(attachId);
            tag_ids=newArr.join(',');
            return already_show;
        }
        function addtagLimit(parentId){
        	if(parentId==1){
        		var number_1=$(".number_1").val();
            	if(number_1*1>=5){
            		toast.error("开发平台最多选择5个标签");
            		return false;
            	}else{
            		number_1=number_1*1+1;
            		$(".number_1").val(number_1);
            	}
            }
            if(parentId==19){
            	number_2=$(".number_2").val();
            	if(number_2*1>=3){
            		toast.error("专长领域最多选择3个标签");
            		return false;
            	}else{
            		number_2=number_2*1+1;
            		$(".number_2").val(number_2);
            	}
            }
        }
        function deltagLimit(parentId){
        	if(parentId*1==1){
        		var number_1=$(".number_1").val();
        		number=number_1*1-1*1;
        		$(".number_1").val(number);
            }
            if(parentId*1==19){
            	var number_2=$(".number_2").val();
            	number=number_2*1-1*1;
            	$(".number_2").val(number);
            }
        }
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
<script>
    $(function () {
        var $sidebar = $('#usercenter-sidebar-td');
        var $sidebar_xs = $('#usercenter-sidebar-xs');
        var $sidebar_sm = $('#usercenter-sidebar-sm');
        var $content = $('#usercenter-content-td');

        function trigger_resp() {
            var width = $(window).width();
            if (width < 768) {
                on_xs();
            } else {
                on_sm();
            }
        }
        function on_xs() {
            $sidebar_xs.append($sidebar);
            $content.css({'padding-left': 0, 'padding-right': 0});
        }
        function on_sm() {
            $sidebar_sm.prepend($sidebar);
        }
        trigger_resp();
        $(window).resize(function () {
            trigger_resp();
        })
    })
</script>
</body>
</html>