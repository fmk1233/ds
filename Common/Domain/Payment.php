<?php

/**
 * User: denn
 * Date: 2017/3/24
 * Time: 17:31
 */
class Domain_Payment
{
    /**
     * 获取商城支付列表数据
     * @param $limit 每次查询记录数
     * @param $offset 查询开始位置
     * @param $where 查询条件
     * @return array 返回结果数组
     */
    public static function getList($limit, $offset, $where = array())
    {
        $payment_model = new Model_Payment();
        $result = $payment_model->getList($limit, $offset, $where, 'id asc', 'id,payment_name,payment_state');
        return $result;
    }


    /**
     * 获取支付方式
     * @param int $id 支付方式ID
     * @return array 支付方式数据
     */
    public static function paymentInfo($id)
    {
        $payment_model = new Model_Payment();
        $payment_info = $payment_model->get($id);
        $payment_info['payment_config'] = unserialize($payment_info['payment_config']);
        $payment_info['config_name'] = unserialize($payment_info['config_name']);
        return $payment_info;

    }

    /**
     * 获取支付列表
     * @return mixed
     */
    public static function getPayment()
    {
        $result = DI()->cache->get('payment');
        if (!$result) {
            $payment_model = new Model_Payment();
            $where = array();
            $where['payment_state=?'] = '1';
            $result = $payment_model->getListByWhere($where, 'id,payment_name,payment_state,payment_config', 'id desc');
            DI()->cache->set('payment', $result, CACHE_TIME);
        }

        return $result;
    }


    /**
     * 获取支付接口信息
     * @param $id
     */
    public static function getPaymentById($id)
    {
        $payment_list = self::getPayment();
        $payment = false;
        foreach ($payment_list as $item) {
            if ($id == $item['id']) {
                $payment = $item;
                break;
            }
        }

        if ($id == 6 && $payment) {
            if($payment['payment_state'] == 0){
                return false;
            }
            $config = unserialize($payment['payment_config']);
            $config['type'] = 'wechat';
            $config['sslPath'] = '';
            $config['sub_appid'] = '';
            $config['sub_mch_id'] = '';
            $config['sslName'] = 'apiclient';
            $config['notifyUrl'] = URL_ROOT . 'payment/weixin.php';
            $lite = new Payment_Lite();
            $wechat_payment = $lite->getPayment($config);
            return $wechat_payment;

        }

        return $payment;

    }


    public static function updatePayment($data)
    {
        $payment_model = new Model_Payment();
        $update_array = array();
        $update_array['payment_config'] = serialize($data['payment_config']);
        $update_array['payment_state'] = $data['payment_state'];
        $update_res = $payment_model->update($data['payment_id'], $update_array);
        if ($update_res === false) {
            return T('操作失败');
        }
        DI()->cache->delete('payment');
        return array('msg' => T('操作成功'));

    }

    public static function paymentTypeName($type = false)
    {
        $names = array(
            1 => T('余额支付'),
            2 => T('支付宝'),
            6 => T('微信支付'),
        );
        if ($type === false) {
            return $names;
        }
        return isset($names[$type]) ? $names[$type] : '';
    }
}