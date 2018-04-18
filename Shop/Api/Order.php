<?php

/**
 * User: denn
 * Date: 2017/2/28
 * Time: 14:38
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
            'batchDelCart' => array(
                'ids' => array('name' => 'ids', 'type' => 'array', 'require' => true, 'desc' => "购物车ID"),
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
                'pay_type' => array('name' => 'pay_type', 'type' => 'int', 'require' => true, 'desc' => '支付方式'),
                'logistics_id' => array('name' => 'logistics_id', 'type' => 'int', 'require' => true, 'desc' => '快递方式'),
                'memo' => array('name' => 'memo', 'type' => 'string', 'require' => true, 'desc' => '订单留言'),
                'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'default' => 0),
                'total' => array('name' => 'total', 'type' => 'int', 'default' => 0),
                'optionid' => array('name' => 'optionid', 'type' => 'string', 'default' => '')
            ),
            'orderList' => array(
                'status' => array('name' => 'status', 'type' => 'int', 'default' => -1),
                'page' => array('name' => 'page', 'type' => 'int', 'default' => 1, 'desc' => '当前页码')
            ),
            'getOrderList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
            ),
            'payOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0),
                'pay_type' => array('name' => 'pay_type', 'type' => 'int', 'default' => 1),
                'password' => array('name' => 'password', 'type' => 'string', 'default' => '')
            ),
            'confirmOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0)
            ),
            'delOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0)
            ),
            'logistics' => array(
                'code' => array('name' => 'code', 'type' => 'string', 'default' => ''),
                'sn' => array('name' => 'sn', 'type' => 'string', 'default' => ''),
                'com' => array('name' => 'com', 'type' => 'string', 'default' => ''),
            ),
            'orderInfo' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
            ),
            'orderConfirm' => array(
                'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'default' => 0),
                'cartids' => array('name' => 'cartids', 'type' => 'array'),
                'total' => array('name' => 'total', 'type' => 'int', 'default' => 0),
                'optionid' => array('name' => 'optionid', 'type' => 'string', 'default' => '')
            ),
            'getAddress' => array(
                'address_id' => array('name' => 'addressid', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => '会员地址ID')
            ),
            'pay' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '订单ID'),
            ),
            'success' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '订单ID'),
            ),
        );
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
     * 批量删除购物车数据
     * @desc 批量删除购物车数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function batchDelCart()
    {
        $result = Domain_Cart::batchDel($this->ids, $this->data['user']['id']);
        if (is_array($result)) {
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
     * 购物车列表
     * @desc 购物车列表
     */
    public function cartList()
    {
        $cart_list = Domain_Cart::getCartList($this->data['user']['id']);
        $this->assign('cart_list', $cart_list);
        $this->view('cart');
    }


    public function orderConfirm()
    {
        $user = $this->data['user'];
        if ($this->goodsid == 0) {
            $cart_list = Domain_Cart::getCartList($user['id']);
            if (count($cart_list) == 0) {
                PhalApi_Tool::showErrorMsg('购物车为空');
            }
            $cart_ids = $this->cartids;
            foreach ($cart_list as $key => $item) {
                if (!in_array($item['id'], $cart_ids)) {
                    unset($cart_list[$key]);
                }
            }
            if (count($cart_list) == 0) {
                PhalApi_Tool::showErrorMsg('请选择购买的产品');
            }

        } else {//立即购买,模仿购物车
            $cart_list[0] = Domain_Goods::getGoodsInfo($this->goodsid, 'goods_pics,goods_name,price,goods_option,market_price,stock,id as goods_id');
            $cart_list[0]['goods_option'] = json_encode($cart_list[0]['goods_option']);
            $cart_list[0]['total'] = $this->total;
            $cart_list[0]['option_id'] = $this->optionid;
            $cart_list[0]['id'] = 0;
        }
        $this->assign('cart_list', $cart_list);
        $this->assign('goodsid', $this->goodsid);
        $this->assign('optionid', $this->optionid);
        $this->assign('total', $this->total);
        $this->view('order/order_confirm');
    }

    public function pay()
    {
        $shop_order_model = new Model_ShopOrders();
        $orderinfo = $shop_order_model->getOrderInfo($this->id);
        if (empty($orderinfo)) {
            PhalApi_Tool::showErrorMsg(T('订单不存在'));
        }
        if ($orderinfo['status'] != ORDER_WAIT_PAY) {
            PhalApi_Tool::showErrorMsg(T('订单状态异常'));
        }
        $this->assign('order', $orderinfo);
        $this->view('order/order_pay');
    }

    public function success()
    {
        $shop_order_model = new Model_ShopOrders();
        $orderinfo = $shop_order_model->getOrderInfo($this->id, 'id,order_sn,order_amount,status');
        if (empty($orderinfo)) {
            PhalApi_Tool::showErrorMsg(T('订单不存在'));
        }
        if ($orderinfo['status'] != ORDER_PAYED) {
            PhalApi_Tool::showErrorMsg(T('订单状态异常'));
        }
        $this->assign('order', $orderinfo);
        $this->view('order/order_success');

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
        $pay_type = $this->pay_type;
        if ($this->goodsid > 0) {
            $goods_info[0] = array('total' => 1, 'id' => $this->goodsid, 'option_id' => $this->optionid, 'cart_id' => 0);
        } else {
            $cart_model = new Model_Cart();
            $goods_info = $cart_model->getCartGoods(Common_Function::user_id());
        }

        $result = $shop_order_domain->addShopOrders($this->data['user'], $address, $pay_type, '', $goods_info, $this->logistics_id, $this->memo);
        if (is_int($result)) {
            DI()->response->setMsg(T('下单成功'));
            return array('url' => Common_Function::url(array('service' => 'Order.Pay', 'id' => $result)));
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }


    /**
     * 订单列表
     * @desc 订单列表
     */
    public function orderList()
    {
        $where = array();
        $where['user_id'] = $this->data['user']['id'];
        $page = $this->page;
        if ($this->status >= 0) {
            $where['status=?'] = $this->status;
        }
        $list = Domain_ShopOrders::getOrderList(PAGENUM, ($page - 1) * PAGENUM, $where);
        $order_model = new Model_ShopOrders();
        $where = array();
        $order = array();
        $where['user_id=?'] = $this->data['user']['id'];
        $where['status=?'] = ORDER_WAIT_PAY;
        $order['wait_pay'] = $order_model->getOrdersCount($where);
        $where['status=?'] = ORDER_PAYED;
        $order['payed'] = $order_model->getOrdersCount($where);
        $where['status=?'] = ORDER_SHIPPING;
        $order['shipping'] = $order_model->getOrdersCount($where);
        $where['status=?'] = ORDER_FINISHED;
        $order['finished'] = $order_model->getOrdersCount($where);
        $this->assign('order', $order);
        $this->assign('page', $page);
        $this->assign('list', $list['rows']);
        $this->assign('total', $list['total']);
        $this->assign('url', array('service' => 'Order.OrderList'));
        $this->view('order/order_list');
    }

    /**
     * 订单详情
     * @desc 订单详情
     */
    public function orderInfo()
    {
        $shop_order_model = new Model_ShopOrders();
        $order_goods_Model = new Model_OrdersGoods();
        $orderinfo = $shop_order_model->getOrderInfo($this->id);
        if (empty($orderinfo)) {
            PhalApi_Tool::showErrorMsg('订单不存在');
        }
        $this->assign('order', $orderinfo);
        $this->assign('goods', $order_goods_Model->getOrderGoodsByOrderId($this->id));
        $this->view('order/order_detail');
    }

    /**
     * 支付订单
     * @desc 支付订单
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function payOrder()
    {
        $shop_order_model = new Model_ShopOrders();
        $shop_order_model->update($this->orderid, array('pay_type' => $this->pay_type));
        if ($this->pay_type == 1) {
            $user = $this->data['user'];
            if (md5(md5($this->password) . $user['sec_salt']) != $user['sec_pwd']) {
                throw new PhalApi_Exception_WrongException(T('支付密码错误'));
            }
            //支付订单
            $shop_order_domain = new Domain_ShopOrders();
            DI()->notorm->beginTransaction(DB_DS);
            $result = $shop_order_domain->payOrders($this->orderid);
            if ($result) {
                DI()->notorm->rollback(DB_DS);
                throw new PhalApi_Exception_WrongException($result);
            }
            DI()->notorm->commit(DB_DS);
            $rs['status'] = ORDER_PAYED;
            DI()->response->setMsg(T('支付成功'));
            return $rs;
        } elseif ($this->pay_type == 6) {

            $order_info = $shop_order_model->get($this->orderid, 'status,id,order_sn,pay_amount,pay_type');
            if ($order_info['pay_type'] != ORDER_WAIT_PAY) {
                DI()->response->setMsg('请扫码支付');
                $wechat_payment = Domain_Payment::getPaymentById(6);
                $orderInfo = array();
                $orderInfo[PaymentProperty::$body] = $order_info['order_sn'] . '订单';
                $orderInfo[PaymentProperty::$orderId] = $order_info['order_sn'];
                $orderInfo[PaymentProperty::$total] = $order_info['pay_amount'] * 100;
                $orderInfo[PaymentProperty::$attach] = '订单支付';
                $orderInfo[PaymentProperty::$tradeType] = 'NATIVE';
                $orderInfo[PaymentProperty::$tag] = '订单支付';
                $orderInfo[PaymentProperty::$productId] = $order_info['order_sn'];
                $result = $wechat_payment->createOrder($orderInfo);
                $file = '/upload/pay/' . $order_info['order_sn'] . '.png';
                $filename = API_ROOT . '/Public/static' . $file;
                if ($result['return_code'] == 'FAIL') {
                    throw new PhalApi_Exception_WrongException($result['return_msg']);
                }
                QRcode::png($result['code_url'], $filename);
                return Common_Function::GoodsPath($file);
            }
            throw new PhalApi_Exception_WrongException('订单已支付请勿重复支付');
        } elseif ($this->pay_type == 2) {
            $order_info = $shop_order_model->get($this->orderid, 'status,id,order_sn,pay_amount,pay_type,buyer_name');
            if ($order_info['pay_type'] != ORDER_WAIT_PAY) {
                $order_info['subject'] = '商品订单';
                $order_info['order_type'] = 1;
                $payment = Domain_Payment::getPaymentById(2);
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
                return $malipay_payment->get_payurl();
            }
            throw new PhalApi_Exception_WrongException('订单已支付请勿重复支付');
        } else {
            throw new PhalApi_Exception_WrongException('支付方式不存在');
        }

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

    public function delOrder()
    {
        $shop_order_domain = new Domain_ShopOrders();
        $result = $shop_order_domain->delOrder($this->orderid);
        if ($result) {
            throw new PhalApi_Exception_WrongException($result);
        }
        $rs['status'] = ORDER_CANCEL;
        DI()->response->setMsg(T('删除成功'));
        return $rs;
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
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $result = Domain_ShopOrders::getOrderList($this->limit, $this->offset, $where);
        return $result;

    }


    /**
     * 订单物流信息
     * @desc 订单物流信息
     */
    public function logistics()
    {
        $shop_order_domain = new Domain_ShopOrders();
        $result = $shop_order_domain->getLogistic($this->code, $this->sn);
        $this->assign('result', $result);
        $this->assign('com', $this->com);
        $this->view('logistics.php');
    }

    public function getAddress()
    {
        if ($this->address_id == 0) {
            $address = Domain_Address::getAddressInfo($this->data['user']['id']);
        } else {
            $user_address_model = new Model_UserAddress();
            $address = $user_address_model->get($this->address_id);
        }

        return $address;
    }
}