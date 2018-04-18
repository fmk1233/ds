<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 21:27
 */
class Api_DProtocol extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'protocolList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
            ),
            'protocolInsert' => array(
                'title' => array('name' => 'title', 'type' => 'string', 'require' => true),
                'content' => array('name' => 'content', 'type' => 'string', 'html'=>true ,'require' => true),
                'state' => array('name' => 'state', 'type' => 'int', 'require' => true),
                'protocolId' => array('name' => 'protocolid', 'type' => 'int', 'default' => 0),
            ),
            'protocolAdd' => array(
                'protocolId' => array('name' => 'protocolid', 'type' => 'int', 'default' => 0)
            ),
            'protocolDelete' => array(
                'protocolId' => array('name' => 'protocol_id', 'type' => 'int', 'require' => true)
            )
        );
    }

    /**
     * 系统协议列表
     * @desc 系统协议列表
     */
    public function protocol()
    {
        $this->assign('tips', array('当前页面显示系统发布的协议','启用后，会员必须同意该协议后方可进行下一步操作'));
        $this->view('protocol_list');
    }

    /**
     * 添加系统协议View
     * @desc 添加系统协议View
     */
    public function protocolAdd()
    {
        $protocol = array('id' => 0, 'state' => 0, 'title' => '',  'content' => '');
        if ($this->protocolId) {
            $protocol_model = new Model_Protocol();
            $protocol = $protocol_model->get($this->protocolId);
        }
        $this->assign('protocol', $protocol);
        $this->view('protocol_detail');
    }

    /**
     * 获取系统协议数据
     * @desc 获取系统协议数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function protocolList()
    {
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,'.$this->qtype.')>0'] = $this->qvalue;
        }

        if(!empty($this->s_time)){
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if(!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $result = Domain_Protocol::getList($this->limit, $this->offset, $where);
        return $result;
    }


    /**
     * 添加系统协议
     * @desc 添加系统协议
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function protocolInsert()
    {

        $protocol_model = new Model_Protocol();
        $data = array();
        $data['title'] = $this->title;
        $data['content'] = $this->content;
        $data['state'] = $this->state;
        $data['add_time'] = NOW_TIME;
        if ($this->protocolId == 0) {
            $insertId = $protocol_model->insert($data);
        } else {
            $insertId = $protocol_model->update($this->protocolId, $data);
        }
        if (!$insertId) {
            if ($this->protocolId == 0) {
                throw  new PhalApi_Exception_WrongException(T('添加失败'));
            } else {
                throw  new PhalApi_Exception_WrongException(T('修改失败'));
            }
        }

    }


    public function protocolDelete()
    {
        $protocol_model = new Model_Protocol();
        $result = $protocol_model->delete($this->protocolId);
        if (!$result) {
            throw  new PhalApi_Exception_WrongException(T('删除失败'));
        }
        DI()->response->setMsg(T('删除成功'));
    }

}