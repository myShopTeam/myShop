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
        <!-- 内容 -->
        <div class="RightContent">
            <div class="article_box">
                <a href="javascript:ShowBox('壹基金温暖包','id')" class="jzBtn"></a>
                <div class="article_tit">壹基金温暖包</div>
                <div class="article_time">来源：国安救援  日期：2016-09-05 浏览：305次</div>
                <div class="article_content tcc twb">
                    <p class="imgs"><img src="{$site_info.enterprise_path}images/news_img.jpg"></p>
                    <p class="ti2">8月31日18时，朝方通过图们口岸向我方提出在稳城郡稳城岛有3名人员被困，请求中方营救。19时，延边公安边防支队派出10人小组，前往图们市凉水镇凉水村对面稳城岛搜救被困人员，因无法确定人员位置，加之图们江水流湍急，无法实施营救。9月1日，按照省委书记巴音朝鲁批示要求，省防指总指挥、副省长隋忠诚紧急调度省防汛机动抢险队赶赴救援，副省长胡家福批示要求消防部队立即开展救援。12时20分，省防汛机动抢险队救援人员驾驶2艘冲锋舟与当地消防官兵一道抵达施救地点，动用无人机确定人员位置，于16时30分成功营救了朝方3名被洪水围困人员(2男1女)，18时18分将朝方被救人员送回朝鲜南阳市。</p>
                    <p class="mt15 ti2">8月31日下午，珲春市春化镇太平沟村3名参与抢险救灾的村民，在返程取钩机途中突遇山洪暴发，被困在山林中。接到救援请求后，珲春市委书记高玉龙、市长张吉峰立即带队前往救援，由于道路积水过深救援车辆和人员无法达到，随即向省防指请求救援。省防指立即协调省军区调动1架直升机，9月1日13时10分救援飞机飞赴珲春，14时50分成功营救3名被洪水围困群众。</p>
                </div>
                <div class="article_sh">
                    <div class="left">
                        <p>上一篇：<a href="#">没有了!</a> </p>
                        <p>下一篇：<a href="#">没有了!</a></p>
                    </div>
                    <div class="right">
                        <div class="share">
                            <div class="sharel">
                                <!-- Baidu Button BEGIN -->
                                <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"> <span class="bds_more">分享到：</span> <a class="bds_qzone"></a> <a class="bds_tsina"></a> <a class="bds_tqq"></a> <a class="bds_renren"></a> <a class="bds_t163"></a> <a class="shareCount"></a> </div>
                                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=775360"></script>
                                <script type="text/javascript" id="bdshell_js"></script>
                                <script type="text/javascript">
                                    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
                                </script>
                                <!-- Baidu Button END -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
<script type="text/javascript">
    $(document).ready(function () {

    })
    function ShowBox(title, id) {

        $("body").append("<div class=\"ShowBox\"><div class=\"closeMonthBox\"><h5 class=\"title\">捐赠项目：" + title + "<span class=\"closeBox\"></span></h5><div class=\"cont\"><img src=\"{$site_info.enterprise_path}images/ewm.jpg\"><p>微信扫描二维码 快速捐款</p><p style=\"text-align:left;padding:0px 30px;margin-top:15px;color:#a9a9a9;\">温馨提示：打开微信扫一扫，扫码捐赠<br></p></div></div></div>")
        $(".closeMonthBox .closeBox").unbind("click");
        $(".closeMonthBox .closeBox").bind("click", function () {
            $(".ShowBox").remove();
        })
    }
</script>
</body>
</html>