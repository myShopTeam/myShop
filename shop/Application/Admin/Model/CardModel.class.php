<?php

// +----------------------------------------------------------------------
// | qcjh 后台用户角色表
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.lovegq1314.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------

namespace Admin\Model;

use Common\Model\Model;

class CardModel extends Model {

    //array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间])
    protected $_validate = array(
        array('card_num', 'require', '卡号不能为空！'),
        array('verify', 'require', '验证码不能为空！'),
        array('card_name', 'require', '卡单类型必选！'),
        array('card_type', 'require', '产品类型必选！'),
        array('realname', 'require', '真实姓名必填！'),
        array('birthday','require','生日必填！','0'),
        array('mobile','require','手机必填！','0'),
        //array('mobile','/^(((13[0-9]{1})|(177)|(126)|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/','手机号格式有误！'),
        array('cred_num', '/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/', '身份证格式有误'),
        array('sex','require','性别必填！','0'),
        array('car_type','require','车辆类型 必选！','0'),
        array('num_plate','require','车牌号必填！','0'),
        array('engine_number','require','发动机号必填！','0'),
        array('car_seat_num','require','核定座位数必填！','0'),
    );

}
