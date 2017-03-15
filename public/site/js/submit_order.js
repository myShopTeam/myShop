$(function () {
    $('.topay').click(function () {
        var url = $(this).attr('data-href');
        if(url){
            $.post(url,{}, function (res) {
                if(res.status == 'success'){
                    ShowBox(res.data, 'id');
//                        showDialog(res.msg, 'succ', '提示信息', null, true, null, '', '', '', 3);
//                        setTimeout(function () {
//                            window.location.href = res.url;
//                        },1200)
                } else {
                    showDialog(res.msg, 'alert', '错误信息', null, true, null, '', '', '', 3);
                    setTimeout(function () {
                        window.location.href = res.url;
                    },1200)
                }
            }, 'json')
        }
    })

    function ShowBox(data, id) {

        $("body").append(data.pay_code)
        $(".closeMonthBox .closeBox").unbind("click");
        $(".closeMonthBox .closeBox").bind("click", function () {
            $(".ShowBox").remove();
        })
    }
});