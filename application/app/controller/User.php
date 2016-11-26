<?php

/**
 * 用户信息接口
 */

namespace app\app\controller;

class User extends UserBase {

    public function infoAction(\think\Request $request) {

        $id = $request->get("id");
        $UserModel = new \app\app\model\Users();
        $userinfo = $UserModel->find($id)->toArray();
        $message = [
            'status' => 2000,
            'message' => '获取用户信息成功',
            'data' => $userinfo
        ];
        //输出特殊格式
//       return response($message,2000, [], 'xml');
        return \think\Response::create($message, "xml", 2000, []);   //两种写法一样 返回xml格式
//        return $message;
    }

    /**
     * 更新用户数据
     */
    public function updateAction(\think\Request $request) {

        $id = $request->param("id");
        $email = $request->post("email");
        $UserModel = new \app\app\model\Users();
        $userinfo = $UserModel->find($id);
        $userinfo->email = $email;
        $userinfo->save();
  
        if ($userinfo->getError()) {
            $message = [
                'status' => 4003,
                'message' => $userinfo->getError(),
                'data' => []
            ];
        } else {
            $message = [
                'status' => 2000,
                'message' => '更新用户信息成功',
                'data' => []
            ];
        }
        return $message;
        
    }

}
