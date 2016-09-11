<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 商品管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Base\Controller;

use Common\Controller\Base;

class BaseController extends Base
{

    public function _initialize()
    {
        parent::_initialize();
        header("Content-type:text/html;charset=utf-8");
    }

}
