<?php
/**
* websocket服务器
* author:objui@qq.com
* date:2018-10-10
*/

class Websocket{
    CONST HOST = '0.0.0.0';
    CONST PORT = 9501;
    public $ws = null;

    public function __construct(){
        $this->ws = new swoole_websocket_server(self::HOST,self::PORT);
        $this->ws->set([
            'enable_static_handler' => true,
            'document_root'         => '/www/wwwroot/obj_im/static',
            'worker_num'            => 4
        ]);
        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('workerStart',[$this,'onWorkerstart']);
        $this->ws->on('request',[$this,'onRequest']);
        $this->ws->on('close',[$this,'onClose']);
        $this->ws->start();
    }

    /**
    * 监听WebSocket连接打开事件
    * @param $ws
    * @param $request
    */
    public function onOpen($ws,$request){
        $this->ws->push($request->fd,$request->fd."hello,welcome".PHP_EOL);
    }

    /**
    * 公共常量定义、文件引入
    * @param $server
    * @param $worker_id
    */
    public function onWorkerStart($server,$worker_id){
        //定义应用目录
        define('APP_PATH', __DIR__ . '/../tp5/application/');
        require __DIR__ . '/../tp5/thinkphp/base.php';
    }


    /**
    * 监听websocket消息事件
    * @param $ws
    * @param $frame
    */
    public function onMessage($ws,$frame){
        $this->ws->push($frame->fd,"server:{$frame->data}");
    }

    /**
    * request回调
    * @param $request
    * @param $response
    */
    public function onRequest($request,$response){
        $_SERVER = [];
        if(isset($request->server)){
            foreach($request->server as $k=>$v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        if(isset($request->header)){
            foreach($request->header as $k=>$v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        $_GET = [];
        if(isset($request->get)){
            foreach($request->get as $k=>$v){
                $_GET[$k] = $v;
            }
        }

        $_POST = [];
        if(isset($request->post)){
            foreach($request->post as $k => $v){
                $_POST[$k] = $v;
            }
        }

        $_FILES = [];
        if(isset($request->files)){
            foreach($request->files as $k => $v ){
                $_FILES[$k] = $v;
            }
        }

        //执行应用并响应
        $_POST['http_server'] = $this->ws;
        ob_start();
        try {
            think\App::run()->send();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

         $res = ob_get_contents();
         ob_end_clean();
         $response->header("Content-Type", "text/html; charset=utf-8");
       //跨域
    $response->header('Access-Control-Allow-Origin', $request->header['origin'] ?? '');
    $response->header('Access-Control-Allow-Methods', 'OPTIONS');
    $response->header('Access-Control-Allow-Headers', 'x-requested-with,session_id,Content-Type,token,Origin');
    $response->header('Access-Control-Max-Age', '86400');
    $response->header('Access-Control-Allow-Credentials', 'true');
      
         $response-> end($res);
    }


    /**
    * 监听websocket连接关闭事件
    * @param $ws
    * @param $fd
    */
    public function onClose($ws,$fd){
        echo "client-{$fd} is closed".PHP_EOL;
    }

}

new Websocket();
