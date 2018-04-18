<?php
/**
 * User: denn
 * Date: 2017/3/21
 * Time: 10:49
 */


require_once dirname(__FILE__) . '/Public/init.php';

//header('Location:DS/Wap/Mobi');
$result = DI()->cache->get('ds_wap_index');
if (!$result || DI()->config->get('sys.debug')) {
    ob_flush();
    ob_start();
    include API_ROOT . '/DS/Wap/Mobi/index.php';
    $result = ob_get_contents();
    ob_clean();
    DI()->cache->set('ds_wap_index', $result, CACHE_TIME);
}
echo $result;