<template file="Site/new_head.php" />

<body>
<!--页头-->
<div class="header">
    <div class="w">
        <div class="header_left">
            <a href="javascript:void(0)" onclick="SetHome(this, window.location)">设为首页</a><span>&nbsp;|&nbsp;</span>
            <a href="javascript:void(0)" onclick="AddFavorite(window.location, document.title)">加入收藏</a>
        </div>
        <div class="header_right">
            
            <div class="header_rlink">
                <p><span>服务热线：</span><em>{:cache('Config.telephone')}</em></p>
            </div>
        </div>
    </div>
</div>
<!--导航-->
<template file="Site/new_naviga.php" />
<!-- Start Slider Wrapper -->
<template file="Site/new_banner.php" />
<!-- End Slider Wrapper -->
<!--产品列表-->
<div class="w">
    <div class="mt20 index_Product_list">
        <ul>
            <content action="category" catid="47" num="4" order="listorder ASC">
                <volist name="data" id="vo" key="k">
                    <li class="pro_0{$k}"><h3 class="Title">{$vo.catname}</h3><div class="ProImgBox"><a href="{$vo.url}"><img src="{$site_info.enterprise_path}images/Pro_img_01.jpg" /><p></p></a></div></li>
                </volist>
            </content>
        </ul>
        <!--clear float-->
        <div class="clear clearfix"></div>
    </div>
    <div class="mt35 AboutBox">
        <div class="fl">
            <h3 class="IndexTitle blueBg"><span>{:getCategory(34,'catname')}</span><em>{:getCategory(34,'catdir')}</em><a href="{:U('Content/Index/lists', array('catid' => 34))}"><img src="{$site_info.enterprise_path}images/About_more.jpg" /></a></h3>
            <div class="AboutPic mt15">
                <div class="PicBox">
                    <ul class="PicUl" id="PicListUl">
                        <content action="lists" catid="34" num="6" order="listorder DESC, id DESC">
                            <volist name="data" id="vo" key="k">
                                <li><a href="{$vo.url}"><img src="{$vo.thumb}" /></a></li>
                            </volist>
                        </content>
                    </ul>
                    <div class="b_c_dian" id="b_c_dian"></div>
                </div>
            </div>
        </div>
        <div class="fl ml15 AboutUs">
            <h3 class="IndexTitle blueBg"><span>{:getCategory(52,'catname')}</span><em>{:getCategory(52,'catdir')}</em><a href="{:U('Content/Index/lists', array('catid' => 52))}"><img src="{$site_info.enterprise_path}images/About_more.jpg" /></a></h3>
            <div class="mt20 AbCont">
                <content action="lists" catid="52" num="1" order="listorder DESC, id DESC">
                    <volist name="data" id="vo" key="k">
                        <p class="imgBox"><img src="{$vo.thumb}" /></p>
                        <p class="abcon_p">{$vo.description}</p>
                    </volist>
                </content>
            </div>
        </div>
        <div class="fr NewsBox">
            <h3 class="IndexTitle blueBg"><span>{:getCategory(19,'catname')}</span><em>{:getCategory(19,'catdir')}</em><a href="{:getCategory(19,'catdir')}"><img src="{$site_info.enterprise_path}images/About_more.jpg" /></a></h3>
            <ul class="mt15">
                <content action="lists" catid="19" num="8" order="listorder DESC, id DESC">
                   <volist name="data" id="vo" key="k">
                       <li><a href="{$vo.url}">{$vo.title|str_cut=21}</a><span>{$vo.updatetime|date='Y-m-d',###}</span></li>
                   </volist>
                </content>
            </ul>
        </div>
    </div>
    <div class="ContactBox">
        <h3 class="IndexTitle orangeBg"><span>{:getCategory(42,'catname')}</span><em>{:getCategory(42,'catdir')}</em><a href="#"><img src="{$site_info.enterprise_path}images/ContactMore.jpg" /></a></h3>
        <div class="Contact">
            <div class="tactL fl">
                <content action="lists" catid="42" num="1" moreinfo="1" order="listorder DESC, id DESC">
                   <volist name="data" id="vo" key="k">
                       <!-- -->
                       <php>$company_info = $vo;</php>
                       <div class="ewmBox">
                           <img src="{$vo.thumb}" />
                       </div>
                       <div class="PhoneTel mt5">
                           <p class="up">全国咨询服务专线</p>
                           <p class="down">{$vo.server_tel}</p>
                       </div>
                       <div class="tactInfo mt15">
                           <p>座机：{$vo.phone}</p>
                           <p>手机：{$vo.telephone}</p>
                           <p>地址：{$vo.address}</p>
                       </div>
                   </volist>
                </content>
            </div>
            <div class="tactR fr">
                <div class="DownLoadBox">
                    <a href="#"><img src="{$site_info.enterprise_path}images/dl_icon_01.png" /></a>
                    <a href="#"><img src="{$site_info.enterprise_path}images/dl_icon_02.png" /></a>
                    <a href="#"><img src="{$site_info.enterprise_path}images/dl_icon_03.png" /></a>
                </div>
                <!--<p class="chengNuo">我们的服务及承诺：<a href="#">保修期内全年一级电话服务<span>/</span></a><a href="#">维修快速响应</a><span>/</span><a href="#">特殊情况维护</a><span>/</span><a href="#">软件服务支持</a></p>-->
                <div class="mt25 MapBox">
                    <iframe src="/mapsIndex.html?company={$company_info.title}&phone={$company_info.phone}&telephone={$company_info.telephone}&address={$company_info.address}" frameborder=0 scrolling="no" width="780" height="210"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
<script type="text/javascript">
    // Nivo Slider
    $(window).load(function () {
        $('#nivoSlider').nivoSlider({
            effect: 'random', // 切换样式：random
            animSpeed: 500, // 滑动转换速度
            pauseTime: 3500, // 多久每张幻灯片显示
            startSlide: 0, // 设置开始滑动（0指数）
            captionOpacity: 0.8 // 通用标题不透明度
        });
    });
</script>
</body>
</html>