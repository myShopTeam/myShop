<link rel="stylesheet" type="text/css"
      href="http://shopwwi.local.com/data/resource/js/jquery-ui/themes/ui-lightness/jquery.ui.css">

<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="active"><a href="{:U('Member/Member/member')}">基本信息</a></li>
<!--            <li class="normal"><a href="index.php?act=member_information&amp;op=more">兴趣标签</a></li>-->
            <li class="normal"><a href="{:U('Member/Member/modifyAvatar')}">更换头像</a></li>
        </ul>
    </div>

    <div class="ncm-default-form">
        <form method="post" id="profile_form"
              action="http://shopwwi.local.com/member/index.php?act=member_information&amp;op=member">
            <input type="hidden" name="form_submit" value="ok">
            <input type="hidden" name="old_member_avatar" value="avatar_2.jpg">
            <input type="hidden" name="area_ids" id="area_ids" value="">
            <dl>
                <dt>用户名称：</dt>
                <dd>
                      <span class="w400">冷月灬微笑&nbsp;&nbsp;
                          <div class="nc-grade-mini" style="cursor:pointer;" onclick="javascript:go('http://shopwwi.local.com/shop/index.php?act=pointgrade&amp;op=index');">V0</div>
                      </span>
<!--                     <span>&nbsp;&nbsp;隐私设置</span>-->
                </dd>
            </dl>
            <dl>
                <dt>邮箱：</dt>
                <dd><span class="w400">310914868@qq.com&nbsp;&nbsp;
            <a href="index.php?act=member_security&amp;op=auth&amp;type=modify_email">
                绑定邮箱 </a>
            </span>
<!--                    <span>-->
<!--            <select name="privacy[email]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
                </dd>
            </dl>
            <dl>
                <dt>真实姓名：</dt>
                <dd><span class="w400">
            <input type="text" class="text" maxlength="20" name="member_truename" value="">
            </span>
<!--                    <span>-->
<!--            <select name="privacy[truename]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
                </dd>
            </dl>
            <dl>
                <dt>性别：</dt>
                <dd><span class="w400">
            <label>
                <input type="radio" name="member_sex" value="3" checked="checked">
                保密</label>
            &nbsp;&nbsp;
            <label>
                <input type="radio" name="member_sex" value="2">
                女</label>
            &nbsp;&nbsp;
            <label>
                <input type="radio" name="member_sex" value="1">
                男</label>
            </span>
<!--                    <span>-->
<!--            <select name="privacy[sex]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
                </dd>
            </dl>
            <dl>
                <dt>生日：</dt>
                <dd><span class="w400">
            <input type="text" class="text hasDatepicker" name="birthday" maxlength="10" id="birthday" value=""
                   readonly="readonly">
            </span>
<!--                    <span>-->
<!--            <select name="privacy[birthday]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
                </dd>
            </dl>
            <dl>
                <dt>所在地区：</dt>
                <dd><span class="w400">
          <select>
              <option value="">-请选择-</option>
              <option value="1">北京</option>
              <option value="2">天津</option>
              <option value="3">河北</option>
              <option value="4">山西</option>
              <option value="5">内蒙古</option>
              <option value="6">辽宁</option>
              <option value="7">吉林</option>
              <option value="8">黑龙江</option>
              <option value="9">上海</option>
              <option value="10">江苏</option>
              <option value="11">浙江</option>
              <option value="12">安徽</option>
              <option value="13">福建</option>
              <option value="14">江西</option>
              <option value="15">山东</option>
              <option value="16">河南</option>
              <option value="17">湖北</option>
              <option value="18">湖南</option>
              <option value="19">广东</option>
              <option value="20">广西</option>
              <option value="21">海南</option>
              <option value="22">重庆</option>
              <option value="23">四川</option>
              <option value="24">贵州</option>
              <option value="25">云南</option>
              <option value="26">西藏</option>
              <option value="27">陕西</option>
              <option value="28">甘肃</option>
              <option value="29">青海</option>
              <option value="30">宁夏</option>
              <option value="31">新疆</option>
              <option value="32">台湾</option>
              <option value="33">香港</option>
              <option value="34">澳门</option>
              <option value="35">海外</option>
          </select><input type="hidden" name="region" id="region" value=""></span>
<!--                    <span>-->
<!--            <select name="privacy[area]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
                </dd>
            </dl>
            <dl>
                <dt>QQ：</dt>
                <dd><span class="w400">
            <input type="text" class="text" maxlength="30" name="member_qq" value="">
            </span>
<!--                    <span>-->
<!--            <select name="privacy[qq]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
                </dd>
            </dl>
            <dl>
                <dt>阿里旺旺：</dt>
                <dd><span class="w400">
            <input name="member_ww" type="text" class="text" maxlength="50" id="member_ww" value="">
            </span>
<!--                    <span>-->
<!--            <select name="privacy[ww]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
                </dd>
            </dl>
            <dl class="bottom">
                <dt></dt>
                <dd>
                    <label class="submit-border">
                        <input type="submit" class="submit" value="保存修改">
                    </label>
                </dd>
            </dl>
        </form>
    </div>
</div>
<script type="text/javascript">
    //注册表单验证
    $(function () {
        $("#region").nc_region({
            show_deep: 3,
            btn_style_html: 'style="background-color: #F5F5F5; width: 60px; height: 32px; border: solid 1px #E7E7E7; cursor: pointer"'
        });
        $('#birthday').datepicker({dateFormat: 'yy-mm-dd'});
        $('#profile_form').validate({
            submitHandler: function (form) {
                $('#area_ids').val($('#region').fetch('area_ids'));
                ajaxpost('profile_form', '', '', 'onerror')
            },
            rules: {
                member_truename: {
                    minlength: 2,
                    maxlength: 20
                },
                member_qq: {
                    digits: true,
                    minlength: 5,
                    maxlength: 12
                }
            },
            messages: {
                member_truename: {
                    minlength: '姓名长度大于等于2位小于等于20位',
                    maxlength: '姓名长度大于等于2位小于等于20位'
                },
                member_qq: {
                    digits: '请填入正确的QQ号码',
                    minlength: '请填入正确的QQ号码',
                    maxlength: '请填入正确的QQ号码'
                }
            }
        });
    });
</script>
<script charset="utf-8" type="text/javascript" src="http://shopwwi.local.com/data/resource/js/jquery-ui/i18n/zh-CN.js"></script>