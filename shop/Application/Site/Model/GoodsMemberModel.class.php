<?php

// +----------------------------------------------------------------------
// | PC端购物车模型
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Site\Model;

use Common\Model\Model;

class GoodsMemberModel extends Model {

    /**
     * 获取用户信息
     * @param string $uid
     * @return array
     */
    public function getMemberInfo($uid){
        $member = $this->where(array('id' => $uid))->find();
        return $member;
    }


}
