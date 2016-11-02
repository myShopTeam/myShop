<script type="text/javascript" src="http://shopwwi.local.com/data/resource/js/jquery.Jcrop/jquery.Jcrop.js"></script>
<link href="http://shopwwi.local.com/data/resource/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet"
      type="text/css" id="cssfile2">
<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="normal"><a href="{:U('Member/Member/member')}">基本信息</a></li>
<!--            <li class="normal"><a href="index.php?act=member_information&amp;op=more">兴趣标签</a></li>-->
            <li class="active"><a href="{:U('Member/Member/modifyAvatar')}">更换头像</a></li>
        </ul>
    </div>
    <form action="http://shopwwi.local.com/member/index.php?act=member_information&amp;op=upload"
          enctype="multipart/form-data" id="form_avaster" method="post">
        <input type="hidden" name="form_submit" value="ok">

        <div class="ncm-default-form">
            <dl>
                <dt>头像预览：</dt>
                <dd>
                    <div class="user-avatar"><span><img
                                src="http://shopwwi.local.com/data/upload/shop/avatar/avatar_2.jpg?0.85560900 1477754030"
                                alt="" nc_type="avatar"></span></div>
                    <p class="hint mt5">完善个人信息资料，上传头像图片有助于您结识更多的朋友。<br><span style="color:orange;">头像默认尺寸为120x120像素，请根据系统操作提示进行裁剪并生效。</span>
                    </p>
                </dd>
            </dl>
            <dl>
                <dt>更换头像：</dt>
                <dd>
                    <div class="ncm-upload-btn"><a href="javascript:void(0);"><span>
            <input type="file" hidefocus="true" size="1" class="input-file" name="pic" id="pic" file_id="0" multiple=""
                   maxlength="0">
            </span>

                            <p><i class="icon-upload-alt"></i>图片上传</p>
                            <input id="submit_button" style="display:none" type="button" value="&nbsp;"
                                   onclick="submit_form($(this))">
                        </a></div>
                </dd>
            </dl>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        $('#pic').change(function () {
            var filepath = $(this).val();
            var extStart = filepath.lastIndexOf(".");
            var ext = filepath.substring(extStart, filepath.length).toUpperCase();
            if (ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
                alert("文件类型错误，请选择图片文件（png|gif|jpg|jpeg）");
                $(this).attr('value', '');
                return false;
            }
            if ($(this).val() == '') return false;
            $("#form_avaster").submit();
        });
    });
</script>