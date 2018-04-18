<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/31
 * Time: 17:22
 */
class Domain_ShopOrders
{

    /**
     * @var array
     */
    private $orderData = array();


    /**
     * 添加购物车
     * @param $data 购物车数据
     * @param $user 用户信息
     * @return array|string
     */
    public static function addCart($data, $user)
    {

        $user['id'] = intval($user['id']);
        if (empty($user)) {
            return T('用户不存在');
        } else {

            $cart_model = new Model_Cart();

            $cart_info = $cart_model->getInfo(array('user_id' => $user['id'], 'goods_id' => $data['goods_id'], 'option_id' => $data['option_id']), 'total,id');
            if ($cart_info) {
                $cart_info['total'] += $data['total'];
                return Domain_ShopOrders::changeCart($cart_info, false);
            }

            $goods_info = Domain_Goods::getGoodsInfo(intval($data['goods_id']), 'goods_option,stock,status');
            if ($goods_info['status'] == 0) {
                return T('该商品已下架');
            }
            if ($data['total'] <= 0) {
                return T('商品数量添加异常');
            }

            $option_id = '';
            if (!empty($data['option_id'])) {//验证商品规格的价格和数量
                $options = array();
                foreach ($goods_info['goods_option'] as $good) {
                    if ($data['option_id'] == $good['option_id']) {
                        $option_id = $data['option_id'];
                        $options = $good;
                        break;
                    }
                }
                if (empty($option_id)) {
                    return T('商品异常');
                }
                if ($data['total'] > $options['option_stock']) {
                    return T('商品库存不足');
                }
            } else {//验证剩余库存
                if ($data['total'] > $goods_info['stock']) {
                    return T('商品库存不足');
                }
            }

            $insert_array = array();
            $insert_array['user_id'] = $user['id'];
            $insert_array['goods_id'] = $data['goods_id'];
            $insert_array['option_id'] = $data['option_id'];
            $insert_array['total'] = $data['total'];
            $insert_array['add_time'] = NOW_TIME;
            $inser_id = $cart_model->insert($insert_array);
            if ($inser_id) {
                Domain_Cart::delCache($user['id']);
                return array('msg' => T('添加购物车') . T('成功'));
            }
            return T('添加购物车') . T('失败');

        }

    }

    /**
     * 修改购物车
     * @param $data 购物车数据
     * @param bool $update_flag 修改还是添加
     * @return array|string
     */
    public static function changeCart($data, $update_flag = true)
    {
        $cart_model = new Model_Cart();
        $data['id'] = intval($data['id']);
        $cart_info = $cart_model->getInfo(array('id' => $data['id']), 'id,option_id,goods_id,total,user_id');
        if (empty($cart_info)) {
            return T('购物车异常数据');
        }
        $goods_info = Domain_Goods::getGoodsInfo(intval($cart_info['goods_id']), 'goods_option,stock,status');
        if ($goods_info['status'] == 0) {
            return T('该商品已下架');
        }

        if ($data['total'] <= 0) {
            return T('商品数量添加异常');
        }

        $option_id = '';
        if (!empty($cart_info['option_id'])) {//验证商品规格的价格和数量
            $options = array();
            foreach ($goods_info['goods_option'] as $good) {
                if ($cart_info['option_id'] == $good['option_id']) {
                    $option_id = $cart_info['option_id'];
                    $options = $good;
                    break;
                }
            }
            if (empty($option_id)) {
                return T('商品异常');
            }
            if ($data['total'] > $options['option_stock']) {
                return array('msg' => T('商品库存不足'), 'total' => $cart_info['total']);
            }
        } else {//验证剩余库存
            if ($data['total'] > $goods_info['stock']) {
                return array('msg' => T('商品库存不足'), 'total' => $cart_info['total']);
            }
        }

        $update_array = array();
        $update_array['total'] = $data['total'];
        $update = $cart_model->update($data['id'], $update_array);
        if ($update) {
            Domain_Cart::delCache($cart_info['user_id']);
            if ($update_flag) {
                return array('msg' => T('修改成功'));
            } else {
                return array('msg' => T('添加购物车') . T('成功'));
            }

        }

        if ($update_flag) {
            return T('修改失败');
        } else {
            return T('添加购物车') . T('失败');
        }


    }


    /**
     * 添加订单
     * @param $user 下单人信息
     * @param $address 收货地址
     * @param $pay_type 支付方式
     * @param $password  余额支付时密码
     * @param $goods_info 商品信息
     * @return int|string
     */
    public function addShopOrders($user, $address, $pay_type, $password, $goods_info, $logistics_id = 0, $memo = '')
    {

        $user['id'] = intval($user['id']);
//        $address_id = intval($address_id);
        //第一步，验证下单人的商品
        list($amount, $goods_list, $cart_ids) = $this->checkGoods($goods_info);
        if (empty($goods_list)) {
            return T('购物车为空');
        }
        if ($amount <= 0) {
            return T('非法请求');
        }

        if ($pay_type == 0) {//余额支付
            /*if ($user['sec_pwd'] != md5(md5($password) . $user['sec_salt'])) { //第一步，判断支付密码是否正确
                return T('请输入正确的安全密码');
            }*/
            //判断金额是否充足
            /*  if ($user[BONUS_NAME . BONUS_GW] < $amount) {
                  return T('购物币余额不足');
              }*/
        }

        //第二步，验证下单人的收货地址，没有固定的收货地址
        /* $address = $this->checkAddress($user['id'], $address_id);
         if (empty($address)) {
             return T('非法请求');
         }*/

        // 保存地址信息
        $old_address = Domain_Address::getAddressInfo($user['id']);
        if ($old_address['id'] == 0) {
            $address['id'] = 0;
            Domain_Address::addAddress($address, $user);
        }
        /* if (!isset($old_address['id'])) {
             $address['id'] = 0 ;
             Domain_Address::addAddress($address,$user);
         }else{

         }*/

        //第三步，生成订单信息
        try {
            DI()->notorm->beginTransaction(DB_DS);
            $order_id = $this->addOrders($user, $amount, $address, $pay_type, $goods_list, $logistics_id, $memo);
            //清空购物车
            Domain_Cart::batchDel($cart_ids, $user['id']);
            DI()->notorm->commit(DB_DS);
        } catch (Exception $e) {
            DI()->notorm->rollback(DB_DS);
            return $e->getMessage();
        }

        return $order_id;


    }


    /**
     * @param $orderid
     * @param int $log_type
     * @return bool|string
     */
    public function payOrders($orderid, $log_type = LOG_ADMIN)
    {
        $shop_order_model = new Model_ShopOrders();
        $order_info = $shop_order_model->get($orderid, 'status,id,user_id,order_sn,pay_amount,pay_type');
        if (empty($order_info)) {
            return T('非法请求');
        }
        if ($order_info['status'] == ORDER_WAIT_PAY) {
            $order_info['user_id'] = intval($order_info['user_id']);
            $update_info = array();
            $user_model = new Model_Users();
            $user = $user_model->get($order_info['user_id'], 'id,user_name,' . BONUS_NAME . BONUS_GW);
            $tips = array();
            $tips['ordersn'] = $order_info['order_sn'];
            $tips['money'] = $order_info['pay_amount'];

            if ($order_info['pay_type'] == 1) {//购物币支付,目前只有购物币支付
                if ($user[BONUS_NAME . BONUS_GW] < $order_info['pay_amount']) {
                    return T('购物币余额不足');
                }
                $pay_result = Domain_Bonus::addCashHistory($order_info['user_id'], -$order_info['pay_amount'], BONUS_GW, BONUS_TYPE_GW_SP, T('支付订单{ordersn}', array('ordersn' => $order_info['order_sn'])));
                if ($pay_result === false) {
                    return T('支付失败');
                }
                $update_info['balance_amount'] = $order_info['pay_amount'];
                $tips['pay_type'] = '购物币支付';

            } else if ($order_info['pay_type'] == 6) {//微信支付
                $tips['pay_type'] = '微信支付';
            } else if ($order_info['pay_type'] == 2) {//支付宝支付
                $tips['pay_type'] = '支付宝支付';
            } else {
                return T('支付方式不存在');
            }
            $update_info['status'] = ORDER_PAYED;
            $update_info['pay_time'] = NOW_TIME;
            $update_info['pay_amount'] = 0;

            $where = array();
            $where['id'] = $order_info['id'];
            $where['pay_amount'] = $order_info['pay_amount'];
            $where['status'] = ORDER_WAIT_PAY;
            $result = $shop_order_model->updateByWhere($where, $update_info);
            if ($result) {
                Domain_Log::addLog(T('支付订单{ordersn}，支付方式{pay_type},支付金额{money}', $tips), $log_type, $user);
                return false;
            }
            return T('订单支付异常');
        } else {
            return T('订单状态异常');
        }

        return T('支付失败');
    }

    /**
     * @param $order_id
     * @param $delivery_name
     * @param $delivery_code
     * @param $delivery_sn
     * @return bool|string
     */
    public function sendGoods($order_id, $delivery_name, $delivery_code, $delivery_sn)
    {
        $shop_order_model = new Model_ShopOrders();
        $order_info = $shop_order_model->get($order_id, 'id,status,order_sn');
        if (empty($order_info)) {
            return T('非法请求');
        }
        if ($order_info['status'] != ORDER_PAYED) {
            return T('订单状态异常');
        }
        $update_info = array();
        $update_info['status'] = ORDER_SHIPPING;
        $update_info['delivery_time'] = NOW_TIME;
        $update_info['delivery_name'] = $delivery_name;
        $update_info['delivery_code'] = $delivery_code;
        $update_info['delivery_sn'] = $delivery_sn;
        $result = $shop_order_model->update($order_id, $update_info);
        if ($result) {
            Domain_Log::addLog('发送订单' . $order_info['order_sn'] . '的货物', LOG_ADMIN);
            return false;
        }
        return T('发货失败');
    }

    /**
     * @param $orderid
     * @param int $log_type
     * @return bool|string
     */
    public function confirmOrder($orderid, $log_type = LOG_ADMIN)
    {
        $shop_order_model = new Model_ShopOrders();
        $order_info = $shop_order_model->get($orderid, 'status,order_sn,id');
        if (empty($order_info)) {
            return T('非法请求');
        }
        if ($order_info['status'] != ORDER_SHIPPING) {
            return T('订单状态异常');
        }
        $update_info = array();
        $update_info['status'] = ORDER_FINISHED;
        $update_info['comfirm_time'] = NOW_TIME;
        $result = $shop_order_model->update(intval($order_info['id']), $update_info);
        if ($result) {
            Domain_Log::addLog(T('确认订单{ordersn}的货物', array('ordersn' => $order_info['order_sn'])), $log_type);
            return false;
        }
        return T('收货失败');
    }


    /**
     * @param $code
     * @param $sn
     * @return mixed
     */
    public function getLogistic($code, $sn)
    {
        $curl = new PhalApi_CUrl();
        $result = $curl->get('http://www.kuaidi100.com/query?type=' . $code . '&postid=' . $sn);

        return json_decode($result, true);
    }

    /**
     * @param $orderid
     * @return bool|string
     */
    public function cancelOrder($orderid)
    {
        $shop_order_model = new Model_ShopOrders();
        $order_info = $shop_order_model->get($orderid, 'id,status');
        if (empty($order_info)) {
            return T('非法请求');
        }
        if ($order_info['status'] != ORDER_WAIT_PAY) {
            return T('订单状态异常');
        }
        $update_info = array();
        $update_info['status'] = ORDER_CANCEL;
        $update_info['cancel_time'] = NOW_TIME;
        $result = $shop_order_model->update($order_info['id'], $update_info);
        if ($result) {
            return false;
        }
        return T('取消失败');
    }


    /**
     * @param $orderid
     * @return bool|string
     */
    public function delOrder($orderid)
    {
        $shop_order_model = new Model_ShopOrders();
        $order_info = $shop_order_model->get($orderid, 'id,status');
        if (empty($order_info)) {
            return T('非法请求');
        }
        if ($order_info['status'] != ORDER_WAIT_PAY) {
            return T('订单状态异常');
        }
        DI()->notorm->beginTransaction(DB_DS);
        $order_goods_model = new Model_OrdersGoods();
        $goods_model = new Model_Goods();

        $del_order = $shop_order_model->delete($orderid);
        $order_goods = $order_goods_model->getGoodsByOrderId($orderid);
        foreach ($order_goods as $order_good) {
            if ($order_good['goods_option'] != 'null') {
                $order_good['goods_option'] = json_decode($order_good['goods_option'], true);
                $order_good['goods_options'] = json_decode($order_good['goods_options'], true);
                foreach ($order_good['goods_options'] as &$goods_option) {
                    if ($goods_option['option_id'] == $order_good['goods_option']['option_id']) {
                        $goods_option['option_stock'] += $order_good['total'];
                    }
                }
                unset($goods_option);
                $goods_model->update(intval($order_good['goods_id']), array('goods_option' => json_encode($order_good['goods_options'])));

            } else {
                $goods_model->update(intval($order_good['goods_id']), array('stock' => new NotORM_Literal('stock+' . $order_good['total'])));
            }
        }
        $del_order_goods = $order_goods_model->delByCondition(array('order_id' => $orderid));
        //更新库存
        if ($del_order && $del_order_goods) {
            DI()->response->setMsg(T('删除成功'));
            DI()->notorm->commit(DB_DS);
        } else {
            DI()->notorm->rollback(DB_DS);
            return T('删除失败');
        }
    }

    //私有区

    /**
     * @param $goods_info
     * @return array
     */
    private function checkGoods($goods_info)
    {
        $goods_model = new Model_Goods();
        $amount = 0;
        $cart_ids = array();
        foreach ($goods_info as &$goods) {
            $cart_ids[] = $goods['cart_id'];
            $total = $goods['total'];
            $option_id = isset($goods['option_id']) ? $goods['option_id'] : '';
            $goods = $goods_model->get(intval($goods['id']), 'price,goods_name,id,stock,goods_option,goods_pics');
            $goods['total'] = $total;
            $goods['option_id'] = $option_id;

            if (!empty($goods['option_id'])) {
                $goods['goods_option'] = json_decode($goods['goods_option'], true);
                foreach ($goods['goods_option'] as $good) {
                    if ($goods['option_id'] == $good['option_id']) {
                        $goods['option'] = $good;
                        break;
                    }
                }
                $amount += $goods['option']['option_price'] * $goods['total'];
            } else {
                $amount += $goods['price'] * $goods['total'];
            }

        }
        unset($goods);
        return array($amount, $goods_info, $cart_ids);
    }


    /**
     * @param $uid
     * @param $address_id
     * @return mixed
     */
    private function checkAddress($uid, $address_id)
    {
        $user_address_model = new Model_UserAddress();
        $address = $user_address_model->getInfo(array('id=? and uid=? ' => array($address_id, $uid)));
        return $address;

    }


    /**
     * 生成订单信息
     * @return int|string
     */
    private function addOrders($user, $amount, $address, $paytype, $goods_list, $logistics_id = 0, $memo = '')
    {
        $logistics = false;
        if ($logistics_id > 0) {
            $logistics_model = new Model_Logistic();
            $logistics = $logistics_model->get($logistics_id);
        }

        $shop_order_model = new Model_ShopOrders();

        $order_info = array();
        $order_sn = $this->generalOrderId('NM' . date('Ymd', NOW_TIME) . rand(100000, 999999));
        $order_info['order_sn'] = $order_sn;
        $order_info['user_id'] = $user['id'];//用户ID
        $order_info['buyer_name'] = $user['user_name'];//用户ID
        $order_info['buyer_realname'] = $user['true_name'];//用户ID
        $order_info['order_amount'] = $amount;//订单价格
        $order_info['address'] = serialize($address);//收货地址ID
        $order_info['pay_type'] = $paytype;//余额支付
        $order_info['pay_amount'] = $amount;//还需支付金额
        $order_info['balance_amount'] = 0;//余额支付金额
        $order_info['add_time'] = NOW_TIME;//用户ID
        $order_info['order_type'] = 0;//订单类型，0：普通订单
        $order_info['memo'] = $memo;//订单留言
        if (!empty($logistics)) {
            $order_info['delivery_name'] = $logistics['company'];//快递公司
            $order_info['delivery_code'] = $logistics['code'];//快递公司代码
        }

        $orderid = $shop_order_model->insert($order_info);
        if (!$orderid) {
            throw new Exception(T('订单数据生成失败'));
        }

        $order_goods_model = new Model_OrdersGoods();
        $goods_model = new Model_Goods();
        //生成订单商品ID
        foreach ($goods_list as $goods) {
            $order_goods = array();
            $order_goods['order_id'] = $orderid;
            $order_goods['goods_id'] = $goods['id'];
            $pics = explode(',', $goods['goods_pics']);
            $order_goods['goods_pic'] = $pics[0];
            $order_goods['goods_name'] = $goods['goods_name'];
            $order_goods['price'] = $goods['price'];
            $order_goods['total'] = $goods['total'];
            $order_goods['add_time'] = NOW_TIME;
            if (!empty($goods['option_id'])) {
                $order_goods['price'] = $goods['option']['option_price'];
                $order_goods['goods_option'] = json_encode($goods['option']);
            }
            $insert_goods = $order_goods_model->insert($order_goods);
            if ($insert_goods == false) {
                throw new Exception(T('订单商品添加失败'));
            }
            if (!empty($goods['option_id'])) {
                $key = array_search($goods['option'], $goods['goods_option']);
                $kucun = $goods['option']['option_stock'] - $goods['total'];
                $kucun = $kucun < 0 ? 0 : intval($kucun);
                $goods['option']['option_stock'] = $kucun;
                $goods['goods_option'][$key] = $goods['option'];
                $update_kucun = $goods_model->update(intval($goods['id']), array('goods_option' => json_encode($goods['goods_option'])));

            } else {
                $kucun = $goods['stock'] - $goods['total'];
                $kucun = $kucun < 0 ? 0 : intval($kucun);
                $update_kucun = $goods_model->update(intval($goods['id']), array('stock' => $kucun));
            }

            if ($update_kucun == false) {
                throw new Exception(T('订单商品库存修改失败'));
            }

        }


        return intval($orderid);

    }


    /**
     * @param $ordersn
     * @return string
     */
    protected function generalOrderId($order_sn)
    {
        $order_model = new Model_ShopOrders();
        $order_id_exist = $order_model->isExistByOrdersn($order_sn);
        if ($order_id_exist) {
            $order_sn = 'NM' . date('YmdHis', NOW_TIME) . rand(100, 999);
            return $this->generalOrderId($order_sn);
        }
        return $order_sn;

    }


    /**
     * 获取订单列表数据
     * @return array
     */
    public static function getOrderList($limit, $offset, $where = array(), $goods = true)
    {
        $shop_order_model = new Model_ShopOrders();
        $order_goods_Model = new Model_OrdersGoods();
        $lists = $shop_order_model->getList($limit, $offset, $where);
        $payment_types = Domain_Payment::paymentTypeName();
        if ($goods) {
            foreach ($lists['rows'] as &$list) {
                $list['address'] = unserialize($list['address']);
                $list['pay_name'] = isset($payment_types[$list['pay_type']])?$payment_types[$list['pay_type']]:'';
                $list['goods'] = $order_goods_Model->getOrderGoodsByOrderId($list['id']);
                foreach ($list['goods'] as &$good) {
                    if (!empty($good['goods_option'])) {
                        $good['goods_option'] = json_decode($good['goods_option'], true);
                        $good['guige'] = $good['goods_option']['option_title'];
                    } else {
                        $good['guige'] = '';
                    }
                }
                unset($good);
            }
            unset($list);
        }


        return $lists;

    }


    /**
     * @param bool $status
     * @return array|mixed
     */
    public static function orderStatus($status = false)
    {
        $order_status = array(
            ORDER_WAIT_PAY => T('待付款'),
            ORDER_PAYED => T('待发货'),
            ORDER_SHIPPING => T('待收货'),
            ORDER_FINISHED => T('完成'),
            ORDER_CANCEL => T('取消'),
            ORDER_REFUND => T('退货'),
        );
        if ($status === false) {
            return $order_status;
        } else {
            return $order_status[$status];
        }


    }


}