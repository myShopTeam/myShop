<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 会员管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.qcjh.net, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Shop\Controller;

use Common\Controller\AdminBase;

class MemberController extends AdminBase
{

    protected function _initialize()
    {
        parent::_initialize();
    }

    //会员列表
    public function vip_index()
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

    //添加会员
    public function vip_add()
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
                'status' => I('post.status', 1, trim),
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
            //检测帐号是否重名
            $checkUser = M('goods_member')->where(array('username' => $data['username']))->find();

            if (!empty($data['nickname'])) {
                //检测昵称是否重名
                $checkNick = M('goods_member')->where(array('username' => $data['nickname']))->find();
                if ($checkNick) {
                    $this->error('此昵称已被占用');
                }
            }
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
            $this->display();
        }
    }

    //修改会员信息
    public function vip_edit()
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
                'status' => I('post.status', 1, trim),
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

    //会员删除
    public function vip_delete()
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
    }

    //校友分类
    public function alumni_index()
    {
        $db = M('goods_alumni');
        $count = $db->count();
        $page = $this->page($count, 10);
        $list = $db->limit($page->firstRow . ',' . $page->listRows)->order('listorder desc , alumni_id desc')->select();

        $this->assign('list', $list);
        $this->assign('Page', $page->show());
        $this->display();
    }

    public function alumni_add()
    {
        if (IS_POST) {
            $data['alumni_name'] = I('post.alumni_name', '', trim);
            $data['is_show'] = I('post.is_show', 1, intval);
            $data['addtime'] = time();
            //检测是否存在校友分类
            $checkAlumni = M('goods_alumni')->where(array('alumni_name' => $data['alumni_name']))->find();
            if ($checkAlumni) {
                $this->error('已存在此分类');
            } else {
                $alumni_id = M('goods_alumni')->add($data);
                if ($alumni_id) {
                    $this->success('添加成功', U('alumni_index'));
                } else {
                    $this->error('添加失败');
                }
            }
        }
        $this->display();
    }

    public function alumni_edit()
    {
        $aid = I('get.aid', '', intval);
        if (IS_POST) {
            $data['alumni_name'] = I('post.alumni_name', '', trim);
            $data['is_show'] = I('post.is_show', 1, intval);
            //检测是否存在校友分类
            $checkAlumni = M('goods_alumni')->where(array('alumni_name' => $data['alumni_name'], 'alumni_id' => array('neq', $aid)))->find();
            if ($checkAlumni) {
                $this->error('已存在此分类');
            } else {
                $bool = M('goods_alumni')->where(array('alumni_id' => $aid))->save($data);
                if ($bool) {
                    $this->success('修改成功', U('alumni_index'));
                } else {
                    $this->error('修改失败');
                }
            }
            exit;
        }
        $info = M('goods_alumni')->where(array('alumni_id' => $aid))->find();

        $this->assign($info);
        $this->display();
    }

    public function alumni_delete()
    {
        if (IS_POST) {
            $alumniArr = I('post.');
            if (is_array($alumniArr)) {
                foreach ($alumniArr['id'] as $k => $v) {
                    $aidArr[] = $v;
                }
                $bool = M('goods_alumni')->where(array('alumni_id' => array('IN', $aidArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('Member/alumni_index'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $aid = I('get.aid', '', intval);
            $bool = M('goods_alumni')->where(array('alumni_id' => $aid))->delete();
            if ($bool) {
                $this->success("删除成功", U('Member/alumni_index'));
            } else {
                $this->error("非法操作");
            }
        }
    }

    //校友管理
    public function alumni_supervise()
    {
        $db = M('goods_school');
        $count = $db->count();
        $page = $this->page($count, 10);
        $list = $db->alias('a')->field('a.*,b.alumni_name')->join('tp_goods_alumni b ON a.alumni_id=b.alumni_id')->limit($page->firstRow . ',' . $page->listRows)->order('a.listorder desc , a.id desc')->select();
// p($db->getLastSql());
        $this->assign('list', $list);
        $this->assign('Page', $page->show());
        $this->display();
    }

    //添加校友
    public function supervise_add()
    {
        if (IS_POST) {
            $alumni_id = I('post.alumni_id', '', intval);
            $school_name = I('post.school_name', '', trim);
            if (!$alumni_id) {
                $this->error('请选择校友分类');
            }
            if (!$school_name) {
                $this->error('请填写校友名称');
            }
            $data = array(
                'alumni_id' => $alumni_id,
                'school_name' => $school_name,
            );
            $id = M('goods_school')->add($data);
            if ($id) {
                $this->success('添加成功', U('alumni_supervise'));
            } else {
                $this->error('添加失败');
            }
        }
        $list = M('goods_alumni')->order('listorder desc,alumni_id desc')->select();

        $this->assign('list', $list);
        $this->display();
    }

    //修改校友信息
    public function supervise_edit()
    {
        $sid = I('get.sid', '', intval);
        if (IS_POST) {
            $alumni_id = I('post.alumni_id', '', intval);
            $school_name = I('post.school_name', '', trim);
            if (!$alumni_id) {
                $this->error('请选择校友分类');
            }
            if (!$school_name) {
                $this->error('请填写校友名称');
            }
            $data = array(
                'alumni_id' => $alumni_id,
                'school_name' => $school_name,
            );
            $bool = M('goods_school')->where(array('id' => $sid))->save($data);
            if ($bool) {
                $this->success('修改成功', U('alumni_supervise'));
            } else {
                $this->error('修改失败');
            }
        }
        //查询此校友详细信息
        $info = M('goods_school')->where(array('id' => $sid))->find();
        //查询分类
        $list = M('goods_alumni')->order('listorder desc,alumni_id desc')->select();

        $this->assign('list', $list);
        $this->assign($info);
        $this->display();
    }

    //删除校友
    public function supervise_del()
    {
        if (IS_POST) {
            $schoolArr = I('post.');
            if (is_array($schoolArr)) {
                foreach ($schoolArr['id'] as $k => $v) {
                    $sidArr[] = $v;
                }
                $bool = M('goods_school')->where(array('id' => array('IN', $sidArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('Member/alumni_supervise'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $sid = I('get.sid', '', intval);
            $bool = M('goods_school')->where(array('id' => $sid))->delete();
            if ($bool) {
                $this->success("删除成功", U('Member/alumni_supervise'));
            } else {
                $this->error("非法操作");
            }
        }


    }

    //校友品牌管理
    public function brand_index()
    {
        $db = M('goods_brand');
        $count = $db->count();
        $page = $this->page($count, 10);
        $list = $db->alias('a')->field('a.*,b.school_name')->join('tp_goods_school b ON a.school_id=b.id')->limit($page->firstRow . ',' . $page->listRows)->order('a.listorder desc , a.brand_id desc')->select();
// p($db->getLastSql());

        $this->assign('list', $list);
        $this->assign('Page', $page->show());
        $this->display();
    }

    //校友品牌添加
    public function brand_add()
    {
        if (IS_POST) {
            $school_id = I('post.school_id', '', intval);
            $brand_name = I('post.brand_name', '', trim);
            if (!$school_id) {
                $this->error('请选择校友');
            }
            if (!$brand_name) {
                $this->error('请填写校友品牌');
            }
            $data = array(
                'school_id' => $school_id,
                'brand_name' => $brand_name,
            );
            $id = M('goods_brand')->add($data);
            if ($id) {
                $this->success('添加成功', U('brand_index'));
            } else {
                $this->error('添加失败');
            }
        }
        $list = M('goods_school')->order('listorder desc,id desc')->select();

        $this->assign('list', $list);
        $this->display();
    }

    //校友品牌修改
    public function brand_edit()
    {
        $brand_id = I('get.brand_id', '', intval);
        if (IS_POST) {
            $school_id = I('post.school_id', '', intval);
            $brand_name = I('post.brand_name', '', trim);
            if (!$school_id) {
                $this->error('请选择校友');
            }
            if (!$brand_name) {
                $this->error('请填写品牌名称');
            }
            $data = array(
                'school_id' => $school_id,
                'brand_name' => $brand_name,
            );
            $bool = M('goods_brand')->where(array('brand_id' => $brand_id))->save($data);
            if ($bool) {
                $this->success('修改成功', U('brand_index'));
            } else {
                $this->error('修改失败');
            }
        }
        //查询此校友详细信息
        $info = M('goods_brand')->where(array('brand_id' => $brand_id))->find();
        //查询分类
        $list = M('goods_school')->order('listorder desc,id desc')->select();

        $this->assign('list', $list);
        $this->assign($info);
        $this->display();
    }

    //校友品牌删除
    public function brand_del()
    {
        if (IS_POST) {
            $brandArr = I('post.');
            if (is_array($brandArr)) {
                foreach ($brandArr['id'] as $k => $v) {
                    $bidArr[] = $v;
                }
                $bool = M('goods_brand')->where(array('brand_id' => array('IN', $bidArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('Member/brand_index'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $brand_id = I('get.brand_id', '', intval);
            $bool = M('goods_brand')->where(array('brand_id' => $brand_id))->delete();
            if ($bool) {
                $this->success("删除成功", U('Member/brand_index'));
            } else {
                $this->error("非法操作");
            }
        }


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

            case "school":
                $db = M('goods_school');
                $a = 'Member/alumni_supervise';
                $id = 'id';
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
