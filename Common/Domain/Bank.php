<?php

/**
 * User: denn
 * Date: 2017/3/30
 * Time: 8:47
 */
class Domain_Bank
{
    public static  function getAllBank(){
        $bank_model = new Model_Bank();
        $list = $bank_model->getListByWhere();
        return $list;
    }

    public static function getList($limit, $offset, $where)
    {
        $bank_model = new Model_Bank();
        $list = $bank_model->getList($limit, $offset, $where);
        return $list;
    }

    public static function getInfo($id)
    {
        $bank_model = new Model_Bank();
        $info = array();
        if ($id > 0) {
            $info = $bank_model->get($id);
        }
        if (empty($info)) {
            $info['id'] = 0;
            $info['bank'] = '';
            $info['zhanghao'] = '';
            $info['huzhu'] = '';
        }
        return $info;
    }

    public static function update($data)
    {

        $rs['msg'] = T('操作成功');
        $rs['url'] = Common_Function::url(array('service' => 'Bank.ListView'));

        $bank_model = new Model_Bank();

        if ($data['id'] > 0) {
            $update_array = array();
            $update_array['bank'] = $data['bank'];
            $update_array['zhanghao'] = $data['zhanghao'];
            $update_array['huzhu'] = $data['huzhu'];
            $result = $bank_model->update($data['id'],$update_array);
            if ($result === false) {
                return T('操作失败');
            }
        } else {

            $insert_array = array();
            $insert_array['bank'] = $data['bank'];
            $insert_array['zhanghao'] = $data['zhanghao'];
            $insert_array['huzhu'] = $data['huzhu'];
            $insert_array['add_time'] = NOW_TIME;
            $result = $bank_model->insert($insert_array);
            if (!$result) {
                return T('操作失败');
            }
        }
        return $rs;
    }

    public static function del($id)
    {
        DI()->response->setMsg(T('删除成功'));
        $bank_model = new Model_Bank();
        $result = $bank_model->delete($id);
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('删除失败'));
        }

    }

}