<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/31
 * Time: 16:59
 */
class Model_ShopOrders extends PhalApi_Model_NotORM
{

    public function isExistByOrdersn($ordersn){
        return $this->getORM()->select('id')->where('order_sn=?',$ordersn)->fetchRow();
    }

    public function getOrdersCount($where){
        $wheresql = $this->parseSearchWhere($where);
        $params = array();
        $wherekey = '';
        if(count($wheresql)){
            $params = reset($wheresql);
            $wherekey = 'where '.key($wheresql);
        }
        $sql = "select count(o.id) from {$this->prefix}shop_order as o {$wherekey} ";
        foreach ($this->getORM()->query($sql,$params)->fetch() as $return){
            return $return;
        }
    }

    public function getOrderInfo($id,$field='*'){
        return $this->getORM()->select($field)->where('id=?',$id)->fetchOne();
    }

    public function getOrders($limit,$offset,$where=array()){
        $wheresql = $this->parseSearchWhere($where);
        $params = array();
        $wherekey = '';
        if(count($wheresql)){
            $params = reset($wheresql);
            $wherekey = 'where '.key($wheresql);
        }
        $sql = "select o.*  from {$this->prefix}shop_order as o   {$wherekey} order by o.id desc limit ?,?";
        $params[] = $offset;
        $params[] = $limit;
        return $this->getORM()->queryAll($sql,$params);
    }


    public function getOrderMoneyByCondition($where)
    {
        return (float)$this->getORM()->where($where)->sum('order_amount');
    }


    protected function getTableName($id)
    {
        return 'shop_order';
    }

}