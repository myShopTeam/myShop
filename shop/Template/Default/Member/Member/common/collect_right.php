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
                                <a href="javascript:void(0)" onclick="ajax_get_confirm('您确定要删除吗?', '{:U("Member/Member/delFavoriteGoods")}&id={$vo.goods_id}');" class="fr ml5" title="删除"><i class="icon-trash"></i></a>
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

</div>

