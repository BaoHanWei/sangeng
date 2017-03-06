<?php if (!defined('THINK_PATH')) exit(); switch($type): case "today": ?><div class="check_rank ">
            <?php if(empty($rank)): ?><div class="default text-center" style="padding: 10px 0;"><?php echo L('_NOBODY_CHECKED_');?></div>
                <?php else: ?>
                <ul class="check_rank_list">
                    <?php if(is_array($rank)): $i = 0; $__LIST__ = $rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="row" style="margin-bottom: 10px;">
                            <div class="paiming col-xs-1" style="line-height: 32px">
                                <?php echo ($i); ?>
                            </div>
                            <div class="list col-xs-7">
                                <img class="avatar-img" style="width: 48px" src="<?php echo ($v["user"]["avatar64"]); ?>">
                                <a ucard="<?php echo ($v["uid"]); ?>" class="text-more " style="width: 50%;vertical-align: middle"
                                   href="<?php echo ($v["user"]["space_url"]); ?>">
                                    <?php echo ($v["user"]["nickname"]); ?></a>
                            </div>
                            <div class="col-xs-4 check_date" style="line-height: 32px">
                                <?php echo date('H:i:s',$v['create_time']);?>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul><?php endif; ?>
            <!-- <div class="col-xs-12"  style="text-align:center;line-height:28px;border-top: 1px rgb(240, 240, 240) dashed;">
                <a href="<?php echo addons_url('CheckIn://CheckIn/ranking');?>" style="padding: 0;color:rgb(51, 51, 51);">
                    <span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;<?php echo L('_CHECK_RANK_');?></a>
            </div> -->
            <div class="clearfix"></div>
        </div><?php break;?>
    <?php default: ?>
    <div class="check_rank ">
        <?php if(empty($rank)): ?><div class="default text-center" style="padding: 10px 0;"> <?php echo L('_NOBODY_CHECKED_');?></div>
            <?php else: ?>
            <ul class="check_rank_list">
                <?php if(is_array($rank)): $i = 0; $__LIST__ = $rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="row" style="margin-bottom: 10px;">


                        <div class="col-xs-3">
                            <a ucard="<?php echo ($v["uid"]); ?>" href="<?php echo ($v["user"]["space_url"]); ?>">
                                <img class="avatar-img" style="width: 48px;" src="<?php echo ($v["user"]["avatar64"]); ?>">
                            </a>
                        </div>

                        <div class="col-xs-5 ">
                            <div class="pull-left" style="width: 100%">
                                <div style="width: 40%;float: left">
                                    Top<?php echo ($i); ?>
                                </div>
                                <a ucard="<?php echo ($v["uid"]); ?>" class="text-more" style="width: 60%;float: left"
                                   href="<?php echo ($v["user"]["space_url"]); ?>">
                                    <?php echo ($v["user"]["nickname"]); ?>
                                </a>
                            </div>

                            <div class="pull-left">
                                <?php echo ($type_ch); echo ($type=='con'?$v['con_check']:$v['total_check']); echo L('_DAY_');?>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <?php echo W('Common/Follow/follow',array('follow_who'=>$v['uid']));?>
                        </div>

                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul><?php endif; ?>
        <!-- <div class="col-xs-12" style="text-align:center;line-height: 28px;border-top: 1px rgb(240, 240, 240) dashed;">
            <a href="<?php echo addons_url('CheckIn://CheckIn/ranking');?>" style="padding: 0;color:rgb(51, 51, 51);">
                <span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;<?php echo L('_CHECK_RANK_');?></a>
        </div> -->
        <div class="clearfix"></div>
    </div><?php endswitch;?>