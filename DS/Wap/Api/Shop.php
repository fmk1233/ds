<?php

/**
 * User: denn
 * Date: 2017/3/23
 * Time: 14:34
 */
class Api_Shop extends Api_Common
{
    public function getRules()
    {
        return array(
            'main'=>array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'user' => array()
        );
    }


    public function main()
    {

        //商城官方公告
        $result['notice'] = Domain_News::notice();

        //商城首页广告
        $result['advs'] = Domain_Icon::iconList(2);
        $result['adv2'] = Domain_Icon::iconList(4);
        $result['goods'] = Domain_Goods::getGoodsList($this->offset,$this->limit,array('is_rec=?'=>1,'status=?'=>1));
        foreach ($result['goods']['rows'] as &$good) {
            Domain_Goods::goodInfo($good);
        }
        unset($good);
        $setting = Domain_System::getSetting();
        $result['keywords'] = unserialize($setting['rec_search']);
        return $result;
    }

    public function user()
    {
        $bouns_names = Common_Function::getBonusName();
        $result['bonus_names'] = $bouns_names;
        $result['user'] = $this->data['user'];
        $result['name'] = BONUS_NAME;
        //订单信息
        //待支付
        $order_model = new Model_ShopOrders();
        $where = array();
        $where['user_id=?'] = $this->data['user']['id'];
        $where['status=?'] = ORDER_WAIT_PAY;
        $order = array();
        $order['wait_pay'] = $order_model->getOrdersCount($where);
        $where['status=?'] = ORDER_PAYED;
        $order['payed'] = $order_model->getOrdersCount($where);
        $where['status=?'] = ORDER_SHIPPING;
        $order['shipping'] = $order_model->getOrdersCount($where);
        $result['order'] = $order;
        return $result;
    }

}