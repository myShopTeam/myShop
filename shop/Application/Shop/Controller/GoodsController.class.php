<?php

// +----------------------------------------------------------------------
// | qcjh 武大校友汇商城 商品管理
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 http://www.qcjh.net, All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Shop\Controller;

use Common\Controller\AdminBase;

class GoodsController extends AdminBase {

	protected function _initialize() {
        parent::_initialize();
        header("Content-type:text/html;charset=utf-8");
        //处理图片上传问题
        $this->disposeUpload();
    }

	//商品列表
   public function goods_index(){
   		$db = M('goods');
         if(IS_POST){
            $searchGoods = I('post.searchGoods','');
            $searchSn = I('post.searchSn','');
            if(!empty($searchGoods)){
               $where['goods_name'] = array('like',"%$searchGoods%");
               $this->assign('searchGoods',$searchGoods);
            }
            if(!empty($searchSn)){
               $where['goods_sn'] = array('like',"%$searchSn%");
               $this->assign('searchSn',$searchSn);
            }
         }
   		$count = $db->where($where)->count();
   		$page = $this->page($count, 10);
        $goodsList = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('listorder desc,goods_id desc')->select();
   		foreach ($goodsList as $k => $v) {
            $imgs = explode('|', $goodsList[$k]['goods_img']);
            $goodsList[$k]['goods_img'] = $imgs[0];
   			$goodsList[$k]['is_show']   = $v['is_show'] == 0 ? '下架'  : '上架';
   			$goodsList[$k]['is_hot']    = $v['is_hot']  == 0 ? '非热销' : '热销';
   			$goodsList[$k]['is_new']    = $v['is_new']  == 0 ? '非新品' : '新品';
   			$goodsList[$k]['is_best']   = $v['is_best'] == 0 ? '非精品' : '精品';
   		}
   		$this->assign("Page", $page->show());
   		$this->assign("goodsList", $goodsList);
   		$this->display();
   }
   //添加商品
   public function goods_add(){
      $goodsDb = M('goods');
   		if(IS_POST){
            //运费
            $transtype = I('post.transtype','免运费');
            $freight = number_format(I('post.freight',0.00),2,'.','');
            $freight = $transtype=='免运费' ? 0.00 : $freight;
            //商品市场价 卖价
            $market_price = number_format(I('post.market_price',0.00),2,'.','');
            $shop_price = number_format(I('post.shop_price',0.00),2,'.','');
            $goods_num = I('post.goods_num',0,'intval');
            //商品展示图
            $multpicArr = I('post.multpic_url',0);
            $goods_img = '';
            for($j=0;$j<count($multpicArr);$j++){
               $goods_img .= $multpicArr[$j].'|';
            }
            $goods_imgs = substr($goods_img, 0 ,-1);
            //检查商品货号是否唯一
            $goods_sn = I('post.goods_sn','');
            if(empty($goods_sn)){
               $goods_sn = rand(1000,9999).date('mdHis').rand(1000,9999);
            }else{
               $checkGoodsSn = $goodsDb->where(array('goods_sn'=>$goods_sn))->find();
               if($checkGoodsSn){
                  $this->error("货号已存在,不填货号系统会自动生成唯一货号");
               }
            }
            
   			$data = array(
   				'goods_name' => I('post.goods_name',''),
   				'goods_sn' => $goods_sn,
   				'cat_id' => I('post.cat_id','','intval'),
   				'other_cat' => I('post.other_cat','','intval'),
                'goods_thumb' => $multpicArr[0],
   				'goods_img' => $goods_imgs,
   				'market_price' => $market_price,
   				'shop_price' => $shop_price,
   				'is_show' => I('post.is_show',0,'intval'),
   				'is_hot' => I('post.is_hot',0,'intval'),
   				'is_new' => I('post.is_new',0,'intval'),
   				'is_best' => I('post.is_best',0,'intval'),
   				'goods_num' => $goods_num,
   				'sale_num' => I('post.sale_num',0,'intval'),
                'content' => I('post.content','',''),
                'alumni_id' => I('post.alumni_id','','intval'),
                'brand_id' => I('post.brand_id','','intval'),
   				'classify' => I('post.classify',''),
                'transtype' => $transtype,
                'freight' => $freight,
   				'add_time' => time()
   			);
            //添加属性
            $attrName = I('post.attr_names',0);
            $attrValue = I('post.attr_values',0);
            $attrMoneys = I('post.attrMoneys',0);
            $attrId = I('post.attr_id',0);
            $multpicUrl = I('post.multpicUrl',0);

   			if(empty($data['goods_name'])){
   				$this->error('商品名称不能为空');
   			}
   			if(empty($data['cat_id'])){
   				$this->error('请选择商品分类');
   			}
   			if(empty($data['shop_price'])){
   				$this->error('商品售价不能为空');
   			}
   			if(empty($data['goods_num'])){
   				$this->error('商品库存不能为空');
   			}
   			$goods_id = M('goods')->add($data);
   			if($goods_id){
               //判断是否为属性商品
               if(!empty($attrMoneys) || !empty($attrId)){
                  for($i=0;$i<count($attrName);$i++){
                     $data2['goods_id'] = $goods_id;
                     $data2['attr_id'] = $attrId[$i];
                     $data2['key'] = $attrName[$i];
                     $data2['value'] = $attrValue[$i];
                     $data2['attr_price'] = $attrMoneys[$i] == '不变' ? number_format($shop_price,2,'.','') : number_format($attrMoneys[$i],2,'.','');
                     $data2['pro_total'] = $goods_num;
                     M('goods_sku')->add($data2);
                  }
               }
   				$this->success('商品添加成功',U('Goods/goods_index'));
   			}else{
   				$this->error('商品添加失败');
   			}
   		}else{
   			//查询商品分类
   			$catList = D('Shop/Role')->selectHtmlOption(0, 'name="cat_id"',1,"请选择");
   			$other_cat = D('Shop/Role')->selectHtmlOption(0, 'name="other_cat"',1,"请选择");
   		   //校友分类
            $alumni = M('goods_alumni')->order('listorder desc')->select();
            //品牌分类
            $brand = M('goods_brand')->order('listorder desc')->select();
            //格式化商品属性
            // $attrList = $this->getFormatAttr();
            // p($attrList);

   			$this->assign('catList',$catList);
   			$this->assign('otherList',$other_cat);
            $this->assign('attrList',$attrList);
            $this->assign('brand',$brand);
            $this->assign('alumni',$alumni);
   			$this->display();
   		}
   }
   //修改商品
   public function goods_edit(){
         $goodsDb = M('goods');
   		$goods_id = I('get.goods_id','',intval);
   		if(IS_POST){
            //运费
            $transtype = I('post.transtype','免运费',trim);
            $freight = number_format(I('post.freight',0.00),2,'.','');
            $freight = $transtype=='免运费' ? 0.00 : $freight;
            //商品市场价 卖价
            $market_price = number_format(I('post.market_price',0.00),2,'.','');
            $shop_price = number_format(I('post.shop_price',0.00),2,'.','');
            $goods_num = I('post.goods_num',0,intval);
            $multpicArr = I('post.multpic_url',0);
            $goods_img = '';
            for($j=0;$j<count($multpicArr);$j++){
               $goods_img .= $multpicArr[$j].'|';
            }
            $goods_imgs = substr($goods_img, 0 ,-1);
   			$goods_sn = I('post.goods_sn','',trim);
   			//$goods_sn = empty($goods_sn) ? rand(1000,9999).date('mdHis').rand(1000,9999) : $goods_sn;
            //检查商品货号是否唯一
            if(empty($goods_sn)){
               $goods_sn = rand(1000,9999).date('mdHis').rand(1000,9999);
            }else{
               $checkGoodsSn = $goodsDb->where(array('goods_sn'=>$goods_sn,'goods_id'=>array('neq',$goods_id)))->find();
               if($checkGoodsSn){
                  $this->error("货号已存在,不填货号系统会自动生成唯一货号");
               }
            }
            $data = array(
   				'goods_name' => I('post.goods_name',''),
   				'goods_sn' => $goods_sn,
   				'cat_id' => I('post.cat_id','','intval'),
   				'other_cat' => I('post.other_cat','','intval'),
                'goods_thumb' => $multpicArr[0],
   				'goods_img' => $goods_imgs,
   				'market_price' => $market_price,
   				'shop_price' => $shop_price,
   				'is_show' => I('post.is_show',0,'intval'),
   				'is_hot' => I('post.is_hot',0,'intval'),
   				'is_new' => I('post.is_new',0,'intval'),
   				'is_best' => I('post.is_best',0,'intval'),
   				'goods_num' => $goods_num,
   				'sale_num' => I('post.sale_num',0,'intval'),
   				'content' => I('post.content','',''),
                'alumni_id' => I('post.alumni_id','','intval'),
                'brand_id' => I('post.brand_id','','intval'),
                'classify' => I('post.classify','','intval'),
   				'is_best' => I('post.is_best',0,'intval'),
                'transtype' => $transtype,
                'freight' => $freight,
   				'update_time' => time()
   			);

            //添加属性
            $attrName = I('post.attr_names',0);
            $attrValue = I('post.attr_values',0);
            $attrMoneys = I('post.attrMoneys',0);
            $attrId = I('post.attr_id',0);
            $multpicUrl = I('post.multpicUrl',0);

   			if(empty($data['goods_name'])){
   				$this->error('商品名称不能为空');
   			}
   			if(empty($data['cat_id'])){
   				$this->error('请选择商品分类');
   			}
   			if(empty($data['shop_price'])){
   				$this->error('商品售价不能为空');
   			}
   			if(empty($data['goods_num'])){
   				$this->error('商品库存不能为空');
   			}
   			$bool = M('goods')->where(array('goods_id'=>$goods_id))->save($data);
   			if($bool){
               //判断是否为属性商品
               if(!empty($attrMoneys) || !empty($attrId)){
                  M('goods_sku')->where(array('goods_id'=>$goods_id))->delete();
                  for($i=0;$i<count($attrName);$i++){
                     $data2['goods_id'] = $goods_id;
                     $data2['attr_id'] = $attrId[$i];
                     $data2['key'] = $attrName[$i];
                     $data2['value'] = $attrValue[$i];
                     $data2['attr_price'] = $attrMoneys[$i] == '不变' ? number_format($shop_price,2,'.','') : number_format($attrMoneys[$i],2,'.','');
                     $data2['pro_total'] = $goods_num;
                     M('goods_sku')->add($data2);
                  }
               }
   				$this->success('商品修改成功',U('Goods/goods_index'));
   			}else{
   				$this->error('商品修改失败');
   			}

   		}else{
            $goodsList = $goodsDb->alias('a')->field('a.*,b.catid,b.cat_name')->join('left join tp_goods_category b ON a.cat_id=b.catid')->where(array('a.goods_id'=>$goods_id))->find();
            $catList = D('Shop/Role')->selectHtmlOption($goodsList['catid'], 'name="cat_id"',1,"请选择");
   			$other_cat = D('Shop/Role')->selectHtmlOption($goodsList['other_cat'], 'name="other_cat"',1,"请选择");
            
            //首次进入页面默认分类下的属性
            $attrName = M('goods_attr')->where(array('cat_id'=>$goodsList['catid']))->group('attr_name')->select();
            $attrHtml = '<option value="0">请选择商品属性名</option>';
            foreach ($attrName as $k => $v) {
               $attrHtml .= '<option value="'.$v['attr_name'].'">'.$v['attr_name'].'</option>';
            }
            //商品图片
            $imgsStr = '';
            $imgsArr = explode('|', $goodsList['goods_img']);
            $rand = substr(time(), -4);
            for($i=0;$i<count($imgsArr);$i++){
               $imgsStr .= '<li id="image'.$rand.$i.'"><input type="text" name="multpic_url[]" value="'.$imgsArr[$i].'" style="width:310px;" ondblclick="image_priview(this.value);" class="input"> <input type="text" name="multpic_alt[]" value="'.md5(time()).'" style="width:160px;" class="input" onfocus="if(this.value == this.defaultValue) this.value = \'\'" onblur="if(this.value.replace(\' \',\'\') == \'\') this.value = this.defaultValue;"> <a href="javascript:remove_div(\'image'.$rand.$i.'\')">移除</a> </li>';
            }
            //商品属性
            $skuStr = '';
            $skuArr = M('goods_sku')->where(array('goods_id'=>$goods_id))->select();
   			foreach ($skuArr as $key => $vo) {
               $skuStr .= '<div class="line"><input type="text" class="input attr_names" name="attr_names[]" readonly="true" value="'.$vo['key'].'">&nbsp;<input type="text" class="input attr_values" name="attr_values[]" readonly="true" value="'.$vo['value'].'">&nbsp;<input type="text" class="input attrMoneys" name="attrMoneys[]" value="'.$vo['attr_price'].'">&nbsp;<input type="hidden" name="attr_id[]" value="'.$vo['attr_id'].'"><input type="button" class="btn close" value="删除"></div>';
            }
            //校友分类
            $alumni = M('goods_alumni')->order('listorder desc')->select();
            //品牌分类
            $brand = M('goods_brand')->order('listorder desc')->select();

            $this->assign($goodsList);
   			$this->assign('catList',$catList);
   			$this->assign('otherList',$other_cat);
            $this->assign('attrHtml',$attrHtml);
            $this->assign('imgsStr',$imgsStr);
            $this->assign('skuStr',$skuStr);
            $this->assign('brand',$brand);
            $this->assign('alumni',$alumni);
   			$this->display();
   		}
   }
   //商品删除
   public function goods_delete(){
         if(IS_POST){
            $goodsArr = I('post.');
            if(is_array($goodsArr)){
               foreach ($goodsArr['id'] as $k => $v) {
                     $goodsidArr[] = $v;
               }
               $bool = M('goods')->where(array('goods_id'=>array('IN',$goodsidArr)))->delete();
               if($bool){
                  //删除商品对应的属性
                  M('goods_sku')->where(array('goods_id'=>array('IN',$goodsidArr)))->delete();
                  $this->success("删除成功",U('Goods/goods_index'));
               }else{
                  $this->error("删除失败");
               }
            }else{
               $this->error("非法操作");
            }
         }else{
            $goodsid = I('get.goods_id','',intval);
            $bool = M('goods')->where(array('goods_id'=>$goodsid))->delete();
               if($bool){
                  //删除商品对应的属性
                  M('goods_sku')->where(array('goods_id'=>$goodsid))->delete();
                  $this->success("删除成功",U('Goods/goods_index'));
               }else{
                  $this->error("非法操作");
               }
         }
   }
   //商品分类列表
   public function category_list(){
   		$db = M('goods_category');
   		$count = $db->count();
   		$page = $this->page($count, 10);
        $catList = $db->limit($page->firstRow . ',' . $page->listRows)->order('listorder desc,catid desc')->select();
   		$this->assign("Page", $page->show());
   		$this->assign("catList", $catList);
   		$this->display();
   }
   //商品分类添加
   public function category_add(){
   		if(IS_POST){
   			$data['parent_id'] = I('post.parent_id',0,'intval');
   			$data['cat_name'] = I('post.cat_name','');
   			$data['cat_img'] = I('post.cat_img','');
   			$data['is_show'] = I('post.is_show',0,'intval');
   			if(empty($data['cat_name'])){
   				$this->error("请输入分类名称");
   			}else{
   				$info = M('goods_category')->where(array('cat_name'=>$data['cat_name']))->find();
   				if(empty($info)){
   					$catid = M('goods_category')->add($data);
   					if($catid){
   						$this->success('添加成功',U('category_add'));
   					}else{
   						$this->error("非法操作");
   					}
   				}else{
   					$this->error("已存在此分类");
   				}
   				
   			}
   		}else{
   			$this->assign('catList',D('Shop/Role')->selectHtmlOption(0, 'name="parent_id"',1,"一级分类"));
   			$this->display();
   		}
   }
   //商品分类修改
   public function category_edit(){
   		$catid = I('get.catid','',intval);
   		if(IS_POST){
   			$data['parent_id'] = I('post.parent_id',0,'intval');
   			$data['cat_name'] = I('post.cat_name','');
   			$data['cat_img'] = I('post.cat_img','');
   			$data['is_show'] = I('post.is_show',0,'intval');
   			$checkCat = M('goods_category')->where(array('cat_name'=>$data['cat_name'],'catid'=>array('neq',$catid)))->find();
   			if($checkCat){
   				$this->error("已存在此分类");
   			}elseif($data['parent_id']==$catid){
   				$this->error("不能此分类为父级分类");
   			}else{
   				$bool = M('goods_category')->where(array('catid'=>$catid))->save($data);
   				if($bool){
   					$this->success("修改成功",U('Goods/category_list'));
   				}else{
   					$this->error("非法操作");
   				}
   			}
   			exit;
   		}
   		$info = M('goods_category')->where(array('catid'=>$catid))->find();

   		$this->assign('catList',D('Shop/Role')->selectHtmlOption($catid, 'name="parent_id"',1,"一级分类"));
   		$this->assign($info);
   		$this->display();
   }
   //商品分类删除
   public function category_delete(){
   		if(IS_POST){
   			$catArr = I('post.');
   			if(is_array($catArr)){
   				foreach ($catArr['id'] as $k => $v) {
   					$checkGoods = M('goods')->where(array('cat_id'=>$v))->find();
                  $checkAttr = M('goods_attr')->where(array('cat_id'=>$v))->find();
   					if($checkGoods){
   						$this->error("此分类下有商品，请删除商品后在删除分类");
   					}
                  if($checkAttr){
                     $this->error("此分类下有属性，请删除属性后在删除分类");
                  }	
                  $catidArr[] = $v;
   				}
   				$bool = M('goods_category')->where(array('catid'=>array('IN',$catidArr)))->delete();
   				if($bool){
   					$this->success("删除成功",U('Goods/category_list'));
   				}else{
   					$this->error("删除失败");
   				}
   			}else{
   				$this->error("非法操作");
   			}
   		}else{
   			$catid = I('get.catid','','intval');
   			$checkGoods = M('goods')->where(array('cat_id'=>$catid))->find();
   			if(!$checkGoods){
   				$bool = M('goods_category')->where(array('catid'=>$catid))->delete();
   				if($bool){
   					$this->success("删除成功",U('Goods/category_list'));
   				}else{
   					$this->error("非法操作");
   				}
   			}else{
   				$this->error("此分类下有商品，请删除商品后在删除分类");
   			}
   			
   		}
   }
   //商品属性列表
   public function attr_index(){
      $db = M('goods_attr');
      $count = $db->alias('a')->join('tp_goods_category b ON a.cat_id=b.catid')->count();
      $page = $this->page($count, 10);
      $attrList = $db->alias('a')->field('a.*,b.cat_name')->join('tp_goods_category b ON a.cat_id=b.catid')->limit($page->firstRow . ',' . $page->listRows)->order('a.listorder desc,a.attr_id desc')->select();
      $this->assign("Page", $page->show());
      $this->assign("attrList", $attrList);
      $this->display();
   }

   //商品属性添加
   public function attr_add(){
      if(IS_POST){
         $data['cat_id'] = I('post.catid','','intval');
         $data['attr_name'] = I('post.attr_name','');
         $attrStr = I('post.attr_val','');
         $attrArr = explode("，", $attrStr);
         if($data['cat_id']==0){
            $this->error("非法操作");
         }
         if(empty($data['attr_name'])){
            $this->error("请输入属性名称");
         }
         for($i=0;$i<count($attrArr);$i++){
            $data['attr_value'] = $attrArr[$i];
            M('goods_attr')->add($data);
         }
         $this->success("添加成功",U('attr_add'));
      }else{
         $this->assign('catList',D('Shop/Role')->selectHtmlOption(0, 'name="catid"',0));
         $this->display();
      }
   }

   //商品属性修改
   public function attr_edit(){
      $attr_id = I('get.attr_id',0,intval);
      if(IS_POST){
         if($attr_id==0){
            $this->error("非法操作");
         }
         $data['cat_id'] = I('post.catid','','intval');
         $data['attr_name'] = I('post.attr_name','');
         $data['attr_value'] = I('post.attr_val','');

         $bool = M('goods_attr')->where(array('attr_id'=>$attr_id))->save($data);
         if($bool){
            $this->success("修改成功",U('attr_index'));
         }else{
            $this->error("修改失败");
         }
      }
      $info = M('goods_attr')->where(array('attr_id'=>$attr_id))->find();

      $this->assign('catList',D('Shop/Role')->selectHtmlOption($info['cat_id'], 'name="catid"',0));
      $this->assign($info);
      $this->display();
   }

   //商品属性删除
   public function attr_delete(){
      if(IS_POST){
            $attrArr = I('post.');
            if(is_array($attrArr)){
               foreach ($attrArr['id'] as $k => $v) {
                     $attridArr[] = $v;
               }
               $bool = M('goods_attr')->where(array('attr_id'=>array('IN',$attridArr)))->delete();
               if($bool){
                  $this->success("删除成功",U('Goods/attr_index'));
               }else{
                  $this->error("删除失败");
               }
            }else{
               $this->error("非法操作");
            }
         }else{
            $attrid = I('get.attr_id','','intval');
            $bool = M('goods_attr')->where(array('attr_id'=>$attrid))->delete();
               if($bool){
                  $this->success("删除成功",U('Goods/attr_index'));
               }else{
                  $this->error("非法操作");
               }
         }
      
   }
   //用户评论
   public function comment(){
      $db = M('goods_comment');
      $count = $db->count();
      $page = $this->page($count, 10);
      $comment = $db->alias('a')->field('a.goods_name,a.goods_img,b.*')->join('tp_goods b ON a.goods_id=b.goods_id')->limit($page->firstRow . ',' . $page->listRows)->order('a.listorder desc,a.id desc')->select();
      
      $this->assign('comment',$comment);
      $this->assign("Page", $page->show());
      $this->display();
   }
   //查看商品评论
   public function viewComment(){
      $goods_id = I('get.gid','',intval);
      //商品详细信息
      $goodsInfo = M('goods')->where(array('goods_id'=>$goods_id))->find();
      //商品评论
      $count = M('goods_comment')->alias('a')->join('tp_goods_member b ON a.vip_id=b.vip_id')->where(array('a.goods_id'=>$goods_id))->count();
      $page = $this->page($count,10);
      $list = M('goods_comment')->alias('a')->join('tp_goods_member b ON a.vip_id=b.vip_id')->where(array('a.goods_id'=>$goods_id))->limit($page->firstRow.','.$page->listRows)->select();
      //用户信息处理
      foreach ($list as $k => $v) {
         if($v['is_anony']==1){
            //匿名处理
            $list[$k]['nickname'] = substr($v['nickname'], 0,3).'****（匿名）';
         }
      }
      // p($list);
      $this->assign($goodsInfo);
      $this->assign('list',$list);
      $this->assign('Page',$page->show());
      $this->display();
   }
   //根据分类异步获取属性
   public function getAttr(){
      $type = I('post.type','','intval');
      if($type==0){
         $catid = I('post.catid','','intval');
         //查询该分类下的所有属性
         $attrArr = M('goods_attr')->group('attr_name')->where(array('cat_id'=>$catid))->select();
         //组装HTML
         $str = '<option value=0>请选择商品属性名</option>';
         foreach ($attrArr as $k => $v) {
            $str .= '<option value="'.$v['attr_name'].'">'.$v['attr_name'].'</option>';
         }
      }else{
         $attr_name = I('post.attrName','',trim);
         $catid = I('post.catid','',intval);
         //查询该分类下的所有属性
         $attrArr = M('goods_attr')->where(array('attr_name'=>$attr_name,'cat_id'=>$catid))->select();
         //组装HTML
         $str = '<option value=0>请选择商品属性值</option>';
         foreach ($attrArr as $k => $v) {
            $str .= '<option value="'.$v['attr_id'].'" data-val="'.$v['attr_value'].'">'.$v['attr_value'].'</option>';
         }
      }
     
      echo json_encode(array('html'=>$str));
   }
   //格式化属性 分类->属性->值
   // public function getFormatAttr(){
   //    $attrDb = M('goods_attr');
   //    //查询属性的分类
   //    $catIdArr = $attrDb->group('cat_id')->select();
   //    foreach ($catIdArr as $k => $v) {
   //       $attrNameArr = $attrDb->where(array('cat_id'=>$v['cat_id']))->group('attr_name')->select();
   //       foreach ($attrNameArr as $key => $value) {
   //           $array[$k]['attr'][$key]['attr_name'][] = $attrDb->
   //       }
   //       $array[$k]['cat_id'] = $v['cat_id'];
   //    }


   //    return $catIdArr;

   // }

   //排序
   public function listorder(){
		$info = I('post.','');
		$id = 'id';
		switch (I('get.str',''))
		{
			case "cat":
			$db = M('goods_category');
			$a = 'Goods/category_list';
			$id = 'catid';
			break;
			
			case "goods":
			$db = M('goods');
			$a = 'Goods/goods_index';
         $id = 'goods_id';
			break;

         case "attr":
         $db = M('goods_attr');
         $a = 'Goods/attr_index';
         $id = 'attr_id';
         break;
		}
		foreach($info['id'] as $k => $v){
			$db->where(array($id=>$v))->save(array('listorder'=>$info['listorder'][$v]));
		}
		 // p($info);
		$this->success('排序成功！',U($a));
	}

    public function disposeUpload(){
        $args = '20,gif|jpg|jpeg|png|bmp,1,,,0';
        $authkey = upload_key($args);
        $this->assign('arg',$args);
        $this->assign('authkey',$authkey);
    }
}
