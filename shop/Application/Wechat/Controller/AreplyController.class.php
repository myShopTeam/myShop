<?php

namespace Wechat\Controller;

use Common\Controller\AdminBase;

class AreplyController extends AdminBase
{

    public $model;
    public $wxuser;

    public function _initialize()
    {
        parent::_initialize();

        $this->model = M('wxuser');
        $this->wxuser = S('wxuser');
    }

    public function index()
    {
        $res = $this->model->find();
        if ($res['first_type'] == 1 && $res['imageid']) {
            $image = M("img")->find($res['imageid']);
            $image['child'] = M("img")->where(array('parentid' => $image['id']))->select();
            $this->assign('img', $image);
        }
        $this->assign('areply', $res);
        $this->display();
    }

    public function insert()
    {
        if (IS_POST) {
            $res = $this->model->find(1);

            if (I('post.type') == 0) {
                $where ['first_content'] = I('post.content');
                $where ['first_type'] = 0;
                $where ['first_imageid'] = 0;
                if (empty ($where ['first_content'])) {
                    echo 2;
                    exit ();
                }
            } else {
                $where ['first_imageid'] = I('post.imageid');
                $where ['first_type'] = 1;
                if (empty ($where ['first_imageid'])) {
                    echo 2;
                    exit ();
                }
            }

            if (isset ($_POST ['keyword'])) {
                $where ['keyword'] = I('post.keyword');
            }
            if (isset ($_POST ['title'])) {
                $where ['title'] = I('post.title');
            }
            if ($this->model->where(array('id' => 1))->save($where)) {
                echo 1;
            } else {
                echo 0;
            }
            exit ();

        }
    }

    /**
     * 获取图文库消息
     */
    public function img_list()
    {
        if (IS_POST) {
            $db = M('img');
            $totalRows = $db->order('id desc')->where(array('parentid' => 0))->count();
            $listRows = 2;
            $totalPages = ceil($totalRows / $listRows); // 总页数
            $nowPage = !empty ($_POST ['p']) ? intval($_POST ['p']) : 1;
            if ($nowPage < 1) {
                $nowPage = 1;
            } elseif (!empty ($totalPages) && $nowPage > $totalPages) {
                $nowPage = $totalPages;
            }
            $firstRow = $listRows * ($nowPage - 1);
            $info = $db->field('id,title,text,pic,createtime')->where(array('parentid' => 0))->order('createtime desc')->limit($firstRow . ',' . $listRows)->select();
            $info_list = array();
            if ($info !== false) {
                foreach ($info as $key => $v) {
                    $info_list [$key] ['id'] = $v ['id'];
                    $info_list [$key] ['title'] = $v ['title'];
                    $info_list [$key] ['text'] = (empty ($v ['text'])) ? '' : substr($v ['text'], 0, 30);
                    $info_list [$key] ['pic'] = $v ['pic'];
                    $info_list [$key] ['createtime'] = date('Y-m-d', $v ['createtime']);
                    $info_list [$key] ['child'] = $db->field('id,title,text,pic,createtime')->where(array('parentid' => $v ['id']))->select();
                    if ($info_list [$key] ['child']) {
                        foreach ($info_list [$key] ['child'] as $m => $n) {
                            $info_list [$key] ['child'] [$m] ['createtime'] = date('Y-m-d', $n ['createtime']);
                        }
                    } else {
                        $info_list [$key] ['child'] = array();
                    }
                }
            }
            unset ($info);
            echo json_encode(array('list' => $info_list, 'count' => $totalPages, 'firstRow' => $nowPage));
        } else {
            echo json_encode(array());
        };
    }

    //关键词回复
    public function keywordReply()
    {
        $db = M('Rule');
        $where ['token'] = session('token');
        $count = $db->where($where)->count();
        $page = $this->page($count, 5);
        $info = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('createtime' => 'desc'))->select();
        $img = M('Img');
        foreach ($info as $k => $v) {
            if ($v ['type'] == 2) {
                $images = $img->where(array('id' => $v ['imageid']))->find();
                $images ['child'] = $img->where(array('parentid' => $v ['imageid']))->select();
                $images ['child'] = empty ($images ['child']) ? array() : $images ['child'];
                $info [$k] ['content'] = $images ['title'];
                $info [$k] ['images'] = $images;
            }
        }
        $this->assign('page', $page->show());
        $this->assign('list', $info);
        $this->display();
    }

    public function keywordInsert()
    {
        // print_r($_POST);
        // exit;
        $db = M("Rule");
        $where ['token'] = session('token');
        $id = I('post.id', '', 'intval');
        if (!empty ($id)) {
            $where ['id'] = $id;
            $rule = I('post.rule');
            $keyword = I('post.keyword');
            $type = I('post.type', '', 'intval');
            $data = array('rule_name' => $rule, 'keyword' => $keyword, 'type' => $type, 'updatetime' => time());
            if ($data ['type'] == 1) {
                $contet = I('post.content');
                if (empty ($contet)) {
                    $this->ajaxReturn(2);
                } else {
                    $data ['content'] = $contet;
                }
            } else {
                $imageid = I('post.imageid', '', 'intval');
                if ($imageid == 0) {
                    $this->ajaxReturn(2);
                } else {
                    $data ['imageid'] = $imageid;
                }
            }
            if ($db->data($data)->where($where)->save() !== false) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(3);
            }
        } else {
            $rule = I('post.rule');
            $keyword = I('post.keyword');
            $type = I('post.type', '', 'intval');
            $data = array('rule_name' => $rule, 'keyword' => $keyword, 'type' => $type, 'token' => session('token'), 'createtime' => time());
            if ($data ['type'] == 1) {
                $contet = I('post.content');
                if (empty ($contet)) {
                    $this->ajaxReturn(2);
                } else {
                    $data ['content'] = $contet;
                }
            } else {
                $imageid = I('post.imageid', '', 'intval');
                if ($imageid == 0) {
                    $this->ajaxReturn(2);
                } else {
                    $data ['imageid'] = $imageid;
                }
            }
            if ($db->data($data)->add()) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(3);
            }
        }
    }

    public function ruleDel()
    {
        if (!IS_AJAX) {
            exit ('access denied');
        }
        $id = I('post.id', '', 'intval');
        if (M('Rule')->where(array('id' => $id))->delete()) {
            $this->ajaxReturn(1);
        } else {
            $this->ajaxReturn(0);
        }
    }

    public function ruleTypeEdit()
    {
        if (!IS_AJAX) {
            exit ('access denied');
        }
        $id = I('post.id', '', 'intval');
        $keyword = I('post.keyword');
        $keywordType = I('post.keywordType');
        $data = array('keyword' => $keyword, 'rule_type' => $keywordType);
        $where = array('id' => $id);
        if (M('Rule')->data($data)->where($where)->save() !== false) {
            $this->ajaxReturn(1);
        } else {
            $this->ajaxReturn(0);
        }
    }



    /**
     * 排序
     */
    // public function listorder() {
    //   $db = M("business");
    //   if (IS_POST){
    //     $listorder = $_POST['listorder'];
    //     if (is_array($listorder)) {
    //       foreach ($listorder as $id => $v) {
    //         $db->where(array("id" => $id))->data(array("listorder" => (int)$v))->save();
    //       }
    //       $this->success("排序更新成功！");
    //     } else {
    //       $this->error("参数错误！");
    //     }
    //   } else {
    //     $this->error("参数错误！");
    //   }
    // }
}
