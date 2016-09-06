<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 订单管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.qcjh.net, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Shop\Controller;

use Common\Controller\AdminBase;

class OrderController extends AdminBase
{

    protected function _initialize()
    {
        parent::_initialize();
    }

    //商品订单列表
    public function order_list()
    {
        $db = M('goods_orderinfo');
        $order_status = 'all';
        if (IS_POST) {
            $order_status = I('post.order_status', 'all', trim);
            $order_sn = I('post.order_sn', '', trim);
            if ($order_status != 'all') {
                $where['order_status'] = $order_status;
            }
            if ($order_sn) {
                $where['order_sn'] = array('like', "%$order_sn%");
                $this->assign('order_sn', $order_sn);
            }
        }
        $count = $db->where($where)->count();
        $page = $this->page($count, 10);
        $order_list = $db->where($where)->order(array('listorder' => 'desc', 'order_id' => 'desc'))
            ->limit($page->firstRow . ',' . $page->listRows)->select();

        $this->assign("Page", $page->show());
        $this->assign('order_status', $order_status);
        $this->assign("order_list", $order_list);
        $this->display();
    }

    //商品订单详情
    public function order_detail()
    {
        $orderDb = M('goods_order');
        $order_id = I('get.oid', '', intval);
        $orderInfoDb = M('goods_orderinfo');
        $orderInfo = $orderInfoDb->where(array('order_id' => $order_id))->find();
        $order = $orderDb->where(array('order_id' => $order_id))->select();
        //商品小计
        foreach ($order as $k => $v) {
            $goods_price = $v['sku_id'] ? $v['attr_price'] : $v['goods_price'];
            $order[$k]['subtotal'] = $v['goods_number'] * $goods_price;
        }
        // p($order_id);
        $this->assign($orderInfo);
        $this->assign('list', $order);
        $this->display();
    }

    //标记发货
    public function delivery()
    {
        $orderInfoDb = M('goods_orderinfo');
        $order_id = I('post.oid', '', intval);
        //查询是否存在此订单
        $checkOrder = $orderInfoDb->where(array('order_id' => $order_id))->find();
        if ($checkOrder) {
            $bool = $orderInfoDb->where(array('order_id' => $order_id))->save(array('order_status' => 3));
            if ($bool) {
                $result = array(
                    'status' => 1,
                    'msg' => '发货成功'
                );
            } else {
                $result = array(
                    'status' => 0,
                    'msg' => '发货失败'
                );
            }
        } else {
            $result = array(
                'status' => 0,
                'msg' => '非法操作'
            );
        }
        echo json_encode($result);
    }

    //排序
    public function listorder()
    {
        $info = I('post.', '', trim);
        $id = 'id';
        switch (I('get.str', '', trim)) {
            case "cat":
                $db = M('goods_category');
                $a = 'Goods/category_list';
                $id = 'catid';
                break;

            case "goods":
                $db = M('takeaway_goods');
                $a = 'Goods/goods_index';
                $id = 'goods_id';
                break;
        }
        foreach ($info['id'] as $k => $v) {
            $db->where(array($id => $v))->save(array('listorder' => $info['listorder'][$v]));
        }
        // p($info);
        $this->success('排序成功！', U($a));
    }
}
