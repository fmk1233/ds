<?php

/**
 * User: denn
 * Date: 2017/2/27
 * Time: 23:10
 */
class Model_Upgrade extends PhalApi_Model_NotORM
{

    /**
     * 根据主键值返回对应的表名
     */
    protected function getTableName($id)
    {
        return 'user_upgrade';
    }

}