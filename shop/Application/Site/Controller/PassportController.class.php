<?php

// +----------------------------------------------------------------------
// | 商城前台登录注册
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
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
            //设置用户登录信息
            $this->setSession($member);
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

}
