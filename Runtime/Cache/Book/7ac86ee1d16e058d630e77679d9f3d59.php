<?php if (!defined('THINK_PATH')) exit();?><div id="sub_nav">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container" style="width:1200px;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-7" style="width: 1150px;border: 1px solid #F0F6F3;">
                    <a href="<?php echo U($MODULE_INFO['entry']);?>" class="navbar-brand logo" style="">
                        <!-- <i class="icon-<?php echo ($brand["icon"]); ?>"></i> --> 
                        <?php if(!empty($menu_list['first']['title'])){ echo $menu_list['first']['title'];}else{if(MODULE_NAME=='Weibo'){echo '微博';}else if(MODULE_NAME=='Event'){echo '活动';}else{echo $brand['title'];}} ?>专区
                    </a>
                    <ul class="nav navbar-nav" style="height:100px;float: left;">
                        <?php if(is_array($menu_list["left"])): $i = 0; $__LIST__ = $menu_list["left"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if($menu['children']): ?><!--二级菜单-->
                                <li id="tab_<?php echo ($menu["tab"]); ?>" class="dropdown <?php echo ($class); ?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <?php if(($menu["icon"]) != ""): ?><!-- <i class="icon-<?php echo ($menu["icon"]); ?>"></i> --><?php endif; ?>
                                        <?php echo ($menu["title"]); ?> <i class="icon-caret-down"></i>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php if(is_array($menu["children"])): $i = 0; $__LIST__ = $menu["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($child["href"]); ?>" class="<?php echo ($child["class"]); ?>">
                                                    <?php if(($child["icon"]) != ""): ?><i
                                                            class="glyphicon glyphicon-<?php echo ($child["icon"]); ?>"></i><?php endif; ?>
                                                    <?php echo ($child["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

                                        </ul>
                                </li>
                                <?php else: ?>
                                <!--一级菜单-->
                                <li id="tab_<?php echo ($menu["tab"]); ?>" class="<?php echo ($menu["li_class"]); ?>"
                                        ><a href="<?php echo ($menu["href"]); ?>" class="<?php echo ($menu["a_class"]); ?>">
                                    <?php if(($menu["icon"]) != ""): ?><i class="glyphicon glyphicon-<?php echo ($menu["icon"]); ?>"></i><?php endif; ?>
                                    <?php echo ($menu["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php if($menu_list['right'] != null): ?><ul class="nav navbar-nav navbar-right" style="margin-top:10px;height:90px;">
                            <?php if(is_array($menu_list["right"])): $i = 0; $__LIST__ = $menu_list["right"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; $class=($current==$menu['tab']?'active':''); ?>
                                <?php switch($menu["type"]): case "button": ?><a href="<?php echo ($menu["href"]); ?>" class="<?php echo ($menu["a_class"]); ?>"><!-- <i class="icon-<?php echo ($menu["icon"]); ?>"></i> --><?php echo ($menu["html"]); ?></a><?php break;?>
                                    <?php case "search": ?><form class="navbar-form navbar-right" action="<?php echo ($menu["action"]); ?>"
                                              method="<?php echo ($menu["from_method"]); ?>" role="search">
                                            <div class="search-input-group">
                                                <button type="submit" class="input-btn"
                                                        style="border-color: transparent;background: transparent;padding: 0 10px 0 10px;">
                                                    <i class="icon-search"></i></button>
                                                <input type="text" class="input" placeholder="<?php echo ($menu["input_title"]); ?>"
                                                       name="<?php echo ($menu["input_name"]); ?>" value="<?php echo ($search_keywords); ?>">
                                            </div>
                                            </span>
                                        </form><?php break;?>
                                    <?php default: ?>
                                    <?php if($menu['children']): ?><!--二级菜单-->
                                        <!-- <li id="tab_<?php echo ($menu["tab"]); ?>" class="dropdown <?php echo ($menu["class"]); ?>">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <?php if(($menu["icon"]) != ""): ?><i class="icon-<?php echo ($menu["icon"]); ?>"></i><?php endif; ?>
                                                <?php echo ($menu["title"]); ?> <i class="icon-caret-down"></i>
                                                <ul class="dropdown-menu" role="menu">
                                                    <?php if(is_array($menu["children"])): $i = 0; $__LIST__ = $menu["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($child["href"]); ?>" class="<?php echo ($child["class"]); ?>">
                                                            <?php if(($child["icon"]) != ""): ?><i
                                                                    class="glyphicon glyphicon-<?php echo ($child["icon"]); ?>"></i><?php endif; ?>
                                                            <?php echo ($child["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </ul>
                                        </li>-->
                                        <?php else: ?> 
                                        <!--一级菜单-->
                                        <!--<li id="tab_<?php echo ($menu["tab"]); ?>" class="<?php echo ($menu["li_class"]); ?>" style="margin-top:0px;height:90px;">
                                            <a href="<?php echo ($menu["href"]); ?>" class="<?php echo ($menu["a_class"]); ?>">
                                                 <?php if(($menu["icon"]) != ""): ?><i class="glyphicon glyphicon-<?php echo ($menu["icon"]); ?>"></i><?php endif; echo ($menu["title"]); ?>
                                            </a>
                                        </li>--><?php endif; endswitch; endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    <div style="clear: both;"></div>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </div>
    </nav>
</div>
<script>
    //$('#sub_nav #tab_<?php echo ($current); ?>').addClass('active');
</script>