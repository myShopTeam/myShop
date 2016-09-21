<div class="w100 BannerBox">
    <div class="BanBg"></div>
    <div class="w slider">
        <div class="slider-wrapper">
            <!-- Start Nivo Slider -->
            <div class="theme-default">
                <div id="nivoSlider" class="nivoSlider nivoBanner">
                    <content action="lists" catid="12" order="listorder desc, id desc">
                        <volist name="data" id="vo">
                            <img src="{$vo.thumb}" alt=""/>
                        </volist>
                    </content>
                </div>
            </div>
        </div>
    </div>
</div>
