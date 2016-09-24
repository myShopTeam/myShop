<?php

// +----------------------------------------------------------------------
// | myshop 基层文件
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Base\Controller;

use Common\Controller\Base;

class BaseController extends Base
{
    public $site_info;
    protected $uid; //会员ID
    protected $member_info; //会员信息

    public function _initialize()
    {
        parent::_initialize();
        header("Content-type:text/html;charset=utf-8");
        //用户ID
        $this->uid = session('uid');
        //加载网站资源
        $this->getSiteInfo();
        //用户登录信息
        $this->setMember();
    }

    private function getSiteInfo(){
        //域名
        $this->site_info['domain'] = get_http_host();
        //public目录
        $this->site_info['public_path']     = $this->site_info['domain'] . '/public/';
        //site资源目录
        $this->site_info['site_path']       = $this->site_info['domain'] . '/public/site/';
        //common资源目录
        $this->site_info['common_path']     = $this->site_info['domain'] . '/public/common/';
        //企业站资源目录
        $this->site_info['enterprise_path'] = $this->site_info['domain'] . '/public/enterprise/';
        //默认头像
        $this->site_info['default_avatar']  = $this->site_info['domain'] . '/public/site/images/default_user_portrait.gif';
        //所有网站信息
        $this->assign('site_info', $this->site_info);
    }

    private function setMember(){

        if(!$this->isLogin()) {

            return false;
        }
        if(S('member_info_' . $this->uid))
        {
            $this->member_info = S('member_info_' . $this->uid);

        } else {
            //设置用户信息
            $this->getMemberInfo();
            $this->member_info['is_login'] = 1;
            //如果用户未设置昵称 为了统一字段 则将用户名设置为昵称
            $this->member_info['nicknane'] = $this->member_info['nicknane'] ? $this->member_info['nicknane'] : $this->member_info['username'];
            //用户信息缓存7200秒
            S('member_info_' . $this->uid, $this->member_info, 7200);
        }

        $this->assign('member_info', $this->member_info);
    }

    /**
     * 更新用户信息 当用户发生改变后执行此方法
     */
    public function updateMember(){
        if($this->isLogin()){
            $this->getMemberInfo();
            S('member_info_' . $this->uid, $this->member_info);
        }
    }

    /**
     * 检测会员是否登录 没有登录跳转到登录页面
     */
    public function checkLogin()
    {
        if (!$this->uid) {
            redirect(U('Passport/login'));
        } else {
            //todo:其他逻辑
        }
    }

    /**
     * 获取会员信息
     */
    public function getMemberInfo()
    {
        if ($this->isLogin()) {
            $this->member_info =  D('Member/Cart')->getMemberInfo($this->uid);
        } else {
            return false;
        }
    }

    /**
     * 检测是否登录 返回 true或者false
     */
    public function isLogin()
    {
        return session('is_login') ? true : false;
    }

}
