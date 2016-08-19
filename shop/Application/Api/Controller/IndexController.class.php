<?php

// +----------------------------------------------------------------------
// | qcjh
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.lovegq1314.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------

namespace Api\Controller;

use Common\Controller\ShuipFCMS;

class IndexController extends ShuipFCMS {

    public function token() {
        $token = \Libs\Util\Encrypt::authcode($_POST['token'], 'DECODE', C('CLOUD_USERNAME'));
        if (!empty($token)) {
            S($this->Cloud->getTokenKey(), $token, 3600);
            $this->success('验证通过');
            exit;
        }
        $this->error('验证失败');
    }

}
