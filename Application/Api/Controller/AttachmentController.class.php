<?php


namespace Api\Controller;


class AttachmentController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }



    public function uploadPicture()
    {
        $aData = I_POST('data');
        $aExt = I_POST('ext');
        if ($aData == '' || $aData == 'undefined') {
            $this->apiError('参数错误');
        }

        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $aData, $result)) {
            $base64_body = substr(strstr($aData, ','), 1);
            empty($aExt) && $aExt = $result[2];
        } else {
            $base64_body = $aData;
        }

        if(!in_array($aExt,array('jpg','gif','png','jpeg'))){
            $this->ajaxReturn(array('status'=>0,'info'=>'非法操作'));
        }
        $hasPhp=base64_decode($base64_body);
        if (strpos($hasPhp, '<?php') !==false) {
            $this->ajaxReturn(array('status' => 0, 'info' => '非法操作'));
        }

        $pictureModel = D('Picture');
        $md5 = md5($base64_body);
        $sha1 = sha1($base64_body);

        $check = $pictureModel->where(array('md5' => $md5, 'sha1' => $sha1))->find();

        if ($check) {
            //已存在则直接返回信息
            $return['id'] = $check['id'];
            $return['path'] = render_picture_path_without_root($check['path']);

            $this->apiSuccess($return);
        } else {
            //不存在则上传并返回信息
            $driver = modC('PICTURE_UPLOAD_DRIVER','local','config');
            $driver = check_driver_is_exist($driver);
            $date = date('Y-m-d');
            $saveName = uniqid();
            $savePath = '/Uploads/Picture/' . $date . '/';

            $path = $savePath . $saveName . '.' . $aExt;
            if($driver == 'local'){
                //本地上传
                mkdir('.' . $savePath, 0777, true);
                $data = base64_decode($base64_body);
                $rs = file_put_contents('.' . $path, $data);
            }
            else{
                $rs = false;
                //使用云存储
                $name = get_addon_class($driver);
                if (class_exists($name)) {
                    $class = new $name();
                    if (method_exists($class, 'uploadBase64')) {
                        $path = $class->uploadBase64($base64_body,$path);
                        $rs = true;
                    }
                }
            }
            if ($rs) {
                $pic['type'] = $driver;
                $pic['path'] = $path;
                $pic['md5'] = $md5;
                $pic['sha1'] = $sha1;
                $pic['status'] = 1;
                $pic['create_time'] = time();
                $id = $pictureModel->add($pic);
                $this->apiSuccess(array('id' => $id, 'path' => render_picture_path_without_root($path)));
            } else {
                $this->apiError('写入文件失败');
            }

        }
    }


    public function getPicture()
    {
        $aId = I('get.id');

        $pictureModel = D('Picture');
        $picture = $pictureModel->where(array('id' => $aId))->find();
        if ($picture) {
            $return['id'] = $picture['id'];
            $return['path'] = render_picture_path_without_root($picture['path']);
            $this->apiSuccess($return);
        } else {
            $this->apiError('找不到图片');
        }

    }


}