<?php if ($member) {
    $grade_ary = Common_Function::getRankName(); ?>
    <?php $user_id = Common_Function::user_id();
    if ($member['pid'] && ($user_id == 0 || $member['id'] != $user_id)) { ?>
        <div align="center" class="Register_a">
            <a href="javascript:void(-1)" member data-id="<?php echo $member['pid']; ?>">
                <input type="button" name="btnSearch" value="<?php echo T('上一层'); ?>" style="margin-bottom: 20px;"
                       id="btnSearch">
            </a>
        </div>
    <?php } ?>
    <table align="center" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td valign="top" align="center">
                <table border="0" cellpadding="0" cellspacing="0" bgcolor="#009999" align="center"
                       width="160">
                    <tr>
                        <td align="center" bgcolor="#FFFFFF">
                            <table width="160" class="Topology-table">

                                <?php
                                switch ($member['rank'] + 1) {
                                    case 0:
                                        $bg1 = "#8b8484";
                                        $bgcol = "#8b8484";
                                        $bg2 = "#8b8484";
                                        break;
                                    case 1:
                                        $bg1 = "#009999";
                                        $bgcol = "#009999";
                                        $bg2 = "#009999";
                                        break;
                                    case 2:
                                        $bg1 = "#8891ed";
                                        $bgcol = "#8891ed";
                                        $bg2 = "#8891ed";
                                        break;
                                    case 3:
                                        $bg1 = "#ff6700";
                                        $bgcol = "#ff6700";
                                        $bg2 = "#ff6700";
                                        break;
                                    case 4:
                                        $bg1 = "#aa3939";
                                        $bgcol = "#aa3939";
                                        $bg2 = "#aa3939";
                                        break;
                                    case 5:
                                        $bg1 = "#336699";
                                        $bgcol = "#336699";
                                        $bg2 = "#336699";
                                        break;
                                    case 6:
                                        $bg1 = "#FFCC00";
                                        $bgcol = "#FFCC00";
                                        $bg2 = "#FFCC00";
                                        break;
                                    case 7:
                                        $bg1 = "#FF9900";
                                        $bgcol = "#FF9900";
                                        $bg2 = "#FF9900";
                                        break;
                                }
                                if ($member['state'] == 0) {
                                    $bg1 = "#8b8484";
                                    $bgcol = "#8b8484";
                                    $bg2 = "#8b8484";
                                }
                                ?>
                                <tr>
                                    <td height="15" align="center" bgcolor="<?php echo $bg1; ?>">
                                        <a href="javascript:void(-1)" member
                                           data-id="<?php echo $member['id']; ?>"><font
                                                    color="ffffff"><strong><?php echo $member['user_name'] ?></strong></font></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="15" align="center" bgcolor="<?php echo $bg2; ?>">
                                        <font color="ffffff"><?php echo $grade_ary[$member['rank']] ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="15" align="center" bgcolor="<?php echo $bg2; ?>">
                                        <font color="ffffff"><?php echo $member['true_name'] ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="15" align="center" style="color: #fff" bgcolor="<?php echo $bg2; ?>">
                                        <?php
                                        $user_model = new Model_Users();
                                        $zt_num = $user_model->getParentCount(
                                            array(
                                                'pid' => intval($member['id']),
                                                'dept' => 1
                                            )
                                        );
                                        $team_num = $user_model->getParentCount(
                                            array(
                                                'pid' => intval($member['id'])
                                            )
                                        );
                                        echo T('直推'), '：', $zt_num, '  ', T('团队'), '：', $team_num;
                                        ?>
                                    </td>
                                </tr>


                                <tr>
                                    <td align="center" background="#ff34dd">

                                        <?php echo $member['confirm_time'] ? date('Y-m-d H:i:s', $member['confirm_time']) : T('未激活'); ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="center2"></div>
    <?php
    function tuopu_tree($member_id, $dept, $dept1, $type)
    {
        $grade_ary = Common_Function::getRankName();
        if ($dept >= $dept1) {
            $i = 1;
            $user_model = new Model_Users();
            $members = $user_model->getListByWhere(array('pid=?' => array($member_id)));
            $members[] = false;
            $c_num = count($members);


            ?>
            <table align="center" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <?php $m = 1;
                    foreach ($members as $member) {
                        $m++;

                        ?>
                        <td valign="top">

                            <?php if ($c_num > 1) {
                                if ($i == 1 && $c_num > $i) { ?>
                                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                            <td align="center">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="50%" height="1"></td>
                                                        <td width="50%" height="1" bgcolor="#999"></td>
                                                    </tr>
                                                </table>
                                                <div class="center2"></div>
                                            </td>
                                        </tr>
                                    </table>
                                <?php } elseif (($i > 1) && ($c_num == $i)) { ?>

                                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                            <td align="center">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="50%" height="1" bgcolor="#999"></td>
                                                        <td width="50%" height="1"></td>
                                                    </tr>
                                                </table>
                                                <div class="center2"></div>
                                            </td>
                                        </tr>
                                    </table>
                                <?php } else { ?>
                                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                            <td align="center">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="50%" height="1" bgcolor="#999"></td>
                                                        <td width="50%" height="1" bgcolor="#999"></td>
                                                    </tr>
                                                </table>
                                                <div class="center2"></div>
                                            </td>
                                        </tr>
                                    </table>
                                <?php }
                            }
                            if ($member) { ?>
                                <table width="160" class="Topology-table">
                                    <?php
                                    switch ($member['rank'] + 1) {
                                        case 0:
                                            $bg1 = "#8b8484";
                                            $bgcol = "#8b8484";
                                            $bg2 = "#8b8484";
                                            break;
                                        case 1:
                                            $bg1 = "#009999";
                                            $bgcol = "#009999";
                                            $bg2 = "#009999";
                                            break;
                                        case 2:
                                            $bg1 = "#8891ed";
                                            $bgcol = "#8891ed";
                                            $bg2 = "#8891ed";
                                            break;
                                        case 3:
                                            $bg1 = "#ff6700";
                                            $bgcol = "#ff6700";
                                            $bg2 = "#ff6700";
                                            break;
                                        case 4:
                                            $bg1 = "#aa3939";
                                            $bgcol = "#aa3939";
                                            $bg2 = "#aa3939";
                                            break;
                                        case 5:
                                            $bg1 = "#336699";
                                            $bgcol = "#336699";
                                            $bg2 = "#336699";
                                            break;
                                        case 6:
                                            $bg1 = "#FFCC00";
                                            $bgcol = "#FFCC00";
                                            $bg2 = "#FFCC00";
                                            break;
                                        case 7:
                                            $bg1 = "#FF9900";
                                            $bgcol = "#FF9900";
                                            $bg2 = "#FF9900";
                                            break;
                                    }
                                    if ($member['state'] == 0) {
                                        $bg1 = "#8b8484";
                                        $bgcol = "#8b8484";
                                        $bg2 = "#8b8484";
                                    }
                                    ?>
                                    <tr>
                                        <td height="15" align="center" bgcolor="<?php echo $bg1; ?>">
                                            <a href="javascript:void(-1)" member data-id="<?php echo $member['id']; ?>"><font
                                                        color="ffffff"><strong><?php echo $member['user_name']; ?></strong></font></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="15" align="center" bgcolor="<?php echo $bg2; ?>">
                                            <font color="ffffff"><?php echo $grade_ary[$member['rank']] ?></font>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="15" align="center" bgcolor="<?php echo $bg2; ?>">
                                            <font color="ffffff"><?php echo $member['true_name'] ?></font>
                                        </td>
                                    </tr>
                                    <td height="15" align="center" style="color: #fff" bgcolor="<?php echo $bg2; ?>">
                                        <?php
                                        $zt_num = $user_model->getParentCount(
                                            array(
                                                'pid' => intval($member['id']),
                                                'dept' => 1
                                            )
                                        );
                                        $team_num = $user_model->getParentCount(
                                            array(
                                                'pid' => intval($member['id'])
                                            )
                                        );
                                        echo T('直推'), '：', $zt_num, '  ', T('团队'), '：', $team_num;
                                        ?>
                                    </td>
                                    <tr>
                                        <td align="center" background="#ff34dd">

                                            <?php echo $member['confirm_time'] ? date('Y-m-d H:i:s', $member['confirm_time']) : T('未激活'); ?>
                                        </td>
                                    </tr>
                                </table>
                                <?php
                                tuopu_tree($member['id'], $dept, $dept1 + 1, $type);
                            } else { ?>
                                <table border="0" cellpadding="0" cellspacing="0" align="center"
                                       style="margin:0px auto 0 auto;">
                                    <tr>
                                        <td align="center" width="70" class="Register_a1">
                                            <a data-service="<?php echo $type == 'user' ? 'User.UserReg' : 'DUser.UserReg'; ?>"
                                               data-user_pid="<?php echo $member_id; ?>"
                                               data-toggle="url"><?php echo T('注册'); ?></a>
                                        </td>
                                    </tr>
                                </table>
                            <?php } ?>

                        </td>
                        <?php $i++;
                    } ?>
                    <div class="center2"></div>

                </tr>
            </table>
            <?php
        }
    }

    tuopu_tree($member['id'], 3, 1, $type);

    ?>
<?php } ?>
<div class="alert alert-info" style="margin-top: 30px">
    本网络图仅显示四层
</div>