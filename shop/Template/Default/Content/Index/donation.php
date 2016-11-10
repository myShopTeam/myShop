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
            <span class="wz">您所在的位置：</span><a href="/">首页</a> &gt; <a href="javascript:;">{:getCategory($parentid, 'catname')}</a> &gt; <a class="last" href="{:U('Content/Index/donation', array('catid' => $catid))}">{:getCategory($catid, 'catname')}</a>
        </div>
        <div class="RightContent">
            <!-- 内容 -->
            <div class="DonationBox">
                <ul>
                    <li class="fl">
                        <div class="imgBox"><a href="{:U('Content/Index/doDetail', array('catid' => $catid))}"><img src="{$site_info.enterprise_path}images/juanz_img01.jpg" /></a></div>
                        <div class="cenBox">
                            <h3><a href="#">壹基金温暖包</a></h3>
                            <h4>您的每一份爱心，都能帮助到一名受灾地区的困境儿童。</h4>
                            <p>公益组织：深圳壹基金公益基金会</p>
                            <p><a href="javascript:ShowBox('壹基金温暖包','id')" class="btn_Jz"></a><em>已有 <i>7</i> 人捐款</em></p>
                        </div>
                    </li>
                    <li class="fr">
                        <div class="imgBox"><a href="{:U('Content/Index/doDetail', array('catid' => $catid))}"><img src="{$site_info.enterprise_path}images/juanz_img02.jpg" /></a></div>
                        <div class="cenBox">
                            <h3><a href="#">壹基金温暖包</a></h3>
                            <h4>您的每一份爱心，都能帮助到一名受灾地区的困境儿童。</h4>
                            <p>公益组织：深圳壹基金公益基金会</p>
                            <p><a href="javascript:ShowBox('壹基金温暖包','id')" class="btn_Jz"></a><em>已有 <i>7</i> 人捐款</em></p>
                        </div>
                    </li>
                    <li class="fl">
                        <div class="imgBox"><a href="{:U('Content/Index/doDetail', array('catid' => $catid))}"><img src="{$site_info.enterprise_path}images/juanz_img03.jpg" /></a></div>
                        <div class="cenBox">
                            <h3><a href="#">壹基金温暖包</a></h3>
                            <h4>您的每一份爱心，都能帮助到一名受灾地区的困境儿童。</h4>
                            <p>公益组织：深圳壹基金公益基金会</p>
                            <p><a href="javascript:ShowBox('壹基金温暖包','id')" class="btn_Jz"></a><em>已有 <i>7</i> 人捐款</em></p>
                        </div>
                    </li>
                    <li class="fr">
                        <div class="imgBox"><a href="{:U('Content/Index/doDetail', array('catid' => $catid))}"><img src="{$site_info.enterprise_path}images/juanz_img04.jpg" /></a></div>
                        <div class="cenBox">
                            <h3><a href="#">壹基金温暖包</a></h3>
                            <h4>您的每一份爱心，都能帮助到一名受灾地区的困境儿童。</h4>
                            <p>公益组织：深圳壹基金公益基金会</p>
                            <p><a href="javascript:ShowBox('壹基金温暖包','id')" class="btn_Jz"></a><em>已有 <i>7</i> 人捐款</em></p>
                        </div>
                    </li>
                    <li class="fl">
                        <div class="imgBox"><a href="{:U('Content/Index/doDetail', array('catid' => $catid))}"><img src="{$site_info.enterprise_path}images/juanz_img05.jpg" /></a></div>
                        <div class="cenBox">
                            <h3><a href="#">壹基金温暖包</a></h3>
                            <h4>您的每一份爱心，都能帮助到一名受灾地区的困境儿童。</h4>
                            <p>公益组织：深圳壹基金公益基金会</p>
                            <p><a href="javascript:ShowBox('壹基金温暖包','id')" class="btn_Jz"></a><em>已有 <i>7</i> 人捐款</em></p>
                        </div>
                    </li>
                    <li class="fr">
                        <div class="imgBox"><a href="{:U('Content/Index/doDetail', array('catid' => $catid))}"><img src="{$site_info.enterprise_path}images/juanz_img06.jpg" /></a></div>
                        <div class="cenBox">
                            <h3><a href="#">壹基金温暖包</a></h3>
                            <h4>您的每一份爱心，都能帮助到一名受灾地区的困境儿童。</h4>
                            <p>公益组织：深圳壹基金公益基金会</p>
                            <p><a href="javascript:ShowBox('壹基金温暖包','id')" class="btn_Jz"></a><em>已有 <i>7</i> 人捐款</em></p>
                        </div>
                    </li>
                </ul>
            </div>

            <!--分页-->
            <div class="pagelist">
                <div class="pager">
                    <span class="pageinfo"> 共105 页 页次:12/105 页</span>
                    <a href='#'>首页</a>
                    <a href='#'>上一页</a>
                    <a href="#">1</a>
                    <span class="cpb">2</span>
                    <a href="#">下一页</a>
                    <a href='#'>尾页</a>
                </div>
            </div>
            <div class="clear clearfix"></div>
            <!--/分页-->
        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
<script type="text/javascript">
    $(document).ready(function () {

    })
    function ShowBox(title, id)
    {

        $("body").append("<div class=\"ShowBox\"><div class=\"closeMonthBox\"><h5 class=\"title\">捐赠项目：" + title + "<span class=\"closeBox\"></span></h5><div class=\"cont\"><img src=\"images/ewm.jpg\"><p>微信扫描二维码 快速捐款</p><p style=\"text-align:left;padding:0px 30px;margin-top:15px;color:#a9a9a9;\">温馨提示：打开微信扫一扫，扫码捐赠<br></p></div></div></div>")
        $(".closeMonthBox .closeBox").unbind("click");
        $(".closeMonthBox .closeBox").bind("click", function () {
            $(".ShowBox").remove();
        })
    }
</script>
</body>
</html>