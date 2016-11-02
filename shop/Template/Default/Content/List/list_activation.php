<template file="Site/new_head.php" />

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
                    <form id='verify'>
                    <div class="TabActiveation pb30 firstStep">
                            <dl>
                                <dt>卡类型</dt>
                                <dd>
                                    <select name="card_name" class="selectType">
                                        <option selected="selected">--请选择--</option>
                                    </select>
                                </dd>
                            </dl>
                            <dl>
                                <dt>卡号</dt>
                                <dd><input  type="text"  name="card_num" class="txt datainp" /></dd>
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
                <form id="secondStep">
                        <div class="secondStep" style="display:none">
                            <input type="hidden" value="" id="card_num" name="card_num">
                            <dl>
                                <dt>真实姓名</dt>
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
                                <dd><input type="text" id="datebut" name="birthday" onClick="jeDate({dateCell:'#datebut',format:'YYYY-MM-DD'})" name="verif" class="txt" /></dd>
                            </dl>
                            <dl>
                                <dt>所在省市</dt>
                                <select style="height:28px" class="input-medium m-wrap" name="Province" id="loc_province"></select>
                                <select style="height:28px"  class="input-medium m-wrap" name="City" id="loc_city"></select>
                                <input type="hidden" value="" name="ProvinceCode" id="loc_provinceCode" />
                                <input type="hidden" value="" name="CityCode" id="loc_cityCode" />
                            </dl>
                            <dl>
                                <dt>身份证号</dt>
                                <dd><input type="text" name="cred_num" id="cred_num" class="txt" /></dd>
                            </dl>
                            <dl>
                                <dt></dt>
                                <dd><input style='text-align: center;cursor:pointer;background: #00bb5e;color: #FFF' class="btn secondStepSubmit" value="激活" /></dd>
                            </dl>
                    </div>
                    </form>
                    <div class="CardMsg tcc twb">
                        <content action="lists" catid="$catid" num="1" moreinfo="1" order="listorder DESC, id DESC">
                            <volist name="data" id="vo">
                                {$vo.content}
                            </volist>
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
        $('.selectType').append(re.card_type)
    },'json')
    
    //卡单验证
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
                    $('.secondStep').css('display','block')
                    $('#card_num').val(re.card_num)
                    
                }
            }else{
                alert('卡单不存在或者校验码错误！')
            }
            $('.verifycode').attr('src',$('.verifycode').attr('src')+'&refresh=1&time=' + Math.random());         
        },'json')
    })  
    
    //身份信息提交
    $('.secondStepSubmit').click(function(){
        if (!$("#mobile").val().match(/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/)) { 
            alert("手机号码格式不正确！"); 
            return false;
        }
        if (!$("#cred_num").val().match(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/)) { 
            alert("身份证号格式不正确！"); 
            return false;
        }
        var data=$('#secondStep').serialize()
        $.post("{:U('Content/Crm/cardActiveDo')}",data,function(re){
            alert(re.info)
            if(re.state == 'success'){
                location.reload() 
            }
        },'json')
    })
    
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