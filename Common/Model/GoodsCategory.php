<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/29
 * Time: 16:58
 */
class Model_GoodsCategory extends PhalApi_Model_NotORM
{

    public function getAllCategorys($field = '*')
    {
        return $this->getORM()->select($field)->order('orders asc')->fetchRows();
    }

    public function getOrdersByPid($pid)
    {
        if ($pid == 0) {
            $orders = $this->getORM()->max('orders');
        } else {
            $orders = $this->getORM()->where('find_in_set(?,pre_str) or id = ?', (string)$pid, $pid)->max('orders');
        }
        return $orders + 1;
    }

    public function updateOrdersByOrders($orders, $id, $plus = '+')
    {
        $count = $this->getORM()->where('orders=?', $orders)->count('id');
        if ($count == 0) {
            return $this->getORM()->where('orders>=? and id=?', $orders, $id)->update(array('orders' => new NotORM_Literal('orders' . $plus . '1')));
        } else {
            return true;
        }
    }

    public function getAllList()
    {
        $list = DI()->cache->get('goods_class_all');
        if (empty($list)) {
            $list = $this->getListByWhere(array(), '*', 'orders asc ,sort desc,id desc');
            DI()->cache->set('goods_class_all', $list, CACHE_TIME);
        }
        return $list;
    }

    public function getCategoryCount($where = array())
    {
        $where = $this->parseSearchWhere($where);
        return $this->getORM()->where($where)->count('*');
    }

    public function getCategory($limit, $offset, $field = '*', $where = array())
    {
        $where = $this->parseSearchWhere($where);
        return $this->getORM()->select($field)->where($where)->order('orders asc')->limit($limit, $offset)->fetchRows();
    }

    public function hasJunior($id)
    {
        $count = $this->getORM()->where('pid=?', $id)->count('id');
        return intval($count);
    }

    protected function getTableName($id)
    {
        return 'shop_good_category';
    }
}