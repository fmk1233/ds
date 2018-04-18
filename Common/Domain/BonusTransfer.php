<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/25
 * Time: 9:46
 */
class Domain_BonusTransfer
{
    //内部转账类型列表
    public static function getTransferTypeList(){
        $bonus_name = Common_Function::getBonusName();
        $type_list = array(
            1 => $bonus_name[BONUS_STC]. T('转') . $bonus_name[BONUS_JHB],//余额转报单币
            2 => $bonus_name[BONUS_STC]. T('转') . $bonus_name[BONUS_GW],//余额转购物币
        );
        return $type_list;
    }

    /**
     * 查询转账明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public static function getList($limit, $offset, $where)
    {
        $BonusTransfer_model = new Model_BonusTransfer();
        $lists = $BonusTransfer_model->getList($limit, $offset, $where);
        return $lists;
    }


    /**
     * 添加会员转账记录
     * @param $data 会员转账数据
     * @param $data 会员转账会员
     * @return array|string 失败返回错误提示信息，成功后返回数组
     */
    public static function addBonusTransfer($data, $user)
    {
        if ($data['money_type'] == 1) {//余额转报单币
            $data['money_type1'] = BONUS_STC;
            $data['money_type2'] = BONUS_JHB;
        } elseif ($data['money_type'] == 2){//余额转购物币
            $data['money_type1'] = BONUS_STC;
            $data['money_type2'] = BONUS_GW;
        }
        $params = Common_Function::BonusTransferParams();
        if ($data['money'] % $params['rule'] != 0) {
            return T('会员奖金转换') . T('金额为{money}的整数倍', array('money' => $params['rule']));
        }
        if ($data['money'] <= 0) {
            return T('会员奖金转换') . T('金额') . T('不能为负数');
        }

        if ($user[BONUS_NAME . $data['money_type1']] < ($data['money'] + ($params['fee'] * $data['money'] / 100))) {
            return T('转账金额超过最大金额，您只有{money}', array('money' => $user[BONUS_NAME . $data['money_type1']]));
        }

        // $user_model = new Model_Users();
        // $to_user = $user_model->getInfo(array('user_name' => $data['username']), 'user_name,id,true_name');
        // if (empty($to_user)) {
        //     return T('转入用户不存在');
        // } else {

        $BonusTransfer_model = new Model_BonusTransfer();

        $memo = T('会员{user}{money_type1}账户转{money_type2}账户{money}', array('user' => $user['user_name'], 'money_type1' => Common_Function::getBonusName($data['money_type1']), 'money_type2' => Common_Function::getBonusName($data['money_type2']), 'money' => $data['money']));

        $user['id'] = intval($user['id']);
        //增加充值记录表
        $insert_data = array();
        $insert_data['user_id'] = $user['id'];
        $insert_data['user_name'] = $user['user_name'];
        $insert_data['true_name'] = $user['true_name'];
        $insert_data['money'] = $data['money'];
        $insert_data['money_type1'] = $data['money_type1'];
        $insert_data['money_type2'] = $data['money_type2'];
        $insert_data['add_time'] = NOW_TIME;
        $inser_id = $BonusTransfer_model->insert($insert_data);

        switch ($data['money_type1']) {
            case BONUS_STC:
                $zc_type = BONUS_TYPE_STC_ZC;
                break;
            case BONUS_JHB:
                $zc_type = BONUS_TYPE_JHB_ZC;
                break;
                break;
        }
        switch ($data['money_type2']) {
            case BONUS_STC:
                $zr_type = BONUS_TYPE_STC_ZR;
                break;
            case BONUS_JHB:
                $zr_type = BONUS_TYPE_JHB_ZR;
                break;
            case BONUS_GW:
                $zr_type = BONUS_TYPE_GW_ZR;
                break;
        }
        //减少转出会员账户金额
        $chage_bonus_zc = Domain_Bonus::addCashHistory($user['id'], -($data['money'] + ($params['fee'] * $data['money'] / 100)), $data['money_type1'], $zc_type, $memo);
        $chage_bonus_zr = Domain_Bonus::addCashHistory($user['id'], $data['money'], $data['money_type2'], $zr_type, $memo);

        if ($inser_id && $chage_bonus_zc && $chage_bonus_zr) {
            Domain_Log::addLog($memo . '->成功', LOG_USERS);
            return array('msg' => T("会员奖金转换") . T('提交') . T('成功'));
        }
        return T("会员奖金转换") . T('提交') . T('失败');
        // }


    }


}