<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 商品管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.qcjh.net, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Site\Controller;

class GoodsController extends SiteController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //pc首页
    public function index(){

        $this->display();
    }

    //商品详情页
    public function products(){

        $this->display();
    }

    //商品详情页
    public function detail(){

        $this->display();
    }
}
