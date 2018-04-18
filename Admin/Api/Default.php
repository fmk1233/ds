<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/23
 * Time: 8:49
 */
class Api_Default extends PhalApi_Api
{


   /**
    * 跳转到登陆页
    * @desc 跳转到登陆页
    */
    public function index(){
        header('Location:'.Common_Function::url(array('service'=>'DPublic.Login')));
    }

}