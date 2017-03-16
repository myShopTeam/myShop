<?php

// +----------------------------------------------------------------------
// | 会员管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Member\Controller;

use Base\Controller\BaseController;

class MemberController extends BaseController
{

    private $__whiteList = array(); //白名单 不需要验证登录

    public function _initialize()
    {
        parent::_initialize();
        //验证是否登录
        if (!in_array(ACTION_NAME, $this->__whiteList)) {
            $this->checkLogin();
        }
        $this->model = D('card');
        //购物车商品数量
        $cart_num = D('Cart/GoodsCart')->getCartNum($this->uid);
        //商品分类
        $cats = D('Site/Goods')->getCats();

        $this->assign('goods_cats', $cats);
        $this->assign('cart_num', $cart_num);
        $this->assign('selected', 'Member_Member_' . ACTION_NAME);
    }

    /**
     * 会员主页
     */
    public function index(){
        $data = array();
        //交易提醒 取最近3条订单信息 状态为：0未付款
        $data['orders'] = M('goods_orderinfo')->where(array('uid' => $this->uid, 'order_status' => 0))->order('addtime DESC')->limit(3)->select();
        if($data['orders']){
            foreach($data['orders'] as $k => $order){
                $data['orders'][$k]['order_items'] = M('goods_order')->where(array('order_id' => $order['order_id']))->select();
                $data['orders'][$k]['items_num']   = count($data['orders'][$k]['order_items']);
            }
        }
        //获取各订单数量
        $orders_status = D('Order/GoodsOrder')->getOrderStatusNum(array('uid' => $this->uid));

        //购物车数据
        $data['carts'] = M('goods_cart')->where(array('uid' => $this->uid))->select();;
        //商品收藏
        $collects = M('goods_collect')->where(array('uid' => $this->uid))->order('addtime DESC')->select();

        if($collects){
            $collect_ids = array_keys(array_bind_key($collects, 'goods_id'));
            $data['collects'] = M('goods')->where(array('goods_id' => array('IN',$collect_ids)))->select();

        }
        //我的足迹
        $params = array(
            'filter'    => array('uid' => $this->uid),
            'page_no'   => 1,
            'page_size' => 9,
        );
        $data['browses'] = D('Site/Goods')->getBrowse($params);

        $this->assign($data);
        $this->assign('orders_num', $orders_status);
        $this->assign('right', 'home');
        $this->display();
    }

    /**
     * 用户设置
     */
    public function member(){
        //用户所在地区 member_area 格式： 湖北省/武汉市/洪山区:420000/420100/420111
        if($this->member_info['member_area']){
            $member_area = explode(':', $this->member_info['member_area']);
            $area = array(
                'name' => explode('/', $member_area[0]),
                'code' => explode('/', $member_area[1]),
            );
            $this->assign('area_data', $area);
        }


        $this->assign('right', 'member_right');
        $this->display('index');
    }

    /**
     * 编辑资料
     */
    public function editMember(){
        if(IS_AJAX){
            $params = I('get.');
            $data = array();

            //验证昵称是否存在
            if($params['nickname']){
                $check_nickname = $this->model->checkNickname(array('uid' => $this->uid, 'nickname' => $params['nickname']));
                if($check_nickname == true){
                    msg('error','此昵称已存在');
                } else {
                    $data['nickname'] = $params['nickname'];
                }
            }

            if($params['qq']){
                $data['qq'] = $params['qq'];
            }

            if($params['realname']){
                $data['realname'] = $params['realname'];
            }

            //昵称不能重复 性别默认 保密
            $data['sex'] = !in_array($params['sex'], array('男','女','保密')) ? '保密' : $params['sex'];
            //处理省市区
            $member_area = $this->getMemberArea($params);
            if($member_area){
                $data['member_area'] = $member_area;
            }
            $this->model->where(array('id' => $this->uid))->save($data);
            $this->updateMember();
            msg('success','操作成功',$params,U('Member/Member/member'));

        }
    }

    /**
     * 修改用户头像
     */
    public function modifyAvatar(){

        $this->assign('right', 'avatar_right');
        $this->display('index');
    }

    /**
     * 用户关注的商品
     */
    public function favoriteGoods(){
        $collects = M('goods_collect')->where(array('uid' => $this->uid))->order('addtime DESC')->select();

        if($collects){
            $collect_ids = array_keys(array_bind_key($collects, 'goods_id'));
            $goods = M('goods')->where(array('goods_id' => array('IN',$collect_ids)))->select();

            $this->assign('collects', $goods);
        }

        $this->assign('right', 'collect_right');
        $this->display('index');
    }

    /**
     * 取消关注
     */
    public function delFavoriteGoods(){
        if(IS_AJAX){
            $goods_id = I('get.id', 0, 'intval');
            //非法操作
            if(!$goods_id){
                msg('error', '非法操作');
            }
            //判断用户是否关注
            $check = M('goods_collect')->where(array('goods_id' => $goods_id, 'uid' => $this->uid))->find();
            if(!$check){
                msg('error', '不存在该商品');
            } else {
                M('goods_collect')->where(array('goods_id' => $goods_id, 'uid' => $this->uid))->delete();
                msg('success', '取消成功', array(), U('Member/Member/favoriteGoods'));
            }
        }
    }

    /**
     * 用户足迹
     */
    public function goodsBrowse(){
        $filter = array('uid' => $this->uid);
        $count = M('goods_look')->where($filter)->count();
        $page = $this->page($count, 8);
        $browses = M('goods_look')->where($filter)->limit($page->firstRow . ',' . $page->listRows)->order('created DESC')->select();

        $this->assign('browses', $browses);
        $this->assign('Page', $page->show());
        $this->assign('right', 'browse_right');
        $this->display('index');
    }

    /**
     * 删除足迹
     */
    public function delBrowse(){
        if(IS_AJAX){
            $id = I('get.id');
            if($id == 'all'){
                M('goods_look')->where(array('uid' => $this->uid))->delete();
                msg('success','删除成功');
            } else {
                if($id){
                    //验证是否存在
                    if(M('goods_look')->where(array('id' => $id, 'uid' => $this->uid))->find()){
                        M('goods_look')->where(array('id' => $id))->delete();
                        msg('success','删除成功');
                    } else {
                        msg('error','不存在此数据');
                    }
                }
            }
        }
    }

    /**
     * 修改登录密码
     */
    public function modifyPwd(){

        $this->display();
    }

    /**
     * 邮箱绑定
     */
    public function modifyEmail(){

        $this->display();
    }

    /**
     * 收货地址
     */
    public function address(){
        $address = M('member_address')->where(array('uid' => $this->uid))->order('created ASC')->select();

        $this->assign('right', 'address_right');
        $this->assign('address', $address);
        $this->display('index');
    }

    /**
     * 添加、修改收货地址
     */
    public function modifyAddress(){
        $addr_id = I('post.addr_id');
        if($addr_id){
            //修改
        } else {
            //添加
        }

    }

    /**
     * 获取用户所在区域
     * @param array $params
     * @return string
     */
    public function getMemberArea($params){
        $member_area = array();
        if($params['province_id']){
            $member_area['code'][] = $params['province_id'];
            $member_area['name'][] = $params['province_name'];
        } else {
            return false;
        }

        if($params['city_id']){
            $member_area['code'][] = $params['city_id'];
            $member_area['name'][] = $params['city_name'];
        }

        if($params['area_id']){
            $member_area['code'][] = $params['area_id'];
            $member_area['name'][] = $params['area_name'];
        }

        return implode('/',$member_area['name']) . ':' . implode('/',$member_area['code']);
    }
}
