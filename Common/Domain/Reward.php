<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/20
 * Time: 8:46
 */
class Domain_Reward
{
    private $setting;


    /**
     * @param $type 结算类型
     * @param array $user 结算用户
     * @param int $value 金额
     */
    public function __construct($type, $user = array(), $value = 0)
    {
        $this->setting = DI()->config->get('setting');
        $reward_model = new Model_Reward();
        $periods = $reward_model->getMaxPeriods() + 1;
        switch ($type) {
            case 'bd':
                $this->jsRecord($user, $value, $periods);
                break;
        }
    }


    /**
     * 结算奖金
     */
    private function jsRecord($user, $value, $periods)
    {
        $this->straightPushPrize($user, $value, $periods);
//        $this->reportPrize($user, $value, $periods);
//        $this->touch($user, $periods);
    }


    /**
     * 直推奖
     * @param object $user 激活会员信息
     * @param float $bdmoney 报单金额
     */
    private function straightPushPrize($user, $bdmoney = 0, $periods)
    {
        $param = 'ztj';
        if (!isset($this->setting['open'][$param])) {
            return;
        }
        if ($user['pid'] <= 0 || $bdmoney <= 0) {
            return;
        }
        $user_model = new Model_Users();
        $parent_user = $user_model->get((int)$user['pid'], 'rank,user_name,id,true_name');

        if ($parent_user) {//上级存在
            //计算奖金
            $base_rate = $this->setting[$param][$parent_user['rank']] / 100;
            $money_out = $bdmoney * $base_rate;
            if ($money_out > 0) {
                //添加奖金明细列表
                $memo = '奖金来源：' . $user['user_name'] . '激活，结算情况：' . $bdmoney . ' x ' . $base_rate;
                $result = $this->jsrec($parent_user, $param, $money_out, $periods, $memo);
                if ($result == false) {
                    throw new Exception('直推奖结算失败');
                }
            }
        }

    }


    private function jiandian($user, $bdmoney = 0, $periods)
    {
        $param = 'jdj';//未做处理重新写
        $user_model = new Model_Users();
        $parent_user = $user_model->getContactUsers(array('user_id' => $user['id']));
        if ($parent_user) {//上级存在
            //计算奖金
            $base_rate = $this->setting[$param][$parent_user['rank']];
            $money_out = $base_rate;
            if ($money_out > 0) {
                //添加奖金明细列表
                $memo = '奖金来源：' . $user['user_name'] . '激活，结算情况：' . $bdmoney . ' x ' . $base_rate;
                $result = $this->jsrec($parent_user, $param, $money_out, $periods, $memo);
                if ($result == false) {
                    throw new Exception('直推奖结算失败');
                }
            }
        }

    }

    /**
     * 报单奖
     * @param object $user 激活会员信息
     * @param float $bdmoney 报单金额
     */
    private function reportPrize($user, $bdmoney = 0, $periods)
    {
        $param = 'bdj';
        if (!isset($this->setting['open'][$param])) {
            return;
        }
        if (empty($user['zmd_name']) || $bdmoney <= 0) {
            return;
        }
        $user_model = new Model_Users();
        $zmd_user = $user_model->getInfo(array('user_name' => $user['zmd_name']), 'rank,user_name,id,true_name');
        if ($zmd_user) {//报单中心
            //计算奖金
            $base_rate = $this->setting[$param][$zmd_user['rank']] / 100;
            $money_out = $bdmoney * $base_rate;
            if ($money_out > 0) {
                //添加奖金明细列表
                $memo = '奖金来源：' . $user['user_name'] . '激活，结算情况：' . $bdmoney . ' x ' . $base_rate;
                $result = $this->jsrec($zmd_user, 'ldj', $money_out, $periods, $memo);
                if ($result == false) {
                    throw new Exception('报单中心奖结算失败');
                }
            }
        }

    }

    /**
     * 对碰奖
     * @param object $user 激活会员信息
     */
    private function touch($user, $periods)
    {
        $rates = $this->setting['dpj'];//对碰奖比例
        $cengs = $this->setting['dpj_cs'];//对碰奖层数
        $fds = $this->setting['dpj_rfd'];
        if (!isset($this->setting['open']['dpj'])) {
            return;
        }
        //取得所有上级
        $user_model = new Model_Users();

        $seniors = $user_model->getContactUsers(array('user_id' => $user['id']), 'pid,user_id,pos,dept');
        foreach ($seniors as $senior) {//判断各层是否产生对碰
            //找寻可以对碰的兄弟节点
            $brother = $user_model->getBrotherUser($senior);
            if ($brother) {//存在对碰兄弟节点，产生对碰奖
                $dept = $senior['dept'];
                $senior = $user_model->get(intval($senior['pid']), 'rank,user_name,id,true_name,rfd');
                //判断对应的深度
                if ($cengs[$senior['rank']] < 0 || $cengs[$senior['rank']] >= $dept) {//判断对碰奖拿几层，-1为拿无限层
                    $brother = $user_model->get(intval($brother['user_id']), 'rank,user_name,id,true_name,bdmoney');
                    $base_money = min($brother['bdmoney'], $user['bdmoney']);//奖金基数
                    $base_rate = $rates[$senior['rank']] / 100;
                    //日封顶金额
                    $money_out = $base_money * $base_rate;
                    $fd_money = $fds[$senior['rank']];
                    $memo = '奖金来源：' . $user['user_name'] . '和会员' . $brother['user_name'] . '产生对碰，结算情况：' . $base_money . ' x ' . $base_rate;
                    if ($senior['rfd'] + $money_out > $fd_money) {//存在日封顶
                        $memo .= '，达到封顶，减少金额为' . ($money_out - $fd_money + $senior['rfd']);
                        $money_out = $fd_money - $senior['rfd'];
                    }
                    if ($money_out > 0) {//对碰奖有奖
                        $result = $this->jsrec($senior, 'dpj', $money_out, $periods, $memo);
                        if ($result == false) {
                            throw new Exception('结算失败');
                        }
                        $this->touchManage($senior, $money_out, $periods);

                        //更新会员日封顶信息
                        $update_info = array();
                        $update_info['rfd'] = new NotORM_Literal('rfd+' . $money_out);
                        $result = $user_model->update(intval($senior['id']), $update_info);
                        if ($result === false) {
                            throw new Exception('结算失败');
                        }
                    }

                }

                //更新自己和兄弟的p_status属性
                $where = array();
                $where['user_id'] = array(intval($user['id']), intval($brother['id']));
                $where['p_status'] = 0;
                $where['pid'] = (int)$senior['id'];
                $result = $user_model->updateContact($where, array('p_status' => 1));
                if ($result === false) {
                    throw new Exception('对碰奖结算失败');
                }
            }
        }
    }


    /**
     * 对碰管理奖--以对碰奖为基数
     * @param object $user 激活会员信息
     */
    private function touchManage($user, $money, $periods)
    {
        $rates = $this->setting['dpglj'];//对碰奖比例
        if (!isset($this->setting['open']['dpglj'])) {
            return;
        }
        $max_dept = 0;
        foreach ($rates as &$rate) {
            $rate = explode('|', $rate);
            $max_dept = $max_dept > count($rate) ? $max_dept : count($rate);
        }
        unset($rate);
        //取得所有上级
        $user_model = new Model_Users();
        $seniors = $user_model->getParentUsers(array('user_id' => (int)$user['id'], 'dept<=?' => $max_dept), 'pid,user_id,dept');
        foreach ($seniors as $senior) {//判断各层是否产生对碰
            $dept = $senior['dept'];
            $senior = $user_model->get(intval($senior['pid']), 'rank,user_name,id,true_name');
            if ($dept <= count($rates[$senior['rank']])) {//是否达到对应的代数
                $base_money = $money;
                $base_rate = $rates[$senior['rank']][$dept - 1] / 100;
                $money_out = $base_money * $base_rate;
                $memo = '奖金来源：' . $user['user_name'] . '产生对碰奖触发对碰管理奖，结算情况：' . $money . ' x ' . $base_rate;
                if ($money_out > 0) {//对碰管理奖有奖
                    $result = $this->jsrec($senior, 'glj', $money_out, $periods, $memo);
                    if ($result == false) {
                        throw new Exception('对碰管理奖结算失败');
                    }
                }
            }
        }
    }

    /**
     * 结算明细表
     * @param $user 用户信息
     * @param $awardName 奖金名称
     * @param $bonus 奖金
     * @param $periods 期数
     * @param $frezze 是否冻结奖金
     */
    private function jsrec($user, $awardName, $bonus, $periods, $memo, $frezze = BONUS_UNFREZZE)
    {
        $fees = Domain_Reward::rewardFee();
        $bonus = round($bonus, 2);
        //添加奖金明细
        $reward_model = new Model_Reward();
//        $reward = $reward_model->getInfo(array('periods' => $periods, 'user_id' => intval($user['id'])), 'id');
//        $fee = round($bonus * $this->setting[$fees['扣税']] / 100, 2);
//        $repeat = round(($bonus - $fee) * $this->setting[$fees['重复消费']] / 100, 2);
//        $repeat = round($bonus * $this->setting[$fees['重复消费']] / 100, 2);
        $money = $bonus;


        $insert_info = array();
        $insert_info[$awardName] = $bonus;
//        $insert_info[$fees['扣税']] = $fee;
//        $insert_info[$fees['重复消费']] = $repeat;
        $insert_info['money'] = $money;
        $insert_info['add_time'] = NOW_TIME;
        $insert_info['periods'] = $periods;
        $insert_info['user_id'] = $user['id'];
        $insert_info['user_name'] = $user['user_name'];
        $insert_info['true_name'] = $user['true_name'];
        $insert_info['memo'] = $memo;
        $insert_id = $reward_model->insert($insert_info);
        if ($insert_id == false) {
            return false;
        }

        //修改余额
        $result = Domain_Bonus::addCashHistory($user['id'], $money, BONUS_STC, BONUS_TYPE_STC_RW, $memo, $frezze);
        if ($result == false) {
            return false;
        }

//        if ($repeat > 0) {
//            //修改购物币
//            $result = Domain_Bonus::addCashHistory($user['id'], $repeat, BONUS_GW, BONUS_TYPE_GW_RW, $memo, $frezze);
//            if ($result == false) {
//                return false;
//            }
//
//        }

        return true;

    }

    /**
     * 查询会员奖金明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public static function getList($limit, $offset, $where, $group = '')
    {
        $reward_model = new Model_Reward();
        switch ($group) {
            case 'day':
                $group = '%Y-%m-%d';
                break;
            case 'week':
                $group = '%Y-%u';
                break;
            case 'month':
                $group = '%Y-%m';
                break;
            default:
                $group = false;
                break;
        }
        $lists = $reward_model->getRewardList($limit, $offset, $where, $group);
        return $lists;
    }


    public static function rewardPrice()
    {
        return array(
            '日分红' => 'jdj',
            '直推奖' => 'ztj',
            '智能链接算力奖' => 'dpj',
//            '对碰管理奖' => 'glj',
//            '报单奖' => 'ldj',
        );
    }

    public static function rewardFee()
    {
        return array(
            '重复消费' => 'repeat_account',
            '扣税' => 'fee',
        );
    }

}