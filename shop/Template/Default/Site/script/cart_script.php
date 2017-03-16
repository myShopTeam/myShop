<script type="text/html" id="cart-list-html">
    {{if is_list == 'no'}}
    <li nctpye="cart_item_{{if cart_info.cart_id }}{{cart_info.cart_id}}{{else}}{{cart_info.goods_id}}{{/if}}">
        <div class="goods-pic">
            <a href="{:U('Site/Goods/product')}&gid={{cart_info.goods_id}}" title="{{cart_info.goods_name}}" target="_blank">
                <img src="{{cart_info.goods_thumb}}" alt="{{cart_info.goods_name}}"></a>
        </div>
        <dl>
            <dt class="goods-name">
                <a href="{:U('Site/Goods/product')}&gid={{cart_info.goods_id}}" title="{{cart_info.goods_name}}" target="_blank">{{cart_info.goods_name}}</a>
            </dt>
            <dd><em class="goods-price">¥{{if cart_info.sku }}{{cart_info.attr_price}}{{else}}{{cart_info.goods_price}}{{/if}}</em>×{{cart_info.goods_num}}</dd>
        </dl>
            <a href="javascript:drop_topcart_item({{if cart_info.cart_id }}{{cart_info.cart_id}}{{else}}{{cart_info.goods_id}}{{/if}});" class="del" title="删除">X</a>

    </li>
    {{else}}
    {{each cart_info as v i}}
    <li nctpye="cart_item_{{if v.cart_id }}{{v.cart_id}}{{else}}{{v.goods_id}}{{/if}}">
        <div class="goods-pic">
            <a href="{:U('Site/Goods/product')}&gid={{v.goods_id}}" title="{{v.goods_name}}" target="_blank">
                <img src="{{v.goods_thumb}}" alt="{{v.goods_name}}"></a>
        </div>
        <dl>
            <dt class="goods-name">
                <a href="{:U('Site/Goods/product')}&gid={{v.goods_id}}" title="{{v.goods_name}}"
                   target="_blank">{{v.goods_name}}</a>
            </dt>
            <dd><em class="goods-price">¥{{if v.sku }}{{v.attr_price}}{{else}}{{v.goods_price}}{{/if}}</em>×{{v.goods_num}}</dd>
        </dl>
        <a href="javascript:drop_topcart_item({{if v.cart_id }}{{v.cart_id}}{{else}}{{v.goods_id}}{{/if}});" class="del" title="删除">X</a>
    </li>
    {{/each}}
    {{/if}}


</script>
<script type="text/html" id="cart-list-submit">
    <div class="btn-box">
        <div nctype="rtoolbar_total_price" class="total-price">
            共计金额：<em class="goods-price">¥{{money_total}}</em>
        </div>
        <a href="javascript:void(0);" onclick="javascript:window.location.href='{:U("Cart/Cart/index")}'">结算购物车中的商品</a>
    </div>
</script>
<script type="text/html" id="cart-top-cart">
    {{if is_list == 'no'}}
    <li nctpye="cart_item_{{if cart_info.cart_id }}{{cart_info.cart_id}}{{else}}{{cart_info.goods_id}}{{/if}}">
        <a traget="_blank" class="pro_img" href="{:U('product')}&gid={{cart_info.goods_id}}" title="{{cart_info.goods_name}}">
            <img src="{{cart_info.goods_thumb}}">
        </a>
        <a traget="_blank" class="pro_name" href="{:U('product')}&gid={{cart_info.goods_id}}">{{cart_info.goods_name}}</a>

        <div class="mcartRight">
            <span class="pro_price">
                <em>¥{{if cart_info.sku }}{{cart_info.attr_price}}{{else}}{{cart_info.goods_price}}{{/if}}×{{cart_info.goods_num}}</em>
            </span>
            <em><a href="javascript:void(0);" onclick="drop_topcart_item({{if cart_info.cart_id }}{{cart_info.cart_id}}{{else}}{{cart_info.goods_id}}{{/if}});">删除</a></em>
        </div>
    </li>
    {{else}}
    {{each cart_info as v i}}
    <li nctpye="cart_item_{{if v.cart_id }}{{v.cart_id}}{{else}}{{v.goods_id}}{{/if}}">
        <a traget="_blank" class="pro_img" href="{:U('product')}&gid={{v.goods_id}}" title="{{v.goods_name}}">
            <img src="{{v.goods_thumb}}">
        </a>
        <a traget="_blank" class="pro_name" href="{:U('product')}&gid={{v.goods_id}}">{{v.goods_name}}</a>

        <div class="mcartRight">
                    <span class="pro_price">
                        <em>¥{{if v.sku }}{{v.attr_price}}{{else}}{{v.goods_price}}{{/if}}×{{v.goods_num}}</em>
                    </span>
            <em><a href="javascript:void(0);" onclick="drop_topcart_item({{if v.cart_id }}{{v.cart_id}}{{else}}{{v.goods_id}}{{/if}});">删除</a></em>
        </div>
    </li>
    {{/each}}
    {{/if}}
</script>
<script type="text/html" id="cart-top-submit">
    <div class="checkout_box">
        <p class="fl">共<em class="tNum">1</em>种商品,总计金额：<em class="tSum">¥{{money_total}}</em></p>
        <a rel="nofollow" class="checkout_btn" href="{:U('Cart/Cart/index')}" target="_self">去结算 </a>
    </div>
</script>
<script>
    //加载购物车数据
    function load_cart_information() {
        $.getJSON("{:U('Cart/Cart/getCartInfo')}", function (res) {
            console.log(res)
            if(res.data.cart_info){
                var cart_html = template('cart-list-html', res.data);
                var submit_html = template('cart-list-submit', res.data.cart_total);
                cart_html = '<ul class="cart-list">' + cart_html + '</ul>';
                $('#rtoolbar_cartlist').html(cart_html+submit_html);
                //顶部购物车
                var top_cart = '<ul>' + template('cart-top-cart', res.data) + '</ul>';
                var top_submit = template('cart-top-submit', res.data.cart_total);
                $('#minicart_list .list_detail').html(top_cart+top_submit);
            } else {
                $('#nofollow').find('.cart_num').text(0);
                $('#rtoolbar_cartlist .btn-box').remove();
                $('#rtoolbar_cartlist').html('<ul class="cart-list"><li><dl><dd style="text-align: center; ">暂无商品</dd></dl></li></ul>');
                //顶部购物车
                $('#minicart_list .list_detail').html('<div class="none_tips"> <i> </i> <p>购物车中没有商品，赶紧去选购！</p> </div>');
            }
        })
    }
    //添加购物车操作
    function addcart(gid, num){
        if(!gid){
            return false;
        }
        $.getJSON("{:U('Cart/Cart/addCart')}", {gid:gid,num:num},function (res) {
            console.log(res);
//            var cart_num = Number($('#nofollow').find('.cart_num').text()) + 1;
            if(!res.data){
                return false;
            }
            if(res.data.cart_info){
                res.data.is_list = 'no';
                var cart_id = res.data.cart_info.cart_id;
                var cart_num = res.data.cart_info.goods_num;
                var goods_total = res.data.cart_total.goods_total;
                var cart_html = template('cart-list-html', res.data);
                var submit_html = template('cart-list-submit', res.data.cart_total)
                //顶部购物车
                var top_cart = template('cart-top-cart', res.data);
                var top_submit = template('cart-top-submit', res.data.cart_total);

                var check_cart = $.trim($('#rtoolbar_cartlist ul li dl').text());
                if(check_cart == '暂无商品' || check_cart == ''){
                    cart_html = '<ul class="cart-list">' + cart_html + '</ul>';
                    top_cart  = '<ul>' + top_cart + '</ul>';
                    $('#minicart_list .list_detail').html(top_cart+top_submit);
                    $('#rtoolbar_cartlist').html(cart_html+submit_html);
                } else {
                    $('li[ncTpye="cart_item_'+ cart_id +'"]').remove();
                    if($.trim($('li[ncTpye="cart_item_'+ cart_id +'"]').text()) == '' ){
                        $('#rtoolbar_cartlist ul').append(cart_html);
                        $('#minicart_list .list_detail ul').append(top_cart);
                    }
                    $('#rtoolbar_cartlist .btn-box').remove();
                    $('#minicart_list .checkout_box').remove();
                    $('#rtoolbar_cartlist').append(submit_html);
                    $('#minicart_list .list_detail').append(top_submit);
                }
                $('#nofollow').find('.cart_num').text(goods_total);
                $('#rtoobar_cart_count').show();
                $('#rtoobar_cart_count').text(goods_total);
            }

        })
    }
    //删除购物车商品 登录前使用goods_id,登录后使用cart_id
    function drop_topcart_item(cart_id){
        $.getJSON("{:U('Cart/Cart/delCart')}", {cart_id:cart_id},function (res) {
            if(res.status == 'success'){
                var cart_num = Number($('#nofollow').find('.cart_num').text()) - 1;
                var goods_total = res.data.cart_total.goods_total;
                $('li[ncTpye="cart_item_'+ cart_id+'"]').remove();
                var cart_total = res.data.cart_total;
                //删除结算按钮
                $('#rtoolbar_cartlist .btn-box').remove();
                $('#minicart_list .list_detail .checkout_box').remove();
                if(cart_total.money_total){
                    var submit_html = template('cart-list-submit', res.data.cart_total);
                    var top_submit = template('cart-top-submit', res.data.cart_total);
                    $('#rtoolbar_cartlist').append(submit_html);
                    $('#minicart_list .list_detail').append(top_submit);
                } else {
                    $('#rtoolbar_cartlist').html('<ul class="cart-list"><li><dl><dd style="text-align: center; ">暂无商品</dd></dl></li></ul>');
                }
                $('#nofollow').find('.cart_num').text(goods_total);
                $('#rtoobar_cart_count').text(goods_total);
                if(cart_num == 0){
                    $('#rtoobar_cart_count').hide();
                    $('#minicart_list .list_detail').html('<div class="none_tips"> <i> </i> <p>购物车中没有商品，赶紧去选购！</p> </div>');
                }
            } else {
                showDialog(res.msg, 'alert', '错误信息', null, true, null, '', '', '', 3);
            }
        })
    }

</script>