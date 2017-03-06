<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-4-27
 * Time: 下午3:30
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Blog\Model;


use Common\Model\ContentHandlerModel;
use Think\Model;

class BlogDetailModel extends Model
{

    public function editData($data = array())
    {
        $contentHandler = new ContentHandlerModel();
        $data['content'] = $contentHandler->filterHtmlContent($data['content']);
        $data['markdown_template'] = $contentHandler->filterHtmlContent($data['markdown_template']);
        if ($this->find($data['blog_id'])) {
            $res = $this->save($data);
        } else {
            $res = $this->add($data);
        }
        return $res;
    }

    public function getData($id)
    {
        $contentHandler = new ContentHandlerModel();
        $res = $this->where(array('blog_id' => $id))->find();
        $res['content'] = $contentHandler->displayHtmlContent($res['content']);
        return $res;
    }

}