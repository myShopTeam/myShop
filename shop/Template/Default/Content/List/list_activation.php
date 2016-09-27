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
            <div class="CardBox">
                <div class="TabCtrl">
                    <span class="this">卡单激活</span>
                    <span>卡单查询</span>
                    <span>保单查询</span>
                </div>
                <div class="CardActivation TabCard">
                    <div class="TabActiveation pb30">
                        <form action="" method="post">
                            <dl>
                                <dt>卡类型</dt>
                                <dd><select><option selected="selected">请选择卡片类型</option><option>家园卡1</option><option>家园卡2</option></select></dd>
                            </dl>
                            <dl>
                                <dt>卡号</dt>
                                <dd><input type="text" class="txt" /></dd>
                            </dl>
                            <dl>
                                <dt>效验码</dt>
                                <dd><input type="text" class="txt" /></dd>
                            </dl>
                            <dl>
                                <dt>验证码</dt>
                                <dd class="code"><input type="text" class="txt" /><img src="images/code_img.jpg" /><a href="#">看不清？点击更换</a></dd>
                            </dl>
                            <dl>
                                <dt></dt>
                                <dd><input type="submit" class="btn btnSubmit" value="下一步" /><input type="button" class="btn" value="取 消" /></dd>
                            </dl>
                        </form>
                    </div>
                    <div class="CardMsg tcc twb">
                        <content action="lists" catid="$catid" num="1" moreinfo="1" order="listorder DESC, id DESC">
                            <volist name="data" id="vo">
                                {$vo.content}
                            </volist>
                        </content>
                    </div>
                </div>
                <div class="CardActivation Select TabCard hide">
                    <div class="TabActiveation pb30">
                        <form action="" method="post">
                            <dl>
                                <dt>身份证</dt>
                                <dd class="code"><input type="text" class="txt" /><input type="submit" class="btn btnSubmit" value="查询" /></dd>
                            </dl>
                        </form>
                        <table class="TabSelect w100" cellpadding="0" cellspacing="0">
                            <tr>
                                <th width="85">姓名</th>
                                <th width="125">卡单类型</th>
                                <th width="210">身份证</th>
                                <th width="210">激活状态</th>
                                <th>生效日期</th>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>家园卡</td>
                                <td>360765198808272521</td>
                                <td>已激活</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>家园卡</td>
                                <td>360765198808272521</td>
                                <td>已激活</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>家园卡</td>
                                <td>360765198808272521</td>
                                <td>已激活</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>家园卡</td>
                                <td>360765198808272521</td>
                                <td>已激活</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>家园卡</td>
                                <td>360765198808272521</td>
                                <td>已激活</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>家园卡</td>
                                <td>360765198808272521</td>
                                <td>已激活</td>
                                <td>2016-09-01</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="CardActivation Select TabCard hide">
                    <div class="TabActiveation pb30">
                        <form action="" method="post">
                            <dl>
                                <dt>身份证</dt>
                                <dd class="code"><input type="text" class="txt" /><input type="submit" class="btn btnSubmit" value="查询" /></dd>
                            </dl>
                        </form>
                        <table class="TabSelect w100" cellpadding="0" cellspacing="0">
                            <tr>
                                <th width="85">姓名</th>
                                <th width="210">身份证</th>
                                <th width="210">保险合同号码</th>
                                <th width="185">保险生效日期</th>
                                <th>救援服务项目生效日期</th>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>360765198808272521</td>
                                <td>1234567890123</td>
                                <td>2016-09-01</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>360765198808272521</td>
                                <td>1234567890123</td>
                                <td>2016-09-01</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>360765198808272521</td>
                                <td>1234567890123</td>
                                <td>2016-09-01</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>360765198808272521</td>
                                <td>1234567890123</td>
                                <td>2016-09-01</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>360765198808272521</td>
                                <td>1234567890123</td>
                                <td>2016-09-01</td>
                                <td>2016-09-01</td>
                            </tr>
                            <tr>
                                <td>王子健</td>
                                <td>360765198808272521</td>
                                <td>1234567890123</td>
                                <td>2016-09-01</td>
                                <td>2016-09-01</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
<script type="text/javascript" src="{$site_info.common}js/template.js"></script>
<script type="text/javascript">
$(document).ready(function () {

    //选项卡
    $(".CardBox .TabCtrl span").click(function () {
        var index = $(this).index();
        $(".CardBox .TabCtrl span").removeClass("this");
        $(this).addClass("this");
        $(".CardBox .TabCard").addClass("hide");
        $(".CardBox .TabCard:eq(" + index + ")").removeClass("hide");


    })

    //定义全局变量
    var _global = {};
})
</script>
</body>
</html>