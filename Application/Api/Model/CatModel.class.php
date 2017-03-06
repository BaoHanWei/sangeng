<?php


namespace Api\Model;

use Think\Model;

class CatModel extends Model
{
    public function getDetail($Id)
    {

        $detail = M('CatInfo')->where(array('status' => 1, 'id' => $Id))->find();
        if($detail){
            if(is_login()!=0){
                if(M('CatFav')->where(array('info_id' => $Id, 'uid' => is_login()))->find()) {
                    $detail['is_fav'] =1;
                }else{
                    $detail['is_fav'] =0;
                }
                $res=M('CatRate')->where(array('info_id' => $Id, 'uid' => is_login()))->find();
                if($res){
                    $detail['is_review']=1;
                    $detail['my_rate']=$res['rate'];
                }    else{
                    $detail['is_review']=0;
                }
            }
            $detail['title'] = op_t($detail['title']);
            $detail['create_time'] = time_format($detail['create_time']);
            $detail['update_time'] = time_format($detail['update_time']);
            $detail['over_time'] = time_format($detail['over_time']);
            $detail['reply_count'] =  M('LocalComment')->where(array('status' => 1,'app' => 'cat','mod'=>'index','row_id'=>$Id))->count();
            $detail['share_url']='http://'.$_SERVER['HTTP_HOST'].'/index.php?s=/cat/index/info/info_id/'.$Id.'.html';
            $detail['entity_name'] = M('CatEntity')->where(array('status' => 1, 'id' => $detail['entity_id']))->getField('alias');
            $detail_data = M('CatData')->where(array('status' => 1, 'info_id' => $detail['id']))->select();
            $detail['user']= D('Api/User')->getInfo($detail['uid']);
            foreach ($detail_data as $key=>&$h) {
                $h['value'] = fmatDtlContent($h['value']);
                $name= M('CatField')->where(array('status' => 1, 'id' => $h['field_id']))->find();
                $h['field_chs']=$name['alias'];
                $h['name']=$name['name'];
                if (strpos($h['name'], 'zhaopian') === 0) {
                    if (empty($h['value'])) {
                        $h['value'] = NUll;
                    } else {
                        $h['img_list'] = get_cover($h['value']);
                    }
                }
                $detail['detail_data'][$name['name']]=$h;
            }
            return $detail;
        }
    }




    public function doFav($mid, $info_id)
    {
        $fav['uid'] = $mid;
        $fav['cTime'] = time();
        $fav['info_id'] = $info_id;
        if (M('CatFav')->add($fav)) {
            return true;
        } else {
            return false;
        }
    }


    public function doDisFav($mid, $info_id)
    {
        $fav['uid'] = $mid;
        $fav['info_id'] = $info_id;
        if (M('CatFav')->where($fav)->delete()) {
            return true;
        } else {
            return false;
        }
    }

}