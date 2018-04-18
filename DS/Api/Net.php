<?php

/**
 * User: denn
 * Date: 2017/2/28
 * Time: 11:51
 */
class Api_Net extends Api_Common
{
    public function getRules()
    {
        return array(
            'net' => array(
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'desc' => '查询类型值'),
                'type' => array('name' => 'type', 'type' => 'int', 'min' => 1, 'max' => 2, 'desc' => '网络图类型'),
                'net_type' => array('name' => 'net_type', 'type' => 'enum', 'range' => array('net', 'tree'), 'desc' => '网络图类型'),
            ),
        );
    }


    /**
     * 会员的安置网络图
     * @desc 会员的安置网络图
     */
    public function pre()
    {
        $this->view('net_pre');
    }

    /**
     * 会员的推荐网络图
     * @desc 会员的推荐网络图
     */
    public function tj()
    {
        $this->view('net_tj');
    }

    /**
     * 获取会员的安置网络图
     * @desc 获取会员的安置网络图
     * @return string 返回安置网体图Html
     */
    public function net()
    {
        if ($this->net_type == 'net') {
            if (empty($this->qvalue)) {//判断查询操作值是否存在
                echo '查询会员不存在';
            } else {
                $user_model = new Model_Users();
                $where = array();
                $where[str_replace('member-', '', $this->qtype)] = $this->qvalue;
                $member = $user_model->getInfo($where);
                if ($member) {
                    $this->assign('member', $member);
                    $this->assign('type', 'user');
                    extract($this->data);
                    $user_id = Common_Function::user_id();
                    if ($this->type == 1) {//安置图
                        if ($member['id'] != $user_id) {
                            $ids = $user_model->getContactUsers($user_id, 'user_id');
                            $flag = false;
                            foreach ($ids as $id) {
                                if ($member['id'] == $id['user_id']) {
                                    $flag = true;
                                    break;
                                }
                            }
                            if ($flag == false) {
                                echo T('查询会员不在会员网体中');
                                die();
                            }
                        }
                        include(API_ROOT . '/Admin/View/user/user_pre_net_base.php');

                    } else {//推荐网络图
                        if ($member['id'] != $user_id) {
                            $ids = $user_model->getParentUsers($user_id, 'user_id');
                            $flag = false;
                            foreach ($ids as $id) {
                                if ($member['id'] == $id['user_id']) {
                                    $flag = true;
                                    break;
                                }
                            }
                            if ($flag == false) {
                                echo T('查询会员不在会员网体中');
                                die();
                            }
                        }
                        include(API_ROOT . '/Admin/View/user/user_tj_net_base.php');
                    }

                } else {
                    echo T('查询会员不存在');
                }

            }
        } else {
            $user_model = new Model_Users();
            $member = $this->data['user'];
            if ($this->qvalue == '0') {
                switch ($member['rank'] + 1) {
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
                if ($member['state'] == 0) {
                    $bg1 = "#8b8484";
                }
                $user = array();
                $user['id'] = $member['id'];
                $user['name'] = '<span style="background-color: ' . $bg1 . ';">[1] [' . $member['user_name'] . '] [' . Common_Function::getRankName($member['rank']) . '] </span>';
                $user['isParent'] = true;
                return $user;
            } else {
                if ($this->type == 1) {//安置图
                    if ($this->qtype) {
                        $users = $user_model->getListByWhere(array($this->qtype => $this->qvalue), 'id,user_name as name,pos,state,rank,gldept');
                        if (count($users) == 0) {
                            return array('id' => $this->qvalue, 'name' => '查询会员不存在', 'isParent' => false);
                        }
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
                        $user['name'] = '<span style="background-color: ' . $bg1 . ';">[' . ($user['gldept'] - $member['gldept'] + 1) . '] [' . $user['name'] . '] [' . Common_Function::getRankName($user['rank']) . '] [' . $state . ']</span>';
                        $user['isParent'] = true;
                    }
                    if (count($users) == 0) {
                        return array(array('id' => 0, 'name' => '<a style="line-height:31px;" data-service="User.UserReg"  data-pos="1" data-toggle="url" data-user_rid="' . $this->qvalue . '">注册新会员</a>', 'isParent' => false), array('id' => 0, 'name' => '<a data-service="User.UserReg"  data-pos="2" data-toggle="url" data-user_rid="' . $this->qvalue . '" style="line-height:31px;" >注册新会员</a>', 'isParent' => false));
                    } elseif (count($users) == 1 && $this->qvalue != 0) {
                        if ($users[0]['pos'] == 2) {
                            array_splice($users, 0, 0, array(array('id' => $this->qvalue, 'name' => '<a data-service="User.UserReg"  data-pos="1" data-toggle="url" data-user_rid="' . $this->qvalue . '" style="line-height:31px;" >注册新会员</a>', 'isParent' => false)));
                        } else {
                            $users[] = array('id' => $this->qvalue, 'name' => '<a data-service="User.UserReg"  data-pos="2" data-toggle="url" data-user_rid="' . $this->qvalue . '"  style="line-height:31px;" >注册新会员</a>', 'isParent' => false);
                        }
                    }
                    unset($user);
                    return $users;

                } else {
                    if ($this->qtype) {
                        $users = $user_model->getListByWhere(array($this->qtype => $this->qvalue), 'id,user_name as name,pos,state,rank,tjdept');
                        if (count($users) == 0) {
                            return array('id' => 0, 'name' => '查询会员不存在', 'isParent' => false);
                        }
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
                    $users[] = array('id' => $this->qvalue, 'name' => '<a data-service="User.UserReg"  data-toggle="url" data-user_pid="' . $this->qvalue . '" style="line-height:31px;" >注册新会员</a>', 'isParent' => false);

                    return $users;
                }
            }


        }

    }

}