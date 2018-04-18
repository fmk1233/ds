<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/11/19
 * Time: 14:32
 */
class Model_RelUsers extends PhalApi_Model_NotORM
{

    public function getPosNum($uid){
        return $this->getORM()->where('uid=?',$uid)->fetchRow('pos_num');
    }

    protected function getTableName($id)
    {
        return 'rel_users';
    }
}