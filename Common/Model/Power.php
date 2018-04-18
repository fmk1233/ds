<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/1/5
 * Time: 14:11
 */
class Model_Power extends PhalApi_Model_NotORM
{

    protected function getTableName($id)
    {
        return 'power';
    }

}