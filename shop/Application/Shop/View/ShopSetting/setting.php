<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <Admintemplate file="Common/Nav"/>
    <div class="h_a">商城配置</div>
    <div class="table_full">
        <form method='post' id="myform" class="J_ajaxForm"  action="{:U('ShopSetting/setting')}">
            <table width="100%"  class="table_form">
                <tbody id="smtpcfg" style="">
                <tr>
                    <th width="120">商城logo</th>
                    <td>
                        <a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','logoimg',thumb_images,'{$args}','Content','14','{$authkey}');return false;">
                            <img src="{$logoimg|default='/statics/images/icon/upload-pic.png'}" id="logoimg_preview" width="135" height="113" style="cursor:hand"></a></td>
                    <input type="hidden"  id='logoimg' name="logoimg" value="{:F('logoimg')}">
                </tr>
                <tr>
                    <th width="120">登录页封面</th>
                    <td>
                        <a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','loginimg',thumb_images,'{$args}','Content','14','{$authkey}');return false;">
                            <img src="{$loginimg|default='/statics/images/icon/upload-pic.png'}" id="loginimg_preview" width="135" height="113" style="cursor:hand"></a></td>
                    <input type="hidden"  id='loginimg' name="loginimg" value="{:F('loginimg')}">
                </tr>
                </tbody>
            </table>
            <div class="btn_wrap">
                <div class="btn_wrap_pd">
                    <input type="hidden" class="input" name="type" id="type" value="default"/>
                    <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{$config_siteurl}statics/js/common.js"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
</body>
</html>