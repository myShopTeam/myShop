<template file="Site/new_head.php" />

<body>
<!--页头-->
<template file="Site/new_header.php" />
<!--导航-->
<template file="Site/new_naviga.php" />
<!-- 内容 -->
<div class="w100 neiBannerBox"><div class="w100 neiBanner neiBanner01"></div><div class="bgLine"></div></div>
<div class="w content">
    <!--left-->
    <template file="Site/new_left.php" />
    <div class="fr nb_cent_r">
        <div class="webMapTitle">
            <span class="wz">您所在的位置：</span><a href="/">首页</a> &gt; <a href="javascript:;">{:getCategory($parentid, 'catname')}</a> &gt; <a class="last" href="{:U('Content/Index/lists', array('catid' => $catid))}">{:getCategory($catid, 'catname')}</a>
        </div>
        <div class="RightContent">
            <!-- 内容 -->
            <content action="lists" catid="$catid" num="1" moreinfo="1" order="listorder DESC, id DESC">
                <volist name="data" id="vo" key="k">
                    <div class="ContactUsBox">
                        <div class="ContactUs">
                            <div class="fl ctInfo">
                                <h3>{$vo.title}</h3>
                                <p><span class="ct_tel">电话：{$vo.phone}</span></p>
                                <p><span class="ct_email">邮箱：{$vo.email}</span></p>
                                <p><span class="ct_url">网址：{$vo.site_url}</span></p>
                                <p><span class="ct_address">地址：{$vo.address}</span></p>
                                <content action="lists" catid="53" num="1" moreinfo="1" order="listorder DESC, id DESC">
                                    <volist name="data" id="v" key="k">
                                        <h3 class="mt30">{$v.title}</h3>
                                        <php>
                                            $tel_arr   = explode('|', $v['tel']);
                                            $phone_arr = explode('|', $v['phone']);
                                        </php>

                                        <volist name="phone_arr" id="phone" key="ko">
                                            <p>
                                                <span class="ct_tel">座机：{$phone_arr[$ko-1]}</span>
                                                <if condition="$tel_arr[$ko-1] neq ''">
                                                <span class="ct_phone">手机：{$tel_arr[$ko-1]}</span>
                                                </if>
                                            </p>
                                        </volist>
                                    </volist>
                                </content>
                            </div>
                            <div class="fr ctMaps">
                                <iframe src="{$vo.map}?company={$vo.title}&phone={$vo.phone}&telephone={$vo.telephone}&address={$vo.address}" frameborder=0 scrolling="no" width="570" height="320"></iframe>
                            </div>
                            <div class="clear clearfix"></div>
                        </div>
                        <div class="ContactUs">
                            <div class="ctInfo">
                                <content action="lists" catid="53" num="4" moreinfo="1" order="listorder DESC, id DESC">
                                    <volist name="data" id="v" key="k">
                                        <if condition="$k neq 1">
                                        <php>
                                            $tel_arr   = explode('|', $v['tel']);
                                            $phone_arr = explode('|', $v['phone']);
                                        </php>

                                        <h3>{$v.title}</h3>
                                        <volist name="phone_arr" id="phone" key="ko">
                                            <p>
                                                <span class="ct_tel">座机：{$phone_arr[$ko-1]}</span>
                                                <if condition="$tel_arr[$ko-1] neq ''">
                                                <span class="ct_phone">手机：{$tel_arr[$ko-1]} </span>
                                                </if>
                                            </p>
                                        </volist>
                                        </if>
                                    </volist>
                                </content>
                            </div>
                        </div>
                    </div>
                </volist>
            </content>
        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
</body>
</html>