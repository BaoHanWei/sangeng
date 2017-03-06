<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|<?php echo L('_SNS_BACKSTAGE_MANAGE_');?></title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">


    <!--zui-->
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/zui/css/zui.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/admin.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/ext.css" media="all">
    <!--zui end-->

    <!--
        <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/base.css" media="all">
        <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/common.css" media="all"-->
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/module.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/style.css" media="all">
    <!--<link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/Public/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/Application/Admin/Static/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
    <script type="text/javascript">
        var ThinkPHP = window.Think = {
            "ROOT": "", //当前网站地址
            "APP": "/index.php?s=", //当前项目地址
            "PUBLIC": "/Public", //项目公共目录地址
            "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINF<?php echo L("_O_SEGMENTATION_");?>
            "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
            'URL_MODEL': "<?php echo C('URL_MODEL');?>"
        }
        var _ROOT_="";
    </script>
</head>
<body>
<style>

</style>
<div class="panel-header">
    <nav class="navbar navbar-inverse admin-bar" role="navigation">
        <div class="navbar-header">
            <a href="<?php echo U('Index/index');?>" class="navbar-brand">
                OpenSNS</a>
        </div>
        <div class="collapse navbar-collapse navbar-collapse-example">
            <ul id="nav_bar" class="nav navbar-nav">
                <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if(($menu["hide"]) != "1"): ?><li data-id="<?php echo ($menu["id"]); ?>" class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>">
                            <?php if(($menu["icon"]) != ""): ?><i class="icon-<?php echo ($menu["icon"]); ?>"></i>&nbsp;<?php endif; ?>
                            <?php echo ($menu["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://os.opensns.cn/index.php?s=question/index/index.html" target="_blank"><i class="icon-question"></i> <?php echo L('_Q_AND_A_');?></a></li>
                <li><a href="http://os.opensns.cn/index.php?s=book/index/index.html" target="_blank"><i class="icon-book"></i> <?php echo L('_DOCUMENT_');?></a></li>
                <li><a href="javascript:;"  onclick="clear_cache()"><i class="icon-trash"></i> <?php echo L('_CACHE_CLEAR_');?></a></li>
                <li><a target="_blank" href="<?php echo U('Home/Index/index');?>"><i class="icon-copy"></i> <?php echo L('_FORESTAGE_OPEN_');?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>
                        <?php echo session('user_auth.username');?> <b
                                class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo U('User/updatePassword');?>"><?php echo L('_PASSWORD_CHANGE_');?></a></li>
                        <li><a href="<?php echo U('User/updateNickname');?>"><?php echo L('_NICKNAME_CHANGE_');?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo U('Public/logout');?>"><?php echo L('_EXIT_');?></a></li>
                    </ul>
                </li>
                <script>
                    function clear_cache() {
                        var msg = new $.zui.Messager("<?php echo L('_CACHE_CLEAR_SUCCESS_'); echo L('_PERIOD_');?>", {placement: 'bottom'});
                        $.get('/cc.php');
                        msg.show()
                    }
                </script>
            </ul>
        </div>
    </nav>

    <div class="admin-title">

    </div>

</div>
<div class="panel-menu">
    <ul class="nav nav-primary nav-stacked">

        <?php if(is_array($__MODULE_MENU__)): $i = 0; $__LIST__ = $__MODULE_MENU__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if($v['is_setup'] AND $v['admin_entry']): ?><li>
                    <a  href="<?php echo U($v['admin_entry']);?>" title="<?php echo (text($v["alias"])); ?>" class="text-ellipsis text-center">
                        <i class="icon-<?php echo ($v['icon']); ?>"></i><br/><?php echo ($v["alias"]); ?>
                    </a>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

    </ul>

</div>

<div class="panel-main" style="float:left;">

    <div class="">


    <div class="clearfix " style="">
        <?php if(!empty($__MENU__["child"])): ?><div class="sub_menu_wrapper" style="background: rgb(245, 246, 247); bottom: -10px;top: 0;position: absolute;width: 180px;overflow: auto">
                <div>
                    <nav id="sub_menu" class="menu" data-toggle="menu">
                        <ul class="nav nav-primary">
                            
                                <!--     <?php if(!empty($_extra_menu)): ?>
                                         <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>-->
                                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- <?php echo L("_SUB_NAVIGATION_");?>-->
                                    <?php if(!empty($sub_menu)): ?><li class="show">
                                            <a href="#">
                                                <?php if(!empty($key)): echo ($key); endif; ?>
                                            </a>
                                            <ul class="nav">
                                                <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                                        <a href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </ul>
                                        </li><?php endif; ?>
                                    <!-- /<?php echo L("_SUB_NAVIGATION_");?>--><?php endforeach; endif; else: echo "" ;endif; ?>

                            

                        </ul>
                    </nav>
                </div>
            </div><?php endif; ?>


        <?php if(!empty($__MENU__["child"])): $col=10; ?>
            <?php else: ?>
            <?php $col=12; endif; ?>
        <div id="main-content" class="" style="padding:10px;padding-left:0;padding-bottom:10px;left: 180px;position:absolute;right: 0;bottom: 0;top: 0;overflow: auto">
           <?php if(($update) == "1"): ?><div id="top-alert" class="alert alert-success alert-dismissable" style="position: absolute;left: 50%;margin-left: -150px;width: 300px;box-shadow: rgba(95, 95, 95, 0.4) 3px 3px 3px;z-index:999">
                   <i class="icon-ok-sign" style="font-size: 28px"></i>  &nbsp;&nbsp; <?php echo L('_VERSION_UPDATE_',array('href'=> '<a class="alert-link" href="'.U('Cloud/update').'">' ));?></a>
                   <button class="close fixed" style="margin-top: 4px;">&times;</button>
               </div><?php endif; ?>

            <div id="main" style="overflow-y:auto;overflow-x:hidden;">
                
                    <!-- nav -->
                    <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                            <span><?php echo L('_YOUR_POSITION_'); echo L('_COLON_');?></span>
                            <?php $i = '1'; ?>
                            <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                                    <?php else: ?>
                                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                                <?php $i = $i+1; endforeach; endif; ?>
                        </div><?php endif; ?>
                    <!-- nav -->
                

                <div class="admin-main-container">
                    
    <div class="main-title">
        <h2><?php echo L("_NAVIGATION_MANAGEMENT_");?></h2>
    </div>


    <div class="with-padding">
        <form action="<?php echo U();?>" method="post" class="form-horizontal" >
        <ul class="channel-ul">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="clearfix pLi" >
    <input name="nav[1][sort][]" class="sort" style="display: none" >
    <div class="pull-left nav_list">

        <select name="nav[1][type][]" class="form-control nav-type" style="width: 100px;">
            <option value="module" <?php if($nav['module_name']): ?>selected<?php endif; ?>><?php echo L("_SYSTEM_MODULE_");?></option>
            <option value="custom" <?php if(!$nav['module_name']): ?>selected<?php endif; ?>><?php echo L("_CUSTOM_");?></option>
        </select>

        <select name="nav[1][modul][]" class="form-control module" style="width: 100px;<?php if(!$nav['module_name']){ ?>display:none<?php } ?>">
            <?php foreach($module as $k=>$v){ ?>
            <option value="<?php echo ($v["entry"]); ?>" data-icon="<?php echo ($v["icon"]); ?>" <?php if(strtolower($nav['url']) == strtolower($v['entry'])): ?>selected<?php endif; ?>><?php echo ($v["alias"]); ?></option>
            <?php }unset($k,$v) ?>
        </select>

        <input name="nav[1][title][]" placeholder=<?php echo L("_PLEASE_ENTER_THE_TITLE_WITH_DOUBLE_");?> class="form-control title" style="width: 100px;" value="<?php echo ($nav["title"]); ?>">

        <input name="nav[1][url][]" placeholder=<?php echo L("_PLEASE_ENTER_A_LINK_WITH_DOUBLE_");?>   class="form-control url" style="width: 300px;<?php if($nav['module_name']){ ?>display:none<?php } ?>" value=" <?php echo ($nav["url"]); ?>">

    </div>
    <div class='pull-left icon-chose' title=<?php echo L("__WITH_DOUBLE_");?>>
        <?php $icon = 'icon-'.$nav['icon']; if(empty($nav['icon'])){ $icon = ''; } ?>
        <select name="nav[1][icon][]" title=<?php echo L("__WITH_DOUBLE_");?> class="chosen-icons" data-value="<?php echo ($icon); ?>"></select>
    </div>
    <div class='pull-left color-chose' title=<?php echo L("_SELECT_THE_ICON_BACKGROUND_COLOR_WITH_DOUBLE_");?>>
        <input name="nav[1][color][]" class='simple_color_callback' value="<?php echo ((isset($nav['color']) && ($nav['color'] !== ""))?($nav['color']):'#000000'); ?>"/>
    </div>
    <div class='pull-left new-blank ' >
        <input name="nav[1][target][]" class="target_input" value="<?php echo ($nav['target']); ?>">
        <label title=<?php echo L("_THE_NEW_WINDOW_OPENS_WITH_DOUBLE_");?> ><input class="target" <?php if($nav['target'] == 1): ?>checked<?php endif; ?>  type="checkbox" value="1"><?php echo L("_NEW_WINDOW_OPENS_");?></label>
    </div>


    <div class='pull-left i-list'>

        <a href="javascript:" title=<?php echo L("_ADD_A_NAVIGATION_WITH_DOUBLE_");?> class="add-one"><i class="icon icon-plus"></i></a>
        <a href="javascript:"  title=<?php echo L("_REMOVE_THIS_NAVIGATION_WITH_DOUBLE_");?> class="remove-li"><i class="icon icon-remove"></i></a>
        <a href="javascript:" title=<?php echo L("_MOBILE_NAVIGATION_SORT_WITH_DOUBLE_");?>><i class="icon icon-move sort-handle-1"></i></a>
    </div>


    <div class='pull-left band-text'>
        <input name="nav[1][band_text][]" class="form-control" placeholder=<?php echo L("_SIGN_POINTS_WITH_DOUBLE_");?>  style="width: 100px;" value="<?php echo ($nav['band_text']); ?>">
    </div>

    <div class='pull-left color-chose' title=<?php echo L("_SELECT_THE_FLAG_COLOR_WITH_DOUBLE_");?>>
        <input name="nav[1][band_color][]" class='simple_color_callback' value="<?php echo ((isset($nav['band_color']) && ($nav['band_color'] !== ""))?($nav['band_color']):'#000000'); ?>"/>
    </div>

<?php if($nav['child']){ ?>
    <div class="clearfix"></div>
    <ul class="ul-2"  style="display: block;">
        <?php if(is_array($nav['child'])): $i = 0; $__LIST__ = $nav['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><li class="clearfix" >
    <input name="nav[2][pid][]" class="pid" style="display: none">
    <input name="nav[2][sort][]" class="sort" style="display: none" >
    <div class="pull-left nav_list">
        <select name="nav[2][type][]" class="form-control nav-type" style="width: 100px;">
            <option value="module" <?php if($child['module_name']): ?>selected<?php endif; ?>><?php echo L("_SYSTEM_MODULE_");?></option>
            <option value="custom" <?php if(!$child['module_name']): ?>selected<?php endif; ?>><?php echo L("_CUSTOM_");?></option>
        </select>

        <select name="nav[2][module][]" class="form-control module" style="width: 100px;<?php if(!$child['module_name']){ ?>display:none<?php } ?>">
            <?php foreach($module as $k=>$v){ ?>
            <option value="<?php echo ($v["entry"]); ?>" data-icon="<?php echo ($v["icon"]); ?>" <?php if(strtolower($child['url']) == strtolower($v['entry'])): ?>selected<?php endif; ?>><?php echo ($v["alias"]); ?></option>
            <?php }unset($k,$v) ?>
        </select>

        <input name="nav[2][title][]" placeholder=<?php echo L("_PLEASE_ENTER_THE_TITLE_WITH_DOUBLE_");?> class="form-control title" style="width: 100px;" value="<?php echo ($child["title"]); ?>">

        <input name="nav[2][url][]" placeholder=<?php echo L("_PLEASE_ENTER_A_LINK_WITH_DOUBLE_");?>  class="form-control url" style="width: 300px;<?php if($child['module_name']){ ?>display:none<?php } ?>" value=" <?php echo ($child["url"]); ?>">

    </div>
    <div class='pull-left icon-chose' title=<?php echo L("_SELECT_ICON_WITH_DOUBLE_");?>>
        <select name="nav[2][icon][]" title=<?php echo L("_SELECT_ICON_WITH_DOUBLE_");?> class="chosen-icons" data-value="icon-<?php echo ((isset($child['icon']) && ($child['icon'] !== ""))?($child['icon']):''); ?>"></select>
    </div>
    <div class='pull-left color-chose' title=<?php echo L("_SELECT_THE_ICON_BACKGROUND_COLOR_WITH_DOUBLE_");?>>
        <input name="nav[2][color][]" class='simple_color_callback'  value="<?php echo ((isset($child['color']) && ($child['color'] !== ""))?($child['color']):'#000000'); ?>"/>
    </div>
    <div class='pull-left new-blank ' >
        <input name="nav[2][target][]" class="target_input" value="<?php echo ($child['target']); ?>">
        <label title=<?php echo L("_THE_NEW_WINDOW_OPENS_WITH_DOUBLE_");?> > <input class="target" <?php if($child['target'] == 1): ?>checked<?php endif; ?>  type="checkbox" value="1"><?php echo L("_NEW_WINDOW_OPENS_");?></label>
    </div>


    <div class='pull-left i-list'>

        <a href="javascript:" title=<?php echo L("_ADD_NAVIGATION_WITH_DOUBLE_");?> class="add-two"><i class="icon icon-plus"></i></a>
        <a href="javascript:"   title=<?php echo L("_REMOVE_THIS_NAVIGATION_WITH_DOUBLE_");?> class="remove-li"><i class="icon icon-remove"></i></a>
        <a href="javascript:"  title=<?php echo L("_MOBILE_NAVIGATION_SORT_WITH_DOUBLE_");?>><i class="icon icon-move sort-handle-2"></i></a>
    </div>


    <div class='pull-left band-text'>
        <input name="nav[2][band_text][]" class="form-control" placeholder=<?php echo L("_SIGN_POINTS_WITH_DOUBLE_");?>  style="width: 100px;" value="<?php echo ($child['band_text']); ?>">
    </div>

    <div class='pull-left color-chose' title=<?php echo L("_SELECT_THE_FLAG_COLOR_WITH_DOUBLE_");?>>
        <input name="nav[2][band_color][]" class='simple_color_callback' value="<?php echo ((isset($child['band_color']) && ($child['band_color'] !== ""))?($child['band_color']):'#000000'); ?>"/>
    </div>

</li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>

 <?php } ?>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>

            <div class="form-item with-padding">
                <button class="btn submit-btn ajax-post no-refresh" id="submit" type="submit" target-form="form-horizontal"><?php echo L("_SURE_WITH_SPACE_");?></button>
                <button class="btn btn-return" onclick="javascript:history.back(-1);return false;"><?php echo L("_RETURN_WITH_SPACE_");?></button>
            </div>
        </form>
    </div>



<div id="one-nav" class="hide">
    <li class="clearfix pLi" >
        <input name="nav[1][sort][]" class="sort" style="display: none" >
        <div class="pull-left nav_list">
            <select name="nav[1][type][]" class="form-control nav-type" style="width: 100px;">
                <option value="module" ><?php echo L("_SYSTEM_MODULE_");?></option>
                <option value="custom" ><?php echo L("_CUSTOM_");?></option>
            </select>

            <select name="nav[1][module][]" class="form-control module" style="width: 100px;">
                <?php foreach($module as $k=>$v){ ?>
                <option value="<?php echo ($v["entry"]); ?>"  data-icon="<?php echo ($v["icon"]); ?>" ><?php echo ($v["alias"]); ?></option>
                <?php }unset($k,$v) ?>
            </select>

            <input name="nav[1][title][]" placeholder=<?php echo L("_PLEASE_ENTER_THE_TITLE_WITH_DOUBLE_");?> class="form-control title" style="width: 100px;" value="<?php echo ($module["0"]["alias"]); ?>">

            <input name="nav[1][url][]" placeholder=<?php echo L("_PLEASE_ENTER_A_LINK_WITH_DOUBLE_");?>  class="form-control url" style="width: 300px;display:none" value="<?php echo ($module["0"]["entry"]); ?>">

        </div>

        <div class='pull-left icon-chose' title=<?php echo L("_SELECT_ICON_WITH_DOUBLE_");?>>
            <select name="nav[1][icon][]" title=<?php echo L("_SELECT_ICON_WITH_DOUBLE_");?> class="chosen-icons" data-value="icon-<?php echo ($module["0"]["icon"]); ?>"></select>
        </div>

        <div class='pull-left color-chose' title=<?php echo L("_SELECT_THE_ICON_BACKGROUND_COLOR_WITH_DOUBLE_");?>>
            <input  name="nav[1][color][]" class='simple_color_callback' value="#000000"/>
        </div>
        <div class='pull-left new-blank ' >
            <input name="nav[1][target][]" class="target_input" value="0">
            <label title=<?php echo L("_THE_NEW_WINDOW_OPENS_WITH_DOUBLE_");?>> <input class="target" type="checkbox" value="1"><?php echo L("_NEW_WINDOW_OPENS_");?></label>
        </div>


        <div class='pull-left i-list'>

            <a href="javascript:" title=<?php echo L("_ADD_A_NAVIGATION_WITH_DOUBLE_");?>  class="add-one"><i class="icon icon-plus"></i></a>
            <a href="javascript:" title=<?php echo L("_REMOVE_THIS_NAVIGATION_WITH_DOUBLE_");?> class="remove-li"><i class="icon icon-remove"></i></a>
            <a href="javascript:" title=<?php echo L("_MOBILE_NAVIGATION_SORT_WITH_DOUBLE_");?>><i class="icon icon-move sort-handle-1"></i></a>
        </div>


        <div class='pull-left band-text'>
            <input name="nav[1][band_text][]" class="form-control" placeholder=<?php echo L("_SIGN_POINTS_WITH_DOUBLE_");?>  style="width: 100px;" value="">
        </div>

        <div class='pull-left color-chose' title=<?php echo L("_SELECT_THE_FLAG_COLOR_WITH_DOUBLE_");?>>
            <input name="nav[1][band_color][]" class='simple_color_callback' value="#000000"/>
        </div>

    </li>

</div>

    <div id="two-nav" class="hide">

        <li class="clearfix" >
            <input name="nav[2][pid][]" class="pid" style="display: none">
            <input name="nav[2][sort][]" class="sort" style="display: none" >
            <div class="pull-left nav_list">

                <select name="nav[2][type][]" class="form-control nav-type" style="width: 100px;">
                    <option value="module" ><?php echo L("_SYSTEM_MODULE_");?></option>
                    <option value="custom" ><?php echo L("_CUSTOM_");?></option>
                </select>

                <select name="nav[2][module][]" class="form-control module" style="width: 100px;">
                    <?php foreach($module as $k=>$v){ ?>
                    <option value="<?php echo ($v["entry"]); ?>" data-icon="<?php echo ($v["icon"]); ?>" ><?php echo ($v["alias"]); ?></option>
                    <?php }unset($k,$v) ?>
                </select>

                <input name="nav[2][title][]" placeholder=<?php echo L("_PLEASE_ENTER_THE_TITLE_WITH_DOUBLE_");?> class="form-control title" style="width: 100px;" value="<?php echo ($module["0"]["alias"]); ?>">

                <input name="nav[2][url][]" placeholder=<?php echo L("_PLEASE_ENTER_A_LINK_WITH_DOUBLE_");?>  class="form-control url" style="width: 300px;display:none" value="<?php echo ($module["0"]["entry"]); ?>">

            </div>
            <div class='pull-left icon-chose' title=<?php echo L("_SELECT_ICON_WITH_DOUBLE_");?>>
                <select name="nav[2][icon][]" title=<?php echo L("_SELECT_ICON_WITH_DOUBLE_");?> class="chosen-icons" data-value="icon-<?php echo ($module["0"]["icon"]); ?>"></select>
            </div>
            <div class='pull-left color-chose' title=<?php echo L("_SELECT_THE_ICON_BACKGROUND_COLOR_WITH_DOUBLE_");?>>
                <input name="nav[2][color][]" class='simple_color_callback' value="#000000"/>
            </div>
            <div class='pull-left new-blank ' >
                <input name="nav[2][target][]" class="target_input" value="0">
                <label title=<?php echo L("_THE_NEW_WINDOW_OPENS_WITH_DOUBLE_");?>> <input class="target"  type="checkbox" value="1"><?php echo L("_NEW_WINDOW_OPENS_");?></label>
            </div>


            <div class='pull-left i-list'>

                <a href="javascript:" title=<?php echo L("_ADD_NAVIGATION_WITH_DOUBLE_");?>  class="add-two"><i class="icon icon-plus"></i></a>
                <a href="javascript:"  title=<?php echo L("_REMOVE_THIS_NAVIGATION_WITH_DOUBLE_");?> class="remove-li"><i class="icon icon-remove"></i></a>

                <a href="javascript:" title=<?php echo L("_MOBILE_NAVIGATION_SORT_WITH_DOUBLE_");?>><i class="icon icon-move sort-handle-2"></i></a>
            </div>


            <div class='pull-left band-text'>
                <input name="nav[2][band_text][]" class="form-control" placeholder=<?php echo L("_SIGN_POINTS_WITH_DOUBLE_");?>  style="width: 100px;" value="">
            </div>

            <div class='pull-left color-chose' title=<?php echo L("_SELECT_THE_FLAG_COLOR_WITH_DOUBLE_");?>>
                <input name="nav[2][band_color][]" class='simple_color_callback' value="#000000"/>
            </div>

        </li>

    </div>




                </div>

            </div>
        </div>
    </div>
    </div>
</div>



<?php if($report){ ?>
<div  class="report_feedback" title="<?php echo L('_REPORT_EXPERIENCE_PLEASE_FILL_');?>" data-toggle="modal" data-target="#myModal">
    <div class="report_icon" ></div>
    <span class="label label-badge label-danger report_point">1</span>
</div>




<div class="modal fade in" id="myModal" aria-hidden="false"  style="display: none">
    <div class="modal-dialog" >
        <div class="modal-content">
            <form class="report_form"  action="<?php echo U('admin/admin/submitReport');?>" method="post">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only"><?php echo L('_CLOSE_');?></span></button>
                <h4 class="modal-title"><?php echo L('_REPORT_EXPERIENCE_');?></h4>
            </div>

            <div class="modal-body">

                    <div class="row">
                        <!-- 帖子分类 -->
                        <div class="col-sm-12">
<div><?php echo L('_THANKS_HOPE_');?></div>

                                <label class="item-label"><?php echo L('_MOOD_MY_');?></label>
                            <div>
                                <select name="q1" class="report-select" style="width:400px;">
                                    <option value="0"><?php echo L('_ELECT_PLEASE_');?></option>
                                    <option><?php echo L('_HAPPY_');?></option>
                                    <option><?php echo L('_AGONY_');?></option>
                                    <option><?php echo L('_LOVE_');?></option>
                                    <option><?php echo L('_EXPECT_');?></option>
                                </select>
                        </div>

                                <label class="item-label"><?php echo L('_LOVE_MY_OPTION_');?></label>
                            <div>
                                <select name="q2" class="report-select" style="width:400px;">
                                    <option value="0"><?php echo L('_ELECT_PLEASE_');?></option>
                                    <?php if(is_array($this_update)): $i = 0; $__LIST__ = $this_update;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo (htmlspecialchars($option)); ?>"><?php echo (htmlspecialchars($option)); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>

                                <label class="item-label"><?php echo L('_HATE_MY_OPTION_');?>
                                </label>
                            <div>
                                <select name="q3" class="report-select" style="width:400px;">
                                    <option value="0"><?php echo L('_ELECT_PLEASE_');?></option>
                                    <?php if(is_array($this_update)): $i = 0; $__LIST__ = $this_update;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo (htmlspecialchars($option)); ?>"><?php echo (htmlspecialchars($option)); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>


                                <label class="item-label"><?php echo L('_EXPECTATION__MY_OPTION_');?>
                                </label>
                            <div>
                                <select name="q4" class="report-select" style="width:400px;">
                                    <option value="0"><?php echo L('_ELECT_PLEASE_');?></option>
                                    <?php if(is_array($future_update)): $i = 0; $__LIST__ = $future_update;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo (htmlspecialchars($option)); ?>"><?php echo (htmlspecialchars($option)); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <?php if(strval($report['url'])!=''){ ?>
                <a class="pull-left" href="<?php echo ($report['url']); ?>" target="_blank" ><?php echo L('_UPDATE_LOOK_');?></a>
                <?php } ?>
                <button type="submit" class="btn ajax-post" target-form="report_form"><?php echo L('_CONFIRM_');?></button>
            </div>

            </form>
        </div>
    </div>
</div>



<?php } ?>


<script>
    $(function () {
        var config = {
            '.chosen-select'           : {search_contains: true, drop_width: 400,no_results_text:"{:L('_OPTION_MATCHED_NONE_')}"},
            '.report-select'           : {search_contains: true, width: '400px',no_results_text:"{:L('_OPTION_MATCHED_NONE_')}"}
        };
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

    });
</script>


<script src="/Application/Admin/Static/zui/lib/chosen/chosen.js"></script>
<link href="/Application/Admin/Static/zui/lib/chosen/chosen.css" type="text/css" rel="stylesheet">




<!-- <?php echo L("_CONTENT_AREA_");?>-->

<!-- /<?php echo L("_CONTENT_AREA_");?>-->
<script type="text/javascript">
    (function () {
        var ThinkPHP = window.Think = {
            "ROOT": "", //当前网站地址
            "APP": "/index.php?s=", //当前项目地址
            "PUBLIC": "/Public", //项目公共目录地址
            "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
            'URL_MODEL': "<?php echo C('URL_MODEL');?>"
        }
    })();
</script>
<script type="text/javascript" src="/Public/static/think.js"></script>

<!--zui-->
<script type="text/javascript" src="/Application/Admin/Static/js/common.js"></script>
<script type="text/javascript" src="/Application/Admin/Static/js/com/com.toast.class.js"></script>
<script type="text/javascript" src="/Application/Admin/Static/zui/js/zui.js"></script>
<script type="text/javascript" src="/Application/Admin/Static/zui/lib/migrate/migrate1.2.js"></script>
<!--zui end-->
<link rel="stylesheet" type="text/css" href="/Application/Admin/Static/js/kanban/kanban.css" media="all">
<script type="text/javascript" src="/Application/Admin/Static/js/kanban/kanban.js"></script>
<script type="text/javascript">
    +function () {
        var $window = $(window), $subnav = $("#subnav"), url;
        $window.resize(function () {
            $("#main").css("min-height", $window.height() - 130);
        }).resize();

        // 导航栏超出窗口高度后的模拟滚动条
        var sHeight = $(".sidebar").height();
        var subHeight = $(".subnav").height();
        var diff = subHeight - sHeight; //250
        var sub = $(".subnav");
        if (diff > 0) {
            $(window).mousewheel(function (event, delta) {
                if (delta > 0) {
                    if (parseInt(sub.css('marginTop')) > -10) {
                        sub.css('marginTop', '0px');
                    } else {
                        sub.css('marginTop', '+=' + 10);
                    }
                } else {
                    if (parseInt(sub.css('marginTop')) < '-' + (diff - 10)) {
                        sub.css('marginTop', '-' + (diff - 10));
                    } else {
                        sub.css('marginTop', '-=' + 10);
                    }
                }
            });
        }
    }();
    highlight_subnav("<?php echo U('Admin'.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$_GET);?>")
</script>

    <script src="/Application/Admin/Static/js/jquery.simple-color.js"></script>
    <script src="/Application/Admin/Static/js/channel.js"></script>
    <script src="/Application/Admin/Static/zui/lib/chosen/chosen.icons.min.js"></script>
    <link href="/Application/Admin/Static/zui/lib/chosen/chosen.icons.css" rel="stylesheet">



</body>
</html>