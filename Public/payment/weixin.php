<?php
/**
 * User: denn
 * Date: 2017/4/20
 * Time: 8:40
 */

defined('URL_ROOT') || define('URL_ROOT', 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF'],2) . '/');

//写入超全局变量

$_REQUEST['service'] = 'Notify.Weixin';
require_once(dirname(__FILE__) . '/../init.php');

//装载公用接口
DI()->loader->addDirs('Common');
//DI()->logger->debug($GLOBALS['HTTP_RAW_POST_DATA']);

$api = new PhalApi();
$rs = $api->response();
$rs->output();