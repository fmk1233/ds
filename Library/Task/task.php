<?php
/**
 * bat 命令格式 php.exe文件目录 调用PHP文件目录 -a 执行类型 H:\php.exe  F:\WWW\task.php -a day
 */


$_SERVER['HTTP_ACCEPT_ENCODING'] = '';
$_SERVER['HTTP_HOST'] = '127.0.0.1';
$_SERVER['PHP_SELF'] = '/';

require_once dirname(__FILE__) . '/../../Public/init.php';

//装载公用接口
DI()->loader->addDirs('Common');
if (count($_GET) > 0) {
    $param_arr = $_GET;
} else {
    $param_arr = getopt('a:n:u:');

}
$_SERVER['argv'][0] = $param_arr['a'];
if (isset($param_arr['n'])) {
    $_SERVER['argv'][1] = $param_arr['n'];
} else {
    $_SERVER['argv'][1] = 0;
}
if (isset($param_arr['u'])) {
    $_SERVER['argv'][2] = $param_arr['u'];
} else {
    $_SERVER['argv'][2] = '';
}

if (empty($_SERVER['argv'][0])) exit('Access Invalid!');
set_time_limit(0);
ignore_user_abort(true);
try {
    switch ($_SERVER['argv'][0]) {
        case 'day':
            new Domain_Reward('day');//日结算
            break;
        case 'month':
            new Domain_Reward('month');//月结算
            break;
        case 'reg':
            $param_arr = getopt('a:n:u:');
            Domain_Users::batchReg($_SERVER['argv'][1], $_SERVER['argv'][2]);
            break;
    }

} catch (Exception $e) {
    echo $e->getMessage();
}

