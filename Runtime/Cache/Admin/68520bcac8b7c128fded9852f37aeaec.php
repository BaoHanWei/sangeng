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
                    
    <script src="/Application/Admin/Static/zui/js/zui.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/Public/js/ext/magnific/magnific-popup.css"/>
    <script type="text/javascript" charset="utf-8" src="/Public/js/ext/webuploader/js/webuploader.js"></script>
    <link href="/Public/js/ext/webuploader/css/webuploader.css" type="text/css" rel="stylesheet">
    <!-- 标题 -->
    <div class="main-title">
        <h2>
            <?php echo ($_meta_title); ?>
        </h2>
    </div>
    <!-- 数据表格 -->
    <div class="with-padding">
        <div class="tab-wrap" style="margin-bottom: 5px">
            <ul class="nav nav-secondary group_nav">
            </ul>
        </div>

        <form action="<?php echo U('editadv?pos_id='.$pos['id']);?>" method="post" class="form-horizontal">
            <label class="item-label">所属广告位： </label>

            <div class="controls ">
                <input type="hidden" name="pos_id" value="<?php echo ($pos["id"]); ?>" class="text input-large form-control"
                       style="width: 400px" placeholder="无需填写" readonly/>

                <p class="lead"><?php echo ($pos["title"]); ?>——<?php echo ($pos["name"]); ?>——<?php echo ($pos["path"]); ?></p></div>

            <p>
                <label class="item-label">广告尺寸： </label>  <span class="text-danger" style="font-size: 32px"><?php echo ($pos["width"]); ?></span> X <span class="text-danger" style="font-size: 32px"><?php echo ($pos["height"]); ?></span>
                请使用最合适宽度的图片获得最佳广告显示效果
            </p>
            <input name="type" type="hidden" value="2">
            <style>
                .web_uploader_picture_list {
                    background: #eee;
                    content: "无图";
                    margin-top: 10px;
                    border: 1px solid #eee;
                    width: 150px;
                    height: 100px;
                    overflow: hidden;
                }

                .web_uploader_picture_list img {
                    width: 150px;
                    height: 100px;
                }

                #data-table {
                    list-style: none;
                    padding-left: 0;
                }

                #data-table li {
                    padding-bottom: 10px;
                    border-bottom: 1px dashed #eee;
                    padding-top: 10px;
                    background: white;
                }

                #data-table .dragging {
                    background-color: #fff4e5;
                    opacity: 0.35;
                }

                .data-header {
                    padding-bottom: 10px;
                    border-bottom: 1px dashed #eee;
                }
            </style>
            <label class="item-label">图片列表： </label>

            <div class="row data-header">
                <div class="col-xs-2">图片</div>
                <div class="col-xs-1">广告标题</div>
                <div class="col-xs-2">Url链接</div>
                <div class="col-xs-1">开始生效时间</div>
                <div class="col-xs-1">失效时间</div>
                <div class="col-xs-1">打开方式</div>
                <div class="col-xs-1">排序</div>
                <div class="col-xs-3">操作</div>
            </div>
            <ul id="data-table">
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="line row">
                        <div class="col-xs-2">
                            <span id="web_uploader_wrapper_<?php echo ($i); ?>">选择图片</span>
                            <input id="web_uploader_input_<?php echo ($i); ?>" name="pic[]" type="hidden" value="<?php echo ($vo["pic"]); ?>"
                                   event-node="uploadinput">

                            <div id="web_uploader_picture_list_<?php echo ($i); ?>" class="web_uploader_picture_list">
                                <img src="<?php echo (pic($vo["pic"])); ?>">
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" name="title[]" value="<?php echo ($vo["title"]); ?>"
                                   class="text input-large form-control" style="width: 100%"/>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" name="url[]" value="<?php echo ($vo["url"]); ?>"
                                   class="text input-large form-control" style="width:  100%"/>
                        </div>
                        <div class="col-xs-1">
                            <input type="hidden" name="start_time[]" value="<?php echo ($vo["start_time"]); ?>"/>

                            <input type="text" data-field-name="start_time"
                                   class="text input-large form-datetime time form-control"
                                   style="width: 130px" value="<?php echo (date('Y-m-d H:i',$vo["start_time"])); ?>"
                                   placeholder="请选择时间"/>

                        </div>
                        <div class="col-xs-1">
                            <input type="hidden" name="end_time[]" value="<?php echo ($vo["end_time"]); ?>"/>
                            <input type="text" data-field-name="end_time"
                                   class="text input-large form-datetime time form-control"
                                   style="width: 130px" value="<?php echo (date('Y-m-d H:i',$vo["end_time"])); ?>"
                                   placeholder="请选择时间"/>
                        </div>
                        <div class="col-xs-1">
                            <select id="target_<?php echo ($vo["id"]); ?>" name="target[]" class="form-control" style="width: 100%">
                                <option value="_blank" selected>新窗口:_blank</option>
                                <option value="_self">当前层:_self</option>
                                <option value="_parent">父框架:_parent</option>
                                <option value="_top">整个框架:_top</option>
                            </select>
                            <script>
                                $('#target_<?php echo ($vo["id"]); ?>').val("<?php echo ($vo["target"]); ?>")
                            </script>
                        </div>

                        <div class="col-xs-1">

                            <input type="text" name="sort[]" value="<?php echo ($vo["sort"]); ?>"
                                   class=" text input-large form-control" style="width: 80px"/>
                        </div>
                        <div class="col-xs-3">
                            <a class="btn btn-success btn-xs" onclick="builder.add(this)"><i
                                    class="icon-plus"></i> 添加</a>
                            <a class="btn btn-danger btn-xs" onclick="builder.remove(this)"><i
                                    class="icon-trash"></i> 删除</a>
                            <a href="javascript:" class="btn btn-warning sort-handle btn-xs"><i class="icon-move"></i>
                                移动
                            </a>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <br/>

            <div class="form-item">
                <button class="btn btn-success submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal" style="width: 100px">确定</button>
                &nbsp;
                <a class="btn btn-default" href="<?php echo U('adv?pos_id='.$pos['id']);?>">返回广告管理</a>
                &nbsp; <a class="btn btn-danger" onclick="builder.init()">清空并重置
            </a></div>
        </form>
    </div>

    <script id="line-tpl" style="display: none" type="text/html">
        <li class="line row">
            <div class="col-xs-2">
            </div>
            <div class="col-xs-1">
                <input type="text" name="title[]" value=""
                       class="text input-large form-control" style="width: 100%"/>
            </div>
            <div class="col-xs-2">
                <input type="text" name="url[]" value=""
                       class="text input-large form-control" style="width:  100%"/>
            </div>
            <div class="col-xs-1">
                <?php $start=time(); ?>
                <input type="hidden" name="start_time[]" value="<?php echo ($start); ?>"/>

                <input type="text" data-field-name="start_time"
                       class="text input-large form-datetime time form-control"
                       style="width: 130px" value="<?php echo (date('Y-m-d H:i',$start)); ?>"
                       placeholder="请选择时间"/>

            </div>
            <div class="col-xs-1">
                <?php $end=time()+7*60*60*24; ?>
                <input type="hidden" name="end_time[]" value="<?php echo ($end); ?>"/>
                <input type="text" data-field-name="end_time"
                       class="text input-large form-datetime time form-control"
                       style="width: 130px" value="<?php echo (date('Y-m-d H:i',$end)); ?>"
                       placeholder="请选择时间"/>
            </div>
            <div class="col-xs-1">
                <select name="target[]" class="form-control" style="width: 100%">
                    <option value="_blank" selected>新窗口:_blank</option>
                    <option value="_self">当前层:_self</option>
                    <option value="_parent">父框架:_parent</option>
                    <option value="_top">整个框架:_top</option>
                </select>
            </div>

            <div class="col-xs-1">

                <input type="text" name="sort[]" value="<?php echo ($data["sort"]); ?>"
                       class=" text input-large form-control" style="width: 80px"/>
            </div>
            <div class="col-xs-3">
                <a class="btn btn-success btn-xs" onclick="builder.add(this)"><i
                        class="icon-plus"></i> 添加</a>
                <a class="btn btn-danger btn-xs" onclick="builder.remove(this)"><i
                        class="icon-trash"></i> 删除</a>
                <a href="javascript:" class="btn btn-warning sort-handle btn-xs"><i class="icon-move"></i>
                    移动
                </a>
            </div>
        </li>
    </script>


    <!-- 分页 -->
    <link href="/Application/Admin/Static/zui/lib/datetimepicker/datetimepicker.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/Application/Admin/Static/zui/lib/datetimepicker/datetimepicker.min.js"></script>

    <script>
        var builder = {
            'uploaders': [],
            'index': 1,
            'sortable': function () {
                $('#data-table').sortable({
                    trigger: '.sort-handle', selector: 'li', dragCssClass: '', finish: function () {
                        // builder.sortable();
                        builder.refresh_order();

                    }
                });
            },
            'refresh_order': function () {
                $('#data-table li').each(function (index, element) {
                    $(this).attr('data-order', index);
                    $(this).find('input[name*=sort]').val($(this).attr('data-order'));
                })
            },
            'init': function () {
                var $html = $($('#line-tpl').html());
                $('#data-table').html($html);
                builder.createWebUpload($html, $html);
                initTimePicker();

                builder.sortable();
                builder.refresh_order();
            },
            'add': function (obj) {
                var $this = $(obj);
                var $html = $($('#line-tpl').html());
                $html.insertAfter($this.parent().parent());
                builder.createWebUpload($html, $this.parent().parent());
                initTimePicker();

                builder.sortable();
                builder.refresh_order();
                bind_time_change();

            },
            'remove': function (obj) {
                $(obj).parent().parent().remove();
                builder.sortable();
                builder.refresh_order();

            },
            'createWebUpload': function ($html, $parent_parent) {
                var id = builder.index++;
                $html.find('div:eq(0)').html(
                        ' <span id="web_uploader_wrapper_' + id + '">选择图片</span>\
                <input id="web_uploader_input_' + id + '" name="pic[]" type="hidden" value=""\
                event-node="uploadinput">\
                <div id="web_uploader_picture_list_' + id + '" class="web_uploader_picture_list">\
                </div>'
                );
                $html.insertAfter($parent_parent);
                builder.createUploader(id);
            },
            'createUploader': function (id_origin) {
                var id = "#web_uploader_wrapper_" + id_origin;
                var uploader = WebUploader.create({
                    // swf文件路径
                    swf: 'Uploader.swf',
                    // 文件接收服务端。
                    server: U('Core/File/uploadPicture'),
                    fileNumLimit: 5,
                    // 选择文件的按钮。可选。
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: {'id': id, 'multi': false}
                });

                uploader.on('fileQueued', function (file) {
                    uploader.upload();
                    $("#web_uploader_file_name_" + id_origin).text('正在上传...');
                });

                /*上传成功*/
                uploader.on('uploadSuccess', function (file, ret) {
                    if (ret.status == 0) {
                        $("#web_uploader_file_name_" + id_origin).text(ret.info);
                        toast.error(ret.info);
                    } else {
                        $('#web_uploader_input_' + id_origin).focus();
                        $('#web_uploader_input_' + id_origin).val(ret.data.file.id);
                        $('#web_uploader_input_' + id_origin).blur();

                        $("#web_uploader_picture_list_" + id_origin).html('<img src="' + ret.data.file.path + '"/>');
                    }
                });
                builder.uploaders.push(uploader);
            }
        };


        function initTimePicker() {
            $('.form-datetime').datetimepicker({
                language: "zh-CN",
                autoclose: true,
                format: 'yyyy-mm-dd hh:ii'
            });
            $('.form-date').datetimepicker({
                language: "zh-CN",
                minView: 2,
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('.form-time').datetimepicker({
                language: "zh-CN",
                minView: 0,
                startView: 1,
                autoclose: true,
                format: 'hh:ii'
            });
            bind_time_change();

        }
        function bind_time_change() {
            $('.time').change(function () {
                var dateString = $(this).val();
                var date = new Date(dateString);
                var timestamp = date.getTime();
                $(this).prev().val(Math.floor(timestamp / 1000));
            });
        }
    </script>
    <script>
        $(function () {
            var children = $('#data-table').children();
            if (children.length == 0) {
                builder.init();

            } else {
                for (var i = 0; i < children.length; i++) {
                    builder.createUploader(i + 1);
                }

                builder.index = i + 1;
                initTimePicker();
                bind_time_change();
            }

        })
    </script>

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



</body>
</html>