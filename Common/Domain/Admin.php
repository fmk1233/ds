<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 16:45
 */
class Domain_Admin
{

    public function login($usreName,$password){

        $userModel = new Model_Admin();
        $user = $userModel->getAdminByUserName($usreName);
        if(!$user){
            return T('用户不存在');
        }elseif($user['password']!=md5(md5($password).$user['salt'])){
            return T('密码错误');
        }
//        unset($user['password'],$user['salt'],$user['sec_pwd'],$user['sec_salt']);
        $user['token'] = md5(microtime(true));
        $_SESSION['adminToken'] =  $user['token'];
        $_SESSION[ADMIN_TOKEN] = Common_Function::encode(json_encode($user));

        return false;
    }


}