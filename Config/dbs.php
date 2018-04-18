<?php
/**
 * 分库分表的自定义数据库路由配置
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2015-02-09
 */

return array(
    /**
     * DB数据库服务器集群
     */
    'servers' => array(
        'db_ds' => array(                         //服务器标记
            'host'      => '127.0.0.1',             //数据库域名
            'name'      => 'ds',               //数据库名字
            'user'      => 'root',                  //数据库会员编号
            'password'  => 'root',	                    //数据库密码
            'port'      => '3306',                  //数据库端口
            'charset'   => 'UTF8',                  //数据库字符集
        ),
    ),

    'prefix'=>'ds_',

    /**
     * 自定义路由表
     */
    'tables' => array(
        //通用路由
        '__default__' => array(
            'prefix' => 'ds_',
            'key' => 'id',
            'map' => array(
                array('db' => 'db_ds'),
            ),
        ),

       /* 'bonus' => array(                                                //表名
            'prefix' => 'nm_',                                         //表名前缀
            'key' => 'id',                                              //表主键名
            'foreign'=>'uid',
            'map' => array(                                             //表路由配置
                array('db' => 'db_mmm'),                               //单表配置：array('db' => 服务器标记)
            ),
        ),*/
    ),
);
