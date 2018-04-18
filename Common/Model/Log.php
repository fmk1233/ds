<?php

/**
 * Class Model_Log 系统日志
 */
class Model_Log extends PhalApi_Model_NotORM
{

    /**
     * 根据主键值返回对应的表名
     */
    protected function getTableName($id)
    {
        return 'log';
    }

}