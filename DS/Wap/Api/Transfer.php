<?php

/**
 * User: denn
 * Date: 2017/3/15
 * Time: 23:17
 */
class Api_Transfer extends Api_Common
{
    public function getRules()
    {
        return array(
            'getTransferList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'addTransfer' => array(
                'money' => array('name' => 'amount', 'type' => 'float', 'require' => true, 'min' => 1, 'desc' => '转账金额'),
                'money_type' => array('name' => 'zztype', 'type' => 'int', 'require' => true, 'min' => 0, 'desc' => '转账类型'),
                'username' => array('name' => 'tousername', 'type' => 'string', 'desc' => '转入会员编号'),
            ),
        );
    }


    /**
     * 获取转账列表数据
     * @desc 获取转账列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getTransferList()
    {
        $where = array();
        $where['f_user_id'] = $this->data['user']['id'];
        $result = Domain_Transfer::getList($this->limit, $this->offset, $where);
        $result['bonus_names'] = Common_Function::getBonusName();
        return $result;
    }

    public function getTransferInfo()
    {
        $result['bonus_names'] = Common_Function::getBonusName();
        $result['user'] = $this->data['user'];
        $result['name'] = BONUS_NAME;
        return $result;
    }

    /**
     * 添加会员转账记录
     * @desc 添加会员转账记录
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function addTransfer()
    {

        DI()->notorm->beginTransaction(DB_DS);
        $result = Domain_Transfer::addTrasfer((array)$this, $this->data['user']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            DI()->notorm->commit(DB_DS);
        } else {
            DI()->notorm->rollback(DB_DS);
            throw new PhalApi_Exception_WrongException($result);
        }

    }

}