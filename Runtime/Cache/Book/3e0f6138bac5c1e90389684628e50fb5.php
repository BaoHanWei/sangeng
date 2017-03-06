<?php if (!defined('THINK_PATH')) exit(); if(is_array($child_tree)): $i = 0; $__LIST__ = $child_tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$book_tree): $mod = ($i % 2 );++$i; if(count($child_tree)==$i){ $last_class="last"; }else{ $last_class=""; }; if($book_tree['type']==0){ ?>
    <li aria-expanded="false" class="<?php echo ($last_class); ?>" <?php if(($book_tree["open_child"]) == "1"): ?>data-role="default-open"<?php endif; ?>>
        <a href="javascript:void(0);" class="tree-parent tree-parent-collapsed"></a>
        <a data-role="book_section" data-id="<?php echo ($book_tree['id']); ?>" style="margin-left: 29px;color:<?php echo ($book_tree['color']); ?>;"><?php echo ($book_tree['title']); ?></a>
        <ul class="child_ul">
            <?php echo W('Book/ChildTree/render',array(array('pid'=>$book_tree['id'],'book_id'=>$book_tree['book_id'])));?>
        </ul>
    </li>
    <?php }else{ ?>
    <li class="<?php echo ($last_class); ?>">
        <a href="javascript:void(0);" class="tree-file" data-role="book_section" data-id="<?php echo ($book_tree['id']); ?>"  style="color:<?php echo ($book_tree['color']); ?>;"><?php echo ($book_tree['title']); ?></a>
    </li>
    <?php } endforeach; endif; else: echo "" ;endif; ?>