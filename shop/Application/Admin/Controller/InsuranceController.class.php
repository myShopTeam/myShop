<?php

/*
 * CRM管理
 * 人员管理、卡单管理、
 * @author   kelleyxuan@163.com
 */

namespace admin\Controller;

use Common\Controller\AdminBase;
use Admin\Service\User;

class InsuranceController extends AdminBase
{
    
    protected $config = array(
                            'is_active' => array('1'=>'未激活','2'=>'已激活')
                            );
    //导入的字段
    protected $insurance_field = array(
                            'realname'=>'姓名',
                            'cred_num'=>'身份证',
                            'insurance_num' =>'保险合同号',
                            'start_time'=>'保险生效日期',
                            'rescue_time'=>'救援服务项目生效日期',         
                            );
    
    protected $tmp_table = array(
                            'realname'=>'于振航',
                            'cred_num'=>'420624196105180052',
                            'insurance_num' =>'10588001900295635988',
                            'start_time'=>'保险2016年12月13日零时起生效',
                            'rescue_time'=>'以卡单激活时间为准',            
        );

    protected function _initialize()
    {
        parent::_initialize();
        session_start();
        $this->userInfo = User::getInstance()->getInfo();
        $this->assign('config',$this->config);
    }

    //会员列表
    public function insuranceList()
    {
        $user_id = $this->userInfo['id'];
        $userStr = $user_id;
        
        $post = $_POST;
        if($post){
            $where = $this->createWhere($post);
            if($post['user_id']) $userStr = $post['user_id'];
            $this->assign('post',$post);
        }else{
            $where = '1 = 1';
        }
        if($_GET['user_id']){
            $userStr = $_GET['user_id'];
        }
        //检查权限
        $child_user = $this->get_child_user($user_id);
        if(!in_array($userStr, $child_user)){
            $this->error('无权限访问！');
        }
        if($user_id != '1'){           
            $where .=' and importId in ('.$userStr.')';
        }
        $db = M('insurance');
        $count = $db->where($where)->count();

        $page = $this->page($count, 20);
        $vipList = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('id desc')->select();
        
        //$this->assign('name',M('user')->getFieldById($userStr,'nickname'));
        $this->assign('user_id',$user_id);
        $this->assign("Page", $page->show());
        $this->assign("vipList", $vipList);
        $this->display();
    }
    
    /*
     * 根据用户id 获取下级所有用户
     */
    public function get_child_user($user_id){
        $role_id = M('user')->getFieldById($user_id,'role_id');
        $child_role_id = D("Admin/role")->getArrchildid($role_id);
        $userArr = M('user')->field('id')->where(array('role_id'=>array('in',$child_role_id)))->select();
        $userIdArr = array();
        foreach($userArr as $v){
            $userIdArr[] = $v['id'];
        }
        
        return $userIdArr;
    }

    public function createWhere($post){
        $where = '1 and ';
        $where .= !empty($post['insurance_num'])?'insurance_num like "%'.$post['insurance_num'].'%" and ':'';
        $where .= !empty($post['cred_num'])?'cred_num like "%'.$post['cred_num'].'%" and ':'';
        $where .= !empty($post['realname'])?'realname like "%'.$post['realname'].'%"':' 1';

        return $where;
    }
    
    /*
     * @time     2016/9/5
     * 卡单激活
     * @author   xuxuan
     */
    public function insuranceActive()
    {
        if (IS_POST) {
            $numArr = I('post.');
            if (is_array($numArr)) {
                foreach ($numArr['id'] as $k => $v) {
                    $insuranceArr[] = $v;
                }
                $data['active_time'] = time();
                $data['is_active'] = 2;
                $bool = M('insurance')->where(array('id' => array('IN', $insuranceArr)))->save($data);
                if ($bool) {
                    $this->success("激活成功", U('Insurance/insuranceList'));
                } else {
                    $this->error("激活失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else{
            $this->error("非法操作");
        }
    }

    //添加会员
    public function insuranceAdd()
    {
        if (IS_POST) {
            foreach($_POST as $k=>$v){
                $data[$k] = I('post.'.$k,'',trim);
            }
            $data['add_time'] = time();
            $data['action_user'] = User::getInstance()->id;
            $data['importId'] = User::getInstance()->id;
            //检测卡号是否已存在
            $checkUser = M('insurance')->where(array('insurance_num' => $data['insurance_num']))->find();
            if ($checkUser) {
                $this->error('此卡号已存在');
            } else {
                $insurance_num = M('insurance')->add($data);
            }
            if ($insurance_num) {
                $this->success('保单添加成功', U('Insurance/insuranceList'));
            } else {
                $this->error('保单添加失败');
            }
        } else {
            $this->display();
        }
    }

    //修改会员信息
    public function insuranceEdit()
    {
        $insurance_num = I('get.insurance_num', '', '');
        if (IS_POST) {
            foreach($_POST as $k=>$v){
                $data[$k] = I('post.'.$k,'',trim);
            }
            $checkUser = M('insurance')->where(array('insurance_num' => $data['insurance_num']))->find();
            if ($checkUser) {
                $data['update_time'] = time();
                $data['update_user'] = User::getInstance()->id;
                $bool = M('insurance')->where(array('insurance_num' => $data['insurance_num']))->save($data);
            } else {
                $this->error('此卡号不存在！');             
            }
            if ($bool) {
                $this->success('修改成功', U('Insurance/insuranceList'));
            } else {
                $this->error('修改失败！');
            }
        } else {
            $vipList = M('insurance')->where(array('insurance_num' => $insurance_num))->find();
            $this->assign($vipList);
            $this->display();
        }
    }

    //会员删除
    public function insuranceDelete()
    {
        if (IS_POST) {
            $numArr = I('post.');
            if (is_array($numArr)) {
                foreach ($numArr['id'] as $k => $v) {
                    $insuranceArr[] = $v;
                }
                $bool = M('insurance')->where(array('id' => array('IN', $insuranceArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('Insurance/insuranceList'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $vipid = I('get.id', '', intval);
            $bool = M('insurance')->where(array('id' => $vipid))->delete();
            if ($bool) {
                $this->success("删除成功", U('Insurance/insuranceList'));
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
                $db = M('insurance');
                $a = 'Insurance/insuranceList';
                $id = 'id';
                break;

            case "school":
                $db = M('goods_school');
                $a = 'Member/alumni_supervise';
                $id = 'id';
                break;
        }
        foreach ($info['listorder'] as $k => $v) {
            $db->where(array($id => $k))->save(array('listorder' =>$v));
        }
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

    /*
     * excel导出  支持excel2007
     * @author  xuxuan
     */
    public function export() {
        vendor('Classes.PHPExcel');
        $Excel = new \PHPExcel();
        // 设置
        $Excel
            ->getProperties()
            ->setCreator("dee")
            ->setLastModifiedBy("dee")
            ->setTitle("数据EXCEL导出")
            ->setSubject("数据EXCEL导出")
            ->setDescription("数据EXCEL导出")
            ->setKeywords("excel")
            ->setCategory("result file");
        $where = $this->createWhere(I('post.'));
        $arr = M('insurance')->where($where)->select();
        array_unshift($arr,$this->insurance_field);
        if(I('get.type') == 'tmp'){
            $arr = array();
            $arr[0] = $this->insurance_field;
            $arr[1] = $this->tmp_table;
        }
        foreach($arr as $key => $val) { // 注意 key 是从 0 还是 1 开始，此处是 0
            $num = $key + 1;
            $object = $Excel ->setActiveSheetIndex(0);
            $abcKey    = 'A';        
            foreach($this->insurance_field as $k=>$v){
                     //Excel的第A列，uid是你查出数组的键值，下面以此类推     
//                    if(($k=='start_time'||$k=='end_time'||$k=='birthday')&&$num!=1){
//                        $val[$k] = date('Y-m-d',$val[$k]);
//                    }
                    $object->setCellValue($abcKey.$num, $val[$k].' ');  
                    $abcKey++;
            }
        }
        $Excel->getActiveSheet()->setTitle('export');
        $Excel->getActiveSheet()->getStyle()->getFont()->setName('宋体');
        $Excel->setActiveSheetIndex(0);
        $name = 'example_export.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$name);
        header('Cache-Control: max-age=0');

        $ExcelWriter = \PHPExcel_IOFactory::createWriter($Excel, 'Excel2007');
        $ExcelWriter->save('php://output');
        exit;       
    }
    
    /*
     * 上传文件  (excel)
     * @author  xuxuan
     */
    function upload() {
        if (!empty($_FILES ['file_stu'] ['name'])) {
            $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
            $file_types = explode(".", $_FILES ['file_stu'] ['name']);
            $file_type = $file_types [count($file_types) - 1];
//             /*判别是不是.xls文件，判别是不是excel文件*/
//             if (strtolower ( $file_type ) != "xlsx")       
//            {
//               $this->error ( '不是Excel文件，重新上传' );
//             }
            /* 设置上传路径 */
            $savePath = SITE_PATH . '/public/upfile/Excel/';
            /* 以时间来命名上传的文件 */
            $str = date('Ymdhis');
            $file_name = $str . "." . $file_type;
            //判断目录 是否存在，不存在则创建
            if (!is_dir($savePath)) {
                mkdir($savePath, 0777, true);
            }
            /* 是否上传成功 */
            if (!copy($tmp_file, $savePath . $file_name)) {
                $this->error('上传失败！');
            } else {
                $data = $this->read($savePath . $file_name, 'utf-8', $file_type);
                //数据处理并存入数据库
                if (count($data) > 0) {
                    $insuranceMdl = M('insurance');
                    $userInfo = User::getInstance()->getInfo();
                    foreach ($data as $k => $v) {
                        $v['start_time'] = $v['start_time'];
                        $v['rescue_time'] = $v['rescue_time'];
                        $v['add_time'] = time();
                        $v['action_user'] = $userInfo['id'];
                        $v['importId'] = $userInfo['id'];
//                        $find_data = $insuranceMdl->where(array('insurance_num' => $v['insurance_num']))->find();
//                        if($find_data){
//                            echo '卡号：'.$v['insurance_num'].'已经存在，不能重复导入！</br>';
//                            $result = true;
//                            continue;                          
//                        }
                        $insertRes = $insuranceMdl->add($v);
                        if(!$insertRes){
                            echo '卡号：'.$v['insurance_num'].'导入失败！</br>';
                            $result = true;
                        }
                    }
                    if (!$result) {
                        $this->success('数据导入完成！');
                    }
                } else {
                    $this->error('文件导入失败！');
                }
            }
        } else {
            $this->error ( '请选择上传文件！',U('Insurance/insuranceList') );
        }
    }
    
    /**
    * 读取excel $filename 路径文件名 $encode 返回数据的编码 默认为utf8
    * @author  xuxuan
    */
    public function read($filename, $encode = 'utf-8', $file_type) {
        header('Content-type: text/html; charset=utf-8');

        vendor('Classes.PHPExcel');

        $Excel = new \PHPExcel();
        /* 判别是不是.xls文件，判别是不是excel文件 */
        if (strtolower($file_type) == "xlsx") {
            // 如果excel文件后缀名为.xlsx
            vendor("Classes.PHPExcel.Reader.Excel2007");
            $PHPReader = new \PHPExcel_Reader_Excel2007();
        } else if (strtolower($file_type) == "xls") {
            // 如果excel文件后缀名为.xls
            vendor("PHPExcel.Classes.PHPExcel.Reader.Excel5");
            $PHPReader = new \PHPExcel_Reader_Excel5();
        }

        //$PHPReadersetLoadSheetsOnly( array("Sales Dashboard") );
        // 载入文件
        $Excel = $PHPReader->load($filename);

        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet = $Excel->getSheet(0);
        //获取总列数
        $allColumn = $currentSheet->getHighestColumn();
        //获取总行数
        $allRow = $currentSheet->getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
            //从哪列开始，A表示第一列
            $currentColumn = 'A';
            foreach ($this->insurance_field as $k => $v) {
                //数据坐标
                $address = $currentColumn . $currentRow;
                $currentColumn++;
                //读取到的数据，保存到数组$arr中
                $arr[$currentRow][$k] = $currentSheet
                        ->getCell($address)
                        ->getValue();
            }
        }
        unset($arr[1]); //去掉第一行的标题数据
        return $arr;
    }
    
}
