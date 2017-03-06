<?php
namespace Tutorial\Controller;
use Think\Controller;
use Think\Hook;
class BaseController extends Controller
{
    public function _initialize()
    {
        
        if (is_login()) {
            $sub_menu['left'][] = array('tab' => 'my', 'title' => L("_MY_") . L('_MODULE_'), 'href' => is_login() ? U('tutorial/index/my') : "javascript:toast.error('登录后才能操作')");
        } else {
            $sub_menu = array('left'=>array());
        }
        $sub_menu['left'] =array_merge($sub_menu['left'],
            array(
                array('tab' => 'discover', 'href' => U('tutorial/index/discover'), 'title' => L("_DISCOVERY_")),
                array('tab' => 'select', 'title' => L("_BEST_COLLECTION_"), 'href' => U('tutorial/index/select')),
                array('tab' => 'tutorials', 'title' => L('_ALL_') . L('_MODULE_'), 'href' => U('tutorial/index/tutorials')),
            ));
        $sub_menu['right'][] = array('tab' => 'create', 'title' => L("_CREATE_") . L('_MODULE_'), 'href' => check_auth('Tutorial/Index/addTutorial',-1) ? U('tutorial/index/create') : "javascript:toast.error('您无添加群组权限')");
        $sub_menu['right'][] =array('type'=>'search', 'input_title' => L("_INPUT_KEYWORDS_"),'input_name'=>'keywords','from_method'=>'post', 'action' =>U('Tutorial/index/index'));
        $sub_menu['first'] = array('title'=>L('_MODULE_'));
        $this->assign('current', 'home');
        $this->assign('sub_menu',$sub_menu);
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置
    }

    public function index()
    {
        redirect(is_login() ? U('mytutorial') : U('tutorials'));
    }

    protected function parseSearchKey($key = null)
    {
        $action = MODULE_NAME . '_' . CONTROLLER_NAME . '_' . ACTION_NAME;
        $post = I('post.');
        if (empty($post)) {
            $keywords = cookie($action);
        } else {
            $keywords = $post;
            cookie($action, $post);
            $_GET['page'] = 1;
        }
        if (!$_GET['page']) {
            cookie($action, null);
            $keywords = null;
        }
        return $key ? $keywords[$key] : $keywords;
    }

    protected function assignTutorialTypes()
    {
        $tutorialType = D('TutorialType')->getTutorialTypes();
        $this->assign($tutorialType);
        return $tutorialType;
    }

    protected function assignTutorial($id)
    {
        $tutorial = D('Tutorial/Tutorial')->getTutorial($id);
        $this->assign('tutorial', $tutorial);
        return $tutorial;
    }

    protected function assignNotice($tutorial_id)
    {
        $notice = D('TutorialNotice')->getNotice($tutorial_id);
        $this->assign('notice', $notice);
        return $notice;
    }

    protected function assignPostCategory($tutorial_id = 0)
    {
        $map['status'] = 1;
        $tutorial_id && $map['tutorial_id'] = $tutorial_id;
        $cate = D('TutorialPostCategory')->getList(array('where' => $map, 'order' => 'sort asc'));
        foreach ($cate as &$v) {
            $v = D('TutorialPostCategory')->getPostCategory($v);
        }
        $this->assign('post_cate', $cate);
        return $cate;
    }


    protected function assignTutorialAllType()
    {
        $tutorialType = $this->assignTutorialTypes();
        foreach ($tutorialType['parent'] as $k => $v) {
            $child = $tutorialType['child'][$v['id']];
            //获取数组中第一父级的位置
            $key_name = array_search($v, $tutorialType['parent']);
            foreach ($child as $key => $val) {
                $val['title'] = '------' . $val['title'];
                //在父级后面添加数组
                array_splice($tutorialType['parent'], $key_name + 1, 0, array($val));
            }
        }
        $this->assign('tutorialTypeAll', $tutorialType['parent']);

    }

    protected function getTutorialIdByPost($post_id)
    {
        $post = D('TutorialPost')->getPost($post_id);
        return $post['tutorial_id'];

    }


    protected function requireLogin()
    {
        if (!is_login()) {
            $this->error(L('_OPERATE_NEED_LOGIN_'));
        }
    }

    protected function requireTutorialExists($tutorial_id)
    {
        if (!tutorial_is_exist($tutorial_id)) {
            $this->error(L('_NO_GROUP_'));
        }
    }

    protected function requirePostExists($post_id)
    {
        if (!post_is_exist($post_id)) {
            $this->error(L('_NO_POST_'));
        }
    }

} 