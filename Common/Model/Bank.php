<?php

/**
 * User: denn
 * Date: 2017/3/30
 * Time: 8:47
 */
class Model_Bank extends PhalApi_Model_NotORM
{

    protected function getTableName($id)
    {
        return 'bank';
    }
}