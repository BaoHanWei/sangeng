<?php if (!defined('THINK_PATH')) exit();?><div class="block-bar">
    <div class="container">
        <div class=" block-body row">
            <div class="col-xs-12">
                <div class="common-block">
                    <header style="margin-bottom: 0;padding-bottom: 0px"><?php echo modC('NEWS_SHOW_TITLE',L('_HOTTEST_NEWS_'),'News');?></header>

                    <div class="common-block-body">
                        <div class="news_list">
                            <?php if(is_array($news_lists)): $i = 0; $__LIST__ = $news_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="col-xs-6" style="position: relative">
                                    <hr style="margin-top: 10px;margin-bottom: 10px"/>
                                    <?php if($data['cover'] != 0): ?><div class="col-xs-4">
                                            <a title="<?php echo (op_t($data["title"])); ?>"
                                               href="<?php echo U('News/index/detail',array('id'=>$data['id']));?>">
                                                <img alt="<?php echo (op_t($data["title"])); ?>"
                                                     src="<?php echo (getthumbimagebyid($data["cover"],100,92)); ?>"
                                                     style="width: 100px;height: 92px">
                                            </a>
                                        </div>
                                        <div class="col-xs-8">
                                            <div>
                                                <h3 class="text-more" style="width: 100%;margin-top: 0">
                                                    <a title="<?php echo (op_t($data["title"])); ?>"
                                                       href="<?php echo U('News/index/detail',array('id'=>$data['id']));?>"><?php echo ($data["title"]); ?></a>
                                                </h3>
                                            </div>
                                            <div>
                                                <span class="author"><a href="<?php echo ($data["user"]["space_url"]); ?>"
                                                                        ucard="<?php echo ($data["uid"]); ?>"><?php echo ($data["user"]["nickname"]); ?></a>&nbsp;&nbsp;<?php echo (date('Y-m-d H:i:s',$data["create_time"])); ?></span>

                                                <p><span style="width: 90%;" class="text-more"><?php echo ($data["description"]); ?></span></p>
                                            </div>
                                            <div>

                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="col-xs-12">
                                            <div>
                                                <h3 class="text-more" style="width: 100%">
                                                    <a title="<?php echo (op_t($data["title"])); ?>"
                                                       href="<?php echo U('News/index/detail',array('id'=>$data['id']));?>"><?php echo ($data["title"]); ?></a>
                                                </h3>
                                            </div>
                                            <div>
                                                <span class="author"><a href="<?php echo ($data["user"]["space_url"]); ?>"
                                                                        ucard="<?php echo ($data["uid"]); ?>"><?php echo ($data["user"]["nickname"]); ?></a>&nbsp;&nbsp;<?php echo (date('Y-m-d H:i:s',$data["create_time"])); ?></span>

                                                <p><span style="width: 80%;" class="text-more"><?php echo ($data["description"]); ?></span></p>
                                            </div>
                                            <div>

                                            </div>
                                        </div><?php endif; ?>
                                    <span class="pull-right" style="position: absolute;right: 0;bottom: 0">
                                        &nbsp;&nbsp;<span><i class="icon-eye-open"></i>  <?php echo ($data["view"]); ?> </span>&nbsp;&nbsp;
                                    </span>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>