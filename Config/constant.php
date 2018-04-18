<?php
/**
 * 系统常量表
 */

defined('THEME') || define('THEME', 'Technology');//前台主题 Default Technology
defined('DB_PREFIX') || define('DB_PREFIX', 'ds_');//数据库前缀
defined('DB_DS') || define('DB_DS', 'db_ds');//数据库事务
defined('SECONDPASS') || define('SECONDPASS', md5('akdsfjasdjfasjdflkj'));//数据库前缀
defined('NOW_TIME') || define('NOW_TIME', isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time());//数据库前缀
//钱包类型定义
defined('BONUS_PDB') || define('BONUS_PDB', 2);
defined('BONUS_STC') || define('BONUS_STC', 0);//余额
defined('BONUS_DNC') || define('BONUS_DNC', 1);
defined('BONUS_JHB') || define('BONUS_JHB', 3);//报单币
defined('BONUS_GW') || define('BONUS_GW', 4);//购物币
defined('BONUS_BJ') || define('BONUS_BJ', 5);
defined('BONUS_NAME') || define('BONUS_NAME', 'b');

//钱包金额统计类型定义 type
//余额钱包
defined('BONUS_TYPE_STC') || define('BONUS_TYPE_STC', 0);//
defined('BONUS_TYPE_STC_K') || define('BONUS_TYPE_STC_K', 1);//余额提现
defined('BONUS_TYPE_STC_RW') || define('BONUS_TYPE_STC_RW', 2);//余额奖金
defined('BONUS_TYPE_STC_CZ') || define('BONUS_TYPE_STC_CZ', 3);//余额充值
defined('BONUS_TYPE_STC_CX') || define('BONUS_TYPE_STC_CX', 4);//
defined('BONUS_TYPE_STC_JD') || define('BONUS_TYPE_STC_JD', 5);//
defined('BONUS_TYPE_STC_ZR') || define('BONUS_TYPE_STC_ZR', 6);//余额转入
defined('BONUS_TYPE_STC_ZC') || define('BONUS_TYPE_STC_ZC', 7);//余额转出
defined('BONUS_TYPE_STC_UP') || define('BONUS_TYPE_STC_UP', 8);//会员升级
//直推钱包

/*暂时无用*/
//defined('BONUS_TYPE_DNC') || define('BONUS_TYPE_DNC', 10);//接受帮助扣除直推钱包
defined('BONUS_TYPE_DNC_CZ') || define('BONUS_TYPE_DNC_CZ', 13);//直推钱包充值
defined('BONUS_TYPE_DNC_K') || define('BONUS_TYPE_DNC_K', 11);//接受帮助扣除直推钱包
defined('BONUS_TYPE_DNC_RW') || define('BONUS_TYPE_DNC_RW', 12);//直推钱包奖金
defined('BONUS_TYPE_DNC_RWF') || define('BONUS_TYPE_DNC_RWF', 14);//直推奖金福利
defined('BONUS_TYPE_DNC_JD') || define('BONUS_TYPE_DNC_JD', 15);//直推奖自动解冻会员扣除
//排单币
defined('BONUS_TYPE_KPDB') || define('BONUS_TYPE_KPDB', 20);//提供帮助扣除躺赚奖
defined('BONUS_TYPE_PDB_CZ') || define('BONUS_TYPE_PDB_CZ', 23);//躺赚奖充值
defined('BONUS_TYPE_PDB_ZR') || define('BONUS_TYPE_PDB_ZR', 22);//躺赚奖转入
defined('BONUS_TYPE_PDB_ZC') || define('BONUS_TYPE_PDB_ZC', 21);//扣除躺赚奖转出
defined('BONUS_TYPE_PDB_RW') || define('BONUS_TYPE_PDB_RW', 24);//躺赚奖金
/*暂时无用*/
//报单币
defined('BONUS_TYPE_KJHB') || define('BONUS_TYPE_KJHB', 30);//激活会员扣除报单币
defined('BONUS_TYPE_JHB_CZ') || define('BONUS_TYPE_JHB_CZ', 33);//报单币充值
defined('BONUS_TYPE_JHB_ZR') || define('BONUS_TYPE_JHB_ZR', 32);//报单币转入
defined('BONUS_TYPE_JHB_ZC') || define('BONUS_TYPE_JHB_ZC', 31);//报单币转出

//购物币
//defined('BONUS_TYPE_GW') || define('BONUS_TYPE_GW', 40);//购物币，挖矿
defined('BONUS_TYPE_GW_CZ') || define('BONUS_TYPE_GW_CZ', 43);//购物币充值
defined('BONUS_TYPE_GW_RW') || define('BONUS_TYPE_GW_RW', 42);//购物币充值
defined('BONUS_TYPE_GW_SP') || define('BONUS_TYPE_GW_SP', 41);//购物币购物
defined('BONUS_TYPE_GW_ZR') || define('BONUS_TYPE_GW_ZR', 44);//购物币转入
defined('BONUS_TYPE_GW_ZC') || define('BONUS_TYPE_GW_ZC', 45);//购物币转出

defined('BONUS_TYPE_BJ_K') || define('BONUS_TYPE_BJ_K', 51);//接受帮助扣除本金

//订单类型
defined('ORDER_TYPE_BUY') || define('ORDER_TYPE_BUY', 0);//提供帮助订单
defined('ORDER_TYPE_SALE') || define('ORDER_TYPE_SALE', 1);//接受帮助订单

//奖金是否冻结
defined('BONUS_FREZZE') || define('BONUS_FREZZE', 1);
defined('BONUS_UNFREZZE') || define('BONUS_UNFREZZE', 0);

//会员状态常量值
defined('USER_STATE_UNPAY') || define('USER_STATE_UNPAY', 0);
defined('USER_STATE_ACT') || define('USER_STATE_ACT', 1);
defined('USER_STATE_FRE') || define('USER_STATE_FRE', 2);

//日志类型常量
defined('LOG_SYS') || define('LOG_SYS', 0);
defined('LOG_ADMIN') || define('LOG_ADMIN', 1);
defined('LOG_USERS') || define('LOG_USERS', 2);

//商品订单状态
defined('ORDER_WAIT_PAY') || define('ORDER_WAIT_PAY', 0);//等待付款
defined('ORDER_PAYED') || define('ORDER_PAYED', 1);//等待发货
defined('ORDER_SHIPPING') || define('ORDER_SHIPPING', 2);//等待收货
defined('ORDER_FINISHED') || define('ORDER_FINISHED', 3);//订单完成
defined('ORDER_CANCEL') || define('ORDER_CANCEL', 4);//取消订单
defined('ORDER_REFUND') || define('ORDER_REFUND', 5);//退货

defined('POSNUM') || define('POSNUM', 2);//几轨制度，1代表太阳线
defined('RANKNUM') || define('RANKNUM', 5);//会员级别个数，2代表三个级别
defined('AUTO_REG') || define('AUTO_REG', false);//是否存在公排
defined('PAGENUM') || define('PAGENUM', 10);


defined('IS_AJAX') || define('IS_AJAX', ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) ? true : false);

defined('PASSTWOTOKEN') || define('PASSTWOTOKEN', 'juejrk3377jksafk');

defined('ADMIN_SEC_PWD') || define('ADMIN_SEC_PWD', 'admin_sec_pwd99');

//审核状态常量
defined('CHECK_SUBMIT') || define('CHECK_SUBMIT', 0);
defined('CHECK_PASS') || define('CHECK_PASS', 1);
defined('CHECK_REFUSE') || define('CHECK_REFUSE', 2);

//充值类型常量
defined('RECHARGE_SYS') || define('RECHARGE_SYS', 1);//系统充值
defined('RECHARGE_WECHAT') || define('RECHARGE_WECHAT', 2);//微信充值
defined('RECHARGE_ALIPAY') || define('RECHARGE_ALIPAY', 3);//支付宝充值


defined('BASE_KEY') || define('BASE_KEY', '223ce2bfc7a1a14b28d854fbcff07b66');
defined('CAN_BD') || define('CAN_BD', true);//普通用户是否可以报单
defined('USER_CAN_BD') || define('USER_CAN_BD', true);//普通用户是否可以报单

defined('ADMIN_TOKEN') || define('ADMIN_TOKEN', '589bc2dc861125ca92a1d274a6ea7f4d');//后台登录SESSION key值，不同的项目请更改此处

defined('SESSION_NAME') || define('SESSION_NAME', '589bc2dc861125ca92a1d274a6ea7fde');

defined('CACHE_TIME') || define('CACHE_TIME', 259200);


