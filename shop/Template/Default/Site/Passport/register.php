<template file="Site/head.php"/>
<body>
<link href="/public/site/css/home_header.css" rel="stylesheet" type="text/css">
<link href="/public/site/css/home_login.css" rel="stylesheet" type="text/css">
<script src="/public/site/js/taglibs.js"></script>
<script src="/public/site/js/tabulous.js"></script>

<div class="header-wrap">

    <header class="public-head-layout wrapper">

        <h1 class="site-logo"><a href="/"><img src="/public/site/images/logo.png" class="pngFix"></a></h1>

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

                            <form id="register_form" method="post" class="nc-login-form" action="http://localhost:8009/member/index.php?act=login&op=usersave">

                                <dl>

                                    <dt>用户名：</dt>

                                    <dd>

                                        <input type="text" id="user_name" name="user_name" class="text" tipMsg="请使用3-15个中、英文、数字及“-”符号"/>

                                    </dd>

                                </dl>

                                <dl>

                                    <dt>设置密码：</dt>

                                    <dd>

                                        <input type="password" id="password" name="password" class="text" tipMsg="6-20个大小写英文字母、符号或数字"/>

                                    </dd>

                                </dl>

                                <dl>

                                    <dt>确认密码：</dt>

                                    <dd>

                                        <input type="password" id="password_confirm" name="password_confirm" class="text" tipMsg="请再次输入密码"/>

                                    </dd>

                                </dl>

                                <dl class="mt15">

                                    <dt>邮箱：</dt>

                                    <dd>

                                        <input type="text" id="email" name="email" class="text" tipMsg="输入常用邮箱作为验证及找回密码使用"/>

                                    </dd>

                                </dl>

                                <div class="code-div mt15">

                                    <dl>

                                        <dt>验证码：</dt>

                                        <dd>

                                            <input type="text" id="captcha" name="captcha" class="text w80" size="10" tipMsg="输入验证码"/>

                                        </dd>

                                    </dl>

                                    <span><img src="other/index.php?act=seccode&op=makecode&type=50,120&nchash=932bc2cf" name="codeimage" id="codeimage"/> <a class="makecode" href="javascript:void(0)" onclick="javascript:document.getElementById('codeimage').src='other/index.php?act=seccode&op=makecode&type=50,120&nchash=932bc2cf&t=' + Math.random();">看不清，换一张</a></span>
                                </div>

                                <dl class="clause-div">

                                    <dd>

                                        <input name="agree" type="checkbox" class="checkbox" id="clause" value="1" checked="checked"/>

                                        阅读并同意<a href="http://localhost:8009/shop/index.php?act=document&op=index&code=agreement" target="_blank" class="agreement" title="阅读并同意">《服务协议》</a></dd>

                                </dl>

                                <div class="submit-div">

                                    <input type="submit" id="Submit" value="立即注册" class="submit"/>

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


//注册表单验证

        $("#register_form").validate({

            errorPlacement: function (error, element) {

                var error_td = element.parent('dd');

                error_td.append(error);

                element.parents('dl:first').addClass('error');

            },

            success: function (label) {

                label.parents('dl:first').removeClass('error').find('label').remove();

            },

            submitHandler: function (form) {

                ajaxpost('register_form', '', '', 'onerror');

            },

            onkeyup: false,

            rules: {

                user_name: {

                    required: true,

                    lettersmin: true,

                    lettersmax: true,

                    letters_name: true,

                    remote: {

                        url: 'index.php?act=login&op=check_member&column=ok',

                        type: 'get',

                        data: {

                            user_name: function () {

                                return $('#user_name').val();

                            }

                        }

                    }

                },

                password: {

                    required: true,

                    minlength: 6,

                    maxlength: 20

                },

                password_confirm: {

                    required: true,

                    equalTo: '#password'

                },

                email: {

                    required: true,

                    email: true,

                    remote: {

                        url: 'index.php?act=login&op=check_email',

                        type: 'get',

                        data: {

                            email: function () {

                                return $('#email').val();

                            }

                        }

                    }

                },

                captcha: {

                    required: true,

                    remote: {

                        url: 'index.php?act=seccode&op=check&nchash=932bc2cf',

                        type: 'get',

                        data: {

                            captcha: function () {

                                return $('#captcha').val();

                            }

                        },

                        complete: function (data) {

                            if (data.responseText == 'false') {

                                document.getElementById('codeimage').src = 'other/index.php?act=seccode&op=makecode&type=50,120&nchash=932bc2cf&t=' + Math.random();

                            }

                        }

                    }

                },

                agree: {

                    required: true

                }

            },

            messages: {

                user_name: {

                    required: '<i class="icon-exclamation-sign"></i>用户名不能为空',

                    lettersmin: '<i class="icon-exclamation-sign"></i>用户名必须在3-15个字符之间',

                    lettersmax: '<i class="icon-exclamation-sign"></i>用户名必须在3-15个字符之间',

                    letters_name: '<i class="icon-exclamation-sign"></i>可包含“_”、“-”，不能是纯数字',

                    remote: '<i class="icon-exclamation-sign"></i>该用户名已经存在'

                },

                password: {

                    required: '<i class="icon-exclamation-sign"></i>密码不能为空',

                    minlength: '<i class="icon-exclamation-sign"></i>密码长度应在6-20个字符之间',

                    maxlength: '<i class="icon-exclamation-sign"></i>密码长度应在6-20个字符之间'

                },

                password_confirm: {

                    required: '<i class="icon-exclamation-sign"></i>请再次输入密码',

                    equalTo: '<i class="icon-exclamation-sign"></i>两次输入的密码不一致'

                },

                email: {

                    required: '<i class="icon-exclamation-sign"></i>电子邮箱不能为空',

                    email: '<i class="icon-exclamation-sign"></i>这不是一个有效的电子邮箱',

                    remote: '<i class="icon-exclamation-sign"></i>该电子邮箱已经存在'

                },

                captcha: {

                    required: '<i class="icon-remove-circle" title="请输入验证码"></i>',

                    remote: '<i class="icon-remove-circle" title="验证码不正确"></i>'

                },

                agree: {

                    required: '<i class="icon-exclamation-sign"></i>请勾选服务协议'

                }

            }

        });

    });

</script>
<template file="Site/footer.php"/>
</body>
</html>