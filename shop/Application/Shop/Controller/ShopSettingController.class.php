<?php

// +----------------------------------------------------------------------
// | 商城配置
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Shop\Controller;

use Common\Controller\AdminBase;

class ShopSettingController extends AdminBase
{

    protected function _initialize()
    {
        parent::_initialize();
        //处理图片上传问题
        $this->disposeUpload();
    }

    //配置
    public function setting(){
        if(IS_POST){
            $params = array(
                'logoimg'  => I('post.logoimg'),
                'loginimg' => I('post.loginimg'),
            );
            if($params['logoimg']){
                F('logoimg', $params['logoimg']);
            }
            if($params['loginimg']){
                F('loginimg', $params['loginimg']);
            }
            $this->success('操作成功');
        }

        $setting = array(
            'logoimg'  => F('logoimg') ?: '',
            'loginimg' => F('loginimg') ?: '',
        );

        $this->assign($setting);
        $this->display();
    }

    public function disposeUpload()
    {
        $args = '1,jpg|jpeg|gif|png|bmp,1,,,0';
        $authkey = upload_key($args);
        $this->assign('args', $args);
        $this->assign('authkey', $authkey);
    }
}
