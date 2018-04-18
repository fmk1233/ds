<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/24
 * Time: 10:41
 */
class Api_Recharge extends Api_Common
{

    public function getRules()
    {
        return array(
            'doRecharge' => array(
                'money' => array('name' => 'amount', 'type' => 'float', 'require' => true, 'min' => 1, 'desc' => '充值金额'),
                'moneyType' => array('name' => 'moneyType', 'type' => 'int', 'require' => true, 'min' => 0, 'desc' => '充值类型'),
                'memo' => array('name' => 'memo', 'type' => 'string', 'desc' => '备注'),
            ),
            'getRechargeList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time'=>array('name'=>'s_time','type'=>'string','desc'=>'开始时间'),
                'e_time'=>array('name'=>'e_time','type'=>'string','desc'=>'结束时间'),
                'type'=>array('name'=>'type','type'=>'int','default'=>-1,'desc'=>'货币类型'),
            )
        );
    }


    /**
     * 会员充值列表
     * @desc 会员充值列表
     */
    public function rechargeList()
    {
        $this->view('bonus_recharge');
    }


    public function getRechargeList()
    {
        $where = array();
        $where['user_id'] = $this->data['user']['id'];
        if(!empty($this->s_time)){
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if(!empty($this->e_time)){
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        if($this->type>=0){
            $where['money_type=?'] = $this->type;
        }

        $result = Domain_Bonus::getRechargeList($this->limit, $this->offset,$where);
        return $result;
    }


    /**
     * 会员提交申请
     * @desc 会员提交申请
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function doRecharge()
    {

        $this->username = $this->data['user']['user_name'];
        $result = Domain_Bonus::addRecharge((array)$this,LOG_USERS);
        if(is_array($result)){
            DI()->response->setMsg($result['msg']);
        }else{
            throw new PhalApi_Exception_WrongException($result);
        }

    }

}