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
        //查询浏览的商品数据
        $look_goods = M('goods')->where(array('goods_id' => array('IN', $goods_ids)))->select();
        if($look_goods){
            //删除之前的浏览记录
            M('goods_look')->where(array('goods_id' => array('IN', $goods_ids),'uid' => $uid))->delete();
            foreach($look_goods as $k => $goods){
                $data_list[$k] = array(
                    'goods_id'     => $goods['goods_id'],
                    'goods_name'   => $goods['goods_name'],
                    'goods_thumb'  => $goods['goods_thumb'],
                    'goods_price'  => $goods['goods_price'],
                    'market_price' => $goods['market_price'],
                    'uid'          => $uid,
                    'created'      => time(),
                );
            }
            M('goods_look')->addAll($data_list);
        }
    }

    /**
     * 添加商品到足迹
     * @param array $params
     */
    public function addLookLog($params){
        //检测是否存在此商品
        $filter = array('goods_id'=> $params['goods']['goods_id'], 'uid' => $params['uid']);
        $check_look = M('goods_look')->where($filter)->find();
        if($check_look){
            M('goods_look')->where($filter)->delete();
        }
        $look_data = array(
            'goods_id'     => $params['goods']['goods_id'],
            'goods_name'   => $params['goods']['goods_name'],
            'goods_thumb'  => $params['goods']['goods_thumb'],
            'goods_price'  => $params['goods']['goods_price'],
            'market_price' => $params['goods']['market_price'],
            'uid'          => $params['uid'],
            'created'      => time(),
        );
        make_log($look_data);
        M('goods_look')->add($look_data);
    }

    /**
     * 获取最大运费
     * @param array $filter
     * @return int
     */
    public function getMaxFreight($filter){
        $freights = $this->field('freight')->where($filter)->select();
        $freight_list = array();
        foreach($freights as $v){
            $freight_list[] = $v['freight'];
        }
        return max($freight_list);
    }

    /**
     * 获取最小运费
     * @param array $filter
     * @return int
     */
    public function getMinFreight($filter){
        $freights = $this->field('freight')->where($filter)->select();
        $freight_list = array();
        foreach($freights as $v){
            $freight_list[] = $v['freight'];
        }
        return min($freight_list);
    }

    /**
     * 足迹
     * @param  array $params
     * @return array
     */
    public function getBrowse($params){
        if($params['filter']){
            $filter = $params['filter'];
        }

        if($params['page_no'] && $params['page_size']){
            $limit = (($params['page_no']-1) * $params['page_size']) . ',' . $params['page_size'];
        } else {
            $limit = 10;
        }

        if($params['order_by']){
            $order = $params['order_by'];
        } else {
            $order = 'created DESC';
        }
        $browses = M('goods_look')->where($filter)->limit($limit)->order($order)->select();

        return  $browses;
    }
}
