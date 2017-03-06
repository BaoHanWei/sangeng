<?php if (!defined('THINK_PATH')) exit();?><div class="comment">


    <?php if($comment['uid']){ ?>
    <a href="<?php echo ($comment["user"]["space_url"]); ?>" class="avatar "><img src="<?php echo ($comment["user"]["avatar64"]); ?>" ucard="<?php echo ($comment["user"]["uid"]); ?>"
                                                             class="avatar-img"/>
        <?php }else{ ?>
        <a href="javascript:" title="游客" class="avatar"><i class="icon-user icon-border icon-2x icon-muted"
                                                           style="color: #999;width:32px;text-align:center;display: block;"></i></a>
        <?php } ?>
    </a>

    <div class="content">
        <div class="pull-right"><span class="text-muted" title="<?php echo (friendlydate($comment["create_time"])); ?>"><?php echo (friendlydate($comment["create_time"])); ?></span>
            &nbsp;<!--<strong>#5</strong>--></div>
                <span class="author">

                       <?php if($comment['uid']){ ?>

                  <a class="nickname" href="<?php echo ($comment["user"]["space_url"]); ?>"
                     ucard="<?php echo ($comment["user"]["uid"]); ?>"><?php echo ($comment["user"]["nickname"]); ?></a>
                         <?php }else{ ?>

                     <a href="javascript:"><strong>游客</strong></a><?php if($comment['area']): ?>（<?php echo ($comment["area"]); ?>）<?php endif; ?>
                          <?php } ?>
                </span>

        <p class="text">
            <?php echo (parse_comment_content($comment["content"])); ?>
        </p>
        <div class="actions text-right">
            <?php if(is_login()){ ?>
            <?php if($comment['uid']){ ?>
            <a href="javascript:" data-role="reply_local_comment" data-nickname="<?php echo ($comment["user"]["real_nickname"]); ?>">回复</a>
            <?php } ?>

            <?php if(check_auth('deleteLocalComment',$comment['uid'])){ ?>
            <a href="javascript:" data-role="delete_local_comment" data-id="<?php echo ($comment["id"]); ?>">删除</a>
            <?php } ?>
            <?php } ?>

        </div>
    </div>
</div>