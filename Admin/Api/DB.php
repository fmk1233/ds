<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/14
 * Time: 10:55
 */
class Api_DB extends Api_DCommon
{

    public function getRules()
    {
        return array(
            'download' => array(
                'filename' => array('name' => 'filename', 'type' => 'string'),
            ),
            'restore' => array(
                'filename' => array('name' => 'filename', 'type' => 'string'),
            ),
            'del' => array(
                'filename' => array('name' => 'filename', 'type' => 'string'),
            )
        );
    }

    public function dbbackup()
    {
        $this->assign('tips', array('当前页面显示系统数据库备份列表', '当系统出现异常需要还原时，可以点击操作栏中“还原”按钮使系统数据还原到对应时间点', '点击右上方“备份数据”按钮，可以进行数据备份', '建议进行日常备份以减少不可抗力导致的系统损失'));
        $this->view('dbbackup');
    }

    public function dbbackupList()
    {
        $rs = array('total' => 0, 'rows' => array());
        $rs['rows'] = $this->showSqlList(API_ROOT . '/Data/');
        $rs['total'] = count($rs['rows']);
        return $rs;
    }

    public function backup()
    {

        set_time_limit(0);
        ignore_user_abort(true);
        $dbconfig = DI()->config->get('dbs.servers');
        $dbname = $dbconfig[DB_DS]['name'];
        $dbuser = $dbconfig[DB_DS]['user'];
        $dbpwd = $dbconfig[DB_DS]['password'];
        $dbhost = $dbconfig[DB_DS]['host'];
//    $dbname = 'yyg';
        $filename = $dbname . '_' . date('Y-m-d_H-i-s') . '.sql';
        if (substr(php_uname(), 0, 7) == "Windows") {
            system('H:/phpStudy/MySQL/bin/mysqldump ' . $dbname . ' -u' . $dbuser . ' -p' . $dbpwd . ' -h' . $dbhost . ' > ' . API_ROOT . '/Data/' . $filename, $return_val);
        } else {
            system('/usr/local/mysql/bin/mysqldump ' . $dbname . ' -u' . $dbuser . ' -p' . $dbpwd . ' -h' . $dbhost . ' > ' . API_ROOT . '/Data/' . $filename, $return_val);
        }

        if (!$return_val) {
            DI()->response->setMsg('备份数据成功');
        } else {
            throw  new PhalApi_Exception_WrongException('备份数据失败！');
        }
    }


    public function download()
    {
        $filename = $this->filename;
        $filepath = API_ROOT . '/Data/' . $filename; //文件名
        header("Content-type:  application/octet-stream ");
        header("Accept-Ranges:  bytes ");
        header("Accept-Length: " . filesize($filepath));
        header("Content-Disposition:  attachment;  filename= {$filename}");
        echo file_get_contents($filepath);
        exit();
    }

    public function restore()
    {
        $rs = array('code' => 40000, 'msg' => '数据库还原成功', 'info' => array());
        set_time_limit(0);
        ignore_user_abort(true);

        $dbconfig = DI()->config->get('dbs.servers');
        $dbname = $dbconfig[DB_DS]['name'];
        $dbuser = $dbconfig[DB_DS]['user'];
        $dbpwd = $dbconfig[DB_DS]['password'];
        $dbhost = $dbconfig[DB_DS]['host'];
        $filename = $this->filename;
        $return_val = true;
        if (file_exists(API_ROOT . '/Data/' . $filename)) {
            if (substr(php_uname(), 0, 7) == "Windows") {//windows
                system('H:/phpStudy/MySQL/bin/mysql ' . $dbname . ' -u' . $dbuser . ' -p' . $dbpwd . ' -h' . $dbhost . ' < ' . API_ROOT . '/Data/' . $filename, $return_val);
            } else {
                system('/usr/local/mysql/bin/mysql ' . $dbname . ' -u' . $dbuser . ' -p' . $dbpwd . ' -h' . $dbhost . ' < ' . API_ROOT . '/Data/' . $filename, $return_val);
            }

        }

        if (!$return_val) {
            DI()->response->setMsg('数据库还原成功');
        } else {
            throw  new PhalApi_Exception_WrongException('数据库还原失败！');
        }
    }

    public function del()
    {
        DI()->response->setMsg('删除成功');
        $filepath = API_ROOT . '/Data/' . $this->filename; //文件名
        if (!file_exists($filepath)) {
            throw  new PhalApi_Exception_WrongException('该文件不存在！');
        } else {
            $result = unlink($filepath);
            if ($result) {
                $rs['msg'] = '删除成功';
            } else {
                throw  new PhalApi_Exception_WrongException('删除失败！');
            }
        }

    }

    private function showSqlList($basedir)
    {
        $key = 0;
        $files = array();
        if ($dh = opendir($basedir)) {
            while (($file = readdir($dh)) !== false)

                if ($file != '.' && $file != '..') {
                    {
                        if (!is_dir($basedir . "/" . $file)) {
                            if (!(stripos($file, '.sql') === false)) {
                                $key++;
                                $file_info = stat($basedir . "/" . $file);
                                $file_a['title'] = iconv('GBK', 'UTF-8', $file);
                                $file_a['id'] = $key;
                                $file_a['addtime'] = $file_info['ctime'];
//                    $file_a['size']  = number_format($file_info['size']/(1024*1024),2,'.','').'MB';
                                $file_a['size'] = number_format($file_info['size'] / 1024, 2) . 'KB';
                                $files[] = $file_a;
                            }
                        }
                    }
                }
            closedir($dh);
        }
        $files = array_reverse($files);
        return $files;
    }

}