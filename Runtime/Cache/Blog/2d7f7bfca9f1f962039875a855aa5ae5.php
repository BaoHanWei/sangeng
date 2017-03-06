<?php if (!defined('THINK_PATH')) exit();?><div class="bdsharebuttonbox">
    <a href="#" class="bds_more" data-cmd="more"></a>
    <a href="#" class="bds_qzone" data-cmd="qzone" title="<?php echo L('_SHARE_TO_QQ_');?>"></a>
    <a href="#" class="bds_tsina" data-cmd="tsina" title="<?php echo L('_SHARE_TO_SINA_');?>"></a>
    <a href="#" class="bds_tqq" data-cmd="tqq" title="<?php echo L('_SHARE_TO_TENCENT_');?>"></a>
    <a href="#" class="bds_renren" data-cmd="renren" title="<?php echo L('_SHARE_TO_RENREN_');?>"></a>
    <a href="#" class="bds_weixin" data-cmd="weixin" title="<?php echo L('_SHARE_TO_WEIXIN_');?>"></a>
    <a href="#" class="bds_tieba" data-cmd="tieba" title="<?php echo L('_SHARE_TO_BAIDU_');?>"></a>
    <a href="#" class="bds_copy" data-cmd="copy" title="<?php echo L('_SHARE_TO_URL_');?>"></a>
</div>
<script>
    window._bd_share_config = {"common": {"bdSnsKey": {}, "bdText": "<?php echo ($share_text); ?>", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "1", "bdSize": "16"}, "share": {}};
    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>
<style>
    #bdshare_weixin_qrcode_dialog {
        min-height: 326px;
    }
</style>