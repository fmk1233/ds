<?php

/**
 * Created by .
 * User: denn
 * Date: 2016/12/30
 * Time: 22:08
 */
class Api_Logistics extends Api_DCommon
{
    public function getRules()
    {
        return array(
            'getLogcomList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true),
            ),
            'AddLogcomAC' => array(
                'company' => array('name' => 'company', 'type' => 'string', 'require' => true),
                'address' => array('name' => 'address', 'type' => 'string', 'require' => true),
                'tel' => array('name' => 'tel', 'type' => 'string', 'require' => true),
                'contact' => array('name' => 'contact', 'type' => 'string', 'require' => true),
                'url' => array('name' => 'url', 'type' => 'string', 'require' => true),
                'code' => array('name' => 'code', 'type' => 'string', 'require' => true),
                'memo' => array('name' => 'memo', 'type' => 'string', 'require' => true),
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            ),
            'logcomAdd' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            ),
            'delLogcom' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            ),
        );
    }


    //View 视图区
    public function logcomList()
    {
        $this->assign('tips', array('当前页面显示商城物流公司信息','公司代号需填写正确，否则无法正确获取物流信息','点击右上方“添加物流公司”按钮，可以新增一条物流公司信息'));
        $this->view('logcom_list');
    }

    public function downComcode()
    {
        $filepath = API_ROOT . '/Public/data/KuaidiCode.doc';
        header('Content-Description: File Transfer');

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        ob_clean();
        flush();
        readfile($filepath);
        die;
    }


    public function logcomAdd()
    {
        if ($this->id > 0) {
            $logisticModel = new Model_Logistic();
            $logcom = $logisticModel->get($this->id);
        } else {
            $logcom = array();
            $logcom['company'] = '';
            $logcom['address'] = '';
            $logcom['tel'] = '';
            $logcom['contact'] = '';
            $logcom['url'] = '';
            $logcom['code'] = '';
            $logcom['id'] = 0;
        }
        $this->assign('logcom', $logcom);
        $this->view('logcom_edit');
    }


    //API接口区
    public function AddLogcomAC()
    {

        $logistic_model = new Model_Logistic();

        DI()->response->setMsg(T('修改成功'));

        if ($this->id > 0) {

            if (empty($hits)) {
                $updateArray = array();
                $updateArray['company'] = $this->company;
                $updateArray['address'] = $this->address;
                $updateArray['tel'] = $this->tel;
                $updateArray['contact'] = $this->contact;
                $updateArray['url'] = $this->url;
                $updateArray['code'] = $this->code;
                $updateArray['memo'] = $this->memo;
                $result = $logistic_model->update($this->id, $updateArray);
                if ($result === false) {
                    throw new PhalApi_Exception_WrongException(T('修改失败'));
                }
            }

        } else {
            DI()->response->setMsg(T('添加成功'));
            if (empty($hits)) {
                $insertArray = array();
                $insertArray['company'] = $this->company;
                $insertArray['address'] = $this->address;
                $insertArray['tel'] = $this->tel;
                $insertArray['contact'] = $this->contact;
                $insertArray['url'] = $this->url;
                $insertArray['code'] = $this->code;
                $insertArray['memo'] = $this->memo;
                $insertArray['add_time'] = NOW_TIME;

                $insertId = $logistic_model->insert($insertArray);
                if (!$insertId) {
                    throw new PhalApi_Exception_WrongException(T('添加失败'));
                }
            }

        }

        return array('url' => Common_Function::url(array('service'=>'Logistics.LogcomList')));
    }

    public function getLogcomList()
    {
        $logistic_model = new Model_Logistic();
        $where = array();
        $lists = $logistic_model->getList($this->limit, $this->offset, $where);
        return $lists;
    }

    public function delLogcom()
    {
        DI()->response->setMsg(T('删除成功'));
        $logistic_model = new Model_Logistic();
        $result = $logistic_model->delete($this->id);
        if ($result == false) {
            throw new PhalApi_Exception_WrongException(T('删除失败'));
        }

    }

}