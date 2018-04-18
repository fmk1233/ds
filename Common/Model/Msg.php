<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/27
 * Time: 23:16
 */
class Model_Msg extends PhalApi_Model_NotORM
{


    /**
     * 获取留言信息条数
     * @param $condition 查询条件
     * @return int
     */
    public function getCountByCondition($condition)
    {
        return (int)$this->getORM()->where($condition)->count('*');
    }


    public function getMsgListByUid($uid,$limit=10,$offset=0){
        return $this->getORM()->where('uid=?',$uid)->limit($offset,$limit)->order('id desc')->fetchRows();
    }
    public function getMsgListByUidCount($uid){
        return $this->getORM()->where('uid=?',$uid)->count();
    }

    public function getMsgListByType($type,$limit=10,$offset=0){
        $prefix = DB_PREFIX;
        $sql = "select m.*,u.user_name as userName from {$prefix}msg as m join {$prefix}user u on u.id=m.uid where  m.is_reply=? order by m.id DESC limit ?,?  ";

        $params[] = $type;
        $params[] = $offset;
        $params[] = $limit;
        return $this->getORM()->queryRows($sql,$params);
    }
    public function getMsgListByTypeCount($type){
        return $this->getORM()->where('is_reply=?',$type)->count();
    }

    protected function getTableName($id)
    {
        return 'msg';
    }
}