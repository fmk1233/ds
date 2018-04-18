<?php

/**
 * User: denn
 * Date: 2017/3/15
 * Time: 22:30
 */
class Api_Bonus extends Api_Common
{

    public function getRules()
    {
        return array(
            'getBonusList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'money_type' => array('name' => 'money_type', 'type' => 'int', 'desc' => '货币类型'),
            ),
            'getCashList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'addCash' => array(
                'money' => array('name' => 'amount', 'type' => 'float', 'require' => true, 'desc' => "提现金额"),
                'bank_name' => array('name' => 'bank_name', 'type' => 'string', 'require' => true, 'desc' => '收款银行'),
                'bank_user' => array('name' => 'bank_user', 'type' => 'string', 'require' => true, 'desc' => '开户姓名'),
                'bank_no' => array('name' => 'bank_no', 'type' => 'string', 'require' => true, 'desc' => '收款账号'),
                'bank_address' => array('name' => 'bank_address', 'type' => 'string', 'require' => true, 'desc' => '银行地址'),
            ),
            'getBonusList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'money_type' => array('name' => 'money_type', 'type' => 'int', 'desc' => '货币类型'),
            ),
            'getInnerTransferList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
//                'money_type' => array('name' => 'money_type', 'type' => 'int', 'desc' => '货币类型'),
            ),
            'doTransfer' => array(
                'money' => array('name' => 'amount', 'type' => 'float', 'require' => true, 'min' => 1, 'desc' => '转账金额'),
                'money_type' => array('name' => 'money_type', 'type' => 'int', 'require' => true, 'min' => 1, 'desc' => '转出货币类型'),
            ),
        );
    }


    /**
     * 获取提现明细数据
     * @desc 获取提现明细数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getCashList()
    {
        $where = array();
        $where['user_id'] = $this->data['user']['id'];
        $result = Domain_Cash::getCashList($this->limit, $this->offset, $where);
        return $result;

    }


    /**
     * 获取货币流向数据
     * @desc 获取货币流向数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getBonusList()
    {
        $where = array();
        $where['money_type'] = $this->money_type;
        $where['user_id'] = $this->data['user']['id'];
        $bonus_model = new Model_Bonus();
        $result = $bonus_model->getList($this->limit, $this->offset, $where);
        $result['bonus_types'] = Domain_Bonus::getBonusTypeNames();
        return $result;
    }


    /**
     * 提交提现申请
     * @desc 提交提现申请
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function addCash()
    {

        $data = (array)$this;
        $data[BONUS_NAME . BONUS_STC] = $this->data['user'][BONUS_NAME . BONUS_STC];
        $result = Domain_Cash::addCash($data, $this->data['user']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }

    }


    /**
     * 获取会员提现银行卡信息和余额，以及提现参数
     * @desc 获取会员提现银行卡信息和余额，以及提现参数
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getCashInfo()
    {
        $result = array();
        $result['money'] = $this->data['user'][BONUS_NAME . BONUS_STC];
        $result['user'] = $this->data['user'];
        $result['params'] = Common_Function::cashParams();
        return $result;
    }

    public function finance()
    {
        $bouns_names = Common_Function::getBonusName();
        foreach ($bouns_names as &$value) {
            $value .= T('钱包');
        }
        unset($value);
        $result['bonus_names'] = $bouns_names;
        $result['user'] = $this->data['user'];
        $result['name'] = BONUS_NAME;
        return $result;
    }

    public function getInnerTransferList(){
        $where = array();
        $where['user_id'] = $this->data['user']['id'];
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $records = Domain_BonusTransfer::getList($this->limit, $this->offset, $where);
        if($records['rows']){
            foreach ($records['rows'] as $key => $value){
                $from_name = Common_Function::getBonusName($value['money_type1']);
                $to_name = Common_Function::getBonusName($value['money_type2']);
                $type = $from_name . "转" . $to_name;
                unset($records['rows'][$key]['money_type1']);
                unset($records['rows'][$key]['money_type2']);
                $records['rows'][$key]['type'] = $type;
            }
        }
        return $records;
    }

    public function toTransfer(){
        $result = Domain_BonusTransfer::getTransferTypeList();
        return $result;
    }

    public function doTransfer(){
        DI()->notorm->beginTransaction(DB_DS);
        $result = Domain_BonusTransfer::addBonusTransfer((array)$this,$this->data['user']);
        if(is_array($result)){
            DI()->response->setMsg($result['msg']);
            DI()->notorm->commit(DB_DS);
        }else{
            DI()->notorm->rollback(DB_DS);
            throw new PhalApi_Exception_WrongException($result);
        }
    }
}