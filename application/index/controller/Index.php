<?php

namespace app\index\controller;

use think\Controller;

class Index extends Controller {
    
//    方法之前执行的一个
    /*
    protected $beforeActionList = [
        'first',
        'second'=>['only'=>'hello'],
        'third'=>['except'=>'data,index']
    ];
     * */
     
    /**
     * 控制器初始化
     */
//    public function _initialize() {
//        parent::_initialize();     //先执行初始化方法然后再执行下面的方法
//        echo "initialize<br>";   
//    }
    
    public function indexAction() {
        $row = \think\Config::get("database.username");
        var_dump($row);
       return $this->fetch();
    }
    
    public function helloAction($id = "",$name = "") {
       $request = \think\Request::instance();
       var_dump($request->user->email);
       echo url("admin/console/login");
        echo "hello $id - $name<br>";            
    }
    
    public function dataAction() {
        \think\Config::set("a",100,"man");
        $a = \think\Config::get("","man");
        var_dump($a);
        echo "data<br>";
    }
    
    public function first() {
        echo "first<br>";
    }
    
    public function second() {
        echo "second<br>";
    }
    
    public function third() {
        echo "third<br>";
    }
    
    /**
     * 空操作
     * @param type $a
     */
    public function _empty($a ="",$b="") {
        var_dump($a,$b);
        echo "不存在方法的时候，调用我";
    }

}
