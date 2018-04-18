<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/30
 * Time: 10:05
 */
class Model_Goods extends PhalApi_Model_NotORM
{

    /**
     * @var string 商品分类表名
     */
    private $category = 'shop_good_category';

    /**
     * @param $where
     * @return mixed
     */
    public function getGoodsCount($where)
    {

        $table_name = $this->getTableName(0);
        $sql = "select count(g.id) from {$this->prefix}{$table_name} as g INNER join {$this->prefix}{$this->category} as gc  on gc.id=g.category_id {$where['sql']} ";

        foreach ($this->getORM()->query($sql, $where['params'])->fetch() as $return) {
            return $return;
        }
    }

    public function getGoodsInfo($where = array(), $field = '*')
    {
        $info = $this->getInfo($where, $field);
        if (isset($info['memo'])) {
            $info['memo'] = html_entity_decode($info['memo']);
        }
        if (isset($info['goods_option'])) {
            $info['goods_option'] = json_decode($info['goods_option'], true);
        }
        if (isset($info['option_title'])) {
            $info['option_title'] = json_decode($info['option_title'], true);
        }
        return $info;
    }

    /**
     * @param $limit
     * @param $offset
     * @param array $where
     * @return array
     */
    public function getGoods($limit, $offset, $where = array(), $order = 'g.id desc')
    {
        $table_name = $this->getTableName(0);
        $sql = "select g.* ,gc.category_name  from {$this->prefix}{$table_name} as g INNER join {$this->prefix}{$this->category} as gc  on gc.id=g.category_id {$where['sql']}  order by {$order}  limit ?,?";
        $params = $where['params'];
        $params[] = $offset;
        $params[] = $limit;
        return $this->getORM()->queryAll($sql, $params);
    }

    public function getGoodsCountByCategoryId($categoryId)
    {
        return $this->getORM()->where('category_id=?', $categoryId)->count('*');
    }

    public function getListByWhereAndLimit($condition = array(), $limit = 10, $field = '*', $order = 'id desc')
    {
        return $this->getORM()->where($condition)->select($field)->limit($limit)->order($order)->fetchAll();
    }

    protected function getTableName($id)
    {
        return 'shop_goods';
    }

}