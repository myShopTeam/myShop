<?php

// +----------------------------------------------------------------------
// | 后台用户角色表
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <535201470@qq.com>
// +----------------------------------------------------------------------

namespace Shop\Model;

use Common\Model\Model;

class GoodsCategoryModel extends Model {

    public $dataList;

    /**
     * 返回Tree使用的数组
     * @return array
     */
    public function getTreeArray() {
        $dataList = array();
        $data = $this->order(array("listorder" => "asc", "catid" => "asc"))->select();
        foreach ($data as $rs) {
            $dataList[$rs['catid']] = $rs;
        }
        return $dataList;
    }

    /**
     * 返回select选择列表
     * @param int $parentid 父节点ID
     * @param string $selectStr 是否要 <select></select>
     * @return string
     */
    public function selectHtmlOption($parentid = 0, $selectStr = '',$bool = 0, $strs = '') {
        $tree = new \Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $str = "<option value='\$catid' \$selected>\$spacer\$cat_name</option>";
        $tree->init($this->getTreeArray());
        if($bool==1){
            $option = "<option value=0>$strs</option>";
        }
        if ($selectStr) {
            $html = '<select ' . $selectStr . '>'.$option;
            $html.=$tree->get_tree(0, $str, $parentid);
            $html.='</select>';
            return $html;
        }
        return $tree->get_tree(0, $str, $parentid);
    }

}
