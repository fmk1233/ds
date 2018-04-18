<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/27
 * Time: 9:10
 */
class Api_DOrders extends Api_DCommon
{


    public function getRules()
    {
        return array(
            'orderList'=>array(
                'offset'=>array('name'=>'offset','type'=>'int','require'=>true),
                'limit'=>array('name'=>'limit','type'=>'int','require'=>true),
                's_type'=>array('name'=>'s_type','type'=>'int','min'=>0,'max'=>1,'require'=>true),
                'userId'=>array('name'=>'userId','type'=>'int'),
                'userName'=>array('name'=>'userName','type'=>'string'),
                's_time'=>array('name'=>'s_time','type'=>'string'),
                'e_time'=>array('name'=>'e_time','type'=>'string'),
                'qiangdan'=>array('name'=>'qiangdan','type'=>'int','default'=>-1)
            ),
            'pPOrderList'=>array(
                'offset'=>array('name'=>'offset','type'=>'int','require'=>true),
                'limit'=>array('name'=>'limit','type'=>'int','require'=>true),
                'in_userId'=>array('name'=>'in_userId','type'=>'string','require'=>true),
                'out_userId'=>array('name'=>'out_userId','type'=>'string','require'=>true),
                'in_order_id'=>array('name'=>'in_order_id','type'=>'string','require'=>true),
                'out_order_id'=>array('name'=>'out_order_id','type'=>'string','require'=>true),
            ),
            'matchOrder'=>array(
                'inCode'=>array('name'=>'inCode','type'=>'string','require'=>true),
                'outCode'=>array('name'=>'outCode','type'=>'string','require'=>true),
            ),
            'deletePP'=>array(
                'ppid'=>array('name'=>'ppid','type'=>'int','require'=>true),
                'type'=>array('name'=>'type','type'=>'int','min'=>0,'max'=>1,'require'=>true),
            ),
            'inQOrder'=>array(
                'orderId'=>array('name'=>'orderId','type'=>'int','require'=>true),
            ),
            'outQOrder'=>array(
                'orderId'=>array('name'=>'orderId','type'=>'int','require'=>true),
            ),
            'unfrezzeOrder'=>array(
                'orderId'=>array('name'=>'orderId','type'=>'int','require'=>true)
            )
        );
    }

    public function cashManager(){
        $this->view('cashManager');
    }

    public function orderList(){
        $bonusModel = new Model_UOrder();
        $where = array();
        if($this->userId){
            $where['u.id=?'] = $this->userId;
        }
        if($this->userName){
            $where['u.user_name=?'] = $this->userName;
        }

        if(!empty($this->s_time)){
            $where['o.addtime>=?'] = strtotime($this->s_time);
        }

        if(!empty($this->e_time)){
            $where['o.addtime<=?'] = strtotime($this->e_time);
        }

        $where['o.s_type=?'] = $this->s_type;

        $total = $bonusModel->getOrderListCount($where);
        $users = $bonusModel->getOrderList($where,$this->offset,$this->limit,'is_sh asc ,is_pay ASC,o.addtime desc');
        $totalMoney = $bonusModel->getOrderListMoney($where);
        return array('total'=>$total,'rows'=>$users,'money'=>number_format($totalMoney,2));
    }

    public function matchOrder(){
        $rs = array('code'=>40000,'msg'=>'','info'=>array());
        $domain = new Domain_UOrder();
        if(Common_Function::lock()){
            $result = $domain->match_order($this->inCode,$this->outCode);
        }else{
            $result = '有人正在匹配中，请等待...';
        }
        if($result){
            $rs['msg'] = $result;
            $rs['code'] = 40001;
        }
        echo json_encode($rs);exit();
    }

    public function autoMatch(){
        $rs = array('code'=>40000,'msg'=>'','info'=>array());
        $domain = new Domain_UOrder();
        set_time_limit(0);
        ignore_user_abort(true);
        if(Common_Function::lock()){
            $result = $domain->autoMatchOrder();
        }else{
            $result = '有人正在匹配中，请等待...';
        }
        if($result){
            $rs['msg'] = $result;
            $rs['code'] = 40001;
        }
        echo json_encode($rs);exit();
    }

    public function inQOrder(){
        $rs = array('code'=>40000,'msg'=>'','info'=>array());
        $domain = new Domain_UOrder();
        $result = $domain->inQOrder($this->orderId);
        if($result){
            $rs['msg'] = $result;
            $rs['code'] = 40001;
        }
        echo json_encode($rs);exit();
    }

    public function outQOrder(){
        $rs = array('code'=>40000,'msg'=>'','info'=>array());
        $domain = new Domain_UOrder();
        $result = $domain->outQOrder($this->orderId);
        if($result){
            $rs['msg'] = $result;
            $rs['code'] = 40001;
        }
        echo json_encode($rs);exit();
    }

    public function pPOrderList(){
        $pporderModel = new Model_PPOrders();
        $where = array();
        if($this->in_userId){
            $where['uid'] = $this->in_userId;
        }
        if($this->out_userId){
            $where['b_uid'] = $this->out_userId;
        }
        if($this->in_order_id){
            $where['order_id'] = $this->in_order_id;
        }
        if($this->out_order_id){
            $where['b_order_id'] = $this->out_order_id;
        }

        $total = $pporderModel->getPPOrderListCount($where);
        $users = $pporderModel->getPPOrderList($this->limit,$this->offset,$where);
        return array('total'=>$total,'rows'=>$users);
    }

    public function unfrezzeOrder()
    {
        $rs = array('code'=>40000,'msg'=>'','info'=>array());
        $orderOrder = new Model_UOrder();
        $result = $orderOrder->update($this->orderId,array('is_pay'=>0));
        if(!$result){
            $rs['msg'] = $result;
            $rs['code'] = 40001;
        }
        echo json_encode($rs);exit();
    }

    public function deletePP(){
        $rs = array('code'=>40000,'msg'=>'','info'=>array());
        if(Common_Function::lock()) {
            $ppid = $this->ppid;//匹配订单id
            $type = $this->type;//撤销类型
            $ppOrderModel = new Model_PPOrders();
            $pporder = $ppOrderModel->get($ppid);
            $orderDomain = new Domain_UOrder();
            $userDomain = new Domain_Users();
            if (!$pporder) {
                $rs['code'] = 40001;
                $rs['msg'] = '非法请求';
            }elseif($pporder['is_buy'] == 1 && $type==0){
                $orderDomain->deletePPOrder($pporder);
            } elseif (($pporder['is_buy'] == 1&&$type==1)  || ($pporder['is_buy'] == 2 && $type == 0)) {//未打款
//                $userDomain->lockUser($pporder['uid']);
                $orderDomain->deletePPOrder($pporder);
            } else {//未确认收款
//                $userDomain->lockUser($pporder['uid']);
                $orderDomain->receiveOrder($pporder['id']);
            }
        }else{
            $rs['code'] = 40001;
            $rs['msg'] = '当前有人操作，请稍后再操作';
        }
        echo json_encode($rs);
        exit();

    }

}