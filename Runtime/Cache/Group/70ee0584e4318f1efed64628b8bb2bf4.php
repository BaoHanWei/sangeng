<?php if (!defined('THINK_PATH')) exit();?><div class="common-block my_manage group_info ">
    <header >
        <?php echo L('_ACTIVE_'); echo L('_MODULE_');?>
    </header>
    <div class="common_block_content_right">
        <?php if(is_array($hot_group)): $i = 0; $__LIST__ = $hot_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$my): $mod = ($i % 2 );++$i;?><div class="row agroup">
                <div class="col-xs-3" >

                    <?php if($my['logo']){ ?>
                    <img class="logo" src="<?php echo (getthumbimagebyid($my["logo"],72,72)); ?>" alt="<?php echo (op_t($my["title"])); ?>">
                    <?php }else{ ?>
                    <img class=" logo" src="/Application/Group/Static/images/icon.jpg" alt="<?php echo (op_t($my["title"])); ?>">
                    <?php } ?>

                </div>
                <div class="col-xs-5"  style="margin-left: -25px;">
                    <h3><a target="_blank" href="<?php echo U('group/index/group',array('id'=>$my['id']));?>" title="<?php echo ($my["title"]); ?>"><?php echo (getshortsp($my["title"],6)); ?></a></h3>

                    <p><?php echo L('_MEMBER_');?>：<?php echo ($my["member_count"]); echo L('_PEER_');?></p>
                </div>

                <div class="col-xs-4">
                    <p><?php echo L('_ACTIVE_'); echo L('_DEGREE_');?>：<?php echo ($my["activity"]); ?></p>
                </div>

            </div><?php endforeach; endif; else: echo "" ;endif; ?>


    </div>
</div>