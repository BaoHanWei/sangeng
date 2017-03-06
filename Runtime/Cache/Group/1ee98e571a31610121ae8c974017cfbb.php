<?php if (!defined('THINK_PATH')) exit(); if(\Think\Hook::get('adminEditor') && MODULE_NAME == 'Admin'){ ?>
<label class="textarea">
    <textarea name="<?php echo ($name); ?>" id="<?php echo ($id); ?>"><?php echo ($default); ?></textarea>
    <?php echo hook('adminEditor', array('id'=>$id,'value'=>$default));?>
</label>

<?php }elseif(\Think\Hook::get('editor')){ ?>

<label class="textarea">
    <textarea name="<?php echo ($name); ?>" id="<?php echo ($id); ?>"><?php echo ($default); ?></textarea>
    <?php echo hook('editor', array('id'=>$id,'value'=>$default));?>
</label>

<?php }else{ ?>
<script type="text/plain" name="<?php echo ($name); ?>" id="<?php echo ($id); ?>" style="width:<?php echo ($width); ?>;height:<?php echo ($height); ?>;<?php echo ($style); ?>"><?php echo ($default); ?></script>
<script>
    var  ue_<?php echo ($id); ?>;
    $(function () {
    var config = {<?php echo ($config); ?>,'topOffset':$('#nav_bar').height()+$('#sub_nav').height()+5};
    ue_<?php echo ($id); ?> = UE.getEditor('<?php echo ($id); ?>', config);
    })


</script>

<?php if(!$param['is_load_script']){ ?>
<script type="text/javascript" charset="utf-8" src="/Public/static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/static/ueditor/ueditor.all.min.js"></script>
<?php } ?>
<?php } ?>