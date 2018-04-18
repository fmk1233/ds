<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/25
 * Time: 14:29
 */

/**
 * 会员奖金明细
 */
class Model_Reward extends PhalApi_Model_NotORM
{


    public function exportList($fields ,$where)
    {
        return $this->getORM()->select($fields)->where($where)->fetchAll();
    }

    public function getRewardList($limit, $offset, $where, $group = false)
    {
        if ($group === false) {
            return $this->getList($limit, $offset, $where);
        } else {
            $field = "id,periods,DATE_FORMAT(FROM_UNIXTIME(add_time),'{$group}') as days,user_name,true_name, sum(money) as money,group_concat(memo SEPARATOR '<br/>')  as memo";
            $prices = Domain_Reward::rewardPrice();
            foreach ($prices as $price) {
                $field .= ", sum({$price}) as {$price}";
            }
            $prices_fee = Domain_Reward::rewardFee();
            foreach ($prices_fee as $price) {
                $field .= ", sum({$price}) as {$price}";
            }
            $where = Common_Function::parseSearchWhere($where, true);
            $tabel_name = $this->getTableName(0);
            $total_sql = "select count(id)  from (select id,DATE_FORMAT(FROM_UNIXTIME(add_time),'{$group}') as days  from {$this->prefix}{$tabel_name} {$where['sql']}  group by user_id ,days ) c";
            foreach ($this->getORM()->query($total_sql, $where['params'])->fetch() as $fetch) {
                $result['total'] = $fetch;
            }
            $sql = "select {$field} from {$this->prefix}{$tabel_name} {$where['sql']}  GROUP  by user_id,days order by id desc limit ?,?";
            $params = $where['params'];
            $params[] = $offset;
            $params[] = $limit;
            $result['rows'] = $this->getORM()->queryAll($sql, $params);
            return $result;
        }

    }

    public function getMaxPeriods()
    {
        return intval($this->getORM()->max('periods'));
    }

    public function getRewardSum($condition = array())
    {
        $field = 'ifnull(sum(money),0) as money ';
        $prices = Domain_Reward::rewardPrice();
        foreach ($prices as $price) {
            $field .= ", ifnull(sum({$price}),0) as {$price}";
        }
        $prices_fee = Domain_Reward::rewardFee();
        foreach ($prices_fee as $price) {
            $field .= ", ifnull(sum({$price}),0) as {$price}";
        }
        return $this->getORM()->select($field)->where($condition)->fetchOne();
    }

    /**
     * 根据主键值返回对应的表名
     */
    protected function getTableName($id)
    {
        return 'user_reward';
    }
}