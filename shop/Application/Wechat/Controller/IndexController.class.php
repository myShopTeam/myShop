<?php

// +----------------------------------------------------------------------
// | myshop 微信对接
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

use Common\Controller\AdminBase;

class IndexController extends AdminBase
{
    public $model;
    public $wxuser;

    public function _initialize()
    {
        parent::_initialize();
        header("Content-type:text/html;charset=utf-8");

        $this->model  = M('wxuser');
        $this->wxuser = S('wxuser');
    }

    public function index()
    {
        if($this->wxuser){
            $this->wxuser['callback']   = U('Wechat/Wxpay');
            $this->wxuser['weixin_url'] = U('Wechat/Wechat/auth');
        }

        $this->assign('list',$this->wxuser);
        $this->display();
    }

    //微信数据添加
    public function wxinsert(){
        $data=array(
            'weixin'    => I('post.weixin'),
            'appsecret' => I('post.appsecret'),
            'appid'     => I('post.appid'),
            'wxname'    => I('post.wxname')
        );

        if($this->wxuser){ //修改
            if(!$this->wxuser['token']){
                $data['token'] = genRandomString(20);
            }
            $this->model->where(array('id' => $this->wxuser['id']))->save($data);
        } else { //添加
            $data['token'] = genRandomString(20);
            $this->model->add($data);
        }
        Wechat::initWeixn();
        $this->success('操作成功',U('index'));
    }

}
