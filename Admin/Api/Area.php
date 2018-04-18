<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/11 0011
 * Time: 16:52
 */
class Api_Area extends Api_DCommon
{
    public function getRules()
    {
        return array(
            'areaList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'pid' => array('name' => 'pid', 'type' => 'int', 'require' => true, 'default' => 1, 'desc' => '上级地区'),
            ),
            'doArea' => array(
                'area_name' => array('name' => 'areaname', 'type' => 'string', 'require' => true, 'desc' => "地区名称"),
                'pid' => array('name' => 'pid', 'type' => 'int', 'require' => true, 'desc' => '上级地区'),
                'level' => array('name' => 'level', 'type' => 'int', 'require' => true, 'desc' => '省市区深度'),
                'code' => array('name' => 'areacode', 'type' => 'string', 'desc' => '地区编码'),
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0, 'desc' => '地区id')
            ),
            'delArea' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '地区id')
            ),
            'doAreaView'=>array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'default'=>0, 'desc' => '地区id'),
                'pid' => array('name' => 'pid', 'type' => 'int', 'require' => true, 'default' => 1, 'desc' => '上级地区'),
            )
        );
    }


    /**
     * 地区列表View
     * @desc 地区列表View
     */
    public function area()
    {
        $this->assign('tips', array('当前页面显示省市区列表'));
        $this->view('area_list');
    }

    /**
     * 地区信息列表数据获取
     * @desc 地区信息列表数据获取
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return array
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function areaList()
    {
        $where = array();
        $where['pid'] = $this->pid;
        return Domain_Area::getList($this->limit, $this->offset, $where);

    }

    /**
     * 地区列表View
     * @desc 地区列表View
     */
    public function doAreaView()
    {
        $this->assign('area', Domain_Area::getArea($this->id,$this->pid));
        $this->assign('tips', array('当前页面显示省市区列表'));
        $this->view('area_add');
    }

    /**
     * 变更地区信息
     * @desc 添加或修改地区信息
     * @return string
     * @throws PhalApi_Exception_WrongException
     */
    public function doArea()
    {
        $data = (array)$this;
        $result =  Domain_Area::doArea($data);
        if(is_array($result)){
            DI()->response->setMsg($result['msg']);
            return $result;
        }else{
            throw new PhalApi_Exception_WrongException($result);
        }
    }

    /**
     * 删除地区信息
     * @desc 删除地区信息
     * @return string
     * @throws PhalApi_Exception_WrongException
     */
    public function delArea()
    {
        $result =  Domain_Area::delArea($this->id);
        if(is_array($result)){
            DI()->response->setMsg($result['msg']);
            return $result;
        }else{
            throw new PhalApi_Exception_WrongException($result);
        }
    }
}