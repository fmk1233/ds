<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 16:46
 */
class Model_Admin extends PhalApi_Model_NotORM
{

    public function getAdminByUserName($userName,$fields='*'){
        return $this->getORM()->select($fields)->where('admin_name=? ',$userName)->fetchRow();
    }

    protected function getTableName($id)
    {
        return 'admin';
    }


}