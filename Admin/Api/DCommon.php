<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 16:37
 */
class Api_DCommon extends PhalApi_Api
{

    public function __construct()
    {

        if(!defined('API')){#TODO 项目整体API查看开发结束后注释掉
            $this->checkAdmin();
        }

//        unset($_SESSION[ADMIN_SEC_PWD]);
    }


    protected function logout()
    {
        unset($_SESSION['adminToken'], $_SESSION[ADMIN_TOKEN], $_SESSION[ADMIN_SEC_PWD]);
    }

    protected function assign($name, $data)
    {
        $this->data[$name] = $data;
    }

    protected function checkAuthor()
    {
        $powers = DI()->config->get('power');
        $admin = Common_Function::admin();
        $service = DI()->request->get('service');
        if (stripos('Goods.UploadFile,Goods.RemoveFile,Logistics.DownComcode,DIndex.index,DIndex.index1,Admin.Logout,Admin.Sec,Admin.SecAc,' . $powers[$admin['power_id']]['power'] . ',', $service . ',') === false) {
            if (IS_JSON) {
                throw  new PhalApi_Exception_WrongException('没有权限');
            } else {
                echo PhalApi_Tool::showErrorMsg('没有权限');;
            }
            exit();

        }

//        unset($_SESSION[ADMIN_SEC_PWD]);
//        echo $_SESSION[ADMIN_SEC_PWD];
        $sec_power = DI()->config->get('admin_sec_power.power');
        if (!isset($_SESSION[ADMIN_SEC_PWD]) && !(stripos($sec_power.',', $service.',') === false)) {//判断页面是否需要输入二级密码
            $cookie = new PhalApi_Cookie();
            $cookie->set('services', $service, NOW_TIME + 3600);
            header('Location:'.Common_Function::url(array('service'=>'Admin.Sec')));
            die();
        }
    }

    protected function checkAdmin()
    {
        if (!Common_Function::admin_id()) {
            if (IS_AJAX) {
                throw  new PhalApi_Exception_WrongException('非法操作');
            } else {
                echo '<script type="text/javascript">top.location.href="'.Common_Function::url(array('service'=>'DPublic.Login')).'";</script>';
            }
            exit();
        }
        $this->checkAuthor();
    }

    protected function view($view)
    {
        $view = '/Admin/View/' . $view;
        parent::view($view);
    }

}