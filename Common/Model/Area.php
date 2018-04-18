<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/11 0011
 * Time: 16:57
 */
class Model_Area extends PhalApi_Model_NotORM
{

    public function delArea($id)
    {

    }

    /**
     * 根据主键值返回对应的表名，注意分表的情况
     */
    protected function getTableName($id)
    {
        return 'area';
    }
}