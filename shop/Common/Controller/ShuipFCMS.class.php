<?php

// +----------------------------------------------------------------------
// | qcjh Controller
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.lovegq1314.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lin19940620@sina.com>
// +----------------------------------------------------------------------

namespace Common\Controller;

use Libs\System\Components;

class ShuipFCMS extends \Think\Controller {

    //缓存
    public static $Cache = array();
    //当前对象
    private static $_app;

    public function __get($name) {
        $parent = parent::__get($name);
        if (empty($parent)) {
            return Components::getInstance()->$name;
        }
        return $parent;
    }

    public function __construct() {
        parent::__construct();
        self::$_app = $this;
    }

    //初始化
    protected function _initialize() {
        $this->initSite();
        //默认跳转时间
        $this->assign("waitSecond", 3000);
    }

    /**
     * 获取QCCMS 对象
     * @return type
     */
    public static function app() {
        return self::$_app;
    }

    /**
     * 初始化站点配置信息
     * @return Arry 配置数组
     */
    protected function initSite() {
        $Config = cache("Config");
        self::$Cache['Config'] = $Config;
        $config_siteurl = $Config['siteurl'];
        if (isModuleInstall('Domains')) {
            $parse_url = parse_url($config_siteurl);
            $config_siteurl = (is_ssl() ? 'https://' : 'http://') . "{$_SERVER['HTTP_HOST']}{$parse_url['path']}";
        }
        defined('CONFIG_SITEURL_MODEL') or define('CONFIG_SITEURL_MODEL', $config_siteurl);
        $this->assign("config_siteurl", $config_siteurl);
        $this->assign("Config", $Config);
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @return void
     */
    protected function ajaxReturn($data, $type = '') {
        $data['state'] = $data['status'] ? "success" : "fail";
        if (empty($type))
            $type = C('DEFAULT_AJAX_RETURN');
        switch (strtoupper($type)) {
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:text/html; charset=utf-8');
                exit(json_encode($data));
            case 'XML' :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:text/html; charset=utf-8');
                $handler = isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                exit($handler . '(' . json_encode($data) . ');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            default :
                // 用于扩展其他返回格式数据
                tag('ajax_return', $data);
        }
    }

    /**
     * 分页输出
     * @param type $total 信息总数
     * @param type $size 每页数量
     * @param type $number 当前分页号（页码）
     * @param type $config 配置，会覆盖默认设置
     * @return type
     */
    protected function page($total, $size = 0, $number = 0, $config = array()) {
        return page($total, $size, $number, $config);
    }

    /**
     * 返回模型对象
     * @param type $model
     * @return type
     */
    protected function getModelObject($model) {
        if (is_string($model) && strpos($model, '/') == false) {
            $model = M(ucwords($model));
        } else if (strpos($model, '/') && is_string($model)) {
            $model = D($model);
        } else if (is_object($model)) {
            return $model;
        } else {
            $model = M();
        }
        return $model;
    }

    /**
     * 基本信息分页列表方法
     * @param type $model 可以是模型对象，或者表名，自定义模型请传递完整（例如：Content/Model）
     * @param type $where 条件表达式
     * @param type $order 排序
     * @param type $limit 每次显示多少
     */
    protected function basePage($model, $where = '', $order = '', $limit = 20) {
        $model = $this->getModelObject($model);
        $count = $model->where($where)->count();
        $page = $this->page($count, $limit);
        $data = $model->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('Page', $page->show());
        $this->assign('data', $data);
        $this->assign('count', $count);
        $this->display();
    }

    /**
     * 基本信息添加
     * @param type $model 可以是模型对象，或者表名，自定义模型请传递完整（例如：Content/Model）
     * @param type $u 添加成功后的跳转地址
     * @param type $data 需要添加的数据
     */
    protected function baseAdd($model, $u = 'index', $data = '') {
        $model = $this->getModelObject($model);
        if (IS_POST) {
            if (empty($data)) {
                $data = I('post.', '', '');
            }
            if ($model->create($data) && $model->add()) {
                $this->success('添加成功！', $u ? U($u) : '');
            } else {
                $error = $model->getError();
                $this->error($error? : '添加失败！');
            }
        } else {
            $this->display();
        }
    }

    /**
     * 基础修改信息方法
     * @param type $model 可以是模型对象，或者表名，自定义模型请传递完整（例如：Content/Model）
     * @param type $u 修改成功后的跳转地址
     * @param type $data 需要修改的数据
     */
    protected function baseEdit($model, $u = 'index', $data = '') {
        $model = $this->getModelObject($model);
        $fidePk = $model->getPk();
        $pk = I('request.' . $fidePk, '', '');
        if (empty($pk)) {
            $this->error('请指定需要修改的信息！');
        }
        $where = array($fidePk => $pk);
        if (IS_POST) {
            if (empty($data)) {
                $data = I('post.', '', '');
            }
            if ($model->create($data) && $model->where($where)->save() !== false) {
                $this->success('修改成功！', $u ? U($u) : '');
            } else {
                $error = $model->getError();
                $this->error($error? : '修改失败！');
            }
        } else {
            $data = $model->where($where)->find();
            if (empty($data)) {
                $this->error('该信息不存在！');
            }
            $this->assign('data', $data);
            $this->display();
        }
    }

    /**
     * 基础信息单条记录删除，根据主键
     * @param type $model 可以是模型对象，或者表名，自定义模型请传递完整（例如：Content/Model）
     * @param type $u 删除成功后跳转地址
     */
    protected function baseDelete($model, $u = 'index') {
        $model = $this->getModelObject($model);
        $pk = I('request.' . $model->getPk());
        if (empty($pk)) {
            $this->error('请指定需要修改的信息！');
        }
        $where = array($model->getPk() => $pk);
        $data = $model->where($where)->find();
        if (empty($data)) {
            $this->error('该信息不存在！');
        }
        if ($model->delete() !== false) {
            $this->success('删除成功！', $u ? U($u) : '');
        } else {
            $error = $model->getError();
            $this->error($error? : '删除失败！');
        }
    }

    /**
     * 验证码验证
     * @param type $verify 验证码
     * @param type $type 验证码类型
     * @return boolean
     */
    static public function verify($verify, $type = "verify") {
        return A('Api/Checkcode')->validate($type, $verify);
    }

    static public function logo() {
        return 'iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAIAAAC0Ujn1AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAATRSURBVEhLtZb5UxtlGMf7D+moBYqUS1vb0paj0gqW0mk9fhTHqf6i004dO/UXHR0sLaJ20MFBx2FEIAkkpAVpqVw5OCKQlGuP3JvdHEuym9343WxcQqAJ/uDOOzth9n0+z/M+x/flUOp/ew4dmBx38nds3DWfaDqgyYHQYeHpY+9bg8QLQ8RhHVmyzHbIqWRBB4XRREw3Sp/REcUj1CtYw1TlEFE07X8/Iqzlp+dDI1hL8BMdccRAloGoI0qGiGI9+fIwVQVPJvrUWrgnKcef5WB/NC+6cWoTfRIBGsijeBupY7bgTVe4e9L7jp4sRVr0ZBk8PfJeJWPDkizudZCL5oRVB9tupmuBQ4B4m6gTi6EvOGFZNZZkwc2PTfnfSzs4oq5J37tEdCAhsdkOdtA0b54JXDNSx9VIYTBMVtiZW8/IqezmzagtMoPNihuiZMx9fin0ZVTcUh1k0G7+AYhoAOQUqcQPmAXis/kLJclxF/cjogF3hKpGSQa2np/wtEip6A56mb2L3ko3QBWiWGK/EqVYNjcp8+7tPlfkNifYcvyxiSXEgWhAR2RIYzy1voNGplAZfNMRpU7ufo4xk5h0cB/OMg0zTL0l1LQe/WY7SWTvEaSwNXh9kHhpYOu5aX+bnErsoAPxGQNZbiArQGeFFc0sJjqdkdtzTOMs02gNtWBZQm/CgT10hd7ulVORbAdUbGQj0idI3K5co4WN1GvoJ0xHTCTVb/7tv6YCFywK9KLKVZct1DLPNU0H6x7RH8eTfIG+5pOeB+465GTMc0HrobVw7yBxeMLbYGFa7exllTvPtSywrWP0pe7F+vvzzTEhWAANHKBokj89F0U5U8DNSF+6t6pM9IlJ33lrqHWBa33ia/1t9Y1Oa32H5VTP0mVeDBVAow7jnmZUeQ8atVXbpmrMc9qw0dxlO3fPWttlr+201Rwc3ZSOulmUlK7Ek45aQavLSFf/7GjotNR9Z1fWQdEJKfjQ3YhcP3S/Hk9m0rcR/hXONLSJfvWX5XPfWus19E+LLTGRKZCQqEigN9Dto3RNVNxUd6OZ0KoYYpWeje6ynW2fq+x1vB1P7uq/bDeZQWfiCyMkJrUcacV0qTug92TMoNYAI/ovuu6u5fg968mR9c8C/C7JZhN/B+Jzil36yaCpmFHRI6pKT5RuRft3Txrn5H7AafRkUY+jpn32WN9K2zr7JCcPq9z3kDN01ALzOfRxB73KdeHsSjOQlWi1zWhfjmVE2LAzN/tdV2zefuhq9lfUxhq8kdZLzHO5njyaSCkpzUS9Ff0D46+mFZ9RT2iCNpYaSJRyZ8/Nj6OpNG0aJF4002eSKaW2GTQCcXHd454mVXlxNERhdp99Gu7JkUDNTVhw2oI3oA0wQTRqL+GKgBztyrX6B+aQ5kdn/B9Ap5C19C1TPOG9tBn9XRMdbIPg4N6B5qRvIlxjRRAJB/u1dhPtg9YigufZwEcwQ23Vc+BATq7bw4/bg5+qUAg/3qP06RWuExK0t7vz3egAPfZehf0wVaG4IZSrFqdBqXEg/J5nbmnX1X9DY3dS3l7mOpAfsNKDU40FZ9AyLz+xF7fPyOTfFJKmHgUbTb4ys7/a6CtdiFyXUxm9z2NY+L8n1TgsuKb8bVCYZfaOnJ6Igs8/k6ULtYvFowEAAAAASUVORK5CYII=';
    }

    //空操作
    public function _empty() {
        $this->error('该页面不存在！');
    }

}
