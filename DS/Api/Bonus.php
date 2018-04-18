    <?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/24
 * Time: 14:31
 */
class Api_Bonus extends Api_Common
{

    public function getRules()
    {
        return array(
            'getBonusList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
                'money_type' => array('name' => 'money_type', 'type' => 'int', 'desc' => '货币类型'),
            ),
            'getCashList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
            ),
            'addCash' => array(
                'money' => array('name' => 'amount', 'type' => 'float', 'require' => true, 'desc' => "提现金额"),
                'bank_name' => array('name' => 'bank_name', 'type' => 'string', 'require' => true, 'desc' => '收款银行'),
                'bank_user' => array('name' => 'bank_user', 'type' => 'string', 'require' => true, 'desc' => '开户姓名'),
                'bank_no' => array('name' => 'bank_no', 'type' => 'string', 'require' => true, 'desc' => '收款账号'),
                'bank_address' => array('name' => 'bank_address', 'type' => 'string', 'require' => true, 'desc' => '银行地址'),
            ),
        );
    }

    /**
     * 余额钱包明细
     * @desc 余额钱包明细
     */
    public function balance()
    {
        $this->bonusList(BONUS_STC);
    }

    /**
     * 报单币钱包明细
     * @desc 余额钱包明细
     */
    public function declaration()
    {
        $this->bonusList(BONUS_JHB);
    }

    /**
     * 购物币钱包明细
     * @desc 余额钱包明细
     */
    public function shopping()
    {
        $this->bonusList(BONUS_GW);
    }

    /**
     * 钱包明细
     * @desc 钱包明细
     */
    private function bonusList($money_type)
    {
        $bonus_model = new Model_Bonus();
        $user = $this->data['user'];
        $this->assign('out_total', number_format($bonus_model->getTotalMoney(array('user_id' => $user['id'], 'money_type' => $money_type, 'is_out=? or (is_out=? and bonus_type=?)' =>array(1,0,BONUS_TYPE_STC_K))), 2));
        $this->assign('in_total', number_format($bonus_model->getTotalMoney(array('user_id' => $user['id'], 'money_type' => $money_type, 'is_out=? and bonus_type<>?' =>array(0,BONUS_TYPE_STC_K))), 2));
        $this->assign('money_type', $money_type);
        $this->view('bonus_list');
    }


    /**
     * 余额提现
     * @desc 余额提现
     */
    public function cashList()
    {
        $bank_list = Domain_Bank::getAllBank();
        $this->assign('bank_list',$bank_list);
        $this->view('bonus_cash');
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
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
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
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $bonus_model = new Model_Bonus();
        $result = $bonus_model->getList($this->limit, $this->offset, $where);
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


}