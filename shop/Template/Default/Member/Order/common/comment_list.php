<div class="wrap">
    <div class="tabmenu">
        <ul id="listpj" class="tab">
            <li class="active"><a href="index.php?act=member_evaluate&amp;op=list">交易评价/晒单</a></li>
        </ul>
    </div>
    <form id="goodsevalform" method="get" class="tc">
        <input type="hidden" name="act" value="member_evaluate">
        <input type="hidden" name="op" value="list">
        <input type="hidden" name="type" value="">

        <div class="norecord">
            <div class="warning-option"><i></i><span>暂无符合条件的数据记录</span></div>
        </div>
    </form>
</div>
<script type="text/javascript" src="{$site_info.common_path}js/jquery.nyroModal/custom.min.js" charset="utf-8"></script>
<script type="text/javascript" src="{$site_info.common_path}js/jquery.poshytip.min.js" charset="utf-8"></script>
<link href="{$site_info.common_path}js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css" id="cssfile2">
<script type="text/javascript" src="{$site_info.common_path}js/jquery.raty/jquery.raty.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.raty').raty({
            path: "/public/common/js/jquery.raty/img",
            readOnly: true,
            score: function () {
                return $(this).attr('data-score');
            }
        });

        $('a[nctype="nyroModal"]').nyroModal();
    });
</script>
