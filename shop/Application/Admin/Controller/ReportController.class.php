<?php

/*
 * 统计报表
 * 区域销售报表，部门销售报表 员工销售报表
 * @author   kelleyxuan@163.com
 */

namespace admin\Controller;

use Common\Controller\AdminBase;
use Admin\Service\User;

Class ReportController extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
        session_start();
        $this->userInfo = User::getInstance()->getInfo();
        $this->assign('config',$this->config);
    }
    
    
    /*
     * 区域销售报表
     */
    public function areaReport(){
        $area_id =  $this->userInfo['id'];
        $where['parentid'] = $this->userInfo['id'];
        //超级管理员身份
        if($this->userInfo['role_id'] == '1'){
            $area = M('role')->where(array('parentid'=>1))->select();
            $this->assign('area',$area);
            $area_id = $where['parentid'] = null;
        }    
        //根据部门名搜索
        if($_POST){
            if($_POST['name']){
                $where['name'] = array('like','%'.$_POST['name'].'%');
                $this->assign("searchName", $_POST['name']);
            }
            if($_POST['area_id']){
                $where['parentid'] = $_POST['area_id'];
                $this->assign("area_id", $_POST['area_id']);
                $area_id = $_POST['area_id'];
            }         
        }
        $child_role_id = D("Admin/role")->getArrchildid($area_id);
        $sql  =  "select count(u.id) counts from  ".C('DB_PREFIX')."user u  inner join ".C('DB_PREFIX')."card c on c.importId = u.id  and u.role_id in (".$child_role_id.") and c.is_active = 2";
        $card_active_count = M('user')->query($sql);
        $sql  =  "select count(u.id) counts from  ".C('DB_PREFIX')."user u  inner join ".C('DB_PREFIX')."card c on c.importId = u.id  and u.role_id in (".$child_role_id.")";
        $card_add_count = M('user')->query($sql);
        //获取区域的员工数量
        $count = M('user')->where(array('role_id'=>array('in',$child_role_id)))->count();
        $page = $this->page($count, 10);
        //获取区域部门
        $section = M('role')->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('id desc')->select();
        foreach($section as $k=>$v){
            $child_role_id_sec = D("Admin/role")->getArrchildid($v['id']);
            $section[$k]['card_active_num'] = M('user')->join("inner join ".C('DB_PREFIX')."card c on c.importId = ".C('DB_PREFIX')."user.id  and ".C('DB_PREFIX')."user.role_id in (".$child_role_id_sec.") and c.is_active = 2")->count();
            $section[$k]['card_add_num']    = M('user')->join("inner join ".C('DB_PREFIX')."card c on c.importId = ".C('DB_PREFIX')."user.id  and ".C('DB_PREFIX')."user.role_id in (".$child_role_id_sec.")")->count(); 
        }
        $this->assign('area_name',M('Role')->getFieldById($area_id,'name'));
        $this->assign('card_active_count',$card_active_count[0]['counts']);
        $this->assign('card_add_count',$card_add_count[0]['counts']);
        $this->assign("Page", $page->show());
        $this->assign('count',$count);
        $this->assign('section',$section);
        
        $this->display();
    }
    
    /*
     * 部门销售报表
     */
    public function sectionReport(){
       $section_id = $this->userInfo['role_id']; 
       $role_levle = M('Role')->getFieldById($this->userInfo['role_id'],'levle');
        //判断是否有权限访问
        if($_GET['id'] || $_POST['id']){
            $id = $_GET['id']?$_GET['id']:$_POST['id'];
            $parentid = M('Role')->getFieldById($id,'parentid');
            
            if($this->userInfo['id'] != 1 && $this->userInfo['id'] != $parentid){
                $this->error('无权限访问！');
            }
            //保留区域查询数据   非超管即区域负责人
            $area_id = $_POST['area_id']?$_POST['area_id']:$this->userInfo['id'];
            $sectionArr = M('Role')->where(array('parentid'=>$area_id))->select();          
            $this->assign('sectionArr',$sectionArr);
            
            $section_id = $id;
            $this->assign('id',intval($id));
            $this->assign('area_id',intval($_POST['area_id']));
        }
        if($role_levle < 3 && !$_GET['id'] && !$_POST['id']){
            $section_id = 0;
        }
        //超级管理员身份通过菜单访问
        if($this->userInfo['role_id'] == '1'){
            $area = M('role')->where(array('parentid'=>1))->select();
            $this->assign('area',$area);
        } 
        //区域负责人访问
        if($role_levle == '2'){
            $sectionArr = M('Role')->where(array('parentid'=>$this->userInfo['role_id']))->select();          
            $this->assign('sectionArr',$sectionArr);
        }
        
        //获取部门的所有角色
        $child_role_id = D("Admin/role")->getArrchildid($section_id);
        $sql  =  "select count(u.id) counts from  ".C('DB_PREFIX')."user u  inner join ".C('DB_PREFIX')."card c on c.importId = u.id  and u.role_id in (".$child_role_id.") and c.is_active = 2";
        $card_active_count = M('user')->query($sql);
        $sql  =  "select count(u.id) counts from  ".C('DB_PREFIX')."user u  inner join ".C('DB_PREFIX')."card c on c.importId = u.id  and u.role_id in (".$child_role_id.")";
        $card_add_count = M('user')->query($sql);
        //获取部门的所有成员
        $count = M('user')->where(array('role_id'=>array('in',$child_role_id)))->count();
        $page = $this->page($count, 10);
        $where['role_id'] = array('in',$child_role_id);
        //根据用户名搜索
        if($_POST['nickname']){
            $where['nickname'] = array('like','%'.$_POST['nickname'].'%');
            $this->assign("searchName", $_POST['nickname']);
        }
        $userArr = M('user')->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('id desc')->select();
        foreach($userArr as $k=>$v){
           $userArr[$k]['card_add_num'] =  M('card')->where(array('importId'=>$v['id']))->count();
           $userArr[$k]['card_active_num'] = M('card')->where(array('importId'=>$v['id'],'is_active'=>2))->count();
        }
        
        $this->assign('section_name',M('Role')->getFieldById($section_id,'name'));
        $this->assign('card_active_count',$card_active_count[0]['counts']);
        $this->assign('card_active_count',$card_active_count[0]['counts']);
        $this->assign("Page", $page->show());
        $this->assign('count',$count);
        $this->assign('userArr',$userArr);
        $this->display();
    }
    
    /*
     * 职员业绩
     */
    public function staffReport(){
        $this->assign('userName', $this->userInfo['nickname']);
        //查询已激活的卡单数
        $activeNum = M('card')->where(array('importId'=>$this->userInfo['id'],'is_active'=>'2'))->count();
        //查询添加的卡单数
        $addNum = M('card')->where(array('importId'=>$this->userInfo['id']))->count();
        $this->assign('activeNum',$activeNum);
        $this->assign('addNum',$addNum);
        $this->display();
    }
    
    /*
     * ajax获取区域下的部门
     * 
     */
    public function ajax_get_section(){
        $area_id = $_POST['area_id'];
        if($area_id){
            $sectionArr = M('Role')->where(array('parentid'=>$area_id))->select();
            
            $this->assign('sectionArr',$sectionArr);
            
            echo $this->display();
        }else{
            $this->error('区域不能为空');
        }
    }
}

