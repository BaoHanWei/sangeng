<?php
namespace Admin\Controller;
use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminTreeListBuilder;
class QuestionController extends AdminController
{
    private $questionModel;
    private $questionAnswerModel;
    private $questionCategoryModel;
    private $questionSupportModel;
    public function _initialize()
    {
        parent::_initialize();
        $this->questionModel = D('Question/Question');
        $this->questionAnswerModel = D('Question/QuestionAnswer');
        $this->questionCategoryModel = D('Question/QuestionCategory');        
        $this->questionSupportModel = D('Question/QuestionSupport');
    }
    
    // 分类管理
    public function category()    
    {        
        // 显示页面
        $builder = new AdminTreeListBuilder();        
        $tree = $this->questionCategoryModel->getTree(0, 'id,title,sort,pid,status');        
        $builder->title(L('_PROBLEM_CLASSIFICATION_MANAGEMENT_'))->suggest(L('_DISABLE_DELETE_AND_TRANSFER_THE_PROBLEM_TO_THE_DEFAULT_CATEGORY_UNDER_CLASSIFICATION_'))
        ->buttonNew(U('Question/add'))
        ->data($tree)
        ->display();
    }

    /**
     * 分类添加  
     * @param int $id         
     * @param int $pid            
     * @author 郑钟良<zzl@ourstu.com>    
     */
    public function add($id = 0, $pid = 0)
    
    {
        $title = $id ? L('_EDIT_') : L('_NEW_');        
        if (IS_POST) {            
            if ($this->questionCategoryModel->editData()) {                
                // S('SHOW_EDIT_BUTTON',null);                
                $this->success($title . L('_CLASSIFICATION_SUCCESS_WITH_PERIOD_'), U('Question/category'));
            } else {                
                $this->error($title . L('_CLASSIFICATION_FAILED_WITH_EXCLAMATION_') . $this->questionCategoryModel->getError());
            }
        } else {            
            $builder = new AdminConfigBuilder();            
            if ($id != 0) {                
                $data = $this->questionCategoryModel->find($id);
            } else {                
                $father_category_pid = $this->questionCategoryModel->where(array(
                    'id' => $pid
                ))->getField('pid');                
                if ($father_category_pid != 0) {                    
                    $this->error(L('_CLASSIFICATION_CAN_NOT_EXCEED_TWO_LEVELS_WITH_EXCLAMATION_'));
                }
            }            
            if ($pid != 0) {                
                $categorys = $this->questionCategoryModel->where(array(
                    'pid' => 0,
                    'status' => array(
                        'egt',
                        0
                    )
                ))->select();
            }            
            $opt = array();            
            foreach ($categorys as $category) {                
                $opt[$category['id']] = $category['title'];
            }            
            $builder->title($title . L('_CLASSIFICATION_'))
            ->data($data)
            ->keyId()
            ->keyText('title', L('_TITLE_'))
            ->keySelect('pid', L('_FATHER_CLASSIFICATION_'), L('_SELECT_THE_PARENT_CLASS_'), array('0' => L('_TOP_CLASSIFICATION_')) + $opt)
            ->keyDefault('pid', $pid)
            ->keyInteger('sort', '排序')
            ->keyDefault('sort', 0)
            ->keyStatus()
            ->keyDefault('status', 1)
            ->buttonSubmit(U('Question/add'))
            ->buttonBack()
            ->display();
        }
    }
    /**
     * 设置问题分类状态：删除=-1，禁用=0，启用=1
     * @param $ids        
     * @param $status       
     * @author 郑钟良<zzl@ourstu.com>  
     */
    public function setStatus($ids, $status)    
    {
        ! is_array($ids) && $ids = explode(',', $ids);  
        if (in_array(1, $ids)) {            
            $this->error('id为 1 的分类是问题基础分类，不能被禁用、删除！');
        }        
        if ($status == 0 || $status == - 1) {            
            $map['category'] = array(
                'in',
                $ids
            );            
            $this->questionModel->where($map)->setField('category', 1);
        }        
        $builder = new AdminListBuilder();        
        $builder->doSetStatus('QuestionCategory', $ids, $status);
    }    
    // 分类管理 end
    public function config()    
    {
        $builder = new AdminConfigBuilder();        
        $data = $builder->handleConfig();        
        $builder->title(L('_QUESTION_AND_ANSWER_BASE_SET_'))->
        data($data);        
        $builder->keyRadio('QUESTION_NEED_AUDIT', L('_IS_THE_PROBLEM_NEED_TO_BE_REVIEWED_'), '', array(
            '0' => '否',
            '1' => '是'
        ))
            ->keyDefault('QUESTION_NEED_AUDIT', 1)
            ->
        keyInteger('QUESTION_ANSWER_MIN_NUM', L('_QUESTION_ANSWER_AT_LEAST_NUMBER_OF_WORDS_'))
            ->keyDefault('QUESTION_ANSWER_MIN_NUM', 20)
            ->
        keyText('QUESTION_SHOW_TITLE', '标题名称', L('_IN_THE_HOME_PAGE_SHOW_BLOCK_OF_THE_TITLE_'))
            ->keyDefault('QUESTION_SHOW_TITLE', L('_HOT_ISSUE_'))
            ->
        keyText('QUESTION_SHOW_COUNT', L('_SHOW_THE_NUMBER_OF_QUESTIONS_'), L('_ONLY_AFTER_THE_SITE_HAS_BEEN_ENABLED_IN_THE_HOME_PAGE_MODULE_WILL_BE_DISPLAYED_'))
            ->keyDefault('QUESTION_SHOW_COUNT', 4)
            ->
        keyRadio('QUESTION_SHOW_TYPE', L('_RANGE_OF_ISSUES_'), '', array(
            '1' => L('_BACKGROUND_'),
            '0' => L('_ALL_')
        ))
            ->keyDefault('QUESTION_SHOW_TYPE', 0)
            ->
        keyRadio('QUESTION_SHOW_ORDER_FIELD', L('_SORT_VALUE_'), L('_DISPLAY_MODULE_DATA_SORTING_METHOD_'), array(
            'answer_num' => L('_ANSWER_A_FEW_'),
            'create_time' => L('_PUBLICATION_TIME_'),
            'update_time' => L('_UPDATE_TIME_')
        ))
            ->keyDefault('QUESTION_SHOW_ORDER_FIELD', 'answer_num')
            ->
        keyRadio('QUESTION_SHOW_ORDER_TYPE', L('_SORT_OF_'), L('_DISPLAY_MODULE_DATA_SORTING_METHOD_'), array(
            'desc' => L('_THE_REVERSE_FROM_LARGE_TO_SMALL_'),
            'asc' => L('_THE_POSITIVE_FROM_SMALL_TO_LARGE_')
        ))
            ->keyDefault('QUESTION_SHOW_ORDER_TYPE', 'desc')
            ->
        keyText('QUESTION_SHOW_CACHE_TIME', L('_CACHE_TIME_'), L('_DEFAULT_600_SECONDS_IN_SECONDS_'))
            ->keyDefault('QUESTION_SHOW_CACHE_TIME', '600')
            ->
        group(L('_BASIC_CONFIGURATION_'), 'QUESTION_NEED_AUDIT,QUESTION_ANSWER_MIN_NUM')
            ->group(L('_HOME_PAGE_DISPLAY_CONFIGURATION_'), 'QUESTION_SHOW_TITLE,QUESTION_SHOW_COUNT,QUESTION_SHOW_TYPE,QUESTION_SHOW_ORDER_FIELD,QUESTION_SHOW_ORDER_TYPE,QUESTION_SHOW_CACHE_TIME')
            ->
        buttonSubmit()
            ->buttonBack()
            ->
        display();
    }

    public function index($page = 1, $r = 20)    
    {
        $aStatus = I('get.status', 0, 'intval');        
        if ($aStatus == 0) {            
            $map['status'] = 1;
        } elseif ($aStatus == 1) {            
            $map['status'] = 2;
        } else {            
            $map['status'] = 0;
        }        
        list ($list, $totalCount) = $this->questionModel->getListPageByMap($map, $page, 'is_recommend desc,create_time desc', $r, '*');        
        $builder = new AdminListBuilder();        
        $builder->title(L('_QUESTION_LIST_PAGE_'));        
        $builder->setSelectPostUrl(U('Question/index'))->
        select('', 'status', 'select', '', '', '', array(
            array(
                'id' => 0,
                'value' => L('_CURRENT_PROBLEMS_ENABLE_')
            ),
            array(
                'id' => 1,
                'value' => L('_NOT_AUDITED_')
            ),
            array(
                'id' => 2,
                'value' => L('_AUDIT_FAILED_OR_DISABLED_')
            )
        ));        
        $builder->setStatusUrl(U('Question/setQuestionStatus'));        
        if ($aStatus == 1) {            
            $builder->buttonEnable(null, L('_AUDIT_THROUGH_'))
                ->buttonDisable(null, L('_AUDIT_FAILURE_'))
                ->buttonDelete(null, L('_DELETE_DIRECTLY_'));
        } elseif ($aStatus == 2) {            
            $builder->buttonEnable(null, L('_ENABLE_OR_AUDIT_THROUGH_'))->buttonDelete();
        } else {            
            $builder->buttonEnable()
                ->buttonDisable()
                ->buttonDelete()
                ->ajaxButton(U('Question/recommend'), array(
                'recommend' => 1
            ), L('_SET_UP_RECOMMEND_'))
                ->ajaxButton(U('Question/recommend'), array(
                'recommend' => 0
            ), L('_CANCEL_RECOMMENDATION_'));
        }
        
        $builder->keyId()
            ->keyLink('title', L('_TITLE_'), 'Question/Index/detail?id=###')
            ->keyUid()
            ->keyText('category', L('_CLASSIFICATION_'))
            ->keyBool('is_recommend', L('_WHETHER_IT_IS_RECOMMENDED_'))
            ->keyCreateTime()
            ->keyUpdateTime()
            ->keyStatus();
        
        $builder->pagination($totalCount, $r)
            ->data($list)
            ->display();
    }
    public function recommend($ids, $recommend = 1)    
    {
        ! is_array($ids) && $ids = explode(',', $ids);        
        $map['id'] = array(
            'in',
            $ids
        );        
        $res = $this->questionModel->where($map)->setField('is_recommend', $recommend);        
        if ($res) {            
            if ($recommend == 1) {                
                $messageModel = D('Message');                
                foreach ($ids as $val) {                    
                    /**
                     * @param $to_uid 接受消息的用户ID            
                     * @param string $content 内容        
                     * @param string $title  标题，默认为 您有新的消息 
                     * @param $url 链接地址，不提供则默认进入消息中心            
                     * @param $int $from_uid  发起消息的用户，根据用户自动确定左侧图标，如果为用户，则左侧显示头像
                     * @param int $type 消息类型，0系统，1用户，2应用
                     *            
                     */              
                    $question = $this->questionModel->find($val);                    
                    $messageModel->sendMessage($question['uid'], L('_PROBLEM_IS_RECOMMENDED_'), '你的问题【' . $question['title'] . '】被管理员设为推荐！', 'Question/Index/detail', array(
                        'id' => $val
                    ), is_login(), 0);
                }
            }            
            $this->success(L('_OPERATION_SUCCESS_WITH_EXCLAMATION_'));
        } else {            
            $this->error(L('_OPERATION_FAILED_WITH_EXCLAMATION_'));
        }
    }

    public function setQuestionStatus($ids, $status = 1)    
    {
        ! is_array($ids) && $ids = explode(',', $ids);        
        $builder = new AdminListBuilder();        
        if ($status == 0 || $status == - 1) {            
            $map['question_id'] = array(
                'in',
                $ids
            );            
            $this->questionAnswerModel->where($map)->setField('status', $status);
        }        
        $messageModel = D('Message');        
        if ($status == 1) {            
            foreach ($ids as $val) {                
                /**
                 * @param $to_uid 接受消息的用户ID            
                 * @param string $content 内容        
                 * @param string $title  标题，默认为 您有新的消息 
                 * @param $url 链接地址，不提供则默认进入消息中心            
                 * @param $int $from_uid  发起消息的用户，根据用户自动确定左侧图标，如果为用户，则左侧显示头像
                 * @param int $type 消息类型，0系统，1用户，2应用
                 *            
                 */
                $question = $this->questionModel->find($val);                
                if ($question['status'] == 2) {                    
                    $messageModel->sendMessage($question['uid'], L('_THE_PROBLEM_IS_REVIEWED_'), '你的问题【' . $question['title'] . '】通过了审核！！', 'Question/Index/detail', array(
                        'id' => $val
                    ), is_login(), 2);
                }
            }
        } else 
            if ($status == 0) {                
                foreach ($ids as $val) {                    
                    /**
                     *
                     * @param $to_uid 接受消息的用户ID            
                     * @param string $content 内容
                     * @param string $title 标题，默认为 您有新的消息
                     * @param $url 链接地址，不提供则默认进入消息中心            
                     * @param $int $from_uid 发起消息的用户，根据用户自动确定左侧图标，如果为用户，则左侧显示头像
                     * @param int $type 消息类型，0系统，1用户，2应用
                     *            
                     */
                    $question = $this->questionModel->find($val);                    
                    if ($question['status'] == 2) {                        
                        $messageModel->sendMessage($question['uid'], L('_PROBLEM_AUDIT_FAILED_'), '你的问题【' . $question['title'] . '】没有通过审核！！', 'Question/Index/detail', array(
                            'id' => $val
                        ), is_login(), 2);
                    }
                }
            } else {                
                foreach ($ids as $val) {                    
                    /**
                     * @param $to_uid 接受消息的用户ID            
                     * @param string $content 内容  
                     * @param string $title 标题，默认为 您有新的消息
                     * @param $url 链接地址，不提供则默认进入消息中心            
                     * @param $int $from_uid 发起消息的用户，根据用户自动确定左侧图标，如果为用户，则左侧显示头像
                     * @param int $type 消息类型，0系统，1用户，2应用
                     *            
                     */
                    $question = $this->questionModel->find($val);                    
                    if ($question['status'] == 2) {                        
                        $messageModel->sendMessage($question['uid'], L('_PROBLEM_AUDIT_FAILED_'), '你的问题【' . $question['title'] . '】被管理员直接删除！！', 'Question/Index/myQuestion', is_login(), 2);
                    }
                }
            }        
        $builder->doSetStatus('Question', $ids, $status);
    }

    public function answer($page = 1, $r = 20)    
    {
        list ($list, $totalCount) = $this->questionAnswerModel->getSimpleListPage(array(
            'status' => array(
                'egt',
                0
            )
        ), $page, 'create_time desc', $r);
        
        foreach ($list as &$val) {            
            $question = $this->questionModel->getData($val['question_id']);            
            $val['question'] = '<a target="_black" href="' . U('Question/Index/detail', array(
                'id' => $val['question_id']
            )) . '">' . $question['title'] . '</a>';
            
            $val['content'] = msubstr(text($val['content']), 0, 100);            
            if ($question['best_answer'] == $val['id']) {                
                $val['best_answer'] = 1;
            } else {                
                $val['best_answer'] = 0;
            }
        }        
        $builder = new AdminListBuilder();        
        $builder->title(L('_ANSWER_LIST_'))->
        setStatusUrl(U('Question/setAnswerStatus'))->
        buttonEnable()
            ->buttonDisable()
            ->buttonDelete()
            ->
        keyId()
            ->
        keyUid()
            ->
        keyText('question', L('_PROBLEM_'))
            ->
        keyText('content', L('_ANSWER_CONTENT_'))
            ->
        keyBool('best_answer', L('_IS_THE_BEST_ANSWER_'))
            ->
        keyStatus()
            ->
        keyUpdateTime()
            ->
        keyCreateTime()
            ->
        pagination($totalCount, $r)
            ->
        data($list)
            ->
        display();
    }
    public function setAnswerStatus($ids, $status = 1)    
    {
        ! is_array($ids) && $ids = explode(',', $ids);        
        $builder = new AdminListBuilder();        
        if ($status == 0 || $status == - 1) {            
            $map['best_answer'] = array(
                'in',
                $ids
            );            
            $best_ids = $this->questionModel->getList($map, 'best_answer');            
            if (count($best_ids)) {                
                $best_ids = array_column($best_ids, 'best_answer');                
                $best_ids = implode(',', $best_ids);                
                $this->error("id 为 {$best_ids} 的答案是问题的最佳答案，不能被禁用或删除！");
            }
        }
        
        if ($status == - 1) {            
            foreach ($ids as &$v) {                
                M('Question')->where(array(
                    'id' => $v
                ))->setDec('answer_num', 1);
            }
        }        $builder->doSetStatus('QuestionAnswer',$ids,$status);
    }
} 