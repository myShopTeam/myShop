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
            <div class="RecrBox" id="RecrBox">
                <h3 class="Title">在招职位</h3>
                <content action="lists" catid="$catid" num="8" moreinfo="1" order="listorder DESC, id DESC">
                    <volist name="data" id="vo" key="k">
                        <dl>
                            <dt><span class="fl cOrange">{$vo.title}</span><span class="fr">{$vo.updatetime|date='Y-m-d',###}</span></dt>
                            <dd>
                                {$vo.content}
                            </dd>
                        </dl>
                    </volist>
                </content>
            </div>
        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
<script>
    $(function () {
        $("#RecrBox>dl>dt").click(function () { var tn = $(this); if (tn.hasClass("open")) { tn.removeClass("open"); tn.parent("dl").stop().animate({ height: $(this).outerHeight() }, 300); } else { tn.addClass("open"); tn.parent("dl").stop().animate({ height: tn.next("dd").outerHeight() + $(this).outerHeight() }, 300); } });
        $("#RecrBox>dl>dt").eq(0).click();
    })
</script>
</body>
</html>