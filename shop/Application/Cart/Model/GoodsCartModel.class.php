<?php

// +----------------------------------------------------------------------
// | 购物车模型
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Cart\Model;

use Common\Model\Model;

class GoodsCartModel extends Model {

    /**
     * 将未登录时本地购物车数据更新到数据库
     * @param array $goods_ids
     * @param array $uid
     */
    public function updateCart($goods_ids, $uid){
        $data_list = array();
        //查出对应商品
        $filter = array('goods_id', array('IN', $goods_ids));
        $goods_list = D('Site/Goods')->getGoodsList('*', $filter, '', -1, true);
        foreach($goods_list as $k => $goods){
            $data_list[$k] = array(
                'goods_id'       => $goods['goods_id'],
                'uid'            => $uid,
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
                    $data_list[$k]['sku_id']     = $sku['sku_id'];
                    $data_list[$k]['attr_price'] = $sku['attr_price'];
                    $data_list[$k]['attr_name']  = $sku['attr_name'];
                    $data_list[$k]['attr_value'] = $sku['attr_value'];
                }
            }
        }

        M('goods_look')->addAll($data_list);
    }

    /**
     * 判断是否添加过购物车
     * @param array $goods
     * @return bool
     */
    public function checkGoodsInCart($goods){
        //判断商品是否有属性
        $filter = $goods['is_sku'] == 1 ? array('sku_id' => $goods['sku_id']) : array('goods_id' => $goods['goods_id']);
        $cart = $this->where($filter)->find();
        return $cart ? true : false;
    }

    /**
     * 获取购物车数量
     * @param int $uid
     * @return int
     */
    public function getCartNum($uid){
        //没有登录的用户通过cookie获取商品
        if($uid){
            $count = $this->where(array('uid' => $uid))->count();
        } else {
            $count = cookie('cart') ? count(explode(',', cookie('cart'))) : 0;
        }
        return $count;
    }

    /**
     * 未登录用户根据cookie获取购物车数据
     */
    public function getCookieCart(){
        if(cookie('cart')){
            $carts = explode(',', cookie('cart'));
            $field = 'goods_id,goods_name,goods_price,goods_thumb';
            $goods_list = D('Site/Goods')->getGoodsList($field, array('goods_id' => array('IN', $carts)), '', -1);
            return $goods_list;
        } else {
            return null;
        }
    }

    /**
     * 验证用户购物车数据
     * @params $filter
     */
    public function checkCart($filter){
        $check = $this->where($filter)->find();

        return $check ? true : false;
    }

}
