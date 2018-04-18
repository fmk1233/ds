<?php

/**
 * User: denn
 * Date: 2017/4/14
 * Time: 17:18
 */
class Api_Article extends Api_Common
{

    public function getRules()
    {
        return array(
            'article' => array(
                'c_id' => array('name' => 'cid', 'type' => 'int', 'require' => true),
                'page' => array('name' => 'page', 'type' => 'int', 'default' => 1, 'desc' => '当前页码')
            ),
            'show' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '文章编号')
            ),
            'news' => array(
                'page' => array('name' => 'page', 'type' => 'int', 'default' => 1, 'desc' => '当前页码')
            ),
            'newsDetail' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '公告编号')
            )
        );
    }

    public function article()
    {
        $page = $this->page;
        $c_id = $this->c_id;
        $this->assign('page', $page);
        $this->assign('url', array('service' => 'Article.Article', 'cid' => $c_id));
        $all_list = Domain_ArticleClass::getAllList();
        $flag = false;
        $current_class = array();
        $c_ids = array();
        foreach ($all_list as $class) {
            if ($class['id'] == $c_id) {
                $current_class = $class;
                $c_ids[] = $class['id'];

            } else if ($class['pid'] == $c_id) {
                $flag = true;
                $c_ids[] = $class['id'];
            }
        }
        if (count($current_class) == 0) {
            PhalApi_Tool::showErrorMsg('该文章分类并不存在');
        }
        $article_class = array();
        foreach ($all_list as $key => $class) {
            if ($flag && $class['pid'] == $c_id) {
                $article_class[] = $class;
            } elseif (!$flag) {
                $article_class[] = $class;
            }
        }
        if (count($article_class) == 0) {
            $article_class = $current_class;
        }
        //左侧文章分类
        $this->assign('article_class', $article_class);
        $this->assign('current_class', $current_class);

        //获取对应的文章
        $list = Domain_Article::getList(PAGENUM, ($page - 1) * PAGENUM, array('c_id' => $c_ids, 'ar_show' => 1), 'id,title,add_time', 'sort desc ,id desc');
        $this->assign('list', $list['rows']);
        $this->assign('total', $list['total']);
        //左侧最新文章
        $news_article = array();
        $default_count = 5;
        $i = 0;
        foreach ($list['rows'] as $row) {
            if ($i >= $default_count) {
                break;
            }
            $news_article[] = $row;
            $i++;
        }
        $this->assign('news_article', $news_article);

        $this->view('article_class');
    }


    public function show()
    {
        $artice = Domain_Article::getInfo($this->id, false);
        if ($artice['id'] == 0 || $artice['ar_show'] == 0) {
            PhalApi_Tool::showErrorMsg('该文章并不存在');
        }
        $this->assign('article', $artice);
        $c_id = $artice['c_id'];
        $all_list = Domain_ArticleClass::getAllList();
        $flag = false;
        $current_class = array();
        $c_ids = array();
        foreach ($all_list as $class) {
            if ($class['id'] == $c_id) {
                $current_class = $class;
                $c_ids[] = $class['id'];

            } else if ($class['pid'] == $c_id) {
                $flag = true;
                $c_ids[] = $class['id'];
            }
        }
        if (count($current_class) == 0) {
            PhalApi_Tool::showErrorMsg('该文章已随所属类别被删除');//该文章已随所属类别被删除
        }
        $article_class = array();
        foreach ($all_list as $key => $class) {
            if ($flag && $class['pid'] == $c_id) {
                $article_class[] = $class;
            } elseif (!$flag) {
                $article_class[] = $class;
            }
        }
        if (count($article_class) == 0) {
            $article_class = $current_class;
        }
        //左侧文章分类
        $this->assign('article_class', $article_class);
        $this->assign('current_class', $current_class);
        $default_count = 5;
        //左侧最新文章列表
        $artice_model = new Model_Article();
        $news_article = $artice_model->getLimitListByWhere(array('c_id' => $c_ids, 'ar_show' => 1), 'id,title,add_time', 'sort desc ,id desc', $default_count);
        $this->assign('news_article', $news_article);
        //上篇文章
        $pre_article = $artice_model->getLimitListByWhere(array('c_id' => $c_ids, 'ar_show' => 1, 'sort>=?' => $artice['sort'], 'id>?' => $artice['id']), 'id,title,add_time', 'sort asc ,id asc', 1);
        //下篇文章
        $next_article = $artice_model->getLimitListByWhere(array('c_id' => $c_ids, 'ar_show' => 1, 'sort<=?' => $artice['sort'], 'id<?' => $artice['id']), 'id,title,add_time', 'sort desc ,id desc', 1);

        $this->assign('pre_article', $pre_article);
        $this->assign('next_article', $next_article);

        $this->view('article');
    }


    public function news()
    {
        $page = $this->page;
        $this->assign('page', $page);
        $where = array();
        $list = Domain_News::getList(PAGENUM, ($page - 1) * PAGENUM, $where, 'id,news_title,add_time', 'is_top desc ,id desc');
        $this->assign('list', $list['rows']);
        $this->assign('total', $list['total']);
        $this->assign('url', array('service' => 'Article.News'));
        $this->view('news');
    }

    public function newsDetail()
    {
        $artice = Domain_News::newsInfo($this->id);
        if ($artice['id'] == 0) {
            PhalApi_Tool::showErrorMsg('该公告并不存在');
        }
        $this->assign('article', $artice);
        $news_model = new Model_News();
        $where = array();
        $where['id>?'] = $artice['id'];
        //上篇文章
        $pre_article = $news_model->getListByCondition($where, 'id,news_title,add_time', 'is_top asc ,id desc', 1);
        unset($where['id>?']);
        $where['id<?'] = $artice['id'];
        //下篇文章
        $next_article = $news_model->getListByCondition($where, 'id,news_title,add_time', 'is_top asc ,id desc', 1);

        $this->assign('pre_article', $pre_article);
        $this->assign('next_article', $next_article);

        $this->view('news_detail');
    }
}