$(document).ready(function () {
    var index = 0;
    var _w = 762;
    var _liw = 110 + 5;
    var picBox = $("#PicBox");
    var picUl = $("#PicList>ul");
    var picli = $("#PicList>ul>li").siblings().andSelf();

    picUl.css({ width: picli.length * _liw });
    $(".picBtn").click(function () {
        if (!picUl.is(":animated")) {
            if ($(this).hasClass("btn_left")) {
                index--;
                if (index < 0)
                    index++;
            } else if ($(this).hasClass("btn_right")) {
                index++;
                if (index > picli.length - 5)
                    index--;
            }
            picUl.stop().animate({ left: -(index * _liw) });
        }
    }).hover(function () { $(this).stop().animate({ opacity: 0.65 }) }, function () { $(this).stop().animate({ opacity: 1 }) });

    picli.click(function () {
        var tn = $(this);
        picli.removeClass("thisli");
        tn.addClass("thisli");
        picBox.html('<img src="' + tn.children("img").attr("src") + '" />');
        PicBoxShow();
    });
    //点击显示大图
    function PicBoxShow() {
        var tn = picBox.children("img");
        var tw = tn.width();
        var th = tn.height();
        if (tw <= 30) {
            tw = _w;
        } else if (th <= 30){
            th = 540;
        }
        //alert("调试：" + tw + " | " + th);
        if (tw >= _w)
            tn.css({ width: _w, height: th * (_w / tw) });
        else if (th >= 540)
            tn.css({ width: tw * (540 / th), height: 540 });
        tw = tn.width();
        th = tn.height();
        tn.css({ left: (_w - tw) / 2, top: (540 - th) / 2 });
    }
    
    picli.eq(0).click();

    //产品信息
    var proLi = $(".ProInfoMenu>ul>li");
    var proInfo = $(".Pro_cptd");
    proLi.click(function () {
        var i = proLi.length - $(this).nextAll().length - 1;
        proLi.removeClass("thisli");
        $(this).addClass("thisli")
        proInfo.addClass("hide")
        proInfo.eq(i).removeClass("hide")
    })
});