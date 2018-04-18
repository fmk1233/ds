<?php

/**
 * User: denn
 * Date: 2017/3/10
 * Time: 8:43
 */
class Api_Common extends PhalApi_Api
{

    public function __construct()
    {
        $this->checkUser();
    }

    protected function assign($name, $data)
    {
        $this->data[$name] = $data;
    }

    public function checkUser()
    {
        $service = DI()->request->get('service', 'Default.Index');
        if (stripos('Default.DoLogin,Default.GetOpenid', $service) === false) {
            $user_token = DI()->request->getHeader('Usertoken', '');
            if ($user_token) {
                $token_model = new Model_UserToken();
                $user_id = $token_model->getInfo(array('token' => $user_token), 'user_id');
                $user_model = new Model_Users();
                $user = $user_model->get(intval($user_id['user_id']));
                if (empty($user)) {
                    throw new PhalApi_Exception_WrongException('您的账号已在其他设备登陆', 2);//40003没有登录
                }
                $user['id'] = intval($user['id']);
                if (strtolower($service) !== 'user.pwdedit') {
                    unset($user['pwd'], $user['sec_pwd'], $user['salt'], $user['sec_salt']);
                }
                $user['rank_name'] = Common_Function::getRankName($user['rank']);
                $this->data['user'] = $user;
            } else {

                $shop_mobile = DI()->request->getHeader('Mobile');
                $not_login_service = 'Goods.GetGoodsCategory,Goods.GetGoodsInfoList,Goods.GoodsDetail,Shop.Main,Goods.GetCartCount,Goods.GetGoodsCategoryByPid,';
                if (empty($shop_mobile) || stripos($not_login_service, $service . ',') === false) {
                    throw new PhalApi_Exception_WrongException('请登陆', 2);//40003没有登录
                }
                $this->data['user'] = array('id' => 0);
            }
        }

    }
}