<?php
/**
 * 统一初始化
 */

/** ---------------- 根目录定义，自动加载 ---------------- **/
if (!headers_sent() && extension_loaded("zlib") && strstr($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) {//开启gzip压缩
    ini_set('zlib.output_compression', 'On');
    ini_set('zlib.output_compression_level', '6');
}
date_default_timezone_set('Asia/Shanghai');

ini_set('display_errors', 1);

defined('URL_ROOT') || define('URL_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . (dirname($_SERVER['PHP_SELF']) == '\\' ? '' : dirname($_SERVER['PHP_SELF'])) . '/Public/');

defined('API_ROOT') || define('API_ROOT', dirname(__FILE__) . '/..');

require_once API_ROOT . '/PhalApi/PhalApi.php';
$loader = new PhalApi_Loader(API_ROOT, 'Library');

/** ---------------- 注册&初始化 基本服务组件 ---------------- **/

//自动加载
DI()->loader = $loader;

//配置
DI()->config = new PhalApi_Config_File(API_ROOT . '/Config');

//调试模式，$_GET['__debug__']可自行改名
DI()->debug = !empty($_GET['__debug__']) ? true : DI()->config->get('sys.debug');

//日记纪录
DI()->logger = new PhalApi_Logger_File(API_ROOT . '/Runtime', PhalApi_Logger::LOG_LEVEL_DEBUG | PhalApi_Logger::LOG_LEVEL_INFO | PhalApi_Logger::LOG_LEVEL_ERROR);

//数据操作 - 基于NotORM，$_GET['__sql__']可自行改名
DI()->notorm = new PhalApi_DB_NotORM(DI()->config->get('dbs'), !empty($_GET['__sql__']));

if (!defined('IS_JSON')) {
    $accept = DI()->request->getHeader('Accept');
    $accept = explode(',', $accept);
    $accept = $accept[0];
    if ($accept == 'application/json') {
        defined('IS_JSON') || define('IS_JSON', true);
    } else {
        defined('IS_JSON') || define('IS_JSON', false);
        DI()->response = 'PhalApi_Response_Explorer';
    }
}

DI()->config->get('constant');


//翻译语言包设定
SL('zh_CN');

/** ---------------- 定制注册 可选服务组件 ---------------- **/

/**
 * //签名验证服务
 * DI()->filter = 'PhalApi_Filter_SimpleMD5';
 */


//缓存 - Memcache/Memcached
DI()->cache = function () {
    return new PhalApi_Cache_File(DI()->config->get('sys.file'));
//    return new PhalApi_Cache_Memcache(DI()->config->get('sys.mc'));
};


/**
 * //支持JsonP的返回
 * if (!empty($_GET['callback'])) {
 * DI()->response = new PhalApi_Response_JsonP($_GET['callback']);
 * }
 */
