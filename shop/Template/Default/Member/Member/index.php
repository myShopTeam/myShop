<template file="Site/head.php" />
<template file="Site/top.php" />
<template file="Site/naviga.php"/>

<link href="{$site_info.site_path}css/member.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{$site_info.site_path}js/member.js"></script>
<script type="text/javascript" src="{$site_info.site_path}js/ToolTip.js"></script>
<script>
    //sidebar-menu
    $(document).ready(function () {
        $.each($(".side-menu > a"), function () {
            $(this).click(function () {
                var ulNode = $(this).next("ul");
//                if (ulNode.css('display') == 'block') {
//                    $.cookie(COOKIE_PRE + 'Mmenu_' + $(this).attr('key'), 1);
//                } else {
//                    $.cookie(COOKIE_PRE + 'Mmenu_' + $(this).attr('key'), null);
//                }
                ulNode.slideToggle();
                if ($(this).hasClass('shrink')) {
                    $(this).removeClass('shrink');
                } else {
                    $(this).addClass('shrink');
                }
            });
        });
        $.each($(".side-menu-quick > a"), function () {
            $(this).click(function () {
                var ulNode = $(this).next("ul");
                ulNode.slideToggle();
                if ($(this).hasClass('shrink')) {
                    $(this).removeClass('shrink');
                } else {
                    $(this).addClass('shrink');
                }
            });
        });
    });

</script>

<div class="ncm-container">
    <div class="ncm-header">
        <div class="ncm-header-top">
            <div class="ncm-member-info">
                <div class="avatar">
                    <a href="{:U('Member/Member/modifyAvatar')}" title="修改头像">
                        <if condition="$member_info['avatar'] eq ''">
                            <img src="{$site_info.default_avatar}">
                            <else/>
                            <img src="{$member_info.avatar}">
                        </if>
                        <div class="frame"></div>
                    </a>
                </div>
                <dl>
                    <dt><a href="{:U('Member/Member/Member')}" title="修改资料">{$member_info.nickname}</a></dt>

<!--                    <dd>会员等级：-->
<!--                        <div class="nc-grade-mini" style="cursor:pointer;"-->
<!--                             onclick="javascript:go('');">-->
<!--                            V0会员-->
<!--                        </div>-->
<!--                    </dd>-->
                    <dd>上次登录：{$member_info.last_time|date='Y年m月d日',###}</dd>
<!--                    <dd>账户安全：-->
<!--                        <div class="SAM"><a-->
<!--                                href="http://shop.local.com/member/index.php?act=member_security&op=index"-->
<!--                                title="安全设置">-->
<!--                                <div id="low" class="SAM-info"><span><em></em></span><strong>低</strong></div>-->
<!--                            </a></div>-->
<!--                    </dd>-->
<!--                    <dd>用户财产：-->
<!--                        <div class="user-account">-->
<!--                            <ul>-->
<!--                                <li id="pre-deposit"><a-->
<!--                                        href="http://shop.local.com/member/index.php?act=predeposit&op=pd_log_list"-->
<!--                                        title="我的余额：￥0.00"> <span class="icon"></span> </a></li>-->
<!--                                <li id="points"><a-->
<!--                                        href="http://shop.local.com/member/index.php?act=member_points&op=index"-->
<!--                                        title="我的积分：290分"> <span class="icon"></span></a></li>-->
<!--                                <li id="voucher"><a-->
<!--                                        href="http://shop.local.com/member/index.php?act=member_voucher&op=index"-->
<!--                                        title="我的代金券：0张"> <span class="icon"></span></a></li>-->
<!--                                <li id="envelope"><a-->
<!--                                        href="http://shop.local.com/member/index.php?act=member_redpacket&op=index"-->
<!--                                        title="我的红包：0张"> <span class="icon"></span></a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </dd>-->
                </dl>
            </div>
            <div class="ncm-trade-menu">
                <div class="line-bg"></div>
                <dl class="trade-step-01">
                    <dt>关注中</dt>
                    <dd></dd>
                </dl>
                <ul class="trade-function-01">
                    <li><a href="{:U('Member/Member/favoriteGoods')}">
                            <span class="tf01"></span>
                            <h5>商品</h5>
                        </a>
                    </li>
<!--                    <li><a href="http://shop.local.com/shop/index.php?act=member_favorite_store&op=index">-->
<!--                            <span class="tf02"></span>-->
<!--                            <h5>店铺</h5>-->
<!--                        </a>-->
<!--                    </li>-->
                    <li><a href="{:U('Member/Member/goodsBrowse')}">
                            <span class="tf03"></span>
                            <h5>足迹</h5>
                        </a>
                    </li>
                </ul>
                <dl class="trade-step-02">
                    <dt>交易进行</dt>
                    <dd></dd>
                </dl>
                <ul class="trade-function-02">
                    <li>
                        <a href="{:U('Member/Order/index', array('status_type' => 0))}">
                            <sup>1</sup>
                            <span class="tf04"></span>
                            <h5>待付款</h5>
                        </a></li>
                    <li>
                        <a href="{:U('Member/Order/index', array('status_type' => 3))}">
                            <span class="tf05"></span>
                            <h5>待收货</h5>
                        </a></li>
<!--                    <li>-->
<!--                        <a href="{:U('Member/Order/index', array('order_type' => 0))}">-->
<!--                            <span class="tf06"></span>-->
<!--                            <h5>待自提</h5>-->
<!--                        </a>-->
<!--                    </li>-->
                    <li>
                        <a href="{:U('Member/Order/index', array('status_type' => 8))}">
                            <span class="tf07"></span>
                            <h5>待评价</h5>
                        </a>
                    </li>
                </ul>
                <dl class="trade-step-03">
                    <dt>售后服务</dt>
                    <dd></dd>
                </dl>
                <ul class="trade-function-03">
                    <li>
                        <a href="{:U('Member/Order/refund')}">
                            <span class="tf08"></span>
                            <h5>退款</h5>
                        </a>
                    </li>
                    <li>
                        <a href="{:U('Member/Order/returnGoods')}">
                            <span class="tf09"></span>
                            <h5>退货</h5>
                        </a>
                    </li>
                    <li>
                        <a href="{:U('Member/Order/complaint')}">
                            <span class="tf10"></span>
                            <h5>投诉</h5>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ncm-header-nav">
            <ul class="nav-menu">
                <li><a href="{:U('Member/Member/index')}" class="current">我的商城</a></li>
<!--                <li class="set"><a href="{:U('Member/Member/member')}">用户设置<i></i></a>-->

                    <div class="sub-menu">
                        <dl>
                            <dt><a href="{:U('Member/Member/modifyPwd')}" style="color: #3AAC8A;">安全设置</a></dt>
                            <dd>
                                <a href="{:U('Member/Member/modifyPwd')}">修改登录密码</a>
                            </dd>
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=member_security&op=auth&type=modify_mobile">手机绑定</a>-->
<!--                            </dd>-->
                            <dd>
                                <a href="{:U('Member/Member/modifyEmail')}">邮件绑定</a>
                            </dd>
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=member_security&op=auth&type=modify_paypwd">支付密码</a>-->
<!--                            </dd>-->
                        </dl>
                        <dl>
                            <dt>
                                <a href="{:U('Member/Member/member')}" style="color: #EA746B">个人资料</a>
                            </dt>
                            <dd>
                                <a href="{:U('Member/Member/address')}"">收货地址</a>
                            </dd>
                            <dd>
                                <a href="{:U('Member/Member/modifyAvatar')}">修改头像</a>
                            </dd>
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=member_message&op=setting">消息接受设置</a>-->
<!--                            </dd>-->
                        </dl>
<!--                        <dl>-->
<!--                            <dt>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=predeposit&op=pd_log_list" style="color: #FF7F00">账户财产</a>-->
<!--                            </dt>-->
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=predeposit&op=recharge_add">余额充值</a>-->
<!--                            </dd>-->
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=member_voucher&op=voucher_binding">领取代金券</a>-->
<!--                            </dd>-->
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=member_redpacket&op=rp_binding">领取红包</a>-->
<!--                            </dd>-->
<!--                        </dl>-->
<!--                        <dl>-->
<!--                            <dt><a href="http://shop.local.com/member/index.php?act=member_bind&op=qqbind"-->
<!--                                   style="color: #398EE8">账号绑定</a></dt>-->
<!--                            <dd><a href="http://shop.local.com/member/index.php?act=member_bind&op=qqbind">QQ绑定</a>-->
<!--                            </dd>-->
<!--                            <dd><a href="http://shop.local.com/member/index.php?act=member_bind&op=sinabind">微博绑定</a>-->
<!--                            </dd>-->
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=member_bind&op=weixinbind">微信绑定</a>-->
<!--                            </dd>-->
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/member/index.php?act=member_sharemanage&op=index">分享绑定</a>-->
<!--                            </dd>-->
<!--                        </dl>-->
                    </div>
                </li>
<!--                <li><a href="http://shop.local.com/shop/index.php?act=member_snshome&op=index">个人主页<i></i></a>-->
<!---->
<!--                    <div class="sub-menu">-->
<!--                        <dl>-->
<!--                            <dd><a href="http://shop.local.com/shop/index.php?act=member_snshome&op=index">新鲜事</a>-->
<!--                            </dd>-->
<!--                            <dd><a href="http://shop.local.com/shop/index.php?act=sns_album&op=index">个人相册</a></dd>-->
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/shop/index.php?act=member_snshome&op=shareglist">分享商品</a>-->
<!--                            </dd>-->
<!--                            <dd>-->
<!--                                <a href="http://shop.local.com/shop/index.php?act=member_snshome&op=storelist">分享店铺</a>-->
<!--                            </dd>-->
<!--                        </dl>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="###">其他应用<i></i></a>-->
<!--                    <div class="sub-menu">-->
<!--                        <dl>-->
<!--                            <dd><a href="http://shop.local.com/cms/index.php?act=member_article&op=article_list">我的CMS</a>-->
<!--                            </dd>-->
<!--                            <dd><a href="http://shop.local.com/circle/index.php?act=p_center&op=index">我的圈子</a></dd>-->
<!--                            <dd><a href="http://shop.local.com/microshop/index.php?act=home&op=index&member_id=2">我的微商城</a>-->
<!--                            </dd>-->
<!--                        </dl>-->
<!--                    </div>-->
<!--                </li>-->
            </ul>
            <div class="notice">
                <ul class="line">
                </ul>
            </div>
            <script>
                $(function () {
                    var _wrap = $('ul.line');
                    var _interval = 2000;
                    var _moving;
                    _wrap.hover(function () {
                            clearInterval(_moving);
                        },
                        function () {
                            _moving = setInterval(function () {
                                    var _field = _wrap.find('li:first');
                                    var _h = _field.height();
                                    _field.animate({
                                            marginTop: -_h + 'px'
                                        },
                                        600,
                                        function () {
                                            _field.css('marginTop', 0).appendTo(_wrap);
                                        })
                                },
                                _interval)
                        }).trigger('mouseleave');
                });
            </script>
        </div>
    </div>
    <div class="left-layout">
        <!-- 左侧菜单 -->
        <template file="Member/Member/common/home_left.php"/>
    </div>
    <div class="right-layout">
        <!-- 右侧内容 -->
        <in name="right" value="home"><template file="Member/Member/common/home_right.php"/></in>
        <in name="right" value="collect_right"><template file="Member/Member/common/collect_right.php"/></in>
        <in name="right" value="browse_right"><template file="Member/Member/common/browse_right.php"/></in>
        <in name="right" value="member_right"><template file="Member/Member/common/member_right.php"/></in>
        <in name="right" value="avatar_right"><template file="Member/Member/common/avatar_right.php"/></in>
        <in name="right" value="address_right"><template file="Member/Member/common/address_right.php"/></in>

        <in name="right" value="order_list"><template file="Member/Order/common/order_right.php"/></in>
        <in name="right" value="order_detail"><template file="Member/Order/common/order_detail.php"/></in>
        <in name="right" value="order_refund"><template file="Member/Order/common/order_refund.php"/></in>
        <in name="right" value="goods_comment"><template file="Member/Order/common/goods_comment.php"/></in>
        <in name="right" value="comment_list"><template file="Member/Order/common/comment_list.php"/></in>
        <in name="right" value="complaint"><template file="Member/Order/common/complaint.php"/></in>
        <in name="right" value="order_refund_apply"><template file="Member/Order/common/order_refund_apply.php"/></in>
    </div>
    <div class="clear"></div>
</div>
<script language="javascript">
    function fade() {
        $("img[rel='lazy']").each(function () {
            var $scroTop = $(this).offset();
            if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {
                $(this).hide();
                $(this).attr("src", $(this).attr("shop-url"));
                $(this).removeAttr("rel");
                $(this).removeAttr("name");
                $(this).fadeIn(500);
            }
        });
    }

    if ($("img[rel='lazy']").length > 0) {
        $(window).scroll(function () {
            fade();
        });
    }
    ;
    fade();
</script>

<script type="text/javascript" src="{$site_info.common_path}js/jquery.charCount.js" charset="utf-8"></script>
<script type="text/javascript" src="{$site_info.common_path}js/jquery.smilies.js" charset="utf-8"></script>

<template file="Site/script/cart_script.php" />
<template file="Site/footer.php" />
</body>
</html>