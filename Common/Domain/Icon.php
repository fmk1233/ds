<?php

/**
 * User: denn
 * Date: 2017/3/8
 * Time: 9:38
 */
class Domain_Icon
{

    public static function iconCategoryName($category = false)
    {
        $categorys = array(
            1 => '首页',
            0 => '登陆页',
            2 => '手机端',
            3 => 'PC端商城',
            4 => '手机端商城'
        );
        if ($category === false) {
            return $categorys;
        }
        return $categorys[$category];
    }


    /**
     * 广告图
     * @param int $category 广告图位置0：首页，1：登陆页
     * @return mixed
     */
    public static function iconList($category = 1)
    {
        $icon_model = new Model_Icon();
        $advs = $icon_model->getListByWhere(array('category' => $category, 'is_rec' => 1), 'url,icon', 'sort desc,id desc');
        return $advs;
    }
}