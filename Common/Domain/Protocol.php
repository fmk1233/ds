<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/26
 * Time: 16:01
 */
class Domain_Protocol
{

    /**
     * 查询新闻公告明细数据列表
     * @param int $limit 数据每次查询条数
     * @param int $offset 数据查询开始位置
     * @param $where  查询条件
     * @return array 返回数据结果
     */
    public static function getList($limit,$offset,$where)
    {
        $protocol_model = new Model_Protocol();
        $list = $protocol_model->getList($limit,$offset,$where,'state desc , add_time desc');
        foreach ($list['rows'] as &$item) {
            $item['content'] = html_entity_decode($item['content']);
        }
        unset($item);
        return $list;
    }

    public static function isOpen()
    {
        return array(
            0=>T('未开启'),
            1=>T('已开启')
        );
    }

}