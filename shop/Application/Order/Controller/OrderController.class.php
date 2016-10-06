<?php

// +----------------------------------------------------------------------
// | 订单
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: linpei <53501470@qq.com>
// +----------------------------------------------------------------------

namespace Order\Controller;

use Base\Controller\BaseController;

class OrderController extends BaseController
{
    private $whiteList = array(); //白名单 不需要验证登录

    public function _initialize()
    {
        parent::_initialize();
        //验证是否登录
        if (!in_array(ACTION_NAME, $this->whiteList)) {
            $this->checkLogin();
        }
        $this->model = D('Cart/GoodsOrder');
    }

    /**
     * 我的订单
     */
    public function index(){

        $this->display();
    }

}
