﻿<template file="Site/new_head.php" />

<body>
<!--页头-->
<template file="Site/new_header.php" />
<!--导航-->
<template file="Site/new_naviga.php" />
<!-- 内容 -->
<div class="w100 neiBannerBox"><div class="w100 neiBanner neiBanner01"></div><div class="bgLine"></div></div>
<!-- 内容 -->
<div class="w content">
    <!--left-->
    <template file="Site/new_left.php" />
    <div class="fr nb_cent_r">
        <div class="webMapTitle">
            <span class="wz">您所在的位置：</span><a href="/">首页</a> &gt; <a href="javascript:;">{:getCategory($parentid, 'catname')}</a> &gt; <a class="last" href="{:U('Content/Index/lists', array('catid' => $catid))}">{:getCategory($catid, 'catname')}</a>
        </div>
        <div class="RightContent">
            <!-- 内容 -->
            <div class="CardBox">
                <div class="TabCtrl">
                    <span class="this">卡单激活</span>
                    <span>卡单查询</span>
                    <span>保单查询</span>
                </div>
                <div class="CardActivation TabCard">
                    <!-- 第一步验证 -->
                    <form id='verify'>
                        <div class="TabActiveation pb30 firstStep">
                            <dl>
                                <dt>卡类型</dt>
                                <dd>
                                    <select name="card_name" class="selectCardType">
                                        <option selected="selected" value="">--请选择--</option>
                                    </select>
                                </dd>
                            </dl>
                            <dl>
                                <dt>卡号</dt>
                                <dd><input  type="text" class="first_num"  name="card_num" class="txt datainp" /></dd>
                            </dl>
                            <dl>
                                <dt>效验码</dt>
                                <dd><input type="text" name="verif" class="txt" /></dd>
                            </dl>
                            <dl>
                                <dt>验证码</dt>
                                <dd class="code"><input type="text" name='code' class="txt" /><img class='verifycode' src="images/code_img.jpg" /><a style="cursor:pointer" onclick="$('.verifycode').attr('src',$('.verifycode').attr('src')+'&refresh=1&time=' + Math.random());">看不清？点击更换</a></dd>
                            </dl>
                            <dl>
                                <dt></dt>
                                <dd><input style='text-align: center;cursor:pointer' class="btn btnSubmit" value="下一步" /><input type="button" class="btn" value="取 消" /></dd>
                            </dl>
                    </div>
                </form>
                <!--end  第一步验证--> 
                <!--第二步验证(普通卡) start-->
                <form id="thirdStepNormal">
                    <div class="thirdStepNormal thirdStep" style="display:none">
                        <input type="hidden" value="" id="card_num" name="card_num">
                        <input type="hidden" value="" id="card_type_p" name="card_type_int">
                        <dl>
                            <dt>客户姓名</dt>
                            <dd>
                                <input type="text" name="realname" >
                            </dd>
                        </dl>
                        <dl>
                            <dt>性别</dt>
                            <dd>
                                <input  type="radio" name="sex" value="男" checked><span>男</span>
                                <input  type="radio" name="sex" value="女"><span>女</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>手机</dt>
                            <dd><input  type="text" name="mobile" id="mobile" class="txt datainp" /></dd>
                        </dl>
                        <dl>
                            <dt>生日</dt>
                            <dd><input type="text" id="datebut" name="birthday" onFocus="jeDate({dateCell:'#datebut',format:'YYYY-MM-DD'})" onClick="jeDate({dateCell:'#datebut',format:'YYYY-MM-DD'})"  class="txt" /></dd>
                        </dl>

                        <dl>
                            <dt>所在省市</dt>
                            <select style="height:28px" class="input-medium m-wrap" name="Province" id="loc_province"></select>
                            <select style="height:28px"  class="input-medium m-wrap" name="City" id="loc_city"></select>
                            <input type="hidden" value="" name="ProvinceCode" id="loc_provinceCode" />
                            <input type="hidden" value="" name="CityCode" id="loc_cityCode" />
                        </dl>
                        
                        <dl>
                        <dt>联系地址</dt>
                        <dd><input  type="text" name="contract_addr"/></dd>
                        </dl>
                        <dl>
                            <dt>身份证号</dt>
                            <dd><input type="text" name="cred_num" id="cred_num" class="txt" /></dd>
                        </dl>
                        <dl>
                            <dt></dt>
                            <dd><input style='text-align: center;cursor:pointer;background: #00bb5e;color: #FFF' class="btn thirdStepSubmit" value="激活" /></dd>
                        </dl>
                </div>
            </form>
            <!--第二步验证(普通卡) end-->
            <!--第二步验证（车卡） start-->
            <form id="thirdStepCar">
                <div class="thirdStepCar thirdStep" style="display:none">
                    <input type="hidden" value="" id="card_num" name="card_num">
                    <input type="hidden" value="" id="card_type_p" name="card_type_int"/>
                    <dl>
                        <dt>车主姓名</dt>
                        <dd>
                            <input type="text" name="realname" />
                        </dd>
                    </dl>
                    <dl>
                        <dt>身份证号</dt>
                        <dd><input type="text" name="cred_num" id="cred_num" /></dd>
                    </dl>
                    <dl>
                        <dt>手机</dt>
                        <dd><input  type="text" name="mobile" id="mobile" /></dd>
                    </dl>
                    <dl>
                        <dt>联系地址</dt>
                        <dd><input  type="text" name="contract_addr"/></dd>
                    </dl>
                    <dl>
                        <dt>车辆类型</dt>
                        <dd>
                            <select name="car_type" class="selectType">
                                <option selected="selected" value="">--请选择车辆类型--</option>
                                <option value="非营运2-5座客车">非营运2-5座客车</option>
                                <option value="营运2-5座客车">营运2-5座客车</option>
                                <option value="营运6-9-座客车">营运6-9-座客车</option>
                                <option value="非营运6-9座客车">非营运6-9座客车</option>
                                <option value="1-3座专用车及10吨以上货车">1-3座专用车及10吨以上货车</option>
                                <option value="2-3座罐装车">2-3座罐装车</option>
                                <option value="0-10吨货车">0-10吨货车</option> 
                            </select>
                        </dd>
                    </dl>
                    <dl>
                        <dt>车牌号</dt>
                        <dd><input  type="text" name="num_plate" /></dd>
                    </dl>
                    <dl>
                        <dt>发动机号</dt>
                        <dd><input  type="text" name="engine_number" /></dd>
                    </dl>
                    <dl>
                        <dt style="width:70px">核定座位数</dt>
                        <dd><input  type="text" name="car_seat_num"  /></dd>
                    </dl>
                    
                    <dl>
                        <dt></dt>
                        <dd><input style='text-align: center;cursor:pointer;background: #00bb5e;color: #FFF' class="btn thirdStepSubmit" value="激活" /></dd>
                    </dl>
                </div>
            </form>
            <!--第二步验证（车卡） end-->
            <!--设置初始密码 start-->
            <form id="fourStep">
                <div class="fourStep" style="display:none">
                    <dl>
                        国安网站及商城登录账号：<span class='active_mobile' style='color: green'>123112111</span>
                    </dl>
                    <dl>
                        <dt>设置密码</dt>
                        <dd>
                            <input placeholder="设置初始密码" type="password" name="password" >
                        </dd>
                    </dl>
                    <dl>
                        <dt>确认密码</dt>
                        <dd><input placeholder="确认密码" type="password" name="confirm_psd" class="txt" /></dd>
                    </dl>

                    <dl>
                        <dt></dt>
                        <dd><input style='text-align: center;cursor:pointer;background: #00bb5e;color: #FFF' class="btn fourStepSubmit" value="提交" /></dd>
                    </dl>
                </div>
            </form>
            <!--设置初始话密码 end-->
                    <div class="CardMsg tcc twb">
                        <content action="lists" catid="$catid" num="1" moreinfo="1" order="listorder DESC, id DESC">
                            <!--投保风险告知函-->
                            <div class="secondStep" style="display:none">
                                <dl style='text-align: center;' class='content_title'>投保风险告知函</dl>
                                <dl>
                                    <dd><input style='text-align: center;cursor:pointer;background: #00bb5e;color: #FFF' class="btn secondStepBtn" value="下一步" /></dd>
                                </dl>
                            </div>
                            <div class='site_content'>
                            <volist name="data" id="vo">
                                {$vo.content}
                            </volist>
                            </div>
                        </content>
                    </div>
                </div>
                <div class="CardActivation Select TabCard hide">
                    <div class="TabActiveation pb30">
                        <form action="" method="post">
                            <dl>
                                <dt>身份证</dt>
                                <dd class="code"><input placeholder="输入身份证" type="text" class="txt" id="cred_num_val" /><input class="btn cardSearch" style="text-align: center;background: #00bb5e;color: #FFF;cursor:pointer" value="查询" /></dd>
                            </dl>
                        </form>
                        <table class="TabSelect w100 cardlist" cellpadding="0" cellspacing="0">


                            
                        </table>
                    </div>
                </div>
                <div class="CardActivation Select TabCard hide">
                    <div class="TabActiveation pb30">
                            <dl>
                                <dt>身份证</dt>
                                <dd class="code"><input name="cred_num" id="insuranceVal" placeholder="输入身份证" type="text" class="txt" /><input style="text-align: center;background: #00bb5e;color: #FFF;cursor:pointer"  class="btn insuranceSearch" value="查询" /></dd>
                            </dl>
                        <table class="TabSelect w100 insuranceList" cellpadding="0" cellspacing="0">
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
<script type="text/javascript" src="{$site_info.common_path}js/template.js"></script>
<script type="text/javascript" src="{$site_info.site_path}jedate/jedate.js"></script>
<script type="text/javascript" src="{$site_info.site_path}area/area.js"></script>
<script type="text/javascript" src="{$site_info.site_path}area/location.js"></script>
<script type="text/javascript">
$(document).ready(function () {

    //选项卡
    $(".CardBox .TabCtrl span").click(function () {
        var index = $(this).index();
        $(".CardBox .TabCtrl span").removeClass("this");
        $(this).addClass("this");
        $(".CardBox .TabCard").addClass("hide");
        $(".CardBox .TabCard:eq(" + index + ")").removeClass("hide");


    })

    //定义全局变量
    var _global = {};
    //页面加载获取验证码
    $.post("{:U('Content/Crm/cardActive')}",'',function(re){
        $('.verifycode').attr('src',re.code)
        $('.selectCardType').append(re.card_type)
    },'json')
    
    //卡单验证-第一步
    $('.btnSubmit').click(function(){  
        var data=$('#verify').serialize()
        $.post("{:U('Content/Crm/cardVerify')}",data,function(re){
            if(re){
                if(re.state){
                    alert(re.info)
                    return false;
                }else if(re.is_active == '2'){
                    alert('该卡单已激活！')
                }else if(re.is_active == '1'){
                    $('.firstStep').css('display','none')
                    $('.content_title').after(re.content);
                    $('.site_content').css('display','none')
                    $('.secondStep').css('display','block')
                    $('#card_num').val(re.card_num)   
                }
            }else{
                alert('卡单不存在或者校验码、卡类型错误！')
            }
            $('.verifycode').attr('src',$('.verifycode').attr('src')+'&refresh=1&time=' + Math.random());         
        },'json')
    })  
    
    $('.secondStepBtn').click(function(){
        var card_type = $('.selectCardType :selected').data('type')
        $('.secondStep').css('display','none');
        var num = $('.first_num').val()
        switch(card_type){
            case 1:
                $('.thirdStepNormal').css('display','block');
                $('.thirdStepNormal').find('#card_type_p').val(card_type)
                $('.thirdStepNormal').find('#card_num').val(num)
                break;
            case 2:
                $('.thirdStepCar').css('display','block');
                $('.thirdStepCar').find('#card_num').val(num)
                $('.thirdStepCar').find('#card_type_p').val(card_type)
                break;
        }   
    })
    
    //身份信息提交
    $('.thirdStepSubmit').click(function(){
        var card_type = $('.selectCardType :selected').data('type')
        thisbtn = $(this)
        thisform = $(this).parents('form')
        if(card_type == 2){
            inputObj = thisform.find('input')
            var result = true;
            inputObj.each(function(){
                if($(this).val() == ''){
                    alert('信息请填写完全！')
                    result = false;
                    return false;
                }
            })
            if(!result) return false;
        }
        if (!thisform.find("#mobile").val().match(/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/)) { 
            alert("手机号码格式不正确！"); 
            return false;
        }
        if (!thisform.find("#cred_num").val().match(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/)) { 
            alert("身份证号格式不正确！"); 
            return false;
        }
        
        var data=thisform.serialize()
        $.post("{:U('Content/Crm/ajaxCheckMobile')}",'mobile='+thisform.find("#mobile").val(),function(re){
            if(re > 0){
                ajaxActive(data)
            }else{
                $('.active_mobile').text($("#mobile").val())
                $('.fourStep').data('form',data)
                thisbtn.parents('thirdStep').css('display','none')
                $(".fourStep").css('display','block')
            }
        })
    })
    
    //初始密码提交
    $('.fourStepSubmit').click(function(){
        var userInfo = $('.fourStep').data('form')
        var formData = userInfo + "&" + $('#fourStep').serialize()
        $.post("{:U('Content/Crm/cardActiveDo')}",formData,function(re){
            alert(re.info)
            if(re.state == 'success'){
                location.reload() 
            }else{
               $(".fourStep").css('display','none')
               $(".thirdStep").css('display','block') 
            }
        },'json')
    })
    
    function ajaxActive(data){
        $.post("{:U('Content/Crm/cardActiveDo')}",data,function(re){
            alert(re.info)
            if(re.state == 'success'){
                location.reload() 
            }
        },'json')
    }
    
    $('.cardSearch').click(function(){
        if($("#cred_num_val").val() == ''){
            alert('请输入待查询的身份证！')
            return false;
        }
        if (!$("#cred_num_val").val().match(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/)) { 
            alert("身份证号格式不正确！"); 
            return false;
        }
        $.post("{:U('Content/Crm/cardSearch')}",'cred_num='+$('#cred_num_val').val(),function(re){
            var data = {
                title: '基本例子',
                isAdmin: true,
                list: re
            };
            var html = template('cardSearch', data);
            $('.cardlist').html(html);
        },'json')
    })
    
    $('.insuranceSearch').click(function(){
        if($("#insuranceVal").val() == ''){
            alert('请输入待查询的身份证！')
            return false;
        }
        if (!$("#insuranceVal").val().match(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/)) { 
            alert("身份证号格式不正确！"); 
            return false;
        }
        $.post("{:U('Content/Crm/insuranceSearch')}",'cred_num='+$('#insuranceVal').val(),function(re){
            var data = {
                title: '基本例子',
                isAdmin: true,
                list: re
            };
            var html = template('insuranceSearch', data);
            $('.insuranceList').html(html);
        },'json')
    })

})

</script>
<script id="cardSearch" type="text/html">
<tr>
    <th width="85">姓名</th>
    <th width="125">卡单类型</th>
    <th width="210">身份证</th>
    <th width="210">激活状态</th>
    <th>生效日期</th>
</tr>
{{if isAdmin}}
{{each list as value i}}
<tr>
    <td>{{value.realname}}</td>
    <td>{{value.card_type}}</td>
    <td>{{value.cred_num}}</td>
    <td>{{if value.is_active == 2}}已激活{{/if}}</td>
    <td>{{value.start_time}}</td>
</tr>
{{/each}}
{{/if}}
</script>
<script id="insuranceSearch" type="text/html">
<tr>
    <th width="85">姓名</th>
    <th width="210">身份证</th>
    <th width="210">保险合同号码</th>
    <th width="185">保险生效日期</th>
    <th>救援服务项目生效日期</th>
</tr>
{{if isAdmin}}
{{each list as value i}}
<tr>
    <td>{{value.realname}}</td>
    <td>{{value.cred_num}}</td>
    <td>{{value.insurance_num}}</td>
    <td>{{value.start_time}}</td>
    <td>{{value.rescue_time}}</td>
</tr>
{{/each}}
{{/if}}
</script>

<script type="text/javascript">
    //jeDate.skin('gray');
	jeDate({
		dateCell:"#indate",//isinitVal:true,
		format:"YYYY-MM",
		isTime:false, //isClear:false,
		minDate:"2015-10-19 00:00:00",
		maxDate:"2016-11-8 00:00:00"
	})
    jeDate({
		dateCell:"#dateinfo",
		format:"YYYY年MM月DD日 hh:mm:ss",
		isinitVal:true,
		isTime:true, //isClear:false,
		minDate:"2014-09-19 00:00:00",
		okfun:function(val){alert(val)}
	})
</script>
<script type="text/javascript">
$(document).ready(function() {
    showLocation(
       $("#loc_provinceCode").val() == "" ? "2456" : $("#loc_provinceCode").val(),
       $("#loc_cityCode").val() == "" ? "2457" : $("#loc_cityCode").val(),
       $("#loc_townCode").val() == "" ? "0" : $("#loc_townCode").val());
});
</script>
</body>
</html>