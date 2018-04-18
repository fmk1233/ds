<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/28
 * Time: 11:33
 */
class Api_Admin extends Api_DCommon
{


    public function getRules()
    {
        return array(
            'changeAdminInfo' => array(
                'newpassword' => array('name' => 'newpassword', 'type' => 'string', 'require' => true, 'desc' => '新的密码或者设置的密码'),
                'renewpassword' => array('name' => 'renewpassword', 'type' => 'string', 'require' => true, 'desc' => '确认密码'),
                'sec_pwd' => array('name' => 'sec_pwd', 'type' => 'string', 'require' => true, 'desc' => '新的二级密码或者设置的二级密码'),
                'resec_pwd' => array('name' => 'resec_pwd', 'type' => 'string', 'require' => true, 'desc' => '确认二级密码'),
                'user_name' => array('name' => 'user_name', 'type' => 'string', 'require' => true, 'desc' => '管理员账号'),
                'adminId' => array('name' => 'adminid', 'type' => 'int', 'require' => true, 'desc' => '管理员Id'),
                'auth_id' => array('name' => 'auth_id', 'type' => 'int', 'desc' => '部门ID'),
            ),
            'getPowerList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'getAdminList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'addPower' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
            ),
            'adminInfo' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
            ),
            'delPower' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
            ),
            'delAdmin' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '删除管理员ID'),
                'sec_pass' => array('name' => 'sec_pass', 'type' => 'string', 'require' => true, 'desc' => '管理员二级密码'),
            ),
            'powerAddAC' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'name' => array('name' => 'title', 'type' => 'string', 'default' => 0),
                'power' => array('name' => 'power', 'type' => 'array', 'default' => 0),
            ),
            'addAdminSecPower' => array(
                'power' => array('name' => 'power', 'type' => 'array', 'default' => 0),
            ),
            'userPowerAc' => array(
                'power' => array('name' => 'power', 'type' => 'array', 'default' => array()),
            ),
            'secAc' => array(
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '二级密码'),
            )

        );
    }

    /**
     *
     * @desc 管理员退出登录
     */
    public function logout()
    {

        parent::logout();
        /*  header('location.href=?DPublic.login');
          exit();*/
        echo '<script>location.reload();</script>';
        exit();
    }

    /**
     *
     * @desc 添加或者修改管理员信息View
     */
    public function adminInfo()
    {
        if ($this->id > 0) {
            $admin_model = new Model_Admin();
            $admin = $admin_model->get($this->id);
        } else {
            $admin = array();
            $admin['id'] = 0;
            $admin['admin_name'] = '';
            $admin['power_id'] = 0;
        }
        $this->assign('admin', $admin);
        $this->assign('powers', DI()->config->get('power'));
        $this->view('admin_info');
    }

    /**
     *
     * @desc 管理员信息列表View
     */
    public function adminList()
    {
        $this->assign('tips', array('当前页面显示系统管理员列表', '为管理员设置部门，可以获得对应部门的系统权限', '点击右上方“添加管理员”按钮，可以新增一位管理员'));
        $this->view('admin_list');
    }

    /**
     *输入二级密码
     * @desc 输入二级密码
     */
    public function sec()
    {
        $this->view('admin_sec');
    }

    /**
     * 二级密码确认
     * @desc 二级密码确认
     * @throws PhalApi_Exception_WrongException 抛出错误异常
     *
     */
    public function secAc()
    {
        $admin_model = new Model_Admin();
        $admin = $admin_model->get(Common_Function::admin_id());
        if (md5(md5($this->password) . $admin['sec_salt']) != $admin['sec_pwd']) {//判断二级密码提交是否成功
            throw new PhalApi_Exception_WrongException(T('验证失败'));
        }

        DI()->response->setMsg(T('验证成功'));
        $_SESSION[ADMIN_SEC_PWD] = true;
        $cookie = new PhalApi_Cookie();
        $rs = array('url' => Common_Function::url(array('service' => isset($_COOKIE['services']) ? $_COOKIE['services'] : 'DIndex.index')));
        $cookie->delete('services');
        return $rs;
    }

    /**
     *系统后台输入二级密码页面设置
     * @desc 系统后台输入二级密码页面设置
     */
    public function adminSecPower()
    {
        $power = DI()->config->get('admin_sec_power');
        $power['power'] = explode(',', $power['power']);
        $this->assign('power', $power);
        $this->assign('menus', DI()->config->get('menu.menu'));
        $this->view('admin_sec_power');
    }

    /**
     * 安全页面设置
     * @desc 安全页面设置
     */
    public function addAdminSecPower()
    {
        DI()->response->setMsg('设置成功');
        $powers = DI()->config->get('admin_sec_power');
        $powers['power'] = implode(',', $this->power);
        file_put_contents(API_ROOT . '/Config/admin_sec_power.php', "<?php   \nreturn " . var_export($powers, true) . ';');
        Domain_Log::addLog('设置安全页面权限', LOG_ADMIN);
    }


    /**
     * 权限信息列表View
     * @desc 权限信息列表View
     */
    public function powerList()
    {
        $this->assign('tips', array('当前页面显示系统部门列表信息', '点击操作栏中“修改”按钮，可以为对应部门设置权限', '点击右上方“添加部门”按钮，可以新增一个部门信息'));
        $this->view('power_list');
    }

    /**
     * 添加或者修改部门信息View
     * @desc 添加或者修改部门信息View
     */
    public function addPower()
    {
        if ($this->id > 0) {//修改
            $power_model = new Model_Power();
            $power = $power_model->get($this->id);
            $power['power'] = explode(',', $power['power']);
        } else {//添加
            $power = array();
            $power['id'] = 0;
            $power['dep_name'] = '';
            $power['power'] = array();
        }

        $this->assign('power', $power);
        $this->assign('menus', DI()->config->get('menu.total'));
        $this->view('power_add');
    }

    /**
     * 修改管理员信息
     * @desc 修改管理员信息
     * @return array  data 返还的数据信息
     * @return stirng  data.url  跳转的url
     * @throws PhalApi_Exception_WrongException 错误抛出错误信息
     */
    public function changeAdminInfo()
    {

        $rs = array();
        $rs['url'] = Common_Function::url(array('service' => 'Admin.AdminList'));
        $admin_model = new Model_Admin();

        if ($this->adminId > 0) {//修改
            DI()->response->setMsg('修改成功');
            $admin = $admin_model->get($this->adminId);
            $update = array();
            $update['admin_name'] = $this->user_name;
            if (!empty($this->auth_id)) {
                $update['power_id'] = $this->auth_id;
            }
            if ($this->newpassword != $this->renewpassword) {//判断新密码和确认密码是否一致
                throw  new PhalApi_Exception_WrongException('新密码和确认密码不一致！');
            }
            if ($this->sec_pwd != $this->resec_pwd) {//判断新二级密码和确认二级密码是否一致
                throw  new PhalApi_Exception_WrongException('新二级密码和确认二级密码不一致！');
            }

            if (!empty($this->newpassword)) {//存在原始密码才修改
                $update['salt'] = Common_Function::randomString();
                $update['password'] = md5(md5($this->newpassword) . $update['salt']);
            }

            if (!empty($this->sec_pwd)) {//存在原始二级密码才修改
                $update['sec_salt'] = Common_Function::randomString();
                $update['sec_pwd'] = md5(md5($this->sec_pwd) . $update['sec_salt']);
            }
            $update['edit_time'] = NOW_TIME;

            $result = $admin_model->update($this->adminId, $update);
            if ($result === false) {//修改成功
                throw  new PhalApi_Exception_WrongException('修改失败');
            } else {
                if ($admin['id'] == Common_Function::admin_id()) {//如果修改的是自己的管理员账号。退出重新登录
                    parent::logout();
                }

                Domain_Log::addLog('修改管理员' . $admin['admin_name'] . '信息', LOG_ADMIN);
            }
        } else {
            DI()->response->setMsg('添加成功');
            if ($this->newpassword != $this->renewpassword) {
                throw  new PhalApi_Exception_WrongException('密码和确认密码不一致');
            }
            if ($this->sec_pwd != $this->resec_pwd) {
                throw  new PhalApi_Exception_WrongException('二级密码和确认二级密码不一致');
            }

            $insert_array = array();
            $insert_array['admin_name'] = $this->user_name;
            $insert_array['add_time'] = NOW_TIME;
            $insert_array['salt'] = Common_Function::randomString();
            $insert_array['power_id'] = $this->auth_id;
            $insert_array['password'] = md5(md5($this->newpassword) . $insert_array['salt']);
            $insert_array['sec_salt'] = Common_Function::randomString();
            $insert_array['sec_pwd'] = md5(md5($this->sec_pwd) . $insert_array['sec_salt']);
            $insertId = $admin_model->insert($insert_array);
            if (!$insertId) {
                throw  new PhalApi_Exception_WrongException('添加失败');
            }

            Domain_Log::addLog('添加管理员' . $insert_array['admin_name'], LOG_ADMIN);


        }
        return $rs;
    }

    /**
     * 获取部门列表信息
     * @desc 获取部门列表信息
     * @return array data 部门列表数组
     * @return int data.id 部门ID
     * @return string data.power_name 部门名称
     * @return array data 部门列表数组
     * @return array data 部门列表数组
     */
    public function getPowerList()
    {
        $powerModel = new Model_Power();
        $where = array();
        $result = $powerModel->getList($this->limit, $this->offset, $where);
        return $result;
    }

    /**
     * @return array
     */
    public function getAdminList()
    {
        $adminModel = new Model_Admin();
        $where = array();
        $result = $adminModel->getList($this->limit, $this->offset, $where);
        foreach ($result['rows'] as &$item) {
            $power = DI()->config->get('power.' . $item['power_id']);
            $item['auth_name'] = $power['dep_name'];
        }
        unset($item);
        return $result;
    }

    /**
     * @return array
     * @throws PhalApi_Exception_WrongException
     */
    public function powerAddAC()
    {
        DI()->response->setMsg('添加成功');
        $rs = array();
        $rs['url'] = Common_Function::url(array('service' => 'Admin.PowerList'));
        $power_model = new Model_Power();
        $id = $this->id;
        if ($this->id > 0) {
            DI()->response->setMsg('修改成功');
            $update_array = array();
            $update_array['dep_name'] = $this->name;
            $update_array['power'] = implode(',', $this->power);
            $result = $power_model->update($this->id, $update_array);
            if ($result === false) {
                throw  new PhalApi_Exception_WrongException('修改失败');
            }
        } else {
            $insert_array = array();
            $insert_array['dep_name'] = $this->name;
            $insert_array['add_time'] = NOW_TIME;
            $insert_array['power'] = implode(',', $this->power);
            $insert_id = $power_model->insert($insert_array);
            $id = $insert_id;
            if (!$insert_id) {
                throw  new PhalApi_Exception_WrongException('添加失败');
            }
        }
        if ($id > 0) {
            $power_info = DI()->config->get('power');
            $powers = implode(',', $this->power) . ',';
            $menu_power = DI()->config->get('menu.menu');
            foreach ($menu_power as $key => $menus) {
                foreach ($menus as $k => $menu) {
                    if (stripos($powers, $menu . ',') === false) {
                        unset($menu_power[$key][$k]);
                    }
                }
                if (count($menu_power[$key]) == 0) {
                    unset($menu_power[$key]);
                }
            }
            $power_info[$id] = array('id' => intval($id), 'dep_name' => $this->name, 'power' => implode(',', $this->power), 'menu' => $menu_power);
            file_put_contents(API_ROOT . '/Config/power.php', "<?php   \nreturn " . var_export($power_info, true) . ';');
        }

        return $rs;
    }


    /**
     * @throws PhalApi_Exception_WrongException
     */
    public function delPower()
    {
        DI()->response->setMsg('删除成功');
        $powerModel = new Model_Power();
        if ($this->id == 1) {
            throw  new PhalApi_Exception_WrongException('总部门不能删除');
        } else {
            $result = $powerModel->delete($this->id);
            if (!$result) {
                throw  new PhalApi_Exception_WrongException('删除失败');
            } else {
                $powers = DI()->config->get('power');
                unset($powers[$this->id]);
                file_put_contents(API_ROOT . '/Config/power.php', "<?php   \nreturn " . var_export($powers, true) . ';');
            }
        }
    }

    /**
     * 删除管理员
     * @desc 删除管理员
     * @throws PhalApi_Exception_WrongException 失败返回失败信息
     * @return msg 删除成功
     */
    public function delAdmin()
    {
        DI()->response->setMsg('删除成功');
        $admin_model = new Model_Admin();
        if ($this->id == 1) {
            throw  new PhalApi_Exception_WrongException('总管理员不能删除');
        } else {
            $orgin_admin = $admin_model->get(Common_Function::admin_id());
            if ($orgin_admin['sec_pwd'] != md5(md5($this->sec_pass) . $orgin_admin['sec_salt'])) {//验证二级密码是否正确
                throw  new PhalApi_Exception_WrongException('请输入正确的二级密码');
            }
            $result = $admin_model->delete($this->id);
            if (!$result) {
                throw  new PhalApi_Exception_WrongException('删除失败');
            }
        }
    }

    /**
     * 会员使用权限
     * @desc 会员使用权限
     */
    public function userPower()
    {
        $user_power = DI()->config->get('home_power');
        $power['power'] = explode(',', $user_power['power']);
        $this->assign('power', $power);
        $this->assign('menus', $user_power['total']);
        $this->view('user/user_power');
    }

    /**
     * 会员使用权限修改
     * @desc 会员使用权限修改
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function userPowerAc()
    {
        DI()->response->setMsg('设置成功');
        $user_power = DI()->config->get('home_power');
        $power = implode(',', $this->power);
        $menu_power = $user_power['all'];
        $powers = $power . ',';
        foreach ($menu_power as $key => $menus) {
            foreach ($menus as $k => $menu) {
                if (stripos($powers, $menu . ',') === false) {
                    unset($menu_power[$key][$k]);
                }
            }
            if (count($menu_power[$key]) == 0) {
                unset($menu_power[$key]);
            }
        }

        $user_power['menu'] = $menu_power;
        $user_power['power'] = $power;
        file_put_contents(API_ROOT . '/Config/home_power.php', "<?php   \nreturn " . var_export($user_power, true) . ';');
        Domain_Log::addLog('修改会员使用权限', LOG_ADMIN);
    }

}