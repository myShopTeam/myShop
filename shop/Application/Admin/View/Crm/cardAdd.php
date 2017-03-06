<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
    <div class="wrap J_check_wrap">
        <Admintemplate file="Common/Nav"/>
        <form class="J_ajaxForm" action="{:U('cardAdd')}" method="post" id="myform">
            <div class="h_a">基本属性</div>
            <div class="table_full">
               
                <table width="100%" class="table_form contentWrap">
                    <tr>
                        <th width="80">卡类型<span class="red">*</span></th>
                        <td width="250">
                            <input type="radio" value="1" checked name="card_type_int" class="input nomal_card" id="card_type_int" placeholder="请输入卡号">
                            普通卡&nbsp;&nbsp;
                            <input type="radio" value="2" name="card_type_int" class="input car_card" id="card_type_int" placeholder="请输入卡号">
                            车卡                        
                        </td>
<!--                        <th width="90">是否激活</th>
                        <td>
                            <input type="radio" name="is_active" class="input" id="sex" value="2">是
                            <input type="radio" name="is_active" class="input" id="sex1" value="1" checked>否</td>  
                        </td>-->
                    </tr>
                    
                    <tbody class="nomal">
                        <tr>
                            <th width="80">卡号<span class="red">*</span></th>
                            <td width="250"><input type="test" name="card_num" class="input" id="username" placeholder="请输入卡号"></td>
                            <th width="90">校验码</th>
                            <td><input type="test" name="verif" class="input" id="verify" maxlength="6"  placeholder="请输入卡号"></td>
                        </tr>
                        <tr>
                            <th>卡单类型<span class="red">*</span></th>
                            <td>
                                <select name="card_type" class="select" id="car_type">
                                    <option ></option>
                                    <volist name="type" id="vo">
                                        <option <if condition="$vo.type != 1">disabled</if> value="{$vo.card_name}">{$vo.card_name}</option>
                                    </volist>
                                </select>
                            </td>
                            <th>产品名称<span class="red">*</span></th>
                            <td>
                                <select name="card_name" class="select" id="card_name">
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th width="80">真实姓名</th>
                            <td width="350"><input type="test" name="realname" class="input" id="realname"  placeholder="请输入真实姓名"></td>
                            <th width="80">身份证号</th>
                            <td><input type="text" name="cred_num" value="" class="input" id="email"  placeholder="请输入身份证号"></td>
                        </tr>
                        <tr>
                            <th>出生年月</th>
                            <td><input type="text" name="birthday" class="input length_2 J_date" id="birthday" value="{$_GET.start_uploadtime}" placeholder="请输入生日" style="width: 147px !important;"></td>
                            <th>联系地址</th>
                            <td><input type="text" name="live" value="" class="input" id="qq" placeholder="请输入联系地址"></td>
                        </tr>
                        <tr class="mobile_tr">          
                            <th width="80">手机</th>
                            <td><input type="text" name="mobile" value="" class="input" id="email"  placeholder="请输入手机号"></td>
                        </tr>   
                        <tr>
                            <th>省份</th>
                            <td><input type="text" name="addr_province" value="" class="input" id="phone" placeholder="请输入省份"></td>
                            <th>城市</th>
                            <td><input type="text" name="addr_city" value="" class="input" id="mobile" placeholder="请输入城市"></td>
                        </tr>
                        <tr>
                            <th>紧急联系人</th>
                            <td><input type="text" name="contract_name" value="" class="input" id="phone" placeholder="请输入紧急联系人姓名"></td>
                            <th>紧急联系人电话</th>
                            <td><input type="text" name="contract_way" value="" class="input" id="mobile" placeholder="请输入紧急联系人电话"></td>
                        </tr> 
                        <tr>
                            <th>性别</th>
                            <td><input type="radio" name="sex" class="input" id="sex" value="保密" checked>保密
                                <input type="radio" name="sex" class="input" id="sex" value="男">男
                                <input type="radio" name="sex" class="input" id="sex1" value="女">女</td>
                        <tr>
                    </tbody>
                    <tbody class="car" style="display:none">
                        <tr>
                            <th width="80">卡号<span class="red">*</span></th>
                            <td width="250"><input disabled type="test" name="card_num" class="input" id="username" placeholder="请输入卡号"></td>
                            <th width="90">校验码</th>
                            <td><input type="test" disabled name="verif" class="input" id="verify" maxlength="6"  placeholder="请输入卡号"></td>
                        </tr>
                        <tr>
                            <th>卡单类型<span class="red">*</span></th>
                            <td>
                                <select disabled name="card_type" class="select" id="card_type">
                                    <option ></option>
                                    <volist name="type" id="vo">
                                        <option <if condition="$vo.type != 2">disabled</if> value="{$vo.card_name}">{$vo.card_name}</option>
                                    </volist>
                                </select>
                            </td>
                            <th>产品名称<span class="red">*</span></th>
                            <td>
                                <select disabled name="card_name" class="select" id="car_name">
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th width="80">车主姓名</th>
                            <td width="350"><input disabled type="test" name="realname" class="input" id="realname"  placeholder="请输入真实姓名"></td>
                            <th width="80">身份证号</th>
                            <td><input disabled type="text" name="cred_num" value="" class="input" id="email"  placeholder="请输入身份证号"></td>
                        </tr>
                        <tr class="mobile_tr">          
                            <th width="80">手机</th>
                            <td><input disabled type="text" name="mobile" value="" class="input" id="email"  placeholder="请输入手机号"></td>
                            <th>联系地址</th>
                            <td><input disabled type="text" name="live" value="" class="input" id="qq" placeholder="请输入联系地址"></td>
                        </tr>   
                        <tr>
                            <th>车辆类型</th>
                            <td>
                                <select disabled name="car_type" class="selectType">
                                <option selected="selected" value="">--请选择车辆类型--</option>
                                <option value="非营运2-5座客车">非营运2-5座客车</option>
                                <option value="营运2-5座客车">营运2-5座客车</option>
                                <option value="营运6-9-座客车">营运6-9-座客车</option>
                                <option value="非营运6-9座客车">非营运6-9座客车</option>
                                <option value="1-3座专用车及10吨以上货车">1-3座专用车及10吨以上货车</option>
                                <option value="2-3座罐装车">2-3座罐装车</option>
                                <option value="0-10吨货车">0-10吨货车</option> 
                                </select>
                            </td>
                            <th>车牌号</th>
                            <td><input disabled type="text" name="num_plate" value="" class="input" id="mobile" placeholder="请输入车牌号"></td>
                        </tr>
                        <tr>
                            <th>发动机号</th>
                            <td><input disabled type="text" name="engine_number" value="" class="input" id="phone" placeholder="请输入发动机号"></td>
                            <th>核定座位数</th>
                            <td><input disabled type="text" name="car_seat_num" value="" class="input" id="mobile" placeholder="请输入紧急联系人电话"></td>
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
<script>
    $('#card_type,#car_type').change(function() {
        var thisSel = $(this)
        var url = "{:U('ajaxGetProduct')}";
        var data = 'card_type=' + $(this).val()
        $.post(url, data, function(re) {
            if (re.res == 'success') {
                thisSel.parents('tr').find('select[name="card_name"]').html(re.data)
            } else {
                alert(re.msg);
            }
        }, 'json')
    })

    $('input[name="mobile"]').focusout(function() {
        var mobile = $(this).val()
        var url = "{:U('ajaxCheckMobile')}";
        $.post(url, 'mobile=' + mobile, function(re) {
            if (re == 0) {
                var html = '<tr class="password">';
                html += '<th>初始密码</th>';
                html += '<td><input type="text" name="password" value="" class="input" id="phone" placeholder="输入初始密码"></td>';
                html += '<th>确认密码</th>';
                html += '<td><input type="text" name="confirm_psd" value="" class="input" id="mobile" placeholder="确认密码"></td>';
                html += '</tr>';
                if ($('.password').length == 0)
                    $('.mobile_tr').after(html)
            } else {
                if ($('.password').length > 0)
                    $('.password').remove()
            }
        })
    })
    
    $('input[name="card_type_int"]').click(function(){
        if($(this).val() == 1){
            $('.nomal').show()
            $('.car').find('input').attr('disabled',true)
            $('.car').find('select').attr('disabled',true)
            $('.nomal').find('input').removeAttr('disabled')
            $('.nomal').find('select').removeAttr('disabled')
            $('.car').hide()
        }else{
            $('.car').show()
            $('.nomal').find('input').attr('disabled',true)
            $('.nomal').find('select').attr('disabled',true)
            $('.car').find('input').removeAttr('disabled')
            $('.car').find('select').removeAttr('disabled')
            
            $('.nomal').hide()
        }
    })
</script>