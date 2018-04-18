<?php

/**
 * User: denn
 * Date: 2017/3/14
 * Time: 14:32
 */
class Api_Goods extends Api_Common
{
    public function getRules()
    {
        return array(
            'getGoodsInfoList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'order' => array('name' => 'order', 'type' => 'enum','range'=>array(0,1,2,3,4), 'require' => true, 'desc' => '排序'),
                'key' => array('name' => 'key', 'type' => 'string', 'require' => true, 'desc' => '关键字'),
                'category_id' => array('name' => 'category_id', 'type' => 'int', 'require' => true, 'default' => 0, 'desc' => '商品分类ID'),
            ),

            'getGoodsCategory' => array(
            ),
            'getGoodsCategoryByPid'=>array(
                'pid'=>array('name'=>'pid','type'=>'int','require'=>true,'desc'=>'上级分类ID')
            ),
            'goodsDetail' => array(
                'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'require' => true, 'desc' => "商品ID"),
            ),
            'getCartCount' => array()
        );
    }

    public function getGoodsCategory()
    {
        $categorys = Domain_Goods::getGoodsCategorys(false);
        return $categorys;
    }

    public function getGoodsCategoryByPid()
    {
        $categorys = Domain_Goods::getGoodsCategoryByPid($this->pid);
        return $categorys;
    }

    public function getCartCount()
    {
        if ($this->data['user']['id'] == 0) {
            return 0;
        }
        $cart_model = new Model_Cart();
        $count = $cart_model->getCartCount(array('user_id' => $this->data['user']['id']));
        return intval($count);
    }

    /**
     * 获取商品信息列表数据
     * @desc 获取商品信息列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getGoodsInfoList()
    {

        $where = array();
        //获取商品分类
        if ($this->category_id == 0) {

        } else {
            $where['gc.id=?'] = $this->category_id;
        }
        $where['g.status=?'] = 1;
        switch ($this->order){
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
                $order = 'g.id desc';
        }

        if($this->key){
            $where['locate( ? ,goods_name)>0'] = $this->key;
        }

        $goods_list = Domain_Goods::getGoodsList($this->offset, $this->limit, $where,$order);
        return $goods_list;
    }


    public function goodsDetail()
    {
        $goods_info = Domain_Goods::getGoodsInfo($this->goodsid);
        return $goods_info;
    }
}