<?php



namespace app\index\controller;


class Blog extends \think\Controller {
    
    public function saveAction() {
        echo "save";
    }
    
    public function readAction(\think\Request $request) {
        $id = $request->param();
        var_dump($id);
    }
}
