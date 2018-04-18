<?php

/**
 * User: denn
 * Date: 2017/4/8
 * Time: 9:39
 */
class Model_System extends PhalApi_Model_NotORM
{


    protected function getTableName($id)
    {
        return 'system';
    }

}