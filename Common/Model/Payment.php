<?php

/**
 * User: denn
 * Date: 2017/3/24
 * Time: 17:31
 */
class Model_Payment extends PhalApi_Model_NotORM
{

    protected function getTableName($id)
    {
        return 'payment';
    }
}