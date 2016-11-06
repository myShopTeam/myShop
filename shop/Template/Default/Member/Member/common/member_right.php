<link rel="stylesheet" type="text/css" href="{$site_info.common_path}css/jquery.ui.css"
      xmlns="http://www.w3.org/1999/html">

<div class="wrap">
    <div class="tabmenu">
        <ul class="tab pngFix">
            <li class="active"><a href="{:U('Member/Member/member')}">基本信息</a></li>
<!--            <li class="normal"><a href="index.php?act=member_information&amp;op=more">兴趣标签</a></li>-->
            <li class="normal"><a href="{:U('Member/Member/modifyAvatar')}">更换头像</a></li>
        </ul>
    </div>

    <div class="ncm-default-form">
        <form method="post" id="myForm" action="{:U('Member/Member/editMember')}">
            <dl>
                <dt>用户昵称：</dt>
                <dd>
                      <span class="w400"><input type="text" class="text" maxlength="20" id="nickname" name="nickname" value="{$member_info.nickname}"></span>
<!--                     <span>&nbsp;&nbsp;隐私设置</span>-->
                </dd>
            </dl>
            <dl>
                <dt>邮箱：</dt>
                <dd><span class="w400">{$member_info.email}&nbsp;&nbsp;
                    <a href="{:U('Member/Member/modifyEmail')}">点此绑定邮箱 </a>
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
            <input type="text" class="text" maxlength="20" id="realname" name="realname" value="{$member_info.realname}">
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
                <input type="radio" name="sex" value="保密" <if condition="$member_info['sex'] eq '保密'">checked="checked"</if>>
                保密</label>
            &nbsp;&nbsp;
            <label>
                <input type="radio" name="sex" value="女" <if condition="$member_info['sex'] eq '女'">checked="checked"</if>>
                女</label>
            &nbsp;&nbsp;
            <label>
                <input type="radio" name="sex" value="男" <if condition="$member_info['sex'] eq '男'">checked="checked"</if>>
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
<!--            <dl>-->
<!--                <dt>生日：</dt>-->
<!--                <dd><span class="w400">-->
<!--            <input type="text" class="text hasDatepicker" name="birthday" maxlength="10" id="birthday" value="{$member_info.birthday|date='Y-m-d',###}" readonly="readonly">-->
<!--            </span>-->
<!--                    <span>-->
<!--            <select name="privacy[birthday]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
<!--                </dd>-->
<!--            </dl>-->
            <dl>
                <dt>所在地区：</dt>
                <dd>
                    <span class="w400">
                        <if condition="$area_data['name'][0] neq ''">
                            {$area_data['name'][0]}&nbsp;&nbsp;{$area_data['name'][1]}&nbsp;&nbsp;{$area_data['name'][2]}
                        </if><br/>
                        <div id="select-area" ></div>
                        <input type="hidden" name="province_id" id="province_id" data-province="{$area_data['code'][0]}" value="">
                        <input type="hidden" name="city_id" id="city_id" data-province="{$area_data['code'][1]}" value="">
                        <input type="hidden" name="area_id" id="area_id" data-province="{$area_data['code'][2]}" value="">
                    </span>
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
            <input type="text" class="text" maxlength="30" id="qq" name="qq" value="{$member_info.qq}">
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
<!--            <dl>-->
<!--                <dt>阿里旺旺：</dt>-->
<!--                <dd><span class="w400">-->
<!--            <input name="member_ww" type="text" class="text" maxlength="50" id="member_ww" value="">-->
<!--            </span>-->
<!--                    <span>-->
<!--            <select name="privacy[ww]">-->
<!--                <option value="0" selected="selected">公开</option>-->
<!--                <option value="1">好友可见</option>-->
<!--                <option value="2">保密</option>-->
<!--            </select>-->
<!--            </span>-->
<!--                </dd>-->
<!--            </dl>-->
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
<script type="text/html" id="area-html">
    <select id="{{area_type}}" name="{{area_type}}">
        <option value="">请选择所在地区</option>
        {{if areas}}
        {{each areas as v i}}
        <option value="{{i}}">{{v}}</option>
        {{/each}}
        {{/if}}
    </select>
</script>
<script type="text/javascript">
    //注册表单验证
    $(function () {
        getArea();
        //地区选择
        $(document).on('change','#province', function () {
            var province_id = $(this).val();
            var city_data = {area_type:'city',areas:area_json.city[province_id]};
            var city_html = template('area-html', city_data);
            $('#select-area').find('.error').remove();
            $('#city').remove();
            $('#area').remove();
            $('#select-area').append(city_html);
            $('#province_id').val(province_id);
            $('#city_id').val('');
            $('#area_id').val('');
        })
        $(document).on('change','#city', function () {
            var city_id = $(this).val();
            $('#select-area').find('.error').remove();
            if(area_json.area[city_id] != undefined){
                var area_data = {area_type:'area',areas:area_json.area[city_id]};
                var area_html = template('area-html', area_data);
                $('#area').remove();
                $('#select-area').append(area_html);
            }
            $('#city_id').val(city_id);
            $('#area_id').val('');
        })
        $(document).on('change','#area', function () {
            $('#select-area').find('.error').remove();
            $('#area_id').val($(this).val());

        })
        $('#myForm').submit(function () {
            var data = {};
            var qq       = $('#qq').val();
            var nickname = $('#nickname').val();
            if($.trim(nickname) == ''){
                showDialog('请先起一个昵称哦', 'alert', '错误信息', null, true, null, '', '', '');
                return false;
            } else {
                data.nickname = nickname;
            }
            if(qq){
                if(!/^[1-9][0-9]{4,}$/.test(qq)){
                    showDialog('QQ号格式不对哦', 'alert', '错误信息', null, true, null, '', '', '');
                    return false;
                } else {
                    data.qq = qq;
                }
            }
            data.sex           = $('input[name=sex]:checked').val();
            data.realname      = $('#realname').val();
            data.province_name = $('select[name=province] option:selected').text();
            data.city_name     = $('select[name=city] option:selected').text();
            data.area_name     = $('select[name=area] option:selected').text();
            data.province_id   = $('#province_id').val();
            data.city_id       = $('#city_id').val();
            data.area_id       = $('#area_id').val();
            $.getJSON("{:U('Member/Member/editMember')}", data, function (res) {
                if(res.status == 'success'){
                    window.location.href = res.url;
                } else {
                    showDialog(res.msg, 'alert', '错误信息', null, true, null, '', '', '');
                }
            })
            return false;
        })

        //获取地理位置
        function getArea(){
            $.getJSON("{:U('Member/Address/getArea')}", function (res) {
                area_json = res.data.area;
                //设置省
                var province_data = {area_type:'province',areas:area_json.province};
                var province_html = template('area-html', province_data);
                $('#select-area').html(province_html);
            })
        }
    });
</script>