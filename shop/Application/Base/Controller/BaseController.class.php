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
        //域名
        $this->site_info['domain'] = get_http_type();
        $this->assign('site_info', $this->site_info);
        //默认头像
        $this->assign('default_avatar', '/public/site/images/default_user_portrait.gif');
    }

}
