<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 17:43
 */
class Api_Navigation extends Api_DCommon
{


    public function getRules()
    {
        return array(
            'listView' => array(),
            'listData' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
            ),
            'infoView' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => 'ID'),
            ),
            'doInfo' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => 'ID'),
                'title' => array('name' => 'title', 'type' => 'string', 'desc' => '导航标题'),
                'type' => array('name' => 'type', 'type' => 'int', 'default' => 0, 'desc' => '类别'),
                'location' => array('name' => 'location', 'type' => 'int', 'default' => 0, 'desc' => '导航位置'),
                'new_open' => array('name' => 'new_open', 'type' => 'int', 'default' => 0, 'desc' => 'new_open'),
                'url' => array('name' => 'url', 'type' => 'string', 'desc' => '导航链接'),
                'sort' => array('name' => 'sort', 'type' => 'int', 'desc' => '排序'),
                'item_id' => array('name' => 'item_id', 'type' => 'array', 'desc' => '类别ID'),
            ),
            'delInfo' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => 'ID'),
            )
        );
    }

    /**
     * 列表数据View
     * @desc 列表数据View
     */
    public function listView()
    {
        $this->assign('tips', array('网站全局顶部/底部及商城主导航设置'));
        $this->view('article/nav_list');
    }

    /**
     * 列表数据
     * @desc 列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function listData()
    {
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }
        return Domain_Navigation::getList($this->limit, $this->offset, $where);
    }

    /**
     * 修改或添加数据View
     * @desc 修改或添加数据View
     */
    public function infoView()
    {
        $this->assign('data', Domain_Navigation::getInfo($this->id));
        $this->view('article/nav_view');
    }

    /**
     * 数据的提交或者修改
     * @desc 数据的提交或者修改
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function doInfo()
    {
        $data = (array)$this;
        $data['item_id'] = $data['item_id'][$data['type']];
        Domain_Navigation::doUpdateNav($data);
    }

    /**
     * 物理删除数据
     * @desc 物理删除数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function delInfo()
    {
        Domain_Navigation::delInfo($this->id);
    }
}