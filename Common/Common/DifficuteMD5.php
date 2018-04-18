<?php

/**
 * Created by PhpStorm.
 * User: denn
 * Date: 2016/9/12
 * Time: 13:43
 */
class Common_DifficuteMD5 implements PhalApi_Filter
{
    protected $signName;

    public function __construct($signName = 'Sign') {
        $this->signName = $signName;
    }

    public function check() {

        $allParams = DI()->request->getAll();
        if(empty($allParams)){
            return;
        }

        if(isset($_GET['sign'])){
            $sign = $_GET['sign'];
        }else{
            $sign = DI()->request->getHeader($this->signName,'');
        }


        $expectSign = $this->encryptAppKey($allParams);


        if ($expectSign != $sign) {
            DI()->logger->debug('Wrong Sign11', array('needSign' => $expectSign,'params'=>json_encode($allParams),'sign'=>$sign));
            throw new PhalApi_Exception_BadRequest(T('wrong sign'), 6);
        }
    }

    protected function encryptAppKey($params) {

        if (count($params)>0){
            ksort($params);
            $paramsStrExceptSign = '';
            foreach ($params as $key=>$param) {
                if(is_array($param)){
                    $param = json_encode($param,JSON_UNESCAPED_UNICODE);
                }
                $paramsStrExceptSign .= '&'.$key.'='.$param;
            }
            $paramsStrExceptSign = trim($paramsStrExceptSign,'&');
        }else{
            $paramsStrExceptSign = '';
        }

        return md5(md5($paramsStrExceptSign).BASE_KEY);
    }
}