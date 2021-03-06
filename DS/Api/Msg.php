<?php

/**
 * User: denn
 * Date: 2017/2/28
 * Time: 10:18
 */
class Api_Msg extends Api_Common
{

    public function getRules()
    {
        return array(
            'getMsgList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
                'type' => array('name' => 'type', 'type' => 'int', 'min' => 0, 'max' => 1, 'desc' => '留言类型')
            ),
            'msgDetail' => array(
                'msg_id' => array(
                    'name' => 'msg_id', 'type' => 'int', 'require' => true, 'desc' => '新闻公告ID'
                ),
                'from' => array(
                    'name' => 'from', 'type' => 'string', 'require' => true, 'desc' => '留言类型'
                )
            ),
            'addMsg' => array(
                'title' => array('name' => 'title', 'type' => 'string', 'require' => true, 'desc' => '主题'),
                'content' => array('name' => 'content', 'type' => 'string', 'require' => true, 'html' => true, 'desc' => '内容'),
            ),
        );
    }

    /**
     * 我要留言
     * @desc 我要留言
     */
    public function msgList()
    {
        $this->assign('type', 0);
        $this->view('msg_list');

    }

    /**
     * 收到留言
     * @desc 收到留言
     */
    public function fromMsgList()
    {
        $this->assign('type', 1);
        $this->view('msg_list');

    }

    public function msgDetail()
    {
        $this->assign('service', $this->from);
        $msg_model = new Model_Msg();
        $news = $msg_model->get($this->msg_id);
        $this->assign('msg', $news);
        $this->view('msg_detail');
    }


    /**
     * 添加会员留言记录
     * @desc 添加会员留言记录
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function addMsg()
    {

        DI()->notorm->beginTransaction(DB_DS);
        $result = Domain_Msg::addMsg((array)$this, $this->data['user']);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            DI()->notorm->commit(DB_DS);
        } else {
            DI()->notorm->rollback(DB_DS);
            throw new PhalApi_Exception_WrongException($result);
        }

    }

    /**
     * 获取公告列表数据
     * @desc 获取公告列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getMsgList()
    {
        $where = array();
        if ($this->type == 0) {//查看我要留言
            $where['user_id=?'] = $this->data['user']['id'];
        } else {
            $where['t_user_id=?'] = $this->data['user']['id'];
        }
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $result = Domain_Msg::getList($this->limit, $this->offset, $where);
        return $result;
    }
}