<?php

/**
 * User: denn
 * Date: 2017/4/15
 * Time: 16:10
 */
class Api_Goods extends Api_Common
{

    public function getRules()
    {
        return array(
            'productList' => array(
                'c_id' => array('name' => 'cid', 'type' => 'int', 'desc' => '分类ID', 'default' => 0),
                'page' => array('name' => 'page', 'type' => 'int', 'default' => 1, 'desc' => '当前页码'),
                'key' => array('name' => 'keyword', 'type' => 'string', 'desc' => '关键字', 'default' => ''),
                'order' => array('name' => 'order', 'type' => 'enum', 'range' => array(0, 1, 2, 3, 4), 'require' => true, 'desc' => '排序', 'default' => 0),
            ),
            'product' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'desc' => '商品ID', 'default' => 0),
            )
        );

    }

    public function productList()
    {
        $where = array();

        //获取商品分类
        if ($this->c_id == 0) {

        } else {
            $where['gc.id=?'] = $this->c_id;
            $categorys = Domain_GoodsClass::getJuniorCategory($this->c_id);
            if (count($categorys) == 0) {
                PhalApi_Tool::showErrorMsg('该商品分类并不存在');
            }
            $this->assign('categorys', $categorys);
        }
        $this->assign('c_id', $this->c_id);

        $where['g.status=?'] = 1;
        switch ($this->order) {
            case 1:
                $order = 'g.price desc,g.id desc';
                break;
            case 2:
                $order = 'g.price asc,g.id desc';
                break;
            case 3:
                $order = 'g.buy_num desc,g.id desc';
                break;
            case 4:
                $order = 'g.buy_num asc,g.id desc';
                break;
            default:
                $order = 'g.sort desc,g.id desc';
        }

        if (!empty($this->key)) {
            $where['locate( ? ,goods_name)>0'] = $this->key;
        }
        $page = $this->page;

        $goods_list = Domain_Goods::getGoodsList(($page - 1) * PAGENUM, PAGENUM, $where, $order);
        $this->assign('goods_list', $goods_list['rows']);
        $this->assign('total', $goods_list['total']);
        $this->assign('page', $this->page);
        $this->assign('order', $this->order);
        $this->assign('keyword', $this->key);
        $this->assign('goods_class', Domain_Goods::getAllList(false));
        $this->assign('url', array('service' => 'Goods.ProductList', 'cid' => $this->c_id, 'keyword' => $this->key, 'order' => $this->order));

        $this->view('product_list');
    }

    public function product()
    {

        $goods = Domain_Goods::getGoodsInfo($this->id);
        if (empty($goods)) {
            PhalApi_Tool::showErrorMsg('该商品并不存在');
        } else if ($goods['status'] == 0) {
            PhalApi_Tool::showErrorMsg('该商品已下架');
        }
//        print_r($goods);exit();

        $categorys = Domain_GoodsClass::getJuniorCategory($goods['category_id']);
        if (count($categorys) == 0) {
            PhalApi_Tool::showErrorMsg('该商品所属分类已被删除');
        }
        $this->assign('categorys', $categorys);
        $this->assign('goods', $goods);

        $this->view('product');

    }

}