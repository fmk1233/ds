<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/29
 * Time: 13:57
 */
class Api_GoodOrders extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'getOrderList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true),
                'state' => array('name' => 'order_state', 'type' => 'int', 'default' => -1, 'desc' => '订单状态'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
            ),
            'orderinfo' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
            ),
            'sendGoods' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
            ),
            'payOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0)
            ),
            'sendGoodsAc' => array(
                'orderid' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'expresssn' => array('name' => 'expresssn', 'type' => 'string'),
                'express' => array('name' => 'express', 'type' => 'string'),
                'expresscom' => array('name' => 'expresscom', 'type' => 'string'),
            ),
            'confirmOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0)
            ),
            'cancelOrder' => array(
                'orderid' => array('name' => 'orderid', 'type' => 'int', 'default' => 0)
            ),
            'lookDelivery' => array(
                'code' => array('name' => 'code', 'type' => 'string', 'default' => ''),
                'sn' => array('name' => 'sn', 'type' => 'string', 'default' => ''),
                'com' => array('name' => 'com', 'type' => 'string', 'default' => ''),
            )
        );
    }

    //View 视图区
    public function ordersList()
    {
        $this->assign('tips', array('当前页面显示商城的订单详情','确认会员付款后可以进行发货操作','点击“查看详情”，可以查看订单详细信息'));
        $this->view('shop_orders_list');
    }

    public function sendGoods()
    {
        $shop_order_model = new Model_ShopOrders();
        $logistic_model = new Model_Logistic();
        $this->assign('order', $shop_order_model->getOrderInfo($this->id));
//        var_dump($this->data['order']);exit();
        $this->assign('logcoms', $logistic_model->getAllList());
        $this->view('sendGoods');
    }

    public function lookDelivery()
    {
        $shop_order_domain = new Domain_ShopOrders();
        $result = $shop_order_domain->getLogistic($this->code, $this->sn);
        $this->assign('result', $result);
        $this->assign('com', $this->com);
        $this->view('logistics');
    }

    public function orderinfo()
    {
        $shop_order_model = new Model_ShopOrders();
        $order_goods_Model = new Model_OrdersGoods();
        $orderinfo = $shop_order_model->getOrderInfo($this->id);
        $orderinfo['pay_name'] = Domain_Payment::paymentTypeName($orderinfo['pay_type']);
        $this->assign('order', $orderinfo);
        $this->assign('goods', $order_goods_Model->getOrderGoodsByOrderId($this->id));
        $this->view('shop_order_info');
    }

    //API接口区

    public function getOrderList()
    {
        $where = array();
        if (!empty($this->ordersn)) {
            $where[' locate(?, ordersn)>0 '] = $this->ordersn;
        }
        if (!empty($this->username)) {
            $where[' locate(?, buyer_name)>0 '] = $this->username;
        }

        if (!empty($this->qvalue)) {//相关搜索的数据
            if ($this->qtype == 'ordersn') {
                $where[' locate(?, order_sn)>0 '] = $this->qvalue;
            }
            if ($this->qtype == 'username') {
                $where[' locate(?, buyer_name)>0 '] = $this->qvalue;
            }
        }

        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }

        if ($this->state >= 0) {
            $where['status=?'] = $this->state;
        }

        $result = Domain_ShopOrders::getOrderList($this->limit, $this->offset, $where);
        return $result;
    }


    public function payOrder()
    {//支付订单

        $shop_order_domain = new Domain_ShopOrders();
        DI()->notorm->beginTransaction(DB_DS);
        $result = $shop_order_domain->payOrders($this->orderid);
        if ($result) {//支付失败
            DI()->notorm->rollback(DB_DS);
            throw new PhalApi_Exception_WrongException($result);
        }
        $rs['status'] = ORDER_PAYED;
        DI()->response->setMsg(T('支付成功'));
        DI()->notorm->commit(DB_DS);
        return $rs;

    }

    public function sendGoodsAc()
    {//发货
        //实质上就是设置物流信息
        $shop_order_domain = new Domain_ShopOrders();
        $result = $shop_order_domain->sendGoods($this->orderid, $this->expresscom, $this->express, $this->expresssn);
        if ($result) {//支付失败
            throw new PhalApi_Exception_WrongException($result);
        }
        $rs['status'] = ORDER_SHIPPING;
        DI()->response->setMsg(T('发货成功'));
        return $rs;
    }

    public function cancelOrder()
    {//取消发货
        $shop_order_domain = new Domain_ShopOrders();
        $result = $shop_order_domain->cancelOrder($this->orderid);
        if ($result) {//支付失败
            throw new PhalApi_Exception_WrongException($result);
        }
        $rs['status'] = ORDER_CANCEL;
        DI()->response->setMsg(T('取消订单成功'));
        return $rs;
    }

    public function cancelSendGoods()
    {//取消发货，实质上是将发货状态改为未发货

    }

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

}