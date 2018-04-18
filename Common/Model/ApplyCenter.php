<?php

/**
 * User: denn
 * Date: 2017/3/6
 * Time: 9:00
 */
class Model_ApplyCenter extends PhalApi_Model_NotORM
{

    /**
     * 根据主键值返回对应的表名
     */
    protected function getTableName($id)
    {
        return 'apply_center';
    }

}