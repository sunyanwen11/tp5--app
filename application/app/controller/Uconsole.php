<?php

/**
 * APP的用户登录注册接口
 */

namespace app\app\controller;

use app\app\model\Users;

class Uconsole extends \think\Controller {

    public function signinAction(\think\Request $request) {
      
        if ($request->isPost()) {

            //获取用户名
            $username = $request->post("user_name", "", "trim");
            //获取密码
            $password = $request->post("password", "", "trim");
            $UserModel = new Users();
            $userinfo = $UserModel->db()->where([               // db()会提示
                        'user_name' => $username
                    ])->find();               
            if (!empty($userinfo)) {
                if ($userinfo['password'] === md5($password)) {
                    session_start();  //开启session
                    //声明并保存TOKEN到SESSION
                    $token = $userinfo['user_name'] . "-" . $userinfo['user_id'];    
                   
                    $_SESSION['token'] = $token;
             
                    $sessionid = session_id();               
                    $header = [
                        'sessionid' => $sessionid
                    ];
                     $message = [
                        'status' => 2000,
                        'message' => '登录成功',
                        'data' => [
                            'userinfo'=>$userinfo->toArray(),
                            'token' => md5($_SESSION['token'])
                        ]
                    ];          
                    return \think\Response::create($message, "xml", 2000, $header);
                }
            } else {
                
            }
        }
    }

    /**
     * 用户注册
     * 获取用户的用户名，密码，保存入库
     * 返回用户的基本信息
     */
    public function signupAction(\think\Request $request) {   //操作方法注入  自动注入当前请求对象
        if ($request->isPost()) {
            //获取用户名
            $username = $request->post("user_name", "", "trim");
            //获取密码
            $password = $request->post("password", "", "trim");
            //保存数据
            $UserModel = new Users();
            $row = $UserModel->save([
                'user_name' => $username,
                'password' => md5($password)
            ]);
            //获取最后插入的ID,  本次查询
            $id = $UserModel->db()->getLastInsID();
            $userinfo = $UserModel->db()->find($id);
            $message = [
                'status' => 2000,
                'message' => '注册成功',
                'data' => $userinfo
            ];
            return $message;
        }
    }

}
