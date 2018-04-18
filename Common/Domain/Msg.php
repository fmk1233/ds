<?php

/**
 * User: denn
 * Date: 2017/2/28
 * Time: 10:16
 */
class Domain_Msg
{

    /**
     * 查询留言信息明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public static function getList($limit,$offset,$where)
    {
        $msg_model = new Model_Msg();
        $list = $msg_model->getList($limit,$offset,$where);
        return $list;
    }


    /**
     * 添加留言信息记录
     * @param $data 留言信息数据
     * @param $data 留言信息会员
     * @return array|string 失败返回错误提示信息，成功后返回数组
     */
    public static function addMsg($data,$user)
    {

        if (empty($user)) {
            return T('用户不存在');
        } else {

            $msg_model = new Model_Msg();

            $user['id'] = intval($user['id']);
            //增加充值记录表
            $insert_data = array();
            $insert_data['user_id'] = $user['id'];
            $insert_data['user_name'] = $user['user_name'];
            $insert_data['msg_title'] = $data['title'];
            $insert_data['content'] = $data['content'];
            $insert_data['add_time'] = NOW_TIME;
            $inser_id = $msg_model->insert($insert_data);

            if ($inser_id ) {
                return array('msg' => T("会员留言") . T('提交') . T('成功'));
            }
            return T("会员留言") . T('提交') . T('失败');
        }


    }

    public static function replayParams()
    {
        return array(
            0=>T('否'),
            1=>T('是')
        );
    }
}