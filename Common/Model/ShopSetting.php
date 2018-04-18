<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/30
 * Time: 10:05
 */
class Model_ShopSetting extends PhalApi_Model_NotORM
{

    protected function getTableName($id)
    {
        return 'shop_setting';
    }

}