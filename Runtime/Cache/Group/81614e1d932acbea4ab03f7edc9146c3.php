<?php if (!defined('THINK_PATH')) exit();?><div class="item_inner">
    <div class="item_type"><?php echo (get_type_name($group["type_id"])); ?></div>
    <a class="pull-left" href="<?php echo U('group/index/group',array('id'=>$group['id']));?>">
        <?php if($group['logo']){ ?>
        <img class="logo" width="238px" height="238px" src="<?php echo (getthumbimagebyid($group["logo"],300,300)); ?>"
             alt="<?php echo (op_t($group["title"])); ?>">
        <?php }else{ ?>
        <img class="logo img-responsive" width="238px" height="238px" src="/Application/Group/Static/images/icon.jpg" alt="<?php echo (op_t($group["title"])); ?>">
        <?php } ?>
    </a>

    <div class="group-detail pull-left col-xs-12" style="padding-bottom: 20px;">
        <h4 class="text-center text-more" style="width: 100%"><a
                href="<?php echo U('group/index/group',array('id'=>$group['id']));?>"
                title="<?php echo ($group["title"]); ?>"><?php echo ($group["title"]); ?></a>
        </h4>

        <p class="detail text-more" style="width: 100%;height: 23px" title="<?php echo ($group["detail"]); ?>">
            <?php echo ($group["detail"]); ?></p>
        <hr>
        <div class="count clearfix" style="margin-bottom: 10px;">
            <div class="pull-left" style="width: 35%" title="<?php echo L('_N_POST_');?>">
                <i class="icon-file"></i>&nbsp;&nbsp;<?php echo ($group["post_count"]); ?>
            </div>
            <div class="pull-left" style="width: 25%" title="<?php echo L('_N_MEMBER_');?>">
                <i class="icon-user"></i>&nbsp;&nbsp;<?php echo ($group["member_count"]); ?>
            </div>
        </div>
        <hr>
        <div class="pull-left text-more" style="width: 50%">
            <a class="author " href="<?php echo ($group["user"]["space_url"]); ?>" ucard="<?php echo ($group["user"]["uid"]); ?>"> <?php echo ($group["user"]["nickname"]); ?> </a>
        </div>

        <?php if(check_auth('Group/Manager/*',get_group_admin($group['id'])) AND is_login()){ ?>
        <a class="btn btn-primary btn-xs pull-right" style="margin-left: 5px;"
           href="<?php echo U('group/Manage/index',array('group_id'=>$group['id']));?>"> <?php echo L('_MANAGE_');?></a>
        <?php } ?>

        <?php if(is_login() != $group['uid']): if(is_joined($group['id']) == 1){ ?>
            <a class="pull-right btn btn-primary btn-xs" data-role="group_quit" data-group-id="<?php echo ($group["id"]); ?>"><?php echo L('_EXIT_');?></a>

            <?php }elseif(is_joined($group['id']) == 2){ ?>
            <a class="pull-right btn btn-default btn-xs"><?php echo L('_AUDIT_');?></a>
            <?php }else{ ?>
            <a class="pull-right btn btn-primary btn-xs" data-role="group_attend" data-group-id="<?php echo ($group["id"]); ?>">+<?php echo L('_IN_');?></a>
            <?php } endif; ?>


    </div>
</div>