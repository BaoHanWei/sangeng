<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-29
 * Time: 下午5:22
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Api\Model;

use Think\Model;

class ShopModel extends Model
{
     public function getType($id = 0, $field = true){
        /* 获取当前分类信息 */
        if($id){
            $info = $this->info($id);
            $id   = $info['id'];
        }

        /* 获取所有分类 */
        $map  = array('status' => array('gt', -1));
        $list = D('Shop/ShopCategory')->field($field)->where($map)->order('sort')->select();
        $list = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'child', $root = $id);


        /* 获取返回数据 */
        if(isset($info)){ //指定分类则返回当前分类极其子分类
            $info['child'] = $list;
        } else { //否则返回所有分类
            $info = $list;
        }

        return $info;
    }
    public function info($id, $field = true){
        /* 获取分类信息 */
        $map = array();
        if(is_numeric($id)){ //通过ID查询
            $map['id'] = $id;
        } else { //通过标识查询
            $map['name'] = $id;
        }
        return $this->field($field)->where($map)->find();
    }

    public function getGoodsInfo($id)
    {
        $goods = D('Shop/Shop')->where(array('id' => $id))->find();
        $goods['goods_name'] = text($goods['goods_name']);
        $goods['goods_introduct'] = text($goods['goods_introduct']);
        $goods['goods_detail'] = fmatDtlContent($goods['goods_detail']);
        if($goods['sell_num']< modC('SHOP_HOT_SELL_NUM',10,'Shop')){
            $goods['is_hot']=0;
        }else{
            $goods['is_hot']=1;
        }

        $app = 'Shop';
        $mod = 'goodsDetail';
        $map['row_id'] = $id;
        $map['mod'] = $mod;
        $map['app'] = $app;
        $map['status'] = 1;
        $goods['share_url']='http://'.$_SERVER['HTTP_HOST'].'/'.'goods/'.'detail_'.$id.'.html';
        $goods['goods_comment']=D('LocalComment')->where($map)->count();
        $goods['goods_icon']=render_picture_path_without_root(get_cover($goods['goods_ico'], 'path'));
        $goods['changetime'] = time_format($goods['changetime']);
        $goods['createtime'] = time_format($goods['createtime']);
        return $goods;
    }


    public function getComment($id)
    {
        $Comments=D('LocalComment')->where(array('id' => $id))->find();
        $Comments['content'] = op_t($Comments['content']);
        $Comments['user'] =D('Api/User')-> getUserReduceInfo($Comments['uid']);
        $Comments['create_time'] = friendlyDate($Comments['create_time']);


        return $Comments;
    }
    public function setUserScore($uids, $score, $type, $action = 'inc',$action_model ='',$record_id=0,$remark='')
    {

        $model = D('Member');
        switch ($action) {
            case 'inc':
                $score = abs($score);
                $res = $model->where(array('uid' => array('in', $uids)))->setInc('score' . $type, $score);
                break;
            case 'dec':
                $score = abs($score);
                $res = $model->where(array('uid' => array('in', $uids)))->setDec('score' . $type, $score);
                break;
            case 'to':
                $res = $model->where(array('uid' => array('in', $uids)))->setField('score' . $type, $score);
                break;
            default:
                $res = false;
                break;
        }

        if(!($action != 'to' && $score == 0)){
            $this->addScoreLog($uids,$type,$action,$score,$action_model,$record_id,$remark);
        }

        foreach ($uids as $val) {
            $this->cleanUserCache($val,$type);
        }
        unset($val);
        return $res;
    }


    public function addScoreLog($uid, $type, $action='inc',$value=0, $model='',$record_id=0,$remark='')
    {
        $uid = is_array($uid) ? $uid : explode(',',$uid);
        foreach($uid as $v){
            $score = D('Member')->where(array('uid'=>$v))->getField('score'.$type);
            $data['uid'] = $v;
            $data['ip'] = ip2long(get_client_ip());
            $data['type'] = $type;
            $data['action'] = $action;
            $data['value'] = $value;
            $data['model'] = $model;
            $data['record_id'] = $record_id;
            $data['finally_value'] = $score;
            $data['remark'] = $remark;
            $data['create_time'] = time();
            D('score_log')->add($data);
        }
        return true;
    }

    public function cleanUserCache($uid,$type){
        $uid = is_array($uid) ? $uid : explode(',',$uid);
        $type = is_array($type)?$type:explode(',',$type);
        foreach($uid as $val){
            foreach($type as $v){
                clean_query_user_cache($val, 'score' . $v);
            }
            clean_query_user_cache($val, 'title');
        }
    }
}