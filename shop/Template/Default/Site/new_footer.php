<div class="w100 FooterBox">
    <div class="w Footer">
        <p class="FotMenu">
            <!--<a class="home" href="#"></a><span>|</span>
            <a class="about" href="#"></a><span>|</span>
            <a class="pro" href="#"></a><span>|</span>
            <a class="idea" href="#"></a><span>|</span>
            <a class="case" href="#"></a><span>|</span>
            <a class="ser" href="#"></a>-->
            <content action="category" catid="1" order="listorder asc">
                <volist name="data" id="vo" key="k">
                    <a href="<if condition="$vo['menuurl'] neq ''">{$vo.menuurl}<else/>{$vo.url}</if>">{$vo.catname}<if condition="$k neq count($data)"><span>|</span></if></a>
                </volist>
            </content>
        </p>
        <p class="CopyRight"><span>{:cache('Config.company')} {:cache('Config.copyright')} &nbsp;&nbsp;&nbsp;&nbsp; {:cache('Config.put_on_records')} </span><img src="{$site_info.enterprise_path}images/cnzz_pic.gif" /></p>
    </div>
</div>
<script type="text/javascript" src="{$site_info.enterprise_path}script/jquery.js"></script>
<script type="text/javascript" src="{$site_info.enterprise_path}script/Banner.js"></script>
<script type="text/javascript" src="{$site_info.enterprise_path}script/Other.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

    })
</script>
<!-- JavaScript Files -->
<script type="text/javascript" src="{$site_info.enterprise_path}script/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="{$site_info.enterprise_path}script/jquery.nivo.slider.pack.js"></script>