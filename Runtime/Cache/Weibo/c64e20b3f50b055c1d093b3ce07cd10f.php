<?php if (!defined('THINK_PATH')) exit();?><div class="common_block_border" style="margin-top: 0">
    <div class="common_block_title" style="border-bottom:1px solid #ddd"><?php echo ($title); ?></div>
    <ul class="userList clearfix" style="padding-left:25px;">
        <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?><li style="text-align: center;margin-right:20px;margin-bottom:10px;margin-left:0px;">
                <a href="<?php echo ($u["user"]["space_url"]); ?>"><img ucard="<?php echo ($u["id"]); ?>" class="avatar-img " style="width: 45px;height: 45px" src="<?php echo ($u["user"]["avatar64"]); ?>"/></a>
                <br/><a href="<?php echo ($u["user"]["space_url"]); ?>" title="<?php echo (op_t($u["user"]["nickname"])); ?>" class="text-more" style="width: 100%"><?php echo (op_t($u["user"]["nickname"])); ?></a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>