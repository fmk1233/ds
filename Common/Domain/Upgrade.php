<?php

/**
 * User: denn
 * Date: 2017/2/27
 * Time: 23:09
 */
class Domain_Upgrade
{

    /**
     * 获取会员升级列表信息
     * @param $limit 每次查询记录数
     * @param $offset 查询开始位置
     * @param $where 查询条件
     * @return array 返回结果数组
     */
    public static function getUpgradeList($limit, $offset, $where)
    {
        $upgrade_model = new Model_Upgrade();
        $result = $upgrade_model->getList($limit, $offset, $where);
        return $result;
    }

    /**
     * 添加会员升级数据
     * @param $data 会员升级数据
     * @return array|string 失败返回错误提示信息，成功后返回数组
     */
    public static function addUpgrade($data, $log_type = LOG_USERS)
    {

        $user_model = new Model_Users();
        $user = $user_model->get(intval($data['user_id']), 'id,user_name,true_name,rank,' . BONUS_NAME . BONUS_TYPE_STC);
        if (empty($user)) {
            return T('用户不存在');
        } else {
            $user['id'] = intval($user['id']);
            $upgrade_model = new Model_Upgrade();
            $upgrade = $upgrade_model->getInfo(array('user_id' => $user['id'], 'status' => CHECK_SUBMIT));
            if ($upgrade) {
                return T('您已提交申请，请等待审核');
            }

            $moneys = DI()->config->get('setting.money');
            if ($log_type == LOG_USERS) {//判断升级金额是否足够
                if ($data['oldrank'] >= $data['newrank']) {
                    return T('新级别不能小于等于旧级别');
                }
                $bd_money = $moneys[$data['newrank']] - $moneys[$data['oldrank']];
                if ($user[BONUS_NAME . BONUS_TYPE_STC] < $bd_money) {
                    return T('您的余额不足');
                }
            }

            $memo = T('提交会员升级申请');

            //增加会员升级记录表
            $insert_data = array();
            $insert_data['user_id'] = $user['id'];
            $insert_data['user_name'] = $user['user_name'];
            $insert_data['real_name'] = $user['true_name'];
            if ($log_type == LOG_USERS) {
                $insert_data['old_rank'] = $data['oldrank'];
            } else {
                $insert_data['old_rank'] = $user['rank'];
            }
            $insert_data['new_rank'] = $data['newrank'];

            $insert_data['up_type'] = $data['uptype'];
            $insert_data['add_time'] = NOW_TIME;
            $inser_id = $upgrade_model->insert($insert_data);

            if ($inser_id) {
                Domain_Log::addLog($memo . '->成功', $log_type);
                //处理充值订单
                if ($log_type == LOG_ADMIN) {//后台提交处理充值订单
                    Domain_Upgrade::dealUpgrade($inser_id, 'pass');
                }
                return array('msg' => T("会员升级") . T('提交') . T('成功'));
            }
            Domain_Log::addLog($memo . '->失败', $log_type);
            return T("会员升级") . T('提交') . T('失败');
        }


    }


    /**
     * 处理会员升级订单
     * @param $id 处理升级订单Id
     * @param $action 处理操作
     * @return string|bool 成功返回array
     * @throws PhalApi_Exception_WrongException
     */
    public static function dealUpgrade($id, $action)
    {

        $upgrade_model = new Model_Upgrade();
        $upgrade_info = $upgrade_model->get($id, 'id,status,user_id,user_name,old_rank,new_rank');//充值订单
        if (empty($upgrade_info)) {
            return T('非法请求');
        }
        if ($upgrade_info['status'] == CHECK_SUBMIT) {
            DI()->response->setMsg('处理成功');
            $update_data = array();
            $update_data['check_time'] = NOW_TIME;
            DI()->notorm->beginTransaction(DB_DS);
            $change_rank = true;
            $bonus_change = true;
            switch ($action) {
                case 'pass':
                    $update_data['status'] = CHECK_PASS;
                    $memo = T('同意') . T('会员{username}会员升级：原级别{oldrank}->新级别{newrank}', array('username' => $upgrade_info['user_name'], 'oldrank' => Common_Function::getRankName($upgrade_info['old_rank']), 'newrank' => Common_Function::getRankName($upgrade_info['new_rank'])));
                    $user_model = new Model_Users();
                    $user_info = $user_model->get(intval($upgrade_info['user_id']), BONUS_NAME . BONUS_TYPE_STC);
                    $moneys = DI()->config->get('setting.money');
                    $bd_money = $moneys[$upgrade_info['new_rank']] - $moneys[$upgrade_info['old_rank']];
                    if ($user_info[BONUS_NAME . BONUS_TYPE_STC] < $bd_money) {
                        return T('您的余额不足');
                    }
                    $change_rank = $user_model->update(intval($upgrade_info['user_id']), array('rank' => $upgrade_info['new_rank'], 'bdmoney' => $moneys[$upgrade_info['new_rank']]));
                    $bonus_change = Domain_Bonus::addCashHistory($upgrade_info['user_id'], -$bd_money, BONUS_STC, BONUS_TYPE_STC_UP, $memo);

                    break;
                case 'refuse':
                    $memo = T('拒绝') . T('会员{username}会员升级：原级别{oldrank}->新级别{newrank}', array('oldrank' => Common_Function::getRankName($upgrade_info['old_rank']), 'newrank' => Common_Function::getRankName($upgrade_info['new_rank'])));
                    $update_data['status'] = CHECK_REFUSE;
                    break;
            }
            $update_res = $upgrade_model->update($id, $update_data);//更新会员升级订单状态
            Domain_Log::addLog($memo, LOG_ADMIN);
            if ($update_res && $change_rank && $bonus_change) {
                DI()->notorm->commit(DB_DS);
                return array('status' => $update_data['status']);
            }
            DI()->notorm->rollback(DB_DS);
            return T('操作失败');
        } else {
            return T('订单状态异常');
        }


    }
}