<?php

/*
 * CRM管理
 * 人员管理、卡单管理、
 * @author   kelleyxuan@163.com
 */

namespace admin\Controller;

use Common\Controller\AdminBase;
use Admin\Service\User;
use Libs\System\RBAC;

class CrmController extends AdminBase {

    protected $config = array(
        'is_active' => array('1' => '未激活', '2' => '已激活')
    );
    
    //查询条件保存前缀
    protected $_prefix = '';
    //导入的字段
    protected $card_field = array(
        'card_type' => '卡类型',
        'card_name' => '卡名称',
        'card_num' => '卡号',
        'verif' => '校验码',
        'active_time' => '激活日期',
        'realname' => '用户(车主)姓名',
        'sex' => '性别',
        'mobile' => '手机号码',
        'contract_addr' => '联系地址',
        'cred_type' => '证件类型',
        'cred_num' => '证件号码',
        'birthday' => '出生日期',
        'addr_province' => '省份',
        'addr_city' => '城市',
        'contract_name' => '紧急联系人',
        'contract_way' => '紧急联系方式',
        'car_type'=>'车辆类型',
        'num_plate'=>'车牌号',
        'engine_number'=>'发动机号',
        'car_seat_num'=>'核定 座位数',
        
    );
    protected $tmp_table = array(
        'card_type' => '幸福家园系列',
        'card_name' => '幸福1号',
        'card_num' => '201601060011',
        'verif' => '231350',
        'active_time' => '2016-11-01 21:59:51',
        'realname' => '王某',
        'sex' => '男',
        'mobile' => '15823356721',
        'contract_addr' => '武汉市洪山区大东街',
        'cred_type' => '身份证',
        'cred_num' => '420914199208692331',
        'birthday' => '2016-11-01',
        'addr_province' => '湖北',
        'addr_city' => '武汉',
        'contract_name' => '哥哥',
        'contract_way' => '15028761981',
        'car_type'=>'营运2-5座客车',
        'num_plate'=>'粤B 999999',
        'engine_number'=>'C198C88008',
        'car_seat_num'=>'4',
    );

    protected function _initialize() {
        parent::_initialize();
        //检查是否登录
        if (User::getInstance()->isLogin() == false) {
            //跳转到登录界面
            redirect(C('USER_AUTH_GATEWAY'));
        }
        session_start();
        $this->_prefix = 'admin';
        $this->userInfo = User::getInstance()->getInfo();
        $this->assign('config', $this->config);
    }

    //会员列表
    public function cardList() {
        $user_id = $this->userInfo['id'];
        $userStr = $user_id;
        if(empty($_POST) && empty($_GET['page'])){
            unset($_SESSION[$this->_prefix."_".__CLASS__."_".__FUNCTION__]);
        }
       //var_dump($_POST);die;
//        //普通卡还是车卡
//        $type = $_GET['type']?2:1;
        //var_dump(session($this->_prefix."_".__CLASS__."_".__FUNCTION__));die;
        if ($_POST) {
            $post = $_POST;
            session($this->_prefix."_".__CLASS__."_".__FUNCTION__,$post);
            $where = $this->createWhere($post);
            if ($post['user_id'])
                $userStr = $post['user_id'];
            $this->assign('post', $post);
        }else if(session($this->_prefix."_".__CLASS__."_".__FUNCTION__)){
            $post = session($this->_prefix."_".__CLASS__."_".__FUNCTION__);
            $where = $this->createWhere($post);
            if ($post['user_id'])
                $userStr = $post['user_id'];
            $this->assign('post', $post);
        }
        else{
            $where = ' 1 = 1 '; //' card_type_int = '.$type;
        }
        if ($_GET['user_id']) {
            $userStr = $_GET['user_id'];
        }
        
        //检查权限
        $child_user = $this->get_child_user($user_id);
        if (!in_array($userStr, $child_user)) {
            $this->error('无权限访问！');
        }
        if ($user_id != '1') {
            $where .=' and importId in (' . $userStr . ')';
        }
        $db = M('card');
        $count = $db->where($where)->count();
        $page = $this->page($count, 20);
        $vipList = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('listorder desc')->select();
        //var_dump($vipList);die;
        $roleSql = 'SELECT * FROM tp_role WHERE parentid = 1';
        $roleResult = M('role')->query($roleSql);

        $type = M('card_config')->where(array('parent_id' => 0))->select();
        $this->assign('type', $type);
        $this->assign('role', $roleResult);
        $this->assign('name', M('user')->getFieldById($userStr, 'nickname'));
        $this->assign('user_id', $user_id);
        $this->assign("Page", $page->show());
        $this->assign("vipList", $vipList);

        $this->display();
    }

    /*
     * 根据用户id 获取下级所有用户
     */

    public function get_child_user($user_id) {
        $role_id = M('user')->getFieldById($user_id, 'role_id');
        $child_role_id = D("Admin/role")->getArrchildid($role_id);
        $userArr = M('user')->field('id')->where(array('role_id' => array('in', $child_role_id)))->select();
        $userIdArr = array();
        foreach ($userArr as $v) {
            $userIdArr[] = $v['id'];
        }

        return $userIdArr;
    }

    public function createWhere($post, $type) {
        foreach($post as $k=>$v){
            $post[$k] = trim($v);
        }
        $where = '1 and ';
        if (!empty($post['stuff'])) {
            $where .= ' importId = ' . $post['stuff'] . ' and ';
            $child_role_id = D("Admin/role")->getArrchildid($roleId);
            $child_role_id = $child_role_id . ',' . $roleId;
            $userArr = M('user')->field('id,nickname')->where(array('role_id' => array('in', $child_role_id)))->select();
            $userIdArr = array();
            foreach ($userArr as $v) {
                $userIdArr[$v['id']]['id'] = $v['id'];
                $userIdArr[$v['id']]['name'] = $v['nickname'];
            }
        } else if (!empty($post['section']) || !empty($post['area'])) {
            $roleId = $post['section'] ? $post['section'] : $post['area'];
            $child_role_id = D("Admin/role")->getArrchildid($post['section']);
            $child_role_id = $child_role_id . ',' . $roleId;
            $userArr = M('user')->field('id,nickname')->where(array('role_id' => array('in', $child_role_id)))->select();
            $userIdArr = array();
            foreach ($userArr as $v) {
                $userIdArr[] = $v['id'];
            }
            $userStr = implode(',', $userIdArr);
            $where .= " importId in(" . $userStr . ") and ";
        }
        $where .=!empty($post['card_type']) ? 'card_type like "%' . $post['card_type'] . '%" and ' : '';
        $where .=!empty($post['card_name']) ? 'card_name like "%' . $post['card_name'] . '%" and ' : '';
        $where .=!empty($post['is_active']) ? 'is_active=' . $post['is_active'] . ' and ' : '';
        $where .=!empty($post['start_time']) ? $post['time_type'] . ' >= ' . strtotime($post['start_time']) . ' and ' : '';
        $where .=!empty($post['end_time']) ? $post['time_type'] . ' < ' . strtotime($post['end_time']) . ' and ' : '';
        $where .=!empty($post['card_num']) ? 'card_num like "%' . $post['card_num'] . '%"' : ' 1';

        return $where;
    }

    /*
     * @time     2016/9/5
     * 卡单激活
     * @author   xuxuan
     */

    public function cardActive() {
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
        } else {
            $this->error("非法操作");
        }
    }

    //添加会员
    public function cardAdd() {
        if (IS_POST) {
            foreach ($_POST as $k => $v) {
                $data[$k] = I('post.' . $k, '', trim);
            }
            if (empty($data['card_name'])) {
                $this->error('产品名称必填！');
            }
            $data['create_time'] = time();
            if ($data['birthday'])
                $data['birthday'] = strtotime($data['birthday']);
            $data['importId'] = User::getInstance()->id;
            if ($data['is_active'] == 2 ) {
                if (!D('Card')->create()) {
                    $this->error(D('Card')->getError());
                }
                $data['active_time'] = time();
            }
            if (isset($data['password'])) {
                if ($data['is_active'] == 2) {
                    if (empty($data['password']))
                        $this->error('请设置初始密码！');
                    if ($data['password'] != $data['confirm_psd'])
                        $this->error('两次输入密码不一致');
                }
                $member['verif'] = $data['verif'];
                //加密规则md5(密码 . md5(verif))
                $member['password'] = md5($data['password'] . md5($data['verif']));
                $member['username'] = $member['mobile'] = $data['mobile'];
                $member['createtime'] = time();
                unset($data['confirm_psd']);
                unset($data['password']);
            }
            //检测卡号是否已存在
            $checkUser = M('card')->where(array('card_num' => $data['card_num']))->find();
            if ($checkUser) {
                $this->error('此卡号已存在');
            } else {
                $card_num = M('card')->add($data);
            }
            if ($card_num) {
                if ($data['is_active'] == 2) {
                    if ($member['password']) {
                        M('member')->add($member);
                    }
                    if ($data['is_active']) {
                        if($data['car_type']){
                            $push_data = array(
                                'cpmc'=>$data['card_name'],
                                'xmz'=>$data['realname'],
                                'yxzjlx'=>'身份证',
                                'jzh'=>$data['cred_num'],
                                'kh'=>$data['card_num'],
                                'brlxfs'=>$data['mobile'],
                                'dljySph'=>$data['num_plate'],
                                'zt'=>'在保',
                                'creator'=>'b22631250f8543c6bd34c3b930d862f5',
                            );
                        }else{
                            $push_data = array(
                                'cpmc' => $data['card_name'],
                                'xmz' => $data['realname'],
                                'xb' => $data['sex'],
                                'yxzjlx' => '身份证',
                                'jzh' => $data['cred_num'],
                                'kh' => $data['card_num'],
                                'csny' => $data['birthday'],
                                'brlxfs' => $data['mobile'],
                                'zt' => '在保',
                                'creator' => 'b22631250f8543c6bd34c3b930d862f5',
                            );
                        }
                        $card_config = M('card_config')->where(array('card_name'=>$data['card_name']))->find();
                        if($card_config['is_push']){
                            $this->push_msg($push_data);
                        }
                    }
                }
                $this->success('卡单添加成功', U('Crm/cardList'));
            } else {
                $this->error('卡单添加失败');
            }
        } else {
            $type = M('card_config')->where(array('parent_id' => 0))->select();
            $this->assign('type', $type);
            $this->display();
        }
    }

    //修改会员信息
    public function cardEdit() {
        $card_num = I('get.card_num', '', '');
        if (IS_POST) {
            foreach ($_POST as $k => $v) {
                $data[$k] = I('post.' . $k, '', trim);
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
                $new_data = M('card')->where(array('id' => $data['id']))->find();
                S('member_info_' . $data['id'], $new_data, 7200);
                $this->success('修改成功', U('Crm/cardList'));
            } else {
                $this->error('修改失败！');
            }
        } else {
            $vipList = M('card')->where(array('card_num' => $card_num))->find();
            $vipList['card_type'] = trim($vipList['card_type']); 
            $vipList['card_type_name'] = M('card_config')->where(array('parent_id' => 0))->select();
            $sql = "SELECT c.*  from tp_card_config c  JOIN tp_card_config p ON c.parent_id = p.id WHERE p.card_name = '" . $vipList['card_type'] . "'";
            $vipList['product'] = M('card_config')->query($sql);
            $card_type = M('card_config')->where(array('card_name'=>$vipList['card_type']))->find();
            $vipList['card_type_int'] = $card_type['type'];
            $this->assign($vipList);
            $this->display();
        }
    }

    //会员删除
    public function cardDelete() {
        if (IS_POST) {
            $numArr = I('post.');
            if (is_array($numArr)) {
                foreach ($numArr['id'] as $k => $v) {
                    $cardArr[] = $v;
                }
                $bool = M('card')->where(array('id' => array('IN', $cardArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('Crm/cardList',array('page'=>1)));
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
                $this->success("删除成功", U('Crm/cardList',array('page'=>1)));
            } else {
                $this->error("非法操作");
            }
        }
    }

    //排序
    public function listorder() {
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
            case "card_config":
                $db = M('card_config');
                $a = 'Crm/cardConfig';
                $id = 'id';
                break;
        }
        foreach ($info['listorder'] as $k => $v) {
            $db->where(array($id => $k))->save(array('listorder' => $v));
        }
        $this->success('排序成功！', U($a));
    }

    //修改卡单最大激活数
    public function updateNum() {
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
            case "card_config":
                $db = M('card_config');
                $a = 'Crm/cardConfig';
                $id = 'id';
                break;
        }
        foreach ($info['num'] as $k => $v) {
            $db->where(array($id => $k))->save(array('max_active' => $v));
        }
        $this->success('修改成功！', U($a));
    }
    
    
    //修改卡单最大激活数
    public function updateLimitAge() {
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
            case "card_config":
                $db = M('card_config');
                $a = 'Crm/cardConfig';
                $id = 'id';
                break;
        }
        foreach ($info['min_age'] as $k => $v) {
            $db->where(array($id => $k))->save(array('min_age' => $v));
        }
        foreach ($info['max_age'] as $k => $v) {
            $db->where(array($id => $k))->save(array('max_age' => $v));
        }
        $this->success('修改成功！', U($a));
    }
    
    //修改是否显示告知函
    public function updateContentL() {
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
            case "card_config":
                $db = M('card_config');
                $a = 'Crm/cardConfig';
                $id = 'id';
                break;
        }
        $sql= 'update tp_card_config set is_content = 0';
        $db->query($sql);
        foreach ($info['is_content'] as $k => $v) {
            $db->where(array($id => $k))->save(array('is_content' => $v));
        }
        $this->success('修改成功！', U($a));
    }
    //修改是否推送
    public function updatePushL() {
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
            case "card_config":
                $db = M('card_config');
                $a = 'Crm/cardConfig';
                $id = 'id';
                break;
        }
        $sql= 'update tp_card_config set is_push = 0';
        $db->query($sql);
        foreach ($info['is_push'] as $k => $v) {
            $db->where(array($id => $k))->save(array('is_push' => $v));
        }
        $this->success('修改成功！', U($a));
    }

    //修改会员信息
    public function typeUpdate() {
        $id = I('get.id', '', '');
        if (IS_POST) {
            foreach ($_POST as $k => $v) {
                $data[$k] = I('post.' . $k, '', trim);
            }
            $data['content'] = I('post.content', 1, trim);
            //检测是否重名
            $bool = M('card_config')->where(array('id' => $id))->save($data);
            if ($bool) {
                $this->success('修改成功', U('Crm/cardConfig'));
            } else {
                $this->error('修改失败！');
            }
        } else {
            $vipList = M('card_config')->where(array('id' => $id))->find();
            $this->assign($vipList);
            $this->display();
        }
    }

    //随机生成N位数字和字符串
    public function getVerif($len, $chars = null) {
        if (is_null($chars)) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        mt_srand(10000000 * (double) microtime());
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
        $user_id = $this->userInfo['id'];
        $userStr = $user_id;
        if ($_GET['user_id']) {
            $userStr = $_GET['user_id'];
        }
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
        $this->card_field = $this->card_field + array('area'=>'区域','section'=>'部门','name'=>'销售');
        if (I('get.type') == 'tmp') {
            $arr = array();
            $arr[0] = $this->card_field;
            $arr[1] = $this->tmp_table;
        }else{
            $where = $this->createWhere($_POST);
            if ($user_id != '1') {
                $where .=' and importId in (' . $userStr . ')';
            }
            $arr = M('card')->where($where)->select();
            array_unshift($arr, $this->card_field);
        }
        $role_area = $this->selectUserArea();
        foreach ($arr as $key => $val) { // 注意 key 是从 0 还是 1 开始，此处是 0
            $num = $key + 1;
            $object = $Excel->setActiveSheetIndex(0);
            $abcKey = 'A';
            foreach ($this->card_field as $k => $v) {
                
                //Excel的第A列，uid是你查出数组的键值，下面以此类推     
                if (($k == 'start_time' || $k == 'end_time' || $k == 'birthday' || $k == 'active_time') && $num != 1) {
                    $val[$k] = $val[$k]?date('Y-m-d H:i:s', $val[$k]):'';
                }
                if(($k == 'area' || $k == 'section' || $k == 'name' )&& $num != 1){
                    $val[$k] = $role_area[$val['importId']][$k];
                }
                $object->setCellValue($abcKey . $num, $val[$k].' ',\PHPExcel_Cell_DataType::TYPE_STRING);
                $abcKey++;
            }
        }
        $Excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $Excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $Excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $Excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $Excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $Excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $Excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $Excel->getActiveSheet()->setTitle('export');
        $Excel->getActiveSheet()->getStyle()->getFont()->setName('宋体');
        $Excel->setActiveSheetIndex(0);
        $name = 'example_export.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=' . $name);
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
                    $cardMdl = M('card');
                    $userInfo = User::getInstance()->getInfo();
                    foreach ($data as $k => $v) {
                        foreach($v as $kk=>$vv){
                            $v[$kk] = trim($vv);
                        }
                        $v['start_time'] = strtotime($v['start_time']);
                        $v['end_time'] = strtotime($v['end_time']);
                        $v['create_time'] = time();
 
                        if(!empty($v['cred_num']) && !empty($v['active_time'])){
                            $v['is_active'] = 2;
                            $v['push_result'] = 3;
                        }
                        $v['birthday'] = $v['birthday']?strtotime($v['birthday']):'';
                        $v['active_time'] = $v['active_time']?strtotime($v['active_time']):'';
                        $v['importId'] = $userInfo['id'];
                        $find_data = $cardMdl->where(array('card_num' => $v['card_num']))->find();
                        if ($find_data) {
                            echo '卡号：' . $v['card_num'] . '已经存在，不能重复导入！</br>';
                            $result = true;
                            continue;
                        }
                        $insertRes = $cardMdl->add($v);
                        if (!$insertRes) {
                            echo '卡号：' . $v['card_num'] . '导入失败！</br>';
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
            $this->error('请选择上传文件！', U('Crm/cardList'));
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
            foreach ($this->card_field as $k => $v) {
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

    public function cardConfig() {
        $card_type = M('card_config')->where(array('parent_id' => 0))->order('listorder asc')->select();
        $html_nomal = array();
        $html_car = array();
        foreach ($card_type as $v) {
            $card_name = M('card_config')->where(array('parent_id' => $v['id']))->order('listorder asc')->select();
            if ($v['type'] == 1) {
                $html_nomal[] = $v;
                foreach ($card_name as $vv) {
                    $html_nomal[] = $vv;
                }
            } else {
                $html_car[] = $v;
                foreach ($card_name as $vv) {
                    $html_car[] = $vv;
                }
            }
        }
        $this->assign('nomal_card', $html_nomal);
        $this->assign('car_card', $html_car);
        $this->display();
    }

    public function typeAdd() {
        if ($_POST['card_name']) {
            $data['card_name'] = $_POST['card_name'];
            $data['type'] = $_POST['type'];
            $data['content'] = $_POST['content'];
            $data['create_user'] = $this->userInfo['id'];
            $data['create_time'] = time();
            $result = M('card_config')->where(array('card_name' => $data['card_name']))->find();
            if ($result) {
                $this->error("卡单类型已存在");
            }
            $result = M('card_config')->add($data);
            if ($result) {
                $this->success("添加成功", U('Crm/cardConfig'));
            } else {
                $this->error("非法操作");
            }
        }
        $this->display();
    }

    public function productAdd() {
        if ($_POST['card_name']) {
            $data['card_name'] = $_POST['card_name'];
            $data['parent_id'] = $_POST['parent_id'];
            $data['create_user'] = $this->userInfo['id'];
            $data['create_time'] = time();
            $result = M('card_config')->where(array('card_name' => $data['card_name']))->find();
            if ($result) {
                $this->error("产品名已存在");
            }
            $result = M('card_config')->add($data);
            if ($result) {
                $this->success("添加成功", U('Crm/cardConfig'));
            } else {
                $this->error("非法操作");
            }
        }
        if ($_GET['id']) {
            $this->assign('id', $_GET['id']);
        }
        $type = M('card_config')->where(array('parent_id' => 0))->select();
        $this->assign('type', $type);
        $this->display();
    }

    //产品删除
    public function productDelete() {
        if (IS_POST) {
            $numArr = I('post.');
            if (is_array($numArr)) {
                foreach ($numArr['id'] as $k => $v) {
                    $cardArr[] = $v;
                }
                $bool = M('card_config')->where(array('id' => array('IN', $cardArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('Crm/cardConfig'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $vipid = I('get.id', '', intval);
            $bool = M('card_config')->where(array('id' => $vipid))->delete();
            if ($bool) {
                $this->success("删除成功", U('Crm/cardConfig'));
            } else {
                $this->error("非法操作");
            }
        }
    }

    //产品删除
    public function typeDelete() {
        if (IS_POST) {
            $numArr = I('post.');
            if (is_array($numArr)) {
                foreach ($numArr['id'] as $k => $v) {
                    $cardArr[] = $v;
                }
                $bool = M('card_config')->where(array('id' => array('IN', $cardArr)))->delete();
                if ($bool) {
                    $this->success("删除成功", U('Crm/cardConfig'));
                } else {
                    $this->error("删除失败");
                }
            } else {
                $this->error("非法操作");
            }
        } else {
            $vipid = I('get.id', '', intval);
            $card = M('card_config')->where(array('parent_id' => $vipid))->select();
            if ($card) {
                $this->error("该卡单类型下还有产品，删除失败");
            }
            $bool = M('card_config')->where(array('id' => $vipid))->delete();
            if ($bool) {
                $this->success("删除成功", U('Crm/cardConfig'));
            } else {
                $this->error("非法操作");
            }
        }
    }

    /*
     * ajax根据卡单类型获取产品名称
     */

    public function ajaxGetProduct() {
        $card_type = $_POST['card_type'];
        $card_name = $_POST['card_name'];
        $sql = "SELECT c.*  from tp_card_config c  JOIN tp_card_config p ON c.parent_id = p.id WHERE p.card_name = '" . $card_type . "'";
        $product_list = M('card_config')->query($sql);
        if ($product_list) {
            $product_html = '<option value="">选择产品名称</option>';
            foreach ($product_list as $v) {
                if ($card_name == $v['card_name']) {
                    $product_html .= '<option selected  value=' . $v['card_name'] . '>' . $v['card_name'] . '</option>';
                } else {
                    $product_html .= '<option  value=' . $v['card_name'] . '>' . $v['card_name'] . '</option>';
                }
            }
            echo json_encode(array('res' => 'success', 'data' => $product_html));
            exit;
        } else {
            echo json_encode(array('res' => 'faile', 'msg' => '未查到对应产品！'));
            exit;
        }
    }

    /*
     * ajax验证手机号是否已经激活过卡单
     */

    public function ajaxCheckMobile() {
        $mobile = I('post.mobile', '', trim);
        $activeNum = M('card')->where(array('mobile' => $mobile))->count();
        echo $activeNum;
    }

    /*
     * 激活，远程推送
     */

    protected function push_msg($data) {
        $ws = "http://www.buma.net.cn:8080/BUMAWs/services/BumaDataInputService?wsdl"; //webservice服务的地址
        $client = new \SoapClient($ws);
        $result=$client->putUser($data);
        if($result->return){
            $sql = 'update tp_card set push_msg = "'.$result->return.'",push_result = 2 where card_num = "'.$data['kh'].'"';
            M('card')->query($sql);
        }
    }

    /*
     * ajax  根据id查询role子类
     */

    public function ajaxSelectRole() {
        $roleId = (int) $_POST['role'];
        $role = M('role')->getFieldById($roleId, 'levle');
        if ($role == 3) {
            $child_role_id = D("Admin/role")->getArrchildid($roleId);
            $child_role_id = $child_role_id . ',' . $roleId;
            $userArr = M('user')->field('id,nickname')->where(array('role_id' => array('in', $child_role_id)))->select();
            $userIdArr = array();
            foreach ($userArr as $v) {
                $userIdArr[$v['id']]['id'] = $v['id'];
                $userIdArr[$v['id']]['name'] = $v['nickname'];
            }
            echo json_encode($userIdArr);
            die;
        }
        $result = M('role')->where(array('parentid' => $roleId))->select();

        echo json_encode($result);
    }
    
    public function selectUserArea(){
        $user_list = M('user')->select();
        $role_arr = array();
        foreach($user_list as $v){
            $sql = "SELECT s.levle,s.name,b.name section,q.name area FROM tp_role s INNER JOIN tp_role b ON  s.parentid = b.id INNER JOIN tp_role q ON b.parentid = q.id  WHERE s.id = ".$v['role_id'];
            $user_rol = M('role')->query($sql);
            if($user_rol[0]['levle'] == 4){
                $role_arr[$v['id']]['area'] = $user_rol[0]['area'];
                $role_arr[$v['id']]['section'] = $user_rol[0]['section'];
            }else if($user_rol[0]['levle'] == 3){
                $role_arr[$v['id']]['area'] = $user_rol[0]['section'];
                $role_arr[$v['id']]['section'] = $user_rol[0]['name'];
            }else if(!$user_rol[0]['levle']){
                $sql = "select levle,name from tp_role where id = ".$v['role_id'];
                $area_rol = M('role')->query($sql);
                if($area_rol[0]['levle'] == 2){
                    $role_arr[$v['id']]['area'] = $area_rol[0]['name'];
                } 
            }
            $role_arr[$v['id']]['name'] = $v['nickname'];

        }
        return $role_arr;
        
    }
    
    public function again_push(){
        $this->error('暂停使用');die;
        $ws = "http://www.buma.net.cn:8080/BUMAWs/services/BumaDataInputService?wsdl";//webservice服务的地址
        $client = new \SoapClient ($ws);
        
        $user =  M('card')->where(array('is_active'=>2))->select();
        foreach($user as $data){
            
            if(!empty($data['car_type'])){
                $push_data = array(
                    'cpmc'=>$data['card_name'],
                    'xmz'=>$data['realname'],
                    'yxzjlx'=>'身份证',
                    'jzh'=>$data['cred_num'],
                    'kh'=>$data['card_num'],
                    'brlxfs'=>$data['mobile'],
                    'dljySph'=>$data['num_plate'],
                    'zt'=>'在保',
                    'creator'=>'b22631250f8543c6bd34c3b930d862f5',
                );
            }else{
                echo 1;
                $push_data = array(
                    'cpmc' => $data['card_name'],
                    'xmz' => $data['realname'],
                    'xb' => $data['sex'],
                    'yxzjlx' => '身份证',
                    'jzh' => $data['cred_num'],
                    'kh' => $data['card_num'],
                    'csny' => date('Y-m-d',$data['birthday']),
                    'brlxfs' => $data['mobile'],
                    'zt' => '在保',
                    'creator' => 'b22631250f8543c6bd34c3b930d862f5',
                );
            }
            $result=$client->putUser($push_data);
            if($result->return){
                $sql = 'update tp_card set push_msg = "'.$result->return.'",push_result = 2 where card_num = "'.$push_data['kh'].'"';
                M('card')->query($sql);       
                echo $push_data['kh']."<font color='red'>失败</font></br>";
                
            }else{
                $sql = 'update tp_card set push_msg = "",push_result = 1 where card_num = "'.$push_data['kh'].'"';
                M('card')->query($sql);     
                echo $push_data['kh']."成功</br>";
            }
        }
        
    }

}
