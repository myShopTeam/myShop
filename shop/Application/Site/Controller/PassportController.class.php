<?php

// +----------------------------------------------------------------------
// | 商城前台登录注册
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Site\Controller;

class PassportController extends SiteController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //登录
    public function login(){

        $this->display();
    }

    //注册
    public function register(){

        $this->display();
    }

}
