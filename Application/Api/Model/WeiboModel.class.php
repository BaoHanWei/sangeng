<?php


namespace Api\Model;

use Think\Model;

class WeiboModel extends Model
{
    protected $tableName = 'weibo';


    public function sendWeibo($data)
    {

        if (!$data) {
            return false;
        }

        $weibo_id = $this->add($data);
        if (!$weibo_id) {
            return false;
        }
        return $weibo_id;

    }

    public function addTopic(&$content)
    {
        //检测话题的存在性

        $topic = $this->get_topic($content);

        if (isset($topic) && !is_null($topic)) {
            foreach ($topic as $e) {
                $tik = D('Weibo/weiboTopic')->where(array('name' => $e))->find();
                //没有这个话题的时候创建这个话题
                if (!$tik) {
                    D('Weibo/weiboTopic')->add(array('name' => $e));
                }
            }
        }
    }

    public function getWeibo($id, $mid)
    {
        $check_empty = empty($weibo);
        if ($check_empty) {
            $weibo = $this->where(array('id' => $id, 'status' => 1))->find();
            if (!empty($weibo)) {
                $weibo['data'] = unserialize($weibo['data']);
                $weibo['from'] = empty($weibo['from']) ? '网站端' : get_from($weibo['from']);
                $weibo['support_count'] = D('Support')->where(array('appname' => 'Weibo', 'table' => 'weibo', 'row' => $id))->count();
                $support = D('Support')->where(array('appname' => 'Weibo', 'table' => 'weibo', 'row' => $id, 'uid' => $mid))->find();
                if ($support) {
                    $weibo['is_support'] = 1;
                } else {
                    $weibo['is_support'] = 0;
                }
                $weibo['user'] = D('Api/User')->getUserReduceInfo($weibo['uid']);
                $weibo['create_time'] = friendlyDate($weibo['create_time']);
                if ($weibo['type'] == 'image') {
                    $img_ids = explode(',', $weibo['data']['attach_ids']);
                    $weibo['image_count'] = count($img_ids);
                    $weibo['image'] = array();
                    foreach ($img_ids as $k => $v) {
                        $weibo['image']['ori'][$k] = render_picture_path_without_root(get_cover($v, 'path'));
                        $weibo['image']['thumb'][$k] = render_picture_path_without_root(getThumbImageById($v, 200, 200));
                    }
                }
                // 判断转发的原微博是否已经删除
                if ($weibo['type'] == 'repost') {
                    $weibo['sourceWeibo'] = $this->getWeibo($weibo['data']['sourceId'], $mid);
                    if ($weibo['sourceWeibo'] == null) {
                        $weibo['sourceWeibo']['type'] = null;
                    }
                }
                if($weibo['type'] == 'video'){
                    $weibo['video_id']=str_replace('http://v.youku.com/v_show/id_','',$weibo['data']['video_url']);
                    $weibo['video_mp4_url']='http://v.youku.com/player/getRealM3U8/vid/'. $weibo['data']['video_id'].'/type/mp4/v.m3u8';
                    $weibo['video_flv_url']='http://v.youku.com/player/getRealM3U8/vid/'. $weibo['data']['video_id'].'/type/video.m3u8';
                }
                if ($weibo['type'] == 'redbag') {
                    $weibo['data'] = array();
                }
                if (modC('WEIBO_BR', 0, 'Weibo')) {
                    $weibo['content'] = str_replace('/br', '<br/>', $weibo['content']);
                    $weibo['content'] = str_replace('/nb', '&nbsp', $weibo['content']);
                } else {
                    $weibo['content'] = str_replace('/br', '', $weibo['content']);
                    $weibo['content'] = str_replace('/nb', '', $weibo['content']);
                }
                $weibo['content'] = parse_at_app_users($weibo['content']);
            }
            return $weibo;
        }
    }

    public function getWeiboTopList($mid)
    {
        $weiboModel = D('Api/Weibo');
        $top_list = $weiboModel->getList(array('where' => array('status' => 1, 'is_top' => 1), 'limit' => 3));
        //获取每个微博详情
        foreach ($top_list as &$e) {
            $e = $this->getWeibo($e, $mid);
        }
        unset($e);
        //返回微博列表

        return $top_list;

    }

    public function delWeibo($id, $mid)
    {
        $weibo = $this->getWeibo($id, $mid);
        //从数据库中删除微博、以及附属评论
        $result = $this->where(array('id' => $id))->save(array('status' => -1, 'comment_count' => 0));
        D('Weibo/WeiboComment')->where(array('weibo_id' => $id))->setField('status', -1);

        if ($weibo['type'] == 'repost') {
            $this->where(array('id' => $weibo['data']['sourceId']))->setDec('repost_count');
            S('api_weibo_' . $weibo['data']['sourceId'], null);
        }

        S('weibo_' . $id, null);
        return $result;
    }


    public function getComment($id)
    {
        $commentModel = M('weibo_comment');

        $comment = $commentModel->where(array('id' => $id, 'status' => 1))->find();
        if ($comment) {
            $comment['content'] = parse_comment_mob_content($comment['content']);
            $comment['user'] = D('Api/User')->getUserInfo($comment['uid']);
            $comment['create_time'] = friendlyDate($comment['create_time']);
            S('api_weibo_comment_' . $id, $comment);
            $comment['can_delete'] = check_auth('Weibo/Index/doDelComment', $comment['uid']);
            return $comment;
        }
    }

    function get_topic($content)
    {
        //正则表达式匹配
        $topic_pattern = "/#([^\\#|.]+)#/";
        preg_match_all($topic_pattern, $content, $users);

        //返回话题列表
        return array_unique($users[1]);
    }


    public function sendComment($weibo_id, $content, $comment_id = 0, $mid = 0)
    {
        $commentModel = M('weibo_comment');
        $result = $commentModel->add(array('uid' => $mid, 'status' => 1, 'content' => $content, 'weibo_id' => $weibo_id, 'to_comment_id' => $comment_id, 'create_time' => time()));
        if (!$result) {
            return false;
        } else {
            //增加微博评论数量
            D('Weibo/weibo')->where(array('id' => $weibo_id))->setInc('comment_count');
        }


        S('weibo_' . $weibo_id, null);
        return $result;
    }


    public function  sendCommentMessage($uid, $weibo_id, $message, $mid)
    {
        $title = '评论消息';
        $from_uid = $mid;
        $type = 1;
        D('Common/Message')->sendMessage($uid, $title, $message, 'Weibo/Index/weiboDetail', array('id' => $weibo_id), $from_uid, $type);
    }


    public function sendAtMessage($uids, $weibo_id, $content, $from_id = 0)
    {
        $my_username = get_nickname($from_id);
        foreach ($uids as $uid) {
            $message = '内容：' . $content;
            $title = $my_username . '@了您';
            $fromUid = $from_id;
            $messageType = 1;
            D('Common/Message')->sendMessage($uid, $title, $message, 'Weibo/Index/weiboDetail', array('id' => $weibo_id), $fromUid, $messageType);
        }
    }


    public function delComment($id)
    {
        //获取微博编号
        $comment = D('Weibo/WeiboComment')->find($id);
        if ($comment['status'] == -1) {
            return false;
        }
        $weibo_id = $comment['weibo_id'];

        //将评论标记为已经删除
        D('Weibo/WeiboComment')->where(array('id' => $id))->setField('status', -1);

        //减少微博的评论数量
        D('Weibo/Weibo')->where(array('id' => $weibo_id))->setDec('comment_count');
        S('weibo_' . $weibo_id, null);
        //返回成功结果
        return true;
    }

    /**获取热门话题
     * @param int $type
     */
    public function getHot($hour, $num, $page = 1, $mid)
    {

        $map['create_time'] = array('gt', time() - $hour * 60 * 60);

        $map['status'] = 1;

        $weiboModel = M('Weibo');
        $all_topic = D('Weibo/weiboTopic')->where(array('status' => 1), array(array('read_count' => array('neq', 0))))->select();

        foreach ($all_topic as $key => &$v) {
            $map['content'] = array('like', "%#{$v['name']}#%");
            $v['weibos'] = $weiboModel->where($map)->count();
            if ($v['weibos'] == 0) {
                unset($all_topic[$key]);
            }
            if ($v['name'] == '') {
                unset($all_topic[$key]);
            }
            $v['logo_url'] = array();
            if (is_numeric($v['logo'])) {

                $v['logo_url']['ori'] = render_picture_path_without_root(get_cover($v['logo'], 'path'));
                $v['logo_url']['thumb'] = render_picture_path_without_root(getThumbImageById($v['logo'], 100, 100));
            } else {
                $v['logo_url']['ori'] = null;
                $v['logo_url']['thumb'] = null;
            }
            $v['user'] = D('Api/User')->getUserInfo($v['uadmin']);
        }
        unset($v);

        $all_topic = $this->arraySortByKey($all_topic, 'weibos', false);
        $i = 0;
        foreach ($all_topic as &$v) {
            $v['top_num'] = ++$i;
        }
        unset($v);
        $list['data'] = array_slice($all_topic, ($page - 1) * $num, $num);

        return $list['data'];
    }

    /**
     * 根据数组中的某个键值大小进行排序，仅支持二维数组
     *
     * @param array $array 排序数组
     * @param string $key 键值
     * @param bool $asc 默认正序
     * @return array 排序后数组
     */
    public function arraySortByKey(array $array, $key, $asc = true)
    {
        $result = array();
        // 整理出准备排序的数组
        foreach ($array as $k => &$v) {
            $values[$k] = isset($v[$key]) ? $v[$key] : '';
        }
        unset($v);
        // 对需要排序键值进行排序
        $asc ? asort($values) : arsort($values);
        // 重新排列原有数组
        foreach ($values as $k => $v) {
            $result[$k] = $array[$k];
        }

        return $result;
    }




}