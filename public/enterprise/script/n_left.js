/*
*   JQuery 1.9.1
*   leiyu 2014-7-28
*   修改前请先备份
*/
$(function () {
    //内页 Banner 淡入
    $(".n_ban_img").css({ top: 80 }).animate({ top: 53 }, 1500);

    /*======================== 左侧菜单展开效果 =======================*/
    /*
            <li class="thisli n_Nodes">
                <a href="javascript:void(0)">政策法规</a>
                <div class="n_Nodes_div isNone">
                    <ul>
                        <li class="thisNodeLi"><a href="#">政策法规</a></li>
                        <li><a href="#">政策法规</a></li>
                        <li><a href="#">政策法规</a></li>
                        <li><a href="#">政策法规</a></li>
                        <li><a href="#">政策法规</a></li>
                    </ul>
                </div>
            </li>
    */

    var n_menu_node = $("#n_menu ul:first>li:first").siblings().andSelf();
    n_menu_node.hover(function () { $(this).addClass("hoverli") }, function () { $(this).removeClass("hoverli") });
    var n_node_li_h = 68; //默认父级 li 的高度
    //点击展开子菜单
    n_menu_node.children("a").click(function () {
        var tn = $(this).parent("li");
        n_Node_Click(tn);
    })
    var firstLogin = true;
    // 展开菜单操作
    function n_Node_Click(tn) {
        if (tn.hasClass("n_Nodes")) {
            for (var i = 0; i < n_menu_node.length; i++) {
                if (n_menu_node.eq(i).hasClass("n_Nodes") && i != n_menu_node.length - tn.nextAll().length - 1)
                    n_menu_node.eq(i).removeClass("thisli").stop().animate({ height: n_node_li_h }).children(".n_Nodes_div").addClass("isNone");
            }
            if (tn.children(".n_Nodes_div").hasClass("isNone")) {
                if (firstLogin) {
                    firstLogin = false;
                    tn.css({ height: tn.children(".n_Nodes_div").height() + n_node_li_h }, 300).children(".n_Nodes_div").removeClass("isNone");
                } else { 
                    tn.stop().animate({ height: tn.children(".n_Nodes_div").height() + n_node_li_h }, 300).children(".n_Nodes_div").removeClass("isNone");
                }
            } else {
                tn.stop().animate({ height: n_node_li_h }, 300).children(".n_Nodes_div").addClass("isNone");
            }
            tn.addClass("thisli");
        }
    }
    function thisNodeLi_Open() {
        for (var i = 0; i < n_menu_node.length; i++) {
            if (n_menu_node.eq(i).hasClass("n_Nodes")) {
                var div_lis = n_menu_node.eq(i).children(".n_Nodes_div").children("ul").children("li");
                for (var j = 0; j < div_lis.length; j++) {
                    if (div_lis.eq(j).hasClass("thisNodeLi")) {
                        n_Node_Click(n_menu_node.eq(i));
                        return;
                    }
                }
            }
        }
    }
    //开始展开子菜单
    thisNodeLi_Open();
})