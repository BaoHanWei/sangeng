<?php if (!defined('THINK_PATH')) exit();?><div class="weibo_post_box">
    <div class="row ">
        <div class="col-xs-12">
            <p>
                <input placeholder="<?php echo L('_PLACE_HOLDER_SAY_SOMETHING_'); echo L('_WAVE_');?>" id=""  data-weibo-id="<?php echo ($weiboId); ?>"
                          class="form-control single_line">
            </p>
        </div>
        <div class="col-xs-12" style="display: none">
            <p>
                <input type="hidden"  name="reply_id" value="0"/>
                <textarea placeholder="<?php echo L('_PLACE_HOLDER_SAY_SOMETHING_'); echo L('_WAVE_');?>" id="text_<?php echo ($weiboId); ?>" rows="2" data-weibo-id="<?php echo ($weiboId); ?>" class="form-control weibo-comment-content comment_text_inputor"></textarea>
            </p>
            <a href="javascript:" class="" onclick="insertFace($(this))"><img src="/Application/Core/Static/images/bq.png"/></a>
            <!--评论按钮-->
            <p class="pull-right ">
                <button class="btn btn-primary " data-role="do_comment" type="submit" id="btn_<?php echo ($weiboId); ?>" data-weibo-id="<?php echo ($weiboId); ?>"><?php echo L('_COMMENTS_CTRL_ENTER_');?> </button>
            </p>
        </div>
    </div>
    <div id="emot_content" class="emot_content" style="float: left"></div>
    <!--评论列表-->
</div>
<div id="show_comment_<?php echo ($weiboId); ?>" class="weibo_comment_list" data-comment-count="<?php echo ($weiboCommentTotalCount); ?>">
    <?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><div <?php if($i>5){ ?> style="display: none"  <?php } ?> >
        <?php echo W('Weibo/Comment/detail',array('comment_id'=>$comment['id']));?>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
<?php $pageCount = ceil($weiboCommentTotalCount / 10); ?>
<div class="pager" style="display: none!important;">
    <?php echo getPageHtml('weibo_page',$pageCount,array('weibo_id'=>$weiboId),$page);?>
</div>
</div>
<?php if(count($comments)>5){ ?>
<div style="width: 100%;height: 40px;text-align: center;line-height: 40px;">
    <a id="show_all_comment_<?php echo ($weiboId); ?>" href="javascript:" onclick="show_comment('<?php echo ($weiboId); ?>');"><?php echo L('_REPLY_VIEW_MORE_'); echo L('_GREATER_'); echo L('_GREATER_');?></a>
</div>
<?php } ?>


<script>
    $(function () {
        var weiboid = '<?php echo ($weiboId); ?>';
        $('#text_' + weiboid + '').keypress(function (e) {
            if (e.ctrlKey && e.which == 13 || e.which == 10) {
                $('#btn_' + weiboid + '').click();
            }
        });
    });
</script>