<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div id="ncToolbar" class="nc-appbar">
    <div class="nc-appbar-tabs" id="appBarTabs">
        <div class="ever">
            <div class="cart">
                <a href="javascript:void(0);" id="rtoolbar_cart">
                    <span class="icon"></span>
                    <span class="name">购物车</span>
                    <i id="rtoobar_cart_count" class="new_msg" <if condition="$cart_num eq 0">style="display:none;"</if>>{$cart_num}</i>
                </a>
            </div>
            <!--            <div class="compare"><a href="javascript:void(0);" id="compare"><span class="icon"></span><span class="tit">商品对比</span></a>-->
            <!--            </div>-->
            <div class="chat">
                <a href="javascript:void(0);" id="chat_show_user">
                    <span class="icon"></span>
                    <i id="new_msg" class="new_msg" style="display:none;"></i>
                    <span class="tit">在线联系</span>
                </a>
            </div>
        </div>
        <div class="variation">
            <div class="middle">
                <if condition="$member_info['is_login'] eq 1">
                    <div class="user" nctype="a-barUserInfo">
                        <a href="javascript:void(0);">
                            <div class="avatar">
                                <if condition="$member_info['avatar'] eq ''">
                                    <img src="{$site_info.default_avatar}">
                                <else/>
                                    <img src="{$member_info.avatar}">
                                </if>
                            </div>
                            <span class="tit">我的账户</span>
                        </a></div>
                    <div class="user-info" nctype="barUserInfo" style="display:none;"><i class="arrow"></i>

                        <div class="avatar">
                            <div class="frame">
                                <if condition="$member_info['avatar'] eq ''">
                                    <img src="{$site_info.default_avatar}">
                                <else/>
                                    <img src="{$member_info.avatar}">
                                </if>
                            </div>
                        </div>
                        <dl>
                            <dt>Hi, {$member_info.nickname}</dt>
<!--                            <dd>当前等级：<strong nctype="barMemberGrade"></strong></dd>-->
<!--                            <dd>当前经验值：<strong nctype="barMemberExp"></strong></dd>-->
                        </dl>
                    </div>
                    <else/>
                    <div class="user" nctype="a-barLoginBox">
                        <a href="javascript:void(0);">
                            <div class="avatar">
                                <img src="{$site_info.default_avatar}">
                            </div>
                            <span class="tit">会员登录</span>
                        </a>
                    </div>
                    <div class="user-login-box" nctype="barLoginBox" style="display:none;"><i class="arrow"></i>
                        <a href="javascript:void(0);" class="close-a" nctype="close-barLoginBox" title="关闭">X</a>

                        <form id="login_form" method="post" action="{:U('Passport/tologin')}">
                            <dl>
                                <dt><strong>登录名</strong></dt>
                                <dd>
                                    <input type="text" class="text" name="username">
                                    <label></label>
                                </dd>
                            </dl>
                            <dl>
                                <dt><strong>登录密码</strong><a href="" target="_blank">忘记登录密码？</a></dt>
                                <dd>
                                    <input type="password" class="text" name="password">
                                    <label></label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>
                                    <strong>验证码</strong>
                                    <a href="javascript:void(0)" class="ml5" onclick="javascript:document.getElementById('codeimage').src='{$site_info.domain}/index.php?g=Api&m=Checkcode&a=index&code_len=4&font_size=20&width=90&height=26&font_color=&background=&refresh=1&time=' + Math.random();">更换验证码</a>
                                </dt>
                                <dd>
                                    <input type="text" name="code" autocomplete="off" class="text w130" id="captcha" maxlength="4" size="10">
                                    <img src="" name="codeimage" border="0" id="codeimage" class="vt">
                                    <label></label>
                                </dd>
                            </dl>
                            <div class="bottom">
                                <input type="submit" class="submit" value="确认">
                                <a href="{:U('Passport/register')}" target="_blank">注册新用户</a>
                            </div>
                        </form>
                    </div>
                <div class="prech">&nbsp;</div>

                </if>
            </div>
            <!--            <div class="l_qrcode"><a href="javascript:void(0);" class=""><span class="icon"></span>-->
            <!--                    <code><img src=""></code></a></div>-->
            <div class="gotop"><a href="javascript:void(0);" id="gotop"><span class="icon"></span><span
                        class="tit">返回顶部</span></a></div>
        </div>
        <div class="content-box" id="content-compare">
            <div class="top">
                <h3>商品对比</h3>
                <a href="javascript:void(0);" class="close" title="隐藏"></a></div>
            <div id="comparelist"></div>
        </div>
        <div class="content-box" id="content-cart">
            <div class="top">
                <h3>我的购物车</h3>
                <a href="javascript:void(0);" class="close" title="隐藏"></a>
            </div>
            <div id="rtoolbar_cartlist"></div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //登录开关状态
    $(function () {
        $(".l_qrcode a").hover(function () {
                $(this).addClass("hover");
            },
            function () {
                $(this).removeClass("hover");
            });

    });
    //返回顶部
    backTop = function (btnId) {
        var btn = document.getElementById(btnId);
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        window.onscroll = set;
        btn.onclick = function () {
            btn.style.opacity = "0.5";
            window.onscroll = null;
            this.timer = setInterval(function () {
                scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                scrollTop -= Math.ceil(scrollTop * 0.1);
                if (scrollTop == 0) clearInterval(btn.timer, window.onscroll = set);
                if (document.documentElement.scrollTop > 0) document.documentElement.scrollTop = scrollTop;
                if (document.body.scrollTop > 0) document.body.scrollTop = scrollTop;
            }, 10);
        };
        function set() {
            scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            btn.style.opacity = scrollTop ? '1' : "0.5";
        }
    };
    backTop('gotop');

    //动画显示边条内容区域
    $(function () {
        replace_code();
        ncToolbar();
        $(window).resize(function () {
            ncToolbar();
        });
        function ncToolbar() {
            if ($(window).width() >= 1240) {
                $('#appBarTabs >.variation').show();
            } else {
                $('#appBarTabs >.variation').hide();
            }
        }

        $('#appBarTabs').hover(
            function () {
                $('#appBarTabs >.variation').show();
            },
            function () {
                ncToolbar();
            }
        );
        $("#compare").click(function () {
            if ($("#content-compare").css('right') == '-210px') {
                loadCompare(false);
                $('#content-cart').animate({'right': '-210px'});
                $("#content-compare").animate({right: '35px'});
            } else {
                $(".close").click();
                $(".chat-list").css("display", 'none');
            }
        });
        $("#rtoolbar_cart").click(function () {
            if ($("#content-cart").css('right') == '-210px') {
                $('#content-compare').animate({'right': '-210px'});
                $("#content-cart").animate({right: '35px'});
//                if (!$("#rtoolbar_cartlist").html()) {
                    //加载右侧购物车数据
                    load_cart_information();
//                }
            } else {
                $(".close").click();
                $(".chat-list").css("display", 'none');
            }
        });
        $(".close").click(function () {
            $(".content-box").animate({right: '-210px'});
        });

        $(".quick-menu dl").hover(function () {
                $(this).addClass("hover");
            },
            function () {
                $(this).removeClass("hover");
            });
        $(".links_a").hover(function () {
                $(this).addClass("hover");
            },
            function () {
                $(this).removeClass("hover");
            });

        // 右侧bar用户信息
        $('div[nctype="a-barUserInfo"]').click(function () {
            $('div[nctype="barUserInfo"]').toggle();
        });
        // 右侧bar登录
        $('div[nctype="a-barLoginBox"]').click(function () {
            $('#login_form')[0].reset();
            $('div[nctype="barLoginBox"]').toggle();

        });
        $('a[nctype="close-barLoginBox"]').click(function () {
            $('div[nctype="barLoginBox"]').toggle();
        });
        //登录
        $('#login_form').submit(function () {
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.post(url,data, function (res) {
                if(res.status == 'success'){
                    showDialog(res.msg, 'succ', '提示信息', null, true, null, '', '', '', 1);
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    },1200);
                } else {
                    replace_code();
                    showDialog(res.msg, 'alert', '错误信息', null, true, null, '', '', '', 3);
                }
            },'json')
            return false;
        })
    });
    function replace_code(){
        $('#codeimage').attr('src', "{$site_info.domain}/index.php?g=Api&m=Checkcode&a=index&code_len=4&font_size=20&width=90&height=26&font_color=&background=&refresh=1&time=" + Math.random());
    }
</script>
<div class="public-top-layout w">
    <div class="topbar wrapper">
        <div class="user-entry">
            <if condition="$member_info['is_login'] eq 1">
                您好 <span> <a href="{:U('Member/Member/index')}">{$member_info.nickname}</a></span> ，欢迎来到
                <a href="/" title="首页" alt="首页">
                    <span>{$Config.sitename}</span>
                </a><span>[<a href="{:U('Site/Passport/logout')}">退出</a>] </span>
            <else/>
                您好，欢迎来到 <a href="/" title="首页" alt="首页">{$Config.sitename}</a>
                <span>[<a href="{:U('Passport/login')}">登录</a>]</span>
                <span>[<a href="{:U('Passport/register')}">注册</a>]</span>
            </if>

        </div>
        <div class="quick-menu">
            <dl>
                <dt>
                    <em class="ico_order"></em>
                    <a href="">我的订单</a>
                    <i></i>
                </dt>
                <dd>
                    <ul>
                        <li><a href="">待付款订单</a></li>
                        <li><a href="">待确认收货</a></li>
                        <li><a href="">待评价交易</a></li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>
                    <em class="ico_store"></em>
                    <a href="">我的收藏</a>
                    <i></i>
                </dt>
                <dd>
                    <ul>
                        <li>
                            <a href="">商品收藏</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>
                    <em class="ico_service"></em>客户服务
                    <i></i>
                </dt>
                <dd>
                    <ul>
                        <li><a href="">帮助中心</a></li>
                        <li><a href="">售后服务</a></li>
                        <li><a href="">客服中心</a></li>
                    </ul>
                </dd>
            </dl>
<!--            <dl class="weixin">-->
<!--                <dt>关注我们<i></i></dt>-->
<!--                <dd>-->
<!--                    <h4>扫描二维码<br/>关注商城微信号</h4>-->
<!--                    <img src=""></dd>-->
<!--            </dl>-->
        </div>
    </div>
</div>