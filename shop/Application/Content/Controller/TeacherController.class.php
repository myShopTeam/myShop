<?php

// +----------------------------------------------------------------------
// | QCCMS8.2 Teacher管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.lovegq1314.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------

namespace Content\Controller;

use Common\Controller\AdminBase;

class TeacherController extends AdminBase {

    //Teacher列表
    public function teacher() {        
        if($_POST['teacher']){
            //print_r($_POST);die;
            $wh['teacher']  = array("LIKE", "%{$_POST['teacher']}%");
        }
        $count = M('teacher')->where($wh)->count();
        $page = $this->page($count, 3);
		$teacher=M('teacher')->where($wh)->limit($page->firstRow . ',' . $page->listRows)->order(array("listorder" => "DESC"))->select();
		$this->assign('Page', $page->show());
        $this->assign("teacher",$teacher);
		$this->display();

    }

    //修改Teacher
    public function edit(){
		if(IS_POST){
			$db=D('Content/Teacher');
			if($db->create()){
		$teacher1=M('teacher')->where(array("teacherid"=>$_POST['teacherid']))->save(array("teacher"=>$_POST['teacher'],"hits"=>$_POST['hits']));

			$this->success('修改成功！', U('teacher'));exit;
		}else{
			 $this->error($db->getError());exit;
		}
		
		}
		$teacher=M('teacher')->where(array("teacherid"=>$_GET['teacherid']))->find();
		$this->assign($teacher);
        $this->display();

    }
	
	 //添加
    public function add(){
		if(IS_POST){
		$db=D('Content/Teacher');		
		if($db->create()){
			$teacher1=M('teacher')->data($_POST)->add();
			$this->success('添加成功！', U('teacher'));exit;
		}else{
				
             $this->error($db->getError());exit;
		}
		
		}
		
        $this->display();

    }
	

     /**
     * 删除
     */
    public function delete(){
    	$db = M("teacher");
    	if (IS_POST) {
    		$id = $_POST['teacherid'];
    		if (is_array($id)) {
    			foreach ($id as $mid) {
    				$r = $db->where(array("teacherid" => $mid))->find();
    				if ($r) {
    					$db->where(array("teacherid" => $mid))->delete();
    				}
    			}
    			$this->success("删除成功！");
    		} else {
    			$this->error("参数错误！");
    		}
    	} else {
    		$id = $_GET['teacherid'];
    			$status = $db->where(array("teacherid"=>$id))->delete();
    			if ($status) {
    				$this->success("删除成功！");
    			} else {
    				$this->error("删除失败！");
    			}
    	}
    }
	
	    /**
     * 排序 
     */
    public function listorder() {
        $db = M("teacher");
        if (IS_POST){
            $listorder = $_POST['listorder'];
            if (is_array($listorder)) {
                foreach ($listorder as $id => $v) {
                    $db->where(array("teacherid" => $id))->data(array("listorder" => (int)$v))->save();
                }
                $this->success("排序更新成功！");
            } else {
                $this->error("参数错误！");
            }
        } else {
            $this->error("参数错误！");
        }
    }
 

}
