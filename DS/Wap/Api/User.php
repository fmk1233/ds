<?php

/**
 * User: denn
 * Date: 2017/3/10
 * Time: 9:53
 */
class Api_User extends Api_Common
{

    public function getRules()
    {
        return array(
            'main' => array(),
            'address' => array(),
            'doAddress' => array(
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
            'doUserInfo' => array(
                'bank_name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '开户银行',),
                'bank_user' => array('name' => 'user', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '开户姓名',),
                'bank_no' => array('name' => 'no', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '银行卡号',),
                'bank_address' => array('name' => 'address', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '银行地址',),
                'sex' => array('name' => 'sex', 'type' => 'int', 'min' => 1, 'max' => 2, 'default' => 1, 'desc' => '性别'),
                'province' => array('name' => 'province', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '省'),
                'city' => array('name' => 'city', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '区'),
            ),
            'getUserList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'state' => array('name' => 'state', 'type' => 'int', 'desc' => '会员状态'),
            ),
            'activateMember' => array(
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'delMember' => array(
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'register' => array(
                'pwd' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => ''),
                're_pwd' => array('name' => 'repassword', 'type' => 'string', 'require' => true, 'desc' => ''),
                'sec_pwd' => array('name' => 'password2', 'type' => 'string', 'require' => true, 'desc' => ''),
                're_sec_pwd' => array('name' => 'password2', 'type' => 'string', 'require' => true, 'desc' => ''),
                'mobile' => array('name' => 'phone', 'type' => 'string', 'desc' => ''),
                'user_name' => array('name' => 'username', 'type' => 'string', 'require' => true, 'desc' => '用户编号'),
                'true_name' => array('name' => 'realname', 'type' => 'string', 'require' => true, 'desc' => '会员姓名'),
                'pid' => array('name' => 'p_user_name', 'type' => 'string', 'desc' => '推荐人会员编号'),
                'rid' => array('name' => 'r_user_name', 'type' => 'string', 'desc' => '接点人会员编号'),
                'pos' => array('name' => 'pos', 'type' => 'int', 'min' => 0, 'max' => POSNUM, 'default' => 0),
                'sex' => array('name' => 'sex', 'type' => 'int', 'min' => 1, 'max' => 2, 'default' => 1),
                'rank' => array('name' => 'rank', 'type' => 'int', 'default' => 0, 'max' => RANKNUM, 'desc' => '会员等级'),
                'zmd_name' => array('name' => 'zmdname', 'type' => 'string', 'desc' => '报单中心'),
                'province' => array('name' => 'province', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '省'),
                'city' => array('name' => 'city', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '区')
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
            'userReg' => array(
                'rid' => array('name' => 'user_rid', 'type' => 'int', 'default' => 0, 'min' => 0, 'desc' => '接点人ID'),
                'pos' => array('name' => 'pos', 'type' => 'int', 'default' => 1, 'min' => 1, 'max' => POSNUM, 'desc' => '接点位置'),
                'pid' => array('name' => 'user_pid', 'type' => 'int', 'default' => 0, 'min' => 0, 'desc' => '推荐人ID'),
            ),
            'getUpgradeList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
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
            'pwdEdit' => array(
                'action' => array('name' => 'action', 'type' => 'enum', 'range' => array('pwd', 'sec_pwd'), 'require' => true, 'desc' => '修改密码类型'),
                'old_pass' => array('name' => 'old_pass', 'type' => 'string', 'require' => true, 'desc' => '原密码'),
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '新密码'),
                'confirm_password' => array('name' => 'confirm_password', 'type' => 'string', 'require' => true, 'desc' => '新确认密码'),
            ),
        );

    }

    public function main()
    {
        $this->data = array_merge($this->data, Domain_Users::getMain($this->data['user'], true, 'wap'));
        //获取会员等级数组
        return $this->data;
    }

    public function userInfo()
    {
        $user = $this->data['user'];
        $user['pos_name'] = Common_Function::getPosName($user['pos']);
        $user_model = new Model_Users();
        $tj_user = $user_model->get((int)$user['pid'], 'user_name');
        $user['tjr_name'] = $tj_user['user_name'];
        if (POSNUM > 1) {
            $pre_user = $user_model->get((int)$user['rid'], 'user_name');
            $user['pre_name'] = $pre_user['user_name'];
            $user['is_pre'] = true;
        } else {
            $user['pre_name'] = '';
            $user['is_pre'] = false;
        }
        $sex = DI()->config->get('app.sex');
        $user['sex_name'] = $sex[$user['sex']];
        $user['sexs'] = $sex;
        return $user;
    }

    public function address()
    {
        return Domain_Address::getAddressInfo($this->data['user']['id']);
    }

    public function doAddress()
    {
        $data = (array)$this;
        $result = Domain_Address::addAddress($data, $this->data['user']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return;
        }
        throw new PhalApi_Exception_WrongException($result);
    }

    public function doUserInfo()
    {
        $data = (array)$this;
        $data['id'] = $this->data['user']['id'];
        $bank_change = Domain_Users::editMember($data, 2);
        $base_change = Domain_Users::editMember($data, 3);
        if ($bank_change !== false && $base_change !== false) {
            DI()->response->setMsg(T('修改成功'));
            return '';
        }
        throw new PhalApi_Exception_WrongException(T('修改失败'));
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

        if (CAN_BD) {
            $where['zmd_name'] = $this->data['user']['user_name'];
        } else {
            $where['reg_id'] = $this->data['user']['id'];
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
            return $result;
        } else if ($result) {
            throw new PhalApi_Exception_WrongException($result);
        }

    }


    public function userReg()
    {
        $result = array();
        $user_model = new Model_Users();
        $user = $this->data['user'];
        $result['user_pid'] = $user['user_name'];
        $result['user_rid'] = '';
        $result['pos'] = $this->pos;
        if ($this->rid) {//从接点人处注册
            $member = $user_model->get($this->rid, 'user_name');
            if ($member) {
                $result['user_rid'] = $member['user_name'];
            }
        }

        if ($this->pid) {//从推荐人处注册
            $member = $user_model->get($this->pid, 'user_name');
            if ($member) {
                $result['user_pid'] = $member['user_name'];
            }
        }
        $result['can_bd'] = CAN_BD;
        $result['user_name'] = Domain_Users::generalUserName();
        $result['sexs'] = DI()->config->get('app.sex');
        $result['rank_names'] = Common_Function::getRankName();
        $result['pos_names'] = Common_Function::getPosName();
        $result['is_pre'] = POSNUM > 1 ? true : false;
        $result['user_can_bd'] = USER_CAN_BD ? USER_CAN_BD : $user['bd_center'];
        return $result;

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
            $this->data['rank_names'] = Common_Function::getRankName();
            $up_names = Common_Function::upgradeName();
            unset($up_names[0]);
            $this->data['up_names'] = $up_names;
            return $this->data;
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

        $where['user_id'] = $this->data['user']['id'];
        $result = Domain_Upgrade::getUpgradeList($this->limit, $this->offset, $where);
        foreach ($result['rows'] as &$row) {
            $row['old_rank'] = Common_Function::getRankName($row['old_rank']);
            $row['new_rank'] = Common_Function::getRankName($row['new_rank']);
            $row['up_type'] = Common_Function::upgradeName($row['up_type']);
            $row['status_name'] = Common_Function::getCheckName($row['status']);
        }
        unset($row);
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
            $this->data['rank_names'] = Common_Function::getBdCenterName();
            $this->data['user']['bd_name'] = Common_Function::getBdCenterName($this->data['user']['bd_center']);
            return $this->data;
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

        $where['user_id'] = $this->data['user']['id'];

        $result = Domain_ApplyCenter::getApplyCenterList($this->limit, $this->offset, $where);
        foreach ($result['rows'] as &$row) {
            $row['old_rank'] = Common_Function::getBdCenterName($row['old_rank']);
            $row['new_rank'] = Common_Function::getBdCenterName($row['new_rank']);
            $row['status_name'] = Common_Function::getCheckName($row['status']);
        }
        if ($this->data['user']['bd_center'] >= count(Common_Function::getBdCenterName()) - 1) {
            $result['can_apply'] = false;
        } else {
            $result['can_apply'] = true;
        }

        return $result;
    }


    public function team()
    {
        $user_model = new Model_Users();
        $user = $this->data['user'];
        $tj_num = $user_model->getParentCount(array('pid' => $user['id'], 'dept' => 1, 'state>=?' => 1));
        $total_num = $user_model->getParentCount(array('pid' => $user['id'], 'state>=?' => 1));
        $result['rank_name'] = $this->data['user']['rank_name'];
        $result['tj_num'] = $tj_num;
        $result['team_num'] = $total_num;
        $result['user_can_bd'] = USER_CAN_BD ? USER_CAN_BD : $user['bd_center'];
        if (CAN_BD) {
            $result['wait_member'] = $user_model->getUsersCount(array('zmd_name' => $user['user_name'], 'state' => 0));
        } else {
            $result['wait_member'] = $user_model->getUsersCount(array('reg_id' => $user['id'], 'state' => 0));
        }

        return $result;
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
    public function pwdEdit()
    {
        if ($this->password != $this->confirm_password) {
            return $this->action == 'pwd' ? (T('一级密码') . T('和') . T('确认') . T('一级密码') . T('不一致')) : (T('安全密码') . T('和') . T('确认') . T('安全密码') . T('不一致'));
        }
        $data = (array)$this;
        $data['id'] = $this->data['user']['id'];
        switch ($this->action) {
            case 'pwd':
                if ($this->data['user']['pwd'] != md5(md5($this->old_pass) . $this->data['user']['salt'])) {
                    throw new PhalApi_Exception_WrongException(T('请输入正确的密码'));
                }
                $result = Domain_Users::editMember($data, 0);
                break;
            case 'sec_pwd':
                if ($this->data['user']['sec_pwd'] != md5(md5($this->old_pass) . $this->data['user']['sec_salt'])) {
                    throw new PhalApi_Exception_WrongException(T('请输入正确的密码'));
                }
                $result = Domain_Users::editMember($data, 1);
                break;
            default :
                $result = false;
        }
        if ($result) {
            DI()->response->setMsg(T('修改成功'));
            return;
        }
        throw new PhalApi_Exception_WrongException(T('修改失败'));

    }

}