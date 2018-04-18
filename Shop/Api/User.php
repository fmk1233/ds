<?php

/**
 * User: denn
 * Date: 2017/4/15
 * Time: 10:53
 */
class Api_User extends Api_Common
{

    public function getRules()
    {
        return array(
            'user' => array(
                'page' => array('name' => 'page', 'type' => 'int', 'default' => 1, 'desc' => '当前页码')
            ),
            'address' => array(
                'from' => array('name' => 'from', 'type' => 'int', 'default' => 0)
            ),
            'addressEdit' => array(
                'mobile' => array('name' => 'phone', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '手机号码',),
                'province' => array('name' => 'province', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '省'),
                'city' => array('name' => 'city', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '区'),
                'address' => array('name' => 'address', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '详细地址',),
                'realname' => array('name' => 'realname', 'type' => 'string', 'require' => true, 'default' => '', 'desc' => '联系人',),
                'id' => array('name' => 'addressid', 'type' => 'int', 'require' => true, 'default' => '', 'desc' => '收货地址ID',),

            ),
            'delAddress' => array(
                'address_id' => array('name' => 'addressid', 'type' => 'int', 'require' => true, 'desc' => '会员地址ID')
            ),
            'setDefault' => array(
                'address_id' => array('name' => 'addressid', 'type' => 'int', 'require' => true, 'desc' => '会员地址ID')
            ),

            'info' => array(),
            'changeInfo' => array(
                'weixin' => array('name' => 'weixin', 'type' => 'string', 'default' => '', 'desc' => '微信号'),
                'alipay' => array('name' => 'alipay', 'type' => 'string', 'default' => '', 'desc' => '支付宝'),
                'idcard' => array('name' => 'idcard', 'type' => 'string', 'default' => '', 'desc' => '身份证号'),
                'qq' => array('name' => 'qq', 'type' => 'string', 'default' => '', 'desc' => 'QQ'),
                'sex' => array('name' => 'sex', 'type' => 'int', 'min' => 1, 'max' => 2, 'default' => 1),
            ),
            'pwdEdit' => array(
                'action' => array('name' => 'action', 'type' => 'enum', 'range' => array('pwd', 'sec_pwd'), 'require' => true, 'desc' => '修改密码类型'),
                'old_pass' => array('name' => 'old_pass', 'type' => 'string', 'require' => true, 'desc' => '原密码'),
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '新密码'),
                'confirm_password' => array('name' => 'confirm_password', 'type' => 'string', 'require' => true, 'desc' => '新确认密码'),
            ),
            'funds' => array(
                'page' => array('name' => 'page', 'type' => 'int', 'default' => 1, 'desc' => '当前页码')
            )
        );

    }

    public function info()
    {
        $this->assign('index', 1);
        $this->view('user/user_info');
    }

    public function user()
    {
        $page = $this->page;
        $this->assign('page', $page);
        $where = array();
        $where['user_id'] = $this->data['user']['id'];
        $where['add_time>=?'] = NOW_TIME - 30 * 86400;
        $list = Domain_ShopOrders::getOrderList(PAGENUM, ($page - 1) * PAGENUM, $where, true);
        $this->assign('list', $list['rows']);
        $this->assign('total', $list['total']);
        $this->assign('url', array('service' => 'User.User'));

        $this->view('user/user');
    }

    public function funds()
    {
        $this->assign('index', 2);
        $page = $this->page;
        $this->assign('page', $page);
        $where = array();
        $where['u.id=?'] = $this->data['user']['id'];
        $where['b.money_type=?'] = BONUS_GW;
        $list = Domain_Bonus::getList(PAGENUM, ($page - 1) * PAGENUM, $where);
        $this->assign('list', $list['rows']);
        $this->assign('total', $list['total']);
        $this->assign('url', array('service' => 'Article.News'));
        $this->view('user/user_funds');
    }

    public function address()
    {
        $user = $this->data['user'];
        $address_list = Domain_Address::getAddressListByWhere(array('user_id' => $user['id']));
        $this->assign('address_list', $address_list);
        $this->assign('from', $this->from);
        $this->view('user/address');
    }

    public function setDefault()
    {
        $result = Domain_Address::setDefault($this->address_id, $this->data['user']['id']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return;
        }
        throw new PhalApi_Exception_WrongException($result);
    }

    public function addressEdit()
    {
        $data = (array)$this;
        $result = Domain_Address::addAddress($data, $this->data['user']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return $result;
        }
        throw new PhalApi_Exception_WrongException($result);
    }

    public function delAddress()
    {
        $result = Domain_Address::delAddress($this->address_id);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return;
        }
        throw new PhalApi_Exception_WrongException($result);
    }

    public function pwd()
    {
        $this->view('user/user_pwd');
    }

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

    public function changeInfo()
    {
        $data = (array)$this;
        $data['id'] = $data['data']['user']['id'];
        $result = Domain_Users::editMember($data, 5);
        if ($result) {
            DI()->response->setMsg(T('修改成功'));
            return '';
        }
        throw new PhalApi_Exception_WrongException(T('修改失败'));
    }

}