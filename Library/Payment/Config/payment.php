<?php
/**
 * Created by PhpStorm.
 * User: qiu han
 * Date: 2016/11/21
 * Time: 19:42
 *
 * 请将本文件复制到根目录下的Config目录下,并将配置项补充齐全
 * 可根据不同框架自行决定存放位置
 */

return array(
    //微信配置文件
    'wechat' => array(
        //证书目录
        'sslPath'   => '',
        //证书名称，不带_cert.pem和_key.pem，比如证书名称为wechat_apiclient_cert.pem，则这里填wechat_apiclient
        'sslName'   => 'apiclient',
        //证书密钥
        'key'       => '8934e7d15453e97507ef794cf7b0519d',
        //回调地址
        'notifyUrl' => '',
        'type'      => 'wechat',
        'appId'     => 'wx426b3015555a46be',
        'appSecret' => '7813490da6f1265e4901ffb80afaa36f',
        'mchId'     => 1900009851,
        'sub_appid' => '',//服务商选填
        'sub_mch_id'=> 0,//服务商必填
    ),
    'alipay' => array(
        //证书目录
        'sslPath'   => '',
        //阿里公钥文件名
        'publicKey' => '',
        //商户私钥文件名
        'sslName'   => '',
        'type'      => 'alipay',
        //回调地址
        'notifyUrl' => '',
        'appId'     => '',
        //卖家支付宝用户ID 2088102146225135  非必需
        'mchId'     => '',
    ),
);