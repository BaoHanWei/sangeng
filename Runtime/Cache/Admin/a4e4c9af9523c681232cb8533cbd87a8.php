<?php if (!defined('THINK_PATH')) exit();?><div>
    <style>
        .modal-dialog {
            width: 430px;
        }
    </style>
    <form id="migration" action="/index.php?s=/admin/news/doaudit.html&&ids%5B%5D=8" method="post" class="ajax-form">
        <input type="hidden" name="ids" value="<?php echo ($ids); ?>">
        <div class="form-group">
            <label class="col-xs-4 control-label" style="text-align: right;">
                <?php echo L('_FAULT_REASON_');?>
            </label>
            <div class="col-xs-8">
                <textarea name="reason" style="width: 240px;height: 73px;margin-bottom: 10px;" placeholder="<?php echo L('_AUDIT_FAULT_RETURN_');?>"></textarea>
                <div class="clearfix"></div>
            </div>
        </div>
        <div style="width: 100%;text-align: center;">
            <a class="btn btn-primary" data-role="submit"><?php echo L('_SUBMIT_');?></a>
            <a onclick="$('.close').click();" class="btn btn-default"><?php echo L('_CANCEL_');?></a>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('[data-role="submit"]').click(function(){
            query=$('#migration').serialize();
            var url=$('#migration').attr('action');
            $.post(url,query,function(msg){
                if(msg.status){
                    toast.success('<?php echo L("_SUCCESS_TIP_");?>！');
                    setTimeout(function(){
                        window.location.href=msg.url;
                    },1500);
                }else{
                    handleAjax(msg);
                }
            },'json');
        });
    });
</script>