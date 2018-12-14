<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 密码加密算法
 * @param string $pwd 明文密码
 * @param string $username 用户名
 * @param string $encrypt 随机安全码
 * @return string 32位加密字符串
 */
function getMd5($pwd,$username,$encrypt){
    $username = strtolower($username);
    return md5(md5($pwd).$username.$encrypt);
}

/**
 * 随机产生安全码
 * @param $len int 长度
 * @param $type int 类型 1全部字母数字  2数字  3小写字母  4大写字母
 * @return string
 */
function getCode($len,$type=1){
    $code = '';
    switch($type){
        case 1:
            $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 2:
            $str = '0123456789';
            break;
        case 3:
            $str = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 4:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 5:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            break;
        default:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    }
    for($i=0;$i<$len;$i++){
        $code .= $str[mt_rand(0,mb_strlen($str,'utf-8') -1 )] ;
    }
    return $code;
}

/**
 * 获取真实IP
 * @return array|false|string
 */
function get_ip() {
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else
        if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else
            if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
                $ip = getenv("REMOTE_ADDR");
            else
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                    $ip = $_SERVER['REMOTE_ADDR'];
                else
                    $ip = "unknown";
    return ($ip);
}

/**
 * 接口输出格式
 */
function api_callback(int $code,string $msg='',array $data=[]){
	$res = [
		'code' 	=> $code,
		'msg'	=> $msg,
		'data'	=> $data
	];
	
	echo  json_encode($res);
}
