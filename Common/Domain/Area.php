<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/11 0011
 * Time: 16:57
 */
class Domain_Area
{
    /**
     * 获取地区信息列表
     * @param $limit
     * @param $offset
     * @param $where
     * @param string $field
     * @return array
     */
    public static function getList($limit, $offset, $where, $field = '*')
    {
//        Domain_Area::save();
        $model_area = new Model_Area();
        return $model_area->getList($limit, $offset, $where, 'id asc', $field);

    }

    public static function getArea($id, $pid = 1)
    {
        $model_area = new Model_Area();
        $area = $model_area->get($id);
        if (!$area) {
            $area['id'] = 0;
            $area['pid'] = $pid;
            $area['area_name'] = '';
            $area['code'] = '';
            $area['level'] = 2;
        }

        if ($pid > 1 || $area) {
            $p_area = $model_area->get($area['pid'], 'area_name,level');
            $area['p_name'] = $p_area['area_name'];
            $area['level'] = $p_area['level'] + 1;
        }

        return $area;
    }


    /**
     * 变更地区信息
     * @param $data
     * @return string
     */
    public static function doArea($data)
    {
        $model_area = new Model_Area();
        $id = $data['id'];
        unset($data['data']);
        DI()->notorm->beginTransaction(DB_DS);

        if ($id > 0) {
            $do_result = $model_area->update($id, $data);
            $memo = "管理员编辑地区信息，[ID:{$id}]";
        } else {
            $do_result = $model_area->insert($data);
            $memo = '管理员添加地区信息';
        }
        if ($do_result) {
            DI()->notorm->commit(DB_DS);
            Domain_Log::addLog($memo);
            Domain_Area::save();
            $rs['msg'] = T('操作成功');
            $rs['url'] = Common_Function::url(array('service'=>'Area.Area'));
            return $rs;
        }
        DI()->notorm->rollback(DB_DS);
        return T('操作失败');
    }

    /**
     * 删除地区信息
     * @return string
     */
    public static function delArea($id)
    {
        $model_area = new Model_Area();
        if ($id > 0) {
            $children_area = $model_area->getInfo(array('pid' => $id));
            if ($children_area) {
                return T('该地区存在下级地区，不允许直接删除');
            }else{
                DI()->notorm->beginTransaction(DB_DS);
                $do_result = $model_area->delete($id);
                $memo = "管理员删除地区信息，[ID:{$id}]";
                if ($do_result) {
                    DI()->notorm->commit(DB_DS);
                    Domain_Log::addLog($memo);
                    Domain_Area::save();
                    $rs['msg'] = T('操作成功');
//                    $rs['url'] = Common_Function::url(array('service'=>'Area.Area'));
                    return $rs;
                }
            }
        }
        DI()->notorm->rollback(DB_DS);
        return T('操作失败');
    }
    private static function save(){
        $model_area = new Model_Area();
        $provices = $model_area->getListByWhere(array('pid'=>1),'*','id asc');
        $area_data = array();
        foreach ($provices as $provice){
            $data = array();
            $data['text'] = $provice['area_name'];
            $data['value'] = $provice['id'];
            $data['children'] = array() ;
            $citys = $model_area->getListByWhere(array('pid'=>(int)$provice['id']),'*','id asc');
            foreach ($citys as $city) {
                $data_c = array();
                $data_c['text'] = $city['area_name'];
                $data_c['value'] = $city['id'];
                $data_c['children'] = array() ;
                $areas = $model_area->getListByWhere(array('pid'=>(int)$city['id']),'*','id asc');
                foreach ($areas as $area){
                    $data_a = array();
                    $data_a['text'] = $area['area_name'];
                    $data_a['value'] = $area['id'];
                    $data_c['children'][] = $data_a;
                }
                $data['children'][] =  $data_c;
            }
            $area_data[] = $data;
        }
        file_put_contents(API_ROOT.'/Public/static/js/city.js','var cityData3 = '.json_encode($area_data,JSON_UNESCAPED_UNICODE));
    }

}