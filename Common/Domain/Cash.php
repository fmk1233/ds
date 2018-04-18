<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/22
 * Time: 14:42
 */
class Domain_Cash
{


    /**
     * 获取提现列表信息
     * @param $limit 每次查询记录数
     * @param $offset 查询开始位置
     * @param $where 查询条件
     * @return array 返回结果数组
     */
    public static function getCashList($limit, $offset, $where, $tongji = false)
    {
        $cash_model = new Model_Cash();
        $result = $cash_model->getList($limit, $offset, $where);
        if ($tongji) {
            $where = array();
            $where['payment_state'] = CHECK_PASS;
            $result['pass_cash'] = number_format($cash_model->getCashMoneyTotal($where), 2);
            $where['payment_state'] = CHECK_SUBMIT;
            $result['wait_cash'] = number_format($cash_model->getCashMoneyTotal($where), 2);
            $where['payment_state'] = CHECK_REFUSE;
            $result['refuse_cash'] = number_format($cash_model->getCashMoneyTotal($where), 2);

        }
        return $result;
    }


    /**
     * 添加提现数据
     * @param array $data 提现数据
     * @return array|string 失败返回错误提示信息，成功后返回数组
     */
    public static function addCash($data, $user = array())
    {
        $params = Common_Function::cashParams();
        if ($data['money'] % $params['rule'] != 0) {
            return T('提现') . T('金额为{money}的整数倍', array('money' => $params['rule']));
        }
        if ($data['money'] <= 0) {
            return T('提现') . T('金额') . T('不能为负数');
        }
        if ($data['money'] > $data[BONUS_NAME . BONUS_STC]) {
            return T('您的余额不足');
        }
        if (empty($user)) {
            return T('用户不存在');
        } else {
            $model_user = new Model_Users();
            $user_info = $model_user->get($user['id'], 'can_cash');
            if ($user_info['can_cash'] == 0) {
                return T('禁止提现');
            }

            $cash_model = new Model_Cash();
            $sn = true;
            while ($sn) {
                $cash_sn = 'TX' . date('Ymd') . rand(100000, 999999);
                $cash_info = $cash_model->getInfo(array('cash_sn=?' => $cash_sn), 'id');
                if (empty($cash_info)) {//不存在重复的充值单号，停止循环
                    $sn = false;
                }
            }

            $memo = T('提交{money}的金额提现申请', array('money' => $data['money']));

            DI()->notorm->beginTransaction(DB_DS);
            $params = Common_Function::cashParams();
            $user['id'] = intval($user['id']);
            //增加充值记录表
            $insert_data = array();
            $insert_data['user_id'] = $user['id'];
            $insert_data['user_name'] = $user['user_name'];
            $insert_data['cash_sn'] = $cash_sn;
            $insert_data['amount'] = $data['money'];
            $insert_data['bank_name'] = $data['bank_name'];
            $insert_data['bank_no'] = $data['bank_no'];
            $insert_data['bank_user'] = $data['bank_user'];
            $insert_data['bank_address'] = $data['bank_address'];
            $insert_data['fee'] = $params['fee'] * $data['money'] / 100;
            $insert_data['payment_state'] = CHECK_SUBMIT;
            $insert_data['add_time'] = NOW_TIME;
            $inser_id = $cash_model->insert($insert_data);

            //较少对应的余额
            $chage_bonus = Domain_Bonus::addCashHistory($user['id'], -$data['money'], BONUS_STC, BONUS_TYPE_STC_K, $memo);

            if ($inser_id && $chage_bonus) {
                DI()->notorm->commit(DB_DS);
                Domain_Log::addLog($memo . '->成功', LOG_USERS);
                return array('msg' => T("提现") . T('提交') . T('成功'));
            }
            DI()->notorm->rollback(DB_DS);
            return T("提现") . T('提交') . T('失败');
        }


    }

}