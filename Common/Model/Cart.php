<?php

/**
 * User: denn
 * Date: 2017/2/28
 * Time: 17:50
 */
class Model_Cart extends PhalApi_Model_NotORM
{

    public function getCartList($user_id)
    {
        $cart_list = DI()->cache->get('cart_list' . $user_id);
        if (empty($cart_list)) {
            $sql = "select g.goods_pics,g.goods_name,g.price,g.goods_option,g.market_price,g.stock,g.id as goods_id,c.total,c.option_id,c.id from {$this->prefix}cart as c LEFT  join {$this->prefix}shop_goods as g on c.goods_id=g.id where c.user_id=? order by c.id DESC ";
            $params[] = $user_id;
            $cart_list = $this->getORM()->queryAll($sql, $params);
            DI()->cache->set('cart_list' . $user_id, $cart_list, CACHE_TIME);
        }

        return $cart_list;
    }

    public function getCartGoods($user_id, $cart_ids = array())
    {
        $where['user_id'] = intval($user_id);
        if (!empty($cart_ids)) {
            foreach ($cart_ids as &$cart_id) {
                $cart_id = intval($cart_id);
            }
            unset($cart_id);
            $where['id'] = $cart_ids;
        }
        return $this->getORM()->select('total,goods_id as id,option_id,id as cart_id')->where($where)->fetchAll();
    }

    public function getCartCount($where)
    {
        return $this->getORM()->where($where)->count('*');
    }

    public function delByCondition($condition)
    {
        if (empty($condition)) {
            return false;
        }
        return $this->getORM()->where($condition)->delete();
    }

    /**
     * 根据主键值返回对应的表名
     */
    protected function getTableName($id)
    {
        return 'cart';
    }

}