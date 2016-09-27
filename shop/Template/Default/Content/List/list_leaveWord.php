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
            <div class="article_box">
                <div class="article_tit">{:getCategory($catid, 'catname')}</div>
                <div class="article_time"></div>
            </div>
            <div class="MessageBox">
                <h3 class="title">如果您有什么问题或是建议请给我们留言，仔细填写下方选项，我们将第一时间给您回复！</h3>
                <form action="" method="post">
                    <table class="w100" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>公司名称：</th>
                            <td><input type="text" class="txt" /></td>
                            <th>公司地址：</th>
                            <td><input type="text" class="txt" /></td>
                        </tr>
                        <tr>
                            <th>联系人：</th>
                            <td><input type="text" class="txt" /></td>
                            <th>联系电话：</th>
                            <td><input type="text" class="txt" /></td>
                        </tr>
                        <tr>
                            <th>QQ号：</th>
                            <td><input type="text" class="txt" /></td>
                            <th>E-mail：</th>
                            <td><input type="text" class="txt" /></td>
                        </tr>
                    </table>
                    <dl>
                        <dt>留言内容：</dt>
                        <dd><textarea class="reachTxt"></textarea></dd>
                        <div class="clear clearfix"></div>
                    </dl>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd><input type="button" class="btn btnYes" value="确认提交" /><input type="button" class="btn btnReset" value="重新填写" /></dd>
                        <div class="clear clearfix"></div>
                    </dl>
                </form>
                
            </div>
        </div>
    </div>
    <div class="clear clearfix"></div>
</div>
<!--页脚-->
<template file="Site/new_footer.php" />
</body>
</html>