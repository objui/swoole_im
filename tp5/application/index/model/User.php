<?php
/**
 * 用户模型
 */
namespace app\index\model;
use think\Model;

class User extends  Model{
	
	/**
	 * 增加用户
	 */
	public function _add($data){
		$User = new User();
		unset($data['id']);
		$User -> username = $data['username'];
		$encrypt = getCode(6);
		$User -> password = getMd5($data['password'],$data['username'],$encrypt);
		$User -> encrypt = $encrypt;
		$User -> register_time = time();
		$User -> save();
	}
	
	/**
	 * 登录
	 */
	public function _login($data){
		$User = new User();
		$row = $User -> where('username',$data['username'])->where('status',1)->find();
		$us =  $row != null ? getMd5($data['password'],$row->username,$row->encrypt)== $row->password :false;
		if($us != false){
			$update_data = [
				'last_time' => time(),
				'last_ip'	=>get_ip()
			];
			$User->where('id',$row->id)->update($update_data);
			$res = [
			    'id' 		=> 	$row->id,
			    'username' 	=>	$row->username,
			    'email'		=>	$row->email
			];
			return $res;
		}else{
			return false;
		}
	}
	
	
}

