<?php if (!defined('THINK_PATH')) exit();?><link href="/Application/Weibo/Static/css/weibo.css" type="text/css" rel="stylesheet"/>
<div class="block-bar">
    <div class="container">
        <div class="block-body row">
            <div class="col-xs-6">
                <div class="common-block">
                    <h2>
                        <?php echo modC('WEIBO_SHOW_TITLE1',L('_NEWEST_WEIBO_'),'Weibo');?>
                    </h2>
                    <div>
                        <div>
                            <ul id="weibo-list-1" class="weibo-list clearfix">
                                <?php if(is_array($weibo1)): $i = 0; $__LIST__ = $weibo1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i;?><div class="row" id="weibo_<?php echo ($weibo["id"]); ?>">
                                        <div class="col-xs-12">
                                            <div class="col-md-12 weibo_content" style="padding: 0;position:relative;">
                                                <div class="" style="padding: 10px 10px 5px 10px">
                                                    <div class="col-md-2 col-sm-2 col-xs-12 text-center" style="position: relative;padding: 0px">
                                                        <a class="s_avatar" href="<?php echo ($weibo["user"]["space_url"]); ?>" ucard="<?php echo ($weibo["user"]["uid"]); ?>">
                                                            <img src="<?php echo ($weibo["user"]["avatar512"]); ?>" class="avatar-img" style="width: 64px;"/>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-10" style="padding: 5px">

                                                        <p>
                                                            <?php if(modC('SHOW_TITLE',1)): ?><small class="font_grey">【<?php echo ($weibo["user"]["title"]); ?>】</small><?php endif; ?>
                                                            <a ucard="<?php echo ($weibo["user"]["uid"]); ?>" href="<?php echo ($weibo["user"]["space_url"]); ?>" class="user_name">
                                                                <?php echo (htmlspecialchars($weibo["user"]["nickname"])); ?>
                                                            </a>
                                                            <?php echo W('Common/UserRank/render',array($weibo['uid']));?>
                                                        </p>
                                                        <div class="weibo_content_p">
                                                            <?php echo ($weibo["fetchContent"]); ?>
                    <span>
                        <a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>"><?php echo (friendlydate($weibo["create_time"])); ?></a>
                    </span>
                                                            &nbsp;&nbsp;<span><?php echo L('_FROM_');?> <?php if($weibo['from'] == ''): echo L('_WEBSITE_SIDE_');?> <?php else: ?><strong><?php echo ($weibo["from"]); ?></strong><?php endif; ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                    </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>


                            </ul>
<script>
    $(function(){
        $('#weibo-list-1').slimScroll({
            height: '600px'
        });
        $('#weibo-list-2').slimScroll({
            height: '600px'
        });
        $('.pswp__ui--hidden').hide();
    });

</script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="common-block">
                    <h2>
                        <?php echo modC('WEIBO_SHOW_TITLE2',L('_HOT_WEIBO_'),'Weibo');?>
                    </h2>

                    <div>
                        <div>
                            <ul id="weibo-list-2" class="weibo-list clearfix">
                                <?php if(is_array($weibo2)): $i = 0; $__LIST__ = $weibo2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i;?><div class="row" id="weibo_<?php echo ($weibo["id"]); ?>">
                                        <div class="col-xs-12">
                                            <div class="col-md-12 weibo_content" style="padding: 0;position:relative;">
                                                <div class="" style="padding: 10px 10px 5px 10px">
                                                    <div class="col-md-2 col-sm-2 col-xs-12 text-center" style="position: relative;padding: 0px">
                                                        <a class="s_avatar" href="<?php echo ($weibo["user"]["space_url"]); ?>" ucard="<?php echo ($weibo["user"]["uid"]); ?>">
                                                            <img src="<?php echo ($weibo["user"]["avatar512"]); ?>" class="avatar-img" style="width: 64px;"/>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-10" style="padding: 5px">

                                                        <p>
                                                            <?php if(modC('SHOW_TITLE',1)): ?><small class="font_grey">【<?php echo ($weibo["user"]["title"]); ?>】</small><?php endif; ?>
                                                            <a ucard="<?php echo ($weibo["user"]["uid"]); ?>" href="<?php echo ($weibo["user"]["space_url"]); ?>" class="user_name">
                                                                <?php echo (htmlspecialchars($weibo["user"]["nickname"])); ?>
                                                            </a>
                                                            <?php echo W('Common/UserRank/render',array($weibo['uid']));?>
                                                        </p>
                                                        <div class="weibo_content_p">
                                                            <?php echo ($weibo["fetchContent"]); ?>
                    <span>
                        <a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>"><?php echo (friendlydate($weibo["create_time"])); ?></a>
                    </span>
                                                            &nbsp;&nbsp;<span><?php echo L('_FROM_');?> <?php if($weibo['from'] == ''): echo L('_WEBSITE_SIDE_');?> <?php else: ?><strong><?php echo ($weibo["from"]); ?></strong><?php endif; ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<script>
    $(function () {
        ucard();
        bind_weibo_popup();
    })

</script>
<link rel="stylesheet" href="/Application/Weibo/Static/css/photoswipe.css">
<link rel="stylesheet" href="/Application/Weibo/Static/css/default-skin/default-skin.css">
<script src="/Application/Weibo/Static/js/photoswipe.min.js"></script>
<script src="/Application/Weibo/Static/js/photoswipe-ui-default.min.js"></script>
<script src="/Application/Weibo/Static/js/weibo.js"></script>