<?php if (!defined('THINK_PATH')) exit(); if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i; echo W('Weibo/WeiboDetail/detail',array('weibo_id'=>$weibo)); endforeach; endif; else: echo "" ;endif; ?>
<?php if(empty($lastId) == false): ?><script>
        weibo.lastId = '<?php echo ($lastId); ?>';
    </script><?php endif; ?>