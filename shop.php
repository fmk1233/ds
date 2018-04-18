<?php
/**
 * $APP_NAME 统一入口
 */

require_once dirname(__FILE__) . '/Public/init.php';

session_name(SESSION_NAME);
session_start();

DI()->request = 'Common_Request';
DI()->filter = 'Common_DifficuteMD5';

//装载公用接口
DI()->loader->addDirs('Common');

//装载你的接口
DI()->loader->addDirs('Shop');


$api = new PhalApi();
$rs = $api->response();
$rs->output();

