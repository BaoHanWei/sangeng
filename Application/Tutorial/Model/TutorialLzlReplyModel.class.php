<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-8
 * Time: PM4:14
 */

namespace Tutorial\Model;

use Think\Model;

class TutorialLzlReplyModel extends Model
{
    protected $tableName = 'tutorial_lzl_reply';
    protected $_auto = array(
        array('status', '1', self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
    );


    public function getLzlReply($id)
    {
        $lzl = S('tutorial_lzl_reply_' . $id);
        if (is_bool($lzl)) {
            $lzl = $this->where(array('id' => $id, 'status' => 1))->find();
            if ($lzl) {
                $lzl['user'] = query_user(array('avatar128', 'avatar64', 'nickname', 'uid', 'space_url'), $lzl['uid']);
                S('tutorial_lzl_reply_' . $id, $lzl, 60 * 60);
            }
        }
        return $lzl;
    }


    public function delLzlReply($id)
    {
        $lzl = $this->getLzlReply($id);
        $res = $this->where(array('id' => $id))->setField('status', -1);
        if ($res) {
            D('TutorialPost')->where(array('id' => $lzl['post_id']))->setDec('reply_count');
            S('tutorial_lzl_reply_' . $id, null);
        }
        return $res;
    }


    public function addLzlReply($data){
        $post_id = $data['post_id'];
        $data = $this->create($data);
        if (!$data) return false;
        $result = $this->add($data);
        if(!$result){
              return false;
        }
        action_log('add_tutorial_lzl_reply', 'TutorialLzlReply', $result, is_login());
        $tutorialPostModel =  D('TutorialPost');
        //增加帖子的回复数
        $tutorialPostModel->where(array('id' => $post_id))->setInc('reply_count');
        //更新最后回复时间
        $tutorialPostModel->where(array('id' => $post_id))->setField('last_reply_time', time());
        S('tutorial_post_'.$post_id,null);
        S('tutorial_lzl_count_'.$data['to_f_reply_id'],null);

        //返回结果
        return $result;
    }


}