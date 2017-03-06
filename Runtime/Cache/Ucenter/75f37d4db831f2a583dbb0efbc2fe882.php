<?php if (!defined('THINK_PATH')) exit();?><style>
    .modal-dialog{
        width: 400px;;
    }
    .uploadify{
        float: left;
    }
    .uploadcover{
        line-height: 21px!important;
    }
</style>
<div class="clearfix">
    <div class="col-xs-12">

        <input type="hidden" name="user_cover" id="user_cover" value="<?php echo ($user_info['cover_id']); ?>"/>
        <div style="color: #999;">
            <?php echo L('_PIC_SUGGEST_');?>
        </div>
        <div class="upload-background-box" style="margin-top: 10px;width: 300px;height: 80px;">
            <?php if($my_cover['cover_id']): ?><div class="upload-pre-item" style="width: 348px;height:70px;"><img class="img-responsive" style="width: 100%;height:100%;" src="<?php echo ($my_cover["cover_path"]); ?>"/></div><?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <input type="file" id="upload_picture_background">
        <?php if($my_cover['cover_id']): ?><div class="btn btn-primary pull-right" id="submit_cover" disabled="disabled" style="width: 100px;"><?php echo L('_SAVE_');?></div>
            <?php else: ?>
            <div class="btn btn-primary pull-right" id="submit_cover" disabled="disabled" style="width: 100px;display: none;"><?php echo L('_SAVE_');?></div><?php endif; ?>

    </div>
</div>


<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
<script>
    $("#upload_picture_background").uploadify({
        "swf": "/Public/static/uploadify/uploadify.swf",
        "fileObjName": "download",
        "buttonText": "<?php echo L('_COVER_UPLOAD_');?>",
        "buttonClass": "btn btn-primary uploadcover",
        "uploader": "<?php echo U('Core/File/uploadPicture',array('session_id'=>session_id(),'width'=>'348','height'=>'70'));?>",
        "width": 100,
        "height":32,
        'removeTimeout': 1,
        'fileTypeExts': '*.jpg; *.png; *.gif;',
        "onUploadSuccess": uploadPicturecover,
        'overrideEvents': ['onUploadProgress', 'onUploadComplete', 'onUploadStart', 'onSelect'],
        'onFallback': function () {
            alert("<?php echo L('_FLASH_BAD_');?>");
        }, 'onUploadProgress': function (file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
            $("#cover_id_cover").parent().find('.upload-img-box').html(totalBytesUploaded + ' bytes uploaded of ' + totalBytesTotal + ' bytes.');
        }, 'onUploadComplete': function (file) {
            //alert('The file ' + file.name + ' finished processing.');
        }, 'onUploadStart': function (file) {
            //alert('Starting to upload ' + file.name);
        }, 'onQueueComplete': function (queueData) {
            // alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
        }
    });
    function uploadPicturecover(file, data) {
        var data = $.parseJSON(data);
        var src = '';
        if (data.status) {
            $("#user_cover").val(data.id);
            src = data.url || data.path_self
            $('.upload-background-box').html(
                    '<div class="upload-pre-item" style="width: 348px;height:70px;"><img class="img-responsive" style="width: 100%;height:100%;" src="' + src + '"/></div>'
            );
            $('#submit_cover').attr('disabled',false);
            $('#submit_cover').show();
        } else {
            $('#submit_cover').hide();
            toast.error("<?php echo L('_SUCCESS_COVER_SELECT_'); echo L('_PERIOD_');?>", "<?php echo L('_TIP_GENTLE_');?>");
        }
    }
    $('#submit_cover').click(function () {
        var cover_id = $('#user_cover').val();
        $.post(U('Ucenter/Public/changeCover'), {cover_id: cover_id}, function (msg) {
            if (msg.status == 1) {
                $('.uc_top_img_bg').attr('src', msg.path_1140);
                $('.uc_top_img_bg_weibo').attr('src', msg.path_273);
                $('.close').click();
                toast.success("<?php echo L('_SUCCESS_COVER_CHANGE_'); echo L('_EXCLAMATION_');?>");
            } else {
                handleAjax(msg)
            }
        });
    });
</script>