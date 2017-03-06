<?php if (!defined('THINK_PATH')) exit();?><div style="margin-top:20px">
    <?php if(!$top_list&&!$list): ?><p class="text-muted" style="text-align: center; font-size: 3em;">
            <br><br>
            <?php echo L('_EMPTY_NOW_');?>
            <br><br><br>
        </p><?php endif; ?>
    <style>
        .weibo_icon {
            border: 1px solid #f0f0f0;
            border-right: none;
        }
        .tweet-item{
			    padding: 20px 0 10px;
    			border-bottom: 1px solid #eee;
        }
    </style>
    <link href="/Application//Weibo/Static/css/weibo.css" type="text/css" rel="stylesheet"/>
    <div id="top_list">
        <?php if(is_array($top_list)): $i = 0; $__LIST__ = $top_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$top): $mod = ($i % 2 );++$i; echo W('Weibo/WeiboDetail/detail',array('weibo_id'=>$top)); endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div id="weibo_list">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i; echo W('Weibo/WeiboDetail/detail',array('weibo_id'=>$weibo)); endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div id="index_weibo_page">
        <div class="text-right">
            <?php echo getPagination($total_count,10);?>
        </div>
    </div>
    <script>
        var SUPPORT_URL = "<?php echo addons_url('Support://Support/doSupport');?>";
        var THIS_MODEL_NAME = 'Weibo';
        $(function () {
                    $('.pswp__ui--hidden').hide();
                }
        );
    </script>
    <link rel="stylesheet" href="/Application/Weibo/Static/css/photoswipe.css">
    <link rel="stylesheet" href="/Application/Weibo/Static/css/default-skin/default-skin.css">
    <script src="/Application/Weibo/Static/js/photoswipe.min.js"></script>
    <script src="/Application/Weibo/Static/js/photoswipe-ui-default.min.js"></script>
    <script src="/Application/Weibo/Static/js/weibo.js"></script>
</div>