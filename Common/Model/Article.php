<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 9:18
 */
class Model_Article  extends PhalApi_Model_NotORM
{

    public function getLimitListByWhere($condition,$field='*',$order='id desc',$limit)
    {
        return $this->getORM()->select($field)->where($condition)->limit($limit)->order($order)->fetchAll();
    }

    /**
     * 根据主键值返回对应的表名，注意分表的情况
     */
    protected function getTableName($id)
    {
        return 'article';
    }
}