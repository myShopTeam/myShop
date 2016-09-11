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
        $list = $this->field($field)->where($filter)->order($order)->limit($limit)->select();
        //是否获取商品的sku
        if($sku){

        }
        return $list;
    }

    /**
     * 获取单个商品
     * @param string $field
     * @param array $filter
     * @param boolean $sku
     * @return array
     */
    public function getGoods($field = '*', $filter = array(), $sku = false){
        $list = $this->field($field)->where($filter)->select();
        //是否获取商品的sku
        if($sku){

        }
        return $list;
    }


}
