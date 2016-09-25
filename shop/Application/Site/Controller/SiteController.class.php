<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 商品管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Site\Controller;

use Base\Controller\BaseController;

class SiteController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //PC端获取验证码
    protected function getVerify(){

        return get_http_host() . '/index.php?g=Api&m=Checkcode&a=index&code_len=4&font_size=20&width=120&height=52&font_color=&background=';

    }
}
