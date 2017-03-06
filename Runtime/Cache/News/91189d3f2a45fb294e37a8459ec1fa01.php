<?php if (!defined('THINK_PATH')) exit();?><div id="adv_<?php echo ($pos["id"]); ?>" class="adv-wrap" style="padding: <?php echo ($pos["padding"]); ?>;margin:<?php echo ($pos["margin"]); ?>;">
    <div class="text-left " style="width:<?php echo ($pos["width"]); ?>;height:<?php echo ($pos["height"]); ?>;">
        <?php if(count($list) > 0): switch($pos["style"]): case "2": ?><script src="/Public/js/ext/kinmaxshow/js/kinmaxshow.min.js"></script>
                    <div style="width:<?php echo ($pos["width"]); ?>;height:<?php echo ($pos["height"]); ?>">
                        <div id="slide_<?php echo ($pos["id"]); ?>" style="display: none">
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div>
                                    <a href="<?php echo ($vo["url"]); ?>" target="_blank" title="<?php echo ($vo["title"]); ?>">
                                        <img style="width:<?php echo ($pos["width"]); ?>;height:<?php echo ($pos["height"]); ?>;" src="<?php echo (pic($vo["pic"])); ?>"
                                             alt="<?php echo ($vo["title"]); ?>" class="img-responsive" >
                                    </a>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            var h_s = "<?php echo ($pos["height"]); ?>";
                            $("#slide_<?php echo ($pos["id"]); ?>").kinMaxShow({height: h_s});
                            $("#slide_<?php echo ($pos["id"]); ?>").fadeIn();
                        })
                    </script><?php break;?>
                <?php default: ?>
                <script src="/Public/js/ext/touchslide/js/jquery.touchSlider.js"></script>
                <link href="/Public/js/ext/touchslide/css/touchslider.css" rel="stylesheet" type="text/css"/>
                <div class="main_visual"  style="height: <?php echo ($pos["height"]); ?>;width:<?php echo ($pos["width"]); ?>;display: none">
                    <div class="flicking_con">
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#"></a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="main_image" >
                        <ul>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a style="width:<?php echo ($pos["width"]); ?>;height:<?php echo ($pos["height"]); ?>;" href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["title"]); ?>" target="_blank"><img  style="width:<?php echo ($pos["width"]); ?>;height:<?php echo ($pos["height"]); ?>;"
                                                                                                                                                   src="<?php echo (pic($vo["pic"])); ?>"
                                        alt="<?php echo ($vo["title"]); ?>" class="img-responsive"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <a href="javascript:;" id="btn_prev"><i class="icon-chevron-left"></i></a>
                    <a href="javascript:;" id="btn_next"><i class="icon-chevron-right"></i></a>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".main_visual").hover(function () {
                            $("#btn_prev,#btn_next").fadeIn()
                        }, function () {
                            $("#btn_prev,#btn_next").fadeOut()
                        });

                        $dragBln = false;

                        $(".main_image").touchSlider({
                            flexible: true,
                            speed: 1000,
                            btn_prev: $("#btn_prev"),
                            btn_next: $("#btn_next"),
                            paging: $(".flicking_con a"),
                            counter: function (e) {
                                $(".flicking_con a").removeClass("on").eq(e.current - 1).addClass("on");
                            }
                        });
                        $('.main_visual').fadeIn();

                        $(".main_image").bind("mousedown", function () {
                            $dragBln = false;
                        });

                        $(".main_image").bind("dragstart", function () {
                            $dragBln = true;
                        });

                        $(".main_image a").click(function () {
                            if ($dragBln) {
                                return false;
                            }
                        });

                        timer = setInterval(function () {
                            $("#btn_next").click();
                        }, 5000);

                        $(".main_visual").hover(function () {
                            clearInterval(timer);
                        }, function () {
                            timer = setInterval(function () {
                                $("#btn_next").click();
                            }, 5000);
                        });

                        $(".main_image").bind("touchstart", function () {
                            clearInterval(timer);
                        }).bind("touchend", function () {
                            timer = setInterval(function () {
                                $("#btn_next").click();
                            }, 5000);
                        });

                    });
                </script><?php endswitch; endif; ?>

    </div>
    <?php if(check_auth('Admin/Adv/adv') == 1): ?><div class="adv-tool">
            <a target="_blank" href="<?php echo U('Admin/Adv/editPos?id=' . $pos['id']);?>"><i title="设置广告位" class="icon-cog"></i> 设置 </a>
            <a target="_blank" href="<?php echo U('Admin/Adv/adv?pos_id=' . $pos['id']);?>"><i title="管理广告" class="icon-sitemap"></i> 广告 </a>
            <a target="_blank" href="<?php echo U('Admin/Adv/editAdv?pos_id=' . $pos['id']);?>"><i title="新增广告" class="icon-plus"></i> 添加 </a>
        </div>
        <div class="adv-size">
            <?php echo ($pos["title"]); ?>  【<?php echo ($pos["name"]); ?>】: <?php echo ($pos["width"]); ?> * <?php echo ($pos["height"]); ?>
        </div><?php endif; ?>

</div>