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
            'getGoodsInfoList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'category_id' => array('name' => 'category_id', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => '商品分类ID'),),
            'goodsDetail' => array(
                'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'require' => true, 'desc' => "商品ID"),
            ),
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
            'getCartList' => array(),
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
            ),
            'getOrderList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
            ),
            'payOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0)
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
        $user_model = new Model_Users();
        $user = $this->data['user'];
        $tj_num = $user_model->getParentCount(array('pid' => $user['id'], 'dept' => 1));
        $active_num = $user_model->getParentCount(array('pid' => $user['id'], 'state>=?' => 1));
        $this->assign('tj_num', $tj_num);
        $this->assign('active_num', $active_num);
        $this->assign('address', Domain_Address::getAddressInfo(Common_Function::user_id()));
        $this->view('goods_cart');
    }

    public function getCartList()
    {
        $cart_list = Domain_Cart::getCartList($this->data['user']['id']);
        $result['rows'] = $cart_list;
        $result['total'] = count($cart_list);
        return $result;
    }

    /**
     * 商品列表
     * @desc 商品列表
     */
    public function goodsList()
    {
        $categorys = Domain_Goods::getGoodsCategorys(false);
        $this->assign('categorys', $categorys);
        $this->view('goods_list');
    }

    /**
     * 商品详情
     * @desc 商品详情
     */
    public function goodsDetail()
    {
        $shop_setting_model = new Model_ShopSetting();
        $shop_setting = $shop_setting_model->get(1);
        $this->assign('shop_setting', $shop_setting);
        $this->assign('goods', Domain_Goods::getGoodsInfo($this->goodsid));
        $this->view('goods_detail');
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
        $cart_model = new Model_Cart();
        $goods_info = $cart_model->getCartGoods(Common_Function::user_id());
        $result = $shop_order_domain->addShopOrders($this->data['user'], $address, $pay_type, '', $goods_info);
        if (is_int($result)) {
            DI()->response->setMsg(T('下单成功'));
            return array('url' => Common_Function::url(array('service' => 'Order.OrderList')));
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }

    /**
     * 获取商品信息列表数据
     * @desc 获取商品信息列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getGoodsInfoList()
    {

        $where = array();
        //获取商品分类
        if ($this->category_id == 0) {

        } else {
            $where['gc.id=?'] = $this->category_id;
        }
        $where['g.status=?'] = 1;

        $goods_list = Domain_Goods::getGoodsList($this->offset, $this->limit, $where);
        return $goods_list;
    }


    /**
     * 订单列表
     * @desc 订单列表
     */
    public function orderList()
    {
        $this->view('order_list');
    }

    /**
     * 订单详情
     * @desc 订单详情
     */
    public function orderInfo()
    {
        $this->assign('service', 'Order.OrderList');
        $shop_order_model = new Model_ShopOrders();
        $order_goods_Model = new Model_OrdersGoods();
        $orderinfo = $shop_order_model->getOrderInfo($this->id);
        $orderinfo['pay_name'] = Domain_Payment::paymentTypeName($orderinfo['pay_type']);
        $this->assign('order', $orderinfo);
        $this->assign('goods', $order_goods_Model->getOrderGoodsByOrderId($this->id));
        $this->view('order_info');
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
    {//支付订单
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
        $result = $shop_order_domain->cancelOrder($this->orderid);
        if ($result) {
            throw new PhalApi_Exception_WrongException($result);
        }
        $rs['status'] = ORDER_CANCEL;
        DI()->response->setMsg(T('取消成功'));
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
}