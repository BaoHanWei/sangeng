<?php if (!defined('THINK_PATH')) exit(); if(check_auth('Admin/Adv/adv') == 1): ?><div id="adv_<?php echo ($pos["id"]); ?>" class="adv-wrap" style="padding: <?php echo ($pos["padding"]); ?>;margin:<?php echo ($pos["margin"]); ?>;">
    <div class="text-left adv-content" style="width:<?php echo ($pos["width"]); ?>;height:<?php echo ($pos["height"]); ?>;">
       <span class="text"><?php echo ($pos["type_text"]); ?> </span>
    </div>

        <div class="adv-tool">
            <a target="_blank" href="<?php echo U('Admin/Adv/editPos?id=' . $pos['id']);?>"><i title="设置广告位" class="icon-cog"></i> 设置 </a>
            <a target="_blank" href="<?php echo U('Admin/Adv/adv?pos_id=' . $pos['id']);?>"><i title="管理广告" class="icon-sitemap"></i> 广告 </a>
            <a target="_blank" href="<?php echo U('Admin/Adv/editAdv?pos_id=' . $pos['id']);?>"><i title="新增广告" class="icon-plus"></i> 添加 </a>
        </div>
        <div class="adv-size">

            <?php echo ($pos["title"]); ?>  【<?php echo ($pos["name"]); ?>】：<?php echo ($pos["width"]); ?> * <?php echo ($pos["height"]); ?>
        </div>


</div><?php endif; ?>