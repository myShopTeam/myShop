<?php

// +----------------------------------------------------------------------
// | PC商城 购物车
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp535201470@qq.com>
// +----------------------------------------------------------------------

namespace Site\Controller;

class CartController extends SiteController
{
    public $model;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = D('Site/GoodsCart');
    }


    public function index(){

        $this->display();
    }
}
