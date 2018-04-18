<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/25
 * Time: 9:45
 */
class Model_Transfer extends  PhalApi_Model_NotORM
{

    /**
     * 根据主键值返回对应的表名
     */
    protected function getTableName($id)
    {
        return 'transfer';
    }

}