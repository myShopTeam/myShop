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
    private $__whiteList = array(); //白名单 不需要验证登录

    public function _initialize()
    {
        parent::_initialize();
        //验证是否登录
        if (!in_array(ACTION_NAME, $this->__whiteList)) {
            $this->checkLogin();
        }
        $this->model = D('Cart/GoodsOrder');
    }

    /**
     * 我的订单
     */
    public function index()
    {
        $post = I('post.');
        $filter = array();
        //验证是否有数据
        if (!$post['cart_id'] && !S('cart' . $this->uid)) {
            redirect(U('Site/Goods/products'));
        }
        if ($post['cart_id']) {
            S('cart' . $this->uid, $post['cart_id']);
        } else {
            $post['cart_id'] = S('cart' . $this->uid);
        }
        //判断是否立即购买还是从购物车进入 是1 不是-1
        $is_cart = S('is_cart' . $this->uid);
        $post['is_cart'] = $post['is_cart'] ? $post['is_cart'] : $is_cart;
        if($post['is_cart']){
            S('is_cart' . $this->uid, $post['is_cart']);
            $filter['cart_id'] = array('IN',$post['cart_id']);
        } else {
            $post['is_cart'] = S('is_cart' . $this->uid);
            //立即购买 单个id
            $filter['cart_id'] = $post['cart_id'];
        }
        //获取购物车数据
        $filter['uid'] = $this->uid;
        $info = D('Cart/GoodsCart')->getCartInfo($filter);
        if(!$info || !$info['carts']){
            redirect(U('Site/Goods/products'));
        }
        //判断商品是否下架 todo

        //判断商品是否还有库存

        //总金额涉及到运费 优惠等
        $info['goods_total'] = $info['total'];
        //运费 多件商品选取最大的运费
        $info['freight'] = D('Site/goods')->getMaxFreight(array('goods_id' => array('IN', $info['goods'])));
        $info['total'] += $info['freight'];
        //收货地址 默认地址>最后一次选择的收货地址
        $address = array();
        $address['list'] = D('Member/MemberAddress')->getAddress($this->uid);
        if ($address['list']) {
            $first_address = current($address['list']);
            if ($first_address['default_address'] == 1) {
                $default_address = current($address['list']);
            } else {
                $end_address_id = S('end_address_' . $this->uid);
                if ($end_address_id && $address['list'][$end_address_id]) {
                    //选取缓存中最后一次使用的地址
                    $default_address = $address['list'][$end_address_id];
                } else {
                    $default_address = current($address['list']);
                }
            }

        } else {
            $address['on_address'] = 1;
        }
        //创建订单所需的购物车ID
        $carts = is_array($post['cart_id']) ? implode(',', $post['cart_id']) : $post['cart_id'];

        $this->assign('info', $info);
        $this->assign('carts', $carts);
        $this->assign('address', $address);
        $this->assign('address_json', json_encode($address['list']));
        $this->assign('default_address', $default_address);
        $this->display();
    }

    /**
     * 创建订单
     */
    public function createorder(){
        //非法请求
        if(!IS_POST){
            msg('error', '非法操作', array(), U('Cart/Cart/index'));
        }
        $post = I('post.');
        //处理参数
        $this->__checkParams($post);
        //收货地址
        $addr_info = M('member_address')->where(array('id' => $post['address_id'], 'uid' => $this->uid))->find();
        if(!$addr_info){
            msg('error', '非法操作', array(), U('Cart/Cart/index'));
        }
        //购物车ID
        if($post['carts']){
            $carts = explode(',', $post['carts']);
        }
        $cart_info = M('goods_cart')->where(array('cart_id' => array('IN', $carts)))->select();
        $goods_fee    = 0; //商品总额
        $goods_total  = 0; //商品总数
        $goods_ids = array();

        foreach($cart_info as $k => $cart){
            $goods_total += $cart['goods_num'];
            //商品是否存在属性
            $price = $cart['sku_id'] ? $cart['attr_price'] : $cart['goods_price'];
            //商品总额
            $goods_fee += $price * $cart['goods_num']; //优惠促销等计算 在此处除去 todo
            //商品ID
            if(!in_array($cart['goods_id'], $goods_ids)){
                $goods_ids[] = $cart['goods_id'];
            }
        }
        $freight = D('Site/goods')->getMaxFreight(array('goods_id' => array('IN', $goods_ids)));
        //付款金额=商品总价+邮费等
        $pay_fee = $goods_fee + $freight;
        //订单总额 订单货币总值 包含支付价格 税等
        $final_amount = $pay_fee;
        //组装订单数据
        $nowtime = time();
        $order_info = array(
            'order_sn'     => $this->getOrderSn(),
            'uid'          => $this->uid,
            'username'     => $this->member_info['username'],
            'consignee'    => $addr_info['full_name'],
            'province'     => $addr_info['province_name'],
            'city'         => $addr_info['city_name'],
            'area'         => $addr_info['area_name'],
            'address'      => $addr_info['address'],
            'mobile_phone' => $addr_info['mobile_phone'] ? $addr_info['mobile_phone'] : $addr_info['phone'],
            'postal'       => $addr_info['postal'],
            'addtime'      => $nowtime,
            'goods_total'  => $goods_total,
            'final_amount' => $final_amount,
            'goods_fee'    => $goods_fee,
            'pay_fee'      => $pay_fee,
            'payment'      => $post['payment'],
            'is_tax'       => $post['is_tax'],
            'recom'        => $post['recom'],
        );
        //开启事务
        M()->startTrans();
        $order_id = M('goods_orderinfo')->add($order_info);

        if($order_id){
            //订单商品信息
            $order = array();
            $cart_ids = array();
            foreach($cart_info as $k => $cart){
                $order[] = array(
                    'order_id'      => $order_id,
                    'goods_id'      => $cart['goods_id'],
                    'goods_name'    => $cart['goods_name'],
                    'goods_serial'  => $cart['goods_serial'],
                    'goods_barcode' => $cart['goods_barcode'],
                    'goods_num'     => $cart['goods_num'],
                    'market_price'  => $cart['market_price'],
                    'goods_price'   => $cart['goods_price'],
                    'goods_attr'    => $cart['goods_attr'],
                    'sku_id'        => $cart['sku_id'],
                    'attr_name'     => $cart['attr_name'],
                    'attr_value'    => $cart['attr_value'],
                    'goods_thumb'   => $cart['goods_thumb'],
                );
                $cart_ids[] = $cart['cart_id'];
                //订单支付名称
                $order_info['pay_body_array'][] = $cart['goods_name'];
                $order_info['product_id'][] = $cart['goods_id'];
            }
            $order_result = M('goods_order')->addAll($order);
            if($order_result){
                //订单创建成功 清除购物车信息
                $clear_bool = A('Cart/Cart')->clearCart($cart_ids);
                //清除此用户购物车缓存
                A('Cart/Cart')->clearCartCache();
                if($clear_bool){
                    M()->commit();
                    $order_info['pay_body'] = implode('、', $order_info['pay_body_array']) . '等共' . count($order_info['pay_body_array']) . '件商品';
                    make_log($order_info);
                    $data = array(
                        'data' => A('Wechat/Wxpay')->native($order_info),
                    );
                    $this->assign('pay_data', $data['data']);
                    $pay_code = $this->fetch('Order/pay_code');
                    msg('success', '订单创建成功', array('pay_code' => $pay_code), U('Member/Member/index'));
                }
            } else {
                M()->rollback();
                msg('error', '订单创建失败', array(), U('Cart/Cart/index'));
            }
        } else {
            M()->rollback();
            msg('error', '订单创建失败', array(), U('Cart/Cart/index'));
        }
    }

    /**
     * 支付提交页面
     */
    public function submit(){

    }

    /**
     * 取消订单
     */
    public function orderCancel(){
        if(IS_POST){
            $order_id = I('post.oid', 0, 'intval');
            $state_info  = I('post.state_info');
            $state_info1 = I('post.state_info1');
            if($order_id){
                $cancel_msg = $state_info ? $state_info : $state_info1;
                $data = array(
                    'order_status' => '5',
                    'cancel_msg'   => $cancel_msg
                );
                M('goods_orderinfo')->where(array('order_id' => $order_id))->save($data);
                //记录用户操作日志
                $data['order_id'] = $order_id;
                $data['created']  = time();
                $data['uid']      = $this->uid;
                M('order_log')->add($data);
                $url = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : U('Member/Member/index');
                redirect($url);
            } else {
                redirect(U('Member/Member/index'));
            }
        } else {
            redirect(U('Member/Member/index'));
        }
    }

    /**
     * 处理参数
     * @param array $data
     */
    private function __checkParams(&$data){
        //地址
        $data['address_id'] = intval($data['address_id']);
        //发票
        $data['is_tax']     = $data['is_tax'] ? 1 : 0;
        //支付方式
        $payment = F('payment');
        $data['payment'] = in_array($data['payment'], $payment) ? $data['payment'] : 'alipay';
        //过滤买家留言
        $data['recom'] = $data['recom'] ? htmlspecialchars($data['recom']) : '';
    }

    /**
     * 生成订单号
     */
    public function getOrderSn(){
        return date('YmdHis', time()) . rand(100000, 999999);
    }

}
