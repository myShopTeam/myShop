<?php

// +----------------------------------------------------------------------
// | 计划任务
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Cron\Controller;

class CronController extends \Think\Controller {
    public function _initialize(){
        if(!defined('WIN_CRON')) die;
    }
    public function index(){
        /*功能实现部分*/
    }

}