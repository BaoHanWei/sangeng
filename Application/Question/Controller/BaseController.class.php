<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-7
 * Time: 上午9:30
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Question\Controller;


use Think\Controller;

class BaseController extends Controller{
    protected  $questionModel;
    protected $questionAnswerModel;
    protected $questionCategoryModel;
    protected $questionSupportModel;

    public function _initialize()
    {
        $this->questionModel=D('Question/Question');
        $this->questionAnswerModel=D('Question/QuestionAnswer');
        $this->questionCategoryModel=D('Question/QuestionCategory');
        $this->questionSupportModel=D('Question/QuestionSupport');

        $sub_menu =
            array(
                'left' =>
                    array(
                        array('tab' => 'waitAnswer', 'title' => L('_WAITING_TO_ANSWER_'), 'href' => U('Question/Index/waitAnswer')),
                        array('tab' => 'goodQuestion', 'title' => L('_HOT_ISSUE_'), 'href' => U('Question/Index/goodQuestion')),
                        array('tab' => 'myQuestion', 'title' => L('_ME_') . $this->MODULE_ALIAS, 'href' => is_login() ? U('Question/Index/myQuestion') : "javascript:toast.error('".L('_LOG_IN_TO_THE_OPERATION_')."')"),
                        array('tab' => 'questions', 'title' => L('_ALL_') . $this->MODULE_ALIAS, 'href' => U('Question/Index/questions')),
                    ),
                'right' =>
                    array(
                        array('tab'=>'create','title' => '<i class="icon-edit"></i> 提问', 'href' =>is_login()?U('Question/index/edit'):"javascript:toast.error('".L('_LOG_IN_TO_THE_OPERATION_')."')"),
                        array('type'=>'search', 'input_title' => L('_ENTER_THE_KEYWORD_'),'input_name'=>'keywords','from_method'=>'post', 'action' =>U('Question/index/search')),
                    )
            );
        $this->assign('sub_menu', $sub_menu);
    }

    protected  function _needLogin()
    {
        if(!is_login()){
            $this->error(L('_PLEASE_LOG_IN_WITH_EXCLAMATION_'));
        }
    }
} 