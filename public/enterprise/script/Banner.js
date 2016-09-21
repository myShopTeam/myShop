/*
*   JQuery 1.9.1
*   leiyu  2015-1-20
*   修改前请先备份
*/
$(document).ready(function () {
    //获取操作的对象
    var banLi = $("#PicListUl>li");
    //Banner 点
    function BanDian() {
        var strTxt = "";
        for (var i = 0; i < banLi.length; i++) {
            strTxt += '<a></a>';
        }
        $("#b_c_dian").html(strTxt);
    }
    BanDian();
    var bdian = $("#b_c_dian>a").siblings().andSelf();

    // Index
    var index = 0, old_index = 0;
    function BannerMove() {
        index = index > banLi.length - 1 ? 0 : index < 0 ? banLi.length - 1 : index;
        banLi.css({ opacity: 0, "z-index": 7 });
        banLi.eq(old_index).css({ opacity: 1, "z-index": 8 });
        banLi.eq(index).css({ "z-index": 9 }).stop().animate({ opacity: 1 }, 500);
        bdian.removeClass("thisli");
        bdian.eq(index).addClass("thisli");
    }
    BannerMove();

    bdian.click(function () {
        old_index = index;
        index = bdian.length - $(this).nextAll().length - 1;
        BannerMove();
        MoveAuto();
    })

    //banner自动播放
    var BannerAuto;
    function MoveAuto() {
        clearInterval(BannerAuto);
        BannerAuto = setInterval(function () {
            old_index = index;
            index++;
            BannerMove();
        }, 3500);
    }
    MoveAuto();
});