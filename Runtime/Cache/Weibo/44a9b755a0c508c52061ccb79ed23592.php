<?php if (!defined('THINK_PATH')) exit();?> <a title="喜欢"
    <?php if($supported): endif; ?> class="support_btn" table="<?php echo ($table); ?>" row="<?php echo ($row); ?>" uid="<?php echo ($uid); ?>" jump="<?php echo ($jump); ?>">

    <?php if($supported): ?><i id="ico_like" class="icon-heart"></i>
        <?php else: ?>
        <i id="ico_like" class="icon-heart-empty"></i><?php endif; ?>

    </a>
    <span id="support_<?php echo ($app); ?>_<?php echo ($table); ?>_<?php echo ($row); ?>_pos"><span id="support_<?php echo ($app); ?>_<?php echo ($table); ?>_<?php echo ($row); ?>"><?php echo ($count); ?></span> </span>
<script>
    bind_support();
</script>