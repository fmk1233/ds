<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/23
 * Time: 9:40
 */
class Model_Recharge extends PhalApi_Model_NotORM
{

    public function getRechargeMoneyTotal($where){
        return (float)$this->getORM()->where($where)->sum('money');
    }
    protected function getTableName($id)
    {
        return 'recharge';
    }
}