<?php

// +----------------------------------------------------------------------
// | qcjh 内容管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.lovegq1314.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------

namespace Content\Controller;

use Common\Controller\Base;
use Content\Model\ContentModel;

class CrmController extends Base {
    
    //获取验证码
    public function cardActive(){
        $data['code'] = get_http_host() . '/index.php?g=Api&m=Checkcode&a=index&code_len=4&font_size=20&width=130&height=50&font_color=&background=';
        $this->assign('public_path', get_http_host() . '/public/');
        $card_type = M('card_config')->where(array('parent_id'=>0))->order('listorder asc')->select();
        $html_normal = ' ';
        $html_car = ' ';
        foreach($card_type as $v){
//            if($v['type'] == 1){
                $card_name = M('card_config')->where(array('parent_id'=>$v['id']))->order('listorder asc')->select();
                $html_normal .= "<option disabled style='color:#999' value='".$v['card_name']."'>".$v['card_name']."</option>" ;  
                foreach($card_name as $vv){
                    $html_normal .= "<option data-type='".$v['type']."' value='".$vv['card_name']."'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$vv['card_name']."</option>" ;  
                }
//            }else{
//                $card_name = M('card_config')->where(array('parent_id'=>$v['id']))->order('listorder asc')->select();
//                $html_car .= "<option disabled style='color:#999' value='".$v['card_name']."'>".$v['card_name']."</option>" ;  
//                foreach($card_name as $vv){
//                    $html_car .= "<option data-type='".$v['type']."' value='".$vv['card_name']."'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$vv['card_name']."</option>" ;  
//                }
//            }
        }
        $html = $html_normal.$html_car;
        $data['card_type'] = $html;
        echo json_encode($data);die;
    }
    
    //卡单验证
    public function cardVerify(){
        $card['card_name'] = I("post.card_name", "", "trim");
        $card['card_num'] = I("post.card_num", "", "trim");
        $card['verif'] = I("post.verif", "", "trim");
        $code = I("post.code", "", "trim");
        if (empty($card['card_name'])) {
            $this->error("请选择卡单类型！");
        }
        if (empty($card['card_num'])) {
            $this->error("请输入卡号！");
        }
        if (empty($card['verif'])) {
            $this->error("请输入验证码！");
        }
        //验证码开始验证
        if (!$this->verify($code)) {
            $this->error("验证码错误，请重新输入！");
        }
        $result = M('card')->field('is_active,card_num')->where($card)->find();
        if(!empty($result) && $result['is_active'] == '1'){
            $sql = 'SELECT p.content c FROM tp_card_config c INNER JOIN tp_card_config p ON c.parent_id = p.id WHERE c.card_name = "'.$card['card_name'].'"';
            $content = M('card_config')->query($sql);
            $result['content'] = $content[0]['c'];
            session('verifCode',  md5($card['card_num'].$card['verif']));
        }
        echo json_encode($result);die;
    }
    
    //卡单激活页面
    public function cardActiveDo(){
        $card_num   = I("post.card_num", "", "trim");
        $birthday   = I("post.birthday", "", trim);
        $card_verif = M('card')->field('is_active,verif,card_name')->where(array('card_num'=>$card_num))->find();
        if($card_verif['is_active'] == '2'){
            $this->error('该卡单已激活过，请勿重复激活！');
        }
        /*验证身份证激活的最大卡单数是否超限*/
        $count_card = M('card')->where(array('cred_num'=>I("post.cred_num", "", "trim"),'is_active'=>'2'))->count();
        $card_config = M('card_config')->where(array('card_name'=>$card_verif['card_name']))->find();
        if($count_card > $card_config['max_active'])
                $this->error('此身份证激活的"'.$card_verif['card_name'].'"卡单数量超过最大限制！');
        /*end*/
        $cred_check = $this->getIDCardInfo($_POST['cred_num']);
        $age = $this->birthday($cred_check['birthday']);
        if($age < $card_config['min_age'] || $age >$card_config['max_age']){
            $this->error('身份证年龄超出参保范围！');
        }
        
//        if(I("post.birthday")){
//            $eightyTime  = strtotime('1998-1-1');
//            $six_fiveTime = strtotime('1951-1-1');
//            $birthday = strtotime(I("post.birthday"));
//            if($card_verif['card_name']== '希望1号'){
//                if($birthday < $eightyTime){
//                    $this->error('参保年龄为0~18岁，您的年龄不符！');
//                }
//            }else{
//                if($birthday > $eightyTime || $birthday < $six_fiveTime){
//                    $this->error('参保年龄为18~65岁，您的年龄不符！');
//                }
//            }
//        }
        $verifCode = md5($card_num.trim($card_verif['verif']));
        if($verifCode != session('verifCode')){
            $this->error('非法激活！');
        }
        if(empty($_POST['mobile'])){
            $this->error('手机号必填！');
        }
        if(empty($_POST['cred_num'])){
            $this->error('身份证必填！');
        }
        if(isset($_POST['password'])){
                if(empty($_POST['password'])) 
                    $this->error('请输入初始密码！');
                if($_POST['password'] != $_POST['confirm_psd']) 
                    $this->error('两次输入密码不一致');
                $member['verif'] = $card_verif['verif'];
                //加密规则md5(密码 . md5(verif))
                $member['password'] = md5($_POST['password'] . md5($card_verif['verif']));
                $member['username'] = $member['mobile'] = $_POST['mobile'];
                $member['createtime'] = time();
                unset($_POST['confirm_psd']);
                unset($_POST['password']);
                M('member')->add($member);
        }
        switch($_POST['card_type_int']){
            case 1:
                $data = array(
                    'realname' => I("post.realname", "", "trim"),
                    'sex' => I("post.sex", "", "trim"),
                    'mobile' => I("post.mobile", "", "trim"),
                    'birthday' => strtotime(I("post.birthday")),
                    'addr_province' => I("post.Province", "", "trim"),
                    'addr_city' => I("post.City", "", "trim"),
                    'contract_addr' =>I("post.contract_addr"),
                    'cred_num' => I("post.cred_num", "", "trim"),
                    'start_time'=> time(),
                    'end_time'=> time() + 365*60*60*24,
                    'active_time'=> time(),
                    'is_active'=>2
                );
                break;
            case 2:
                $data = array(
                    'realname' => I("post.realname", "", "trim"),
                    'mobile' => I("post.mobile", "", "trim"),
                    'contract_addr' =>I("post.contract_addr"),
                    'num_plate' => I("post.num_plate", "", "trim"),
                    'engine_number' => I("post.engine_number", "", "trim"),
                    'car_seat_num' => I("post.car_seat_num", "", "trim"),
                    'car_type' => I("post.car_type", "", "trim"),
                    'cred_num' => I("post.cred_num", "", "trim"),
                    'start_time'=> time(),
                    'end_time'=> time() + 365*60*60*24,
                    'active_time'=> time(),
                    'is_active'=>2
                );
                break;
        }
        
        $bool = M('card')->where(array('card_num' => $card_num))->save($data);
        if($bool){   
            session('verifCode',NULL);
            switch($_POST['card_type_int']){
                case 1:
                    $push_data = array(
                                'cpmc'=>$card_verif['card_name'],
                                'xmz'=>I("post.realname", "", "trim"),
                                'xb'=>I("post.sex", "", "trim"),
                                'yxzjlx'=>'身份证',
                                'jzh'=>I("post.cred_num", "", "trim"),
                                'kh'=>$card_num,
                                'csny'=>I("post.birthday"),
                                'brlxfs'=>I("post.mobile", "", "trim"),
                                'zt'=>'在保',
                                'creator'=>'b22631250f8543c6bd34c3b930d862f5',
                        );
                    break;
                case 2;
                    $push_data = array(
                                'cpmc'=>$card_verif['card_name'],
                                'xmz'=>I("post.realname", "", "trim"),
                                'yxzjlx'=>'身份证',
                                'jzh'=>I("post.cred_num", "", "trim"),
                                'kh'=>$card_num,
                                'brlxfs'=>I("post.mobile", "", "trim"),
                                'dljySph'=>I("post.num_plate", "", "trim"),
                                'zt'=>'在保',
                                'creator'=>'b22631250f8543c6bd34c3b930d862f5',
                        );
                    break;
                    
            }
            $this->push_msg($data);
            $this->success('激活成功！');
        }else{
            $this->success('激活失败！');           
        }
    }
    
    /*
     * 激活，远程推送
     */
    protected function push_msg($data){
        $ws = "http://www.buma.net.cn:8080/BUMAWs/services/BumaDataInputService?wsdl";//webservice服务的地址
        $client = new \SoapClient ($ws);
        $result=$client->putUser($data);
        if(!$result){
            M('card')->update(array('push_result'=>$result));
        }
    }


    //卡单查询
    public  function cardSearch(){
        $cred_num = I('post.cred_num','','trim');
        $card = M('card')->field('realname,card_type,is_active,start_time,cred_num')->where(array('cred_num'=>$cred_num,'is_active'=>'2'))->select();
        foreach ($card as $k=>$v){
            $card[$k]['start_time'] = date('Y-m-d',$v['start_time']);
        }
        echo json_encode($card);
        exit;
    }
    
    //卡单查询
    public  function insuranceSearch(){
        $cred_num = I('post.cred_num','','trim');
        $insurance = M('insurance')->field('realname,cred_num,insurance_num,start_time,rescue_time')->where(array('cred_num'=>$cred_num))->select();
        foreach ($insurance as $k=>$v){
            $insurance[$k]['start_time'] = date('Y-m-d',$v['start_time']);
            $insurance[$k]['rescue_time'] = date('Y-m-d',$v['rescue_time']);
        }
        echo json_encode($insurance);
        exit;
    }
    
    /*
     * ajax验证手机号是否已经激活过卡单
     */
    public function ajaxCheckMobile(){
        $mobile = I('post.mobile','',trim);
        $activeNum = M('card')->where(array('mobile'=>$mobile))->count();
        
        echo false;
    }
    
    function getIDCardInfo($IDCard){ 
        $result['error']=0;//0：未知错误，1：身份证格式错误，2：无错误 
        $result['flag']='';//0标示成年，1标示未成年 
        $result['tdate']='';//生日，格式如：2012-11-15 
        if(!eregi("^[1-9]([0-9a-zA-Z]{17}|[0-9a-zA-Z]{14})$",$IDCard)){ 
            $result['error']=1; 
            return $result; 
        }else{ 
            if(strlen($IDCard)==18){ 
                $tyear=intval(substr($IDCard,6,4)); 
                $tmonth=intval(substr($IDCard,10,2)); 
                $tday=intval(substr($IDCard,12,2)); 
                if($tyear>date("Y")||$tyear<(date("Y")-100)){ 
                    $flag=0; 
                }elseif($tmonth<0||$tmonth>12){ 
                    $flag=0; 
                }elseif($tday<0||$tday>31){ 
                    $flag=0; 
                }else{ 
                    $tdate=$tyear."-".$tmonth."-".$tday." 00:00:00"; 
                    if((time()-mktime(0,0,0,$tmonth,$tday,$tyear))>18*365*24*60*60){ 
                        $flag=0; 
                    }else{ 
                        $flag=1; 
                    } 
                } 
            }elseif(strlen($IDCard)==15){ 
                $tyear=intval("19".substr($IDCard,6,2)); 
                $tmonth=intval(substr($IDCard,8,2)); 
                $tday=intval(substr($IDCard,10,2)); 
                if($tyear>date("Y")||$tyear<(date("Y")-100)){ 
                    $flag=0; 
                }elseif($tmonth<0||$tmonth>12){ 
                    $flag=0; 
                }elseif($tday<0||$tday>31){ 
                    $flag=0; 
                }else{ 
                    $tdate=$tyear."-".$tmonth."-".$tday." 00:00:00"; 
                    if((time()-mktime(0,0,0,$tmonth,$tday,$tyear))>18*365*24*60*60){ 
                        $flag=0; 
                    }else{ 
                        $flag=1; 
                    } 
                } 
            } 
        } 
        $result['error']=2;//0：未知错误，1：身份证格式错误，2：无错误 
        $result['isAdult']=$flag;//0标示成年，1标示未成年 
        $result['birthday']=$tdate;//生日日期 
        return $result; 
    } 
    
    function birthday($birthday){ 
        $age = strtotime($birthday); 
        if($age === false){ 
         return false; 
        } 
        list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
        $now = strtotime("now"); 
        list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
        $age = $y2 - $y1; 
        if((int)($m2.$d2) < (int)($m1.$d1)) 
         $age -= 1; 
        return $age; 
       } 
}

