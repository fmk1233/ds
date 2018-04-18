<?php
/**
 * 以下配置为系统级的配置，通常放置不同环境下的不同配置
 */


return array(
    /**
     * 默认环境配置
     */
    'debug' => true,

    /**
     * MC缓存服务器参考配置
     */
    'mc' => array(
        'host' => '127.0.0.1',
        'port' => 11211,
    ),

    /**
     * 加密
     */
    'crypt' => array(
        'mcrypt_iv' => '12345678',      //8位
    ),
    'file' => array(
        'path' => API_ROOT . '/Runtime'
    ),

    'translate' => true,

    'alipay' => array(
        //证书目录
        'sslPath' => API_ROOT . '/Library/Payment/cert/',
        //阿里公钥文件名
        'publicKey' => 'alipay_public.pem',
        //商户私钥文件名
        'sslName' => 'alipay_private.pem',
        'type' => 'alipay',
        //回调地址
        'notifyUrl' => '',
        'appId' => '2016080200148294',
        //卖家支付宝用户ID 2088102146225135  非必需
        'mchId' => '',
    ),
);
