<?php

/*
 * 募捐管理
 * 
 * @author   kelleyxuan@163.com
 */

namespace admin\Controller;

use Common\Controller\AdminBase;
use Admin\Service\User;

class CollectionController extends AdminBase{
    
    protected function _initialize()
    {
        parent::_initialize();
        session_start();
        $this->userInfo = User::getInstance()->getInfo();
        $this->assign('config',$this->config);
        //处理图片上传问题
        $this->disposeUpload();
        
    }
    
    /*
     *  募捐列表
     */
    public function index($msg = ''){
        /*更新过期募捐状态*/
        $result = $this->change_status($msg);
        if(!$result){
            $this->error($msg);
        }
        /*end*/
        $post = $_POST;
        if($post){
            $where = $this->createWhere($post);
            $this->assign('post',$post);
        }else{
            $where = '1 = 1';
        }
        $db = M('Collection');
        $count = $db->where($where)->count();
        $page = $this->page($count, 20);
        $sql = 'SELECT *,MAX(period) AS period,SUM(com_num) AS com_num,MIN(status) AS status,MAX(times) AS times '
                . 'FROM tp_collection WHERE '.$where.' GROUP BY number ORDER BY field(status,3,1,2),id DESC LIMIT  '.$page->firstRow . ',' . $page->listRows;
        $vipList = M("Collection")->query($sql);
        $this->assign("Page", $page->show());
        $this->assign("vipList", $vipList);
        $this->display();
    }
    
    /*
     *  发起募捐
     */
    public function add(){
        $mem_count = M('card')->where(array('is_active'=>'2'))->count();
        if($_POST){
            $mdl_collection = D('Collection');
            if(!$mdl_collection->create()){
                $this->error($mdl_collection->getError());
            }else{
                $data = $_POST;
                $data['number']    = $this->userInfo['id'].time();
                $data['initiator'] = $this->userInfo['id'];
                $data['period']    = strtotime($data['period']);
                $interval = $data['period'] - time();
                if($data['member_num'] > $mem_count){
                    $this->error('捐款人数超过最大人数！');
                }else if($data['aver_money'] * $data['member_num'] != $data['total_money']){
                    $this->error('捐款金额有误，请重新输入！');
                }
                
                $data['issue_time'] = time();
                $mem_arr = $this->select_member($data['member_num'],' where is_active = 2 ');
                $data['member'] = serialize($mem_arr);
                $result = $mdl_collection->add($data);
                if($result){
                    $collection_id = $mdl_collection->getLastInsID();
                    $collection    = $mdl_collection->where(array('id'=>$collection_id))->find();
                    $msg = "发布成功！";
                    $result2 = $this->insert_donation($collection,$msg);
                    if(!$result2){
                        $this->error($msg);
                    }else{
                        $result3 = $this->add_times($mem_arr,$msg);
                        if(!$result3){
                           $this->error($msg); 
                        }
                    }
                    $this->success('发布成功！',U('index'));
                }else{
                    $this->error('发布失败！');
                }
            }           
        }
        $this->assign('max_mem',$mem_count);
        $this->display();
        
    }
    
    /*
     * 募捐重启
     */
    public function again_collection(){
        $mem_count = M('card')->count();
        $msg = "发布成功！";
        if($_POST){
            $mdl_collection = D('Collection');
            if(!$mdl_collection->create()){
                $this->error($mdl_collection->getError());
            }else{
                $data = $this->get_data($_POST['number'], $msg);
                $data['period']    = strtotime($_POST['period']);
                $interval = $data['period'] - $data['issue_time'];
                if($data['member_num'] > $mem_count){
                    $this->error('捐款人数超过最大人数！');
                }else if($data['aver_money'] * $data['member_num'] != $data['total_money']){
                    $this->error('捐款金额有误，请重新输入！');
                }
                var_dump($data);die;
                $result = $mdl_collection->add($data);
                if($result){
                    $collection_id = $mdl_collection->getLastInsID();
                    $collection    = $mdl_collection->where(array('id'=>$collection_id))->find();
                    $result2 = $this->insert_donation($collection,$msg);
                    if(!$result2){
                        $this->error($msg);
                    }else{
                        $mem_arr = unserialize($data['member']);
                        $result3 = $this->add_times($mem_arr,$msg);
                        if(!$result3){
                           $this->error($msg); 
                        }
                    }
                    $this->success('发布成功！',U('detail',array('number'=>$data['number'])));
                }else{
                    $this->error('发布失败！');
                }
            }           
        }
        $base64_num = $_GET['id'];
        $number     = base64_decode($base64_num);
        $sql        = 'select * from tp_collection where number = '.$number.' order by id desc';
        $data     = $this->get_data($number,$msg);
        if(!$data){
            $this->error($msg);
        }

        $this->assign('data',$data);
        $this->assign('max_mem',$mem_count);
        $this->display(); 
    }
    
    /*
     * 计算重新募捐的数据
     */
    protected function get_data($number,&$msg){
        $sql        = 'select * from tp_collection where number = '.$number.' order by id desc';
        $result     = M('Collection')->query($sql);
        $result     = $result[0];
        if($result){
            $data = array();
            $data['number'] = $number;
            $data['title']  = $result['title'];
            $data['content']  = $result['content'];
            $data['col_thumb'] = $result['col_thumb'];
            $data['initiator'] = $this->userInfo['id'];
            $data['issue_time'] = time();
            $data['period'] = $result['period'];
            $data['member_num'] = $result['member_num'] - $result['com_num'];
            $data['aver_money'] = $result['aver_money'];
            $data['total_money'] = $data['aver_money']*$data['member_num'];
            $data['times'] = $result['times'] + 1;
            /*之前捐款的人不参与后续募捐*/
            $sql2        = 'select member from tp_collection where number = '.$number;
            $result2     = M('Collection')->query($sql2);
            if(is_array($result2)){
                $result_mem_arr = array();
                foreach($result2 as $v){
                    $mem_arr = unserialize($v['member']); 
                    $result_mem_arr = array_merge($result_mem_arr,$mem_arr);
                }
            }    
            $result_mem_str = implode(',', $result_mem_arr);
            $where = ' where id not in('.$result_mem_str.') and is_active = 2 ';
            $max_mem_num = $this->select_member($data['member_num'],$where);
            $member_num = count($max_mem_num);
            //如果可捐款人数不足，则从之前的募捐中捐款失败的人中重新抽取
            if($member_num < $data['member_num']){
                $member_num2 = $data['member_num'] - $member_num;
                $sql = 'select donation_user_id from tp_donation where status = 3 and collection_num = '.$data['number'].' limit 0,'.$member_num2;
                $faile_member = M('Donation')->query($sql);
                $arr_mem  = array();
                if(is_array($faile_member)){
                    foreach($faile_member as $v){
                        $arr_mem[] = $v['donation_user_id'];
                    }
                }
                $total_member = array_merge($arr_mem,$max_mem_num);
            }
            
            $data['member'] = serialize($total_member);
            /*end*/
            return $data;
        }else{
            $msg = '获取募捐信息失败！';
            return false;
        }
    }


    /*
     *系统抽选捐款人员
     *@param  int $num_mem   //计划捐款人数
     *@param  inf $times     //募捐发起的次数  
     */
    public function select_member($num_mem,$where=''){
        //成功捐款次数正序、参与捐款总次数正序、最近捐款时间倒叙
        $sql = "select id from tp_card ".$where." order by donation_times_succ asc,donation_times_totol asc,donation_lately_time asc limit 0,".$num_mem;
        $mem_list = M('card')->query($sql);
        $arr_mem  = array();
        if(is_array($mem_list)){
            foreach($mem_list as $v){
                $arr_mem[] = $v['id'];
            }
        }
        return $arr_mem;
    }
    
    /*
     * 过期的募捐更改募捐状态
     */
    protected function change_status(&$msg){
        $time = time();
        $sql = 'select id from tp_collection where period < '.$time.' and status = 1';
        $result = M('Collection')->query($sql);
//        if(is_array($result)){
            foreach($result as $v){
                //修改募捐状态
                $sql2 = 'update tp_collection set status=3 where id = '.$v['id'];
                $result2 = M('Collection')->query($sql2);   
                //修改捐款记录捐款状态1
                if(is_array($result2)){
                    $sql3 = 'update tp_donation set status=3 where status = 1 and collection_id = '.$v['id'];
                    $result3 = M('Donation')->query($sql3);  
                    if(is_array($result3)){
                       //修改会员表捐款失败的会员失败捐款次数
                       $sql4 = 'select donation_user_id from tp_donation where status = 3 and collection_id ='.$v['id'];
                       $result4 = M('Donation')->query($sql4);  
                       if($result4){
                            $arr_mem  = array();
                            if(is_array($result4)){
                                foreach($result4 as $v){
                                    $arr_mem[] = $v['donation_user_id'];
                                }
                            }
                            $mem_str = implode(',', $arr_mem);
                            $sql5 = 'UPDATE tp_card SET donation_times_faile = donation_times_faile + 1 where id in('.$mem_str.')';
                            $result5 = M("Card")->query($sql5);
                            if(is_array($result5)){
                                return true;
                            }else{
                                $msg = '修改会员失败次数失败';
                                return false;
                            }
                       }else{
                          $msg = '修改会员失败次数失败！';
                          return false;
                       }
                       return true; 
                    }else{
                        $msg = '修改会员捐款状态失败';
                        return false;
                    }                
                }else{
                    $msg = '过期募捐状态更新失败！';
                    return false;
                }    
            }
            return true;
//        }else{
//            $msg = '查询过期募捐失败！';
//            return false;
//        }
    }

    /*
     * 生成捐款记录，批量插入
     */
    public function insert_donation($collection,&$msg){
        if(is_array($collection)){
            $member_arr = unserialize($collection['member']);
            if(is_array($member_arr)){
                $insert_data = array();
                foreach($member_arr as $v){
                    $insert_data[] = '("'.$collection['id'].'","'.$collection['number'].'","'.$collection['aver_money'].'","'.$v.'")';
                } 
                $insert_data_str = implode(',',$insert_data);
                $sql = 'INSERT INTO tp_donation (collection_id,collection_num,donation_money,donation_user_id) values'.$insert_data_str;
                $result = M('Donation')->query($sql);  
                if(is_array($result)){
                    return true;
                }else{
                    $msg = '插入捐款信息异常！';
                    return false;
                }
            }else{
                $msg = '募捐信息无捐款人员！';
                return false;
            }
        }else{
            $msg = '募捐信息有误！';
            return false;
        }
    }
    
    /*
     * 会员表会员参与捐款数量自增1
     */
    private function add_times($mem_arr,&$msg){
        if(is_array($mem_arr)){
            $mem_str = implode(',', $mem_arr);
            $sql = 'update tp_card set donation_times_totol = donation_times_totol + 1 where id in('.$mem_str.')';
            $result = M('Card')->query($sql);
            if(is_array($result)){
                return true;
            }        
        }else{
            $msg = '捐款人员参数异常';
            return false;
        }   
    }
    
    /*
     * 捐款明细
     */
    public function donation_detail(){
        $don_id = base64_decode($_GET['id']); 
        if($_POST){
            $post = $_POST;
            $where = '1 and ';
            $where .= !empty($post['start_time'])?'d.donation_time >= '.strtotime($post['start_time']).' and ':'';
            $where .= !empty($post['end_time'])?'d.donation_time < '.strtotime($post['end_time']).' and ':'';
            $where .= !empty($post['status'])?'d.status='.$post['status']:'1';
            $this->assign('post',$post);
            $don_id = $post['id'];  
            $where .= ' and d.collection_id = '.$don_id;
        }else{
            $where = 'd.collection_id = '.$don_id;
        }
        $this->assign('id',$don_id);
        $db = M('Donation');
        $sql3 = 'select count(*) as count from tp_donation d where '.$where;
        $count = $db->query($sql3);
        $page = $this->page($count[0]['count'], 20);       
        
        $sql = 'select d.*,c.realname,c.donation_times_totol as total,c.donation_times_faile as faile from tp_donation d INNER JOIN tp_card c ON c.id = d.donation_user_id  where '.$where.' ORDER BY d.donation_time asc LIMIT  '.$page->firstRow . ',' . $page->listRows;
        $result = M('Donation')->query($sql);
        $sql2 = 'select * from tp_collection where id ='.$don_id;
        $result2 = M('Donation')->query($sql2);
        $this->assign('collection',$result2[0]); 

        $this->assign("Page", $page->show());
        $this->assign('donation',$result);
        $this->display();
    }
    
    /*
     * 募捐详情
     */
    public function detail(){
        $number = I('get.number','',trim);
        $db_collection  = M('Collection');
        $collection_arr = $db_collection->where(array('number'=>$number))->select();
        foreach($collection_arr as &$v){
            $v['base_number'] = base64_encode($v['id']); 
        }
        $this->assign('base64_num',  base64_encode($number));
        $this->assign('col_arr',$collection_arr);
        $this->assign('col_num',count($collection_arr));
        $this->display();
    }
    
    public function createWhere($post){
        $where = '1 and ';
        $where .= !empty($post['title'])?'title like "%'.$post['title'].'%" and ':'';
        $where .= !empty($post['start_time'])?$post['time_type'].' >= '.strtotime($post['start_time']).' and ':'';
        $where .= !empty($post['end_time'])?$post['time_type'].' < '.strtotime($post['end_time']).' and ':'';
        $where .= !empty($post['status'])?'status='.$post['status']:'1';

        return $where;
    }
    
    public function disposeUpload()
    {
        $args = '1,jpg|jpeg|gif|png|bmp,1,,,0';
        $authkey = upload_key($args);
        $args_thumb = '20,gif|jpg|jpeg|png|bmp,1,,,0';
        $authkey_thumb = upload_key($args_thumb);
        $this->assign('args', $args);
        $this->assign('authkey', $authkey);
        $this->assign('args_thumb', $args_thumb);
        $this->assign('authkey_thumb', $authkey_thumb);
    }
    
    
}
