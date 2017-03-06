<?php

return array(
    //模块名
    'name' => 'Blog',
    //别名
    'alias' => '博客',
    //版本号
    'version' => '1.0.0',
    //是否商业模块,1是，0，否
    'is_com' => 0,
    //是否显示在导航栏内？  1是，0否
    'show_nav' => 1,
    //模块描述
    'summary' => '博客模块，用户撰写博客的CMS模块',
    //开发者
    'developer' => '包汉伟',
    //开发者网站
    'website' => '',
    //前台入口，可用U函数
    'entry' => 'Blog/index/index',

    'admin_entry' => 'Admin/Blog/index',

    'icon' => 'rss-sign',

    'can_uninstall' => 1

);