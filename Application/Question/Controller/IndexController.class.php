<?php
namespace Question\Controller;
class IndexController extends BaseController
{
    public function index()   {
        redirect(is_login() ? U('Question/Index/waitAnswer') : U('Question/Index/goodQuestion'));
    }
    public function questions($page = 1, $r = 15)
    {
        $quesionCategory = $this->questionCategoryModel->getQuestionCategoryList();
        $this->assign($quesionCategory);
        $aCategory = I('get.category', 0, 'intval');
        $map_cate = $this->questionCategoryModel->getCategoryList(array('pid' => $aCategory));
        $map_cate = array_column($map_cate, 'id');
        $map['category'] = array('in', array_merge(array($aCategory), $map_cate));
        $this->assign('question_cate', $aCategory);
        $title=$this->questionCategoryModel->where('id='.$aCategory)->field('title')->select();
        $this->assign('title',$title[0]['title']);
        $map['status'] = 1;
        list($list, $totalCount) = $this->_getList($map, $page, $r);
        $this->assign('list', $list);
        $this->assign('totalCount', $totalCount);
        $this->assign('current', 'questions');
        $this->setTitle(L('_ALL_THE_PROBLEMS_'));
        $this->display();
    }
    public function myQuestion($page = 1, $r = 15)
    {
        $this->_needLogin();
        $aType = I('get.type', 'a', 'text');//类型 q:question,a:answer
        if ($aType == 'q') {
            $map['status'] = array('egt', 0);
            $map['uid'] = get_uid();
            list($list, $totalCount) = $this->_getList($map, $page, $r);
            $this->assign('type', 'q');
        } else {
            list($list, $totalCount) = $this->questionAnswerModel->getMyListPage(0, $page, 'support desc,create_time desc', $r, '*');
            $user = query_user(array('uid', 'nickname', 'space_url', 'avatar64'));
            $this->assign('user', $user);
            $this->assign('type', 'a');
        }
        $this->assign('list', $list);
        $this->assign('totalCount', $totalCount);
        $this->assign('current', 'myQuestion');
        $this->setTitle(L('_MY_QUESTION_AND_ANSWER_'));
        $this->display();
    }
    public function waitAnswer($page = 1, $r = 15)
    {        $map['status'] = 1;
        $map['update_time'] = array('gt', get_time_ago('month', 1));
        $map['best_answer'] = 0;
        list($list, $totalCount) = $this->questionModel->getListPageByMap($map, $page, 'create_time desc', $r, '*');
        foreach ($list as &$val) {
            $val['info'] = mb_substr(text($val['description']), 0, 200,'utf-8');
            $val['title'] = mb_substr(text($val['title']), 0, 200,'utf-8');
            $val['img'] = get_pic($val['description']);
            $val['user'] = query_user(array('uid', 'space_link', 'nickname', 'avatar128'), $val['uid']);
        }
        unset($val);
        $this->assign('list', $list);
        $this->assign('totalCount', $totalCount);
        $this->assign('current', 'waitAnswer');
        $this->setTitle(L('_TO_ANSWER_THE_QUESTION_'));
        $this->display();
    }
    public function goodQuestion($page = 1, $r = 15)
    {
        $map['status'] = 1;
        $map['create_time']=array('gt',time()-604800);
        list($list, $totalCount) = $this->_getList($map, $page, $r, 'answer_num desc');
        $this->assign('list', $list);
        $this->assign('totalCount', $totalCount);
        $this->assign('current', 'goodQuestion');
        $this->setTitle(L('_HOT_ISSUE_'));
        $this->display();
    }
    
    public function tag($page = 1, $r = 15)
    {
        $_GET['name'] = trim($_POST['name']) ? json_encode(trim($_POST['name'])) : $_GET['name'];
        $aKeywords = json_decode($_GET['name']);
        $map['status'] = 1;
        $map['tags'] = array('like', '%' . $aKeywords . '%');
        list($list, $totalCount) = $this->_getList($map, $page, $r, 'answer_num desc');
        $this->assign('list', $list);
        $this->assign('totalCount', $totalCount);
        $this->assign('search_keywords', $_GET['name'] );
        $this->display();
    }
    
    public function search($page = 1, $r = 15)
    {
        $_GET['keywords'] = trim($_POST['keywords']) ? json_encode(trim($_POST['keywords'])) : $_GET['keywords'];
        $aKeywords = json_decode($_GET['keywords']);
        $map['status'] = 1;
        $map['title'] = array('like', '%' . $aKeywords . '%');
        list($list, $totalCount) = $this->_getList($map, $page, $r, 'answer_num desc');
        $this->assign('list', $list);
        $this->assign('totalCount', $totalCount);
        $this->assign('search_keywords', $aKeywords);
        $this->display();
    }
    public function detail($page = 1, $r = 10)
    {
        $aId = I('id', 0, 'intval');
        $data = $this->questionModel->getData($aId);
        if (!$data || $data['status'] == -1) {
            $this->error(L('_THE_PROBLEM_DOES_NOT_EXIST_OR_HAS_BEEN_DELETED_WITH_EXCLAMATION_'));
        } else {            if ($data['status'] == 2) {
                $data['audit_info'] = '<span style="color: #D79F39;">待审核</span>';
            } elseif ($data['status'] == 0) {
                $data['audit_info'] = '<span style="color: #A6A6A6;">审核失败或被禁用！<a href="' . U('question/index/edit', array('id' => $aId)) . '">编辑问题</a> 重新审核</span>';            } else {
                $data['audit_info'] = "";
            }
        }
        if ($data['best_answer']) {
            $best_answer = $this->questionAnswerModel->getData(array('id' => $data['best_answer'], 'status' => 1));
            $this->assign('best_answer', $best_answer);
            $this->_getAnswer($aId, $page, $r, array('id' => array('neq', $data['best_answer'])));
        } else {
            $this->_getAnswer($aId, $page, $r);
        }
        $data['leixing_title']=M('UcenterScoreType')->where(array('id'=>$data['leixing'],'status'=>1))->find();
        M("question")->where("id=".$aId)->setInc("views");
        $data['title'] = str_replace('"', '', $data['title']);//去除引号
        $this->setTitle('{$question.title|text}');
        $this->assign('question', $data);
        $this->display();
    }
    public function edit()
    {
        $this->_needLogin();
        if (IS_POST) {
            $this->_doEdit();
        } else {
            $aId = I('id', 0, 'intval');
            $title = $aId ? L('_EDITING_PROBLEMS_') : L('_RAISE_QUESTIONS_');
            if ($aId) {
                $data = $this->questionModel->getData($aId);
                $this->checkAuth('Question/Index/edit', $data['uid'], L('_NO_EDITING_THE_PROBLEM_RIGHT_WITH_EXCLAMATION_'));
                $need_audit = modC('QUESTION_NEED_AUDIT', 1, 'Question');
                if ($need_audit) {
                    $data['status'] = 2;
                }
            } else {
                $data['title'] = I('title', '', 'text');
                $this->checkAuth('Question/Index/add', -1, L('_NO_AUTHORITY_TO_ISSUE_A_PROBLEM_WITH_EXCLAMATION_'));
            }
            $this->assign('data', $data);
            $category = $this->questionCategoryModel->getCategoryList(array('status' => 1), 1);
            if(!$aId){
                $data['description']=$category['0']['content'];
                $this->assign('data', $data);
            }
            $this->assign('category', $category);
            $this->assign('edit_title', $title);
            $this->assign('current', 'create');
            $this->display();
        }
    }
    private function _doEdit()
    {
        $aId = I('post.id', 0, 'intval');
        $need_audit = modC('QUESTION_NEED_AUDIT', 1, 'Question');
        if ($aId) {
            $data['id'] = $aId;
            $now_data = $this->questionModel->getData($aId);
            $this->checkAuth('Question/Index/edit', $now_data['uid'], L('_NO_EDITING_THE_PROBLEM_RIGHT_WITH_EXCLAMATION_'));
            if ($need_audit) {
                $data['status'] = 2;
            }
            $this->checkActionLimit('edit_question', 'question', $now_data['id'], get_uid());
        } else {
            $this->checkAuth('Question/Index/add', -1, L('_NO_AUTHORITY_TO_ISSUE_A_PROBLEM_WITH_EXCLAMATION_'));
            $this->checkActionLimit('add_question', 'question', 0, get_uid());
            $data['uid'] = get_uid();
            $data['answer_num'] = $data['good_question'] = 0;
            if ($need_audit) {                $data['status'] = 2;
            } else {
                $data['status'] = 1;
            }
        }
        $data['title'] = I('post.title', '', 'text');
        $data['category'] = I('post.category', 0, 'intval');
        $data['tags'] = I('post.tags', 0, 'text');
        $content = I('post.description', '', 'filter_content');
        if (strlen($content) > 20 && strlen($content) < 40000) {
            $data['description'] = $content;
        } else {
            $this->error(L('描述内容不合法 or 长度不合法'));
        }        /*2016年4月28日新增问答悬赏*/
        $data['leixing'] = I('post.leixing', '', 'op_t');
        $data['score_num'] = I('post.score_num', '', 'op_t');
        $user=M('Member')->where(array('uid'=>is_login()))->find();
        if( $data['score_num']<0){
            $this->error('非法操作，当心我嫩死你。');
        }
        if($user['score'.$data['leixing']]<$data['score_num']){
            $this->error('您的财富值不足。');
        }
        if($data['score_num']>0){
            $rs=D('Ucenter/Score')->setUserScore(is_login(),$data['score_num'],$data['leixing'] ,'dec');
        }
        /*2016年4月28日新增问答悬赏END*/
        if (!mb_strlen($data['title'], 'utf-8')) {
            $this->error(L('_TITLE_CAN_NOT_BE_EMPTY_WITH_EXCLAMATION_'));
        }
        $res = $this->questionModel->editData($data);
        $title = $aId ? L('_EDIT_') : "提";
        if ($res) {            if (!$aId) {
                $aId = $res;
                if ($need_audit) {
                    $this->success($title . L('_SUCCESS_WITH_EXCLAMATION_') . cookie('score_tip') . L('_PLEASE_WAIT_FOR_THE_AUDIT_WALK_THE_WALK_TODAY_WITH_WAVE_'), U('Question/Index/detail', array('id' => $aId)));                }
            }
            if (D('Common/Module')->isInstalled('Weibo')) {//安装了微博模块
                //同步到微博
                $postUrl = "http://$_SERVER[HTTP_HOST]" . U('Question/Index/detail', array('id' => $aId));
                $weiboModel = D('Weibo/Weibo');
                $weiboModel->addWeibo("我问了一个问题【" . $data['title'] . "】：" . $postUrl);
            }
            $this->success($title . L('_SUCCESS_WITH_EXCLAMATION_') . cookie('score_tip'), U('Question/Index/detail', array('id' => $aId)));        } else {
            $this->error($title . L('_PROBLEM_FAILED_WITH_EXCLAMATION_') . $this->questionModel->getError());        }
    }
    private function _getAnswer($question_id, $page = 1, $r = 10, $map = array())
    {        $map['question_id'] = $question_id;
        $map['status'] = 1;
        list($list, $totalCount) = $this->questionAnswerModel->getListByMapPage($map, $page, 'support desc,create_time desc', $r, $field = '*');
        $this->assign('list', $list);
        $this->assign('totalCount', $totalCount);
        return true;
    }
    private function _getList($map, $page = 1, $r = 15, $order = 'create_time desc')
    {
        list($list, $totalCount) = $this->questionModel->getListPageByMap($map, $page, $order, $r, '*');
        foreach ($list as &$val) {
            $val['info'] = msubstr(op_t($val['description']), 0, 200);
            $val['title'] = msubstr(op_t($val['title']), 0, 200);
            $val['img'] = get_pic($val['description']);
            $val['user'] = query_user(array('uid', 'space_url', 'nickname', 'avatar128', 'space_link'), $val['uid']);
            if ($val['best_answer']) {
                $val['best_answer_info'] = $this->questionAnswerModel->getData(array('id' => $val['best_answer'], 'status' => 1));
            } else {
                $val['best_answer_info'] = $this->questionAnswerModel->getData(array('question_id' => $val['id'], 'status' => 1), 'support desc');
            }
            if ($val['best_answer_info']) {
                $val['best_answer_info']['content'] = msubstr(op_t($val['best_answer_info']['content']), 0, 200);
            }
        }
        return array($list, $totalCount);
    }
    public function selectContent(){
        $pid = I('post.pid', '', 'op_t');
        $questionId=I('post.questionId', '', 'op_t');
        if(empty($questionId)){
            $content= M('QuestionCategory')->where(array('id'=>$pid))->find();
        }else{
            exit;
            $content= M('Question')->where(array('id'=>$questionId))->find();
            $content=$content['description'];
        }
        $this->ajaxReturn(array('info'=>$content['content']));
    }
    public function delQuestion(){
        if(!check_auth('Question/Edit/delQuestion')){
            $this->ajaxReturn(array('status'=>0,'info'=>'无操作权限'));
        }
        $questionId=I('post.id', '', 'op_t');
        $rs=M('Question')->where(array('id'=>$questionId))->save(array('status'=>-1));
        if($rs){
            $this->ajaxReturn(array('status'=>1,'info'=>'删除成功'));
        }else{            $this->ajaxReturn(array('status'=>0,'info'=>'删除失败'));
        }
    }
    public function recommendQuestion(){
        if(!check_auth('Question/Edit/recommend')){
            $this->ajaxReturn(array('status'=>0,'info'=>'无操作权限'));
        }
        $questionId=I('post.id', '', 'text');
        $question= M('Question')->where(array('id'=>$questionId))->find();
        if($question['is_recommend']==1){
            M('Question')->where(array('id'=>$questionId))->save(array('is_recommend'=>0));
            $this->ajaxReturn(array('status'=>1,'info'=>'已取消推荐'));
        }else{
            M('Question')->where(array('id'=>$questionId))->save(array('is_recommend'=>1));
            $this->ajaxReturn(array('status'=>1,'info'=>'设置推荐成功！'));
        }
    }
} 