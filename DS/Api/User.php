<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/24
 * Time: 9:54
 */
class Api_User extends Api_Common
{

    public function getRules()
    {
        return array(
            'pwdEdit' => array(
                'action' => array(
                    'name' => 'action', 'type' => 'enum', 'range' => array('pwd', 'sec_pwd'), 'require' => true, 'desc' => '修改密码类型'
                )
            ),
            'pwdEditAC' => array(
                'action' => array(
                    'name' => 'action', 'type' => 'enum', 'range' => array('pwd', 'sec_pwd'), 'require' => true, 'desc' => '修改密码类型'
                ),
                'password' => array(
                    'name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '新密码'
                ),
                'confirm_password' => array(
                    'name' => 'confirm_password', 'type' => 'string', 'require' => true, 'desc' => '新确认密码'
                ),
            ),
            'bankInfoEdit' => array(
                'action' => array(
                    'name' => 'action', 'type' => 'enum', 'range' => array('view', 'post'), 'require' => true, 'default' => 'view', 'desc' => '修改银行信息',
                ),
                'bank_name' => array(
                    'name' => 'name', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '开户银行',
                ),
                'bank_user' => array(
                    'name' => 'user', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '开户姓名',
                ),
                'bank_no' => array(
                    'name' => 'no', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '银行卡号',
                ),
                'bank_address' => array(
                    'name' => 'address', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '银行地址',
                ),

            ),
            'addressEdit' => array(
                'action' => array(
                    'name' => 'action', 'type' => 'enum', 'range' => array('view', 'post'), 'require' => true, 'default' => 'view', 'desc' => '修改银行信息',
                ),
                'mobile' => array(
                    'name' => 'phone', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '手机号码',
                ),
                'province' => array('name' => 'province', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '省'),
                'city' => array('name' => 'city', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '区'),
                'address' => array(
                    'name' => 'address', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '详细地址',
                ),
                'realname' => array(
                    'name' => 'realname', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '联系人',
                ),
                'id' => array(
                    'name' => 'addressid', 'type' => 'int', 'require' => true, 'default' => '', 'desc' => '收货地址ID',
                ),

            ),
            'userReg' => array(
                'rid' => array('name' => 'user_rid', 'type' => 'int', 'default' => 0, 'min' => 0, 'desc' => '接点人ID'),
                'pos' => array('name' => 'pos', 'type' => 'int', 'default' => 1, 'min' => 1, 'max' => POSNUM, 'desc' => '接点位置'),
                'pid' => array('name' => 'user_pid', 'type' => 'int', 'default' => 0, 'min' => 0, 'desc' => '推荐人ID'),
            ),
            'register' => array(
                'pwd' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => ''),
                're_pwd' => array('name' => 'repassword', 'type' => 'string', 'require' => true, 'desc' => ''),
                'sec_pwd' => array('name' => 'password2', 'type' => 'string', 'require' => true, 'desc' => ''),
                're_sec_pwd' => array('name' => 'password2', 'type' => 'string', 'require' => true, 'desc' => ''),
                'mobile' => array('name' => 'mobile', 'type' => 'string', 'desc' => ''),
                'user_name' => array('name' => 'username', 'type' => 'string', 'require' => true, 'desc' => '用户编号'),
                'true_name' => array('name' => 'realname', 'type' => 'string', 'require' => true, 'desc' => '会员姓名'),
                'pid' => array('name' => 'p_user_name', 'type' => 'string', 'desc' => '推荐人会员编号'),
                'rid' => array('name' => 'r_user_name', 'type' => 'string', 'desc' => '接点人会员编号'),
                'pos' => array('name' => 'pos', 'type' => 'int', 'min' => 0, 'max' => POSNUM, 'default' => 0),
                'sex' => array('name' => 'sex', 'type' => 'int', 'min' => 1, 'max' => 2, 'default' => 1),
                'rank' => array('name' => 'rank', 'type' => 'int', 'default' => 0, 'max' => RANKNUM, 'desc' => '会员等级'),
                'zmd_name' => array('name' => 'zmd_name', 'type' => 'string', 'desc' => '报单中心'),
                'province' => array('name' => 'province', 'type' => 'int', 'require' => true, 'desc' => '省'),
                'city' => array('name' => 'city', 'type' => 'int', 'require' => true, 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'int', 'require' => true, 'desc' => '区'),
                'weixin' => array('name' => 'weixin', 'type' => 'string', 'default' => '', 'desc' => '微信号'),
                'alipay' => array('name' => 'alipay', 'type' => 'string', 'default' => '', 'desc' => '支付宝'),
                'idcard' => array('name' => 'idcard', 'type' => 'string', 'default' => '', 'desc' => '身份证号'),
                'qq' => array('name' => 'qq', 'type' => 'string', 'default' => '', 'desc' => 'QQ'),
                'email' => array('name' => 'email', 'type' => 'string', 'default' => '', 'desc' => '邮箱'),
            ),
            'getUserList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
                'state' => array('name' => 'state', 'type' => 'int', 'desc' => '会员状态'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'desc' => '查询类型值'),
            ),
            'activateMember' => array(
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'delMember' => array(
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'upgrade' => array(
                'action' => array(
                    'name' => 'action', 'type' => 'enum', 'range' => array('view', 'post'), 'require' => true, 'default' => 'view', 'desc' => '会员升级',
                ),
                'oldrank' => array(
                    'name' => 'oldrank', 'type' => 'int', 'require' => true, 'min' => 0, 'max' => RANKNUM, 'default' => 0, 'desc' => '原会员等级',
                ),
                'newrank' => array(
                    'name' => 'newrank', 'type' => 'int', 'require' => true, 'min' => 0, 'max' => RANKNUM, 'default' => 0, 'desc' => '新会员等级',
                ),
                'uptype' => array(
                    'name' => 'uptype', 'type' => 'int', 'require' => true, 'default' => 1, 'min' => 1, 'max' => 1, 'desc' => '升级类型',
                ),
            ),
            'getUpgradeList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
            ),
            'applyCenter' => array(
                'action' => array(
                    'name' => 'action', 'type' => 'enum', 'range' => array('view', 'post'), 'require' => true, 'default' => 'view', 'desc' => '报单中心升级',
                ),
                'oldrank' => array(
                    'name' => 'oldrank', 'type' => 'int', 'require' => true, 'min' => 0, 'max' => RANKNUM, 'default' => 0, 'desc' => '原会员报单中心等级',
                ),
                'newrank' => array(
                    'name' => 'newrank', 'type' => 'int', 'require' => true, 'min' => 0, 'max' => RANKNUM, 'default' => 0, 'desc' => '新会员报单中心等级',
                ),
            ),
            'getApplyCenterList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
            ),
            'editUser' => array(
                'action' => array(
                    'name' => 'action', 'type' => 'enum', 'range' => array('view', 'post'), 'require' => true, 'default' => 'view', 'desc' => '修改会员资料',
                ),
                'sex' => array('name' => 'sex', 'type' => 'int', 'min' => 1, 'max' => 2, 'default' => 1, 'desc' => '性别'),
                'province' => array('name' => 'province', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '省'),
                'city' => array('name' => 'city', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '区'),

            ),
            'secAc' => array(
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '二级密码'),
            )
        );
    }

    /**
     * 个人中心
     * @desc 个人中心
     */
    public function main()
    {

        $news_model = new Model_News();
        //官方公告
        $this->assign('notices', $news_model->getListByCondition(array('category' => 2), 'id,news_title', 'is_top desc ,id desc', 6));
        $this->data = array_merge($this->data, Domain_Users::getMain($this->data['user']));
        $this->view('main');
    }


    /**
     * 查看会员资料
     * @desc 查看会员资料
     */
    public function userView()
    {
        $user_model = new Model_Users();
        $user = $this->data['user'];
        if ($this->data['user']['pid'] > 0) {
            $tjr_name = $user_model->getInfo(array('id' => $this->data['user']['pid']), 'user_name');
        }
        $this->assign('tjrname', empty($tjr_name['user_name']) ? T('无') : $tjr_name['user_name']);
        if (POSNUM > 1) {
            $pre_name = $user_model->getInfo(array('id' => $this->data['user']['rid']), 'user_name');
            $this->assign('prename', empty($pre_name['user_name']) ? T('无') : $pre_name['user_name']);
        }
        $this->data['user'] = array_merge($this->data['user'], Common_Function::getAddress($user['province'], $user['city'], $user['area']));
        $user_address_model = new Model_UserAddress();
        $this->assign('address', $user_address_model->getInfo(array('user_id' => Common_Function::user_id(), 'is_default' => 1)));

        $this->view('user_view');
    }


    /**
     * 会员注册
     * @desc 会员注册
     */
    public function userReg()
    {
        $user_model = new Model_Users();
        $user = $this->data['user'];
        if (!USER_CAN_BD && $user['bd_center'] == 0) {
            echo PhalApi_Tool::showErrorMsg('管理员尚未开启权限');
        }
        $this->assign('user_pid', $user['user_name']);
        $this->assign('user_rid', '');
        $this->assign('pos', $this->pos);
        if ($this->rid) {//从接点人处注册
            $member = $user_model->get($this->rid, 'user_name');
            if ($member) {
                $this->assign('user_rid', $member['user_name']);
            }
            $this->assign('market', false);
        }

        if ($this->pid) {//从推荐人处注册
            $member = $user_model->get($this->pid, 'user_name');
            if ($member) {
                $this->assign('user_pid', $member['user_name']);
            }
            $this->assign('market', false);
        }
        $protocol_model = new Model_Protocol();
        $protocol = $protocol_model->get(1);//会员注册协议
        $this->assign('protocol', $protocol);
        $this->assign('user_name', Domain_Users::generalUserName());
        $this->view('user_reg');
    }

    public function editUser()
    {
        if ($this->action == 'post') {
            $data = (array)$this;
            $data['id'] = Common_Function::user_id();
            $result = Domain_Users::editMember($data, 3);
            if ($result) {
                DI()->response->setMsg(T('修改成功'));
                return '';
            }
            throw new PhalApi_Exception_WrongException(T('修改失败'));
        } else {
            $this->view('user_edit');
        }
    }

    /**
     * 未审核列表
     * @desc 未审核列表
     */
    public function unUserList()
    {
        $this->assign('state', 0);
        $this->view('user_list');
    }

    /**
     * 未审核列表
     * @desc 未审核列表
     */
    public function userList()
    {
        $this->assign('state', -10);
        $this->view('user_list');
    }

    /**
     * 获取会员列表信息
     * @desc 获取会员列表信息
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getUserList()
    {
        $where = array();

        if (!empty($this->qvalue)) {//相关搜索的数据
            switch ($this->qtype) {
                case 'username':
                    $where['locate( ? ,user_name)>0'] = $this->qvalue;
                    break;
                case 'realname':
                    $where['locate( ? ,true_name)>0'] = $this->qvalue;
                    break;
            }
        }
        if (CAN_BD) {
            $where['zmd_name'] = $this->data['user']['user_name'];
        } else {
            $where['reg_id'] = $this->data['user']['id'];
        }
        if (!empty($this->s_time)) {
            $where['reg_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['reg_time<=?'] = strtotime($this->e_time);
        }
        if ($this->state == -10) {
            $where['state>?'] = 0;
        } else {
            $where['state=?'] = $this->state;
        }
        $result = Domain_Users::getList($this->limit, $this->offset, $where, array('tj' => true, 'pre' => true));
        return $result;
    }

    /**
     * 注册提交
     * @desc 注册提交
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function register()
    {
        $result = Domain_Users::register((array)$this, LOG_USERS);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            $array = array();
            $array['url'] = Common_Function::url(array('service' => 'User.UnUserList'));
            return $array;
        } else if ($result) {
            throw new PhalApi_Exception_WrongException($result);
        }

    }

    /**
     * 修改密码
     * @desc 修改密码
     */
    public function pwdEdit()
    {
        $this->assign('service', 'User.Security');
        $this->assign('type', $this->action);
        $this->view('user_pwd_edit');
    }


    /**
     * 修改银行信息
     * @desc 修改银行信息
     */
    public function bankInfoEdit()
    {
        $this->assign('service', 'User.Security');
        if ($this->action == 'post') {
            $data = (array)$this;
            $data['id'] = Common_Function::user_id();
            $result = Domain_Users::editMember($data, 2);
            if ($result) {
                Domain_Log::addLog('修改会员银行信息', LOG_USERS);
                DI()->response->setMsg(T('修改成功'));
                return array('url' => Common_Function::url(array('service' => 'User.Security')));
            }
            throw new PhalApi_Exception_WrongException(T('修改失败'));
        } else {
            $this->view('user_bank_info');
        }

    }


    /**
     * 修改会员收货信息
     * @desc 修改会员收货信息
     */
    public function addressEdit()
    {
        $this->assign('service', 'User.Security');
        if ($this->action == 'post') {
            $data = (array)$this;
            $result = Domain_Address::addAddress($data, $this->data['user']);
            if (is_array($result)) {
                DI()->response->setMsg($result['msg']);
                return array('url' => Common_Function::url(array('service' => 'User.Security')));
            }
            throw new PhalApi_Exception_WrongException($result);
        } else {
            $this->assign('address', Domain_Address::getAddressInfo(Common_Function::user_id()));
            $this->view('user_address');
        }

    }

    /**
     * 会员安全中心
     * @desc 会员安全中心
     */
    public function security()
    {
        $this->assign('address', Domain_Address::getAddressInfo(Common_Function::user_id()));
        $user_model = new Model_Users();
        $user = $this->data['user'];
        $tj_num = $user_model->getParentCount(array('pid' => $user['id'], 'dept' => 1));
        $active_num = $user_model->getParentCount(array('pid' => $user['id'], 'state>=?' => 1));
        $this->assign('tj_num', $tj_num);
        $this->assign('active_num', $active_num);
        $this->view('user_security');
    }


    /**
     * 修改密码提交
     * @desc 修改密码提交
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function pwdEditAC()
    {
        if ($this->password != $this->confirm_password) {
            return $this->action == 'pwd' ? (T('一级密码') . T('和') . T('确认') . T('一级密码') . T('不一致')) : (T('安全密码') . T('和') . T('确认') . T('安全密码') . T('不一致'));
        }
        $data = (array)$this;
        $data['id'] = Common_Function::user_id();
        switch ($this->action) {
            case 'pwd':
                $result = Domain_Users::editMember($data, 0);
                break;
            case 'sec_pwd':
                $result = Domain_Users::editMember($data, 1);
                break;
        }
        if ($result) {
            DI()->response->setMsg(T('修改成功'));
            return array('url' => Common_Function::url(array('service' => 'User.Security')));
        }
        throw new PhalApi_Exception_WrongException(T('修改失败'));

    }


    /**
     * 激活会员
     * @desc 激活会员
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function activateMember()
    {
        $result = Domain_Users::activateMember($this->user_id, LOG_USERS);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }

    /**
     * 删除会员
     * @desc 删除会员
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function delMember()
    {
        $result = Domain_Users::delMember($this->user_id);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }

    /**
     * 会员等级升级和提交
     * @desc 会员等级升级
     */
    public function upgrade()
    {
        if ($this->action == 'post') {
            DI()->notorm->beginTransaction(DB_DS);
            $data = (array)$this;
            $data['user_id'] = $this->data['user']['id'];
            $result = Domain_Upgrade::addUpgrade($data);
            if (is_array($result)) {
                DI()->response->setMsg($result['msg']);
                DI()->notorm->commit(DB_DS);
            } else {
                DI()->notorm->rollback(DB_DS);
                throw new PhalApi_Exception_WrongException($result);
            }
        } else {
            $user_model = new Model_Users();
            $user = $this->data['user'];
            $tj_num = $user_model->getParentCount(array('pid' => $user['id'], 'dept' => 1));
            $active_num = $user_model->getParentCount(array('pid' => $user['id'], 'state>=?' => 1));
            $this->assign('tj_num', $tj_num);
            $this->assign('active_num', $active_num);
            $this->view('user_upgrade');
        }
    }

    /**
     * 会员升级记录
     * @desc 会员升级记录
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getUpgradeList()
    {
        $where = array();

        $where['user_id'] = Common_Function::user_id();
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }

        $result = Domain_Upgrade::getUpgradeList($this->limit, $this->offset, $where);
        return $result;
    }


    /**
     * 报单中心申请和提交
     * @desc 报单中心申请
     */
    public function applyCenter()
    {
        if ($this->action == 'post') {
            DI()->notorm->beginTransaction(DB_DS);
            $data = (array)$this;
            $data['user_id'] = $this->data['user']['id'];
            $result = Domain_ApplyCenter::addApplyCenter($data);
            if (is_array($result)) {
                DI()->response->setMsg($result['msg']);
                DI()->notorm->commit(DB_DS);
            } else {
                DI()->notorm->rollback(DB_DS);
                throw new PhalApi_Exception_WrongException($result);
            }
        } else {
            $user_model = new Model_Users();
            $user = $this->data['user'];
            $tj_num = $user_model->getParentCount(array('pid' => $user['id'], 'dept' => 1));
            $active_num = $user_model->getParentCount(array('pid' => $user['id'], 'state>=?' => 1));
            $this->assign('tj_num', $tj_num);
            $this->assign('active_num', $active_num);
            $protocol_model = new Model_Protocol();
            $protocol = $protocol_model->get(2);//会员报单协议
            $this->assign('protocol', $protocol);
            $this->view('apply_center');
        }
    }

    /**
     * 报单中心申请记录
     * @desc 报单中心申请记录
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getApplyCenterList()
    {
        $where = array();

        $where['user_id'] = Common_Function::user_id();
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }

        $result = Domain_ApplyCenter::getApplyCenterList($this->limit, $this->offset, $where);
        return $result;
    }

    public function sec()
    {
        $this->assign('service', isset($_COOKIE['services']) ? $_COOKIE['services'] : 'Default.index');
        $this->view('home_sec');
    }

    public function secAc()
    {
        $user = $this->data['user'];
        if (md5(md5($this->password) . $user['sec_salt']) != $user['sec_pwd']) {//判断二级密码提交是否成功
            throw new PhalApi_Exception_WrongException(T('验证失败'));
        }

        DI()->response->setMsg(T('验证成功'));
        $_SESSION[ADMIN_SEC_PWD] = true;
        $cookie = new PhalApi_Cookie();
        $rs = array('url' => Common_Function::url(array('service' => (isset($_COOKIE['services']) ? $_COOKIE['services'] : 'Default.index'))));
        $cookie->delete('services');
        return $rs;
    }

}