<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="active"><a href="index.php?act=member_order">订单列表</a></li>
<!--            <li class="normal"><a href="index.php?act=member_order&amp;recycle=1">回收站</a></li>-->
        </ul>
    </div>
    <form method="post" action="{:U('Member/Order/index')}" target="_self">
        <table class="ncm-search-table">
            <tbody>
            <tr>
                <td>&nbsp;</td>
                <th>订单状态</th>
                <td class="w100"><select name="status_type">
                        <option value="all" <if condition="$status_type eq ''">selected</if>>所有订单</option>
                        <option value="0" <if condition="$status_type eq '0'">selected</if>>待付款</option>
                        <option value="2" <if condition="$status_type eq '2'">selected</if>>待发货</option>
                        <option value="3" <if condition="$status_type eq '3'">selected</if>>待收货</option>
                        <option value="1" <if condition="$status_type eq '1'">selected</if>>已完成</option>
                        <option value="4" <if condition="$status_type eq '4'">selected</if>>退货/款</option>
                        <option value="5" <if condition="$status_type eq '5'">selected</if>>已取消</option>
                    </select></td>
<!--                <th>下单时间</th>-->
<!--                <td class="w240">-->
<!--                    <input type="text" class="text w70 hasDatepicker" name="query_start_date" id="query_start_date" value="" readonly="readonly">-->
<!--                    <label class="add-on"><i class="icon-calendar"></i></label>&nbsp;–&nbsp;<input type="text" class="text w70 hasDatepicker" name="query_end_date" id="query_end_date" value="" readonly="readonly">-->
<!--                    <label class="add-on"><i class="icon-calendar"></i></label>-->
<!--                </td>-->
                <th>订单号</th>
                <td class="w160">
                    <input type="text" class="text w150" name="order_sn" value="{$search_sn}">
                </td>
                <td class="w70 tc">
                    <label class="submit-border">
                        <input type="submit" class="submit" value="搜索">
                    </label>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <table class="ncm-default-table order">
        <thead>
        <tr>
            <th class="w10"></th>
            <th colspan="2">商品</th>
            <th class="w90">单价（元）</th>
            <th class="w40">数量</th>
<!--            <th class="w90">优惠活动</th>-->
<!--            <th class="w90">售后维权</th>-->
            <th class="w110">订单金额</th>
            <th class="w90">交易状态</th>
            <th class="w120">交易操作</th>
        </tr>
        </thead>

        <if condition="$orders neq ''">
            <volist name="orders" id="vo" key="ko">
            <tbody <if condition="$vo['order_status'] eq '0'">class="pay"</if>>
            <tr>
                <td colspan="19" class="sep-row"></td>
            </tr>
            <if condition="$vo['order_status'] eq '0'">
                <tr>
                    <td colspan="19" class="pay-td">
                <span class="ml15">在线支付金额：
                    <em>￥{$vo.pay_fee|cur}</em>
                </span>
                        <a class="ncbtn ncbtn-bittersweet fr mr15" href="{:U('Order/Order/pay', array('order_sn' => $vo['order_sn']))}">
                            <i class="icon-shield"></i>订单支付
                        </a>
                    </td>
                </tr>
            </if>

            <tr>
                <th colspan="19">
                <span class="ml10">
                  <!-- order_sn -->
                  订单号：{$vo.order_sn}
                </span>
                    <!-- order_time -->
                    <span>下单时间：{$vo.addtime|date='Y-m-d H:i:s',###}</span>

                    <!-- store_name -->
                    <!--                <span>-->
                    <!--                    <a href="http://shopwwi.local.com/shop/index.php?act=show_store&amp;op=index&amp;store_id=1" title="我的店铺">我的店铺</a>-->
                    <!--                </span>-->
                    <if condition="$vo['order_status'] neq '0'">
                        <a href="javascript:void(0);" class="share-goods" onclick="ajax_get_confirm('您确定要删除吗?删除后该订单不可恢复！', '{:U(\"Order/Order/delOrder\", array(\"oi\d" => $vo[\"order_id\"]))}');"><i class="icon-trash"></i>删除</a>
                    </if>
                    <!-- QQ -->
                    <!--          <span member_id="1">wang wang</span>-->
                    <!--                <a href="javascript:void(0)" class="share-goods" nc_type="sharegoods" data-param="{&quot;gid&quot;:&quot;100004&quot;}">-->
                    <!--                    <i class="icon-share"></i>分享-->
                    <!--                </a>-->

                    <!-- 放入回收站 -->

                    <!-- 还原订单 -->

                </th>
            </tr>

            <!-- S 商品列表 -->
            <volist name="vo.items" id="item" key="key">
            <tr>
                <td class="bdl"></td>
                <td class="w70">
                    <div class="ncm-goods-thumb">
                        <a href="{:U('Site/Goods/product', array('gid' => $item['goods_id']))}" target="_blank">
                            <img src="{$item.goods_thumb}" onmouseover="toolTip('<img src={$item.goods_thumb}>')" onmouseout="toolTip()">
                        </a>
                    </div>
                </td>
                <td class="tl">
                    <dl class="goods-name">
                        <dt>
                            <a href="{:U('Site/Goods/product', array('gid' => $item['goods_id']))}" target="_blank">{$item.goods_name}</a>
                        <span class="rec">
<!--                            <a target="_blank" href="">[交易快照]</a>-->
                        </span>
                        </dt>
                        <!-- 消费者保障服务 -->
                    </dl>
                </td>
                <td>
                    <if condition="$item['sku_id'] eq ''">{$item.goods_price|cur}<else/>{$item.attr_price|cur}</if>
                    <p class="green"></p>
                </td>
                <td>1</td>
                <if condition="$key eq 1">
                    <!-- S 合并TD -->
                    <td class="bdl" rowspan="{$vo.items_count}"><p class=""><strong>{$vo.pay_fee|cur}</strong></p>

                        <p class="goods-freight"><if condition="$vo['shipping_fee'] eq 0">（免运费） <else/>（运费：￥{$vo.shipping_fee|cur}）</if></p>
                        <if condition="$vo['payment'] eq 'alipay'">
                            <p title="支付方式：支付宝">支付宝</p>
                            <elseif condition="$vo['payment'] eq 'bank_card'" />
                            <p title="支付方式：银行卡">银行卡</p>
                            <elseif condition="$vo['payment'] eq 'cash'" />
                            <p title="支付方式：现金">现金</p>
                            <elseif condition="$vo['payment'] eq 'wxpay'" />
                            <p title="支付方式：微信支付">微信支付</p>
                        </if>

                    </td>
                    <td class="bdl" rowspan="{$vo.items_count}">
                        <p></p>

                        <!-- 订单查看 -->

                        <p><a href="{:U('Member/Order/orderDetail', array('oid' => $vo['order_id']))}" target="_blank">订单详情</a></p>

                        <!-- 物流跟踪 -->

                    </td>
                    <td class="bdl bdr" rowspan="{$vo.items_count}"><!-- 永久删除 -->

                        <!-- 锁定-->


                        <!-- 取消订单 -->
                        <if condition="$vo['order_status'] eq '0'">
                            <p>
                                <a href="javascript:void(0)" class="ncbtn ncbtn-grapefruit" nc_type="dialog" dialog_width="480" dialog_title="取消订单" dialog_id="buyer_order_cancel_order" uri="{:U('Member/Order/change_state',array('oid' => $vo['order_id']))}" id="order{$vo.order_id}_action_cancel">
                                    <i class="icon-ban-circle"></i> 取消订单
                                </a>
                            </p>
                        </if>
                    </td>
                    <!-- E 合并TD -->
                </if>
            </volist>

            </tr>

            </tbody>
            </volist>

            <tfoot>
            <tr>
                <td colspan="19">
                    <div class="mt30 pagelist">
                        <div class="pager">
                            {$Page}
                        </div>
                    </div>
                </td>
            </tr>
            </tfoot>
        <else/>
            <template file="Member/Member/common/empty.php"/>
        </if>
    </table>
</div>
<script charset="utf-8" type="text/javascript" src="{$site_info.site_path}js/zh-CN.js"></script>
<script charset="utf-8" type="text/javascript" src="{$site_info.site_path}js/sns.js"></script>
<script type="text/javascript">
    $(function () {
        $('#query_start_date').datepicker({dateFormat: 'yy-mm-dd'});
        $('#query_end_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
