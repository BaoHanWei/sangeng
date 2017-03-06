<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php echo hook('syncMeta');?>
<?php $oneplus_seo_meta = get_seo_meta($vars,$seo); ?>
<?php if($oneplus_seo_meta['title']): ?><title><?php echo ($oneplus_seo_meta['title']); ?></title>
    <?php else: ?>
    <title><?php echo modC('WEB_SITE_NAME',L('_OPEN_SNS_'),'Config');?></title><?php endif; ?>
<?php if($oneplus_seo_meta['keywords']): ?><meta name="keywords" content="<?php echo ($oneplus_seo_meta['keywords']); ?>"/><?php endif; ?>
<?php if($oneplus_seo_meta['description']): ?><meta name="description" content="<?php echo ($oneplus_seo_meta['description']); ?>"/><?php endif; ?>
<!-- zui -->
<link href="/Public/zui/css/zui.css" rel="stylesheet">
<link href="/Public/zui/css/zui-theme.css" rel="stylesheet">
<link href="/Public/css/core.css" rel="stylesheet"/>
<link type="text/css" rel="stylesheet" href="/Public/js/ext/magnific/magnific-popup.css"/>
<script src="/Public/js.php?f=js/jquery-2.0.3.min.js,js/com/com.functions.js,js/com/com.toast.class.js,js/com/com.ucard.js,js/core.js"></script>
<!--Style-->
<!--合并前的js-->
<?php $config = api('Config/lists'); C($config); $count_code=C('COUNT_CODE'); ?>
<script type="text/javascript">
    var ThinkPHP = window.Think = {
        "ROOT": "", //当前网站地址
        "APP": "", //当前项目地址
        "PUBLIC": "/Public", //项目公共目录地址
        "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
        "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
        "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
        'URL_MODEL': "<?php echo C('URL_MODEL');?>",
        'WEIBO_ID': "<?php echo C('SHARE_WEIBO_ID');?>"
    }
    var cookie_config={
        "prefix":"<?php echo C('COOKIE_PREFIX');?>"
    }
    var Config={
        'GET_INFORMATION':<?php echo modC('GET_INFORMATION',1,'Config');?>,
        'GET_INFORMATION_INTERNAL':<?php echo modC('GET_INFORMATION_INTERNAL',10,'Config');?>*1000
    }
    var weibo_comment_order = "<?php echo modC('COMMENT_ORDER',0,'WEIBO');?>";
</script>
<script src="/Public/lang.php?module=<?php echo strtolower(MODULE_NAME);?>&lang=<?php echo LANG_SET;?>"></script>
<script src="/Public/expression.php"></script>
<!-- Bootstrap库 -->
<!--
<?php $js[]=urlencode('/static/bootstrap/js/bootstrap.min.js'); ?>
&lt;!&ndash; 其他库 &ndash;&gt;
<script src="/Public/static/qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="/Public/Core/js/ext/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/Public/static/jquery.iframe-transport.js"></script>
-->
<!--CNZZ广告管家，可自行更改-->
<!--<script type='text/javascript' src='http://js.adm.cnzz.net/js/abase.js'></script>-->
<!--CNZZ广告管家，可自行更改end-->
<!-- 自定义js -->
<!--<script src="/Public/js.php?get=<?php echo implode(',',$js);?>"></script>-->
<script>
    //全局内容的定义
    var _ROOT_ = "";
    var MID = "<?php echo is_login();?>";
    var MODULE_NAME="<?php echo MODULE_NAME; ?>";
    var ACTION_NAME="<?php echo ACTION_NAME; ?>";
    var CONTROLLER_NAME ="<?php echo CONTROLLER_NAME; ?>";
    var initNum = "<?php echo modC('WEIBO_NUM',140,'WEIBO');?>";
    function adjust_navbar(){
        $('#sub_nav').css('top',$('#nav_bar').height());
        $('#main-container').css('padding-top',$('#nav_bar').height()+$('#sub_nav').height()+20)
    }
</script>
<audio id="music" src="" autoplay="autoplay"></audio>
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>
    <link type="text/css" rel="stylesheet" href="/Application/Ucenter/Static/css/login-main.css">  
</head>
<body class="sc reg">  
    <div id="main-container" class="container">
    <header class="home-header">
        <a href="https://www.oschina.net/"><span class="logo"></span></a>
    </header>    
    <section class="box vertical home-wrapper">
        <div class="logon-body">
            <?php if($step == 'start'): ?><div class="box logon-form">
                <div class="box-aw">
                    <nav class="logon-tabs">
                        <span class="tab-item active" data-tab-for="mail_logon">
                            <i class="ic-svg ic-mail"></i>
                            <span>邮箱注册</span>
                        </span>
                        <span class="tab-item" data-tab-for="mail_logon">
                            <i class="ic-svg ic-mail"></i>
                            <span></span>
                        </span>
                    </nav>
                    <article>
                        <form action="<?php echo U('register');?>" method="post">
                            <div class="mail-logon tab-box" id="mail_logon">
                                <div class="logon-form form-wrapper">
                                    <div class="form-item">
                                        <div class="form-ctrl">
                                            <label for="username" class=".sr-only" style="display: none"></label>
                                            <input type="text" id="email" class="form_check" check-type="UserEmail" check-url="<?php echo U('ucenter/member/checkAccount');?>" placeholder="请输入邮箱" title="邮箱" <?php if($key != 0): ?>disabled="disabled"<?php endif; ?>  value="" name="username">
                                            <input type="hidden" name="reg_type" value="email" <?php if($key != 0): ?>disabled="disabled"<?php endif; ?>>
                                        </div>
                                    </div>
                                    <div class="form-item form-group">
                                        <div class="form-ctrl">
                                            <label for="nickname" class=".sr-only" style="display: none"></label>
                                            <input type="text" id="nickname" class=" form_check" check-type="Nickname"  check-url="<?php echo U('ucenter/member/checkNickname');?>" placeholder="输入昵称，中文、字母和数字和下划线" value="" name="nickname">
                                        </div>
                                    </div>
                                    <div class="form-item box">
                                        <div class="form-ctrl box-aw">
                                            <input type="password" id="inputPassword" class="" check-length="6,30"  placeholder="请输入密码，6-30位字符"  name="password">
                                        </div>
                                        <span class="form-phone-code box-fr" title="点击切换">
                                            <a class="btn btn-green box vertical send-phone-vcode" href="javascript:void(0);" style="font-size:16px" onclick="change_show(this)">show</a>
                                        </span>
                                    </div>
                                    <div class="form-item box v-code">
                                        <div class="form-ctrl box-aw">
                                            <label for="verifyCode" class=".sr-only" style="display: none"></label>
                                            <input type="text" id="verifyCode" class="" placeholder="验证码"
                                               errormsg="请填写正确的验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
                                        </div>
                                        <div class="box form-v-code box-fr vertical">
                                            <span class="v-code-img box-aw box" title="点击切换验证码">
                                                <img id="img_vcode" class="verifyimg reloadverify img-responsive" align="absmiddle" alt="点击切换" src="<?php echo U('verify');?>" style="cursor:pointer;height:48px">
                                            </span>
                                        </div>
                                    </div>
                                    <?php if(count($role_list)==1): ?><input id="name" type="hidden" name="role" value="<?php echo ($role_list[0]['id']); ?>">
                                        <?php else: endif; ?>
                                    <div class="form-button form-item">
                                        <button type="submit" class="btn btn-green block btn-logon">注册</button>
                                        <div class="form-tips"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </article>
                </div>
                <div class="box-fr other-login-wrapper">
                    <span class="span-box">已经注册过?</span>
                    <a href="<?php echo U('Ucenter/Member/login');?>" class="btn btn-link btn-lg btn-login">直接登录 →</a>
                    <div class="other-login">
                        <div class="">使用以下账号直接登录</div>
                            <div class="login-logos">
                                
                            </div>
                        </div>
                    </div>
            </div><?php endif; ?>
            <?php if($step != 'start' and $step != 'finish'): echo W('RegStep/view'); endif; ?>
            <?php if($step == 'finish'): ?><div class="col-xs-12" style="font-size: 16px;margin-top: 30px;">
                    <span>感谢您注册 <?php echo modC('WEB_SITE_NAME','OpenSNS开源社交系统','Config');?> ，希望你玩的愉快！ <a href="<?php echo U('Ucenter/Config/index');?>" title="完善个人资料" style="color:#3f88bf">完善个人资料</a> 或 <a  href="<?php echo U('home/Index/index');?>" title="前往首页" style="color:#3f88bf">前往首页</a></span>
                </div><?php endif; ?>
        </div>
    </section>
    <footer class="home-footer">
    <div>
        <div>
            <span class="copy">©<span>开源中国(OSChina.NET) |  <a href="https://www.oschina.net/home/aboutosc" class="btn-link">关于我们</a> | <a href="mailto:market@oschina.cn" class="btn-link">广告联系</a> | <a href="http://weibo.com/oschina2010" class="btn-link">@新浪微博</a> | <a href="https://m.oschina.net/" class="btn-link">开源中国手机版</a>
            <a href="http://www.miitbeian.gov.cn/" target="_blank">粤ICP备12009483号-3</a>
        </span></span></div>
        <div>
            开源中国(OSChina.NET)是 工信部开源软件推进联盟 指定的官方社区
        </div>
    </div>
</footer>
</div>
<!-- jQuery (ZUI中的Javascript组件依赖于jQuery) -->
<!-- 为了让html5shiv生效，请将所有的CSS都添加到此处 -->
<link type="text/css" rel="stylesheet" href="/Public/static/qtip/jquery.qtip.css"/>
<!--<script type="text/javascript" src="/Public/js/com/com.notify.class.js"></script>-->
<!-- 其他库-->
<!--<script src="/Public/static/qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="/Public/js/ext/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/Public/static/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="/Public/js/ext/magnific/jquery.magnific-popup.min.js"></script>-->
<!--<script type="text/javascript" src="/Public/js/ext/placeholder/placeholder.js"></script>
<script type="text/javascript" src="/Public/js/ext/atwho/atwho.js"></script>
<script type="text/javascript" src="/Public/zui/js/zui.js"></script>-->
<link type="text/css" rel="stylesheet" href="/Public/js/ext/atwho/atwho.css"/>
<script src="/Public/js.php?t=js&f=js/com/com.notify.class.js,static/qtip/jquery.qtip.js,js/ext/slimscroll/jquery.slimscroll.min.js,js/ext/magnific/jquery.magnific-popup.min.js,js/ext/placeholder/placeholder.js,js/ext/atwho/atwho.js,zui/js/zui.js&v=<?php echo ($site["sys_version"]); ?>.js"></script>
<script type="text/javascript" src="/Public/static/jquery.iframe-transport.js"></script>
<script src="/Public/js/ext/lazyload/lazyload.js"></script>


<script type="text/javascript">
    var step="<?php echo ($step); ?>";
    if (MID == 0&&step=='start') {
        $(document)
                .ajaxStart(function () {
                    $("button:submit").addClass("log-in").attr("disabled", true);
                })
                .ajaxStop(function () {
                    $("button:submit").removeClass("log-in").attr("disabled", false);
                });
        $("form").submit(function () {
            toast.showLoading();
            var self = $(this);
            $.post(self.attr("action"), self.serialize(), success, "json");
            return false;

            function success(data) {
                if (data.status) {
                    //toast.success(data.info, '温馨提示');
                    setTimeout(function () {
                        window.location.href = data.url
                    }, 10);
                } else {
                    toast.error(data.info, '温馨提示');
                    //self.find(".Validform_checktip").text(data.info);
                    //刷新验证码
                    $(".reloadverify").click();
                }
                toast.hideLoading();
            }
        });

        function change_show(obj) {
            if ($(obj).text().trim() == 'show') {
                $(obj).html('hide');
                $(obj).parents('.password_block').find('input').attr('type', 'text');
            } else {
                $(obj).html('show');
                $(obj).parents('.password_block').find('input').attr('type', 'password');
            }
        }
        function setNickname(obj) {
            var text = jQuery.trim($(obj).val());
            if (text != null && text != '') {
                $('#nickname').val(text);
            }
        }

        $(function () {

            $(".reloadverify").click(function () {
                var $this = $(this);
                var verifyimg = $this.attr("src");
                if (verifyimg.indexOf('?') > 0) {
                    $this.attr("src", verifyimg + '&random=' + Math.random());
                } else {
                    $this.attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
                }
            });
        });
        $(function () {
            $("[data-role='getVerify']").click(function () {
                var $this = $(this);
                toast.showLoading();
                var account = $this.parents('.tab-pane').find('[name="username"]').val();
                var type = $this.parents('.tab-pane').find('[name="reg_type"]').val();
                var verify = $this.parents('.tab-pane').find('[name="verify"]').val();

                if(account == ''){
                    toast.error('请输入帐号');
                    toast.hideLoading();
                    return false;
                }
                if(verify == ''){
                    toast.error('请输入验证码');
                    toast.hideLoading();
                    return false;
                }

                $.post("<?php echo U('ucenter/verify/sendVerify');?>", {account: account, type: type, action: 'member',verify:verify}, function (res) {
                    if (res.status) {
                        DecTime.obj = $this
                        DecTime.time = "<?php echo modC('SMS_RESEND','60','USERCONFIG');?>";
                        $this.attr('disabled',true)
                        DecTime.dec_time();
                        toast.success(res.info);
                    }
                    else {
                        toast.error(res.info);
                    }
                    toast.hideLoading();
                })
            })
            $('#reg_nav li a').click(function(){
                $('.tab-pane').find('input').attr('disabled',true);
                $('.tab-pane').eq($("#reg_nav li a").index(this)).find('input').attr('disabled',false);
            })
            $("[type='submit']").click(function () {
                $(this).parents('form').submit();
            })
             $('[href="#<?php echo ($type); ?>_reg"]').click()
        })
    }
    var DecTime = {
        obj:0,
        time:0,
        dec_time : function(){
            if(this.time > 0){
                this.obj.text(this.time--+'S')
                setTimeout("DecTime.dec_time()",1000)
            }else{
                this.obj.text("<?php echo L('_EMAIL_VERIFY_');?>")
                this.obj.attr('disabled',false)
            }

        }
    }
</script>
<link href="/Application/Core/Static/css/form_check.css" rel="stylesheet" type="text/css">
<script src='/Application/Core/Static/js/form_check.js'></script>
<script>
    // 验证密码长度
    $(function(){
        $('#inputPassword').after('<div class=" show_info" ></div>');
        $('#inputPassword').blur(function(){
            var obj =$('#inputPassword');
            var str =  obj.val().replace(/\s+/g, "");
            var html = '';
            if (str.length == 0) {
                html = '<div class="send red"><div class="arrow"></div>'+"<?php echo L('_EMPTY_CANNOT_');?>"+'</div>';
            } else {
                if (typeof (obj.attr('check-length')) != 'undefined') {
                    var strs = new Array(); //定义一数组
                    strs = obj.attr('check-length').split(","); //字符分割
                    if (strs[1]) {
                        if (strs[1] < str.length || str.length < strs[0]) {
                            html = '<div class="send red"><div class="arrow"></div>'+"<?php echo L('_LENGTH_ILLEGAL_');?>"+'</div>';
                        }
                    }
                    else {
                        if (strs[0] < str.length) {
                            html = '<div class="send red"><div class="arrow"></div>'+"<?php echo L('_LENGTH_ILLEGAL_');?>"+'</div>';
                        }
                    }
                }
                obj.parent().find('.show_info').html(html);
            }
        })
    })
</script>
</body>
</html>