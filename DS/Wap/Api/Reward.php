<?php

/**
 * User: denn
 * Date: 2017/3/15
 * Time: 20:28
 */
class Api_Reward extends Api_Common
{

    public function getRules()
    {
        return array(
            'getRewardList'=>array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
        );
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
        $result = Domain_Reward::getList($this->limit, $this->offset, $where);
        $result['rewardPrice'] = Domain_Reward::rewardPrice();
        $result['rewardFee'] = Domain_Reward::rewardFee();
        return $result;
    }
}