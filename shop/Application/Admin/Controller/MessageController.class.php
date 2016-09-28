<?php

// +----------------------------------------------------------------------
// | 信息类
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

use Common\Controller\AdminBase;

class MessageController extends AdminBase {

    //后台框架首页
    public function onlineMessage() {
        $this->basePage(M('message_online'), '', 'listorder desc, id desc');
    }

    //排序
    public function listorder()
    {
        $info = I('post.listorder');
        $id = 'id';
        switch (I('get.str')) {
            case "online":
                $db = M('message_online');
                $a = 'onlineMessage';
                $id = 'id';
                break;
        }
        foreach ($info as $k => $v) {
            $db->where(array($id => $k))->save(array('listorder' => $v));
        }
        $this->success('排序成功！', U($a));
    }

}
