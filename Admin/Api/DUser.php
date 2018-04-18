<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 17:22
 */
class Api_DUser extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'userList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'state' => array('name' => 'member_state', 'type' => 'int', 'default' => -1, 'desc' => '会员状态'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                'tjr_name' => array('name' => 'tjr_name', 'type' => 'string', 'desc' => '推荐人编号'),
                'pre_name' => array('name' => 'pre_name', 'type' => 'string', 'desc' => '接点人编号'),
                'rank' => array('name' => 'rank', 'type' => 'int', 'default' => -1, 'desc' => '会员等级'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
            ),
            'expUserList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                'rank' => array('name' => 'rank', 'type' => 'int', 'default' => -1, 'desc' => '会员等级'),
            ),
            'loginHome' => array(
                'userId' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'userInfo' => array(
                'userId' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'userView' => array(
                'userId' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'userreg' => array(
                'rid' => array('name' => 'user_rid', 'type' => 'int', 'default' => 0, 'min' => 0, 'desc' => '接点人ID'),
                'pos' => array('name' => 'pos', 'type' => 'int', 'default' => 1, 'min' => 1, 'max' => POSNUM, 'desc' => '接点位置'),
                'pid' => array('name' => 'user_pid', 'type' => 'int', 'default' => 0, 'min' => 0, 'desc' => '推荐人ID'),
            ),
            'userRegAC' => array(
                'pwd' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => ''),
                're_pwd' => array('name' => 'repassword', 'type' => 'string', 'require' => true, 'desc' => ''),
                'sec_pwd' => array('name' => 'password2', 'type' => 'string', 'require' => true, 'desc' => ''),
                're_sec_pwd' => array('name' => 'password2', 'type' => 'string', 'require' => true, 'desc' => ''),
                'mobile' => array('name' => 'mobile', 'type' => 'string', 'desc' => ''),
                'user_name' => array('name' => 'username', 'type' => 'string', 'require' => true, 'desc' => '用户编号'),
                'true_name' => array('name' => 'realname', 'type' => 'string', 'require' => true, 'desc' => '会员姓名'),
                'pid' => array('name' => 'p_user_name', 'type' => 'string', 'desc' => '推荐人会员编号'),
                'rid' => array('name' => 'r_user_name', 'type' => 'string', 'desc' => '接点人会员编号'),
                'market' => array('name' => 'market', 'type' => 'int', 'min' => 0, 'max' => 1, 'default' => 0, 'desc' => '市场'),
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
            'changeUserInfo' => array(
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => ''),
                'password2' => array('name' => 'password2', 'type' => 'string', 'require' => true, 'desc' => ''),
                'phone' => array('name' => 'phone', 'type' => 'string', 'require' => true, 'desc' => ''),
                'state' => array('name' => 'state', 'type' => 'int', 'require' => true, 'desc' => ''),
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => ''),
                'sex' => array('name' => 'sex', 'type' => 'enum', 'require' => true, 'range' => array(1, 2), 'desc' => '性别'),
                'province' => array('name' => 'province', 'type' => 'int', 'require' => true, 'desc' => '省'),
                'city' => array('name' => 'city', 'type' => 'int', 'require' => true, 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'int', 'require' => true, 'desc' => '区'),
            ),
            'net' => array(
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'desc' => '查询类型值'),
                'type' => array('name' => 'type', 'type' => 'int', 'min' => 1, 'max' => 2, 'desc' => '网络图类型'),
                'net_type' => array('name' => 'net_type', 'type' => 'enum', 'range' => array('net', 'tree'), 'desc' => '网络图类型'),
            ),
            'activateMember' => array(
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'openMember' => array(
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
                'is_open' => array('name' => 'isopen', 'type' => 'int', 'require' => true, 'desc' => '是否封停'),
            ),
            'cashMember' => array(
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
                'can_cash' => array('name' => 'cancash', 'type' => 'int', 'require' => true, 'desc' => '是否允许提现'),
            ),
            'delMember' => array(
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
            ),
            'getUpgradeList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
                'state' => array('name' => 'state', 'type' => 'int', 'desc' => '会员状态'),
            ),
            'dealUpgrade' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => "会员升级订单ID"),
                'action' => array('name' => 'action', 'type' => 'enum', 'range' => array('pass', 'refuse'), 'require' => true, 'desc' => '操作类型')
            ),
            'editRank' => array(
                'action' => array('name' => 'action', 'type' => 'enum', 'range' => array('post', 'view'), 'require' => true, 'desc' => '操作类型'),
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
                'rank' => array('name' => 'rank', 'type' => 'int', 'default' => 0, 'max' => RANKNUM, 'desc' => '会员等级'),
            ),
            'editBdcenter' => array(
                'action' => array('name' => 'action', 'type' => 'enum', 'range' => array('post', 'view'), 'require' => true, 'desc' => '操作类型'),
                'user_id' => array('name' => 'userid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
                'rank' => array('name' => 'rank', 'type' => 'int', 'desc' => '报单等级'),
            ),
            'getApplyCenterList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
            ),
            'dealApplyCenter' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => "会员报单中心申请订单ID"),
                'action' => array('name' => 'action', 'type' => 'enum', 'range' => array('pass', 'refuse'), 'require' => true, 'desc' => '操作类型')
            )
        );
    }

    /**
     *已审核会员列表View
     * @desc 已审核会员列表View
     */
    public function users()
    {
        $this->assign('tips', array('当前页面显示已通过审核的会员', '点击操作栏中的“登入”按钮，可以登录对应会员前台'));
        $this->assign('state', -10);
        $this->view('user/users');
    }


    /**
     * 异常会员列表
     * @desc 异常会员列表
     */
    public function expUsers()
    {
        $this->assign('tips', array('当前页面显示系统检测为行为异常的会员列表', '异常会员账号将被系统封禁，无法登系统', '进行日常操作时，请留意该会员行为或数据是否异常，以免遭受损失'));
        $this->view('user/user/user_exp');
    }

    /**
     *已审核会员列表View
     * @desc 已审核会员列表View
     */
    public function unConfirmUsers()
    {
        $this->assign('tips', array('当前页面显示未通过审核的会员', '如需推荐人信息填写有误，请删除后重新注册'));
        $this->assign('state', 0);
        $this->view('user/users');
    }

    /**
     *后台市场注册View
     * @desc 后台市场注册
     */
    public function userReg()
    {
        $user_model = new Model_Users();
        $user_count = $user_model->getUsersCount();
        if ($user_count == 0) {
            $this->assign('market', true);
        } else {
            $this->assign('market', false);
        }
        $this->assign('user_rid', '');
        $this->assign('user_pid', '');
        $this->assign('pos', $this->pos);
        if ($this->rid) {//从接点人处注册
            $member = $user_model->get($this->rid, 'user_name');
            if ($member) {
                $this->assign('user_rid', $member['user_name']);
                $this->assign('user_pid', $member['user_name']);
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
        $this->assign('user_name', Domain_Users::generalUserName());
        $this->view('user/user_reg');
    }


    /**
     *后台市场注册提交
     * @desc 后台市场注册提交
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return null d.data 返回的数据信息
     */
    public function userRegAC()
    {

        $result = Domain_Users::register((array)$this);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return $result;
        } else if ($result) {
            throw new PhalApi_Exception_WrongException($result);
        }

    }


    /**
     * 会员信息列表数据获取
     * @desc 会员信息列表数据获取
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function userList()
    {
        $user_model = new  Model_Users();
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }

        if ($this->rank >= 0) {
            $where['rank=?'] = $this->rank;
        }
        if (!empty($this->tjr_name)) {
            $pid = $user_model->getInfo(array('user_name' => $this->tjr_name), 'id');
            $where['pid=?'] = $pid['id'];
        }
        if (!empty($this->pre_name)) {
            $rid = $user_model->getInfo(array('user_name' => $this->pre_name), 'id');
            $where['rid=?'] = $rid['id'];
        }
        if ($this->state >= 0) {
            $where['state=?'] = $this->state;
        }
        if ($this->state == -10) {
            $where['state>=?'] = 1;
        }

        if (!empty($this->s_time)) {
            $where['reg_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['reg_time<=?'] = strtotime($this->e_time);
        }

        return Domain_Users::getList($this->limit, $this->offset, $where, array('tj' => true, 'pre' => true));

    }


    /**
     * 异常会员信息列表数据获取
     * @desc 异常会员信息列表数据获取
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function expUserList()
    {
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . str_replace('member-', '', $this->qtype) . ')>0'] = $this->qvalue;
        }

        if ($this->rank >= 0) {
            $where['rank=?'] = $this->rank;
        }

        return Domain_Users::getExpList($this->limit, $this->offset, $where, array('tj' => true, 'pre' => true));

    }

    /**
     *
     */
    public function loginHome()
    {
        $userModel = new  Model_Users();
        $user = $userModel->get($this->userId, 'user_name');
        $userDomain = new Domain_Users();
        $result = $userDomain->login($user['user_name'], '', false);
        if ($result === true) {
            header('location:' . dirname(URL_ROOT));
        } else {
            echo '<script>alert("' . $result . '")</script>';
            exit();
        }


    }

    /**
     *
     */
    public function userInfo()
    {
        $userModel = new  Model_Users();
        $this->assign('user', $userModel->get($this->userId));
        $this->view('user/user_info');
    }

    /**
     * 会员资料查看页面
     * @desc 会员资料查看页面
     */
    public function userView()
    {
        $this->assign('user', Domain_Users::getUserInfo(array('id' => $this->userId), '*', array('tj' => true, 'pre' => true)));
        $this->assign('address', Domain_Address::getAddressInfo($this->userId));
        $this->view('user/user_view');
    }

    /**
     *
     */
    public function changeUserInfo()
    {
        $data = (array)$this;
        $data['id'] = $data['user_id'];
        $result = Domain_Users::editMember($data, 4);//后台修改
        if ($result === false) {
            throw new PhalApi_Exception_WrongException('修改失败');
        } else {
            DI()->response->setMsg('修改成功');
        }
    }


    /**
     * 会员的安置网络图
     * @desc 会员的安置网络图
     */
    public function preNet()
    {
        $user_model = new Model_Users();
        $where['rid'] = 0;
        $member = $user_model->getInfo($where, 'id');
        $this->assign('tips', array('本网络图根据会员的接点关系进行排网'));
        $this->assign('member_id', $member['id'] ? $member['id'] : 0);
        $this->view('user/user_pre_net');
    }

    /**
     * 会员的推荐网络图
     * @desc 会员的推荐网络图
     */
    public function tjNet()
    {
        $user_model = new Model_Users();
        $where['pid'] = 0;
        $member = $user_model->getInfo($where, 'id');
        $this->assign('tips', array('本网络图根据会员的推荐关系进行排网'));
        $this->assign('member_id', $member['id'] ? $member['id'] : 0);
        $this->view('user/user_tj_net');
    }


    /**
     * 获取会员的安置网络图
     * @desc 获取会员的安置网络图
     * @return string 返回安置网体图Html
     */
    public function net()
    {
        if ($this->net_type == 'net') {//网络图
            if (empty($this->qvalue)) {//判断查询操作值是否存在
                echo '查询会员不存在';
            } else {
                $user_model = new Model_Users();
                $where = array();
                $where[$this->qtype] = $this->qvalue;
                $member = $user_model->getInfo($where);
                if ($member) {
                    $this->assign('type', 'admin');
                    $this->assign('member', $member);
                    if ($this->type == 1) {//安置图

                        $this->view('user/user_pre_net_base');

                    } else {//推荐网络图
                        $this->view('user/user_tj_net_base');
                    }

                } else {
                    echo '查询会员不存在';
                }

            }
        } else {
            $user_model = new Model_Users();
            if ($this->type == 1) {//安置图
                if ($this->qtype) {
                    $users = $user_model->getListByWhere(array($this->qtype => $this->qvalue), 'id,user_name as name,pos,state,rank,gldept');
                } else {
                    $users = $user_model->getListByWhere(array('rid' => $this->qvalue), 'id,user_name as name,pos,state,rank,gldept');
                }


                foreach ($users as &$user) {
                    switch ($user['rank'] + 1) {
                        case 0:
                            $bg1 = "#8b8484";
                            break;
                        case 1:
                            $bg1 = "#009999";
                            break;
                        case 2:
                            $bg1 = "#8891ed";
                            break;
                        case 3:
                            $bg1 = "#ff6700";
                            break;
                        case 4:
                            $bg1 = "#aa3939";
                            break;
                        case 5:
                            $bg1 = "#336699";
                            break;
                        case 6:
                            $bg1 = "#FFCC00";
                            break;
                        case 7:
                            $bg1 = "#FF9900";
                            break;
                    }
                    $state = '已开通';
                    if ($user['state'] == 0) {
                        $bg1 = "#8b8484";
                        $state = '未开通';
                    }
                    $user['name'] = '<span style="background-color: ' . $bg1 . ';">[' . $user['gldept'] . '] [' . $user['name'] . '] [' . Common_Function::getRankName($user['rank']) . '] [' . $state . ']</span>';
                    $user['isParent'] = true;
                }
                if (count($users) == 0) {
                    return array(array('id' => $this->qvalue, 'name' => '<a style="line-height:31px;" data-service="DUser.UserReg"  data-pos="1" data-toggle="url" data-user_rid="' . $this->qvalue . '">注册新会员</a>', 'isParent' => false), array('id' => 0, 'name' => '<a data-service="DUser.UserReg"  data-pos="2" data-toggle="url" data-user_rid="' . $this->qvalue . '" style="line-height:31px;" >注册新会员</a>', 'isParent' => false));
                } elseif (count($users) == 1 && $this->qvalue != 0) {
                    if ($users[0]['pos'] == 2) {
                        array_splice($users, 0, 0, array(array('id' => $this->qvalue, 'name' => '<a data-service="DUser.UserReg"  data-pos="1" data-toggle="url" data-user_rid="' . $this->qvalue . '" style="line-height:31px;" >注册新会员</a>', 'isParent' => false)));
                    } else {
                        $users[] = array('id' => $this->qvalue, 'name' => '<a data-service="DUser.UserReg"  data-pos="2" data-toggle="url" data-user_rid="' . $this->qvalue . '"  style="line-height:31px;" >注册新会员</a>', 'isParent' => false);
                    }
                }
                unset($user);
                return $users;

            } else {
                if ($this->qtype) {
                    $users = $user_model->getListByWhere(array($this->qtype => $this->qvalue), 'id,user_name as name,pos,state,rank,tjdept');
                } else {
                    $users = $user_model->getListByWhere(array('pid' => $this->qvalue), 'id,user_name as name,pos,state,rank,tjdept');
                }
                foreach ($users as &$user) {
                    switch ($user['rank'] + 1) {
                        case 0:
                            $bg1 = "#8b8484";
                            break;
                        case 1:
                            $bg1 = "#009999";
                            break;
                        case 2:
                            $bg1 = "#8891ed";
                            break;
                        case 3:
                            $bg1 = "#ff6700";
                            break;
                        case 4:
                            $bg1 = "#aa3939";
                            break;
                        case 5:
                            $bg1 = "#336699";
                            break;
                        case 6:
                            $bg1 = "#FFCC00";
                            break;
                        case 7:
                            $bg1 = "#FF9900";
                            break;
                    }
                    if ($user['state'] == 0) {
                        $bg1 = "#8b8484";
                    }
                    $state = '已开通';
                    if ($user['state'] == 0) {
                        $bg1 = "#8b8484";
                        $state = '未开通';
                    }
                    $user['name'] = '<span style="background-color: ' . $bg1 . ';">[' . $user['tjdept'] . '] [' . $user['name'] . '] [' . Common_Function::getRankName($user['rank']) . '] [' . $state . ']</span>';
                    $user['isParent'] = true;
                }
                unset($user);
                $users[] = array('id' => $this->qvalue, 'name' => '<a data-service="DUser.UserReg"  data-toggle="url" data-user_pid="' . $this->qvalue . '" style="line-height:31px;" >注册新会员</a>', 'isParent' => false);

                return $users;
            }

        }

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
        $result = Domain_Users::activateMember($this->user_id);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }

    }

    /**
     * 封停会员
     * @desc 封停会员
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function openMember()
    {
        $result = Domain_Users::openMember($this->user_id, $this->is_open);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }

    }

    /**
     * 设置会员提现
     * @desc 设置会员提现
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function cashMember()
    {
        $result = Domain_Users::cashMember($this->user_id, $this->can_cash);
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
     * 会员升级记录
     * @desc 会员升级记录
     */
    public function upgradeList()
    {
        $this->assign('tips', array('当前页面显示会员升级申请记录', '点击“同意”，该会员立即升级为申请等级'));
        $this->view('user/user_upgrade');
    }

    /**
     * 处理会员升级订单要求
     * @desc 处理会员升级订单要求
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function dealUpgrade()
    {
        //只有后台可以操作
        $result = Domain_Upgrade::dealUpgrade($this->id, $this->action);
        if (is_array($result)) {
            return $result;
        } else {
            throw new PhalApi_Exception_WrongException($result);
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

        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }

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
     * 修改会员等级页面和提交
     * @desc 修改会员等级页面和提交
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function editRank()
    {
        if ($this->action == 'post') {//修改
            $data = (array)$this;
            $data['newrank'] = $data['rank'];
            $data['uptype'] = 0;
            $result = Domain_Upgrade::addUpgrade($data, LOG_ADMIN);
            if (is_array($result)) {
                DI()->response->setMsg($result['msg']);
                return $result;
            } else {
                throw new PhalApi_Exception_WrongException($result);
            }
        } else {
            $user['id'] = $this->user_id;
            $user['rank'] = $this->rank;
            $this->assign('user', $user);
            $this->view('user/user_editrank');
        }

    }

    /**
     * 设置会员报单中心页面和提交
     * @desc 设置会员报单中心页面和提交
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return array|bool|string
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function editBdcenter()
    {
        if ($this->action == 'post') {//修改
            $data = (array)$this;
            $result = Domain_ApplyCenter::setBdCenter($data);
            if (is_array($result)) {
                DI()->response->setMsg($result['msg']);
                return $result;
            } else {
                throw new PhalApi_Exception_WrongException($result);
            }
        } else {
            $user['id'] = $this->user_id;
            $this->assign('user', $user);
            $this->view('user/user_setBdcenter');
        }

    }


    /**
     * 会员报单中心申请记录
     * @desc 会员报单中心申请记录
     */
    public function applyCenterList()
    {
        $this->assign('tips', array('当前页面显示会员报单中心申请记录', '点击“同意”，该会员立即升级为报单中心'));
        $this->view('user/user_apply_center');
    }

    /**
     * 处理会员报单中心申请订单要求
     * @desc 处理会员报单中心申请订单要求
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function dealApplyCenter()
    {
        //只有后台可以操作
        $result = Domain_ApplyCenter::dealApplyCenter($this->id, $this->action);
        if (is_array($result)) {
            return $result;
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }

    }


    /**
     * 会员报单中心申请记录
     * @desc 会员报单中心申请记录
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getApplyCenterList()
    {
        $where = array();

        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }

        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $result = Domain_ApplyCenter::getApplyCenterList($this->limit, $this->offset, $where);
        return $result;
    }


}