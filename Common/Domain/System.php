<?php

/**
 * User: denn
 * Date: 2017/4/8
 * Time: 9:40
 */
class Domain_System
{

    public static function getUserReg()
    {
        $setting = self::getSetting();
        return unserialize($setting['user_reg']);
    }

    public static function getSetting()
    {

        $info = DI()->cache->get('setting');
        if (!$info) {
            $system_model = new Model_System();
            $info = $system_model->get(1, '*');
            DI()->cache->set('setting', $info, CACHE_TIME);
        }
        return $info;
    }

    public static function updateSetting($data, $type = 0)
    {

        DI()->cache->delete('setting');
        $system_model = new Model_System();
        $update_array = array();
        switch ($type) {
            case 0:
                $user_reg = array();
                $user_reg['begin'] = $data['sys']['begin'];
                $user_reg['length'] = $data['sys']['length'];
                $user_reg['open'] = $data['sys']['open'];
                $user_reg['power_1'] = $data['power_1'] ? $data['power_1'] : array();
                $user_reg['power_2'] = $data['power_2'] ? $data['power_2'] : array();
                $update_array['user_reg'] = serialize($user_reg);
                break;
            case 1:
                $update_array['rec_search'] = serialize($data['search']);
                break;
        }

        $result = $system_model->update(1, $update_array);
        if ($result === false) {
            return T('操作失败');
        }
        return array('msg' => '操作成功');
    }

    public static function delSearch($id)
    {
        DI()->response->setMsg(T('删除成功'));
        $setting = self::getSetting();
        $result = false;
        $setting['rec_search'] = unserialize($setting['rec_search']);
        if (isset($setting['rec_search'][$id - 1])) {
            unset($setting['rec_search'][$id - 1]);
            $data['search'] = $setting['rec_search'];
            $result = self::updateSetting($data, 1);
        }
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('删除失败'));
        }

    }

}