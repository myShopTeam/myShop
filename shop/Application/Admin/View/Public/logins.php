<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<style>
@charset "utf-8";
/* CSS Document */

/*================基本样式重置================*/
html,body,div,ul,ol,li,dl,dt,dd,h1,h2,h3,h4,h5,h6,p,img,span,i,a,em,strong,b,input,textarea { margin:0; padding:0; }
html, body{ height:100%;}
body { font-family:"微软雅黑"; font-size:12px; color:#555;background:#FFF;}
li { list-style:none; }
a,img,input { border:0 none; }
a { text-decoration:none; outline:none; }
a:hover { text-decoration:none; }
a:focus,input:focus { outline:0 none;}
textarea { resize:none; font-size:12px;} /*去掉火狐和谷歌浏览器的Textarea改变尺寸大小功能*/
i,em{ font-style:normal;}

/*================定义通用样式================*/
.w{ width:1180px;}
.mcenter{ width:1180px; margin:0 auto;}
.icon { background:url(images/icon_bg.png) no-repeat;}
.hide { display:none;}
.clear { clear:both; }
.fl { float:left; }
.fr { float:right; }
.clearfix:after { content:" "; display:block; clear:both; height:0; }
.clearfix { zoom:1;}
a img.opacity { filter:alpha(opacity=100); opacity:1; -moz-opacity:1; } 
a:hover img.opacity { filter:alpha(opacity=80); opacity:0.8; -moz-opacity:0.8; }
.mt5{ margin-top:5px;}
.mt10{ margin-top:10px;}
.mt15{ margin-top:15px;}
.mt25{ margin-top:25px;}
.mt35{ margin-top:35px;}

.ml30{ margin-left:30px;}
.ml5{ margin-left:5px;}
.ml49{margin-left:49px;}

.bt{border-top:solid 1px #e6e6e6}

/*================login 页面样式================*/
.loginBody{position:relative;width:100%;height:578px;background:url(statics/images/admin/login/login_bg.jpg) repeat-x;}
.lo_content{position:relative;width:1000px;height:578px;margin:0 auto;}
.lo_content .lo_top{position:static;width:1000px;height:212px;background:url(statics/images/admin/login/login_top_bg.jpg) no-repeat;}
.lo_content .lo_con{position:static;width:1000px;height:306px;margin-left: 30%;}
.lo_content .lo_con .lo_c_left{position:static;float:left;width:414px;height:306px;background:url(statics/images/admin/login/qc_logo.png) 108px 70px no-repeat;margin-left:90px;}
.lo_content .lo_con .lo_c_line{position:static;float:left;width:2px;height:306px;background:url(statics/images/admin/login/login_line.jpg) center top no-repeat;}
.lo_content .lo_con .lo_c_right{position:static;float:left;width:454px;height:306px;margin-left:40px;}
.lo_content .lo_con .lo_c_right .lo_c_r_top{position:static;width:434px;height:28px;padding:8px 0 0 42px;background:url(images/login_tb_dl.png) left top no-repeat;font-size:18px; font-weight:700px;color:#333;line-height:36px;}
.lo_content .lo_con .lo_c_right .lo_c_r_cen{position:static;width:424px;height:128px;margin-top:20px;}
.lo_content .lo_con .lo_c_right .lo_c_r_cen td{font-size:14px;color:#4490b4;height:30px;line-height:30px;}
.lo_content .lo_con .lo_c_right .lo_c_r_cen td input{font-size:14px;border:solid 1px #85b5dd;width:150px;height:20px;line-height:20px;border-radius:4px;padding-left:4px;}
.lo_content .lo_con .lo_c_right .lo_c_r_cen td .c_r_keyCode{width:75px;}
.lo_content .lo_con .lo_c_right .lo_c_r_cen td .c_r_btn{background:#bcd9e9;color:#000;font-size:12px;cursor:pointer;width:62px;border-radius:2px;padding-left:0px;}
.lo_content .lo_bottom{position:static;width:1000px;height:60px;text-align:center;font-size:12px;color:#333;font-family:"微软雅黑";line-height:60px;}
.lo_content .lo_bottom a{font-size:12px;color:#333;text-decoration:underline;}
</style>
</head>

<body>
<div class="loginBody">
	<div class="lo_content">
    	<div class="lo_top"></div>
        <div class="lo_con">
<!--        	<div class="lo_c_left"></div>-->
<!--            <div class="lo_c_line"></div>-->
            <div class="lo_c_right">
            	<div class="lo_c_r_top">用 户 登 录</div>
                <div class="lo_c_r_cen">
                <form  id="loginform" method="post" name="loginform" action="{:U('Public/tologin')}"  >
                	<table width="424" border="0" cellspacing="0" cellpadding="0">
  						<tr>
    						<td width="61">用户名：</td>
    						<td colspan="2" align="left"><input type="text" id="username" name="username" value="" tabindex="1"/></td>
    						<td width="37">&nbsp;</td>
  						</tr>
  						<tr>
    						<td>密&nbsp;&nbsp;&nbsp;&nbsp;码：</td>
    						<td colspan="2"><input type="password" id="password" name="password" value="" tabindex="2"/></td>
    						<td>&nbsp;</td>
  						</tr>
  						<tr>
    						<td>验证码：</td>
    						<td width="165"><input  id="verifycode" name="code" maxlength=5 tabindex="3" class="input_txt" type="text" value="" onfocus="$('#verifycodehint').hide();" onblur="if($('#verifycode').val()=='')$('#verifycodehint').show();" placeholder="请输入验证码" tabindex="3" /></td>
    						<td width="161"><span id="captcha"></span></td>
    						<td>&nbsp;</td>
  						</tr>
  						<tr>
    						<td>&nbsp;</td>
    						<td><input type="submit" class="c_r_btn" value="确 定"/>&nbsp;
   						    <input type="reset" class="c_r_btn" value="重 置" onclick="clearText()"/></td>
    						<td>&nbsp;</td>
    						<td>&nbsp;</td>
  						</tr>
					</table>
                    </form>
                </div>
            </div>
        </div>
<!--        <div class="lo_bottom">Copyright @ 2008 - 2013 启创聚核 QCCMS8 All Right Reserved.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--        	版权所有：<a href="http://www.lovegq1314.com"  target="_Blank">湖北启创聚核科技有限公司</a>-->
<!--        </div>-->
    </div>
</div>
<script type="text/javascript">
window.onload=function(){
 document.getElementById('captcha').innerHTML='<img alt="点击刷新验证码" src="/cms/Common/Checkcode/captcha.php" style="cursor:pointer" onclick="this.src=this.src+\'?\'" />';
}
</script>
<script type="text/javascript">
function clearText(){
	var username=document.getElementById("username");
	var password=document.getElementById("password");
	var keyCode=document.getElementById("keyCode");
	username.value=password.value=keyCode.value="";
}
</script>

<script>
//刷新广告
function refreshs(){
	document.getElementById('code_img').src='{:U('Api/Checkcode/index','code_len=4&font_size=18&width=110&height=40&font_color=&background=&refresh=1')}&time='+Math.random();void(0);
}
$(function(){
	$('#verifycode').focus(function(){
		$('a.change_img').trigger("click");
	});
});
</script>
</body>
</html>
