<?php
return array(
    //模块名
    'name' => 'Tutorial',
    //别名
    'alias' => '教程',
    //版本号
    'version' => '1.0.0',
    //是否商业模块,1是，0，否
    'is_com' => 0,
    //是否显示在导航栏内？  1是，0否
    'show_nav' => 1,
    //模块描述
    'summary' => '教程模块，提供国内专业的编程入门教程及技术手册',
    //开发者
    'developer' => '包包大人',
    //开发者网站
    'website' => 'http://www.phpzhidao.com',
    //前台入口，可用U函数
    'entry' => 'Tutorial/index/index',
    //后台入口
    'admin_entry' => 'Admin/Tutorial/tutorial',
    'icon' => 'flag',
    'can_uninstall' => 1
);