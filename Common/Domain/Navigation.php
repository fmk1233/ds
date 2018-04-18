<?php

/**
 * User: denn
 * Date: 2017/4/13
 * Time: 17:43
 */
class Domain_Navigation
{
    use Trait_Common;

    public static function getInfo($id)
    {
        /**
         * @var Model_Navigation $model
         */
        $model = self::getModel();
        $info = false;
        if ($id > 0) {
            $info = $model->get($id, '*');
        }
        if (empty($info)) {
            $info = array();
            $info['id'] = 0;
            $info['type'] = 0;
            $info['title'] = '';
            $info['url'] = '';
            $info['location'] = 0;
            $info['new_open'] = 0;
            $info['sort'] = 255;
            $info['item_id'] = 0;
        }

        return $info;
    }

    public static function doUpdateNav($data)
    {
        DI()->cache->delete('shop_navigation'.$data['type']);
        Common_Function::delShopFooterCache();//清除商城底部缓存
        return self::doUpdate($data);
    }

    public static function location($location = false)
    {
        $locations = array(
            0 => '顶部',
            1 => '中部',
            2 => '底部',
        );
        if ($location === false) {
            return $locations;
        }
        return $locations[$location];

    }

    public static function navType($type = false)
    {
        $nav_types = array(
            0 => '自定义导航',
            1 => '商品分类',
            2 => '文章分类',
        );
        if ($type === false) {
            return $nav_types;
        }
        return $nav_types[$type];

    }


    public static function url($nav)
    {
        if(!empty($nav['url'])){
            return $nav['url'];
        }
        switch ($nav['type']){
            case 0:
                return $nav['url'];
                break;
            case 1:
                return Common_Function::url(array('service'=>'GoodsClass.Index','id'=>$nav['item_id']));
                break;
            case 2:
                return Common_Function::url(array('service'=>'Article.Article','id'=>$nav['item_id']));
                break;
        }
    }

    public static function getNavList($location)
    {
        $cache_key = 'shop_navigation' . $location;
        /**
         * @var Model_Navigation $model
         */
        $model = self::getModel();
        $footer = DI()->cache->get($cache_key);
        if (empty($footer)) {
            $footer = $model->getListByWhere(array('location=?'=> $location), '*','sort desc');
            DI()->cache->set($cache_key, $footer);
        }
        return $footer;

    }
}