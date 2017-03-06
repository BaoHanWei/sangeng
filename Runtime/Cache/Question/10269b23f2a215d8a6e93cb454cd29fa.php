<?php if (!defined('THINK_PATH')) exit();?><div class="common-block blog_position">
    <header>
      <?php echo L("_RECOMMENDATION_PROBLEM_WITH_SPACE_");?>
    </header>
<?php if(!empty($recommend_list)): if(is_array($recommend_list)): $i = 0; $__LIST__ = $recommend_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="clearfix" style="position: relative">
            <div class="col-xs-12">
                <div>
                    <h3 class="text-more" style="width: 100%">
                        <a title="<?php echo (op_t($data["title"])); ?>" href="<?php echo U('Question/index/detail',array('id'=>$data['id']));?>"><?php echo ($data["title"]); ?></a>
                    </h3>
                </div>
                <div>
                        <span class="author">
                            &nbsp;&nbsp;<?php echo (date('Y-m-d H:i:s',$data["create_time"])); ?>
                        </span>
                </div>
            </div>
                <span class="pull-right" style="position: absolute;right: 0;bottom: 0">
                    &nbsp;&nbsp;
                    <span title=<?php echo L("_ANSWER_WITH_DOUBLE_");?>><i class="icon-comments-alt"></i>  <?php echo ($data["answer_num"]); ?> </span>
                    &nbsp;&nbsp;
                </span>
        </div>
        <?php if($i == count($recommend_list)): ?><div style="padding-bottom: 10px;"></div>
            <?php else: ?>
            <div style="border-top: 1px dashed rgb(204, 204, 204);padding-bottom: 10px;margin: 15px;"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    <?php else: ?>
    <div style="font-size:14px;padding:2em 0;color: #ccc;text-align: center"><?php echo L("_NO_PROBLEM_WITH_WAVE_");?></div><?php endif; ?>
</div>