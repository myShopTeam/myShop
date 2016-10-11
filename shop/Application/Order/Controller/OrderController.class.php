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
        $post = I('post.');
        //验证是否有数据
        if (!$post['cart_id'] && !S('cart' . $this->uid)) {
            redirect(U('Site/Goods/products'));
        }
        if($post['cart_id']){
            S('cart' . $this->uid, $post['cart_id']);
        } else {
            $post['cart_id'] = S('cart' . $this->uid);
        }
        //获取购物车数据
        $info = D('Cart/GoodsCart')->getCartInfo($this->uid);
        //总金额涉及到运费 优惠等
        $info['goods_total'] = $info['total'];
        //运费 多件商品选取最大的运费
        $info['freight'] = D('Site/goods')->getMaxFreight(array('goods_id' => array('IN', $info['goods'])));

        $info['total'] += $info['freight'];
        $this->assign('info', $info);
        $this->display();
    }

}
