<?php

// +----------------------------------------------------------------------
// | lp PC端商品模型
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Base\Model;

use Common\Model\Model;

class BaseModel extends Model {

    //array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间])
    protected $_validate = array(
    );
    //array(填充字段,填充内容,[填充条件,附加规则])
    protected $_auto = array(
    );


}
