<?php

/**
 * User: denn
 * Date: 2017/4/15
 * Time: 11:34
 */
class Domain_GoodsClass  //商品分类Domain
{

    //商城首页分类数据获取
    public static function getShopCategoryList()
    {
        $categorys = Domain_Goods::getAllList(false);
        $list = array();
        foreach ($categorys as $category) {
            if ($category['dept'] == 1) {
                $list[$category['id']] = $category;
            } else if ($category['dept'] == 2) {
                $ids = explode(',', $category['pre_str']);
                $list[$ids[count($ids) - 1]]['child'][$category['id']] = $category;
            } else {
                $ids = explode(',', $category['pre_str']);
                $len = count($ids);
                $list[$ids[$len - 1]]['child'][$ids[$len - 2]]['child'][$category['id']] = $category;
            }
        }

        return $list;
    }


    public static function getJuniorCategory($c_id)
    {
        $categorys = self::getShopCategoryList();

        $list = array();
        foreach ($categorys as $category) {//循环一级分类
            if ($c_id == $category['id']) {//如果等于一级分类，找到所有的下级分类
                $list['name'][] = $category['category_name'];
                $list['ids'][] = $category['id'];
                $list['c_ids'][] = $c_id;
                if (isset($categorys[$c_id]['child'])) {
                    foreach ($categorys[$c_id]['child'] as $key => $category_1) {
                        $list['c_ids'][] = $key;
                        if (isset($categorys[$c_id]['child'][$key]['child'])) {
                            $list['c_ids'] = array_merge($list['c_ids'], array_keys($category_1['child']));
                        }
                    }
                }
                break;
            } else {
                if (isset($category['child'])) {//判断是否存在二级分类
                    foreach ($category['child'] as $key => $category_2) {
                        if ($key == $c_id) {//如果该分类是二级分类
                            $list['name'][] = $category['category_name'];
                            $list['ids'][] = $category['id'];
                            $list['name'][] = $category_2['category_name'];
                            $list['ids'][] = $category_2['id'];
                            $list['c_ids'][] = $category_2['id'];
                            if (isset($category_2['child'])) {
                                $list['c_ids'] = array_merge($list['c_ids'], array_keys($category_2['child']));
                            }
                            break;
                        }
                        if (isset($category_2['child'])) {//如果是三级分类
                            foreach ($category_2['child'] as $key_2 => $category_3) {
                                if ($c_id == $key_2) {
                                    $list['name'][] = $category['category_name'];
                                    $list['ids'][] = $category['id'];
                                    $list['name'][] = $category_2['category_name'];
                                    $list['ids'][] = $category_2['id'];
                                    $list['name'][] = $category_3['category_name'];
                                    $list['ids'][] = $category_3['id'];
                                    $list['c_ids'][] = $category_2['id'];
                                    break;
                                }
                            }
                        }

                    }
                }
            }
        }

        return $list;

    }

    public static function shopIndex()
    {
        $categorys = self::getShopCategoryList();
        $list = array();
        foreach ($categorys as $category) {
            $li = array();
            $li['class'] = $category;
            $li['ids'][] = $category['id'];
            if (isset($category['child'])) {
                foreach ($category['child'] as $child) {
                    $li['ids'][] = $child['id'];
                    if (isset($child['child'])) {
                        $li['ids'] = array_merge($li['ids'], array_keys($child['child']));
                    }
                }
            }
            $list[] = $li;
        }
        return $list;
    }


}