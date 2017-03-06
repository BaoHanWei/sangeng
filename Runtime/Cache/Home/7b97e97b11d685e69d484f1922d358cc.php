<?php if (!defined('THINK_PATH')) exit();?><link type="text/css" rel="stylesheet" href="<?php echo getRootUrl();?>Addons/Report/_static/css/report.css"/>
<!-- 模态框HTML -->
<form class="ajax-form" method="post"  data-role="eject" action="<?php echo addons_url('Report://Report/addReport',array('param'=>http_build_query($param)));?>">
    <?php if(!is_login()): ?><div class="need_login_tip"><?php echo L('_REPORT_NOT_LOGIN_');?></div><?php endif; ?>
    <div style="padding-bottom:45px">
        <span class="col-md-2 pad0" style="font-size: 14px;height: 32px;padding-top: 2px"><?php echo L('_REPORT_REASON_');?>：</span>
    <span class="col-md-10 pad0">
        <select data-role="select"  name="reason" class="chosen-select form-control" tabindex="-1">
            <?php if(is_array($reason)): $i = 0; $__LIST__ = $reason;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vl); ?>"><?php echo ($vl); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select></span>
    </div>
    <div>
        <p><textarea class="form-control "  data-role="textarea" name="content" style="height: 6em;" placeholder="<?php echo L('_REPORT_DETAIL_');?>..."></textarea></p>
    </div>

    <div style="height: 40px;margin-left: 18px;width: 140px ">
    <span>
        <p class="pull-left" style="margin-right: 5px" >
            <input type="submit" data-role="submitreport" value="<?php echo L('_OK_');?>" class="btn btn-primary send_box" <?php if(!is_login()): ?>disabled="disabled"<?php endif; ?>>

        </p>
    </span>
    <span>
        <p class="pull-left" style="margin-left: 5px;">
            <input type="button" value="<?php echo L('_CANCEL_');?>"  class="btn btn-primary send_box" data-role="cancel" data-dismiss="modal">
        </p>
    </span>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('[data-role="submitreport"]').click(function(){
            $('[data-dismiss="modal"]').click();
        });
    });
</script>