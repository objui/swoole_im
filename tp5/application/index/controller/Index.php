<?php
namespace app\index\controller;
use app\common\lib\Redis;

class Index
{
    public function index()
    {
        return '';
    }
	
	
	public function talk_list(){
		$server = $_POST['http_server'];
		$userid = (int)$_POST['userid'];
        $login_token = $_POST['login_token'];



		$redis = Redis::getInstance();

        $redis_login_token = $redis->hget("logins", "user_".$userid);
        dump($redis_login_token);

        $list = $redis->lrange('talk_list',0,-1);


        if($list == false){
            //$list = \app\index\model\Msgs::talk_list();
        }





		
	}
}
