<template file="Site/head.php"/>
<body>
<link href="{$site_info.site_path}css/home_header.css" rel="stylesheet" type="text/css">
<link href="{$site_info.site_path}css/home_login.css" rel="stylesheet" type="text/css">
<script src="{$site_info.site_path}js/taglibs.js"></script>
<script src="{$site_info.site_path}js/tabulous.js"></script>

<div class="header-wrap">

    <header class="public-head-layout wrapper">

        <h1 class="site-logo"><a href="/"><img src="{:F('logoimg')}" class="pngFix"></a></h1>

        <div class="nc-login-now">我已经注册，现在就<a href="{:U('Passport/login')}" title="" class="register">登录</a></span></div>

    </header>

</div>

<!-- PublicHeadLayout End -->

<div id="append_parent"></div>

<div id="ajaxwaitid"></div>


<div class="nc-register-bg">

    <div class="nc-register-box">

        <div class="nc-register-layout">

            <div class="left">

                <div class="nc-register-mode">

                    <ul class="tabs-nav">

                        <li><a href="#default">账号注册<i></i></a></li>

                    </ul>

                    <div id="tabs_container" class="tabs-container">

                        <div id="default" class="tabs-content">

                            <form id="register_form" method="post" class="nc-login-form" action="{:U('Passport/toregister')}">

                                <dl>

                                    <dt>用户名：</dt>

                                    <dd>

                                        <input type="text" id="user_name" name="username" class="text" placeholder="请使用3-15个中、英文、数字及“-”符号"/>

                                    </dd>

                                </dl>

                                <dl>

                                    <dt>设置密码：</dt>

                                    <dd>

                                        <input type="password" id="password" name="password" class="text" placeholder="6-20个大小写英文字母、符号或数字"/>

                                    </dd>

                                </dl>

                                <dl>

                                    <dt>确认密码：</dt>

                                    <dd>

                                        <input type="password" id="password_confirm" name="password_confirm" class="text" placeholder="请再次输入密码"/>

                                    </dd>

                                </dl>

                                <dl class="mt15">

                                    <dt>邮箱：</dt>

                                    <dd>

                                        <input type="text" id="email" name="email" class="text" placeholder="输入常用邮箱作为验证及找回密码使用"/>

                                    </dd>

                                </dl>

                                <div class="code-div mt15">

                                    <dl>

                                        <dt>验证码：</dt>

                                        <dd>

                                            <input type="text" id="captcha" name="code" class="text w80" size="10" placeholder="输入验证码"/>

                                        </dd>

                                    </dl>

                                    <span>
                                <img src="{$code}" name="codeimage" id="codeimage">
                                <a class="makecode" href="javascript:void(0)" onclick="javascript:document.getElementById('codeimage').src='{$code}&refresh=1&time=' + Math.random();">看不清，换一张</a>
                            </span>
                                </div>

                                <dl class="clause-div">

                                    <dd>

                                        <input name="agree" type="checkbox" class="checkbox" id="clause" value="1" checked="checked"/>

                                        阅读并同意<a href="#" target="_blank" class="agreement" title="阅读并同意">《服务协议》</a></dd>

                                </dl>

                                <div class="submit-div">

                                    <input type="button" id="Submit" value="立即注册" class="submit"/>

                                </div>

                                <input type="hidden" value="" name="ref_url">

                                <input name="nchash" type="hidden" value="932bc2cf"/>

                                <input type="hidden" name="form_submit" value="ok"/>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <div class="right">

                <div class="reister-after">

                    <h4>注册之后您可以</h4>

                    <ol>

                        <li class="ico01"><i></i>购买商品支付订单</li>

                        <li class="ico02"><i></i>收藏商品关注店铺</li>

                        <li class="ico03"><i></i>安全交易诚信无忧</li>

                        <li class="ico04"><i></i>积分获取优惠购物</li>

                        <li class="ico05"><i></i>会员等级享受特权</li>

                        <li class="ico06"><i></i>评价晒单站外分享</li>

                    </ol>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    $(function () {

        //初始化Input的灰色提示信息

        $('input[tipMsg]').inputTipText({pwd: 'password,password_confirm'});

        //注册方式切换

        $('.nc-register-mode').tabulous({

            //动画缩放渐变效果effect: 'scale'

            effect: 'slideLeft'//动画左侧滑入效果

            //动画下方滑入效果 effect: 'scaleUp'

            //动画反转效果 effect: 'flip'

        });

        var div_form = '#default';

        $(".nc-register-mode .tabs-nav li a").click(function () {

            if ($(this).attr("href") !== div_form) {

                div_form = $(this).attr('href');

                $("" + div_form).find(".makecode").trigger("click");

            }

        });

        $('.submit').click(function () {
            var data = {};
            var username = $('input[name=username]').val();
            var password = $('input[name=password]').val();
            var password_confirm = $('input[name=password_confirm]').val();
            var email    = $('input[name=email]').val();
            var agree    = $('input[name=agree]:checked').val();
            var code     = $('input[name=code]').val();

            if($.trim(username) == ''){
                showDialog('请输入用户名', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            } else {
                data.username = username;
            }
            if($.trim(password) == ''){
                showDialog('请输入密码', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            } else {
                if(password.length < 6){
                    showDialog('请输入6位以上的密码', 'alert', '错误信息', null, true, null, '', '', '', 3);
                    return;
                }
                data.password = password;
            }
            if($.trim(password) != $.trim(password_confirm)){
                showDialog('2次密码输入不一样', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            } else {
                data.password_confirm = password_confirm;
            }
            if($.trim(email) == ''){
                showDialog('请输入邮箱', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            } else {
                data.email = email;
            }
            if($.trim(agree) == ''){
                showDialog('请勾选服务协议', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            } else {
                data.agree = agree;
            }
            if($.trim(code) == ''){
                showDialog('请输入验证码', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            }
            if(($.trim(code)).length != 4){
                showDialog('请输入正确的验证码', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            } else {
                data.code = code;
            }
            data.back = "{$redirect_url}";
            $.ajax({
                type: "post",
                data: data,
                url: "{:U('Passport/toregister')}",
                dataType: "json",
                success: function (res) {
                    if(res.status == 'success'){
                        showDialog(res.msg, 'succ', '提示信息', null, true, null, '', '', '', 1);
                        setTimeout(function () {
                            window.location.href = res.data.back;
                        },1200);
                    } else {

                        showDialog(res.msg, 'alert', '错误信息', null, true, null, '', '', '', 3);
                        return;
                    }
                }
            })
        })

    });

</script>
<template file="Site/footer.php"/>
</body>
</html>