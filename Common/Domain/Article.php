<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 9:18
 */
class Domain_Article
{

    use Trait_Common;

    public static function getInfo($id, $category = false, $field = '*')
    {
        $model = self::getModel();
        $info = false;
        if ($id > 0) {
            $info = $model->get($id, $field);
        }
        if (empty($info)) {
            $info = array();
            $info['id'] = 0;
            $info['c_id'] = 0;
            $info['url'] = '';
            $info['ar_show'] = 1;
            $info['position'] = 1;
            $info['sort'] = 255;
            $info['title'] = '';
            $info['content'] = '';
        }
        if (isset($info['content'])) {
            $info['content'] = html_entity_decode($info['content']);
        }
        if ($category) {
            $article_class_model = new Model_ArticleClass();
            $info['categorys'] = $article_class_model->getAllList();
            Domain_ArticleClass::foramtToGroup($info['categorys']);
        }
        return $info;

    }

    public static function getArticleList($limit, $offset, $where = array(), $field = '*', $order = 'id desc')
    {
        $list = self::getList($limit, $offset, $where, $field, $order);
        $article_class = new Model_ArticleClass();
        foreach ($list['rows'] as &$row) {
            $class = $article_class->get($row['c_id'], 'name');
            $row['c_name'] = $class['name'] ? $class['name'] : '无';
        }
        unset($row);
        return $list;
    }

    public static function url($article)
    {
        if (!empty($article['url'])) {
            return $article['url'];
        }
        return Common_Function::url(array('service' => 'Article.Index', 'id' => $article['id']));
    }

}