<?php

// +----------------------------------------------------------------------
// | 商城前台登录注册
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Site\Controller;

class PassportController extends SiteController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    //登录页面
    public function login(){
        //登录过的用户 跳转到商品列表
        $redirect_url = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : U('Goods/products');

        if($this->isLogin()){
            redirect($redirect_url);
        }

        $this->assign('code', $this->getVerify());
        $this->assign('redirect_url', $redirect_url);
        $this->display();
    }

    //注册
    public function register(){

        $this->display();
    }

    //登录操作处理
    public function tologin(){
        if(IS_POST){
            $post = I('post.');
            //验证码验证
            if(!$this->verify($post['code'])){
                msg('error', '验证码错误');
            }

            //验证用户是否存在
            $member = M('card')->where(array('username' => $post['username']))->find();
            if(!$member){
                msg('error', '不存在此用户');
            }

            //加密规则md5(密码 . md5(verif))
            $password = md5($post['password'] . md5($member['verif']));
            if($password !== $member['password']){
                msg('error', '帐号或者密码不正确');
            }
            //设置上次登录时间
            M('card')->where(array('id' => $member['id']))->save(array('last_time' => $member['login_time'], 'login_time' => time()));
            $member['last_time']  = $member['login_time'];
            $member['login_time'] = time();
            //设置用户登录信息
            $this->setSession($member);
            //将未登录时本地浏览内容更新到数据库
            $this->updateLocalToDb();
            $back_url = $post['back'] ? $post['back'] : U('Goods/products');
            msg('success', '登录成功', array('back' => $back_url));
        } else {
            msg('error', '非法操作');
        }
    }

    //退出登录
    public function logout(){
        //删除会员缓存信息
        $this->delMember();
        session(null);
        //退出登录默认跳转到商品列表页
        redirect(U('Goods/products'));
    }

    //将未登录时本地浏览内容更新到数据库
    private function updateLocalToDb(){
        //浏览记录 look_log = 1,2,3
        $look_log = explode(',', cookie('look_log'));
        $cart     = explode(',', cookie('cart'));
        if($look_log && is_array($look_log)){
            D('Site/Goods')->updateLookLog($look_log, $this->uid);
        }
        //购物车 cart = 1,2,3
        if(is_array($cart)){
            D('Cart/GoodsCart')->updateCart($cart, $this->uid);
        }
    }

}
