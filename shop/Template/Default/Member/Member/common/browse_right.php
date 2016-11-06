<style>
    .pricetag {
        background-color: #D93600;
        color: #FFFFFF;
        height: 14px;
        line-height: 14px;
        margin-right: 2px;
        padding-bottom: 1px;
        padding-left: 3px;
        padding-right: 3px;
        padding-top: 1px;
        vertical-align: middle;
    }
</style>
<div class="wrap">
    <div class="tabmenu">
        <ul id="listpj" class="tab">
            <li class="active"><a href="{:U('Member/Member/goodsBrowse')}">我的足迹</a></li>
        </ul>
        <a class="ncbtn ncbtn-grapefruit" href="javascript:void(0);" nc_type="delbtn" data-id="all"><i class="icon-trash"></i>清空全部足迹</a>
    </div>

    <div class="ncm-browse">
        <div class="ncm-browse-left">
            <ul class="ncm-browse-list">
                <if condition="$browses neq ''">
                    <volist name="browses" id="vo">
                        <li id="browserow_{$vo.id}">
                            <div class="browse-timeline">&nbsp;</div>
                            <div class="browse-time">{$vo.created|date='Y-m-d H:i:s',###}</div>
                            <div class="browse-goods">
                                <div class="goods-thumb">
                                    <a href="{:U('Site/Goods/product',array('gid' => $vo['goods_id']))}" target="_blank">
                                        <img src="{$vo.goods_thumb}">
                                    </a>
                                </div>
                                <dl class="goods-info">
                                    <dt>
                                        <a target="_blank" href="{:U('Site/Goods/product',array('gid' => $vo['goods_id']))}">{$vo.goods_name}</a>
                                    </dt>
                                    <dd>商城价：
                                        <!--  -->
                                        <em class="sale-price">¥{$vo.goods_price|cur}</em>
                                        <em class="market-price" title="市场价">¥{$vo.market_price|cur}</em>
                                    </dd>
                                </dl>
<!--                                <a class="ncbtn ncbtn-bittersweet" href="javascript:void(0)" nctype="add_cart" data-gid="100004"><i class="icon-shopping-cart"></i>加入购物车</a>-->
<!--                                <br><br>-->
                                <a class="ncbtn" href="javascript:void(0);" nc_type="delbtn" data-id="{$vo.id}"><i class="icon-trash"></i>删除该记录</a>
                            </div>
                        </li>
                    </volist>
                <else/>
                    <template file="Member/Member/common/empty.php"/>
                </if>
            </ul>
        </div>

<!--        <div class="ncm-browse-class">-->
<!--            <div class="title"><a href="index.php?act=member_goodsbrowse&amp;op=list" class="selected"> 全部浏览历史</a></div>-->
<!--            <ul id="sidebarMenu">-->
<!--                <li class="side-menu"><a href="index.php?act=member_goodsbrowse&amp;op=list&amp;gc_id=530"-->
<!--                                         class=""><i></i>珠宝手表</a>-->
<!--                    <ul style="display: none;">-->
<!--                        <li class=""><a href="index.php?act=member_goodsbrowse&amp;op=list&amp;gc_id=540">钟表手表</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="side-menu"><a href="index.php?act=member_goodsbrowse&amp;op=list&amp;gc_id=1"-->
<!--                                         class=""><i></i>服饰鞋帽</a>-->
<!--                    <ul style="display: none;">-->
<!--                        <li class=""><a href="index.php?act=member_goodsbrowse&amp;op=list&amp;gc_id=4">女装</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>
    <div class="mt30 pagelist">
        <div class="pager">
            {$Page}
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        //清除单条浏览记录
        $("[nc_type='delbtn']").bind('click', function () {
            if (confirm("确实要删除吗？")) {
                var id = $(this).attr('data-id');
                $.getJSON("{:U('Member/Member/delBrowse')}", {id:id}, function (data) {
                    if (data.status == 'success') {
                        if (id == 'all') {
                            location.reload(true);
                        } else {
                            $("#browserow_" + id).hide();
                        }
                    } else {
                        showDialog(data.msg);
                    }
                });
            }
        });
    });
</script>
