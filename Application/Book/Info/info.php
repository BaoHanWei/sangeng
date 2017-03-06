<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-28
 * Time: 下午01:12
 * @author 郑钟良<zzl@ourstu.com>
 */


return array(
    //模块名
    'name' => 'Book',
    //别名
    'alias' => '教程',
    //版本号
    'version' => '2.1.0',
    //是否商业模块,1是，0，否
    'is_com' => 1,
    //是否显示在导航栏内？  1是，0否
    'show_nav' => 1,
    //模块描述
    'summary' => '教程模块，可以用于发布用户教程等',
    //开发者
    'developer' => '嘉兴想天信息科技有限公司',
    //开发者网站
    'website' => 'http://www.ourstu.com',
    //前台入口，可用U函数
    'entry' => 'Book/Index/index',

    'admin_entry' => 'Admin/Book/index',

    'icon' => 'book',

    'can_uninstall' => 1

);