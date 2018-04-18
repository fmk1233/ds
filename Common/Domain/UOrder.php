<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/25
 * Time: 23:33
 */
class Domain_UOrder
{

    public function __construct()
    {
        exit();
    }

    public function addOrderBuy($money,$payTypes,$userId){
        $setting = DI()->config->get('setting');



        //第一步判断投资金额
        $baseMoeny =explode('|',$setting['b0']);
       /* if($money<$baseMoeny[0]){
            return T('投资金额最小不能小于{money}元',array('money'=>$baseMoeny[0]));
        }elseif($money>$baseMoeny[1]){
            return T('投资金额最大不能大于{money}元',array('money'=>$baseMoeny[1]));
        }
       if($money%100!=0){
            return T('投资金额必须为100的整数倍');
        }
       */
       if(!in_array($money,$baseMoeny)){
           return T('投资金额错误');
       }


        $orderModel = new Model_UOrder();
        $beginTime = strtotime(date('Y-m-d'));
        $endTime = $beginTime+24*3600-1;
        $todayCount = $orderModel->getOrderCountByTime($userId,0,$beginTime,$endTime);
        if($todayCount>=1){
           return T('每{day}天最多能排一单',array('day'=>1));
        }


        $userModel = new Model_Users();
        $user = $userModel->get($userId,'b0,b1,b2,rank,is_fenh,is_modify,market');
        if($user['is_modify']==0){
            return T('请先修改和设置用户资料');
        }
        return $this->orderBuy($userId,$money,$payTypes,$user['market'],$user['b2']);

    }


    public function orderBuy($userId,$money,$payTypes,$market,$b2){
        $setting = DI()->config->get('setting');

        if($setting['b20']!=0){
            if($b2<$money/$setting['b20']){
                return T('您的排单币不足，请购买后再排单');
            }
        }
        $orderModel = new Model_UOrder();
        /*  $where['s_type=?'] = ORDER_TYPE_BUY;
         $where['uid=?'] = $userId;
         $where['is_pay=?'] = 0;
         $orderUnPay = $orderModel->getOrderCount($where);
         if($orderUnPay){
             return T('请先完成当前排队交易');
         }*/

        $orderId = $this->generalOrderId(Common_Function::randomString('Salpha',2).date('YmdHis',NOW_TIME));

        $data = array();
        $data['order_id'] = $orderId;
        $data['uid'] = $userId;
        $data['addtime'] = time();
        $data['money'] = $money;
        $data['money_two'] = $money;
        $data['pay_types'] = serialize($payTypes);
        $data['s_type'] = ORDER_TYPE_BUY;  //接受帮助
        $data['market'] = $market;  //市场类型
        $data['meno'] = Common_Function::randomString();
        $insertId = $orderModel->insert($data);
        if($insertId){
            if($setting['b20']!=0) {
                $bonusModel = new Model_Bonus();
                $bonusId = $bonusModel->addCashHistory($userId, -$money / $setting['b20'], BONUS_TYPE_KPDB, BONUS_PDB, T('提供帮助'));
                if ($bonusId) {
                    $userModel = new Model_Users();
                    $userModel->changeBouns($userId, -$money / $setting['b20'], BONUS_PDB);
                    //增加当前排单时间
                    $userModel->update($userId,array('fenh_dt'=>NOW_TIME));
                }
            }
            return false;
        }
        return T('提供帮助失败');
    }


    protected function generalOrderId($orderId){
        $orderModel = new Model_UOrder();
        $orderIdExist = $orderModel->isExistByOrderId($orderId);
        if($orderIdExist){
            $orderId = Common_Function::randomString('Salpha',2).date('YmdHis',NOW_TIME);
            return $this->generalOrderId($orderId);
        }
        return $orderId;

    }

    public function deleteOrder($oid){
        $orderModel = new Model_UOrder();
        $return = $orderModel->delete($oid);
        if($return){
            return false;
        }
        return T('撤销订单失败');
    }

    public function addOrderSale($money,$payTypes,$userId,$moneyType){
        $setting = DI()->config->get('setting');

        $orderModel = new Model_UOrder();

        $userModel = new Model_Users();
        $user = $userModel->get($userId,'b0,b1,b2,b5,rank,is_fenh,is_modify,market');

        if($money<=0){
            return T('投资金额错误');
        }

        if($user['is_modify']==0){
            return T('请先修改和设置用户资料');
        }
        $beginTime = strtotime(date('Y-m-d',NOW_TIME));
        $endTime = $beginTime+24*3600-1;
        if($moneyType==0){
            if($user['b0']<$money){
                return T('您的{moneytype}金额不足{need}，只有{actual}',array('moneytype'=>T('余额'),'need'=>$money,'actual'=>$user['b0']));
            }
            $type = BONUS_TYPE_STC_K;

        }elseif($moneyType==1){
            if($user['b1']<$money){
                return T('您的{moneytype}金额不足{need}，只有{actual}',array('moneytype'=>T('推广钱包'),'need'=>$money,'actual'=>$user['b1']));
            }
            //动态奖提现额度
            $dnc_ed = explode('|',$setting['b15']) ;
            if($money>$dnc_ed[$user['rank']]){
                return T('您的动态收益最大提现额度为{money}元',array('money'=>$dnc_ed[$user['rank']]));
            }
            $type = BONUS_TYPE_DNC_K;
        }elseif($moneyType==5){
            if($user['b5']<$money){
                return T('您的{moneytype}金额不足{need}，只有{actual}',array('moneytype'=>T('本金钱包'),'need'=>$money,'actual'=>$user['b5']));
            }
            $type = BONUS_TYPE_BJ_K;

        }else{
            return T('非法操作');
        }


        if($moneyType!=1){
            $b12 = explode('~',$setting['b12']);
            if($money<$b12[0]||$money>$b12[1]||$money%$setting['b13']){
                return T('{moneytype}提现范围为{need}，且必须为{actual}的整数倍',array('moneytype'=>'','need'=>$setting['b12'],'actual'=>$setting['b13']));
            }
        }
        $xiane = $setting['b11'];
        //每天提现限额
        $orderNum = $orderModel->getOrderCountByTime($userId,ORDER_TYPE_SALE,$beginTime,$endTime,$moneyType);
        if($orderNum>=$xiane){
            return T('您今天的提现次数已用完');
        }


        $orderId = $this->generalOrderId(Common_Function::randomString('Salpha',2).date('YmdHis',NOW_TIME));

        $data = array();
        $data['order_id'] = $orderId;
        $data['uid'] = $userId;
        $data['addtime'] = time();
        $data['money'] = $money;
        $data['money_two'] = $money;
        $data['pay_types'] = serialize($payTypes);
        $data['s_type'] = ORDER_TYPE_SALE;  //接受帮助
        $data['money_type'] = $moneyType;  //接受帮助类型
        $data['market'] = $user['market'];  //市场类型
        $insertId = $orderModel->insert($data);
        if($insertId){
            $bonusModel = new Model_Bonus();
            $bonusId = $bonusModel->addCashHistory($userId,-$money,$type,$moneyType,T('接受帮助'));
            if($bonusId){
                $userModel->changeBouns($userId,-$money,$moneyType);
            }
            return false;
        }
        return T('接受帮助失败');
    }

    public function match_order($inCode,$outCode){
        $orderModel = new Model_UOrder();

        $inOrder = $orderModel->getOrderInfoByOrderId($inCode);
        if(!$inOrder){
            return T('进场订单不存在或者异常');
        }

        $outOrder = $orderModel->getOrderInfoByOrderId($outCode);
        if(!$outOrder){
            return T('出场订单不存在或者异常');
        }
        $money = min($inOrder['money_two'],$outOrder['money_two']);
        if($money<=0){
            return T('部分订单已匹配完全，请勿多余匹配');
        }


        if ($inOrder['uid'] == $outOrder['uid']) {
            return T("同一会员的订单不能进行匹配！");
        }elseif($inOrder['market']!=$outOrder['market']){
            return T('不同市场的订单不能相互匹配');
        }

        $inUpdate['money_two'] = $inOrder['money_two']-$money;
        if($inUpdate['money_two']<=0){
            $inUpdate['is_sh'] = 2;
        }else{
            $inUpdate['is_sh'] = 1;
        }

        $outUpdate['money_two'] = $outOrder['money_two']-$money;
        if($outUpdate['money_two']<=0){
            $outUpdate['is_sh'] = 2;
        }else{
            $outUpdate['is_sh'] = 1;
        }

        //插入匹配订单信息
        $ppOdersModel = new Model_PPOrders();
        $data = array();
        $data['order_id'] = $inOrder['order_id'];
        $data['b_order_id'] = $outOrder['order_id'];

        $data['uid'] = $inOrder['uid'];
        $data['b_uid'] = $outOrder['uid'];

        $data['oid'] = $inOrder['id'];
        $data['b_oid'] = $outOrder['id'];

        $data['addtime'] = NOW_TIME;
        $data['money'] = $money;
        $data['is_buy'] = 1;
        $data['is_hand'] = 1;
        $data['is_pay'] = 0;
        $data['pdt'] = $inOrder['addtime'];
        $data['is_q'] = $inOrder['is_q'];
        $data['money_type'] = $outOrder['money_type'];//取钱类型
        $insertId = $ppOdersModel ->insert($data);
        if($insertId){
            $orderModel->updateOrderByOrderId($inCode,$inUpdate);
            $orderModel->updateOrderByOrderId($outCode,$outUpdate);

            $this->sendPPOrderMobileMsg($inOrder['uid'],$outOrder['uid'],$inOrder['money'],$outOrder['money']);
            return false;
        }
        return T('匹配失败');

    }

    private function sendPPOrderMobileMsg($inUserId,$outUserId,$inMoney=0,$outMoney=0){
        $b33 = DI()->config->get('setting.b33');
        if($b33==0) {//是否开启短信功能
            $userModel = new Model_Users();
            $inUserMobile = $userModel->get($inUserId, 'mobile,user_name');
            $outUserMobile = $userModel->get($outUserId, 'mobile,user_name');
            $userDomain = new Domain_Users();
            $userDomain->sendMobileMsg($inUserMobile['mobile'], ('尊敬的GGP会员，您好，您申请的'.$inMoney.'点植入已经匹配成功，匹配会员信息为：'.$outUserMobile['user_name'].'先生／女士，联系电话：'.$outUserMobile['mobile'].'，请及时登录网站核实相关信息。'));
            $userDomain->sendMobileMsg($outUserMobile['mobile'], '尊敬的GGP会员，您好，您申请的'.$outMoney.'点释放已经匹配成功，匹配会员信息为：'.$inUserMobile['user_name'].'先生／女士，联系电话：'.$inUserMobile['mobile'].'，请及时登录网站核实相关信息。');
        }
    }

    private function sendPayMobileMsg($userid,$money=0){
        $b33 = DI()->config->get('setting.b33');
        if($b33==0) {//是否开启短信功能
            $userModel = new Model_Users();
            $inUserMobile = $userModel->get($userid, 'mobile,user_name');
            $userDomain = new Domain_Users();
            $userDomain->sendMobileMsg($inUserMobile['mobile'], '尊敬的GGP会员，您好，您申请的'.$money.'点匹配会员'.$inUserMobile['user_name'].'先生/女士联系电话'.$inUserMobile['mobile'].'，已经完成植入打米，请您及时登录平台核实相关信息。');

        }
    }

    public function payOrder($ppid,$uid=false){
        $pporderModel = new Model_PPOrders();
        //判断匹配订单是否存在
        $pporder = $pporderModel->get($ppid,'id,is_q,addtime,uid,b_uid,money');
        if(!$pporder){
            return T('参数错误');
        }
        if($uid){
            if($uid != $pporder['uid']){
                return T('非法操作，请本人来确认打款');
            }
        }

        $update = array();
        $update['is_buy']=2;
        $update['rdt'] = NOW_TIME;

        $mintime = DI()->config->get('setting.b27')*3600;

        if(NOW_TIME-$pporder['addtime']<$mintime){
            $update['star'] = 1;
        }

        $count = $pporderModel->update($ppid,$update);
        if($count){
            $this->sendPayMobileMsg($pporder['b_uid'],$pporder['money']);
            return false;
        }
        return T('确认打款失败');


    }


    public function autoMatchOrder(){

        $lasttime = NOW_TIME - DI()->config->get('setting.b3')*24*3600;
        $orderModel = new Model_UOrder();
        //获取可以匹配的进场订单
        $inOrders = $orderModel->getInOrdersCanMatch($lasttime);

        $ppOdersModel = new Model_PPOrders();

        foreach ($inOrders as $inOrder) {
            $money = $inOrder['money_two'];
            $outOrders = $orderModel->getOutOrdersCanMatch($inOrder['uid'],$inOrder['market']);
            foreach ($outOrders as $outOrder) {

                $ppmoney = min($money,$outOrder['money_two']);
                if($ppmoney==0){
                    break;
                }

                if($outOrder['uid']==$inOrder['uid']){
                    continue;
                }

                $inUpdate['money_two'] = $money - $ppmoney;
                if($inUpdate['money_two']<=0){
                    $inUpdate['is_sh'] = 2;
                }else{
                    $inUpdate['is_sh'] = 1;
                }

                $outUpdate['money_two'] = $outOrder['money_two']-$ppmoney;
                if($outUpdate['money_two']<=0){
                    $outUpdate['is_sh'] = 2;
                }else{
                    $outUpdate['is_sh'] = 1;
                }

                //插入匹配订单信息
                $data = array();
                $data['order_id'] = $inOrder['order_id'];
                $data['b_order_id'] = $outOrder['order_id'];

                $data['uid'] = $inOrder['uid'];
                $data['b_uid'] = $outOrder['uid'];

                $data['oid'] = $inOrder['id'];
                $data['b_oid'] = $outOrder['id'];

                $data['addtime'] = NOW_TIME;
                $data['money'] = $ppmoney;
                $data['pdt'] = $inOrder['addtime'];
                $data['is_buy'] = 1;
                $data['is_hand'] = 0;
                $data['is_pay'] = 0;
                $data['is_q'] = $inOrder['is_q'];
                $data['money_type'] = $outOrder['money_type'];//取钱类型
                $insertId = $ppOdersModel ->insert($data);
                if($insertId){
                    $money -=$ppmoney;
                    $orderModel->update($inOrder['id'],$inUpdate);
                    $orderModel->update($outOrder['id'],$outUpdate);
                    //是否开启短信功能
                    $this->sendPPOrderMobileMsg($inOrder['uid'],$outOrder['uid'],$inOrder['money'],$outOrder['money']);
                }
            }

        }

        return false;
    }

    public function receiveOrder($ppid,$uid=false){
        $pporderModel = new Model_PPOrders();
       // $bonusModel = new Model_Bonus();
        //判断匹配订单是否存在
        $pporder = $pporderModel->get($ppid,'id,is_q,addtime,b_uid,oid,uid,b_oid,order_id,money,rdt,is_pay,pdt');
        if(!$pporder){
            return T('参数错误');
        }
        if($uid){
            if($uid != $pporder['b_uid']){
                return T('非法操作，请本人来确认收款');
            }
        }

        if($pporder['is_pay']==1){
            return T('您已经确认过了，请勿重复确认');
        }

        $update = array();
        $update['is_pay']=1;
        $update['is_buy']=3;
        $update['okdt'] = NOW_TIME;
        $count = $pporderModel->update($ppid,$update);
        if($count){
            $orderModel = new Model_UOrder();
            //判断提供帮助是否完成
            $inTotalMoney = $pporderModel->getTotalMoneyByOrderAndPay($pporder['oid'],ORDER_TYPE_BUY);
            $finishIn = $orderModel->confirmOrder($pporder['oid'],$inTotalMoney,NOW_TIME);
            if($finishIn){//更新成功说明订单确认成功，这笔订单全部完成 ；
                //开始计算奖金
                $cxTotalMoney = $pporderModel->getTotalCxMoenyByOrderAndPay($pporder['oid'],0);
                $this->getjj($pporder['uid'],$inTotalMoney,$cxTotalMoney,$pporder['order_id'],$pporder['oid'],$pporder['pdt']);

            }
         /*   //计算收款诚信奖
            if($pporder['rdt']+DI()->config->get('setting.b9')*3600>NOW_TIME){
                //发放收款诚信奖
                $money_count = bcmul($pporder['money'],DI()->config->get('setting.b10')/100,2);//诚信奖
                $menos=DI()->config->get('setting.b9').'小时内，确认收到订单'.$pporder['order_id'].'的款项完成产生诚信奖励';
                $bonusModel->addCashHistory($pporder['b_uid'],$money_count,BONUS_TYPE_STC_CX,BONUS_STC,$menos,1,$pporder['oid']);//发放并冻结
            }*/

            //判断接受帮助是否完成
            $outTotalMoney = $pporderModel->getTotalMoneyByOrderAndPay($pporder['b_oid'],ORDER_TYPE_SALE);
            $orderModel->confirmOrder($pporder['b_oid'],$outTotalMoney,NOW_TIME);
            return false;
        }
        return T('确认收款失败');


    }


    public function getjj($uid,$money,$cxTotalMoney,$orderId=0,$oid=0,$pdt=0){
        $setting = DI()->config->get('setting');

        $userModel = new Model_Users();
        $bonusModel = new Model_Bonus();

        //更新当前交易金额
        $updateArray = array();
        $updateArray['money'] = $money;
        if($money<=$cxTotalMoney){//诚信打款
            $updateArray['star'] = array(new NotORM_Literal('star+'.$setting['b28']));
            $pri = $setting['b4'];
            $money_count = bcmul($money,$pri/100,2);//利息
        }else{
            $updateArray['star'] = array(new NotORM_Literal('star+'.$setting['b25']));
            $pri = $setting['b6'];
            $money_count = bcmul($money,$pri/100,2);//利息
        }
        $updateArray['order_count'] = array(new NotORM_Literal('order_count+1'));
        $updateArray['daytime'] = NOW_TIME;
        $userModel->update($uid,$updateArray);
        //对会员进行升级操作
        $user = $userModel->get($uid,'user_name,star,rank,pid,is_fenh,rid,id,affect_num,money,order_count');
        $meno = T('{username}的订单{orderid}完成产生',array('username'=>$user['user_name'],'orderid'=>$orderId));

        $b18 = explode('|',$setting['b18']);
        $b19 = explode('|',$setting['b19']);
        if($user['star']>=$b19[$user['rank']]&&$user['order_count']>=$b18[$user['rank']]){
            $userModel->changeRank($user['id'],$user['rank']+1,$user['rank']);
        }


        //静态收益
        $menos=$meno.' '.T('利息奖励');
        $bonusId = $bonusModel->addCashHistory($uid,$money_count,BONUS_TYPE_STC_RW,BONUS_STC,$menos,BONUS_FREZZE,$oid,$uid,$pri,0);//
        if($bonusId){
           // $userModel->changeBouns($uid,$money_count,BONUS_STC);
        }
        //提供帮助本金
        $menos=$meno.' '.T('本金返还');
        $bonusId = $bonusModel->addCashHistory($uid,$money,BONUS_TYPE_STC,BONUS_BJ,$menos,BONUS_FREZZE,$oid,$uid,0,0);
        if($bonusId){
           // $userModel->changeBouns($uid,$money,BONUS_STC);
        }


        //获取当前能获得领导奖的代数
        $where = array();
        $where['pid=?'] = intval($user['id']);
        $where['dept=?'] = 1;
        $where['state>?'] = 0;
        $directCount = $userModel->getChildCountByCondition($where);
        $where['dept=?'] = 2;
        $secondCount = $userModel->getChildCountByCondition($where);
        $where['dept=?'] = 3;
        $thirdCount = $userModel->getChildCountByCondition($where);
        $b35 = explode('|',$setting['b35']);//直推人数
        $b36 = explode('|',$setting['b36']);//二级人数
        $b39 = explode('|',$setting['b39']);//三级人数
        $b37 = explode('|',$setting['b37']);//代数
        $b38 = explode('|',$setting['b38']);//奖金比例
        $num = -1; //获取第几种领导奖
        foreach ($b35 as $key=>$b){
            if($directCount>=$b35[$key]&&$secondCount>=$b36[$key]&&$thirdCount>=$b39[$key]){
                $num = $key;
            }else{
                break;
            }
        }
        $daishu = 0;
        if($num>=0){
            $daishu = $b37[$num];
        }

        //推广奖收益
        $tgRewardParams = explode('|',$setting['b14']);
        $tgRewardCount = count($tgRewardParams);
        $length = max($daishu,$tgRewardCount);
        $pid = $user['pid'];
        for($i=0;$i<$length;$i++){
            if(!$pid){
                break;
            }
            $senior = $userModel->get($pid,'user_name,star,rank,is_fenh,rid,id,pid,affect_num,money');
            $pid = $senior['pid'];
            if($i<$tgRewardCount){//推广奖
                $base_money = min($money,$senior['money']);
                $money_count = bcmul($base_money,$tgRewardParams[$i]/100,2);//推广奖
                if($money_count>0){
                    $menos = $meno.' '.T('第{dai}代推广奖',array('dai'=>$i+1));
                    $bonusId = $bonusModel->addCashHistory($senior['id'],$money_count,BONUS_TYPE_DNC_RW,BONUS_DNC,$menos,BONUS_FREZZE,$oid,$uid,$tgRewardParams[$i],$i+1);//
                    if($bonusId){
                       // $userModel->changeBouns($pid,$money_count,BONUS_DNC);
                    }
                }
            }

            if($i<$daishu){
                $base_money = min($money,$senior['money']);
                $money_count = bcmul($base_money,$b38[$i]/100,2);//推广奖
                if($money_count>0){
                    $menos = $meno.' '.T('第{dai}代领导奖',array('dai'=>$i+1));
                    $bonusId = $bonusModel->addCashHistory($senior['id'],$money_count,BONUS_TYPE_DNC_RWF,BONUS_DNC,$menos,BONUS_FREZZE,$oid,$uid,$b38[$i],$i+1);//
                    if($bonusId){
                       // $userModel->changeBouns($pid,$money_count,BONUS_DNC);
                    }
                }
            }



        }




    }


    public function uploadPzAndMeno($ppid,$uid=false,$meno){
        $pporderModel = new Model_PPOrders();
        //判断匹配订单是否存在
        $pporder = $pporderModel->get($ppid,'id,is_q,addtime,uid,oid');
        if(!$pporder){
            return T('参数错误');
        }
        $orderModel = new Model_UOrder();
        $order = $orderModel->get($pporder['oid'],'meno');
        if($uid){
            if($uid != $pporder['uid']){
                return T('非法操作，请本人来上传凭证');
            }
        }
        if($meno !=$order['meno']){
            return T('请上传正确的备注单号');
        }

        if ($_FILES["proof"]["error"] > 0) {
            DI()->logger->debug('failed to upload file with error: ' . $_FILES['proof']['error']);
            return T('上传失败');
        }
        list ( $width, $height, $type, $attr ) = getimagesize ( $_FILES ['proof'] ['tmp_name'] );
        switch ($type) {
            case 1 :
                $ext = ".GIF";
                break;
            case 2 :
                $ext = ".JPG";
                break;
            case 3 :
                $ext = ".PNG";
                break;
            default :
                $ext = "...";
                break;
        }
        $path = '/static/upload/image/'.md5(microtime(true).rand(1000,9999)).$ext;
        move_uploaded_file($_FILES['proof']['tmp_name'],API_ROOT.'/public'.$path);

        $update = array();
        $update['pz'] = $path;
        $update['meno'] = $meno;
        $count = $pporderModel->update($ppid,$update);
        if($count){
            return false;
        }
        return T('上传失败');
    }



    public function inQOrder($oid)
    {
        $orderModel = new Model_UOrder();
        $update = array();
        $update['is_q'] = 1;
        $result =  $orderModel->update($oid,$update);
        if($result){
            return false;
        }
        return '进入抢单池失败';

    }
    public function outQOrder($oid)
    {
        $orderModel = new Model_UOrder();
        $update = array();
        $update['is_q'] = 0;
        $result =  $orderModel->update($oid,$update);
        if($result){
            return false;
        }
        return '退出抢单池失败';

    }

    public function qOrderConfirm($oid,$user){
        if(Common_Function::lock()){

            $b24 =DI()->config->get('setting.b24');//是否开启抢单模式
            if($b24 ==1){
                return '当前抢单模式未开启，请等待后台开启此功能';
            }
            $b34 =DI()->config->get('setting.b34');
            $b21_rs = explode('|',$b34);
            $flag = false;
            foreach ($b21_rs as $b21_r) {
                $b21 = explode('-',$b21_r);
                $beginTime = strtotime(date('Y-m-d '.$b21[0]));
                $endTime = strtotime(date('Y-m-d '.$b21[1]));
                if($beginTime<=NOW_TIME&&NOW_TIME<=$endTime){
                    $flag = true;
                }
            }
            if(!$flag){
                return '当前时间不可抢单，抢单时间为'.$b34;
            }

            $orderModel = new Model_UOrder();

            $outOrder = $orderModel->get($oid,'money_two,order_id,uid,pay_types');
            $money = $outOrder['money_two'];

            if($money<=0){
                return '本单已经抢购完了';
            }

            if($outOrder['uid']==$user['id']){
                return '自己不能抢自己的订单';
            }

            $orderId = $this->generalOrderId(Common_Function::randomString('Salpha',2).date('YmdHis',NOW_TIME));

            $data = array();
            $data['order_id'] = $orderId;
            $data['uid'] = $user['id'];
            $data['addtime'] = NOW_TIME;
            $data['money'] = $money;
            $data['money_two'] = $money;
            $data['pay_types'] = $outOrder['pay_types'];
            $data['market'] = $user['market'];  //市场类型
            $data['s_type'] = ORDER_TYPE_BUY;  //接受帮助
            $data['meno'] = Common_Function::randomString();
            $insertId = $orderModel->insert($data);
            if($insertId){
                $userModel = new Model_Users();
                $userModel->update($user['id'],array('fenh_dt'=>NOW_TIME));
                $result = $this->match_order($data['order_id'],$outOrder['order_id']);
                if($result){
                    $orderModel->delete($insertId);
                    return $result;
                }
                return false;
            }
            return '抢单失败';
        }else{
            return '抢单失败';
        }
    }


    //未打款匹配订单
    public function deletePPOrder($unPayOrder){
        $orderModel = new Model_UOrder();
        $ppOrderModel = new Model_PPOrders();

        $prefix = DB_PREFIX;

        $inSql = "update {$prefix}orders set money_two=money_two+:money, is_sh=CASE when money=money_two THEN 0 ELSE 1 END where id=:oid and is_pay=0";
        $update1 = $orderModel->queryExecute($inSql,array(':money'=>$unPayOrder['money'],':oid'=>$unPayOrder['oid']));

        //还原各自的匹配金额
        $outSql = "update {$prefix}orders set money_two=money_two+:money, is_sh=CASE when money=money_two THEN 0 ELSE 1 END ,is_q=1 where id=:oid and is_pay=0";
        $update2 = $orderModel->queryExecute($outSql,array(':money'=>$unPayOrder['money'],':oid'=>$unPayOrder['b_oid']));

        if($update1&&$update2){
            $userDomain = new Domain_Users();
            //删除当前的匹配订单
            $ppOrderModel->delete($unPayOrder['id']);
            $userDomain->lockUser($unPayOrder['uid'],true);
        }
    }

}