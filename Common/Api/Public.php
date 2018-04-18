<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/23
 * Time: 8:45
 */
class Api_Public extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'verify' => array(),
            'checkUserField' => array(
                'field' => array('name' => 'field', 'type' => 'string', 'require' => true),
                'value' => array('name' => 'value', 'type' => 'string', 'require' => true)
            ),
            'checkPassword' => array(
                'type' => array('name' => 'type', 'type' => 'string', 'require' => true),
                'value' => array('name' => 'value', 'type' => 'string', 'require' => true)
            ),
            'uploadImage' => array(
                'file' => array('name' => 'file', 'type' => 'file', 'min' => 0, 'max' => 1024 * 1024, 'range' => array('image/jpg', 'image/jpeg', 'image/png'), 'ext' => array('jpg', 'jpeg', 'png')),
                'path' => array('name' => 'path', 'type' => 'string', 'default' => 'image'),
                'type' => array('name' => 'json', 'type' => 'int', 'default' => '1')
            ),
            'checkBdCenter' => array(
                'username' => array('name' => 'zmd_name', 'type' => 'string', 'require' => true, 'desc' => '会员编号'),
            ),
            'log' => array(
                'memo' => array('name' => 'memo', 'type' => 'string', 'html' => true, 'require' => true, 'desc' => '日志')
            ),
            'removeFile' => array(
                'path' => array('name' => 'path', 'type' => 'string', 'require' => true, 'desc' => '文件路径')
            )
        );
    }


    /**
     * 上传图片信息
     * @desc 上传图片信息
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function uploadImage()
    {

        $result = Common_Function::upLoadImage('file', $this->path);
        if (is_array($result)) {
            if ($this->type == 0) {//CKedtior
                $callback = $_REQUEST['CKEditorFuncNum'];
                echo "<script type=\"text/javascript\">", "window.parent.CKEDITOR.tools.callFunction(" . $callback . ",'", Common_Function::GoodsPath($result['url']) . "','')", "</script>";
                exit();
            } elseif ($this->type == 1) {
                return Common_Function::GoodsPath($result['url']);
            } elseif ($this->type == 2) {
                echo json_encode(array('code' => 40000, 'data' => $result['url']));
                exit();
            } else {
                echo json_encode(array('code' => 0, 'data' => array('src' => Common_Function::GoodsPath($result['url']))));
                exit();
            }
        } else {
            if ($this->type == 0) {//CKedtior
                echo '<script>alert("' + $result + '")</script>';
                exit();
            } elseif ($this->type == 1) {
                throw new PhalApi_Exception_WrongException($result);
            } elseif ($this->type == 2) {
                echo json_encode(array('code' => 40001, 'msg' => '上传失败'));
                exit();
            } else {
                echo json_encode(array('code' => 40000, 'msg' => $result));
                exit();
            }
        }


    }


    /**
     * 返回验证码
     */
    public function verify()
    {
        ob_clean();
        Common_Image::buildImageVerify($length = 4, $mode = 1, $type = 'png', $width = 50, $height = 36);
    }

    public function checkBdCenter()
    {
        $user_model = new Model_Users();
        $user = $user_model->getInfo(array('user_name' => $this->username), 'true_name,bd_center');
        if ($user) {
            if ($user['bd_center'] > 0) {
                return $user;
            }
            throw new PhalApi_Exception_WrongException('');
        } else {
            throw new PhalApi_Exception_WrongException('');
        }
    }

    /**
     * 检验会员密码数据
     * @desc 检验会员字段数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function checkPassword()
    {
        $user_model = new Model_Users();
        $this_user['id'] = Common_Function::user_id();
        $right = false;
        if ($this->type == 'pwd') { //登陆密码
            $user = $user_model->getInfo(array('id' => $this_user['id']));
            $old_pwd = md5(md5($this->value) . $user['salt']);
            if ($old_pwd == $user['pwd']) {
                $right = true;
            }
        } else {
            $user = $user_model->getInfo(array('id' => $this_user['id']));
            $old_pwd = md5(md5($this->value) . $user['sec_salt']);
            if ($old_pwd == $user['sec_pwd']) {
                $right = true;
            }
        }
        if ($right) {
            return $user;
        } else {
            throw new PhalApi_Exception_WrongException('');
        }
    }

    /**
     * 检验会员字段数据
     * @desc 检验会员字段数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function checkUserField()
    {
        $user_model = new Model_Users();
        switch ($this->field) {
            case 'username':
                $user = $user_model->checkField('user_name', $this->value, 'true_name');
                break;
            default:
                $user = false;
        }
        if ($user) {
            return $user;
        } else {
            throw new PhalApi_Exception_WrongException('');
        }
    }

    public function removeFile()
    {
        @unlink(API_ROOT . '/Public/static' . $this->path);
    }

    public function createOrder()
    {
        try {
            DI()->payment = new Payment_Lite();
            /**
             * @var AliPayment $wechatPay
             */
            $wechatPay = DI()->payment->getPayment(DI()->config->get('sys.alipay'));
            $orderInfo = array();
            $orderInfo[PaymentProperty::$body] = 'test';
            $orderInfo[PaymentProperty::$orderId] = date("YmdHis");
            $orderInfo[PaymentProperty::$total] = 1;
            $result = $wechatPay->createPreOrder($orderInfo);
            QRcode::png($result['qr_code']);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }

    }

    public function transfer()
    {
        try {
            DI()->payment = new Payment_Lite();
            /**
             * @var AliPayment $wechatPay
             */
            $wechatPay = DI()->payment->getPayment(DI()->config->get('sys.alipay'));
            $result = $wechatPay->fundTransToaccountTransferRequest();
            var_dump($result);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }

    }

    public function log()
    {
        DI()->logger->info(html_entity_decode($this->memo));
    }

}