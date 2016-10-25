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
                <div class="article_tit">{$title}</div>
                <div class="article_time">来源：{$copyfrom|default='国安救援'} 日期：{$updatetime} &nbsp;&nbsp;&nbsp;浏览：{$views}次</div>
                <div class="article_content tcc twb">
                    {$content}
                </div>
                <div class="article_sh">
                    <div class="left">
                        <p>上一篇：<pre catid="$catid" id="$id" target="1" msg="已经没有了" /> </p>
                        <p>下一篇：<next catid="$catid" id="$id" target="1" msg="已经没有了" /></p>
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
</body>
</html>