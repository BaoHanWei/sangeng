<?php
namespace Ucenter\Model;

use Think\Model;

class ProjectModel extends Model
{

    private $typeModel = null;

    protected function _initialize()
    {
        parent::_initialize();
        $this->typeModel = M('blog_project');
    }

    /**
     * 获取项目的文档树
     * @param int $project_id
     * @return array
     */
    public static function getProjectTree($project_id)
    {
        if(empty($project_id)){
            return [];
        }
        $tree = M("blog")->field("id,title,doc_parent_id")->where('doc_project_id='.$project_id)
            ->order('doc_sort ASC')
            ->select();
        $jsonArray = [];
        if(empty($tree) === false){
            foreach ($tree as $key => $value) {
               $tmp['id'] = $value['id'].'';
               $tmp['text'] = $value['title'];
               $tmp['parent' ] = ($value['doc_parent_id'] == 0 ? '#' : $value['doc_parent_id']).'';
               $jsonArray[] = $tmp;
            }
        }
        return $jsonArray;
    }
    /**
     * 获取项目的文档树Html结构
     * @param int $project_id
     * @param int $selected_id
     * @return string
     */
    public static function getProjectHtmlTree($project_id,$selected_id = 0)
    {
        if(empty($project_id)){
            return [];
        }
        $tree = M("blog")->field("id,title,doc_parent_id")->where('doc_project_id='.$project_id)
            ->order('doc_sort ASC')
            ->select();

        if(empty($tree) === false){
            $parent_id = self::getSelecdNode($tree,$selected_id);
            return self::createTree(0,$tree,$selected_id,$parent_id);
        }
        return [];
    }

    protected static function getSelecdNode($array,$parent_id)
        {
            foreach ($array as $item){
                if($item['id'] == $parent_id and $item['doc_project_id'] == 0){
                    return $item['id'];
                }elseif ($item['id'] == $parent_id and $item['doc_project_id'] != 0){
                    return self::getSelecdNode($array,$item['doc_project_id']);
                }
            }
            return 0;
        }

        protected static function createTree($parent_id,$array,$selected_id = 0,$selected_parent_id = 0){
            global $menu;
            $menu .= '<ul>';
            foreach ($array as $item){
                if($item['doc_project_id'] == $parent_id) {
                    $selected = $item['id'] == $selected_id ? ' class="jstree-clicked"' : '';
                    $selected_li = $item['id'] == $selected_parent_id ? ' class="jstree-open"' : '';

                    $menu .= '<li id="'.$item['id'].'"'.$selected_li.'><a href="'.U('Blog/column/show',array('id'=>$item['id'])).'" title="' . htmlspecialchars($item['title']) . '"'.$selected.'>' . $item['title'] .'</a>';

                    $key = array_search($item['id'], array_column($array, 'doc_project_id'));
                    if ($key !== false) {
                        self::createTree($item['id'], $array,$selected_id,$selected_parent_id);
                    }
                    $menu .= '</li>';
                }
            }
            $menu .= '</ul>';
            return $menu;
        }
    /**
     * 获取项目分页
     * @param int 
     * @return array
     */
    public function getListByPage($map, $page = 1, $order = 'update_time desc', $field = '*', $r = 20)
    {
        $totalCount = $this->typeModel->where($map)->count();
        if ($totalCount) {
            $list = $this->typeModel->where($map)->page($page, $r)->order($order)->field($field)->select();
        }
        return array($list, $totalCount);
    }

}