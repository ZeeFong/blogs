<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class ArticleViewModel extends ViewModel{
        public $viewFields = array(
      //定义主表需要显示的字段      
     'Article'=>array('id','title','pic','time','_type'=>'LEFT'),
      //关联表显示的字段－－
     'Cate'=>array('catename', '_on'=>'Article.cateid=Cate.id'),
     
   );

}
