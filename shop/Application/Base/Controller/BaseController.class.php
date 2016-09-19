<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 商品管理
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

    public function _initialize()
    {
        parent::_initialize();
        header("Content-type:text/html;charset=utf-8");
        //加载网站资源
        $this->getSiteInfo();
    }

    private function getSiteInfo(){
        //域名
        $this->site_info['domain'] = get_http_host();
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
}
