<template file="Site/head.php" />
<template file="Site/top.php" />
<template file="Site/naviga.php"/>
<body>
<script src="{$site_info.site_path}js/search_goods.js"></script>
<link href="{$site_info.site_path}css/layout.css" rel="stylesheet" type="text/css">

<style type="text/css">

    /*body {*/
        /*_behavior: url(other/csshover.htc);*/

    /*}*/

</style>
<div class="nch-container wrapper" >

    <div class="left">

        <div class="nch-module nch-module-style02">

            <div class="title">

                <h3>分类筛选</h3>

            </div>

            <div class="content">

                <ul id="files" class="tree">
                    <if condition="$cats neq ''">
                        <volist name="cats" id="vo">
                            <li>
                                <i class="tree-parent"></i>
                                <php>
                                    $params = $url_params;
                                    unset($params['type']);
                                    $p_cat = array_merge($params,array('cid' => $vo['catid']));
                                </php>
                                <a href="{:U('products', $p_cat)}" <if condition="$catid eq $vo['catid']">class="selected"</if>>{$vo.cat_name}</a>
                                <if condition="$vo['childs'] neq ''">
                                    <ul>
                                        <volist name="vo.childs" id="v">
                                            <li class="tree-parent tree-parent-collapsed"><i></i>
                                                <php>
                                                    $params = $url_params;
                                                    unset($params['type']);
                                                    $c_cat = array_merge($params,array('cid' => $v['catid']));
                                                </php>
                                                <a href="{:U('products', $c_cat)}" <if condition="$catid eq $v['catid']">class="selected"</if>>{$v.cat_name}</a></li>
                                        </volist>
                                    </ul>
                                </if>

                            </li>
                        </volist>
                    </if>
                </ul>

            </div>

        </div>

        <!-- S 推荐展位 -->

        <div nctype="booth_goods" class="nch-module" style="display:none;"> </div>

        <!-- E 推荐展位 -->

<!--        <div class="nch-module"><a href='' title='商品列表页左侧广告位'><img style='width:206px;height:300px' border='0' src='' alt=''/></a></div>-->

        <!-- 最近浏览 -->



        <div class="nch-module nch-module-style03">

            <div class="title">

                <h3>最近浏览</h3>

            </div>

            <div class="content">

                <div class="nch-sidebar-viewed" id="nchSidebarViewed">
                    <if condition="$browses neq ''">
                        <ul>
                            <volist name="browses" id="vo">
                                <li class="nch-sidebar-bowers">
                                    <div class="goods-pic">
                                        <a href="{:U('product', array('gid' => $vo['goods_id']))}" target="_blank">
                                            <img src="{$vo.goods_thumb}" title="{$vo.goods_name}" alt="{$vo.goods_name}">
                                        </a>
                                    </div>
                                    <dl>
                                        <dt><a href="{:U('product', array('gid' => $vo['goods_id']))}" target="_blank">{$vo.goods_name}</a></dt>
                                        <dd>¥{$vo.goods_price|cur}</dd>
                                    </dl>
                                </li>
                            </volist>
                        </ul>
                    </if>
                </div>

                <a href="{:U('Member/Member/goodsBrowse')}" class="nch-sidebar-all-viewed">全部浏览历史</a></div>

        </div>

    </div>

    <div class="right">

        <!-- 分类下的推荐商品 -->

        <div id="gc_goods_recommend_div" style="width:980px;"></div>

        <div class="shop_con_list" id="main-nav-holder">

            <nav class="sort-bar" id="main-nav">

                <div class="nch-all-category">

                    <div class="all-category">

                        <div class="title">
                            <!--<i></i>-->
                            <h3><a href="javascript:;"><!--全部分类--></a></h3>
                        </div>
                    </div>

                </div>

                <div class="nch-sortbar-array"> 排序方式：

                    <ul>
                        <php>
                            $g_order = array_merge($url_params,array('type' => 1));
                        </php>
                        <li <if condition="($type eq 1) OR ($type eq '')">class="selected"</if>><a href="{:U('products', $g_order)}"  title="默认排序">默认</a></li>
                        <php>
                            $g_order = array_merge($url_params,array('type' => 2));
                        </php>
                        <li <if condition="$type eq 2">class="selected"</if>><a href="{:U('products', $g_order)}"  title="点击按销量从高到低排序">销量<i></i></a></li>
                        <php>
                            $g_order = array_merge($url_params,array('type' => 3));
                        </php>
                        <li <if condition="$type eq 3">class="selected"</if>><a href="{:U('products', $g_order)}"  title="点击按人气从高到低排序">人气<i></i></a></li>
                        <php>
                            $g_order = array_merge($url_params,array('type' => 4, 'order' => $p_order));
                        </php>
                        <li <if condition="$type eq 4">class="selected"</if>><a href="{:U('products', $g_order)}"  title="" class="<if condition="$p_order eq 'asc'">desc<else/>asc</if>">价格<i></i></a></li>

                    </ul>

                </div>

<!--                <div class="nch-sortbar-filter" nc_type="more-filter">-->
<!---->
<!--                    <span class="arrow"></span>-->
<!---->
<!--                    <ul>-->
<!---->
                       <!-- 消费者保障服务 -->
<!---->
<!--                        <li><a href="" ><i></i>7天退货</a></li>-->
<!---->
<!--                        <li><a href="" ><i></i>品质承诺</a></li>-->
<!---->
<!--                        <li><a href="" ><i></i>破损补寄</a></li>-->
<!---->
<!--                        <li><a href="" ><i></i>急速物流</a></li>-->
<!---->
<!--                    </ul>-->
<!---->
<!--                </div>-->


            </nav>

            <!-- 商品列表循环  -->

            <div>
                <div class="squares" nc_type="current_display_mode">
                    <input type="hidden" id="lockcompare" value="unlock"/>
                    <ul class="list_pic">
                        <volist name="list" id="vo">
                            <li class="item">
                            <div class="goods-content">
                                <div class="goods-pic">
                                    <a href="{:U('product', array('gid' => $vo['goods_id']))}" target="_blank" title="{$vo.goods_name}">
                                        <img data-url="{$vo.goods_thumb}" rel='lazy' src="{$site_info.site_path}images/loading.gif" title="{$vo.goods_name}" alt=""/>
                                    </a>
                                </div>
<!--                                <div class="goods-promotion"><span>团购商品</span></div>-->
                                <div class="goods-info">
                                    <div class="goods-pic-scroll-show">
                                        <ul>
                                            <!-- 默认展示 -->
                                            <li class="selected">
                                                <a href="javascript:void(0);">
                                                    <img data-url="{$vo.goods_thumb}" rel='lazy' src="{$site_info.site_path}images/loading.gif"/>
                                                </a>
                                            </li>
                                            <!-- 多图展示 -->
                                            <if condition="$vo['goods_img'] neq ''">
                                                <php>$goods_img = explode('|', $vo['goods_img']);</php>
                                                <volist name="goods_img" id="img">
                                                    <li class="selected">
                                                        <a href="javascript:void(0);">
                                                            <img data-url="{$img}" rel='lazy' src="{$site_info.site_path}images/loading.gif"/>
                                                        </a>
                                                    </li>
                                                </volist>
                                            </if>
                                        </ul>
                                    </div>
                                    <div class="goods-name">
                                        <a href="{:U('product', array('gid' => $vo['goods_id']))}" target="_blank" title="{$vo.goods_name}">{$vo.goods_name}</a>
                                    </div>
                                    <div class="goods-price">
                                        <em class="sale-price" title="商城价：&yen;{$vo.goods_price}">￥{$vo.goods_price}</em>
                                        <em class="market-price" title="市场价：&yen;{$vo.market_price}">￥{$vo.market_price}</em>
                                        <!--<span class="raty" data-score="5"></span>--> </div>
                                    <div class="goods-sub"></div>
                                    <div class="sell-stat">
                                        <ul>
                                            <li>
                                                <a href="javascript:;" class="status">{$vo.sale_num|default='0'}</a>
                                                <p>商品销量</p>
                                            </li>
                                            <li>
                                                <a href="javascript:;">{$vo.comments|default='0'}</a>

                                                <p>用户评论</p></li>
                                            <li><em>&nbsp;</em></li>
                                        </ul>
                                    </div>
                                    <!-- 店铺 -->
                                    <div class="store"></div>
                                    <div class="add-cart">
                                        <if condition="$vo['is_sku'] eq 1">
                                            <a href="{:U('product', array('gid' => $vo['goods_id']))}" data-gid="{$vo.goods_id}"><i class="icon-shopping-cart"></i>加入购物车</a>
                                        <else/>
                                            <a href="javascript:void(0);" nctype="add_cart" data-gid="{$vo.goods_id}"><i class="icon-shopping-cart"></i>加入购物车</a>
                                        </if>
                                    </div>
                                </div>
                            </div>
                        </li>
                        </volist>
                        <div class="clear"></div>
                    </ul>
                </div>
                <form id="buynow_form" method="post" action="http://localhost:8009/shop/index.php" target="_blank">
                    <input id="act" name="act" type="hidden" value="buy"/>
                    <input id="op" name="op" type="hidden" value="buy_step1"/>
                    <input id="goods_id" name="cart_id[]" type="hidden"/>
                </form>
                <script type="text/javascript" src="{$site_info.common_path}js/jquery.raty.min.js"></script>
                <!-- 分页 -->
                <div class="mt30 pagelist">
                    <div class="pager">
                        {$pages}
                    </div>
                </div>
                <div class="clear clearfix"></div>
            </div>


        </div>



        <!-- 猜你喜欢 -->

        <div id="guesslike_div" style="width:980px;"></div>

    </div>

    <div class="clear"></div>

</div>

<script src="{$site_info.site_path}js/waypoints.js"></script>

<script src="{$site_info.site_path}js/search_category_menu.js"></script>

<script type="text/javascript" src="{$site_info.common_path}js/jquery.fly.min.js" charset="utf-8"></script>

<!--[if lt IE 10]>

<script type="text/javascript" src="{$site_info.site_path}js/requestAnimationFrame.js" charset="utf-8"></script>

<![endif]-->

<script type="text/javascript">

    var defaultSmallGoodsImage = '/public/site/images/default_goods_image_240.gif';

    var defaultTinyGoodsImage = '/public/site/images/default_goods_image_60.gif';


    $(function () {

        $('#files').tree({

            expanded: 'li:lt(2)'

        });

        //品牌索引过长滚条

        $('#ncBrandlist').perfectScrollbar({suppressScrollX: true});

        //浮动导航  waypoints.js

        $('#main-nav-holder').waypoint(function (event, direction) {

            $(this).parent().toggleClass('sticky', direction === "down");

            event.stopPropagation();

        });

        // 单行显示更多

        $('span[nc_type="show"]').click(function () {

            s = $(this).parents('dd').prev().find('li[nc_type="none"]');

            if (s.css('display') == 'none') {

                s.show();

                $(this).html('<i class="icon-angle-up"></i>收起');

            } else {

                s.hide();

                $(this).html('<i class="icon-angle-down"></i>更多');

            }

        });


        //浏览历史处滚条

        $('#nchSidebarViewed').perfectScrollbar({suppressScrollX: true});

    });

</script>

<script language="javascript">

    function fade() {

        $("img[rel='lazy']").each(function () {

            var $scroTop = $(this).offset();

            if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {

                $(this).hide();

                $(this).attr("src", $(this).attr("data-url"));

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

<div style="clear: both;"></div>

<div id="web_chat_dialog" style="display: none;float:right;">

</div>
<template file="Site/script/cart_script.php" />
<template file="Site/footer.php" />
<script>
    $(function(){

    })
</script>
</body>
</html> 