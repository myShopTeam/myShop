<?php

// +----------------------------------------------------------------------
// | ShuipFCMS Wechat后台管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

use Common\Controller\AdminBase;

class WechatController extends AdminBase {

    //配置
    protected $config = array();
    //数据对象
    private $db;

    //初始化
    protected function _initialize() {
        parent::_initialize();
        $this->config = cache("WechatConfig");
        $this->db = D('Wechat/Wechat');
    }

    //微信设置
    public function config() {
        if (IS_POST) {
            if ($this->db->wechat_config(I('post.config'))) {
                $this->success('配置更新成功！');
            } else {
                $this->error('更新失败！');
            }
        } else {
            //接口URL
            if (empty($this->config['api_url'])) {
                $this->config['api_url'] = U('Wechat/Api/index');
            }
            $this->assign('config', $this->config);
            $this->display();
        }
    }

    //菜单管理
    public function menu() {
        if (IS_POST) {
            if ($this->db->saveMenu($_POST['button'])) {
                $this->success('菜单项已经更新！');
            } else {
                $this->error($this->db->getError() ? : '菜单更新失败！');
            }
        } else {
            //检查是否已经填写
            if (empty($this->config['appid']) || empty($this->config['appsecret'])) {
                $this->error('您还没有填写微信平台接口信息！', U('config'));
            }
            $this->assign('button', $this->config['button']);
            $this->display();
        }
    }

    //消息回复规则
    public function reply() {
        //检查是否已经填写
        if (empty($this->config['appid']) || empty($this->config['appsecret'])) {
            $this->error('您还没有填写微信平台接口信息！', U('config'));
        }
        $list = $this->db->order(array('id' => 'DESC'))->select();
        $this->assign('list', $list);
        $this->display();
    }

    //添加新规则
    public function add() {
        if (IS_POST) {
            if ($this->db->wechatAdd($_POST)) {
                $this->success('添加成功！', U('reply'));
            } else {
                $error = $this->db->getError();
                $this->error($error ? : '添加失败！');
            }
        } else {
            //检查是否已经填写
            if (empty($this->config['appid']) || empty($this->config['appsecret'])) {
                $this->error('您还没有填写微信平台接口信息！', U('config'));
            }
            $addonsList = $this->db->getAddonsList();
            $this->assign('addonsList', $addonsList);
            $this->display();
        }
    }

    //编辑规则
    public function edit() {
        if (IS_POST) {
            if ($this->db->wechatEdit($_POST)) {
                $this->success('编辑成功！', U('reply'));
            } else {
                $error = $this->db->getError();
                $this->error($error ? $error : '编辑失败！');
            }
        } else {
            $id = I('get.id', 0, 'intval');
            if (empty($id)) {
                $this->error('请指定需要编辑的规则！');
            }
            //详细信息
            $info = $this->db->where(array('id' => $id))->find();
            if (empty($info)) {
                $this->error('该规则不存在！');
            }
            $addonsList = $this->db->getAddonsList();
            $this->assign('info', $info);
            $this->assign('addonsList', $addonsList);
            $this->display();
        }
    }

    //删除回复规则
    public function delete() {
        $id = I('get.id', 0, 'intval');
        if (empty($id)) {
            $this->error('请指定需要删除的规则！');
        }
        if ($this->db->wechatDelete($id)) {
            $this->success('删除成功！', U('reply'));
        } else {
            $error = $this->db->getError();
            $this->error($error ? : '删除失败！');
        }
    }

    //状态转换
    public function status() {
        $id = I('get.id', 0, 'intval');
        if (empty($id)) {
            $this->error('请指定需要删除的规则！');
        }
        //详细信息
        $info = $this->db->where(array('id' => $id))->find();
        if (empty($info)) {
            $this->error('该规则不存在！');
        }
        $status = $info['status'] ? 0 : 1;
        if ($this->db->where(array('id' => $id))->save(array('status' => $status)) !== false) {
            //更新缓存
            $this->db->wechatReplyCache();
            $this->success('状态转换成功！', U('reply'));
        } else {
            $this->error('操作失败！');
        }
    }

    //日志管理
    public function log() {
        $db = D('Wechat/WechatLog');
        //操作
        $act = I('get.act', 0, 'trim');
        if ($act) {
            //删除一个月前的数据
            if ($act == 'delete') {
                if ($db->deleteMonth()) {
                    $this->success('删除成功！');
                    return true;
                } else {
                    $this->error('删除失败！');
                }
            }
        }
        //条件
        $where = array();
        $keyword = I('get.keyword', '', 'trim');
        $field = I('get.field', 0, 'intval');
        if ($keyword && $field) {
            switch ($field) {
                case 1:
                    $where['id'] = $keyword;
                    break;
                case 2:
                    $where['tousername'] = $keyword;
                    break;
                case 3:
                    $where['fromusername'] = $keyword;
                    break;
                case 4:
                    $where['addons'] = $keyword;
                    break;
            }
            $this->assign('field', $field)->assign('keyword', $keyword);
        }
        //总数
        $count = $db->where($where)->count();
        $page = $this->page($count, 20);
        $data = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "DESC"))->select();
        $this->assign("Page", $page->show('Admin'));
        $this->assign('data', $data);
        $this->display();
    }

    //获取插件的setting配置
    public function public_setting() {
        //插件名
        $name = I('name', '', 'trim');
        //实例化插件
        $obj = D('Wechat/Addons')->getObject($name);
        if(!is_object($obj)){
            return false;
        }
        //检查是否有setting方法
        if (method_exists($obj, 'setting')) {
            $id = I('get.id', 0, 'intval');
            $setting = array();
            if ($id) {
                $info = $this->db->where(array('id' => $id))->find();
                $setting = unserialize($info['setting']);
            }
            exit($obj->setting($setting));
        } else {
            return false;
        }
    }

}
