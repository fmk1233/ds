<?php

/**
 * Created by PhpStorm.
 * User: denn
 * Date: 2016/9/12
 * Time: 14:47
 */

class Common_Request extends PhalApi_Request
{

    /**
     * 生成请求参数
     * 此生成过程便于项目根据不同的需要进行定制化参数的限制，如：
     * 如只允许接受POST数据，或者只接受GET方式的service参数，以及对称加密后的数据包等
     *
     * @param array $data 接口参数包
     *
     * @return array
     */
    protected function genData($data) {
        if (!isset($data) || !is_array($data)) {
            if (isset($_REQUEST['params'])) {
                if(isset($_GET['params'])){
                    $token = $_GET['token'];
                }else{
                    $token = $this->getHeader('Token');
                }
//                var_dump($_REQUEST);
                if ($token != md5($_REQUEST['params'])) {
                    throw new PhalApi_Exception_BadRequest('非法请求');
                }

                $data = Common_Function::decode($_REQUEST['params']);
                return json_decode($data,true);
            }else{

                if(!empty($_GET)||!empty($_POST)){
                    if(IS_JSON){
                        throw new PhalApi_Exception_BadRequest('非法请求');
                    }else{
                        echo '<script>alert("非法请求");</script>';
                        exit();
                    }
                }
                return array();
            }
        }
        return $data;
    }


}