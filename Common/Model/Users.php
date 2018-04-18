<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/25
 * Time: 18:44
 */
class Model_Users extends PhalApi_Model_NotORM
{


    /**
     * @var string 推荐图谱关联user表表明
     */
    private $parent = 'parent_user';

    /**
     * @var string 接点图谱关联user表表明
     */
    private $contact = 'contact_user';
    private $bonus = 'bonus';

    /**
     * @param array $where
     * @return int
     */
    public function getUsersCount($where = array())
    {
        return (int)$this->getORM()->where($where)->count('*');
    }

    /**
     * @param $limit
     * @param $offset
     * @param array $where
     * @return mixed
     */
    public function getUsers($limit, $offset, $where = array())
    {
        $where = $this->parseSearchWhere($where);
        return $this->getORM()->where($where)->order('id desc')->limit($offset, $limit)->fetchRows();
    }

    public function getUserByUserName($userName, $fields = '*')
    {
        return $this->getORM()->select($fields)->where('user_name=? or mobile=?', $userName, $userName)->fetchRow();
    }

    public function getUserByRidAndPos($rid, $pos, $fields = '*')
    {
        return $this->getORM()->select($fields)->where('rid=? and pos=?', $rid, $pos)->fetchRow();
    }

    public function deleteUsersByUserIds($userIds)
    {
        return $this->getORM()->where("id in ({$userIds})")->delete();
    }

    public function findRegisterPos($uid)
    {
        $sql = "select u.id,u.user_name from {$this->prefix}user as u join  {$this->prefix}rel_users as relu on u.id=relu.uid join {$this->prefix}rusers as ru on relu.uid=ru.uid where ru.pid=? and relu.pos_num<? order by   relu.pos_num asc ,ru.dept asc , ru.id asc  limit 1";
        $params[] = $uid;
        $params[] = POSNUM;
        $result = $this->getORM()->queryRows($sql, $params);
        return $result[0];
    }

    public function openUsersByUserIds($userIds)
    {
        return $this->getORM()->where("id in ({$userIds})")->update(array('state' => 1, 'pdt' => NOW_TIME));
    }


    public function getUserByStateAndPidCount($pid, $state)
    {
        return $this->getORM()->where('pid=? and state=?', $pid, $state)->count('id');
    }

    public function getUserByStateAndPid($pid, $state, $limit, $offset, $field = '*')
    {
        return $this->getORM()->select($field)->where('pid=? and state=?', $pid, $state)->limit($offset, $limit)->order('id desc')->fetchRows();
    }

    public function checkField($field, $value, $fields = 'id')
    {
        return $this->getORM()->select($fields)->where("{$field}=?", $value)->fetchRow();
    }

    public function changeBouns($uid, $money, $money_type)
    {
        $field = BONUS_NAME . $money_type;
        $prefix = $this->prefix;
        $table_name = $this->getTableName($uid);
        $sql = "update {$prefix}{$table_name} set {$field}={$field}+:money where id=:uid";
        $params[':money'] = $money;
        $params[':uid'] = $uid;
        return $this->getORM()->queryExecute($sql, $params);
    }

    public function getDirectChild($pid)
    {
        return $this->getORM()->select('id,user_name,state')->where('pid=?', $pid)->fetchRows();
    }

    public function getUnPayUsers()
    {
        $lastTime = NOW_TIME - DI()->config->get('setting.b29') * 24 * 3600;
        $lastTime2 = NOW_TIME - DI()->config->get('setting.b26') * 24 * 3600;
        return $this->getORM()->select('id')->where(' (state=0 and regtime<?) or (state=1 and fenh_dt<?)', $lastTime, $lastTime2)->fetchRows();
    }

    /**
     * 清空会员数据
     */
    public function clearUserData()
    {
        $this->getORM()->where('id>0')->delete();
    }

    /**
     * 插入推荐图谱关系数据，以确保推荐关系的确立
     * @param long $user_id 用户ID
     * @param long $pid 推荐人ID
     * @param long $state 会员自己的激活状态
     * @return boolean 返回执行结果
     */
    public function insertParentNet($user_id, $pid, $state = 0)
    {
        $insert_p = $this->queryExecute("insert into {$this->prefix}{$this->parent} (pid,user_id,dept,state) values(?,?,1,?)", array($pid, $user_id, $state));//插入自己与上级的推荐关系图
        if ($insert_p == false) {
            return false;
        }
        $insert_ps = $this->queryExecute("insert into {$this->prefix}{$this->parent} (pid,user_id,dept,state) select pid,?,dept+1,? from {$this->prefix}{$this->parent} where user_id=?", array($user_id, $state, $pid));//插入推荐人的所有上级的数据，并将用户id改为自己

        if ($insert_ps === false) {
            return false;
        }
        return true;

    }

    /**
     * 脱离推荐关系图
     * @param long $user_id 用户ID
     * @param int $pid 推荐人ID
     * @param int $tjdept 当前用户推荐深度
     * @return bool 返回结果
     */
    public function outParentNet($user_id, $pid, $tjdept)
    {
        $model_name = $this->getTableName($user_id);
        //更新所有的下级和自己的tjdept和自己的pid
        $update_user = $this->queryExecute("update {$this->prefix}{$model_name} set tjdept=tjdept-? ,pid=CASE when id=? THEN 0 ELSE pid END where id in (select user_id from {$this->prefix}{$this->parent} where pid=? ) or id=? ", array($tjdept - 1, $user_id, $user_id, $user_id));
        if ($update_user == false) {
            return false;
        }


        //脱离所有下级的跟我的上级的关系
        $update_juniors_parent = $this->queryExecute("delete from {$this->prefix}{$this->parent} where  user_id in ( select u.user_id from (select user_id from {$this->prefix}{$this->parent} where pid=? )  u) and pid in (select p.pid from (select pid from {$this->prefix}{$this->parent} where user_id=? )  p ) ", array($user_id, $user_id));
        if ($update_juniors_parent === false) {
            return false;
        }

        //脱离跟上级的关系
        $update_parent = $this->queryExecute("delete from {$this->prefix}{$this->parent} where user_id=?", array($user_id));
        if ($update_parent == false) {
            return false;
        }
        return true;
    }


    /**
     * 删除会员，对应的推荐关系图谱
     * @param long $user_id 用户ID
     * @param int $tjdept 当前用户推荐深度
     * @return bool 返回结果
     */
    public function delParentNet($user_id, $tjdept)
    {
        $model_name = $this->getTableName($user_id);

        //更新我的所有下级的推荐dept
        $update_user = $this->queryExecute("update {$this->prefix}{$model_name} set tjdept=tjdept-?  where id in (select user_id from {$this->prefix}{$this->parent} where pid=? ) ", array($tjdept, $user_id));
        if ($update_user === false) {
            return false;
        }

        //脱离所有下级的跟我的上级和我的关系
        $update_juniors_parent = $this->queryExecute("delete from {$this->prefix}{$this->parent} where ( user_id in ( select u.user_id from (select user_id from {$this->prefix}{$this->parent} where pid=? )  u) and pid in (select p.pid from (select pid from {$this->prefix}{$this->parent} where user_id=? )p ) ) or (pid=?) ", array($user_id, $user_id, $user_id));
        if ($update_juniors_parent === false) {
            return false;
        }

        //脱离我自己跟上级的关系
        $update_parent = $this->queryExecute("delete from {$this->prefix}{$this->parent} where user_id=?", array($user_id));
        if ($update_parent == false) {
            return false;
        }
        return true;
    }

    /**
     * 重新接入推荐关系图
     * @param long $user_id 用户ID
     * @param int $pid 推荐人ID
     * @param int $tjdept 推荐人所在深度
     * @param int $state 重新接入会员的状态
     * @return bool 返回结果
     */
    public function accessParentNet($user_id, $pid, $tjdept, $state = 0)
    {
        $model_name = $this->getTableName($user_id);
        $update_user = $this->queryExecute("update {$this->prefix}{$model_name} set tjdept=tjdept+? ,pid=CASE when id=? THEN ? ELSE pid END where id in (select user_id from {$this->prefix}{$this->parent} where pid=? ) or id=? ", array($tjdept, $user_id, $pid, $user_id, $user_id));
        if ($update_user == false) {
            return false;
        }


        //重新插入推荐关系图谱
        $insert_parent = $this->insertParentNet($user_id, $pid, $state);
        if ($insert_parent === false) {
            return false;
        }

        //插入我的下级跟我的上级的关系图谱
        $insert_juniors_ps = $this->queryExecute("insert into {$this->prefix}{$this->parent} (pid,user_id,dept,state) (select a.pid ,p.user_id,a.dept+p.dept,?  from {$this->prefix}{$this->parent} as a INNER JOIN {$this->prefix}{$this->parent} as p on a.user_id=p.pid  where  a.user_id=? ) ", array($state, $user_id));//插入推荐人的所有上级的数据，并将用户id改为自己
        if ($insert_juniors_ps === false) {
            return false;
        }

        return true;

    }

    /**
     * 插入接点图谱关系数据，以确保接点关系的确立
     * @param long $user_id 用户ID
     * @param long $rid 接点人ID
     * @param int $pos 接点位置
     * @param int $state 会员的状态
     * @return bool 返回结果
     */
    public function insertContactNet($user_id, $rid, $pos, $state = 0)
    {
        $insert_c = $this->queryExecute("insert into {$this->prefix}{$this->contact} (pid,user_id,dept,pos,state) values(?,?,1,?,?)", array($rid, $user_id, $pos, $state));//插入自己与上级的推荐关系图
        if ($insert_c == false) {
            return false;
        }

        //修改上级的pos_num值
        $update_senior = $this->update($rid, array('pos_num' => new NotORM_Literal('pos_num+1')));
        if ($update_senior == false) {
            return false;
        }

        $insert_cs = $this->queryExecute("insert into {$this->prefix}{$this->contact} (pid,user_id,dept,pos,state) select pid,?,dept+1,pos,? from {$this->prefix}{$this->contact} where user_id=?", array($user_id, $state, $rid));//插入推荐人的所有上级的数据，并将用户id改为自己
        if ($insert_cs === false) {
            return false;
        }
        return true;

    }


    /**
     * 脱离接点关系图
     * @param long $user_id 用户ID
     * @param long $rid 接点人ID
     * @param int $pos 接点位置
     * @param int $gldept 接点的深度
     * @return bool
     */
    public function outContactNet($user_id, $rid, $gldept)
    {
        $model_name = $this->getTableName($user_id);
        //更新所有的下级和自己的gldept和自己的pid
        $update_user = $this->queryExecute("update {$this->prefix}{$model_name} set gldept=gldept-? ,rid=CASE when id=? THEN 0 ELSE rid END where id in (select user_id from {$this->prefix}{$this->parent} where rid=? ) or id=? ", array($gldept - 1, $user_id, $user_id, $user_id));
        if ($update_user == false) {
            return false;
        }

        //修改上级的pos_num值
        $update_senior = $this->update($rid, array('pos_num' => new NotORM_Literal('pos_num-1')));
        if ($update_senior == false) {
            return false;
        }

        //脱离所有下级的跟我的上级的关系
        $update_juniors_con = $this->queryExecute("delete from {$this->prefix}{$this->contact} where  user_id in ( select u.user_id from (select user_id from {$this->prefix}{$this->contact} where pid=? )  u) and pid in (select p.pid from (select pid from {$this->prefix}{$this->contact} where user_id=? )  p ) ", array($user_id, $user_id));
        if ($update_juniors_con === false) {
            return false;
        }

        $update_contact = $this->queryExecute("delete from {$this->prefix}{$this->contact} where user_id=?", array($user_id));
        if ($update_contact == false) {
            return false;
        }
        return true;
    }

    /**
     * 删除会员，对应的接点关系图谱
     * @param long $user_id 用户ID
     * @param int $tjdept 当前用户推荐深度
     * @return bool 返回结果
     */
    public function delContactNet($user_id, $gldept)
    {
        $model_name = $this->getTableName($user_id);

        //更新我的所有下级的推荐dept
        $update_user = $this->queryExecute("update {$this->prefix}{$model_name} set gldept=gldept-?  where id in (select user_id from {$this->prefix}{$this->contact} where pid=? ) ", array($gldept, $user_id));
        if ($update_user === false) {
            return false;
        }

        //脱离所有下级的跟我的上级和我的关系
        $update_juniors_parent = $this->queryExecute("delete from {$this->prefix}{$this->contact} where ( user_id in ( select u.user_id from (select user_id from {$this->prefix}{$this->contact} where pid=? )  u) and pid in (select p.pid from (select pid from {$this->prefix}{$this->contact} where user_id=? )p ) ) or (pid=?) ", array($user_id, $user_id, $user_id));
        if ($update_juniors_parent === false) {
            return false;
        }

        //脱离我自己跟上级的关系
        $update_parent = $this->queryExecute("delete from {$this->prefix}{$this->contact} where user_id=?", array($user_id));
        if ($update_parent == false) {
            return false;
        }
        return true;
    }


    /**
     * 重新接入安置关系图
     * @param long $user_id 用户ID
     * @param int $rid 接点人ID
     * @param int $pos 接点人位置
     * @param int $gldept 推荐人所在深度
     * @param int $state 重新接入会员的状态
     * @return bool 返回结果
     */
    public function accessContactNet($user_id, $rid, $pos, $gldept, $state = 0)
    {
        $model_name = $this->getTableName($user_id);
        $update_user = $this->queryExecute("update {$this->prefix}{$model_name} set gldept=gldept+? ,rid=CASE when id=? THEN ? ELSE rid END where id in (select user_id from {$this->prefix}{$this->parent} where rid=? ) or id=? ", array($gldept, $user_id, $rid, $user_id, $user_id));
        if ($update_user == false) {
            return false;
        }

        //重新插入推荐关系图谱
        $insert_contact = $this->insertContactNet($user_id, $rid, $pos, $state);
        if ($insert_contact === false) {
            return false;
        }

        //插入我的下级跟我的上级的关系图谱
        $insert_juniors_con = $this->queryExecute("insert into {$this->prefix}{$this->contact} (pid,user_id,dept,pos,state) (select a.pid ,p.user_id,a.dept+p.dept,a.pos,?  from {$this->prefix}{$this->contact} as a INNER JOIN {$this->prefix}{$this->contact} as p on a.user_id=p.pid  where  a.user_id=? ) ", array($state, $user_id));//插入推荐人的所有上级的数据，并将用户id改为自己
        if ($insert_juniors_con === false) {
            return false;
        }

        return true;

    }

    /**
     * 大公排获取上级ID
     */
    public function getContactAutoUser($user_id = 0)
    {

        if ($user_id == 0) {
            $condition = array();
            $condition['pos_num<? and state>0 '] = POSNUM;
            return $this->getORM()->select('id,user_name,pos_num')->where($condition)->order('gldept asc ,id asc')->fetchRow();
        } else {
            $sql = "select u.user_name,u.pos_num from {$this->prefix}users as u LEFT join {$this->prefix}{$this->contact} as c on u.id=c.user_id where c.pid=? and u.pos_num<? and u.state>0 order by u.gldept asc ,id asc";
            $result = $this->getORM()->queryAll($sql, array($user_id, POSNUM));
            return isset($result[0]) ? $result[0] : false;

        }

    }


    /**
     * 修改会员状态变化
     * @param $user_id 会员ID
     * @param $state    会员状态
     * @return bool 执行结果
     */
    public function changeState($user_id, $state)
    {
        $update_user = $this->update($user_id, array('state' => $state));
        if ($update_user == false) {//更新会员状态失败或者影响0行
            return false;
        }
        $update_par_user = $this->queryExecute("update {$this->prefix}{$this->parent} set state=? where user_id=? ", array($state, $user_id));
        if ($update_par_user === false) {//更新会员推荐关系子表会员状态失败
            return false;
        }
        $update_con_user = $this->queryExecute("update {$this->prefix}{$this->contact} set state=? where user_id=? ", array($state, $user_id));
        if ($update_con_user === false) {//更新会员接点关系子表会员状态失败
            return false;
        }
        return true;

    }


    /**
     * 删除会员
     * @param $user_id
     * @return bool
     */
    public function delMember($user_id)
    {
        $user_id = intval($user_id);
        $user = $this->get($user_id, 'tjdept,gldept');
        $del_parent_result = $this->delParentNet($user_id, $user['tjdept']);
        if ($del_parent_result === false) {
            return false;
        }
        if (POSNUM > 1) {//存在接点关系的时候删除
            $del_contact_result = $this->delContactNet($user_id, $user['gldept']);
            if ($del_contact_result === false) {
                return false;
            }
        }


        $del_result = $this->getORM()->where('id=?', $user_id)->delete();
        if ($del_result == false) {
            return false;
        }

        return true;
    }

    /**
     * 获取所有接点上级的ID
     * @param $uid
     * @return mixed
     */
    public function getContactUsers($where, $field = 'pid', $order = 'dept asc')
    {
        $contact = $this->contact;
        $ids = DI()->notorm->$contact->select($field)->order($order)->where($where)->fetchAll();
        return $ids;
    }


    /**
     * 获取接点关系某个会员的上级团队或者下级团队的用户信息
     * @param $where 查询条件 此条件中必须有$where['c.pid=?']=1或者$where['c.user_id=?']=1这样的条件
     * @param string $field 查询字段
     * @param string $order 插叙排序
     * @return array
     */
    public function getContactUsersByJoin($where, $field = 'u.*', $order = 'u.id desc')
    {
        $name = $this->getORM();
        $condition = Common_Function::parseSearchWhere($where, true);
        $sql = "select {$field} from {$this->prefix}{$name} as u left join  {$this->prefix}{$this->contact} as c on u.id=c.user_id {$condition['sql']} {$order}";
        $params = $where['params'];
        return $this->getORM()->queryRows($sql, $params);

    }

    /**
     * 获取所有接点关系的数量
     * @param $uid
     * @return mixed
     */
    public function getContactCount($condition)
    {
        $contact = $this->contact;
        $num = DI()->notorm->$contact->where($condition)->count();
        return intval($num);
    }


    /**
     * 获取所有推荐上级的ID
     * @param $uid
     * @return mixed
     */
    public function getParentUsers($where, $field = 'pid', $order = 'dept asc')
    {
        $parent = $this->parent;
        $ids = DI()->notorm->$parent->select($field)->order($order)->where($where)->fetchAll();
        return $ids;
    }

    /**
     * 获取推荐关系某个会员的上级团队或者下级团队的用户信息
     * @param $where 查询条件 此条件中必须有$where['p.pid=?']=1或者$where['p.user_id=?']=1这样的条件
     * @param string $field 查询字段
     * @param string $order 插叙排序
     * @return array
     */
    public function getParentUsersByJoin($where, $field = 'u.*', $order = 'u.id desc')
    {
        $name = $this->getORM();
        $condition = Common_Function::parseSearchWhere($where, true);
        $sql = "select {$field} from {$this->prefix}{$name} as u left join  {$this->prefix}{$this->parent} as p on u.id=p.user_id {$condition['sql']} {$order}";
        $params = $where['params'];
        return $this->getORM()->queryRows($sql, $params);

    }

    /**
     * 获取所有推荐关系的数量
     * @param $uid
     * @return mixed
     */
    public function getParentCount($condition)
    {
        $parent = $this->parent;
        $num = DI()->notorm->$parent->where($condition)->count();
        return intval($num);
    }


    public function emptyMoney()
    {
        $lasttime = DI()->config->get('setting.b22');
        return $this->getORM()->where('daytime<?', NOW_TIME - $lasttime * 24 * 3600)->update(array('money' => 0));
    }

    public function getBrotherUsers($user_id)
    {
        $contact = DB_PREFIX.$this->contact;
        $sql = sprintf('select s.pid,s.user_id,s.pos,s.dept ,(select user_id from %s where pid=s.pid and pos=if(s.pos=1,2,1) and p_status=0 and state=1 order by dept ASC limit 1) as b_user_id from %s as s where user_id=?', DB_PREFIX . $contact, DB_PREFIX . $contact);
        $params[] = $user_id;
        $result = $this->getORM()->queryRows($sql, $params);
        return $result;
    }

    /**
     * 获取可以对碰的兄弟节点
     */
    public function getBrotherUser($user)
    {
        $contact = $this->contact;
        $sql = "select user_id from {$this->prefix}{$contact}  where pid=? and pos=? and p_status=0 and state=1 order by dept ASC limit 1";
        $params[] = intval($user['pid']);
        $params[] = $user['pos'] == 1 ? 2 : 1;
        $result = $this->getORM()->queryRows($sql, $params);
        return $result ? $result[0] : false;

    }


    /**
     * 获取报单金额统计
     * @param $where
     */
    public function getBdMoney($where = array())
    {
        return floatval($this->getORM()->where($where)->sum('bdmoney'));

    }

    /**
     * 更新接点图谱子表
     * @param $where
     * @param $data
     * @return mixed
     */
    public function updateContact($where, $data)
    {
        $contact = $this->contact;
        return DI()->notorm->$contact->where($where)->update($data);
    }


    /**
     * 判断是否为异常会员
     * @param $user_id
     * @return int
     */
    public function isExpUser($user_id)
    {
        $table_name = $this->getTableName($user_id);
        $sql = "select count(u.id) from {$this->prefix}{$table_name} as u where u.id=? and (b0+b1+b2+b3+b4)>(select ifnull(sum(money),0) from {$this->prefix}{$this->bonus} where user_id=u.id and frezze_state=? )";
        $params[] = $user_id;
        $params[] = BONUS_UNFREZZE;
        foreach ($this->getORM()->query($sql, $params)->fetch() as $return) {
            return (int)$return;
        }

    }

    /**
     * @param $where
     * @return int
     */
    public function getExpListCount($where)
    {
        $table_name = $this->getTableName(0);
        $sql = "select count(u.id) from {$this->prefix}{$table_name} as u where {$where['sql']}  (b0+b1+b2+b3+b4)>(select ifnull(sum(money),0) from {$this->prefix}{$this->bonus} where user_id=u.id and frezze_state=? )";
        $params = $where['params'];
        $params[] = BONUS_UNFREZZE;
        foreach ($this->getORM()->query($sql, $params)->fetch() as $return) {
            return (int)$return;
        }
    }

    /**
     * @param $limit
     * @param $offset
     * @param $where
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getExpList($limit, $offset, $where, $order = 'id desc', $field = '*')
    {
        $table_name = $this->getTableName(0);
        $sql = "select {$field} from {$this->prefix}{$table_name} as u where {$where['sql']}  (b0+b1+b2+b3+b4)>(select ifnull(sum(money),0) from {$this->prefix}{$this->bonus} where user_id=u.id and frezze_state=? ) order by {$order} limit ?,?";
        $params = $where['params'];
        $params[] = BONUS_UNFREZZE;
        $params[] = $offset;
        $params[] = $limit;
        return $this->getORM()->queryAll($sql, $params);
    }


    protected function getTableName($id)
    {
        return 'user';
    }

}