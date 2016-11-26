<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//静态规则
use think\Route;
\think\Route::get("/", function(){
    echo "hello world";
});
//一个项目只有一个模块，可以绑定到模块，url地址不再需要模块了
//如果其他模块也在使用，则不能绑定模块
Route::bind("app","module");

//:id相当于占位符
//Route::rule('new/:id','index/news/read');  //路由请求后不能在以普通的方式转发了
//Route::rule('new/:id','news/update','POST');   //指定默认请求类型
//快捷路由 
//Route::get('new/:id','news/update');   // 定义GET请求路由规则
//Route::post('new/:id','News/update'); // 定义POST请求路由规则
//Route::put('new/:id','News/update'); // 定义PUT请求路由规则
//Route::delete('new/:id','News/delete'); // 定义DELETE请求路由规则
//Route::any('new/:id','News/read'); // 所有请求都支持的路由规则

//批量注册
//Route::rule([
////    'new/:id/[:month]'=>'index/news/read',
//     'new/:id/[:month]'=>'index/news/read?status=100',   //额外参数
//    'blog/:id'=>'index/blog/read'
//    
//]);

Route::get('new/:id/[:month]','index/news/read',[
    'cache'=>3600
],['__url__'=>'new\/\w+$']);

Route::get("/baidu", "http://www.baidu.com");  //重定向 跳转到百度
Route::get("/sina",function(){
   header("Location:http://www.weibo.com");
   exit();
});

Route::get("/login","@index/index/hello");

Route::get("/demo/:var","app\index\service\Blog@demo");  //重定向到一个类的方法
 
//给User控制器设置快捷路由
//Route::controller('user','index/User');

// user 别名路由到 index/User 控制器
//Route::alias('user','index/User');
//Route::alias('user','index/User/phone');
//Route::alias('user','\app\index\controller\User');  // user 路由别名指向 User控制器类

//支持使用闭包方式注册路由分组 
//Route::group('blog', function() {
//    Route::rule(':id', 'blog/read', '', ['id' => '\d+']);
//    Route::rule(':name', 'blog/read', '', ['name' => '\w+']);
//}, ['method' => 'get', 'ext' => 'html']);

//闭包支持   5.4以上支持闭包
Route::get("closure/:var",function($var){
    return "Hello " . strtoupper($var);
});

//闭包来返回模型对象数据
//Route::rule('hello/:user_id', 'index/index/hello', 'GET', [
//    'bind_model' => [
//        'user' => function($param) {
////            var_dump($param);
////            return;
//            $model = new \app\index\model\Users;
//            $row = $model->where($param)->find();
////            var_dump($row);
//            return $row;
//        }
//    ],
//]);
    
//资源路由
//Route::resource('blog','index/blog');  //推荐
//资源路由   改变默认的id参数名  绑定参数
//Route::resource('blog','index/blog',['var'=>'blog_id']);  //两种方式都可以，key值不起作用
//Route::resource('blog','index/blog',['var'=>['blog'=>'blog_id']]);
// 只允许index read edit update 四个操作  过滤
//Route::resource('blog','index/blog',['only'=>['index','read','edit','update']]);
//自定义rest规则    全局规则替换
Route::rest('update',['post', '/:id/update', 'update']);  // rest是全局的
Route::rest('delete',['get', '/:id/delete', 'delete']); 

//Route::rest(['delete'=>['get', '/:id/delete', 'delete'],
//    'update'=>['post', '/:id/update', 'update']
//    ]); 

Route::resource('blog','index/blog');  
Route::resource('product','index/product');
//资源路由的嵌套
Route::resource('blog.comment','index/comment');

//APP模块的RESTFUL接口
Route::resource("order","app/order");

return [
//    ['item-<name>-<id>','index/product/detail',[],['name'=>'\w+','id'=>'\d+']],
    'item-<name>-<id>'=>['index/product/detail',[],['name'=>'\w+','id'=>'\d+']],
//     'new/:id/[:month]'=>'index/news/read?status=100',
     
    //两种写法一样   
//    'n/:id' => ['index/news/read',['method' => 'post|put|'], ['id' => '\d+']],
     'n/<id>' => ['index/news/read',['method' => 'post|put|get'], ['id' => '\d+']], 
    
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    
//    '__alias__' => [
//        'user' => 'index/user/phone',
//    ],
    //最后的路由
//    '__miss__' => 'index/hello',
];



