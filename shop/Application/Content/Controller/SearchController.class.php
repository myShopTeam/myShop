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

class SearchController extends Base {

    //首页
    public function search() {
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
        //会员信息
        $where=array();
        
        if (IS_POST) {
        //性别
        $sex = I('post.sex');
        if ($sex) {
        	$where['sex'] = array('eq',mb_substr($sex,0,1,'utf8'));
        }
        //省市
        $province=I('post.province');
        if ($province_jg) {
        	$where['province'] = array('eq',$province);
        }
        $city=I('post.city');
        if ($city && $city!="任意") {
        	$where['city'] = array('eq',$city);
        }
        //有无照片
        $image=I('post.headpic');
        if ($image=="true") {
        	$where['headpic'] = array('NEQ','');
        }

        //年龄范围搜索
        $startage= I('post.startage');
        $endage = I('post.endage');
        if (!empty($startage)) {
        	$where['age'] = array('EGT', $startage);
        	if ($endage) {
        		$where['age'] = array(array('EGT', $startage), array('ELT', $endage), 'AND');
        	}
        }
        //住房状况
        $isfang=I('post.isfang');
        if($isfang && $isfang!='不限'){
        	$where['isfang']=array('eq',$isfang);
        }
        //婚史
        $marriage=I('post.marriage');
        if($marriage && $marriage!='不限'){
        	$where['marriage']=array('eq',$marriage);
        }
        //学历
        $grade=I('post.grade');
        if($grade && $grade!='不限'){
        	$where['grade']=array('eq',$grade);
        }
        //星座
        $constellation=I('post.constellation');
        if($constellation && $constellation!='不限'){
        	$where['constellation']=array('eq',$constellation);
        }
        //月收入
        $income=I('post.income');
        $income1=I('post.income1');
        if($income && $income!='不限'){
        	if($income1=='true'){
        		$where['income']=array('EGT',$income);
        	}
        	if($income1=='false'){
        		$where['income']=array('eq',$income);;
        	}
        }
        
        $this->assign($_POST);
        
        }
        $db=M("member");
        $count = $db->where($where)->count();
        $page = $this->page($count, 10);
        $member=$db->table('tp_membertype,tp_member')->where('tp_member.typeid=tp_membertype.typeid')->where($where)->order(array("tp_member.listorder"=>"desc","tp_member.id"=>"desc"))->limit($page->firstRow . ',' . $page->listRows)->select();
        //print_r($member);exit;
        $this->assign("Page", $page->show(''));
        $this->assign("member", $member);
        //把分页分配到模板
        $search="search";
        $this->assign("search", $search);
        $this->assign(C("VAR_PAGE"), $page);
        $this->display("Index:search");
    }

}
