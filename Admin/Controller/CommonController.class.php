<?php
namespace Admin\Controller;

class CommonController extends Controller{
    public function __construct() {
        parent::__construst();
        if(!session('id')){
            $this->error('请先登录系统！',U('Login'));
        }
    }
}