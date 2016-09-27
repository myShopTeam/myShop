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

    /**
     * 设置会员信息
     */
    private function setMember(){

        if(!$this->isLogin()) {

            return false;
        }
        if(count(S('member_info_' . $this->uid)) > 3)
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
     * 消除会员信息
     */
    protected function delMember(){
        $this->member_info = null;
        S('member_info_' . $this->uid, null);
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

            $this->member_info =  D('Member/Card')->getMemberInfo($this->uid);

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

    /**
     * 设置用户登录状态
     * @param array  $member
     */
    protected function setSession($member){
        $this->uid = $member['id'];
        //设置session
        session('uid', $this->uid);
        session('username', $member['username']);
        session('is_login', 1);
        //设置cookie
        $_COOKIE['uid'] = $this->uid;
        $_COOKIE['username'] = $member['username'];
        //设置用户信息
        $this->setMember();
    }
}
