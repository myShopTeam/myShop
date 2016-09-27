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
        <!-- 内容 -->
        <div class="RightContent">
            <div class="article_box">
                <content action="lists" catid="$catid" num="1" moreinfo="1" order="listorder DESC, id DESC">
                    <volist name="data" id="vo" key="k">
                        <div class="article_tit">{$vo.title}</div>
                        <div class="article_time"></div>
                        <div class="Culture">
                            {$vo.content}
                        </div>
                    </volist>
                </content>
            </div>
        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
</body>
</html>