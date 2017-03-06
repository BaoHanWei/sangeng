<?php if (!defined('THINK_PATH')) exit(); if(!empty($rec_event)): ?><div class="common_block_border event_right">
        <div class="common_block_title_right"> <?php echo L('_EVENT_RECOMMEND_');?></div>

        <div style="padding:0 10px">
            <?php if(is_array($rec_event)): $i = 0; $__LIST__ = $rec_event;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="">
                    <a href="<?php echo U('Event/Index/detail',array('id'=>$vo['id']));?>"> <img style="margin-bottom: 10px;width: 100%"
                                               src="<?php echo (getthumbimagebyid($vo["cover_id"],345,233)); ?>"/></a>
    <span><strong><a href="<?php echo U('Event/Index/detail',array('id'=>$vo['id']));?>"
                     class="text-more" style="width: 100%"><?php echo ($vo["title"]); ?></a></strong><div class="font_grey"
                                                                    style="font-size: 12px;margin-top: -5px;margin-bottom: 10px;">
        <?php echo date('Y-m-d',$vo['sTime']);?>--<?php echo date('Y-m-d',$vo['eTime']);?>
    </div><span
            class="font_grey" style="font-size: 14px;"> </span></span>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

    </div><?php endif; ?>