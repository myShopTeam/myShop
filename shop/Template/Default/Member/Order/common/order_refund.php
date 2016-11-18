<link rel="stylesheet" type="text/css" href="{$site_info.common_path}css/jquery.ui.css">

<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="active"><a href="index.php?act=member_refund">退款申请</a></li>
            <li class="normal"><a href="index.php?act=member_return">退货申请</a></li>
            <li class="normal"><a href="index.php?act=member_vr_refund">虚拟兑码退款</a></li>
        </ul>
    </div>
    <form method="get" action="index.php">
        <input type="hidden" name="act" value="member_refund">
        <input type="hidden" name="op" value="index">
        <table class="ncm-search-table">
            <tbody>
            <tr>
                <td>&nbsp;</td>
                <th>申请时间</th>
                <td class="w240">
                    <input name="add_time_from" id="add_time_from" type="text" class="text w70 hasDatepicker" value="" readonly="readonly">
                    <label class="add-on">
                        <i class="icon-calendar"></i>
                    </label>&nbsp;–&nbsp;
                    <input name="add_time_to" id="add_time_to" type="text" class="text w70 hasDatepicker" value="" readonly="readonly">
                    <label class="add-on">
                        <i class="icon-calendar"></i>
                    </label>
                </td>
                <th>
                    <select name="type">
                        <option value="order_sn">订单编号</option>
                        <option value="refund_sn">退款编号</option>
                        <option value="goods_name">商品名称</option>
                    </select>
                </th>
                <td class="w160"><input type="text" class="text w150" name="key" value=""></td>
                <td class="w70 tc"><label class="submit-border">
                        <input type="submit" class="submit" value="搜索">
                    </label></td>
            </tr>
            </tbody>
        </table>
    </form>
    <table class="ncm-default-table order">
        <thead>
        <tr>
            <th class="w10"></th>
            <th colspan="2">商品</th>
            <th class="w100">退款金额（元）</th>
            <th class="w100">审核状态</th>
            <th class="w100">平台确认</th>
            <th class="w100">操作</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        <tbody>
        <tr>
            <td colspan="20" class="norecord">
                <div class="warning-option"><i>&nbsp;</i><span>暂无符合条件的数据记录</span></div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<!--<script type="text/javascript" src="http://shopwwi.local.com/data/resource/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>-->
<script type="text/javascript">
    $(function () {
        $('#add_time_from').datepicker({dateFormat: 'yy-mm-dd'});
        $('#add_time_to').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>