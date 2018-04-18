<?php
/**
 * User: denn
 * Date: 2017/3/25
 * Time: 9:10
 */
define('IS_JSON',true);
// echo $_GET['echostr'];
// die();

if (!isset($GLOBALS['HTTP_RAW_POST_DATA'])) {
    die('Access denied!');
}

require_once dirname(__FILE__) . '/Public/init.php';

//装载项目代码和扩展类库
DI()->loader->addDirs(array('Common', 'Library'));

/** ---------------- 微信轻聊版 ---------------- **/

$robot = new Wechat_Lite('Xy53RZLfk556tp2PxL4Xrfr60XpruXX0', true);
$rs = $robot->response();
$rs->output();
