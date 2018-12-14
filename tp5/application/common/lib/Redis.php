<?php
/**
 * Redis封装
 * Author:objui@qq.com
 * time:2018-10-31
 */
 namespace app\common\lib;
 
 class Redis{
 	
	private $redis;
	
	//单例模式实例化
	private static $_instance = null;
	
	public static function getInstance(){
		if(empty(self::$_instance)){
			self::$_instance = new self();
		}
		return self::$_instance;
	}

     public function __construct(){
		$this->redis = new \Redis();
        $result = $this->redis->connect(config('redis.host'), config('redis.port'), config('redis.out_time'));
        if($result === false) {
            throw new \Exception('redis connect error');
        }
	}



     public function __call($name, $arguments) {
		switch(count($arguments)){
			case 1:
				return $this->redis->$name($arguments[0]);
				break;
			case 2:
                return $this->redis->$name($arguments[0], $arguments[1]);
				break;
			case 3:
                return $this->redis->$name($arguments[0], $arguments[1],$arguments[2]);
				break;
			default:
                return $this->redis->$name();
		}
    }
	
	
 }
