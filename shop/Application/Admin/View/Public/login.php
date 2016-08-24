<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="keywords" content="{$Config.sitekeywords}" />
	<meta name="description" content="{$Config.siteinfo}" />
	<title><if condition="isset($SEO['title']) && !empty($SEO['title']) ">{$SEO['title']}</if>{$SEO['site_title']}</title>

	<link href="/public/admin/css/login.css" rel="stylesheet" type="text/css">
	<link href="/public/admin/css/font-awesome.min.css" rel="stylesheet">
	<script src="/public/common/js/jquery.js" type="text/javascript"></script>
	<script src="/public/common/js/common.js" type="text/javascript"></script>
	<script src="/public/common/js/jquery.validation.min.js"></script>
	<script src="/public/common/js/jquery.supersized.min.js" ></script>
	<script src="/public/common/js/jquery.progressBar.js" type="text/javascript"></script>

</head>
<body>
<div class="login-layout">
	<div class="top">
		<h5><em></em></h5>
		<h2>系统管理中心</h2>
		<h6>商城  |  资讯  |  企业站  |  微商城  </h6>
	</div>
	<form method="post" id="form_login" action="{:U('Public/tologin')}">
		<input type="hidden" name="form_submit" value="ok" />
		<div class="lock-holder">
			<div class="form-group pull-left input-username">
				<label>帐号</label>
				<input name="username" id="user_name" autocomplete="off" type="text" class="input-text" value="" required>
			</div>
			<i class="fa fa-ellipsis-h dot-left"></i> <i class="fa fa-ellipsis-h dot-right"></i>
			<div class="form-group pull-right input-password-box">
				<label>密码</label>
				<input name="password" id="password" class="input-text" autocomplete="off" type="password" required pattern="[\S]{6}[\S]*" title="">
			</div>
		</div>
		<div class="avatar"><img src="/public/admin/images/login/admin.png" alt=""></div>
		<div class="submit"> <span>
      <div class="code">
		  <div class="arrow"></div>
		  <div class="code-img"><img src="{$code}" name="codeimage" id="codeimage" border="0"/></div>
		  <a href="JavaScript:void(0);" id="hide" class="close" title=""><i></i></a><a href="JavaScript:void(0);" onclick="javascript:document.getElementById('codeimage').src='{$code}&refresh=1&time=' + Math.random();" class="change" title=""><i></i></a> </div>
      <input name="code" type="text" required class="input-code" id="captcha" placeholder="请输入验证码" pattern="[A-z0-9]{4}" title="<?php echo $lang['login_index_checkcode_pattern'];?>" autocomplete="off" value="" >
      </span> <span>
      <input name="nchash" type="hidden" value="" />
      <input name="" class="input-button btn-submit" type="button" value="登录">
      </span> </div>
		<div class="submit2"></div>
	</form>
	<div class="bottom">
		<h6>Copyright 2006-2015</h6>
		<h6>Powered by lp</h6>
	</div>
</div>
<script>
	$(function(){
		$.supersized({

			// 功能
			slide_interval     : 4000,
			transition         : 1,
			transition_speed   : 1000,
			performance        : 1,

			// 大小和位置
			min_width          : 0,
			min_height         : 0,
			vertical_center    : 1,
			horizontal_center  : 1,
			fit_always         : 0,
			fit_portrait       : 1,
			fit_landscape      : 0,

			// 组件
			slide_links        : 'blank',
			slides             : [
				{image : '/public/admin/images/login/1.jpg'},
				{image : '/public/admin/images/login/2.jpg'},
				{image : '/public/admin/images/login/3.jpg'},
				{image : '/public/admin/images/login/4.jpg'},
				{image : '/public/admin/images/login/5.jpg'}
			]

		});
		//显示隐藏验证码
		$("#hide").click(function(){
			$(".code").fadeOut("slow");
		});
		$("#captcha").focus(function(){
			$(".code").fadeIn("fast");
		});
		//跳出框架在主窗口登录
		if(top.location!=this.location)	top.location=this.location;
		$('#user_name').focus();
		if ($.browser.msie && ($.browser.version=="6.0" || $.browser.version=="7.0")){
			window.location.href='http://www.baidu.com';
		}
		$("#captcha").nc_placeholder();
		//动画登录
		$('.btn-submit').click(function(e){
			$('.input-username,dot-left').addClass('animated fadeOutRight')
			$('.input-password-box,dot-right').addClass('animated fadeOutLeft')
			$('.btn-submit').addClass('animated fadeOutUp')
			setTimeout(function () {
						$('.avatar').addClass('avatar-top');
						$('.submit').hide();
						$('.submit2').html('<div class="progress"><div class="progress-bar progress-bar-success" aria-valuetransitiongoal="100"></div></div>');
						$('.progress .progress-bar').progressbar({
							done : function() {$('#form_login').submit();}
						});
					},
					300);

		});

		// 回车提交表单
		$('#form_login').keydown(function(event){
			if (event.keyCode == 13) {
				$('.btn-submit').click();
			}
		});
	});

</script>
</body>
</html>