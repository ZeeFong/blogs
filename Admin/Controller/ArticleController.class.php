<?php
namespace Admin\Controller;
use Think\Controller;

class ArticleController extends Controller{
    public function lst(){
        $article=D('ArticleView');
        $count= $article->count();// 查询满足要求的总记录数
        $Page= new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(2)
        $show= $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $alist = $article->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('alist',$alist);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出”
        $this->assign('count',$count);// 数据总纪录


        $this->display();
    }
    public function add(){
        
        if(IS_POST){
        $article=D('article');
        $data=$article->create();
        $data['time']= time();
         //上传附件
        if(IS_FILE['pic']['tmp_name']!=''){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath  =      '/Public/Uploads/'; // 设置附件上传根目录
            $upload->rootPath  =      './'; // 设置附件上传根目录
            
            // 上传单个文件
            $info   =   $upload->uploadOne($_FILES['pic']);
            if(!$info) {// 上传错误提示错误信息
        $this->error($upload->getError());
    }else{// 上传成功 获取上传文件信息
        $data['pic']=$info['savepath'].$info['savename'];
        
    }
        }
       //收集表单 
        
        if($data){
            if($article->add($data)){
               //dump($data);die();
                $this->success('添加成功',U('lst'),2); 
                
            }else{
                $this->error(添加失败);
            }        
            
            } else {
                $this->error($article->getError());    
            }
        } else {
            $cate=D('cate');
            $flist=$cate->select();
            $this->assign('flist',$flist);
            
             $this->display();
        }
        
       
    }
    public function edit(){
        $article=D('article');
        if(IS_POST){
        $data=$article->create();
        //上传附件
        if(IS_FILE['pic']['tmp_name']!=''){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath  =      '/Public/Uploads/'; // 设置附件上传根目录
            $upload->rootPath  =      './'; // 设置附件上传根目录
            
            // 上传单个文件
            $info  =  $upload->uploadOne($_FILES['pic']);
            if(!$info) {// 上传错误提示错误信息
        $this->error($upload->getError());
    }else{// 上传成功 获取上传文件信息
        $data['pic']=$info['savepath'].$info['savename'];
        
    }
        } else {
            //收集表单 
        
        if($data){
            if($article->save($data)){
               //dump($data);die();
                $this->success('文章修改成功',U('lst'),2); 
                
            }else{
                $this->error(文章修改失败);
            }        
            
            } else {
                $this->error($article->getError());    
            }
            return;
       }

        }
        $articles=$article->find(I('id'));
        $this->assign('articles',$articles);
        $cateres=D('cate')->select();
        $this->assign('cateres',$cateres);
        $this->display();
        }
    function del(){
        $cate=D('article');
        $cate->delete(I('id'));
        $this->success('删除成功',U('lst'),2);
}
}