<?php

/**
 * User: denn
 * Date: 2017/4/6
 * Time: 17:41
 */
class Api_Default extends Api_Common
{
    public function getRules()
    {
        return array(
            'doLogin' => array(
                'username' => array('name' => 'username', 'type' => 'string', 'require' => true, 'desc' => '会员编号或手机号'),
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '密码'),
            )
        );

    }

    public function index()
    {

        if (PhalApi_Tool::is_mobile_request()) {
            $this->mobileShop();
        } else {
            $this->assign('icons', Domain_Icon::iconList(3));
            $this->assign('show_menu', true);
            $this->view('index');
        }

    }

    public function mobileShop()
    {
        $result = DI()->cache->get('shop_index');
        if (!$result || DI()->config->get('sys.debug')) {
            ob_flush();
            ob_start();
            include API_ROOT . '/Shop/Mobi/index.php';
            $result = ob_get_contents();
            ob_clean();
            DI()->cache->set('shop_index', $result, CACHE_TIME);
        }
        echo $result;
    }


    public function doLogin()
    {
        $result = Domain_Users::login($this->username, $this->password);
        if ($result === true) {//登陆成功
            DI()->response->setMsg(T('登陆成功'));
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
    }

    public function login()
    {
        if (Common_Function::user_id() > 0) {
            header('Location:' . Common_Function::url(array('service' => 'Default.Index')));
            exit();
        }
        $this->view('login');
    }

    public function register()
    {
        $this->view('register');
    }

    /**
     * 会员退出登录
     * @desc 会员退出登录
     */
    public function logout()
    {
        if (isset($_SESSION[SECONDPASS])) {
            unset($_SESSION[SECONDPASS]);
        }
        unset($_SESSION[md5('@#mmusers!')], $_SESSION['token'], $_SESSION[ADMIN_SEC_PWD]);
        unset($_SESSION);
        header('Location:' . Common_Function::url(array('service' => 'Default.login')));
        exit();

    }


    public function cartList()
    {
        ob_flush();
        ob_start();
        $this->view('common/top_cart');
        $result = ob_get_contents();
        ob_clean();

        $data['top'] = $result;

        return $data;

    }

}