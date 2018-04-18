<?php

/**
 * User: denn
 * Date: 2017/3/16
 * Time: 21:07
 */
class Api_Net extends Api_Common
{

    public function getRules()
    {
        return array(
            'net' => array(
                'user_name' => array('name' => 'username', 'type' => 'string', 'default' => '', 'desc' => '用户编号'),
                'type' => array('name' => 'type', 'type' => 'int', 'min' => 1, 'max' => 2, 'desc' => '网络图类型'),
            ),
        );
    }

    public function getRankColor()
    {
        $result['rank_colors'] = Common_Function::rankColor();
        $result['rank_names'] = Common_Function::getRankName();
        return $result;
    }

    public function net()
    {

        if ($this->user_name == '') {
            $member = $this->data['user'];
        } else {
            $user_model = new Model_Users();
            $member = $user_model->getInfo(array('user_name' => $this->user_name), 'id,gldept,tjdept,rank,state,user_name,pos');

        }

        if (empty($member)) {
            echo '查询会员不存在';
        } else {
            if ($this->type == 1) {
                $html = '<div class="team-hd "><a href="#"><i class="icon icon-touxiang" style="color:' . Common_Function::rankColor($member['rank'], $member['state']) . '"></i>[' . $member['gldept'] . '][' . $member['user_name'] . '][' . Common_Function::getRankName($member['rank']) . '][' . Common_Function::getPosName($member['pos']) . ']已开通 </a></div><ul>';
                $this->tuopu_tree($member['id'], 3, 1, $html, $this->type);
                $html .= '</ul>';
            } else {
                $html = '<div class="team-hd "><a href="#"><i class="icon icon-touxiang" style="color:' . Common_Function::rankColor($member['rank'], $member['state']) . '"></i>[' . $member['tjdept'] . '][' . $member['user_name'] . '][' . Common_Function::getRankName($member['rank']) . ']已开通 </a></div><ul>';
                $this->tuopu_tree($member['id'], 3, 1, $html, $this->type);
                $html .= '</ul>';
            }

            echo $html;
        }
    }

    private function tuopu_tree($member_id, $dept, $dept1, &$html, $type)
    {
        if ($dept >= $dept1) {
            if ($type == 1) {
                $c_num = POSNUM;
                for ($m = 1; $m <= $c_num; $m++) {
                    $user_model = new Model_Users();
                    $member = $user_model->getInfo(array('rid=? and pos=? ' => array($member_id, $m)), 'id,user_name,tjdept,gldept,pos,rank,state');
                    if ($member) {
                        $state = '已开通';
                        if ($member['state'] == 0) {
                            $state = '未开通';
                        }
                        $html .= '<li><div class="team-hd "><a href="javascript:void(-1)" search data-username="' . $member['user_name'] . '"><i class="icon icon-touxiang" style="color:' . Common_Function::rankColor($member['rank'], $member['state']) . '"></i>[' . $member['gldept'] . '][' . $member['user_name'] . '][' . Common_Function::getRankName($member['rank']) . '][' . Common_Function::getPosName($member['pos']) . ']' . $state . ' </a></div><ul>';
                        $this->tuopu_tree($member['id'], $dept, $dept1 + 1, $html, $type);
                        $html .= '</ul></li>';
                    }
                }
            } else {
                $user_model = new Model_Users();
                $members = $user_model->getListByWhere(array('pid=?' => array($member_id)), 'id,user_name,tjdept,gldept,pos,rank,state');
                foreach ($members as $member) {
                    $state = '已开通';
                    if ($member['state'] == 0) {
                        $state = '未开通';
                    }
                    $html .= '<li><div class="team-hd "><a href="javascript:void(-1)" search data-username="' . $member['user_name'] . '"><i class="icon icon-touxiang" style="color:' . Common_Function::rankColor($member['rank'], $member['state']) . '"></i>[' . $member['gldept'] . '][' . $member['user_name'] . '][' . Common_Function::getRankName($member['rank']) . ']' . $state . ' </a></div><ul>';
                    $this->tuopu_tree($member['id'], $dept, $dept1 + 1, $html, $type);
                    $html .= '</ul></li>';
                }
            }

        }

    }
}