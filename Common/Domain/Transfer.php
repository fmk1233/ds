<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/25
 * Time: 9:46
 */
class Domain_Transfer
{

    /**
     * 查询转账明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public static function getList($limit, $offset, $where)
    {
        $transfer_model = new Model_Transfer();
        $lists = $transfer_model->getList($limit, $offset, $where);
        return $lists;
    }


    /**
     * 添加会员转账记录
     * @param $data 会员转账数据
     * @param $data 会员转账会员
     * @return array|string 失败返回错误提示信息，成功后返回数组
     */
    public static function addTrasfer($data, $user)
    {

        $params = Common_Function::transferParams();
//        var_dump($params['rule']);die;
        if ($data['money'] % $params['rule'] != 0) {
            return T('会员转账') . T('金额为{money}的整数倍', array('money' => $params['rule']));
        }
        if ($data['money'] <= 0) {
            return T('会员转账') . T('金额') . T('不能为负数');
        }

        if($user[BONUS_NAME.$data['money_type']]<$data['money']){
            return T('转账金额超过最大金额，您只有{money}',array('money'=>$user[BONUS_NAME.$data['money_type']]));
        }

        $user_model = new Model_Users();
        $to_user = $user_model->getInfo(array('user_name' => $data['username']), 'user_name,id,true_name');
        if (empty($to_user)) {
            return T('转入用户不存在');
        } else {

            $tranfer_model = new Model_Transfer();

            $memo = T('会员{from}转给会员{to}{money_type}账户{money}', array('from' => $user['user_name'], 'to' => $to_user['user_name'], 'money_type' => Common_Function::getBonusName($data['money_type']), 'money' => $data['money']));

            $user['id'] = intval($user['id']);
            //增加充值记录表
            $insert_data = array();
            $insert_data['f_user_id'] = $user['id'];
            $insert_data['f_user_name'] = $user['user_name'];
            $insert_data['f_true_name'] = $user['true_name'];
            $insert_data['t_user_id'] = $to_user['id'];
            $insert_data['t_user_name'] = $to_user['user_name'];
            $insert_data['t_true_name'] = $to_user['true_name'];
            $insert_data['money'] = $data['money'];
            $insert_data['money_type'] = $data['money_type'];
            $insert_data['add_time'] = NOW_TIME;
            $inser_id = $tranfer_model->insert($insert_data);

            switch ($data['money_type']){
                case BONUS_STC:
                    $zr_type = BONUS_TYPE_STC_ZR;
                    $zc_type = BONUS_TYPE_STC_ZC;
                    break;
                case BONUS_JHB:
                    $zr_type = BONUS_TYPE_JHB_ZR;
                    $zc_type = BONUS_TYPE_JHB_ZC;
                    break;
                    break;
                case BONUS_GW:
                    $zr_type = BONUS_TYPE_GW_ZR;
                    $zc_type = BONUS_TYPE_GW_ZC;
                    break;
                    break;
            }
            //减少转出会员账户金额
            $chage_bonus_zc = Domain_Bonus::addCashHistory($user['id'], -$data['money'], $data['money_type'], $zc_type, $memo);
            $chage_bonus_zr = Domain_Bonus::addCashHistory($to_user['id'], $data['money'], $data['money_type'], $zr_type, $memo);

            if ($inser_id && $chage_bonus_zc && $chage_bonus_zr) {
                Domain_Log::addLog($memo.'->成功',LOG_USERS);
                return array('msg' => T("会员转账") . T('提交') . T('成功'));
            }
            return T("会员转账") . T('提交') . T('失败');
        }


    }


}