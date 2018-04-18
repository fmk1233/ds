<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/21
 * Time: 9:27
 */
class Domain_Goods
{

    /**
     * 查询数据
     * @param $limit 每次查询条数
     * @param $offset 开始位置
     * @param $where  查询条件
     * @param string $field 字段
     * @param string $order 排序
     * @return object a 返回结果集
     * @return int a.total 总条数
     * @return array a.rows 当前查询结果集
     */
    public static function getList($limit, $offset, $where = array(), $field = '*', $order = 'id desc')
    {
        $model = new Model_Goods();
        return $model->getList($limit, $offset, $where, $order, $field);
    }

    public static function getShopIndexList($condition = array(), $limit = 10, $field = '*', $order = 'id desc')
    {
        $model = new Model_Goods();
        return $model->getListByWhereAndLimit($condition, $limit, $field, $order);
    }

    /**
     * 获取商品列表信息
     * @param $offset
     * @param $limit
     * @param $where
     * @param string $order
     * @return array
     */
    public static function getGoodsList($offset, $limit, $where, $order = 'g.id desc')
    {
        $condition = Common_Function::parseSearchWhere($where, true);
        $goodsModel = new Model_Goods();
        $total = $goodsModel->getGoodsCount($condition);
        $lists = $goodsModel->getGoods($limit, $offset, $condition, $order);
        foreach ($lists as &$list) {
            $list['memo'] = html_entity_decode($list['memo']);
        }
        unset($list);
        return array('total' => $total, 'rows' => $lists);
    }

    /**
     * 获取商品分类信息
     * @param bool $format
     * @return mixed
     */
    public static function getGoodsCategorys($format = true)
    {
        $goods_category_model = new Model_GoodsCategory();
        $categorys = $goods_category_model->getAllCategorys('id,category_name,dept,icon');
        if ($format) {
            Domain_Goods::foramtGoodsCategoryToGroup($categorys);
        }
        return $categorys;

    }

    /**
     * 根据商品分类上级ID获取下级商品分类
     * @param int $pid
     * @return mixed
     */
    public static function getGoodsCategoryByPid($pid = 0)
    {
        $goods_category_model = new Model_GoodsCategory();
        $where = array();
        if ($pid == 0) {
            $where['pid'] = 0;
        } else {
            $where['find_in_set(?,pre_str)'] = $pid;
        }
        return $goods_category_model->getListByWhere($where, 'id,category_name,dept,icon');
    }


    /**
     * 获取商品分类信息（从缓存中获取）
     * @param bool $format
     * @return mixed
     */
    public static function getAllList($format = true)
    {
        $goods_category_model = new Model_GoodsCategory();
        $list = $goods_category_model->getAllList();
        if ($format) {
            self::foramtGoodsCategoryToGroup($list);
        }
        return $list;
    }

    /**
     * 获取商品信息
     * @param $id
     * @param string $field
     * @return array|mixed
     */
    public static function getGoodsInfo($id, $field = '*')
    {
        if ($id > 0) {
            $goods_model = new Model_Goods();
            $goods = $goods_model->getGoodsInfo(array('id' => $id), $field);
        } else {
            $goods = array();
            $goods['sort'] = 127;
            $goods['category_id'] = 0;
            $goods['goods_name'] = '';
            $goods['market_price'] = 0.00;
            $goods['price'] = 0.00;
            $goods['is_rec'] = 0;
            $goods['goods_pics'] = '';
            $goods['memo'] = '';
            $goods['stock'] = 0;
            $goods['has_option'] = 0;
            $goods['goods_option'] = array();
            $goods['option_title'] = array();
            $goods['weight'] = 0;
            $goods['goods_sn'] = 0;
            $goods['product_sn'] = 0;
            $goods['id'] = 0;
        }
        return $goods;
    }

    /**
     * 添加商品分类
     * @param $data
     * @return string
     */
    public static function addGoodsCategory($data)
    {
        $rs['msg'] = T('修改成功');
        $rs['url'] = Common_Function::url(array('service' => 'Goods.GoodsCategory'));
        DI()->cache->delete('goods_class_all');
        $goods_category_model = new Model_GoodsCategory();
        if (stripos($data['pic'], 'temp')) {
            $result = Common_Function::moveImage($data['pic'], 'goods');
            if (is_array($result)) {
                $data['pic'] = $result['url'];
            } else {
                return $result;
            }
        }

        if ($data['id'] > 0) {
            $update_array = array();
            $update_array['category_name'] = $data['name'];
            $update_array['sort'] = $data['sort'];
            $update_array['icon'] = $data['pic'];
            $update_array['is_show'] = $data['is_show'];
            if (isset($data['ad'])) {
                $update_array['ad'] = $data['ad'];
            }
            if (isset($data['left_ad'])) {
                $update_array['left_ad'] = trim($data['left_ad'], ',');
            }
            $result = $goods_category_model->update($data['id'], $update_array);
            if ($result === false) {
                return T('修改失败');
            }
        } else {
            if (empty($data['pic'])) {
                return T('请上传图片');
            }
            $insert_array = array();
            $insert_array['category_name'] = $data['name'];
            $insert_array['pid'] = $data['pid'];
            $insert_array['orders'] = $goods_category_model->getOrdersByPid($data['pid']);
            $insert_array['dept'] = 1;
            $insert_array['icon'] = $data['pic'];
            $insert_array['sort'] = $data['sort'];
            if (isset($data['ad'])) {
                $insert_array['ad'] = $data['ad'];
            }
            $insert_array['is_show'] = $data['is_show'];
            if (isset($data['left_ad'])) {
                $insert_array['left_ad'] = trim($data['left_ad'], ',');
            }
            if ($data['pid'] > 0) {
                $p_goods_category = $goods_category_model->get($data['pid'], 'dept,id,pre_str');
                $insert_array['dept'] = $p_goods_category['dept'] + 1;
                $insert_array['pre_str'] = trim($p_goods_category['id'] . ',' . $p_goods_category['pre_str'], ',');
            }
            if ($insert_array['dept'] >= 4) {
                return '商品分类最多三层';
            }

            $insertId = $goods_category_model->insert($insert_array);
            if (!$insertId) {
                return T('添加失败');
            }
            $rs['msg'] = T('添加成功');
            $goods_category_model->updateOrdersByOrders($insert_array['orders'], $insertId);
        }
        return $rs;

    }


    /**
     * 多规格商品第一种规格的价格，市场价，以及库存
     * @param $goods
     */
    public static function goodInfo(&$goods)
    {
        $goods['goods_pics'] = explode(',', $goods['goods_pics']);
        if ($goods['has_option'] == 1) {
            if (!is_array($goods['option_title'])) {
                $goods['option_title'] = json_decode($goods['option_title'], true);
            }
            if (count($goods['option_title']) > 0) {
                if (!is_array($goods['goods_option'])) {
                    $goods['goods_option'] = json_decode($goods['goods_option'], true);
                }
                $goods_options = $goods['goods_option'];
                $goods['price'] = $goods_options[0]['option_price'];
                $goods['market_price'] = $goods_options[0]['option_marketprice'];
                $goods['stock'] = $goods_options[0]['option_stock'];
                $goods['optionid'] = $goods_options[0]['option_id'];
            }
        }
    }

    /**
     * 对商品分类进行格式化
     * @param $categorys
     */
    private static function foramtGoodsCategoryToGroup(&$categorys)
    {
        foreach ($categorys as &$category) {
            $str = '';
            for ($i = 1; $i < $category['dept']; $i++) {
                $str .= '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $category['category_name'] = $str ? $str . '|-' . $category['category_name'] : $category['category_name'];
        }
        unset($category);
    }

}