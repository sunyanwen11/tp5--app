<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Users;

class User extends Controller{
    
    public function indexAction() {
        $User = new Users();
        $all = $User->all();
//        var_dump($all);
        $row = $User->get(20);
        var_dump($row);
    }
    
    /**
     * 增加
     */
    public function addAction() {
        $User = new Users();
        $User->email="lisi@126.com";
        $User->user_name="lisi" . rand(1000, 9999);
        $User->password = md5("123456");
        $User->save();
    }
    
    /**
     * 更新
     */
    public function updateAction() {
        $User = new Users();
        $U = $User->get([
            'user_name'=>'lisi4544'
        ]);
//        var_dump($U);
        $U->email="lisi4544@qq.com";
        $U->password = md5('654321');
        $U->save();
    }
    
    /**
     * 删除
     */
    public function deleteAction() {
        $User = new Users();
//        $U = $User->get([
//            'user_name'=>'lisi1108'
//        ]);
//        $U->delete();
//       ;
        $U = $User->where('user_id','>',28);
        $U->delete();
        
//         Users::destroy(26);
        
    }
    /**
     * 查询
     */
    public function sqlAction() {
        $User = new Users;
//        第一种方法
        $U = $User->where([
            'user_name'=>'lisi4544'
        ])->select();
        //第二种方法
//        $U = $User->db()->where([
//             'user_name'=>'lisi4544'
//        ])->select();
        var_dump($U);
    }
    
    /**
     * 动态查询  方法找不到就去调用call方法了
     */
     public function fieldAction() {
         $User = Users::getByUser_name("lisi4544");
         var_dump($User);
     }
    
    
    
    
    
}
