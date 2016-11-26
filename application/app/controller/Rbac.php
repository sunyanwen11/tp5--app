<?php



namespace app\app\controller;

class Rbac extends UserBase{
    
    public function _initialize() {
        parent::_initialize();
        
    }
    
    public function indexAction(){
          $UserModel = new \app\app\model\RbacUser();
          
    }
}
