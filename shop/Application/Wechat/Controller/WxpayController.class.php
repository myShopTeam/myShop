<?php

// +----------------------------------------------------------------------
// | myshop 微信支付
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2015 , All rights reserved.
// +----------------------------------------------------------------------
// | Author: lp <lp@qcjh.net>
// +----------------------------------------------------------------------

namespace Wechat\Controller;

require_once VENDOR_PATH . 'Wxpay/lib/WxPay.Api.php';
require_once VENDOR_PATH . 'Wxpay/example/WxPay.NativePay.php';

class WxpayController extends \Think\Controller
{
    private $error_msg;

    public function __construct()
    {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
    }

    //获取二维码参数
    public function native($order_info){
        $notify = new \NativePay();
        $input  = new \WxPayUnifiedOrder();
        $notify_url = U('Wechat/Wxpay/notify');
        //获取配置信息
//        $this->__getConf();
        if(!is_object($input)){
            $this->error_msg = '没有引入微信类库';
        }
        //设置appid
        $input->SetAppid('wx7c1bdcbc86a9b6f6');
        //设置商户号
        $input->SetMch_id('1302245101');
        $input->SetBody($order_info['pay_body']);
        $input->SetAttach($order_info['pay_body']);
        $input->SetOut_trade_no($order_info['order_sn']);
//        $input->SetTotal_fee($order_info['pay_fee'] * 100);
        $input->SetTotal_fee(1);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($order_info['pay_body']);
        $input->SetNotify_url('http://16161fg813.iok.la:39659/wechat.php');
//        $input->SetNotify_url('http://www.gajysos.com/wechat.php');
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id(implode(',', $order_info['product_id']));
        make_log($notify_url);
        $result = $notify->GetPayUrl($input);
        make_log($result);
        $url = $result["code_url"];
        return $url;
    }

    //异步回调
    public function notify(){
        $xml = file_get_contents('php://input');
        if($xml){
            make_log($xml);
            //将XML转为array
            //禁止引用外部xml实体
            libxml_disable_entity_loader(true);
            $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

            if(!session('isCheckOrder')){
                if($data['result_code'] == 'SUCCESS'){
                    //订单成功
                    M()->startTrans();
                    session('isCheckOrder', true);
                    if(!M('wxpay_log')->where(array('transaction_id' => $data['transaction_id']))->find()){
                        $orderRes = M('goods_orderinfo')->where(array('order_sn' => $data['out_trade_no']))->save(array('pay_status' => 1, 'order_status' => 2));
                        $logRes = M('wxpay_log')->add($data);
                        if($orderRes && $logRes){
                            M()->commit();
                        } else {
                            M()->rollback();
                        }
                    }
                } else {
                    //订单失败
                }
            }
        }
    }

    //设置微信支付相关信息
    private function __getConf(){

    }

    //获取操作信息
    public function getErrorMsg(){
        return $this->error_msg;
    }
}
