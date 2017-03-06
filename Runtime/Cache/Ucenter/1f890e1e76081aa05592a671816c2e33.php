<?php if (!defined('THINK_PATH')) exit();?><hr style="margin: 5px 0;"/>
<div id="comment_<?php echo ($comment["id"]); ?>" class="row weibo_comment" data-weibo-id="<?php echo ($comment["weibo_id"]); ?>"
     data-comment-id="<?php echo ($comment["id"]); ?>">
    <div class="clearfix">
        <div class="col-xs-1" style="width: 10%">
            <div class="" style="overflow: hidden;  padding-top: 5px;">
                <a href="<?php echo ($comment["user"]["space_url"]); ?>" ucard="<?php echo ($comment["user"]["uid"]); ?>">
                    <img src="<?php echo ($comment["user"]["avatar32"]); ?>" class="avatar-img"/></a>
            </div>
        </div>
        <div class="col-xs-11  " style="width: 90%">
            <div> <a href="<?php echo ($comment["user"]["space_url"]); ?>"
                     ucard="<?php echo ($comment["user"]["uid"]); ?>"><?php echo ($comment["user"]["nickname"]); ?></a>：<span class="weibo-comment"><?php echo ($comment["content"]); ?></span></div>

           <div class="clearfix text-muted">
               <div class="pull-left">
                   <?php echo (friendlydate($comment["create_time"])); ?>
               </div>
               <div class="pull-right ">&nbsp;&nbsp;&nbsp;
                   <?php if($comment['can_delete']): ?>&nbsp;<a href="javascript:" data-role="comment_del"><?php echo L('_DELETE_');?></a><?php endif; ?>
                   &nbsp;<a href="javascript:" data-role="weibo_reply" data-user-nickname="<?php echo ($comment["user"]["real_nickname"]); ?>"><?php echo L('_REPLY_');?></a>
               </div>
           </div>
        </div>

    </div>


</div>