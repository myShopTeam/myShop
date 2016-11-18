<template file="Site/head.php"/><template file="Site/top.php"/><template file="Site/naviga.php"/><body><link href="{$site_info.site_path}css/home_goods.css" rel="stylesheet" type="text/css"><script type="text/javascript" src="{$site_info.site_path}js/mz-packed.js" charset="utf-8"></script><div class="wrapper pr">    <input type="hidden" id="lockcompare" value="unlock"/>    <div class="ncs-detail ownshop">        <!-- 焦点图 -->        <div id="ncs-goods-picture" class="ncs-goods-picture">            <div class="gallery_wrap">                <div class="gallery">                    <img title="鼠标滚轮向上或向下滚动，能放大或缩小图片哦~" src="{$goods_thumb}" class="cloudzoom" data-cloudzoom="zoomImage: '{$goods_thumb}'">                </div>            </div>            <div class="controller_wrap">                <div class="controller">                    <ul>                        <li>                            <img title="鼠标滚轮向上或向下滚动，能放大或缩小图片哦~" src="{$goods_thumb}" data-cloudzoom="useZoom: '.cloudzoom', image: '{$goods_thumb}', zoomImage: '{$goods_thumb}' " width="60" height="60" class="cloudzoom-gallery">                        </li>                        <if condition="$goods_img[0] neq ''">                            <volist name="goods_img" id="vo">                                <li>                                    <img title="鼠标滚轮向上或向下滚动，能放大或缩小图片哦~" src="{$vo}" data-cloudzoom="useZoom: '.cloudzoom', image: '{$vo}', zoomImage: '{$vo}' " width="60" height="60" class="cloudzoom-gallery">                                </li>                            </volist>                        </if>                    </ul>                </div>            </div>        </div>        <!-- //焦点图 -->        <!-- S 商品基本信息 -->        <div class="ncs-goods-summary">            <div class="name">                <h1>{$goods_name}</h1><!--                <strong>　</strong>-->            </div>            <div class="ncs-meta">                <!-- S 商品参考价格 -->                <dl>                    <dt>市&nbsp;&nbsp;场&nbsp;&nbsp;价：</dt>                    <dd class="cost-price"><strong>&yen;{$market_price|cur}</strong></dd>                </dl>                <!-- E 商品参考价格 -->                <!-- S 商品发布价格 -->                <dl>                    <dt>商&nbsp;&nbsp;城&nbsp;&nbsp;价：</dt>                    <dd class="price">                        <strong>&yen;{$goods_price|cur}</strong>                    </dd>                </dl>                <dl class="rate">                    <dt>商品评分：</dt>                    <!-- S 描述相符评分 -->                    <dd>                        <span class="raty" data-score="5" title="很满意" style="width: 100px;">                            <for start="0" end="$score">                                <img src="{$site_info.common_path}js/jquery.raty/img/star-on.png" alt="1" title="很满意">&nbsp;                            </for>                            <input type="hidden" name="score" value="{$score}" readonly="readonly"></span>                        <a href="#ncGoodsRate">共有{$comment_num}条评价</a>                    </dd>                    <!-- E 描述相符评分 -->                </dl><!--                <div class="ncs-goods-code">--><!----><!--                    <p><img src="{$site_info.site_path}images/default_qrcode.png" title="用商城手机客户端扫描二维码直达商品详情内容"></p>--><!----><!--                    <span class="ncs-goods-code-note"><i></i>客户端扫购有惊喜</span>--><!--                </div>-->            </div>            <!-- E 商品发布价格 -->            <!-- S 促销 -->            <!-- E 促销 --><!--            <div class="ncs-logistics"><!-- S 物流与运费新布局展示 --><!--                <dl id="ncs-freight" class="ncs-freight">--><!----><!--                    <dt>配&nbsp;&nbsp;送&nbsp;&nbsp;至：</dt>--><!----><!--                    <dd class="ncs-freight_box">--><!----><!--                        <div id="ncs-freight-selector" class="ncs-freight-select">--><!----><!--                            <div class="text">--><!----><!--                                <div>请选择地区</div>--><!----><!--                                <b>∨</b></div>--><!----><!--                            <div class="content">--><!----><!--                                <div id="ncs-stock" class="ncs-stock" data-widget="tabs">--><!----><!--                                    <div class="mt">--><!----><!--                                        <ul class="tab">--><!----><!--                                            <li data-index="0" data-widget="tab-item" class="curr"><a href="#none"--><!--                                                                                                      class="hover"><em>请选择</em><i>--><!--                                                        ∨</i></a></li>--><!----><!--                                        </ul>--><!----><!--                                    </div>--><!----><!--                                    <div id="stock_province_item" data-widget="tab-content" data-area="0">--><!----><!--                                        <ul class="area-list">--><!----><!--                                        </ul>--><!----><!--                                    </div>--><!----><!--                                    <div id="stock_city_item" data-widget="tab-content" data-area="1"--><!--                                         style="display: none;">--><!----><!--                                        <ul class="area-list">--><!----><!--                                        </ul>--><!----><!--                                    </div>--><!----><!--                                    <div id="stock_area_item" data-widget="tab-content" data-area="2"--><!--                                         style="display: none;">--><!----><!--                                        <ul class="area-list">--><!----><!--                                        </ul>--><!----><!--                                    </div>--><!----><!--                                </div>--><!----><!--                            </div>--><!----><!--                            <a href="javascript:;" class="close"--><!--                               onclick="$('#ncs-freight-selector').removeClass('hover')">关闭</a></div>--><!----><!--                        <div id="ncs-freight-prompt"><strong>有货</strong>--><!----><!--                            免运费--><!--                        </div>--><!----><!--                    </dd>--><!----><!--                </dl>-->                <!-- S 物流与运费新布局展示  -->                <!-- S 门店自提 -->                <!-- E 门店自提 --><!--            </div>-->            <div class="ncs-key">                <!-- S 商品规格值-->                <!-- E 商品规格值-->            </div>            <!-- S 购买数量及库存 -->            <div class="ncs-buy">                <div class="ncs-figure-input">                    <input type="text" name="" id="quantity" value="1" size="3" maxlength="6" class="input-text">                    <a href="javascript:void(0)" class="increase" nctype="increase">&nbsp;</a> <a                        href="javascript:void(0)" class="decrease" nctype="decrease">&nbsp;</a></div>                <div class="ncs-point" style="display: none;"><i></i>                    <!-- S 库存 -->                    <span>您选择的商品库存<strong nctype="goods_stock">{$goods_total|default='0'}</strong>件</span>                    <!-- E 库存 -->                </div>                <!-- S 提示已选规格及库存不足无法购买 -->                <!-- E 提示已选规格及库存不足无法购买 -->                <!-- S 购买按钮 -->                <div class="ncs-btn">                    <!-- 加入购物车-->                    <a href="javascript:void(0);" nctype="addcart_submit" class="addcart " title="加入购物车"><i                            class="icon-shopping-cart"></i>加入购物车</a>                    <!-- 立即购买--><!--                    <a href="javascript:void(0);" nctype="buynow_submit" class="buynow " title="立即购买">立即购买</a>-->                    <!-- S 加入购物车弹出提示框 -->                    <div class="ncs-cart-popup">                        <dl>                            <dt>成功添加到购物车<a title="关闭" onClick="$('.ncs-cart-popup').css({'display':'none'});">X</a></dt>                            <dd>购物车共有 <strong id="bold_num"></strong> 种商品 总金额为：<em id="bold_mly" class="saleP"></em>                            </dd>                            <dd class="btns"><a href="javascript:void(0);" class="ncbtn-mini ncbtn-mint"                                                onClick="location.href='http://shopwwi.local.com/shop/index.php?act=cart'">查看购物车</a>                                <a href="javascript:void(0);" class="ncbtn-mini" value=""                                   onClick="$('.ncs-cart-popup').css({'display':'none'});">继续购物</a></dd>                        </dl>                    </div>                    <!-- E 加入购物车弹出提示框 -->                </div>                <!-- E 购买按钮 -->            </div>            <!-- E 购买数量及库存 -->            <!-- S消费者保障服务 -->            <!-- E消费者保障服务 -->            <!--E 商品信息 -->        </div>        <!-- E 商品图片及收藏分享 -->        <div class="ncs-handle">            <!-- S 分享 --><!--            <a href="javascript:void(0);" class="share" nc_type="sharegoods" data-param='{"gid":"100009"}'><i></i>分享--><!--                <span>(<em nc_type="sharecount_100009">0</em>)</span>--><!--            </a>-->            <!-- S 收藏 -->            <a href="javascript:collect_goods('100009','count','goods_collect');" class="favorite"><i></i>收藏商品                <span>(<em nctype="goods_collect">0</em>)</span>            </a>            <!-- S 对比 --><!--            <a href="javascript:void(0);" class="compare" nc_type="compare_100009" data-param='{"gid":"100009"}'><i></i>加入对比</a>-->            <!-- S 举报 --><!--            <a href="javascript:login_dialog();" title="举&nbsp;报" class="inform"><i></i>举&nbsp;报</a>-->            <!-- End --> </div>    </div>    <!-- E 优惠套装 -->    <div id="content" class="ncs-goods-layout expanded">        <div class="ncs-goods-main" id="main-nav-holder">            <div class="tabbar pngFix" id="main-nav">                <div class="ncs-goods-title-nav">                    <ul id="categorymenu">                        <li class="current"><a id="tabGoodsIntro" href="#content">商品详情</a></li>                        <li><a id="tabGoodsRate" href="#content">商品评价<em>(0)</em></a></li><!--                        <li><a id="tabGoodsTraded" href="#content">销售记录<em>(1)</em></a></li>--><!----><!--                        <li><a id="tabGuestbook" href="#content">购买咨询</a></li>-->                    </ul>                    <div class="switch-bar"><a href="javascript:void(0)" id="fold">&nbsp;</a></div>                </div>            </div>            <div class="ncs-intro">                <div class="content bd" id="ncGoodsIntro">                    {$content}                </div>            </div>            <div class="ncs-comment">                <div class="ncs-goods-title-bar hd">                    <h4><a href="javascript:void(0);">商品评价</a></h4>                </div>                <div class="ncs-goods-info-content bd" id="ncGoodsRate">                    <div class="top">                        <div class="rate">                            <p><strong>100</strong><sub>%</sub>好评</p>                            <span>共有0人参与评分</span></div>                        <div class="percent">                            <dl>                                <dt>好评<em>(100%)</em></dt>                                <dd><i style="width: 100%"></i></dd>                            </dl>                            <dl>                                <dt>中评<em>(0%)</em></dt>                                <dd><i style="width: 0%"></i></dd>                            </dl>                            <dl>                                <dt>差评<em>(0%)</em></dt>                                <dd><i style="width: 0%"></i></dd>                            </dl>                        </div>                        <div class="btns"><span>您可对已购商品进行评价</span>                            <p>                                <a href="{:U('Member/Order/commentList')}" class="ncbtn ncbtn-grapefruit" target="_blank">                                    <i class="icon-comment-alt"></i>评价商品                                </a>                            </p>                        </div>                    </div>                    <div class="ncs-goods-title-nav">                        <ul id="comment_tab">                            <li data-type="all" class="current"><a href="javascript:void(0);">商品评价(0)</a></li>                            <li data-type="1"><a href="javascript:void(0);">好评(0)</a></li>                            <li data-type="2"><a href="javascript:void(0);">中评(0)</a></li>                            <li data-type="3"><a href="javascript:void(0);">差评(0)</a></li>                        </ul>                    </div>                    <!-- 商品评价内容部分 -->                    <div id="goodseval" class="ncs-commend-main"></div>                </div>            </div>        </div>        <div class="ncs-sidebar">            <script type="text/javascript">                $(document).ready(function () {                    //热销排行切换                    $('#hot_sales_tab').on('mouseenter', function () {                        $(this).addClass('current');                        $('#hot_collect_tab').removeClass('current');                        $('#hot_sales_list').removeClass('hide');                        $('#hot_collect_list').addClass('hide');                    });                    $('#hot_collect_tab').on('mouseenter', function () {                        $(this).addClass('current');                        $('#hot_sales_tab').removeClass('current');                        $('#hot_sales_list').addClass('hide');                        $('#hot_collect_list').removeClass('hide');                    });                });                /** left.php **/                // 商品分类                function class_list(obj) {                    var stc_id = $(obj).attr('span_id');                    var span_class = $(obj).attr('class');                    if (span_class == 'ico-block') {                        $("#stc_" + stc_id).show();                        $(obj).html('<em>-</em>');                        $(obj).attr('class', 'ico-none');                    } else {                        $("#stc_" + stc_id).hide();                        $(obj).html('<em>+</em>');                        $(obj).attr('class', 'ico-block');                    }                }            </script>            <!-- 最近浏览 -->            <div class="ncs-sidebar-container ncs-top-bar">                <div class="title">                    <h4>最近浏览</h4>                </div>                <div class="content">                    <div id="hot_sales_list" class="ncs-top-panel">                        <ol>                            <if condition="$browses neq ''">                                <volist name="browses" id="vo">                                    <li>                                        <dl>                                            <dt>                                                <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}">{$vo.goods_name}</a>                                            </dt>                                            <dd class="goods-pic">                                                <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}">                                                    <span class="thumb size60"><i></i>                                                        <img src="{$vo.goods_thumb}" onload="javascript:DrawImage(this,60,60);" width="41" height="60">                                                    </span>                                                </a>                                                <p>                                                    <span class="thumb size100">                                                        <i></i>                                                        <img src="{$vo.goods_thumb}" onload="javascript:DrawImage(this,100,100);" title="test" height="100" width="69"><big></big><small></small>                                                    </span>                                                </p>                                            </dd>                                            <dd class="price pngFix">{$vo.goods_price|cur}</dd>                                        </dl>                                    </li>                                </volist>                            </if>                        </ol>                    </div>                    <p>                        <a href="{:U('Member/Member/goodsBrowse')}" class="nch-sidebar-all-viewed">全部浏览历史</a>                    </p>                </div>            </div>        </div>    </div></div><form id="buynow_form" method="post" action="http://shopwwi.local.com/shop/index.php">    <input id="act" name="act" type="hidden" value="buy"/>    <input id="op" name="op" type="hidden" value="buy_step1"/>    <input id="cart_id" name="cart_id[]" type="hidden"/></form><script src="{$site_info.common_path}js/jquery.ajaxContent.pack.js" type="text/javascript"></script><script src="{$site_info.site_path}js/sns.js" type="text/javascript" charset="utf-8"></script><script src="{$site_info.common_path}js/jquery.F_slider.js" type="text/javascript" charset="utf-8"></script><script type="text/javascript" src="{$site_info.site_path}js/waypoints.js"></script><script type="text/javascript" src="{$site_info.common_path}js/jquery.raty.min.js"></script><script type="text/javascript" src="{$site_info.site_path}js/custom.min.js" charset="utf-8"></script><link href="{$site_info.site_path}css/nyroModal.css" rel="stylesheet" type="text/css" id="cssfile2"/><script type="text/javascript">    $(document).ready(function () {        //热销排行切换        $('#hot_sales_tab').on('mouseenter', function () {            $(this).addClass('current');            $('#hot_collect_tab').removeClass('current');            $('#hot_sales_list').removeClass('hide');            $('#hot_collect_list').addClass('hide');        });        $('#hot_collect_tab').on('mouseenter', function () {            $(this).addClass('current');            $('#hot_sales_tab').removeClass('current');            $('#hot_sales_list').addClass('hide');            $('#hot_collect_list').removeClass('hide');        });    });    /** left.php **/    // 商品分类    function class_list(obj) {        var stc_id = $(obj).attr('span_id');        var span_class = $(obj).attr('class');        if (span_class == 'ico-block') {            $("#stc_" + stc_id).show();            $(obj).html('<em>-</em>');            $(obj).attr('class', 'ico-none');        } else {            $("#stc_" + stc_id).hide();            $(obj).html('<em>+</em>');            $(obj).attr('class', 'ico-block');        }    }</script><script type="text/javascript">    /** 辅助浏览 **/        //产品图片    jQuery(function ($) {        // 放大镜效果 产品图片        CloudZoom.quickStart();        // 图片切换效果        $(".controller li").first().addClass('current');        $('.controller').find('li').mouseover(function () {            $(this).first().addClass("current").siblings().removeClass("current");        });    });    //收藏分享处下拉操作    jQuery.divselect = function (divselectid, inputselectid) {        var inputselect = $(inputselectid);        $(divselectid).mouseover(function () {            var ul = $(divselectid + " ul");            ul.slideDown("fast");            if (ul.css("display") == "none") {                ul.slideDown("fast");            }        });        $(divselectid).live('mouseleave', function () {            $(divselectid + " ul").hide();        });    };    $(function () {        //赠品处滚条        $('#ncsGoodsGift').perfectScrollbar({suppressScrollX: true});        // 加入购物车        $('a[nctype="addcart_submit"]').click(function () {            if (typeof(allow_buy) != 'undefined' && allow_buy === false) return;            addcart(100009, checkQuantity(), 'addcart_callback');        });        // 立即购买        $('a[nctype="buynow_submit"]').click(function () {            if (typeof(allow_buy) != 'undefined' && allow_buy === false) return;            buynow(100009, checkQuantity());        });        // 到货通知        //浮动导航  waypoints.js        $('#main-nav').waypoint(function (event, direction) {            $(this).parent().parent().parent().toggleClass('sticky', direction === "down");            event.stopPropagation();        });        // 分享收藏下拉操作        $.divselect("#handle-l");        $.divselect("#handle-r");        // 规格选择        $('dl[nctype="nc-spec"]').find('a').each(function () {            $(this).click(function () {                if ($(this).hasClass('hovered')) {                    return false;                }                $(this).parents('ul:first').find('a').removeClass('hovered');                $(this).addClass('hovered');                checkSpec();            });        });    });    function checkSpec() {        var spec_param = [{            "sign": "",            "url": "http:\/\/shopwwi.local.com\/shop\/index.php?act=goods&op=index&goods_id=100009"        }];        var spec = new Array();        $('ul[nctyle="ul_sign"]').find('.hovered').each(function () {            var data_str = '';            eval('data_str =' + $(this).attr('data-param'));            spec.push(data_str.valid);        });        spec1 = spec.sort(function (a, b) {            return a - b;        });        var spec_sign = spec1.join('|');        $.each(spec_param, function (i, n) {            if (n.sign == spec_sign) {                window.location.href = n.url;            }        });    }    // 验证购买数量    function checkQuantity() {        var quantity = parseInt($("#quantity").val());        if (quantity < 1) {            alert("请填写购买数量");            $("#quantity").val('1');            return false;        }        max = parseInt($('[nctype="goods_stock"]').text());        if (quantity > max) {            alert("库存不足");            return false;        }        return quantity;    }    $(function () {        /** goods.php **/            // 商品内容部分折叠收起侧边栏控制        $('#fold').click(function () {            $('.ncs-goods-layout').toggleClass('expanded');        });        // 商品内容介绍Tab样式切换控制        $('#categorymenu').find("li").click(function () {            $('#categorymenu').find("li").removeClass('current');            $(this).addClass('current');        });        // 商品详情默认情况下显示全部        $('#tabGoodsIntro').click(function () {            $('.bd').css('display', '');            $('.hd').css('display', '');        });        // 点击地图隐藏其他以及其标题栏        $('#tabStoreMap').click(function () {            $('.bd').css('display', 'none');            $('#ncStoreMap').css('display', '');            $('.hd').css('display', 'none');        });        // 点击评价隐藏其他以及其标题栏        $('#tabGoodsRate').click(function () {            $('.bd').css('display', 'none');            $('#ncGoodsRate').css('display', '');            $('.hd').css('display', 'none');        });        // 点击成交隐藏其他以及其标题        $('#tabGoodsTraded').click(function () {            $('.bd').css('display', 'none');            $('#ncGoodsTraded').css('display', '');            $('.hd').css('display', 'none');        });        // 点击咨询隐藏其他以及其标题        $('#tabGuestbook').click(function () {            $('.bd').css('display', 'none');            $('#ncGuestbook').css('display', '');            $('.hd').css('display', 'none');        });        //商品排行Tab切换        $(".ncs-top-tab > li > a").mouseover(function (e) {            if (e.target == this) {                var tabs = $(this).parent().parent().children("li");                var panels = $(this).parent().parent().parent().children(".ncs-top-panel");                var index = $.inArray(this, $(this).parent().parent().find("a"));                if (panels.eq(index)[0]) {                    tabs.removeClass("current ").eq(index).addClass("current ");                    panels.addClass("hide").eq(index).removeClass("hide");                }            }        });        //信用评价动态评分打分人次Tab切换        $(".ncs-rate-tab > li > a").mouseover(function (e) {            if (e.target == this) {                var tabs = $(this).parent().parent().children("li");                var panels = $(this).parent().parent().parent().children(".ncs-rate-panel");                var index = $.inArray(this, $(this).parent().parent().find("a"));                if (panels.eq(index)[0]) {                    tabs.removeClass("current ").eq(index).addClass("current ");                    panels.addClass("hide").eq(index).removeClass("hide");                }            }        });//触及显示缩略图        $('.goods-pic > .thumb').hover(            function () {                $(this).next().css('display', 'block');            },            function () {                $(this).next().css('display', 'none');            }        );        /* 商品购买数量增减js */        // 增加        $('a[nctype="increase"]').click(function () {            num = parseInt($('#quantity').val());            max = parseInt($('[nctype="goods_stock"]').text());            if (num < max) {                $('#quantity').val(num + 1);            }        });        //减少        $('a[nctype="decrease"]').click(function () {            num = parseInt($('#quantity').val());            if (num > 1) {                $('#quantity').val(num - 1);            }        });        //评价列表        $('#comment_tab').on('click', 'li', function () {            $('#comment_tab li').removeClass('current');            $(this).addClass('current');            load_goodseval($(this).attr('data-type'));        });        $('.ncs-buy').bind({            mouseover: function () {                $(".ncs-point").show();            },            mouseout: function () {                $(".ncs-point").hide();            }        });    });    /* 加入购物车后的效果函数 */    function addcart_callback(data) {        $('#bold_num').html(data.num);        $('#bold_mly').html(price_format(data.amount));        $('.ncs-cart-popup').fadeIn('fast');    }</script><script language="javascript">    function fade() {        $("img[rel='lazy']").each(function () {            var $scroTop = $(this).offset();            if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {                $(this).hide();                $(this).attr("src", $(this).attr("shopwwi-url"));                $(this).removeAttr("rel");                $(this).removeAttr("name");                $(this).fadeIn(500);            }        });    }    if ($("img[rel='lazy']").length > 0) {        $(window).scroll(function () {            fade();        });    }    ;    fade();</script><script type="text/javascript">    var LOGIN_SITE_URL = 'http://shopwwi.local.com/member';    var CHAT_SITE_URL = 'http://shopwwi.local.com/chat';    var SHOP_SITE_URL = 'http://shopwwi.local.com/shop';    var connect_url = "http://shopwwi.local.com:8091";    var layout = "layout/home_layout.php";    var act_op = "goods_index";    var chat_goods_id = "100009";    var user = {};    user['u_id'] = "";    user['u_name'] = "";    user['s_id'] = "";    user['s_name'] = "";    user['s_avatar'] = "http://shopwwi.local.com/data/upload/shop/common/default_store_avatar.gif";    user['avatar'] = "{$site_info.site_path}images/default_user_portrait.gif";    $("#chat_login").nc_login({        action: '/index.php?act=login',        nchash: '165a4a24',        formhash: 'x7lNyFxbd1VK_XhbOVtlCMtRU1X1ImX'    });</script><template file="Site/script/cart_script.php" /><template file="Site/footer.php" /><script>    $(function(){    })</script></body></html>