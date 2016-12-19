<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 微信平台，插件管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

use Common\Controller\AdminBase;

class AddonsController extends AdminBase {

    //数据对象
    private $db;

    //初始化
    protected function _initialize() {
        parent::_initialize();
        $this->db = D('Wechat/Addons');
    }

    //插件列表
    public function index() {
        $addons = $this->db->getAddonList();
        $this->assign('addons', $addons);
        $this->display();
    }

    //插件安装
    public function install() {
        //插件名称
        $addonName = trim(I('get.addonename'));
        if (empty($addonName)) {
            $this->error('请选择需要安装的插件！');
        }
        if ($this->db->installAddon($addonName)) {
            $this->success('插件安装成功！', U('Addons/index'));
        } else {
            $error = $this->db->getError();
            $this->error($error ? : '插件安装失败！');
        }
    }

    //插件卸载
    public function uninstall() {
        //插件名称
        $addonId = trim(I('get.id'));
        if (empty($addonId)) {
            $this->error('请选择需要卸载的插件！');
        }
        if ($this->db->uninstallAddon($addonId)) {
            $this->success('插件卸载成功！', U('Addons/index'));
        } else {
            $error = $this->db->getError();
            $this->error($error ? : '插件卸载失败！');
        }
    }

    //状态转换
    public function status() {
        //插件名称
        $addonId = trim(I('get.id'));
        if (empty($addonId)) {
            $this->error('请选择需要操作的插件！');
        }
        if ($this->db->statusAddon($addonId)) {
            $this->success('插件状态成功！', U('Addons/index'));
        } else {
            $error = $this->db->getError();
            $this->error($error ? : '插件状态失败！');
        }
    }

    //本地安装
    public function local() {
        if (IS_POST) {
            if (!$_FILES['file']) {
                $this->error("请选择上传文件！");
            }
            //上传临时文件地址
            $filename = $_FILES['file']['tmp_name'];
            if (strtolower(substr($_FILES['file']['name'], -3, 3)) != 'zip') {
                $this->error("上传的文件格式有误！");
            }
            //插件目录
            $addonsDir = $this->db->getAddonsPath();
            //检查插件目录是否存在
            if (!file_exists($addonsDir)) {
                //创建
                if (mkdir($addonsDir, 0777, true) == false) {
                    $this->error('插件目录' . $addonsDir . '创建失败！');
                }
            }
            //检查插件目录可写权限
            if (is_writeable($addonsDir) === false) {
                $this->error('插件目录' . $addonsDir . '不可写！');
            }
            //插件名称
            $addonName = pathinfo($_FILES['file']['name']);
            $addonName = $addonName['filename'];
            //检查插件目录是否存在
            if (file_exists($addonsDir . $addonName)) {
                $this->error('该插件目录已经存在！');
            }
            C('TOKEN_ON', false);
            $data = array('name' => $addonName);
            $data = $this->db->create($data, 1);
            if (!$data) {
                $this->error($this->db->getError());
            }
            $zip = new \PclZip($filename);
            $status = $zip->extract(PCLZIP_OPT_PATH, $addonsDir . $addonName);
            if ($status) {
                $this->success('插件解压成功，可以进入插件管理进行安装！', U('Addons/index'));
            } else {
                $this->error('插件解压失败！');
            }
        } else {
            $this->display();
        }
    }

    //打包下载
    public function unpack() {
        $addonName = I('get.addonname');
        if (empty($addonName)) {
            $this->error('请选择需要打包的插件！');
        }
        //插件目录
        $addonsDir = $this->db->getAddonsPath() . "{$addonName}/";
        $basename = $addonName . '.zip';
        $file = RUNTIME_PATH . $basename;
        //创建压缩包
        $zip = new \PclZip($file);
        $path = explode(':', $addonsDir);
        $zip->create($addonsDir, PCLZIP_OPT_REMOVE_PATH, $path[1] ? $path[1] : $path[0]);

        //获取用户客户端UA，用来处理中文文件名
        $ua = $_SERVER["HTTP_USER_AGENT"];
        //从下载文件地址中获取的后缀
        $fileExt = fileext(basename($file));
        //下载文件名后缀
        $baseNameFileExt = fileext($basename);
        if (preg_match("/MSIE/", $ua)) {
            $filename = iconv("UTF-8", "GB2312//IGNORE", $baseNameFileExt ? $basename : ($basename . "." . $fileExt));
        } else {
            $filename = $baseNameFileExt ? $basename : ($basename . "." . $fileExt);
        }
        header("Content-type: application/octet-stream");
        $encoded_filename = urlencode($filename);
        $encoded_filename = str_replace("+", "%20", $encoded_filename);
        if (preg_match("/MSIE/", $ua)) {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
        } else if (preg_match("/Firefox/", $ua)) {
            header("Content-Disposition: attachment; filename*=\"utf8''" . $filename . '"');
        } else {
            header('Content-Disposition: attachment; filename="' . $filename . '"');
        }
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Content-Length: " . filesize($file));
        readfile($file);
    }

}
