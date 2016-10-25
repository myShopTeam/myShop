<?php

// +----------------------------------------------------------------------
// | 购物车
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: linpei <53501470@qq.com>
// +----------------------------------------------------------------------

namespace Cart\Controller;

use Base\Controller\BaseController;

class CartController extends BaseController
{
    private $__whiteList = array('addCart', 'delCart', 'getCartInfo'); //白名单 不需要验证登录

    public function _initialize()
    {
        parent::_initialize();
        //验证是否登录
        if (!in_array(ACTION_NAME, $this->__whiteList)) {
            $this->checkLogin();
        }
        $this->model = D('Cart/GoodsCart');
    }

    /**
     * 购物车
     */
    public function index(){
        $info = $this->model->getCartInfo($this->uid);
        //判断商品是否下架 todo

        //判断商品是否还有库存

        $checkCart = $info['carts'] ? 1 : 0;
        $this->assign('total', $info['total']);
        $this->assign('carts', $info['carts']);
        $this->assign('checkCart', $checkCart);
        $this->display();
    }

    /**
     * 添加商品到购物车
     */
    public function addCart(){
        if(IS_AJAX){
            $goods_id =  I('get.gid', 0, 'intval');
            $goods = D('Site/Goods')->getGoods('*', array('goods_id' => $goods_id), true);
            //添加购物车 1.登录用户存数据库 2.非登录用户存cookie
            if($this->isLogin() === true){
                if($goods){
                    //判断是否添加过购物车
                    if(!$this->model->checkGoodsInCart($goods)){
                        //处理购物车数据
                        $data = $this->__discountCartData($goods);
                        $data['uid'] = $this->uid;

                        $cart_id = M('goods_cart')->add($data);
                        if($cart_id){
                            //购物车总计
                            $result = array('cart_info' => $data);
                            $this->getCartTotal($result);
                            msg('success', '加入购物车成功', $result);
                        } else {
                            msg('error', '加入购物车失败');
                        }
                    } else {
                        //已加入购物车的商品 点击加入购物车的处理 比如：数量+1等
                        msg('success', '加入购物车成功');
                    }
                } else {
                    msg('error', '不存在此商品');
                }
            } else {
                //非登录用户
                if($this->__addCartToCookie($goods['goods_id'])){
                    if($goods){
                        //处理购物车数据
                        $data = $this->__discountCartData($goods);
                        //购物车总计
                        $result = array('cart_info' => $data);
                        $this->getCartTotal($result);
                        msg('success', '加入购物车成功',  $result);
                    } else {
                        msg('error', '不存在此商品');
                    }
                } else {
                    //已加入购物车的商品 点击加入购物车的处理 比如：数量+1等
                    msg('success', '加入购物车成功');
                }
            }
        } else {
            msg('error', '非法操作');
        }
    }

    /**
     * 删除购物车中商品
     */
    public function delCart(){
        if(IS_AJAX){
            //删除购物车 1.登录用户删数据库数据 2.非登录用户删cookie数据
            $cart_id =  I('get.cart_id', 0, 'intval'); //可能是goods_id 可能是cart_id
            if(!$cart_id){
                msg('error', '非法操作');
            }
            if($this->isLogin() === true){
                //判断是否添加过购物车
                if($this->model->find($cart_id)){
                    if($this->model->where(array('cart_id' => $cart_id))->delete()){
                        //购物车总计
                        $result = array('cart_info' => array());
                        $this->getCartTotal($result);
                        //判断购物车是否为空
                        $result['quantity'] = $result['cart_total']['money_total'] ? 1 : 0;
                        msg('success', '删除成功', $result);
                    } else {
                        msg('error', '删除失败');
                    }
                } else {
                    msg('error', '购物车中不存在此商品');
                }
            } else {
                //非登录用户
                if($this->__delCartToCookie($cart_id)){
                    //购物车总计
                    $result = array('cart_info' => array());
                    $this->getCartTotal($result);
                    msg('success', '删除成功', $result);
                } else {
                    //已加入购物车的商品 点击加入购物车的处理 比如：数量+1等
                    msg('error', '删除失败');
                }
            }
        } else {
            msg('error', '非法操作');
        }
    }

    /**
     * 获取购物车数据
     */
    public function getCartInfo(){
        if(IS_AJAX){
            if($this->uid){
                $cat_info = $this->model->where(array('uid' => $this->uid))->select();
            } else {
                //没有登录的用户读取cookie
                $cat_info = $this->model->getCookieCart();
            }
            //购物车总计
            $result = array('cart_info' => $cat_info);
            $this->getCartTotal($result, 'list');
            msg('success', '操作成功', $result);
        } else {
            msg('error', '非法操作');
        }
    }

    /**
     * 未登录用户添加商品到购物车后
     * @params int $goods_id
     * @return bool
     */
    private function __addCartToCookie($goods_id){
        $cookie_goods = cookie('cart');
        if($cookie_goods){
            $cart = explode(',', $cookie_goods);
            if(!in_array($goods_id, $cart)){
                $cookie_goods = $cookie_goods . ',' . $goods_id;
                cookie('cart', $cookie_goods, 0);
                return true;
            } else {
                return false;
            }
        } else {
            cookie('cart', $goods_id, 0);
            return true;
        }

    }

    /**
     * 未登录用户删除购物车中商品
     * @params int $goods_id
     * @return bool
     */
    private function __delCartToCookie($goods_id){
        $cookie_goods = cookie('cart');
        if($cookie_goods){
            $cart = explode(',', $cookie_goods);
            if(in_array($goods_id, $cart)){
                //只有一个的时候清空cookie
                if(count($cart) == 1){
                    cookie('cart', null);
                } else {
                    $del_key = array_search($goods_id, $cart);
                    unset($cart[$del_key]);
                    cookie('cart', implode(',', $cart), 0);
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    /**
     * 未登录用户添加商品到购物车后
     * @params array $goods
     * @return bool
     */
    private function __discountCartData($goods){
        $data = array(
            'goods_id'       => $goods['goods_id'],
            'created'        => time(),
            'goods_name'     => $goods['goods_name'],
            'goods_barcode'  => $goods['goods_barcode'],
            'goods_serial'   => $goods['goods_serial'],
            'market_price'   => $goods['market_price'],
            'goods_price'    => $goods['goods_price'],
            'goods_thumb'    => $goods['goods_thumb'],
            'goods_num'      => 1,
        );

        //处理属性 默认属性商品加入购物车
        $skus = $goods['skus'];
        foreach($skus as $sku){
            if($sku['default_sku']){
                $data['sku_id']     = $sku['sku_id'];
                $data['attr_price'] = $sku['attr_price'];
                $data['attr_name']  = $sku['attr_name'];
                $data['attr_value'] = $sku['attr_value'];
            }
        }
        return $data;
    }

    /**
     * 购物车总计
     * @params array $cart_info
     * @params string $type
     */
    public function getCartTotal(&$cart_info, $type=''){
        //cart_total 里存购物车统计数据
        $cart_info['cart_total']['money_total'] = 0;

        if($type == 'list'){
            $carts = $cart_info['cart_info'];
        } else {
            if($this->uid){
                $carts = $this->model->where(array('uid' => $this->uid))->select();
            } else {
                $carts = $this->model->getCookieCart();
            }
        }
        if($carts){
            foreach($carts as $cart){
                //商品数量
                $goods_num = $cart['goods_num'] ? $cart['goods_num'] : 1;
                $cart_info['cart_total']['goods_total'] += $goods_num;
                if($cart['sku_id']){
                    //商品价格
                    $cart_info['cart_total']['money_total'] += $cart['attr_price'] * $goods_num;
                } else {
                    $cart_info['cart_total']['money_total'] += $cart['goods_price'] * $goods_num;
                }
            }
            cur($cart_info['cart_total']['money_total']);
        }
    }

    /**
     * 修改购物车商品数量
     */
    public function change(){
        if(IS_AJAX){
            $get = I('get.');
            //验证数据
            if(!$this->model->checkCart(array('cart_id' => intval($get['cart_id']), 'uid' => $this->uid))){
                msg('error', '非法操作');
            }

            if(intval($get['quantity']) !== 0){
                $cart_id  = intval($get['cart_id']);
                //数量
                $quantity = intval($get['quantity']);
                //验证商品库存
                $cart_info = $this->model->find($cart_id);
                $this->__checkSku($cart_info, $quantity);

                $filter = array('cart_id' => $cart_id, 'uid' => $this->uid);
                $data   = array('goods_num' => $quantity);
                $this->model->where($filter)->save($data);
//                $carts = $this->model->where(array('uid' => $this->uid))->select();
                //初始化数据
                $return_data = array(
                    'goods_price' => $cart_info['sku'] ? $cart_info['attr_price'] : $cart_info['goods_price'],
                    'goods_num'   => $quantity,
                );
                $return_data['subtotal'] = $return_data['goods_price'] * $return_data['goods_num'];
//                foreach($carts as $k => $cart){
//                    if($cart['sku']){
//                        $return_data['subtotal'] = $cart['goods_num'] * $cart['attr_price'];
//                    } else {
//                        $return_data['subtotal'] = $cart['goods_num'] * $cart['goods_price'];
//                    }
//                    $return_data['subtotal']  += $cart['goods_price'];
//                }
                msg('success', '操作成功', $return_data);
            } else {
                msg('error', '非法操作');
            }
        } else {
            msg('error', '非法操作');
        }
    }

    /**
     * 清除购物车
     * @param array  $cart_ids
     * @return bool
     */
    public function clearCart($cart_ids){
        if($cart_ids){
            return $this->model->where(array('cart_id' => array('IN', $cart_ids)))->delete();
        } else {
            return false;
        }
    }

    /**
     * 清除此用户购物车缓存
     */
    public function clearCartCache(){
        S('cart' . $this->uid, null);
        S('is_cart' . $this->uid, null);
    }

    /**
     * 验证商品库存
     * @param array $params
     * @param int $quantity
     */
    private function __checkSku($params, &$quantity){
        //根据商品的sku判断库存
        if($params['sku']){
            $total = M('goods_sku')->where(array('sku_id' => $params['sku']))->getField('sku_total');
        } else {
            $total = M('goods')->where(array('goods_id' => $params['goods_id']))->getField('goods_total');
        }

        $quantity = $quantity > $total ? $total : $quantity;
    }

}
