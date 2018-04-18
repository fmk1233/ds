<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 21:27
 */
class Api_DNews extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'newsList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
            ),
            'newsInsert' => array(
                'category' => array('name' => 'category', 'type' => 'int', 'require' => true),
                'title' => array('name' => 'title', 'type' => 'string', 'require' => true),
                'content' => array('name' => 'content', 'type' => 'string', 'html'=>true ,'require' => true),
                'isTop' => array('name' => 'isTop', 'type' => 'int', 'require' => true),
                'newsId' => array('name' => 'newsid', 'type' => 'int', 'default' => 0),
            ),
            'newsAdd' => array(
                'newsId' => array('name' => 'newsid', 'type' => 'int', 'default' => 0)
            ),
            'newsDelete' => array(
                'newsId' => array('name' => 'news_id', 'type' => 'int', 'require' => true)
            )
        );
    }

    /**
     * 新闻公告列表
     * @desc 新闻公告列表
     */
    public function news()
    {
        $this->assign('tips', array('当前页面显示系统发布的公告','点击右上角‘添加公告’按钮，可以添加一条新公告'));
        $this->view('news_list');
    }

    /**
     * 添加新闻公告View
     * @desc 添加新闻公告View
     */
    public function newsAdd()
    {
        $news = array('id' => 0, 'is_top' => 0, 'news_title' => '', 'category' => 2, 'content' => '');
        if ($this->newsId) {
            $news_model = new Model_News();
            $news = $news_model->get($this->newsId);
        }
        $this->assign('news', $news);
        $this->view('news_detail');
    }

    /**
     * 获取新闻公告数据
     * @desc 获取新闻公告数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function newsList()
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
        $result = Domain_News::getList($this->limit, $this->offset, $where);
        return $result;
    }


    /**
     * 添加新闻公告
     * @desc 添加新闻公告
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function newsInsert()
    {

        $news_model = new Model_News();
        $data = array();
        $data['news_title'] = $this->title;
        $data['category'] = $this->category;
        $data['content'] = $this->content;
        $data['is_top'] = $this->isTop;
        $data['add_time'] = NOW_TIME;
        $admin = Common_Function::admin();
        $data['admin_name'] = $admin['admin_name'];
        if ($this->newsId == 0) {
            $insertId = $news_model->insert($data);
        } else {
            $insertId = $news_model->update($this->newsId, $data);
        }
        if (!$insertId) {
            if ($this->newsId == 0) {
                throw  new PhalApi_Exception_WrongException(T('添加失败'));
            } else {
                throw  new PhalApi_Exception_WrongException(T('修改失败'));
            }
        }

    }


    public function newsDelete()
    {
        $news_model = new Model_News();
        $result = $news_model->delete($this->newsId);
        if (!$result) {
            throw  new PhalApi_Exception_WrongException(T('删除失败'));
        }
        DI()->response->setMsg(T('删除成功'));
    }

}