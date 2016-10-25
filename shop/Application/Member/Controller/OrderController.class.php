<?php

// +----------------------------------------------------------------------
// | 会员中心-订单管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Member\Controller;

use Base\Controller\BaseController;

class OrderController extends BaseController
{

    private $__whiteList = array(); //白名单 不需要验证登录

    public function _initialize()
    {
        parent::_initialize();
        //验证是否登录
        if (!in_array(ACTION_NAME, $this->__whiteList)) {
            $this->checkLogin();
        }
        $this->model = D('card');
    }

    /**
     * 订单管理
     * 订单状态（0未付款、1已完成、2待发货、3待收货、4退货/款、5已取消、6已关闭、7失效、8评价[暂定]）
     */
    public function index(){

        $this->display();
    }

    /**
     * 退款
     */
    public function refund(){

        $this->display();
    }

    /**
     * 退货
     */
    public function returnGoods(){

        $this->display();
    }

    /**
     * 投诉
     */
    public function complaint(){

        $this->display();
    }
}
