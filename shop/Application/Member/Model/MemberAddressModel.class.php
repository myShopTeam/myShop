<?php

// +----------------------------------------------------------------------
// | 收货地址
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Member\Model;

use Common\Model\Model;

class MemberAddressModel extends Model {

    /**
     * 获取收货地址
     * @param int $uid
     * @return array
     */
    public function getAddress($uid)
    {
        $address = $this->where(array('uid' => $uid))->order('default_address DESC')->select();

        return array_bind_key($address, 'id');
    }

}
