<?php

/*
 * CRM管理
 * 人员管理、卡单管理、
 * @author   kelleyxuan@163.com
 */

namespace admin\Controller;

use Common\Controller\AdminBase;

class CrmController extends AdminBase
{
    protected $config = array(
                            'is_active' => array('1'=>'未激活','2'=>'已激活')
                            );
    //导入的字段
    protected $card_field = array(
                            'card_name'=>'产品名称',
                            'card_num' =>'卡号',
                            'verif'=>'校验码',
                            'start_time'=>'生效日期',
                            'end_time'=>'截止日期',
                            'realname'=>'用户姓名',
                            'sex'=>'性别',
                            'mobile'=>'手机号码',
                            'cred_type'=>'证件类型',
                            'cred_num'=>'证件号码',
                            'birthday'=>'出生日期',
                            'addr_province'=>'省份',
                            'addr_city'=>'城市',
                            'contract_name'=>'紧急联系人',
                            'contract_cred_num'=>'紧急联系人身份证号',
                            'contract_way'=>'紧急联系方式',
                            'assist_adult'=>'副卡成人姓名',
                            'assist_adult_cred'=>'副卡成人身份证号',
                            'assist_child'=>'副卡未成年人姓名',
                            'assist_child_cred'=>'副卡未成年人姓名',
                            'guardian'=>'监护人姓名',
                            'guardian_cred'=>'监护人身份证号',
                            'num_plate'=>'车牌号',
                            'car_firm'=>'汽车厂商',
                            'engine_number'=>'发动机编号',
                            'pcm_vim'=>'车架号',
                            'car_register_time'=>'车辆初次登记时间',
                            'car_type'=>'车辆类型',
                            'company'=>'所属单位',
                            'contract_addr'=>'联系地址',
                            'card_type'=>'产品类型'          
                            );

    protected function _initialize()
    {
        parent::_initialize();
        $this->assign('config',$this->config);
    }

    //会员列表
    public function cardList()
    {
        $post = $_POST;
        if($post){
            $where = $this->createWhere($post);
            $this->assign('post',$post);
        }else{
            $where = '1 = 1';
        }
        $db = M('card');
        $count = $db->where($where)->count();
        
        $page = $this->page($count, 8);
        $vipList = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('listorder desc,id desc')->select();
        
        $this->assign("Page", $page->show());
        $this->assign("vipList", $vipList);
        $this->display();
    }

    public function createWhere($post){
        $where = '1=1 and ';
        $where .= !empty($post['card_type'])?'card_type="'.$post['card_type'].'" and ':'';
        $where .= !empty($post['card_name'])?'card_name="'.$post['card_name'].'" and ':'';
        $where .= !empty($post['is_active'])?'is_active='.$post['is_active'].' and ':'';
        $where .= !empty($post['start_time'])?$post['time_type'].' >= '.strtotime($post['start_time']).' and ':'';
        $where .= !empty($post['end_time'])?$post['time_type'].' < '.strtotime($post['end_time']).' and ':'';
        $where .= !empty($post['card_num'])?'card_num like "%'.$post['card_num'].'%"':' 1 = 1';

        return $where;
    }
    
    /*
     * @time     2016/9/5
     * 卡单激活
     * @author   xuxuan
     */
    public function cardActive()
    {
        if (IS_POST) {
            $numArr = I('post.');
            if (is_array($numArr)) {
                foreach ($numArr['id'] as $k => $v) {
                    $cardArr[] = $v;
                }
                $data['active_time'] = time();
                $data['is_active'] = 2;
                $bool = M('card')->where(array('id' => array('IN', $cardArr)))->save($data);
                if ($bool) {
                    $this->success("激活成功", U('Crm/cardList'));
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
    public function cardAdd()
    {
        if (IS_POST) {
            foreach($_POST as $k=>$v){
                $data[$k] = I('post.'.$k,'',trim);
            }
            $data['create_time'] = time();
            $data['birthday']    = strtotime($data['birthday']);
            //检测卡号是否已存在
            $checkUser = M('card')->where(array('card_num' => $data['card_num']))->find();
            if ($checkUser) {
                $this->error('此卡号已存在');
            } else {
                $card_num = M('card')->add($data);
            }
            if ($card_num) {
                $this->success('卡单添加成功', U('Crm/cardList'));
            } else {
                $this->error('卡单添加失败');
            }
        } else {
            $this->display();
        }
    }

    //修改会员信息
    public function cardEdit()
    {
        $card_num = I('get.card_num', '', '');
        if (IS_POST) {
            foreach($_POST as $k=>$v){
                $data[$k] = I('post.'.$k,'',trim);
            }
            $data['status'] = I('post.status', 1, trim);
            $data['birthday'] = strtotime($data['birthday']);
            //检测是否重名
            $checkUser = M('card')->where(array('card_num' => $data['card_num']))->find();
            if ($checkUser) {
                $bool = M('card')->where(array('card_num' => $data['card_num']))->save($data);
            } else {
                $this->error('此卡号不存在！');             
            }
            if ($bool) {
                $this->success('修改成功', U('Crm/cardList'));
            } else {
                $this->error('修改失败！');
            }
        } else {
            $vipList = M('card')->where(array('card_num' => $card_num))->find();
            $this->assign($vipList);
            $this->display();
        }
    }

    //会员删除
    public function cardDelete()
    {
        if (IS_POST) {
            $numArr = I('post.');
            if (is_array($numArr)) {
                foreach ($numArr['id'] as $k => $v) {
                    $cardArr[] = $v;
                }
                $bool = M('card')->where(array('id' => array('IN', $cardArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('Crm/cardList'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $vipid = I('get.id', '', intval);
            $bool = M('card')->where(array('id' => $vipid))->delete();
            if ($bool) {
                $this->success("删除成功", U('Crm/cardList'));
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
                $db = M('card');
                $a = 'Crm/cardList';
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
        $arr = M('card')->where($where)->select();
        array_unshift($arr,$this->card_field);
        if(I('get.type') == 'tmp'){
            $arr = array();
            $arr[0] = $this->card_field;
        }
        foreach($arr as $key => $val) { // 注意 key 是从 0 还是 1 开始，此处是 0
            $num = $key + 1;
            $object = $Excel ->setActiveSheetIndex(0);
            $abcKey    = 'A';        
            foreach($this->card_field as $k=>$v){
                     //Excel的第A列，uid是你查出数组的键值，下面以此类推     
                    if(($k=='start_time'||$k=='end_time'||$k=='birthday')&&$num!=1){
                        $val[$k] = date('Y-m-d',$val[$k]);
                    }
                    $object->setCellValue($abcKey.$num, $val[$k].' ');  
                    $abcKey++;
            }
        }
        $Excel->getActiveSheet()->setTitle('export');
        $Excel->setActiveSheetIndex(0);
        $name='example_export.xlsx';

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
    function upload(){
        if (! empty ( $_FILES ['file_stu'] ['name'] )) 
        {
            $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
            $file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
            $file_type = $file_types [count ( $file_types ) - 1];
             /*判别是不是.xls文件，判别是不是excel文件*/
             if (strtolower ( $file_type ) != "xls")       
            {
               $this->error ( '不是Excel文件，重新上传' );
             }
            /*设置上传路径*/
             $savePath = SITE_PATH . '/public/upfile/Excel/';
            /*以时间来命名上传的文件*/
             $str = date ( 'Ymdhis' ); 
             $file_name = $str . "." . $file_type;
             //判断目录 是否存在，不存在则创建
            if(!is_dir($savePath)) {
               mkdir($savePath, 0777, true);
            }
             /*是否上传成功*/
             if (! copy ( $tmp_file, $savePath . $file_name )) 
             {
               $this->error ( '上传失败！' );
             }else{
                 $data = $this->read($savePath . $file_name);
                 //数据处理并存入数据库
                 if(count($data) > 0){
                     print str_repeat(" ", 4096);
                     $cardMdl = M('card');
                     foreach($data as $k=>$v){
                        $v['start_time'] = strtotime($v['start_time']);
                        $v['end_time']   = strtotime($v['end_time']);
                        $v['create_time']= time();
                        $v['birthday'] = strtotime($v['birthday']);
                        $find_data = $cardMdl->where(array('card_num' => $v['card_num']))->find();
                        if($find_data){
                            echo '卡号：'.$v['card_num'].'已经存在，不能重复导入！</br>';
                            ob_flush();
                            flush();
                            $result = true;
                            continue;                          
                        }
                        $insertRes = $cardMdl->add($v);
                        if(!$insertRes){
                            echo '卡号：'.$v['card_num'].'导入失败！</br>';
                            ob_flush();
                            flush();
                            $result = true;
                        }
                     }
                     if(!$result){
                        $this->success('数据导入完成！');
                     }
                 }else{
                    $this->error( '文件导入失败！' );
                 }
             }
        }else{
            $this->error ( '请选择上传文件！',U('Crm/cardList') );
        }
    }
    
    /**
    * 读取excel $filename 路径文件名 $encode 返回数据的编码 默认为utf8
    * @author  xuxuan
    */
    public function read($filename,$encode='utf-8'){
        header('Content-type: text/html; charset=utf-8');
 
        vendor('Classes.PHPExcel');
 
        $Excel = new \PHPExcel();
        // 如果excel文件后缀名为.xls
        vendor("PHPExcel.Classes.PHPExcel.Reader.Excel5");
        // 如果excel文件后缀名为.xlsx
        //vendor("Classes.PHPExcel.Reader.Excel2007");
        $PHPReader = new \PHPExcel_Reader_Excel5();
        //$PHPReadersetLoadSheetsOnly( array("Sales Dashboard") );
 
        // 载入文件
        $Excel = $PHPReader -> load($filename);
 
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet = $Excel -> getSheet(0);
        //获取总列数
        $allColumn = $currentSheet -> getHighestColumn();
        //获取总行数
        $allRow = $currentSheet -> getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
            //从哪列开始，A表示第一列
            $currentColumn = 'A';
            foreach($this->card_field as $k=>$v){
            //数据坐标
            $address = $currentColumn.$currentRow;
            $currentColumn++;
            //读取到的数据，保存到数组$arr中
            $arr[$currentRow][$k] = $currentSheet
                                                -> getCell($address)
                                                -> getValue();
            }
 
        }
        unset($arr[1]);//去掉第一行的标题数据
        return  $arr;
    } 
    
}
