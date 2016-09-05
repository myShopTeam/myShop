<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 团购管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.qcjh.net, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Shop\Controller;

use Common\Controller\AdminBase;

class BulkController extends AdminBase
{

    protected function _initialize()
    {
        parent::_initialize();
    }

    //团购活动列表
    public function bulk_index()
    {
        $db = M('goods_member');
        $count = $db->count();
        $page = $this->page($count, 10);
        $vipList = $db->limit($page->firstRow . ',' . $page->listRows)->order('listorder desc,vip_id desc')->select();
        foreach ($vipList as $k => $v) {
            $vipList[$k]['status'] = $v['status'] == 0 ? '冻结' : '正常';
        }
        $this->assign("Page", $page->show());
        $this->assign("vipList", $vipList);
        $this->display();
    }

    //添加团购活动
    public function bulk_add()
    {
        if (IS_POST) {
            $data = array(
                'username' => I('post.username', '', trim),
                'nickname' => I('post.nickname', '', trim),
                'realname' => I('post.realname', '', trim),
                'headpic' => I('post.headpic', '', trim),
                'email' => I('post.email', '', trim),
                'birthday' => I('post.birthday', '', trim),
                'qq' => I('post.qq', '', trim),
                'phone' => I('post.phone', '', trim),
                'mobile' => I('post.mobile', '', trim),
                'sex' => I('post.sex', '', trim),
                'status' => I('post.status', 1, intval),
                'createtime' => time()
            );
            $password = I('post.password', '', trim);
            $checkPassword = I('post.checkPassword', '', trim);
            //密码加密规则 md5(md5(密码).随机字符串)
            if ($password == $checkPassword) {
                $data['verif'] = $this->getVerif(4);
                $data['password'] = md5(md5($password) . $data['verif']);
            } else {
                $this->error('2次输入密码不一样');
            }
            if (empty($data['username'])) {
                $this->error('帐号不能为空');
            }
            //检测是否重名
            $checkUser = M('goods_member')->where(array('username' => $data['username']))->find();
            if ($checkUser) {
                $this->error('此账户名已被占用');
            } else {
                $vip_id = M('goods_member')->add($data);
            }
            if ($vip_id) {
                $this->success('会员添加成功', U('Member/vip_index'));
            } else {
                $this->error('会员添加失败');
            }
        } else {
            //选择团购商品
            $goodsList = M('goods')->where(array('is_show' => 1))->select();

            $this->assign('goodsList', $goodsList);
            $this->display();
        }
    }

    //修改团购活动
    public function bulk_edit()
    {
        $vip_id = I('get.vip_id', '', intval);
        if (IS_POST) {
            $data = array(
                'username' => I('post.username', '', trim),
                'nickname' => I('post.nickname', '', trim),
                'realname' => I('post.realname', '', trim),
                'headpic' => I('post.headpic', '', trim),
                'email' => I('post.email', '', trim),
                'birthday' => I('post.birthday', '', trim),
                'qq' => I('post.qq', '', trim),
                'phone' => I('post.phone', '', trim),
                'mobile' => I('post.mobile', '', trim),
                'sex' => I('post.sex', '', trim),
                'status' => I('post.status', 1, intval),
                'createtime' => time()
            );
            $password = I('post.password', '', trim);
            $checkPassword = I('post.checkPassword', '', trim);
            //修改资料 密码为空默认不修改密码
            if (!empty($password)) {
                //密码加密规则 md5(md5(密码).随机字符串)
                if ($password == $checkPassword) {
                    $data['verif'] = $this->getVerif(4);
                    $data['password'] = md5(md5($password) . $data['verif']);
                } else {
                    $this->error('2次输入密码不一样');
                }
            }
            if (empty($data['username'])) {
                $this->error('帐号不能为空');
            }
            //检测是否重名
            $checkUser = M('goods_member')->where(array('username' => $data['username'], 'vip_id' => array('neq', $vip_id)))->find();
            if ($checkUser) {
                $this->error('此账户名已被占用');
            } else {
                $bool = M('goods_member')->where(array('vip_id' => $vip_id))->save($data);
            }
            if ($bool) {
                //当账户被冻结后 旗下所有商品全部下架
                if ($data['status'] == 0) {
                    M('goods')->where(array('vipId' => $vip_id))->save(array('is_show' => 0));
                }
                $this->success('会员修改成功', U('Member/vip_index'));
            } else {
                $this->error('资料没有改变');
            }
        } else {
            $vipList = M('goods_member')->where(array('vip_id' => $vip_id))->find();
            $this->assign($vipList);
            $this->display();
        }
    }

    //团购活动删除
    public function bulk_delete()
    {
        if (IS_POST) {
            $vipArr = I('post.');
            if (is_array($vipArr)) {
                foreach ($vipArr['id'] as $k => $v) {
                    $vipidArr[] = $v;
                }
                $bool = M('goods_member')->where(array('vip_id' => array('IN', $vipidArr)))->delete();
                if ($bool) {
                    M('goods')->where(array('vipId' => array('IN', $vipidArr)))->delete();
                    $this->success("删除成功", U('Member/vip_index'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $vipid = I('get.vip_id', '', intval);
            $bool = M('goods_member')->where(array('vip_id' => $vipid))->delete();
            if ($bool) {
                M('goods')->where(array('vipId' => $vipid))->delete();
                $this->success("删除成功", U('Member/vip_index'));
            } else {
                $this->error("非法操作");
            }
        }
        $this->display();
    }

    //排序
    public function listorder()
    {
        $info = I('post.', '', trim);
        $id = 'id';
        switch (I('get.str', '', trim)) {
            case "vip":
                $db = M('goods_member');
                $a = 'Member/vip_index';
                $id = 'vip_id';
                break;
        }
        foreach ($info['id'] as $k => $v) {
            $db->where(array($id => $v))->save(array('listorder' => $info['listorder'][$v]));
        }
        // p($info);
        $this->success('排序成功！', U($a));
    }

    //随机生成N位数字和字符串
    public function getVerif($len, $chars = null)
    {
        if (is_null($chars)) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        mt_srand(10000000 * (double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }
}
