<?php


namespace Api\Model;
use Common\Model\ContentHandlerModel;
use Think\Model;

class QuestionModel extends Model
{
    public function getQuestionDetail($id)
    {
        $Question = D('Question/Question')->where(array('id' => $id))->find();
        $Question['user'] = query_user(array('uid', 'title', 'nickname','avatar128','rank_link'),$Question['uid']);
        $Question['description'] = fmatDtlContent($Question['description']);
        $Question['user']['avatar128']=render_picture_path_without_root($Question['user']['avatar128']);
        $Question['create_time'] = friendlyDate($Question['create_time']);

        $Question['update_time'] = friendlyDate($Question['update_time']);
        $Question['share_url']='http://'.$_SERVER['HTTP_HOST'].'/index.php?s=/question/index/detail/id/'.$id.'.html';
        return $Question;
    }

    public function getAnswer($id,$mid){
        if(!$mid){
            $answer['support']=-1;
        }else{
            if(D('Question/QuestionSupport')->where(array('uid'=>$mid,'row'=>$id))->count()){
                $answer['support']=1;
            }else{
                $answer['support']=0;
            }
        }
        $Answer = D('Question/QuestionAnswer')->where(array('id' => $id))->find();
        $arr = array();
        $Answer['content'] = fmatDtlContent($Answer['content']);
        $Answer['user'] = query_user(array('uid', 'title', 'nickname','avatar128','rank_link'),$Answer['uid']);

        $Answer['user']['avatar128']=render_picture_path_without_root($Answer['user']['avatar128']);
        $Answer['create_time'] = friendlyDate($Answer['create_time']);
        $Answer['update_time'] = friendlyDate($Answer['update_time']);

        return $Answer;
    }



    public function changeNum($id, $type = 1)
    {

        if ($type) {
            $field = 'support';
        } else {
            $field = 'oppose';
        }
        $res = D('Question/QuestionAnswer')->where(array('id' => $id))->setInc($field);
        return $res;
    }


    public function editData($data,$mid)
    {
        $contentHandler=new ContentHandlerModel();
        if(isset($data['description'])){

            $data['description']=$contentHandler->filterHtmlContent($data['description']);

        }

        if($data['id']){
            $data['update_time']=time();
            $res=$this->save($data);
            if($res){
                action_log('edit_question','question',$data['id'],$mid);
            }
        }else{
            !$data['category']&&$data['category']=1;
            $data['create_time']=$data['update_time']=time();
            $res=$this->add($data);
            if($res){
                action_log('add_question','question',$res,$mid);
            }
        }
        return $res;
    }
}