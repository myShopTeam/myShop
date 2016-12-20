<?php

return array(
    //模块名称
    'modulename' => '微信',
    //图标
    'icon' => 'http://www.shuipfcms.com/d/file/content/2014/07/53b6485c21ae2.png',
    //模块简介
    'introduce' => '微信平台管理！',
    //模块介绍地址
    'address' => 'http://www.shuipfcms.com',
    //模块作者
    'author' => '水平凡',
    //作者地址
    'authorsite' => 'http://www.shuipfcms.com',
    //作者邮箱
    'authoremail' => 'admin@abc3210.com',
    //版本号，请不要带除数字外的其他字符
    'version' => '1.0.0',
    //适配最低ShuipFCMS版本，
    'adaptation' => '2.0.0',
    //签名
    'sign' => 'a5640439cbb9a1b06bbaa11a2026621c',
    //依赖模块
    'depend' => array(),
    //行为注册
    'tags' => array(),
    //缓存，格式：缓存key=>array('module','model','action')
    'cache' => array(
        'WechatConfig' => array(
            'name' => '微信模块配置',
            'model' => 'Wechat',
            'action' => 'wechat_cache',
        ),
        'WechatAddons' => array(
            'name' => '微信插件',
            'model' => 'Addons',
            'action' => 'addons_cache',
        ),
        'WechatReply' => array(
            'name' => '微信回复规则',
            'model' => 'Wechat',
            'action' => 'wechatReplyCache',
        ),
    ),
);
