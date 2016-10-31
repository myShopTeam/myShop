<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="active"><a href="index.php?act=member_adderss&amp;op=address">地址列表</a></li>
        </ul>
        <a href="javascript:void(0)" class="ncbtn ncbtn-bittersweet" nc_type="dialog" dialog_title="新增地址"
           dialog_id="my_address_edit" uri="index.php?act=member_address&amp;op=address&amp;type=add" dialog_width="550"
           title="新增地址"><i class="icon-map-marker"></i>新增地址</a>
<!--        <a href="javascript:void(0)" class="ncbtn ncbtn-bittersweet" style="right: 100px;" nc_type="dialog"-->
<!--           dialog_title="使用代收货（自提）" dialog_id="daisou" uri="index.php?act=member_address&amp;op=delivery_add"-->
<!--           dialog_width="900" title="使用自提服务站"><i class="icon-flag"></i>使用自提服务站</a>-->
    </div>
    <div class="alert alert-success">
        <h4>操作提示：</h4>
        <ul>
            <li>最多可保存20个有效地址</li>
        </ul>
    </div>
    <table class="ncm-default-table">
        <thead>
        <tr>
            <th class="w80">收货人</th>
            <th class="w150">所在地区</th>
            <th class="tl">街道地址</th>
            <th class="w120">电话/手机</th>
            <th class="w100"></th>
            <th class="w110">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr class="bd-line">
            <td>dqd</td>
            <td>河北 石家庄市 井陉矿区</td>
            <td class="tl">ddq</td>
            <td><p><i class="icon-phone"></i></p>

                <p><i class="icon-mobile-phone"></i>15623433629</p></td>
            <td></td>
            <td class="ncm-table-handle"><span>
                    <a href="javascript:void(0);" class="btn-bluejeans" dialog_id="my_address_edit" dialog_width="550"
                       dialog_title="编辑地址" nc_type="dialog"
                       uri="http://shopwwi.local.com/member/index.php?act=member_address&amp;op=address&amp;type=edit&amp;id=3"><i
                            class="icon-edit"></i>

                        <p>编辑</p>
                    </a>
                    </span> <span><a href="javascript:void(0)" class="btn-grapefruit"
                                     onclick="ajax_get_confirm('您确定要删除吗?', 'http://shopwwi.local.com/member/index.php?act=member_address&amp;op=address&amp;id=3');"><i
                            class="icon-trash"></i>

                        <p>删除</p>
                    </a></span></td>
        </tr>
        <tr class="bd-line">
            <td>dq</td>
            <td>天津 天津市 河西区</td>
            <td class="tl">fqfq</td>
            <td><p><i class="icon-phone"></i></p>

                <p><i class="icon-mobile-phone"></i>15623433629</p></td>
            <td></td>
            <td class="ncm-table-handle"><span>
                    <a href="javascript:void(0);" class="btn-bluejeans" dialog_id="my_address_edit" dialog_width="550"
                       dialog_title="编辑地址" nc_type="dialog"
                       uri="http://shopwwi.local.com/member/index.php?act=member_address&amp;op=address&amp;type=edit&amp;id=2"><i
                            class="icon-edit"></i>

                        <p>编辑</p>
                    </a>
                    </span> <span><a href="javascript:void(0)" class="btn-grapefruit"
                                     onclick="ajax_get_confirm('您确定要删除吗?', 'http://shopwwi.local.com/member/index.php?act=member_address&amp;op=address&amp;id=2');"><i
                            class="icon-trash"></i>

                        <p>删除</p>
                    </a></span></td>
        </tr>
        <tr class="bd-line">
            <td>lp</td>
            <td>吉林 四平市 公主岭市</td>
            <td class="tl">dqdqd</td>
            <td><p><i class="icon-phone"></i></p>

                <p><i class="icon-mobile-phone"></i>15623433629</p></td>
            <td></td>
            <td class="ncm-table-handle"><span>
                    <a href="javascript:void(0);" class="btn-bluejeans" dialog_id="my_address_edit" dialog_width="550"
                       dialog_title="编辑地址" nc_type="dialog"
                       uri="http://shopwwi.local.com/member/index.php?act=member_address&amp;op=address&amp;type=edit&amp;id=1"><i
                            class="icon-edit"></i>

                        <p>编辑</p>
                    </a>
                    </span> <span><a href="javascript:void(0)" class="btn-grapefruit"
                                     onclick="ajax_get_confirm('您确定要删除吗?', 'http://shopwwi.local.com/member/index.php?act=member_address&amp;op=address&amp;id=1');"><i
                            class="icon-trash"></i>

                        <p>删除</p>
                    </a></span></td>
        </tr>
        </tbody>
    </table>
</div>
<script src="http://shopwwi.local.com/data/resource/js/jquery.ajaxContent.pack.js" type="text/javascript"></script>
