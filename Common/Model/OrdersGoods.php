<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/31
 * Time: 17:16
 */
class Model_OrdersGoods  extends PhalApi_Model_NotORM
{

    public function getOrderGoodsByOrderId($orderid){
        $sql = "select og.total,og.price ,og.goods_name,og.goods_pic,og.goods_option,og.goods_id from {$this->prefix}shop_order_goods as og  where og.order_id=:orderid  order by og.id";
        $params[':orderid'] = $orderid;
        return $this->getORM()->queryAll($sql,$params);
    }

    public function getGoodsByOrderId($orderid)
    {
        $sql = "select og.total,og.price ,og.goods_name,og.goods_pic,og.goods_option,og.goods_id,g.goods_option as goods_options from {$this->prefix}shop_order_goods as og left join {$this->prefix}shop_goods as g on g.id=og.goods_id  where og.order_id=:orderid  order by og.id";
        $params[':orderid'] = $orderid;
        return $this->getORM()->queryAll($sql, $params);
    }

    public function delByCondition($condition=array())
    {
        return $this->getORM()->where($condition)->delete();

    }

    protected function getTableName($id)
    {
        return 'shop_order_goods';
    }
}