<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-8
 * Time: PM4:14
 */

namespace Tutorial\Model;

use Think\Model;

class TutorialModel extends Model
{
    protected $tableName = 'tutorial';
    protected $_validate = array(
             array('title', '1,99999', '标题不能为空', self::EXISTS_VALIDATE, 'length'),
        array('title', '0,100', '标题太长', self::EXISTS_VALIDATE, 'length'),
    );

    protected $_auto = array(
        array('post_count', '0', self::MODEL_INSERT),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
    );


    public function editTutorial($data)
    {

        $data = $this->create($data);
        if (!$data) return false;
        $result = $this->save($data);
        if (!$result) {
            return false;
        }
        action_log('edit_tutorial', 'Tutorial', $data['id'], is_login());
        S('tutorial_' . $data['id'], null);
        return $result;
    }


    public function createTutorial($data)
    {
        $data = $this->create($data);
        //对帖子内容进行安全过滤
        if (!$data) return false;
        $result = $this->add($data);
        if (!$result) {
            return false;
        }
        action_log('add_tutorial', 'Tutorial', $result, is_login());
        //返回帖子编号
        return $result;
    }

    public function getTutorial($id)
    {
        $tutorial = S('tutorial_' . $id);
        if (is_bool($tutorial)) {
            $tutorial = $this->where(array('id' => $id, 'status' => 1))->find();
            if ($tutorial) {
                $tutorial['user'] = query_user(array('avatar128', 'avatar64', 'nickname', 'uid', 'space_url'), $tutorial['uid']);
                $tutorial['user']['tutorial_count'] = $this->getUserTutorialCount($tutorial['uid']);
                S('tutorial_' . $id, $tutorial, 60 * 60);
            }
        }
        if ($tutorial) {
            $tutorial['member_count'] = D('TutorialMember')->where(array('tutorial_id' => $tutorial['id'], 'status' => 1))->cache('tutorial_member_count_'.$tutorial['id'],60*5)->count();
        }

        return $tutorial;
    }


    public function getUserTutorialCount($uid)
    {
        return $this->where(array('uid' => $uid, 'status' => 1))->count();
    }


    public function delTutorial($id)
    {
        $res = $this->where(array('id' => $id))->setField('status', -1);
        S('tutorial_' . $id, null);
        return $res;
    }


}
