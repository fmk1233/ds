<?php

/**
 * User: denn
 * Date: 2017/3/10
 * Time: 9:14
 */
class Model_UserToken extends PhalApi_Model_NotORM
{

    public function deleteByCondition($condition = array())
    {
        if (count($condition) == 0) {
            return false;
        }
        return $this->getORM()->where($condition)->delete();
    }

    /**
     * 根据主键值返回对应的表名
     */
    protected function getTableName($id)
    {
        return 'user_token';
    }

}