<?php

/**
 * I_POST  获取post提交的参数
 * @param string $key
 * @return mixed
 * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
 */
function I_POST($key = '', $filter = 'text')
{
    $value = I('post.' . $key,'',$filter);
    if (empty($value)) {
        $value = I('put.' . $key,'',$filter);
    }

    return $value;
}


/**
 * api_encode  加密
 * @param $txt
 * @param null $key
 * @return string
 * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
 */
function api_encode($txt, $key = null)
{
    $key = empty($key) ? C('DATA_AUTH_KEY') : $key;
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-=_";
    $nh = rand(0, 64);
    $ch = $chars[$nh];
    $mdKey = md5($key . $ch);
    $mdKey = substr($mdKey, $nh % 8, $nh % 8 + 7);
    $txt = base64_encode($txt);
    $tmp = '';
    $i = 0;
    $j = 0;
    $k = 0;
    for ($i = 0; $i < strlen($txt); $i++) {
        $k = $k == strlen($mdKey) ? 0 : $k;
        $j = ($nh + strpos($chars, $txt [$i]) + ord($mdKey[$k++])) % 64;
        $tmp .= $chars[$j];
    }
    return $ch . $tmp;
}

/**
 * api_decode  解密
 * @param $txt
 * @param null $key
 * @return string
 * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
 */
function api_decode($txt, $key = null)
{
    $key = empty($key) ? C('DATA_AUTH_KEY') : $key;

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-=_";
    $ch = $txt[0];
    $nh = strpos($chars, $ch);
    $mdKey = md5($key . $ch);
    $mdKey = substr($mdKey, $nh % 8, $nh % 8 + 7);
    $txt = substr($txt, 1);
    $tmp = '';
    $i = 0;
    $j = 0;
    $k = 0;
    for ($i = 0; $i < strlen($txt); $i++) {
        $k = $k == strlen($mdKey) ? 0 : $k;
        $j = strpos($chars, $txt[$i]) - $nh - ord($mdKey[$k++]);
        while ($j < 0) {
            $j += 64;
        }
        $tmp .= $chars[$j];
    }
    return base64_decode($tmp);
}

//function render_picture_path($path){
//    $path = get_pic_src($path);
//    return is_bool(strpos($path, 'http://')) ?  'http://'.str_replace('//','/',$_SERVER['HTTP_HOST'] .'/'. $path) : $path;
//}

function render_picture_path_without_root($path){

//$path = get_pic_src($path);
    $path = strpos($path,'Uploads/Avatar')?$path:str_replace('Uploads/Avatar','',$path);
   return is_bool(strpos($path, 'http://')) ?  'http://'.str_replace('//','/',$_SERVER['HTTP_HOST'] .'/'. $path) : $path;
}


function del_dir($dir)
{
    //先删除目录下的文件：
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                $this->deldir($fullpath);
            }
        }
    }

    closedir($dh);
    //删除当前文件夹：
    if (rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}



function get_from($from_en){
    switch($from_en){
        case 'MI 4LTE':$from = '小米4';break;
        case 'iPhone':$from = 'IPhone客户端';break;
        case 'HM 2A':$from = '红米2A';break;
        default :
            $from =$from_en;
            if(strpos($from_en,'H60') === 0){
                $from = '华为荣耀6';
            }

    }
    return $from;
}


function H5U($url = '', $vars = '', $suffix = true, $domain = false){
    $url = preg_replace("/(?<=#)[\s\S]*$/","",$url);
    $link =  require('./Application/Api/Conf/router.php');
    $url_mob = $link['router'][$url];
    return U($url_mob, $vars , $suffix, $domain);
}

//解析虾米
function ipcxiami($location){
    $count = (int)substr($location, 0, 1);
    $url = substr($location, 1);
    $line = floor(strlen($url) / $count);
    $loc_5 = strlen($url) % $count;
    $loc_6 = array();
    $loc_7 = 0;
    $loc_8 = '';
    $loc_9 = '';
    $loc_10 = '';
    while ($loc_7 < $loc_5){
        $loc_6[$loc_7] = substr($url, ($line+1)*$loc_7, $line+1);
        $loc_7++;
    }
    $loc_7 = $loc_5;
    while($loc_7 < $count){
        $loc_6[$loc_7] = substr($url, $line * ($loc_7 - $loc_5) + ($line + 1) * $loc_5, $line);
        $loc_7++;
    }
    $loc_7 = 0;
    while ($loc_7 < strlen($loc_6[0])){
        $loc_10 = 0;
        while ($loc_10 < count($loc_6)){
            $loc_8 .= @$loc_6[$loc_10][$loc_7];
            $loc_10++;
        }
        $loc_7++;
    }
    $loc_9 = str_replace('^', 0, urldecode($loc_8));
    return $loc_9;
}



function getXiaMiUrl($ID){
    if(!empty($ID)){
        $url= 'http://www.xiami.com/widget/json-single/sid/'.$ID;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_USERAGENT, '');
        curl_setopt($ch, CURLOPT_REFERER,'b');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($content,true);
        return $result;
    }else{
        return false;
    }
}

/** fmatDtlContent 用于过滤掉html文本的大量冗余属性
* @param $content
* @return string
*/
function fmatDtlContent($content){
    $content = preg_replace("/style=.+?['|\"]/i","",$content);
    $content = preg_replace("/<a[^>]*>/","", $content);
    $content = preg_replace("/<\/a>/","", $content);
    return $content;
}

function fmat_at_text($text){
    $text = preg_replace('/\[at:(\d)+\]/','',$text);
    return $text;
}

/**根据ID获取一张图片，如果传入width则返回缩略图，否则取原图
 * @param String    $cover_id
 * @return String/int   $width
 * @author 胡佳雨 <hjy@ourstu.com>.
 */
function get_one_pic($cover_id,$width = null){
    $path = $width ? getThumbImageById($cover_id, $width) : get_cover($cover_id,'path');
    return strpos($path,'http') === false ?  'http://' . str_replace('//', '/', $_SERVER['HTTP_HOST'] . $path):$path;
}