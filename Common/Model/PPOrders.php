<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/27
 * Time: 10:05
 */
class Model_PPOrders extends PhalApi_Model_NotORM
{


    public function getPPOrderListByUid($uid,$is_pay=0,$limit=false,$offset=0){
        $where = '';
        switch ($is_pay){
            case 0:
                $where = ' and is_pay=0';
                break;
            case 1:
                $where = ' and is_pay=1';
                break;
        }
        $sql = "select po.*,u1.user_name as username,u2.user_name as b_username from {$this->prefix}pporders as po join {$this->prefix}user as u1 on u1.id=po.uid join {$this->prefix}user as u2 on u2.id=po.b_uid where (po.uid=:uid or po.b_uid=:uid) {$where}  order by po.id desc ";
        if($limit){
            $sql .= ' limit :start,:limit';
            $params[':start'] = $offset;
            $params[':limit'] = $limit;
        }
        $params[':uid'] = $uid;
        return $this->getORM()->queryRows($sql,$params);
    }

    public function getPPOrderListByUidCount($uid,$is_pay=0){
        $where = '';
        switch ($is_pay){
            case 0:
                $where = ' and is_pay=0';
                break;
            case 1:
                $where = ' and is_pay=1';
                break;
        }

        $sql = "select count(*) from {$this->prefix}pporders as po where ( po.uid=:uid  or po.b_uid=:uid) {$where} order by po.id desc ";
        $params[':uid'] = $uid;
        foreach ($this->getORM()->query($sql,$params)->fetch() as $fetch) {
            return $fetch;
        }
    }



    public function getDetailUserInfo($ppid,$type){
        if($type==0){
            $sql = "select po.id,po.pz,po.meno,po.money,po.b_order_id as order_id,u1.user_name as username,u1.mobile,u1.bank_user,u1.bank_name,u1.bank_address,u1.bank_account,u1.zfb,u1.wx from {$this->prefix}pporders as po join {$this->prefix}user as u1 on u1.id=po.b_uid  where po.id=:ppid  limit 1";
        }else{
            $sql = "select po.id,po.pz,po.meno,po.money,po.order_id,u1.user_name as username,u1.mobile,u1.bank_user,u1.bank_name,u1.bank_address,u1.bank_account,u1.zfb,u1.wx  from {$this->prefix}pporders as po  join {$this->prefix}user as u1 on u1.id=po.uid where po.id=:ppid  limit 1";
        }

        $params[':ppid'] = $ppid;
        return $this->getORM()->queryRows($sql,$params);
    }

    public function getTotalMoneyByOrderAndPay($orderId,$s_type)
    {
        if($s_type==0){//提供帮助
            $money = $this->getORM()->where('oid=? and is_pay=1',$orderId)->sum('money');
            return $money?$money:0;
        }else{
            $money = $this->getORM()->where('b_oid=? and is_pay=1',$orderId)->sum('money');
            return $money?$money:0;
        }

    }

    public function getTotalCxMoenyByOrderAndPay($orderId,$s_type){
        if($s_type==0){//提供帮助
            return $this->getORM()->where('oid=? and is_pay=1 and star=1',$orderId)->sum('money');
        }else{
            return $this->getORM()->where('b_oid=? and is_pay=1  and star=1',$orderId)->sum('money');
        }
    }


    /**
     *获取超时未打款的记录，并冻结其订单
     */
    public function  getOrderListOutPay(){
        $b23 = DI()->config->get('setting.b30');
        $lastTime = NOW_TIME - $b23*3600;
        return $this->getORM()->select('oid,uid,b_uid,order_id,b_order_id,id,b_oid,money')->where('is_buy=1 and addtime<=? and is_pay=0  ',$lastTime)->fetchRows();
    }

    /**
     *获取超时未确认收款的记录
     */
    public function  getOrderListOutConfirm(){
        $b24 = DI()->config->get('setting.b31');
        $lastTime = NOW_TIME - $b24*3600;
        return $this->getORM()->select('oid,b_oid,uid,b_uid,order_id,b_order_id,id,meno,money')->where('is_buy=2 and rdt<=? and is_pay=0 ',$lastTime)->fetchRows();
    }


    public function  getPPOrderListCount($where=array()){
        return $this->getORM()->where($where)->count();
    }

    public function  getPPOrderList($limit=20,$offset=0,$where=array()){
        return $this->getORM()->limit($offset,$limit)->where($where)->order('is_buy desc ,id desc')->fetchRows();
    }

    protected function getTableName($id)
    {
        return 'pporders';
    }
}