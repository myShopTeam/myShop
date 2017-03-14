<?php

// +----------------------------------------------------------------------
// | 计划任务
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------

//if (PHP_SAPI != 'cli') die;
define('WIN_CRON', TRUE);
define('BIND_MODULE', 'Wechat');
define('BIND_CONTROLLER', 'Wxpay');
define('BIND_ACTION', 'notify');
define('APP_MODE', 'api');
require getcwd() . '/index.php';