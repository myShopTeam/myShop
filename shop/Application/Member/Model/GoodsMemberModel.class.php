<?php

// +----------------------------------------------------------------------
// | 会员模型
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Member\Model;

use Common\Model\Model;

class GoodsMemberModel extends Model {

    /**
     * 获取用户信息
     * @param int  $uid
     * @return type
     */
    public function getMemberInfo($uid){
        if(!$uid) {

            return false;
        }
        $member = $this->where(array('id' => $uid))->find();

        return $member;
    }

    /**
     * 验证是否存在此昵称
     * @param array $params
     * @return boolean
     */
    public function checkNickname($params){
        $check = $this->where(array('nickname' => $params['nickname'], 'id' => array('neq',$params['uid'])))->find();

        return $check ? true : false;
    }

}
