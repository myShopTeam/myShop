<?php

// +----------------------------------------------------------------------
// | 后台 商品管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Shop\Controller;

use Common\Controller\AdminBase;

class CategoryController extends AdminBase
{
    public $model;
    public $order;

    protected function _initialize()
    {
        parent::_initialize();
        header("Content-type:text/html;charset=utf-8");
        $this->model = D('Shop/GoodsCategory');
        $this->order = array('listorder' => 'DESC', 'catid' => 'DESC');
        //处理图片上传问题
        $this->disposeUpload();
    }

    //商品分类列表
    public function index()
    {
        $count = $this->model->count();
        $page = $this->page($count, 10);
        $catList = $this->model->limit($page->firstRow . ',' . $page->listRows)->order($this->order)->select();
        $this->assign("Page", $page->show());
        $this->assign("catList", $catList);
        $this->display();
    }

    //商品分类添加
    public function category_add()
    {
        $catid = I('get.catid', '', 'intval');
        if (IS_POST) {
            $data['parent_id'] = I('post.parent_id', 0, 'intval');
            $data['cat_name'] = I('post.cat_name', '');
            $data['cat_img'] = I('post.cat_img', '');
            $data['is_show'] = I('post.is_show', 0, 'intval');
            if (empty($data['cat_name'])) {
                $this->error("请输入分类名称");
            } else {
                $info = $this->model->where(array('cat_name' => $data['cat_name']))->find();
                if (empty($info)) {
                    $catid = $this->model->add($data);
                    if ($catid) {
                        $this->success('添加成功', U('index'));
                    } else {
                        $this->error("非法操作");
                    }
                } else {
                    $this->error("已存在此分类");
                }

            }
        } else {
            $this->assign('catList', $this->model->selectHtmlOption($catid, 'name="parent_id"', 1, "一级分类"));
            $this->display();
        }
    }

    //商品分类修改
    public function category_edit()
    {
        $catid = I('get.catid', '', 'intval');
        if (IS_POST) {
            $data['parent_id'] = I('post.parent_id', 0, 'intval');
            $data['cat_name'] = I('post.cat_name', '');
            $data['cat_img'] = I('post.cat_img', '');
            $data['is_show'] = I('post.is_show', 0, 'intval');
            $checkCat = $this->model->where(array('cat_name' => $data['cat_name'], 'catid' => array('neq', $catid)))->find();
            if ($checkCat) {
                $this->error("已存在此分类");
            } elseif ($data['parent_id'] == $catid) {
                $this->error("不能此分类为父级分类");
            } else {
                $bool = $this->model->where(array('catid' => $catid))->save($data);
                if ($bool) {
                    $this->success("修改成功", U('index'));
                } else {
                    $this->error("非法操作");
                }
            }
            exit;
        }
        $info = $this->model->where(array('catid' => $catid))->find();

        $this->assign('catList', D('Shop/Role')->selectHtmlOption($catid, 'name="parent_id"', 1, "一级分类"));
        $this->assign($info);
        $this->display();
    }

    //商品分类删除
    public function category_delete()
    {
        if (IS_POST) {
            $catArr = I('post.');
            if (is_array($catArr)) {
                foreach ($catArr['id'] as $k => $v) {
                    $checkGoods = M('goods')->where(array('cat_id' => $v))->find();
                    $checkAttr = M('goods_attr')->where(array('cat_id' => $v))->find();
                    if ($checkGoods) {
                        $this->error("此分类下有商品，请删除商品后在删除分类");
                    }
                    if ($checkAttr) {
                        $this->error("此分类下有属性，请删除属性后在删除分类");
                    }
                    $catidArr[] = $v;
                }
                $bool = $this->model->where(array('catid' => array('IN', $catidArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('index'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $catid = I('get.catid', '', 'intval');
            $checkGoods = M('goods')->where(array('cat_id' => $catid))->find();
            if (!$checkGoods) {
                $bool = $this->model->where(array('catid' => $catid))->delete();
                if ($bool) {
                    $this->success("删除成功", U('index'));
                } else {
                    $this->error("非法操作");
                }
            } else {
                $this->error("此分类下有商品，请删除商品后在删除分类");
            }

        }
    }


    //排序
    public function listorder()
    {
        $info = I('post.', '');
        foreach ($info['id'] as $k => $v) {
            $this->model->where(array('catid' => $v))->save(array('listorder' => $info['listorder'][$v]));
        }
        $this->success('排序成功！', U('index'));
    }

    public function disposeUpload()
    {
        $args = '1,jpg|jpeg|gif|png|bmp,1,,,0';
        $authkey = upload_key($args);
        $this->assign('args', $args);
        $this->assign('authkey', $authkey);
    }
}
