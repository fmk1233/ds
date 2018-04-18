<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/1/4
 * Time: 14:22
 */
class Model_UserAddress extends PhalApi_Model_NotORM
{

    public function deleteByCondition($where)
    {
        return $this->getORM()->where($where)->delete();
    }

    public function updateByCondition($where,$data)
    {
        return $this->getORM()->where($where)->update($data);
    }

    protected function getTableName($id)
    {
        return 'user_address';
    }

}