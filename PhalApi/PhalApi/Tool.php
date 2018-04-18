<?php
/**
 * PhalApi_Tool 工具集合类
 *
 * 只提供通用的工具类操作，目前提供的有：
 *
 * - IP地址获取
 * - 随机字符串生成
 *
 * @package     PhalApi\Tool
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2015-02-12
 */

class PhalApi_Tool {

    /**
     * IP地址获取
     *
     * @return string 如：192.168.1.1 失败的情况下，返回空
     */
    public static function getClientIp() {
        $unknown = 'unknown';

        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)) {
            $ip = getenv('REMOTE_ADDR');
        } else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '';
        }

        return $ip;
    }

    /**
     * 随机字符串生成
     *
     * @param int $len 需要随机的长度，不要太长
     * @return string
     */
    public static function createRandStr($len) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($chars, rand(5, 8))), 0, $len);
    }


    /**
     * @param string $data
     * @return string
     */
    public static function decode($data){
        $privateKey = '@fdskalhfj2387A!';
        $iv =   '@fdfpu+adj2387A!';
        $encryptedData=base64_decode($data);
        $decrypted=mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$privateKey,$encryptedData,MCRYPT_MODE_CBC,$iv);
        $decrypted=rtrim($decrypted,"\0");//解密出来的数据后面会出现如图所示的六个红点；这句代码可以处理掉，从而不影响进一步的数据操作
        return $decrypted;
    }

    /**
     * @param string $data
     * @return string
     */
    public static function encode($data){
        $privateKey = '@fdskalhfj2387A!';
        $iv =   '@fdfpu+adj2387A!';
        $encrypted=mcrypt_encrypt(MCRYPT_RIJNDAEL_128,$privateKey,$data,MCRYPT_MODE_CBC,$iv);
        $encode = base64_encode($encrypted);
        return $encode;
    }


    public static function is_mobile_request()
    {
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
            $mobile_browser++;
        if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
            $mobile_browser++;
        if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
            $mobile_browser++;
        if(isset($_SERVER['HTTP_PROFILE']))
            $mobile_browser++;
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
        $mobile_agents = array(
            'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
            'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
            'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
            'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
            'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
            'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
            'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
            'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
            'wapr','webc','winw','winw','xda','xda-'
        );
        if(in_array($mobile_ua, $mobile_agents))
            $mobile_browser++;
        if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
            $mobile_browser++;
// Pre-final check to reset everything if the user is on Windows
        if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
            $mobile_browser=0;
// But WP7 is also Windows, with a slightly different characteristic
        if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
            $mobile_browser++;
        if($mobile_browser>0)
            return true;
        else
            return false;
    }


    public static function showErrorMsg($msg){
//        echo '<link href="', URL_ROOT,'/static/js/plugins/layui/css/layui.css" rel="stylesheet">';
        echo '<meta charset="UTF-8"><script src="', URL_ROOT,'/static/js/plugins/layui/layui.js"></script>';
        echo '<script type="text/javascript">
                layui.use("layer",function() {
                  var layer = layui.layer;
                  layer.alert("',$msg,'",{title:"提示"},function(index){
                        history.back(-1);
                        layer.close(index);
                   });
                });
              </script>';
        exit;
    }

}
