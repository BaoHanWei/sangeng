<?php if (!defined('THINK_PATH')) exit(); if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><dl class="cate-item">
		<dt class="clearfix">
			<form action="<?php echo U('add'.$model);?>" method="post">
				<div class="btn-toolbar opt-btn clearfix">
					<a title=<?php echo L("_EDIT_WITH_DOUBLE_");?> href="<?php echo U('add'.$model.'?id='.$list['id'].'&pid='.$list['pid']);?>"><?php echo L("_EDIT_");?></a>
					<a title="<?php echo (show_status_op($list["status"])); ?>" href="<?php echo U('set'.$model.'Status?ids='.$list['id'].'&status='.abs(1-$list['status']));?>" class="ajax-get"><?php echo (show_status_op($list["status"])); ?></a>
					<a title=<?php echo L("_DELETE_WITH_DOUBLE_");?> href="<?php echo U('set'.$model.'Status?ids='.$list['id'].'&status=-1');?>" class="confirm ajax-get"><?php echo L("_DELETE_");?></a>
					<?php if(($canMove) == "true"): ?><a title=<?php echo L("_MOVE_WITH_DOUBLE_");?> href="<?php echo U('operate'.$model.'?type=move&from='.$list['id']);?>"><?php echo L("_MOBILE_");?></a><?php endif; ?>
                    <?php if(($canMerge) == "true"): ?><a title=<?php echo L("_MERGER_WITH_DOUBLE_");?> href="<?php echo U('operate'.$model.'?type=merge&from='.$list['id']);?>"><?php echo L("_MERGE_");?></a><?php endif; ?>

				</div>
				<div class="fold"><i></i></div>
				<div class="order"><input type="text" name="sort" class="form-control text input-mini" value="<?php echo ($list["sort"]); ?>"></div>

				<div class="name">
					<span class="tab-sign"></span>
					<input type="hidden" name="id" value="<?php echo ($list["id"]); ?>">
					<input type="text" name="title" class="form-control text" style="width: 200px;display: inline-block" value="<?php echo ($list["title"]); ?>">
                    <?php if($level > 0): ?><a class="add-sub-cate" title=<?php echo L("_ADD_A_SUB_CATEGORY_WITH_DOUBLE_");?> href="<?php echo U('add'.$model.'?pid='.$list['id']);?>">
                            <i class="icon-plus"></i>
                        </a><?php endif; ?>

					<span class="help-inline msg"></span>
				</div>
			</form>
		</dt>

		<?php if(!empty($list['_'])): ?><dd>
                <?php $tree_list = new Admin\Builder\AdminTreeListBuilder(); $tree_list->setLevel($level); $tree_list->setModel($model); $tree_list->tree($list['_']); ?>
			</dd><?php endif; ?>
	</dl><?php endforeach; endif; else: echo "" ;endif; ?>