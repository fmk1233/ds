<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 16:39
 */
class Api_DPublic extends PhalApi_Api
{

    public function getRules()
    {
        return array(
            'doLogin'=>array(
                'user_name'=>array('name'=>'username','type'=>'string','require'=>true,'desc'=>'用户编号'),
                'password'=>array('name'=>'password','type'=>'string','require'=>true,'desc'=>'密码'),
                'verify'=>array('name'=>'verify','type'=>'string','require'=>true,'desc'=>'验证码'),
            ),
        );
    }

    public function login(){

        if(Common_Function::admin_id()){
            header('Location:'.Common_Function::url(array('service'=>'DIndex.index')));
            exit();
        }
        $this->view('/Admin/View/login.php');
    }

    public function doLogin(){

        $userName = $this->user_name;
        $password = $this->password;
        $verify = $this->verify;
        if(md5($verify) !=$_SESSION['verify']){
            unset($_SESSION['verify']);
            throw new PhalApi_Exception_WrongException(T('验证码错误'));
        }else{
            unset($_SESSION['verify']);
        }

        $domain = new Domain_Admin();
        $result = $domain->login($userName,$password);
        if($result){
            throw new PhalApi_Exception_WrongException($result);
        }

        DI()->response->setMsg(T('登录成功'));
        return array('url'=>Common_Function::url(array('service'=>'DIndex.Index')));
    }

}