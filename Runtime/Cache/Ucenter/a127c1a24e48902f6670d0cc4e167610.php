<?php if (!defined('THINK_PATH')) exit();?>
<?php echo W('Ucenter/UploadAvatar/render',array('uid'=>$uid));?>

<?php if(check_step_can_skip('change_avatar')){ ?>
<a href="<?php echo U('Ucenter/member/step', array('step' => get_next_step('change_avatar')));?>" style="display: block;position: absolute;z-index: 99;top: 523px;left: 700px;padding: 6px;"><?php echo L('_STEP_');?></a>
<?php } ?>