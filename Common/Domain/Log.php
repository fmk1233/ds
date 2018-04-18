<?php

/**
 * Class Domain_Log 系统日志
 */
class Domain_Log
{

    /**
     * 生成日志
     * @param string $memo 日志内容
     * @param int $log_type 日志类型 0：系统；1：管理员；2：用户
     * @return bool
     */
    public static function addLog($memo, $log_type = LOG_SYS, $user = array('id' => 0, 'user_name' => ''))
    {
        $model_log = new Model_Log();
        $data = array();
        $data['log_type'] = $log_type;
        if ($log_type == 0) { //系统自身产生日志
            $data['operator_name'] = '系统';
        } else if ($log_type == 1) {
            $admin_info = Common_Function::admin();
            $memo = '管理员' . $admin_info['admin_name'] . $memo;
            $data['operator_id'] = $admin_info['id'];
            $data['operator_name'] = $admin_info['admin_name'];
        } else {
            $user_info = Common_Function::user();
            if ($user_info == 0) {
                $user_info = $user;
            }
            $memo = '会员' . $user_info['user_name'] . $memo;
            $data['operator_id'] = $user_info['id'];
            $data['operator_name'] = $user_info['user_name'];
        }
        $data['memo'] = $memo;
        $data['add_time'] = time();
        $data['operator_ip'] = Common_Function::getip();
        $data['operator_url'] = DI()->request->get('service');
        $insert_result = $model_log->insert($data);
        if ($insert_result) {
            return false;
        } else {
            return '日志生成失败';
        }
    }

    /**
     * 获取日志列表
     * @param $limit
     * @param $offset
     * @param array $where
     * @return array
     */
    public function getLogList($limit, $offset, $where = array())
    {
        $log_model = new Model_Log();
        $result = $log_model->getList($limit, $offset, $where);
        return $result;
    }
}