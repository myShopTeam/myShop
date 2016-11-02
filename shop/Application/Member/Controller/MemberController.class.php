<?php

// +----------------------------------------------------------------------
// | 会员管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Member\Controller;

use Base\Controller\BaseController;

class MemberController extends BaseController
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

        $this->assign('cart_num', $cart_num);
        $this->assign('selected', 'Member_Member_' . ACTION_NAME);
    }

    /**
     * 会员主页
     */
    public function index(){
        $data = array();
        //交易提醒 取最近3条订单信息 状态为：0未付款
        $data['orders'] = M('goods_orderinfo')->where(array('uid' => $this->uid, 'order_status' => 0))->order('addtime DESC')->limit(3)->select();
        if($data['orders']){
            foreach($data['orders'] as $k => $order){
                $data['orders'][$k]['order_items'] = M('goods_order')->where(array('order_id' => $order['order_id']))->select();
                $data['orders'][$k]['items_num']   = count($data['orders'][$k]['order_items']);
            }
        }
        //获取各订单数量
        $orders_status = D('Order/GoodsOrder')->getOrderStatusNum(array('uid' => $this->uid));

        //购物车数据
        $data['carts'] = M('goods_cart')->where(array('uid' => $this->uid))->select();;
        //商品收藏
        $data['collects'] = array();
        //我的足迹
        $params = array(
            'filter'    => array('uid' => $this->uid),
            'page_no'   => 1,
            'page_size' => 9,
        );
        $data['browses'] = D('Site/Goods')->getBrowse($params);

        $this->assign($data);
        $this->assign('orders_num', $orders_status);
        $this->assign('right', 'home');
        $this->display();
    }

    /**
     * 用户设置
     */
    public function member(){

        $this->assign('right', 'member_right');
        $this->display('index');
    }

    /**
     * 编辑资料
     */
    public function editMember(){

        $this->display();
    }

    /**
     * 修改用户头像
     */
    public function modifyAvatar(){

        $this->assign('right', 'avatar_right');
        $this->display('index');
    }

    /**
     * 用户关注的商品
     */
    public function favoriteGoods(){
        $collects = M('goods_collect')->where(array('uid' => $this->uid))->order('addtime DESC')->select();

        if($collects){
            $collect_ids = array_keys(array_bind_key($collects, 'id'));
            $goods = M('goods')->where(array('goods_id' => array('IN',$collect_ids)))->select();

            $this->assign('items', $goods);
        }

        $this->assign('right', 'collect_right');
        $this->display('index');
    }

    /**
     * 取消关注
     */
    public function delFavoriteGoods(){
        if(IS_AJAX){
            $collect_id = I('cid', '', 'intval');
            //非法操作
            if(!$collect_id){
                msg('error', '非法操作');
            }
            //判断用户是否关注
            $check = M('goods_collect')->where(array('id' => $collect_id, 'uid' => $this->uid))->find();
            if(!$check){
                msg('error', '不存在该商品');
            } else {
                M('goods_collect')->where(array('id' => $collect_id))->delete();
                msg('success', '取消成功', array(), U('Member/Member/favoriteGoods'));
            }
        }
    }

    /**
     * 用户足迹
     */
    public function goodsBrowse(){
        $browses = M('goods_look')->where(array('uid' => $this->uid))->order('created DESC')->select();


        $this->assign('browses', $browses);
        $this->assign('right', 'browse_right');
        $this->display('index');
    }

    /**
     * 修改登录密码
     */
    public function modifyPwd(){

        $this->display();
    }

    /**
     * 邮箱绑定
     */
    public function modifyEmail(){

        $this->display();
    }

    /**
     * 收货地址
     */
    public function address(){

        $this->assign('right', 'address_right');
        $this->display('index');
    }
}
