<template file="Site/new_head.php" />

<body>
<!--页头-->
<template file="Site/new_header.php" />
<!--导航-->
<template file="Site/new_naviga.php" />
<!-- 内容 -->
<div class="w100 neiBannerBox"><div class="w100 neiBanner neiBanner01"></div><div class="bgLine"></div></div>
<!-- 内容 -->
<div class="w content">
    <!--left-->
    <template file="Site/new_left.php" />
    <div class="fr nb_cent_r">
        <div class="webMapTitle">
            <span class="wz">您所在的位置：</span><a href="/">首页</a> &gt; <a href="javascript:;">{:getCategory($parentid, 'catname')}</a> &gt; <a class="last" href="{:U('Content/Index/lists', array('catid' => $catid))}">{:getCategory($catid, 'catname')}</a>
        </div>
        <div class="RightContent">
            <!-- 内容 -->
            <div class="article_box">
                <div class="article_tit">{:getCategory($catid, 'catname')}</div>
                <div class="article_time"></div>
            </div>
            <div class="MessageBox">
                <h3 class="title">如果您有什么问题或是建议请给我们留言，仔细填写下方选项，我们将第一时间给您回复！</h3>
                <form id="myForm" action="{:U('Content/Index/onlineMessage')}" method="post">
                    <table class="w100" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>公司名称：</th>
                            <td><input type="text" name="company" class="txt" check-type="empty" check-error="请输入公司名称" /></td>
                            <th>公司地址：</th>
                            <td><input type="text" name="address" class="txt" check-type="empty" check-error="请输入公司地址" /></td>
                        </tr>
                        <tr>
                            <th>联系人：</th>
                            <td><input type="text" name="contacts" class="txt" check-type="empty" check-error="请输入联系人姓名" /></td>
                            <th>联系电话：</th>
                            <td><input type="text" name="tel" class="txt" check-type="mobile|phone" check-error="联系人电话格式不正确" /></td>
                        </tr>
                        <tr>
                            <th>QQ号：</th>
                            <td><input type="text" name="qq" class="txt" check-type="qq" check-error="QQ号格式不正确" /></td>
                            <th>E-mail：</th>
                            <td><input type="text" name="email" class="txt" check-type="email" check-error="邮箱格式不正确" /></td>
                        </tr>
                    </table>
                    <dl>
                        <dt>留言内容：</dt>
                        <dd><textarea class="reachTxt" name="content" check-error="请输入留言内容"></textarea></dd>
                        <div class="clear clearfix"></div>
                    </dl>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd><input type="submit" class="btn btnYes" value="确认提交" /><input type="button" class="btn btnReset" value="重新填写" /></dd>
                        <div class="clear clearfix"></div>
                    </dl>
                </form>

            </div>
        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
<script>
    $(function () {
        $('#myForm').submit(function () {
            var checkError = 0;
            var url = $(this).attr('action');
            if(!url) {
                console.log('表单URL为空');
                return false;
            }
            $.each($(this).serializeArray(), function (k,v) {
                var thisObj = $('*[name=' + v.name + ']');
                //验证类型
                var dataType  = thisObj.attr('check-type');
                if($.trim(dataType) != ''){
                    var data      = thisObj.val();
                    var dataError = thisObj.attr('check-error');
                    //数据格式不对时
                    var check = checkDataType(data, dataType);
                    if(check === 'error'){
                        checkError = 1;
                        alert(dataError);
                        return false;
                    }
                }

            })

            if(checkError == 1) {
                return false;
            }
            $.ajax({
                url:url,
                type:'post',
                dataType:'json',
                data:$(this).serialize(),
                success: function (res) {
                    if(res.status == 'success'){
                        alert(res.msg);
                        $('#myForm')[0].reset();
                    } else {
                        alert(res.msg);
                        return false;
                    }
                }
            })
            return false;
        })

        function checkDataType(data, dataType){
            switch (dataType){
                case 'number' :
                    //数字判断
                    if(isNaN(data)){
                        return 'error';
                    }
                    break;

                case 'mobile' :
                    //手机号判断 156XXXXXXXX
                    if(!(/^1[34578]\d{9}$/.test(data))){
                        return 'error';
                    }
                    break;

                case 'phone' :
                    //座机号判断 027-8980XXXX
                    if(!(/^(?:(?:0\d{2,3})-)?(?:\d{7,8})(-(?:\d{3,}))?$/.test(data))){
                        return 'error';
                    }
                    break;

                case 'mobile|phone' :
                    //手机号或者座机号 联合判断
                    var mobile = (/^1[34578]\d{9}$/.test(data));
                    var phone     = (/^(?:(?:0\d{2,3})-)?(?:\d{7,8})(-(?:\d{3,}))?$/.test(data));
                    if(!mobile && !phone){
                        return 'error';
                    }
                    break;

                case 'email':
                    //邮箱格式判断
                    if (!data.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
                        return 'error';
                    }
                    break;

                case 'qq':
                    //邮QQ号格式判断
                    if(!/^[1-9][0-9]{4,}$/.test(data)){
                        return 'error';
                    }
                    break;

                case 'empty':
                    //默认验证是否为空
                    if($.trim(data) == ''){
                        return 'error';
                    }
                    break;
            }
        }

        $('.btnReset').click(function () {
            $('#myform')[0].reset();
        })
    })
</script>
</body>
</html>