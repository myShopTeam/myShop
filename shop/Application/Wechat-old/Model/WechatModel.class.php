<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 微信模型
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Model;

use Common\Model\Model;

class WechatModel extends Model {

    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        array('match', 'require', '匹配内容不能为空！', 1, 'regex', 3),
        array('type', 'require', '数据类型不能为空！', 1, 'regex', 3),
        array('pattern', 'require', '匹配方式不能为空！', 1, 'regex', 3),
        array('addons', 'require', '请选择执行插件！', 1, 'regex', 3),
    );
    //自动完成
    protected $_auto = array(
        //array(填充字段,填充内容,填充条件,附加规则)
        array('createtime', 'time', 1, 'function')
    );

    /**
     * 回复规则添加，进行验证是否可以添加
     * @param type $data 数据
     * @param type $isadd 是否新增
     * @return boolean
     */
    protected function verification($data, $isadd = true) {
        if (empty($data)) {
            return $data;
        }
        //如果是非文本消息
        if (in_array($data['type'], array('image', 'voice', 'video', 'location', 'link', 'event-CLICK', 'event-subscribe', 'event-unsubscribe'))) {
            //这些类型的，只允许出现一条规则
            if ($data['match'] != '*') {
                $this->error = '由于该类型暂时不支持内容匹配，且只允许“*”匹配规则！';
                return false;
            }
            if ($isadd) {
                if ($this->where(array('type' => $data['type']))->count()) {
                    $this->error = '由于该类型暂时不支持内容匹配，且只允许添加一条“*”匹配规则！';
                    return false;
                }
            } else {
                if ($this->where(array('type' => $data['type'], 'id' => array('NEQ', $data['id'])))->count()) {
                    $this->error = '由于该类型暂时不支持内容匹配，且只允许添加一条“*”匹配规则！';
                    return false;
                }
            }
        }
        return $data;
    }

    /**
     * 添加回复规则
     * @param type $data 数据
     * @return boolean
     */
    public function wechatAdd($data) {
        if (empty($data)) {
            $this->error = '数据不能为空！';
            return false;
        }
        C('TOKEN_ON', false);
        //数据验证
        $data = $this->create($data, 1);
        if ($data) {
            $data = $this->verification($data);
            if ($data == false) {
                return false;
            }
            //setting配置回调检查
            $addons = $data['addons'];
            $addonsModel = D('Wechat/Addons');
            $addonObj = $addonsModel->getObject($addons);
            if ($addonObj === false) {
                $this->error = $addonsModel->getError();
                return false;
            }
            if (method_exists($addonObj, 'callbackSetting')) {
                if ($addonObj->callbackSetting($data['setting']) !== true) {
                    if (method_exists($addonObj, 'getError')) {
                        $this->error = $addonObj->getError();
                    } else {
                        $this->error = '插件配置不正确！';
                    }
                    return false;
                }
            }
            if (isset($data['setting']) && is_array($data['setting'])) {
                $data['setting'] = serialize($data['setting']);
            }
            $id = $this->add($data);
            if ($id) {
                //更新缓存
                $this->wechatReplyCache();
                return $id;
            } else {
                $this->error = '入库失败！';
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 编辑规则
     * @param type $data 数据
     * @return boolean
     */
    public function wechatEdit($data) {
        if (empty($data) || empty($data['id'])) {
            $this->error = '数据不能为空！';
            return false;
        }
        C('TOKEN_ON', false);
        $id = $data['id'];
        //数据验证
        $data = $this->create($data, 2);
        if ($data) {
            $data = $this->verification($data, false);
            if ($data == false) {
                return false;
            } else {
                unset($data['id']);
            }
            //setting配置回调检查
            $addons = $data['addons'];
            $addonsModel = D('Wechat/Addons');
            $addonObj = $addonsModel->getObject($addons);
            if ($addonObj === false) {
                $this->error = $addonsModel->getError();
                return false;
            }
            if (method_exists($addonObj, 'callbackSetting')) {
                if ($addonObj->callbackSetting($data['setting']) !== true) {
                    if (method_exists($addonObj, 'getError')) {
                        $this->error = $addonObj->getError();
                    } else {
                        $this->error = '插件配置不正确！';
                    }
                    return false;
                }
            }
            if (isset($data['setting']) && is_array($data['setting'])) {
                $data['setting'] = serialize($data['setting']);
            }
            $status = $this->where(array('id' => $id))->save($data);
            if ($status !== false) {
                //更新缓存
                $this->wechatReplyCache();
                return true;
            } else {
                $this->error = '库操作失败！';
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 删除规则
     * @param int $id ID
     * @return boolean
     */
    public function wechatDelete(int $id) {
        if (empty($id)) {
            $this->error = "请指定需要删除的规则！";
            return false;
        }
        if ($this->where(array('id' => $id))->delete() !== false) {
            //更新缓存
            $this->wechatReplyCache();
            return true;
        }
        return false;
    }

    /**
     * 返回对应的微信插件列表
     * @return array
     */
    public function getAddonsList() {
        $addonsList = cache('WechatAddons');
        return $addonsList;
    }

    /**
     * 生成缓存
     * @return boolean
     */
    public function wechat_cache() {
        $config = M("Module")->where(array("module" => "Wechat"))->find();
        if (!$config) {
            return false;
        }
        $config = unserialize($config['setting']);
        //接口URL
        $config['api_url'] = isset($config['api_url']) ? $config['api_url'] : '';
        //接口标识
        $config['ukey'] = isset($config['ukey']) ? $config['ukey'] : '';
        //微信Token
        $config['token'] = isset($config['token']) ? $config['token'] : '';
        //AppId
        $config['appid'] = isset($config['appid']) ? $config['appid'] : '';
        //AppSecret
        $config['appsecret'] = isset($config['appsecret']) ? $config['appsecret'] : '';
        //菜单key对应
        $button = array();
        if ($config['button']) {
            foreach ($config['button'] as $k => $rs) {
                $button[$rs['key']] = $rs['url'];
                if ($rs['sub_button']) {
                    foreach ($rs['sub_button'] as $i => $v) {
                        $button[$v['key']] = $v['url'];
                    }
                }
            }
            $config['button_key'] = $button;
        }
        cache("WechatConfig", $config);
        return $config;
    }

    /**
     * 生成回复规则缓存
     * @return boolean
     */
    public function wechatReplyCache() {
        $data = $this->where(array('status' => 1))->order(array('id' => 'DESC'))->select();
        if (empty($data)) {
            return false;
        }
        $cache = array();
        foreach ($data as $rs) {
            $rs['setting'] = unserialize($rs['setting']);
            $cache[$rs['type']][] = $rs;
        }
        cache('WechatReply', $cache);
        return $cache;
    }

    /**
     * 更新配置
     * @param type $config 配置数据
     * @return boolean 成功返回true
     */
    public function wechat_config($config) {
        if (!$config || !is_array($config)) {
            return false;
        }
        $oldConfig = M("Module")->where(array("module" => "Wechat"))->find();
        $oldConfig['setting'] = unserialize($oldConfig['setting']);
        $config['button'] = $oldConfig['setting']['button'];
        $status = M("Module")->where(array("module" => "Wechat"))->save(array("setting" => serialize($config)));
        if ($status !== false) {
            $this->wechat_cache();
            return true;
        }
        return false;
    }

    /**
     * 更新菜单项
     * @param type $config 配置数据
     * @return boolean 成功返回true
     */
    public function saveMenu($button) {
        if (!$button || !is_array($button)) {
            return false;
        }
        //检查菜单完整性
        $newButton = array();
        foreach ($button as $k => $rs) {
            $sub_button = $rs['sub_button'];
            //检查一级菜单
            if ($rs['name'] && $rs['type'] && $rs['key']) {
                //如果是view，一定要填写链接
                if ($rs['key'] == 'view' && empty($rs['url'])) {
                    continue;
                }
                unset($rs['sub_button']);
                $newButton[$k] = $rs;
                //检查二级菜单
                if (!empty($sub_button)) {
                    foreach ($sub_button as $i => $v) {
                        if ($v['name'] && $v['type'] && $v['key']) {
                            //如果是view，一定要填写链接
                            if ($v['key'] == 'view' && empty($v['url'])) {
                                continue;
                            }
                            $newButton[$k]['sub_button'][$i] = $v;
                        }
                    }
                }
            }
        }

        $config = M("Module")->where(array("module" => "Wechat"))->find();
        $setting = unserialize($config['setting']);
        $setting['button'] = $newButton;
        $status = M("Module")->where(array("module" => "Wechat"))->save(array("setting" => serialize($setting)));
        if ($status !== false) {
            $this->wechat_cache();
            //推送自定义菜单
            $this->customMenu();
            return true;
        }
        return false;
    }

    /**
     * 对数据进行签名认证，确保是微信发送的数据
     * @param type $signature 微信加密签名，signature结合了开发者填写的token参数和请求中的timestamp参数、nonce参数。
     * @param type $timestamp 时间戳
     * @param type $nonce 随机数
     * @return boolean
     */
    public function wechatAuth($signature, $timestamp, $nonce) {
        $config = cache('WechatConfig');
        if (empty($signature) || empty($timestamp) || empty($nonce)) {
            return false;
        }
        //待验证数据
        $data = array($config['token'], $timestamp, $nonce);
        //对数据进行字典排序
        sort($data, SORT_STRING);
        //生成自己的签名
        $sign = sha1(implode($data));
        if ($signature == $sign) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 重新从微信获取accesstoken
     * @return type access_token
     */
    public function getAcessToken() {
        //检查缓存
        $access_token = S('WechatAccessToken');
        if ($access_token) {
            return $access_token;
        }
        $config = cache('WechatConfig');
        //请求地址
        $url = 'https://api.weixin.qq.com/cgi-bin/token';
        $params = array();
        $params ['grant_type'] = 'client_credential';
        $params ['appid'] = $config['appid'];
        $params ['secret'] = $config['appsecret'];
        $httpstr = ShuipFCMS()->Curl->get($url . '?' . http_build_query($params));
        $harr = json_decode($httpstr, true);
        //access_token有效期为7200秒
        S('WechatAccessToken', $harr['access_token'], 7000);
        return $harr['access_token'];
    }

    /**
     * 处理接收到微信的内容，然后准备回复内容
     */
    protected function autoReply($data) {
        if (empty($data)) {
            return false;
        }
        //微信平台配置
        $config = cache('WechatConfig');
        //回复规则
        $replyCache = cache('WechatReply');
        //事件类
        if($data['MsgType'] == 'event'){
            $data['MsgType'] = "{$data['MsgType']}-{$data['Event']}";
        }
        //检查对应信息类型有没有回复规则需要处理
        if (empty($replyCache[$data['MsgType']])) {
            //默认回复消息 defaultreply
            if ($config['defaultreply']) {
                $reply = array(
                    'Content' => $config['defaultreply'],
                    'MsgType' => 'text',
                );
            }
        } else {
            //执行插件名称
            $addonsName = '';
            //检查是否出现规则“*”，优先匹配
            $rule = array();
            foreach ($replyCache[$data['MsgType']] as $rs) {
                if ($rs['match'] == '*') {
                    $rule = $rs;
                    $addonsName = $rs['addons'];
                    break;
                }
            }

            if (empty($addonsName)) {
                //匹配其他类型的规则
                foreach ($replyCache[$data['MsgType']] as $rs) {
                    //匹配类型
                    if (in_array($data['MsgType'], array('text'))) {
                        switch ((int) $rs['pattern']) {
                            case 1://相等匹配
                                if ($data['Content'] == $rs['match']) {
                                    $rule = $rs;
                                    $addonsName = $rs['addons'];
                                    //退出循环
                                    break;
                                }
                                break;
                            case 2://包含
                                if (strstr($data['Content'], $rs['match'])) {
                                    $rule = $rs;
                                    $addonsName = $rs['addons'];
                                    //退出循环
                                    break;
                                }
                                break;
                            case 3://正则匹配
                                if (preg_match($rs['match'], $data['Content'], $matches)) {
                                    $rule = $rs;
                                    $addonsName = $rs['addons'];
                                    //退出循环
                                    break;
                                }
                                break;
                        }
                    } else {
                        //其他的 图片消息，语音消息，视频消息，地理位置消息，事件类消息 直接交给一个插件处理还是怎么，没想好
                        $rule = $rs;
                        $addonsName = $rs['addons'];
                        //退出循环
                        break;
                    }
                }
            }
            $wechatAddons = cache('WechatAddons');
            //执行对应插件
            if (!empty($rule) && !empty($addonsName) && $wechatAddons[$addonsName]) {
                //插件
                $this->wechat_addons_name = $addonsName;
                //获取插件对象
                $object = D('Wechat/Addons')->getObject($addonsName);
                //检查该类是否存在
                if (is_object($object)) {
                    //实例化插件
                    if (method_exists($object, 'run')) {
                        $reply = $object->run($rule, $data);
                    }
                }
            }
        }
        //如果没有对应的插件执行，使用默认回复
        if (empty($reply)) {
            //默认回复消息 defaultreply
            if ($config['defaultreply']) {
                $reply = array(
                    'Content' => $config['defaultreply'],
                    'MsgType' => 'text',
                );
            }
        }

        return $reply;
    }

    /**
     * 响应微信发送的信息（自动回复）
     * @param array $reply
     */
    public function response($data) {
        if (empty($data)) {
            return false;
        }
        //添加日志
        D('Wechat/WechatLog')->logAdd(array(
            'tousername' => $data['ToUserName'],
            'fromusername' => $data['FromUserName'],
            'msgtype' => $data['MsgType'],
            'data' => $data,), 0);
        //基础数据
        $newData = array(
            //开发者微信号
            'ToUserName' => $data['FromUserName'],
            //发送方帐号（一个OpenID）
            'FromUserName' => $data['ToUserName'],
            //消息创建时间 （整型）
            'CreateTime' => NOW_TIME,
            //消息id，64位整型
            'MsgId' => $data['MsgId'],
        );
        //处理回复
        $replyArray = $this->autoReply($data);
        //合并回复后的数据
        $newData = array_merge($newData, $replyArray);
        //转换数据为XML
        $xml = new \SimpleXMLElement('<xml></xml>');
        $this->data2xml($xml, $newData);
        $ree = $xml->asXML();
        //添加日志
        D('Wechat/WechatLog')->logAdd(array(
            'tousername' => $newData['ToUserName'],
            'fromusername' => $newData['FromUserName'],
            'msgtype' => $newData['MsgType'],
            'data' => $newData,
            'addons' => $this->wechat_addons_name,), 1);
        return $ree;
    }

    /**
     * 推送菜单到微信
     * @return type
     */
    public function customMenu() {
        $config = cache('WechatConfig');
        $data = $config['button'];
        if (empty($data)) {
            $this->error = '没有自定义菜单数据！';
            return false;
        }
        foreach ($data as $k => $rs) {
            if ($rs['type'] == 'click' && isset($rs['url'])) {
                unset($data[$k]['url']);
            }
            if (isset($rs['sub_button']) && !empty($rs['sub_button'])) {
                foreach ($rs['sub_button'] as $i => $val) {
                    if ($val['type'] == 'click' && isset($val['url'])) {
                        unset($data[$k]['sub_button'][$i]['url']);
                    }
                }
            } else {
                unset($data[$k]['sub_button']);
            }
        }
        //处理后的
        $menuData = array(
            'button' => $data,
        );
        //获取access_token
        $access_token = $this->getAcessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
        //参数发送前处理,不能包含\uxxxx格式的字符
        $postJson = str_replace("\\/", "/", json_encode($menuData));
        $search = "#\\\u([0-9a-f]+)#ie";
        if (strpos(strtoupper(PHP_OS), 'WIN') === false) {
            $replace = "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))"; //LINUX
        } else {
            $replace = "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))"; //WINDOWS
        }
        $postJson = preg_replace($search, $replace, $postJson);
        $httpstr = ShuipFCMS()->Curl->post($url, $postJson);
        $harr = json_decode($httpstr, true);
        return $harr;
    }

    /**
     * 把数据添加到XML编码
     * @param  object $xml  XML对象
     * @param  mixed  $data 数据
     * @param  string $item 数字索引时的节点名称
     * @return string
     */
    public function data2xml($xml, $data, $item = 'item') {
        foreach ($data as $key => $value) {
            /* 指定默认的数字key */
            is_numeric($key) && $key = $item;
            /* 添加子元素 */
            if (is_array($value) || is_object($value)) {
                $child = $xml->addChild($key);
                $this->data2xml($child, $value, $item);
            } else {
                if (is_numeric($value)) {
                    $child = $xml->addChild($key, $value);
                } else {
                    $child = $xml->addChild($key);
                    $node = dom_import_simplexml($child);
                    $node->appendChild($node->ownerDocument->createCDATASection($value));
                }
            }
        }
    }

}
