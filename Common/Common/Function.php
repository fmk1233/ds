<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/9/18
 * Time: 10:05
 */
define('IOS', '2');
define('ANDROID', '1');
define('OTHER', '3');

class Common_Function
{

    /**
     * 检测值是否存在
     * @param $value 输入值
     * @return string 输出值
     */
    public static function issetValue($value)
    {
        return isset($value) ? $value : '';
    }

    /**
     * 获取会员报单金额
     * @return array 会员报单金额
     */
    public static function getBdmoney($rank = false)
    {
        $moneys = DI()->config->get('setting.money');
        if ($rank === false) {
            return $moneys;
        } else {
            return $moneys[$rank];
        }

    }


    public static function getSexName($sex = false)
    {

        $sexs = DI()->config->get('app.sex');
        if ($sex === false) {
            return $sexs;
        } else {
            return $sexs[$sex];
        }
    }

    /**
     * 获取会员等级名称数据
     * @return array 会员名称数组
     */
    public static function getRankName($rank = false)
    {
        $ranks = DI()->config->get('setting.rank_name');
        if ($rank === false) {
            return $ranks;
        } else {
            return T($ranks[$rank]);
        }

    }

    /**
     * 会员奖金转换规则
     * @return array 规则参数
     */
    public static function BonusTransferParams()
    {
        $fee = DI()->config->get('setting.bouns_transfer_fee');
        return array(
            'rule' => 1,
            'fee' => 0
        );
    }

    /**
     * 获取会员报单中心数据
     * @return array 会员报单中心数组
     */
    public static function getBdCenterName($rank = false)
    {
        $bd_center = array(
            0 => '无',
            1 => '报单中心',
        );
        if ($rank === false) {
            return $bd_center;
        } else {
            return T($bd_center[$rank]);
        }

    }


    /**
     * 获取会员升级类型名称数据
     * @return array 会员会员升级类型数组
     */
    public static function upgradeName($up_type = false)
    {
        $up_names = array(
            0 => '后台提交',
            1 => '正常升级',
        );
        if ($up_type === false) {
            return $up_names;
        } else {
            return T($up_names[$up_type]);
        }
    }

    /**
     * 获取位置名称数据
     * @return array 会员位置数组
     */
    public static function getPosName($pos = false)
    {
        $pos_names = DI()->config->get('app.posNames');
        if ($pos === false) {
            return $pos_names;
        } else {
            if ($pos == 0) {
                return '';
            }
            return T($pos_names[$pos]);
        }
    }

    public static function rankColor($rank = false, $state = false)
    {
        $rank_color = array(
            '#8b8484', '#009999', '#8891ed', '#ff6700', '#aa3939', '#336699', '#FFCC00', '#FF9900'
        );

        if ($state === false && $rank === false) {
            return $rank_color;
        }
        if ($state == 0) {
            return $rank_color[0];
        }
        return $rank_color[$rank + 1];
    }

    /**
     * 获取钱包名称数据
     * @return array 会员钱包名称数据
     */
    public static function getBonusName($money_type = false)
    {
        $bonus_names = array(
            BONUS_STC => T('比特币'),
//            BONUS_JHB => T('报单币'),
//            BONUS_GW => T('购物币'),
        );
        if ($money_type === false) {
            return $bonus_names;
        } else {
            return $bonus_names[$money_type];
        }

    }


    /**
     * 获取审核状态名称
     * @param int $status
     * @return string 会员名称
     */
    public static function getCheckName($status = false)
    {
        $check_names = array(
            0 => T('未审核'),
            1 => T('审核通过'),
            2 => T('拒绝'),
        );
        if ($status === false) {
            return $check_names;
        } else {
            return $check_names[$status];
        }
    }


    /**
     * 会员充值规则
     * @return array 规则参数
     */
    public static function rechargeParams()
    {
        return array(
            'rule' => 1
        );
    }

    /**
     * 会员提现规则
     * @return array 规则参数
     */
    public static function cashParams()
    {
        $fee = DI()->config->get('setting.cash_fee');
        return array(
            'rule' => 1,
            'fee' => 0
        );
    }

    /**
     * 会员转账规则
     * @return array 规则参数
     */
    public static function transferParams()
    {
        return array(
            'rule' => 1,
            'fee' => 0
        );
    }

    /**
     * 拼接联合查询sql语句条件
     * @param $conditions 查询条件 例如 $where['u.id=?']=1;$where['type>=?']=1
     * @param bool $where_flag 是否拼接 sql where条件
     * @return array 返回sql 语句和查询条件 返回结果例如 array('sql'=>' u.id=? and type>=?','params'=>array(1,1))
     */
    public static function parseSearchWhere($conditions, $where_flag = false, $trim = true)
    {
        $where = array();
        $where['sql'] = '';
        $where['params'] = array();
        $keys = '';

        foreach ($conditions as $key => $condition) {//循环拼接sql语句
            $keys .= $key . ' and ';
            $where['params'][] = $condition;
        }
        if ($trim) {
            $keys = trim($keys, 'and ');
        }
        if ($where_flag && $keys) {//判断查询条件是否需要where语句，需要加上where
            $where['sql'] = ' where ';
        }
        $where['sql'] .= $keys;
        return $where;
    }

    public static function lock($id = 1)
    {
        $lockModel = new Model_Lock();
        $lock = $lockModel->get($id);
        set_time_limit(0);
        ignore_user_abort(true);
        if ($lock['state'] == 0) {
            $result = $lockModel->updateStateByTimeAndState($lock['rdt'], 0, $id);
            if ($result) {
                register_shutdown_function('Common_Function::unlock', $id);
                return true;
            } else {
                return false;
            }
        } elseif (NOW_TIME - $lock['rdt'] > 3600 * 2) {
            $lockModel->updateStateByTimeAndState($lock['rdt'], 1, $id);
            return false;
        }
        return false;
    }

    public static function unlock($id = 1)
    {
        $lockModel = new Model_Lock();
        $lock = $lockModel->get($id);
        if ($lock['state'] == 1) {
            $lockModel->updateStateByTimeAndState($lock['rdt'], 1, $id);
        }
    }


    public static function strReplace($str, $start = 3, $end = 0, $replace = '*')
    {
        $length = mb_strlen($str, 'utf-8') - $start - $end;
        if ($length < 0) {
            return $str;
        }
        $replaces = '';
        for ($i = 0; $i < $length; $i++) {
            $replaces .= $replace;
        }
        return substr_replace($str, $replaces, $start, mb_strlen($str, 'utf-8') - $end - $start);
    }

    public static function sendSMS($mobile, $message)
    {
        /* $message1 = iconv("UTF-8", "GBK", $message);
         $CorpID = "301917";
         $LoginName = "yixtc";
         $Password = "196632";
         $gateway = "http://sms3.mobset.com/SDK/Sms_Send.asp?CorpID={$CorpID}&Passwd={$Password}&LoginName={$LoginName}&send_no={$mobile}&msg={$message1}&longsms=1";
         $ch = curl_init();
         $timeout = 30;
         curl_setopt($ch, CURLOPT_URL, $gateway);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
         try {
             $file_contents = curl_exec($ch);
         } catch (Exception $e) {
             $file_contents = "0,12222";
         }
         curl_close($ch);

         return explode(',', $file_contents);*/
    }

    /**
     * Create a Random String
     *
     * Useful for generating passwords or hashes.
     *
     * @access    public
     * @param    string    type of random string.  basic, alpha, alunum, numeric, nozero, unique, md5, encrypt and sha1
     * @param    integer    number of characters
     * @return    string
     */
    public static function randomString($type = 'alnum', $len = 8)
    {
        switch ($type) {
            case 'basic'    :
                return mt_rand();
                break;
            case 'alnum'    :
            case 'numeric'    :
            case 'nozero'    :
            case 'Salpha'    :
            case 'alpha':

                switch ($type) {
                    case 'alpha'    :
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum'    :
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric'    :
                        $pool = '0123456789';
                        break;
                    case 'nozero'    :
                        $pool = '123456789';
                        break;
                    case 'Salpha':
                        $pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                }

                $str = '';
                for ($i = 0; $i < $len; $i++) {
                    $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
                }
                return $str;
                break;
            case 'unique'    :
            case 'md5'        :

                return md5(uniqid(mt_rand()));
                break;
        }
    }

    public static function getip()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset ($_SERVER ['REMOTE_ADDR']) && $_SERVER ['REMOTE_ADDR'] && strcasecmp($_SERVER ['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER ['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return ($ip);
    }

    public static function getDeviceType()
    {
        if (stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
            return IOS;
        } else if (stripos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false) {
            return ANDROID;
        } else {
            return OTHER;
        }
    }


    /**
     * utf8字符转Unicode字符
     * @param string $char 要转换的单字符
     * @return void
     */
    public static function utf8_to_unicode($char)
    {
        switch (strlen($char)) {
            case 1:
                return dechex(ord($char));
            case 2:
                $n = (ord($char[0]) & 0x3f) << 6;
                $n += ord($char[1]) & 0x3f;
                return dechex($n);
            case 3:
                $n = (ord($char[0]) & 0x1f) << 12;
                $n += (ord($char[1]) & 0x3f) << 6;
                $n += ord($char[2]) & 0x3f;
                return dechex($n);
            case 4:
                $n = (ord($char[0]) & 0x0f) << 18;
                $n += (ord($char[1]) & 0x3f) << 12;
                $n += (ord($char[2]) & 0x3f) << 6;
                $n += ord($char[3]) & 0x3f;
                return dechex($n);
        }
    }

    /**
     * utf8字符串分隔为unicode字符串
     * @param string $str 要转换的字符串
     * @param string $depart 分隔,默认为空格为单字
     * @return string
     */
    public static function str_to_unicode_word($str, $depart = ' ')
    {
        $arr = array();
        $str_len = mb_strlen($str, 'utf-8');
        for ($i = 0; $i < $str_len; $i++) {
            $s = mb_substr($str, $i, 1, 'utf-8');
            if ($s != ' ' && $s != '　') {
                $arr[] = 'ux' . self::utf8_to_unicode($s);
            }
        }
        return implode($depart, $arr);
    }


    /**
     * utf8字符串分隔为unicode字符串
     * @param string $str 要转换的字符串
     * @return string
     */
    public static function str_to_unicode_string($str)
    {
        $string = self::str_to_unicode_word($str, '');
        return $string;
    }

    /**
     * 获取登录管理员id
     * @return int
     */
    public static function admin_id()
    {
        if (isset($_SESSION[ADMIN_TOKEN])) {
            $user = Common_Function::decode($_SESSION[ADMIN_TOKEN]);
            $user = json_decode($user);
            if (isset($_SESSION['adminToken']) && $_SESSION['adminToken'] == $user->token) {
                return $user->id;
            }
            unset($_SESSION[ADMIN_TOKEN]);
            return 0;
        }
        return 0;
    }

    /**
     * 获取登录管理员信息实体
     * @return int|mixed|string
     */
    public static function admin()
    {
        if (isset($_SESSION[ADMIN_TOKEN])) {
            $user = Common_Function::decode($_SESSION[ADMIN_TOKEN]);
            $user = json_decode($user, true);
            if (isset($_SESSION['adminToken']) && $_SESSION['adminToken'] == $user['token']) {
                return $user;
            }
            unset($_SESSION[ADMIN_TOKEN]);
            return 0;
        }
        return 0;
    }

    public static function user_id()
    {
        if (isset($_SESSION[md5('@#mmusers!')])) {
            $user = Common_Function::decode($_SESSION[md5('@#mmusers!')]);
            $user = json_decode($user);

            if (isset($_SESSION['token']) && $_SESSION['token'] == $user->token) {
                return intval($user->id);
            }
            unset($_SESSION[md5('@#mmusers!')]);
            return 0;
        }
        return 0;
    }


    public static function user()
    {
        if (isset($_SESSION[md5('@#mmusers!')])) {
            $user = Common_Function::decode($_SESSION[md5('@#mmusers!')]);
            $user = json_decode($user, true);
            if (isset($_SESSION['token']) && $_SESSION['token'] == $user['token']) {
                return $user;
            }
            unset($_SESSION[md5('@#mmusers!')]);
            return 0;
        }
        return 0;
    }

    /**
     * @param string $data
     * @return string
     */
    public static function decode($data)
    {
        $privateKey = '@fdskalhfj2387A!';
        $iv = '@fdfpu+adj2387A!';
        $encryptedData = base64_decode($data);
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
        $decrypted = rtrim($decrypted, "\0");//解密出来的数据后面会出现如图所示的六个红点；这句代码可以处理掉，从而不影响进一步的数据操作
        return $decrypted;
    }

    /**
     * @param string $data
     * @return string
     */
    public static function encode($data)
    {
        $privateKey = '@fdskalhfj2387A!';
        $iv = '@fdfpu+adj2387A!';
        $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data, MCRYPT_MODE_CBC, $iv);
        $encode = base64_encode($encrypted);
        return $encode;
    }

    public static function url($params, $encode = true)
    {
        if($encode){
            if (count($params) > 0) {
                ksort($params);
                $paramsStrExceptSign = str_replace('&quot;', '"', urldecode(http_build_query($params)));
            } else {
                $paramsStrExceptSign = '';
            }
            $params = Common_Function::encode(json_encode($params));
            $token = md5($params);

            $sign = md5(md5($paramsStrExceptSign) . BASE_KEY);
            return '?params=' . urlencode($params) . '&token=' . $token . '&sign=' . $sign;
        }else{
            return '?'.http_build_query($params);
        }
    }

    public static function sign($encode)
    {
        $token = md5(microtime(true) . rand(1000, 9999));
        $_SESSION[$encode] = $token;
        setcookie($encode, $token, time() + 24 * 3600, '/');
    }

    public static function GoodsPath($imagePath)
    {
        return URL_ROOT . 'static' . $imagePath;
    }

    public static function upLoadImage($fileName, $path)
    {
        if ($_FILES[$fileName]["error"] > 0) {
            return T('上传图片失败: {error}', array('error' => $_FILES[$fileName]['error']));
        } else {
            list ($width, $height, $type, $attr) = getimagesize($_FILES [$fileName] ['tmp_name']);
            switch ($type) {
                case 1 :
                    $ext = ".GIF";
                    break;
                case 2 :
                    $ext = ".JPG";
                    break;
                case 3 :
                    $ext = ".PNG";
                    break;
                default :
                    $ext = "...";
                    break;
            }
            if ($ext == '...') {
                return T('图片格式错误');
            }

            $info = '/upload/' . $path . '/' . date('Ym');
            $dir = API_ROOT . '/Public/static' . $info;
            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }

            $url = '/' . Common_Function::randomString('unique') . $ext;
            if (!@move_uploaded_file($_FILES[$fileName]['tmp_name'], $dir . $url)) {
                return T('上传失败');
            }
            @unlink($_FILES[$fileName]['tmp_name']);
            return array('url' => $info . $url);
        }
    }


    public static function deleteAllDir($path)
    {
        $op = dir($path);
        while (false != ($item = $op->read())) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (is_dir($op->path . '/' . $item)) {
                self::deleteAllDir($op->path . '/' . $item);
                rmdir($op->path . '/' . $item);
            } else {
                unlink($op->path . '/' . $item);
            }

        }
    }

    public static function moveImage($from, $to)
    {
        $dir = API_ROOT . '/Public/static';
        if (file_exists($dir . $from)) {
            $names = explode('/', $from);
            $info = '/upload/' . $to . '/' . date('Ym');
            if (!file_exists($dir . $info)) {
                mkdir($dir . $info, 0777);
            }
            $name = $names[count($names) - 1];
            if (!@copy($dir . $from, $dir . $info . '/' . $name)) {
                return T('上传失败');
            }
            @unlink($dir . $from);
            return array('url' => $info . '/' . $name);
        }
        return T('上传失败');

    }

    public static function png($id, $logo = '')
    {
        // 二维码数据
        $data = URL_ROOT . Common_Function::url(array('service' => 'UPublic.register', 'uid' => $id));

// 生成的文件名
        $filename = $id . '.png';

// 纠错级别：L、M、Q、H
        $errorCorrectionLevel = 'L';

// 点的大小：1到10
        $matrixPointSize = 4;
        $info = '/upload/reg/';
        $dir = API_ROOT . '/Public/static' . $info;


        if (!file_exists($dir)) {
            mkdir($dir, 0777);
        }
        $file = $dir . $filename;
        if (!file_exists($file)) {
            QRcode::png($data, $file, $errorCorrectionLevel, $matrixPointSize, 2);
        }
        if (!empty($logo) && file_exists($file)) {
            $logo = imagecreatefromstring(file_get_contents(API_ROOT . '/Public/static' . $logo));
            $qrcode = imagecreatefromstring(file_get_contents($file));
            $QR_width = imagesx($qrcode);//二维码图片宽度
            $QR_height = imagesy($qrcode);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
//重新组合图片并调整大小
            imagecopyresampled($qrcode, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
//保存生成的二维码
            imagepng($qrcode, $file);
        }
        return self::GoodsPath($info . $filename);
    }

    public static function numberFormat($price)
    {
        return number_format($price, 2, '.', ' ');
    }


    /**
     * 获取省市区的名称
     * @param $province 省
     * @param $city     市
     * @param $area     区
     */
    public static function getAddress($province_id, $city_id, $area_id)
    {
        $citys = file_get_contents(API_ROOT . '/Public/static/js/city.js');
        $citys = str_replace('var cityData3 = ', '', $citys);
        $cityDatas = json_decode($citys, true);
        $areas = array('province' => '', 'city' => '', 'area' => '');
        foreach ($cityDatas as $province) {
            if ($province['value'] == $province_id) {
                $areas['province'] = $province['text'];
                foreach ($province['children'] as $city) {
                    if ($city['value'] == $city_id) {
                        $areas['city'] = $city['text'];
                        foreach ($city['children'] as $area) {
                            if ($area['value'] == $area_id) {
                                $areas['area'] = $area['text'];
                                break;
                            }
                        }
                        break;
                    }
                }
                break;
            }
        }
        return $areas;

    }


    /**
     *  清除底部页面缓存
     */
    public static function delShopFooterCache()
    {
        DI()->cache->delete('shop_footer');
    }


}
