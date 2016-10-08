<?php

// +----------------------------------------------------------------------
// | PC端商品模型
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Site\Model;

use Common\Model\Model;

class GoodsModel extends Model {

    //array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间])
    protected $_validate = array(
    );
    //array(填充字段,填充内容,[填充条件,附加规则])
    protected $_auto = array(
    );

    /**
     * 获取商品列表
     * @param string $field
     * @param array $filter
     * @param array $order
     * @param int $limit
     * @param boolean $sku
     * @return array
     */
    public function getGoodsList($field = '*', $filter = array(), $order = array('listorder' => 'DESC'), $limit = 12, $sku = false){
        if($limit == -1) $limit = '';
        if(!$order) $order = array('listorder' => 'DESC');
        $goods_list = $this->field($field)->where($filter)->order($order)->limit($limit)->select();
        //是否获取商品的sku
        if($sku == true){
            $goods_skus = array();//处理后的所有商品
            $goods_ids  = array();//带有sku所有商品ID
            //获得所有有属性的商品ID
            foreach($goods_list as $key => $goods){
                $goods_skus[$goods['goods_id']] = $goods;
                if($goods['is_sku']){
                    $goods_ids[] = $goods['goods_id'];
                }
            }
            unset($goods_list);
            if($goods_ids){
                $sku_list = M('goods_sku')->where(array('goods_id' => array('IN' => $goods_ids)))->select();
                foreach($sku_list as $k => $sku){
                    $goods_skus[$sku['goods_id']]['skus'][] = $sku;
                }
            }
            return $goods_skus;
        } else {

            return $goods_list;
        }
    }

    /**
     * 获取单个商品
     * @param string $field
     * @param array $filter
     * @param boolean $sku
     * @return array
     */
    public function getGoods($field = '*', $filter = array(), $sku = false){
        $goods = $this->field($field)->where($filter)->find();
        //是否获取商品的sku
        if($sku){
            $goods['skus'] = M('goods_sku')->where(array('goods_id' => $goods['goods_id']))->select();
        }
        return $goods;
    }

    /**
     * 将未登录时本地浏览记录更新到数据库
     * @param array $goods_ids
     * @param array $uid
     */
    public function updateLookLog($goods_ids, $uid){
        foreach($goods_ids as $k => $goods_id){
            $data_list[$k] = array(
                'goods_id' => $goods_id,
                'uid'      => $uid,
                'created'  => time(),
            );
        }

        M('goods_look')->addAll($data_list);
    }

}
