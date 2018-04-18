<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/29
 * Time: 13:56
 */
class Api_Goods extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'addCategory' => array(
                'pid' => array('name' => 'pid', 'type' => 'int', 'default' => 0),
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            ),
            'addGoodsCategoryAC' => array(
                'pid' => array('name' => 'pid', 'type' => 'int', 'default' => 0),
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'sort' => array('name' => 'sort', 'type' => 'int', 'min' => 0, 'max' => 127, 'default' => 0),
                'pic' => array('name' => 'pic', 'type' => 'string', 'desc' => '图片地址'),
                'is_show' => array('name' => 'is_show', 'type' => 'int', 'default' => 0, 'desc' => '图片地址'),
                'ad' => array('name' => 'ad', 'type' => 'string', 'desc' => '广告地址'),
                'left_ad' => array('name' => 'left_ad', 'type' => 'string', 'desc' => '左侧广告地址'),
                'name' => array('name' => 'title', 'type' => 'string', 'require' => true, 'desc' => '分类名称')
            ),
            'goodsCategoryList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true),
            ),
            'DelCategory' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            ),
            'addGoods' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'tpl' => array('name' => 'tpl', 'type' => 'string', 'default' => ''),
                'spec_id' => array('name' => 'spec_id', 'type' => 'string',),
                'title' => array('name' => 'title', 'type' => 'string', 'defalut' => '')
            ),
            'addGoodsAC' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'name' => array('name' => 'title', 'type' => 'string', 'default' => ''),
                'sort' => array('name' => 'sort', 'type' => 'int', 'min' => 0, 'max' => 127, 'default' => 0),
                'category_id' => array('name' => 'categoryId', 'type' => 'int', 'require' => true, 'default' => 0),
                'goods_pics' => array('name' => 'goods_pics', 'type' => 'string', 'default' => ''),
                'orgin_goods_pics' => array('name' => 'orgin_goods_pics', 'type' => 'array', 'format' => 'explode', 'separator' => ',', 'default' => ''),
                'old_goods_pics' => array('name' => 'old_goods_pics', 'type' => 'array', 'format' => 'explode', 'separator' => ',', 'default' => ''),
                'market_price' => array('name' => 'market_price', 'type' => 'float', 'min' => 0, 'default' => 0),
                'price' => array('name' => 'price', 'type' => 'float', 'min' => 0, 'default' => 0),
                'stock' => array('name' => 'stock', 'type' => 'int', 'min' => 0, 'default' => 0),
                'is_rec' => array('name' => 'is_rec', 'type' => 'string', 'default' => 0),
                'memo' => array('name' => 'memo', 'type' => 'string', 'html' => true, 'default' => ''),
                'goods_sn' => array('name' => 'goods_sn', 'type' => 'string', 'default' => ''),
                'product_sn' => array('name' => 'product_sn', 'type' => 'string', 'default' => ''),
                'weight' => array('name' => 'weight', 'type' => 'float', 'default' => 0),
                'has_option' => array('name' => 'has_option', 'type' => 'int', 'default' => 0),
                'goods_option' => array('name' => 'optionArray', 'type' => 'array', 'format' => 'json'),
                'option_title' => array('name' => 'spec_title', 'type' => 'array'),
            ),
            'getGoodsList' => array(
                'category_id' => array('name' => 'categoryId', 'type' => 'int', 'require' => true, 'default' => 0),
                'goodsName' => array('name' => 'goodsName', 'type' => 'string', 'require' => true, 'default' => 0),
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
            ),
            'changeStatusGoods' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'status' => array('name' => 'status', 'type' => 'int', 'min' => 0, 'max' => 1, 'default' => 1),
            ),
            'delGoods' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
            ),
            'uploadFile' => array(
                'pic' => array('name' => 'pic', 'type' => 'file', 'min' => 0, 'max' => 1024 * 1024, 'range' => array('image/jpg', 'image/jpeg', 'image/png'), 'ext' => array('jpg', 'jpeg', 'png'))
            ),
            'removeFile' => array(
                'pic' => array('name' => 'pic', 'type' => 'string', 'require' => true)
            ),
            'doSetting' => array(
                'phone' => array('name' => 'phone', 'type' => 'string', 'desc' => '联系电话'),
                'tips' => array('name' => 'tips', 'type' => 'string', 'desc' => '提示'),
                'qq' => array('name' => 'qq', 'type' => 'string', 'desc' => 'qq'),
                'qq1' => array('name' => 'qq1', 'type' => 'string', 'desc' => '客服QQ1'),
                'qq2' => array('name' => 'qq2', 'type' => 'string', 'desc' => '客服QQ2'),
            )
        );
    }


    public function setting()
    {
        $shop_setting_model = new Model_ShopSetting();
        $shop_setting = $shop_setting_model->get(1);
        $this->assign('shop_setting', $shop_setting);
        $this->view('good_setting');
    }

    public function doSetting()
    {
        $shop_setting_model = new Model_ShopSetting();
        $data = (array)$this;
        unset($data['data']);
        $shop_setting_model->update(1, $data);
        Common_Function::delShopFooterCache();//清除商城底部缓存
        Domain_Log::addLog('修改商城设置', LOG_ADMIN);
        DI()->response->setMsg('修改成功');
    }

    //View 视图区
    public function goodsCategory()
    {
        $this->assign('tips', array('当前页面显示商城的商品分类信息', '每个分类最多可以添加2层子分类', '点击右上角“添加分类”按钮，可以添加新分类'));
        $this->view('goods_category');
    }

    public function addCategory()
    {
        if ($this->id > 0) {
            $goods_category_model = new Model_GoodsCategory();
            $category = $goods_category_model->get($this->id, 'category_name,sort,id,pid,icon,ad,is_show,left_ad');
            $this->pid = $category['pid'];
            $this->assign('category', $category);
        }
        $this->assign('pid', $this->pid);
        $this->assign('id', $this->id);
        if ($this->pid > 0) {
            $goods_category_model = new Model_GoodsCategory();
            $pCategory = $goods_category_model->get($this->pid, 'category_name');
            $this->assign('category_name', $pCategory['category_name']);
        }

        $this->view('goods_category_add');
    }

    /**
     * 商品列表视图
     * @desc 商品列表视图
     */
    public function goodsList()
    {
        $this->assign('tips', array('当前页面显示商城的商品信息', '商品下架后将不会在商城内显示', '点击右上角“添加商品”按钮，可以添加一件新商品'));
        $this->assign('categorys', Domain_Goods::getGoodsCategorys());
        $this->view('goods_list');
    }

    /**
     * 添加或修改商品信息
     * @desc 添加或修改商品信息
     */
    public function addGoods()
    {
        switch ($this->tpl) {
            case 'spec':
                $spec = array('id' => Common_Function::randomString('unique'), 'title' => $this->title);
                $this->assign('spec', $spec);
                $this->view('shop/tpl/goods_spec');
                break;
            case 'specItem':
                $spec = array('id' => $this->spec_id);
                $spec_item = array('id' => Common_Function::randomString('unique'), 'title' => $this->title, 'show' => 1);
                $this->assign('spec_item', $spec_item);
                $this->assign('spec', $spec);
                $this->view('shop/tpl/goods_spec_item');
                break;
            default:
                $goods = Domain_Goods::getGoodsInfo($this->id);
                $this->assign('categorys', Domain_Goods::getGoodsCategorys());
                $this->assign('goods', $goods);
                $this->view('goods_edit');
        }

    }

    //API接口区

    /**
     * 添加或修改商品分类
     * @desc 添加或修改商品分类
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function addGoodsCategoryAC()
    {
        $result = Domain_Goods::addGoodsCategory((array)$this);
        if (is_array($result)) {
            DI()->response->setMsg(T($result['msg']));
        } else {
            throw new PhalApi_Exception_WrongException($result);
        }
        return $result;
    }


    public function goodsCategoryList()
    {
        $goods_category_model = new Model_GoodsCategory();
        $where = array();
        $result = $goods_category_model->getList($this->limit, $this->offset, $where, 'orders asc', 'id,category_name,dept,icon');
        foreach ($result['rows'] as &$list) {
            $str = '';
            for ($i = 1; $i < $list['dept']; $i++) {
                $str .= '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $list['category_name'] = $str ? $str . '|-' . $list['category_name'] : $list['category_name'];
        }
        unset($list);
        return $result;
    }


    public function DelCategory()
    {
        $rs = array('code' => 40000, 'msg' => '删除成功', 'info' => array());
        $goodsCategoryModel = new Model_GoodsCategory();
        $hasJunior = $goodsCategoryModel->hasJunior($this->id);
        if ($hasJunior) {
            $rs['code'] = 40001;
            $rs['msg'] = '存在下级不允许删除';
        } else {
            $goodsModel = new Model_Goods();
            $goodsCount = $goodsModel->getGoodsCountByCategoryId($this->id);
            if ($goodsCount) {
                $rs['code'] = 40001;
                $rs['msg'] = '该分类下存在商品不允许删除';
            } else {
                $result = $goodsCategoryModel->delete($this->id);
                if (!$result) {
                    $rs['code'] = 40001;
                    $rs['msg'] = '删除失败';
                }
            }

        }
        echo json_encode($rs);
        exit();

    }


    public function addGoodsAC()
    {
        $rs = array('code' => 40000, 'msg' => '添加成功', 'info' => array());
        $rs['url'] = Common_Function::url(array('service' => 'Goods.goodsList'));

        DI()->response->setMsg(T('添加成功'));
        $goods_model = new Model_Goods();
        $hits = '';
        if (empty($this->name)) {
            throw new PhalApi_Exception_WrongException(T('商品名称不能为空'));
        }
        if (empty($this->category_id)) {
            throw new PhalApi_Exception_WrongException(T('请选择商品分类'));
        }
        $goods_option = $this->goods_option;
        $option_title = $this->option_title;
        $options = array();
        $option_titles = array();
        if ($this->has_option == 1 && !empty($option_title)) {//拼接商品规格参数
            $post = DI()->request->getAll();
            $len = count($goods_option['option_id']);
            foreach ($option_title as $key => $title) {
                $titles = array();
                $titles['id'] = $key;
                $titles['title'] = $title;
                if (empty($title)) {
                    throw new PhalApi_Exception_WrongException(T('请填写规格名称'));
                }
                if (!isset($post['spec_item_id_' . $key])) {
                    throw new PhalApi_Exception_WrongException(T('请填写规格子项'));
                }
                foreach ($post['spec_item_id_' . $key] as $key1 => $value) {
                    $item['id'] = $post['spec_item_id_' . $key][$key1];
                    $item['show'] = $post['spec_item_show_' . $key][$key1];
                    $item['title'] = $post['spec_item_title_' . $key][$key1];
                    $titles['items'][] = $item;
                }
                $option_titles[] = $titles;
            }
            for ($i = 0; $i < $len; $i++) {
                if (empty($goods_option['option_id'][$i])) {
                    $option_id = Common_Function::randomString('unique');
                } else {
                    $option_id = $goods_option['option_id'][$i];
                }
                $option['option_id'] = $option_id;
                $option['option_stock'] = $goods_option['option_stock'][$i];
                $option['option_ids'] = $goods_option['option_ids'][$i];
                $option['option_title'] = $goods_option['option_title'][$i];
                $option['option_price'] = $goods_option['option_marketprice'][$i];
                $option['option_marketprice'] = $goods_option['option_productprice'][$i];
                $option['option_goodssn'] = $goods_option['option_goodssn'][$i];
                $option['option_productsn'] = $goods_option['option_productsn'][$i];
                $option['option_weight'] = $goods_option['option_weight'][$i];
                $options[] = $option;
            }
        }
        if ($this->id > 0) {//修改商品
            DI()->response->setMsg(T('修改成功'));
            $orgin_pics = $this->orgin_goods_pics;
            $old_pics = $this->old_goods_pics;
            $dir = API_ROOT . '/Public/static';
            foreach ($old_pics as $value) {
                if (!in_array($value, $orgin_pics)) {
                    @unlink($dir . $value);
                }
            }
            $goodspic = implode($orgin_pics, ',');
            if (empty($goodspic) && empty($this->goods_pics)) {
                throw new PhalApi_Exception_WrongException(T('商品图片不能为空'));
            }

            if (empty($hits)) {
                $goodspic .= ',' . $this->goods_pics;
                $goodspic = trim($goodspic, ',');
                $update_array = array();
                $update_array['goods_name'] = $this->name;
                $update_array['category_id'] = $this->category_id;
                $update_array['goods_pics'] = $goodspic;
                $update_array['market_price'] = $this->market_price;
                $update_array['memo'] = $this->memo;
                $update_array['price'] = $this->price;
                $update_array['edit_time'] = NOW_TIME;
                $update_array['is_rec'] = empty($this->is_rec) ? 0 : 1;
                $update_array['stock'] = $this->stock;
                $update_array['has_option'] = $this->has_option;
                $update_array['goods_option'] = json_encode($options);
                $update_array['option_title'] = json_encode($option_titles);
                $result = $goods_model->update($this->id, $update_array);
                if ($result === false) {
                    throw new PhalApi_Exception_WrongException(T('修改失败'));
                }
            }

        } else {//添加商品

            if (empty($this->goods_pics)) {
                throw new PhalApi_Exception_WrongException(T('商品图片不能为空'));
            }

            if (empty($hits)) {
                $insert_array = array();
                $insert_array['goods_name'] = $this->name;
                $insert_array['category_id'] = $this->category_id;
                $insert_array['goods_pics'] = $this->goods_pics;
                $insert_array['market_price'] = $this->market_price;
                $insert_array['memo'] = $this->memo;
                $insert_array['price'] = $this->price;
                $insert_array['stock'] = $this->stock;
                $insert_array['is_rec'] = empty($this->is_rec) ? 0 : 1;
                $insert_array['sort'] = $this->sort;
                $insert_array['add_time'] = NOW_TIME;
                $insert_array['has_option'] = $this->has_option;
                $insert_array['goods_option'] = json_encode($options);
                $insert_array['option_title'] = json_encode($option_titles);
//                var_dump($this->memo);die;
                $insertId = $goods_model->insert($insert_array);
                if (!$insertId) {
                    throw new PhalApi_Exception_WrongException(T('添加失败'));
                }
            }

        }

        return $rs;
    }

    /**
     * 获取商品列表数据
     * @desc 获取商品列表数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function getGoodsList()
    {

        $where = array();
        if (!empty($this->category_id)) {
            $where['g.category_id=?'] = $this->category_id;
        }
        if (!empty($this->goodsName)) {
            $where[' locate(?, g.name)>0'] = $this->goodsName;
        }
        return Domain_Goods::getGoodsList($this->offset, $this->limit, $where);
    }

    public function changeStatusGoods()
    {
        DI()->response->setMsg('下架成功');
        $goods_model = new Model_Goods();
        if ($this->status == 0) {
            $status = 1;
            DI()->response->setMsg('上架成功');
        } else {
            $status = 0;
        }
        $goods_model->update($this->id, array('status' => $status));
        return $status;
    }

    public function delGoods()
    {
        DI()->response->setMsg('删除成功');
        $order_goods_model = new Model_OrdersGoods();
        $where['goods_id'] = $this->id;
        $order_goods = $order_goods_model->getInfo($where, 'id');
        if (!empty($order_goods)) {
            throw new PhalApi_Exception_WrongException('该商品存在订单，请勿删除');
        }
        $goods_model = new Model_Goods();
        $result = $goods_model->delete($this->id);
        if (!$result) {
            throw new PhalApi_Exception_WrongException('删除失败');
        }
    }


    public function uploadFile()
    {
        $rs = array('code' => 40000, 'msg' => '', 'info' => array());
        if ($_FILES["pic"]["error"] > 0) {
            $rs['code'] = 40001;
            $rs['msg'] = T('failed to upload file with error: {error}', array('error' => $_FILES['file']['error']));

        } else {
            $ext = $ext = trim(strrchr($_FILES['pic']['name'], '.'), '.');
            $info = '/upload/goods/' . date('Ym');
            $dir = API_ROOT . '/Public/static' . $info;
            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }

            $url = '/' . Common_Function::randomString('unique') . '.' . $ext;

            if (!move_uploaded_file($_FILES['pic']['tmp_name'], $dir . $url)) {
                $rs['code'] = 40001;
                $rs['msg'] = '上传失败';

            }
            @unlink($_FILES['pic']['tmp_name']);
            $rs['info'] = $info . $url;
        }

        echo json_encode($rs);
        exit();
    }

    public function removeFile()
    {
        $rs = array('code' => 40000, 'msg' => '', 'info' => array());
        $dir = API_ROOT . '/Public/static';
        $fileNames = explode(',', $this->pic);
        foreach ($fileNames as $fileName) {
            if (file_exists($dir . $fileName)) {
                unlink($dir . $fileName);
            } else {
                $rs['code'] = 40001;
                $rs['msg'] .= '文件' . $fileName . ' ,';
            }
        }
        if ($rs['code'] == 40001) {
            $rs['msg'] .= '不存在';
        }

        echo json_encode($rs);
        exit();
    }

    //私有方法区
    private function foramtGoodsCategoryToGroup(&$categorys)
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