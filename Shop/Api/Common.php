<?php

/**
 * User: denn
 * Date: 2017/4/14
 * Time: 9:17
 */
class Api_Common extends PhalApi_Api
{

    public function __construct()
    {
        $this->assign('path', URL_ROOT . 'static/web_shop/');
        $service = DI()->request->get('service', 'Default.Index');
        $this->assign('service', $service);
        $this->checkUser();
    }

    public function checkUser()
    {
        $service = $this->data['service'];
        if (!Common_Function::user_id() && stripos('Default.Index,Default.CartList,Default.DoLogin,Default.Logout,Default.Register,Default.Login,Article.Article,Article.Show,Goods.Product,Goods.ProductList,Default.MobileShop,', $service) === false) {
            if (!IS_AJAX) {
                header('Location:' . Common_Function::url(array('service' => 'Default.Login')));
            }else{
                throw new PhalApi_Exception_WrongException('请登录',2);
            }
            exit();
        } else {
            if (Common_Function::user_id() > 0) {
                $user_model = new Model_Users();
                $user = $user_model->get(Common_Function::user_id());
                $user['id'] = intval($user['id']);
                if ($user['state'] != 1) {
                    header('Location:' . Common_Function::url(array('service' => 'Default.Logout')));
                }
                $user['rank_name'] = Common_Function::getRankName($user['rank']);
                $this->data['user'] = $user;
            }
        }

    }

    protected function assign($name, $data)
    {
        $this->data[$name] = $data;
    }

    protected function view($view)
    {

        $view = '/Shop/View/' . $view;
        parent::view($view);
    }
}