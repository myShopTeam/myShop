<div class="eject_con">
    <div class="adds">
        <div id="warning"></div>
        <form method="post" action="{:U('Member/Member/modifyAddress')}" id="address_form" target="_parent">
            <input type="hidden" name="addr_id" value="{$id}" />
            <input type="hidden" name="province" id="province_id" value="{$province}">
            <input type="hidden" name="city" id="city_id" value="{$city}">
            <input type="hidden" name="area" id="area_id" value="{$area}">
            <dl>
                <dt><i class="required">*</i>收货人：</dt>
                <dd>
                    <input type="text" class="text w100" name="full_name" value="{$full_name}"/>
                    <p class="hint">请填写您的真实姓名</p>
                </dd>
            </dl>
            <dl>
                <dt><i class="required">*</i>所在地区：</dt>
                    <dd id="select-area">
                        <if condition="$id neq ''">
                            {$province_name}&nbsp;&nbsp;{$city_name}&nbsp;&nbsp;{$area_name}
                            <input type="button" id="modify-address" class="input-btn" value="编辑">
                        <else/>
                                <select>
                                    <option value="">-请选择-</option>
                                </select>
                        </if>
                    </dd>

            </dl>
            <dl>
                <dt><i class="required">*</i>街道地址：</dt>
                <dd>
                    <input class="text w300" type="text" name="address" value="{$address}"/>
                    <p class="hint">不必重复填写地区</p>
                </dd>
            </dl>
            <dl>
                <dt><i class="required">*</i>电话号码：</dt>
                <dd>
                    <input type="text" class="text w200" name="phone" value="{$phone}"/>
                    <p class="hint">区号 - 电话号码 - 分机</p>
                </dd>
            </dl>
            <dl>
                <dt><i class="required">*</i>手机号码：</dt>
                <dd>
                    <input type="text" class="text w200" name="mobile_phone" value="{$mobile_phone}"/>
                </dd>
            </dl>
            <dl>
                <dt><em class="pngFix"></em>设为默认地址：</dt>
                <dd>
                    <input type="checkbox" class="checkbox vm mr5"  name="default_address" id="is_default" value="1" <if condition="$default_address eq 1">checked</if>/>
                    <label for="is_default">设置为默认收货地址</label>
                </dd>
            </dl>
            <div class="bottom">
                <label class="submit-border">
                    <input type="submit" class="submit" value="编辑地址" />
                </label>
                <a class="ncbtn ml5" href="javascript:DialogManager.close('my_address_edit');">取消</a> </div>
        </form>
    </div>
</div>
<script type="text/html" id="area-html">
    <select id="{{area_type}}" name class="valid">
        <option value="">-请选择-</option>
        {{if areas}}
        {{each areas as v i}}
        <option value="{{i}}">{{v}}</option>
        {{/each}}
        {{/if}}
    </select>
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#region").nc_region();
        $('#address_form').validate({
            submitHandler:function(form){
                alert(1111);
                return false;
                ajaxpost('address_form', '', '', 'onerror');
            },
            errorLabelContainer: $('#warning'),
            invalidHandler: function(form, validator) {
                var errors = validator.numberOfInvalids();
                if(errors)
                {
                    $('#warning').show();
                }
                else
                {
                    $('#warning').hide();
                }
            },
            rules : {
                true_name : {
                    required : true
                },
                address : {
                    required : true
                },
                region : {
                    checklast: true
                },
                tel_phone : {
                    required : check_phone,
                    minlength : 6,
                    maxlength : 20
                },
                mob_phone : {
                    required : check_phone,
                    minlength : 11,
                    maxlength : 11,
                    digits : true
                }
            },
            messages : {
                true_name : {
                    required : '请填写收货人姓名'
                },
                address : {
                    required : '请填写详细地址'
                },
                tel_phone : {
                    required : '固定电话和手机请至少填写一项.',
                    minlength: '电话号码由数字、加号、减号、空格、括号组成,并不能少于6位. ',
                    maxlength: '电话号码由数字、加号、减号、空格、括号组成,并不能少于6位. '
                },
                mob_phone : {
                    required : '固定电话和手机请至少填写一项.',
                    minlength: '错误的手机号码',
                    maxlength: '错误的手机号码',
                    digits : '错误的手机号码'
                }
            },
            groups : {
                phone:'tel_phone mob_phone'
            }
        });
        $(document).on('click','#modify-address', function () {
            getArea();
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
        //地区选择
        $(document).on('change','#province', function () {
            var province_id = $(this).val();
            var city_data = {area_type:'city',areas:area_json.city[province_id]};
            var city_html = template('area-html', city_data);
            $('#city').remove();
            $('#area').remove();
            $('#select-area').append(city_html);
            $('#province_id').val(province_id);
            $('#city_id').val('');
            $('#area_id').val('');
        })
        $(document).on('change','#city', function () {
            var city_id = $(this).val();
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
            $('#area_id').val($(this).val());

        })
    });
    function check_phone(){
        return ($('input[name="phone"]').val() == '' && $('input[name="mobile_phone"]').val() == '');
    }
</script>