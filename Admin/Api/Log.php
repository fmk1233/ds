<?php

/**
 * Class Api_Log 系统日志
 */
class Api_Log extends Api_DCommon
{
    public function getRules()
    {
        return array(
            'addLog'=>array(
                'memo'=>array('name'=>'memo','type'=>'string'),
                'log_type'=>array('name'=>'log_type','type'=>'int'),
                'add_time'=>array('name'=>'add_time','type'=>'int'),
            ),
            'logList'=>array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true, 'desc' => "开始位置"),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true, 'desc' => '数量'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true,'desc'=>'查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true,'desc'=>'查询类型值'),
                's_time'=>array('name'=>'s_time','type'=>'string'),
                'e_time'=>array('name'=>'e_time','type'=>'string'),
                'log_type'=>array('name'=>'log_type','type'=>'int','default'=>-1),
            ),
            'delLog'=>array(
                'id'=>array('name'=>'id','type'=>'int','require'=>TRUE),
            )
        );
    }


    public function logListView()
    {
        $this->assign('tips', array('当前页面显示系统运行日志列表','当系统出现异常时，可以在此查询进行排查'));
        $this->view('log_list');
    }

    /**
     * @desc 获取日志列表
     * @return array 日志列表
     * @internal param $limit
     * @internal param $offset
     * @internal param array $where
     */
    public function logList(){
        $log_domain = new Domain_Log();
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,'.str_replace('member-','',$this->qtype).')>0'] = $this->qvalue;
        }

        if($this->log_type>=0){
            $where['log_type=?'] = $this->log_type;
        }

        if(!empty($this->s_time)){
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if(!empty($this->e_time)){
            $where['add_time<=?'] = strtotime($this->e_time);
        }

        $log_list = $log_domain->getLogList($this->limit,$this->offset,$where);
        return $log_list;
    }

    /**
     * @desc 删除日志
     * @internal int
     */
    public function delLog()
    {
        $result = array('code'=>40000,'msg'=>'','info'=>array());
        $log_model = new Model_Log();
        $log_model->delete($this->id);
        echo json_encode($result);die;
    }
}