<?php if (!defined('THINK_PATH')) exit();?>
<div class="common_block_title_right">
    <?php echo L('_ACTIVE_'); echo L('_VIP_');?>
</div>
<div class="common_block_content_right clearfix group_active_member">

    <?php if(is_array($hot_people)): $i = 0; $__LIST__ = $hot_people;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$people): $mod = ($i % 2 );++$i;?><div class="" style="margin-bottom: 10px;float: left;width: 100%;margin-left: -15px;">
        <div class="col-xs-7 name">
            <a ucard="<?php echo ($people["uid"]); ?>" href="<?php echo ($people["user"]["space_url"]); ?>" style="margin-right: 20px;"><img class="avatar-img avatar" src="<?php echo ($people["user"]["avatar64"]); ?>"/></a>
            <?php echo ($people["user"]["nickname"]); ?>
        </div>
        <div class="col-xs-5 active" style="font-size: 12px;" >
            <?php echo L('_ACTIVE_'); echo L('_DEGREE_');?>： <?php echo ($people["activity"]); ?>
        </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>


<div class="common_block_title_right">
    <?php echo L('_NEWEST_'); echo L('_MEMBER_');?>
</div>
<div class="">
    <div class="joined">
        <?php if(is_array($all)): $i = 0; $__LIST__ = $all;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="clearfix text-center" style="width: 50px; display: inline-block">
                <a ucard="<?php echo ($vo["uid"]); ?>" href="<?php echo ($vo["user"]["space_url"]); ?>" style="margin-right:5px;"><img class="avatar-img avatar"  src="<?php echo ($vo["user"]["avatar64"]); ?>" style="width: 32px;height: 32px;margin-bottom: 5px"/></a>

                <div  class="text-more" style="width: 50px"><a ucard="<?php echo ($vo["uid"]); ?>" href="<?php echo ($vo["user"]["space_url"]); ?>" style="margin-right:5px;"><?php echo ($vo["user"]["nickname"]); ?></a></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>

    </div>
</div>