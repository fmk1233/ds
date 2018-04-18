<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 16:44
 */
class Api_DIndex extends Api_DCommon
{

    public function index()
    {

        $admin = Common_Function::admin();
        $this->assign('admin', $admin);
        $powers = DI()->config->get('power');
        $icons = DI()->config->get('menu.icon');
        $this->assign('menus', $powers[$admin['power_id']]['menu']);
        $this->assign('icons', $icons);
        $this->view('index.php');
    }

    public function index1()
    {
        $this->view('index1.php');
    }

    public function main()
    {
        //统计收入今年的收入占总收入百分比 begin
        $bdmoney = array();
        $user_model = new Model_Users();
        $where = array();
        $where['state'] = 1;
        $bdmoney['total'] = $user_model->getBdMoney($where);
        $day_time = DateHelper::getDayTime();
        $where['confirm_time>=?'] = $day_time['begin'];
        $where['confirm_time<=?'] = $day_time['end'];
        $bdmoney['today'] = $user_model->getBdMoney($where);
        $bdmoney['ratio'] = $bdmoney['total'] > 0 ? number_format($bdmoney['today'] / $bdmoney['total'] * 100, 2) : number_format(0, 2);
        $this->assign('bdmoney', $bdmoney);
        //统计收入今年的收入占总收入百分比 end


        //统计待审核会员和所有会员比 begin
        $where = array();
        $where['state'] = 0;
        $wait_user['wait'] = $user_model->getUsersCount($where);
        unset($where['state']);
        $wait_user['total'] = $user_model->getUsersCount($where);
        $wait_user['ratio'] = $wait_user['total'] > 0 ? number_format($wait_user['wait'] / $wait_user['total'] * 100, 2) : number_format(0, 2);
        $this->assign('wait_user', $wait_user);
        //end


        //统计今日新增激活会员和所有激活会员比 begin
        $where = array();
        $where['state'] = 1;
        $user['total'] = $user_model->getUsersCount($where);
        $where['confirm_time>=?'] = $day_time['begin'];
        $where['confirm_time<=?'] = $day_time['end'];
        $user['today'] = $user_model->getUsersCount($where);
        $user['ratio'] = $user['total'] > 0 ? number_format($user['today'] / $user['total'] * 100, 2) : number_format(0, 2);
        $this->assign('user', $user);
        //end

        //统计待审核提现订单和所有提现订单的比 begin
        $cash_model = new Model_Cash();
        $where = array();
        $cash['total'] = $cash_model->getCountByCondition($where);
        $where['payment_state'] = CHECK_SUBMIT;
        $cash['wait'] = $cash_model->getCountByCondition($where);
        $cash['ratio'] = $cash['total'] > 0 ? number_format($cash['wait'] / $cash['total'] * 100, 2) : number_format(0, 2);
        $this->assign('cash', $cash);
        //end

        //统计待审核留言信息和所有留言信息的比 begin
        $msg_model = new Model_Msg();
        $where = array();
        $msg['total'] = $msg_model->getCountByCondition($where);
        $where['is_reply'] = 0;
        $msg['wait'] = $msg_model->getCountByCondition($where);
        $msg['ratio'] = $msg['total'] > 0 ? number_format($msg['wait'] / $msg['total'] * 100, 2) : number_format(0, 2);
        $this->assign('msg', $msg);
        //end


        //统计今日和所有的奖金拨比率 begin
        $reward_model = new Model_Reward();
        $where = array();
        $reward_total = $reward_model->getRewardSum($where);
        $where['add_time>=?'] = $day_time['begin'];
        $where['add_time<=?'] = $day_time['end'];
        $reward_today = $reward_model->getRewardSum($where);
        $statistical['total']['shouru'] = $bdmoney['total'];
        $statistical['total']['zhichu'] = 0;
        $prices = Domain_Reward::rewardPrice();
        foreach ($prices as $price) {
            $statistical['total']['zhichu'] += $reward_total[$price];
        }
        $statistical['today']['shouru'] = $bdmoney['today'];
        $statistical['today']['zhichu'] = 0;
        foreach ($prices as $price) {
            $statistical['today']['zhichu'] += $reward_today[$price];
        }
        $this->assign('statistical', $statistical);
        //end

        //统计本周奖金折线图 begin
        $week_time = DateHelper::getCurrentWeekDayTime();
        $week_reward = array();
        foreach ($week_time as $time) {
            $where = array();
            $where['add_time>=?'] = $time;
            $where['add_time<=?'] = $time + 86400 - 1;
            $total = 0;
            $reward = $reward_model->getRewardSum($where);
            foreach ($prices as $price) {
                $total += $reward[$price];
            }
            $week_reward[] = $total;
        }
        $this->assign('week_reward', $week_reward);
        //end

        //进行会员统计begin
        $rank_names = Common_Function::getRankName();
        $user_statistic = array();
        $rows = array('#', '未审', '今日', '昨日', '本周', '本月', '全部');
        foreach ($rows as $key => $row) {
            $statistic = array();
            $statistic[] = $row;
            for ($i = 0; $i <= RANKNUM; $i++) {
                if ($key == 0) {
                    $statistic[] = $rank_names[$i];
                } else {
                    $where = array();
                    $where['state'] = $key == 1 ? 0 : 1;
                    $where['rank'] = $i;
                    switch ($key) {
                        case 2:
                            $times = DateHelper::getDayTime();
                            $where['confirm_time>=?'] = $times['begin'];
                            $where['confirm_time<=?'] = $times['end'];
                            break;
                        case 3:
                            $times = DateHelper::getDayTime(-1);
                            $where['confirm_time>=?'] = $times['begin'];
                            $where['confirm_time<=?'] = $times['end'];
                            break;
                        case 4:
                            $times = DateHelper::getWeekTime();
                            $where['confirm_time>=?'] = $times['begin'];
                            $where['confirm_time<=?'] = $times['end'];
                            break;
                        case 5:
                            $times = DateHelper::getMonthTime();
                            $where['confirm_time>=?'] = $times['begin'];
                            $where['confirm_time<=?'] = $times['end'];
                            break;
                    }
                    $statistic[] = $user_model->getUsersCount($where);
                }
            }
            $user_statistic[] = $statistic;
        }

        $this->assign('user_statistic', $user_statistic);
        //end


        //统计本周会员折线图 begin
        $week_user = array();
        foreach ($week_time as $time) {
            $where = array();
            $where['state'] = 1;
            $where['confirm_time>=?'] = $time;
            $where['confirm_time<=?'] = $time + 86400 - 1;
            $week_user[] = $user_model->getUsersCount($where);
        }
        $this->assign('week_user', $week_user);
        //end

        //报单额，拨出额，购物额，提现额，充值额统计 begin
        $recharge_model = new Model_Recharge();
        $shop_order_model = new Model_ShopOrders();
        $sys_statistic = array();
        $rows = array('#', '今日', '全部');

        foreach ($rows as $key => $row) {
            if ($key == 0) {
                $stat = array('#', '报单额', '拨出额', '利润', '提现额', '充值额', '购物额');
            } elseif ($key == 1) {//今日
                $stat = array();
                $stat[] = $row;
                $stat[] = $bdmoney['today'];
                $stat[] = $statistical['today']['zhichu'];
                $stat[] = $bdmoney['today'] - $statistical['today']['zhichu'];
                $where = array();
                $where['add_time<=?'] = $day_time['end'];
                $where['add_time>=?'] = $day_time['begin'];
                $where['payment_state<=?'] = CHECK_PASS;
                $stat[] = $cash_model->getCashMoneyTotal($where);
                unset($where['payment_state<=?']);
                $where['status'] = CHECK_PASS;
                $stat[] = $recharge_model->getRechargeMoneyTotal($where);
                unset($where['status']);
                $where['status>=?'] = ORDER_PAYED;
                $where['status<=?'] = ORDER_FINISHED;
                $stat[] = $shop_order_model->getOrderMoneyByCondition($where);

            } else {//全部
                $stat = array();
                $stat[] = $row;
                $stat[] = $bdmoney['total'];
                $stat[] = $statistical['total']['zhichu'];
                $stat[] = $bdmoney['total'] - $statistical['total']['zhichu'];
                $where = array();
                $where['payment_state<=?'] = CHECK_PASS;
                $stat[] = $cash_model->getCashMoneyTotal($where);
                unset($where['payment_state<=?']);
                $where['status'] = CHECK_PASS;
                $stat[] = $recharge_model->getRechargeMoneyTotal($where);
                unset($where['status']);
                $where['status>=?'] = ORDER_PAYED;
                $where['status<=?'] = ORDER_FINISHED;
                $stat[] = $shop_order_model->getOrderMoneyByCondition($where);
            }

            $sys_statistic[] = $stat;
        }
        $this->assign('sys_statistic', $sys_statistic);

        //end
        $this->view('main');
    }

}