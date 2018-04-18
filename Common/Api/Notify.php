<?php

require_once API_ROOT . '/Library/Payment/Lib/Wechat/WxPay.Api.php';
require_once API_ROOT . '/Library/Payment/Lib/Wechat/Wxpay.Notify.php';

Class PayNotifyCallBack extends WxPayNotify
{

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {

        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            DI()->logger->error($msg);
            return false;
        }

        /*
         *  $wechat_payment WechatPayment
         */
        $wechat_payment = DI()->payment;;
        if ($wechat_payment === false) {
            $msg = "支付方式不存在";
            DI()->logger->error($msg);
            return false;
        }

        //查询订单，判断订单真实性
        try {
            $result = $wechat_payment->orderQuery($data["transaction_id"]);
            if (array_key_exists("return_code", $result)
                && array_key_exists("result_code", $result)
                && $result["return_code"] == "SUCCESS"
                && $result["result_code"] == "SUCCESS"
            ) {

                //查询订单
                $shop_order_model = new Model_ShopOrders();
                $where = array();
                $where['order_sn'] = $data['out_trade_no'];
                $order_info = $shop_order_model->getInfo($where, 'id,status,pay_amount,pay_type');
                if ($order_info['status'] != ORDER_WAIT_PAY) {
                    $msg = 'OK';
                    return true;
                }
                if (empty($order_info)) {
                    $msg = '订单不存在';
                    DI()->logger->error($msg);
                    return false;
                } else if ($order_info['pay_type'] != 6) {
                    $update_info['pay_type'] = 6;
                }

                if ($order_info['pay_amount'] * 100 != $result['total_fee']) {
                    $msg = '订单金额不符';
                    DI()->logger->error($msg);
                    return false;
                }

                $update_info['pay_info'] = '微信交易单号' . $data['transaction_id'];
                $shop_order_model->update($order_info['id'], $update_info);
                $domain_shop_orders = new Domain_ShopOrders();
                $result = $domain_shop_orders->payOrders($order_info['id'], LOG_USERS);
                if ($result !== false) {
                    return false;
                }

            } else {
                $msg = '订单查询失败';
                DI()->logger->error($msg);
                return false;
            }
        } catch (WxPayException $e) {
            $msg = $e->getMessage();
            DI()->logger->error($msg);
            return false;
        }


        return true;
    }
}

/**
 * User: denn
 * Date: 2017/4/20
 * Time: 8:43
 */
class Api_Notify extends PhalApi_Api
{

    public function getRules()
    {
        return array(
            'weixin' => array(),
            'alipay' => array(
                'extra_common_param' => array('name' => 'extra_common_param', 'type' => 'string'),
                'out_trade_no' => array('name' => 'out_trade_no', 'type' => 'string'),
                'trade_no' => array('name' => 'trade_no', 'type' => 'string'),
            ),
            'returns' => array(
                'extra_common_param' => array('name' => 'extra_common_param', 'type' => 'string'),
                'out_trade_no' => array('name' => 'out_trade_no', 'type' => 'string'),
                'trade_no' => array('name' => 'trade_no', 'type' => 'string'),
            )
        );
    }

    public function weixin()
    {
        DI()->payment = Domain_Payment::getPaymentById(6);
        $notify = new PayNotifyCallBack();
        $notify->Handle(false);
        exit();
    }

    private function alipays($data, $notify = true)
    {

        $success = 'success';
        $fail = 'fail';

        $order_type = $data['extra_common_param'];
        $out_trade_no = $data['out_trade_no'];
        $trade_no = $data['trade_no'];


        //查询订单
        $shop_order_model = new Model_ShopOrders();
        $where = array();
        $where['order_sn'] = $out_trade_no;
        $order_info = $shop_order_model->getInfo($where, 'id,status,pay_amount,pay_type');
        if ($order_info['status'] != ORDER_WAIT_PAY) {
            if ($notify) {
                exit($success);
            } else {
                PhalApi_Tool::showErrorMsg('订单已支付，请勿重复支付');
            }
        }

        $payment = Domain_Payment::getPaymentById(2);
        if ($payment === false) {
            if ($notify) {
                exit($fail);
            } else {
                PhalApi_Tool::showErrorMsg('支付方式不存在');
            }
        }
        $payment_info = unserialize($payment['payment_config']);
        $config = array();
        $config['type'] = 'malipay';
        $config['payment'] = $payment_info;
        $config['order'] = $order_info;
        $lite = new Payment_Lite();
        /**
         * @var alipay $malipay_payment
         */
        $malipay_payment = $lite->getPayment($config);

        //对进入的参数进行远程数据判断
        if ($notify) {
            $verify = $malipay_payment->notify_verify();
        } else {
            $verify = $malipay_payment->return_verify();
        }
        if (!$verify) {
            if ($notify) {
                exit($fail);
            } else {
                PhalApi_Tool::showErrorMsg('参数验证失败');
            }
        }

        if (empty($order_info)) {
            if ($notify) {
                exit($fail);
            } else {
                PhalApi_Tool::showErrorMsg('订单不存在');
            }
        } else if ($order_info['pay_type'] != 2) {
            $update_info['pay_type'] = 2;
        }

        $update_info['pay_info'] = '支付宝交易单号' . $trade_no;
        $shop_order_model->update($order_info['id'], $update_info);
        $domain_shop_orders = new Domain_ShopOrders();
        $result = $domain_shop_orders->payOrders($order_info['id'], LOG_USERS);
        if ($result === false) {
            if ($notify) {
                exit($fail);
            } else {
                header('Location:' . URL_ROOT . '../shop.php' . Common_Function::url(array('service' => 'Order.Success', 'id' => $order_info['id'])));
            }
        }
        if ($notify) {
            exit($fail);
        } else {
            header('Location:' . URL_ROOT . '../shop.php' . Common_Function::url(array('service' => 'Order.Success', 'id' => $order_info['id'])));
        }
    }

    public function alipay()
    {
        $data = (array)$this;
        $this->alipays($data, true);
    }


    public function returns()
    {
        $data = (array)$this;
        $this->alipays($data, false);
    }

}