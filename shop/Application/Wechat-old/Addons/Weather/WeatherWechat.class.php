<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 天气查询插件
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Addons\Weather;

use Wechat\Util\Wechat;

class WeatherWechat extends Wechat {

    /**
     * 插件基本信息
     * @return type
     */
    public function config() {
        return array(
            'name' => '天气查询插件',
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
        return '百度KEY：<input type="text" name="setting[key]" class="input length_6" value="' . $data['key'] . '"><span class="gray"> 可以到 http://lbsyun.baidu.com/apiconsole/key 申请。</span>';
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
        if (empty($setting['key'])) {
            return false;
        }
        preg_match("/^天气 (.*)/i", $data['Content'], $matches);
        if (empty($matches[1])) {
            return array(
                'Content' => '小Q不明白你要查询的内容',
                'MsgType' => 'text',
            );
        }
        //根据API调用输出数据
        $url = "http://api.map.baidu.com/telematics/v2/weather?location={$matches[1]}&output=json&ak=" . $setting['key'];
        $httpstr = ShuipFCMS()->Curl->get($url);
        $harr = json_decode($httpstr, true);
        $results = $harr['results'][0];
        return array(
            'Content' => '地区：' . $harr['currentCity'] . "\r\n时间：" . $results['date'] . " " . $results['weather'] . " " . $results['wind'] . "\r\n气温：" . $results['temperature'],
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
