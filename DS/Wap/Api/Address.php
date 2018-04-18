<?php

/**
 * User: denn
 * Date: 2017/3/21
 * Time: 13:57
 */
class Api_Address extends Api_Common
{

    public function getRules()
    {
        return array(
            'addressList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'setDefault'=>array(
                'address_id'=>array('name'=>'addressid','type'=>'int','require' => true, 'desc'=>'会员地址ID')
            ),
            'delAddress'=>array(
                'address_id'=>array('name'=>'addressid','type'=>'int','require' => true, 'desc'=>'会员地址ID')
            ),
        );
    }

    public function addressList()
    {
        $where = array();
        $where['user_id'] = $this->data['user']['id'];
        $list = Domain_Address::getAddressList($this->limit, $this->offset, $where);
        return $list;

    }

    public function setDefault()
    {
        $result = Domain_Address::setDefault($this->address_id, $this->data['user']['id']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return;
        }
        throw new PhalApi_Exception_WrongException($result);
    }

    public function delAddress()
    {
        $result = Domain_Address::delAddress($this->address_id);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return;
        }
        throw new PhalApi_Exception_WrongException($result);
    }

}