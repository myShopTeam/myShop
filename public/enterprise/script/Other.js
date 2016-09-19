/*
*   JQuery 1.9.1
*   leiyu  2014-10-10
*   修改前请先备份
*/
$(document).ready(function () {
    /*============== imgHover ===============*/
    $(".imgHover").hover(function () { var tn = $(this); tn.stop(); tn.animate({ opacity: 0.65 }, 300); }, function () { var tn = $(this); tn.stop(); tn.animate({ opacity: 1 }, 300); });
    //返回顶部
    window.isScroll = false;//禁止页面滚动
    window.TopScroll = 0;//当前页面 ScrollTop 值
    $(window).scroll(function () { if (window.isScroll) { $("html, body").scrollTop(window.TopScroll); } if ($(this).scrollTop() != 0) { $("#back_top").css({ display: "block" }) } else { $("#back_top").css({ display: "none" }) } });
    $("#back_top").click(function () { $("html, body").animate({ scrollTop: 0 }, 500); return false; });
    //文本输入为空则返回默认文本
    $(".txtEmpty").focus(function () { if ($(this).val() == $(this).attr("txtEmpty")) $(this).val(""); }).blur(function () { if ($(this).val() == "") $(this).val($(this).attr("txtEmpty")); });
    $(".IsNull").focus(function () { if ($(this).text() == $(this).attr("IsNull")) { $(this).text(""); } }).blur(function () { if ($(this).text() == "") { $(this).text($(this).attr("IsNull")); } });
    //全选
    $(".CheckAll").change(function () { if ($(this).prop("checked")) { $("input[type=checkbox]").prop("checked", true); } else { $("input[type=checkbox]").prop('checked', false); } });
    //关闭试用浮窗
    $(window).scroll(function () { $("#FloatBox").stop().animate({ top: $(window).scrollTop() + 200 }); });
    $("#FloatBox input[name=subInfo]").hover(function () { $(this).stop().animate({ opacity: 0.3 }); }, function () { $(this).stop().animate({ opacity: 0.0 }); }).css({ opacity: 0 });
    $("#FloatBox a.CloseBox").click(function () { $("#FloatBox").stop().animate({ opacity: 0 }, 500, function () { $(this).remove(); }); });
    $("#FloatBox>form").submit(function () { var mobile = $("#FloatBox input[name=Mobile]"); var email = $("#FloatBox input[name=Email]"); if (mobile.val() == mobile.attr("txtEmpty") || mobile.val() == "") { alert("请填写手机号！"); return false; } if (email.val() == email.attr("txtEmpty") || email.val() == "") { alert("请填写邮箱！"); return false; } return true; });




    $("#Menus>li").siblings().andSelf().each(function () {
        var theSpan = $(this);
        var theMenu = theSpan.find(".submenu");
        var tarHeight = theMenu.height();
        theMenu.css({ height: 0, opacity: 0 });
        theSpan.hover(function () {
            $(this).addClass("selected");
            theMenu.stop().css({ display: "block" }).animate({ height: tarHeight, opacity: 1 }, 400);
        }, function () {
            $(this).removeClass("selected");
            theMenu.stop().animate({ height: 0, opacity: 0 }, 400, function () {
                $(this).css({ display: "none" });
            });
        });
    });
    //微信
    //$(".codeToWx,.pop_code").hover(function () {
    //    var tn = $(".pop_code");
    //    tn.css({ display: "block"});
    //    tn.stop().animate({ opacity: 1 });
    //}, function () {
    //    var tn = $(".pop_code");
    //    tn.stop().animate({ opacity: 0 }, function () { $(this).css({ display: "none" }) });
    //})
    
    /*================== 跟随鼠标移入方向 ====================*/
    $(".ProImgBox").hover(function (e) {
        pho_BG_Move($(this), e, "in");
    }, function (e) {
        pho_BG_Move($(this), e, "out");
    })

    function pho_BG_Move(tn, e, hover) {
        var w = tn.width();
        var h = tn.height();
        //alert(w + " | " + h);
        var x = (e.pageX - tn.offset().left - (w / 2)) * (w > h ? (h / w) : 1);
        var y = (e.pageY - tn.offset().top - (h / 2)) * (h > w ? (w / h) : 1);
        var direction = Math.round((((Math.atan2(y, x) * (180 / Math.PI)) + 180) / 90) + 3) % 4;
        var tnp = tn.children("a").children("p");
        var mts = 260;
        if (hover === "in") {
            switch (direction) {
                case 0:/*上方*/tnp.css({ top: -h, left: 0 }).stop().animate({ top: 0, left: 0 }, mts); break;
                case 1:/*右侧*/tnp.css({ top: 0, left: w }).stop().animate({ top: 0, left: 0 }, mts); break;
                case 2:/*下方*/tnp.css({ top: h, left: 0 }).stop().animate({ top: 0, left: 0 }, mts); break;
                case 3:/*左侧*/tnp.css({ top: 0, left: -w }).stop().animate({ top: 0, left: 0 }, mts); break;
            }
        } else if (hover === "out") {
            switch (direction) {
                case 0:/*上方*/tnp.css({ top: 0, left: 0 }).stop().animate({ top: -h, left: 0 }, mts); break;
                case 1:/*右侧*/tnp.css({ top: 0, left: 0 }).stop().animate({ top: 0, left: w }, mts); break;
                case 2:/*下方*/tnp.css({ top: 0, left: 0 }).stop().animate({ top: h, left: 0 }, mts); break;
                case 3:/*左侧*/tnp.css({ top: 0, left: 0 }).stop().animate({ top: 0, left: -w }, mts); break;
            }
        }
    }
    /*================== 跟随鼠标移入方向 ====================*/






    ////响应式布局
    //$(window).resize(function () {
    //    pageWidth = $(window).width();
    //    AutoPageWidth();
    //})
    ////alert($(document).width() + " | " + $(window).width());
    //var pageWidth = $(window).width();
    //function AutoPageWidth() {
    //    if (pageWidth <= 1680 && pageWidth >= 1152) {
    //        $(".w100").css({ width: "100%" });
    //        $(".banner").addClass("of_h").css({ width: pageWidth });
    //    }
    //    else if (pageWidth <= 1152) {
    //        $(".w100").css({ width: 1152 });
    //        $(".banner").addClass("of_h").css({ width: 1152 });
    //    }
    //}
    //AutoPageWidth();

    //响应式布局 wap
    //$(window).resize(function () {
    //    AutoPageWidth();
    //})
    //var pageW;
    //function AutoPageWidth() {
    //    pageW = $(window).width();
    //    if (pageW >= 640)
    //        pageW = 640;
    //    $("article").css({ width: pageW });
    //}
    //AutoPageWidth();
});

//加入收藏 <a href="javascript:void(0)" onclick="AddFavorite(window.location,document.title)">加入收藏</a>
function AddFavorite(sURL, sTitle) { try { window.external.addFavorite(sURL, sTitle); } catch (e) { try { window.sidebar.addPanel(sTitle, sURL, ""); } catch (e) { alert("加入收藏失败，请使用Ctrl+D进行添加"); } } }
//设为首页 <a href="javascript:void(0)" onclick="SetHome(this,window.location)">设为首页</a>
function SetHome(obj, vrl) { try { obj.style.behavior = 'url(#default#homepage)'; obj.setHomePage(vrl); } catch (e) { if (window.netscape) { try { netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect"); } catch (e) { alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。"); } var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch); prefs.setCharPref('browser.startup.homepage', vrl); } else alert("您的浏览器不支持，请按照下面步骤操作：\n1.打开浏览器设置。\n2.点击设置网页。\n3.输入：" + vrl + "点击确定。"); } }
/** * @author Alexander Farkas * v. 1.02 火狐下支持 backgroundPosition属性(function ($) { $.extend($.fx.step, { backgroundPosition: function (fx) { if (fx.state === 0 && typeof fx.end == 'string') { var start = $.curCSS(fx.elem, 'backgroundPosition'); start = toArray(start); fx.start = [start[0], start[2]]; var end = toArray(fx.end); fx.end = [end[0], end[2]]; fx.unit = [end[1], end[3]]; } var nowPosX = []; nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0]; nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1]; fx.elem.style.backgroundPosition = nowPosX[0] + ' ' + nowPosX[1]; function toArray(strg) { strg = strg.replace(/left|top/g, '0px'); strg = strg.replace(/right|bottom/g, '100%'); strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g, "$1px$2"); var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/); return [parseFloat(res[1], 10), res[2], parseFloat(res[3], 10), res[4]]; } } }); })(jQuery); */
//按规律添加 class 样式 ,[tn ThisNow 操作的元素] [index 求余] [cn ThisClass 操作的Class对象]
function LawAddClass(strName, index, tc) { var tn = $(strName); for (var i = 1; i <= tn.length; i++) { if (i % index == 0) tn.eq(i - 1).addClass(tc); } };

