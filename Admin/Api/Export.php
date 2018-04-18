<?php

/**
 * User: denn
 * Date: 2017/3/4
 * Time: 17:25
 */
class Api_Export extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'reward' => array(
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
                'columns' => array('name' => 'columns', 'type' => 'array', 'format' => 'json'),
            ),
            'userList' => array(
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                'member_state' => array('name' => 'member_state', 'type' => 'int', 'require' => true, 'desc' => '状态'),
                'tjr_name' => array('name' => 'tjr_name', 'type' => 'string', 'desc' => '推荐人编号'),
                'pre_name' => array('name' => 'pre_name', 'type' => 'string', 'desc' => '接点人编号'),
                's_time' => array('name' => 's_time', 'type' => 'string'),
                'e_time' => array('name' => 'e_time', 'type' => 'string'),
                'rank' => array('name' => 'rank', 'type' => 'int', 'desc' => '会员等级'),
            ),
            'orderList' => array(
                'state' => array('name' => 'order_state', 'type' => 'int', 'default' => -1, 'desc' => '订单状态'),
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
                'page' => array('name' => 'page', 'type' => 'int', 'default' => 1),
            ),
            'cash' => array(
                'qtype' => array('name' => 'qtype', 'type' => 'string', 'require' => true, 'desc' => '查询类型'),
                'qvalue' => array('name' => 'qvalue', 'type' => 'string', 'require' => true, 'desc' => '查询类型值'),
                's_time' => array('name' => 's_time', 'type' => 'string', 'desc' => '开始时间'),
                'e_time' => array('name' => 'e_time', 'type' => 'string', 'desc' => '结束时间'),
                'state' => array('name' => 'state', 'type' => 'int', 'default' => -1, 'desc' => '状态'),
            )
        );

    }


    /**
     * 奖金明细导出
     */
    public function reward()
    {

        $titles = array();
        $columns = $this->columns;
        $fields = '';
        foreach ($columns as $column) {
            if ($column['field'] == 'action') {
                continue;
            }
            $titles[$column['field']] = $column['title'];
            $fields .= $column['field'] . ',';
        }
        $fields = trim($fields, ',');
        $reward_model = new Model_Reward();
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }

        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        $data = $reward_model->exportList($fields, $where);
        foreach ($data as &$item) {
            if (isset($item['add_time'])) {
                $item['add_time'] = date('Y-m-d H:i:s', $item['add_time']);
            }
        }
        unset($item);
        $cvs = new Cvs();
        $cvs->filename = '奖金明细';
        array_splice($data, 0, 0, array($titles));
        $cvs->export($data);
        exit();
    }

    /**
     * 提现明细导出
     * @desc 提现明细导出
     */
    public function cash()
    {
        $titles = array();
        $titles['cash_sn'] = '提现编号';
        $titles['user_id'] = '会员ID';
        $titles['user_name'] = '会员名称';
        $titles['amount'] = '提现金额';
        $titles['fee'] = '提现手续费';
        $titles['add_time'] = '申请时间';
        $titles['bank_name'] = '收款银行';
        $titles['bank_no'] = '收款账号';
        $titles['bank_user'] = '开户姓名';
        $titles['bank_address'] = '收款地址';

        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }

        if (!empty($this->s_time)) {
            $where['add_time>=?'] = strtotime($this->s_time);
        }

        if (!empty($this->e_time)) {
            $where['add_time<=?'] = strtotime($this->e_time);
        }
        if ($this->state >= 0) {
            $where['payment_state=?'] = $this->state;
        }


        $cash_model = new  Model_Cash();
        $data = $cash_model->getListByWhere($where, 'cash_sn,user_id,user_name,amount,fee,DATE_FORMAT(FROM_UNIXTIME(add_time),\'%Y-%m-%d %H:%i:%s\') as add_time,bank_name,bank_no,bank_user,bank_address');

        $cvs = new Cvs();
        $cvs->filename = '提现明细';
        array_splice($data, 0, 0, array($titles));
        $cvs->export($data);
    }

    /**
     * 提现明细导出
     * @desc 提现明细导出
     */
    public function userList()
    {
        $titles = array();
        $titles['user_name'] = '会员编号';
        $titles['true_name'] = '会员名称';
        $titles['tjr_name'] = '推荐人';
        $titles['pre_name'] = '接点人';
        $titles['rank'] = '等级';
        $titles['reg_time'] = '申请时间';
        $titles['mobile'] = '手机号码';

        $user_model = new  Model_Users();
        $where = array();
        if (!empty($this->qvalue)) {//相关搜索的数据
            $where['locate( ? ,' . $this->qtype . ')>0'] = $this->qvalue;
        }
        if (!empty($this->tjr_name)) {
            $pid = $user_model->getInfo(array('user_name' => $this->tjr_name), 'id');
            $where['pid=?'] = $pid['id'];
        }
        if (!empty($this->pre_name)) {
            $rid = $user_model->getInfo(array('user_name' => $this->pre_name), 'id');
            $where['rid=?'] = $rid['id'];
        }

        if (!empty($this->s_time)) {
            $where['reg_time>=?'] = strtotime($this->s_time);
        }
        if (!empty($this->e_time)) {
            $where['reg_time<=?'] = strtotime($this->e_time);
        }
        if ($this->member_state == 0) {
            $where['state=?'] = $this->member_state;
        } else {
            $where['state=?'] = 1;
        }


        $data = $user_model->getListByWhere($where, 'user_name,true_name,pid,rid,rank,DATE_FORMAT(FROM_UNIXTIME(reg_time),\'%Y-%m-%d %H:%i:%s\') as reg_time,mobile');
        if (count($data) > 0) {
            foreach ($data as &$row) {
                if ($row['pid'] > 0) {
                    $tj_user = $user_model->get(intval($row['pid']), 'user_name');
                    $row['pid'] = $tj_user['user_name'];
                } else {
                    $row['pid'] = T('无');
                }
                if (POSNUM > 1) {
                    //是否双轨以上制度
                    if ($row['rid'] > 0) {
                        $pre_user = $user_model->get(intval($row['rid']), 'user_name');
                        $row['rid'] = $pre_user['user_name'];
                    } else {
                        $row['rid'] = T('无');
                    }
                }
                $row['rank'] = Common_Function::getRankName($row['rank']);
            }
            unset($row);
        }

        $cvs = new Cvs();
        $cvs->filename = '已审会员列表';
        array_splice($data, 0, 0, array($titles));
        $cvs->export($data);
    }


    public function orderList()
    {
        $file_name = '';
        $where = array();
        if (!empty($this->ordersn)) {
            $where[' locate(?, o.ordersn)>0 '] = $this->ordersn;
        }
        if (!empty($this->username)) {
            $where[' locate(?, o.buyer_name)>0 '] = $this->username;
        }

        if (!empty($this->qvalue)) {//相关搜索的数据
            if ($this->qtype == 'ordersn') {
                $where[' locate(?, o.order_sn)>0 '] = $this->qvalue;
            }
            if ($this->qtype == 'username') {
                $where[' locate(?, o.buyer_name)>0 '] = $this->qvalue;
            }
        }

        if (!empty($this->s_time)) {
            $begin_time = strtotime($this->s_time);
            $where['o.add_time>=?'] = $begin_time;
            $file_name .= '-' . date('Y-m-d', $begin_time);
        }

        if (!empty($this->e_time)) {
            $end_time = strtotime($this->e_time);
            $where['o.add_time<=?'] = $end_time;
            $file_name .= '-' . date('Y-m-d', $end_time);
        }

        if ($this->state >= 0) {
            $where['o.status=?'] = $this->state;
        }

        $file_name .= '订单明细.xlsx';

        $page_num = 1;
        $shop_order_model = new Model_ShopOrders();
        $order_goods_Model = new Model_OrdersGoods();
        $data = $shop_order_model->getListLimitByWhere($page_num, ($this->page - 1) * $page_num, $where, 'id desc', 'order_sn,add_time,status,delivery_name,delivery_sn,address,id');

        $header_arr = array();
        $header_arr[] = '订单编号';
        $header_arr[] = '下单时间';
        $header_arr[] = '订单状态';
        $header_arr[] = '快递公司';
        $header_arr[] = '快递单号';
        $header_arr[] = '收货人';
        $header_arr[] = '收货电话';
        $header_arr[] = '收货地址';
        $header_arr[] = '商品名称';
        $header_arr[] = '单价';
        $header_arr[] = '数量';
        $PHPExcel = new PHPExcel_Lite();
        $objPHPExcel = $PHPExcel->getPHPExcel();
        $objActSheet = $objPHPExcel->setActiveSheetIndex(0);

        if (PHPExcel_Lite::$column == 0) {
            $key = ord("A");
            //设置表头
            $objActSheet->getRowDimension(1)->setRowHeight(21.5);
            foreach ($header_arr as $v) {
                $colum = chr($key);
                $objActSheet->getStyle($colum . '1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objActSheet->getStyle($colum . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objActSheet->getStyle($colum . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objActSheet->setCellValue($colum . '1', $v);
                $key += 1;
            }
        }
        $column = PHPExcel_Lite::$column == 0 ? 2 : PHPExcel_Lite::$column;

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );

        foreach ($data as $key => $rows) { //行写入
            $span = ord("A");
            $objActSheet->getRowDimension($column)->setRowHeight(21.5);
            $rows['address'] = unserialize($rows['address']);
            $rows['id'] = $order_goods_Model->getOrderGoodsByOrderId($rows['id']);
            $goods_count = count($rows['id']);
            //开始的行合并
            foreach ($rows as $keyName => $value) {// 列写入
                $j = chr($span);
                switch ($keyName) {
                    case 'id':
                        foreach ($value as $key => &$good) {
                            if (!empty($good['goods_option'])) {
                                $good['goods_option'] = json_decode($good['goods_option'], true);
                                $good['guige'] = $good['goods_option']['option_title'];
                            } else {
                                $good['guige'] = '';
                            }
                            for ($i = 0; $i < 3; $i++) {
                                switch ($i) {
                                    case 0:
                                        $name = $good['goods_name'] . $good['guige'];
                                        break;
                                    case 1:
                                        $name = $good['price'];
                                        break;
                                    case 2:
                                        $name = $good['total'];
                                        break;
                                }
                                $j = chr($span + $i);
                                $objActSheet->setCellValue($j . $column, $name);
                                $objActSheet->getColumnDimension($j)->setWidth(strlen($name) + 4);
                            }
                            if ($key < $goods_count - 1) {
                                $column++;
                            }
                        }
                        unset($good);
                        continue;
                        break;
                    case 'address':
                        for ($i = 0; $i < 3; $i++) {
                            switch ($i) {
                                case 0:
                                    $name = $value['realname'];
                                    break;
                                case 1:
                                    $name = $value['mobile'];
                                    break;
                                case 2;
                                    $name = $value['address'] . ' ' . $value['city'] . ' ' . $value['area'] . ' ' . $value['address'];
                                    break;
                            }
                            $j = chr($span);
                            $objActSheet->mergeCells($j . $column . ':' . $j . ($column + $goods_count - 1));
                            $objActSheet->setCellValue($j . $column, $name);
                            $objActSheet->getColumnDimension($j)->setWidth(strlen($name) + 4);
                            if ($i < 2) {
                                $span++;
                            }
                        }

                        break;
                    case 'status':
                        $value = Domain_ShopOrders::orderStatus($value);
                    default:
                        $objActSheet->mergeCells($j . $column . ':' . $j . ($column + $goods_count - 1));
                        $objActSheet->setCellValue($j . $column, $value);
                        $len = strlen($value);
                        $objActSheet->getColumnDimension($j)->setWidth($len==0?10:$len + 4);
                }

                $span++;
            }
            $column++;
        }
        PHPExcel_Lite::$column = $column;

        if (count($data) < $page_num) {
            $objPHPExcel->getActiveSheet()->getStyle('A0:'.chr(ord('A')+count($header_arr)-1) . ($column - 1))->applyFromArray($styleArray);
            $file_name = iconv("utf-8", "gb2312", $file_name);
            ob_end_clean();
            //设置活动单指数到第一个表,所以Excel打开这是第一个表
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=\"$file_name\"");
            header('Cache-Control: max-age=0');

            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, PHPExcel_Lite::getExcelType($file_name));
            $objWriter->save('php://output'); //文件通过浏览器下载
            exit;
        } else {
            $this->page++;
            register_shutdown_function(array(&$this, 'orderList'));
        }


    }

}