<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="active"><a href="index.php?act=member_adderss&amp;op=address">地址列表</a></li>
        </ul>
        <a href="javascript:void(0)" class="ncbtn ncbtn-bittersweet" nc_type="dialog" dialog_title="新增地址"
           dialog_id="my_address_edit" uri="{:U('Member/Order/change_state', array('state_type' => 'change_address'))}" dialog_width="550"
           title="新增地址"><i class="icon-map-marker"></i>新增地址</a>
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
        <if condition="$address neq ''">
            <volist name="address" id="vo">
                <tr class="bd-line">
                    <td>{$vo.full_name}</td>
                    <td>{$vo.province_name} {$vo.city_name} {$vo.area_name}</td>
                    <td class="tl">{$vo.address}</td>
                    <td>
                        <if condition="$vo['phone'] neq ''"><p><i class="icon-phone"></i>{$vo.phone}</p></if>
                        <if condition="$vo['mobile_phone'] neq ''"><p><i class="icon-mobile-phone"></i>{$vo.mobile_phone}</p></td></if>
                    <td></td>
                    <td class="ncm-table-handle">
                        <span>
                            <a href="javascript:void(0);" class="btn-bluejeans" dialog_id="my_address_edit" dialog_width="550" dialog_title="编辑地址" nc_type="dialog" uri="{:U('Member/Order/change_state', array('state_type' => 'change_address', 'addr_id' => $vo['id']))}">
                                <i class="icon-edit"></i>
                                <p>编辑</p>
                            </a>
                        </span>
                        <span>
                            <a href="javascript:void(0)" class="btn-grapefruit" onclick="ajax_get_confirm('您确定要删除吗?', '{:U(\'Member/Member/delAddress\',array(\'addr_id\' => $vo[\'id\']))}');">
                                <i class="icon-trash"></i>
                                <p>删除</p>
                            </a>
                        </span>
                    </td>
                </tr>
            </volist>
        </if>
        </tbody>
    </table>
</div>
