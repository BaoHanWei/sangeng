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
        <h2><?php echo L("_WEB_SITE_SETTINGS_");?></h2>
    </div>
    <div class="tab-wrap with-padding">
        <ul class="nav nav-secondary">
            <?php if(is_array(C("CONFIG_GROUP_LIST"))): $i = 0; $__LIST__ = C("CONFIG_GROUP_LIST");if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li
                <?php if(($id) == $key): ?>class="active"<?php endif; ?>
                ><a href="<?php echo U('?id='.$key);?>"><?php echo ($group); echo L("_TO_CONFIGURE_");?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>

    </div>
    <div class="tab-content with-padding">
    <div class="col-md-12">
        <form action="<?php echo U('save');?>" method="post" class="form-horizontal">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$config): $mod = ($i % 2 );++$i;?><div class="form-item">
                    <label class="item-label"><?php echo ($config["title"]); ?><span class="check-tips">（<?php echo ($config["remark"]); ?>）</span>
                    </label>

                    <div class="controls">
                        <?php switch($config["type"]): case "0": ?><input type="text" class="text input-small form-control" name="config[<?php echo ($config["name"]); ?>]" style="width: 180px"
                                       value="<?php echo ($config["value"]); ?>"><?php break;?>
                            <?php case "1": ?><input type="text" class="text input-large form-control" name="config[<?php echo ($config["name"]); ?>]" style="width: 400px"
                                       value="<?php echo ($config["value"]); ?>"><?php break;?>
                            <?php case "2": ?><label class="textarea input-large">
                                    <textarea name="config[<?php echo ($config["name"]); ?>]" class="form-control" style="width: 400px;height: 200px" ><?php echo ($config["value"]); ?></textarea>
                                </label><?php break;?>
                            <?php case "3": ?><label class="textarea input-large">
                                    <textarea name="config[<?php echo ($config["name"]); ?>]" class="form-control" style="width: 400px;min-height: 120px;" ><?php echo ($config["value"]); ?></textarea>
                                </label><?php break;?>
                            <?php case "4": ?><select name="config[<?php echo ($config["name"]); ?>]" class="form-control" style="width: auto">
                                    <?php $_result=parse_config_attr($config['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"
                                        <?php if(($config["value"]) == $key): ?>selected<?php endif; ?>
                                        ><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select><?php break;?>
                            <?php case "5": ?><!--增加富文本和非明文-->

                                <?php echo W('Common/Ueditor/editor',array($config['name'],'config['.$config['name'].']',$config['value'],'500px','300px')); break;?>
                            <?php case "6": ?><input type="password" class="text input-large form-control" style="width:400px;" name="config[<?php echo ($config["name"]); ?>]" autoComplete="off"
                                       value="<?php echo ($config["value"]); ?>"><?php break;?>
                            <?php case "7": ?><script type="text/javascript" charset="utf-8" src="/Public/js/ext/webuploader/js/webuploader.js"></script>
                                <link href="/Public/js/ext/webuploader/css/webuploader.css" type="text/css" rel="stylesheet">
                                <div class="controls">
                                    <div id="upload_single_image_<?php echo ($config["name"]); ?>" style="padding-bottom: 5px;"><?php echo L("_SELECT_PICTURES_");?></div>
                                    <input class="attach" type="hidden" name="config[<?php echo ($config["name"]); ?>]" value="<?php echo ($config['value']); ?>"/>
                                    <div class="upload-img-box">
                                        <div class="upload-pre-item popup-gallery">
                                            <?php if(!empty($config["value"])): ?><div class="each">
                                                    <a href="<?php echo (get_cover($config["value"],'path')); ?>" title=<?php echo L("_CLICK_TO_SEE_THE_BIG_PICTURE_WITH_DOUBLE_");?>>
                                                        <img src="<?php echo (get_cover($config["value"],'path')); ?>">
                                                    </a>
                                                    <div class="text-center opacity del_btn" ></div>
                                                    <div onclick="admin_image.removeImage($(this),'<?php echo ($config["value"]); ?>')"  class="text-center del_btn"><?php echo L("_DELETE_");?></div>
                                                </div><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(function () {
                                        var uploader_<?php echo ($config["name"]); ?>= WebUploader.create({
                                            // 选完文件后，是否自动上传。
                                            auto: true,
                                            // sw<?php echo L("_F_FILE_PATH_");?>
                                            swf: 'Uploader.swf',
                                            // 文件接收服务端。
                                            server: "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
                                            // 选择文件的按钮。可选。
                                            // 内部根据当前运行是创建，可能是input元素，<?php echo L("_AND_IT_COULD_BE_FLASH_");?>.
                                            pick: '#upload_single_image_<?php echo ($config["name"]); ?>',
                                            // 只允许<?php echo L("_SELECT_PICTURES_");?>文件。
                                            accept: {
                                                title: 'Images',
                                                extensions: 'gif,jpg,jpeg,bmp,png',
                                                mimeTypes: 'image/*'
                                            }
                                        });
                                        uploader_<?php echo ($config["name"]); ?>.on('fileQueued', function (file) {
                                            uploader_<?php echo ($config["name"]); ?>.upload();
                                        });
                                        /*<?php echo L("_UPLOAD_SUCCESS_");?>*/
                                        uploader_<?php echo ($config["name"]); ?>.on('uploadSuccess', function (file, data) {
                                            if (data.status) {
                                                $("[name='config[<?php echo ($config["name"]); ?>]']").val(data.id);
                                                $("[name='config[<?php echo ($config["name"]); ?>]']").parent().find('.upload-pre-item').html(
                                                        ' <div class="each"><a href="'+ data.path+'" title=<?php echo L("_CLICK_TO_SEE_THE_BIG_PICTURE_WITH_DOUBLE_");?>><img src="'+ data.path+'"></a><div class="text-center opacity del_btn" ></div>' +
                                                                '<div onclick="admin_image.removeImage($(this),'+data.id+')"  class="text-center del_btn"><?php echo L("_DELETE_");?></div></div>'
                                                );
                                                uploader_<?php echo ($config["name"]); ?>.reset();
                                            } else {
                                                updateAlert(data.info);
                                                setTimeout(function () {
                                                    $('#top-alert').find('button').click();
                                                    $(that).removeClass('disabled').prop('disabled', false);
                                                }, 1500);
                                            }
                                        });
                                    })
                                </script><?php break;?>


                            <?php case "8": $config['value_array'] = explode(',', $config['value']); $config['extra'] = explode("\r\n", $config['extra']); $config['opt'] = array(); foreach( $config['extra'] as &$val){ $val = explode(':', $val); $config['opt'][$val[0]] = $val[1]; } ?>
                                <?php if(is_array($config["opt"])): $i = 0; $__LIST__ = $config["opt"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i; $checked = in_array($key,$config['value_array']) ? 'checked' : ''; $inputId = "id_$config[name]_$key"; ?>
                                    <label for="<?php echo ($inputId); ?>">
                                        <input type="checkbox" value="<?php echo ($key); ?>" id="<?php echo ($inputId); ?>" class="oneplus-checkbox" data-field-name="<?php echo ($config["name"]); ?>" <?php echo ($checked); ?>/>
                                        <?php echo (htmlspecialchars($option)); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
                                <input type="hidden" name="config[<?php echo ($config["name"]); ?>]" class="oneplus-checkbox-hidden"
                                       data-field-name="<?php echo ($config["name"]); ?>" value="<?php echo ($config["value"]); ?>"/>

                                    <script>
                                        $(function () {
                                            function implode(x, list) {
                                                var result = "";
                                                for (var i = 0; i < list.length; i++) {
                                                    if (result == "") {
                                                        result += list[i];
                                                    } else {
                                                        result += ',' + list[i];
                                                    }
                                                }
                                                return result;
                                            }

                                            $('.oneplus-checkbox').change(function (e) {
                                                var fieldName = $(this).attr('data-field-name');
                                                var checked = $('.oneplus-checkbox[data-field-name=' + fieldName + ']:checked');
                                                var result = [];
                                                for (var i = 0; i < checked.length; i++) {
                                                    var checkbox = $(checked.get(i));
                                                    result.push(checkbox.attr('value'));
                                                }
                                                result = implode(',', result);
                                                $('.oneplus-checkbox-hidden[data-field-name=' + fieldName + ']').val(result);
                                            });
                                        })
                                    </script><?php break; endswitch;?>

                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="form-item">
                <label class="item-label"></label>

                <div class="controls">
                    <?php if(empty($list)): ?><button type="submit" disabled class="btn submit-btn disabled"
                                target-form="form-horizontal"><?php echo L("_SURE_WITH_SPACE_");?>
                        </button>
                        <?php else: ?>
                        <button type="submit" class="btn submit-btn ajax-post" target-form="form-horizontal"><?php echo L("_SURE_WITH_SPACE_");?>
                        </button><?php endif; ?>

                    <button class="btn btn-return" onclick="javascript:history.back(-1);return false;"><?php echo L("_RETURN_WITH_SPACE_");?></button>
                </div>
            </div>
        </form>
    </div>

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





</body>
</html>