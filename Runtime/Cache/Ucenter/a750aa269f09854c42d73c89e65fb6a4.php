<?php if (!defined('THINK_PATH')) exit(); if(!empty($config['type'])){ ?>
<span class="other_login_title">合作登录：</span>
<div class="other_login_link">
    <?php if(in_array('Qq',$config['type'])){ ?>
    <a href="<?php echo addons_url('SyncLogin://Base/login',array('type'=>'qq'));?>" class="other_login other_login_qq"></a>
    <?php } ?>
    <?php if(in_array('Sina',$config['type'])){ ?>
    <a href="<?php echo addons_url('SyncLogin://Base/login',array('type'=>'sina'));?>" class="other_login other_login_sina"></a>
    <?php } ?>
    <?php if(in_array('Douban',$config['type'])){ ?>
    <a href="<?php echo addons_url('SyncLogin://Base/login',array('type'=>'douban'));?>" class="other_login other_login_douban"></a>
    <?php } ?>
    <?php if(in_array('RenRen',$config['type'])){ ?>
    <a href="<?php echo addons_url('SyncLogin://Base/login',array('type'=>'renren'));?>" class="other_login other_login_renren"></a>
    <?php } ?>
    <?php if(in_array('Weixin',$config['type'])){ ?>
    <a href="<?php echo addons_url('SyncLogin://Base/login',array('type'=>'weixin'));?>" class="other_login other_login_weixin"></a>
    <?php } ?>
</div>
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?php echo getRootUrl();?>Addons/SyncLogin/_static/css/sync.css">