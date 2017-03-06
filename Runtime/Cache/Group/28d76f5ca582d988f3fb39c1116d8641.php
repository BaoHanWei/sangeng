<?php if (!defined('THINK_PATH')) exit(); if(is_login()): ?><div class="common-block my_manage group_info " >
        <header>
            <?php if($uid == 0 || $uid == is_login()): echo L('_MY_'); echo L('_MODULE_');?>  <a class="pull-right" href="<?php echo U('group/index/mygroup');?>"><?php echo L('_MORE_');?>></a><?php else: echo L('_TA_DE_'); echo L('_MODULE_'); endif; ?>

        </header>


        <div class="common_block_content_right">

            <?php if(is_array($my_attendance)): $i = 0; $__LIST__ = $my_attendance;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$my): $mod = ($i % 2 );++$i;?><div class="row agroup">
                    <div class="col-xs-3">

                        <?php if($my['logo']){ ?>
                        <img class="logo" src="<?php echo (getthumbimagebyid($my["logo"],48,48)); ?>" alt="<?php echo (op_t($my["title"])); ?>">
                        <?php }else{ ?>
                        <img class=" logo" src="/Public/Group/images/icon.jpg" alt="<?php echo (op_t($my["title"])); ?>">
                        <?php } ?>

                    </div>
                    <div class="col-xs-9" style="margin-left: -25px;">
                        <h3><a target="_blank" href="<?php echo U('group/index/group',array('id'=>$my['id']));?>" title="<?php echo ($my["title"]); ?>"><?php echo (getshortsp($my["title"],10)); ?></a></h3>

                        <p><?php echo L('_MEMBER_');?>：<?php echo ($my["member_count"]); echo L('_PEER_');?></p>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
    </div><?php endif; ?>