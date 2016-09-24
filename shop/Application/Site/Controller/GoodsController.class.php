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
        $page = isset($_GET[C("VAR_PAGE")]) ? $_GET[C("VAR_PAGE")] : 1;
        $page = max($page, 1);
        //模板处理
        $tp = explode(".", self::$Cache['Config']['indextp']);
        $tp[0] = $tp[0] ? $tp[0] : 'index';
        $SEO = seo('', '', self::$Cache['Config']['siteinfo'], self::$Cache['Config']['sitekeywords']);
        //生成路径
        $urls = $this->Url->index($page);
        $GLOBALS['URLRULE'] = $urls['page'];
        //seo分配到模板
        $this->assign("SEO", $SEO);
        //把分页分配到模板
        $this->assign(C("VAR_PAGE"), $page);
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
        $goods = $this->checkGoods();
        //最近浏览

        $this->display();
    }

    /**
     * 验证商品是否存在 默认跳转到商品列表页面 存在商品时返回商品信息
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
        return $goods;
    }
}
