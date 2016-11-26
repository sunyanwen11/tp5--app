<?php

namespace app\app\controller;
use app\app\model\OrderInfo;

class Order extends UserBase{
    /**
     * 获取订单列表列表
     */
    public function indexAction(\think\Request $request) {
        $OrderInfoModel = new OrderInfo();
        //当前页
        $nowpage = $request->param("page",1,"intval");
        //每页多少条数据
        $perpage = $request->param("perpage",5,"intval");
        //订单总数
        $count = $OrderInfoModel->db()->where([
            'user_id'=>$this->userid      //userid在父类获取到了
        ])->count();

        //列表
        $list = $OrderInfoModel->db()->where([
             'user_id'=>$this->userid  
        ])->page($nowpage,$perpage)->select();
        $message = [
            'status' => '2000',
            'message'=>'获取订单成功',
            'data'=>[
                'count' => $count,
                'perpage'=>$perpage,
                'nowpage'=> $nowpage,
                'list' => $list,
            ]
        ];
        return $message;
    }
    
    /**
     * 某一个订单详细信息
     */
    public function readAction() {
        
             
        $OrderInfoModel = new OrderInfo();
        $count = $OrderInfoModel->db()->where([
            'user_id' =>  $this->userid
        ])->count();
        $list = $OrderInfoModel->db()->where([
            'user_id' => $this->userid,
        ])->find();
        $message = [
            
            'status' => '2000',
            'message' => '获取订单成功',
            'data' => [
                'list' => $list,
                'count'=>$count,
            ]
        ];
        return $message;
    }
    /**
     * 创建订单
     */
    public function createAction(\think\Request $request) {
        $id = $request ->param("id");
        $OrderInfoModel = new OrderInfo();   
        $OrderInfoModel->password = md5("123456");
        $OrderInfoModel->save();
    }
    /**
     * 更改订单信息
     */
    public function saveAction() {
        
        
    }
    /**
     * 修改订单状态
     */
    public function updateAction() {
        
    }
    
    /**
     * 删除订单
     */
    public function deleteAction() {
        
    }
}
