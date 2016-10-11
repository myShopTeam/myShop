<template file="Site/head.php"/>
<template file="Site/top.php"/>
<script>
    var delCartUrl = "{:U('Cart/Cart/delCart')}";
    var changeCartUrl = "{:U('Cart/Cart/change')}";
</script>
<link href="{$site_info.site_path}css/home_cart.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{$site_info.site_path}js/goods_cart.js"></script>
<style id="poshytip-css-tip-yellowsimple" type="text/css">div.tip-yellowsimple {
        visibility: hidden;
        position: absolute;
        top: 0;
        left: 0;
    }

    div.tip-yellowsimple table, div.tip-yellowsimple td {
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        font-weight: inherit;
        font-style: inherit;
        font-variant: inherit;
    }

    div.tip-yellowsimple td.tip-bg-image span {
        display: block;
        font: 1px/1px sans-serif;
        height: 10px;
        width: 10px;
        overflow: hidden;
    }

    div.tip-yellowsimple td.tip-right {
        background-position: 100% 0;
    }

    div.tip-yellowsimple td.tip-bottom {
        background-position: 100% 100%;
    }

    div.tip-yellowsimple td.tip-left {
        background-position: 0 100%;
    }

    div.tip-yellowsimple div.tip-inner {
        background-position: -10px -10px;
    }

    div.tip-yellowsimple div.tip-arrow {
        visibility: hidden;
        position: absolute;
        overflow: hidden;
        font: 1px/1px sans-serif;
    }</style>
</head>
<body>

<header class="ncc-head-layout">
    <div class="site-logo"><a href="/"><img src="{$site_info.site_path}images/logo.png" class="pngFix"></a>
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

    <script type="text/javascript">
        //是否允许表单提交
        var SUBMIT_FORM = true;
        $(function () {
            $('select[nctype="voucher"]').on('change', function () {
                if ($(this).val() == '') {
                    $('#eachStoreVoucher_' + items[1]).html('-0.00');
                } else {
                    var items = $(this).val().split('|');
                    $('#eachStoreVoucher_' + items[1]).html('-' + number_format(items[2], 2));
                }
                calcOrder();
            });

            $('#rpt').on('change', function () {
                if (typeof allTotal == 'undefined') {
                    alert('系统正忙，请稍后再试');
                    return false
                }
                if ($(this).val() == '') {
                    $('#orderRpt').html('-0.00');
                    $('#orderTotal').html(allTotal.toFixed(2));
                } else {
                    var items = $(this).val().split('|');
                    $('#orderRpt').html('-' + number_format(items[1], 2));
                    var paytotal = allTotal - parseFloat(items[1]);
                    if (paytotal < 0) paytotal = 0;
                    $('#orderTotal').html(paytotal.toFixed(2));
                }
            });
        });
        function disableOtherEdit(showText) {
            $('a[nc_type="buy_edit"]').each(function () {
                if ($(this).css('display') != 'none') {
                    $(this).after('<font color="#B0B0B0">' + showText + '</font>');
                    $(this).hide();
                }
            });
            disableSubmitOrder();
        }
        function ableOtherEdit() {
            $('a[nc_type="buy_edit"]').show().next('font').remove();
            ableSubmitOrder();

        }
        function ableSubmitOrder() {
            $('#submitOrder').on('click', function () {
                submitNext()
            }).addClass('ok');
        }
        function disableSubmitOrder() {
            $('#submitOrder').unbind('click').removeClass('ok');
        }

    </script>
    <form method="post" id="order_form" name="order_form" action="http://shopwwi.local.com/shop/index.php">

        <!-- S fcode -->
        <!-- E fcode -->

        <div class="ncc-main">
            <div class="ncc-title">
                <h3>确认订单</h3>
                <h5>请仔细核对填写收货、发票等信息，以确保物流快递及时准确投递。</h5>
            </div>

            <div class="ncc-receipt-info current_box">
                <div class="ncc-receipt-info-title">
                    <h3>收货人信息</h3>
                    <a href="javascript:void(0)" nc_type="buy_edit" id="edit_reciver" style="display: none;">[修改]</a>
                </div>
                <div id="addr_list" class="ncc-candidate-items">
                    <ul>
                        <li class="receive_add addr_item">
                            <input value="0" nc_type="addr" id="add_addr" type="radio" name="addr" checked="checked">
                            <label for="add_addr">使用新地址</label>&nbsp;
                            <label>
                                <a class="del" href="" target="_blank">管理自提服务站 </a>
                            </label>
                        </li>
                        <div id="add_addr_box">
                            <div class="ncc-form-default">
                                <form method="POST" id="addr_form" action="http://shopwwi.local.com/shop/index.php">
                                    <input type="hidden" value="buy" name="act">
                                    <input type="hidden" value="add_addr" name="op">
                                    <input type="hidden" name="form_submit" value="ok">
                                    <dl>
                                        <dt><i class="required">*</i>收货人姓名：</dt>
                                        <dd>
                                            <input type="text" class="text w100" name="true_name" maxlength="20"
                                                   id="true_name" value="">
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><i class="required">*</i>所在地区：</dt>
                                        <dd>
                                            <div><select>
                                                    <option value="">-请选择-</option>
                                                    <option value="1">北京</option>
                                                    <option value="2">天津</option>
                                                    <option value="3">河北</option>
                                                    <option value="4">山西</option>
                                                    <option value="5">内蒙古</option>
                                                    <option value="6">辽宁</option>
                                                    <option value="7">吉林</option>
                                                    <option value="8">黑龙江</option>
                                                    <option value="9">上海</option>
                                                    <option value="10">江苏</option>
                                                    <option value="11">浙江</option>
                                                    <option value="12">安徽</option>
                                                    <option value="13">福建</option>
                                                    <option value="14">江西</option>
                                                    <option value="15">山东</option>
                                                    <option value="16">河南</option>
                                                    <option value="17">湖北</option>
                                                    <option value="18">湖南</option>
                                                    <option value="19">广东</option>
                                                    <option value="20">广西</option>
                                                    <option value="21">海南</option>
                                                    <option value="22">重庆</option>
                                                    <option value="23">四川</option>
                                                    <option value="24">贵州</option>
                                                    <option value="25">云南</option>
                                                    <option value="26">西藏</option>
                                                    <option value="27">陕西</option>
                                                    <option value="28">甘肃</option>
                                                    <option value="29">青海</option>
                                                    <option value="30">宁夏</option>
                                                    <option value="31">新疆</option>
                                                    <option value="32">台湾</option>
                                                    <option value="33">香港</option>
                                                    <option value="34">澳门</option>
                                                    <option value="35">海外</option>
                                                </select><input name="region" type="hidden" id="region" value="">
                                                <input type="hidden" name="city_id" id="_area_2">
                                                <input type="hidden" name="area_id" id="_area">
                                            </div>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><i class="required">*</i>详细地址：</dt>
                                        <dd>
                                            <input type="text" class="text w500" name="address" id="address"
                                                   maxlength="80" value="">

                                            <p class="hint">请填写真实地址，不需要重复填写所在地区</p>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><i class="required">*</i>手机号码：</dt>
                                        <dd>
                                            <input type="text" class="text w200" name="mob_phone" id="mob_phone" maxlength="15" value="">
                                            &nbsp;&nbsp;(或)&nbsp;固定电话：
                                            <input type="text" class="text w200" id="tel_phone" name="tel_phone" maxlength="20" value="">
                                        </dd>
                                    </dl>
                                </form>
                            </div>

                        </div>
                    </ul>
                    <div class="hr16"><a id="hide_addr_list" class="ncbtn ncbtn-grapefruit" href="javascript:void(0);">保存收货人信息</a>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                //隐藏收货地址列表
                function hideAddrList(addr_id, true_name, address, phone) {
                    $('#edit_reciver').show();
                    $("#address_id").val(addr_id);
                    $("#addr_list").html('<ul><li><span class="true-name">' + true_name + '</span><span class="address">' + address + '</span><span class="phone"><i class="icon-mobile-phone"></i>' + phone + '</span></li></ul>');
                    $('.current_box').removeClass('current_box');
                    ableOtherEdit();
                    $('#edit_payment').click();
                }
                //加载收货地址列表
                $('#edit_reciver').on('click', function () {
                    $(this).hide();
                    disableOtherEdit('如需修改，请先保存收货人信息 ');
                    $(this).parent().parent().addClass('current_box');
                    var url = SITEURL + '/index.php?act=buy&op=load_addr';
                    $('#addr_list').load(url);
                });
                //异步显示每个店铺运费 city_id计算运费area_id计算是否支持货到付款
                function showShippingPrice(city_id, area_id) {
                    $('#buy_city_id').val('');
                    $.post(SITEURL + '/index.php?act=buy&op=change_addr', {
                        'freight_hash': 'p_rTsBianFhh5DZLA0anwoqRK_ZJv1TplMxWxajGSnBJiNQFYeGs_ER2_7ApxSY54M93RhoKw4M6DbIDNLmIDfWI-3jJSWjySIl5FvStoGy6UwkFh26y5CI_RFgrUDyFwG7MCvUHhOfOm9e2iMB8--pzC-d5moc6wCYFwgY',
                        city_id: city_id,
                        'area_id': area_id
                    }, function (data) {
                        if (data.state == 'success') {
                            $('#buy_city_id').val(city_id ? city_id : area_id);
                            $('#allow_offpay').val(data.allow_offpay);
                            if (data.allow_offpay_batch) {
                                var arr = new Array();
                                $.each(data.allow_offpay_batch, function (k, v) {
                                    arr.push('' + k + ':' + (v ? 1 : 0));
                                });
                                $('#allow_offpay_batch').val(arr.join(";"));
                            }
                            $('#offpay_hash').val(data.offpay_hash);
                            $('#offpay_hash_batch').val(data.offpay_hash_batch);
                            var content = data.content;
                            var tpl_ids = data.no_send_tpl_ids;
                            no_send_tpl_ids = [];
                            no_chain_goods_ids = [];
                            for (var i in content) {
                                if (content[i] !== false) {
                                    $('#eachStoreFreight_' + i).html(number_format(content[i], 2));
                                } else {
                                    no_send_store_ids[i] = true;
                                }
                            }
                            for (var i in tpl_ids) {
                                no_send_tpl_ids[tpl_ids[i]] = true;
                            }
                            calcOrder();
                        } else {
                            showDialog('系统出现异常', 'error', '', '', '', '', '', '', '', '', 2);
                        }

                    }, 'json');
                }

                //根据门店自提站ID计算商品是否有库存（有库存即支持自提）
                function showProductChain(city_id) {
                    $('#buy_city_id').val('');
                    var product = [];
                    $('input[name="goods_id[]"]').each(function () {
                        product.push($(this).val());
                    });
                    $.post(SITEURL + '/index.php?act=buy&op=change_chain', {
                        chain_id: chain_id,
                        product: product.join('-')
                    }, function (data) {
                        if (data.state == 'success') {
                            $('#buy_city_id').val(city_id);
                            $('em[nc_type="eachStoreFreight"]').html('0.00');
                            no_send_tpl_ids = [];
                            no_chain_goods_ids = [];
                            if (data.product.length > 0) {
                                for (var i in data.product) {
                                    no_chain_goods_ids[data.product[i]] = true;
                                }
                            }
                            calcOrder();
                        } else {
                            showDialog('系统出现异常', 'error', '', '', '', '', '', '', '', '', 2);
                        }
                    }, 'json');
                }
                $(function () {
                    $('#edit_reciver').click();
                });
            </script>
            <div class="ncc-receipt-info" id="paymentCon">
                <div class="ncc-receipt-info-title">
                    <h3>支付方式</h3>
                </div>
                <div class="ncc-candidate-items">
                    <ul>
                        <li>在线支付</li>
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

                <div class="tc mt10 mb10"><a href="javascript:void(0);" class="ncbtn ncbtn-bittersweet"
                                             id="close_confirm_button">确认支付方式</a></div>
            </div>
            <script type="text/javascript">
                $(function () {

                    var hybrid = 0;

                    var failInPage = false;

// 重新调整在线支付/到付的商品展示
                    var setCodGoodsShow = function () {
                        var j = $('#allow_offpay_batch').val();
                        var arr = {};
                        if (j) {
                            $.each(j.split(';'), function (k, v) {
                                vv = v.split(':');
                                arr[vv[0]] = vv[1] == '1' ? true : false;
                            });
                        }

                        $.each(arr, function (k, v) {
                            //console.log(''+k+':'+v);
                            if (v) {
                                $("[data-cod-type='online'] [data-cod-store='" + k + "']").appendTo("[data-cod-type='offline']");
                                $("[data-cod-type='online'] [data-cod-store='" + k + "']").remove();

                                $("[data-cod2-type='online'] [data-cod2-store='" + k + "']").appendTo("[data-cod2-type='offline']");
                                $("[data-cod2-type='online'] [data-cod2-store='" + k + "']").remove();
                            } else {
                                $("[data-cod-type='offline'] [data-cod-store='" + k + "']").appendTo("[data-cod-type='online']");
                                $("[data-cod-type='offline'] [data-cod-store='" + k + "']").remove();

                                $("[data-cod2-type='offline'] [data-cod2-store='" + k + "']").appendTo("[data-cod2-type='online']");
                                $("[data-cod2-type='offline'] [data-cod2-store='" + k + "']").remove();
                            }
                        });

                        var off = $("[data-cod2-type='offline'] [data-cod2-store]").length;
                        var on = $("[data-cod2-type='online'] [data-cod2-store]").length;

                        $("[data-hideshow='offline']")[off ? 'show' : 'hide']();
                        $("[data-hideshow='online']")[on ? 'show' : 'hide']();

                        $("span[data-cod-nums='offline']").html(off);
                        $("span[data-cod-nums='online']").html(on);

                        failInPage = !off;
                        hybrid = off && on;

                    };

                    //点击修改支付方式
                    $('#edit_payment').on('click', function () {
                        $('#edit_payment').parent().next().remove();
                        $(this).hide();
                        $('#paymentCon').addClass('current_box');
                        $('#payment_list').show();
                        if (chain_id != '') {
                            $('#payment_type_offline').parent().hide();
                            $('#payment_type_chain').parent().show();
                        } else {
                            $('#payment_type_online').attr('checked', true);
                            $('#payment_type_chain').parent().hide();
                            $('#payment_type_offline').parent().show();
                        }
                        disableOtherEdit('如需要修改，请先保存支付方式');
                    });
                    //保存支付方式
                    $('#hide_payment_list').on('click', function () {
                        var payment_type = $('input[name="payment_type"]:checked').val();
                        if ($('input[name="payment_type"]:checked').size() == 0) return;

                        setCodGoodsShow();

                        //判断该地区(县ID)是否能货到付款
                        if (payment_type == 'offline' && ($('#allow_offpay').val() == '0' || failInPage)) {
                            showDialog('您目前选择的收货地区不支持货到付款!', 'error', '', '', '', '', '', '', '', '', 2);
                            return;
                        }
                        $('#payment_list').hide();
                        $('#edit_payment').show();
                        $('.current_box').removeClass('current_box');
                        if (payment_type == 'chain') {
                            var content = '门店支付';
                        } else {
                            var content = (payment_type == 'online' ? '在线支付' : '货到付款');
                        }

                        $('#pay_name').val(payment_type);

                        if (payment_type == 'offline') {
                            //如果混合支付（在线+货到付款）
                            if (hybrid) {
                                content = $('#show_goods_list').clone().html();
                                $('#edit_payment').parent().after('<div class="ncc-candidate-items"><ul><li>您选择货到付款 + 在线支付完成此订单<br/><a href="javsacript:void(0);" id="show_goods_list" class="ncc-payment-showgoods">' + content + '</a></li></ul></div>');
                                $('#show_goods_list').hover(function () {
                                    showPayGoodsList(this)
                                }, function () {
                                    $('#ncc-payment-showgoods-list').fadeOut()
                                });
                            } else {
                                $('#edit_payment').parent().after('<div class="ncc-candidate-items"><ul><li>' + content + '</li></ul></div>');
                            }
                        } else {
                            $('#edit_payment').parent().after('<div class="ncc-candidate-items"><ul><li>' + content + '</li></ul></div>');
                        }
                        ableOtherEdit();
                    });
                    $('#show_goods_list').hover(function () {
                        showPayGoodsList(this)
                    }, function () {
                        $('#ncc-payment-showgoods-list').fadeOut()
                    });
                    function showPayGoodsList(item) {
                        var pos = $(item).position();
                        var pos_x = pos.left + 0;
                        var pos_y = pos.top + 25;
                        $("#ncc-payment-showgoods-list").css({
                            'left': pos_x,
                            'top': pos_y,
                            'position': 'absolute',
                            'display': 'block'
                        });
                        $('#ncc-payment-showgoods-list').addClass('ncc-payment-showgoods-list').fadeIn();
                    }

                    $('input[name="payment_type"]').on('change', function () {
                        if ($(this).val() == 'online') {
                            $('#show_goods_list').hide();
                        } else {
                            if ($(this).val() == 'offline') {
                                setCodGoodsShow();
                                //判断该地区(县ID)是否能货到付款
                                if (($('#allow_offpay').val() == '0') || failInPage) {
                                    $('#payment_type_online').attr('checked', true);
                                    showDialog('您目前选择的收货地区不支持货到付款', 'error', '', '', '', '', '', '', '', '', 2);
                                    return;
                                }
                                html_form('confirm_pay_type', '请确认支付方式', $('#confirm_offpay_goods_list').html(), 500, 1);
                                $('#show_goods_list').show();
                            } else {
                            }
                        }
                    });

                    $('body').on('click', '#close_confirm_button', function () {
                        DialogManager.close('confirm_pay_type');
                    });
                })
            </script>
            <div class="ncc-receipt-info">
                <div class="ncc-receipt-info-title">
                    <h3>发票信息</h3>
                    <a href="javascript:void(0)" nc_type="buy_edit" id="edit_invoice"
                       style="display: none;">[修改]</a><font color="#B0B0B0">如需修改，请先保存收货人信息 </font></div>
                <div id="invoice_list" class="ncc-candidate-items">
                    <ul>
                        <li>不需要发票</li>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                //隐藏发票列表
                function hideInvList(content) {
                    $('#edit_invoice').show();
                    $("#invoice_list").html('<ul><li>' + content + '</li></ul>');
                    $('.current_box').removeClass('current_box');
                    ableOtherEdit();
                    //重新定位到顶部
                    $("html, body").animate({scrollTop: 0}, 0);
                }
                //加载发票列表
                $('#edit_invoice').on('click', function () {
                    $(this).hide();
                    disableOtherEdit('如需修改，请先保存发票信息');
                    $(this).parent().parent().addClass('current_box');
                    $('#invoice_list').load(SITEURL + '/index.php?act=buy&op=load_inv&vat_hash=mOcY7ToMGooaOlcaBtr-05tszTVt7peZbKb');
                });
            </script>

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
                    <tbody id="jjg-valid-skus-tpl" style="display:none;">
                    <tr class="bundling-list">
                        <td class="tree td-border-left"><input name="jjg[]" type="hidden"
                                                               value="%jjgId%|%jjgLevel%|%id%"></td>
                        <td><a class="ncc-goods-thumb" href="http://shopwwi.local.com/shop/%url%" target="_blank"> <img
                                    alt="%name%" data-src="%imgUrl%"> </a></td>
                        <td class="tl">
                            <dl class="ncc-goods-info">
                                <dt><a href="http://shopwwi.local.com/shop/%url%" target="_blank">%name%</a></dt>
                                <dd class="ncc-goods-gift"><span>已选换购</span></dd>
                            </dl>
                        </td>
                        <td><em class="goods-price">%jjgPrice%</em></td>
                        <td>1</td>
                        <td class="td-border-right"><em nc_type="eachGoodsTotal" class="goods-subtotal">
                                %jjgPrice% </em></td>
                    </tr>
                    </tbody>
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
                                <textarea name="pay_message[1]" class="ncc-msg-textarea" placeholder="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）" title="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）" maxlength="150"></textarea>
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
                                <dl class="total">
                                    <dt>本店合计：</dt>
                                    <dd class="rule"></dd>
                                    <dd class="sum"><em store_id="1" nc_type="eachStoreTotal">{$info.total|cur}</em>元</dd>
                                </dl>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>

                    <tr>
                        <td colspan="20">
                            <a href="http://shopwwi.local.com/shop/index.php?act=cart" class="ncc-prev-btn"><i class="icon-angle-left"></i>返回购物车</a>
                            <div class="ncc-all-account">订单总金额：<em id="orderTotal">....</em>元</div>
                            <a href="javascript:void(0)" id="submitOrder" class="ncc-next-submit">提交订单</a>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <script>
                function submitNext() {
                    if (!SUBMIT_FORM) return;

                    if ($('input[name="cart_id[]"]').size() == 0) {
                        showDialog('所购商品无效', 'error', '', '', '', '', '', '', '', '', 2);
                        return;
                    }
                    if ($('#address_id').val() == '') {
                        showDialog('请先设置收货地址', 'error', '', '', '', '', '', '', '', '', 2);
                        return;
                    }
                    if ($('#buy_city_id').val() == '') {
                        showDialog('正在计算运费,请稍后！', 'error', '', '', '', '', '', '', '', '', 2);
                        return;
                    }
                    if ($('input[name="fcode"]').size() == 1 && $('#fcode_callback').val() != '1') {
                        showDialog('请输入并使用F码！', 'error', '', '', '', '', '', '', '', '', 2);
                        return;
                    }
                    if (no_send_tpl_ids.length > 0 || no_chain_goods_ids.length > 0) {
                        showDialog('有部分商品配送范围无法覆盖您选择的地址，请更换其它商品！', 'error', '', '', '', '', '', '', '', '', 4);
                        return;
                    }
                    SUBMIT_FORM = false;
                    $('#order_form').submit();
                }

                //计算总运费和每个店铺小计
                function calcOrder() {
                    allTotal = 0;
                    $('em[nc_type="eachStoreTotal"]').each(function () {
                        store_id = $(this).attr('store_id');
                        var eachTotal = 0;
                        $('em[nc_type="eachGoodsTotal' + store_id + '"]').each(function () {
                            if (no_send_tpl_ids[$(this).attr('tpl_id')]) {
                                $(this).next().show();
                                $('#cart_item_' + $(this).attr('cart_id')).addClass('item_disabled');
                            } else {
                                if (no_chain_goods_ids[$(this).attr('goods_id')]) {
                                    $(this).next().show();
                                    $('#cart_item_' + $(this).attr('cart_id')).addClass('item_disabled');
                                } else {
                                    $(this).next().hide();
                                    $('#cart_item_' + $(this).attr('cart_id')).removeClass('item_disabled');
                                }
                            }
                        });
                        if ($('#eachStoreGoodsTotal_' + store_id).length > 0) {
                            eachTotal += parseFloat($('#eachStoreGoodsTotal_' + store_id).html());
                        }
                        if ($('#eachStoreManSong_' + store_id).length > 0) {
                            eachTotal += parseFloat($('#eachStoreManSong_' + store_id).html());
                        }
                        if ($('#eachStoreVoucher_' + store_id).length > 0) {
                            eachTotal += parseFloat($('#eachStoreVoucher_' + store_id).html());
                        }
                        if ($('#eachStoreFreight_' + store_id).length > 0) {
                            eachTotal += parseFloat($('#eachStoreFreight_' + store_id).html());
                        }
                        allTotal += eachTotal;
                        $(this).html(eachTotal.toFixed(2));
                    });

                    if ($('#orderRpt').length > 0) {
                        iniRpt(allTotal.toFixed(2));
                        $('#orderRpt').html('-0.00');
                    }
                    $('#orderTotal').html(allTotal.toFixed(2));
                    $('#submitOrder').on('click', function () {
                        submitNext()
                    }).addClass('ok');
                }
                $(function () {
                    var tpl = $('#jjg-valid-skus-tpl').html();
                    var jjgValidSkus = [];

                    $footers = {};
                    $('[data-jjg]').each(function () {
                        var id = $(this).attr('data-jjg');
                        if (!$footers[id]) {
                            var $footer = $('<tr><td colspan="20"></td></tr>');
                            $footers[id] = $footer;
                            $("tr[data-jjg='" + id + "']:last").after($footer);
                        }
                    });

                    $.each(jjgValidSkus || {}, function (k, v) {
                        $.each(v || {}, function (kk, vv) {
                            var s = tpl.replace(/%(\w+)%/g, function ($m, $1) {
                                return vv[$1];
                            });
                            var $s = $(s);
                            $s.find('img[data-src]').each(function () {
                                this.src = $(this).attr('data-src');
                            });
                            $footers[k].before($s);
                        });
                    });
                });

            </script>

            <input value="buy" type="hidden" name="act">
            <input value="buy_step2" type="hidden" name="op">
            <!-- 来源于购物车标志 -->
            <input value="1" type="hidden" name="ifcart">

            <!-- 收货地址ID -->
            <input value="" name="address_id" id="address_id" type="hidden">
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
                $(this).attr("src", $(this).attr("shopwwi-url"));
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


<script type="text/javascript">
    $(function () {

        $('[nctype="mcard"]').membershipCard({type: 'shop'});
    });
</script>
<script>
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
</script>
<template file="Site/footer_simple.php"/>
</body>
</html>