<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 默认文本自动回复插件
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Addons\Text;

use Wechat\Util\Wechat;

class TextWechat extends Wechat {

    /**
     * 插件基本信息
     * @return type
     */
    public function config() {
        return array(
            'name' => '文本回复插件',
            'author' => '水平凡',
            'version' => '1.0.0',
        );
    }

    /**
     * 插件扩展配置信息
     * @param type $data 设置数据信息
     * @return type
     */
    public function setting($data) {
        return '回复内容：<br/><textarea name="setting[name]" style="width:400px; height:100px;">' . $data['name'] . '</textarea><br/><span class="gray"> 需要回复的内容，只支持text文本类型回复。</span>';
    }

    /**
     * 扩展配置信息回调检查
     * @param type $data 设置数据信息
     * @return type
     */
    public function callbackSetting(&$data) {
        return true;
    }

    /**
     * 插件执行入口
     * @param type $rule 规则配置信息
     * @param type $data 微信服务器发送的数据
     * @return type
     */
    public function run($rule, $data) {
        $setting = $rule['setting'];
        if (empty($setting['name'])) {
            return false;
        }
        return array(
            'Content' => $setting['name'],
            'MsgType' => 'text',
        );
    }

    /**
     * 插件安装
     * @return boolean
     */
    public function install() {
        return true;
    }

    /**
     * 插件卸载
     * @return boolean
     */
    public function uninstall() {
        return true;
    }

    /**
     * 获取错误信息
     * @return string
     */
    public function getError() {
        return "";
    }

}
