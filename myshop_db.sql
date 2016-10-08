/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : 127.0.0.1:3306
Source Database       : myshop_db

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-08-19 14:24:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_about
-- ----------------------------
DROP TABLE IF EXISTS `tp_about`;
CREATE TABLE `tp_about` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `style` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `posid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '点击总数',
  `yesterdayviews` int(11) NOT NULL DEFAULT '0' COMMENT '最日',
  `dayviews` int(10) NOT NULL DEFAULT '0' COMMENT '今日点击数',
  `weekviews` int(10) NOT NULL DEFAULT '0' COMMENT '本周访问数',
  `monthviews` int(10) NOT NULL DEFAULT '0' COMMENT '本月访问',
  `viewsupdatetime` int(10) NOT NULL DEFAULT '0' COMMENT '点击数更新时间',
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`weekviews`,`views`,`dayviews`,`monthviews`,`status`,`id`),
  KEY `thumb` (`thumb`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_about
-- ----------------------------

-- ----------------------------
-- Table structure for tp_about_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_about_data`;
CREATE TABLE `tp_about_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_about_data
-- ----------------------------

-- ----------------------------
-- Table structure for tp_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_access`;
CREATE TABLE `tp_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `app` varchar(20) NOT NULL COMMENT '模块',
  `controller` varchar(20) NOT NULL COMMENT '控制器',
  `action` varchar(20) NOT NULL COMMENT '方法',
  `status` tinyint(4) DEFAULT '0' COMMENT '是否有效',
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色权限表';

-- ----------------------------
-- Records of tp_access
-- ----------------------------

-- ----------------------------
-- Table structure for tp_admin_panel
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin_panel`;
CREATE TABLE `tp_admin_panel` (
  `mid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '菜单ID',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` char(32) NOT NULL COMMENT '菜单名',
  `url` char(255) NOT NULL COMMENT '菜单地址',
  UNIQUE KEY `userid` (`mid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='常用菜单';

-- ----------------------------
-- Records of tp_admin_panel
-- ----------------------------
INSERT INTO `tp_admin_panel` VALUES ('5', '2', '修改个人信息', 'Admin/Adminmanage/myinfo');
INSERT INTO `tp_admin_panel` VALUES ('6', '2', '修改密码', 'Admin/Adminmanage/chanpass');

-- ----------------------------
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(160) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `style` char(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumb` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keywords` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `url` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `posid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '点击总数',
  `yesterdayviews` int(11) NOT NULL DEFAULT '0' COMMENT '最日',
  `dayviews` int(10) NOT NULL DEFAULT '0' COMMENT '今日点击数',
  `weekviews` int(10) NOT NULL DEFAULT '0' COMMENT '本周访问数',
  `monthviews` int(10) NOT NULL DEFAULT '0' COMMENT '本月访问',
  `viewsupdatetime` int(10) NOT NULL DEFAULT '0' COMMENT '点击数更新时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`weekviews`,`views`,`dayviews`,`monthviews`,`status`,`id`),
  KEY `thumb` (`thumb`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_article
-- ----------------------------

-- ----------------------------
-- Table structure for tp_article_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_article_data`;
CREATE TABLE `tp_article_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `copyfrom` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_article_data
-- ----------------------------

-- ----------------------------
-- Table structure for tp_attachment
-- ----------------------------
DROP TABLE IF EXISTS `tp_attachment`;
CREATE TABLE `tp_attachment` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '附件ID',
  `module` char(15) NOT NULL COMMENT '模块名称',
  `catid` smallint(5) NOT NULL COMMENT '栏目ID',
  `filename` char(50) NOT NULL COMMENT '上传附件名称',
  `filepath` char(200) NOT NULL COMMENT '附件路径',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '附件大小',
  `fileext` char(10) NOT NULL COMMENT '附件扩展名',
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为图片 1为图片',
  `isthumb` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为缩略图 1为缩略图',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '上传用户ID',
  `isadmin` tinyint(1) NOT NULL COMMENT '是否后台用户上传',
  `uploadtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `uploadip` char(15) NOT NULL COMMENT '上传ip',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '附件使用状态',
  `authcode` char(32) NOT NULL COMMENT '附件路径MD5值',
  PRIMARY KEY (`aid`),
  KEY `authcode` (`authcode`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_attachment
-- ----------------------------
INSERT INTO `tp_attachment` VALUES ('1', 'content', '11', '2cd0afc379310a552cf194a7b54543a9802610f6.jpg', 'content/2016/08/57b6a3055473f.jpg', '65365', 'jpg', '1', '0', '1', '1', '1471587077', '127.0.0.1', '0', '2b316c6ca7088ef2687f9e31e42798f9');
INSERT INTO `tp_attachment` VALUES ('2', 'content', '11', '8a3c81cb39dbb6fdd8e1a5750b24ab18962b3715.jpg', 'content/2016/08/57b6a30c53d34.jpg', '41752', 'jpg', '1', '0', '1', '1', '1471587084', '127.0.0.1', '0', '9182f48f7253f244e7ae8e54af5e33ff');
INSERT INTO `tp_attachment` VALUES ('3', 'content', '11', '8a3c81cb39dbb6fdd8e1a5750b24ab18962b3715.jpg', 'content/2016/08/57b6a31d4ef58.jpg', '41752', 'jpg', '1', '0', '1', '1', '1471587101', '127.0.0.1', '0', '5659daa2d4253153929f1d7a5ba2a57c');

-- ----------------------------
-- Table structure for tp_attachment_index
-- ----------------------------
DROP TABLE IF EXISTS `tp_attachment_index`;
CREATE TABLE `tp_attachment_index` (
  `keyid` char(30) NOT NULL COMMENT '关联id',
  `aid` char(10) NOT NULL COMMENT '附件ID',
  KEY `keyid` (`keyid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件关系表';

-- ----------------------------
-- Records of tp_attachment_index
-- ----------------------------

-- ----------------------------
-- Table structure for tp_behavior
-- ----------------------------
DROP TABLE IF EXISTS `tp_behavior`;
CREATE TABLE `tp_behavior` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-控制器，2-视图',
  `status` tinyint(2) NOT NULL COMMENT '状态（0：禁用，1：正常）',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统',
  `module` char(20) NOT NULL COMMENT '所属模块',
  `datetime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='系统行为表';

-- ----------------------------
-- Records of tp_behavior
-- ----------------------------
INSERT INTO `tp_behavior` VALUES ('1', 'app_init', '应用初始化标签位', '应用初始化标签位', '1', '1', '1', '', '1381021393');
INSERT INTO `tp_behavior` VALUES ('2', 'path_info', 'PATH_INFO检测标签位', 'PATH_INFO检测标签位', '1', '1', '1', '', '1381021411');
INSERT INTO `tp_behavior` VALUES ('3', 'app_begin', '应用开始标签位', '应用开始标签位', '1', '1', '1', '', '1381021424');
INSERT INTO `tp_behavior` VALUES ('4', 'action_name', '操作方法名标签位', '操作方法名标签位', '1', '1', '1', '', '1381021437');
INSERT INTO `tp_behavior` VALUES ('5', 'action_begin', '控制器开始标签位', '控制器开始标签位', '1', '1', '1', '', '1381021450');
INSERT INTO `tp_behavior` VALUES ('6', 'view_begin', '视图输出开始标签位', '视图输出开始标签位', '1', '1', '1', '', '1381021463');
INSERT INTO `tp_behavior` VALUES ('7', 'view_parse', '视图解析标签位', '视图解析标签位', '1', '1', '1', '', '1381021476');
INSERT INTO `tp_behavior` VALUES ('8', 'template_filter', '模板内容解析标签位', '模板内容解析标签位', '1', '1', '1', '', '1381021488');
INSERT INTO `tp_behavior` VALUES ('9', 'view_filter', '视图输出过滤标签位', '视图输出过滤标签位', '1', '1', '1', '', '1381021621');
INSERT INTO `tp_behavior` VALUES ('10', 'view_end', '视图输出结束标签位', '视图输出结束标签位', '1', '1', '1', '', '1381021631');
INSERT INTO `tp_behavior` VALUES ('11', 'action_end', '控制器结束标签位', '控制器结束标签位', '1', '1', '1', '', '1381021642');
INSERT INTO `tp_behavior` VALUES ('12', 'app_end', '应用结束标签位', '应用结束标签位', '1', '1', '1', '', '1381021654');
INSERT INTO `tp_behavior` VALUES ('13', 'appframe_rbac_init', '后台权限控制', '后台权限控制', '1', '1', '1', '', '1381023560');

-- ----------------------------
-- Table structure for tp_behavior_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_behavior_log`;
CREATE TABLE `tp_behavior_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `ruleid` int(10) NOT NULL COMMENT '行为ID',
  `guid` char(50) NOT NULL COMMENT '标识',
  `create_time` int(10) NOT NULL COMMENT '执行行为的时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='行为日志';

-- ----------------------------
-- Records of tp_behavior_log
-- ----------------------------

-- ----------------------------
-- Table structure for tp_behavior_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_behavior_rule`;
CREATE TABLE `tp_behavior_rule` (
  `ruleid` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `behaviorid` int(11) NOT NULL COMMENT '行为id',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统',
  `module` char(20) NOT NULL COMMENT '规则所属模块',
  `addons` char(20) NOT NULL COMMENT '规则所属插件',
  `rule` text NOT NULL COMMENT '行为规则',
  `listorder` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `datetime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`ruleid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='行为规则表';

-- ----------------------------
-- Records of tp_behavior_rule
-- ----------------------------
INSERT INTO `tp_behavior_rule` VALUES ('1', '1', '1', '', '', 'phpfile:BuildLiteBehavior', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('2', '3', '1', '', '', 'phpfile:ReadHtmlCacheBehavior', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('3', '12', '1', '', '', 'phpfile:ShowPageTraceBehavior', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('4', '7', '1', '', '', 'phpfile:ParseTemplateBehavior', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('5', '8', '1', '', '', 'phpfile:ContentReplaceBehavior', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('6', '9', '1', '', '', 'phpfile:WriteHtmlCacheBehavior', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('7', '1', '1', '', '', 'phpfile:AppInitBehavior|module:Common', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('8', '3', '1', '', '', 'phpfile:AppBeginBehavior|module:Common', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('9', '6', '1', '', '', 'phpfile:ViewBeginBehavior|module:Common', '0', '1381021954');
INSERT INTO `tp_behavior_rule` VALUES ('10', '3', '0', 'Wap', '', 'phpfile:WapBehavior|module:Wap', '0', '1431316756');

-- ----------------------------
-- Table structure for tp_cache
-- ----------------------------
DROP TABLE IF EXISTS `tp_cache`;
CREATE TABLE `tp_cache` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `key` char(100) NOT NULL COMMENT '缓存key值',
  `name` char(100) NOT NULL COMMENT '名称',
  `module` char(20) NOT NULL COMMENT '模块名称',
  `model` char(30) NOT NULL COMMENT '模型名称',
  `action` char(30) NOT NULL COMMENT '方法名',
  `param` char(255) NOT NULL COMMENT '参数',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统',
  PRIMARY KEY (`id`),
  KEY `ckey` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='缓存更新列队';

-- ----------------------------
-- Records of tp_cache
-- ----------------------------
INSERT INTO `tp_cache` VALUES ('1', 'Config', '网站配置', '', 'Config', 'config_cache', '', '1');
INSERT INTO `tp_cache` VALUES ('2', 'Module', '可用模块列表', '', 'Module', 'module_cache', '', '1');
INSERT INTO `tp_cache` VALUES ('3', 'Behavior', '行为列表', '', 'Behavior', 'behavior_cache', '', '1');
INSERT INTO `tp_cache` VALUES ('4', 'Menu', '后台菜单', 'Admin', 'Menu', 'menu_cache', '', '0');
INSERT INTO `tp_cache` VALUES ('5', 'Category', '栏目索引', 'Content', 'Category', 'category_cache', '', '0');
INSERT INTO `tp_cache` VALUES ('6', 'Model', '模型列表', 'Content', 'Model', 'model_cache', '', '0');
INSERT INTO `tp_cache` VALUES ('7', 'Urlrules', 'URL规则', 'Content', 'Urlrule', 'urlrule_cache', '', '0');
INSERT INTO `tp_cache` VALUES ('8', 'ModelField', '模型字段', 'Content', 'ModelField', 'model_field_cache', '', '0');
INSERT INTO `tp_cache` VALUES ('9', 'Position', '推荐位', 'Content', 'Position', 'position_cache', '', '0');

-- ----------------------------
-- Table structure for tp_category
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `catid` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `module` varchar(15) NOT NULL COMMENT '所属模块',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类别',
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `domain` varchar(200) DEFAULT NULL COMMENT '栏目绑定域名',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `arrparentid` varchar(255) NOT NULL COMMENT '所有父ID',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否存在子栏目，1存在',
  `arrchildid` mediumtext NOT NULL COMMENT '所有子栏目ID',
  `catname` varchar(30) NOT NULL COMMENT '栏目名称',
  `image` varchar(100) NOT NULL COMMENT '栏目图片',
  `description` mediumtext NOT NULL COMMENT '栏目描述',
  `parentdir` varchar(100) NOT NULL COMMENT '父目录',
  `catdir` varchar(30) NOT NULL COMMENT '栏目目录',
  `url` varchar(100) NOT NULL COMMENT '链接地址',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '栏目点击数',
  `setting` mediumtext NOT NULL COMMENT '相关配置信息',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `sethtml` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否生成静态',
  `letter` varchar(30) NOT NULL COMMENT '栏目拼音',
  `menuurl` varchar(100) NOT NULL COMMENT '跳转链接',
  PRIMARY KEY (`catid`),
  KEY `module` (`module`,`parentid`,`listorder`,`catid`),
  KEY `siteid` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_category
-- ----------------------------

-- ----------------------------
-- Table structure for tp_category_field
-- ----------------------------
DROP TABLE IF EXISTS `tp_category_field`;
CREATE TABLE `tp_category_field` (
  `fid` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `catid` smallint(5) DEFAULT NULL COMMENT '栏目ID',
  `fieldname` varchar(30) NOT NULL COMMENT '字段名',
  `type` varchar(10) NOT NULL COMMENT '类型,input',
  `setting` mediumtext NOT NULL COMMENT '其他',
  `createtime` int(10) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目扩展字段列表';

-- ----------------------------
-- Records of tp_category_field
-- ----------------------------

-- ----------------------------
-- Table structure for tp_category_priv
-- ----------------------------
DROP TABLE IF EXISTS `tp_category_priv`;
CREATE TABLE `tp_category_priv` (
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `roleid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '角色或者组ID',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为管理员 1、管理员',
  `action` char(30) NOT NULL COMMENT '动作',
  KEY `catid` (`catid`,`roleid`,`is_admin`,`action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目权限表';

-- ----------------------------
-- Records of tp_category_priv
-- ----------------------------

-- ----------------------------
-- Table structure for tp_config
-- ----------------------------
DROP TABLE IF EXISTS `tp_config`;
CREATE TABLE `tp_config` (
  `id` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `varname` varchar(20) NOT NULL DEFAULT '',
  `info` varchar(100) NOT NULL DEFAULT '',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='网站配置表';

-- ----------------------------
-- Records of tp_config
-- ----------------------------
INSERT INTO `tp_config` VALUES ('1', 'sitename', '网站名称', '1', 'cmsdemo');
INSERT INTO `tp_config` VALUES ('2', 'siteurl', '网站网址', '1', '/');
INSERT INTO `tp_config` VALUES ('3', 'sitefileurl', '附件地址', '1', '/d/file/');
INSERT INTO `tp_config` VALUES ('4', 'siteemail', '站点邮箱', '1', '535201470@qq.com');
INSERT INTO `tp_config` VALUES ('6', 'siteinfo', '网站介绍', '1', 'cmsdemo');
INSERT INTO `tp_config` VALUES ('7', 'sitekeywords', '网站关键字', '1', 'cmsdemo');
INSERT INTO `tp_config` VALUES ('8', 'uploadmaxsize', '允许上传附件大小', '1', '20240');
INSERT INTO `tp_config` VALUES ('9', 'uploadallowext', '允许上传附件类型', '1', 'jpg|jpeg|gif|bmp|png|doc|docx|xls|xlsx|ppt|pptx|pdf|txt|rar|zip|swf');
INSERT INTO `tp_config` VALUES ('10', 'qtuploadmaxsize', '前台允许上传附件大小', '1', '200');
INSERT INTO `tp_config` VALUES ('11', 'qtuploadallowext', '前台允许上传附件类型', '1', 'jpg|jpeg|gif');
INSERT INTO `tp_config` VALUES ('12', 'watermarkenable', '是否开启图片水印', '1', '1');
INSERT INTO `tp_config` VALUES ('13', 'watermarkminwidth', '水印-宽', '1', '300');
INSERT INTO `tp_config` VALUES ('14', 'watermarkminheight', '水印-高', '1', '100');
INSERT INTO `tp_config` VALUES ('15', 'watermarkimg', '水印图片', '1', '/statics/images/mark_bai.png');
INSERT INTO `tp_config` VALUES ('16', 'watermarkpct', '水印透明度', '1', '80');
INSERT INTO `tp_config` VALUES ('17', 'watermarkquality', 'JPEG 水印质量', '1', '85');
INSERT INTO `tp_config` VALUES ('18', 'watermarkpos', '水印位置', '1', '7');
INSERT INTO `tp_config` VALUES ('19', 'theme', '主题风格', '1', 'Default');
INSERT INTO `tp_config` VALUES ('20', 'ftpstatus', 'FTP上传', '1', '0');
INSERT INTO `tp_config` VALUES ('21', 'ftpuser', 'FTP用户名', '1', '');
INSERT INTO `tp_config` VALUES ('22', 'ftppassword', 'FTP密码', '1', '');
INSERT INTO `tp_config` VALUES ('23', 'ftphost', 'FTP服务器地址', '1', '');
INSERT INTO `tp_config` VALUES ('24', 'ftpport', 'FTP服务器端口', '1', '21');
INSERT INTO `tp_config` VALUES ('25', 'ftppasv', 'FTP是否开启被动模式', '1', '1');
INSERT INTO `tp_config` VALUES ('26', 'ftpssl', 'FTP是否使用SSL连接', '1', '0');
INSERT INTO `tp_config` VALUES ('27', 'ftptimeout', 'FTP超时时间', '1', '10');
INSERT INTO `tp_config` VALUES ('28', 'ftpuppat', 'FTP上传目录', '1', '/');
INSERT INTO `tp_config` VALUES ('29', 'mail_type', '邮件发送模式', '1', '1');
INSERT INTO `tp_config` VALUES ('30', 'mail_server', '邮件服务器', '1', 'smtp.qq.com');
INSERT INTO `tp_config` VALUES ('31', 'mail_port', '邮件发送端口', '1', '25');
INSERT INTO `tp_config` VALUES ('32', 'mail_from', '发件人地址', '1', '535201470@qq.com');
INSERT INTO `tp_config` VALUES ('33', 'mail_auth', '密码验证', '1', '1');
INSERT INTO `tp_config` VALUES ('34', 'mail_user', '邮箱用户名', '1', 'admin');
INSERT INTO `tp_config` VALUES ('35', 'mail_password', '邮箱密码', '1', '');
INSERT INTO `tp_config` VALUES ('36', 'mail_fname', '发件人名称', '1', '管理员');
INSERT INTO `tp_config` VALUES ('37', 'domainaccess', '指定域名访问', '1', '0');
INSERT INTO `tp_config` VALUES ('38', 'generate', '是否生成首页', '1', '0');
INSERT INTO `tp_config` VALUES ('39', 'index_urlruleid', '首页URL规则', '1', '12');
INSERT INTO `tp_config` VALUES ('40', 'indextp', '首页模板', '1', 'index.php');
INSERT INTO `tp_config` VALUES ('41', 'tagurl', 'TagURL规则', '1', '8');
INSERT INTO `tp_config` VALUES ('42', 'checkcode_type', '验证码类型', '1', '0');
INSERT INTO `tp_config` VALUES ('43', 'attachment_driver', '附件驱动', '1', 'Local');

-- ----------------------------
-- Table structure for tp_config_field
-- ----------------------------
DROP TABLE IF EXISTS `tp_config_field`;
CREATE TABLE `tp_config_field` (
  `fid` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '自增长id',
  `fieldname` varchar(30) NOT NULL COMMENT '字段名',
  `type` varchar(10) NOT NULL COMMENT '类型,input',
  `setting` mediumtext NOT NULL COMMENT '其他',
  `createtime` int(10) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站配置，扩展字段列表';

-- ----------------------------
-- Records of tp_config_field
-- ----------------------------

-- ----------------------------
-- Table structure for tp_customlist
-- ----------------------------
DROP TABLE IF EXISTS `tp_customlist`;
CREATE TABLE `tp_customlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自定义列表ID',
  `url` char(100) NOT NULL COMMENT '访问地址',
  `name` varchar(60) NOT NULL COMMENT '列表标题',
  `title` varchar(120) NOT NULL COMMENT '网页标题',
  `keywords` varchar(40) NOT NULL COMMENT '网页关键字',
  `description` text NOT NULL COMMENT '页面简介',
  `totalsql` text NOT NULL COMMENT '数据统计SQL',
  `listsql` text NOT NULL COMMENT '数据查询SQL',
  `lencord` int(11) NOT NULL DEFAULT '0' COMMENT '每页显示',
  `urlruleid` int(11) NOT NULL COMMENT 'URL规则ID',
  `urlrule` varchar(120) NOT NULL COMMENT 'URL规则',
  `template` mediumtext NOT NULL COMMENT '模板',
  `listpath` varchar(60) NOT NULL COMMENT '列表模板文件',
  `createtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='自定义列表';

-- ----------------------------
-- Records of tp_customlist
-- ----------------------------

-- ----------------------------
-- Table structure for tp_customtemp
-- ----------------------------
DROP TABLE IF EXISTS `tp_customtemp`;
CREATE TABLE `tp_customtemp` (
  `tempid` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '模板ID',
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '模板名称',
  `tempname` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '模板完整文件名',
  `temppath` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '模板生成路径',
  `temptext` mediumtext CHARACTER SET utf8 NOT NULL COMMENT '模板内容',
  PRIMARY KEY (`tempid`),
  KEY `tempname` (`tempname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='自定义模板表';

-- ----------------------------
-- Records of tp_customtemp
-- ----------------------------

-- ----------------------------
-- Table structure for tp_download
-- ----------------------------
DROP TABLE IF EXISTS `tp_download`;
CREATE TABLE `tp_download` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `style` char(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumb` char(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keywords` char(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` char(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `posid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '点击总数',
  `yesterdayviews` int(11) NOT NULL DEFAULT '0' COMMENT '最日',
  `dayviews` int(10) NOT NULL DEFAULT '0' COMMENT '今日点击数',
  `weekviews` int(10) NOT NULL DEFAULT '0' COMMENT '本周访问数',
  `monthviews` int(10) NOT NULL DEFAULT '0' COMMENT '本月访问',
  `viewsupdatetime` int(10) NOT NULL DEFAULT '0' COMMENT '点击数更新时间',
  `prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`weekviews`,`views`,`dayviews`,`monthviews`,`status`,`id`),
  KEY `thumb` (`thumb`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_download
-- ----------------------------

-- ----------------------------
-- Table structure for tp_download_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_download_data`;
CREATE TABLE `tp_download_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `template` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `download` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_download_data
-- ----------------------------

-- ----------------------------
-- Table structure for tp_goods
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods`;
CREATE TABLE `tp_goods` (
  `goods_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `goods_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '商品货号',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `cat_id` int(11) DEFAULT '0' COMMENT '商品类型',
  `other_cat` int(11) DEFAULT '0' COMMENT '扩展分类',
  `goods_img` text COMMENT '商品图片',
  `goods_thumb` varchar(255) DEFAULT NULL COMMENT '商品缩略图',
  `market_price` decimal(10,2) DEFAULT '0.00' COMMENT '市场价格',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际价格',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:非热销 1:热销',
  `is_new` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:非新品 1:新品',
  `is_best` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:非精品 1:精品',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '最后一次更新商品时间',
  `goods_num` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `sale_num` int(11) NOT NULL DEFAULT '0' COMMENT '已销售数量',
  `vipId` int(1) NOT NULL DEFAULT '0' COMMENT '0:官方商品 其他数字代表其他用户上架的商品',
  `alumni_id` int(11) NOT NULL DEFAULT '0' COMMENT '校友分类',
  `brand_id` int(11) DEFAULT '0' COMMENT '校友品牌',
  `classify` varchar(50) DEFAULT '' COMMENT '导航上分类',
  `transtype` varchar(10) NOT NULL DEFAULT '免运费' COMMENT '运费类型',
  `freight` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `content` text COMMENT '商品详细参数',
  `listorder` int(11) NOT NULL DEFAULT '0' COMMENT '商品排序',
  PRIMARY KEY (`goods_id`),
  KEY `goods_sn` (`goods_sn`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of tp_goods
-- ----------------------------
INSERT INTO `tp_goods` VALUES ('15', '521911201943099291', '吊坠', '12', '15', '/d/file/content/2015/11/564f074b04d39.jpg', '/d/file/content/2015/11/564f074b04d39.jpg', '29.00', '9.90', '1', '1', '1', '1', '1448019789', '1448075566', '100', '453', '0', '9', '20', '校友产品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('16', '205111201947382665', '杯子', '12', '15', '/d/file/content/2015/11/564f08521672a.jpg', '/d/file/content/2015/11/564f08521672a.jpg', '20.00', '9.90', '1', '1', '1', '1', '1448020058', '1448075372', '234', '142', '0', '9', '11', '武大纪念品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('17', '818311201948564211', '青花保温杯', '14', '15', '/d/file/content/2015/11/564f08a18ea44.jpg', '/d/file/content/2015/11/564f08a18ea44.jpg', '99.00', '39.00', '1', '1', '1', '1', '1448020136', '1448075351', '453', '235', '0', '9', '11', '武大纪念品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('18', '931211201951014580', '女性休闲短袖', '7', '15', '/d/file/content/2015/11/564f0924261ec.jpg', '/d/file/content/2015/11/564f0924261ec.jpg', '89.00', '69.00', '1', '1', '1', '1', '1448020261', '1448075389', '4242', '542', '0', '0', '0', '校友产品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('19', '365811201952343938', '挂饰', '13', '15', '/d/file/content/2015/11/564f097f06bc3.jpg', '/d/file/content/2015/11/564f097f06bc3.jpg', '39.00', '19.00', '1', '1', '1', '1', '1448020354', '1448075397', '342', '0', '0', '0', '0', '武大纪念品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('20', '302811201957174618', '红帽子', '14', '15', '/d/file/content/2015/11/564f0a8cb84d5.jpg', '/d/file/content/2015/11/564f0a8cb84d5.jpg', '99.00', '39.00', '1', '1', '1', '1', '1448020637', '1448075406', '313', '342', '0', '9', '0', '校友特卖', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('21', '297811201958401471', '文具用品签字笔', '12', '15', '/d/file/content/2015/11/564f0aeac430f.jpg', '/d/file/content/2015/11/564f0aeac430f.jpg', '29.00', '15.00', '1', '1', '1', '1', '1448020720', '1448075415', '247', '21', '0', '9', '0', '武大纪念品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('22', '945711202002427108', '泰康人寿 保险 标价与实际价格无关', '14', '0', '/d/file/content/2015/11/564f0bcfc1ed9.jpg', '/d/file/content/2015/11/564f0bcfc1ed9.jpg', '1.30', '1.00', '1', '1', '1', '1', '1448020962', '1448021067', '232', '424', '0', '1', '7', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('23', '522011202004202320', '泰康人寿 保险 标价与实际价格无关', '14', '14', '/d/file/content/2015/11/564f0c36dfed7.jpg', '/d/file/content/2015/11/564f0c36dfed7.jpg', '1.30', '1.00', '1', '0', '0', '0', '1448021060', '0', '4234', '324', '0', '1', '7', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('24', '499411202005423526', '泰康人寿 保险 标价与实际价格无关', '14', '0', '/d/file/content/2015/11/564f0c8c2df23.jpg', '/d/file/content/2015/11/564f0c8c2df23.jpg', '1.30', '1.00', '1', '0', '0', '0', '1448021142', '1448076922', '31', '313', '0', '1', '7', '校友产品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('25', '376311202006339919', '泰康人寿 保险 标价与实际价格无关', '14', '0', '/d/file/content/2015/11/564f0cbe36dd0.jpg', '/d/file/content/2015/11/564f0cbe36dd0.jpg', '1.30', '1.00', '1', '1', '0', '0', '1448021193', '0', '31', '32', '0', '1', '0', '校友产品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('26', '669211202007141007', '泰康人寿 保险 标价与实际价格无关', '14', '0', '/d/file/content/2015/11/564f0cea10386.jpg', '/d/file/content/2015/11/564f0cea10386.jpg', '1.30', '1.00', '1', '0', '1', '0', '1448021234', '0', '342', '423', '0', '1', '0', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('27', '239511202014282128', '中建三局多种户型', '14', '0', '/d/file/content/2015/11/564f126d8115f.jpg', '/d/file/content/2015/11/564f126d8115f.jpg', '10000.00', '6000.00', '1', '1', '1', '1', '1448021668', '1448022640', '313', '0', '0', '2', '8', '校友产品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('28', '686111202031486853', '中建三局多种户型', '14', '0', '/d/file/content/2015/11/564f12aad2dc0.jpg', '/d/file/content/2015/11/564f12aad2dc0.jpg', '10000.00', '6000.00', '1', '0', '1', '1', '1448022708', '0', '23', '34', '0', '2', '0', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('29', '492211202032476319', '中建三局多种户型', '14', '0', '/d/file/content/2015/11/564f12e485030.jpg', '/d/file/content/2015/11/564f12e485030.jpg', '10000.00', '6000.00', '1', '1', '0', '0', '1448022767', '0', '31', '34', '0', '2', '0', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('30', '259911202033584262', '泰康人寿 保险 标价与实际价格无关', '13', '0', '/d/file/content/2015/11/564f132ea68dd.jpg', '/d/file/content/2015/11/564f132ea68dd.jpg', '1.30', '1.00', '1', '0', '1', '0', '1448022838', '0', '31', '4324', '0', '2', '0', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('31', '230511202034372433', '泰康人寿 保险 标价与实际价格无关', '14', '0', '/d/file/content/2015/11/564f1355ef2be.jpg', '/d/file/content/2015/11/564f1355ef2be.jpg', '1.30', '1.00', '1', '0', '1', '0', '1448022877', '0', '31', '432', '0', '2', '0', '校友产品', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('32', '139711202037559601', '多种课程', '14', '0', '/d/file/content/2015/11/564f141c2ca9f.jpg', '/d/file/content/2015/11/564f141c2ca9f.jpg', '998.00', '250.00', '1', '0', '0', '0', '1448023075', '0', '231', '34', '0', '4', '0', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('33', '745811202039101454', '多种课程', '12', '0', '/d/file/content/2015/11/564f1459e867b.jpg', '/d/file/content/2015/11/564f1459e867b.jpg', '500.00', '250.00', '1', '0', '0', '0', '1448023150', '0', '231', '31', '0', '4', '13', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('34', '521111202042419347', '多种课程', '13', '0', '/d/file/content/2015/11/564f1537c1995.jpg', '/d/file/content/2015/11/564f1537c1995.jpg', '300.00', '250.00', '1', '0', '0', '0', '1448023361', '0', '324', '31', '0', '4', '13', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('35', '553911202045117466', '凤凰网是一个集图文资讯、视频点播、专题报道、虚拟社区等一体的Internet站点', '14', '0', '/d/file/content/2015/11/564f15bec10bb.jpg', '/d/file/content/2015/11/564f15bec10bb.jpg', '999.00', '299.00', '0', '0', '0', '0', '1448023511', '1448023564', '313', '3213', '0', '5', '15', '', '免运费', '0.00', '', '0');
INSERT INTO `tp_goods` VALUES ('36', '158811202045491077', '深圳华强集团有限公司是一家以高科技产业为主导的大型投资控股公司', '12', '0', '/d/file/content/2015/11/564f15f91349f.jpg', '/d/file/content/2015/11/564f15f91349f.jpg', '3111.00', '424.00', '0', '0', '0', '0', '1448023549', '1448023557', '3131', '14', '0', '5', '16', '', '免运费', '0.00', '', '0');
INSERT INTO `tp_goods` VALUES ('37', '760811202048596269', '公司主营产品真空采血管现有约3000多种品规，公司是全球真空采血系统......', '12', '0', '/d/file/content/2015/11/564f16b6e72a2.jpg', '/d/file/content/2015/11/564f16b6e72a2.jpg', '3142.00', '432.00', '0', '0', '0', '0', '1448023739', '1448023838', '231', '324', '0', '7', '18', '', '免运费', '0.00', '', '0');
INSERT INTO `tp_goods` VALUES ('38', '109211202051498714', '蓝月亮洗衣液 正品深层洁', '12', '0', '/d/file/content/2015/11/564f175abc602.jpg', '/d/file/content/2015/11/564f175abc602.jpg', '30.00', '19.00', '1', '0', '1', '0', '1448023909', '0', '231', '324', '0', '7', '19', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('39', '634111202052396230', '全因爱新生儿皮脂柔护爽身粉', '14', '0', '/d/file/content/2015/11/564f178f50d3f.jpg', '/d/file/content/2015/11/564f178f50d3f.jpg', '30.00', '19.00', '1', '0', '0', '1', '1448023959', '0', '323', '423', '0', '7', '20', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('40', '770911202053325022', '索芙特黑亮柔顺洗发水750G', '13', '0', '/d/file/content/2015/11/564f17c47e318.jpg', '/d/file/content/2015/11/564f17c47e318.jpg', '30.00', '19.00', '1', '0', '0', '0', '1448024012', '0', '314', '43', '0', '7', '21', '', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');
INSERT INTO `tp_goods` VALUES ('41', '737811202056092275', '大号可爱学生笔记本日记本', '13', '15', '/d/file/content/2015/11/564f1860b6ac7.png', '/d/file/content/2015/11/564f1860b6ac7.png', '30.00', '10.00', '1', '1', '1', '1', '1448024169', '1448075328', '313', '42', '0', '9', '0', '校友特卖', '免运费', '0.00', '<div class=\"det01\"><div class=\"fl\"><em>商品编号</em>10511</div><div class=\"fr mr50\"><em>是否原装</em>是</div></div><div class=\"det02\"><p>品牌名称：MICROLAND/米可·兰迪</p><ul><li>产品参数：</li><li>产品名称：MICROLAND/米可·兰迪</li><li>型号：TYM128-0483TY</li><li>幅面：A5</li><li>装订方式: 胶钉式装订</li></ul><ul><li>包装数量: 单本装</li><li>记事本分类: 通用笔记本</li><li>封面材质: 其他/other</li></ul><ul><li>品牌: MICROLAND/米可·兰迪</li><li>颜色分类: 海棠红 柳绿 妃色 绀蓝</li><li>封面硬度: 硬面抄</li><li>风格: 复古</li></ul><div class=\"clear clearfix\"></div></div><div class=\"det03\"><img src=\"images/proD01.jpg\" alt=\"\"/><img src=\"images/proD02.jpg\" alt=\"\"/><img src=\"images/proD03.jpg\" alt=\"\"/><img src=\"images/proD04.jpg\" alt=\"\"/></div>', '0');

-- ----------------------------
-- Table structure for tp_goods_address
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_address`;
CREATE TABLE `tp_goods_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `country` varchar(30) NOT NULL DEFAULT '中国大陆' COMMENT '国家',
  `province` varchar(30) DEFAULT NULL COMMENT '省',
  `city` varchar(30) DEFAULT NULL COMMENT '市',
  `area` varchar(30) DEFAULT NULL COMMENT '区',
  `street` varchar(30) DEFAULT NULL COMMENT '街道',
  `address` varchar(100) DEFAULT '' COMMENT '详细地址',
  `postal` int(11) DEFAULT '0' COMMENT '邮政编码',
  `full_name` varchar(20) DEFAULT NULL COMMENT '收货人',
  `phone` varchar(11) DEFAULT NULL COMMENT '手机号',
  `tel` varchar(11) DEFAULT '' COMMENT '手机',
  `default_address` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认地址',
  `addtime` int(11) DEFAULT NULL COMMENT '收藏时间',
  `listorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='收货地址表';

-- ----------------------------
-- Records of tp_goods_address
-- ----------------------------
INSERT INTO `tp_goods_address` VALUES ('1', '3', '中国大陆', '湖北省', '武汉市', '新洲区', null, '武武大科技园武大科技园武大科技园武大科技园武大科技园武大科技园武大科技园大科技园', '430000', '林培', null, '15623433629', '0', '1447382143', '0');
INSERT INTO `tp_goods_address` VALUES ('2', '3', '中国大陆', '湖北省', '武汉市', '洪山区', null, '慧园楼', '22222222', '林培2', null, '15623433629', '0', '1447382421', '0');
INSERT INTO `tp_goods_address` VALUES ('3', '3', '中国大陆', '内蒙古', '呼和浩特市', '回民区', null, '哈哈', '3333331', '林培', null, '15623433629', '1', '1447382448', '0');
INSERT INTO `tp_goods_address` VALUES ('4', '3', '中国大陆', '湖北省', '武汉市', '洪山区', null, '慧园楼', '11111', '林培', null, '15623433629', '0', '1447384005', '0');
INSERT INTO `tp_goods_address` VALUES ('5', '3', '中国大陆', '湖北省', '武汉市', '洪山区', null, '慧园楼', '11111111', '林培1', null, '15623433629', '0', '1447384391', '0');
INSERT INTO `tp_goods_address` VALUES ('6', '12', '中国大陆', '湖北省', '武汉市', '江夏区', null, '江夏区华师园北路茅店汤逊湖社区', '430000', '傲飞', null, '18672928128', '1', '1447905393', '0');
INSERT INTO `tp_goods_address` VALUES ('7', '13', '中国大陆', '陕西省', '西安市', '莲湖区', null, '1111', '0', 'lp', null, '15623433629', '1', '1447925110', '0');

-- ----------------------------
-- Table structure for tp_goods_alumni
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_alumni`;
CREATE TABLE `tp_goods_alumni` (
  `alumni_id` int(11) NOT NULL AUTO_INCREMENT,
  `alumni_name` varchar(30) NOT NULL COMMENT '分类名',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `addtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `listorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`alumni_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='校友分类表';

-- ----------------------------
-- Records of tp_goods_alumni
-- ----------------------------
INSERT INTO `tp_goods_alumni` VALUES ('1', '金融业校友', '1', '1446452649', '0');
INSERT INTO `tp_goods_alumni` VALUES ('2', '建筑业校友', '1', '1446452753', '0');
INSERT INTO `tp_goods_alumni` VALUES ('3', '互联网业校友', '1', '1446452781', '0');
INSERT INTO `tp_goods_alumni` VALUES ('4', '教育行业校友', '1', '1446453669', '0');
INSERT INTO `tp_goods_alumni` VALUES ('5', '文化传媒业校友', '1', '1446453688', '0');
INSERT INTO `tp_goods_alumni` VALUES ('6', '能源环保业校友', '1', '1446453705', '0');
INSERT INTO `tp_goods_alumni` VALUES ('7', '生物医疗业校友', '1', '1446453716', '0');
INSERT INTO `tp_goods_alumni` VALUES ('8', '农业牧副业校友', '1', '1446453731', '0');
INSERT INTO `tp_goods_alumni` VALUES ('9', '武大纪念品', '1', '1446453746', '0');

-- ----------------------------
-- Table structure for tp_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_attr`;
CREATE TABLE `tp_goods_attr` (
  `attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品分类ID',
  `attr_name` varchar(20) NOT NULL COMMENT '商品属性名',
  `attr_value` varchar(20) NOT NULL COMMENT '商品属性值',
  `listorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='商品属性SKU表';

-- ----------------------------
-- Records of tp_goods_attr
-- ----------------------------
INSERT INTO `tp_goods_attr` VALUES ('1', '7', '颜色', '黄色', '0');
INSERT INTO `tp_goods_attr` VALUES ('2', '8', '尺寸', 'X', '0');
INSERT INTO `tp_goods_attr` VALUES ('3', '8', '尺寸', 'M', '0');
INSERT INTO `tp_goods_attr` VALUES ('4', '8', '尺寸', 'L', '0');
INSERT INTO `tp_goods_attr` VALUES ('5', '8', '尺寸', 'XL', '0');
INSERT INTO `tp_goods_attr` VALUES ('8', '10', '颜色', '金色', '0');
INSERT INTO `tp_goods_attr` VALUES ('9', '10', '颜色', '白色', '0');
INSERT INTO `tp_goods_attr` VALUES ('10', '10', '颜色', '黑色', '0');
INSERT INTO `tp_goods_attr` VALUES ('11', '7', '尺寸', 'M', '0');
INSERT INTO `tp_goods_attr` VALUES ('12', '7', '尺寸', 'X', '0');
INSERT INTO `tp_goods_attr` VALUES ('13', '7', '尺寸', 'L', '0');
INSERT INTO `tp_goods_attr` VALUES ('14', '7', '尺寸', 'XL', '0');
INSERT INTO `tp_goods_attr` VALUES ('16', '13', '12', '23', '0');

-- ----------------------------
-- Table structure for tp_goods_cart
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_cart`;
CREATE TABLE `tp_goods_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加购物车时间',
  `goods_sn` varchar(60) NOT NULL DEFAULT '0' COMMENT '商品货号',
  `goods_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品实际价格',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性价格',
  `goods_number` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `goods_img` varchar(255) DEFAULT '' COMMENT '商品图片',
  `sku_id` int(11) DEFAULT NULL COMMENT '商品属性ID',
  `attr_key` varchar(20) DEFAULT '' COMMENT '属性名',
  `attr_value` varchar(20) DEFAULT '' COMMENT '属性值',
  `attrJson` varchar(255) DEFAULT '' COMMENT '商品属性',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='购物车';

-- ----------------------------
-- Records of tp_goods_cart
-- ----------------------------
INSERT INTO `tp_goods_cart` VALUES ('35', '3', '12', '1447905334', '12551024190307473', '马大褂', '998.00', '129.00', '0.00', '3', '/d/file/content/2015/10/562b6568d978e.jpg', null, '', '', '');
INSERT INTO `tp_goods_cart` VALUES ('2', '10', '68', '1447244412', '19581102145839734', '11', '11.00', '112.00', '112.00', '4', '/d/file/content/2015/11/5637099a26fb2.jpg', '39', '尺寸', 'L', '');
INSERT INTO `tp_goods_cart` VALUES ('3', '10', '68', '1447244633', '19581102145839734', '11', '11.00', '112.00', '112.00', '1', '/d/file/content/2015/11/5637099a26fb2.jpg', '41', '尺寸', 'M', '');
INSERT INTO `tp_goods_cart` VALUES ('4', '13', '68', '1447244855', '938611111100526415', 'test', '998.00', '2000.00', '0.00', '18', '/d/file/content/2015/11/5642af5f8d770.jpg', null, '', '', '');
INSERT INTO `tp_goods_cart` VALUES ('5', '2', '68', '1447244894', '2147483647', 'iphone6s', '999999.99', '49999.00', '0.00', '5', '/d/file/content/2015/10/562b653eca4b7.jpg', null, '', '', '');
INSERT INTO `tp_goods_cart` VALUES ('49', '17', '14', '1448351848', '818311201948564211', '青花保温杯', '99.00', '39.00', '0.00', '1', '/d/file/content/2015/11/564f08a18ea44.jpg', null, '', '', '');
INSERT INTO `tp_goods_cart` VALUES ('36', '2', '12', '1447905422', '2147483647', 'iphone6s', '999999.99', '49999.00', '0.00', '1', '/d/file/content/2015/10/562b653eca4b7.jpg', null, '', '', '');
INSERT INTO `tp_goods_cart` VALUES ('24', '10', '659', '1447835138', '19581102145839734', '11', '11.00', '112.00', '112.00', '1', '/d/file/content/2015/11/5637099a26fb2.jpg', '40', '尺寸', 'XL', '');
INSERT INTO `tp_goods_cart` VALUES ('44', '3', '3', '1447986506', '12551024190307473', '马大褂', '998.00', '129.00', '0.00', '2', '/d/file/content/2015/10/562b6568d978e.jpg', null, '', '', '');
INSERT INTO `tp_goods_cart` VALUES ('37', '10', '12', '1447905643', '19581102145839734', '11', '11.00', '112.00', '112.00', '1', '/d/file/content/2015/11/5637099a26fb2.jpg', '40', '尺寸', 'XL', '');
INSERT INTO `tp_goods_cart` VALUES ('34', '2', '3', '1447843343', '2147483647', 'iphone6s', '999999.99', '49999.00', '0.00', '2', '/d/file/content/2015/10/562b653eca4b7.jpg', null, '', '', '');
INSERT INTO `tp_goods_cart` VALUES ('46', '23', '3', '1448261069', '522011202004202320', '泰康人寿 保险 标价与实际价格无关', '1.30', '1.00', '0.00', '7', '/d/file/content/2015/11/564f0c36dfed7.jpg', null, '', '', '');
INSERT INTO `tp_goods_cart` VALUES ('48', '41', '3', '1448261288', '737811202056092275', '大号可爱学生笔记本日记本', '30.00', '10.00', '0.00', '1', '/d/file/content/2015/11/564f1860b6ac7.png', null, '', '', '');

-- ----------------------------
-- Table structure for tp_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_category`;
CREATE TABLE `tp_goods_category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) DEFAULT NULL COMMENT '分类名称',
  `cat_img` varchar(255) DEFAULT NULL COMMENT '分类图片',
  `listorder` int(11) NOT NULL DEFAULT '0' COMMENT '分类排序',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级分类',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:不显示 1:显示',
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='商品类型表';

-- ----------------------------
-- Records of tp_goods_category
-- ----------------------------
INSERT INTO `tp_goods_category` VALUES ('7', '衣服', '/d/file/content/2015/10/5628a9f96cfda.jpg', '0', '0', '1');
INSERT INTO `tp_goods_category` VALUES ('8', '裤子', '/d/file/content/2015/10/5628aa3b8a146.jpg', '3', '0', '1');
INSERT INTO `tp_goods_category` VALUES ('10', '电子产品', '/d/file/content/2015/10/562b651e268e3.jpg', '2', '0', '1');
INSERT INTO `tp_goods_category` VALUES ('12', '今日专享', '', '0', '0', '1');
INSERT INTO `tp_goods_category` VALUES ('13', '捐赠特卖', '', '0', '0', '1');
INSERT INTO `tp_goods_category` VALUES ('14', '校友特卖', '', '0', '0', '1');
INSERT INTO `tp_goods_category` VALUES ('15', '首页商品', '', '0', '0', '1');

-- ----------------------------
-- Table structure for tp_goods_collect
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_collect`;
CREATE TABLE `tp_goods_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='商品收藏表';

-- ----------------------------
-- Records of tp_goods_collect
-- ----------------------------
INSERT INTO `tp_goods_collect` VALUES ('7', '10', '3', '1447229973');
INSERT INTO `tp_goods_collect` VALUES ('8', '11', '3', '1447644966');
INSERT INTO `tp_goods_collect` VALUES ('9', '14', '13', '1447925082');
INSERT INTO `tp_goods_collect` VALUES ('10', '33', '3', '1448087154');
INSERT INTO `tp_goods_collect` VALUES ('12', '16', '3', '1448278691');

-- ----------------------------
-- Table structure for tp_goods_comment
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_comment`;
CREATE TABLE `tp_goods_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `vip_id` int(11) NOT NULL COMMENT '会员ID',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户ID',
  `comment` text COMMENT '评论',
  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `is_anony` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不匿名 1:匿名',
  `score` tinyint(1) NOT NULL DEFAULT '5' COMMENT '评分',
  `listorder` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='食品评分、评论表';

-- ----------------------------
-- Records of tp_goods_comment
-- ----------------------------
INSERT INTO `tp_goods_comment` VALUES ('1', '10', '3', '15623433629', null, '192.168.0.138', '1447752415', '1', '4', '0');
INSERT INTO `tp_goods_comment` VALUES ('2', '10', '3', '15623433629', null, '192.168.0.138', '1447752486', '1', '4', '0');
INSERT INTO `tp_goods_comment` VALUES ('3', '10', '3', '15623433629', '', '192.168.0.138', '1447752514', '1', '5', '0');
INSERT INTO `tp_goods_comment` VALUES ('4', '10', '3', '15623433629', '好评哦！', '192.168.0.138', '1447752639', '1', '3', '0');

-- ----------------------------
-- Table structure for tp_goods_member
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_member`;
CREATE TABLE `tp_goods_member` (
  `vip_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户帐号',
  `nickname` varchar(50) DEFAULT NULL COMMENT '用户昵称',
  `realname` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `password` varchar(50) NOT NULL COMMENT '登录密码',
  `verif` varchar(10) NOT NULL DEFAULT '0000' COMMENT '加密密码插入随机验证码',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱地址',
  `sex` varchar(10) NOT NULL DEFAULT '保密' COMMENT '0:保密 1:男 2:女',
  `birthday` varchar(20) DEFAULT NULL COMMENT '出生日期',
  `vip_level` int(11) DEFAULT '0' COMMENT 'vip等级',
  `qq` varchar(12) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL COMMENT '家庭电话',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机',
  `headpic` varchar(255) DEFAULT NULL COMMENT '头像',
  `createtime` int(11) DEFAULT NULL COMMENT '创建会员时间',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:买家 1:卖家',
  `live` varchar(50) DEFAULT '' COMMENT '居住地',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:禁止登录 1:正常登录',
  `listorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`vip_id`),
  KEY `username` (`username`) USING BTREE,
  KEY `nickname` (`nickname`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='商城会员表';

-- ----------------------------
-- Records of tp_goods_member
-- ----------------------------
INSERT INTO `tp_goods_member` VALUES ('3', '15623433629', '冷月灬微笑', '林培', 'aafe1689b8f0e8f152204329ecbc42e5', 'xMjC', '535201470@qq.com', '男', '1994-6-20', '0', '535201470', '', '15623433629', '/images/uplode/token_3/1447385509.jpg', '1446517554', '0', '湖北省-武汉市-新洲区', '1', '0');
INSERT INTO `tp_goods_member` VALUES ('13', 'test', '', 'test', 'b94cfaaa0679dedfee44e54dcb42703a', 'ZgsA', '5352@qq.com', '保密', '', '0', '', '', '', '', '1448330805', '0', '', '1', '0');
INSERT INTO `tp_goods_member` VALUES ('12', 'aofei', null, 'aofei', '4f9f2d351c7889b8508bddf32ec39d52', 'E2jg', 'aofei@qcjh.net', '保密', null, '0', null, null, null, '/images/uplode/token_12/1447905273.jpg', null, '0', '', '1', '0');
INSERT INTO `tp_goods_member` VALUES ('14', 'dsxy', '', '', '434878b422d9347d43562d137df212ca', 'uUua', '', '保密', '', '0', '', '', '', '', '1448330696', '0', '', '1', '0');

-- ----------------------------
-- Table structure for tp_goods_order
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_order`;
CREATE TABLE `tp_goods_order` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '商品货号',
  `goods_number` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `market_price` decimal(10,2) DEFAULT NULL COMMENT '市场价',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品实际价格',
  `goods_attr` text NOT NULL COMMENT '商品属性',
  `sku_id` int(11) DEFAULT NULL COMMENT '属性ID',
  `attr_key` varchar(30) DEFAULT '' COMMENT '属性名',
  `attr_value` varchar(30) DEFAULT '' COMMENT '属性值',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '该属性下的商品价格',
  `goods_thumb` varchar(255) DEFAULT NULL,
  `comment_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0,未评价1,已评价',
  PRIMARY KEY (`rec_id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of tp_goods_order
-- ----------------------------
INSERT INTO `tp_goods_order` VALUES ('1', '3', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('2', '3', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('3', '3', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('4', '4', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('5', '4', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('6', '4', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('7', '5', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('8', '5', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('9', '5', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('10', '6', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('11', '6', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('12', '6', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('13', '7', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('14', '7', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('15', '7', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('16', '8', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('17', '8', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('18', '8', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('19', '9', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('20', '9', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('21', '9', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('22', '10', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('23', '10', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('24', '10', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('25', '11', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('26', '11', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('27', '11', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('28', '12', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('29', '12', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('30', '12', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('31', '13', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('32', '13', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('33', '13', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('34', '14', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('35', '14', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('36', '14', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('37', '15', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('38', '15', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('39', '15', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('40', '16', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('41', '16', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('42', '16', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('43', '17', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('44', '17', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('45', '17', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('46', '18', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('47', '18', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('48', '18', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('49', '19', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('50', '19', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('51', '19', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('64', '28', '10', '11', '19581102145839734', '4', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('63', '27', '11', '222', '178211041156406181', '1', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('55', '21', '10', '11', '19581102145839734', '6', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('56', '21', '10', '11', '19581102145839734', '4', null, '112.00', '', '39', '尺寸', 'L', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('57', '21', '11', '222', '178211041156406181', '4', null, '222.00', '', '38', '尺寸', 'M', '1.00', '/d/file/content/2015/11/56370a0a2184c.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('58', '22', '11', '222', '178211041156406181', '1', null, '222.00', '', '38', '尺寸', 'M', '0.01', '/d/file/content/2015/11/56370a0a2184c.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('59', '23', '11', '222', '178211041156406181', '1', null, '222.00', '', '38', '尺寸', 'M', '0.01', '/d/file/content/2015/11/56370a0a2184c.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('60', '24', '11', '222', '178211041156406181', '1', null, '222.00', '', '38', '尺寸', 'M', '0.01', '/d/file/content/2015/11/56370a0a2184c.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('61', '25', '11', '222', '178211041156406181', '1', null, '222.00', '', '38', '尺寸', 'M', '0.01', '/d/file/content/2015/11/56370a0a2184c.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('62', '26', '11', '222', '178211041156406181', '1', null, '222.00', '', '38', '尺寸', 'M', '0.01', '/d/file/content/2015/11/56370a0a2184c.jpg', '1');
INSERT INTO `tp_goods_order` VALUES ('65', '38', '10', '11', '19581102145839734', '1', null, '112.00', '', '40', '尺寸', 'XL', '112.00', '/d/file/content/2015/11/5637099a26fb2.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('66', '39', '13', 'test', '938611111100526415', '1', null, '2000.00', '', null, '', '', '0.00', '/d/file/content/2015/11/5642af5f8d770.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('67', '40', '13', 'test', '938611111100526415', '1', null, '2000.00', '', null, '', '', '0.00', '/d/file/content/2015/11/5642af5f8d770.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('68', '42', '14', '1111111', '526411191706046096', '2', null, '1111.00', '', '50', '颜色', '白色', '222.00', '/d/file/content/2015/11/564d90f408819.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('69', '43', '3', '马大褂', '12551024190307473', '1', null, '129.00', '', null, '', '', '0.00', '/d/file/content/2015/10/562b6568d978e.jpg', '0');
INSERT INTO `tp_goods_order` VALUES ('70', '44', '41', '大号可爱学生笔记本日记本', '737811202056092275', '1', null, '10.00', '', null, '', '', '0.00', '/d/file/content/2015/11/564f1860b6ac7.png', '0');
INSERT INTO `tp_goods_order` VALUES ('71', '45', '26', '泰康人寿 保险 标价与实际价格无关', '669211202007141007', '1', null, '1.00', '', null, '', '', '0.00', '/d/file/content/2015/11/564f0cea10386.jpg', '0');

-- ----------------------------
-- Table structure for tp_goods_orderinfo
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_orderinfo`;
CREATE TABLE `tp_goods_orderinfo` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `uid` int(11) NOT NULL COMMENT '买家ID',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '购买者名字',
  `sell_id` int(11) NOT NULL DEFAULT '0' COMMENT '卖家ID  0:官方出售 ',
  `order_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态（0未付款、1已完成、2待发货、3待收货、4退货/款、5已取消、6已关闭、7失效 ）',
  `shipping_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0，未发货；1，已经发货；',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0，未付款；1，已付款'',；',
  `refund_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未退款、1有退款、2退款由系统处理,退款完成',
  `consignee` varchar(20) DEFAULT '' COMMENT '收货人',
  `province` varchar(20) DEFAULT '' COMMENT '收货地址-省',
  `city` varchar(20) DEFAULT '' COMMENT '收货地址-市',
  `area` varchar(20) DEFAULT '' COMMENT '收货地址-区',
  `address` varchar(100) DEFAULT '' COMMENT '详细地址',
  `tel` varchar(11) DEFAULT '' COMMENT '收货人手机号',
  `postal` varchar(10) DEFAULT '' COMMENT '邮编',
  `addtime` int(11) DEFAULT NULL COMMENT '创建订单时间',
  `pay_time` int(11) DEFAULT NULL COMMENT '付款时间',
  `total_number` int(11) NOT NULL COMMENT '商品总数量',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总金额',
  `money_paid` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '已付款金额',
  `refund_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `send_goods_time` int(11) NOT NULL COMMENT '发货时间',
  `shipping_fee` decimal(10,2) DEFAULT '0.00' COMMENT '配送费用',
  `anonym` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:匿名 1:不匿名',
  `listorder` int(11) DEFAULT '0' COMMENT '订单排序',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='订单详情表';

-- ----------------------------
-- Records of tp_goods_orderinfo
-- ----------------------------
INSERT INTO `tp_goods_orderinfo` VALUES ('1', '2015111617013937641', '3', '冷月灬微笑', '0', '3', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447664499', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('2', '2015111617023037501', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447664550', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('3', '2015111617033438714', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447664614', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('4', '2015111619444939556', '3', '冷月灬微笑', '0', '3', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447674289', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('5', '2015111619454836205', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447674348', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('6', '2015111619512335674', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447674683', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('7', '2015111619531631672', '3', '冷月灬微笑', '0', '2', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447674796', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('8', '2015111619541934160', '3', '冷月灬微笑', '0', '2', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447674859', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('9', '2015111619550637587', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447674906', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('10', '2015111619572434667', '3', '冷月灬微笑', '0', '2', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675044', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('11', '2015111619581635456', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675096', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('12', '2015111619583437143', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675114', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('13', '2015111619585134421', '3', '冷月灬微笑', '0', '3', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675131', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('14', '2015111619592138184', '3', '冷月灬微笑', '0', '3', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675161', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('15', '2015111620001233538', '3', '冷月灬微笑', '0', '3', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675212', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('16', '2015111620011533261', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675275', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('17', '2015111620013137750', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675291', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('18', '2015111620020539683', '3', '冷月灬微笑', '0', '1', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675325', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('19', '2015111620025437727', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675374', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('21', '2015111620050938967', '3', '冷月灬微笑', '0', '5', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447675509', null, '0', '5769.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('22', '2015111620404434154', '3', '冷月灬微笑', '0', '5', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447677644', null, '0', '0.01', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('23', '2015111621001039479', '3', '冷月灬微笑', '0', '5', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447678810', null, '0', '0.01', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('24', '2015111621010238786', '3', '冷月灬微笑', '0', '5', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447678862', null, '0', '0.01', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('25', '2015111621114938008', '3', '冷月灬微笑', '0', '5', '0', '1', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447679509', '1447681210', '0', '0.01', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('26', '2015111622520237253', '3', '冷月灬微笑', '0', '5', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', null, null, '1447685522', null, '0', '0.01', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('27', '2015111816313938872', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', null, '1447835499', null, '0', '102128.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('28', '2015111816492733453', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', null, '1447836567', null, '0', '448.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('29', '2015111816574733458', '3', '冷月灬微笑', '0', '3', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447837067', null, '0', '129.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('30', '2015111816582333518', '3', '冷月灬微笑', '0', '2', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447837103', null, '0', '129.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('31', '2015111816584433124', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447837124', null, '0', '49999.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('32', '2015111816593839341', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '', '1447837178', null, '0', '49999.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('33', '2015111817002034048', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447837220', null, '0', '49999.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('34', '2015111817012134097', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447837281', null, '0', '49999.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('35', '2015111817023038295', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447837350', null, '0', '49999.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('36', '2015111817024539565', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447837365', null, '0', '49999.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('37', '2015111818422533459', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447843345', null, '0', '49999.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('38', '2015111818435233163', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447843432', null, '0', '112.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('39', '2015111914073033629', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447913250', null, '0', '2000.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('40', '2015111914082431745', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447913304', null, '0', '2000.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('41', '20151119172731131044', '13', 'test', '0', '0', '0', '0', '0', 'lp', '陕西省', '西安市', '莲湖区', '1111', '15623433629', '0', '1447925251', null, '0', '444.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('42', '20151119172759139200', '13', 'test', '0', '0', '0', '0', '0', 'lp', '陕西省', '西安市', '莲湖区', '1111', '15623433629', '0', '1447925279', null, '0', '444.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('43', '2015112009555231110', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1447984552', null, '0', '129.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('44', '2015112310380535745', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1448246285', null, '0', '10.00', '0.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('45', '2015112314455033773', '3', '冷月灬微笑', '0', '3', '0', '1', '0', '林培', '湖北省', '武汉市', '新洲区', '武武大科技园武大科技园武大科技园武大科技园武大科技园武大科技园武大科技园大科技园', '15623433629', '430000', '1448261150', '1448261186', '0', '1.00', '1.00', '0.00', '0', '0.00', '0', '0');
INSERT INTO `tp_goods_orderinfo` VALUES ('46', '2015112314484035969', '3', '冷月灬微笑', '0', '0', '0', '0', '0', '林培', '内蒙古', '呼和浩特市', '回民区', '哈哈', '15623433629', '3333331', '1448261320', null, '0', '6888.00', '0.00', '0.00', '0', '0.00', '0', '0');

-- ----------------------------
-- Table structure for tp_goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_sku`;
CREATE TABLE `tp_goods_sku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `key` varchar(20) NOT NULL COMMENT '属性名',
  `value` varchar(20) NOT NULL COMMENT '属性值',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性价格',
  `pro_total` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `imgs` varchar(255) DEFAULT NULL COMMENT '属性图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COMMENT='属性商品表';

-- ----------------------------
-- Records of tp_goods_sku
-- ----------------------------

-- ----------------------------
-- Table structure for tp_link
-- ----------------------------
DROP TABLE IF EXISTS `tp_link`;
CREATE TABLE `tp_link` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `style` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `posid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '点击总数',
  `yesterdayviews` int(11) NOT NULL DEFAULT '0' COMMENT '最日',
  `dayviews` int(10) NOT NULL DEFAULT '0' COMMENT '今日点击数',
  `weekviews` int(10) NOT NULL DEFAULT '0' COMMENT '本周访问数',
  `monthviews` int(10) NOT NULL DEFAULT '0' COMMENT '本月访问',
  `viewsupdatetime` int(10) NOT NULL DEFAULT '0' COMMENT '点击数更新时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`weekviews`,`views`,`dayviews`,`monthviews`,`status`,`id`),
  KEY `thumb` (`thumb`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_link
-- ----------------------------

-- ----------------------------
-- Table structure for tp_link_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_link_data`;
CREATE TABLE `tp_link_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_link_data
-- ----------------------------

-- ----------------------------
-- Table structure for tp_locking
-- ----------------------------
DROP TABLE IF EXISTS `tp_locking`;
CREATE TABLE `tp_locking` (
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `catid` smallint(5) NOT NULL COMMENT '栏目ID',
  `id` mediumint(8) NOT NULL COMMENT '信息ID',
  `locktime` int(10) NOT NULL COMMENT '锁定时间',
  KEY `userid` (`userid`),
  KEY `onlinetime` (`locktime`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 COMMENT='信息锁定';

-- ----------------------------
-- Records of tp_locking
-- ----------------------------

-- ----------------------------
-- Table structure for tp_loginlog
-- ----------------------------
DROP TABLE IF EXISTS `tp_loginlog`;
CREATE TABLE `tp_loginlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `username` char(30) NOT NULL COMMENT '登录帐号',
  `logintime` int(10) NOT NULL COMMENT '登录时间戳',
  `loginip` char(20) NOT NULL COMMENT '登录IP',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,1为登录成功，0为登录失败',
  `password` varchar(30) NOT NULL DEFAULT '' COMMENT '尝试错误密码',
  `info` varchar(255) NOT NULL COMMENT '其他说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='后台登陆日志表';

-- ----------------------------
-- Records of tp_loginlog
-- ----------------------------
INSERT INTO `tp_loginlog` VALUES ('1', 'admin', '1471583673', '127.0.0.1', '0', 'admin123', '用户名登录');
INSERT INTO `tp_loginlog` VALUES ('2', 'admin', '1471583682', '127.0.0.1', '0', 'admin123', '用户名登录');
INSERT INTO `tp_loginlog` VALUES ('3', 'admin', '1471583733', '127.0.0.1', '0', 'admin123', '用户名登录');
INSERT INTO `tp_loginlog` VALUES ('4', 'lp', '1471583779', '127.0.0.1', '1', '密码保密', '用户名登录');
INSERT INTO `tp_loginlog` VALUES ('5', 'admin', '1471583803', '127.0.0.1', '0', 'admin123', '用户名登录');
INSERT INTO `tp_loginlog` VALUES ('6', 'admin', '1471583817', '127.0.0.1', '0', 'lp546734', '用户名登录');
INSERT INTO `tp_loginlog` VALUES ('7', 'admin', '1471583853', '127.0.0.1', '1', '密码保密', '用户名登录');
INSERT INTO `tp_loginlog` VALUES ('8', 'admin', '1471584003', '127.0.0.1', '1', '密码保密', '用户名登录');
INSERT INTO `tp_loginlog` VALUES ('9', 'admin', '1471584547', '127.0.0.1', '1', '密码保密', '用户名登录');

-- ----------------------------
-- Table structure for tp_menu
-- ----------------------------
DROP TABLE IF EXISTS `tp_menu`;
CREATE TABLE `tp_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '上级菜单',
  `app` char(20) NOT NULL COMMENT '应用标识',
  `controller` char(20) NOT NULL COMMENT '控制键',
  `action` char(20) NOT NULL COMMENT '方法',
  `parameter` char(255) NOT NULL COMMENT '附加参数',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
-- Records of tp_menu
-- ----------------------------
INSERT INTO `tp_menu` VALUES ('1', '缓存更新', '0', 'Admin', 'Index', 'cache', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('2', '我的面板', '0', 'Admin', 'Config', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('3', '设置', '0', 'Admin', 'Config', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('4', '个人信息', '2', 'Admin', 'Adminmanage', 'myinfo', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('5', '修改个人信息', '4', 'Admin', 'Adminmanage', 'myinfo', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('6', '修改密码', '4', 'Admin', 'Adminmanage', 'chanpass', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('7', '系统设置', '3', 'Admin', 'Config', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('8', '站点配置', '7', 'Admin', 'Config', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('9', '邮箱配置', '8', 'Admin', 'Config', 'mail', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('10', '附件配置', '8', 'Admin', 'Config', 'attach', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('11', '高级配置', '8', 'Admin', 'Config', 'addition', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('12', '扩展配置', '8', 'Admin', 'Config', 'extend', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('13', '行为管理', '7', 'Admin', 'Behavior', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('14', '行为日志', '13', 'Admin', 'Behavior', 'logs', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('15', '编辑行为', '13', 'Admin', 'Behavior', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('16', '删除行为', '13', 'Admin', 'Behavior', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('17', '后台菜单管理', '7', 'Admin', 'Menu', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('18', '添加菜单', '17', 'Admin', 'Menu', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('19', '修改', '17', 'Admin', 'Menu', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('20', '删除', '17', 'Admin', 'Menu', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('21', '管理员设置', '3', 'Admin', 'Management', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('22', '管理员管理', '21', 'Admin', 'Management', 'manager', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('23', '添加管理员', '22', 'Admin', 'Management', 'adminadd', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('24', '编辑管理信息', '22', 'Admin', 'Management', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('25', '删除管理员', '22', 'Admin', 'Management', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('26', '角色管理', '21', 'Admin', 'Rbac', 'rolemanage', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('27', '添加角色', '26', 'Admin', 'Rbac', 'roleadd', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('28', '删除角色', '26', 'Admin', 'Rbac', 'roledelete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('29', '角色编辑', '26', 'Admin', 'Rbac', 'roleedit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('30', '角色授权', '26', 'Admin', 'Rbac', 'authorize', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('31', '日志管理', '3', 'Admin', 'Logs', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('32', '后台登陆日志', '31', 'Admin', 'Logs', 'loginlog', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('33', '后台操作日志', '31', 'Admin', 'Logs', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('34', '删除一个月前的登陆日志', '32', 'Admin', 'Logs', 'deleteloginlog', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('35', '删除一个月前的操作日志', '33', 'Admin', 'Logs', 'deletelog', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('36', '添加行为', '13', 'Admin', 'Behavior', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('37', '模块', '0', 'Admin', 'Module', 'index', '', '0', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('38', '在线云平台', '37', 'Admin', 'Cloud', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('39', '模块商店', '38', 'Admin', 'Moduleshop', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('40', '插件商店', '38', 'Admin', 'Addonshop', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('41', '在线升级', '38', 'Admin', 'Upgrade', 'index', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('42', '本地模块管理', '37', 'Admin', 'Module', 'local', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('43', '模块管理', '42', 'Admin', 'Module', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('44', '内容', '0', 'Content', 'Index', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('45', '内容管理', '44', 'Content', 'Content', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('46', '内容相关设置', '44', 'Content', 'Category', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('47', '栏目列表', '46', 'Content', 'Category', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('48', '添加栏目', '47', 'Content', 'Category', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('49', '添加单页', '47', 'Content', 'Category', 'singlepage', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('50', '添加外部链接栏目', '47', 'Content', 'Category', 'wadd', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('51', '编辑栏目', '47', 'Content', 'Category', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('52', '删除栏目', '47', 'Content', 'Category', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('53', '栏目属性转换', '47', 'Content', 'Category', 'categoryshux', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('54', '模型管理', '46', 'Content', 'Models', 'index', '', '1', '1', '', '2');
INSERT INTO `tp_menu` VALUES ('55', '创建新模型', '54', 'Content', 'Models', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('56', '删除模型', '54', 'Content', 'Models', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('57', '编辑模型', '54', 'Content', 'Models', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('58', '模型禁用', '54', 'Content', 'Models', 'disabled', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('59', '模型导入', '54', 'Content', 'Models', 'import', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('60', '字段管理', '54', 'Content', 'Field', 'index', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('61', '字段修改', '60', 'Content', 'Field', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('62', '字段删除', '60', 'Content', 'Field', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('63', '字段状态', '60', 'Content', 'Field', 'disabled', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('64', '模型预览', '60', 'Content', 'Field', 'priview', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('65', '管理内容', '45', 'Content', 'Content', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('66', '附件管理', '45', 'Attachment', 'Atadmin', 'index', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('67', '删除', '66', 'Attachment', 'Atadmin', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('68', '发布管理', '44', 'Content', 'Createhtml', 'index', '', '0', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('69', '批量更新栏目页', '68', 'Content', 'Createhtml', 'category', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('70', '生成首页', '68', 'Content', 'Createhtml', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('71', '批量更新URL', '68', 'Content', 'Createhtml', 'update_urls', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('72', '批量更新内容页', '68', 'Content', 'Createhtml', 'update_show', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('73', '刷新自定义页面', '68', 'Template', 'Custompage', 'createhtml', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('74', 'URL规则管理', '46', 'Content', 'Urlrule', 'index', '', '1', '0', '', '3');
INSERT INTO `tp_menu` VALUES ('75', '添加规则', '74', 'Content', 'Urlrule', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('76', '编辑', '74', 'Content', 'Urlrule', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('77', '删除', '74', 'Content', 'Urlrule', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('78', '推荐位管理', '46', 'Content', 'Position', 'index', '', '0', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('79', '信息管理', '78', 'Content', 'Position', 'item', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('80', '添加推荐位', '78', 'Content', 'Position', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('81', '修改推荐位', '78', 'Content', 'Position', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('82', '删除推荐位', '78', 'Content', 'Position', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('83', '信息编辑', '79', 'Content', 'Position', 'item_manage', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('84', '信息排序', '79', 'Content', 'Position', 'item_listorder', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('85', '数据重建', '78', 'Content', 'Position', 'rebuilding', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('86', 'Tags管理', '45', 'Content', 'Tags', 'index', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('87', '修改', '86', 'Content', 'Tags', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('88', '删除', '86', 'Content', 'Tags', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('89', 'Tags数据重建', '86', 'Content', 'Tags', 'create', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('90', '界面', '0', 'Template', 'Style', 'index', '', '0', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('91', '模板管理', '90', 'Template', 'Style', 'index', '', '0', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('92', '模板风格', '91', 'Template', 'Style', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('93', '添加模板页', '92', 'Template', 'Style', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('94', '删除模板', '92', 'Template', 'Style', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('95', '修改模板', '92', 'Template', 'Style', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('96', '主题管理', '91', 'Template', 'Theme', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('97', '主题更换', '96', 'Template', 'Theme', 'chose', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('98', '自定义页面', '90', 'Template', 'Custompage', 'index', '', '0', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('99', '自定义页面', '98', 'Template', 'Custompage', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('100', '添加自定义页面', '99', 'Template', 'Custompage', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('101', '删除自定义页面', '99', 'Template', 'Custompage', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('102', '编辑自定义页面', '99', 'Template', 'Custompage', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('103', '自定义列表', '98', 'Template', 'Customlist', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('104', '添加列表', '103', 'Template', 'Customlist', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('105', '删除列表', '103', 'Template', 'Customlist', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('106', '编辑列表', '103', 'Template', 'Customlist', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('107', '生成列表', '103', 'Template', 'Customlist', 'generate', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('108', '安装模块', '39', 'Admin', 'Moduleshop', 'install', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('109', '升级模块', '39', 'Admin', 'Moduleshop', 'upgrade', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('110', '安装插件', '40', 'Admin', 'Addonshop', 'install', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('111', '升级插件', '40', 'Admin', 'Addonshop', 'upgrade', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('112', '栏目授权', '26', 'Admin', 'Rbac', 'setting_cat_priv', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('113', '手机版管理', '46', 'Wap', 'Wap', 'index', '', '1', '1', '3G手机版管理！', '1');
INSERT INTO `tp_menu` VALUES ('114', '修改', '113', 'Wap', 'Wap', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('154', '教师管理', '45', 'Content', 'Teacher', 'teacher', '', '1', '0', '新员工的自学教程', '0');
INSERT INTO `tp_menu` VALUES ('155', '教师添加', '154', 'Content', 'Teacher', 'add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('156', '教师修改', '154', 'Content', 'Teacher', 'edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('157', '教师删除', '154', 'Content', 'Teacher', 'delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('158', '数据库管理', '3', 'Datamanage', 'Manage', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('159', '数据备份', '158', 'Datamanage', 'Backup', 'index', 'type=export', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('160', '备份列表', '158', 'Datamanage', 'Backup', 'index', 'type=import', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('161', '商城', '0', 'Shop', 'Goods', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('162', '商品添加', '166', 'Shop', 'Goods', 'goods_add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('163', '商品修改', '166', 'Shop', 'Goods', 'goods_edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('164', '商品删除', '166', 'Shop', 'Goods', 'goods_delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('165', '商品管理', '161', 'Shop', 'Goods', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('166', '商品列表', '165', 'Shop', 'Goods', 'goods_index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('167', '会员管理', '161', 'Shop', 'Member', 'index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('168', '商品分类', '165', 'Shop', 'Goods', 'category_list', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('169', '分类添加', '168', 'Shop', 'Goods', 'category_add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('170', '分类修改', '168', 'Shop', 'Goods', 'category_edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('171', '分类删除', '168', 'Shop', 'Goods', 'category_delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('172', '会员列表', '167', 'Shop', 'Member', 'vip_index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('173', '添加会员', '172', 'Shop', 'Member', 'vip_add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('174', '会员修改', '172', 'Shop', 'Member', 'vip_edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('175', '会员删除', '172', 'Shop', 'Member', 'vip_delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('176', '促销管理', '161', 'Shop', 'Bulk', 'index', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('177', '团购列表', '176', 'Shop', 'Bulk', 'bulk_index', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('178', '添加团购活动', '177', 'Shop', 'Bulk', 'bulk_add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('179', '团购活动修改', '177', 'Shop', 'Bulk', 'bulk_edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('180', '团购活动删除', '177', 'Shop', 'Bulk', 'bulk_delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('181', '商品属性', '165', 'Shop', 'Goods', 'attr_index', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('182', '添加属性', '181', 'Shop', 'Goods', 'attr_add', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('183', '属性修改', '181', 'Shop', 'Goods', 'attr_edit', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('184', '删除属性', '181', 'Shop', 'Goods', 'attr_delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('185', '订单管理', '161', 'Shop', 'Order', 'order_list', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('186', '订单列表', '185', 'Shop', 'Order', 'order_list', '', '1', '1', '', '0');
INSERT INTO `tp_menu` VALUES ('187', '订单删除', '186', 'Shop', 'Order', 'order_delete', '', '1', '0', '', '0');
INSERT INTO `tp_menu` VALUES ('188', '订单详情', '186', 'Shop', 'Order', 'order_detail', '', '1', '0', '', '0');

-- ----------------------------
-- Table structure for tp_model
-- ----------------------------
DROP TABLE IF EXISTS `tp_model`;
CREATE TABLE `tp_model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL COMMENT '模型名称',
  `description` char(100) NOT NULL COMMENT '描述',
  `tablename` char(20) NOT NULL COMMENT '表名',
  `setting` text NOT NULL COMMENT '配置信息',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `items` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '信息数',
  `enablesearch` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启全站搜索',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用 1禁用',
  `default_style` char(30) NOT NULL COMMENT '风格',
  `category_template` char(30) NOT NULL COMMENT '栏目模板',
  `list_template` char(30) NOT NULL COMMENT '列表模板',
  `show_template` char(30) NOT NULL COMMENT '内容模板',
  `js_template` varchar(30) NOT NULL COMMENT 'JS模板',
  `sort` tinyint(3) NOT NULL COMMENT '排序',
  `type` tinyint(1) NOT NULL COMMENT '模块标识',
  PRIMARY KEY (`modelid`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_model
-- ----------------------------
INSERT INTO `tp_model` VALUES ('1', '文章模型', '文章模型', 'article', '', '1403150253', '0', '1', '0', '', '', '', '', '', '0', '0');
INSERT INTO `tp_model` VALUES ('2', '下载模型', '下载模型', 'download', '', '1403153866', '0', '1', '0', '', '', '', '', '', '0', '0');
INSERT INTO `tp_model` VALUES ('3', '图片模型', '图片模型', 'photo', '', '1403153881', '0', '1', '0', '', '', '', '', '', '0', '0');
INSERT INTO `tp_model` VALUES ('4', '单栏目模型', '单栏目模型', 'about', '', '1433899642', '0', '1', '0', '', '', '', '', '', '0', '0');
INSERT INTO `tp_model` VALUES ('5', '友情链接模型', '友情链接', 'link', '', '1438414641', '0', '1', '0', '', '', '', '', '', '0', '0');
INSERT INTO `tp_model` VALUES ('6', '多图片上传', 'multpic', 'multpic', '', '1438414840', '0', '1', '0', '', '', '', '', '', '0', '0');

-- ----------------------------
-- Table structure for tp_model_field
-- ----------------------------
DROP TABLE IF EXISTS `tp_model_field`;
CREATE TABLE `tp_model_field` (
  `fieldid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `field` varchar(20) NOT NULL COMMENT '字段名',
  `name` varchar(30) NOT NULL COMMENT '别名',
  `tips` text NOT NULL COMMENT '字段提示',
  `css` varchar(30) NOT NULL COMMENT '表单样式',
  `minlength` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最小值',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最大值',
  `pattern` varchar(255) NOT NULL COMMENT '数据校验正则',
  `errortips` varchar(255) NOT NULL COMMENT '数据校验未通过的提示信息',
  `formtype` varchar(20) NOT NULL COMMENT '字段类型',
  `setting` mediumtext NOT NULL,
  `formattribute` varchar(255) NOT NULL,
  `unsetgroupids` varchar(255) NOT NULL,
  `unsetroleids` varchar(255) NOT NULL,
  `iscore` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否内部字段 1是',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否系统字段 1 是',
  `isunique` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '值唯一',
  `isbase` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为基本信息',
  `issearch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为搜索条件',
  `isadd` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '在前台投稿中显示',
  `isfulltext` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为全站搜索信息',
  `isposition` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否入库到推荐位',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 禁用 0启用',
  `isomnipotent` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldid`),
  KEY `modelid` (`modelid`,`disabled`),
  KEY `field` (`field`,`modelid`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_model_field
-- ----------------------------
INSERT INTO `tp_model_field` VALUES ('1', '1', 'status', '状态', '', '', '0', '2', '', '', 'box', 'a:8:{s:7:\"options\";s:0:\"\";s:9:\"fieldtype\";s:7:\"varchar\";s:5:\"width\";s:0:\"\";s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"outputtype\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '15', '0', '0');
INSERT INTO `tp_model_field` VALUES ('2', '1', 'username', '用户名', '', '', '0', '20', '', '', 'text', 'a:5:{s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"ispassword\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '16', '0', '0');
INSERT INTO `tp_model_field` VALUES ('3', '1', 'islink', '转向链接', '', '', '0', '0', '', '', 'islink', 'a:3:{s:4:\"size\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '1', '0', '0', '17', '0', '0');
INSERT INTO `tp_model_field` VALUES ('4', '1', 'template', '内容页模板', '', '', '0', '30', '', '', 'template', 'a:2:{s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '-99', '-99', '0', '0', '0', '0', '0', '0', '0', '0', '13', '0', '0');
INSERT INTO `tp_model_field` VALUES ('5', '1', 'allow_comment', '允许评论', '', '', '0', '0', '', '', 'box', 'a:10:{s:7:\"options\";s:32:\"允许评论|1\n不允许评论|0\";s:7:\"boxtype\";s:5:\"radio\";s:9:\"fieldtype\";s:7:\"tinyint\";s:9:\"minnumber\";s:1:\"1\";s:5:\"width\";s:2:\"88\";s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:1:\"1\";s:10:\"outputtype\";s:1:\"1\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '14', '0', '0');
INSERT INTO `tp_model_field` VALUES ('6', '1', 'pages', '分页方式', '', '', '0', '0', '', '', 'pages', 'a:2:{s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '-99', '-99', '0', '0', '0', '1', '0', '0', '0', '0', '9', '0', '0');
INSERT INTO `tp_model_field` VALUES ('7', '1', 'inputtime', '真实发布时间', '', '', '0', '0', '', '', 'datetime', 'a:5:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '1', '1', '0', '0', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('8', '1', 'posid', '推荐位', '', '', '0', '0', '', '', 'posid', 'a:4:{s:5:\"width\";s:3:\"125\";s:12:\"defaultvalue\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('9', '1', 'url', 'URL', '', '', '0', '100', '', '', 'text', 'a:5:{s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"ispassword\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '1', '1', '0', '1', '0', '0', '0', '1', '12', '0', '0');
INSERT INTO `tp_model_field` VALUES ('10', '1', 'listorder', '排序', '', '', '0', '6', '', '', 'number', 'a:7:{s:9:\"minnumber\";s:0:\"\";s:9:\"maxnumber\";s:0:\"\";s:13:\"decimaldigits\";s:1:\"0\";s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '18', '0', '0');
INSERT INTO `tp_model_field` VALUES ('11', '1', 'relation', '相关文章', '', '', '0', '255', '', '', 'omnipotent', 'a:4:{s:8:\"formtext\";s:464:\"<input type=\"hidden\" name=\"info[relation]\" id=\"relation\" value=\"{FIELD_VALUE}\" style=\"50\" >\n<ul class=\"list-dot\" id=\"relation_text\">\n</ul>\n<input type=\"button\" value=\"添加相关\" onClick=\"omnipotent(\'selectid\',GV.DIMAUB+\'index.php?a=public_relationlist&m=Content&g=Content&modelid={MODELID}\',\'添加相关文章\',1)\" class=\"btn\">\n<span class=\"edit_content\">\n  <input type=\"button\" value=\"显示已有\" onClick=\"show_relation({MODELID},{ID})\" class=\"btn\">\n</span>\";s:9:\"fieldtype\";s:7:\"varchar\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '0', '0', '0', '1', '0', '8', '0', '0');
INSERT INTO `tp_model_field` VALUES ('12', '1', 'thumb', '缩略图', '', '', '0', '100', '', '', 'image', 'a:10:{s:5:\"width\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";s:9:\"show_type\";s:1:\"1\";s:15:\"upload_allowext\";s:20:\"jpg|jpeg|gif|png|bmp\";s:9:\"watermark\";s:1:\"0\";s:13:\"isselectimage\";s:1:\"1\";s:12:\"images_width\";s:0:\"\";s:13:\"images_height\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '1', '0', '1', '7', '0', '0');
INSERT INTO `tp_model_field` VALUES ('13', '1', 'catid', '栏目', '', '', '1', '6', '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'a:2:{s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '0', '0', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('15', '1', 'title', '标题', '', 'inputtitle', '1', '80', '', '请输入标题', 'title', 'a:2:{s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '1', '1', '1', '1', '3', '0', '0');
INSERT INTO `tp_model_field` VALUES ('16', '1', 'keywords', '关键词', '多关之间用空格或者“,”隔开', '', '0', '40', '', '', 'keyword', 'a:2:{s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '1', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('17', '1', 'tags', 'TAGS', '多关之间用空格或者“,”隔开', '', '0', '0', '', '', 'tags', 'a:4:{s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('18', '1', 'description', '摘要', '', '', '0', '255', '', '', 'textarea', 'a:7:{s:5:\"width\";s:2:\"99\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"enablehtml\";s:1:\"0\";s:9:\"fieldtype\";s:10:\"mediumtext\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '1', '1', '1', '5', '0', '0');
INSERT INTO `tp_model_field` VALUES ('19', '1', 'updatetime', '发布时间', '', '', '0', '0', '', '', 'datetime', 'a:5:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '10', '0', '0');
INSERT INTO `tp_model_field` VALUES ('20', '1', 'content', '内容', '<style type=\"text/css\">.content_attr{ border:1px solid #CCC; padding:5px 8px; background:#FFC; margin-top:6px}</style><div class=\"content_attr\"><label><input name=\"add_introduce\" type=\"checkbox\"  value=\"1\" checked>是否截取内容</label><input type=\"text\" name=\"introcude_length\" value=\"200\" size=\"3\">字符至内容摘要\n<label><input type=\'checkbox\' name=\'auto_thumb\' value=\"1\" checked>是否获取内容第</label><input type=\"text\" name=\"auto_thumb_no\" value=\"1\" size=\"2\" class=\"\">张图片作为标题图片\n</div>', '', '1', '999999', '', '内容不能为空', 'editor', 'a:7:{s:7:\"toolbar\";s:4:\"full\";s:12:\"defaultvalue\";s:0:\"\";s:15:\"enablesaveimage\";s:1:\"1\";s:6:\"height\";s:0:\"\";s:9:\"fieldtype\";s:10:\"mediumtext\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '1', '0', '1', '1', '0', '6', '0', '0');
INSERT INTO `tp_model_field` VALUES ('21', '1', 'copyfrom', '来源', '', '', '0', '0', '', '', 'copyfrom', 'a:4:{s:12:\"defaultvalue\";s:0:\"\";s:5:\"width\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '1', '0', '1', '0', '0', '5', '0', '0');
INSERT INTO `tp_model_field` VALUES ('26', '2', 'username', '用户名', '', '', '0', '20', '', '', 'text', '', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '16', '0', '0');
INSERT INTO `tp_model_field` VALUES ('27', '2', 'islink', '转向链接', '', '', '0', '0', '', '', 'islink', '', '', '', '', '0', '1', '0', '0', '0', '1', '0', '0', '17', '0', '0');
INSERT INTO `tp_model_field` VALUES ('28', '2', 'template', '内容页模板', '', '', '0', '30', '', '', 'template', 'a:2:{s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '0', '0', '0', '0', '0', '0', '0', '13', '0', '0');
INSERT INTO `tp_model_field` VALUES ('29', '2', 'allow_comment', '允许评论', '', '', '0', '0', '', '', 'box', 'a:9:{s:7:\"options\";s:33:\"允许评论|1\r\n不允许评论|0\";s:7:\"boxtype\";s:5:\"radio\";s:9:\"fieldtype\";s:7:\"tinyint\";s:9:\"minnumber\";s:1:\"1\";s:5:\"width\";s:2:\"88\";s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:1:\"1\";s:10:\"outputtype\";s:1:\"1\";s:10:\"filtertype\";s:1:\"0\";}', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '14', '0', '0');
INSERT INTO `tp_model_field` VALUES ('24', '1', 'prefix', '自定义文件名', '', '', '0', '255', '', '', 'text', 'a:5:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"ispassword\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '17', '0', '0');
INSERT INTO `tp_model_field` VALUES ('66', '3', 'prefix', '自定义文件名', '', '', '0', '0', '', '', 'text', 'a:7:{s:4:\"size\";s:2:\"50\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"ispassword\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '8', '0', '0');
INSERT INTO `tp_model_field` VALUES ('25', '2', 'status', '状态', '', '', '0', '2', '', '', 'box', '', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '15', '0', '0');
INSERT INTO `tp_model_field` VALUES ('65', '2', 'prefix', '自定义文件名', '', '', '0', '0', '', '', 'text', 'a:7:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"ispassword\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '17', '0', '0');
INSERT INTO `tp_model_field` VALUES ('31', '2', 'inputtime', '真实发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '1', '1', '0', '0', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('32', '2', 'posid', '推荐位', '', '', '0', '0', '', '', 'posid', 'a:4:{s:5:\"width\";s:3:\"125\";s:12:\"defaultvalue\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('33', '2', 'url', 'URL', '', '', '0', '100', '', '', 'text', '', '', '', '', '1', '1', '0', '1', '0', '0', '0', '1', '12', '0', '0');
INSERT INTO `tp_model_field` VALUES ('34', '2', 'listorder', '排序', '', '', '0', '6', '', '', 'number', '', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '18', '0', '0');
INSERT INTO `tp_model_field` VALUES ('35', '2', 'relation', '相关下载', '', '', '0', '255', '', '', 'omnipotent', 'a:4:{s:8:\"formtext\";s:464:\"<input type=\"hidden\" name=\"info[relation]\" id=\"relation\" value=\"{FIELD_VALUE}\" style=\"50\" >\n<ul class=\"list-dot\" id=\"relation_text\">\n</ul>\n<input type=\"button\" value=\"添加相关\" onClick=\"omnipotent(\'selectid\',GV.DIMAUB+\'index.php?a=public_relationlist&m=Content&g=Content&modelid={MODELID}\',\'添加相关信息\',1)\" class=\"btn\">\n<span class=\"edit_content\">\n  <input type=\"button\" value=\"显示已有\" onClick=\"show_relation({MODELID},{ID})\" class=\"btn\">\n</span>\";s:9:\"fieldtype\";s:7:\"varchar\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '0', '0', '0', '1', '0', '8', '0', '0');
INSERT INTO `tp_model_field` VALUES ('36', '2', 'thumb', '缩略图', '', '', '0', '100', '', '', 'image', 'a:9:{s:4:\"size\";s:2:\"50\";s:12:\"defaultvalue\";s:0:\"\";s:9:\"show_type\";s:1:\"1\";s:14:\"upload_maxsize\";s:4:\"1024\";s:15:\"upload_allowext\";s:20:\"jpg|jpeg|gif|png|bmp\";s:9:\"watermark\";s:1:\"0\";s:13:\"isselectimage\";s:1:\"1\";s:12:\"images_width\";s:0:\"\";s:13:\"images_height\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '1', '0', '1', '7', '0', '0');
INSERT INTO `tp_model_field` VALUES ('37', '2', 'catid', '栏目', '', '', '1', '6', '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'a:1:{s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '0', '0', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('38', '2', 'typeid', '类别', '', '', '0', '0', '', '', 'typeid', 'a:2:{s:9:\"minnumber\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '', '', '1', '1', '0', '1', '1', '1', '0', '0', '2', '0', '0');
INSERT INTO `tp_model_field` VALUES ('39', '2', 'title', '标题', '', 'inputtitle', '1', '80', '', '请输入标题', 'title', '', '', '', '', '0', '1', '0', '1', '1', '1', '1', '1', '3', '0', '0');
INSERT INTO `tp_model_field` VALUES ('40', '2', 'keywords', '关键词', '多关键词之间用空格隔开', '', '0', '40', '', '', 'keyword', 'a:2:{s:4:\"size\";s:3:\"100\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '1', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('41', '2', 'tags', 'TAGS', '多关之间用空格或者“,”隔开', '', '0', '0', '', '', 'tags', 'a:4:{s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('42', '2', 'description', '摘要', '', '', '0', '255', '', '', 'textarea', 'a:4:{s:5:\"width\";s:2:\"98\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"enablehtml\";s:1:\"0\";}', '', '', '', '0', '1', '0', '1', '0', '1', '1', '1', '5', '0', '0');
INSERT INTO `tp_model_field` VALUES ('43', '2', 'updatetime', '发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '10', '0', '0');
INSERT INTO `tp_model_field` VALUES ('45', '3', 'status', '状态', '', '', '0', '2', '', '', 'box', '', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '15', '0', '0');
INSERT INTO `tp_model_field` VALUES ('46', '3', 'username', '用户名', '', '', '0', '20', '', '', 'text', '', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '16', '0', '0');
INSERT INTO `tp_model_field` VALUES ('47', '3', 'islink', '转向链接', '', '', '0', '0', '', '', 'islink', '', '', '', '', '0', '1', '0', '0', '0', '1', '0', '0', '17', '0', '0');
INSERT INTO `tp_model_field` VALUES ('48', '3', 'template', '内容页模板', '', '', '0', '30', '', '', 'template', 'a:2:{s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '0', '0', '0', '0', '0', '0', '0', '13', '0', '0');
INSERT INTO `tp_model_field` VALUES ('49', '3', 'allow_comment', '允许评论', '', '', '0', '0', '', '', 'box', 'a:9:{s:7:\"options\";s:33:\"允许评论|1\r\n不允许评论|0\";s:7:\"boxtype\";s:5:\"radio\";s:9:\"fieldtype\";s:7:\"tinyint\";s:9:\"minnumber\";s:1:\"1\";s:5:\"width\";s:2:\"88\";s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:1:\"1\";s:10:\"outputtype\";s:1:\"1\";s:10:\"filtertype\";s:1:\"0\";}', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '14', '0', '0');
INSERT INTO `tp_model_field` VALUES ('67', '2', 'download', '文件下载', '', '', '0', '0', '', '', 'downfiles', 'a:9:{s:15:\"upload_allowext\";s:20:\"gif|jpg|jpeg|png|bmp\";s:13:\"isselectimage\";s:1:\"0\";s:13:\"upload_number\";s:2:\"10\";s:10:\"statistics\";s:0:\"\";s:12:\"downloadlink\";s:1:\"1\";s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '0', '0', '1', '0', '1', '0', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('51', '3', 'inputtime', '真实发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '1', '1', '0', '0', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('52', '3', 'posid', '推荐位', '', '', '0', '0', '', '', 'posid', 'a:4:{s:5:\"width\";s:3:\"125\";s:12:\"defaultvalue\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('53', '3', 'url', 'URL', '', '', '0', '100', '', '', 'text', '', '', '', '', '1', '1', '0', '1', '0', '0', '0', '1', '12', '0', '0');
INSERT INTO `tp_model_field` VALUES ('54', '3', 'listorder', '排序', '', '', '0', '6', '', '', 'number', '', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '18', '0', '0');
INSERT INTO `tp_model_field` VALUES ('55', '3', 'relation', '相关图片', '', '', '0', '255', '', '', 'omnipotent', 'a:4:{s:8:\"formtext\";s:464:\"<input type=\"hidden\" name=\"info[relation]\" id=\"relation\" value=\"{FIELD_VALUE}\" style=\"50\" >\n<ul class=\"list-dot\" id=\"relation_text\">\n</ul>\n<input type=\"button\" value=\"添加相关\" onClick=\"omnipotent(\'selectid\',GV.DIMAUB+\'index.php?a=public_relationlist&m=Content&g=Content&modelid={MODELID}\',\'添加相关信息\',1)\" class=\"btn\">\n<span class=\"edit_content\">\n  <input type=\"button\" value=\"显示已有\" onClick=\"show_relation({MODELID},{ID})\" class=\"btn\">\n</span>\";s:9:\"fieldtype\";s:7:\"varchar\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '0', '0', '0', '1', '0', '8', '0', '0');
INSERT INTO `tp_model_field` VALUES ('56', '3', 'thumb', '缩略图', '', '', '0', '100', '', '', 'image', 'a:9:{s:4:\"size\";s:2:\"50\";s:12:\"defaultvalue\";s:0:\"\";s:9:\"show_type\";s:1:\"1\";s:14:\"upload_maxsize\";s:4:\"1024\";s:15:\"upload_allowext\";s:20:\"jpg|jpeg|gif|png|bmp\";s:9:\"watermark\";s:1:\"0\";s:13:\"isselectimage\";s:1:\"1\";s:12:\"images_width\";s:0:\"\";s:13:\"images_height\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '1', '0', '1', '7', '0', '0');
INSERT INTO `tp_model_field` VALUES ('57', '3', 'catid', '栏目', '', '', '1', '6', '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'a:1:{s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '0', '0', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('59', '3', 'title', '标题', '', 'inputtitle', '1', '80', '', '请输入标题', 'title', '', '', '', '', '0', '1', '0', '1', '1', '1', '1', '1', '3', '0', '0');
INSERT INTO `tp_model_field` VALUES ('60', '3', 'keywords', '关键词', '多关键词之间用空格隔开', '', '0', '40', '', '', 'keyword', 'a:2:{s:4:\"size\";s:3:\"100\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '1', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('61', '3', 'tags', 'TAGS', '多关之间用空格或者“,”隔开', '', '0', '0', '', '', 'tags', 'a:4:{s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('62', '3', 'description', '摘要', '', '', '0', '255', '', '', 'textarea', 'a:4:{s:5:\"width\";s:2:\"98\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"enablehtml\";s:1:\"0\";}', '', '', '', '0', '1', '0', '1', '0', '1', '1', '1', '5', '0', '0');
INSERT INTO `tp_model_field` VALUES ('63', '3', 'updatetime', '发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '10', '0', '0');
INSERT INTO `tp_model_field` VALUES ('68', '3', 'imgs', '图片列表', '', '', '0', '0', '', '', 'images', 'a:8:{s:15:\"upload_allowext\";s:20:\"gif|jpg|jpeg|png|bmp\";s:13:\"isselectimage\";s:1:\"0\";s:13:\"upload_number\";s:2:\"10\";s:9:\"watermark\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '0', '0', '1', '0', '1', '0', '0', '8', '0', '0');
INSERT INTO `tp_model_field` VALUES ('69', '4', 'status', '状态', '', '', '0', '2', '', '', 'box', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '15', '1', '0');
INSERT INTO `tp_model_field` VALUES ('70', '4', 'username', '用户名', '', '', '0', '20', '', '', 'text', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '16', '1', '0');
INSERT INTO `tp_model_field` VALUES ('71', '4', 'islink', '转向链接', '', '', '0', '0', '', '', 'islink', 's:0:\"\";', '', '', '', '0', '1', '0', '0', '0', '1', '0', '0', '17', '0', '0');
INSERT INTO `tp_model_field` VALUES ('72', '4', 'template', '内容页模板', '', '', '0', '30', '', '', 'template', 'a:2:{s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '0', '0', '0', '0', '0', '0', '0', '13', '1', '0');
INSERT INTO `tp_model_field` VALUES ('73', '4', 'allow_comment', '允许评论', '', '', '0', '0', '', '', 'box', 'a:9:{s:7:\"options\";s:33:\"允许评论|1\r\n不允许评论|0\";s:7:\"boxtype\";s:5:\"radio\";s:9:\"fieldtype\";s:7:\"tinyint\";s:9:\"minnumber\";s:1:\"1\";s:5:\"width\";s:2:\"88\";s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:1:\"1\";s:10:\"outputtype\";s:1:\"1\";s:10:\"filtertype\";s:1:\"0\";}', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '14', '1', '0');
INSERT INTO `tp_model_field` VALUES ('74', '4', 'pages', '分页方式', '', '', '0', '0', '', '', 'pages', 's:0:\"\";', '', '-99', '-99', '0', '0', '0', '1', '0', '0', '0', '0', '9', '1', '0');
INSERT INTO `tp_model_field` VALUES ('75', '4', 'inputtime', '真实发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '1', '1', '0', '0', '0', '0', '0', '1', '11', '1', '0');
INSERT INTO `tp_model_field` VALUES ('76', '4', 'posid', '推荐位', '', '', '0', '0', '', '', 'posid', 'a:4:{s:5:\"width\";s:3:\"125\";s:12:\"defaultvalue\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '1', '11', '1', '0');
INSERT INTO `tp_model_field` VALUES ('77', '4', 'url', 'URL', '', '', '0', '100', '', '', 'text', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '1', '12', '1', '0');
INSERT INTO `tp_model_field` VALUES ('78', '4', 'listorder', '排序', '', '', '0', '6', '', '', 'number', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '18', '0', '0');
INSERT INTO `tp_model_field` VALUES ('79', '4', 'relation', '相关文章', '', '', '0', '255', '', '', 'omnipotent', 'a:4:{s:8:\"formtext\";s:464:\"<input type=\"hidden\" name=\"info[relation]\" id=\"relation\" value=\"{FIELD_VALUE}\" style=\"50\" >\n<ul class=\"list-dot\" id=\"relation_text\">\n</ul>\n<input type=\"button\" value=\"添加相关\" onClick=\"omnipotent(\'selectid\',GV.DIMAUB+\'index.php?a=public_relationlist&m=Content&g=Content&modelid={MODELID}\',\'添加相关文章\',1)\" class=\"btn\">\n<span class=\"edit_content\">\n  <input type=\"button\" value=\"显示已有\" onClick=\"show_relation({MODELID},{ID})\" class=\"btn\">\n</span>\";s:9:\"fieldtype\";s:7:\"varchar\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '0', '0', '0', '1', '0', '8', '1', '0');
INSERT INTO `tp_model_field` VALUES ('80', '4', 'thumb', '缩略图', '', '', '0', '100', '', '', 'image', 'a:9:{s:4:\"size\";s:2:\"50\";s:12:\"defaultvalue\";s:0:\"\";s:9:\"show_type\";s:1:\"1\";s:14:\"upload_maxsize\";s:4:\"1024\";s:15:\"upload_allowext\";s:20:\"jpg|jpeg|gif|png|bmp\";s:9:\"watermark\";s:1:\"0\";s:13:\"isselectimage\";s:1:\"1\";s:12:\"images_width\";s:0:\"\";s:13:\"images_height\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '1', '0', '1', '7', '0', '0');
INSERT INTO `tp_model_field` VALUES ('81', '4', 'catid', '栏目', '', '', '1', '6', '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'a:1:{s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '0', '0', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('82', '4', 'typeid', '类别', '', '', '0', '0', '', '', 'typeid', 'a:2:{s:9:\"minnumber\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '', '', '1', '1', '0', '1', '1', '1', '0', '0', '2', '0', '0');
INSERT INTO `tp_model_field` VALUES ('83', '4', 'title', '标题', '', 'inputtitle', '1', '80', '', '请输入标题', 'title', 's:0:\"\";', '', '', '', '0', '1', '0', '1', '1', '1', '1', '1', '3', '0', '0');
INSERT INTO `tp_model_field` VALUES ('84', '4', 'keywords', '关键词', '多关键词之间用空格隔开', '', '0', '40', '', '', 'keyword', 'a:2:{s:4:\"size\";s:3:\"100\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '1', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('85', '4', 'tags', 'TAGS', '多关之间用空格或者“,”隔开', '', '0', '0', '', '', 'tags', 'a:4:{s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '0', '4', '1', '0');
INSERT INTO `tp_model_field` VALUES ('86', '4', 'description', '摘要', '', '', '0', '255', '', '', 'textarea', 'a:4:{s:5:\"width\";s:2:\"98\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"enablehtml\";s:1:\"0\";}', '', '', '', '0', '1', '0', '1', '0', '1', '1', '1', '5', '1', '0');
INSERT INTO `tp_model_field` VALUES ('87', '4', 'updatetime', '发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '10', '0', '0');
INSERT INTO `tp_model_field` VALUES ('88', '4', 'content', '内容', '<style type=\"text/css\">.content_attr{ border:1px solid #CCC; padding:5px 8px; background:#FFC; margin-top:6px}</style><div class=\"content_attr\"><label><input name=\"add_introduce\" type=\"checkbox\"  value=\"1\" checked>是否截取内容</label><input type=\"text\" name=\"introcude_length\" value=\"200\" size=\"3\">字符至内容摘要\r\n<label><input type=\'checkbox\' name=\'auto_thumb\' value=\"1\" checked>是否获取内容第</label><input type=\"text\" name=\"auto_thumb_no\" value=\"1\" size=\"2\" class=\"\">张图片作为标题图片\r\n</div>', '', '1', '999999', '', '内容不能为空', 'editor', 'a:6:{s:7:\"toolbar\";s:4:\"full\";s:12:\"defaultvalue\";s:0:\"\";s:13:\"enablekeylink\";s:1:\"1\";s:10:\"replacenum\";s:1:\"2\";s:9:\"link_mode\";s:1:\"0\";s:15:\"enablesaveimage\";s:1:\"1\";}', '', '', '', '0', '0', '0', '1', '0', '1', '1', '0', '6', '0', '0');
INSERT INTO `tp_model_field` VALUES ('89', '4', 'content', '内容', '', '', '0', '0', '', '', 'editor', 'a:8:{s:7:\"toolbar\";s:4:\"full\";s:9:\"mbtoolbar\";s:4:\"full\";s:12:\"defaultvalue\";s:0:\"\";s:15:\"enablesaveimage\";s:1:\"0\";s:6:\"height\";s:3:\"200\";s:9:\"fieldtype\";s:10:\"mediumtext\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '1', '1', '1', '5', '0', '0');
INSERT INTO `tp_model_field` VALUES ('90', '5', 'status', '状态', '', '', '0', '2', '', '', 'box', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '15', '0', '0');
INSERT INTO `tp_model_field` VALUES ('91', '5', 'username', '用户名', '', '', '0', '20', '', '', 'text', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '16', '1', '0');
INSERT INTO `tp_model_field` VALUES ('92', '5', 'islink', '转向链接', '', '', '0', '0', '', '', 'islink', 'a:3:{s:4:\"size\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '1', '0', '0', '5', '0', '0');
INSERT INTO `tp_model_field` VALUES ('93', '5', 'template', '内容页模板', '', '', '0', '30', '', '', 'template', 'a:2:{s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '0', '0', '0', '0', '0', '0', '0', '13', '1', '0');
INSERT INTO `tp_model_field` VALUES ('94', '5', 'allow_comment', '允许评论', '', '', '0', '0', '', '', 'box', 'a:9:{s:7:\"options\";s:33:\"允许评论|1\r\n不允许评论|0\";s:7:\"boxtype\";s:5:\"radio\";s:9:\"fieldtype\";s:7:\"tinyint\";s:9:\"minnumber\";s:1:\"1\";s:5:\"width\";s:2:\"88\";s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:1:\"1\";s:10:\"outputtype\";s:1:\"1\";s:10:\"filtertype\";s:1:\"0\";}', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '14', '1', '0');
INSERT INTO `tp_model_field` VALUES ('95', '5', 'pages', '分页方式', '', '', '0', '0', '', '', 'pages', 's:0:\"\";', '', '-99', '-99', '0', '0', '0', '1', '0', '0', '0', '0', '9', '1', '0');
INSERT INTO `tp_model_field` VALUES ('96', '5', 'inputtime', '真实发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '1', '1', '0', '0', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('97', '5', 'posid', '推荐位', '', '', '0', '0', '', '', 'posid', 'a:4:{s:5:\"width\";s:3:\"125\";s:12:\"defaultvalue\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '1', '11', '1', '0');
INSERT INTO `tp_model_field` VALUES ('98', '5', 'url', 'URL', '', '', '0', '100', '', '', 'text', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '1', '12', '0', '0');
INSERT INTO `tp_model_field` VALUES ('99', '5', 'listorder', '排序', '', '', '0', '6', '', '', 'number', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '18', '0', '0');
INSERT INTO `tp_model_field` VALUES ('100', '5', 'relation', '相关文章', '', '', '0', '255', '', '', 'omnipotent', 'a:4:{s:8:\"formtext\";s:464:\"<input type=\"hidden\" name=\"info[relation]\" id=\"relation\" value=\"{FIELD_VALUE}\" style=\"50\" >\n<ul class=\"list-dot\" id=\"relation_text\">\n</ul>\n<input type=\"button\" value=\"添加相关\" onClick=\"omnipotent(\'selectid\',GV.DIMAUB+\'index.php?a=public_relationlist&m=Content&g=Content&modelid={MODELID}\',\'添加相关文章\',1)\" class=\"btn\">\n<span class=\"edit_content\">\n  <input type=\"button\" value=\"显示已有\" onClick=\"show_relation({MODELID},{ID})\" class=\"btn\">\n</span>\";s:9:\"fieldtype\";s:7:\"varchar\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '0', '0', '0', '1', '0', '8', '1', '0');
INSERT INTO `tp_model_field` VALUES ('101', '5', 'thumb', '缩略图', '', '', '0', '100', '', '', 'image', 'a:9:{s:4:\"size\";s:2:\"50\";s:12:\"defaultvalue\";s:0:\"\";s:9:\"show_type\";s:1:\"1\";s:14:\"upload_maxsize\";s:4:\"1024\";s:15:\"upload_allowext\";s:20:\"jpg|jpeg|gif|png|bmp\";s:9:\"watermark\";s:1:\"0\";s:13:\"isselectimage\";s:1:\"1\";s:12:\"images_width\";s:0:\"\";s:13:\"images_height\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '1', '0', '1', '7', '0', '0');
INSERT INTO `tp_model_field` VALUES ('102', '5', 'catid', '栏目', '', '', '1', '6', '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'a:1:{s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '0', '0', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('103', '5', 'typeid', '类别', '', '', '0', '0', '', '', 'typeid', 'a:2:{s:9:\"minnumber\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '', '', '1', '1', '0', '1', '1', '1', '0', '0', '2', '0', '0');
INSERT INTO `tp_model_field` VALUES ('104', '5', 'title', '标题', '', 'inputtitle', '1', '80', '', '请输入标题', 'title', 's:0:\"\";', '', '', '', '0', '1', '0', '1', '1', '1', '1', '1', '3', '0', '0');
INSERT INTO `tp_model_field` VALUES ('105', '5', 'keywords', '关键词', '多关键词之间用空格隔开', '', '0', '40', '', '', 'keyword', 'a:2:{s:4:\"size\";s:3:\"100\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '1', '0', '4', '1', '0');
INSERT INTO `tp_model_field` VALUES ('106', '5', 'tags', 'TAGS', '多关之间用空格或者“,”隔开', '', '0', '0', '', '', 'tags', 'a:4:{s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '0', '4', '1', '0');
INSERT INTO `tp_model_field` VALUES ('107', '5', 'description', '摘要', '', '', '0', '255', '', '', 'textarea', 'a:4:{s:5:\"width\";s:2:\"98\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"enablehtml\";s:1:\"0\";}', '', '', '', '0', '1', '0', '1', '0', '1', '1', '1', '5', '1', '0');
INSERT INTO `tp_model_field` VALUES ('108', '5', 'updatetime', '发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '10', '1', '0');
INSERT INTO `tp_model_field` VALUES ('109', '5', 'content', '内容', '<style type=\"text/css\">.content_attr{ border:1px solid #CCC; padding:5px 8px; background:#FFC; margin-top:6px}</style><div class=\"content_attr\"><label><input name=\"add_introduce\" type=\"checkbox\"  value=\"1\" checked>是否截取内容</label><input type=\"text\" name=\"introcude_length\" value=\"200\" size=\"3\">字符至内容摘要\r\n<label><input type=\'checkbox\' name=\'auto_thumb\' value=\"1\" checked>是否获取内容第</label><input type=\"text\" name=\"auto_thumb_no\" value=\"1\" size=\"2\" class=\"\">张图片作为标题图片\r\n</div>', '', '1', '999999', '', '内容不能为空', 'editor', 'a:6:{s:7:\"toolbar\";s:4:\"full\";s:12:\"defaultvalue\";s:0:\"\";s:13:\"enablekeylink\";s:1:\"1\";s:10:\"replacenum\";s:1:\"2\";s:9:\"link_mode\";s:1:\"0\";s:15:\"enablesaveimage\";s:1:\"1\";}', '', '', '', '0', '0', '0', '1', '0', '1', '1', '0', '6', '0', '0');
INSERT INTO `tp_model_field` VALUES ('110', '6', 'status', '状态', '', '', '0', '2', '', '', 'box', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '15', '0', '0');
INSERT INTO `tp_model_field` VALUES ('111', '6', 'username', '用户名', '', '', '0', '20', '', '', 'text', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '16', '0', '0');
INSERT INTO `tp_model_field` VALUES ('112', '6', 'islink', '转向链接', '', '', '0', '0', '', '', 'islink', 's:0:\"\";', '', '', '', '0', '1', '0', '0', '0', '1', '0', '0', '17', '0', '0');
INSERT INTO `tp_model_field` VALUES ('113', '6', 'template', '内容页模板', '', '', '0', '30', '', '', 'template', 'a:2:{s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '0', '0', '0', '0', '0', '0', '0', '13', '0', '0');
INSERT INTO `tp_model_field` VALUES ('114', '6', 'allow_comment', '允许评论', '', '', '0', '0', '', '', 'box', 'a:9:{s:7:\"options\";s:33:\"允许评论|1\r\n不允许评论|0\";s:7:\"boxtype\";s:5:\"radio\";s:9:\"fieldtype\";s:7:\"tinyint\";s:9:\"minnumber\";s:1:\"1\";s:5:\"width\";s:2:\"88\";s:4:\"size\";s:0:\"\";s:12:\"defaultvalue\";s:1:\"1\";s:10:\"outputtype\";s:1:\"1\";s:10:\"filtertype\";s:1:\"0\";}', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '14', '0', '0');
INSERT INTO `tp_model_field` VALUES ('115', '6', 'pages', '分页方式', '', '', '0', '0', '', '', 'pages', 's:0:\"\";', '', '-99', '-99', '0', '0', '0', '1', '0', '0', '0', '0', '9', '0', '0');
INSERT INTO `tp_model_field` VALUES ('116', '6', 'inputtime', '真实发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '1', '1', '0', '0', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('117', '6', 'posid', '推荐位', '', '', '0', '0', '', '', 'posid', 'a:4:{s:5:\"width\";s:3:\"125\";s:12:\"defaultvalue\";s:0:\"\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '1', '11', '0', '0');
INSERT INTO `tp_model_field` VALUES ('118', '6', 'url', 'URL', '', '', '0', '100', '', '', 'text', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '1', '12', '0', '0');
INSERT INTO `tp_model_field` VALUES ('119', '6', 'listorder', '排序', '', '', '0', '6', '', '', 'number', 's:0:\"\";', '', '', '', '1', '1', '0', '1', '0', '0', '0', '0', '18', '0', '0');
INSERT INTO `tp_model_field` VALUES ('120', '6', 'relation', '相关文章', '', '', '0', '255', '', '', 'omnipotent', 'a:4:{s:8:\"formtext\";s:464:\"<input type=\"hidden\" name=\"info[relation]\" id=\"relation\" value=\"{FIELD_VALUE}\" style=\"50\" >\n<ul class=\"list-dot\" id=\"relation_text\">\n</ul>\n<input type=\"button\" value=\"添加相关\" onClick=\"omnipotent(\'selectid\',GV.DIMAUB+\'index.php?a=public_relationlist&m=Content&g=Content&modelid={MODELID}\',\'添加相关文章\',1)\" class=\"btn\">\n<span class=\"edit_content\">\n  <input type=\"button\" value=\"显示已有\" onClick=\"show_relation({MODELID},{ID})\" class=\"btn\">\n</span>\";s:9:\"fieldtype\";s:7:\"varchar\";s:12:\"backstagefun\";s:0:\"\";s:8:\"frontfun\";s:0:\"\";}', '', '', '', '0', '0', '0', '0', '0', '0', '1', '0', '8', '0', '0');
INSERT INTO `tp_model_field` VALUES ('121', '6', 'thumb', '缩略图', '', '', '0', '100', '', '', 'image', 'a:9:{s:4:\"size\";s:2:\"50\";s:12:\"defaultvalue\";s:0:\"\";s:9:\"show_type\";s:1:\"1\";s:14:\"upload_maxsize\";s:4:\"1024\";s:15:\"upload_allowext\";s:20:\"jpg|jpeg|gif|png|bmp\";s:9:\"watermark\";s:1:\"0\";s:13:\"isselectimage\";s:1:\"1\";s:12:\"images_width\";s:0:\"\";s:13:\"images_height\";s:0:\"\";}', '', '', '', '0', '1', '0', '0', '0', '1', '0', '1', '7', '0', '0');
INSERT INTO `tp_model_field` VALUES ('122', '6', 'catid', '栏目', '', '', '1', '6', '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'a:1:{s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '0', '0', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('123', '6', 'typeid', '类别', '', '', '0', '0', '', '', 'typeid', 'a:2:{s:9:\"minnumber\";s:0:\"\";s:12:\"defaultvalue\";s:0:\"\";}', '', '', '', '1', '1', '0', '1', '1', '1', '0', '0', '2', '0', '0');
INSERT INTO `tp_model_field` VALUES ('124', '6', 'title', '标题', '', 'inputtitle', '1', '80', '', '请输入标题', 'title', 's:0:\"\";', '', '', '', '0', '1', '0', '1', '1', '1', '1', '1', '3', '0', '0');
INSERT INTO `tp_model_field` VALUES ('125', '6', 'keywords', '关键词', '多关键词之间用空格隔开', '', '0', '40', '', '', 'keyword', 'a:2:{s:4:\"size\";s:3:\"100\";s:12:\"defaultvalue\";s:0:\"\";}', '', '-99', '-99', '0', '1', '0', '1', '1', '1', '1', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('126', '6', 'tags', 'TAGS', '多关之间用空格或者“,”隔开', '', '0', '0', '', '', 'tags', 'a:4:{s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '1', '0', '0', '0', '0', '4', '0', '0');
INSERT INTO `tp_model_field` VALUES ('127', '6', 'description', '摘要', '', '', '0', '255', '', '', 'textarea', 'a:4:{s:5:\"width\";s:2:\"98\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";s:10:\"enablehtml\";s:1:\"0\";}', '', '', '', '0', '1', '0', '1', '0', '1', '1', '1', '5', '0', '0');
INSERT INTO `tp_model_field` VALUES ('128', '6', 'updatetime', '发布时间', '', '', '0', '0', '', '', 'datetime', 'a:3:{s:9:\"fieldtype\";s:3:\"int\";s:6:\"format\";s:11:\"Y-m-d H:i:s\";s:11:\"defaulttype\";s:1:\"0\";}', '', '', '', '0', '1', '0', '0', '0', '0', '0', '0', '10', '0', '0');
INSERT INTO `tp_model_field` VALUES ('129', '6', 'content', '内容', '<style type=\"text/css\">.content_attr{ border:1px solid #CCC; padding:5px 8px; background:#FFC; margin-top:6px}</style><div class=\"content_attr\"><label><input name=\"add_introduce\" type=\"checkbox\"  value=\"1\" checked>是否截取内容</label><input type=\"text\" name=\"introcude_length\" value=\"200\" size=\"3\">字符至内容摘要\r\n<label><input type=\'checkbox\' name=\'auto_thumb\' value=\"1\" checked>是否获取内容第</label><input type=\"text\" name=\"auto_thumb_no\" value=\"1\" size=\"2\" class=\"\">张图片作为标题图片\r\n</div>', '', '1', '999999', '', '内容不能为空', 'editor', 'a:6:{s:7:\"toolbar\";s:4:\"full\";s:12:\"defaultvalue\";s:0:\"\";s:13:\"enablekeylink\";s:1:\"1\";s:10:\"replacenum\";s:1:\"2\";s:9:\"link_mode\";s:1:\"0\";s:15:\"enablesaveimage\";s:1:\"1\";}', '', '', '', '0', '0', '0', '1', '0', '1', '1', '0', '6', '0', '0');
INSERT INTO `tp_model_field` VALUES ('130', '6', 'multpic', 'multpic', '', '', '0', '0', '', '', 'images', 'a:8:{s:15:\"upload_allowext\";s:20:\"gif|jpg|jpeg|png|bmp\";s:13:\"isselectimage\";s:1:\"1\";s:13:\"upload_number\";s:2:\"20\";s:9:\"watermark\";s:1:\"0\";s:12:\"backstagefun\";s:0:\"\";s:17:\"backstagefun_type\";s:1:\"1\";s:8:\"frontfun\";s:0:\"\";s:13:\"frontfun_type\";s:1:\"1\";}', '', '', '', '0', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for tp_module
-- ----------------------------
DROP TABLE IF EXISTS `tp_module`;
CREATE TABLE `tp_module` (
  `module` varchar(15) NOT NULL COMMENT '模块',
  `modulename` varchar(20) NOT NULL COMMENT '模块名称',
  `sign` varchar(255) NOT NULL COMMENT '签名',
  `iscore` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '内置模块',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否可用',
  `version` varchar(50) NOT NULL DEFAULT '' COMMENT '版本',
  `setting` mediumtext NOT NULL COMMENT '设置信息',
  `installtime` int(10) NOT NULL COMMENT '安装时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`module`),
  KEY `sign` (`sign`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='已安装模块列表';

-- ----------------------------
-- Records of tp_module
-- ----------------------------
INSERT INTO `tp_module` VALUES ('Wap', 'WAP手机版', '4B7B06DA1101821D6AAE4B51BC96E6AF', '0', '1', '1.0.2', '', '1431316756', '1431316756', '0');

-- ----------------------------
-- Table structure for tp_multpic
-- ----------------------------
DROP TABLE IF EXISTS `tp_multpic`;
CREATE TABLE `tp_multpic` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `style` varchar(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `posid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '点击总数',
  `yesterdayviews` int(11) NOT NULL DEFAULT '0' COMMENT '最日',
  `dayviews` int(10) NOT NULL DEFAULT '0' COMMENT '今日点击数',
  `weekviews` int(10) NOT NULL DEFAULT '0' COMMENT '本周访问数',
  `monthviews` int(10) NOT NULL DEFAULT '0' COMMENT '本月访问',
  `viewsupdatetime` int(10) NOT NULL DEFAULT '0' COMMENT '点击数更新时间',
  `multpic` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`weekviews`,`views`,`dayviews`,`monthviews`,`status`,`id`),
  KEY `thumb` (`thumb`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_multpic
-- ----------------------------

-- ----------------------------
-- Table structure for tp_multpic_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_multpic_data`;
CREATE TABLE `tp_multpic_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_multpic_data
-- ----------------------------

-- ----------------------------
-- Table structure for tp_operationlog
-- ----------------------------
DROP TABLE IF EXISTS `tp_operationlog`;
CREATE TABLE `tp_operationlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `uid` smallint(6) NOT NULL COMMENT '操作帐号ID',
  `time` int(10) NOT NULL COMMENT '操作时间',
  `ip` char(20) NOT NULL DEFAULT '' COMMENT 'IP',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0错误提示，1为正确提示',
  `info` text NOT NULL COMMENT '其他说明',
  `get` varchar(255) NOT NULL COMMENT 'get数据',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `username` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='后台操作日志表';

-- ----------------------------
-- Records of tp_operationlog
-- ----------------------------
INSERT INTO `tp_operationlog` VALUES ('1', '0', '1471583673', '127.0.0.1', '0', '提示语：用户名或者密码错误，登陆失败！<br/>模块：Admin,控制器：Public,方法：tologin<br/>请求方式：POST', 'http://myshop.local.com/shopadmin.php?m=Public&a=login');
INSERT INTO `tp_operationlog` VALUES ('2', '0', '1471583682', '127.0.0.1', '0', '提示语：用户名或者密码错误，登陆失败！<br/>模块：Admin,控制器：Public,方法：tologin<br/>请求方式：POST', 'http://myshop.local.com/shopadmin.php?m=Public&a=login');
INSERT INTO `tp_operationlog` VALUES ('3', '0', '1471583733', '127.0.0.1', '0', '提示语：用户名或者密码错误，登陆失败！<br/>模块：Admin,控制器：Public,方法：tologin<br/>请求方式：POST', 'http://myshop.local.com/shopadmin.php?m=Public&a=login');
INSERT INTO `tp_operationlog` VALUES ('4', '3', '1471583795', '127.0.0.1', '1', '提示语：注销成功！<br/>模块：Admin,控制器：Public,方法：logout<br/>请求方式：GET', 'http://myshop.local.com/shopadmin.php');
INSERT INTO `tp_operationlog` VALUES ('5', '0', '1471583803', '127.0.0.1', '0', '提示语：用户名或者密码错误，登陆失败！<br/>模块：Admin,控制器：Public,方法：tologin<br/>请求方式：POST', 'http://myshop.local.com/shopadmin.php?m=Public&a=login');
INSERT INTO `tp_operationlog` VALUES ('6', '0', '1471583817', '127.0.0.1', '0', '提示语：用户名或者密码错误，登陆失败！<br/>模块：Admin,控制器：Public,方法：tologin<br/>请求方式：POST', 'http://myshop.local.com/shopadmin.php?m=Public&a=login');
INSERT INTO `tp_operationlog` VALUES ('7', '1', '1471583955', '127.0.0.1', '1', '提示语：注销成功！<br/>模块：Admin,控制器：Public,方法：logout<br/>请求方式：GET', 'http://myshop.local.com/shopadmin.php');
INSERT INTO `tp_operationlog` VALUES ('8', '1', '1471584542', '127.0.0.1', '1', '提示语：注销成功！<br/>模块：Admin,控制器：Public,方法：logout<br/>请求方式：GET', 'http://myshop.local.com/admin.php');

-- ----------------------------
-- Table structure for tp_page
-- ----------------------------
DROP TABLE IF EXISTS `tp_page`;
CREATE TABLE `tp_page` (
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `title` varchar(160) NOT NULL COMMENT '标题',
  `style` varchar(24) NOT NULL COMMENT '样式',
  `keywords` varchar(40) NOT NULL COMMENT '关键字',
  `content` text NOT NULL COMMENT '内容',
  `template` varchar(30) NOT NULL,
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`catid`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='单页内容表';

-- ----------------------------
-- Records of tp_page
-- ----------------------------

-- ----------------------------
-- Table structure for tp_photo
-- ----------------------------
DROP TABLE IF EXISTS `tp_photo`;
CREATE TABLE `tp_photo` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` char(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `style` char(24) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumb` char(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keywords` char(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` char(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `posid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '点击总数',
  `yesterdayviews` int(11) NOT NULL DEFAULT '0' COMMENT '最日',
  `dayviews` int(10) NOT NULL DEFAULT '0' COMMENT '今日点击数',
  `weekviews` int(10) NOT NULL DEFAULT '0' COMMENT '本周访问数',
  `monthviews` int(10) NOT NULL DEFAULT '0' COMMENT '本月访问',
  `viewsupdatetime` int(10) NOT NULL DEFAULT '0' COMMENT '点击数更新时间',
  `prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`weekviews`,`views`,`dayviews`,`monthviews`,`status`,`id`),
  KEY `thumb` (`thumb`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_photo
-- ----------------------------

-- ----------------------------
-- Table structure for tp_photo_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_photo_data`;
CREATE TABLE `tp_photo_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `template` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `imgs` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tp_photo_data
-- ----------------------------

-- ----------------------------
-- Table structure for tp_position
-- ----------------------------
DROP TABLE IF EXISTS `tp_position`;
CREATE TABLE `tp_position` (
  `posid` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '推荐位id',
  `modelid` char(30) DEFAULT '0' COMMENT '模型id',
  `catid` char(30) DEFAULT '0' COMMENT '栏目id',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '推荐位名称',
  `maxnum` smallint(5) NOT NULL DEFAULT '20' COMMENT '最大存储数据量',
  `extention` char(100) DEFAULT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`posid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='推荐位';

-- ----------------------------
-- Records of tp_position
-- ----------------------------
INSERT INTO `tp_position` VALUES ('1', '0', '0', '首页幻灯片', '10', null, '0');
INSERT INTO `tp_position` VALUES ('2', '0', '0', '首页文字头条', '10', null, '0');
INSERT INTO `tp_position` VALUES ('3', '0', '0', '首页站长推荐', '10', null, '0');

-- ----------------------------
-- Table structure for tp_position_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_position_data`;
CREATE TABLE `tp_position_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'ID',
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `posid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位ID',
  `module` char(20) DEFAULT NULL COMMENT '模型',
  `modelid` smallint(6) unsigned DEFAULT '0' COMMENT '模型ID',
  `thumb` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否有缩略图',
  `data` mediumtext COMMENT '数据信息',
  `listorder` mediumint(8) DEFAULT '0' COMMENT '排序',
  `expiration` int(10) NOT NULL,
  `extention` char(30) DEFAULT NULL,
  `synedit` tinyint(1) DEFAULT '0' COMMENT '是否同步编辑',
  KEY `posid` (`posid`),
  KEY `listorder` (`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='推荐位数据表';

-- ----------------------------
-- Records of tp_position_data
-- ----------------------------

-- ----------------------------
-- Table structure for tp_role
-- ----------------------------
DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE `tp_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '角色名称',
  `parentid` smallint(6) NOT NULL COMMENT '父角色ID',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  `listorder` int(3) NOT NULL DEFAULT '0' COMMENT '排序字段',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色信息列表';

-- ----------------------------
-- Records of tp_role
-- ----------------------------
INSERT INTO `tp_role` VALUES ('1', '超级管理员', '0', '1', '拥有网站最高管理员权限！', '1329633709', '1329633709', '0');
INSERT INTO `tp_role` VALUES ('2', '站点管理员', '1', '1', '站点管理员', '1329633722', '1399780945', '0');
INSERT INTO `tp_role` VALUES ('3', '发布人员', '2', '1', '发布人员', '1329633733', '1399798954', '0');

-- ----------------------------
-- Table structure for tp_tags
-- ----------------------------
DROP TABLE IF EXISTS `tp_tags`;
CREATE TABLE `tp_tags` (
  `tagid` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'tagID',
  `tag` char(20) NOT NULL COMMENT 'tag名称',
  `style` char(5) NOT NULL COMMENT '附加状态码',
  `usetimes` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '信息总数',
  `lastusetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后使用时间',
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `lasthittime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最近访问时间',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`tagid`),
  UNIQUE KEY `tag` (`tag`),
  KEY `usetimes` (`usetimes`,`listorder`),
  KEY `hits` (`hits`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='tags主表';

-- ----------------------------
-- Records of tp_tags
-- ----------------------------

-- ----------------------------
-- Table structure for tp_tags_content
-- ----------------------------
DROP TABLE IF EXISTS `tp_tags_content`;
CREATE TABLE `tp_tags_content` (
  `tag` char(20) NOT NULL COMMENT 'tag名称',
  `url` varchar(255) DEFAULT NULL COMMENT '信息地址',
  `title` varchar(80) DEFAULT NULL COMMENT '标题',
  `modelid` tinyint(3) unsigned NOT NULL COMMENT '模型ID',
  `contentid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '信息ID',
  `catid` smallint(5) unsigned NOT NULL COMMENT '栏目ID',
  `updatetime` int(11) unsigned NOT NULL COMMENT '更新时间',
  KEY `modelid` (`modelid`,`contentid`),
  KEY `tag` (`tag`(10))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='tags数据表';

-- ----------------------------
-- Records of tp_tags_content
-- ----------------------------

-- ----------------------------
-- Table structure for tp_teacher
-- ----------------------------
DROP TABLE IF EXISTS `tp_teacher`;
CREATE TABLE `tp_teacher` (
  `teacherid` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'tagID',
  `teacher` char(20) NOT NULL COMMENT 'tag名称',
  `style` char(5) NOT NULL COMMENT '附加状态码',
  `usetimes` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '信息总数',
  `lastusetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后使用时间',
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `lasthittime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最近访问时间',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`teacherid`),
  UNIQUE KEY `tag` (`teacher`),
  KEY `usetimes` (`usetimes`,`listorder`),
  KEY `hits` (`hits`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='tags主表';

-- ----------------------------
-- Records of tp_teacher
-- ----------------------------

-- ----------------------------
-- Table structure for tp_terms
-- ----------------------------
DROP TABLE IF EXISTS `tp_terms`;
CREATE TABLE `tp_terms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `parentid` smallint(5) NOT NULL COMMENT '父ID',
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT '分类名称',
  `module` varchar(200) NOT NULL DEFAULT '' COMMENT '所属模块',
  `setting` mediumtext NOT NULL COMMENT '相关配置信息',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `module` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of tp_terms
-- ----------------------------

-- ----------------------------
-- Table structure for tp_urlrule
-- ----------------------------
DROP TABLE IF EXISTS `tp_urlrule`;
CREATE TABLE `tp_urlrule` (
  `urlruleid` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id',
  `module` varchar(15) NOT NULL COMMENT '所属模块',
  `file` varchar(20) NOT NULL COMMENT '所属文件',
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '生成静态规则 1 静态',
  `urlrule` varchar(255) NOT NULL COMMENT 'url规则',
  `example` varchar(255) NOT NULL COMMENT '示例',
  PRIMARY KEY (`urlruleid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_urlrule
-- ----------------------------
INSERT INTO `tp_urlrule` VALUES ('1', 'content', 'category', '0', 'index.php?a=lists&catid={$catid}|index.php?a=lists&catid={$catid}&page={$page}', '动态：index.php?a=lists&catid=1&page=1');
INSERT INTO `tp_urlrule` VALUES ('2', 'content', 'category', '1', '{$categorydir}{$catdir}/index.shtml|{$categorydir}{$catdir}/index_{$page}.shtml', '静态：news/china/1000.shtml');
INSERT INTO `tp_urlrule` VALUES ('3', 'content', 'show', '1', '{$year}/{$catdir}_{$month}/{$id}.shtml|{$year}/{$catdir}_{$month}/{$id}_{$page}.shtml', '静态：2010/catdir_07/1_2.shtml');
INSERT INTO `tp_urlrule` VALUES ('4', 'content', 'show', '0', 'index.php?a=shows&catid={$catid}&id={$id}|index.php?a=shows&catid={$catid}&id={$id}&page={$page}', '动态：index.php?m=Index&a=shows&catid=1&id=1');
INSERT INTO `tp_urlrule` VALUES ('5', 'content', 'category', '1', 'news/{$catid}.shtml|news/{$catid}-{$page}.shtml', '静态：news/1.shtml');
INSERT INTO `tp_urlrule` VALUES ('6', 'content', 'category', '0', 'list-{$catid}.html|list-{$catid}-{$page}.html', '伪静态：list-1-1.html');
INSERT INTO `tp_urlrule` VALUES ('7', 'content', 'tags', '0', 'index.php?a=tags&amp;tagid={$tagid}|index.php?a=tags&amp;tagid={$tagid}&amp;page={$page}', '动态：index.php?a=tags&amp;tagid=1');
INSERT INTO `tp_urlrule` VALUES ('8', 'content', 'tags', '0', 'index.php?a=tags&amp;tag={$tag}|/index.php?a=tags&amp;tag={$tag}&amp;page={$page}', '动态：index.php?a=tags&amp;tag=标签');
INSERT INTO `tp_urlrule` VALUES ('9', 'content', 'tags', '0', 'tag-{$tag}.html|tag-{$tag}-{$page}.html', '伪静态：tag-标签.html');
INSERT INTO `tp_urlrule` VALUES ('10', 'content', 'tags', '0', 'tag-{$tagid}.html|tag-{$tagid}-{$page}.html', '伪静态：tag-1.html');
INSERT INTO `tp_urlrule` VALUES ('11', 'content', 'index', '1', 'index.html|index_{$page}.html', '静态：index_2.html');
INSERT INTO `tp_urlrule` VALUES ('12', 'content', 'index', '0', 'index.html|index_{$page}.html', '伪静态：index_2.html');
INSERT INTO `tp_urlrule` VALUES ('13', 'content', 'index', '0', 'index.php|index.php?page={$page}', '动态：index.php?page=2');
INSERT INTO `tp_urlrule` VALUES ('14', 'content', 'category', '1', 'download.shtml|download_{$page}.shtml', '静态：download.shtml');
INSERT INTO `tp_urlrule` VALUES ('15', 'content', 'show', '1', '{$categorydir}{$id}.shtml|{$categorydir}{$id}_{$page}.shtml', '静态：/父栏目/1.shtml');
INSERT INTO `tp_urlrule` VALUES ('16', 'content', 'show', '1', '{$catdir}/{$id}.shtml|{$catdir}/{$id}_{$page}.shtml', '示例：/栏目/1.html');

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `nickname` varchar(50) NOT NULL COMMENT '昵称/姓名',
  `password` char(32) NOT NULL COMMENT '密码',
  `bind_account` varchar(50) NOT NULL COMMENT '绑定帐户',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  `last_login_ip` varchar(40) NOT NULL COMMENT '上次登录IP',
  `verify` varchar(32) NOT NULL COMMENT '证验码',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `role_id` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '对应角色ID',
  `info` text NOT NULL COMMENT '信息',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('1', 'admin', '超管', '79af6a945b9fcdfe2b2f34300e7ca631', '', '1471584547', '127.0.0.1', 'CsjNAh', '535201470@qq.com', '备注信息', '1431313856', '1462765536', '1', '1', '');
INSERT INTO `tp_user` VALUES ('3', 'lp', 'lp', '9060685ef5e1f96040aa1c08c0fc48ac', '', '1471583779', '127.0.0.1', 'eNgYqq', '535201470@qq.com', '', '1442453190', '1462767708', '1', '1', '');
