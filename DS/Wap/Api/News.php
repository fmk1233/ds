<?php

/**
 * User: denn
 * Date: 2017/3/14
 * Time: 9:33
 */
class Api_News extends Api_Common
{

    public function getRules()
    {
        return array(
            'getNewsList'=>array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'newsInfo'=>array(
                'news_id'=>array('name'=>'newsid','type'=>'int','require'=>true,'desc'=>'新闻公告ID')
            )
        );
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
    public function getNewsList()
    {
        $where = array();
        $result = Domain_News::getList($this->limit, $this->offset, $where);
        return $result;
    }


    /**
     * 获取新闻公告内容
     * @desc 获取新闻公告内容
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function newsInfo()
    {
        return Domain_News::newsInfo($this->news_id);
    }
}