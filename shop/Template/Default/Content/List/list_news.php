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
            <div class="RC_NewsList">
                <div class="news_first">
                    <content action="lists" catid="$catid" num="1" moreinfo="1" order="listorder DESC, id DESC">
                        <volist name="data" id="vo">
                            <a href="{$vo.url}"><img class="fl n_f_img" src="{$vo.thumb}"></a>
                            <div class="fr n_f_con">
                                <h3><a href="{$vo.url}">{$vo.title}</a><span>{$vo.updatetime|date='Y-m-d',###}</span></h3>
                                <p>{$vo.description}</p>
                            </div>
                        </volist>
                    </content>
                </div>
                <ul class="mt20 news_ul">
                    <content action="lists" catid="$catid" num="16" moreinfo="1" order="listorder DESC, id DESC" page="$page">
                        <volist name="data" id="vo" key="k">
                            <if condition="$k neq 1">
                                <li><a href="{$vo.url}">{$vo.title}</a><span>{$vo.updatetime|date='Y-m-d',###}</span></li>
                            </if>
                        </volist>
                    </content>
                </ul>
            </div>
            <!--分页-->
            <div class="mt30 pagelist">
                <div class="pager">
                    {$pages}
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
</body>
</html>