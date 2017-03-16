<link href="{$site_info.enterprise_path}style/base.css" rel="stylesheet" type="text/css">
<style id="poshytip-css-tip-yellowsimple" type="text/css">
    div.tip-yellowsimple {
        visibility: hidden;
        position: absolute;
        top: 0;
        left: 0;
    }

    div.tip-yellowsimple table, div.tip-yellowsimple td {
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        font-weight: inherit;
        font-style: inherit;
        font-variant: inherit;
    }

    div.tip-yellowsimple td.tip-bg-image span {
        display: block;
        font: 1px/1px sans-serif;
        height: 10px;
        width: 10px;
        overflow: hidden;
    }

    div.tip-yellowsimple td.tip-right {
        background-position: 100% 0;
    }

    div.tip-yellowsimple td.tip-bottom {
        background-position: 100% 100%;
    }

    div.tip-yellowsimple td.tip-left {
        background-position: 0 100%;
    }

    div.tip-yellowsimple div.tip-inner {
        background-position: -10px -10px;
    }

    div.tip-yellowsimple div.tip-arrow {
        visibility: hidden;
        position: absolute;
        overflow: hidden;
        font: 1px/1px sans-serif;
    }</style>
<div class="ShowBox">
    <div class="closeMonthBox"><h5 class="title" title="{$pay_body}">支付项目：{$pay_body|str_cut=17}<span class="closeBox"></span></h5>

        <div class="cont">
            <if condition="$pay_data neq ''">
                <img alt="模式二扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data={$pay_data}" style="width:200px;height:200px;"/>

                <p>微信扫描二维码 快速付款</p>

                <p style="text-align:left;padding:0px 30px;margin-top:15px;color:#a9a9a9;">温馨提示：打开微信扫一扫，扫描二维码支付<br></p>
            <else/>
                <p style="text-align:left;padding:0px 30px;margin-top:15px;color:#a9a9a9;">此订单已过期，不能在支付</p>
            </if>

        </div>
    </div>
</div>