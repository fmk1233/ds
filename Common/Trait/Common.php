<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 9:53
 */
trait Trait_Common
{


    /**
     * 查询数据
     * @param $limit 每次查询条数
     * @param $offset 开始位置
     * @param $where  查询条件
     * @param string $field 字段
     * @param string $order 排序
     * @return object a 返回结果集
     * @return int a.total 总条数
     * @return array a.rows 当前查询结果集
     */
    public static function getList($limit, $offset, $where = array(), $field = '*', $order = 'id desc')
    {
        $model = self::getModel();
        return $model->getList($limit, $offset, $where, $order, $field);
    }

    /**
     * @param $data 更新或者插入的数据
     * @throws PhalApi_Exception_WrongException 错误抛出异常
     */
    public static function doUpdate($data)
    {
        $model = self::getModel();
        DI()->response->setMsg(T('操作成功'));

        $id = $data['id'];
        unset($data['id'], $data['data']);
        if ($id > 0) {//更新
            $result = $model->update($id, $data);
            $result = $result !== false;
        } else {
            $result = $model->insert($data);
        }
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('操作失败'));
        }
    }

    /**
     * @param $id 删除信息的ID
     * @throws PhalApi_Exception_WrongException  错误抛出异常
     */
    public static function delInfo($id)
    {
        $model = self::getModel();
        DI()->response->setMsg('删除成功');
        $result = $model->delete($id);
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('删除失败'));
        }
    }


    /**
     * @return PhalApi_Model_NotORM 返回对应的 Model实例
     */
    public static function getModel()
    {
        $class = str_replace('Domain_', 'Model_', __CLASS__);
        return new $class;
    }

}