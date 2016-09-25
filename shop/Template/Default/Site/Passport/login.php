<template file="Site/head.php"/>
<link rel="stylesheet" href="{$site_info.site_path}css/home_login.css">
<script src="{$site_info.site_path}js/taglibs.js"></script>
<script src="{$site_info.site_path}js/tabulous.js"></script>

<body>
<div class="header-wrap">

    <header class="public-head-layout wrapper">

        <h1 class="site-logo"><a href="/"><img src="{$site_info.site_path}images/logo.png" class="pngFix"></a></h1>

        <div class="nc-regist-now">

            <span class="avatar"><img src="{$site_info.site_path}images/default_user_portrait.gif"></span>

            <span>您好，欢迎来到网站演示<br/>已注册的会员请登录，或立即<a title="" href="{:U('Passport/register')}" class="register">注册新会员</a></span></div>

    </header>

</div>

<!-- PublicHeadLayout End -->

<div id="append_parent"></div>

<div id="ajaxwaitid"></div>

<div class="nc-login-layout">

    <div class="left-pic"><img src="{$site_info.site_path}images/1.jpg" border="0"></div>

    <div class="nc-login">

        <div class="arrow"></div>

        <div class="nc-login-mode">

            <ul class="tabs-nav">

                <li><a href="#default">用户登录<i></i></a></li>

            </ul>

            <div id="tabs_container" class="tabs-container">

                <div id="default" class="tabs-content">

                    <form id="login_form" class="nc-login-form" method="post" action="{:U('Passport/tologin')}">

                        <dl>

                            <dt>账&nbsp;&nbsp;&nbsp;号：</dt>

                            <dd>

                                <input type="text" class="text" autocomplete="off" name="username" placeholder="使用已注册的用户名登录">

                            </dd>

                        </dl>

                        <dl>

                            <dt>密&nbsp;&nbsp;&nbsp;码：</dt>

                            <dd>

                                <input type="password" class="text" name="password" autocomplete="off" placeholder="6-20个大小写英文字母、符号或数字">

                            </dd>

                        </dl>

                        <div class="code-div mt15">

                            <dl>

                                <dt>验证码：</dt>

                                <dd>

                                    <input type="text" name="code" autocomplete="off" class="text w100" placeholder="输入验证码" size="10"/>

                                </dd>

                            </dl>

                            <span><img src="{$code}" name="codeimage" id="codeimage">
                                <a class="makecode" href="javascript:void(0)" onclick="javascript:document.getElementById('codeimage').src='{$code}&refresh=1&time=' + Math.random();">看不清，换一张</a></span>
                        </div>

                        <div class="handle-div">

<!--                            <span class="auto"><input type="checkbox" class="checkbox" name="auto_login" value="1">七天自动登录<em style="display: none;">请勿在公用电脑上使用</em></span>-->

<!--                            <a class="forget" href="http://localhost:8009/member/index.php?act=login&op=forget_password">忘记密码？</a>-->
                        </div>

                        <div class="submit-div">

                            <input type="button" class="submit" value="登&nbsp;&nbsp;&nbsp;录">

                            <input type="hidden" value="" name="ref_url">

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="nc-login-api" id="demo-form-site">

        </div>

    </div>

    <div class="clear"></div>

</div>

<script>

    $(function () {
        //初始化Input的灰色提示信息

        $('input[tipMsg]').inputTipText({pwd: 'password'});

        //登录方式切换

        $('.nc-login-mode').tabulous({

            effect: 'flip'//动画反转效果

        });
        $('.submit').click(function () {
            var data = {};
            var username = $('input[name=username]').val();
            var password = $('input[name=password]').val();
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
                data.password = password;
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
                url: "{:U('Passport/tologin')}",
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