<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/22
 * Time: 14:31
 */
class Model_Cash extends PhalApi_Model_NotORM
{


    /**
     * 获取提现单额数
     * @param $condition 查询条件
     * @return int
     */
    public function getCountByCondition($condition)
    {
        return (int)$this->getORM()->where($condition)->count('*');
    }

    /**
     * 获取提现金额总数
     * @param $where 查询条件
     * @return float
     */
    public function getCashMoneyTotal($where){
        return (float)$this->getORM()->where($where)->sum('amount');
    }

    protected function getTableName($id)
    {
        return 'cash';
    }
}