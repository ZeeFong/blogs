<?php
namespace Admin\Controller;
use Think\Controller;

class LinkController extends Controller{
    public function link(){
        $link=D('link');
        $count= $link->count();// 查询满足要求的总记录数
        $Page= new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(2)
        $show= $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $link->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出”
        $this->assign('count',$count);// 数据总纪录


        $this->display();
    }
    public function add(){
        $link=D('link');
        if(IS_POST){
            if($data=$link->create()){
                if($link->add($data)){
                    $this->success('添加链接成功',U('link'),2);
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($link->getError());
            }
            
        }else{
            $this->display();
        }
       }
    public function edit(){
           $link=D('link');
           if(IS_POST){
               if($data=$link->create()){
                   if($link->save($data)){
                       $this->success('修改成功',U('link'),2);
                   }else{
                       $this->error('修改失败');
                   }
               }else{
                   $this->error($link->getError());
               }
           }else{
           $id=I('get.id');
           $res=$link->find($id);
           $this->assign('res',$res);
           $this->display();
           }
       }
    public function del(){
        $link=D('link');
        $link->delete(I('id'));
        $this->success('删除成功',U('link'),2);
    }
}
