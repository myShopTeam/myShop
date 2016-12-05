<?php

// +----------------------------------------------------------------------
// | myshop 微信对接基础接口
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

class BaseApiController extends \Think\Controller
{
    private $curl;

    public function __construct()
    {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");

        $this->curl = new \Curl();
    }

    public function getAccessToken(){

    }
}
