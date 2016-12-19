<?php

// +----------------------------------------------------------------------
// | myshop 微信
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

class Wechat extends \Think\Controller
{

    public static $wxuser;
    public static $access_token;
    public static $error_msg;

    public function __construct()
    {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");

        self::$wxuser      = S('wxuser');
        self::$access_token = self::getAccessToken();
    }

    public static function initWeixn(){
        $wxuser = M('wxuser')->find();
        if($wxuser){
            S('wxuser',$wxuser);
            self::$wxuser = $wxuser;
        }
    }

    //获取微信access_token
    public static function getAccessToken(){
        if(S('wx_access_token')){
            return S('wx_access_token');
        } else {
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . C('WECHAT_APPID') . '&secret=' . C('WECHAT_APPSECRET');
            $curl = new \Curl();
            $result = json_decode($curl->get($url), true);
            if($result['access_token']){
                S('wx_access_token', $result['access_token'], $result['expires_in']);
                return $result['access_token'];
            }
        }

    }

    //获取微信图文素材
    public static function getBatchgetMaterial(){
        $curl = new \Curl();
        $data = array(
            'type'   => 'NEWS', //素材的类型，图片（image）、视频（video）、语音 （voice）、图文（news）
            'offset' => 0, //从全部素材的该偏移位置开始返回，0表示从第一个素材 返回
            'count'  => 20 //返回素材的数量，取值在1到20之间
        );
        $url = '//api.weixin.qq.com/cgi-bin/material/batchget_material?access_token' . self::getAccessToken();

        $result = json_decode($curl->post($url, $data), true);
        p($result,1);
        if(!$result['errcode']){
            return $result;
        } else {
            self::$error_msg = $result['errmsg'];
        }

    }
}
