<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-29
 * Time: 下午5:22
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Api\Model;

use Think\Model;

class NewsModel extends Model
{


   public  function editData($data = array())
    {

        if (!mb_strlen($data['description'], 'utf-8')) {
            $data['description'] = msubstr(op_t($data['content']), 0, 200);
        }
        $detail['content'] = $data['content'];
        $detail['template'] = $data['template'];
        $data['reason'] = '';
        if ($data['id']) {
            $data['update_time'] = time();
            $res = D('News/News')->save($data);
            $detail['news_id'] = $data['id'];
            if ($res) {
                D('News/NewsDetail')->save($detail);
            }
        } else {
            $data['create_time'] = $data['update_time'] = time();
            $res = D('News/News')->add($data);
            action_log('add_news', 'News', $res, $data['uid']);
            $detail['news_id'] = $res;
            if ($res) {
                D('News/NewsDetail')->add($detail);
            }
        }

        return $res;
    }

    function filterHtmlContent($content)
    {
        $content = html($content);
        $content = $this->beforeSave($content);
        $content = filter_base64($content);
//检测图片src是否为图片并进行过滤
        $content = filter_image($content);
        return $content;
    }

    function beforeSave($content)
    {
        $content = preg_replace('/\<embed[^>]*?src=\"[^>]*?\.swf[^>]*?\>/', '', $content);
        return $content;
    }



    function getData($id)
    {
        if ($id > 0) {
            $map['id'] = $id;
            $data = $this->where($map)->find();
            if ($data) {
                $data['detail'] = D('News/NewsDetail')->getData($id);
            }

            return $data;
        }
        return null;
    }

    function getDetail($id)
    {
        $News = D('News/News')->where(array('status' => 1, 'id' => $id))->find();
        $News['cover_url'] = array();

        if ($News['cover'] == 0) {

            $News['cover_url']='';
        }else{


            $News['cover_url']['ori']= render_picture_path_without_root(get_cover($News['cover'], 'path'));
            $News['cover_url']['thumb']= render_picture_path_without_root(getThumbImageById($News['cover'], 100, 100));
            $News['cover_url']['banana']= render_picture_path_without_root(getThumbImageById($News['cover'], 400 ,292));
        }
        if ($News['dead_line'] <= time()){
            $News['approval'] = '已过期';
        } else {
            $News['approval'] = '未过期';
        }
        $News['share_url']='http://'.$_SERVER['HTTP_HOST'].'/index.php?s=/news/index/detail/id/'.$id.'.html';
        $News['create_time'] = friendlyDate($News['create_time']);
        $News['dead_line'] = time_format($News['dead_line']);
        $News['update_time'] = friendlyDate($News['update_time']);
        $News['user']= D('Api/User')->getUserReduceInfo($News['uid']);
        $Cate = D('News/NewsCategory')->where(array('id' => $News['category']))->find();
        $News['category_title'] = $Cate['title'];

        return $News;
    }
}