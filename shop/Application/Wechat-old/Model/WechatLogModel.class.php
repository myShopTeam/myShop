<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 微信对话记录
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Model;

use Common\Model\Model;

class WechatLogModel extends Model {

    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        array('tousername', 'require', '接收方不能为空！', 1, 'regex', 3),
        array('fromusername', 'require', '发送方不能为空！', 1, 'regex', 3),
        array('msgtype', 'require', '消息类型不能为空！', 1, 'regex', 3),
            //array('addons', 'require', '请选择执行插件！', 1, 'regex', 3),
    );
    //自动完成
    protected $_auto = array(
        //array(填充字段,填充内容,填充条件,附加规则)
        array('createtime', 'time', 1, 'function')
    );

    /**
     * 增加日志
     * @param type $data 数据
     * @param type $isserver 是否由服务器发生给微信方
     * @return boolean
     */
    public function logAdd($data, $isserver = 0) {
        if (empty($data)) {
            $this->error = '数据不能为空！';
            return false;
        }
        $data = $this->create($data, 1);
        if ($data) {
            $data['isserver'] = $isserver;
            //data数据处理
            if (!empty($data['data']) && is_array($data['data'])) {
                $data['data'] = serialize($data['data']);
            }
            $logid = $this->add($data);
            if ($logid) {
                return $logid;
            } else {
                $this->error = '入库失败！';
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 删除一个月前的数据
     * @return boolean
     */
    public function deleteMonth() {
        if ($this->where(array('createtime' => array('ELT', (time() - (30 * 86400)))))->delete() !== false) {
            return true;
        }
        return false;
    }

}
