<?php


namespace app\index\controller;


class Product extends \think\Controller{
    public function detailAction(\think\Request $request){
        $name = $request->param("name");
        $id = $request->param("id");
        var_dump($name,$id);
    }
}
