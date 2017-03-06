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
        <?php if(!empty($title)): ?><h2><?php echo ($title); ?></h2><?php endif; ?>
    </div>


    <div class="with-padding">
        <form action="/index.php?s=/admin/book/editsections/book_id/6.html" method="post" class="form-horizontal">
            <input type="hidden" name="book_id" value="<?php echo ($book_id); ?>">
            <input type="hidden" name="section_id" value="<?php echo ($section_id); ?>">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th style="width: 100px"><?php echo L("_TYPE_");?></th>
                    <th style="width: 100px;"><?php echo L("_EXPAND_SUB_CHAPTER_");?></th>
                    <th style="width: 400px;"><?php echo L("_TITLE_");?></th>
                    <th style="width: 100px"><?php echo L("_SORT_");?></th>
                    <th style="width: 150px"><?php echo L("_AUTHOR_ID_");?></th>
                    <th style="width: 500px"><?php echo L("_KEY_WORD_");?></th>
                    <th style="width: 100px"><?php echo L("_RELEASE_STATE_");?></th>
                    <th style="width: 200px"><?php echo L("_RELEASE_TIME_DELAYED_RELEASE_");?></th>
                </tr>
                </thead>

                <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$one_section): $mod = ($i % 2 );++$i;?><tr class="text-center">
                        <input type="hidden" name="id[]" value="<?php echo ($one_section["id"]); ?>"/>
                        <td>
                            <select name="type[]" class="form-control">
                                <?php if(($one_section["type"]) == "0"): ?><option value="0" selected="selected"><?php echo L("_CHAPTER_");?></option>
                                    <option value="1"><?php echo L("_ARTICLE_");?></option>
                                    <?php else: ?>
                                    <option value="0"><?php echo L("_CHAPTER_");?></option>
                                    <option value="1" selected="selected"><?php echo L("_ARTICLE_");?></option><?php endif; ?>
                            </select>
                        </td>
                        <td>
                            <select name="open_child[]" class="form-control">
                                <?php if(($one_section["open_child"]) == "0"): ?><option value="0" selected="selected">否</option>
                                    <option value="1">是</option>
                                    <?php else: ?>
                                    <option value="0">否</option>
                                    <option value="1" selected="selected">是</option><?php endif; ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="title[]" value="<?php echo ($one_section["title"]); ?>" class="form-control" placeholder=<?php echo L("_ENTER_THE_TITLE_NOT_REQUIRED_FILL_IN_THE_SYSTEM_THAT_DOES_NOT_EXIST_WITH_DOUBLE_");?> />
                        </td>
                        <td>
                            <input type="text" name="sort[]" value="<?php echo ($one_section["sort"]); ?>" class="form-control" placeholder=<?php echo L("_INPUT_SORT_VALUES_OPTIONAL_WITH_DOUBLE_");?> />
                        </td>
                        <td>
                            <input type="text" name="uid[]" value="<?php echo ($one_section["uid"]); ?>" class="form-control" placeholder=<?php echo L("_ENTER_AUTHOR_ID_");?>(<?php echo L("_OPTIONAL_");?>) />
                        </td>
                        <td>
                            <input type="text" name="keywords[]" value="<?php echo ($one_section["keywords"]); ?>" class="form-control" placeholder=<?php echo L('_INPUT_KEY_WORDS_OPTIONAL_WITH_DOUBLE_');?> />
                        </td>
                        <td>
                            <select name="is_show[]" class="form-control">
                                <?php if(($one_section["is_show"]) == "0"): ?><option value="0" selected="selected"><?php echo L("_DRAFT_");?></option>
                                    <option value="1"><?php echo L("_NORMAL_");?></option>
                                    <?php else: ?>
                                    <option value="0"><?php echo L("_DRAFT_");?></option>
                                    <option value="1" selected="selected"><?php echo L("_NORMAL_");?></option><?php endif; ?>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="create_time[]" class="time-value" value="<?php echo ($one_section["create_time"]); ?>"/>
                            <input type="text" class="form-datetime time form-control" value="<?php echo (time_format($one_section["create_time"])); ?>" placeholder=<?php echo L("_PLEASE_ENTER_THE_PUBLISHING_TIME_WITH_DOUBLE_");?> />
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php $i=0; do{ ?>
                <tr class="text-center">
                    <input type="hidden" name="id[]" value=""/>
                    <td>
                        <select name="type[]" class="form-control">
                            <option value="0" selected="selected"><?php echo L("_CHAPTER_");?></option>
                            <option value="1"><?php echo L("_ARTICLE_");?></option>
                        </select>
                    </td>
                    <td>
                        <select name="open_child[]" class="form-control">
                            <option value="0">否</option>
                            <option value="1" selected="selected">是</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="title[]" value="" class="form-control" placeholder=<?php echo L("_ENTER_THE_TITLE_NOT_REQUIRED_FILL_IN_THE_SYSTEM_THAT_DOES_NOT_EXIST_WITH_DOUBLE_");?> />
                    </td>
                    <td>
                        <input type="text" name="sort[]" value="0" class="form-control" placeholder=<?php echo L("_INPUT_SORT_VALUES_OPTIONAL_WITH_DOUBLE_");?> />
                    </td>
                    <td>
                        <input type="text" name="uid[]" value="" class="form-control" placeholder=<?php echo L("_ENTER_AUTHOR_ID_");?>(<?php echo L("_OPTIONAL_");?>) />
                    </td>
                    <td>
                        <input type="text" name="keywords[]" value="" class="form-control" placeholder=<?php echo L("_INPUT_KEY_WORDS_OPTIONAL_WITH_DOUBLE_");?> />
                    </td>
                    <td>
                        <select name="is_show[]" class="form-control">
                            <option value="0"><?php echo L("_DRAFT_");?></option>
                            <option value="1" selected="selected"><?php echo L("_NORMAL_");?></option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="create_time[]" class="time-value" value="<?php echo time();?>"/>
                        <input type="text" class="form-datetime time form-control" value="<?php echo time_format();?>" placeholder=<?php echo L("_PLEASE_ENTER_THE_PUBLISHING_TIME_WITH_DOUBLE_");?>/>
                    </td>
                </tr>
                <?php $i++; }while($i<5); ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <div class="form-item with-padding">
                <button class="btn submit-btn ajax-post no-refresh" id="submit" type="submit" target-form="form-horizontal"><?php echo L("_SURE_");?></button>
                <button class="btn btn-return" onclick="javascript:history.back(-1);return false;"><?php echo L("_RETURN_");?></button>
                <button class="btn btn-return" type="button" data-role="add-tr"><?php echo L("_INCREASE_");?></button>
            </div>
        </form>
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

    <link href="/Application/Admin/Static/zui/lib/datetimepicker/datetimepicker.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/Application/Admin/Static/zui/lib/datetimepicker/datetimepicker.min.js"></script>
    <script>
        $('.form-datetime').datetimepicker({
            language: "zh-CN",
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii'
        });
        $('.time').change(function () {
            var dateString = $(this).val();
            var date = new Date(dateString);
            var timestamp = date.getTime();
            $(this).parents('td').children('.time-value').val(Math.floor(timestamp / 1000));
        });
        $('[data-role="add-tr"]').click(function(){
            var html='';
            for(var i=0;i<5;i++){
                html+='<tr class="text-center">\
                   <input type="hidden" name="id[]" value=""/>\
                    <td>\
                    <select name="type[]" class="form-control">\
                    <option value="0" selected="selected"><?php echo L("_CHAPTER_");?></option>\
            <option value="1"><?php echo L("_ARTICLE_");?></option>\
            </select>\
            </td>\
            <td>\
                        <select name="open_child[]" class="form-control">\
                        <option value="0">否</option>\
                <option value="1" selected="selected">是</option>\
                </select>\
                </td>\
                    <td>\
            <input type="text" name="title[]" value="" class="form-control" placeholder=<?php echo L("_ENTER_THE_TITLE_NOT_REQUIRED_FILL_IN_THE_SYSTEM_THAT_DOES_NOT_EXIST_WITH_DOUBLE_");?> />\
                    </td>\
                    <td>\
            <input type="text" name="sort[]" value="0" class="form-control" placeholder=<?php echo L("_INPUT_SORT_VALUES_OPTIONAL_WITH_DOUBLE_");?> />\
                    </td>\
                    <td>\
            <input type="text" name="uid[]" value="" class="form-control" placeholder=<?php echo L("_ENTER_AUTHOR_ID_");?>(<?php echo L("_OPTIONAL_");?>) />\
                    </td>\
                    <td>\
            <input type="text" name="keywords[]" value="" class="form-control" placeholder=<?php echo L("_INPUT_KEY_WORDS_OPTIONAL_WITH_DOUBLE_");?> />\
                    </td>\
                    <td>\
            <select name="is_show[]" class="form-control">\
                    <option value="0"><?php echo L("_DRAFT_");?></option>\
            <option value="1" selected="selected"><?php echo L("_NORMAL_");?></option>\
            </select>\
            </td>\
                    <td>\
            <input type="hidden" name="create_time[]" class="time-value" value="<?php echo time();?>"/>\
                    <input type="text" class="form-datetime time form-control" value="<?php echo time_format();?>" placeholder=<?php echo L("_PLEASE_ENTER_THE_PUBLISHING_TIME_WITH_DOUBLE_");?> />\
                    </td>\
            </tr>';
            }
           $('tbody').append(html);
        });
    </script>



</body>
</html>