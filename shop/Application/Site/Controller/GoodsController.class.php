<?php

// +----------------------------------------------------------------------
// | PC商城
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp535201470@qq.com>
// +----------------------------------------------------------------------

namespace Site\Controller;

class GoodsController extends SiteController
{
    public $model;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = D('Site/Goods');
    }

    //pc首页
    public function index(){

        $this->display();
    }

    //商品列表
    public function products(){
        $order  = array();//排序
        $filter = array();//筛选
        //商品列表
        $list = $this->model->getGoodsList('*', $filter);

        $this->assign('list', $list);
        $this->display();
    }

    //商品详情页
    public function product(){
        //验证商品是否存在
        $this->checkGoods();

        $this->display();
    }

    /**
     * 验证商品是否存在 默认跳转到商品列表页面
     * @param string $url
     */
    private function checkGoods($url=''){
        $url = $url ? $url : U('products');
        $goods_id = I('get.gid', 0, 'intval');
        //非法验证
        if($goods_id == 0){
            redirect($url);
        }
        //验证是否存在此商品
        $goods = $this->model->where(array('goods_id' => $goods_id))->find();
        if(!$goods){
            redirect($url);
        }
        //验证商品是否上架
        if($goods['is_show'] == 0){
            redirect($url);
        }
    }
}
