<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('bulk_add')}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">团购商品<span class="red">*</span></th>
            <td width="350"><select name="goods_id" style="width: 155px;">
              <option value="0">选择团购商品</option>
              <volist name="goodsList" id="vo">
                  <option value="{$vo.goods_id}">{$vo.goods_name}</option>
              </volist>
            </select></td>
              <th width="80">保证金</th>
            <td><input type="text" name="deposit" value="" class="input" id="deposit" placeholder="请输入保证金的数量">&nbsp;&nbsp;元</td>
          </tr>
          <tr>
            <th width="80">活动开始时间</th>
            <td width="350"><input type="text" name="start_time" class="input length_2 J_date" value="{$_GET.start_uploadtime}" style="width: 144px;" placeholder="请选择活动开始时间"></td>
              <th width="80">活动结束时间</th>
            <td><input type="text" class="input length_2 J_date" name="end_time" value="{$_GET.end_uploadtime}" style="width: 144px;" placeholder="请选择活动开始时间"></td>
          </tr>
          <tr>
            <th>限购数量</th>
            <td><input type="text" name="restrict_amount" value="" class="input" id="restrict_amount" placeholder="请输入家庭电话"></td>
            <th>价格阶梯</th>
            <td><input type="text" name="phone" value="" class="input" id="phone" placeholder="请输入家庭电话"></td>
          </tr>
          <tr>
            <th>家庭电话</th>
            <td><input type="text" name="phone" value="" class="input" id="phone" placeholder="请输入家庭电话"></td>
            <th>手机</th>
            <td><input type="text" name="mobile" value="" class="input" id="mobile" placeholder="请输入手机号"></td>
          </tr>
          <tr>
          <tr>
            <th>性别</th>
            <td><input type="radio" name="sex" class="input" id="sex" value="保密" checked>保密
            <input type="radio" name="sex" class="input" id="sex" value="男">男
            <input type="radio" name="sex" class="input" id="sex1" value="女">女</td>
            <th>是否启动</th>
                <td><select name="status">
                      <option value="1">启动</option>
                      <option value="0">冻结</option>
                  </select><span class="gray">账户冻结后，此账户所有商品将下架</span></td>
          </tr>
        </tbody>
      </table>
   </div>
   <div class="btn_wrap" style="z-index:9999 !important;">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
      </div>
    </div>
    </form>
</div>
<script src="{$config_siteurl}statics/js/common.js"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
<style type="text/css">.content_attr{ border:1px solid #CCC; padding:5px 8px; background:#FFC; margin-top:6px}</style>
</body>
</html>