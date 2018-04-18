<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 16:01
 */
class Domain_News
{

    /**
     * 查询新闻公告明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public static function getList($limit, $offset, $where)
    {
        $news_model = new Model_News();
        $list = $news_model->getList($limit, $offset, $where, 'is_top desc , add_time desc');
        foreach ($list['rows'] as &$item) {
            $item['content'] = html_entity_decode($item['content']);
        }
        unset($item);
        return $list;
    }


    /**
     * 获取新闻公告内容
     * @param int $id 公告ID
     * @return array 新闻数据
     */
    public static function newsInfo($id)
    {
        $news = array();
        if ($id > 0) {
            $news_model = new Model_News();
            $news = $news_model->get($id);
        }
        if (empty($news)) {
            $news['id'] = 0;
            $news['news_title'] = '';
            $news['content'] = '';
            $news['is_top'] = 0;
            $news['category'] = 0;
            $news['add_time'] = 0;
            $news['add_name'] = '';
            $news['scan_num'] = 0;
        }
        $news['content'] = html_entity_decode($news['content']);
        return $news;

    }

    /**
     * 新闻公告
     * @param int $category
     * @return mixed
     */
    public static function notice($category = 2)
    {
        $news_model = new Model_News();
        $notice = $news_model->getListByCondition(array('category' => $category), 'id,news_title', 'is_top desc ,id desc', 6);
        return $notice;
    }


    public static function newsCategoryParams()
    {
        return array(
            2 => T('官方公告'),
            1 => T('业内动态'),
            0 => T('其他'),


        );
    }


    public static function isTopParams()
    {
        return array(
            0 => T('未置顶'),
            1 => T('置顶')
        );
    }

}