<?php
namespace Admin\Model;
use Think\Model;
class LinkModel extends Model{
    protected $_validate =array(
     array('title','require','链接名称不能为空'),
     array('title','','链接名称已存在',0,'unique',3),
     array('url','require','链接地址不能为空'),
     array('url','','链接地址已存在',0,'unique',3),
     array('desc','require','链接描述不能为空')
     
         
     );
}
