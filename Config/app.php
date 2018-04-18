<?php
/**
 * 请在下面放置任何您需要的应用配置
 */


return array(

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(//'sign' => array('name' => 'sign', 'require' => true),
    ),
    //位置名称，其长度对应POSNUM常量
    'posNames' => array(
        1 => 'A区',
        2 => 'B区',
    ),
    'sex' => array(
        1 => T('男'),
        2 => T('女'),
    ),
    'Wechat' => array(
        'plugins' => array(
            Wechat_InMessage::MSG_TYPE_TEXT => array('Plugin_Money'),
            Wechat_InMessage::MSG_TYPE_IMAGE => array(),
            Wechat_InMessage::MSG_TYPE_VOICE => array(),
            Wechat_InMessage::MSG_TYPE_VIDEO => array(),
            Wechat_InMessage::MSG_TYPE_LOCATION => array(),
            Wechat_InMessage::MSG_TYPE_LINK => array(),
            Wechat_InMessage::MSG_TYPE_EVENT => array('Plugin_Events'),
            Wechat_InMessage::MSG_TYPE_DEVICE_EVENT => array(),
            Wechat_InMessage::MSG_TYPE_DEVICE_TEXT => array(),
        ),
    )

);
