<?php
// +----------------------------------------------------------------------
// | 素材管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.qcjh.net, All rights reserved.
// +----------------------------------------------------------------------
// | Author: WZH <wzh@qcjh.net>
// +----------------------------------------------------------------------
namespace Wechat\Controller;

use Common\Controller\AdminBase;

class MaterialController extends AdminBase {


    public function index() {
        $db = D ( 'Img' );
        $where ['parentid'] = 0;
        $count = $db->where ( $where )->count ();
        $page = $this->page($count, 25);
        $info = $db->where ( $where )->order ( 'createtime DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
        if (! empty ( $info )) {
            foreach ( $info as $k => $v ) {
                $where ['parentid'] = $v ['id'];
                $info [$k] ['child'] = $db->where ( $where )->select ();
            }
        }
        $this->assign ( 'page', $page->show () );
        $this->assign ( 'info', $info );
        $this->display ();
	}

    //同步素材
    public function sync(){
        $data = Wechat::getBatchgetMaterial();

        if($data){
            //获取的图文处理
            $items = $data['item'];

        } else {
            $this->error('error',Wechat::$error_msg);
        }
    }

    //删除素材
    public function del(){

    }
}
