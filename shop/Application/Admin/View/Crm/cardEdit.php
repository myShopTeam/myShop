<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
    <div class="wrap J_check_wrap">
        <Admintemplate file="Common/Nav"/>
        <form class="J_ajaxForm" action="{:U('cardEdit')}" method="post" id="myform">
            <div class="h_a">基本属性</div>
            <div class="table_full">
                <input type="hidden" name="id" value="{$id}">
                <table width="100%" class="table_form contentWrap">
                    <if  condition="$card_type_int == 1">
                        <tbody>
                            <tr>
                                <th width="80">卡号<span class="red">*</span></th>
                                <td width="250"><input readonly type="test" value='{$card_num}' name="card_num" class="input" id="username" placeholder="请输入卡号"></td>
                                <th width="90">校验码</th>
                                <td><input type="test" name="verif" class="input" id="verify" maxlength="6" value="{$verif}" placeholder="请输入卡号"></td>
                            </tr>
                            <tr>
                                <th>卡单类型<span class="red">*</span></th>
                                <td>
                                    <select name="card_type" class="select" id="card_type">
                                        <option ></option>
                                        <volist name="card_type_name" id="vo">
                                            <option <eq name="vo.card_name"  value="$card_type">selected</eq>  value="{$vo.card_name}">{$vo.card_name}</option>
                                        </volist>
                                    </select>
                                </td>
                                <th>产品名称<span class="red">*</span></th>
                                <td>
                                    <select name="card_name" class="select" id="card_name">
                                        <option ></option>
                                        <volist name="product" id="vo">
                                            <option <eq name="vo.card_name" value="$card_name">selected</eq> value="{$vo.card_name}">{$vo.card_name}</option>
                                        </volist>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th width="80">真实姓名</th>
                                <td width="350"><input type="test" value='{$realname}' name="realname" class="input" id="realname"  placeholder="请输入真实姓名"></td>
                                <th width="80">身份证</th>
                                <td><input type="text" name="cred_num" value="{$cred_num}" class="input" id="email"  placeholder="请输入手机号"></td>

                            </tr>
                            <tr>
                                <th>出生年月</th>
                                <td><input type="text" name="birthday" value="<if condition='$birthday'>{$birthday|date='Y-m-d',###}</if>" class="input length_2 J_date" id="birthday" value="{$_GET.start_uploadtime}" placeholder="请输入生日" style="width: 147px !important;"></td>
                                <th>联系地址</th>
                                <td><input type="text" name="contract_addr" value="{$contract_addr}" class="input" id="qq" placeholder="请输入联系地址"></td>
                            </tr>
                            <tr>
                                <th width="80">手机</th>
                                <td><input type="text" name="mobile" value="{$mobile}" class="input" id="email"  placeholder="请输入手机号"></td>
                            </tr>
                            <tr>
                                <th>省份</th>
                                <td><input type="text" name="addr_province"  value="{$addr_province}" class="input" id="phone" placeholder="请输入省份"></td>
                                <th>城市</th>
                                <td><input type="text" name="addr_city" value="{$addr_city}" class="input" id="mobile" placeholder="请输入城市"></td>
                            </tr>
                            <tr>
                                <th>紧急联系人</th>
                                <td><input type="text" name="contract_name" value="{$contract_name}" class="input" id="phone" placeholder="请输入紧急联系人姓名"></td>
                                <th>紧急联系人电话</th>
                                <td><input type="text" name="contract_way" value="{$contract_way}" class="input" id="mobile" placeholder="请输入紧急联系人电话"></td>
                            </tr>
                            <tr>
                            <th>性别</th>
                                    <td><input type="radio" name="sex" class="input" id="sex" value="保密" <if condition="$sex eq '保密'"> checked</if>>保密
                            <input type="radio" name="sex" class="input" id="sex" value="男" <if condition="$sex eq '男'"> checked</if>>男
                            <input type="radio" name="sex" class="input" id="sex1" value="女" <if condition="$sex eq '女'"> checked</if>>女</td>
                            <th>状态</th>
                            <td style="color:green"><if condition="$is_active == 2">已激活<else/><font color="red">未激活</font></if></td>
                            </tr>
                            </tbody>
                        <else/>
                        <tbody>
                            <tr>
                                <th width="80">卡号<span class="red">*</span></th>
                                <td width="250"><input value='{$card_num}' type="test" name="card_num" class="input" id="username" placeholder="请输入卡号"></td>
                                <th width="90">校验码</th>
                                <td><input type="test"  name="verif" value="{$verif}" class="input" id="verify" maxlength="6"  placeholder="请输入卡号"></td>
                            </tr>
                            <tr>
                                <th>卡单类型<span class="red">*</span></th>
                                <td>
                                    <select  name="card_type" class="select" id="card_type">
                                        <option ></option>
                                        <volist name="card_type_name" id="vo">
                                            <option <eq name="vo.card_name"  value="$card_type">selected</eq> value="{$vo.card_name}">{$vo.card_name}</option>
                                        </volist>
                                    </select>
                                </td>
                                <th>产品名称<span class="red">*</span></th>
                                <td>
                                    <select name="card_name" class="select" id="card_name">
                                        <option ></option>
                                        <volist name="product" id="vo">
                                            <option <eq name="vo.card_name" value="$card_name">selected</eq> value="{$vo.card_name}">{$vo.card_name}</option>
                                        </volist>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th width="80">车主姓名</th>
                                <td width="350"><input value='{$realname}' type="test" name="realname" class="input" id="realname"  placeholder="请输入真实姓名"></td>
                                <th width="80">身份证号</th>
                                <td><input value="{$cred_num}" type="text" name="cred_num"  class="input" id="email"  placeholder="请输入身份证号"></td>
                            </tr>
                            <tr class="mobile_tr">          
                                <th width="80">手机</th>
                                <td><input value="{$mobile}" type="text" name="mobile"  class="input" id="email"  placeholder="请输入手机号"></td>
                                <th>联系地址</th>
                                <td><input type="text" name="contract_addr" value="{$contract_addr}" class="input" id="qq" placeholder="请输入联系地址"></td>
                            </tr>   
                            <tr>
                                <th>车辆类型</th>
                                <td>
                                    <select name="car_type" class="selectType">
                                        <option value="">--请选择车辆类型--</option>
                                        <option <if condition="$car_type == '非营运2-5座客车'"> selected="selected"</if> value="非营运2-5座客车">非营运2-5座客车</option>
                                        <option <if condition="$car_type == '营运2-5座客车'"> selected="selected"</if> value="营运2-5座客车">营运2-5座客车</option>
                                        <option <if condition="$car_type == '营运6-9-座客车'"> selected="selected"</if> value="营运6-9-座客车">营运6-9-座客车</option>
                                        <option <if condition="$car_type == '非营运6-9座客车'"> selected="selected"</if> value="非营运6-9座客车">非营运6-9座客车</option>
                                        <option <if condition="$car_type == '1-3座专用车及10吨以上货车'"> selected="selected"</if> value="1-3座专用车及10吨以上货车">1-3座专用车及10吨以上货车</option>
                                        <option <if condition="$car_type == '2-3座罐装车'"> selected="selected"</if> value="2-3座罐装车">2-3座罐装车</option>
                                        <option <if condition="$car_type == '0-10吨货车'"> selected="selected"</if> value="0-10吨货车">0-10吨货车</option> 
                                    </select>
                                </td>
                                <th>车牌号</th>
                                <td><input  type="text" name="num_plate" value="{$num_plate}" class="input" id="mobile" placeholder="请输入车牌号"></td>
                            </tr>
                            <tr>
                                <th>发动机号</th>
                                <td><input  type="text" name="engine_number" value="{$engine_number}" class="input" id="phone" placeholder="请输入发动机号"></td>
                                <th>核定座位数</th>
                                <td><input type="text" name="car_seat_num" value="{$car_seat_num}" class="input" id="mobile" placeholder="请输入紧急联系人电话"></td>
                            </tr> 
                            <tr>
                            <th>状态</th>
                            <td style="color:green"><if condition="$is_active == 2">已激活<else/><font color="red">未激活</font></if></td>
                            </tr>
                        </tbody>    
                    </if>
                </table>
            </div>
            <div class="btn_wrap" style="z-index:9999 !important;">
                <div class="btn_wrap_pd">             
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">修改</button>
                </div>
            </div>
        </form>
    </div>
    <script src="{$config_siteurl}statics/js/common.js"></script>
    <script src="{$config_siteurl}statics/js/content_addtop.js"></script>
    <style type="text/css">.content_attr{ border:1px solid #CCC; padding:5px 8px; background:#FFC; margin-top:6px}</style>
</body>
</html>
<script>
    $('#card_type').change(function() {
        var url = "{:U('ajaxGetProduct')}";
        var data = 'card_type=' + $(this).val()
        $.post(url, data, function(re) {
            if (re.res == 'success') {
                $('#card_name').html(re.data)
            } else {
                alert(re.msg);
            }
        }, 'json')
    })
</script>
