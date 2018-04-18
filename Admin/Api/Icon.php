<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/1/3
 * Time: 13:52
 */
class Api_Icon extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'iconAdd' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            ),
            'iconAddAc' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'name' => array('name' => 'title', 'type' => 'string', 'default' => ''),
                'category' => array('name' => 'category', 'type' => 'enum','range'=>array(0,1,2,3,4), 'desc'=>'幻灯片分类'),
                'url' => array('name' => 'url', 'type' => 'string', 'default' => ''),
                'icon' => array('name' => 'orgin_icon', 'type' => 'string', 'default' => ''),
                'sort' => array('name' => 'sort', 'type' => 'int', 'min' => 0, 'max' => 127, 'default' => 0),
                'is_rec' => array('name' => 'is_rec', 'type' => 'int', 'min' => 0, 'max' => 1, 'default' => 0),
            ),
            'getIconList' => array(
                'offset' => array('name' => 'offset', 'type' => 'int', 'require' => true),
                'limit' => array('name' => 'limit', 'type' => 'int', 'require' => true),
            ),
            'chageStatus' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0),
                'is_rec' => array('name' => 'is_rec', 'type' => 'int', 'default' => 0)
            ),
            'delIcon' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'default' => 0)
            )
        );
    }

    /**
     * 幻灯片图片列表数据
     * @desc 幻灯片图片列表数据
     */
    public function iconList()
    {
        $this->view('icon_list');
    }

    /**
     * 添加或修改幻灯片数据
     * @desc 添加或修改幻灯片数据
     */
    public function iconAdd()
    {
        if ($this->id > 0) {
            $icon_model = new Model_Icon();
            $icon = $icon_model->get($this->id);
        } else {
            $icon = array();
            $icon['name'] = '';
            $icon['icon'] = '';
            $icon['url'] = '';
            $icon['category'] = 0;
            $icon['sort'] = 127;
            $icon['is_rec'] = 0;
            $icon['id'] = 0;
        }
        $this->assign('icon', $icon);
        $this->view('icon_add');
    }

    /**
     * 获取幻灯片数据
     * @desc 获取幻灯片数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return null d.data 返回的数据信息
     */
    public function getIconList()
    {
        $icon_model = new Model_Icon();
        $where = array();
        $lists = $icon_model->getList($this->limit, $this->offset, $where);
        return $lists;
    }


    /**
     * 提交幻灯片数据资料
     * @desc 提交幻灯片数据资料
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function iconAddAc()
    {
        $rs['url'] = Common_Function::url(
            array('service' => 'Icon.IconList')
        );

        $icon_model = new Model_Icon();

        if (empty($this->name)) {
            throw new PhalApi_Exception_WrongException('幻灯片名称不能为空');
        }

        if ($this->id > 0) {
            DI()->response->setMsg(T('修改成功'));
            $icon = $this->icon;
            if (isset($_FILES['icon']) && $_FILES['icon']["error"] == 0) {
                $icon = Common_Function::upLoadImage('icon', 'icon');
                if (is_array($icon)) {
                    @unlink($this->icon);
                } else {
                    throw new PhalApi_Exception_WrongException($icon);
                }
            }

            $update_array = array();
            $update_array['name'] = $this->name;
            $update_array['icon'] = $icon;
            $update_array['category'] = $this->category;
            $update_array['url'] = $this->url;
            $update_array['sort'] = $this->sort;
            $update_array['is_rec'] = $this->is_rec;
            $result = $icon_model->update($this->id, $update_array);
            if ($result === false) {
                throw new PhalApi_Exception_WrongException(T('修改失败'));
            }

        } else {
            DI()->response->setMsg(T('添加成功'));
            $icon = Common_Function::upLoadImage('icon', 'icon');


            if (is_string($icon)) {
                throw new PhalApi_Exception_WrongException($icon);
            }

            $insert_array = array();
            $insert_array['name'] = $this->name;
            $insert_array['icon'] = $icon;
            $insert_array['category'] = $this->category;
            $insert_array['url'] = $this->url;
            $insert_array['sort'] = $this->sort;
            $insert_array['is_rec'] = $this->is_rec;
            $insert_array['addtime'] = NOW_TIME;

            $insertId = $icon_model->insert($insert_array);
            if (empty($insertId)) {
                throw new PhalApi_Exception_WrongException(T('添加失败'));
            }

        }

        return $rs;
    }

    /**
     * 修改幻灯片推荐状态
     * @desc 修改幻灯片推荐状态
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function chageStatus()
    {
        DI()->response->setMsg(T('修改成功'));
        $icon_model = new Model_Icon();
        if ($this->is_rec == 0) {
            $update_array['is_rec'] = 1;
        } else {
            $update_array['is_rec'] = 0;
        }
        $result = $icon_model->update($this->id, $update_array);
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('修改失败'));
        }
        return $update_array['is_rec'];
    }

    /**
     * 删除幻灯片数据
     * @desc 删除幻灯片数据
     * @throws PhalApi_Exception_WrongException 抛出错误信息
     * @return object d
     * @return int d.code 返回信息Code 40000：成功 40001：失败
     * @return string d.msg 返回的错误信息提示或者成功信息提示
     * @return array d.data each as data 返回的数据信息
     */
    public function delIcon()
    {
        DI()->response->setMsg(T('删除成功'));
        $icon_model = new Model_Icon();
        $result = $icon_model->delete($this->id);
        if (!$result) {
            throw new PhalApi_Exception_WrongException(T('删除失败'));
        }
    }

}