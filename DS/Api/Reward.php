<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/25
 * Time: 14:28
 */
class Api_Reward extends Api_Common
{

    public function getRules()
    {
        return array(
            'getRewardList'=>array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                'search_type' => array('name' => 'search_type', 'type' => 'int' ,'default'=>0, 'desc'=> '为1时是查询会员某时间段奖金信息'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
                'group' => array('name'=>'group','type'=>'enum','range'=>array('day','week','','month'),'desc'=>'统计查询')
            ),
            'rewardDetail'=>array(
                'days'=>array('name'=>'days','type'=>'string','require'=>true,'desc'=>'时间'),
                'group' => array('name'=>'group','type'=>'enum','range'=>array('day','week','month'),'desc'=>'统计查询'),
                'username' => array('name'=>'username','type'=>'string','desc'=>'会员编号')
            )
        );
    }

    /**
     * 会员奖金列表
     * @desc 会员奖金列表
     */
    public function rewardList()
    {
        $this->view('reward_list');

    }

    /**
     * 获取会员奖金列表数据
     * @desc 获取会员奖金列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getRewardList()
    {
        $where = array();
        $where['user_id=?'] = $this->data['user']['id'];
        if (!empty($this->qvalue) and $this->search_type!=1) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $result = Domain_Reward::getList($this->limit, $this->offset, $where,$this->group);
        return $result;
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

}