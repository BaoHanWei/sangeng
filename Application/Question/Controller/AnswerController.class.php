<?php
namespace Question\Controller;
class AnswerController extends BaseController
{
    public function edit()
    {
        $this->_needLogin();
        if (IS_POST) {
            $this->_doEdit();
        } else {
            $aAnswerId = I('get.answer_id', 0, 'intval');
            $answer = $this->questionAnswerModel->getData(array('id' => $aAnswerId, 'status' => 1));
            if (!$answer) {
                $this->error(L('_ILLEGAL_OPERATION_WITH_EXCLAMATION_'));
            }
            $this->checkAuth('Question/Index/edit', $answer['uid'], L('_NO_AUTHORITY_TO_EDIT_THE_ANSWER_WITH_EXCLAMATION_'));
            $user = query_user(array('space_url', 'nickname', 'avatar128', 'uid', 'nickname'));
            //获取当前问题的最佳答案
            $question = $this->questionModel->getData($answer['question_id']);
            $this->assign('question', $question);
            if ($question['best_answer']) {
                $map['id'] = $question['best_answer'];
                $best_answer = $this->questionAnswerModel->getData($map);
            } else {
                $map['question_id'] = $answer['question_id'];
                $map['id'] = array('neq', $aAnswerId);
                $best_answer = $this->questionAnswerModel->getData($map, 'support desc');
            }
            $this->assign('best_answer', $best_answer);
            //获取当前问题的最佳答案 end
            $this->assign('user', $user);
            $this->assign('answer', $answer);
            $this->display();
        }
    }
    /**
     * 删除回答
     * 范佳炜 fjw@ourstu.com
     */
    public function delAnswer(){
        $aAnswerId=I('get.answer_id',0,'intval');
        $data['status']=0;
        $res=$this->questionAnswerModel->where(array('id'=>$aAnswerId))->save($data);
        if($res){
            $question_id=$this->questionAnswerModel->where(array('id'=>$aAnswerId))->field('question_id')->select();
            $this->questionModel->where(array('id'=>$question_id[0]['question_id']))->setDec('answer_num',1);
            $this->success('删除成功!');
        }else{
            $this->error('删除失败!');
        }
    }
    public function support()
    {
        $this->_needLogin();
        $aId = I('post.answer_id', 0, 'intval');
        $aType = I('post.type', 1, 'intval');
        $res['status'] = 0;
        if (!$aId) {
            $res['info'] = L('_OPERATION_FAILED_WITH_EXCLAMATION_');
            $this->ajaxReturn($res);
        }
        $this->checkActionLimit('support_answer', 'question_answer_support', $aId, get_uid());
        $answer = $this->questionAnswerModel->getData(array('id' => $aId, 'status' => 1));
        if ($answer['uid'] == get_uid()) {
            $res['info'] = L('_NO_SUPPORT_NO_OBJECTION_TO_YOUR_ANSWER_WITH_EXCLAMATION_');
            $this->ajaxReturn($res);
        }
        if (!($this->questionSupportModel->where(array('uid' => get_uid(), 'tablename' => 'QuestionAnswer', 'row' => $aId))->count())) {
            $resultAdd = $this->questionSupportModel->addData('QuestionAnswer', $aId, $aType);
        } else {
            $res['info'] = L('_YOU_HAVE_SUPPORTED_OR_OPPOSED_THE_ANSWER_AND_YOU_CANNOT_REPEAT_THE_OPERATION_WITH_EXCLAMATION_');
            $this->ajaxReturn($res);
        }        if ($resultAdd) {
            $result = $this->questionAnswerModel->changeNum($aId, $aType);
        }        if ($result) {
            //发送消息
            $question = $this->questionModel->find($answer['question_id']);
            if ($aType) {
                $user_info = query_user(array('nickname', 'uid'));
                $tip = L('_USER_') . $user_info['nickname'] . L('_SUPPORT_YOU_ON_THE_PROBLEM_') . $question['title'] . L('_ANSWER_WITH_PERIOD_');
                $title = L('_THE_ANSWER_IS_SUPPORTED_');
            } else {
                $tip = L('_YOUR_QUESTION_') . $question['title'] . L('_THE_ANSWER_WAS_OPPOSED_BY_SOME_DIFFERENT_PEOPLE_WITH_PERIOD_');
                $title = L('_THE_ANSWER_IS_OPPOSED_');
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
            //发送消息 end
            action_log('support_answer', 'question_answer_support', $aId, get_uid());
            $res['info'] = L('_OPERATION_SUCCESS_WITH_EXCLAMATION_') . cookie('score_tip');
            $res['status'] = 1;
        } else {
            $res['info'] = L('_OPERATION_FAILED_WITH_EXCLAMATION_');
        }
        $this->ajaxReturn($res);
    }
    public function setBest()
    {
        $aAnswerId = I('post.answer_id', 0, 'intval');
        $aQuestion = I('post.question_id', 0, 'intval');
        $question = $this->questionModel->getData($aQuestion);
        $this->checkAuth('Question/Answer/setBest', $question['uid'], L('_NO_SET_PERMISSIONS_WITH_EXCLAMATION_'));
        $res['status'] = 0;
        if ($question['best_answer']) {
            $this->error(L('_BEST_ANSWER!_CAN_NOT_BE_SET_WITH_EXCLAMATION_'));
        }
        if ($question && $aAnswerId) {
            $result = $this->questionModel->editData(array('id' => $aQuestion, 'best_answer' => $aAnswerId));
            if ($result) {
                $res['status'] = 1;
                $tip = '在问题【' . $question['title'] . '】中你的回答被设为最佳答案。';
                $answer = $this->questionAnswerModel->getData(array('id' => $aAnswerId));
                /*获得悬赏，打赏积分*/
                $rs=D('Ucenter/Score')->setUserScore($answer['uid'],$question['score_num'],$question['leixing'] ,'inc');
                /*获得悬赏，打赏积分END*/
                D('Common/Message')->sendMessage($answer['uid'], L('_THE_ANSWER_IS_SET_TO_THE_BEST_ANSWER_'), $tip, 'Question/index/detail', array('id' => $aQuestion), is_login(), 1);            } else {
                $res['info'] = L('_OPERATION_FAILED_WITH_EXCLAMATION_');
            }
        } else {
            $res['info'] = L('_ILLEGAL_OPERATION_WITH_EXCLAMATION_');
        }
        $this->ajaxReturn($res);
    }
    private function _doEdit()
    {
        $aQuestion = $data['question_id'] = I('post.question_id', 0, 'intval');
        $aContent = I('post.content', '', 'filter_content');
        $aAnswerId = I('post.answer_id', 0, 'intval');
        if (strlen($aContent) < 40000) {
            $data['content'] = $aContent;
        } else {
            $this->error(L('回答内容不合法 or 长度不合法'));
        }
        if ($aAnswerId) {
            $now_answer = $this->questionAnswerModel->getData(array('id' => $aAnswerId, 'status' => 1));
            $this->checkAuth('Question/Answer/edit', $now_answer['uid'], L('_NO_PERMISSION_TO_EDIT_THE_ANSWER_'));
            $this->checkActionLimit('edit_answer', 'question_answer', $now_answer['id'], get_uid());
            $data['id'] = $aAnswerId;            $title = L('_EDIT_');
        } else {
            $this->checkAuth('Question/Answer/add', -1, L('_NO_AUTHORITY_TO_ANSWER_'));
            $this->checkActionLimit('add_answer', 'question_answer', 0, get_uid());
            $title = L('_RELEASE_');
        }
        $result['status'] = 0;
        if (!$aQuestion) {
            $result['info'] = L('_PARAMETER_ERROR!_THE_PROBLEM_DOES_NOT_EXIST_WITH_EXCLAMATION_WITH_PERIOD_');
            $this->ajaxReturn($result);
        }
        if (mb_strlen($aContent, 'utf-8') < modC('QUESTION_ANSWER_MIN_NUM', 20, 'Question')) {
            $result['info'] = L('_THE_ANSWER_IS_NO_LESS_THAN_') . modC('QUESTION_ANSWER_MIN_NUM', 20, 'Question') . L('_A_WORD_WITH_EXCLAMATION_');
            $this->ajaxReturn($result);
        }
        $res = $this->questionAnswerModel->editData($data);
        if ($res) {
            $this->handleAt($data['content'], 'Question/Index/detail#' . $result, array('id' => $data['question_id']));
            //发送消息            $messageModel = D('Message');
            $user_info = query_user(array('nickname', 'uid'));
            /**
             * @param $to_uid 接受消息的用户ID
             * @param string $content 内容
             * @param string $title 标题，默认为  您有新的消息
             * @param $url 链接地址，不提供则默认进入消息中心
             * @param $int $from_uid 发起消息的用户，根据用户自动确定左侧图标，如果为用户，则左侧显示头像
             * @param int $type 消息类型，0系统，1用户，2应用
             */
            $question = $this->questionModel->find($aQuestion);
            $messageModel->sendMessage($question['uid'], $user_info['nickname'] . '回答了你的问题【' . $question['title'] . '】或编辑了 Ta 的答案，快去看看吧！', L('_THE_QUESTION_IS_ANSWERED_'), 'Question/Index/detail', array('id' => $aQuestion), is_login(), 1);            //发送消息 end
            $result['status'] = 1;
            if ($aAnswerId) {
                $result['url'] = U('Question/Index/detail', array('id' => $aQuestion));
            }            $result['info'] = $title . L('_ANSWER_A_SUCCESS_WITH_EXCLAMATION_') . cookie('score_tip');
        } else {
            $result['info'] = $title . L('_ANSWER_FAILED_WITH_EXCLAMATION_');
        }        $this->ajaxReturn($result);
    }
    public function handleAt($content, $url, $args)
    {
        D('ContentHandler')->handleAtWho($content, $url, $args);
    }
} 