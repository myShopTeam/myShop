<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 各插件调用
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

class EmptyController {

    //插件标识
    public $addonName = NULL;
    //插件路径
    protected $addonPath = NULL;

    public function __construct() {
        $this->addonName = CONTROLLER_NAME;
        $this->addonPath = APP_PATH . "Wechat/Addons/{$this->addonName}/{$this->addonName}Wechat.class.php";
    }

    //魔术方法
    public function __call($method, $args) {
        $wechatAddons = cache('WechatAddons');
        //检查对应插件是否有安装
        if (empty($wechatAddons[$this->addonName])) {
            send_http_status(404);
            exit;
        }
        import('Wechat.Util.Wechat');
        //导入对应插件
        if (require_cache($this->addonPath) == false) {
            send_http_status(404);
            exit;
        }
        $action = ACTION_NAME;
        //禁止访问特殊方法
        if (in_array(strtolower($action), 'config', 'setting', 'run', 'install', 'uninstall', 'geterror', 'callbacksetting')) {
            send_http_status(404);
            exit;
        }
        $actionObj = D('Wechat/Addons')->getObject($this->addonName);
        if (!is_object($actionObj)) {
            send_http_status(404);
            exit;
        }
        if (method_exists($actionObj, $action)) {
            $actionObj->$action();
        } else {
            send_http_status(404);
            exit;
        }
    }

}
