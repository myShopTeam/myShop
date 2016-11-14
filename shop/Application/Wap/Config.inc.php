<?php

// +----------------------------------------------------------------------
// | qcjh  3G手机版配置
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.lovegq1314.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------
return array(
    //模块名称
    'modulename' => 'WAP手机版',
    //图标
    'icon' => '',
    //模块简介
    'introduce' => 'WAP手机版！',
    //模块介绍地址
    'address' => '/',
    //模块作者
    'author' => 'CMS',
    //作者地址
    'authorsite' => '/',
    //作者邮箱
    'authoremail' => 'lin19940620@sina.com',
    //版本号，请不要带除数字外的其他字符
    'version' => '1.0.2',
    //适配最低版本，
    'adaptation' => '8.3.0',
    //签名
    'sign' => '4B7B06DA1101821D6AAE4B51BC96E6AF',
    //依赖模块
    'depend' => array('Content'),
    //行为注册
    'tags' => array(
        'app_begin' => array(
            'title' => '应用开始标签位',
            'remark' => '应用开始标签位',
            'type' => 1,
            'phpfile:WapBehavior|module:Wap',
        ),
    ),
    //缓存，格式：缓存key=>array('module','model','action')
    'cache' => array(),
);
