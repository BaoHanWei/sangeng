<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/25
 * Time: 14:40
 * @author :  DDG佳炜 fjw@ourstu.com
 */

return array(
    'route_rules' => array(
        'tutorial/discover' => is_mobile() ? 'mob/tutorial/index?mark=discover' : 'tutorial/index/discover',
        'tutorial/mytutorial/[:page\d]' => is_mobile() ? 'mob/tutorial/index?mark=mytutorial' : 'tutorial/index/my',
        'tutorial/select' => is_mobile() ? 'mob/tutorial/index?mark=select' : 'tutorial/index/select',
        '/^tutorial\/(\d+)(\/p_(\d+)(\D*?))?$/' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/tutorial?id=:1&page=:3',
        '/^tutorial\/(\d+)\/(post|new|member)(\/p_(\d+)(\D*?))?$/' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/tutorial?id=:1&type=:2&page=:4',
        '/^tutorial\/(\d+)\/(ctime|reply)$/' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/tutorial?id=:1&order=:2',
        '/^tutorial\/(\d+)\/(\d+)(\/p_(\d+))?(.*?)$/' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/tutorial?id=:1&cate=:2&page=:4',
        'tutorial/create' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/create',
        'tutorial/detail/:id\d' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/detail',
        '/^tutorial\/edit(\/g_(\d+))?(\/(\d+))?$/' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/edit?tutorial_id=:2&post_id=:4',
        'tutorial/editreply/:reply_id\d' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/editreply',
        'tutorial/search' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/search',


        '/^tutorial\/manage\/member\/(\d+)(\/(\d+))?(\/p_(\d+))?(.*?)$/' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/manage/member?tutorial_id=:1&status=:3&page=:5',


        'tutorial/manage/notice/:tutorial_id\d' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/manage/notice',
        'tutorial/manage/category/:tutorial_id\d' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/manage/category',
        'tutorial/manage/:tutorial_id\d' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/manage/index',
        'tutorials' => is_mobile() ? 'mob/tutorial/index' : 'tutorial/index/tutorials',
    ),
    'router' => array(
        'tutorial/index/index' => 'tutorial',
        'tutorial/index/my' => 'tutorial/mytutorial/[page]',
        'tutorial/index/tutorials' => 'tutorials',
        'tutorial/index/discover' => 'tutorial/discover',
        'tutorial/index/select' => 'tutorial/select',
        'tutorial/index/tutorial' => 'tutorial/[id]/[order]/[type]/[cate]/p_[page]',
        'tutorial/index/edit' => 'tutorial/edit/g_[tutorial_id]/[post_id]',
        'tutorial/index/create' => 'tutorial/create',
        'tutorial/index/detail' => 'tutorial/detail/[id]',
        'tutorial/index/editreply' => 'tutorial/editreply/[reply_id]',
        'tutorial/index/search' => 'tutorial/search',
        'tutorial/manage/index' => 'tutorial/manage/[tutorial_id]',
        'tutorial/manage/member' => 'tutorial/manage/member/[tutorial_id]/[status]/p_[page]',
        'tutorial/manage/notice' => 'tutorial/manage/notice/[tutorial_id]',
        'tutorial/manage/category' => 'tutorial/manage/category/[tutorial_id]',

    )
);