<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 插件模型
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Model;

use Common\Model\Model;

class AddonsModel extends Model {

    //数据表
    protected $tableName = 'wechat_addons';
    //插件所处目录路径
    protected $addonsPath = NULL;
    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        array('name', 'require', '插件标识不能为空！', 1, 'regex', 3),
        array('name', '/^[a-zA-Z][a-zA-Z0-9_]+$/i', '插件标识只支持英文、数字、下划线！', 0, 'regex', 3),
        array('name', '', '该插件标识已经存在！', 0, 'unique', 1),
    );
    //自动完成
    protected $_auto = array(
        //array(填充字段,填充内容,填充条件,附加规则)
        array('createtime', 'time', 1, 'function')
    );

    //初始化
    protected function _initialize() {
        parent::_initialize();
        $this->addonsPath = APP_PATH . 'Wechat/Addons/';
    }

    /**
     * 获取插件目录
     * @return type
     */
    public function getAddonsPath() {
        return $this->addonsPath;
    }

    /**
     * 获取插件实例化对象
     * @param type $addonName 插件名称
     * @return boolean 对象
     */
    public function getObject($addonName, $enforce = false) {
        if (empty($addonName)) {
            $this->error = "插件名称不能为空！";
            return false;
        }
        //已安装插件缓存
        $cacheWechatAddons = cache('WechatAddons');
        if (empty($cacheWechatAddons[$addonName]) && $enforce == false) {
            $this->error = '该插件还未安装！';
            return false;
        }
        //获取类名
        $class = "\\Wechat\\Addons\\{$addonName}\\{$addonName}Wechat";
        //导入对应插件
        require_cache($this->addonsPath . "{$addonName}/{$addonName}Wechat.class.php");
        if (!class_exists($class)) {
            $this->error = '插件不存在或者插件入口文件有误！';
            return false;
        }
        return \Think\Think::instance($class);
    }

    /**
     * 安装插件
     * @param type $addonName 插件标识
     * @return boolean
     */
    public function installAddon($addonName) {
        if (empty($addonName)) {
            $this->error = '请选择需要安装的插件！';
            return false;
        }
        //检查插件是否安装
        if ($this->isInstall($addonName)) {
            $this->error = '该插件已经安装，无需重复安装！';
            return false;
        }
        //实例化插件入口类
        $addonObj = $this->getObject($addonName, true);
        if (!is_object($addonObj)) {
            return false;
        }
        //获取插件信息
        $config = $addonObj->config();
        $info = array(
            'name' => $addonName,
            'title' => $config['name'],
            'author' => $config['author'],
            'version' => $config['version'],
        );
        if (empty($info)) {
            $this->error = '插件信息获取失败！';
            return false;
        }
        C('TOKEN_ON', false);
        //插件信息验证
        $data = $this->create($info, 1);
        if (!$data) {
            return false;
        }
        //开始安装
        if (method_exists($addonObj, 'install')) {
            $install = $addonObj->install();
            if ($install !== true) {
                $this->error = $addonObj->getError() ? : '执行插件装操作失败！';
                return false;
            }
        }
        //添加插件安装记录
        $id = $this->add($data);
        if (!$id) {
            $this->error = '写入插件数据失败！';
            return false;
        }
        //数据库安装脚本
        $this->runSQL($addonName, 'install');
        //静态资源文件
        if (file_exists($this->addonsPath . "{$addonName}/Extres/")) {
            $Dir = new \Dir();
            //拷贝模板到前台模板目录中去
            $Dir->copyDir($this->addonsPath . "{$addonName}/Extres/", SITE_PATH . 'statics/extres/wechat/' . strtolower($addonName) . '/');
        }
        //更新缓存
        $this->addons_cache();
        return $id;
    }

    /**
     * 卸载插件
     * @param type $addonId 插件id
     * @return boolean
     */
    public function uninstallAddon($addonId) {
        $addonId = (int) $addonId;
        if (empty($addonId)) {
            $this->error = '请选择需要卸载的插件！';
            return false;
        }
        //获取插件信息
        $info = $this->where(array('id' => $addonId))->find();
        if (empty($info)) {
            $this->error = '该插件不存在！';
            return false;
        }
        //插件标识
        $addonName = $info['name'];
        //检查插件是否安装
        if ($this->isInstall($addonName) == false) {
            $this->error = '该插件未安装，无需卸载！';
            return false;
        }
        //实例化插件入口类
        $addonObj = $this->getObject($addonName, true);
        if (!is_object($addonObj)) {
            $this->error = '获取不到插件对象！';
            return false;
        }
        //卸载插件
        if (method_exists($addonObj, 'uninstall')) {
            $uninstall = $addonObj->uninstall();
            if ($uninstall !== true) {
                $this->error = $addonObj->getError() ? : '执行插件卸载操作失败！';
                return false;
            }
        }
        //删除插件记录
        if (false !== $this->where(array('id' => $addonId))->delete()) {
            //数据库安装脚本
            $this->runSQL($addonName, 'uninstall');
            //删除对应附件
            service("Attachment")->api_delete('addons-' . $addonId);
            //更新缓存
            $this->addons_cache();
            //静态资源移除
            $Dir = new \Dir();
            $Dir->delDir(SITE_PATH . 'statics/extres/wechat/' . strtolower($addonName) . '/');
            return true;
        } else {
            $this->error = '卸载插件失败！';
            return false;
        }
    }

    /**
     * 插件升级
     * @param type $addonName 插件名称
     * @return boolean
     */
    public function upgradeAddon($addonName) {

        return true;
    }

    /**
     * 插件状态转换
     * @param type $addonId 插件ID
     * @return boolean
     */
    public function statusAddon($addonId) {
        $addonId = (int) $addonId;
        if (empty($addonId)) {
            $this->error = '请选择需要卸载的插件！';
            return false;
        }
        //获取插件信息
        $info = $this->where(array('id' => $addonId))->find();
        if (empty($info)) {
            $this->error = '该插件不存在！';
            return false;
        }
        $status = $info['status'] ? 0 : 1;
        if (false !== $this->where(array('id' => $addonId))->save(array('status' => $status))) {
            //更新缓存
            $this->addons_cache();
            return true;
        } else {
            $this->error = '插件状态失败！';
            return false;
        }
    }

    /**
     * 检查插件是否已经安装
     * @param type $name 插件标识
     * @return boolean
     */
    public function isInstall($name) {
        if (empty($name)) {
            return false;
        }
        $count = $this->where(array('name' => $name))->count('id');
        return $count ? true : false;
    }

    /**
     * 获取插件列表
     * @return type
     */
    public function getAddonList() {
        //取得模块目录名称
        $dirs = array_map('basename', glob($this->addonsPath . '*', GLOB_ONLYDIR));
        if ($dirs === FALSE || !file_exists($this->addonsPath)) {
            return false;
        }
        $addons = array();
        //取得已安装插件列表
        $addonsList = $this->where(array('name' => array('in', $dirs)))->select();
        foreach ($addonsList as $addon) {
            $addon['uninstall'] = 0;
            $addons[$addon['name']] = $addon;
        }
        //遍历插件列表
        foreach ($dirs as $value) {
            //是否已经安装过
            if (!isset($addons[$value])) {
                //实例化插件入口类
                $addonObj = $this->getObject($value, true);
                if (!is_object($addonObj)) {
                    continue;
                }
                //获取插件配置
                $config = $addonObj->config();
                $addons[$value] = array(
                    'name' => $value,
                    'title' => $config['name'],
                    'author' => $config['author'],
                    'version' => $config['version'],
                );
                if ($addons[$value]) {
                    $addons[$value]['uninstall'] = 1;
                    unset($addons[$value]['status']);
                }
            }
        }
        return $addons;
    }

    /**
     * 执行数据库脚本
     * @param type $addonName 插件目录
     * @return boolean
     */
    private function runSQL($addonName = '', $sql = 'install') {
        if (empty($addonName)) {
            return true;
        }
        $path = $this->addonsPath . "{$addonName}/{$sql}.sql";
        if (!file_exists($path)) {
            return true;
        }
        $sql = file_get_contents($path);
        $sql = $this->resolveSQL($sql, C("DB_PREFIX"));
        if (!empty($sql) && is_array($sql)) {
            foreach ($sql as $sql_split) {
                M()->execute($sql_split);
            }
        }
        return true;
    }

    /**
     * 分析处理sql语句，执行替换前缀都功能。
     * @param string $sql 原始的sql
     * @param string $tablepre 表前缀
     */
    private function resolveSQL($sql, $tablepre) {
        if ($tablepre != "shuipfcms_")
            $sql = str_replace("shuipfcms_", $tablepre, $sql);
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);
        if ($r_tablepre != $s_tablepre)
            $sql = str_replace($s_tablepre, $r_tablepre, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }

    /**
     * 缓存已安装插件缓存
     * @return type
     */
    public function addons_cache() {
        $return = array();
        $data = $this->where(array('status' => 1))->order(array('id' => 'DESC'))->select();
        if (!empty($data)) {
            foreach ($data as $r) {
                $return[$r['name']] = $r;
            }
        }
        cache('WechatAddons', $return);
        return $return;
    }

}
