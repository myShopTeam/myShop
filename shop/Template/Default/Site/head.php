<!doctype html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><if condition="isset($SEO['title']) && !empty($SEO['title']) ">{$SEO['title']}</if>{$SEO['site_title']}</title>
    <meta name="keywords" content="{$Config.sitekeywords}" />
    <meta name="description" content="{$Config.siteinfo}" />
    <meta name="author" content="">
    <meta name="copyright" content="">
    <link href="/public/site/css/base.css" rel="stylesheet" type="text/css">
    <link href="/public/site/css/home_header.css" rel="stylesheet" type="text/css">
    <link href="/public/site/css/font-awesome.min.css" rel="stylesheet" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="/public/site/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/public/site/js/html5shiv.js"></script>
    <script src="/public/site/js/respond.min.js"></script>
    <![endif]-->
    <script src="/public/common/js/jquery.js"></script>
    <script src="/public/common/js/template.js"></script>
    <script src="/public/common/js/common.js" charset="utf-8"></script>
    <script src="/public/common/js/jquery-ui/jquery.ui.js"></script>
    <script src="/public/common/js/jquery.validation.min.js"></script>
    <script src="/public/common/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
    <script type="text/javascript">
        var PRICE_FORMAT = '&yen;%s';
        $(function(){
            //首页左侧分类菜单
            $(".category ul.menu").find("li").each(
                function() {
                    $(this).hover(
                        function() {
                            var cat_id = $(this).attr("cat_id");
                            var menu = $(this).find("div[cat_menu_id='"+cat_id+"']");
                            menu.show();
                            $(this).addClass("hover");
                            var menu_height = menu.height();
                            if (menu_height < 60) menu.height(80);
                            menu_height = menu.height();
                            var li_top = $(this).position().top;
                            $(menu).css("top",-li_top + 50);
                        },
                        function() {
                            $(this).removeClass("hover");
                            var cat_id = $(this).attr("cat_id");
                            $(this).find("div[cat_menu_id='"+cat_id+"']").hide();
                        }
                    );
                }
            );
            $(".mod_minicart").hover(function() {
                    $("#nofollow,#minicart_list").addClass("on");
                },
                function() {
                    $("#nofollow,#minicart_list").removeClass("on");
                });
            $('.mod_minicart').mouseover(function(){
                load_cart_information();
                $(this).unbind('mouseover');
            });

            $('#button').click(function(){
                if ($('#keyword').val() == '') {
                    if ($('#keyword').attr('data-value') == '') {
                        return false
                    } else {
                        window.location.href="http://localhost:8009/shop/index.php?act=search&op=index&keyword="+$('#keyword').attr('data-value');
                        return false;
                    }
                }
            });
            $(".head-search-bar").hover(null,
                function() {
                    $('#search-tip').hide();
                });
            // input ajax tips
            $('#keyword').focus(function(){$('#search-tip').show()}).autocomplete({
                //minLength:0,
                source: function (request, response) {
                    $.getJSON('http://localhost:8009/shop/index.php?act=search&op=auto_complete', request, function (data, status, xhr) {
                        $('#top_search_box > ul').unwrap();
                        response(data);
                        if (status == 'success') {
                            $('#search-tip').hide();
                            $(".head-search-bar").unbind('mouseover');
                            $('body > ul:last').wrap("<div id='top_search_box'></div>").css({'zIndex':'1000','width':'362px'});
                        }
                    });
                },
                select: function(ev,ui) {
                    $('#keyword').val(ui.item.label);
                    $('#top_search_form').submit();
                }
            });
            $('#search-his-del').on('click',function(){$.cookie('4F55_his_sh',null,{path:'/'});$('#search-his-list').empty();});
        });
        $(function(){
            var act = "search";
            if (act == "store_list"){
                $("#head-search-bar").children('#hdSearchTab').children('a:eq(1)').addClass("d");
                $("#head-search-bar").children('#hdSearchTab').children('a:eq(0)').removeClass("d");
            }
            $("#head-search-bar").children('#hdSearchTab').children('a').click(function(){
                $(this).parent().children('a').removeClass("d");
                $(this).addClass("d");
                $('#search_act').attr("value",$(this).attr("act"));
                $('#keyword').attr("placeholder",$(this).attr("title"));
            });
            $("#keyword").blur();
            $('#search-tip').hide();

        });
    </script>
</head>
