<?php
/**
* 用户模块验证类
* author:objui@qq.com
* date:2018-10-30
*/
namespace app\index\validate;
use think\Validate;
use think\Db;

class UserVal extends Validate{
    
    //注册规则
    protected  $rule = [
        'username' => 'require|checkName|max:20',
        'password' => 'require|min:5',
        'repassword' => 'confirm:password'
    ];
    protected  $msg = [
        'username.require'         => '账号必填',
        'username.checkName'     => '该用户已注册',
        'username.max'             => '账号不能超过20个字符',
        'password.require'         => '密码不能为空',
        'password.min'             => '密码只能5~32个字符',
        'repassword.confirm'    => '两次密码输入不一致'
    ];
    
    
    //登录规则
    protected  $login_rule = [
        'username' => 'require|max:20',
        'password' => 'require|min:5',
    ];
    protected  $login_msg = [
        'username.require' => '账号必填',
        'username.max'     => '账号不能超过20个字符',
        'password.require' => '密码不能为空',
        'password.min' => '密码只能5~32个字符',
    ];

    
    protected $field = [];
    
    public function __construct($action = 'register'){
        switch($action){
            case 'login':
                parent::__construct($this->login_rule, $this->login_msg, $this->field);
                break;
            case 'register':
            default:
                parent::__construct($this->rule, $this->msg, $this->field);
        }
        
    }
    
    protected  function checkName($value){
        $res = Db::name('User')->where('username',$value)->find();
        if(false != $res){
            return false;
        }else{
            return true;
        }
    }

}
