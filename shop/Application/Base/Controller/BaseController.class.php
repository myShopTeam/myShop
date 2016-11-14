<?php

// +----------------------------------------------------------------------
// | myshop 基层文件
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Base\Controller;

use Common\Controller\Base;

class BaseController extends Base
{
    protected $uid; //会员ID
    protected $member_info; //会员信息
    protected $model; //模型

    public function _initialize()
    {
        parent::_initialize();
        header("Content-type:text/html;charset=utf-8");
        //用户ID
        $this->uid = session('uid');
        //加载网站资源
        $this->_getSiteInfo();
        //用户登录信息
        $this->_setMember();
        //自动登录
        $this->__keepLogin();
    }

    /**
     * 设置会员信息
     */
    protected function _setMember(){

        if(!$this->isLogin()) {

            return false;
        }
        if(count(S('member_info_' . $this->uid)) > 3)
        {
            $this->member_info = S('member_info_' . $this->uid);

        } else {
            //设置用户信息
            $this->getMemberInfo();
            //用户信息缓存7200秒
            S('member_info_' . $this->uid, $this->member_info, 7200);
        }

        $this->assign('member_info', $this->member_info);
    }

    /**
     * 消除会员信息
     */
    protected function _delMember(){
        $this->member_info = null;
        S('member_info_' . $this->uid, null);
    }

    /**
     * 更新用户信息 当用户发生改变后执行此方法
     */
    public function updateMember(){
        if($this->isLogin()){
            $this->getMemberInfo();
            S('member_info_' . $this->uid, $this->member_info, 7200);
        }
    }

    /**
     * 检测会员是否登录 没有登录跳转到登录页面
     */
    public function checkLogin()
    {
        if (!$this->uid) {
            if(IS_AJAX){
                msg('error', '非法操作');
            } else {
                redirect(U('Site/Passport/login',5,'damiofjfofw'));
            }
        } else {
            //todo:其他逻辑
        }
    }

    /**
     * 获取会员信息
     */
    public function getMemberInfo()
    {
        if ($this->isLogin()) {

            $this->member_info =  D('Member/Card')->getMemberInfo($this->uid);
            $this->member_info['is_login'] = 1;
            //如果用户未设置昵称 为了统一字段 则将用户名设置为昵称
            $this->member_info['nicknane'] = $this->member_info['nicknane'] ? $this->member_info['nicknane'] : $this->member_info['username'];

        } else {
            return false;
        }
    }

    /**
     * 检测是否登录 返回 true或者false
     */
    public function isLogin()
    {
        return session('is_login') ? true : false;
    }

    /**
     * 设置用户登录状态
     * @param array  $member
     */
    protected function _setSession($member){
        $this->uid = $member['id'];
        //设置session
        session('uid', $this->uid);
        session('username', $member['username']);
        session('is_login', 1);
        //设置cookie
        cookie('uid', $this->uid);
        cookie('username', $member['username']);
        //记住密码 保持登录
        if($member['keep_login'] == true){
            //序列化uid username数组后 sha1加密
            $keep_data = array(
                'uid'      => $this->uid,
                'username' => $member['username'],
                'salt'     => C('SALT_LOGIN')
            );
            cookie('s', sha1(serialize($keep_data)));
        }
        //设置用户信息
        $this->_setMember();
    }

    /**
     * 地区
     */
    public function getFormatArea(){
        $areas = array();
        $city  = array();
        $logistics = json_decode(file_get_contents(SITE_PATH . 'public/common/js/area.json'), true);
        if(!$logistics) {
            $logistics = M('logistics')->field('region_id,local_name,p_region_id')->select();
            foreach($logistics as $key => $logistic){
                if($logistic['p_region_id'] == 0){
                    $areas['province'][$logistic['region_id']] = $logistic['local_name'];
                    unset($logistics[$key]);
                }
            }
            foreach($areas['province'] as $k => $area){
                foreach($logistics as $key => $logistic){
                    if($logistic['p_region_id'] == $k){
                        $city[$logistic['region_id']] = $logistic['local_name'];
                        $areas['city'][$k][$logistic['region_id']] = $logistic['local_name'];
                        unset($logistics[$key]);
                    }
                }
            }
            foreach($city as $k => $area){
                foreach($logistics as $key => $logistic){
                    if($logistic['p_region_id'] == $k){
                        $areas['area'][$k][$logistic['region_id']] = $logistic['local_name'];
                        unset($logistics[$key]);
                    }
                }
            }
            return $areas;
        } else {
            return $logistics;
        }

    }

    /**
     * 保持登录
     */
    private function __keepLogin(){
        //保持登录加密字符串
        if(cookie('s')){
            $keep_data = array(
                'uid'      => cookie('uid'),
                'username' => cookie('username'),
                'salt'     => C('SALT_LOGIN')
            );
            if(cookie('s') === sha1(serialize($keep_data))){
                //验证成功 用户自动登录
                $member = M('card')->find(cookie('uid'));
                if($member){
                    $this->_setSession($member);
                }
            }
        }
    }
}
