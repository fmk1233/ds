<?php
/**
 * $APP_NAME 统一入口
 */

require_once dirname(__FILE__) . '/Public/init.php';

session_name(SESSION_NAME);
session_start();

//装载公用接口
DI()->loader->addDirs('Common');
//装载你的接口
DI()->loader->addDirs('Admin');


DI()->request = 'Common_Request';
DI()->filter = 'Common_DifficuteMD5';



/** ---------------- 响应接口请求 ---------------- **/
/*if(isset($_GET['lang'])){
    switch ($_GET['lang']){
        case 1:
            $_SESSION['lang'] = 'zh_TW';
            break;
        case 2:
            $_SESSION['lang'] = 'en';
            break;
        default:
            $_SESSION['lang'] = 'zh_CN';
            break;
    }
}else{
    $_SESSION['lang'] = 'zh_CN';
}

SL($_SESSION['lang']);*/

$api = new PhalApi();
$rs = $api->response();
$rs->output();

