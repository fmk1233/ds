<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 9:19
 */
class Model_ArticleClass extends PhalApi_Model_NotORM
{

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
        $list = DI()->cache->get('article_class_all');
        if (empty($list)) {
            $list = $this->getListByWhere(array(), '*', 'orders asc,sort desc');
            DI()->cache->set('article_class_all',$list,CACHE_TIME);
        }
        return $list;
    }

    public function delAll($id)
    {
        return $this->getORM()->where('find_in_set(?,pre_str) or id = ?', (string)$id, $id)->delete();
    }

    /**
     * 根据主键值返回对应的表名，注意分表的情况
     */
    protected function getTableName($id)
    {
        return 'article_class';
    }
}