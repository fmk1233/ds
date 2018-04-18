<?php
/**
 * $APP_NAME 统一入口
 */

require_once dirname(__FILE__) . '/Public/init.php';

$result = DI()->cache->get('shop_index');
if (!$result || DI()->config->get('sys.debug')) {
    ob_flush();
    ob_start();
    include API_ROOT . '/Shop/Mobi/index.php';
    $result = ob_get_contents();
    ob_clean();
    DI()->cache->set('shop_index', $result, CACHE_TIME);
}
echo $result;
