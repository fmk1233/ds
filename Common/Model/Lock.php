<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/27
 * Time: 18:43
 */
class Model_Lock extends PhalApi_Model_NotORM
{


    public function updateStateByTimeAndState($time,$state,$id){
        return $this->getORM()->where('id=? and state=? and rdt=?',$id,$state,$time)->update(array('state'=>!$state,'rdt'=>NOW_TIME));
    }

    public function updateStateStrong($id){
        return $this->getORM()->where('id=?',$id)->update(array('state'=>0));
    }

    public function updateStateByState($id){
        return $this->getORM()->where('id=? and state=1',$id)->update(array('state'=>0));
    }

    protected function getTableName($id)
    {
        return 'lock';
    }
}