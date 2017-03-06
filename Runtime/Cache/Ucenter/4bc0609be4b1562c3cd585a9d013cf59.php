<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" charset="utf-8" src="/Public/js/ext/webuploader/js/webuploader.js"></script>
<link href="/Public/js/ext/webuploader/css/webuploader.css" type="text/css" rel="stylesheet">

    <style>
        .jcrop-holder > div > div {
            border-radius: 100%;
        }
        .jcrop-holder img {
            max-width: none;
        }
        .jcrop-holder .avatar_select{margin-top: -10px;margin-left: -10px;}
    </style>

<div style="height: 600px;">
<div id="uploader-demo">
    <!--用来存放item-->
    <div id="fileList" class="uploader-list"></div>
    <div id="upload_avatar_<?php echo ($uid); ?>" style="padding: 20px 0"><?php echo L('_AVATAR_SELECT_');?></div>
    <div class="show_avatar">
        <div class="col-xs-4 avatar_select" >
            <div id="avatar_<?php echo ($uid); ?>_original">
                <img class="avatar-img"  src="<?php echo ($user["avatar256"]); ?>" style=""/>
            </div>
            <div class="pull-left avatar_256 text-center avatar_select" id="avatar_<?php echo ($uid); ?>_256" style="padding-bottom: 49px;">
                <div class="" style="margin-bottom: 20px;">
                    <img class="avatar-img"  src="<?php echo ($user["avatar256"]); ?>">
                </div>
                <p><?php echo L('_AVATAR_BIG_');?></p>
                <p> 256*256</p>
            </div>
            <div class="pull-left avatar_128 text-center avatar_select" id="avatar_<?php echo ($uid); ?>_128" style="">
                <div class="" style="margin-bottom: 20px;">
                    <img class="avatar-img"  src="<?php echo ($user["avatar128"]); ?>">
                </div>
                <p><?php echo L('_AVATAR_MIDDLE_');?></p>
                <p> 128*128</p>
            </div>
            <div class="pull-left avatar_64 text-center avatar_select" id="avatar_<?php echo ($uid); ?>_64" style="padding: 10px 41px;">
                <div class="" style="margin-bottom: 20px;">
                    <img class="avatar-img" src="<?php echo ($user["avatar64"]); ?>">
                </div>
                <p style="width: 66px;"><?php echo L('_AVATAR_SMALL_');?></p>
                <p>64*64</p>
            </div>
            <input class="btn btn-default avatar_btn" data-role="avatar_btn"  type="button" value="<?php echo L('_AVATAR_SAVE_');?>"/>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="/Public/static/jcrop/jquery.Jcrop.css"/>
<script src="/Public/static/jcrop/jquery.Jcrop.js"></script>
<script src="/Public/static/browser/jquery.browser.js"></script>
<script>
    $(function () {
        var crop;
        var jcrop_api;
        var ext;
        var boundx, boundy,
                $preview = $('.avatar_256'),
                $preview_128 = $('.avatar_128'),
                $preview_64 = $('.avatar_64'),
                $pcnt = $('.avatar_256 div'),
                $pimg = $('.avatar_256 div img'),
                $pcnt_128 = $('.avatar_128 div'),
                $pimg_128 = $('.avatar_128 div img'),
                $pcnt_64 = $('.avatar_64 div'),
                $pimg_64 = $('.avatar_64 div img');
        var path;
        var uploader_<?php echo ($uid); ?>= WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: 'Uploader.swf',
            // 文件接收服务端。
            server: "<?php echo U('Core/File/uploadAvatar',array('uid'=>$uid));?>",
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#upload_avatar_<?php echo ($uid); ?>',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader_<?php echo ($uid); ?>.on('fileQueued', function (file) {
            uploader_<?php echo ($uid); ?>.upload();
            toast.showLoading();
        });
        /*上传成功*/
        uploader_<?php echo ($uid); ?>.on('uploadSuccess', function (file, ret) {
            toast.hideLoading();
            if (ret.status == 0) {
                toast.error(ret.info);
            } else {
               // $("#avatar_" + "<?php echo ($uid); ?>" + "_original img").attr('src', ret.data.file.path );
                ext = ret.data.file.ext;
                path = ret.data.file.path;
                var src = ret.data.file.src+'?time='+ret.data.file.time;
                $("#avatar_" + "<?php echo ($uid); ?>" + "_original").html('');
                $("#avatar_" + "<?php echo ($uid); ?>" + "_original").html('<img src="'+src+'">');
                $pimg.attr('src', src)
                $pimg_128.attr('src', src)
                $pimg_64.attr('src', src)
                $("#avatar_" + "<?php echo ($uid); ?>" + "_original img").load(function () {
                    $("#avatar_" + "<?php echo ($uid); ?>" + "_original >img").Jcrop({
                        aspectRatio: 1,
                        onChange: updateCoordinate,
                        onSelect: updateCoordinate,
                        minSize: [10, 10],
                        setSelect: [0, 0, 256, 256]
                    }, function () {
                        var bounds = this.getBounds();
                        boundx = bounds[0];
                        boundy = bounds[1];
                        jcrop_api = this;
                        $preview.appendTo(jcrop_api.ui.holder);
                        $preview_128.appendTo(jcrop_api.ui.holder);
                        $preview_64.appendTo(jcrop_api.ui.holder);
                        crop = jcrop_api.tellScaled();
                        updateCoordinate(crop);
                    });
                })
                //重置队列
                uploader_<?php echo ($uid); ?>.reset();
            }
        });
        function updateCoordinate(c) {
            crop = c;
            if (parseInt(c.w) > 0) {
                var xsize = $pcnt.width();
                var ysize = $pcnt.height();
                var rx = xsize / c.w ;
                var ry = ysize / c.h ;
                $pimg.css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
                var xsize_128 = $pcnt_128.width();
                var ysize_128 = $pcnt_128.height();
                var rx_128 = xsize_128 / c.w;
                var ry_128 = ysize_128 / c.h;
                $pimg_128.css({
                    width: Math.round(rx_128 * boundx) + 'px',
                    height: Math.round(ry_128 * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx_128 * c.x) + 'px',
                    marginTop: '-' + Math.round(ry_128 * c.y) + 'px'
                });

                var xsize_64 = $pcnt_64.width() ;
                var ysize_64 = $pcnt_64.height() ;
                var rx_64 = xsize_64 / c.w;
                var ry_64 = ysize_64 / c.h;
                $pimg_64.css({
                    width: Math.round(rx_64 * boundx) + 'px',
                    height: Math.round(ry_64 * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx_64 * c.x) + 'px',
                    marginTop: '-' + Math.round(ry_64 * c.y) + 'px'
                });


            }
        }
        $('[data-role=avatar_btn]').click(function(){
            //检查是否已经裁剪过
            if (typeof (crop) == 'undefined') {
                toast.error("<?php echo L('_AVATAR_UPLOAD_AND_CROP_');?>");
                return;
            }
            else{
                var crop2 = crop.x / boundx + ',' + crop.y / boundy + ',' + crop.w / boundx + ',' + crop.h / boundy;
            }
            var uid ='<?php echo ($uid); ?>';
            //提交到服务器
            var url = "<?php echo U('ucenter/member/saveAvatar');?>";

            $.post(url, {uid: uid, crop: crop2,path:path}, function (res) {
                     handleAjax(res);
            });

        })
    })
</script>
</div>