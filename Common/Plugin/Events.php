<?php

/**
 * User: denn
 * Date: 2017/3/25
 * Time: 10:26
 */
class Plugin_Events implements Wechat_Plugin_Event
{

    public function handleEvent($inMessage, &$outMessage)
    {
        $outMessage = new Wechat_OutMessage_Text();
//        $outMessage->setContent(var_export($inMessage,true));

        switch ($inMessage->getEventType()) {
            //关注
            case 'subscribe':
                if ($inMessage->getEventKey() && $inMessage->getTicket()) {
                    //二维码关注
                } else {
                    //普通关注
                }
                break;
            case 'scan':
                //扫描二维码
                break;
            case 'location':
                //地理位置
                break;
            case 'click':
                //自定义菜单 - 点击菜单拉取消息时的事件推送
                break;
            case 'view':
                //自定义菜单 - 点击菜单跳转链接时的事件推送
                break;
            case 'scancode_push':
                //自定义菜单 - 扫码推事件的事件推送
                break;
            case 'scancode_waitmsg':
                //自定义菜单 - 扫码推事件且弹出“消息接收中”提示框的事件推送
                break;
            case 'pic_sysphoto':
                //自定义菜单 - 弹出系统拍照发图的事件推送
                break;
            case 'pic_photo_or_album':
                //自定义菜单 - 弹出拍照或者相册发图的事件推送
                break;
            case 'pic_weixin':
                //自定义菜单 - 弹出微信相册发图器的事件推送
                break;
            case 'location_select':
                //自定义菜单 - 弹出地理位置选择器的事件推送
                break;
            case 'unsubscribe':
                //取消关注
                break;
            case 'masssendjobfinish':
                //群发接口完成后推送的结果
                break;
            case 'templatesendjobfinish':
                //模板消息完成后推送的结果
                break;
            default:
                break;
        }
    }

}