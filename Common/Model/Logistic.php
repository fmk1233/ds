<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/30
 * Time: 22:09
 */
class Model_Logistic extends PhalApi_Model_NotORM
{

    public function getAllList(){
        return $this->getORM()->fetchAll();
    }

    protected function getTableName($id)
    {
        return 'logistics_com';
    }
}