<?php

namespace app\index\controller;

class News extends \think\Controller{
    
    public function readAction(\think\Request $request) {
        $id = $request->param("id");     //get的时候不行 id当参数处理了
        var_dump($id); 
        $month = $request->param("month");
        var_dump($month);
        $status = $request->param("status");
        var_dump($status);
        
    }
    
    public function updateAction(\think\Request $request) {
//        echo "update";
        $id = $request->param("id");
        var_dump($id);
        $data = $request->post();
        var_dump($data);
        
    }
    
    public function deleteAction(\think\Request $request) {
//        echo "update";
        $id = $request->param("id");
        var_dump($id);
        $data = $request->post();
        var_dump($data);
    }
}
