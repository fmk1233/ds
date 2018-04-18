<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 9:19
 */
class Domain_ArticleClass
{

    use Trait_Common;


    public static function getInfo($id, $category = false)
    {
        $model = self::getModel();
        $info = false;
        if ($id > 0) {
            $info = $model->get($id, '*');
        }
        if (empty($info)) {
            $info = array();
            $info['id'] = 0;
            $info['name'] = '';
            $info['code'] = '';
            $info['pid'] = 0;
            $info['sort'] = 255;
        }
        if ($category) {
            $article_class_model = new Model_ArticleClass();
            $info['categorys'] = $article_class_model->getListByWhere(array('pid=?' => 0), 'name,id', 'orders asc');
        }
        return $info;
    }

    public static function getClassList($limit, $offset, $where = array(), $field = '*', $order = '*')
    {
        $list = self::getList($limit, $offset, $where, $field, 'orders asc');
        self::foramtToGroup($list['rows']);
        return $list;
    }

    public static function getAllList($format = true)
    {
        /**
         * @var Model_ArticleClass $model
         */
        $model = self::getModel();
        $list = $model->getAllList();
        if ($format) {
            self::foramtToGroup($list);
        }
        return $list;
    }

    public static function doUpdate($data)
    {
        /**
         * @var Model_ArticleClass $model
         */
        $model = self::getModel();
        DI()->response->setMsg(T('操作成功'));

        $id = $data['id'];
        unset($data['id'], $data['data']);
        DI()->cache->delete('article_class_all');
        Common_Function::delShopFooterCache();//清除商城底部缓存
        if ($id > 0) {//更新
            $result = $model->update($id, $data);
            $result = $result !== false;
        } else {
            $data['orders'] = $model->getOrdersByPid($data['pid']);
            $data['pre_str'] = '';
            $data['dept'] = 1;
            if ($data['pid'] > 0) {
                $p_info = $model->get($data['pid'], 'dept,id,pre_str');//父级的信息
                $data['dept'] = $p_info['dept'] + 1;
                $data['pre_str'] = trim($p_info['id'] . ',' . $p_info['pre_str'], ',');
            }

            $result = $model->insert($data);
            if ($result) {
                $model->updateOrdersByOrders($data['orders'], $result);
            }
        }
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('操作失败'));
        }

    }

    public static function delInfo($id)
    {
        /**
         * @var Model_ArticleClass $model
         */
        $model = self::getModel();
        DI()->response->setMsg('删除成功');
        $result = $model->delAll($id);
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('删除失败'));
        }
    }

    //私有方法区
    public static function foramtToGroup(&$categorys)
    {
        foreach ($categorys as &$category) {
            $str = '';
            for ($i = 1; $i < $category['dept']; $i++) {
                $str .= '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $category['name'] = $str ? $str . '|-' . $category['name'] : $category['name'];
        }
        unset($category);
    }


    public static function getshopFooterList()
    {
        $lists = self::getAllList(false);
        $shop_footer = array();
        $article_model = new Model_Article();
        foreach ($lists as $list) {
            if(empty($list['code'])){
                continue;
            }
            $articles = $article_model->getListByWhere(array('c_id=?'=>$list['id'],'`ar_show`=?'=>1),'id,title,url');
            $shop_footer[$list['name']] = $articles;
        }
        return $shop_footer;
    }


}