<?php 
/**
* 用户模块
* author:objui@qq.com
* date:2018-10-30
*/
namespace app\index\controller;
use think\Controller;
use app\common\lib\Redis;

class User extends  Controller{
   
    /**
	 * 登录
	 */
    public function login(){
     	try{
    		$data = [
	            'username' 		=> trim($_POST['username']),
	            'password' 		=> trim($_POST['password'])
	        ];
			$validate = new \app\index\validate\UserVal('login');
			$check_res = $validate -> check($data);

	        if($check_res == false){
				api_callback(10001,$validate -> getError());
	        }else{
	        	$User = new \app\index\model\User();
				
			    $row = $User -> _login($data);
                $login_token = md5($_POST['username'].$_POST['password'].config('apikey.LOGIN_KEY'));
				if($row !=false){
					$res_data = [
		            	'id' 			=> $row['id'],
		                'login_token' 	=> $login_token
		            ];
                    $redis = Redis::getInstance();
                    $redis->hSet("logins", "user_".$row['id'],$login_token);

					api_callback(200,'登录成功',$res_data);
				}else{
					api_callback(10002,'账号不存在或密码错误');
				}
	        }
    	} catch(\Exception $e){
    		api_callback(-1,$e->getMessage());
    	}
        
    }

    /**
    * 注册
    */
    public function register(){
       try {
	        $data = [
	            'username' 		=> trim($_POST['username']),
	            'password' 		=> trim($_POST['password']),
	            'repassword' 	=> trim($_POST['repassword'])
	        ];
			
	        $validate = new \app\index\validate\UserVal();
	        $check_res = $validate -> check($data);
	        if($check_res == false){
				api_callback(10001,$validate->getError());
	        }else{
	           $User = new \app\index\model\User();
			   $User -> _add($data);
			   api_callback(200,'注册成功');
	        }
        } catch(\Exception $e){
        	api_callback(-1,$e->getMessage());
       }
    }

}
