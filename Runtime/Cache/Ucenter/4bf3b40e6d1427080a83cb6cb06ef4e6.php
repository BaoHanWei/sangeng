<?php if (!defined('THINK_PATH')) exit();?><div class="clearfix" style="width: 350px;font-size: 13px;line-height: 23px;">
    <div class="col-xs-12" style="padding: 1px">
        <img class="img-responsive" src="<?php echo ($user["cover_path"]); ?>">
    </div>
    <div class="col-xs-12" style="padding: 2px;margin-top: -25px;">
        <div class="col-xs-3">
            <img src="<?php echo ($user["avatar64"]); ?>" class="avatar-img" style="margin-top: -10px"/>
        </div>
        <div class="col-xs-9" style="padding-top: 25px;padding-right:10px;font-size: 12px;">
            <div style="font-size: 16px;"><a href="<?php echo ($user["space_url"]); ?>" title=""><?php echo ($user["real_nickname"]); ?>
                <?php if($user['followed'] AND ($user['alias'] != '')): ?><span class="text-danger " style="font-size: 0.8em"><?php echo ($user["nickname"]); ?></span><?php endif; ?>
            </a>
                <?php if(get_uid() AND $not_self AND $user['followed']): ?><a
                        onclick="card.set_alias(<?php echo ($user["uid"]); ?>)"><i
                        class="icon-edit text-danger"></i> </a><?php endif; ?>
                <?php echo ($user["rank_link"]); ?>
            </div>
            <div>
                <a href="<?php echo ($user["following_url"]); ?>" title="<?php echo L('_FOLLOWERS_MY_');?>" target="_black"><?php echo L('_FOLLOWERS_'); echo L('_COLON_'); echo ($user["following"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo ($user["fans_url"]); ?>" title="<?php echo L('_FOLLOWERS_MY_');?>" target="_black"><?php echo L('_FANS_'); echo L('_COLON_'); echo ($user["fans"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div>
                <?php echo L('_SIGNATURE_'); echo L('_COLON_');?>
                <span class="text-muted">
                    <?php echo ((isset($user["signature"]) && ($user["signature"] !== ""))?($user["signature"]):L('_NO_IDEA_')); ?>
                </span>
            </div>
            <div style="margin-bottom: 15px;color: #848484">
                <?php echo ($user["tags"]); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12" style="background: #f1f1f1;">


        <?php if(get_uid() AND $not_self): ?><button type="button" class="btn btn-default" onclick="talker.start_talk(<?php echo ($user["uid"]); ?>)"
                    style="float: right;margin: 5px 0;padding: 2px 12px;margin-left: 8px;"><?php echo L('_CHAT_');?>
            </button>
            &nbsp;<?php endif; ?>
        <?php if(($user["followed"]) == "1"): ?><button type="button" class="btn btn-default" data-before="btn btn-primary" data-after="btn btn-default"
                    data-role="unfollow" data-follow-who="<?php echo ($user["uid"]); ?>"
                    style="float: right;margin: 5px 0;padding: 2px 12px;"><font title="<?php echo L('_FOLLOWED_CANCEL_');?>"><?php echo L('_FOLLOWED_');?></font></button>
            <?php else: ?>
            <?php if($not_self): ?><button type="button" class="btn btn-primary" data-before="btn btn-primary" data-after="btn btn-default"
                        data-role="follow" data-follow-who="<?php echo ($user["uid"]); ?>"
                        style="float: right;margin: 5px 0;padding: 2px 12px;"><?php echo L('_FOLLOWERS_');?>
                </button><?php endif; endif; ?>
    </div>
</div>