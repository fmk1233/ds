<?php

/**
 * User: denn
 * Date: 2017/3/6
 * Time: 8:57
 */
class Domain_ApplyCenter
{
    /**
     * 获取申请报单中心列表信息
     * @param $limit 每次查询记录数
     * @param $offset 查询开始位置
     * @param $where 查询条件
     * @return array 返回结果数组
     */
    public static function getApplyCenterList($limit, $offset, $where)
    {
        $apply_center_model = new Model_ApplyCenter();
        $result = $apply_center_model->getList($limit, $offset, $where);
        return $result;
    }

    /**
     * 添加申请报单中心数据
     * @param $data 申请报单中心数据
     * @return array|string 失败返回错误提示信息，成功后返回数组
     */
    public static function addApplyCenter($data, $log_type = LOG_USERS)
    {
        $user_model = new Model_Users();
        $user = $user_model->get(intval($data['user_id']), 'id,user_name,true_name,bd_center');
        if (empty($user)) {
            return T('用户不存在');
        } else {
            $user['id'] = intval($user['id']);
            $apply_center_model = new Model_ApplyCenter();
            $upgrade = $apply_center_model->getInfo(array('user_id' => $user['id'], 'status' => CHECK_SUBMIT));
            if ($upgrade) {
                return T('您已提交申请，请等待审核');
            }

            $memo = T('提交申请报单中心申请');

            //增加申请报单中心记录表
            $insert_data = array();
            $insert_data['user_id'] = $user['id'];
            $insert_data['user_name'] = $user['user_name'];
            $insert_data['real_name'] = $user['true_name'];
            if ($log_type == LOG_USERS) {
                $insert_data['old_rank'] = $data['oldrank'];
            } else {
                $insert_data['old_rank'] = $user['bd_center'];
            }
            $insert_data['new_rank'] = $data['newrank'];

            if ($insert_data['old_rank'] == $data['newrank']) {
                return T('会员等级不能为相同等级');
            }
//            $insert_data['bd_type'] = $data['bd_type'];
            $insert_data['add_time'] = NOW_TIME;
            $inser_id = $apply_center_model->insert($insert_data);

            if ($inser_id) {
                Domain_Log::addLog($memo . '->成功', $log_type);
                //处理充值订单
                if ($log_type == LOG_ADMIN) {//后台提交处理充值订单
                    Domain_ApplyCenter::dealApplyCenter($inser_id, 'pass');
                }
                return array('msg' => T("申请报单中心") . T('提交') . T('成功'));
            }
            Domain_Log::addLog($memo . '->失败', $log_type);
            return T("申请报单中心") . T('提交') . T('失败');
        }


    }

    /**
     * 设置报单中心
     * @param int $user_id 处理升级订单Id
     * @return string|bool 成功返回array
     * @throws PhalApi_Exception_WrongException
     */
    public static function setBdCenter($data)
    {

        $model_user = new Model_Users();
        $user_info = $model_user->get($data['user_id'], 'id,user_name,bd_center');//充值订单
        if (empty($user_info)) {
            return T('非法请求');
        }
        if ($user_info['bd_center'] == $data['rank']) {
            return T('该会员已经是改等级报单中心');
        }
        DI()->notorm->beginTransaction(DB_DS);
        $memo = T('确认') . T('设置会员{username}为{rank}等级报单中心', array('username' => $user_info['user_name'],'rank'=>Common_Function::getBdCenterName($data['rank'])));
        $change_bdcenter = $model_user->update(intval($user_info['id']), array('bd_center' => $data['rank']));
        Domain_Log::addLog($memo, LOG_ADMIN);
        if ($change_bdcenter) {
            DI()->notorm->commit(DB_DS);
            return array('msg' => T("设置报单中心") . T('成功'));
        }
        DI()->notorm->rollback(DB_DS);
        return T('操作失败');


    }

    /**
     * 处理申请报单中心订单
     * @param $id 处理升级订单Id
     * @param $action 处理操作
     * @return string|bool 成功返回array
     * @throws PhalApi_Exception_WrongException
     */
    public static function dealApplyCenter($id, $action)
    {

        $apply_center_model = new Model_ApplyCenter();
        $upgrade_info = $apply_center_model->get($id, 'id,status,user_id,user_name,old_rank,new_rank');//充值订单
        if (empty($upgrade_info)) {
            return T('非法请求');
        }
        if ($upgrade_info['status'] == CHECK_SUBMIT) {
            DI()->response->setMsg('处理成功');
            $update_data = array();
            $update_data['check_time'] = NOW_TIME;
            DI()->notorm->beginTransaction(DB_DS);
            $change_rank = true;
            switch ($action) {
                case 'pass':
                    $update_data['status'] = CHECK_PASS;
                    $memo = T('同意') . T('会员{username}申请报单中心：原级别{oldrank}->新级别{newrank}', array('username' => $upgrade_info['user_name'], 'oldrank' => Common_Function::getRankName($upgrade_info['old_rank']), 'newrank' => Common_Function::getBdCenterName($upgrade_info['new_rank'])));
                    $user_model = new Model_Users();
                    $change_rank = $user_model->update(intval($upgrade_info['user_id']), array('bd_center' => $upgrade_info['new_rank']));
                    break;
                case 'refuse':
                    $memo = T('拒绝') . T('会员{username}申请报单中心：原级别{oldrank}->新级别{newrank}', array('oldrank' => Common_Function::getBdCenterName($upgrade_info['old_rank']), 'newrank' => Common_Function::getRankName($upgrade_info['new_rank'])));
                    $update_data['status'] = CHECK_REFUSE;
                    break;
            }
            $update_res = $apply_center_model->update($id, $update_data);//更新申请报单中心订单状态
            Domain_Log::addLog($memo, LOG_ADMIN);
            if ($update_res && $change_rank) {
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