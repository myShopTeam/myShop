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
    public $page_num;   //页数
    public $page_limit; //一次加载的个数

    public function _initialize()
    {
        parent::_initialize();
        $this->model = D('Site/Goods');
        $this->page_num   = 1;
        $this->page_limit = 12;
        //购物车商品数量
        $cart_num = D('Cart/GoodsCart')->getCartNum($this->uid);

        $this->assign('cart_num', $cart_num);
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
        $filter = array('is_show' => 1);//筛选 默认查询上架商品
        $type   = I('get.type', 1, 'intval');
        $url_params = array(); //前台url使用
        //分类
        $catid  = I('get.cid', '', 'intval');
        //商品分类
        $cats = $this->model->getCats();
        //商品 上新new 热卖hot 精品best
        if(I('get.new', 0, 'intval')){
            $filter['is_new'] = 1;
            $url_params['new'] = 1;
            $this->assign('new', 1);
        }

        if(I('get.hot', 0, 'intval')){
            $filter['is_hot'] = 1;
            $url_params['hot'] = 1;
            $this->assign('hot', 1);
        }

        if(I('get.best', 0, 'intval')){
            $filter['is_best'] = 1;
            $url_params['best'] = 1;
            $this->assign('best', 1);
        }
        if($catid){
            //选择的分类置顶
            if($cats[$catid]){
                $cat_name = $cats[$catid]['cat_name'];
                $this_cat = $cats[$catid];
                unset($cats[$catid]);
                array_unshift($cats, $this_cat);
                //提取子分类为筛选条件
                $first_cat = pos($cats);
                if($first_cat['childs']){
                    $catids = array_keys($first_cat['childs']);
                    $catids[] = $catid;
                }
            } else {
                foreach($cats as $k => $cat){
                    if($cat['childs'][$catid]){
                        $cat_name = $cat['childs'][$catid]['cat_name'];
                        $this_cat = $cats[$cat['catid']];
                        unset($cats[$cat['catid']]);
                        array_unshift($cats, $this_cat);
                        $catids = array($catid);
                        break;
                    }
                }
            }

            //分类筛选
            $filter['cat_id'] = array('IN', $catids);
            $url_params['cid'] = $catid;
        }
        //排序
        if ($type == 2)
        {
            //销量最高
            $order['sale_num'] = 'DESC';
        }
        elseif ($type == 3)
        {
            //人气最高
            $order['browse'] = 'DESC';
        }
        elseif ($type == 4)
        {
            //价格排序
            $p_order = I('get.order', 'asc');
            $order['goods_price'] = $p_order;
            $p_order = $p_order == 'asc' ? 'desc' : 'asc';
            $this->assign('p_order', $p_order);
        }
        else
        {
            //默认
            $type = 1;
            $order['listorder'] = 'DESC';
        }
        $url_params['type'] = $type;

        //分页
        $goods_num = $this->model->where($filter)->count();
        $page = $this->page($goods_num, $this->page_limit);
        $limit = $page->firstRow . ',' . $this->page_limit;
        //商品列表
        $list = $this->model->getGoodsList('*', $filter, $order, $limit);

        //浏览历史
        if($this->uid){
            $browses = M('goods_look')->where(array('uid' => $this->uid))->order('created DESC')->limit(5)->select();
            $this->assign('browses', $browses);
        }

        $this->assign('type', $type);
        $this->assign('cats', $cats);
        $this->assign('list', $list);
        $this->assign('catid', $catid);
        $this->assign('cat_name', $cat_name);
        $this->assign('url_params', $url_params);
        $this->assign('pages', $page->show());
        $this->display();
    }

    //商品详情页
    public function product(){
        //验证商品是否存在
        $goods = $this->checkGoods();
        //最近浏览
        if($this->uid){
            $look_data = array(
                'goods' => $goods,
                'uid'   => $this->uid
            );
            $this->model->addLookLog($look_data);
        }
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
        $goods = $this->model->find($goods_id);
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
