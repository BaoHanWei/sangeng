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
    <script type="text/javascript" src="/Application/Tutorial/Static/js/common.js"></script>
    <link type="text/css" rel="stylesheet" href="/Application/Tutorial/Static/css/tutorial.css"/>
    <script>
        var group_lzl_order = "<?php echo modC('GROUP_LZL_REPLY_ORDER',1,'GROUP');?>";
        var group_lzl_show_count = "<?php echo modC('GROUP_LZL_SHOW_COUNT',5,'GROUP');?>";
    </script>
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
<div class="main-wrapper">
    <?php echo W('Group/SubMenu/render',array($sub_menu,$current,L('_MODULE_'),''));?>

    <!-- 主体 -->
    <div id="main-container" class="container">

        <?php if(!empty($tutorial)): ?><div class="group_header common-block">
    <div class="group_header_block ">
        <div class="col-md-4 hidden-xs hidden-sm">
            <?php if($tutorial['logo']){ ?>
            <img class="logo"  src="<?php echo (getthumbimagebyid($tutorial["logo"],173,231)); ?>"
                 alt="<?php echo (op_t($tutorial["title"])); ?>">
            <?php }else{ ?>
            <img class="logo" src="/Application/Tutorial/Static/images/default.png" alt="<?php echo (op_t($tutorial["title"])); ?>">
            <?php } ?>
        </div>
        <div class="col-md-8 info">
            <h1 class="title col-md-12 text-more" style="margin-left: -15px;">
                <a href="<?php echo U('tutorial/index/tutorial',array('id'=>$tutorial['id']));?>" title="<?php echo ($tutorial["title"]); ?>"><?php echo ($tutorial["title"]); ?></a>
            </h1>
            <div class="clearfix" style="font-size: 13px;padding: 10px 0 10px 0;">
                <a href="<?php echo ($tutorial["user"]["space_url"]); ?>" class="e-user" ucard="<?php echo ($tutorial["user"]["uid"]); ?>">
                <img class="user-avatar" ucard="<?php echo ($tutorial["user"]["uid"]); ?>" width="30" height="30" src="<?php echo ($tutorial["user"]["avatar128"]); ?>"><?php echo ($tutorial["user"]["nickname"]); ?>
                </a>
            </div>

            <div class="clearfix" style="font-size: 13px;padding: 5px 0 5px 0;">
                <?php echo L('_MODULE_'); echo L('_TYPE_');?>：<?php echo $tutorial['type']?L('_PRIVATE_').L('_MODULE_'):L('_PUBLIC_').L('_MODULE_');?>
            </div>
            <div class="clearfix group_count" style="font-size: 13px;padding: 5px 0 5px 0;">
                章节：<a href="<?php echo U('index/tutorial',array('type'=>'post','id'=>$tutorial_id));?>"><?php echo ($tutorial["post_count"]); ?></a>
                学员：<a href="<?php echo U('index/tutorial',array('type'=>'member','id'=>$tutorial_id));?>"><?php echo ($tutorial["member_count"]); ?></a>
                <?php echo L('_CATEGORY_');?>：<a href="<?php echo U('index/index',array('cate'=>$tutorial['type_id']));?>"><?php echo (get_type_name($tutorial["type_id"])); ?></a>
            </div>
            <div class="clearfix" style="font-size: 13px;padding: 5px 0 5px 0;">
                <?php if(check_auth('Tutorial/Manager/*',get_tutorial_admin($tutorial['id']))){ ?>
                <a class="pull-left btn btn-primary" href="<?php echo U('Tutorial/Manage/index',array('tutorial_id'=>$tutorial['id']));?>"
                   style="margin-right: 5px"> <?php echo L('_MANAGE_');?></a>
                <?php } ?>
                <?php if(is_login() != $tutorial['uid']): if(is_joined($tutorial['id']) == 1){ ?>
                <a class="pull-left btn btn-primary" data-role="group_quit" data-group-id="<?php echo ($tutorial["id"]); ?>"><?php echo L('_EXIT_'); echo L('_MODULE_');?></a>

                <?php }elseif(is_joined($tutorial['id']) == 2){ ?>
                <a class="pull-left btn btn-default"><?php echo L('_AUDITING_');?></a>
                <?php }else{ ?>
                <a class="pull-left btn btn-primary" data-role="group_attend" data-group-id="<?php echo ($tutorial["id"]); ?>">+<?php echo L('_IN_'); echo L('_MODULE_');?></a>
                <?php } endif; ?>
            </div>
            <div class="clearfix" style="font-size: 13px;padding: 5px 0 5px 0;">
                <?php if(ACTION_NAME != 'detail'): echo W('Common/Share/detailShare',array(array('share_text'=>$tutorial['title'].'-'.L('_MODULE_')))); endif; ?>
            </div>
        </div>
    </div>
    </div><?php endif; ?>



        <div class="row">
            <div class="col-md-8">
                
        <div class="">
            <div class="fourm-top common-block" style="padding: 15px 20px;margin-top: 0;margin-bottom: 15px">
                <h4>
                    <?php if($isEdit): echo L('_EDIT_'); echo L('_MODULE_');?>
                        <?php else: ?>
                        <?php echo L('_CREATE_'); echo L('_MODULE_');?>：<?php echo L('_WELCOME_'); echo L('_CREATE_'); echo L('_MODULE_'); endif; ?>
                </h4>
                <hr/>
                <section id="contents">
                    <form class="form-horizontal ajax-form" role="form" action="<?php echo U('Group/Index/create');?>" method="post" id="edit-article-form">
                        <input type="hidden" name="group_id" value="<?php echo ($group["id"]); ?>"/>

                        <div class="row">
                            <!-- 帖子分类 -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputTitle" class="col-sm-2 control-label">*<?php echo L('_MODULE_'); echo L('_NAME_');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="<?php echo L('_MODULE_'); echo L('_NAME_');?>，<?php echo L('_TIP_MODULE_NAME_');?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputType" class="col-sm-2 control-label">*<?php echo L('_CATEGORY_');?></label>
                                    <div class="col-sm-10">
                                        <select name="group_type" class="form-control" id="inputType">
                                            <option value="-1"><?php echo L('_PLEASE_SELECT_');?></option>
                                            <?php if(is_array($groupTypeAll)): $i = 0; $__LIST__ = $groupTypeAll;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$groupType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($groupType['id']); ?>"><?php echo ($groupType['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputDescription" class="col-sm-2 control-label">*<?php echo L('_MODULE_'); echo L('_INTRO_');?></label>
                                    <div class="col-sm-10">
                                        <textarea name="detail" class="form-control" id="inputDescription" placeholder="<?php echo L('_TIP_INTRO_');?>"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputDescription" class="col-sm-2 control-label">*<?php echo L('_MODULE_'); echo L('_TYPE_');?></label>
                                    <div class="col-sm-10">
                                        <label for="id_type_0" style="font-weight: normal">
                                        <input id="id_type_0" name="type" value="0" type="radio" checked="">
                                            <?php echo L('_PUBLIC_'); echo L('_MODULE_');?></label>
                                        <label for="id_type_1" style="font-weight: normal">
                                        <input id="id_type_1" name="type" value="1" type="radio">
                                            <?php echo L('_PRIVATE_'); echo L('_MODULE_');?>
                                        </label>
                                        <div style="color: #999">
                                            （<?php echo L(_TIP_GROUP_TYPE_);?>）
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label"><?php echo L('_MODULE_'); echo L('_FIGURE_');?></label>
                                    <div  class="col-sm-10">
                                        <?php echo W('Common/UploadImage/render',array(array('id'=>'cover_id_cover','name'=>'logo','value'=>'','width'=>200,'height'=>200,'isLoadScript'=>1)));?>
                                    </div>
                                </div>
                               <!-- <div class="form-group">
                                    <label  class="col-sm-2 control-label">背景图片</label>

                                    <div  class="col-sm-10">
                                        <?php echo W('Common/UploadImage/render',array(array('id'=>'background','name'=>'background','value'=>'','width'=>200,'height'=>200,'isLoadScript'=>1)));?>
                                </div>-->
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle" class="col-sm-2 control-label">*<?php echo L('_NAME_OF_MEMBER_');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="member_alias" class="form-control" id="inputMember" placeholder="<?php echo L('_TIP_ALIAS_');?>" value="">
                                    </div>
                                </div>
                            </div>

                        <p class="pull-right">
                            <button type="submit" class="btn btn-large btn-primary" id="submit-button">
                                <span class="glyphicon glyphicon-edit"></span>
                            <span id="submit-content">
                                <?php if($isEdit): echo L('_MODIFY_');?>
                                    <?php else: ?>
                                    <?php echo L('_CREATE_'); endif; ?>
                            </span>
                            </button>
                            <input type="hidden" id="isEdit" value="<?php echo ($isEdit); ?>">
                        </p>
                        <p>
                            <a class="btn btn-large btn-primary" onclick="history.go(-1)">
                                <span class="glyphicon glyphicon-home"></span>
                                <?php echo L('_RETURN_');?>
                            </a>
                        </p>
                    </form>
                </section>
            </div>
    </div>

            </div>
            <div class="col-md-4">
                
                <?php if(ACTION_NAME != 'create' && ACTION_NAME != 'search' ){ ?>

        <?php if(check_auth('Tutorial/Index/addPost',-1)){ ?>
    <div style="margin-bottom: 20px">
        <a type="button" class="btn btn-large btn-primary-tie group_post_btn"
           href="<?php echo U('index/edit',array('tutorial_id'=>$tutorial_id));?>">
            <?php echo L('_DO_POST_');?>
        </a>
    </div>

<?php } ?>

<?php if($tutorial){ ?>
<div class="common-block group_info" style="padding-bottom: 10px;">


    <header class="">
        <?php echo L('_MODULE_'); echo L('_FOUNDER_');?>
    </header>
    <div class="common_block_content_right">
        <div class="pull-left">
            <a href="<?php echo ($tutorial["user"]["space_url"]); ?>" ucard="<?php echo ($tutorial["user"]["uid"]); ?>"><img src="<?php echo ($tutorial["user"]["avatar128"]); ?>" width="55px"
                                                                               class="avatar-img"/></a>
        </div>
        <div class="pull-left" style="height: 55px;padding: 7px 0 0 20px;;">
            <a href="<?php echo ($tutorial["user"]["space_url"]); ?>" ucard="<?php echo ($tutorial["user"]["uid"]); ?>"><?php echo (op_t($tutorial["user"]["nickname"])); ?></a>

            <div class="" style="color: #999">
                <?php echo L('_OWN_');?> <?php echo ($tutorial["user"]["tutorial_count"]); echo L('_A_MODULE_');?>
            </div>
        </div>
        <div class="clearfix" style="padding:10px 0px;"><span style="font-weight: 700">[<?php echo L('_MODULE_'); echo L('_INTRO_');?>]</span> <?php echo ($tutorial["detail"]); ?></div>
    </div>
    <?php if($notice != null): ?><hr class="" style="margin-top:0;margin-bottom: 10px;">
    <div class="common_block_content_right" >
       <span style="font-weight: 700">[<?php echo L('_NOTICE_');?>]</span> <?php echo ($notice["content"]); ?>
    </div><?php endif; ?>
</div>
<?php } ?>

<?php echo W('HotPost/lists',array('tutorial_id'=>$tutorial_id));?>

<div class="common_block_border group_info">

 <?php echo W('HotPeople/lists',array('tutorial_id'=>$tutorial_id));?>
</div>


<?php }else{ ?>

<?php echo W('MyAttendance/lists');?>
<?php echo W('HotTutorial/lists');?>


<?php } ?>

            </div>
        </div>

    </div>
    <script type="text/javascript">
    </script>
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



    <script type="text/javascript" charset="utf-8" src="/Public/js/ext/webuploader/js/webuploader.js"></script>
    <link href="/Public/js/ext/webuploader/css/webuploader.css" type="text/css" rel="stylesheet">

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


</div>
<!-- /底部 -->
</body>
</html>