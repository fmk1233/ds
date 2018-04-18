<?php

/**
 * User: denn
 * Date: 2017/2/28
 * Time: 23:27
 */
class Domain_Address
{
    /**
     * 获取会员收货地址信息
     * @param $limit 每次查询记录数
     * @param $offset 查询开始位置
     * @param $where 查询条件
     * @return array 返回结果数组
     */
    public static function getAddressList($limit, $offset, $where)
    {
        $user_address_model = new Model_UserAddress();
        $result = $user_address_model->getList($limit, $offset, $where);
        return $result;
    }

    public static function getAddressListByWhere($where=array())
    {
        $user_address_model = new Model_UserAddress();
        $result = $user_address_model->getListByWhere($where);
        return $result;
    }

    /**
     * 获取会员收货地址
     * @param $id
     * @param string $field
     * @return array|mixed
     */
    public static function getAddressInfo($user_id, $field = '*')
    {
        $user_address_model = new Model_UserAddress();
        $user_address = $user_address_model->getInfo(array('user_id' => $user_id, 'is_default' => 1), $field);
        if (empty($user_address)) {
            $user_address = array();
            $user_address['mobile'] = '';
            $user_address['province'] = 0;
            $user_address['city'] = 0;
            $user_address['area'] = 0;
            $user_address['address'] = '';
            $user_address['realname'] = '';
            $user_address['id'] = 0;
        }

        return $user_address;
    }

    /**
     * 添加或修改会员地址信息
     * @param $data
     * @return array|string
     */
    public static function addAddress($data, $user)
    {

        if (empty($user)) {
            return T('用户不存在');
        } else {
            $user_address_model = new Model_UserAddress();

            if ($data['id'] > 0) {//修改
                $update_array = array();
                $update_array['realname'] = $data['realname'];
                $update_array['mobile'] = $data['mobile'];
                $update_array['province'] = $data['province'];
                $update_array['city'] = $data['city'];
                $update_array['area'] = $data['area'];
                $update_array['address'] = $data['address'];
                $up_result = $user_address_model->update($data['id'], $update_array);
                if ($up_result === false) {
                    return T('修改失败');
                }
                return array('msg' => T('修改成功'));
            } else {//添加
                $insert_array = array();
                $insert_array['realname'] = $data['realname'];
                $insert_array['mobile'] = $data['mobile'];
                $insert_array['province'] = $data['province'];
                $insert_array['city'] = $data['city'];
                $insert_array['area'] = $data['area'];
                $insert_array['is_default'] = 0;
                $insert_array['user_id'] = $user['id'];
                $insert_array['address'] = $data['address'];
                $insert_id = $user_address_model->insert($insert_array);
                if ($insert_id) {
                    Domain_Address::setDefault($insert_id, $user['id']);
                    return array('msg' => T('添加成功'));
                }
                return array('msg' => T('添加成功'));

            }
        }

    }

    public static function setDefault($address_id, $user_id)
    {
        $address_id = intval($address_id);
        $user_id = intval($user_id);
        $user_address_model = new Model_UserAddress();
        $update_all = $user_address_model->updateByCondition(array('user_id' => $user_id), array('is_default' => 0));
        if ($update_all !== false) {
            $update_default = $user_address_model->update($address_id, array('is_default' => 1));
            if ($update_default) {
                return array('msg' => T('操作成功'));
            }
        }
        return T('操作失败');

    }

    public static function delAddress($address_id)
    {
        $address_id = intval($address_id);
        $user_address_model = new Model_UserAddress();
        $del_res = $user_address_model->delete($address_id);
        if ($del_res) {
            return array('msg' => T('操作成功'));
        }
        return T('操作失败');
    }

}