<?php

// +----------------------------------------------------------------------
// | PC商城
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp535201470@qq.com>
// +----------------------------------------------------------------------

namespace Site\Controller;

class GoodsController extends SiteController
{
    public $model;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = D('Site/Goods');
    }

    //pc首页
    public function index(){

        $this->display();
    }

    //商品列表
    public function products(){
        $filter = array();
        //商品列表
        $list = $this->model->getGoodsList($filter);
//        p($this->model->select());

        $this->assign('list', $list);
        $this->display();
    }

    //商品详情页
    public function product(){

        $this->display();
    }
}
