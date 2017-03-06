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

class messageModel extends Model
{
    public function getContent($id)
    {
//        $content = S('message_content_' . $id);
        if (empty($content)) {
            $content = D('message_content')->find($id);
            if ($content) {
                $content['args'] = json_decode($content['args'], true);
                $content['args_json'] = json_encode($content['args']);
                if ($content['url']) {
                    $content['web_url'] = is_bool(strpos($content['url'], 'http://')) ? U($content['url'], $content['args']) : $content['url'];
                } else {
                    $content['web_url'] = U('ucenter/message/message', array('tab' => 'all'));
                }
            }
//            S('message_content_' . $id, $content, 60 * 60);
        }

        return $content;
    }
}