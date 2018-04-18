<?php

/**
 * User: denn
 * Date: 2017/3/24
 * Time: 17:28
 */
class Api_Payment extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'paymentList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'paymentInfoView' => array(
                'payment_id' => array('name' => 'payment_id', 'type' => 'int', 'require' => true, 'desc' => '支付方式ID'),
            ),
            'doPaymentInfo' => array(
                'payment_config' => array('name' => 'config', 'type' => 'array', 'require' => true, 'desc' => '支付配置'),
                'payment_state' => array('name' => 'state', 'type' => 'enum', 'range' => array(0, 1),'default'=>0, 'require' => true, 'desc' => '状态'),
                'payment_id' => array('name' => 'payment_id', 'type' => 'int', 'require' => true, 'desc' => '支付方式ID'),
            )
        );
    }

    /**
     * 商城支付方式列表View
     * @desc 商城支付方式列表View
     */
    public function paymentListView()
    {
        $this->assign('tips', array('此处列出了系统支持的支付方式，点击“设置”按钮可以编辑支付参数及开关状态'));
        $this->view('payment_list');
    }


    /**
     * 获取商城支付方式列表数据
     * @desc 获取商城支付方式列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function paymentList()
    {
        return Domain_Payment::getList($this->limit, $this->offset);
    }


    /**
     * 商城支付方式View
     * @desc 商城支付方式View
     */
    public function paymentInfoView()
    {
        $this->assign('payment', Domain_Payment::paymentInfo($this->payment_id));
        $this->view('payment_info');
    }

    /**
     * 修改支付方式信息数据
     * @desc 修改支付方式信息数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function doPaymentInfo()
    {
        $result = Domain_Payment::updatePayment((array)$this);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return;
        }
        throw new PhalApi_Exception_WrongException($result);
    }
}