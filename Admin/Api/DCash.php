<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/22
 * Time: 14:39
 */
class Api_DCash extends Api_DCommon
{
    public function getRules()
    {
        return array(
            'getCashList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => TRUE),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => TRUE),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
                'state' => array('name' => 'state', 'type' => 'int','default'=>-1, 'desc' => '状态'),
            ),
            'dealCash' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => "提现订单ID"),
                'action' => array('name' => 'action', 'type' => 'enum', 'range' => array('pass', 'refuse'), 'require' => true, 'desc' => '操作类型')
            ),
        );

    }

    /**
     * 提现明细列表
     * @desc 提现明细列表
     */
    public function cashList()
    {
        $this->assign('tips', array('当前页面显示会员提现记录', '点击操作栏中“同意”，即扣除会员对应账户金额'));
        $this->view('bonus_cash_list');
    }

    /**
     * 获取提现列表数据
     * @desc 获取提现列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getCashList()
    {
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }

        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        if ($this->state >= 0) {
            $where['payment_state=?'] = $this->state;
        }
        $result = Domain_Cash::getCashList($this->limit, $this->offset, $where, true);
        return $result;

    }


    /**
     * 处理提现订单要求
     * @desc 处理提现订单要求
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function dealCash()
    {
        //只有后台可以操作
        $cash_model = new Model_Cash();
        $cash_info = $cash_model->get($this->id, 'user_id,amount,cash_sn,payment_state,user_name');//提现订单
        if (empty($cash_info)) {
            throw new PhalApi_Exception_WrongException(T('非法请求'));
        }
        if ($cash_info['payment_state'] == CHECK_SUBMIT) {
            DI()->response->setMsg('处理成功');
            $update_data = array();
            $admin = Common_Function::admin();
            $update_data['payment_admin'] = $admin['admin_name'];
            $update_data['payment_time'] = NOW_TIME;
            DI()->notorm->beginTransaction(DB_DS);
            $change_bonus = true;
            switch ($this->action) {
                case 'pass':
                    $update_data['payment_state'] = CHECK_PASS;
                    $memo = T('同意') . T('会员{username}提现订单：{ordersn}', array('username' => $cash_info['user_name'], 'ordersn' => $cash_info['cash_sn']));
                    break;
                case 'refuse':
                    $memo = T('拒绝') . T('会员{username}提现订单：{ordersn}', array('username' => $cash_info['user_name'], 'ordersn' => $cash_info['cash_sn']));
                    $change_bonus = Domain_Bonus::addCashHistory(intval($cash_info['user_id']), floatval($cash_info['amount']), BONUS_STC, BONUS_TYPE_STC_K, $memo);
                    $update_data['payment_state'] = CHECK_REFUSE;
                    break;
            }
            $update_res = $cash_model->update($this->id, $update_data);//更新充值订单状态
            Domain_Log::addLog($memo, LOG_ADMIN);
            if ($update_res && $change_bonus) {
                DI()->notorm->commit(DB_DS);
                return $update_data['payment_state'];
            }
            DI()->notorm->rollback(DB_DS);
            throw new PhalApi_Exception_WrongException(T('操作失败'));
        } else {
            throw new PhalApi_Exception_WrongException(T('订单状态异常'));
        }

    }

}