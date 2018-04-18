<?php

/**
 * User: denn
 * Date: 2017/3/1
 * Time: 21:51
 */
class Api_Reward extends Api_DCommon
{
    public function getRules()
    {
        return array(
            'getRewardList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                'search_type' => array('name' => 'search_type', 'type' => 'int' ,'default'=>0, 'desc'=> '为1时是查询会员某时间段奖金信息'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
                'group' => array('name'=>'group','type'=>'enum','range'=>array('day','week','','month'),'desc'=>'统计查询')
            ),
            'getRewardTotalList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
            ),
            'rewardDetail'=>array(
                'days'=>array('name'=>'days','type'=>'string','require'=>true,'desc'=>'时间'),
                'group' => array('name'=>'group','type'=>'enum','range'=>array('day','week','month'),'desc'=>'统计查询'),
                'username' => array('name'=>'username','type'=>'string','desc'=>'会员编号')
            )
        );
    }

    /**
     * 奖金明细
     * @desc 奖金明细
     */
    public function rewardList()
    {
        $this->assign('tips', array('当前页面显示会员相应奖金的收支明细','选择“周”视图时，年份后面的数字为当年第几周'));
        $this->view('reward_list');
    }

    public function rewardDetail()
    {
        switch ($this->group){
            case 'day':
                $s_time = $this->days;
                $e_time = date('Y-m-d',strtotime($s_time)+3600*24);
                break;
            case 'week':
                $week = explode('-',$this->days);
                $now_w = date('W',NOW_TIME);
                $now_y = date('Y',NOW_TIME);
                $y_intval = $now_y - $week[0];
                $w_intval = $now_w - $week[1];
                $time = DateHelper::getWeekTime(-$w_intval);
                $begin_time = strtotime(date('Y-m-d',$time['begin']).' - '.$y_intval.' year');
                $s_time = date('Y-m-d',$begin_time);
                $e_time = date('Y-m-d',$begin_time + 7*86400);
                break;
            case 'month':
                $s_time = $this->days.'-01';
                $e_time = date('Y-m-d',strtotime($s_time.' + 1 month'));
                break;
        }

        $this->assign('s_time',$s_time);
        $this->assign('e_time',$e_time);
        $this->assign('username', $this->username);
        $this->assign('tips', array('当前页面显示会员相应奖金的收支明细'));
        $this->view('reward_detail');
    }

    public function rewardRatio()
    {
        $reward_model = new Model_Reward();
        $user_model = new Model_Users();

        $total = array();
        $bdmoney = $user_model->getBdMoney();
        $total['报单额累计'] = $bdmoney;

        $reward = $reward_model->getRewardSum();
        $prices = Domain_Reward::rewardPrice();
        $total_ze = 0;
        foreach ($prices as $key => $price) {
            $total[$key] = $reward[$price];
            $total_ze += $reward[$price];
        }
        $total['奖金发放'] =$total_ze;
        $total['奖金拨出率'] =($bdmoney<=0?number_format(0,2):number_format($total_ze/$bdmoney*100,2)).'%';
        $this->assign('tips', array('当前页面显示系统的收入拨出情统计'));
        $this->assign('reward', $total);
        $this->view('reward_ratio');
    }

    /**
     * 获取奖金明细列表数据
     * @desc 获取奖金明细列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getRewardList()
    {
        $where = array();
        if (!empty($this->qvalue) and $this->search_type!=1) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }
        if (!empty($this->qvalue) and $this->search_type==1) {//相关搜索的数据
            $where[$this->qtype.'=?'] = $this->qvalue;
        }

        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }

        $list = Domain_Reward::getList($this->limit, $this->offset, $where,$this->group);
        return $list;
    }

    /**
     * 会员奖金汇总
     * @desc 会员奖金汇总
     */
    public function rewardTotal()
    {
        $this->assign('tips', array('当前页面显示会员相应奖金的统计情况'));
        $this->view('reward_total');
    }


    /**
     * 获取奖金明细列表数据
     * @desc 获取奖金明细列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getRewardTotalList()
    {
        $where = array();
        $condtion = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }

        if (!empty($this->s_time)) {
            $condtion['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $condtion['add_time<=?'] = strtotime($this->e_time);
        }

        $reward_model = new Model_Reward();
        $cash_model = new Model_Cash();
        $recharge_model = new Model_Recharge();
        $list = Domain_Users::getList($this->limit, $this->offset, $where, array(), 'b0,b1,b2,b3,b4,b5,id,user_name,true_name');
        foreach ($list['rows'] as &$item) {
            $condtion['user_id'] = intval($item['id']);
            $reward_list = $reward_model->getRewardSum($condtion);
            $item = array_merge($item, $reward_list);
            $condtion['payment_state<=?'] = 1;
            $item['cash_money'] = $cash_model->getCashMoneyTotal($condtion);
            unset($condtion['payment_state<=?']);
            $condtion['status'] = 1;
            $item['recharge_money'] = $recharge_model->getRechargeMoneyTotal($condtion);
            unset($condtion['status']);
        }
        unset($item);
        return $list;
    }

}