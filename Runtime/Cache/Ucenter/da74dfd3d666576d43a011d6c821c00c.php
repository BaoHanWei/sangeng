<?php if (!defined('THINK_PATH')) exit();?><div data-role="login_info"></div>
<div class="col-xs-7 lg_left">
    <div class="col-xs-12">
        <!--<div class="col-xs-12  lg_lf_top">
            <h2><?php echo L('_WELCOME_TO_');?> <?php if(($login_type) == "login"): ?><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>" title="L('_ENTER_INDEX_')"><?php echo modC('WEB_SITE_NAME',L('_OPEN_SNS_'),'Config');?></a><?php else: echo modC('WEB_SITE_NAME',L('_OPEN_SNS_'),'Config'); endif; ?> ！</h2>
        </div>-->
        <div class="clearfix"></div>
        <form action="/ucenter/member/login.html" method="post" class="lg_lf_form ">
            <div class="row">
                <div class="form-group">
                    <label for="inputEmail" class=".sr-only col-xs-12"></label>

                    <div class="col-xs-12">

                        <input type="text" id="inputEmail" class="form-control" placeholder="<?php echo L('_INPUT_PLEASE_'); echo ($ph); ?>"
                               ajaxurl="/member/checkUserNameUnique.html" errormsg="<?php echo L('_MI_USERNAME_ERROR_');?>"
                               nullmsg="<?php echo L('_MI_USERNAME_');?>"
                               datatype="*4-32" value="" name="username" autocomplete="off">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class=".sr-only col-xs-12"></label>

                    <div class="col-xs-12">
                        <div id="password_block" class="input-group">
                            <input type="password" id="inputPassword" class="form-control"
                                   placeholder="<?php echo L('_NEW_PW_INPUT_');?>"
                                   errormsg="<?php echo L('_PW_ERROR_');?>" nullmsg="<?php echo L('_PW_INPUT_ERROR_');?>" datatype="*6-30" name="password">

                            <div class="input-group-addon"><a style="width: 100%;height: 100%"
                                                              href="javascript:void(0);"
                                                              onclick="change_show(this)">show</a></div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <?php if(check_verify_open('login')): ?><div class="form-group">
                        <label for="verifyCode" class=".sr-only col-xs-12"
                               style="display: none"></label>

                        <div class="col-xs-4">
                            <input type="text" id="verifyCode" class="form-control" placeholder="<?php echo L('_VERIFY_CODE_');?>"
                                   errormsg="<?php echo L('_MI_CODE_NULL_');?>" nullmsg="<?php echo L('_MI_CODE_NULL_');?>" datatype="*5-5" name="verify">
                        </div>
                        <div class="col-xs-8 lg_lf_fm_verify">
                            <img class="verifyimg reloadverify  " alt="<?php echo L('_MI_ALT_');?>" src="<?php echo U('verify');?>"
                                 style="cursor:pointer;max-width: 100%">
                        </div>
                        <div class="col-xs-11 Validform_checktip text-warning lg_lf_fm_tip col-sm-offset-1"></div>
                        <div class="clearfix"></div>
                    </div><?php endif; ?>
                <div class="clearfix form-group">
                    <div class="col-xs-7 checkbox-group">
                        <input type="checkbox" checked="checked" name="remember" value="1" id="save_login" style="cursor:pointer;width:10%;">
                        <label style="width: 100%;font-weight:normal;" class="checkbox">
                            <?php echo L('_REMEMBER_LOGIN_');?>
                        </label>
                    </div>
                    <?php if(check_reg_type('email')||check_reg_type('mobile')){ ?>
                    <div class="col-xs-5 text-right">
                        <div class="with-padding box-fr">
                            <a  href="<?php echo U('Member/mi');?>" style="color: #31b968;font-size: 15px;"> <?php echo L('_FORGET_PW_'); echo L('_QUESTION_');?>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <input name="from" type="hidden" value="<?php echo $_SERVER['HTTP_REFERER'] ?>">
            <?php session('login_http_referer',$_SERVER['HTTP_REFERER']); ?>

            <div class="form-group">
                <button type="submit" class="btn btn-green block btn-login"><?php echo L('_LOGIN_SPACE_');?></button>
            </div>


        </form>
    </div>
    <div class="lg_center"></div>
</div>

<div class="col-xs-5 box-fr other-login-wrapper">

    <div class="" style="margin: 0px 0 16px 40px;">
        <span class="span-box"><?php echo L('_ACCOUNT_LOST_'); echo L('_QUESTION_');?></span>
        <a href="<?php echo U('Ucenter/Member/inCode',array('type'=>'email'));?>" class="btn-link btn-lg btn-logon" style="color: #31b968;">立即注册 →</a>
        <!--
        <?php $register_type=modC('REGISTER_TYPE','normal','Invite'); $register_type=explode(',',$register_type); if(in_array('invite',$register_type)&&!in_array('normal',$register_type)){ ?>
        <?php if(check_reg_type('username')){ ?>
            <a data-type="ajax" data-url="<?php echo U('Ucenter/Member/inCode',array('type'=>'username'));?>" data-title="<?php echo L('_REG_JUST_FOR_INV_'); echo L('_EXCLAMATION_');?>" data-toggle="modal"
               class="btn btn-block btn-danger btn-lg"><?php echo L('_REGISTER_USERNAME_');?></a>
            <?php } ?>
            <?php if(check_reg_type('email')){ ?>
            <a data-type="ajax" data-url="<?php echo U('Ucenter/Member/inCode',array('type'=>'email'));?>" data-title="<?php echo L('_REG_JUST_FOR_INV_'); echo L('_EXCLAMATION_');?>" data-toggle="modal"
               class="btn btn-block btn-primary btn-lg"><?php echo L('_REGISTER_EMAIL_');?></a>
            <?php } ?>
            <?php if(check_reg_type('mobile')){ ?>
            <a data-type="ajax" data-url="<?php echo U('Ucenter/Member/inCode',array('type'=>'mobile'));?>" data-title="<?php echo L('_REG_JUST_FOR_INV_'); echo L('_EXCLAMATION_');?>" data-toggle="modal"
               class="btn btn-block btn-success btn-lg"><?php echo L('_REGISTER_PHONE_');?></a>
            <?php } ?>
        <?php }else{ ?>
            <?php if(check_reg_type('username')){ ?>
            <a href="<?php echo U('ucenter/member/register',array('type'=>'username'));?>"
               class="btn btn-block btn-danger btn-lg"><?php echo L('_REGISTER_USERNAME_');?></a>
            <?php } ?>
            <?php if(check_reg_type('email')){ ?>
            <a href="<?php echo U('ucenter/member/register',array('type'=>'email'));?>"
               class="btn btn-block btn-primary btn-lg"><?php echo L('_REGISTER_EMAIL_');?></a>
            <?php } ?>
            <?php if(check_reg_type('mobile')){ ?>
            <a href="<?php echo U('ucenter/member/register',array('type'=>'mobile'));?>"
               class="btn btn-block btn-success btn-lg"><?php echo L('_REGISTER_PHONE_');?></a>
            <?php } ?>
        <?php } ?>-->
    </div>

    <div style="margin-top: 20px;">
        <div class="">使用以下账号直接登录</div>
        <?php echo hook('syncLogin');?>
    </div>
</div>

<div class="clearfix"></div>


<script type="text/javascript">
    var quickLogin = "<?php echo ($login_type); ?>";
    $(document)
            .ajaxStart(function () {
                $("button:submit").addClass("log-in").attr("disabled", true);
            })
            .ajaxStop(function () {
                $("button:submit").removeClass("log-in").attr("disabled", false);
            });

    function change_show(obj) {
        if ($(obj).text().trim() == 'show') {
            var value = $('#inputPassword').val().trim();
            var html = '<input type="text" value="' + value + '" id="inputPassword" class="form-control" placeholder="'+"<?php echo L('_NEW_PW_INPUT_');?>"+'" errormsg="'+"<?php echo L('_PW_ERROR_');?>"+'" nullmsg="'+"<?php echo L('_PW_INPUT_ERROR_');?>"+'" datatype="*6-30" name="password">' +
                    '<div class="input-group-addon"><a style="width: 100%;height: 100%" href="javascript:void(0);" onclick="change_show(this)">hide</a></div>';
            $('#password_block').html(html);
        } else {
            var value = $('#inputPassword').val().trim();
            var html = '<input type="password" value="' + value + '" id="inputPassword" class="form-control" placeholder="'+"<?php echo L('_NEW_PW_INPUT_');?>"+'" errormsg="'+"<?php echo L('_PW_ERROR_');?>"+'" nullmsg="'+"<?php echo L('_PW_INPUT_ERROR_');?>"+'" datatype="*6-30" name="password">' +
                    '<div class="input-group-addon"><a style="width: 100%;height: 100%" href="javascript:void(0);" onclick="change_show(this)">show</a></div>';
            $('#password_block').html(html);
        }
    }

    $(function () {
        $("form").submit(function () {
            toast.showLoading();
            var self = $(this);
            $.post(self.attr("action"), self.serialize(), success, "json");
            return false;
            function success(data) {
                if (data.status) {
                    if (data.url==undefined&&quickLogin == "quickLogin") {
                        $('[data-role="login_info"]').append(data.info);
                        toast.success("<?php echo L('_WELCOME_RETURN_'); echo L('_PERIOD_');?>", "<?php echo L('_TIP_GENTLE_');?>");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    } else {
                        $('body').append(data.info);
                        toast.success("<?php echo L('_WELCOME_RETURN_REDIRECTING_');?>", "<?php echo L('_TIP_GENTLE_');?>");
                        setTimeout(function () {
                            window.location.href = data.url;
                        }, 1500);
                    }
                } else {
                    toast.error(data.info, "<?php echo L('_TIP_GENTLE_');?>");
                    //self.find(".Validform_checktip").text(data.info);
                    //刷新验证码
                    $(".reloadverify").click();
                }
                toast.hideLoading();
            }
        });
        var verifyimg = $(".verifyimg").attr("src");
        $(".reloadverify").click(function () {
            if (verifyimg.indexOf('?') > 0) {
                $(".verifyimg").attr("src", verifyimg + '&random=' + Math.random());
            } else {
                $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            }
        });
    });
</script>