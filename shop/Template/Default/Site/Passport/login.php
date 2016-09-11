<template file="Site/head.php"/>
<body>
<div class="header-wrap">

    <header class="public-head-layout wrapper">

        <h1 class="site-logo"><a href="/"><img src="/public/site/images/logo.png" class="pngFix"></a></h1>

        <div class="nc-regist-now">

            <span class="avatar"><img src="images/default_user_portrait.gif"></span>

            <span>您好，欢迎来到网站演示<br/>已注册的会员请登录，或立即<a title="" href="{:U('Passport/register')}" class="register">注册新会员</a></span></div>

    </header>

</div>

<!-- PublicHeadLayout End -->

<div id="append_parent"></div>

<div id="ajaxwaitid"></div>

<div class="nc-login-layout">

    <div class="left-pic"><img src="images/1.jpg" border="0"></div>

    <div class="nc-login">

        <div class="arrow"></div>

        <div class="nc-login-mode">

            <ul class="tabs-nav">

                <li><a href="#default">用户登录<i></i></a></li>

            </ul>

            <div id="tabs_container" class="tabs-container">

                <div id="default" class="tabs-content">

                    <form id="login_form" class="nc-login-form" method="post" action="http://localhost:8009/member/index.php?act=login&op=login">

                        <input type='hidden' name='formhash' value='O6OKx6xCx77x6k3Cny7-Wt6RWy6xGfA'/>
                        <input type="hidden" name="form_submit" value="ok"/>

                        <input name="nchash" type="hidden" value="cfcd7b0f"/>

                        <dl>

                            <dt>账&nbsp;&nbsp;&nbsp;号：</dt>

                            <dd>

                                <input type="text" class="text" autocomplete="off" name="user_name" tipMsg="可使用已注册的用户名或手机号登录" id="user_name">

                            </dd>

                        </dl>

                        <dl>

                            <dt>密&nbsp;&nbsp;&nbsp;码：</dt>

                            <dd>

                                <input type="password" class="text" name="password" autocomplete="off" tipMsg="6-20个大小写英文字母、符号或数字" id="password">

                            </dd>

                        </dl>

                        <div class="code-div mt15">

                            <dl>

                                <dt>验证码：</dt>

                                <dd>

                                    <input type="text" name="captcha" autocomplete="off" class="text w100" tipMsg="输入验证码" id="captcha" size="10"/>

                                </dd>

                            </dl>

                            <span><img src="other/index.php?act=seccode&op=makecode&type=50,120&nchash=cfcd7b0f" name="codeimage" id="codeimage">
                                <a class="makecode" href="javascript:void(0)" onclick="javascript:document.getElementById('codeimage').src='other/index.php?act=seccode&op=makecode&type=50,120&nchash=cfcd7b0f&t=' + Math.random();">看不清，换一张</a></span>
                        </div>

                        <div class="handle-div">

                            <span class="auto"><input type="checkbox" class="checkbox" name="auto_login" value="1">七天自动登录<em style="display: none;">请勿在公用电脑上使用</em></span>

                            <a class="forget" href="http://localhost:8009/member/index.php?act=login&op=forget_password">忘记密码？</a>
                        </div>

                        <div class="submit-div">

                            <input type="submit" class="submit" value="登&nbsp;&nbsp;&nbsp;录">

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

        var div_form = '#default';

        $(".nc-login-mode .tabs-nav li a").click(function () {

            if ($(this).attr("href") !== div_form) {

                div_form = $(this).attr('href');

                $("" + div_form).find(".makecode").trigger("click");

            }

        });


        $("#login_form").validate({

            errorPlacement: function (error, element) {

                var error_td = element.parent('dd');

                error_td.append(error);

                element.parents('dl:first').addClass('error');

            },

            success: function (label) {

                label.parents('dl:first').removeClass('error').find('label').remove();

            },

            submitHandler: function (form) {

                ajaxpost('login_form', '', '', 'onerror');

            },

            onkeyup: false,

            rules: {

                user_name: "required",

                password: "required"

                , captcha: {

                    required: true,

                    remote: {

                        url: 'index.php?act=seccode&op=check&nchash=cfcd7b0f',

                        type: 'get',

                        data: {

                            captcha: function () {

                                return $('#captcha').val();

                            }

                        },

                        complete: function (data) {

                            if (data.responseText == 'false') {

                                document.getElementById('codeimage').src = 'other/index.php?act=seccode&op=makecode&type=50,120&nchash=cfcd7b0f&t=' + Math.random();

                            }

                        }

                    }

                }

            },

            messages: {

                user_name: "<i class='icon-exclamation-sign'></i>请输入已注册的用户名或手机号",

                password: "<i class='icon-exclamation-sign'></i>密码不能为空"

                , captcha: {

                    required: '<i class="icon-remove-circle" title="验证码不能为空"></i>',

                    remote: '<i class="icon-remove-circle" title="验证码不能为空"></i>'

                }

            }

        });


        // 勾选自动登录显示隐藏文字

        $('input[name="auto_login"]').click(function () {

            if ($(this).attr('checked')) {

                $(this).attr('checked', true).next().show();

            } else {

                $(this).attr('checked', false).next().hide();

            }

        });

    });

</script>
<template file="Site/footer.php"/>
</body>
</html>