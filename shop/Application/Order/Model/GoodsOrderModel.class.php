<?php

// +----------------------------------------------------------------------
// | 订单管理模型
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Order\Model;

use Common\Model\Model;

class GoodsOrderModel extends Model {

    /**
     * 获取各个状态订单数量
     * @param  array $params
     * @return array
     */
    public function getOrderStatusNum($params){
        $orders_status = M('goods_orderinfo')->field('order_status,count(order_id) AS order_num')->where(array('uid' => $params['uid']))->group('order_status')->select();
        $orders_status = array_bind_key($orders_status, 'order_status');
        //待评论订单数量
        $orders_status[8] = array('order_status' => 8, 'order_num' => 0);
        $comment_order = M('goods_order')->field('comment_status,order_id')->where(array('uid' => $params['uid']))->group('order_id')->select();
        if($comment_order){
            foreach($comment_order as $k => $v){
                //未评价数量
                if($v['comment_status'] == 0){
                    $orders_status[8]['order_num'] ++;
                }
            }
        }

        return $orders_status;
    }
}
