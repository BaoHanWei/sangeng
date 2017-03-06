<?php if (!defined('THINK_PATH')) exit();?><div class="common_block_border blog_position">
    <div class="common_block_title" style="margin-top: 0px;">
      <?php echo L("_THIS_KIND_OF_POPULAR_WITH_SPACE_");?>
    </div>
    <?php if(!empty($hot_list)): if(is_array($hot_list)): $i = 0; $__LIST__ = $hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="clearfix" style="position: relative">
                <div class="col-xs-12">
                    <div>
                        <h3 class="text-more" style="width: 90%;font-size:14px;">
                            <a title="<?php echo (op_t($data["title"])); ?>" href="<?php echo U('Question/index/detail',array('id'=>$data['id']));?>"><?php echo ($data["title"]); ?></a>
                        </h3>
                        <span class="pull-right" style="position: absolute;right: 0;bottom: 11px">
			                    &nbsp;&nbsp;
			                    <span title=<?php echo L("_ANSWER_WITH_DOUBLE_");?>><i class="icon-comments-alt"></i>  <?php echo ($data["answer_num"]); ?> </span>
			                    &nbsp;&nbsp;
			                </span>                        <!-- <ins style="text-decoration: none;padding: 3px 0;color: #999;line-height: 25px;">
                            <?php echo ($data["info"]); ?>
                        </ins> -->
                    </div>
                   <!--  <div>
                        <span class="author">
                            &nbsp;&nbsp;<?php echo (date('Y-m-d H:i:s',$data["create_time"])); ?>
                        </span>
                    </div>-->
                </div>
                
            </div>
            <?php if($i == count($hot_list)): ?><div style="padding-bottom: 10px;"></div>
                <?php else: ?>
                <div style="border-top: 1px dashed rgb(204, 204, 204);"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
        <div style="font-size:1em;padding:2em 0;color: #ccc;text-align: center"><?php echo L("_NO_HOT_ISSUES_WITH_WAVE_");?></div><?php endif; ?>
</div>