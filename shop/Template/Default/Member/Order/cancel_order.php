<div class="eject_con">
    <div id="warning"></div>
    <form method="post" action="{:U('Order/Order/orderCancel')}" id="order_cancel_form">
        <dl>
            <dt>订单号：</dt>
            <dd><span class="num">{$order_sn}</span></dd>
        </dl>
        <dl>
            <dt>取消原因：</dt>
            <dd>
                <ul class="eject_con-list">
                    <li>
                        <input type="radio" class="radio" checked name="state_info" id="d1" value="改买其他商品" />
                        <label for="d1">改买其他商品</label>
                    </li>
<!--                    <li>-->
<!--                        <input type="radio" class="radio" name="state_info" id="d2" value="改用其他配送方式" />-->
<!--                        <label for="d2">改用其他配送方式</label>-->
<!--                    </li>-->
                    <li>
                        <input type="radio" class="radio" name="state_info" id="d3" value="我不想买了" />
                        <label for="d3">我不想买了</label>
                    </li>
                    <li>
                        <input type="radio" class="radio" name="state_info" flag="other_reason" id="d4" value="" />
                        <label for="d4">其他原因</label>
                    </li>
                    <li id="other_reason" style="display:none;">
                        <textarea name="state_info1" class="textarea w300 h50" rows="2" id="other_reason_input"></textarea>
                    </li>
                </ul>
            </dd>
        </dl>
        <div class="bottom">
            <input type="hidden" name="oid" value="{$order_id}">
            <label class="submit-border"><input type="submit" id="confirm_button" class="submit" value="确定提交" /></label>
            <a class="ncbtn ml5" href="javascript:DialogManager.close('buyer_order_cancel_order');">取消</a>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $("input[name='state_info']").click(function(){
            if ($(this).attr('flag') == 'other_reason')
            {
                $('#other_reason').show();
            }
            else
            {
                $('#other_reason').hide();
            }
        });
    });
</script>