<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/25
 * Time: 18:42
 */
class Domain_Users
{
    private $userIds = array();


    public static function getMain($user, $notice = false, $request_type = 'wap')
    {
        $result = array();
        $user_model = new Model_Users();
        $tj_num = $user_model->getParentCount(array('pid' => $user['id'], 'dept' => 1, 'state>=?' => 1));
        $total_num = $user_model->getParentCount(array('pid' => $user['id'], 'state>=?' => 1));
        $result['tj_num'] = $tj_num;
        $result['total_num'] = $total_num;
        $result['active_num'] = $user_model->getParentCount(array('pid' => $user['id'], 'state>=?' => 1));

        $cash_model = new Model_Cash();//提现金额
        $result['cash_money'] = $cash_model->getCashMoneyTotal(array('user_id' => $user['id'], 'payment_state' => 1));

        //奖金总数
        $reward_model = new Model_Reward();
        $reward_list = array();
        //昨天
        $day_begin = strtotime(date('Y-m-d', NOW_TIME));
        $where['user_id'] = $user['id'];
        $where['add_time>=?'] = $day_begin;
        $where['add_time<=?'] = $day_begin + 24 * 3600 - 1;
        $reward_list[] = $reward_model->getRewardSum($where);
        //昨天
        $where['add_time>=?'] = $day_begin - 24 * 3600;
        $where['add_time<=?'] = $day_begin - 1;
        $reward_list[] = $reward_model->getRewardSum($where);
        //全部
        unset($where['add_time>=?'], $where['add_time<=?']);
        $reward_list[] = $reward_model->getRewardSum($where);
        $result['reward_list'] = $reward_list;
        $reward_total = 0;
        $prices = Domain_Reward::rewardPrice();
        foreach ($prices as $price) {
            $reward_total += $reward_list[2][$price];
        }
        $result['reward_total'] = number_format($reward_total, 2);

        //统计本周奖金折线图 begin
        $week_time = DateHelper::getCurrentWeekDayTime();
        $week_reward = array();
        foreach ($week_time as $time) {
            $where = array();
            $where['user_id'] = $user['id'];
            $where['add_time>=?'] = $time;
            $where['add_time<=?'] = $time + 86400 - 1;
            $total = 0;
            $reward = $reward_model->getRewardSum($where);
            foreach ($prices as $price) {
                $total += $reward[$price];
            }
            $week_reward[] = $total;
        }
        $result['week_reward'] = $week_reward;
        //end
        //广告页
        $result['advs'] = Domain_Icon::iconList();
        //官方公告
        if ($notice) {
            $result['notices'] = Domain_News::notice();
        }

        switch ($request_type) {
            case 'wap':
                $result['rewardPrice'] = Domain_Reward::rewardPrice();
                $result['rewardFee'] = Domain_Reward::rewardFee();
                break;
        }

        return $result;
    }


    public static function getUserInfo($condition, $field = '*', $extend = array())
    {
        $user_model = new Model_Users();
        $user = $user_model->getInfo($condition, $field);
        if ($user) {
            if (isset($extend['tj'])) {//查询推荐人信息
                if ($user['pid'] > 0) {
                    $tj_user = $user_model->get(intval($user['pid']), 'user_name');
                    $user['t_user_name'] = $tj_user['user_name'];
                } else {
                    $user['t_user_name'] = T('无');
                }
            }
            if (POSNUM > 1) {//是否双轨以上制度
                if (isset($extend['pre'])) {//查询接点人信息
                    if ($user['rid'] > 0) {
                        $pre_user = $user_model->get(intval($user['rid']), 'user_name');
                        $user['p_user_name'] = $pre_user['user_name'];
                    } else {
                        $user['p_user_name'] = T('无');
                    }
                }
            }
            $user['pos_name'] = Common_Function::getPosName($user['pos']);
            $user['rank_name'] = Common_Function::getRankName($user['rank']);
        }
        return $user;
    }

    /**
     * 获取会员列表信息
     * @param $limit 每次查询记录数
     * @param $offset 查询开始位置
     * @param $where 查询条件
     * @param $extend 扩展字段，查询推荐人和接点人信息 $extend['tj'],$extend['pre']
     * @return array 返回结果数组
     */
    public static function getList($limit, $offset, $where, $extend = array(), $field = '*')
    {
        $user_model = new Model_Users();
        $result = $user_model->getList($limit, $offset, $where, 'id desc', $field);

        foreach ($result['rows'] as &$row) {
            unset($row['sec_pwd'], $row['pwd'], $row['salt'], $row['sec_salt']);
            if (count($extend) > 0) {
                if (isset($extend['tj'])) {//查询推荐人信息
                    if ($row['pid'] > 0) {
                        $tj_user = $user_model->get(intval($row['pid']), 'user_name');
                        $row['t_user_name'] = $tj_user['user_name'];
                    } else {
                        $row['t_user_name'] = T('无');
                    }
                }
                if (POSNUM > 1) {//是否双轨以上制度
                    if (isset($extend['pre'])) {//查询接点人信息
                        if ($row['rid'] > 0) {
                            $pre_user = $user_model->get(intval($row['rid']), 'user_name');
                            $row['p_user_name'] = $pre_user['user_name'];
                        } else {
                            $row['p_user_name'] = T('无');
                        }
                    }
                    $row['is_pre'] = true;
                } else {
                    $row['is_pre'] = false;
                }
                $row['pos_name'] = Common_Function::getPosName($row['pos']);
                $row['rank_name'] = Common_Function::getRankName($row['rank']);

            }
        }
        unset($row);

        return $result;
    }


    public static function getExpList($limit, $offset, $where, $extend = array())
    {
        $where = Common_Function::parseSearchWhere($where, false, false);
        $user_model = new Model_Users();
        $result['total'] = $user_model->getExpListCount($where);
        $result['rows'] = $user_model->getExpList($limit, $offset, $where);
        if (count($extend) > 0) {
            foreach ($result['rows'] as &$row) {
                unset($row['sec_pwd'], $row['pwd'], $row['salt'], $row['sec_salt']);
                if (isset($extend['tj'])) {//查询推荐人信息
                    if ($row['pid'] > 0) {
                        $tj_user = $user_model->get(intval($row['pid']), 'user_name');
                        $row['t_user_name'] = $tj_user['user_name'];
                    } else {
                        $row['t_user_name'] = T('无');
                    }
                }
                if (POSNUM > 1) {//是否双轨以上制度
                    if (isset($extend['pre'])) {//查询接点人信息
                        if ($row['rid'] > 0) {
                            $pre_user = $user_model->get(intval($row['rid']), 'user_name');
                            $row['p_user_name'] = $pre_user['user_name'];
                        } else {
                            $row['p_user_name'] = T('无');
                        }
                    }
                }
            }
            unset($row);
        }
        return $result;
    }


    /**
     * 会员登陆
     * @param $usre_name
     * @param $password
     * @param bool $check
     * @param int $login_type 登录方式，wap登录，返回生成的token值
     * @return bool|string
     */
    public static function login($usre_name, $password, $check = true, $login_type = 0)
    {

        $user_model = new Model_Users();
        $user = $user_model->getUserByUserName($usre_name, 'id,user_name,true_name,pwd,salt,state,login_ip,login_time,openid');
        if ($check) {
            if (!$user) {
                return T('用户不存在');
            } elseif ($user['pwd'] != md5(md5($password) . $user['salt'])) {
                return T('密码错误');
            }
            if ($user['state'] == 0) {
                return T('您未激活，请激活后登陆');
            } elseif ($user['state'] == 2) {
                return T('您已被冻结，请解冻后登陆');
            }

        }

       /* if ($user_model->isExpUser((int)$user['id'])) {
            #TODO 异常会员
            DI()->logger->error('该会员为异常会员' . $user['id']);
//            return T('该会员为异常会员');
        }*/
        $update_array = array();
        $update_array['login_time'] = NOW_TIME;
        $update_array['login_ip'] = Common_Function::getip();
        $update_array['last_ip'] = $user['login_ip'];
        $update_array['last_time'] = $user['login_time'];
        $update_array['login_num'] = new NotORM_Literal('login_num+1');
        $user_model->update(intval($user['id']), $update_array);
        unset($user['pwd'], $user['salt']);

        if ($login_type == 1) {
            $user_token_model = new Model_UserToken();
            $user_token_model->deleteByCondition(array('user_id' => intval($user['id'])));
            $insert_array = array();
            $insert_array['user_id'] = $user['id'];
            $insert_array['user_name'] = $user['user_name'];
            $insert_array['login_time'] = NOW_TIME;
            $insert_array['token'] = Common_Function::randomString('md5');
            $user_token_model->insert($insert_array);
            return array('token' => $insert_array['token'], 'user_id' => $user['id'],'openid'=>!empty($user['openid'])?true:false);
        } else {
            $users = array();
            $users['id'] = $user['id'];
            $users['user_name'] = $user['user_name'];
            $users['true_name'] = $user['true_name'];
            $users['token'] = md5(microtime(true));
            $_SESSION['token'] = $users['token'];
            $_SESSION[md5('@#mmusers!')] = Common_Function::encode(json_encode($users));
        }

        return true;
    }

    /**
     * 修改会员信息
     * @param array $user_data 注册会员数据
     * @param string $edit_type 修改类型 0：修改一级密码，1：修改二级密码，2：修改银行信息
     * @return array|string
     */
    public static function editMember($data, $edit_type = 0)
    {
        $user_model = new Model_Users();
        $update_data = array();
        switch ($edit_type) {
            case 0:
                $update_data['salt'] = Common_Function::randomString();
                $update_data['pwd'] = md5(md5($data['password']) . $update_data['salt']);
                $update_data['o_pwd'] = Common_Function::encode($data['password']);
                break;
            case 1:
                $update_data['sec_salt'] = Common_Function::randomString();
                $update_data['sec_pwd'] = md5(md5($data['password']) . $update_data['sec_salt']);
                $update_data['o_sec_pwd'] = Common_Function::encode($data['password']);
                break;
            case 2:
                $update_data['bank_name'] = $data['bank_name'];
                $update_data['bank_user'] = $data['bank_user'];
                $update_data['bank_no'] = $data['bank_no'];
                $update_data['bank_address'] = $data['bank_address'];
                break;
            case 3:
                $update_data['sex'] = $data['sex'];
                $update_data['province'] = $data['province'];
                $update_data['city'] = $data['city'];
                $update_data['area'] = $data['area'];
                break;
            case 4://后台修改会员信息
                $update_data['sex'] = $data['sex'];
                $update_data['state'] = $data['state'];
                $update_data['province'] = $data['province'];
                $update_data['city'] = $data['city'];
                $update_data['area'] = $data['area'];
                $update_data['mobile'] = $data['phone'];
                if (!empty($data['password'])) {
                    $update_data['salt'] = Common_Function::randomString();
                    $update_data['pwd'] = md5(md5($data['password']) . $update_data['salt']);
                }
                if (!empty($data['password2'])) {
                    $update_data['sec_salt'] = Common_Function::randomString();
                    $update_data['sec_pwd'] = md5(md5($data['password2']) . $update_data['sec_salt']);
                }
                Domain_Log::addLog('后台修改会员' . $data['id'] . '信息');
                break;
            case 5:
                $update_data['sex'] = $data['sex'];
                $update_data['weixin'] = $data['weixin'];
                $update_data['qq'] = $data['qq'];
                $update_data['alipay'] = $data['alipay'];
                $update_data['idcard'] = $data['idcard'];
                break;
        }
        $result = $user_model->update($data['id'], $update_data);
        return $result !== false;
    }

    /**
     * 注册会员
     * @param array $user_data 注册会员数据
     * @param string $reg_type 注册类型 admin 后台注册 user PC前台注册
     * @return array|string
     */
    public static function register($user_data, $reg_type = LOG_ADMIN)
    {

        if ($user_data['pwd'] != $user_data['re_pwd']) {
            return T('一级密码和一级确认密码不一致');
        }
        if ($user_data['sec_pwd'] != $user_data['re_sec_pwd']) {
            return T('安全密码和确认密码不一致');
        }

        $model_user = new Model_Users();

        $market_flag = false;

        if (!empty($user_data['market'])) {
            $market = $model_user->checkField('market', $user_data['market']);
            if ($market) {
                return T('该市场已存在');
            }
            $user_data['state'] = 1;
            $user_data['pid'] = 0;
            $user_data['rid'] = 0;
            $user_data['tjdept'] = 1;
            $user_data['market'] = $user_data['market'];
            $user_data['gldept'] = 1;
            $user_data['zmd_name'] = '';

            $market_flag = true;
        } else {
            $puser = $model_user->getInfo(array('user_name' => $user_data['pid']), 'id,tjdept,market,state');
            if (!$puser) {
                return T('推荐人不存在');
            } elseif ($puser['state'] == 0) {
                return T('推荐人未激活，不能推荐会员');
            }
            //判断推荐人是否为异常会员
           /* if ($model_user->isExpUser($user_data['pid'])) {
                #TODO 异常会员
                DI()->logger->error('该会员为异常会员' . $user_data['pid']);
//                return T('该推荐人为异常会员');
            }*/

            //检测报单中心是否存在
            /* if (CAN_BD) {
                 $bd_user = $model_user->getInfo(array('user_name' => $user_data['zmd_name']), 'id,bd_center');
                 if (!$bd_user) {
                     return T('报单中心填写错误');
                 }
             } else {
                 $user_data['zmd_name'] = '';
             }*/


            $user_data['state'] = 0;
            $user_data['tjdept'] = $puser['tjdept'] + 1;
            $user_data['market'] = $puser['market'];
            $user_data['pid'] = intval($puser['id']);

            if (POSNUM > 1) {
                if ($user_data['pos'] > POSNUM || $user_data['pos'] <= 0) {
                    return T('接点位置错误');
                }
                $ruser = $model_user->getInfo(array('user_name' => $user_data['rid']), 'id,gldept,market,pos,state');
                if (empty($ruser)) {
                    return T('接点人不存在');
                } else if ($puser['market'] != $ruser['market']) {//
                    return T('推荐人和接点人必须在同一市场中');
                } elseif ($ruser['state'] == 0) {
                    return T('接点人未激活，不能安置在旗下');
                }

                //判断推荐人是否为异常会员
              /*  if ($model_user->isExpUser($user_data['rid'])) {
                    #TODO 异常会员
                    DI()->logger->error('该会员为异常会员' . $user_data['rid']);
//                    return T('该接点人为异常会员');
                }*/
                $user_data['rid'] = intval($ruser['id']);
                $user_data['gldept'] = $ruser['gldept'] + 1;
                //判断接点人该区会员是否存在
                $user_data['pos'] = intval($user_data['pos']);
                $user = $model_user->getInfo(array('rid=? and pos=?' => array($user_data['rid'], $user_data['pos'])));
                if ($user) {
                    $posNames = Common_Function::getPosName();
                    return T('该接点人的{pos}已注册，请确认后在注册', array('pos' => $posNames[$user_data['pos']]));
                }

            } else {
                $user_data['rid'] = 0;
                $user_data['pos'] = 0;
                $user_data['gldept'] = 1;
            }

        }

        $data = array();
        $user_regs = Domain_System::getUserReg();
        $regs = DI()->config->get('user_reg.会员注册是否显示项');
        foreach ($regs as $key => $reg) {
            if (in_array($reg, $user_regs['power_2']) && empty($user_data[$reg])) {
                return T('请输入') . T($key);
            }
            if (isset($user_data[$reg])) {
                $data[$reg] = $user_data[$reg];
            }
        }
        if (isset($user_data['zmd_name']) && $user_data['zmd_name'] != '' && $user_data['market']) {
            $bd_user = $model_user->getInfo(array('user_name' => $user_data['zmd_name']), 'id,bd_center');
            if (!$bd_user) {
                return T('报单中心填写错误');
            }
        }
        if (isset($user_data['mobile']) && $user_data['mobile'] != '') {
            $mobile = $model_user->checkField('mobile', $user_data['mobile']);
            if ($mobile) {
                return T('该手机账号已注册，请重新输入');
            } elseif (!preg_match("/^1[34578]{1}\d{9}$/", $user_data['mobile'])) {
                return T('请输入正确的手机号');
            }

        }

        $username = $user_data['user_name'];
        if (empty($username)) {
            return T('请输入会员编号');
        }
        if (empty($user_data['true_name'])) {
            return T('请输入') . T('会员姓名');
        }
        $userName = $model_user->checkField('user_name', $username);
        if ($userName) {
            return T('该会员编号已存在，请重新输入');
        }


        DI()->notorm->beginTransaction(DB_DS);

        $salt = Common_Function::randomString();
        $sec_salt = Common_Function::randomString();


        $data['sex'] = isset($user_data['sex']) ? $user_data['sex'] : 1;
        $data['user_name'] = $username;
        $data['true_name'] = $user_data['true_name'];
        $data['pwd'] = md5(md5($user_data['pwd']) . $salt);
        $data['sec_pwd'] = md5(md5($user_data['sec_pwd']) . $sec_salt);
        $data['o_pwd'] = Common_Function::encode($user_data['pwd']);
        $data['o_sec_pwd'] = Common_Function::encode($user_data['sec_pwd']);
        $data['salt'] = $salt;
        $data['sec_salt'] = $sec_salt;
        $data['reg_ip'] = Common_Function::getip();
        $data['reg_time'] = NOW_TIME;

        $data['pid'] = $user_data['pid'];
        $data['rid'] = $user_data['rid'];
        $data['tjdept'] = $user_data['tjdept'];
        $data['market'] = $user_data['market'];
        $data['state'] = $user_data['state'];
        $data['pos'] = $user_data['pos'];
        $data['gldept'] = $user_data['gldept'];
        $data['rank'] = $user_data['rank'];
//        $data['bdmoney'] = Common_Function::getBdmoney($data['rank']);
        $data['bdmoney'] = 0;
        $data['pos_num'] = 0;
        $data['province'] = $user_data['province'];
        $data['city'] = $user_data['city'];
        $data['area'] = $user_data['area'];
        if ($reg_type == LOG_USERS) {
            $user = Common_Function::user();
            $data['reg_name'] = $user['user_name'];
            $data['reg_id'] = $user['id'];
        } else {
            $admin = Common_Function::admin();
            $data['reg_name'] = $admin['admin_name'];
        }
        if ($market_flag) {
            $data['confirm_time'] = NOW_TIME;
        }

        $insert_id = $model_user->insert($data);
        if ($insert_id) {
            $update_result = true;
            $insert_con = true;
            $insert_par = true;
            if (POSNUM > 1) {//是否是太阳线
                if ($data['rid'] > 0) {//是否存在接点人
                    $insert_con = $model_user->insertContactNet(intval($insert_id), $data['rid'], $data['pos']);
                }
            }

            if ($data['pid'] > 0) {//是否存在推荐人
                $insert_par = $model_user->insertParentNet(intval($insert_id), $data['pid']);
            }

            Domain_Log::addLog('注册会员' . $user_data['user_name'] . '->成功', $reg_type);

            if ($update_result && $insert_par && $insert_con) {//更新成功后才能提交
                DI()->notorm->commit(DB_DS);
                $url = '';
                if ($reg_type == LOG_ADMIN) {//判断是后台注册还是前台注册
                    $url = $market_flag ? Common_Function::url(array('service' => 'DUser.Users')) : Common_Function::url(array('service' => 'DUser.UnConfirmUsers'));;
                }
                return array('msg' => T('会员注册成功'), 'url' => $url, 'id' => $insert_id);
            }

            Domain_Log::addLog('注册会员' . $user_data['user_name'] . '->失败', $reg_type);

        }

        DI()->notorm->rollback(DB_DS);

        return T('注册失败');
    }

    /**
     * 激活会员
     * @param int $id 会员ID
     * @param string $reg_type 注册类型 admin 后台注册 user PC前台注册
     * @return array|string
     */
    public static function activateMember($id, $reg_type = LOG_ADMIN)
    {
        if ($reg_type == LOG_SYS || Common_Function::lock()) {

            $user_model = new Model_Users();
            //激活的会员信息
            $user = $user_model->get($id);

            $user['id'] = intval($user['id']);

            if (empty($user)) {
                return T('用户不存在');
            }

        /*    if ($user_model->isExpUser((int)$user['id'])) {
                #TODO 异常会员
                DI()->logger->error('该会员为异常会员' . $user['id']);
//                return T('该会员为异常会员');
            }*/

            if ($user['state'] != 0) {
                return T('会员已激活，请勿重复激活');
            }

//            $bdmoney = $user['bdmoney'];
            $bdmoney = 0;
            if (CAN_BD) {
                $zmd_user = $user_model->getInfo(array('user_name' => $user['zmd_name']), 'id,b0,b1,b2,b3,b4,b5');
            } else {
                $zmd_user = $user_model->getInfo(array((int)$user['reg_id']), 'id,b0,b1,b2,b3,b4,b5');
            }

            if ($reg_type == LOG_ADMIN || $reg_type == LOG_SYS) {
                $bdmoney = 0;
            } else {
                $reg_type = LOG_USERS;
            }
//            if ($bdmoney > 0) {
            if (LOG_USERS > 0) {
                //会员激活金额是否足够
//                if ($zmd_user[BONUS_NAME . BONUS_JHB] < $bdmoney) {
                if (0 < $bdmoney) {
                    return T('激活会员需要激活币{bdmoney}，您只有{only_money}', array('bdmoney' => $user['bdmoney'], 'only_money' => $zmd_user[BONUS_NAME . BONUS_JHB]));
                }
            }
            $memo = '激活会员' . $user['user_name'];
            try {

                DI()->notorm->beginTransaction(DB_DS);
//                if (LOG_USERS) {//添加钱包激活明细
//                    $change_bonus = Domain_Bonus::addCashHistory($zmd_user['id'], -$user['bdmoney'], BONUS_JHB, BONUS_TYPE_KJHB, $memo);
//                    if ($change_bonus === false) {
//                        throw new Exception('激活失败');
//                    }
//                }

                //修改会员状态
                $change_sate = $user_model->changeState($user['id'], USER_STATE_ACT);
                if ($change_sate === false) {
                    throw new Exception('激活失败');
                }

                //修改会员激活时间
                $update_data = array();
                $update_data['confirm_time'] = NOW_TIME;
                $update_res = $user_model->update($user['id'], $update_data);
                if ($update_res == false) {//修改会员数据失败
                    throw new Exception('激活失败');
                }

                //计算奖金
                new Domain_Reward('bd', $user, $user['bdmoney']);


                DI()->notorm->commit(DB_DS);

                Domain_Log::addLog($memo . '->成功', $reg_type);
                return array('msg' => '激活成功');
            } catch (Exception $e) {
                DI()->notorm->rollback(DB_DS);
                Domain_Log::addLog($memo . '->失败', $reg_type);
                return $e->getMessage();
            }
        } else {
            return T('当前有人正在激活会员，请稍后...');
        }


    }

    public static function openMember($id, $is_open)
    {
        $user_model = new Model_Users();
//        $update_data = array();
//        $update_data['is_open'] = $is_open;
        DI()->notorm->beginTransaction(DB_DS);
        $update_res = $user_model->changeState($id, $is_open);
        if ($update_res) {
            if ($is_open == 1) {
                $memo = "解封会员，ID[{$id}]";
            } elseif ($is_open == 2) {
                $memo = "封停会员，ID[{$id}]";
            }
            Domain_Log::addLog($memo, LOG_ADMIN);
            DI()->notorm->commit(DB_DS);
            return array('msg' => '操作成功');
        } else {
            DI()->notorm->rollback(DB_DS);
            throw new PhalApi_Exception_WrongException('操作失败');
        }
    }

    public static function cashMember($id, $can_cash)
    {
        $user_model = new Model_Users();
        $update_data = array();
        $update_data['can_cash'] = $can_cash;
        DI()->notorm->beginTransaction(DB_DS);
        $update_res = $user_model->update($id, $update_data);
        if ($update_res) {
            if ($can_cash == 1) {
                $memo = "允许会员提现，ID[{$id}]";
            } else {
                $memo = "禁止会员提现，ID[{$id}]";
            }
            Domain_Log::addLog($memo, LOG_ADMIN);
            DI()->notorm->commit(DB_DS);
            return array('msg' => '操作成功');
        } else {
            DI()->notorm->rollback(DB_DS);
            throw new PhalApi_Exception_WrongException('操作失败');
        }
    }

    /**
     * 删除会员
     * @param int $id 会员ID
     * @param string $reg_type 注册类型 admin 后台注册 user PC前台注册
     * @return array|string
     */
    public static function delMember($id, $reg_type = LOG_ADMIN)
    {
        $user_model = new Model_Users();
        $user = $user_model->get($id);
        $user['id'] = intval($user['id']);
        if (empty($user)) {
            return T('用户不存在');
        }

        //查看该会员是否存在下级会员
        $junior_num = $user_model->getUsersCount(array('pid' => $user['id']));
        if ($junior_num > 0) {
            return T('该会员存在下级会员不能删除');
        }

        if ($reg_type == LOG_ADMIN) {
            $reg_type = LOG_ADMIN;
        } else {
            $reg_type = LOG_USERS;
        }
        $memo = '删除会员' . $user['user_name'];
        try {
            //查看该会员是否存在下级会员
            $junior_num = $user_model->getUsersCount(array('pid' => $user['id']));
            if ($junior_num > 0) {
                return T('该会员存在下级会员不能删除');
            }
            if (POSNUM > 1) {//是否是双轨等制度
                //查看该会员是否存在下级会员
                $junior_num = $user_model->getUsersCount(array('rid' => $user['id']));
                if ($junior_num > 0) {
                    return T('该会员存在下级会员不能删除');
                }
            }
            DI()->notorm->beginTransaction(DB_DS);

            //还需要删除的信息
            $address_model = new Model_UserAddress();
            $address_res = $address_model->deleteByCondition(array('user_id' => (int)$user['id']));
            if ($address_res === false) {
                throw new Exception('删除会员地址错误');
            }

            $del_user_res = $user_model->delMember((int)$user['id']);
            if ($del_user_res === false) {
                throw new Exception('删除会员错误');
            }
            DI()->notorm->commit(DB_DS);
            Domain_Log::addLog($memo . '->成功', $reg_type);
            return array('msg' => T('删除成功'));
        } catch (Exception $e) {
            DI()->notorm->rollback(DB_DS);
            Domain_Log::addLog($memo . '->失败', $reg_type);
            return $e->getMessage();
        }


    }


    public static function generalUserName()
    {
        $sn = true;
        $user_model = new Model_Users();
        $user_reg_setting = Domain_System::getUserReg();
        while ($sn) {
            $user_name = $user_reg_setting['begin'] . Common_Function::randomString('numeric', $user_reg_setting['length']);
            $user = $user_model->getInfo(array('user_name' => $user_name), 'id');
            if (empty($user)) {
                $sn = false;
            }
        }
        return $user_name;

    }


    public static function batchReg($reg_num = 0, $user_name = '')
    {
        global $begin_time;
        $i = 0;
        $begin_time = microtime(true);
        $num = 0;
        set_time_limit(0);
        $user_model = new Model_Users();
        $count = $user_model->getUsersCount();
        while (true) {
            if ($i >= $reg_num) {
                break;
            }
            //批量注册
            $data = array();
            $data['pwd'] = $data['re_pwd'] = $data['sec_pwd'] = $data['re_sec_pwd'] = '123456';
            $data['user_name'] = Domain_Users::generalUserName();
            $data['true_name'] = $data['user_name'];
            $data['sex'] = 1;
            $data['province'] = $data['city'] = $data['area'] = 0;

            if ($count == 0) {
                $data['market'] = 1;
            }

            $data['rank'] = rand(0, RANKNUM);
            if ($count > 0) {
                if (POSNUM > 1) {//
                    //查找接点人
                    $p_user = $user_model->getContactAutoUser();
                    if (!$p_user) {
                        throw new PhalApi_Exception_WrongException('接点人不存在');
                        break;
                    }
                    $data['pos'] = $p_user['pos_num'] + 1;
                    $data['rid'] = $p_user['user_name'];
                    $data['pid'] = $p_user['user_name'];
                }

                if (!empty($user_name)) {
                    $data['pid'] = $user_name;
                }
            }

            $result = Domain_Users::register($data);
            if (!is_array($result)) {
                throw new PhalApi_Exception_WrongException($result);
                break;
            }

            //激活
            $result = Domain_Users::activateMember($result['id'], LOG_SYS);
            if (!is_array($result)) {
                throw new PhalApi_Exception_WrongException($result);
                break;
            }
            if ($count == 0) {
                $count = 1;
            }
            $i++;
            $num++;
        }
        echo '注册成功',$num,'人，注册时间：', microtime(true) - $begin_time;
    }
}