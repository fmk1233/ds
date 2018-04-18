<?php

/**
 * User: denn
 * Date: 2017/3/30
 * Time: 8:48
 */
class Api_Bank extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'update' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'bank' => array('name' => 'bank', 'type' => 'string', 'default' => ''),
                'zhanghao' => array('name' => 'zhanghao', 'type' => 'string', 'default' => ''),
                'huzhu' => array('name' => 'huzhu', 'type' => 'string', 'default' => ''),
            ),
            'listView' => array(),
            'listData' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
            ),
            'infoView' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            ),
            'del' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            )
        );
    }


    public function listView()
    {
        $this->assign('tips', array('当前页面显示庄园植物列表数据'));
        $this->view('bank_list');
    }

    public function listData()
    {
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }

        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $result = Domain_Bank::getList($this->limit, $this->offset, $where);
        return $result;

    }

    public function infoView()
    {
        $this->assign('info', Domain_Bank::getInfo($this->id));
        $this->view('bank_view');
    }

    public function update()
    {
        $data = (array)$this;
        $result = Domain_Bank::update($data);
        if (is_array($result)) {
            DI()->response->setMsg($result['msg']);
            return $result;
        }
        throw new PhalApi_Exception_WrongException($result);
    }

    public function del()
    {
        DI()->response->setMsg(T('删除成功'));
        $bank_model = new Model_Bank();
        $result = $bank_model->delete($this->id);
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('删除失败'));
        }
    }
}