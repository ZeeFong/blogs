<?php
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model{
  protected $_validate =array(
     array('title','require','文章标题不能为空'),
     array('desc','require','链接地址不能为空'),
     array('cateid','require','链接描述不能为空'),
     array('content','require','链接描述不能为空'),
         
     );
}
