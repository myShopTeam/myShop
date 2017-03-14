<?php

// +----------------------------------------------------------------------
// | myshop 微信对接
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

class WechatController extends \Think\Controller
{

    public function __construct()
    {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
    }

    public function auth()
    {
        make_log($_GET);
        if($this->checkSignature()){
            echo $_GET['echostr'];
            exit;
        }
    }

    private function checkSignature(){
        $wxuser = S('wxuser');
        $data = array($wxuser['token'],$_GET['timestamp'], $_GET['nonce']);
        $sign = $_GET['signature'];
        sort($data, SORT_STRING);
        make_log($data);
        $signature = sha1(implode($data));
        if($signature == $sign){
            return true;
        } else {
            return false;
        }
    }
}
