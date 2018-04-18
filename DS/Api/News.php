<?php

/**
 * User: denn
 * Date: 2017/2/28
 * Time: 9:45
 */
class Api_News extends Api_Common
{

    public function getRules()
    {
        return array(
            'getNewsList'=>array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
            ),
            'newsDetail'=>array(
                'news_id'=>array(
                    'name'=>'news_id','type'=>'int','require'=>true,'desc'=>'新闻公告ID'
                )
            )
        );
    }

    /**
     * 公告列表
     * @desc 公告列表
     */
    public function newsList()
    {
        $this->view('news_list');

    }

    public function newsDetail()
    {
        $this->assign('service','News.NewsList');
        $news_model = new Model_News();
        $news = $news_model->get($this->news_id);
        $this->assign('news',$news);
        $this->view('news_detail');
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
        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $result = Domain_News::getList($this->limit, $this->offset, $where);
        return $result;
    }
}