<?php

// +----------------------------------------------------------------------
// | 收货地址管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Member\Controller;

use Base\Controller\BaseController;

class AddressController extends BaseController
{
    private $__whiteList = array('getArea'); //白名单 不需要验证登录

    public function _initialize()
    {
        parent::_initialize();
        //验证是否登录
        if (!in_array(ACTION_NAME, $this->__whiteList)) {
            $this->checkLogin();
        }
    }

    public function index(){

        $this->display();
    }

    /*
     * 获取地区
     */
    public function getArea(){
        if(IS_AJAX){
            $areas = $this->getFormatArea();

            msg('success', '操作成功', array('area' => $areas));
        } else {
            msg('error', '非法操作');
        }
    }

    public function addAddress(){
        if(IS_POST){
            $post = I('post.');
            if(!$post['province']) msg('error', '请选择省');
            if(!$post['city'])     msg('error', '请选择市');
            if(!$post['address'])  msg('error', '请填写详细地址');
            if(!$post['full_name'])msg('error', '请填写收货人');
            if(!$post['mobile_phone'] && !$post['phone']) msg('error', '请填写手机或者座机');
            $post['uid'] = $this->uid;
            $post['created'] = time();
            $id = M('member_address')->add($post);
            $add_data = M('member_address')->find($id);
            if($id){
                msg('success', '添加成功', $add_data);
            } else {
                msg('error', '添加失败');
            }
        }
    }
}
