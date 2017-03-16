<template file="Site/head.php"/>
<template file="Site/top.php"/>
<script>
    var delCartUrl = "{:U('Cart/Cart/delCart')}";
    var changeCartUrl = "{:U('Cart/Cart/change')}";
</script>
<link href="{$site_info.site_path}css/home_cart.css" rel="stylesheet" type="text/css">
<link href="{$site_info.enterprise_path}style/base.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{$site_info.site_path}js/goods_cart.js"></script>
</head>
<body>

<header class="ncc-head-layout">
    <div class="site-logo"><a href="/"><img src="" class="pngFix"></a>
    </div>
    <ul class="ncc-flow">
        <li class=""><i class="step1"></i>

            <p>我的购物车</p>
            <sub></sub>

            <div class="hr"></div>
        </li>
        <li class="current"><i class="step2"></i>

            <p>确认订单</p>
            <sub></sub>

            <div class="hr"></div>
        </li>
        <li class=""><i class="step3"></i>

            <p>支付提交</p>
            <sub></sub>

            <div class="hr"></div>
        </li>
        <li class=""><i class="step4"></i>

            <p>订单完成</p>
            <sub></sub>

            <div class="hr"></div>
        </li>
    </ul>
</header>
<div class="ncc-wrapper">
    <form method="post" id="order_form" name="order_form" action="http://shopwwi.local.com/shop/index.php">

        <!-- S fcode -->
        <!-- E fcode -->

        <div class="ncc-main">
            <div class="ncc-title">
                <h3>确认订单</h3>
                <h5>请仔细核对填写收货、发票等信息，以确保物流快递及时准确投递。</h5>
            </div>

                <div class="ncc-receipt-info <if condition="$address['on_address'] eq 1">current_box</if>">
                    <div class="ncc-receipt-info-title">
                        <h3>收货人信息</h3>
                        <a href="javascript:void(0)" nc_type="buy_edit" id="edit_reciver" style="display: inline-block;">[修改]</a></div>
                    <div id="addr_list" class="ncc-candidate-items">
                        <ul>
                            <if condition="$address['on_address'] neq 1">
                                <li>
                                    <span class="true-name">{$default_address.full_name}</span>
                                    <span class="address">{$default_address.province_name} {$default_address.city_name} {$default_address.area_name}&nbsp;{$default_address.address}</span>
                                    <span class="phone"><i class="icon-mobile-phone"></i>{$default_address.mobile_phone|default=$default_address.phone}</span>
                                </li>
                            <else/>
                                <volist name="address.list" id="v">
                                    <li class="receive_add address_item <if condition="$v['id'] eq $default_address['id']">ncc-selected-item</if>">
                                        <input id="addr_{$v.id}" nc_type="addr" type="radio" class="radio" name="addr" value="{$v.id}" <if condition="$v['id'] eq $default_address['id']">checked="checked"</if>>
                                        <label for="addr_{$v.id}">
                                            <span class="true-name">{$v.full_name}</span>
                                            <span class="address">{$v.province_name} {$v.city_name} {$v.area_name}&nbsp;{$v.address}</span>
                                            <if condition="$v['mobile_phone'] neq ''">
                                                <span class="phone"><i class="icon-mobile-phone"></i>{$v.mobile_phone}</span>
                                            </if>
                                            <if condition="$v['phone'] neq ''">
                                                <span class="phone"><i class="icon-phone"></i>{$v.phone}</span>
                                            </if>
                                        </label>
                                        <a href="javascript:void(0);" onclick="delAddr({$v.id});" class="del">[ 删除 ]</a>
                                    </li>
                                </volist>
                            </if>
                        </ul>
                    </div>
                </div>
            <div class="ncc-receipt-info" id="paymentCon">
                <div class="ncc-receipt-info-title">
                    <h3>支付方式</h3>
                </div>
                <div class="ncc-candidate-items">
                    <ul>
                        <li>微信扫码支付</li>
                    </ul>
                </div>
                <div id="payment_list" class="ncc-candidate-items" style="display:none">
                    <ul>
                        <li>
                            <input type="radio" value="online" name="payment_type" id="payment_type_online">
                            <label for="payment_type_online">在线支付</label>
                        </li>
                        <li>
                            <input type="radio" value="offline" name="payment_type" id="payment_type_offline">
                            <label for="payment_type_offline">货到付款</label>
                            <a id="show_goods_list" style="display: none" class="ncc-payment-showgoods"
                               href="javascript:void(0);"><i class="icon-truck"></i>货到付款 (<span data-cod-nums="offline">0</span>种商品)
                                + <i class="icon-credit-card"></i>在线支付 (<span data-cod-nums="online">0</span>种商品)</a>
                        </li>
                    </ul>
                    <div class="hr16"><a href="javascript:void(0);" class="ncbtn ncbtn-grapefruit"
                                         id="hide_payment_list">保存支付方式</a></div>
                </div>
                <div id="ncc-payment-showgoods-list" class="ncc-payment-showgoods-list">
                    <dl>
                        <dt data-hideshow="offline">货到付款</dt>
                        <dd data-hideshow="offline" data-cod2-type="offline">
                        </dd>
                        <dt data-hideshow="online">在线支付</dt>
                        <dd data-hideshow="online" data-cod2-type="online">
                        </dd>
                    </dl>
                </div>
            </div>

            <!-- 在线支付和货到付款组合时，显示弹出确认层内容 -->
            <div id="confirm_offpay_goods_list" style="display: none;">
                <dl class="ncc-offpay-list" data-hideshow="offline">
                    <dt>以下商品支持<strong>货到付款</strong></dt>
                    <dd>
                        <ul data-cod-type="offline">
                        </ul>
                        <label>
                            <input type="radio" value="" checked="checked">
                            货到付款
                        </label>
                    </dd>
                </dl>
                <dl class="ncc-offpay-list" data-hideshow="online">
                    <dt>以下商品支持<strong>在线支付</strong></dt>
                    <dd>
                        <ul data-cod-type="online">
                        </ul>
                        <label>
                            <input type="radio" value="" checked="checked">
                            在线支付
                        </label>
                    </dd>
                </dl>

                <div class="tc mt10 mb10">
                    <a href="javascript:void(0);" class="ncbtn ncbtn-bittersweet" id="close_confirm_button">确认支付方式</a>
                </div>
            </div>
<!--            <div class="ncc-receipt-info">-->
<!--                <div class="ncc-receipt-info-title">-->
<!--                    <h3>发票信息</h3>-->
<!--                    <a href="javascript:void(0)" nc_type="buy_edit" id="edit_invoice"-->
<!--                       style="display: none;">[修改]</a><font color="#B0B0B0">如需修改，请先保存收货人信息 </font></div>-->
<!--                <div id="invoice_list" class="ncc-candidate-items">-->
<!--                    <ul>-->
<!--                        <li>不需要发票</li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->

            <div class="ncc-receipt-info">
                <div class="ncc-receipt-info-title">
                    <h3>商品清单</h3>
                </div>
                <table class="ncc-table-style">
                    <thead>
                    <tr>
                        <th class="w50"></th>
                        <th></th>
                        <th>商品</th>
                        <th class="w150">单价(元)</th>
                        <th class="w100">数量</th>
                        <th class="w150">小计(元)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <volist name="info.carts" id="vo" key="k">
                        <tr id="cart_item_{$vo.cart_id}" class="shop-list ">
                            <td class="td-border-left">
                                <input type="hidden" value="{$vo.cart_id}" name="cart_id[]">
                            </td>
                            <td class="w100">
                                <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}" target="_blank" class="ncc-goods-thumb">
                                    <img src="{$vo.goods_thumb}" alt="{$vo.goods_name}">
                                </a>
                            </td>
                            <td class="tl">
                                <dl class="ncc-goods-info">
                                    <dt>
                                        <a href="{:U('Site/Goods/product', array('gid' => $vo['goods_id']))}" target="_blank">{$vo.goods_name}</a>
                                    </dt>
                                    <dd class="goods-spec"></dd>
                                </dl>
                            </td>
                            <td>
                                <em class="goods-price">{$vo.price|cur}</em>
                            </td>
                            <td>{$vo.goods_num}</td>
                            <td class="td-border-right">
                                <em cart_id="11" goods_id="100008" nc_type="eachGoodsTotal1" tpl_id="0" class="goods-subtotal">{$vo.goods_subtotal|cur}</em>
                                <span id="no_send_tpl_0" style="color: #F00;display:none">无货</span>
                            </td>
                        </tr>
                    </volist>

                    <tr>
                        <td colspan="20">
                            <div class="ncc-msg">买家留言：
                                <textarea id="recom" name="recom" class="ncc-msg-textarea" placeholder="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）" title="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）" maxlength="150"></textarea>
                            </div>
                            <div class="ncc-store-account">
                                <dl>
                                    <dt>商品金额：</dt>
                                    <dd class="rule"></dd>
                                    <dd class="sum"><em id="eachStoreGoodsTotal">{$info.goods_total|cur}</em></dd>
                                </dl>

                                <dl>
                                    <dt>物流运费：</dt>
                                    <dd class="rule">
                                    </dd>
                                    <dd class="sum"><em nc_type="eachStoreFreight" id="eachStoreFreight">{$info.freight|cur}</em>
                                    </dd>
                                </dl>
<!--                                <dl class="total">-->
<!--                                    <dt>本店合计：</dt>-->
<!--                                    <dd class="rule"></dd>-->
<!--                                    <dd class="sum"><em store_id="1" nc_type="eachStoreTotal">{$info.total|cur}</em>元</dd>-->
<!--                                </dl>-->
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>

                    <tr>
                        <td colspan="20">
                            <a href="{:U('Cart/Cart/index')}" class="ncc-prev-btn"><i class="icon-angle-left"></i>返回购物车</a>
                            <div class="ncc-all-account">订单总金额：<em id="orderTotal">{$info.total|cur}</em>元</div>
                            <a href="javascript:void(0)" id="submitOrder" class="ncc-next-submit <if condition="$address['on_address'] neq 1">ok</if>">提交订单</a>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- 收货地址ID -->
            <input value="{$default_address.id|default=''}" name="address_id" id="address_id" type="hidden">
            <input type="hidden" name="carts" value="{$carts}">
        </div>
    </form>

</div>
<script type="text/javascript" src="{$site_info.common_path}js/jquery.poshytip.min.js" charset="utf-8"></script>

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
    };
    fade();
</script>
<script type="text/html" id="area-html">
    <select id="{{area_type}}" class="valid">
        <option value="">-请选择-</option>
        {{if areas}}
        {{each areas as v i}}
        <option value="{{i}}">{{v}}</option>
        {{/each}}
        {{/if}}
    </select>
</script>
<script type="text/html" id="add-address-html">
    <div id="add_addr_box">
        <div class="ncc-form-default">
            <form method="POST" id="addr_form" action="">
                <dl>
                    <dt><i class="required">*</i>收货人姓名：</dt>
                    <dd>
                        <input type="text" class="text w100" name="full_name" maxlength="20" id="full_name">
                    </dd>
                </dl>
                <dl>
                    <dt><i class="required">*</i>所在地区：</dt>
                    <dd>
                        <div id="select-area"></div>
                    </dd>
                    <input type="hidden" name="province_id" id="province_id">
                    <input type="hidden" name="city_id" id="city_id">
                    <input type="hidden" name="area_id" id="area_id">
                </dl>
                <dl>
                    <dt><i class="required">*</i>详细地址：</dt>
                    <dd>
                        <input type="text" class="text w500" name="address" id="address" maxlength="80">

                        <!--                                            <p class="hint">请填写真实地址，不需要重复填写所在地区</p>-->
                    </dd>
                </dl>
                <dl>
                    <dt><i class="required">*</i>手机号码：</dt>
                    <dd>
                        <input type="text" class="text w200" name="mobile_phone" id="mobile_phone" maxlength="15" value="">
                        &nbsp;&nbsp;(或)&nbsp;固定电话：
                        <input type="text" class="text w200" id="phone" name="phone" maxlength="20" value="">
                    </dd>
                </dl>
            </form>
        </div>

    </div>
    <div class="hr16">
    <a id="hide_addr_list" class="ncbtn ncbtn-grapefruit" href="javascript:void(0);">保存收货人信息</a>
    </div>
</script>
<script type="text/html" id="select-address-html">
    {{each address as v i}}
    <li class="receive_add address_item">
        <input id="addr_{{v.id}}" nc_type="addr" type="radio" class="radio" name="addr" value="{{v.id}}">
        <label for="addr_{{v.id}}">
            <span class="true-name">{{v.full_name}}</span>
            <span class="address">{{v.province_name}} {{v.city_name}} {{v.area_name}}&nbsp;{{v.address}}</span>
            {{if v.mobile_phone}}
            <span class="phone"><i class="icon-mobile-phone"></i>{{v.mobile_phone}}</span>
            {{/if}}
            {{if v.phone}}
            <span class="phone"><i class="icon-phone"></i>{{v.phone}}</span>
            {{/if}}
        </label>
        <a href="javascript:void(0);" onclick="delAddr({{v.id}});" class="del">[ 删除 ]</a>
    </li>
    {{/each}}
    <li class="receive_add addr_item">
        <input value="0" nc_type="addr" id="add_addr" type="radio" name="addr" checked="checked">
        <label for="add_addr">使用新地址</label>&nbsp;
        <label>
            <a class="del" href="{:U('Member/Address/index')}" target="_blank">管理自提服务站 </a>
        </label>
    </li>
</script>
<script type="text/javascript">
    var area_json;
    $(function () {
        $('[nctype="mcard"]').membershipCard({type: 'shop'});
        //保存收货人信息
        $(document).on('click', '#hide_addr_list', function () {
            //选择收货地址
            if($('#addr_list .ncc-selected-item').length != 0){
                var addr_id = $('.ncc-selected-item').find('input[name=addr]').val();
                var address_json = {$address_json};
                var address = address_json[addr_id];
                selectAddress(address);
                return;
            }
            var data = {};
            var selLength = $('.valid').length;
            data.full_name = $('#full_name').val();
            data.address = $('#address').val();
            data.mobile_phone = $('#mobile_phone').val();
            data.phone = $('#phone').val()
            data.province = $('#province_id').val();
            data.city     = $('#city_id').val();
            data.area     = $('#area_id').val();
            if($.trim(data.full_name) == ''){
                $('#full_name').parent('dd').find('label').remove();
                $('#full_name').parent('dd').append('<label for="true_name" class="error"><i class="icon-exclamation-sign"></i>请填写收货人姓名</label>');
                $('#full_name').addClass('error');
            } else {
                $('#full_name').removeClass('error');
                $('#full_name').parent('dd').find('label').remove();
            }
            if(selLength <= 2){
                if(!data.province || !data.city){
                    $('.valid').parent('div').find('.error').remove();
                    $('.valid').parent('div').append('<label for="region" class="error"><i class="icon-exclamation-sign"></i>请将地区选择完整</label>');;
                } else {
                    data.province_name = $("#province").find("option:selected").text();
                    data.city_name = $("#city").find("option:selected").text();
                    delete data.area;
                    $('.valid').parent('div').find('.error').remove();
                }
            } else if(selLength == 3){
                if(!data.province || !data.city || !data.area){
                    $('.valid').parent('div').find('.error').remove();
                    $('.valid').parent('div').append('<label for="region" class="error"><i class="icon-exclamation-sign"></i>请将地区选择完整</label>');;
                } else {
                    data.province_name = $("#province").find("option:selected").text();
                    data.city_name = $("#city").find("option:selected").text();
                    data.area_name = $("#area").find("option:selected").text();
                    $('.valid').parent('div').find('.error').remove();
                }
            }
            if($.trim(data.address) == ''){
                $('#address').parent('dd').find('label').remove();
                $('#address').parent('dd').append('<label for="address" class="error"><i class="icon-exclamation-sign"></i>请填写收货人详细地址</label>');
                $('#address').addClass('error');
            } else {
                $('#address').removeClass('error');
                $('#address').parent('dd').find('label').remove();
            }
            if($.trim(data.mobile_phone) == '' && $.trim(data.phone) == ''){
                $('#phone').parent('dd').find('label').remove();
                $('#phone').parent('dd').append('<label for="phone" class="error"><i class="icon-exclamation-sign"></i>手机号码或固定电话请至少填写一个</label>');
                $('#mobile_phone').addClass('error');
                $('#phone').addClass('error');
            } else {
                $('#mobile_phone').removeClass('error');
                $('#phone').removeClass('error');
                $('#phone').parent('dd').find('label').remove();
            }
            if($('.error').length > 0){
                return false;
            }
            $.post("{:U('Member/Address/addAddress')}",data, function (res) {
                console.log(res)
                selectAddress(res.data);
                return;
            },'json')

        })

        //获取地理位置
        function getArea(){
            $.getJSON("{:U('Member/Address/getArea')}", function (res) {
                area_json = res.data.area;
                //设置省
                var province_data = {area_type:'province',areas:area_json.province};
                var province_html = template('area-html', province_data);
                $('#select-area').html(province_html);
            })
        }
        //是否存在地区
        var on_address = "{$address.on_address}";
        if(on_address == 1){
            getArea();
        }
        //地区选择
        $(document).on('change','#province', function () {
            var province_id = $(this).val();
            var city_data = {area_type:'city',areas:area_json.city[province_id]};
            var city_html = template('area-html', city_data);
            $('#select-area').find('.error').remove();
            $('#city').remove();
            $('#area').remove();
            $('#select-area').append(city_html);
            $('#province_id').val(province_id);
            $('#city_id').val('');
            $('#area_id').val('');
        })
        $(document).on('change','#city', function () {
            var city_id = $(this).val();
            $('#select-area').find('.error').remove();
            if(area_json.area[city_id] != undefined){
                var area_data = {area_type:'area',areas:area_json.area[city_id]};
                var area_html = template('area-html', area_data);
                $('#area').remove();
                $('#select-area').append(area_html);
            }
            $('#city_id').val(city_id);
            $('#area_id').val('');
        })
        $(document).on('change','#area', function () {
            $('#select-area').find('.error').remove();
            $('#area_id').val($(this).val());

        })
        //加载收货地址列表
        $('#edit_reciver').on('click', function () {
            var address_json = {$address_json};
            if(address_json){
                var address = {address:address_json};
                var address_html = template('select-address-html', address);
            }
            $(this).hide();
            var add_address_html = template('add-address-html');
            $(this).parents('.ncc-receipt-info ').addClass('current_box');
            $('#addr_list ul').html(address_html);
            $('#addr_list').append(add_address_html);
            $('#submitOrder').removeClass('ok');
            getArea();

        });
        //切换收货地址
        $(document).on('click', '#addr_list .receive_add', function () {
            $(this).siblings().removeClass('ncc-selected-item')
            if(!$(this).hasClass('addr_item')){
                $(this).addClass('ncc-selected-item');
            }
        })

        //创建订单
        $('#submitOrder').click(function () {
            var _this = $(this);
            //判断是否可提交
            if(!_this.hasClass('ok')){
                return false;
            }
            var data = {};
            var address_id = $('#address_id').val();
            data.carts = $('input[name=carts]').val();
            data.recom      = $('#recom').val();
            if($('.receive_add').length != 0){
                showDialog('请选择收货地址', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            }
            if(!address_id){
                showDialog('请选择收货地址', 'alert', '错误信息', null, true, null, '', '', '', 3);
                return;
            } else {
                data.address_id = address_id;
            }
            ShowBox('急救包', 'id');
            $.ajax({
                type:"post",
                data:data,
                url:"{:U('Order/Order/createorder')}",
                dataType:"json",
                success: function (res) {
                    if(res.status == 'success'){
                        ShowBox(res.data, 'id');
//                        showDialog(res.msg, 'succ', '提示信息', null, true, null, '', '', '', 3);
//                        setTimeout(function () {
//                            window.location.href = res.url;
//                        },1200)
                    } else {
                        showDialog(res.msg, 'alert', '错误信息', null, true, null, '', '', '', 3);
                        setTimeout(function () {
                            window.location.href = res.url;
                        },1200)
                    }
                }
            })
        })
        //选择收货地址
        function selectAddress(address){
            var html = '<ul>';
            html += '<li> <span class="true-name">' + address.full_name + ' </span> ' +
                    '<span class="address">' + address.province_name + address.city_name + address.area_name + '&nbsp;' + address.address + '</span> ';
            if(address.mobile_phone){
                html += '<span class="phone"><i class="icon-mobile-phone"></i> ' + address.mobile_phone + '</span> ';
            }
            if(address.phone){
                html += '<span class="phone"><i class="icon-phone"></i>' + address.phone + '</span> ';
            }
            html += '</li>';
            $('.current_box').removeClass('current_box');
            $('#edit_reciver').show();
            $('#addr_list').html(html);
            //设置收货地区ID
            $("#address_id").val(address.id);
            orderSubmit();
            return false;
        }
        //订单确定
        function orderSubmit(){
            $('#submitOrder').addClass('ok');
        }

        //提示信息
        $('.tip').poshytip({
            className: 'tip-yellowsimple',
            showOn: 'hover',
            alignTo: 'target',
            alignX: 'center',
            alignY: 'top',
            offsetX: 0,
            offsetY: 5,
            allowTipHover: false
        });

        function ShowBox(data, id) {

            $("body").append(data.pay_code)
            $(".closeMonthBox .closeBox").unbind("click");
            $(".closeMonthBox .closeBox").bind("click", function () {
                $(".ShowBox").remove();
            })
        }
    });
</script>
<template file="Site/footer_simple.php"/>
</body>
</html>