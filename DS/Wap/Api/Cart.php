<?php

/**
 * User: denn
 * Date: 2017/3/22
 * Time: 21:01
 */
class Api_Cart extends Api_Common
{

    public function getRules()
    {
        return array(
            'batchDel' => array(
                'cart_ids' => array('name' => 'cart_ids', 'type' => 'array')
            )
        );

    }

    public function batchDel()
    {
        $result = Domain_Cart::batchDel($this->cart_ids,$this->data['user']['id']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return;
        }
        throw new PhalApi_Exception_WrongException($result);

    }

}