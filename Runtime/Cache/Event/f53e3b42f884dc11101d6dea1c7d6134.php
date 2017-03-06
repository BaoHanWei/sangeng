<?php if (!defined('THINK_PATH')) exit();?><div id="frm-post-popup" class="white-popup" style="max-width: 745px">
    <button title="Close (Esc)" type="button" class="mfp-close" style="color: #333;">×</button>
    <h2>报名</h2>
    <div class="aline" style="margin-bottom: 10px"></div>
    <div>
        <div class="row">
            <p>
            <div class="info_title"><?php echo L('_EVENT_TIME_'); echo L('_COLON_');?></div>
            <?php echo date('Y-m-d',$content['sTime']);?>--<?php echo date('Y-m-d',$content['eTime']);?></p>
            <p>
            <div class="info_title"><?php echo L('_REGISTRATION_TIME_DEADLINE_'); echo L('_COLON_');?></div>
            <?php echo date('Y-m-d H:i',$content['deadline']);?></p>
            <p>
            <div class="info_title"><?php echo L('_NUMBER_LIMIT_'); echo L('_COLON_');?></div>
            <?php echo ($content["limitCount"]); ?>  </p>
            <p>
            <div class="info_title"><?php echo L('_REGISTER_ED_'); echo L('_COLON_');?></div>
            <?php echo ($content["attentionCount"]); ?></p>
            <p>
            <div class="info_title"><?php echo L('_NUMBER_REMAIN_'); echo L('_COLON_');?></div>
            <?php echo ($content['limitCount']-$content['attentionCount']); ?></p>
            <p>

            <div class="info_title"><?php echo L('_SITE_'); echo L('_COLON_');?></div>
            <?php echo ($content["address"]); ?></p>


            <div class="col-xs-8">
                <form class="form-horizontal  ajax-form" role="form" action="<?php echo U('Event/Index/doSign');?>" method="post">
                    <div class="form-group has-feedback">
                        <label for="name" class="col-sm-2 control-label"><?php echo L('_COMPELLATION_');?></label>

                        <div class="col-sm-10">
                            <input id="name" name="name" type="" class="form-control form_check" check-type="Text"  value="" placeholder="<?php echo L('_PLACEHOLDER_NAME_');?>"/>
                            <input id="event_id" name="event_id" type="hidden" class="form-control"
                                   value="<?php echo ($content["id"]); ?>"/>
                        </div>

                    </div>
                    <div class="form-group has-feedback">
                        <label for="phone" class="col-sm-2 control-label"><?php echo L('_PHONE_');?></label>

                        <div class="col-sm-10">
                            <input id="phone" name="phone" type="" class="form-control form_check" check-type="Phone"  value="" placeholder="<?php echo L('_PLACEHOLDER_CONTACT_');?>"/>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary " href="<?php echo U('Event/Index/doSign');?>"><?php echo L('_SUBMIT_');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link href="/Application/Core/Static/css/form_check.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Application/Core/Static/js/form_check.js"></script>