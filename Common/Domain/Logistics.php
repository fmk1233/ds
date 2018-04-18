<?php

/**
 * User: denn
 * Date: 2017/4/18
 * Time: 14:55
 */
class Domain_Logistics
{

    public static function getAllList()
    {
        $logistics_model = new Model_Logistic();
        $where = array();
        $list = $logistics_model->getListByWhere($where);
        return $list;
    }

}