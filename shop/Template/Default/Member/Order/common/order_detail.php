<div class="ncm-oredr-show">
    <div class="ncm-order-info">
        <div class="ncm-order-details">
            <div class="title">订单信息</div>
            <div class="content">
                <dl>
                    <dt>收货地址：</dt>
                    <dd><span>{$consignee}，</span><span>{$mobile_phone}，</span><span>{$province} {$city} {$area} {$address}</span></dd>
                </dl>
<!--                <dl>-->
<!--                    <dt>发&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;票：</dt>-->
<!--                    <dd>-->
<!--                    </dd>-->
<!--                </dl>-->
                <dl>
                    <dt>买家留言：</dt>
                    <dd>{$recom}</dd>
                </dl>
                <dl class="line">
                    <dt>订单编号：</dt>
                    <dd>{$order_sn}<a href="javascript:void(0);">更多<i class="icon-angle-down"></i>

                            <div class="more"><span class="arrow"></span>
                                <ul>
                                    <li>支付方式：<span>
                                            <if condition="$payment eq 'alipay'">支付宝
                                                <elseif condition="$payment eq 'bank_card'" />银行卡
                                                <elseif condition="$payment eq 'cash'" />现金
                                                <elseif condition="$payment eq 'wxpay'" />微信支付
                                            </if>
                                        </span></li>
                                    <li>下单时间：<span>{$addtime|date='Y-m-d H:i:s',###}</span></li>
                                </ul>
                            </div>
                        </a></dd>
                </dl>
<!--                <dl>-->
<!--                    <dt>商&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家：</dt>-->
<!--                    <dd>我的店铺<a href="javascript:void(0);">更多<i class="icon-angle-down"></i>-->
<!---->
<!--                            <div class="more"><span class="arrow"></span>-->
<!--                                <ul>-->
<!--                                    <li>所在地区：<span>&nbsp;</span></li>-->
<!--                                    <li>联系电话：<span></span></li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </a>-->
<!---->
<!--                        <div class="msg"><span member_id="1"></span>-->
<!--                            <!-- wang wang -->-->
<!--                        </div>-->
<!--                    </dd>-->
<!--                </dl>-->
            </div>
        </div>
        <div class="ncm-order-condition">
            <if condition="$order_status eq '0'">
                <!-- 订单未付款 -->
                <dl>
                    <dt><i class="icon-ok-circle green"></i>订单状态：</dt>
                    <dd> 订单已经提交，等待买家付款</dd>
                </dl>
                <ul>
                    <li>1. 您尚未对该订单进行支付，请
                        <a href="{:U('Order/Order/pay')}" class="ncbtn-mini ncbtn-bittersweet"><i></i>支付订单</a>以确保商家及时发货。
                    </li>
                    <li>2. 如果您不想购买此订单的商品，请选择<a href="#order-step" class="ncbtn-mini">取消订单</a>操作。</li>
<!--                    <li>3. 如果您未对该笔订单进行支付操作，系统将于-->
<!--                        <time>2016-10-29 18:28:26</time>-->
<!--                        自动关闭该订单。-->
<!--                    </li>-->
                </ul>
            <elseif condition="$order_status eq '1'" />
                <!-- 订单已完成 -->

            <elseif condition="$order_status eq '5'" />
                <!-- 订单取消 -->
                <dl>
                    <dt><i class="icon-off orange"></i>订单状态：</dt>
                    <dd>交易关闭</dd>
                </dl>
                <ul>
                    <volist name="order_log" id="v">
                        <li>买家 于 {$v.created|date='Y-m-d H:i:s',###} 取消了订单 ( {$v.cancel_msg} )</li>
                    </volist>
                </ul>
            </if>
        </div>
<!--        <div class="mall-msg">有疑问可咨询-->
<!--            <a href="javascript:void(0);" onclick="ajax_form('mall_consult', '平台客服', 'index.php?act=member_mallconsult&amp;op=add_mallconsult&amp;inajax=1', 640);">-->
<!--                <i class="icon-comments-alt"></i>平台客服-->
<!--            </a>-->
<!--        </div>-->
    </div>
    <div class="ncm-order-contnet">
        <table class="ncm-default-table order" id="order-step">
            <thead>
            <tr>
                <th class="w10"></th>
                <th colspan="2">商品名称</th>
                <th class="w20"></th>
                <th class="w120 tl">单价（元）</th>
                <th class="w60">数量</th>
<!--                <th class="w100">优惠活动</th>-->
<!--                <th class="w100">售后维权</th>-->
                <th class="w100">交易状态</th>
                <th class="w100">交易操作</th>
            </tr>
            </thead>
            <tbody>
            <volist name="items" id="vo" key="k">
                <tr class="bd-line">
                    <td>&nbsp;</td>
                    <td class="w70">
                        <div class="ncm-goods-thumb">
                            <a target="_blank" href="{:U('Site/Goods/product',array('gid' => $vo['goods_id']))}">
                                <img src="{$vo.goods_thumb}" onmouseover="toolTip('<img src={$vo.goods_thumb}>')" onmouseout="toolTip()">
                            </a>
                        </div>
                    </td>
                    <td class="tl">
                        <dl class="goods-name">
                            <dt>
                                <a target="_blank" href="{:U('Site/Goods/product',array('gid' => $vo['goods_id']))}">{$vo.goods_name}</a>
                            </dt>
                        </dl>
                    </td>
                    <td></td>
                    <td class="tl refund"><if condition="$vo['sku_id'] eq ''">{$vo.goods_price|cur}<else/>{$vo.attr_price|cur}</if><p class="green">
                        </p></td>
                    <td>{$vo.goods_num}</td>
<!--                    <td>-->
<!---->
<!--                    </td>-->

                    <!-- S 合并TD -->
                    <if condition="$k eq 1">
                        <td class="bdl bdr" rowspan="{$items_num}">
                            <if condition="$order_status eq '0'">待付款</if>
                            <if condition="$order_status eq '1'">已完成</if>
                            <if condition="$order_status eq '2'">待发货</if>
                            <if condition="$order_status eq '3'">待收货</if>
                            <if condition="$order_status eq '4'">退货/款</if>
                            <if condition="$order_status eq '5'">已取消</if>
                        </td>
                        <td rowspan="{$items_num}">
                            <!-- 取消订单 -->

                            <p><a href="javascript:void(0)" style="color:#F30; text-decoration:underline;" nc_type="dialog" dialog_width="480" dialog_title="取消订单" dialog_id="buyer_order_cancel_order" uri="{:U('Member/Order/change_state',array('oid' => $order_id))}" id="order_action_cancel">取消订单</a></p>
                            <!-- 退款取消订单 -->


                            <!-- 收货 -->


                            <!-- 评价 -->


                            <!-- 已经评价 -->


                            <!-- 分享  -->

                            <!--                    <p><a href="javascript:void(0)" nc_type="sharegoods" data-param="{&quot;gid&quot;:&quot;100001&quot;}">分享商品</a></p>-->
                        </td>
                        <!-- E 合并TD -->
                    </if>
                </tr>
            </volist>

            <!-- S 赠品列表 -->
            <!-- E 赠品列表 -->

            </tbody>
            <tfoot>
            <tr>
                <td colspan="20">
                    <dl class="freight">
                        <dd>
                            <if condition="$shipping_fee eq 0">（免运费） <else/>（运费：￥{$shipping_fee|cur}）</if>
                        </dd>
                    </dl>
                    <dl class="sum">
                        <dt>订单应付金额：</dt>
                        <dd><em>{$pay_fee|cur}</em>元</dd>
                    </dl>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>