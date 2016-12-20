<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 微信平台，插件管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

use Common\Controller\Base;

class ApiController extends Base {

    //配置
    protected $config = array();
    //数据对象
    private $db;
    //微信传过来的基本信息
    public $signature, $timestamp, $nonce;
    //微信推送过来的数据或响应数据
    private $data = array();

    //初始化
    protected function _initialize() {
        parent::_initialize();
        $this->config = cache("WechatConfig");
        $this->db = D('Wechat/Wechat');
        import('Wechat.Util.Wechat');
        //微信签名
        $this->signature = I('get.signature');
        //时间戳
        $this->timestamp = I('get.timestamp');
        //随机字符串
        $this->nonce = I('get.nonce');
        //进行验证
        if ($this->db->wechatAuth($this->signature, $this->timestamp, $this->nonce) !== true) {
            send_http_status(404);
            exit;
        } else {
            if (IS_GET) {
                exit($_GET['echostr']);
            }
        }
    }

    //接口处理
    public function index() {
        //获取微信的XML
        $xml = file_get_contents("php://input");
        //把 XML 转换为对象。
        $xml = new \SimpleXMLElement($xml);
        if (!$xml) {
            exit;
        }
        foreach ($xml as $key => $value) {
            $this->data[$key] = strval($value);
        }
        //根据接收到的内容，进行自动回复内容准备
        exit($this->db->response($this->data));
    }

}
