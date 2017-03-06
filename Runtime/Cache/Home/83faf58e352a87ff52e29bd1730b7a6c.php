<?php if (!defined('THINK_PATH')) exit();?><div class="block-bar">
    <div class="container">
        <div class="block-body row">
            <div class="col-xs-6">
                <div class="common-block">
                    <h2>
                        <?php echo modC('USER_SHOW_TITLE1',L('_ACTIVE_MEMBER_'),'People');?>
                    </h2>

                    <div>
                        <div>
                            <ul class="user-list clearfix">
                                <?php if(is_array($people1)): $i = 0; $__LIST__ = $people1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
                                        <div>
                                            <div><a href="<?php echo ($v["user"]["space_url"]); ?>">
                                                <img class="avatar-img" src="<?php echo ($v["user"]["avatar64"]); ?>"></a>
                                            </div>
                                            <div class="user-name">
                                                <a ucard="<?php echo ($v["uid"]); ?>"><?php echo ($v["user"]["nickname"]); ?></a>
                                            </div>

                                        </div>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>


                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="common-block">
                    <h2>
                        <?php echo modC('USER_SHOW_TITLE2',L('_NEW_MEMBER_'),'People');?>
                    </h2>

                    <div>
                        <div>
                            <ul class="user-list clearfix">
                                <?php if(is_array($people2)): $i = 0; $__LIST__ = $people2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
                                        <div>
                                            <div>
                                                <a href="<?php echo ($v["user"]["space_url"]); ?>">


                                                    <img class="avatar-img" src="<?php echo ($v["user"]["avatar64"]); ?>"></a>
                                            </div>
                                            <div class="user-name">
                                                <a href="<?php echo ($v["user"]["space_url"]); ?>" ucard="<?php echo ($v["uid"]); ?>"><?php echo ($v["user"]["nickname"]); ?></a>
                                            </div>

                                        </div>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(function () {
        ucard();
    })
</script>