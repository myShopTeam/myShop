<div id="member_center_box" class="ncm-index-container">
    <style type="text/css">
        .ncm-container .left-layout { border-color: transparent; }
    </style>
    <div id="transaction" class="double">
        <div class="outline">
            <div class="title">
                <h3>交易提醒</h3>
                <ul>
                    <li>
                        <a href="index.php?act=member_order&amp;state_type=state_new">待付款<em>{$orders_num[0].order_num|default='0'}</em></a>
                    </li>
                    <li>
                        待发货<em>{$orders_num[2].order_num|default='0'}</em>
                    </li>
                    <li>
                        待收货<em>{$orders_num[3].order_num|default='0'}</em>
                    </li>
                </ul>
            </div>
            <if condition="$orders">
                <div class="order-list">
                    <ul>
                        <volist name="orders" id="vo" key="k">
                            <li>
                                <div class="ncm-goods-thumb">
                                    <a target="_blank" href="{:U('Site/Goods/product', array('gid' => $vo['order_items'][0]['goods_id']))}">
                                        <img src="{$vo['order_items'][0]['goods_thumb']}">
                                    </a>
                                    <em><if condition="$vo['items_num'] neq 0">{$vo.items_num}</if></em>
                                </div>
                                <dl class="ncm-goods-info">
                                    <dt>
                                        <a href="{:U('Site/Goods/product', array('gid' => $vo['order_items'][0]['goods_id']))}" target="_blank">{$vo['order_items'][0]['goods_name']}</a>
                                    </dt>
                                    <dd>
                                        <span class="order-date">下单时间：{$vo.addtime|date='Y-m-d H:i:s',###}</span>
                                        <span class="ncm-order-price">订单金额：<em>￥{$vo.final_amount|cur}</em></span>
                                    </dd>
                                    <dd>
                                        <span class="order-state">订单状态：
                                            <if condition="$vo['order_status'] eq '1'">已完成
                                            <elseif condition="$vo['order_status'] eq '2'" />待发货
                                            <elseif condition="$vo['order_status'] eq '3'" />待收货
                                            <elseif condition="$vo['order_status'] eq '4'" />退货/款
                                            <elseif condition="$vo['order_status'] eq '5'" />已取消
                                            <elseif condition="$vo['order_status'] eq '6'" />已关闭
                                            <elseif condition="$vo['order_status'] eq '7'" />失效
                                            <else/>未付款
                                            </if>
                                        </span>
                                    </dd>
                                </dl>
                                <a href="{:U('Order/Order/pay')}" target="_blank" class="ncbtn ncbtn-bittersweet"><i class="icon-shield"></i>订单支付</a>
                            </li>
                        </volist>
                    </ul>
                </div>
            <else/>
                <dl class="null-tip">
                    <dt></dt>
                    <dd>
                        <h4>您好久没在商城购物了</h4>
                        <h5>交易提醒可帮助您了解订单状态和物流情况</h5>
                    </dd>
                </dl>
            </if>
        </div>
    </div>
    <div id="shopping" class="normal">
        <div class="outline">
            <div class="title">
                <h3>购物车</h3>
            </div>
            <if condition="$carts neq ''">
                <div class="cart-list">
                    <ul>
                        <volist name="carts" id="vo">
                            <li>
                                <div class="ncm-goods-thumb">
                                    <a target="_blank" href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}">
                                        <img src="{$vo.goods_thumb}">
                                    </a>
                                </div>
                                <dl class="ncm-goods-info">
                                    <dt>
                                        <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}">{$vo.goods_name}</a>
                                    </dt>
                                    <dd>
                                        <span class="ncm-order-price">商城价：<em>￥<if condition="$vo['sku_id'] eq ''">{$vo.goods_price|cur}<else/>{$vo.attr_price|cur}</if></em></span><!-- <span class="sale">限时折扣</span> -->
                                    </dd>
                                </dl>
                            </li>
                        </volist>
                    </ul>
                    <div class="more"><a href="{:U('Cart/Cart/index')}">查看购物车所有商品</a></div>
                </div>
            <else/>
                <dl class="null-tip">
                    <dt></dt>
                    <dd>
                        <h4>您的购物车还是空的</h4>
                        <h5>将想买的商品放进购物车，一起结算更轻松</h5>
                    </dd>
                </dl>
            </if>
        </div>
    </div>

    <div id="favoritesGoods" class="double">
        <div class="outline">
            <div class="title">
                <h3>商品收藏</h3>
            </div>
            <if condition="$collects">

            <else/>
                <dl class="null-tip">
                    <dt></dt>
                    <dd>
                        <h4>您还没有收藏商品</h4>
                        <h5>收藏的商品将显示最新的促销活动和降价情况</h5>
                    </dd>
                </dl>
            </if>
        </div>
    </div>
    <div id="browseMark" class="normal">
        <div class="outline">
            <div class="title">
                <h3>我的足迹</h3>
            </div>
            <if condition="$browses">
                <div class="ncm-browse-mark">
                    <div class=" jcarousel-skin-tango">
                        <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
                            <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                                <ul id="browseMarkList" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 203px;">
                                    <volist name="browses" id="vo" key="k">
                                        <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-{$k} jcarousel-item-{$k}-horizontal" jcarouselindex="{$k}" style="float: left; list-style: none; width: 103px;">
                                            <div class="ncm-goods-pic">
                                                <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}" target="_blank">
                                                    <img alt="{$vo.goods_name}" src="{$vo.goods_thumb}">
                                                </a>
                                            </div>
                                            <dl>
                                                <dt class="ncm-goods-name">
                                                    <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}" title="{$vo.goods_name}" target="_blank">{$vo.goods_name}</a>
                                                </dt>
                                                <dd class="ncm-goods-price"><em>￥<if condition="$vo['sku_id'] eq ''">{$vo.goods_price|cur}<else/>{$vo.attr_price|cur}</if></em></dd>
                                            </dl>
                                        </li>
                                    </volist>
                                </ul>
                            </div>
                            <div class="jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal" disabled="disabled" style="display: block;"></div>
                            <div class="jcarousel-next jcarousel-next-horizontal jcarousel-next-disabled jcarousel-next-disabled-horizontal" disabled="disabled" style="display: block;"></div>
                        </div>
                    </div>
                    <div class="more">
                        <a href="{:U('Member/Member/goodsBrowse')}" target="_blank">查看所有商品</a>
                    </div>
                </div>
            <else/>
                <dl class="null-tip">
                    <dt></dt>
                    <dd>
                        <h4>您的商品浏览记录为空</h4>
                        <h5>赶紧去商城看看促销活动吧</h5>
                        <p><a target="_blank" href="{:U('Site/Goods/products')}" class="ncbtn-mini">浏览商品</a></p>
                    </dd>
                </dl>
            </if>

        </div>
    </div>

<!--    <div id="friendsShare" class="normal">-->
<!--        <div class="outline">-->
<!--            <div class="title">-->
<!--                <h3>好友动态</h3>-->
<!--            </div>-->
<!--            <dl class="null-tip">-->
<!--                <dt></dt>-->
<!--                <dd>-->
<!--                    <h4>您的好友最近没有什么动静</h4>-->
<!--                    <h5>关注其他用户成为好友可将您的动态进行分享</h5>-->
<!--                    <p><a target="_blank" href="http://shopwwi.local.com/member/index.php?act=member_snsfriend&amp;op=follow" class="ncbtn-mini">查看我的全部好友</a></p>-->
<!--                </dd>-->
<!--            </dl>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div id="circle" class="normal">-->
<!--        <div class="outline">-->
<!--            <div class="title">-->
<!--                <h3>我的圈子</h3>-->
<!--            </div>-->
<!--            <dl class="null-tip">-->
<!--                <dt></dt>-->
<!--                <dd>-->
<!--                    <h4>您还没有自己的圈子</h4>-->
<!--                    <h5>您可以创建或加入感兴趣的社交圈子</h5>-->
<!--                    <p><a target="_blank" href="http://shopwwi.local.com/circle/index.php?act=index&amp;op=add_group" class="ncbtn-mini">创建圈子</a></p>-->
<!--                </dd>-->
<!--            </dl>-->
<!--        </div>-->
<!--    </div>-->

</div>
<script>
//信息轮换
$.getScript("{$site_info.common_path}js/jquery.jcarousel.min.js", function(){
$('#favoritesGoodsList').jcarousel({visible: 4,itemFallbackDimension: 300});
$('#favoritesStoreList').jcarousel({visible: 3,itemFallbackDimension: 300});
$('#friendsShareList').jcarousel({visible: 3,itemFallbackDimension: 300});
$('#circleList').jcarousel({visible: 3,itemFallbackDimension: 300});
$('#browseMarkList').jcarousel({visible: 3,itemFallbackDimension: 300});
});
</script>