<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/22
 * Time: 17:49
 */
class Api_Common extends PhalApi_Api
{

    function __construct()
    {
        if (DI()->config->get('sys_setting.open') == 0) {
            echo '	<div style="margin-top:150px;text-align:center;font-size:25px;"><img src="', URL_ROOT, 'static/image/wzzzwhz_img.jpg"></div>';
            die();
        }
        $service = DI()->request->get('service', 'Default.Index');
        $this->assign('service', $service);
        $this->checkAuthor();
        $this->checkUser();
    }

    public function checkUser()
    {
        $service = DI()->request->get('service', 'Default.Index');
        if (!Common_Function::user_id() && stripos('Default.Index,Default.DoLogin,Default.Logout,Default.SetLang,', $service) === false) {
            if (!IS_AJAX) {
                header('Location:' . Common_Function::url(array('service' => 'Default.Index')));
            }
            exit();
        } else {
            if (Common_Function::user_id() > 0) {
                $user_model = new Model_Users();
                $user = $user_model->get(Common_Function::user_id());
                $user['id'] = intval($user['id']);
                if ($user['id'] == 0 || $user['state'] != 1) {
                    unset($_SESSION[md5('@#mmusers!')]);
                    header('Location:' . Common_Function::url(array('service' => 'Default.Logout')));
                    exit();
                }
                $this->data['user'] = $user;
            }
        }
    }

    public function checkAuthor()
    {
        $service = DI()->request->get('service', 'Default.Index');
        $power = DI()->config->get('home_power.power');
        if (stripos($power . ',Default.Index,Default.DoLogin,Default.Logout,User.Sec,User.SecAc,Default.SetLang,', $service . ',') === false) {
            if (IS_JSON) {
                throw  new PhalApi_Exception_WrongException('没有权限');
            } else {
                echo PhalApi_Tool::showErrorMsg('没有权限');;
            }
            exit();
        }
//        unset($_SESSION[ADMIN_SEC_PWD]);

        if (!isset($_SESSION[ADMIN_SEC_PWD]) && stripos(',Default.Index,Default.DoLogin,Default.Logout,User.Sec,User.SecAc,User.Main,Default.SetLang,', $service . ',') === false) {//判断页面是否需要输入二级密码
            $cookie = new PhalApi_Cookie();
            $cookie->set('services', $service, NOW_TIME + 3600);
            header('Location:' . Common_Function::url(array('service' => 'User.Sec')));
            die();
        }

    }

    protected function assign($name, $data)
    {
        $this->data[$name] = $data;
    }

    protected function view($view)
    {

        $view = '/DS/View/' . THEME . '/' . $view;
        parent::view($view);
    }

}