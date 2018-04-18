<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 17:43
 */
class Model_Navigation extends PhalApi_Model_NotORM
{

    protected function getTableName($id)
    {
        return 'navigation';
    }
}