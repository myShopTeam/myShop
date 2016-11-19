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

class CollectionModel extends Model {

    //array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间])
    protected $_validate = array(
        array('title', 'require', '募捐标题不能为空！'),
        array('col_thumb', 'require', '必须上传缩略图！'),
        array('content','require','必须填写募捐说明！'),
        array('total_money', '/^\+?[1-9][0-9]*$/', '募捐金额格式有误，只能为整数！'),
        array('member_num', '/^\+?[1-9][0-9]*$/', '募捐人数格式有误，只能为整数！'),
        array('aver_money', '/^\+?[1-9][0-9]*$/', '人均捐款金额格式有误，只能为整数！'),
        array('period','require','捐款截止时间不能为空！')
    );

}
