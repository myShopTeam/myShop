<div class="ncm-flow-layout">
    <div class="ncm-flow-container">
        <div class="title"><a href="javascript:history.go(-1);" class="ncbtn-mini fr"><i class="icon-reply"></i>返&nbsp;回</a>

            <h3>对商品进行评价</h3>
        </div>
        <form id="evalform" method="post" action="index.php?act=member_evaluate&amp;op=add&amp;order_id=4">
            <input type="hidden" name="form_submit" value="ok">

            <div class="alert alert-block">
                <h4>操作提示：</h4>
                <ul>
                    <li>评价信息最多填写250字，请您根据本次交易，给予真实、客观地评价；您的评价将是其他会员的参考。</li>
                    <li>评价完成将获得 “10经验值” “50积分”。</li>
                    <li>店铺动态评分默认为“5分”，您可以根据本次交易情况给予商家评分，<span class="orange"> 一旦提交后不能修改。</span></li>
                    <li>图片上传请使用jpg\jpeg\png等格式、单张大小不超过1M的图片，最多可发布5张晒图，上传后的图片也将被保存在个人主页相册中以便其它使用。</li>
                </ul>
            </div>
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active"><a href="javascript:void(0);">对购买过的商品评价</a></li>
                </ul>
            </div>
            <table class="ncm-default-table mb30">
                <tbody>

                <tr class="bd-line">
                    <td class="w20"></td>
                    <td class="pic-mode w200">
                        <div class="pic-thumb">
                            <a href="index.php?act=goods&amp;goods_id=100004" target="_blank">
                                <img src="http://shopwwi.local.com/data/upload/shop/store/goods/1/1_04752627799921979_240.jpg">
                            </a>
                        </div>
                        <dl class="goods-name">
                            <dt>
                                <a href="index.php?act=goods&amp;goods_id=100004" target="_blank" title="劳力士Rolex 日志型系列 自动机械钢带男表 联保正品 116233">劳力士Rolex 日志型系列 自动机械钢带男表 联保正品 116233</a>
                            </dt>
                            <dd title=""></dd>
                        </dl>
                    </td>
                    <td valign="top" class="tl">
                        <div class="ncgeval">商品评分：
                            <div class="raty vm" style="cursor: pointer; width: 100px;">
                                <input nctype="score" name="goods[11][score]" type="hidden">
                                <img src="{$site_info.site_path}images/star-off.png" alt="1" title="很不满意">&nbsp;
                                <img src="{$site_info.site_path}images/star-off.png" alt="2" title="不满意">&nbsp;
                                <img src="{$site_info.site_path}imagesimg/star-off.png" alt="3" title="一般">&nbsp;
                                <img src="{$site_info.site_path}imagesimg/star-off.png" alt="4" title="满意">&nbsp;
                                <img src="{$site_info.site_path}images/star-off.png" alt="5" title="很满意">
                                <input type="hidden" name="score"></div>
                        </div>
                        <textarea name="goods[11][comment]" cols="150" class="w450 mt10 mb10 h40" placeholder="请输入要评价的内容，不要超过150个字符。"></textarea>

                        <div class="show-pic">
                            <div class="ncm-upload-btn fl"><a href="javascript:void(0);"> <span>
                  <input type="file" hidefocus="true" size="1" class="input-file" name="file" id="file11" multiple="">
                  </span>

                                    <p><i class="icon-camera" data_type="0"></i>买家晒图</p>
                                </a></div>
                            <div class="ml5 mt5 fl">限5张</div>
                                <span class="fr mr10 mt5">
                <input type="checkbox" class="checkbox vm" name="goods[11][anony]">
                &nbsp;匿名评价</span>

                            <div class="evaluation-image">
                                <ul nctype="ul_evaluate_image11" data-count="0">
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
            <div class="ncm-default-form">
                <div class="bottom">
                    <label class="submit-border">
                        <input id="btn_submit" type="button" class="submit" value="提交">
                    </label>
                </div>
            </div>
        </form>
    </div>
    <div class="ncm-flow-item">
    </div>
</div>
<script type="text/javascript" src={$site_info.common_path}js/jquery.raty.min.js"></script>
<script type="text/javascript" src="{$site_info.common_path}js/jquery.iframe-transport.js" charset="utf-8"></script>
<script type="text/javascript" src="{$site_info.common_path}js/jquery.ui.widget.js" charset="utf-8"></script>
<script type="text/javascript" src="{$site_info.common_path}js/jquery.fileupload.js" charset="utf-8"></script>
<script type="text/javascript">
    $(function () {
        $('.raty').raty({
            path: "/public/common/js/jquery.raty/img",
            click: function (score) {
                $(this).find('[nctype="score"]').val(score);
            }
        });

        $('.raty-x2').raty({
            path: "/public/common/js/jquery.raty/img",
            starOff: 'star-off-x2.png',
            starOn: 'star-on-x2.png',
            width: 150,
            click: function (score) {
                $(this).find('[nctype="score"]').val(score);
            }
        });


        $('#btn_submit').on('click', function () {
            ajaxpost('evalform', '', '', 'onerror')
        });
        // 图片上传
        $('#file11').fileupload({
            dataType: 'json',
            url: 'http://shopwwi.local.com/shop/index.php?act=sns_album&op=swfupload',
            formData: '',
            add: function (e, data) {
                var $count = parseInt($('ul[nctype="ul_evaluate_image11"]').attr('data-count'));
                if ($count >= 5) {
                    return false;
                }
                $('ul[nctype="ul_evaluate_image11"]').attr('data-count', $count + 1);
                data.formData = {category_id: 1};
                data.submit();
            },
            done: function (e, data) {
                if (data.result.state == 'true') {
                    $('<li>' +
                        '<div class="upload-thumb" nctype="image_item">' +
                        '<img src="' + data.result.file_url + '"><input type="hidden" nctype="input_image" name="goods[11][evaluate_image][]" value=" ' + data.result.file_name + ' " >' +
                        '<a href="javascript:;" nctype="del" data-file-id="' + data.result.file_id + '" class="del" title="移除">X</a>' +
                        '</div></li>').appendTo('ul[nctype="ul_evaluate_image11"]');
                } else {
                    showError(data.result.message);
                }
            }
        });
        // 图片上传
        $('#file10').fileupload({
            dataType: 'json',
            url: 'http://shopwwi.local.com/shop/index.php?act=sns_album&op=swfupload',
            formData: '',
            add: function (e, data) {
                var $count = parseInt($('ul[nctype="ul_evaluate_image10"]').attr('data-count'));
                if ($count >= 5) {
                    return false;
                }
                $('ul[nctype="ul_evaluate_image10"]').attr('data-count', $count + 1);
                data.formData = {category_id: 1};
                data.submit();
            },
            done: function (e, data) {
                if (data.result.state == 'true') {
                    $('<li>' +
                        '<div class="upload-thumb" nctype="image_item">' +
                        '<img src="' + data.result.file_url + '"><input type="hidden" nctype="input_image" name="goods[10][evaluate_image][]" value=" ' + data.result.file_name + ' " >' +
                        '<a href="javascript:;" nctype="del" data-file-id="' + data.result.file_id + '" class="del" title="移除">X</a>' +
                        '</div></li>').appendTo('ul[nctype="ul_evaluate_image10"]');
                } else {
                    showError(data.result.message);
                }
            }
        });
        // 图片上传
        $('#file9').fileupload({
            dataType: 'json',
            url: 'http://shopwwi.local.com/shop/index.php?act=sns_album&op=swfupload',
            formData: '',
            add: function (e, data) {
                var $count = parseInt($('ul[nctype="ul_evaluate_image9"]').attr('data-count'));
                if ($count >= 5) {
                    return false;
                }
                $('ul[nctype="ul_evaluate_image9"]').attr('data-count', $count + 1);
                data.formData = {category_id: 1};
                data.submit();
            },
            done: function (e, data) {
                if (data.result.state == 'true') {
                    $('<li>' +
                        '<div class="upload-thumb" nctype="image_item">' +
                        '<img src="' + data.result.file_url + '"><input type="hidden" nctype="input_image" name="goods[9][evaluate_image][]" value=" ' + data.result.file_name + ' " >' +
                        '<a href="javascript:;" nctype="del" data-file-id="' + data.result.file_id + '" class="del" title="移除">X</a>' +
                        '</div></li>').appendTo('ul[nctype="ul_evaluate_image9"]');
                } else {
                    showError(data.result.message);
                }
            }
        });
        $('ul[nctype^="ul_evaluate_image"]').on('click', '[nctype="del"]', function () {
            album_pic_del($(this).attr('data-file-id'));
            var $item_li = $(this).parents('li:first');
            var $item_ul = $item_li.parents('ul:first');
            $item_li.find('[nctype="input_image"]').val('');
            $item_li.remove();
            $item_ul.attr('data-count', $item_ul.attr('data-count') - 1);
        });

        var album_pic_del = function (file_id) {
            var del_url = "http://shopwwi.local.com/shop/index.php?act=sns_album&op=album_pic_del";
            del_url += '&id=' + file_id;
            $.get(del_url);
        }
    });
</script>