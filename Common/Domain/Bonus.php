<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/18
 * Time: 11:14
 */
class Domain_Bonus
{



    /**
     * 查询财务明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public static function getList($limit, $offset, $where)
    {
        $bonus_model = new Model_Bonus();
        $where = Common_Function::parseSearchWhere($where,true);
        $total = $bonus_model->getBonusListCount($where);
        $users = $bonus_model->getBonusList($limit, $offset, $where);
        return array('total' => $total, 'rows' => $users);
    }

    /**
     * @param $uid 会员ID
     * @param $money 金额
     * @param $moneyType 货币类型
     * @param $bonus_type 收益明细类型
     * @param $meno 备注
     * @param int $frezzeState 是否冻结
     * @param int $oid 订单ID
     * @return long|string
     */
    public static function addCashHistory($user_id, $money, $money_type, $bonus_type, $meno, $frezze_state = 0, $oid = 0, $from_id = 0, $rate = 0, $dai = 0)
    {
        if ($money == 0) {
            return false;
        }
        $user_id = intval($user_id);
        $money = floatval($money);
        $money_type = intval($money_type);
        //检验会员是否为异常会员，异常会员执行不了任何修改钱包金额
        $user_model = new Model_Users();
       /* if ($user_model->isExpUser($user_id)) {
            #TODO 异常会员
            DI()->logger->error('该会员为异常会员' . $user_id . '操作自己的钱包' . Common_Function::getBonusName($money_type));
//            DI()->logger->debug('异常会员'.$user_id.'操作自己的钱包');
//            return false;
        }*/
        $bonus_model = new Model_Bonus();

        $data = array();
        $data['user_id'] = $user_id;
        $data['money'] = $money;
        $data['bonus_type'] = $bonus_type;
        $data['money_type'] = $money_type;
        $data['memo'] = $meno;
        $data['frezze_state'] = $frezze_state;
        $data['order_id'] = $oid;
        $data['from_id'] = $from_id;
        $data['dai'] = $dai;
        $data['rate'] = $rate;
        $data['is_out'] = 0;//收入
        if ($money < 0) {//钱包支出
            $data['is_out'] = 1;//支出
        }
        $data['add_time'] = NOW_TIME;

        $insert_id = $bonus_model->insert($data);
        $chang_money = true;
        if ($frezze_state == BONUS_UNFREZZE) {//不冻结的钱包收入，立即更改钱包金额
            $chang_money = $user_model->changeBouns($user_id, $money, $money_type);
        }
        if ($insert_id && $chang_money) {//只有全部运行正常返回true
            return true;
        }
        return false;
    }


    /**
     * 查询充值明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public static function getRechargeList($limit, $offset, $where, $tongji = false)
    {
        $recharge_model = new Model_Recharge();
        $list = $recharge_model->getList($limit, $offset, $where);
        if ($tongji) {
            $bonus_names = Common_Function::getBonusName();
            foreach ($bonus_names as $key=>$bonus_name) {
                $where = array();
                $where['status'] = CHECK_PASS;
                $where['money_type'] = $key;
                $list['recharge'.$key] = number_format($recharge_model->getRechargeMoneyTotal($where),2);
            }
        }
        return $list;
    }


    public static function addRecharge($data, $reg_type = LOG_ADMIN, $recharge_type = RECHARGE_SYS)
    {

        $params = Common_Function::rechargeParams();
        if ($data['money'] % $params['rule'] != 0 && $reg_type != LOG_ADMIN) {
            return T('充值') . T('金额为{money}的整数倍', array('money' => $params['rule']));
        }
        if ($reg_type == LOG_USERS && $data['money'] <= 0) {
            return T('充值') . T('金额') . T('不能为负数');
        }

        $user_model = new Model_Users();
        $user = $user_model->getUserByUserName($data['username'], 'id,user_name,true_name');
        if (!$user) {
            return T('用户不存在');
        } else {
            $recharge_model = new Model_Recharge();

            $sn = true;
            while ($sn) {
                $recharge_sn = 'CZ' . date('Ymd') . rand(100000, 999999);
                $recharge_info = $recharge_model->getInfo(array('recharge_sn=?' => $recharge_sn), 'id');
                if (empty($recharge_info)) {//不存在重复的充值单号，停止循环
                    $sn = false;
                }
            }

            if ($reg_type == LOG_ADMIN) {
                $admin = Common_Function::admin();
                $memo = '给会员' . $user['user_name'] . '充值' . $data['money'] . '充值单号：' . $recharge_sn;
                $meno = '后台' . $admin['admin_name'] . $memo;
            } else {
                $memo = T('提交{money}的充值，充值单号：{ordersn}', array('money' => $data['money'], 'ordersn' => $recharge_sn));
            }
            DI()->notorm->beginTransaction(DB_DS);
            //增加充值记录表
            $insert_data = array();
            $insert_data['user_id'] = $user['id'];
            $insert_data['user_name'] = $user['user_name'];
            $insert_data['recharge_sn'] = $recharge_sn;
            $insert_data['true_name'] = $user['true_name'];
            $insert_data['money_type'] = $data['moneyType'];
            $insert_data['add_time'] = NOW_TIME;
            $insert_data['status'] = CHECK_SUBMIT;
            $insert_data['memo'] = isset($data['memo']) ? $data['memo'] : '';
            if ($reg_type == 1) {
                $insert_data['check_time'] = NOW_TIME;
                $insert_data['status'] = CHECK_PASS;
            }
            $insert_data['recharge_type'] = $recharge_type;
            $insert_data['money'] = $data['money'];

            $insert_id = $recharge_model->insert($insert_data);

            $change_bonus_res = true;
            if ($reg_type == LOG_ADMIN) {
                switch ($data['moneyType']) {
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
                //增加货币流向
                $change_bonus_res = Domain_Bonus::addCashHistory(intval($user['id']), $data['money'], $data['moneyType'], $type, $meno);
                Domain_Log::addLog($memo, $reg_type);
            } else {
                Domain_Log::addLog($memo, $reg_type);
            }

            if ($insert_id && $change_bonus_res) {
                DI()->notorm->commit(DB_DS);
                return array('msg' => T("充值") . T('提交') . T('成功'));
            }
            DI()->notorm->rollback(DB_DS);
            return T("充值") . T('提交') . T('失败');

        }

    }

    /**
     * 获取各项财务明细类型
     * @desc
     * @return array d.data each as data 返回的数据信息
     */
    public static function getBonusTypeNames()
    {
        return array(
            BONUS_TYPE_STC_K => T('余额') . T('提现'),
            BONUS_TYPE_STC_RW => T('余额') . T('奖金'),
            BONUS_TYPE_STC_CZ => T('余额') . T('充值'),
            BONUS_TYPE_STC_ZR => T('余额') . T('转入'),
            BONUS_TYPE_STC_ZC => T('余额') . T('转出'),
            BONUS_TYPE_STC_UP => T('余额') . T('升级'),
            BONUS_TYPE_KJHB => T('激活会员扣除') . T('报单币'),
            BONUS_TYPE_JHB_ZC => T('报单币') . T('转出'),
            BONUS_TYPE_JHB_ZR => T('报单币') . T('转入'),
            BONUS_TYPE_JHB_CZ => T('报单币') . T('充值'),
            BONUS_TYPE_GW_SP => T('购物币') . T('购物'),
            BONUS_TYPE_GW_RW => T('购物币') . T('奖金'),
            BONUS_TYPE_GW_CZ => T('购物币') . T('充值'),
            BONUS_TYPE_GW_ZR => T('购物币') . T('转入'),
            BONUS_TYPE_GW_ZC => T('购物币') . T('转出'),
        );
    }
}