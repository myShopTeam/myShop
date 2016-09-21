<?php

// +----------------------------------------------------------------------
// | PC商城 卡单管理 会员管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp535201470@qq.com>
// +----------------------------------------------------------------------

namespace Site\Controller;

class CardController extends SiteController
{
    public $model;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = D('Site/Card');
        //检测会员是否登录
        $this->checkLogin();
    }

    //会员首页
    public function index(){

        $this->display();
    }
}
