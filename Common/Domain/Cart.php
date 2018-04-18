<?php

/**
 * User: denn
 * Date: 2017/2/28
 * Time: 20:42
 */
class Domain_Cart
{

    /**
     * 获取购物车列表信息
     * @return array 返回结果数组
     */
    public static function getCartList($user_id)
    {
        $cart_model = new Model_Cart();
        $result = $cart_model->getCartList($user_id);
        return $result;
    }

    public static function buyList($goods_id)
    {
        $goods_model = new Model_Goods();
        $goods = $goods_model->get($goods_id, 'goods_pics,goods_name,price,goods_option,market_price,stock,id as goods_id');
        return $goods;
    }

    public static function goodsInfo(&$cart)
    {
        $cart['guige'] = '';
        if (!empty($cart['option_id'])) {
            $cart['goods_option'] = json_decode($cart['goods_option'], true);
            foreach ($cart['goods_option'] as $item) {
                if ($item['option_id'] == $cart['option_id']) {
                    $cart['market_price'] = $item['option_marketprice'];
                    $cart['stock'] = $item['option_stock'];
                    $cart['price'] = $item['option_price'];
                    $cart['guige'] = $item['option_title'];
                    break;
                }
            }
        }
    }

    public static function batchDel($cart_ids, $user_id)
    {
        foreach ($cart_ids as &$cart_id) {
            $cart_id = intval($cart_id);
        }
        unset($cart_id);
        $cart_model = new Model_Cart();
        $result = $cart_model->delByCondition(array('id' => $cart_ids));
        if ($result == false) {
            return T('删除失败');
        }
        self::delCache($user_id);
        return array('msg' => T('删除成功'));
    }

    public static function delCache($user_id)
    {
        DI()->cache->delete('cart_list' . $user_id);
    }

    public static function delCart($cart_id, $user_id)
    {
        $cart_model = new Model_Cart();
        $result = $cart_model->delete($cart_id);
        if ($result == false) {
            return T('删除失败').$cart_id;
        }

        self::delCache($user_id);
        return array('msg' => T('删除成功'));
    }
}