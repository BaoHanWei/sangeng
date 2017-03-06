<?php

namespace Admin\Controller;

use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;

class ApiController extends AdminController
{
    public function index()
    {
        $this->redirect('config');
    }

    public function config()
    {
        $builder = new AdminConfigBuilder();
        $data = $builder->handleConfig();
        $data['accesstoken'] = md5(base64_encode($data['ACCESS_TOKEN']));
        $data['app_version'] = $data['APP_VERSION'];
        $builder->title('基本设置')
            ->data($data)
            ->keyText('ACCESS_TOKEN', 'access_token', '应用的access_token，输入一个字符串，系统将进行加密。')
            ->keyDefault('ACCESS_TOKEN', 'xxxxxxx')
            ->keyLabel('accesstoken', '以下部分为access_token', '加密后的token，应用最终使用的access_token')
            ->keyText('APP_VERSIONS', 'APP最新版本号')
            ->keyText('APP_VERSION', '允许运行的最低客户端版本号', '例如：1.0.0，不填表示支持所有版本')
            ->keyText('APP_MOD_URL', 'APP外部下载地址')
            ->keySingleFile('APP_MOD_FILE', '安卓客户端下载链接', '仅供安卓平台自动升级需要的安装包')
            ->buttonSubmit('', '保存');
        $builder->display();
    }

    public function sort()
    {
        $builder = new AdminConfigBuilder();
        $data = $builder->handleConfig();
        $mod_list = D('module')->where(array('is_setup' => 1))->select();
        foreach ($mod_list as $k => &$val) {
            $val = array('data-id' => $val['name'], 'title' => $val['alias']);
        }
        unset($val);
        $default = array(array('data-id' => 'disable', 'title' => '未加入应用模块', 'items' => $mod_list), array('data-id' => 'enable', 'title' => '应用开启', 'items' => array()));
        $data['SHOW_MOD_TAB'] = $builder->parseKanbanArray($data['SHOW_MOD_TAB'], $mod_list, $default);
        $builder->title('APP相关')
            ->keyBool('IS_NEED_ADMIN', '是否允许客户端用户自行配置', '默认为否')
            ->keyKanban('SHOW_MOD_TAB', '开启客户端模块列表')
            ->data($data)
            ->keyDefault('IS_NEED_ADMIN', 0)
            ->buttonSubmit()
            ->display();
    }

   public function setCatIcon($page = 1, $r = 20){
       $data = D('cat_entity')->where('status>-1')->page($page, $r)->order('sort desc')->select();
       $totalCount = D('cat_entity')->where('status>-1')->count();
       $listBuilder = new AdminListBuilder();

       $listBuilder->title('客户端图标')
           ->keyId()
           ->key('alias', '分类名称','')
           ->keyImage('app_icon','客户端图标')
           ->keyDoActionEdit('editCat?entity_id=###','修改')
           ->data($data)
           ->pagination($totalCount, $r);
       $listBuilder->display();
   }

    /**分类信息分类图标
     * @param int $entity_id
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    public function editCat($entity_id=0){
        $entity_id = intval($entity_id);
        $configBuilder = new AdminConfigBuilder();
        if ($entity_id != 0) {
            $entity = D('cat_entity')->find($entity_id);
        }
        if (IS_POST) {
            $entity = D('cat_entity')->create();
            $entity['status'] = 1;
            $rs = D('cat_entity')->save($entity);
            if ($rs) {
                $this->success('操作成功。');
            } else {
                $this->error('操作失败。');
            }
        }else{
            $configBuilder->title('客户端图标配置')
                ->keyId()
                ->keyLabel('alias', '中文名称')
                ->keySingleImage('app_icon','选择客户端图标')
                ->buttonSubmit()
                ->buttonBack()
                ->data($entity)
                ->display();
        }
    }

    /**用于配置个推服务的授权信息
     * @author 胡佳雨 <hjy@ourstu.com>.
     */
    public function igtConfig(){
        $builder = new AdminConfigBuilder();
        $data = $builder->handleConfig();
        $data['igt_open'] = $data['IGT_OPEN'];
        $data['igt_appid'] = $data['IGT_APPID'];
        $data['igt_appkey'] = $data['IGT_APPKEY'];
        $data['igt_mastersecret'] = $data['IGT_MASTERSECRET'];
        $builder->title('个推配置')
            ->data($data)
            ->keyBool('IGT_OPEN','是否开启推送服务','默认为否')
            ->keyDefault('IGT_OPEN', 0)
            ->keyText('IGT_APPID', 'appid', '个推所给的APPID')
            ->keyText('IGT_APPKEY', 'apkey', '个推所给的APPKEY')
            ->keyText('IGT_MASTERSECRET', 'mastersecret', '个推所给的MASTERSECRET')
            ->buttonSubmit('', '保存');
        $builder->display();
    }
}