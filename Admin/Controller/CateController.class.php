<?php
namespace Admin\Controller;
use Think\Controller;

class CateController extends Controller{
    function lst(){
        $cate=D('cate');
        $res=$cate->order('id asc')->select();
        $this->assign('res',$res);
        $this->display();
    }
    function add(){
        $cate=D('cate');
        if(IS_POST){
            $data['catename']=I('catename');
            if($cate->create($data)){
                if($cate->add()){
                    $this->success('添加栏目成功！',U('lst'),2);
                }else{
                    $this->error('添加失败');
                }
                
            } else {
                $this->error($cate->getError());
            }
            return;
            };
       $this->display(); 
    }
    function edit(){
        $cate=D('cate');
        if(IS_POST){
            $data['catename']=I('catename');
            $data['id']=I('id');
            if($cate->create($data)){
                 if($cate->save() !==FALSE){
                     $this->success('修改栏目成功',U('lst'),2);
                 } else {
                     $this->error('修改栏目失败');   
                 }
            }else{
                $this->error($cate->getError());
            }
            return;
        }
        $cates=$cate->find(I('id'));
        $this->assign('cates',$cates);
        $this->display();
    }
    function del(){
        $cate=D('cate');
        $cate->delete(I('id'));
        $this->success('删除成功',U('lst'),2);
        
    }
    function sort(){
        $this->display();
    }
}