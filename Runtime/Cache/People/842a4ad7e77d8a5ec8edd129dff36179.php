<?php if (!defined('THINK_PATH')) exit(); if($is_following && !$is_self){ ?>
<button type="button" class="<?php echo ((isset($after) && ($after !== ""))?($after):'btn btn-default btn-green-border'); ?>" data-after="<?php echo ((isset($before) && ($before !== ""))?($before):'btn btn-default btn-green-border'); ?>"  data-before="<?php echo ((isset($after) && ($after !== ""))?($after):'btn btn-green-border'); ?>" data-role="unfollow" data-follow-who="<?php echo ($follow_who); ?>" style="width: 75px">
    <?php echo L('_FOLLOWED_CANCEL_');?>
</button>
<?php }elseif(!$is_following && !$is_self){ ?>
<button type="button" class="<?php echo ((isset($before) && ($before !== ""))?($before):'btn btn-default btn-green-border'); ?> " data-after="<?php echo ((isset($before) && ($before !== ""))?($before):'btn btn-default btn-green-border'); ?>"  data-before="<?php echo ((isset($after) && ($after !== ""))?($after):'btn btn-green-border'); ?>"  data-role="follow" data-follow-who="<?php echo ($follow_who); ?>" style="width: 65px">
    <?php echo L('_FOLLOWERS_');?>
</button>
<?php }else{ ?>
<button class="btn btn-primary" disabled="disabled" style="width: 65px">
    <?php echo L('_SELF_');?>
</button>
<?php } ?>