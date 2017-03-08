<?php if (!defined('THINK_PATH')) exit(); if($lists != false): ?><div class="tjyd">
    <div class="box_tit border_t">
        <h3>热门资讯</h3>
    </div>
    <div class="box_con">
        <ul class="txt_li_t clearfix">
            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('News/index/detail',array('id'=>$data['id']));?>" title="<?php echo ($data["title"]); ?>"><?php echo ($data["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div><?php endif; ?>

<!--<?php if($lists != false): ?><div class="common_block_border blog_position">
        <div class="common_block_title">
            <?php if(($category) != ""): echo L('_HOT_CATEGORY_');?>
                <?php else: ?>
                <?php echo L('_HOT_SITE_'); endif; ?>
        </div>
        <div style="height:15px;"></div>
        <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="clearfix" style="position: relative;">
                <div class="col-xs-12">
                    <div>
                        <h3 class="margin-top-0 text-more" style="width: 100%;font-size: 15px;margin-bottom:0px"><a title="<?php echo (op_t($data["title"])); ?>" href="<?php echo U('News/index/detail',array('id'=>$data['id']));?>"><?php echo ($data["title"]); ?></a></h3>
                    </div>
                    <div style="font-size:12px;">
                        <span class="author" style="color:#898989"><?php echo (date('m-d H:i',$data["create_time"])); ?></span>&nbsp;&nbsp;&nbsp;<span style="color:#898989">阅读(<?php echo ($data["view"]); ?>)</span>
                    </div>
                </div>
            </div>
            <?php if($i == count($lists)): ?><div style="margin: 15px"></div>
                <?php else: ?>
                <div style="border-bottom: 1px dashed rgb(204, 204, 204);margin:5px"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div><?php endif; ?>-->