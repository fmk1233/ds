<?php

/**
 * User: denn
 * Date: 2017/3/14
 * Time: 17:57
 */
class Api_Order extends Api_Common
{
    public function getRules()
    {
        return array(
            'addCart' => array(
                'goods_id' => array('name' => 'goodsid', 'type' => 'int', 'require' => true, 'desc' => "商品ID"),
                'total' => array('name' => 'num', 'type' => 'int', 'require' => true, 'desc' => "商品数量"),
                'option_id' => array('name' => 'optionid', 'type' => 'string', 'require' => true, 'desc' => "商品规格ID"),
            ),
            'changeCart' => array(
                'id' => array('name' => 'cartid', 'type' => 'int', 'require' => true, 'desc' => "购物车Id"),
                'total' => array('name' => 'num', 'type' => 'int', 'require' => true, 'desc' => "商品数量"),
            ),
            'delCart' => array(
                'id' => array('name' => 'cartid', 'type' => 'int', 'require' => true, 'desc' => "购物车Id"),
            ),
            'addOrders' => array(
                'mobile' => array(
                    'name' => 'phone', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '手机号码',
                ),
                'province' => array('name' => 'province', 'type' => 'int', 'require' => true, 'desc' => '省'),
                'city' => array('name' => 'city', 'type' => 'int', 'require' => true, 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'int', 'require' => true, 'desc' => '区'),
                'address' => array(
                    'name' => 'address', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '详细地址',
                ),
                'realname' => array(
                    'name' => 'realname', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '联系人',
                ),
                'cart_ids' => array('name' => 'cart_ids', 'type' => 'array'),
                'goods_info' => array('name' => 'goods_info', 'type' => 'array'),
            ),
            'getOrderList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'status' => array('name' => 'state', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => '订单状态')
            ),
            'payOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0),
                'pay_type' => array('name' => 'paytype', 'type' => 'int', 'default' => 1),
            ),
            'confirmOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0)
            ),
            'delOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0)
            ),
            'cancelOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'require' => true, 'desc' => "订单Id"),
            ),
            'logistics' => array(
                'code' => array('name' => 'code', 'type' => 'string', 'default' => ''),
                'sn' => array('name' => 'sn', 'type' => 'string', 'default' => ''),
                'com' => array('name' => 'com', 'type' => 'string', 'default' => ''),
            ),
            'buy' => array(
                'goods_id' => array('name' => 'goodsid', 'type' => 'int', 'require' => true, 'desc' => "商品ID"),
                'option_id' => array('name' => 'optionid', 'type' => 'string', 'require' => true, 'desc' => "商品规格ID"),
            )

        );
    }


    /**
     * 模拟添加购物车直接购买
     * @return mixed
     * @throws PhalApi_Exception_WrongException
     */
    public function buy()
    {
        //模拟加入购物车，获取收获地址信息
        $cart = Domain_Cart::buyList($this->goods_id);
        if (!$cart && $cart['status'] == 0) {
            throw new PhalApi_Exception_WrongException('商品不存在或下架');
        }
        $cart['id'] = 0;
        $cart['user_id'] = $this->data['user']['id'];
        $cart['total'] = 1;
        $cart['option_id'] = $this->option_id;
        if (!empty($cart['option_id'])) {
            $option = json_decode($cart['goods_option'], true);
            foreach ($option as $item) {
                if ($item['option_id'] == $cart['option_id']) {
                    $cart['market_price'] = $item['option_marketprice'];
                    $cart['stock'] = $item['option_stock'];
                    $cart['price'] = $item['option_price'];
                    break;
                }
            }
        }
        $cart_list[] = $cart;
        $data['cart_list'] = json_encode($cart_list);
        $data['address'] = json_encode(Domain_Address::getAddressInfo($this->data['user']['id']));
        return $data;
    }

    /**
     * 添加商品数据到购物车
     * @desc 添加商品数据到购物车
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function addCart()
    {
        $data = (array)$this;
        $result = Domain_ShopOrders::addCart($data, $this->data['user']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }

    public function cartList()
    {
        $cart_list = Domain_Cart::getCartList($this->data['user']['id']);
        $data['cart_list'] = $cart_list;
        $data['address'] = Domain_Address::getAddressInfo($this->data['user']['id']);
        return $data;
    }

    /**
     * 修改购物车商品数量
     * @desc 修改购物车商品数量
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function changeCart()
    {
        $data = (array)$this;
        $result = Domain_ShopOrders::changeCart($data);
        if (is_array($result)) {
            if (isset($result['total'])) {
                DI()->response->setMsg($result['msg']);
                return $result;
            }
            DI()->response->setMsg($result['msg']);
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }

    /**
     * 删除购物车数据
     * @desc 删除购物车数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function delCart()
    {
        $result = Domain_Cart::delCart($this->id, $this->data['user']['id']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }


    /**
     * 添加订单
     * @desc 添加订单
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function addOrders()
    {
        $shop_order_domain = new Domain_ShopOrders();
        $address = array();
        $address['realname'] = $this->realname;
        $address['mobile'] = $this->mobile;
        $address = array_merge(Common_Function::getAddress($this->province, $this->city, $this->area), $address);
        $address['address'] = $this->address;
        $pay_type = 1;
        if (count($this->cart_ids) == 1 && $this->cart_ids[0] == 0) {//立即购买
            $goods_info = $this->goods_info;
        } else {
            $cart_model = new Model_Cart();
            $goods_info = $cart_model->getCartGoods($this->data['user']['id'], $this->cart_ids);
        }
        $result = $shop_order_domain->addShopOrders($this->data['user'], $address, $pay_type, '', $goods_info);
        if (is_int($result)) {
            DI()->response->setMsg(T('下单成功'));
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }


    /**
     * 订单列表详情
     * @desc 订单列表详情
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getOrderList()
    {
        $where = array();
        $where['user_id'] = $this->data['user']['id'];
        if ($this->status > 0) {
            $where['status'] = $this->status - 1;
        }
        $result = Domain_ShopOrders::getOrderList($this->limit, $this->offset, $where);
        return $result;

    }


    private function _balancePay($order_id)
    {
        $shop_order_domain = new Domain_ShopOrders();
        DI()->notorm->beginTransaction(DB);
        $result = $shop_order_domain->payOrders($order_id);
        if ($result) {
            DI()->notorm->rollback(DB);
            throw new PhalApi_Exception_WrongException($result);
        }
        DI()->notorm->commit(DB);
        $rs['status'] = ORDER_PAYED;
        DI()->response->setMsg(T('支付成功'));
        return $rs;
    }

    private function _onlinePay($order_id, $pay_type)
    {

        //支付订单
        $shop_order_model = new Model_ShopOrders();
        $order_info = $shop_order_model->get($order_id, 'status,id,order_sn,pay_amount,pay_type,buyer_name');
        if (!empty($order_info) && $order_info['status'] == ORDER_WAIT_PAY) {

            switch ($pay_type) {
                case 2://
                    $order_info['subject'] = '商品订单';
                    $order_info['order_type'] = 1;
                    $payment = Domain_Payment::getPaymentById($pay_type);
                    if ($payment === false) {
                        throw new PhalApi_Exception_WrongException('支付方式不存在');
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
                    return array('alipay' => $malipay_payment->get_payurl());
                    break;
                case 6:
                case 7:
                    $payment = Domain_Payment::getPaymentById(6);
                    if (!$payment) {
                        throw new PhalApi_Exception_WrongException('支付未开启或不支持');
                    }

                    $orderInfo = array();
                    $orderInfo[PaymentProperty::$body] = $order_info['order_sn'] . '订单';
                    $orderInfo[PaymentProperty::$orderId] = $order_info['order_sn'];
                    $orderInfo[PaymentProperty::$total] = $order_info['pay_amount'] * 100;
                    $orderInfo[PaymentProperty::$attach] = 'OrderPay';
                    $orderInfo[PaymentProperty::$tradeType] = $pay_type == 6 ? 'NATIVE' : 'JSAPI';
                    $orderInfo[PaymentProperty::$tag] = 'OrderPay';
                    $orderInfo[PaymentProperty::$productId] = $order_info['order_sn'];
                    if ($pay_type == 7) {
                        $orderInfo[PaymentProperty::$openId] = $this->data['user']['openid'];
                    }

                    $result = $payment->createOrder($orderInfo);
                    $file = '/upload/pay/' . $order_info['order_sn'] . '.png';
                    $file_path = API_ROOT . '/Public/static' . $file;
                    if ($result['return_code'] == 'FAIL') {
                        throw new PhalApi_Exception_WrongException($result['return_msg']);
                    }
                    if ($result['result_code'] == 'FAIL') {
                        throw new PhalApi_Exception_WrongException($result['err_code_des']);
                    }
                    $jsapi = '';
                    if ($pay_type == 6) {
                        QRcode::png($result['code_url'], $file_path);
                    } else {
                        $jsapi = $payment->getJsApiParameters($result);
                    }
                    return array('file' => Common_Function::GoodsPath($file), 'jsapi' => $jsapi);
                    break;
            }
        }
    }

    public function payOrder()
    {//支付订单

        switch ($this->pay_type) {
            case 1://余额支付
                return $this->_balancePay($this->orderid);
                break;
            default: //在线支付
                return $this->_onlinePay($this->orderid, $this->pay_type);
                break;
        }

    }


    /**
     * 物流信息
     * @desc 物流信息
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return null d.data 返回的数据信息
     */
    public function logistics()
    {
        $shopOrderDomain = new Domain_ShopOrders();
        $result = $shopOrderDomain->getLogistic($this->code, $this->sn);
        return $result;
    }


    /**
     * 确认收货
     * @desc 确认收货
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function confirmOrder()
    {//确认发货
        $shop_order_domain = new Domain_ShopOrders();
        $result = $shop_order_domain->confirmOrder($this->orderid);
        if ($result) {
            throw new PhalApi_Exception_WrongException($result);
        }
        $rs['status'] = ORDER_FINISHED;
        DI()->response->setMsg(T('收货成功'));
        return $rs;
    }

    public function cancelOrder()
    {
        $shop_order_domain = new Domain_ShopOrders();
        $result = $shop_order_domain->cancelOrder($this->orderid);
        if ($result) {
            throw new PhalApi_Exception_WrongException($result);
        }
        $rs['status'] = ORDER_CANCEL;
        DI()->response->setMsg(T('取消成功'));
        return $rs;
    }

    public function delOrder()
    {
        $shop_order_domain = new Domain_ShopOrders();
        $shop_order_domain->delOrder($this->orderid);
    }

    public function paymentList()
    {
        return Domain_Payment::paymentTypeName();
    }
}