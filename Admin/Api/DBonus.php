<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 23:52
 */
class Api_DBonus extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'doRecharge' => array(
                'action' => array('name' => 'action', 'type' => 'string', 'default' => 'post'),
                'moneyType' => array('name' => 'moneyType', 'type' => 'int', 'default' => 0),
                'money' => array('name' => 'amount', 'type' => 'int', 'default' => 0),
                'username' => array('name' => 'username', 'type' => 'string', 'default' => ''),
            ),
            'rechargeList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
            ),
            'bonusListAC' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'bonusType' => array('name' => 'bonusType', 'type' => 'int', 'default' => -1),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
            ),
            'dealRecharge' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => "充值订单ID"),
                'action' => array('name' => 'action', 'type' => 'enum', 'range' => array('pass', 'refuse'), 'require' => true, 'desc' => '操作类型')
            ),

        );
    }

    /**
     * 充值明细管理View
     * @desc 充值明细管理View
     */
    public function recharge()
    {
        $this->assign('tips', array('当前页面显示会员账户充值记录', '点击右上方“充值”，可以给会员对应账户进行充值'));
        $this->view('bonus_recharge');
    }

    /**
     * 获取充值订单明细列表数据
     * @desc 获取充值订单明细列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function rechargeList()
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
        $result = Domain_Bonus::getRechargeList($this->limit, $this->offset, $where, true);
        return $result;
    }

    /**
     *财务明细列表View
     * @desc 财务明细列表View
     */
    public function bonusList()
    {
        $this->assign('tips', array('当前页面显示会员相应账户的金额变动情况'));
        $this->view('bonus_list');
    }

    /**
     * 财务明细列表数据
     * @desc 财务明细列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function bonusListAC()
    {
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['u.' . str_replace('member-', '', $this->qtype).'=?'] = $this->qvalue;
//            $where['locate( ? ,u.' . str_replace('member-', '', $this->qtype) . ')>0'] = $this->qvalue;
        }
        if ($this->bonusType >= 0) {
            $where['b.bonus_type=?'] = $this->bonusType;
        }
        return Domain_Bonus::getList($this->limit, $this->offset, $where);
    }

    /**
     * 添加充值订单
     * @desc 添加充值订单
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function doRecharge()
    {

        if ($this->action == 'post') {//提交充值数据
            $result = Domain_Bonus::addRecharge((array)$this);
            if (is_array($result)) {
                DI()->response->setMsg($result['msg']);
            } else {
                throw new PhalApi_Exception_WrongException($result);
            }
        } else {//ajax获取充值html
            $this->view('bonus_recharge_add');
        }


    }

    /**
     * 处理充值订单要求
     * @desc 处理充值订单要求
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function dealRecharge()
    {
        //只有后台可以操作
        $recharge_model = new Model_Recharge();
        $recharge_info = $recharge_model->get($this->id, 'money,user_id,money_type,user_name,recharge_sn,status');//充值订单
        if (empty($recharge_info)) {
            throw new PhalApi_Exception_WrongException(T('非法请求'));
        }
        if ($recharge_info['status'] == CHECK_SUBMIT) {
            DI()->response->setMsg('处理成功');
            $update_data = array();
            $update_data['check_time'] = NOW_TIME;
            DI()->notorm->beginTransaction(DB_DS);
            $change_bonus = true;
            switch ($this->action) {
                case 'pass':
                    $update_data['status'] = CHECK_PASS;
                    $memo = T('同意') . T('会员{username}充值订单：{ordersn}', array('username' => $recharge_info['user_name'], 'ordersn' => $recharge_info['recharge_sn']));
                    switch ($recharge_info['money_type']) {
                        case 0:
                            $type = BONUS_TYPE_STC_CZ;
                            break;
                        case 1:
                            $type = BONUS_TYPE_DNC_CZ;
                            break;
                        case 2:
                            $type = BONUS_TYPE_PDB_CZ;
                            break;
                        case 3:
                            $type = BONUS_TYPE_JHB_CZ;
                            break;
                        case 4:
                            $type = BONUS_TYPE_GW_CZ;
                            break;
                    }
                    $change_bonus = Domain_Bonus::addCashHistory((int)$recharge_info['user_id'], (float)$recharge_info['money'], (int)$recharge_info['money_type'], $type, $memo);
                    break;
                case 'refuse':
                    $memo = T('拒绝') . T('同意会员{username}充值订单：{ordersn}', array('username' => $recharge_info['user_name'], 'ordersn' => $recharge_info['recharge_sn']));
                    $update_data['status'] = CHECK_REFUSE;
                    break;
            }
            $update_res = $recharge_model->update($this->id, $update_data);//更新充值订单状态
            Domain_Log::addLog($memo, LOG_ADMIN);
            if ($update_res && $change_bonus) {
                DI()->notorm->commit(DB_DS);
                return $update_data['status'];
            }
            DI()->notorm->rollback(DB_DS);
            throw new PhalApi_Exception_WrongException(T('操作失败'));
        } else {
            throw new PhalApi_Exception_WrongException(T('订单状态异常'));
        }

    }


}