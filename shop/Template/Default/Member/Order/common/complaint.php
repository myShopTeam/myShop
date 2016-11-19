<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="active"><a href="index.php?act=member_complain">投诉管理</a></li>
        </ul>
    </div>
    <form method="get" action="index.php">
        <table class="ncm-search-table">
            <input type="hidden" name="act" value="member_complain">
            <tbody>
            <tr>
                <td>&nbsp;</td>
                <td class="w100 tr"><select name="select_complain_state">
                        <option value="0" selected="true"> 选择状态</option>
                        <option value="1"> 进行中</option>
                        <option value="2"> 已完成</option>
                    </select></td>
                <td class="w70 tc"><label class="submit-border">
                        <input type="submit" class="submit" value="搜索">
                    </label></td>
            </tr>
            </tbody>
        </table>
    </form>
    <table class="ncm-default-table">
        <thead>
        <tr>
            <th class="w10"></th>
            <th colspan="2">投诉商品</th>
            <th class="w200">投诉主题</th>
            <th class="w200">投诉时间</th>
            <th class="w150">投诉状态</th>
            <th class="w110">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="20" class="norecord">
                <div class="warning-option"><i></i><span>暂无符合条件的数据记录</span></div>
            </td>
        </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>
