<?php if (!defined('THINK_PATH')) exit();?><!-- Modal -->
<div id="frm-post-popup" class="white-popup" style="max-width: 745px">
    <div class="weibo_post_box">
        <h2><?php echo L('_SHARE_TO_WEIBO_');?></h2>
        <div class="aline" style="margin-bottom: 10px"></div>
        <div class="row">
            <div class="col-xs-12">
                <div>
                    <?php echo W('Weibo/Share/fetchShare',array('param'=>$parse_array));?>
                </div>
                <br/>
                <p>
                    <textarea class="form-control" id="share_content" style="height: 6em;"
                             placeholder="<?php echo L('_PLACE_HOLDER_WRITE_SOMETHING_'); echo L('_WAVE_'); echo L('_WAVE_');?>"><?php echo ($weiboContent); ?></textarea></p>
                <a href="javascript:" onclick="insertFace($(this))"><img src="/Application/Core/Static/images/bq.png"/></a>
                <p class="pull-right"><input type="submit" value="<?php echo L('_PUBLISH_CTRL_CENTER_');?>" data-role="do_send_share" data-query="<?php echo ($query); ?>"
                                             class="btn btn-primary" data-url="<?php echo U('weibo/Share/doSendShare');?>"/></p>
            </div>
        </div>
        <div id="emot_content" class="emot_content"></div>
        <button title="Close (Esc)" type="button" class="mfp-close" style="color: #333;">×</button>
    </div>
</div>
<!-- /.modal -->

<script>
    $(function () {
        $('#share_content').keypress(function (e) {
            if (e.ctrlKey && e.which == 13 || e.which == 10) {
                $("[data-role='do_send_share']").click();
            }
        });

        $('[data-role="do_send_share"]').click(function(){
            //获取参数
            var url = $(this).attr('data-url');
            var content = $('#share_content').val();
            var $button = $(this);
            var query = $button.attr('data-query');

            var originalButtonText = $button.val();

            //发送到服务器
            $.post(url, {content: content,query:query}, function (a) {
                handleAjax(a);
                if (a.status) {
                    $('.mfp-close').click();
                    $button.attr('class', 'btn btn-primary');
                    $button.val(originalButtonText);

                }
            });
        })
    });
</script>