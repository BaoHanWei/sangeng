<?php if (!defined('THINK_PATH')) exit(); if(!$isLoadScript){ ?>
<script type="text/javascript" charset="utf-8" src="/Public/js/ext/webuploader/js/webuploader.js"></script>
<link href="/Public/js/ext/webuploader/css/webuploader.css" type="text/css" rel="stylesheet">
<?php } ?>
<span id="web_uploader_wrapper_<?php echo ($id); ?>"><?php echo ($config['text']); ?></span>
<input id="web_uploader_input_<?php echo ($id); ?>" name="<?php echo ($name); ?>" type="hidden" value="<?php echo ($value); ?>" event-args="<?php echo ($args); ?>" event-node="uploadinput">
<div id="web_uploader_picture_list_<?php echo ($id); ?>" class="web_uploader_picture_list">
    <?php echo ($img); ?>
</div>
<script>
    $(function () {
        var id = "#web_uploader_wrapper_<?php echo ($id); ?>";
        var uploader_<?php echo ($id); ?>  = WebUploader.create({
            // swf文件路径
            swf: 'Uploader.swf',
            // 文件接收服务端。
            server: U('Core/File/uploadPicture'),
            fileNumLimit: 5,
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {'id': id, 'multi': false}
        });
        uploader_<?php echo ($id); ?>.on('fileQueued', function (file) {
            uploader_<?php echo ($id); ?>.upload();
            $("#web_uploader_file_name_<?php echo ($id); ?>").text('正在上传...');
        });

        /*上传成功*/
        uploader_<?php echo ($id); ?>.on('uploadSuccess', function (file, ret) {
            if (ret.status == 0) {
                $("#web_uploader_file_name_<?php echo ($id); ?>").text(ret.info);
                toast.error(ret.info);
            } else {
                $('#web_uploader_input_<?php echo ($id); ?>').focus();
                $('#web_uploader_input_<?php echo ($id); ?>').val(ret.data.file.id);
                $('#web_uploader_input_<?php echo ($id); ?>').blur();

                $("#web_uploader_picture_list_<?php echo ($id); ?>").html('<img src="' + ret.data.file.path + '"/>');
            }
        });
    });

</script>