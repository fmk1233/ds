<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 16:02
 */
class Model_Protocol extends PhalApi_Model_NotORM
{


    public function getListByCondition($where,$field='*',$order='id desc',$limit=0)
    {
        if($limit==0){
            return $this->getORM()->select($field)->where($where)->order($order)->fetchAll();
        }else{
            return $this->getORM()->select($field)->where($where)->order($order)->limit($limit)->fetchAll();
        }
    }

    protected function getTableName($id)
    {
        return 'protocol';
    }

}