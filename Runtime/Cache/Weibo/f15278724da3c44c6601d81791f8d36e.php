<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="<?php echo getRootUrl();?>Addons/CheckIn/Static/css/check.css">

<div class="checkdiv">
    <div class="row">
        <div class="col-xs-4 text-center" style="margin-left: 19px;">
            <img class="ico_calendar" src="<?php echo getRootUrl();?>Addons/CheckIn/Static/images/calendar.png">
            <?php if(!$check){ ?>
            <a href="javascript:void(0)" data-role="do_checkin" class="btn-sign"
               style="color: red;font-weight: bolder;"><?php echo L('_CHECKIN_');?></a>
            <?php }else{ ?>
            <a href="javascript:void(0)" class="btn-sign"><?php echo L('_CHECKED_');?></a>
            <?php } ?>
        </div>

        <div class="col-xs-3  text-center">
            <?php echo ($week); ?>
        </div>
        <div>
            <?php echo ($day); ?>
        </div>

    </div>
</div>
<div class="check-tab">
    <div class="col-xs-3 text-center active" data-role="change_rank" data-type="today"><?php echo L('_TODAY_CHECKED_');?></div>
    <div class="col-xs-3 text-center" data-role="change_rank" data-type="con"><?php echo L('_CON_CHECKED_');?></div>
    <div class="col-xs-3 text-center" data-role="change_rank" data-type="total"><?php echo L('_TOTAL_CHECKED_');?></div>
    <div class="col-xs-3 text-center" data-role="change_rank" data-type="rank"><a href="<?php echo addons_url('CheckIn://CheckIn/ranking');?>">排行榜</a></div>
</div>
<div class="clearfix"></div>
<div id="rank-list" style="margin-bottom: 15px;">
    <?php echo ($html); ?>
</div>

<script>
    $(function () {
        do_checkin();
        $('[data-role="change_rank"]').click(function () {
            var $this = $(this);
            var type = $this.attr('data-type')
            $.post("<?php echo addons_url('CheckIn://CheckIn/getRank');?>", {type: type}, function (res) {
                if (res.status) {
                    $('#rank-list').html(res.html);
                    $('[data-role="change_rank"]').removeClass('active');
                    $this.addClass('active');
                    follower.bind_follow();
                    ucard()
                }
            });
        })

    })
    var do_checkin = function () {
        $('[data-role="do_checkin"]').click(function () {
            var $this = $(this);
            $.post("<?php echo addons_url('CheckIn://CheckIn/doCheckIn');?>", {}, function (res) {
                if (res.status) {
                    $this.replaceWith('<a href="javascript:void(0)" class="btn-sign">已签</a>');
                    $('.check-tab').find('.active').click();
                    toast.success(res.info);
                } else {
                    handleAjax(res);
                    /*              setTimeout(function () {
                     location.reload();
                     }, 1500);*/
                }
                //location.reload();
            });
        })
    }
</script>