<template file="Site/head.php"/><template file="Site/top.php"/><script>    var delCartUrl    = "{:U('Cart/Cart/delCart')}";    var changeCartUrl = "{:U('Cart/Cart/change')}";</script><link href="{$site_info.site_path}css/home_cart.css" rel="stylesheet" type="text/css"><script type="text/javascript" src="{$site_info.site_path}js/goods_cart.js"></script><body><header class="ncc-head-layout">    <div class="site-logo"><a href="/"><img src="{$site_info.site_path}images/logo.png" class="pngFix"></a></div>    <ul class="ncc-flow">        <li class="current"><i class="step1"></i>            <p>我的购物车</p>            <sub></sub>            <div class="hr"></div>        </li>        <li class=""><i class="step2"></i>            <p>确认订单</p>            <sub></sub>            <div class="hr"></div>        </li>        <li class=""><i class="step3"></i>            <p>支付提交</p>            <sub></sub>            <div class="hr"></div>        </li>        <li class=""><i class="step4"></i>            <p>订单完成</p>            <sub></sub>            <div class="hr"></div>        </li>    </ul></header><div class="ncc-wrapper">    <!-- 购物车是否存在商品 -->    <if condition="$checkCart eq 1">        <div class="ncc-main">            <div class="ncc-title">                <h3>我的购物车</h3>                <h5>查看购物车商品清单，增加减少商品数量，并勾选想要的商品进入下一步操作。</h5>            </div>            <form action="{:U('Order/Order/index')}" method="POST" id="form_buy" name="form_buy">                <input type="hidden" value="1" name="ifcart">                <input type="hidden" value="" name="ifchain" id="ifchain">                <table class="ncc-table-style" nc_type="table_cart">                    <thead>                    <tr>                        <th class="w50">                            <label><input type="checkbox" checked="" value="1" id="selectAll">全选</label>                        </th>                        <th></th>                        <th>商品</th>                        <th class="w150">单价(元)</th>                        <th class="w100">数量</th>                        <th class="w150">小计(元)</th>                        <th class="w80 tl">操作</th>                    </tr>                    </thead>                    <tbody>                    <!-- S one store list -->                    <volist name="carts" id="vo">                        <tr id="cart_item_{$vo.cart_id}" nc_group="{$vo.cart_id}" class="shop-list ">                            <td class="td-border-left ">                                <input type="checkbox" checked="" nc_type="eachGoodsCheckBox" value="9|1" data_chain="0" data_store_id="1" id="cart_id{$vo.cart_id}" name="cart_id[]" class="checkbox mt10">                            </td>                            <td class="w100">                                <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}" target="_blank" class="ncc-goods-thumb">                                    <img src="{$vo.goods_thumb}" alt="{$vo.goods_name}">                                </a>                            </td>                            <td class="tl">                                <dl class="ncc-goods-info">                                    <dt>                                        <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}" target="_blank">{$vo.goods_name}</a>                                    </dt>                                    <dd class="goods-spec"></dd>                                </dl>                            </td>                            <td>                                <em id="item{$vo.cart_id}_price" class="goods-price">                                    {$vo.price}                                </em>                            </td>                            <td class="ws0">                                <a href="JavaScript:void(0);" onclick="decrease_quantity({$vo.cart_id});" title="减少商品件数" class="add-substract-key tip">-</a>                                <input id="input_item_{$vo.cart_id}" bl_id="0" value="{$vo.goods_num}" orig="1" changed="1" onkeyup="change_quantity({$vo.cart_id}, this);" type="text" class="text tc w20">                                <a href="JavaScript:void(0);" onclick="add_quantity({$vo.cart_id});" title="增加商品件数" class="add-substract-key tip">+</a>                            </td>                            <td>                                <em id="item{$vo.cart_id}_subtotal" nc_type="eachGoodsTotal" class="goods-subtotal">{$vo.goods_subtotal|cur}</em>                            </td>                            <td class="tl td-border-right">                                <a href="javascript:void(0)" onclick="collect_goods({$vo.goods_id});">移入收藏夹</a><br>                                <a href="javascript:void(0)" onclick="drop_cart_item({$vo.cart_id});">删除</a>                            </td>                        </tr>                        <!-- S bundling goods list -->                        <!-- E bundling goods list -->                        <!-- E one store list -->                        <tr>                            <td colspan="20"></td>                        </tr>                    </volist>                    </tbody>                    <tfoot>                    <tr>                        <td colspan="20">                            <div class="ncc-all-account">商品总价（不含运费）                                <em id="cartTotal">{$total|cur}</em>元                            </div>                            <a id="next_submit" href="javascript:void(0)" class="ncc-next-submit ok">确认订单</a>                        </td>                    </tr>                    </tfoot>                </table>            </form>            <!-- 猜你喜欢 -->            <div id="guesslike_div"></div>        </div>    <else/>        <div class="ncc-null-shopping"><i class="ico"></i>            <h4>您的购物车还没有商品</h4>            <p>                <a href="{:U('Site/Goods/products')}" class="ncbtn mr10"><i class="icon-reply-all"></i>马上去购物</a>                <a href="index.php?act=member_order" class="ncbtn"><i class="icon-file-text"></i>查看自己的订单</a>            </p>        </div>    </if></div><script language="javascript">    function fade() {        $("img[rel='lazy']").each(function () {            var $scroTop = $(this).offset();            if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {                $(this).hide();                $(this).attr("src", $(this).attr("shopwwi-url"));                $(this).removeAttr("rel");                $(this).removeAttr("name");                $(this).fadeIn(500);            }        });    }    if ($("img[rel='lazy']").length > 0) {        $(window).scroll(function () {            fade();        });    }    ;    fade();</script><div style="clear: both;"></div><div id="web_chat_dialog" style="display: none;float:right;"></div><a id="chat_login" href="javascript:void(0)" style="display: none;"></a><script type="text/javascript" src="{$site_info.common_path}js/jquery.poshytip.min.js" charset="utf-8"></script><script type="text/javascript" src="{$site_info.common_path}js/jquery.smilies.js" charset="utf-8"></script><script type="text/javascript" src="{$site_info.common_path}js/jquery.cookie.js"></script><link href="{$site_info.site_path}css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"><script type="text/javascript" src="{$site_info.site_path}js/perfect-scrollbar.min.js"></script><script type="text/javascript" src="{$site_info.common_path}js/jquery.qtip.min.js"></script><link href="{$site_info.common_path}css/jquery.qtip.min.css" rel="stylesheet" type="text/css"><script>    $(function () {        // Membership card        $('[nctype="mcard"]').membershipCard({type: 'shop'});    });</script><script>    //提示信息    $('.tip').poshytip({        className: 'tip-yellowsimple',        showOn: 'hover',        alignTo: 'target',        alignX: 'center',        alignY: 'top',        offsetX: 0,        offsetY: 5,        allowTipHover: false    });</script><template file="Site/footer_simple.php"/></body></html>