<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015-8-21
 * Time: 10:18:20
 */

namespace Api\Controller;


class QuestionController extends BaseController
{
    public function getQuestionType()
    {
        $aPage = I_POST('page','intval');
        $aId = I_POST('id','intval');
        if ($aId) {
            $category = D('Question/QuestionCategory')->where(array('status' => 1, 'pid' => $aId))->page($aPage)->select();
        } else {
            $category = D('Question/QuestionCategory')->where(array('status' => 1, 'pid' => 0))->page($aPage)->select();
            foreach ($category as &$g) {
                $g['QuestionSecond'] = D('Question/QuestionCategory')->where(array('status' => 1, 'pid' => $g['id']))->select();
            }
            unset($g);
        }
        $this->apiSuccess('返回成功', $category);
    }

    public function getQuestionList()
    {

        $aPage = I_POST('page', 'intval');


        if (empty($aPage)) {
            $aPage = 1;
        }
        $aType = I_POST('type','text');
        if (empty($aType)) {
            $aType = 'all';
        }
        $aCate = I_POST('id', 'intval');
        $QuestionModel = D('Api/Question');
        $where['status'] = 1;
        if (empty($aCate)) {
            switch ($aType) {
                case 'wait':
                    $order = 'create_time desc';
                    $where['best_answer'] = 0;
                    $where['update_time'] =array('gt', get_time_ago('month', 1));
                    $list = $QuestionModel->getList(array('field' => 'id', 'where' => $where,'order' => $order));

                    break;
                case 'hot':
                    $order = 'is_recommend desc,answer_num desc';
                    $list = $QuestionModel->getList(array('field' => 'id', 'order' => $order));

                    break;
                case 'my':
                    $order = 'support desc,create_time desc';
                    $where['uid'] = $this->isLogin();
                    $list = $QuestionModel->getList(array('field' => 'id', 'order' => $order, 'where' => $where));
                    break;
                case 'all':
                    $order = 'create_time desc';
                    $list = $QuestionModel->getList(array('field' => 'id', 'order' => $order));
                    break;
            }
        } else {

            $first = D('Question/QuestionCategory')->where(array('id' => $aCate, 'status' => 1))->find();
            if ($first['pid'] == 0) {
                $second = D('Question/QuestionCategory')->where(array('pid' => $first['id'], 'status' => 1))->field('id')->select();
                $ids = array();
                foreach ($second as &$s) {
                    $ids = array_merge($ids, array_column($s, 'id'));
                }
                $map2['status'] = array('neq', 2);
                $map2 = array_merge($ids, array($first['id']));
                $map2['category'] = array('in', $map2);
                $order = 'create_time desc';
                $list = $QuestionModel->getList(array('field' => 'id', 'order' => $order, 'where' => $map2, 'page' => $aPage));
            } else {
                $order = 'create_time desc';
                $map3['category'] = $first['id'];
                $list = $QuestionModel->getList(array('field' => 'id', 'order' => $order, 'where' => $map3, 'page' => $aPage));
            }
        }


        foreach ($list as $key => &$v) {
            $v = D('Question/Question')->where(array('id' => $v))->find();
            $v['description'] = mb_substr(text($v['description']), 0, 100, 'utf-8');
            $v['user'] =D('Api/User')->getUserSimpleInfo($v['uid']);
            $v['create_time'] = friendlyDate($v['create_time']);
            $v['update_time'] = friendlyDate($v['update_time']);
            if ($v['status'] == 2) {
                unset($list[$key]);
            }
        }
        $num = 10;
        $list = $this->arraySortByKey($list, 'create_time', false);
        $list = array_slice($list, ($aPage - 1) * $num, $num);
        if ($list == null) {
            $this->apiError('当前无问题');
        }
        $this->apiSuccess('返回成功', $list);
    }
    public function getUserQuestion(){
        $aUid = I_POST('uid', 'intval');
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $QuestionModel = D('Api/Question');
        $where['status']=1;
        $where['uid']=$aUid;
        $list = $QuestionModel->getList(array('field' => 'id','where' => $where, 'page' => $aPage));

        foreach ($list as $key => &$v) {
            $v = D('Question/Question')->where(array('id' => $v))->find();
            $v['description'] = mb_substr(text($v['description']), 0, 100, 'utf-8');
            $v['user'] =D('Api/User')->getUserSimpleInfo($v['uid']);
            $v['create_time'] = friendlyDate($v['create_time']);
            $v['update_time'] = friendlyDate($v['update_time']);
            if ($v['status'] == 2) {
                unset($list[$key]);
            }
        }
        $num = 10;
        $list = $this->arraySortByKey($list, 'answer_num', false);
        $list = array_slice($list, ($aPage - 1) * $num, $num);
        if ($list == null) {
            $this->apiError('当前无问题');
        }
        $this->apiSuccess('返回成功', $list);
    }

    //返回问题详情
    public function getQuestion()
    {
        $QuestionModel = D('Api/Question');
        $mid = $this->isLogin();
        $aId = I('get.id','','intval');
        $map['status'] = 1;
        $map['question_id'] = $aId;
        if (empty($aId)) {
            $this->apiError('请选择问题查看');
        } else {
            $Detail = $QuestionModel->getQuestionDetail($aId);
            if ($Detail['best_answer'] == 0) {
                $Detail['best'] = null;
            } else {
                $Detail['best'] = $QuestionModel->getAnswer($Detail['best_answer'], $mid);
                $Detail['best']['content'] = mb_substr(text($Detail['best']['content']), 0, 100, 'utf-8');
            }


            $this->apiSuccess('返回成功', $Detail);
        }
    }


    //返回问题下的所有答案
    public function getQuestionDetail()
    {
        $QuestionModel = D('Api/Question');
        $aId = I('get.id', 'intval');
        $aPage = I_POST('page', 'intval');
        $order = 'create_time desc';
        $map['status'] = 1;
        $map['question_id'] = $aId;

        if (empty($aPage)) {
            $aPage = 1;
        }
        $mid = $this->isLogin();
        if (empty($aId)) {
            $this->apiError('请选择问题查看');
        } else {
            $Question = D('Question/Question')->find($aId);
            $answer = D('Question/QuestionAnswer')->getList(array('field' => 'id', 'order' => $order, 'where' => $map, 'page' => $aPage));
            foreach ($answer as $key => &$v) {
                $v = $QuestionModel->getAnswer($v, $mid);
                $v['content'] = mb_substr(text($v['content']), 0, 100, 'utf-8');
                if ($v['id'] == $Question['best_answer']) {
                    unset($answer[$key]);
                }
            }
            unset($v);
            $num = 10;
            $list = $this->arraySortByKey($answer, 'answer_num', false);
            $answer = array_slice($list, ($aPage - 1) * $num, $num);
            if (!$answer) {
                $this->apiError('该问题暂时无人回答!');
            }
            $this->apiSuccess('返回成功', $answer);
        }
    }

    //答案详情
    public function getAnswerDetail()
    {
        $aId = I('get.id', 'intval');
        $map['status'] = 1;
        $mid = $this->isLogin();
        $QuestionModel = D('Api/Question');
        $answer = $QuestionModel->getAnswer($aId, $mid);
        if (!$answer) {
            $this->apiError('该答案未找到!');
        }
        $this->apiSuccess('返回成功', $answer);
    }

    //回答问题
    public function sendAnswer()
    {

        $mid = $this->requireIsLogin();

        $aAnswerId = I('get.id','', 'intval');
        $aQuestionId = I_POST('question_id','intval');
        $aContent = I_POST('content', 'filter_content');

        if (!$aQuestionId) {
            $this->apiError('参数错误！问题不存在。');
        }
        if (mb_strlen($aContent, 'utf-8') < modC('QUESTION_ANSWER_MIN_NUM', 10, 'Question')) {
            $this->apiError('回答内容不能少于' . modC('QUESTION_ANSWER_MIN_NUM', 10, 'Question') . '个字！');
        }
        $data['question_id'] = $aQuestionId;
        $data['content'] = $aContent;

        if ($aAnswerId) {
            $now_answer = D('Question/QuestionAnswer')->where(array('id' => $aAnswerId, 'status' => 1))->find();
            $this->ApiCheckAuth('Question/Answer/edit', $now_answer['uid'], '没有编辑该答案的权限');
            $this->checkActionLimit('edit_answer', 'question_answer', $now_answer['id'], $mid);
            $data['id'] = $aAnswerId;
            $title = '编辑';
            $data['update_time'] = time();
            $data['status'] = 1;
            $data['uid'] = $mid;
            $res = D('Question/QuestionAnswer')->save($data);
        } else {
            $this->ApiCheckAuth('Question/Answer/add', -1, '没有回答的权限');
            $this->checkActionLimit('add_answer', 'question_answer', 0, $mid);
            $title = '发表';
            $data['update_time'] = time();
            $data['create_time'] = time();
            $data['status'] = 1;
            $data['uid'] = $mid;
            $res = D('Question/QuestionAnswer')->add($data);
        }

        if ($res) {
            //发送消息

            $user_info = query_user(array('nickname', 'uid'));
            /**
             * @param $to_uid 接受消息的用户ID
             * @param string $content 内容
             * @param string $title 标题，默认为  您有新的消息
             * @param $url 链接地址，不提供则默认进入消息中心
             * @param $int $from_uid 发起消息的用户，根据用户自动确定左侧图标，如果为用户，则左侧显示头像
             * @param int $type 消息类型，0系统，1用户，2应用
             */
            $question = D('Question/Question')->where(array('id' => $aQuestionId, 'status' => 1))->find();
            D('Common/Message')->sendMessage($question['uid'], $user_info['nickname'] . '回答了你的问题【' . $question['title'] . '】或编辑了 Ta 的答案，快去看看吧！', '问题被回答', 'Question/Index/detail', array('id' => $aQuestionId), $mid, 1);
//            $list['title']='问答';
//            $list['content']= $user_info['nickname'] . '回答了你的问题【' . $question['title'] . '】或编辑了 Ta 的答案，快去看看吧！';
//            $list['message']='问题被回答';
//            $list['question_id']=$aQuestionId;
//            $list['message_type']='question';
//            $arr=array($question['uid']);
//            $list['cids']=D('Api/User')->getUserCID($arr);
//            D('Api/Igt')->pushMessageToSingle(4,$list);
            //发送消息 end
            $result['status'] = 1;
            if ($aAnswerId) {
                $result['url'] = U('Question/Index/detail', array('id' => $aQuestionId));
            }
            D('Question/Question')->where(array('id' => $aQuestionId))->setInc('answer_num');
            $this->apiSuccess($title . '回答成功！');
        } else {
            $this->apiError($title . '回答失败！');
        }
    }


    //提问

    public function sendQuestion()
    {
        $mid = $this->requireIsLogin();
        $need_audit = modC('QUESTION_NEED_AUDIT', 1, 'Question');
        $aId = I('get.id', '', 'intval');
        $title = $aId ? "编辑问题" : "提问题";
        $QuestionModel = D('Api/Question');
        if ($aId) {
            $data = $QuestionModel->getQuestionDetail($aId);
            $this->ApiCheckAuth('Question/Index/edit', $data['uid'], '没有编辑该问题权限！');

            if ($need_audit) {
                $data['status'] = 2;
            } else {
                $data['status'] = 1;
            }

            $data['description'] = I_POST('description', 'text');
            $data['update_time'] = time();
            $res = D('Question/Question')->save($data);
        } else {
            $data['title'] = I_POST('title', 'text');
            $data['category'] = I_POST('category', 'intval');
            if ($need_audit) {
                $data['status'] = 2;
            } else {
                $data['status'] = 1;
            }
            $data['description'] = I_POST('description', '');
            $data['update_time'] = time();
            $data['uid'] = $mid;
            $this->ApiCheckAuth('Question/Index/add', -1, '没有发布问题的权限！');
            $data['create_time'] = time();
            if (!mb_strlen($data['title'], 'utf-8')) {
                $this->apiError('标题不能为空！');
            }
            $res = D('Question/Question')->add($data);
        }

        if ($res) {
            if (!$aId) {
                $aId = $res;
                if ($need_audit) {
                    $this->apiSuccess($title . '问题成功！' . cookie('score_tip') . ' 请等待审核~', U('Question/Index/detail', array('id' => $aId)));
                }
            }
            if (D('Common/Module')->isInstalled('Weibo')) {//安装了微博模块
                //同步到微博
                $postUrl = "http://$_SERVER[HTTP_HOST]" . U('Question/Index/detail', array('id' => $aId));
                $weiboModel = D('Weibo/Weibo');
                $weiboModel->addWeibo("我问了一个问题【" . $data['title'] . "】：" . $postUrl);
            }
            $Detail = $QuestionModel->getQuestionDetail($aId);
            $Detail['description'] = mb_substr(text($Detail['description']), 0, 100, 'utf-8');
            $this->apiSuccess($title . '成功！', $Detail);
        } else {
            $this->apiError($title . '失败！');
        }
    }

    public function evaluate()
    {
        $mid = $this->requireIsLogin();
        $aId = I_POST('id','','intval');
        if (!$aId) {
            $this->apiError('操作失败!');
        }
        $aType = I_POST('type', 'intval');//1 顶  0 踩
        $data['row'] = $aId;
        $data['uid'] = $mid;
        $data['type'] = $aType;
        $data['tablename'] = 'QuestionAnswer';
        $QuestionModel = D('Api/Question');
        $answer = D('Question/QuestionAnswer')->where(array('id' => $aId, 'status' => 1))->find();
        if ($answer['uid'] == $mid) {
            $this->apiError('不能支持、反对自己的回答！');
        }
        if (!D('Question/QuestionSupport')->where(array('uid' => $mid, 'tablename' => 'QuestionAnswer', 'row' => $aId))->count()) {
            $res = D('Question/QuestionSupport')->add($data);
        } else {
            $this->apiError('你已经支持或反对过该回答，不能重复操作！');
        }
        if ($res) {
            $result = $QuestionModel->changeNum($aId, $aType);
        }

        if ($result) {
            //发送消息
            $question = D('Question/Question')->where(array('id' => $answer['question_id']))->find();
            if ($aType) {
                $user_info = query_user(array('nickname', 'uid'));
                $tip = '用户' . $user_info['nickname'] . '支持了你关于问题' . $question['title'] . '的回答。';
                $title = '答案被支持';
            } else {
                $tip = '你的关于问题' . $question['title'] . '的回答被某些不同意见的人反对了。';
                $title = '答案被反对';
            }
            /**
             * @param $to_uid 接受消息的用户ID
             * @param string $content 内容
             * @param string $title 标题，默认为  您有新的消息
             * @param $url 链接地址，不提供则默认进入消息中心
             * @param $int $from_uid 发起消息的用户，根据用户自动确定左侧图标，如果为用户，则左侧显示头像
             * @param int $type 消息类型，0系统，1用户，2应用
             */

            D('Common/Message')->sendMessage($answer['uid'], $title, $tip, 'Question/index/detail', array('id' => $answer['question_id']), 0, 1);
//            $list['title']='问答';
//            $list['content']= $tip;
//            $list['message']='您的'.$title;
//            $list['question_id']=$answer['question_id'];
//            $list['message_type']='question';
//            $arr=array($answer['uid']);
//            $list['cids']=D('Api/User')->getUserCID($arr);
//            D('Api/Igt')->pushMessageToSingle(4,$list);
            //发送消息 end
            action_log('support_answer', 'question_answer_support', $aId, $mid);
            $this->apiSuccess('操作成功！');
        } else {
            $this->apiError('操作失败!');
        }
    }

    public function setBest()
    {
        $mid = $this->requireIsLogin();
        $aAnswerId = I_POST('answer_id', 'intval');
        $aQuestion = I_POST('question_id', 'intval');
        $QuestionModel = D('Api/Question');
        $question = $QuestionModel->getQuestionDetail($aQuestion);
        $this->ApiCheckAuth('Question/Answer/setBest', $question['uid'], '没有设置权限！');
        $res['status'] = 0;
        if ($question && $aAnswerId) {
            if ($question['best_answer']) {
                $this->ApiCheckAuth('Question/Answer/setBest', -1, '已有最佳答案！不能重复设置');
            }
            $result = $QuestionModel->editData(array('id' => $aQuestion, 'best_answer' => $aAnswerId), $mid);
            if ($result) {
                $res['status'] = 1;
                $tip = '在问题【' . $question['title'] . '】中你的回答被设为最佳答案。';
                $answer = $QuestionModel->getAnswer($aAnswerId);
                D('Common/Message')->sendMessage($answer['uid'], '答案被设为最佳答案', $tip, 'Question/index/detail', array('id' => $aQuestion), $mid, 1);
//                $list['title']='问答';
//                $list['content']= $tip;
//                $list['message']='您的答案被设为最佳答案';
//                $list['question_id']=$aQuestion;
//                $list['message_type']='question';
//                $arr=array($answer['uid']);
//                $list['cids']=D('Api/User')->getUserCID($arr);
//                D('Api/Igt')->pushMessageToSingle(4,$list);
            } else {
                $this->apiError('操作失败！');
            }
        } else {
            $this->apiError('非法操作！');
        }
        $this->apiSuccess('操作成功');
    }

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