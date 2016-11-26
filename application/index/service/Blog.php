<?php

namespace app\index\service;


class Blog {
    
   public static function demo($var) {
       var_dump($var);
       $request = \think\Request::instance();
      $param= $request->param();
      var_dump($param);
   }
}
