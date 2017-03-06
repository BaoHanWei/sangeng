<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-8-7
 * Time: 上午9:40
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Book\Widget;


use Think\Controller;

class ChildTreeWidget extends Controller{
    public function render($data)
    {
        $map['status']=1;
        $map['is_show']=1;
        $map['create_time']=array('lt',time());
        $map['book_id']=$data['book_id'];
        $map['pid']=$data['pid'];
        $child=D('Book/BookSection')->getList($map);
        $this->assign('child_tree',$child);
        $this->display(T('Application://Book@Widget/_child_tree'));
    }
} 