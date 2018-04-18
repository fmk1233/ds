<?php

/**
 * User: denn
 * Date: 2017/3/10
 * Time: 8:43
 */
class Api_Default extends Api_Common
{

    public function getRules()
    {
        return array(
            'doLogin' => array(
                'username' => array('name' => 'username', 'type' => 'string', 'require' => true, 'desc' => '会员编号或手机号'),
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '密码'),
            ),
            'getOpenid' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '用户ID')
            )
        );

    }

    public function index()
    {

    }

    /**
     * 会员登陆
     * @desc 会员登陆
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function doLogin()
    {
        $result = Domain_Users::login($this->username, $this->password, true, 1);
        if (is_array($result)) {//登陆成功
            DI()->response->setMsg(T('登陆成功'));
            return $result;
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }


    public function getOpenid()
    {
        $wx_payment = Domain_Payment::getPaymentById(6);
        $openid = $wx_payment->getOpenid(Common_Function::url(array('service' => 'Default.GetOpenid','id'=>$this->id)));
        $user_model = new Model_Users();
        $user_model->update($this->id, array('openid' => $openid));
        header('Location: ' . dirname(URL_ROOT) . '/mshop.php');
        exit();
    }

}