<?php

namespace app\app\controller;


class UserBase extends \think\Controller{
    
    protected $userid;


    protected function _initialize() {
        
        parent::_initialize();
        $this->checkSigninStatus();
    }
    
    /**
     * 检查登录状态
     */
    public function checkSigninStatus() {
//        echo 'check',
        //1.获取SESSIONID,确保同一个SESSION下的会话
        //2.把会话转移到当前的SESSIONID上
//        var_dump($_SERVER);
        $sessionid = !empty($_SERVER['HTTP_SESSIONID']) ? $_SERVER['HTTP_SESSIONID'] :null; 
//        var_dump($sessionid);
        if (empty($sessionid)) {
             $message = [
               'status' =>4001,
                 'message' => 'SESSIONID不存在，请重新登录',
                 'data' => []
             ];
             $header = [];
             \think\Response::create($message,"json",2000,$header)->send();
             die();
        }
//        设置 session_id()
         session_id($sessionid);
         session_start();
//         echo session_id();       
         if (empty($_SESSION['token'])){
             $message = [
               'status' =>4001,
                 'message' => 'Token错误，请重新登录',
                 'data' => []
             ];
             \think\Response::create($message,"json",2000,$header)->send();
             die();
         }
         $request = \think\Request::instance();   //相当于在方法中写\think\Request $request  
         $token = $request->param("token");
//         var_dump($_SESSION['token'],$token);         
         
         if (md5($_SESSION['token']) != $token){
             $message = [
               'status' =>4001,
                 'message' => 'Token错误，请重新登录',
                 'data' => []
             ];
             $header = [];
             \think\Response::create($message,"json",2000,$header)->send();
             die();
         }
         list($username,$userid) = explode("-", $_SESSION['token']);
        //容错忽略不写
         //获取userid，并赋值到属性，可以再整个类或者子类中传递
        $this->userid = $userid;
        
//        rbac
        //1,资源，就是URL
        $url = $request->pathinfo();
        var_dump($url);
        
        //2.获取用户权限
         $pemission=[
             'order','user/index','user/update','signout'    //
         ];
         //3.判断资源在用户权限允许列表里
         if (in_array($url, $pemission)) {
             //do nothing
         } else {
              $message = [
               'status' =>4001,
                 'message' => '没有权限',
                 'data' => []
             ];
             $header = [];
             \think\Response::create($message,"json",2000,$header)->send();
             die();
         }
//         return true;        
             
//         var_dump($_SESSION);      
    }
    
}
