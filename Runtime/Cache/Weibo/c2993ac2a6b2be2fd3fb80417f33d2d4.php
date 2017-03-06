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




	<!-- /头部 -->
	<!-- 主体 -->
	<div class="main-wrapper" id="container">
    
    <?php echo W('Common/SubMenu/render',array($sub_menu,$tab,array('icon'=>'quote-left'),''));?>

    <!--顶部导航之后的钩子，调用公告等-->
<?php echo hook('afterTop');?>
<!--顶部导航之后的钩子，调用公告等 end-->
    <div id="main-container" class="container">
        <div class="row">
            
    <style>
        #main-container {
            width: 1160px;
        }
    </style>
    <script type="text/javascript" src="/Public/js/ajaxfileupload.js"></script>
    <link href="/Application/Weibo/Static/css/weibo.css" type="text/css" rel="stylesheet"/>
    <!--微博内容列表部分-->
    <div class="weibo_middle pull-left" style="width: 820px;min-height: 700px;">
        <?php if($show_post): ?><div class="weibo_content weibo_post_box">

        <p class="pull-left">
            <?php echo modC('WEIBO_INFO',L('_TIP_SOMETHING_TO_SAY_'));?>
        </p>
        <div class="pull-right show_num_quick"><?php echo L('_TIP_REMAIN_INPUT_'); echo modC('WEIBO_NUM',140,'WEIBO'); echo L('_GE_WORDS_');?></div>
        <div class="weibo_content_p">
            <div class="row">
                <div class="col-xs-12">
                    <p><textarea class="form-control weibo_content_quick" id="weibo_content" style="height: 6em;"
                                 placeholder="<?php echo L('_PLACEHOLDER_SOMETHING_TO_WRITE_');?>" onfocus="startCheckNum_quick($(this))"
                                 onblur="endCheckNum_quick()"></textarea></p>
                    <a href="javascript:" onclick="insertFace($(this))">
                        <img class="weibo_type_icon" src="/Application/Core/Static/images/bq.png"/>
                    </a>
                    <?php if(modC('CAN_IMAGE',1)): ?><a href="javascript:" id="insert_image" onclick="insert_image.insertImage(this)">
                        <img class="weibo_type_icon" src="/Application/Weibo/Static/images/image.png"/>
                    </a><?php endif; ?>
                    <?php if(modC('CAN_TOPIC',1)): ?><a href="javascript:" onclick="insert_topic.InsertTopic(this)">
                        <img class="weibo_type_icon" src="/Application/Weibo/Static/images/topic.png"/>
                    </a><?php endif; ?>
                    <?php echo hook('weiboType');?>
                    <p class="pull-right">
                        <?php echo use_topic();?>
                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" value="<?php echo L('_PUBLISH_');?>"  data-role="send_weibo" class="btn btn-primary btn-lg" style="border:none;width: 100px" data-url="<?php echo U('Weibo/Index/doSend');?>"/>
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



        <!--  筛选部分-->
        <div>
            <?php if(!is_login()) $style='margin-top:0' ?>
            <div id="weibo_filter" class="margin-bottom-10" style="position: relative;<?php echo ($style); ?>">
                <div class="weibo_icon">
                    <?php $show_icon_eye_open=0; if(count($top_list)){ $hide_ids=cookie('Weibo_index_top_hide_ids'); if(mb_strlen($hide_ids,'utf-8')){ $hide_ids=explode(',',$hide_ids); foreach($top_list as $val){ if(in_array($val,$hide_ids)){ $show_icon_eye_open=1; break; } }}} if(count($top_list)){ if($show_icon_eye_open){ ?>
                    <li data-weibo-id="<?php echo ($weibo["id"]); ?>" title="<?php echo L('_SHOW_ALL_TOP_'); echo ($MODULE_ALIAS); ?>" data-role="show_all_top_weibo">
                        <i class="icon icon-eye-open"></i>
                    </li>
                    <?php }else{ ?>
                    <li data-weibo-id="<?php echo ($weibo["id"]); ?>" title="<?php echo L('_SHOW_ALL_TOP_'); echo ($MODULE_ALIAS); ?>" data-role="show_all_top_weibo" style="display: none;">
                        <i class="icon icon-eye-open"></i>
                    </li>
                    <?php }} ?>
                </div>
                <?php if(is_array($tab_config)): $i = 0; $__LIST__ = $tab_config;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><a id="<?php echo ($tab); ?>" href="<?php echo U('Weibo/Index/index',array('type'=>$tab));?>">
                       <?php switch($tab): case "concerned": echo L('_MY_FOLLOWING_'); break;?>
                            <?php case "hot": echo L('_HOT_WEIBO_'); break;?>
                            <?php case "all": echo L('_ALL_WEBSITE_WEIBO_'); break;?>
                            <?php case "fav": echo L('_MY_FAV_'); break; endswitch;?>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="pull-right" style="line-height: 35px;text-align: right">
                    <?php echo W('Common/Adv/render',array(array('name'=>'filter_right','type'=>3,'width'=>'300px','height'=>'30px','title'=>'过滤右方')));?>
                 </div>

            </div>
        </div>
        <script>
            $('#weibo_filter #<?php echo ($filter_tab); ?>').addClass('active');
        </script>


        <!--筛选部分结束-->
        <div id="top_list" >
            <?php if(is_array($top_list)): $i = 0; $__LIST__ = $top_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$top): $mod = ($i % 2 );++$i; echo W('WeiboDetail/detail',array('weibo_id'=>$top,'can_hide'=>1)); endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div id="weibo_list">
            <?php if($page != 1){ ?>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i; echo W('Weibo/WeiboDetail/detail',array('weibo_id'=>$weibo)); endforeach; endif; else: echo "" ;endif; ?>
<?php if(empty($lastId) == false): ?><script>
        weibo.lastId = '<?php echo ($lastId); ?>';
    </script><?php endif; ?>


            <?php } ?>
        </div>
        <div id="load_more" class="text-center text-muted"
        <?php if($page != 1): ?>style="display:none"<?php endif; ?>
        >
        <p id="load_more_text"><img style="margin-top:80px" src="/Application/Weibo/Static/images/loading-new.gif"/></p>
    </div>
    <div id="index_weibo_page" style=" <?php if($page == 1): ?>display:none<?php endif; ?>">
        <div class="text-right">
            <?php echo getPagination($total_count,30);?>
        </div>
    </div>
    </div>
    <!--微博内容列表部分结束-->
    <!--首页右侧部分-->
    <div class="weibo_right" style="width: 300px;margin-top:5px;">
        <!--登录后显示个人区域-->
        <?php if(is_login()): ?><div class="user-card" style="height: auto;">
                <div>
                    <div class="top_self">
                        <?php if($self['cover_id']): ?><img class="cover uc_top_img_bg_weibo" src="<?php echo ($self['cover_path']); ?>">
                            <?php else: ?>
                            <img class="cover uc_top_img_bg_weibo" src="/Application/Core/Static/images/bg.jpg"><?php endif; ?>
                        <?php if(is_login() && $self['uid'] == is_login()): ?><div class="change_cover"><a data-type="ajax" data-url="<?php echo U('Ucenter/Public/changeCover');?>"
                                                         data-toggle="modal" data-title="<?php echo L('_UPLOAD_COVER_');?>" style="color: white;"><img
                                    class="img-responsive" src="/Application/Core/Static/images/fractional.png" style="width: 25px;"></a>
                            </div><?php endif; ?>
                    </div>
                </div>
                <div class="user_info" style="padding: 0px;">
                    <div class="avatar-bg">
                        <div class="headpic ">
                            <a href="<?php echo ($self["space_url"]); ?>" ucard="<?php echo ($self["uid"]); ?>">
                                <img src="<?php echo ($self["avatar128"]); ?>" class="avatar-img" style="width:80px;"/>
                            </a>
                        </div>
                        <div class="clearfix " style="padding: 0;/*margin-bottom:8px*/">
                            <div class="clearfix">
                                <div class="col-xs-12" style="text-align: center">
                        <span class="nickname">
                            <?php echo ($self["title"]); ?>
                        <a ucard="<?php echo ($self["uid"]); ?>" href="<?php echo ($self["space_url"]); ?>" class="user_name"><?php echo (htmlspecialchars($self["nickname"])); ?></a>

                            </span>
                                    <br/><?php echo W('Common/UserRank/render',array($self['uid']));?>
                                </div>
                            </div>
                            <?php $title=D('Ucenter/Title')->getCurrentTitleInfo(is_login()); ?>
                            <script>
                                $(function () {
                                    $('#upgrade').tooltip({
                                                html: true,
                                                title: '<?php echo L("_CURRENT_LEVEL_");?>：<?php echo ($self["title"]); ?> <br/><?php echo L("_NEXT_LEVEL_");?>：<?php echo ($title["next"]); ?><br/><?php echo L("_NOW_");?>：<?php echo ($self["score"]); ?><br/><?php echo L("_NEED_");?>：<?php echo ($title["upgrade_require"]); ?><br/><?php echo L("_LAST_");?>： <?php echo ($title["left"]); ?><br/><?php echo L("_PROGRESS_");?>：<?php echo ($title["percent"]); ?>% <br/> '
                                            }
                                    );
                                })
                            </script>

                        </div>

                        <div id="upgrade" data-toggle="tooltip" data-placement="bottom" title=""
                             style="padding-bottom: 10px;/*padding-top: 10px*/">
                            <div style="border-top:1px solid #eee;"></div>
                            <div style="/*border-top: 1px solid rgb(3, 199, 3);*/margin-top: -1px;/*width: <?php echo ($title["percent"]); ?>%;*/z-index: 9999;">

                            </div>
                        </div>
                        <div class="clearfix user-data">
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo U('Ucenter/index/applist',array('uid'=>$self['uid'],'type'=>'Weibo'));?>"
                                   title="<?php echo ($MODULE_ALIAS); ?>数"><?php echo ($self["weibocount"]); ?></a><br><?php echo ($MODULE_ALIAS); ?>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo U('Ucenter/index/fans',array('uid'=>$self['uid']));?>" title="<?php echo L('_FANS_COUNT_');?>"><?php echo ($self["fans"]); ?></a><br><?php echo L('_FANS_');?>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo U('Ucenter/index/following',array('uid'=>$self['uid']));?>" title="<?php echo L('_FOLLOW_COUNT_');?>"><?php echo ($self["following"]); ?></a><br><?php echo L('_FOLLOW_');?>
                            </div>
                        </div>

                    </div>
                </div>
            </div><?php endif; ?>
        <!--登录后显示个人区域部分结束-->
        <!-- <?php echo W('Common/Adv/render',array(array('name'=>'below_self_info','type'=>1,'width'=>'280px','height'=>'100px','margin'=>'0 0 10px 0','title'=>'个人资料下方')));?> -->
        <div>
            <h1 style="color:#6a6a6a;border-bottom:1px solid #ddd;font-size:16px;line-height:35px;">每日签到</h1>
         	<div class="checkin">
                <?php echo hook('checkIn');?>
                <?php echo hook('Rank');?>
            </div> 
            <?php echo hook('weiboSide');?>
        	<div>
        		<h1 style="color:#6a6a6a;border-bottom:1px solid #ddd;font-size:16px;line-height:35px;">热门话题</h1>
        		<ul class="topic-list">
                      <section class="items">
                          <?php if(is_array($topics["data"])): $i = 0; $__LIST__ = $topics["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
                                  <div class="item-content">
                                      <div class="media pull-left">
                                          <div class="media-place-holder" style="width:100px;height:100px;line-height:100px">
	                                          <a href="<?php echo U('Weibo/topic/index?topk='.urlencode($vo['name']));?>">
	                                              <?php if(($vo["logo"]) != "0"): ?><img style="width:100px;height:100px;" src="<?php echo (getthumbimagebyid($vo["logo"],100,100)); ?>"/>
	                                                  <?php else: ?>
	                                                  <img src="/Application/Weibo/Static/images/topicavatar.png"/><?php endif; ?>
	                                           </a>
                                          </div>
                                      </div>
                                      <div class="text">
                                          <div class="item-heading text-ellipsis">
                                              <?php switch($vo['top_num']) { case 1:$band='label label-danger'; break; case 2:$band='label label-warning'; break; case 3:$band='label label-success'; break; default:$band=''; } ?>
                                              <h4><span class="<?php echo ($band); ?>">Top <?php echo ($vo["top_num"]); ?></span>&nbsp; <a href="<?php echo U('Weibo/topic/index?topk='.urlencode($vo['name']));?>">#<?php echo (text($vo["name"])); ?>#</a>
                                              </h4>
                                          </div>
                                          <?php echo (text((isset($vo["intro"]) && ($vo["intro"] !== ""))?($vo["intro"]):L('_CHAT_TOGETHER_'))); ?>
                                      </div>
                                      <div class="item-footer">
                                          <i class="icon-comments-alt"></i>
                                          <?php echo ($vo["weibos"]); ?></a>&nbsp; <i class="icon-eye-open"></i>
                                              <?php echo ($vo["read_count"]); ?>&nbsp;
                                          <?php if(($vo["uadmin"]) != "0"): ?><span class="text-muted"><?php echo L('_PRESENTER_'); echo L('_COLON_'); echo ($vo["user"]["space_link"]); ?></span>
                                              <?php else: ?>
                                              <?php echo L('_PRESENTER_'); echo L('_COLON_'); echo L('_WAIT_FOR_YOU_'); endif; ?>
                                      </div>
                                  </div>
                              </div><?php endforeach; endif; else: echo "" ;endif; ?>
                      </section>
                  </ul>
        	</div>
        	<div>
        		<h1 style="color:#6a6a6a;border-bottom:1px solid #ddd;font-size:16px;line-height:35px;">微博 Top 10</h1>
        		 <div class="weilist">
	        		<ul>
	        			<?php if(is_array($top10)): $i = 0; $__LIST__ = $top10;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
								<span class="portrait"><a href=""><img align="absmiddle" class="SmallPortrait img-circle" title="<?php echo ($vo["user"]["nickname"]); ?>" alt="<?php echo ($vo["user"]["nickname"]); ?>" src="<?php echo ($vo["user"]["avatar64"]); ?>"></a></span>
								<span class="body"> <span class="user"><small class="font_grey">【<?php echo ($vo["user"]["title"]); ?>】</small><?php echo ($vo["user"]["space_link"]); ?>：</span><span class="log"><p><?php echo ($vo["fetchContent"]); ?></p></span> 
									<span class="time"><a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$vo['id']));?>"><?php echo (friendlydate($vo["create_time"])); ?></a>
										<div class="col-xs-4" style="padding: 0px;width:35px"> <?php echo Hook('support',array('table'=>'weibo','row'=>$vo['id'],'app'=>'Weibo','uid'=>$vo['uid'],'jump'=>'weibo/index/weibodetail'));?></div>
										<?php $sourceId =$vo['data']['sourceId']?$vo['data']['sourceId']:$vo['id']; ?>
										<a title="<?php echo L('_REPOST_');?>"  style="float:left;" data-role="send_repost"  href="<?php echo U('Weibo/Index/sendrepost',array('sourceId'=>$sourceId,'weiboId'=>$vo['id']));?>"><?php echo L('_REPOST_');?> <?php echo ($vo["repost_count"]); ?></a>
										<div class="col-xs-4" style="padding: 0px;width:50px;text-align:center;" ><span style="display:block;color:#9A9A9A" class="cpointer" data-role="weibo_comment_btn"  data-weibo-id="<?php echo ($vo["id"]); ?>"><?php echo L('_COMMENT_');?> <?php echo ($vo["comment_count"]); ?></span></div>
									</span>
								</span>
								<div class="clear"></div>
							</li><?php endforeach; endif; else: echo "" ;endif; ?> 				
					</ul>
				</div> 
        	</div>
           
            <!--广告位-->
            <!-- <?php echo W('Common/Adv/render',array(array('name'=>'below_checkrank','type'=>1,'width'=>'280px','height'=>'100px','title'=>'签到下方广告')));?> -->
            <!--广告位end-->
             <?php if(modC('ACTIVE_USER',1)): echo W('TopUserList/lists',array(null,'score'.modC('ACTIVE_USER_ORDER',1).'
                desc',L('_ACTIVE_USER_'),'top',modC('ACTIVE_USER_COUNT',6))); endif; ?>
            <?php echo hook('Advs',array('pos'=>'weibo_right_below_all','type'=>1,'width'=>'280px','height'=>'100px','title'=>'微博右侧底部广告'));?>
        </div>
    </div>
    <!--首页右侧部分结束-->

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
        weibo.page = '<?php echo ($page); ?>';
        weibo.loadCount = 0;
        weibo.lastId = parseInt('<?php echo (reset($list)); ?>')+1;
        weibo.url = "<?php echo ($loadMoreUrl); ?>";
        weibo.type = "<?php echo ($type); ?>";
        $(function () {
            weibo_bind();
            //当屏幕滚动到底部时
            if (weibo.page == 1) {
                $(window).on('scroll', function () {
                    if (weibo.noMoreNextPage) {
                        return;
                    }
                    if (weibo.isLoadingWeibo) {
                        return;
                    }
                    if (weibo.isLoadMoreVisible()) {
                        weibo.loadNextPage();
                    }
                });
                $(window).trigger('scroll');
            }
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