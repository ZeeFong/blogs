<?php
namespace Admin\Model;
use Think\Model;
class CateModel extends Model{
    protected $_validate =array(
     array('catename','require','栏目名称不能为空'),
     array('catename','','栏目名称已存在',0,'unique',3)
         
     );
}
