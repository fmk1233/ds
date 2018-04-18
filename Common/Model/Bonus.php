<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 8:40
 */
class Model_Bonus extends PhalApi_Model_NotORM
{


    /**
     * @param $uid 会员ID
     * @param $money 金额
     * @param $type 收益明细类型
     * @param $moneyType 货币类型
     * @param $meno 备注
     * @param int $frezzeState 是否冻结
     * @param int $oid 订单ID
     * @return long|string
     */
    public function addCashHistory($uid, $money, $bonus_type, $money_type, $meno, $frezze_state = 0, $oid = 0, $from_id = 0, $rate = 0, $dai = 0)
    {

        $data = array();
        $data['user_id'] = $uid;
        $data['money'] = $money;
        $data['bonus_type'] = $bonus_type;
        $data['money_type'] = $money_type;
        $data['memo'] = $meno;
        $data['frezze_state'] = $frezze_state;
        $data['order_id'] = $oid;
        $data['from_id'] = $from_id;
        $data['dai'] = $dai;
        $data['rate'] = $rate;
        $data['is_out'] = 0;
        if ($money < 0) {//钱包支出
            $data['is_out'] = 1;
        }
        $data['add_time'] = NOW_TIME;

        return $this->insert($data);

    }

    public function getRechargeListCount()
    {
        $type = implode(',', array(BONUS_TYPE_STC_CZ, BONUS_TYPE_DNC_CZ, BONUS_TYPE_PDB_CZ, BONUS_TYPE_JHB_CZ));
        $sql = "select count(*) as count from {$this->prefix}bonus where type in ({$type}) ";
        $params = array();
        foreach ($this->getORM()->query($sql, $params)->fetch() as $return) {
            return $return;
        }
    }

    public function getRechargeList($limit = 20, $offset = 0, $field = '*')
    {
        $type = implode(',', array(BONUS_TYPE_STC_CZ, BONUS_TYPE_DNC_CZ, BONUS_TYPE_PDB_CZ, BONUS_TYPE_JHB_CZ, BONUS_TYPE_GW_CZ));
        $sql = "select {$field} from {$this->prefix}bonus where type in ({$type}) order by id desc limit :start ,:limit ";
        $params[':limit'] = $limit;
        $params[':start'] = $offset;
        return $this->getORM()->queryAll($sql, $params);
    }

    public function getListByMoneyTypeAndUidCount($userId, $moneyType)
    {
        return $this->getORM()->where(
            'uid=? and money_type=?', $userId, $moneyType
        )->count();
    }

    public function getListByMoneyTypeAndUid($userId, $moneyType, $limit = 20, $offset = 0, $field = '*')
    {
        return $this->getORM()->select($field)->where('uid=? and money_type=?', $userId, $moneyType)->limit($offset, $limit)->order('id desc')->fetchRows();
    }


    public function getBonusListByUidCount($uid)
    {
        $where['uid=?'] = $uid;
        $where['type'] = array(BONUS_TYPE_STC_CX, BONUS_TYPE_STC_RW, BONUS_TYPE_DNC_RW, BONUS_TYPE_PDB_RW);
        return $this->getORM()->where($where)->count();
    }

    public function getBonusListByUid($uid, $limit = 20, $offset = 0)
    {
        $where['uid=?'] = $uid;
        $where['type'] = array(BONUS_TYPE_STC_CX, BONUS_TYPE_STC_RW, BONUS_TYPE_DNC_RW);
        return $this->getORM()->where($where)->limit($offset, $limit)->fetchRows();
    }


    public function getFrezzeMoenyByUid($uid)
    {
        $lasttime1 = NOW_TIME - DI()->config->get('setting.b23') * 3600 * 24;
        return $this->getORM()->select('id,uid,money,money_type')->where('uid=? and addtime<?  and frezze_state=1 ', $uid, $lasttime1)->limit(1000)->fetchRows();
    }

    public function updateFrezzeState($bid)
    {
        return $this->getORM()->where('id=?  and frezze_state=1 ', $bid)->update(array('frezze_state' => 0));
    }

    /**
     * 查询财务明细的总条数
     * @param $where 查询条件
     * @return mixed 总数
     */
    public function getBonusListCount($where)
    {
        $sql = "select count(b.id) from {$this->prefix}bonus as b left join {$this->prefix}user as u on b.user_id=u.id {$where['sql']} ";
        foreach ($this->getORM()->query($sql, $where['params'])->fetch() as $return) {
            return intval($return);
        }
    }

    /**
     * 查询财务明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public function getBonusList($limit = 20, $offset = 0, $where)
    {

        $sql = "select b.*,u.user_name from {$this->prefix}bonus as b left join {$this->prefix}user as u on b.user_id=u.id {$where['sql']}  order by b.id desc limit ?,? ";

        $params = $where['params'];
        $params[] = $offset;
        $params[] = $limit;

        return $this->getORM()->queryRows($sql, $params);
    }

    public function getBonusListByFromId($limit = 20, $offset = 0, $where)
    {
        $wheresql = $this->parseSearchWhere($where);
        $params = array();
        $wherekey = '';
        if (count($wheresql)) {
            $params = reset($wheresql);
            $wherekey = 'where ' . key($wheresql);
        }

        $sql = "select b.*,u.user_name from {$this->prefix}bonus as b left join {$this->prefix}user as u on u.id=b.from_id {$wherekey}  order by b.id desc limit ?,? ";

        $params[] = $offset;
        $params[] = $limit;
        return $this->getORM()->queryRows($sql, $params);
    }

    public function getTotalMoney($condition)
    {
        return floatval($money = $this->getORM()->where($condition)->sum('money'));
    }


    protected function getTableName($id)
    {
        return 'bonus';
    }

}