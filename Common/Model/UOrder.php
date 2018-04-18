<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/25
 * Time: 23:47
 */
class Model_UOrder extends PhalApi_Model_NotORM
{

    public function getLastMoneyByUid($userId){
        return $this->getORM()->where('uid=? and s_type=0',$userId)->order('addtime desc')->fetchRow('moeny');
    }
    public function isExistByOrderId($orderId){
        return $this->getORM()->where('order_id=?',$orderId)->fetchRow('id');
    }

    public function confirmOrder($oid,$money,$time){
        $sql = "update {$this->prefix}orders set is_pay=1 ,okdt=:okdt,money_two=0,rate=:rate  where id=:oid and money<=:money ";
        $params[':okdt'] = $time;
        $params[':oid'] = $oid;
        $params[':money'] = $money;
        $params[':rate'] = floatval(DI()->config->get('setting.b4'));
        return $this->getORM()->queryExecute($sql,$params);
    }

    public function getOrderInfoByOrderId($orderId,$field='*'){
        return $this->getORM()->select($field)->where('order_id=? and is_pay=0',$orderId)->fetchRow();
    }

    public function updateOrderByOrderId($orderId,$data){
        return $this->getORM()->where('order_id=?',$orderId)->update($data);
    }

    public function getQOrderList($offset=0,$limit=10){
        return $this->getORM()->where('is_q=1 and  is_sh<2 and s_type=1 ')->limit($offset,$limit)->fetchRows();
    }

    public function getQOrderCount(){
        return $this->getORM()->where('is_q=1 and  is_sh<2 and s_type=1')->count();
    }

    public function getOrderInfoListByUserIdAndPayType($userId,$payType,$limit=false){
        $prefix = DB_PREFIX;
        $sql = "select o.*,u.user_name as userName from {$prefix}orders as o join {$prefix}user u on u.id=o.uid where o.uid=:userId and  is_pay=:payType";
        if($limit){
            $sql .= $limit;
        }
        $params[':userId'] = $userId;
        $params[':payType'] = $payType;
        return $this->getORM()->queryRows($sql,$params);
    }

    public function getOrderListCount($where){

        $wheresql  = $this->parseSearchWhere($where);
        $params = array();
        $wherekey = '';
        if(count($wheresql)){
            $params = reset($wheresql);
            $wherekey = 'where '.key($wheresql);
        }
        $sql =  "select count(o.id) from {$this->prefix}orders as o left join {$this->prefix}user as u on o.uid=u.id {$wherekey} ";
        foreach ($this->getORM()->query($sql,$params)->fetch() as $return){
            return $return;
        }
    }

    public function getOrderListMoney($where){

        $wheresql  = $this->parseSearchWhere($where);
        $params = array();
        $wherekey = '';
        if(count($wheresql)){
            $params = reset($wheresql);
            $wherekey = 'where '.key($wheresql);
        }
        $sql =  "select sum(o.money) from {$this->prefix}orders as o left join {$this->prefix}user as u on o.uid=u.id {$wherekey} ";
        foreach ($this->getORM()->query($sql,$params)->fetch() as $return){
            return $return;
        }
    }

    public function getOrderList($where,$offset=0,$limit=10,$order='is_sh asc ,is_pay ASC '){
        $wheresql  = $this->parseSearchWhere($where);
        $params = array();
        $wherekey = '';
        if(count($wheresql)){
            $params = reset($wheresql);
            $wherekey = 'where '.key($wheresql);
        }
        $sql = "select o.*,u.user_name,u.bank_user from {$this->prefix}orders as o LEFT join {$this->prefix}user as u on u.id=o.uid {$wherekey} order by {$order} limit ?,?";
        $params[]=$offset;
        $params[]=$limit;

        return $this->getORM()->queryRows($sql,$params);
    }

    public function getChirdOrderList($uid,$dept,$where,$offset=0,$limit=10,$order='o.is_sh asc ,o.is_pay ASC'){
        $wheresql  = $this->parseSearchWhere($where);
        $params[] = $uid;
        $params[] = $dept;
        if(count($wheresql)){
            $params = array_merge($params, reset($wheresql));
            $wherekey = ' and ' .key($wheresql);
        }

        $sql = "select o.*,u.user_name,u.bank_user from {$this->prefix}orders as o LEFT join {$this->prefix}user as u on u.id=o.uid where o.uid in (select uid from {$this->prefix}pusers where pid=? and dept =?)  {$wherekey}  order by {$order} limit ?,?";
        $params[]=$offset;
        $params[]=$limit;
        return $this->getORM()->queryRows($sql,$params);
    }

    public function getOrderMoneyByTime($uid,$s_type,$begintime,$endtime){
        return $this->getORM()->where('uid=?  and addtime<=? and addtime>=? and s_type=? ',$uid,$endtime,$begintime,$s_type)->sum('money');
    }

    public function getOrderCountByTime($uid,$s_type,$begintime,$endtime,$money_type=0){
        return $this->getORM()->where('uid=?  and addtime<=? and addtime>=? and s_type=? ',$uid,$endtime,$begintime,$s_type)->count();
    }

    public function getOrderCountByTimeAndFinished($uid,$s_type,$begintime,$endtime){
        return $this->getORM()->where('uid=?  and addtime<=? and addtime>=? and s_type=? and is_pay=1 ',$uid,$endtime,$begintime,$s_type)->count();
    }

    public function getTotalMoneyByWhere($where)
    {
        $where = $this->parseSearchWhere($where);
        $totalMoney = $this->getORM()->where($where)->sum('money');
        return $totalMoney?floatval($totalMoney):0;
    }

    public function getChirdOrderMoney($uid,$dept,$where){
        $wheresql  = $this->parseSearchWhere($where);
        $params[] = $uid;
        $params[] = $dept;
        if(count($wheresql)){
            $params = array_merge($params, reset($wheresql));
            $wherekey = ' and ' .key($wheresql);
        }

        $sql = "select sum(money) from {$this->prefix}orders where uid in (select uid from {$this->prefix}pusers where pid=? and dept =?)  {$wherekey} limit 1";
        foreach($this->getORM()->query($sql,$params)->fetch() as $return){
            return $return;
        }

    }

    public function getOrderCount($where=array()){
        $where = $this->parseSearchWhere($where);
        return $this->getORM()->where($where)->count('*');
    }

    public function getInOrdersCanMatch($lasttime){
        return $this->getORM()->select('*')->where('s_type=0 and is_sh<2 and is_pay=0 and addtime<= ? ',$lasttime)->fetchRows();
    }

    public function getOutOrdersCanMatch($uid,$market){
        return $this->getORM()->select('*')->where('market=? and s_type=1 and is_sh<2 and is_pay=0 and is_q=0 and uid<>?',$market,$uid)->fetchRows();
    }


    public function frezzeOrderByUid($uid){
        return $this->getORM()->where('uid=? and is_pay=0',$uid)->update(array('is_pay'=>2));
    }

    protected function getTableName($id)
    {
        return 'orders';
    }
}