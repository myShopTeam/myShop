<div class="header-wrap">
    <header class="public-head-layout wrapper">
        <h1 class="site-logo"><a href="/"><img src="" class="pngFix"></a></h1>
        <div class="logo-test"><!--好货·好快·好便宜--></div>

        <div class="head-search-layout">
            <div class="head-search-bar" id="head-search-bar">
                <div class="hd_serach_tab" id="hdSearchTab">
                    <a href="javascript:;" act="search" title="请输入您要搜索的商品关键字" class="d">商品</a>
<!--                    <i></i>-->
                </div>
                <form action="" method="get" class="search-form" id="top_search_form">
                    <input name="act" id="search_act" value="search" type="hidden">
                    <input name="keyword" id="keyword" type="text" class="input-text" value="" maxlength="60" x-webkit-speech lang="zh-CN" onwebkitspeechchange="foo()" placeholder="请输入您要搜索的商品关键字" data-value="" x-webkit-grammar="builtin:search" autocomplete="off" />
                    <input type="submit" id="button" value="搜索" class="input-submit">
                </form>
            </div>
<!--            <div class="keyword">-->
<!--                <ul>-->
<!--                    <li><a href="javascript:;" style="color: #f55;">热门搜索：</a></li>-->
<!--                    <li><a href="">手机</a></li>-->
<!--                    <li><a href="">内衣</a></li>-->
<!--                    <li><a href="">手表</a></li>-->
<!--                    <li><a href="">电脑</a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
        <div class="mod_minicart" style="">
            <a id="nofollow" target="_self" href="{:U('Cart/Cart/index')}" class="mini_cart_btn">
                <i class="cart_icon"></i>
                <em class="cart_num">{$cart_num|default='0'}</em>
                <span>购物车</span>
            </a>
            <div id="minicart_list" class="minicart_list">
                <div class="spacer"></div>
                <div class="list_detail">
                    <!--购物车有商品时begin-->
                    <ul><img class="loading" src="{$site_info.site_path}images/loading.gif" /></ul>
                    <div class="checkout_box">
                        <p class="fl">共<em class="tNum">1</em>件商品,合计：<em class="tSum">0</em></p>
                        <a rel="nofollow" class="checkout_btn" href="/index.php?act=cart" target="_self"> 去结算 </a>
                    </div>
                </div>
            </div>
        </div>

    </header>
</div>
<!-- PublicHeadLayout End -->

<!-- publicNavLayout Begin -->
<nav class="public-nav-layout">
    <div class="wrapper">
        <div class="all-category">
            <div class="title"><i></i><h3><a href="javascript:;">全部分类</a></h3>
            </div>
            <div class="category">
                <ul class="menu">
                    <if condition="$goods_cats neq ''">
                        <volist name="goods_cats" id="vo">
                            <li cat_id="{$vo.catid}" class="odd">
                                <div class="class">
                                    <span class="ico">
                                         <if condition="$vo['cat_img'] neq ''"><img src="{$vo.cat_img}"></if>
                                    </span>
                                    <h4>
                                        <a href="{:U('Site/Goods/products', array('catid' => $vo['catid']))}">{$vo.cat_name}</a>
                                    </h4>
                                    <span class="arrow"></span>
                                </div>
                            </li>
                        </volist>
                    </if>

                </ul>
            </div>
        </div>
        <ul class="site-menu">
            <li><a href="/"><span>首页</span></a></li>
            <li class="navitems-on"><a href="{:U('products', array('hot' => 1))}" <if condition="$hot eq 1">class="current"</if>><span>热卖</span></a></li>
            <li><a href="{:U('products', array('new' => 1))}" <if condition="$new eq 1">class="current"</if>><span>新品</span></a></li>
            <li><a href="{:U('products', array('best' => 1))}" <if condition="$best eq 1">class="current"</if>><span>精品</span></a></li>
           </ul>
    </div>
</nav>

<div class="nch-breadcrumb-layout">

    <div class="nch-breadcrumb wrapper"><i class="icon-home"></i>

        <span><a href="/">首页</a></span><span class="arrow">></span>

        <span>{$cat_name}</span>

    </div>

</div>
