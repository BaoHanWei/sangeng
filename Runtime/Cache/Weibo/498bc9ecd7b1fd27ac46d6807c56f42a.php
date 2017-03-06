<?php if (!defined('THINK_PATH')) exit(); if($weibo){ ?>
<p class="word-wrap"><?php echo ($weibo["content"]); ?></p>
<?php } ?>

<a class="" target="_blank" title="<?php echo ($show["title"]); ?>"  href="<?php echo ($show["site_link"]); ?>">
<div class="clearfix">
    <div style="border: 1px solid #e8e8e8;padding: 10px;margin-bottom: 20px; background: #f1f1f1;float: left;clear: both;width: 100%">
        <div class="show_share">
            <?php if($show['img']){ ?>
            <div class="pull-left left">
                <img src="<?php echo ($show["img"]); ?>">
            </div>
            <?php } ?>
            <div class="pull-left right "><div class="text-more" style="width: 100%"><?php echo ($show["title"]); ?></div>
                <div class="des"><?php echo (getshortsp(text($show["content"]),40)); ?></div>
            </div>
        </div>
    </div>
</div>
</a>
<style>
    .show_share {
        height: 100%;
        width: 100%;
    }

    .show_share .left {
        width: 100px;
        height: 100px;
        /*line-height: 100px;*/
    }

    .show_share .left img {
        width: 100px;
        height: 100px;

    }

    .show_share .right {
        margin-left: 20px;
        width: 300px;
    }

    .show_share .right {
        font-size: 16px;
        font-weight: 700;
    }

    .show_share .right .des {
        color: #999;
        line-height: 20px;
        font-size: 13px;
        font-weight: normal;
    }

</style>