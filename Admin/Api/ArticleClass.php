<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 9:19
 */
class Api_ArticleClass extends Api_DCommon
{
    public function getRules()
    {
        return array(
            'listView' => array(),
            'listData' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                /*'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),*/
            ),
            'infoView' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => 'ID'),
                'pid' => array('name' => 'pid', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => '上级地区'),
            ),
            'doInfo' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => 'ID'),
                'name'=>array('name'=>'title','type'=>'string','desc'=>'名称'),
                'pid'=>array('name'=>'pid','type'=>'int','default'=>0,'desc'=>'上级ID'),
                'sort'=>array('name'=>'sort','type'=>'int','desc'=>'排序'),
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
        $this->assign('tips', array('管理员新增文章时，可选择文章分类。文章分类将在前台文章列表页显示', '默认的文章分类不可以删除'));
        $this->view('article/class_list');
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
        return Domain_ArticleClass::getClassList($this->limit, $this->offset);
    }

    /**
     * 修改或添加数据View
     * @desc 修改或添加数据View
     */
    public function infoView()
    {
        $this->assign('data', Domain_ArticleClass::getInfo($this->id, true));
        $this->assign('pid', $this->pid);
        $this->view('article/class_view');
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
        Domain_ArticleClass::doUpdate($data);
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
        Domain_ArticleClass::delInfo($this->id);
    }
}