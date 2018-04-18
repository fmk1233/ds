<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 21:35
 */
class Api_Setting extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'doSysSetting' => array(
                'sys' => array('name' => 'sys', 'type' => 'array', 'desc' => '系统参数'),
            ),
            'doUserReg' => array(
                'sys' => array('name' => 'sys', 'type' => 'array', 'desc' => '会员参数'),
                'power_1' => array('name' => 'power_1', 'type' => 'array', 'desc' => '权限'),
                'power_2' => array('name' => 'power_2', 'type' => 'array', 'desc' => '权限'),
            ),
            'clearData' => array(
                'type' => array('name' => 'type', 'type' => 'enum', 'range' => array('view', 'post'), 'default' => 'view'),
                'password' => array('name' => 'password', 'type' => 'string', 'default' => '')
            ),
            'clearCache'=>array(
                'type' => array('name' => 'type', 'type' => 'enum', 'range' => array('view', 'post'), 'default' => 'view'),
                'caches' => array('name' => 'caches', 'type' => 'array', 'default' => array())
            ),
            'doSearch' => array(
                'type' => array('name' => 'type', 'type' => 'enum', 'range' => array('view', 'post'), 'default' => 'view'),
                'search' => array('name' => 'search', 'type' => 'string', 'default' => ''),
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'display' => array('name' => 'display', 'type' => 'string', 'default' => '')
            ),
            'search' => array(),
            'delSearch' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            ),
            'hotSearch' => array()
        );
    }

    public function hotSearch()
    {
        $setting = Domain_System::getSetting();
        $rec_search = unserialize($setting['rec_search']) ? unserialize($setting['rec_search']) : array();
        $data['total'] = count($rec_search);
        foreach ($rec_search as $key => &$item) {
            $item['id'] = $key + 1;
        }
        unset($item);
        $data['rows'] = $rec_search;
        return $data;
    }

    public function search()
    {
        $this->assign('tips', array('热门搜索词设置后，将显示在前台搜索框作为默认值 随机出现，最多可设置10个热搜词。
', '每个热搜词包括搜索词和显示词两部分，搜索词参于搜索，显示词不参于搜索，只起显示作用。'));
        $this->view('setting/setting_search');
    }

    public function delSearch()
    {
        Domain_System::delSearch($this->id);
    }

    public function doSearch()
    {
        if ($this->type == 'post') {
            $data = array();
            $data['id'] = 1;
            $setting = Domain_System::getSetting();
            $rec_search = $setting['rec_search'] ? unserialize($setting['rec_search']) : array();
            $search = array();
            $search['search'] = $this->search;
            $search['display'] = $this->display;
            if (isset($rec_search[$this->id - 1])) {
                $rec_search[$this->id - 1] = $search;
            } else {
                $rec_search[] = $search;
            }
            $data['search'] = $rec_search;
            $result = Domain_System::updateSetting($data, 1);
            if ($result) {
                DI()->response->setMsg(T('操作成功'));
                return;
            }
            throw new PhalApi_Exception_WrongException(T('操作失败'));
        } else {
            $setting = Domain_System::getSetting();
            $rec_search = $setting['rec_search'] ? unserialize($setting['rec_search']) : array();
            $search = array('id' => 0, 'search' => '', 'display' => '');
            if (isset($rec_search[$this->id - 1])) {
                $search = $rec_search[$this->id - 1];
                $search['id'] = $this->id;
            }
            $this->assign('rec_search', $search);
            $this->view('setting/setting_search_view');
        }
    }

    public function settingUserReg()
    {
        $this->assign('setting', Domain_System::getUserReg());
        $this->assign('menus', DI()->config->get('user_reg'));
        $this->view('setting/setting_user');
    }

    public function doUserReg()
    {
        $data = (array)$this;
        $result = Domain_System::updateSetting($data, 0);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return $result;
        }
        throw new PhalApi_Exception_WrongException($result);

    }

    public function sysSetting()
    {

        $this->assign('setting', DI()->config->get('sys_setting'));
        $this->view('setting/sys_setting');

    }

    public function setting()
    {
        $this->assign('setting', DI()->config->get('setting'));
        $this->view('setting/setting');
    }

    public function clearCache()
    {
        if ($this->type == 'post') {
            foreach ($this->caches as $cachs) {
                DI()->cache->delete($cachs);
            }
            DI()->response->setMsg('清除成功');
        } else {
            $this->view('setting/setting_cache');
        }
    }

    public function clearData()
    {
        if ($this->type == 'post') {
            $admin = Common_Function::admin();
            if (md5(md5($this->password) . $admin['sec_salt']) != $admin['sec_pwd']) {
                throw new PhalApi_Exception_WrongException('请输入正确的二级密码');
            }
            $sql_cleartxt = "
            truncate table ds_orders;
            truncate table ds_pporders; 
            truncate table ds_msg;
            truncate table ds_bonus;
            truncate table ds_log;
            truncate table ds_cash;
            truncate table ds_transfer;
            truncate table ds_bonus_transfer;
            truncate table ds_recharge;
            truncate table ds_shop_order;
            truncate table ds_shop_order_goods;
            truncate table ds_apply_center;
            truncate table ds_contact_user;
            truncate table ds_parent_user;
            truncate table ds_cart;
            truncate table ds_user;
            truncate table ds_user_reward;
            truncate table ds_user_upgrade;
            truncate table ds_user_token;
            truncate table ds_user_bank;
            truncate table ds_user_address
        ";
            $sqlary = explode(";", $sql_cleartxt);
            $userModel = new Model_Users();
            foreach ($sqlary as $value) {
                if (!empty($value)) {
                    $userModel->queryExecute($value);
                }
            }
//            $userModel->clearUserData();
            Common_Function::deleteAllDir(API_ROOT.'/Public/static/upload/temp');
            Common_Function::deleteAllDir(API_ROOT.'/Public/static/upload/user');
            DI()->response->setMsg('清除成功');
            Domain_Log::addLog('清空数据', LOG_ADMIN);
        } else {
            $this->view('setting/setting_clear');
        }

    }

    public function doSetting()
    {
        $post = DI()->request->getAll();
        unset($post['service']);
        foreach ($post as $key => &$item) {//过滤奖金参数，防止非法提交
            if (in_array($key,array('rank_name','open'))) {
                continue;
            }
            if (is_array($item)) {
                foreach ($item as &$it) {
                    if (stripos($it, '~') === false) {
                        $it = (string)round($it, 2);
                    } else {
                        $value = explode('~', $it);
                        foreach ($value as &$v) {
                            $v = (string)round($it, 2);
                        }
                        unset($v);
                        $it = implode('~', $value);
                    }

                }
            } else {
                if (stripos($item, '~') === false) {
                    $item = (string)round($item, 2);
                }
            }
            unset($it);
        }
        unset($item);
        file_put_contents(API_ROOT . '/Config/setting.php', "<?php   \nreturn " . var_export($post, true) . ';');
        Domain_Log::addLog('修改奖金参数'.json_encode($post), LOG_ADMIN);
        DI()->response->setMsg('修改成功');
    }

    public function doSysSetting()
    {
        $new_sys = $this->sys;
        $lang = include(API_ROOT . '/Language/zh_cn/common.php');
        $lang['title'] = $new_sys['name'];
        file_put_contents(API_ROOT . '/Language/zh_cn/common.php', "<?php   \nreturn " . var_export($lang, true) . ';');

        $lang = include(API_ROOT . '/Language/zh_tw/common.php');
        unset($lang['title']);
        file_put_contents(API_ROOT . '/Language/zh_tw/common.php', "<?php   \nreturn " . var_export($lang, true) . ';');

        $lang = include(API_ROOT . '/Language/en/common.php');
        unset($lang['title']);
        file_put_contents(API_ROOT . '/Language/en/common.php', "<?php   \nreturn " . var_export($lang, true) . ';');
        if (isset($_FILES['logo'])) {
            if ($_FILES['logo']["error"] == 0) {
                list ($width, $height, $type, $attr) = getimagesize($_FILES ['logo'] ['tmp_name']);
                if ($type < 1 || $type > 3) {
                    throw new PhalApi_Exception_WrongException(T('图片格式错误'));
                }
                if (!@move_uploaded_file($_FILES['logo']['tmp_name'], API_ROOT . '/Public/static/ds/img/logo-default.png')) {
                    return T('上传失败');
                }
                @unlink($_FILES['logo']['tmp_name']);
            }
        }
        if (isset($_FILES['ico'])) {
            if ($_FILES['ico']["error"] == 0) {

                list ($width, $height, $type, $attr) = getimagesize($_FILES ['ico'] ['tmp_name']);
                if ($type != 17) {
                    throw new PhalApi_Exception_WrongException(T('图片格式错误'));
                }

                if (!@move_uploaded_file($_FILES['ico']['tmp_name'], API_ROOT . '/Public/favicon.ico')) {
                    throw new PhalApi_Exception_WrongException(T('上传失败'));
                }
                @unlink($_FILES['ico']['tmp_name']);
            }
        }

        if(isset($_FILES['admin_bg'])){
            if ($_FILES['admin_bg']["error"] == 0) {

                list ($width, $height, $type, $attr) = getimagesize($_FILES ['admin_bg'] ['tmp_name']);
                if ($type < 1 || $type > 3) {
                    throw new PhalApi_Exception_WrongException(T('图片格式错误'));
                }

                if (!@move_uploaded_file($_FILES['admin_bg']['tmp_name'], API_ROOT . '/Public/static/image/15.png')) {
                    throw new PhalApi_Exception_WrongException(T('上传失败'));
                }
                @unlink($_FILES['admin_bg']['tmp_name']);
            }
        }

        file_put_contents(API_ROOT . '/Config/sys_setting.php', "<?php   \nreturn " . var_export($new_sys, true) . ';');
        Domain_Log::addLog('修改系统参数', LOG_ADMIN);
        DI()->response->setMsg('修改系统参数成功');
    }

}