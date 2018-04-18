<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/1/3
 * Time: 13:50
 */
class Model_Icon extends PhalApi_Model_NotORM
{


    protected function getTableName($id)
    {
        return 'icon';
    }
}