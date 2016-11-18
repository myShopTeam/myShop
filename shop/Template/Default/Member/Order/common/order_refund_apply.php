<div class="ncm-flow-layout">
    <div class="ncm-flow-container">
        <div class="title">
            <h3>服务类型：退款</h3>
        </div>
        <div class="alert">
            <h4>操作提示：</h4>
            <ul>
                <li>1. 若您对订单进行支付后想取消购买且与商家达成一致退款，请填写<em>“订单退款”</em>内容并提交。</li>
                <li>2. 成功完成退款/退货；经过商城审核后，会将退款金额以<em>“预存款”</em>的形式返还到您的余额账户中（充值卡部分只能退回到充值卡余额）。</li>
            </ul>
        </div>
        <div id="saleRefund" show_id="1">
<!--            <div class="ncm-flow-step">-->
<!--                <dl class="step-first current">-->
<!--                    <dt>买家申请退款</dt>-->
<!--                    <dd class="bg"></dd>-->
<!--                </dl>-->
<!--                <dl class="">-->
<!--                    <dt>商家处理退款申请</dt>-->
<!--                    <dd class="bg"></dd>-->
<!--                </dl>-->
<!--                <dl class="">-->
<!--                    <dt>平台审核，退款完成</dt>-->
<!--                    <dd class="bg"></dd>-->
<!--                </dl>-->
<!--            </div>-->
            <div class=" ncm-default-form">
                <div id="warning"></div>
                <form id="post_form1" enctype="multipart/form-data" method="post"
                      action="index.php?act=member_refund&amp;op=add_refund_all&amp;order_id=5&amp;goods_id=">
                    <input type="hidden" name="form_submit" value="ok">

                    <h3>如果商家不同意，可以再次申请或投诉。</h3>
                    <dl>
                        <dt>退款原因：</dt>
                        <dd>取消订单，全部退款</dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>退款金额：</dt>
                        <dd><strong class="green">87500.00</strong> 元</dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>退款说明：</dt>
                        <dd>
                            <textarea name="buyer_message" rows="3" class="textarea w400"></textarea>
                            <br>
                            <span class="error"></span></dd>
                    </dl>
                    <dl>
                        <dt>上传凭证：</dt>
                        <dd>
                            <p>
                                <input name="refund_pic1" type="file">
                                <span class="error"></span></p>

                            <p>
                                <input name="refund_pic2" type="file">
                                <span class="error"></span></p>

                            <p>
                                <input name="refund_pic3" type="file">
                                <span class="error"></span></p>
                        </dd>
                    </dl>
                    <div class="bottom">
                        <label class="submit-border">
                            <input type="submit" class="submit" value="确认提交">
                        </label>
                        <a href="javascript:history.go(-1);" class="ncbtn ml10">取消并返回</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="ncm-flow-item">
        <div class="title">相关商品交易信息</div>
        <div class="item-goods">
            <dl>
                <dt>
                <div class="ncm-goods-thumb-mini"><a target="_blank"
                                                     href="http://shopwwi.local.com/shop/index.php?act=goods&amp;op=index&amp;goods_id=100001">
                        <img src="http://shopwwi.local.com/data/upload/shop/store/goods/1/1_04752627707766698_60.png"
                             onmouseover="toolTip('<img src=http://shopwwi.local.com/data/upload/shop/store/goods/1/1_04752627707766698_240.png>')"
                             onmouseout="toolTip()"></a></div>
                </dt>
                <dd><a target="_blank"
                       href="http://shopwwi.local.com/shop/index.php?act=goods&amp;op=index&amp;goods_id=100001">劳力士Rolex
                        深海系列 自动机械钢带男士表 联保正品116660 98210</a>
                    ¥87500.00 * 1 <font color="#AAA">(数量)</font>
                    <span></span>
                </dd>
            </dl>
        </div>
        <div class="item-order">
            <dl>
                <dt>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</dt>
                <dd>（免运费）</dd>
            </dl>
            <dl>
                <dt>订单总额：</dt>
                <dd><strong>¥87500.00 </strong></dd>
            </dl>
            <dl class="line">
                <dt>订单编号：</dt>
                <dd><a target="_blank" href="index.php?act=member_order&amp;op=show_order&amp;order_id=5">8000000000000501</a>
                    <a href="javascript:void(0);" class="a">更多<i class="icon-angle-down"></i>

                        <div class="more"><span class="arrow"></span>
                            <ul>
                                <li>付款单号：<span>420530755429491002</span></li>
                                <li>支付方式：<span>在线付款</span></li>
                                <li>下单时间：<span>2016-10-26 00:03:48</span></li>
                            </ul>
                        </div>
                    </a></dd>
            </dl>
            <dl class="line">
                <dt>商&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家：</dt>
                <dd>我的店铺<a href="javascript:void(0);" class="a">更多<i class="icon-angle-down"></i>

                        <div class="more"><span class="arrow"></span>
                            <ul>
                                <li>所在地区：<span>&nbsp;</span></li>
                                <li>联系电话：<span></span></li>
                            </ul>
                        </div>
                    </a>

                    <div><span member_id="1"></span>
                    </div>
                </dd>
            </dl>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#post_form1').validate({
            errorPlacement: function (error, element) {
                error.appendTo(element.nextAll('span.error'));
            },
            submitHandler: function (form) {
                ajaxpost('post_form1', '', '', 'onerror')
            },
            rules: {
                buyer_message: {
                    required: true
                },
                refund_pic1: {
                    accept: 'jpg|jpeg|gif|png'
                },
                refund_pic2: {
                    accept: 'jpg|jpeg|gif|png'
                },
                refund_pic3: {
                    accept: 'jpg|jpeg|gif|png'
                }
            },
            messages: {
                buyer_message: {
                    required: '<i class="icon-exclamation-sign"></i>请填写退款说明'
                },
                refund_pic1: {
                    accept: '<i class="icon-exclamation-sign"></i>图片必须是jpg/jpeg/gif/png格式'
                },
                refund_pic2: {
                    accept: '<i class="icon-exclamation-sign"></i>图片必须是jpg/jpeg/gif/png格式'
                },
                refund_pic3: {
                    accept: '<i class="icon-exclamation-sign"></i>图片必须是jpg/jpeg/gif/png格式'
                }
            }
        });
    });
</script>