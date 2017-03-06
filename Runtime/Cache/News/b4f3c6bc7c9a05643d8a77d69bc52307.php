<?php if (!defined('THINK_PATH')) exit(); if(is_login()){ ?>
<?php if (D('Module')->checkInstalled('Weibo')) { ?>

<a href="<?php echo U('Weibo/Share/shareBox',array('query'=>$query));?>" data-role="share_box" class="share_btn <?php echo ($css["class"]); ?>"
   style="<?php echo ($css['style']); ?>"><?php echo ($text); ?></a>
<script>
    $(function () {
        $('[data-role="share_box"]').magnificPopup({
            type: 'ajax',
            overflowY: 'scroll',
            modal: true,

            callbacks: {
                ajaxContentAdded: function () {
                    // Ajax content is loaded and appended to DOM
                    $('#repost_content').focus();
                }, open: function () {
                    $('.mfp-bg').css('opacity', 0.1)
                }
            }
        });
    })
</script>
<?php }} ?>