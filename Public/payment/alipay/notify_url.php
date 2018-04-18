<?php
/**
 * 支付宝通知地址
 *
 */
defined('URL_ROOT') || define('URL_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'],3) . '/');

$_REQUEST['service'] = 'Notify.Alipay';
require_once(dirname(__FILE__) . '/../../init.php');

//装载公用接口
DI()->loader->addDirs('Common');

$api = new PhalApi();
$rs = $api->response();
$rs->output();

/*error_reporting(7);
$_GET['c']	= 'payment';
$_GET['a']		= 'notify';
$_GET['payment_code'] = 'alipay';
require_once(dirname(__FILE__).'/../../../index.php');*/
?>