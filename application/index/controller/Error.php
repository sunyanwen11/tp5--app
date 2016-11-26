<?php

namespace app\index\controller;

use think\Request;

class Error extends \think\Controller {

    public function indexAction(Request $request) {
        echo "error/index<br>";
//        var_dump($request);
        // 获取当前域名
        echo 'domain: ' . $request->domain() . '<br/>';
        // 获取当前入口文件
        echo 'file: ' . $request->baseFile() . '<br/>';
        // 获取当前URL地址 不含域名
        echo 'url: ' . $request->url() . '<br/>';
        // 获取包含域名的完整URL地址
        echo 'url with domain: ' . $request->url(true) . '<br/>';
        // 获取当前URL地址 不含QUERY_STRING
        echo 'url without query: ' . $request->baseUrl() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root:' . $request->root() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root with domain: ' . $request->root(true) . '<br/>';
        // 获取URL地址中的PATH_INFO信息
        echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
        // 获取URL地址中的PATH_INFO信息 不含后缀
        echo 'pathinfo: ' . $request->path() . '<br/>';
        // 获取URL地址中的后缀信息
        echo 'ext: ' . $request->ext() . '<br/>';
        
        $a = $request->get("a","0","intval");   //相当于I函数
        var_dump($a);
        
        echo "当前模块名称是" . $request->module();
        echo "当前控制器名称是" . $request->controller();
        echo "当前操作名称是" . $request->action();
        
        echo '路由信息：';
        dump($request->route());
        echo '调度信息：';
        dump($request->dispatch());
        
        
        var_dump($request->has("a","get"));  //检查get中是否有a变量
        
        var_dump($request->param("b"));   //获取a变量
         var_dump($request->param());   //获取所有变量
         
         var_dump($request->get());  //获取$_GET变量
         var_dump($request->post());
         var_dump($request->request());
//         var_dump($_SERVER);
         
//         var_dump($request->param("b","","intval"));
         var_dump($request->param("b","","strip_tags,strtolower")); //strip_tags过滤标签 strtolower大写转小写
         
         var_dump($request->header());  //获取某个请求头信息
         
         
    }

}
