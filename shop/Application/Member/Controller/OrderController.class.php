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
        //购物车商品数量
        $cart_num = D('Cart/GoodsCart')->getCartNum($this->uid);
        //商品分类
        $cats = D('Site/Goods')->getCats();

        $this->assign('goods_cats', $cats);
        $this->assign('cart_num', $cart_num);
        $this->assign('selected', 'Member_Order_' . ACTION_NAME);
    }

    /**
     * 订单管理
     * 订单状态（0未付款、1已完成、2待发货、3待收货、4退货/款、5已取消、6已关闭、7失效、8评价[暂定]）
     */
    public function index(){
        $filter = array();
        $order = array(
            'addtime' => 'DESC'
        );

        $order_sn = I('request.order_sn');
        $status_type = I('request.status_type', 'all');
        //订单状态
        if ($status_type != 'all') {
            $filter['order_status'] = intval($status_type);
        }
        //订单号
        if ($order_sn) {
            $filter['order_sn'] = intval($order_sn);
            $this->assign('search_sn', $order_sn);
        }


        $count = M('goods_orderinfo')->where($filter)->count();
        $page = $this->page($count, 5);
        $orders = M('goods_orderinfo')->where($filter)->limit($page->firstRow . ',' . $page->listRows)->order($order)->select();

        if($orders){
            foreach($orders as $k => $v){
                $items = M('goods_order')->where(array('order_id' => $v['order_id']))->select();
                $orders[$k]['items'] = $items;
                $orders[$k]['items_count'] = count($items);
                unset($items);
            }
        }
        //单独处理订单状态
        $status_type = isset($status_type) ? $status_type : 'all';

        $this->assign('Page', $page->show());
        $this->assign('orders', $orders);
        $this->assign('status_type', $status_type);
        $this->assign('right', 'order_list');
        $this->display('Member/Member/index');
    }

    /**
     * 订单详情
     */
    public function orderDetail(){
        $order_id = I('get.oid', '', 'intval');
        //非法操作
        if(!$order_id){
            redirect(U('Member/Order/index'));
        }
        $order_info = M('goods_orderinfo')->find($order_id);
        //不存在此订单
        if(!$order_info){
            redirect(U('Member/Order/index'));
        } else {
            $items = M('goods_order')->where(array('order_id' => $order_id))->select();
            $order_info['items'] = $items;
            $order_info['items_num'] = count($items);
        }
        //用户操作日志
        $order_log = M('order_log')->where(array('uid' => $this->uid, 'order_id' => $order_id))->order('created DESC')->limit(3)->select();

        $this->assign($order_info);
        $this->assign('order_log', $order_log);
        $this->assign('right', 'order_detail');
        $this->display('Member/Member/index');
    }

    /**
     * 退款列表
     */
    public function refund(){
        $aftersales_mdl = M('goods_aftersales');
        $count = $aftersales_mdl->where(array('uid' => $this->uid))->count();
        $page = $this->page($count, 5);
        $aftersales = $aftersales_mdl->where(array('uid' => $this->uid))->limit($page->firstRow . ',' . $page->listRows)->order('created DESC')->select();

        $this->assign('aftersales', $aftersales);
        $this->assign('right', 'order_refund');
        $this->display('Member/Member/index');
    }

    /**
     * 退款申请
     */
    public function refundApply(){
        if(IS_POST){

        } else {
            $this->assign('right', 'order_refund_apply');
            $this->display('Member/Member/index');
        }
    }

    /**
     * 退货
     */
    public function returnGoods(){

        $this->assign('right', 'order_returngoods');
        $this->display('Member/Member/index');
    }

    /**
     * 投诉
     */
    public function complaint(){
        $complaint_mdl = M('goods_complaint');
        $count = $complaint_mdl->where(array('uid' => $this->uid))->count();
        $page = $this->page($count, 5);
        $complaint = $complaint_mdl->where(array('uid' => $this->uid))->limit($page->firstRow . ',' . $page->listRows)->order('created DESC')->select();

        $this->assign('complaint', $complaint);
        $this->assign('right', 'complaint');
        $this->display('Member/Member/index');
    }

    /**
     * 我的评价
     */
    public function commentList(){
        $comment_mdl = M('goods_comment');
        $count = $comment_mdl->where(array('uid' => $this->uid))->count();
        $page = $this->page($count, 5);
        $comments = $comment_mdl->where(array('uid' => $this->uid))->limit($page->firstRow . ',' . $page->listRows)->order('created DESC')->select();

        $this->assign('comments', $comments);
        $this->assign('right', 'comment_list');
        $this->display('Member/Member/index');
    }

    /**
     * 我要评价
     */
    public function comment(){
        if(IS_POST){

        } else {
            $this->assign('right', 'goods_comment');
            $this->display('Member/Member/index');
        }
    }

    /**
     * 获取取消订单模版
     */
    public function change_state(){
        if(IS_AJAX){
            $state_type = I('get.state_type', 'order_cancel');
            switch($state_type){

                case 'order_cancel':
                    $order_id = I('get.oid', 0, 'intval');
                    if($order_id){
                        $order = M('goods_orderinfo')->field('order_id,order_sn')->find($order_id);

                        $this->assign($order);
                        $this->display('Member/Order/cancel_order');
                    } else {
                        msg('error','不存在此订单');
                    }
                    break;

                default:
                    break;
            }

        }

    }
}
