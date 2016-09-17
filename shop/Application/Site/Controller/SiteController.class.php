<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 商品管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Site\Controller;

use Base\Controller\BaseController;

class SiteController extends BaseController
{
    protected $uid; //会员ID
    protected $user_info; //会员信息

    public function _initialize()
    {
        parent::_initialize();
        $this->uid = session('uid');
    }

    /**
     * 检测会员是否登录 没有登录跳转到登录页面
     */
    public function checkLogin()
    {
        $this->uid = session('uid');//用户ID
        if (!$this->uid) {
            redirect(U('Passport/login'));
        } else {
            //其他逻辑
        }
    }

    /**
     * 获取会员信息
     */
    public function getMemberInfo()
    {
        if ($this->isLogin()) {
            return D('Site/Cart')->getMemberInfo($this->uid);
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
