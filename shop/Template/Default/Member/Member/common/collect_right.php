<style type="text/css">
    #box {
        background: #F30;
        width: 16px;
        height: 16px;
        margin-left: 150px;
        display: block;
        border-radius: 100%;
        position: absolute;
        z-index: 999;
        opacity: .5
    }
</style>
<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="active"><a href="{:U('Member/Member/favoriteGoods')}">收藏商品</a></li>
<!--            <li class="normal"><a href="index.php?act=member_favorite_goods&amp;op=fglist&amp;show=store">同店商品</a></li>-->
        </ul>
    </div>
    <div id="favoritesGoods">
        <if condition="$collects neq ''">
            <volist name="collects" id="vo">
                <div class="favorite-goods-list">
                    <ul>

                        <li class="favorite-pic-list">
                            <div class="favorite-goods-thumb">
                                <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}" target="_blank" title="{$vo.goods_name}">
                                    <div class="jqthumb" style="width: 150px; height: 150px; opacity: 1;">
                                        <div style="width: 100%; height: 100%; background-image: url(&quot;{$vo.goods_thumb}&quot;); background-repeat: no-repeat; background-position: 50% 50%; background-size: cover;"></div>
                                    </div>
                                    <img src="{$vo.goods_thumb}" style="display: none;">
                                </a>
                            </div>
                            <div class="handle">
                                <a href="javascript:void(0)" onclick="ajax_get_confirm('您确定要删除吗?', '{:U("Member/Member/delFavoriteGoods")}');" class="fr ml5" title="删除"><i class="icon-trash"></i></a>
                                <!--                        <a href="javascript:void(0)" class="fr" title="加入购物车" nctype="add_cart" data-gid="100004"><i class="icon-shopping-cart"></i></a>-->
                                <!--                        <a href="javascript:void(0)" nc_type="sharegoods" data-param="{&quot;gid&quot;:&quot;100004&quot;}" class="fl w40" title="分享"><i class="icon-share"></i>分享</a>-->
                            </div>
                            <dl class="favorite-goods-info">
                                <dt>
                                    <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}" target="_blank" title="{$vo.goods_name}">{$vo.goods_name}</a>
                                </dt>
                                <dd class="goods-price">
                                    ¥<strong>{$vo.goods_price|cur}</strong>
                                </dd>
                            </dl>
                        </li>

                    </ul>
                </div>
            </volist>
        <else/>
            <template file="Member/Member/common/empty.php"/>
        </if>

    </div>
<!--    <div class="tc mt20 mb20">-->
<!--        <div class="pagination" id="page-nav">-->
<!--            <div id="infscr-loading" style="display: none;">-->
<!--                <img alt="Loading..." src="http://shopwwi.local.com/shop/templates/default/images/loading.gif" style="display: none;">-->
<!---->
<!--                <div style="opacity: 1;">没有记录了</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <!-- 猜你喜欢 -->
<!--    <div id="guesslike_div" style="width:980px;"></div>-->
</div>

<script src="http://shopwwi.local.com/data/resource/js/jquery.infinitescroll.js" type="text/javascript"></script>
<script src="http://shopwwi.local.com/data/resource/js/jquery.thumb.min.js"></script>
<script src="http://shopwwi.local.com/data/resource/js/sns.js"></script>
<script src="http://shopwwi.local.com/data/resource/js/fly/jquery.fly.min.js"></script>
<!--[if lt IE 10]>
<script type="text/javascript" src="http://shopwwi.local.com/data/resource/js/fly/requestAnimationFrame.js"charset="utf-8"></script>
<![endif]-->
<script>
    $(function () {
//        $('#favoritesGoods').infinitescroll({
//            navSelector: '#page-more',
//            nextSelector: '#page-more a',
//            itemSelector: '.favorite-goods-list',
//            loading: {
//                selector: '#page-nav',
//                img: '/public/site/images/loading.gif',
//                msgText: '努力加载中...',
//                maxPage: 1,
//                finishedMsg: '没有记录了',
//                finished: function () {
//                    $('.favorite-goods-thumb img').jqthumb({
//                        width: 150,
//                        height: 150,
//                        after: function (imgObj) {
//                            imgObj.css('opacity', 0).attr('title', $(this).attr('alt')).animate({opacity: 1}, 2000);
//                        }
//                    });
//                }
//            }
//        });


        $('.favorite-goods-thumb img').jqthumb({
            width: 150,
            height: 150,
            after: function (imgObj) {
                imgObj.css('opacity', 0).attr('title', $(this).attr('alt')).animate({opacity: 1}, 2000);
            }
        });


        // 加入购物车
        $(window).resize(function () {
            $('#favoritesGoods').on('click', 'a[nctype="add_cart"]', function () {
                flyToCart($(this));
            });
        });
        $('#favoritesGoods').on('click', 'a[nctype="add_cart"]', function () {
            flyToCart($(this));
        });
        function flyToCart($this) {
            var rtoolbar_offset_left = $("#rtoolbar_cart").offset().left;
            var rtoolbar_offset_top = $("#rtoolbar_cart").offset().top - $(document).scrollTop();
            var img = $this.parents('li').find('img').attr('src');
            var data_gid = $this.attr('data-gid');
            var flyer = $('<img class="u-flyer" src="' + img + '" style="z-index:999">');
            flyer.fly({
                start: {
                    left: $this.offset().left,
                    top: $this.offset().top - $(document).scrollTop()
                },
                end: {
                    left: rtoolbar_offset_left,
                    top: rtoolbar_offset_top,
                    width: 0,
                    height: 0
                },
                onEnd: function () {
                    addcart(data_gid, 1, '');
                    flyer.remove();
                }
            });
        }

        // 立即购买
        $('a[nctype="buy_now"]').click(function () {
            var data_gid = $(this).attr('data-gid');
            $("#goods_id").val(data_gid + '|1');
            $("#buynow_form").submit();
        });
    });

</script>
