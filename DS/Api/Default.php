<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/25
 * Time: 20:06
 */
class APi_Default extends Api_Common
{

    public function getRules()
    {
        return array(
            'doLogin' => array(
                'username' => array('name' => 'username', 'type' => 'string', 'require' => true, 'desc' => '会员编号或手机号'),
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '密码'),
            ),
            'setLang' => array(
                'lang' => array('name' => 'lang', 'type' => 'string', 'require' => true, 'desc' => '语言')
            )
        );

    }

    /**
     * 首页
     * @desc 首页
     */
    public function index()
    {

        if (THEME == 'Default') {
            $news_model = new Model_News();

            //官方公告
            $this->assign('notices', $news_model->getListByCondition(array('category' => 2), 'id,news_title', 'is_top desc ,id desc', 6));
            //业内动态
            $this->assign('news', $news_model->getListByCondition(array('category' => 1), 'id,news_title', 'is_top desc ,id desc', 6));
        } else {
            if (Common_Function::user_id() > 0) {
                header('Location:' . Common_Function::url(array('service' => 'User.Main')));
                exit();
            }
        }
        $icon_model = new Model_Icon();
        $this->assign('advs', $icon_model->getListByWhere(array('category' => 0, 'is_rec' => 1), 'url,icon', 'sort desc,id desc'));
        $this->view('index');
    }


    /**
     * 会员登陆
     * @desc 会员登陆
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function doLogin()
    {
        $result = Domain_Users::login($this->username, $this->password);
        if ($result === true) {//登陆成功
            DI()->response->setMsg(T('登陆成功'));
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }

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
        header('Location:' . Common_Function::url(array('service' => 'Default.Index')));
        exit();

    }

    public function setLang()
    {
        $_SESSION['lang'] = $this->lang;
    }


}