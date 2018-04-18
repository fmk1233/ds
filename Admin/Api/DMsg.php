<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/10/28
 * Time: 9:06
 */
class Api_DMsg extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'getMsgList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true,'desc'=>"开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true,'desc'=>'数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
                'reply' => array('name' => 'reply', 'type' => 'enum', 'range'=>array(-1,0,1),'default'=>-1,'require' => true,'desc'=>'类型'),
            ),
            'msgReply' => array(
                'reply' => array('name' => 'reply', 'type' => 'string','html'=>true , 'require' => true),
                'msgId' => array('name' => 'msgid', 'type' => 'int', 'default' => 0),
            ),
            'msgdetail' => array(
                'msgId' => array('name' => 'msgid', 'type' => 'int', 'require' => true)
            )
        );
    }

    /**
     * 留言信息列表
     * @desc 留言信息列表
     */
    public function msgList()
    {
        $this->assign('tips', array('当前页面显示会员发给系统的留言记录'));
        $this->view('msg_list');
    }

    public function msgDetail()
    {
        $msg_model = new Model_Msg();
        $this->assign('msg', $msg_model->get($this->msgId));
        $this->view('msg_detail');
    }


    public function msgReply()
    {

        $msg_model = new Model_Msg();
        $update['is_reply'] = 1;
        $update['reply_time'] = NOW_TIME;
        $update['reply'] = $this->reply;
        $result = $msg_model->update($this->msgId, $update);
        if (!$result) {
            throw  new PhalApi_Exception_WrongException('回复失败');
        }
        Domain_Log::addLog('回复留言信息，ID:'.$this->msgId,LOG_ADMIN);

    }


    public function getMsgList()
    {
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,'.$this->qtype.')>0'] = $this->qvalue;
        }

        if(!empty($this->s_time)){
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if($this->reply>=0){
            $where['is_reply'] = $this->reply;
        }

        if(!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $result = Domain_Msg::getList($this->limit,$this->offset,$where);
        return $result;
    }

}