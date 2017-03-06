<?php if (!defined('THINK_PATH')) exit(); if(!$isLoadScript){ ?>
<script type="text/javascript" charset="utf-8" src="/Public/js/ext/webuploader/js/webuploader.js"></script>
<link href="/Public/js/ext/webuploader/css/webuploader.css" type="text/css" rel="stylesheet">
<?php } ?>


<div class="controls multiImage">
    <div id="web_uploader_wrapper_<?php echo ($id); ?>" style="padding-bottom: 5px;"><?php echo ($config['text']); ?></div>
    <input class="attach" type="hidden" name="<?php echo ($id); ?>" value="<?php echo ($value); ?>"/>
    <div class="upload-img-box">
        <!--<div class="progress progress-striped active">-->
           <!--<div class="progress-bar" role="progressbar" style="width: 0%">-->
                <!--</div>-->
        <div class="upload-pre-item popup-gallery" style=" width: 325px;">
            <?php if(is_array($images)): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo) != ""): ?><div class="each">
                        <a href="<?php echo (get_cover($vo,'path')); ?>" title="点击查看大图">
                            <img src="<?php echo (thumb($vo,$width,$height)); ?>"></a>
                        <div class="text-center opacity del_btn width"></div>
                        <div onclick="image_upload.removeImage($(this),<?php echo ($vo); ?>)" class="text-center del_btn " >删除</div></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
<script>
    $(function () {
        var id = "#web_uploader_wrapper_<?php echo ($id); ?>";
        var limit = parseInt('<?php echo ($limit); ?>');
        var uploader_<?php echo ($id); ?>  = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: 'Uploader.swf',
            // 文件接收服务端。
            server: U('Core/File/uploadPicture'),

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {'id': id, 'multi': true},
            fileNumLimit: limit,
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader_<?php echo ($id); ?>.on( 'fileQueued', function( file ) {
       //     uploader_<?php echo ($id); ?>.upload();
        var $li = $(
                        '<div id="' + file.id + '" class="file-item'+file.id+' thumbnail each">' +
                        '<img>' +
                        '</div>'
                ),
                $img = $li.find('img');


        // $list为容器jQuery实例
            $("[name='<?php echo ($id); ?>']").parent().find('.upload-pre-item').append( $li );

        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader_<?php echo ($id); ?>.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }
            $img.attr( 'src', src );
        }, 500, 500 );

    });
//      uploader_<?php echo ($id); ?>.on('fileQueued', function (file) {
//            uploader_<?php echo ($id); ?>.upload();
//            $("#web_uploader_file_name_<?php echo ($id); ?>").text('正在上传...');
//
//
//        });



        // 文件上传过程中创建进度条实时显示。
        uploader_<?php echo ($id); ?>.on( 'uploadProgress', function( file, percentage ) {

            var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress .progress-bar');

            if ( !$percent.length ) {
                $percent = $('<div class="progress progress-striped active opacity del_btn" style="width: 100px">' +
                '<div class="progress-bar  text-center del_btn" data-role="progressbar'+file.id+'" style="top:30px" ">'+Math.round(percentage* 100)  + '%' +
                '</div>' +
                '</div>').appendTo( $li ).find('.progress-bar');
            }

            $('[data-role="progressbar'+file.id+'"]').html( Math.round(percentage* 100) + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader_<?php echo ($id); ?>.on('uploadSuccess', function (file, ret) {
            if (ret.status == 0) {
                $("#web_uploader_file_name_<?php echo ($id); ?>").text(ret.info);
                toast.error(ret.info);
            } else {
                var data = ret.data.file;
                var ids = $("[name='<?php echo ($id); ?>']").val();
                ids = ids.split(',');
                if( ids.indexOf(data.id) == -1){
                    var rids = upAttachVal('add',data.id, $("[name='<?php echo ($id); ?>']").parents('.controls').find('.attach'));
                    if(rids.length>limit){
                        toast.error("<?php echo L('_PIC_LIMIT_OVERLOAD_');?>");
                        return;
                    }

                    //$("[name='<?php echo ($id); ?>']").parent().find('.upload-pre-item').append(
                  //          ' <div class="each"><a href="'+ data.path+'" title="'+"<?php echo L('_PIC_CLICK_TO_VIEW_BIGGER_');?>"+'"><img src="'+ data.path+'"></a><div class="text-center opacity del_btn" ></div>' +
                  //  '<div onclick="image_upload.removeImage($(this),'+data.id+')"  class="text-center del_btn"><?php echo L("_DELETE_");?></div></div>'
                  //  $('[data-role="progressbar"]').html('<div onclick="image_upload.removeImage($(this),'+data.id+')"'+ '删除'+'</div>');
                    $('[data-role="progressbar'+file.id+'"]').html('  <a style="color:#ffffff" href="javascript:void(0);" onclick="image_upload.removeImage($(this),'+data.id+')">'+'删除'+'</a>');

              //      );
                    imageUpload.callback();

                }else{
                    $("[name='<?php echo ($id); ?>']").parent().find('.file-item'+file.id+'').remove();
                    toast.error("<?php echo L('_PIC_ALREADY_EXIST_');?>");
                }

            }
        });

// 文件上传失败，显示上传出错。
        uploader_<?php echo ($id); ?>.on( 'uploadError', function( file ) {
            var $li = $( '#'+file.id ),
                    $error = $li.find('div.error');
            // 避免重复创建
            if ( !$error.length ) {
                $error = $('<div class="error"></div>').appendTo( $li );
            }

            $error.text('上传失败');
        });


//        uploader_<?php echo ($id); ?>.on('uploadFinished', function (file) {
//            uploader_<?php echo ($id); ?>.reset();
//        });
        /*上传成功*/

        uploader_<?php echo ($id); ?>.on('uploadFinished', function (file) {
            uploader_<?php echo ($id); ?>.reset();
        });

        uploader_<?php echo ($id); ?>.on( 'uploadComplete', function( file ) {
          //  $( '#'+file.id ).find('.progress').remove();
          //  $("[name='<?php echo ($id); ?>']").parent().find('.file-item').remove();

        });
    });


    image_upload = {
        removeImage: function (obj, attachId) {
            // 移除附件ID数据
            upAttachVal('del', attachId,obj.parents('.controls').find('.attach'));
            obj.parents('.each').remove();
            imageUpload.removeCallback();

        }
    }




</script>