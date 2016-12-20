<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 微信插件 图文回复
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Addons\ImageArticles;

use Wechat\Util\Wechat;

class ImageArticlesWechat extends Wechat {

    /**
     * 插件基本信息
     * @return type
     */
    public function config() {
        return array(
            'name' => '图文回复',
            'author' => '水平凡',
            'version' => '1.0.0',
        );
    }

    /**
     * 插件扩展配置信息
     * @param type $data 设置数据信息
     * @return type
     */
    public function setting($setting) {
        $html = '图文消息个数最多10条<div class="cross" style="width:100%;"><ul id="J_ul_list_addItem" class="J_ul_list_public" style="margin-left:0px;"><li><span style="width:205px;">标题</span><span style="width:205px;">地址</span><span style="width:205px;">简介</span><span>图片</span></li>';
        for ($i = 1; $i <= 10; $i++) {
            $html .= '<li><span style="width:205px;"><input type="test" name="setting[' . $i . '][title]" class="input" value="' . $setting[$i]['title'] . '" style="width:200px;" placeholder="第' . $i . '条数据标题"></span><span style="width:205px;"><input type="test" name="setting[' . $i . '][url]" class="input" value="' . $setting[$i]['url'] . '" style="width:200px;" placeholder="地址"></span><span style="width:205px;"><input type="test" name="setting[' . $i . '][description]" class="input" value="' . $setting[$i]['description'] . '" style="width:200px;" placeholder="简介"></span><span style="width:360px;">' . \Form::images('setting[' . $i . '][imgsrc]', 'image' . $i . '', $setting[$i]['imgsrc'], 'Wechat') . '</span></li>';
        }
        $html .= '</ul></div>';
        return $html;
    }

    /**
     * 扩展配置信息回调检查
     * @param type $data 设置数据信息
     * @return type
     */
    public function callbackSetting(&$data) {
        if (!is_array($data)) {
            $this->error = "数据错误！";
            return false;
        }
        //检查第一条数据是否有图片是否存在等
        if (!$data[1]['title'] || !$data[1]['url'] || !$data[1]['description'] || !$data[1]['imgsrc']) {
            $this->error = "第一条数据必须填写完整！";
            return false;
        }
        foreach ($data as $k => $rs) {
            if (!$rs['title'] || !$rs['url'] || !$rs['description'] || !$rs['imgsrc']) {
                $data[$k]['title'] = $data[$k]['url'] = $data[$k]['imgsrc'] = $data[$k]['description'] = '';
            }
        }
        //更新附件状态，把相关附件和文章进行管理
        service("Attachment")->api_update('', 'addons-image', 1);
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
        if (empty($setting) || !is_array($setting)) {
            return false;
        }
        $reply = array(
            'MsgType' => 'news',
            'ArticleCount' => 0, //最多10条
            'Articles' => array(
                'item' => array(
                    'Title' => $setting[1]['title'],
                    'Description' => $setting[1]['description'],
                    'PicUrl' => $setting[1]['imgsrc'],
                    'Url' => $setting[1]['url'],
                ),
            ),
        );
        unset($setting[1]);
        foreach ($setting as $rs) {
            if ($rs['title'] || $rs['url'] || $rs['description'] || $rs['imgsrc']) {
                array_push($reply['Articles'], array(
                    'Title' => $rs['title'],
                    'Description' => $rs['description'],
                    'PicUrl' => $rs['imgsrc'],
                    'Url' => $rs['url'],
                ));
            }
        }
        //总数
        $reply['ArticleCount'] = count($reply['Articles']);
        return $reply;
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
        //删除附件
        service("Attachment")->api_delete('addons-image');
        return true;
    }

}
