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
            <li class="pro_01"><h3 class="Title">健康医生</h3><div class="ProImgBox"><a href="#"><img src="{$site_info.enterprise_path}images/Pro_img_01.jpg" /><p></p></a></div></li>
            <li class="pro_02"><h3 class="Title">白金十分钟</h3><div class="ProImgBox"><a href="#"><img src="{$site_info.enterprise_path}images/Pro_img_02.jpg" /><p></p></a></div></li>
            <li class="pro_03"><h3 class="Title">保险服务咨询</h3><div class="ProImgBox"><a href="#"><img src="{$site_info.enterprise_path}images/Pro_img_03.jpg" /><p></p></a></div></li>
            <li class="pro_04"><h3 class="Title">旅行/道路救援</h3><div class="ProImgBox"><a href="#"><img src="{$site_info.enterprise_path}images/Pro_img_04.jpg" /><p></p></a></div></li>
        </ul>
        <!--clear float-->
        <div class="clear clearfix"></div>
    </div>
    <div class="mt35 AboutBox">
        <div class="fl">
            <h3 class="IndexTitle blueBg"><span>视频中心</span><em>Videos</em><a href="#"><img src="{$site_info.enterprise_path}images/About_more.jpg" /></a></h3>
            <div class="AboutPic mt15">
                <div class="PicBox">
                    <ul class="PicUl" id="PicListUl">
                        <li><a href="#"><img src="{$site_info.enterprise_path}images/AboutPic_img_01.jpg" /></a></li>
                        <li><a href="#"><img src="{$site_info.enterprise_path}images/AboutPic_img_02.jpg" /></a></li>
                        <li><a href="#"><img src="{$site_info.enterprise_path}images/AboutPic_img_01.jpg" /></a></li>
                        <li><a href="#"><img src="{$site_info.enterprise_path}images/AboutPic_img_02.jpg" /></a></li>
                    </ul>
                    <div class="b_c_dian" id="b_c_dian"></div>
                </div>
            </div>
        </div>
        <div class="fl ml15 AboutUs">
            <h3 class="IndexTitle blueBg"><span>关于我们</span><em>About us</em><a href="#"><img src="{$site_info.enterprise_path}images/About_more.jpg" /></a></h3>
            <div class="mt20 AbCont">
                <p class="imgBox"><img src="{$site_info.enterprise_path}images/AboutUsImg.jpg" /></p>
                <p class="abcon_p">投身中国救援事业，构建民族救援体系”，是我近两年来与人交流时的永恒主题。紧急救援，对我而言就是深深的烙在我的脑海中和心里面了，我想这可能就是我一辈子的事业。理想很宏大，但是我觉得哪怕是为中国救援事业的发展发一句声，出一份力，未来成为我们民族救援体系的螺丝钉，那也是功德无量的善举。所以，在我接触了救援理念从事了救援卡销售和合伙组建救援咨询公司之后...</p>
            </div>
        </div>
        <div class="fr NewsBox">
            <h3 class="IndexTitle blueBg"><span>最新公告</span><em>Announcement</em><a href="#"><img src="{$site_info.enterprise_path}images/About_more.jpg" /></a></h3>
            <ul class="mt15">
                <li><a href="#">襄阳志愿者培训圆满结束</a><span>2016-9-18</span></li>
                <li><a href="#">意大利中部地震死亡人数升至250人</a><span>2016-9-18</span></li>
                <li><a href="#">襄阳志愿者应急救援公益培训开班通知</a><span>2016-9-18</span></li>
                <li><a href="#">国安家园第四期“应急救援员”培训圆满结束</a><span>2016-9-18</span></li>
                <li><a href="#">未来5天干流水位将持续下降 武汉解除防汛...</a><span>2016-9-18</span></li>
                <li><a href="#">暴雨蓝色预警发布：陕西山西等4省局地有...</a><span>2016-9-18</span></li>
                <li><a href="#">国安家园第四期“应急救援员”开班通知</a><span>2016-9-18</span></li>
                <li><a href="#">国安家园第四期“应急救援员”开班通知</a><span>2016-9-18</span></li>
            </ul>
        </div>
    </div>
    <div class="ContactBox">
        <h3 class="IndexTitle orangeBg"><span>联系我们</span><em>Contact Us</em><a href="#"><img src="{$site_info.enterprise_path}images/ContactMore.jpg" /></a></h3>
        <div class="Contact">
            <div class="tactL fl">
                <div class="ewmBox">
                    <img src="{$site_info.enterprise_path}images/ftzn_Ewm.png" />
                </div>
                <div class="PhoneTel mt5">
                    <p class="up">全国咨询服务专线</p>
                    <p class="down">4001 - 120 - 185</p>
                </div>
                <div class="tactInfo mt15">
                    <p>座机：027-50668224</p>
                    <p>手机：15527767799</p>
                    <p>地址：武汉市硚口区古田二路汇丰企业天地汇贤楼1</p>
                </div>
            </div>
            <div class="tactR fr">
                <div class="DownLoadBox">
                    <a href="#"><img src="{$site_info.enterprise_path}images/dl_icon_01.png" /></a>
                    <a href="#"><img src="{$site_info.enterprise_path}images/dl_icon_02.png" /></a>
                    <a href="#"><img src="{$site_info.enterprise_path}images/dl_icon_03.png" /></a>
                </div>
                <!--<p class="chengNuo">我们的服务及承诺：<a href="#">保修期内全年一级电话服务<span>/</span></a><a href="#">维修快速响应</a><span>/</span><a href="#">特殊情况维护</a><span>/</span><a href="#">软件服务支持</a></p>-->
                <div class="mt25 MapBox">
                    <iframe src="/mapsIndex.html" frameborder=0 scrolling="no" width="780" height="210"></iframe>
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