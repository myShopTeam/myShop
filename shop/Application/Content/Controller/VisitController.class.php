<?php

// +----------------------------------------------------------------------
// | QCCMS8.2 网站前台
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.lovegq1314.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------

namespace Content\Controller;

use Common\Controller\Base;
use Content\Model\ContentModel;

class VisitController extends Base {

    //首页
    public function visit() {
    	if(empty($_COOKIE['UserName'])){
    		$this->error('未登录！');
    	}
        $page = isset($_GET[C("VAR_PAGE")]) ? $_GET[C("VAR_PAGE")] : 1;
        $page = max($page, 1);
        //模板处理
        $tp = explode(".", self::$Cache['Config']['indextp']);
        $template = parseTemplateFile("Index/{$tp[0]}");
        $SEO = seo('', '', self::$Cache['Config']['siteinfo'], self::$Cache['Config']['sitekeywords']);
        //生成路径
        $urls = $this->Url->index($page);
        $GLOBALS['URLRULE'] = $urls['page'];
        //seo分配到模板
        $this->assign("SEO", $SEO);
        //个人信息
        $username=$_COOKIE['UserName'];
        $member=M('member')->table('tp_membertype,tp_member')->where("tp_member.typeid=tp_membertype.typeid and tp_member.username='{$username}'")->order(array("tp_member.listorder"=>"desc","tp_member.id"=>"desc"))->find();
        $this->assign($member);
        //谁看过我的
        $visit=M('visit')->query("select a.id,b.* from tp_visit as a LEFT JOIN tp_member as b on a.userid=b.id WHERE a.usernameb='{$username}' and a.useridb='{$member['id']}'");
        $this->assign("visit", $visit);
        
        //把分页分配到模板
        $thisurl="visit";
        $this->assign("thisurl", $thisurl);
        $this->assign(C("VAR_PAGE"), $page);
        $this->display("Index:visit");
    }
    
   
    public function seen() {
    	if(empty($_COOKIE['UserName'])){
    		$this->error('未登录！');
    	}
    	$page = isset($_GET[C("VAR_PAGE")]) ? $_GET[C("VAR_PAGE")] : 1;
    	$page = max($page, 1);
    	//模板处理
    	$tp = explode(".", self::$Cache['Config']['indextp']);
    	$template = parseTemplateFile("Index/{$tp[0]}");
    	$SEO = seo('', '', self::$Cache['Config']['siteinfo'], self::$Cache['Config']['sitekeywords']);
    	//生成路径
    	$urls = $this->Url->index($page);
    	$GLOBALS['URLRULE'] = $urls['page'];
    	//seo分配到模板
    	$this->assign("SEO", $SEO);
    	//个人信息
    	$username=$_COOKIE['UserName'];
    	$member=M('member')->table('tp_membertype,tp_member')->where("tp_member.typeid=tp_membertype.typeid and tp_member.username='{$username}'")->order(array("tp_member.listorder"=>"desc","tp_member.id"=>"desc"))->find();
    	$this->assign($member);
    	//谁看过我的
    	$visit=M('visit')->query("select a.id,b.* from tp_visit as a LEFT JOIN tp_member as b on a.useridb=b.id WHERE a.username='{$username}' and a.userid='{$member['id']}'");
    
    	$this->assign("visit", $visit);
    
    	//把分页分配到模板
    	$thisurl="seen";
    	$this->assign("thisurl", $thisurl);
    	$this->assign(C("VAR_PAGE"), $page);
    	$this->display("Index:visit");
    }
    
    public function atten() {
    	if(empty($_COOKIE['UserName'])){
    		$this->error('未登录！');
    	}
    	$page = isset($_GET[C("VAR_PAGE")]) ? $_GET[C("VAR_PAGE")] : 1;
    	$page = max($page, 1);
    	//模板处理
    	$tp = explode(".", self::$Cache['Config']['indextp']);
    	$template = parseTemplateFile("Index/{$tp[0]}");
    	$SEO = seo('', '', self::$Cache['Config']['siteinfo'], self::$Cache['Config']['sitekeywords']);
    	//生成路径
    	$urls = $this->Url->index($page);
    	$GLOBALS['URLRULE'] = $urls['page'];
    	//seo分配到模板
    	$this->assign("SEO", $SEO);
    	//个人信息
    	$username=$_COOKIE['UserName'];
    	$member=M('member')->table('tp_membertype,tp_member')->where("tp_member.typeid=tp_membertype.typeid and tp_member.username='{$username}'")->order(array("tp_member.listorder"=>"desc","tp_member.id"=>"desc"))->find();
    	$this->assign($member);
    	//谁看过我的
    	$visit=M('visit')->query("select a.id,b.* from tp_attention as a LEFT JOIN tp_member as b on a.userid=b.id WHERE a.usernameb='{$username}' and a.useridb='{$member['id']}'");
    	$this->assign("visit", $visit);
    
    	//把分页分配到模板
    	$thisurl="atten";
    	$this->assign("thisurl", $thisurl);
    	$this->assign(C("VAR_PAGE"), $page);
    	$this->display("Index:atten");
    }

    public function attention() {
    	if(empty($_COOKIE['UserName'])){
    		$this->error('未登录！');
    	}
    	$page = isset($_GET[C("VAR_PAGE")]) ? $_GET[C("VAR_PAGE")] : 1;
    	$page = max($page, 1);
    	//模板处理
    	$tp = explode(".", self::$Cache['Config']['indextp']);
    	$template = parseTemplateFile("Index/{$tp[0]}");
    	$SEO = seo('', '', self::$Cache['Config']['siteinfo'], self::$Cache['Config']['sitekeywords']);
    	//生成路径
    	$urls = $this->Url->index($page);
    	$GLOBALS['URLRULE'] = $urls['page'];
    	//seo分配到模板
    	$this->assign("SEO", $SEO);
    	//个人信息
    	$username=$_COOKIE['UserName'];
    	$member=M('member')->table('tp_membertype,tp_member')->where("tp_member.typeid=tp_membertype.typeid and tp_member.username='{$username}'")->order(array("tp_member.listorder"=>"desc","tp_member.id"=>"desc"))->find();
    	$this->assign($member);
    	//谁看过我的
    	$visit=M('visit')->query("select a.id,b.* from tp_attention as a LEFT JOIN tp_member as b on a.useridb=b.id WHERE a.username='{$username}' and a.userid='{$member['id']}'");
    
    	$this->assign("visit", $visit);
    
    	//把分页分配到模板
    	$thisurl="attention";
    	$this->assign("thisurl", $thisurl);
    	$this->assign(C("VAR_PAGE"), $page);
    	$this->display("Index:visit");
    }
}
