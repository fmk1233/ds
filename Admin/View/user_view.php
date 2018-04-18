<!DOCTYPE html>
<html>


<?php $this->view('header');?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>会员资料查看页</h5>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content" style="display: block;">
                <div class="tablesaw-bar mode-stack"></div><table class="table table-hover tablesaw-stack" data-tablesaw-mode="stack" id="table-6138">
                    <tbody><tr>
                        <th scope="row" width="130">用户编号：</th>
                        <td><?php echo $user['user_name']; ?></td>
                        <th scope="row" width="130">会员级别：</th>
                        <td><?php echo $user['rank_name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">会员姓名：</th>
                        <td><?php echo $user['true_name']; ?></td>
                        <th scope="row">注册时间：</th>
                        <td><?php echo date('Y-m-d H:i:s',$user['reg_time']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">推荐人编号：</th>
                        <td><?php echo $user['t_user_name']; ?></td>
                        <th scope="row">接点人编号：</th>
                        <td><?php echo $user['p_user_name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">市场位置：</th>
                        <td><?php echo $user['pos_name']; ?></td>
                        <th scope="row">报单中心：</th>
                        <td><?php echo $user['zmd_name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">一级密码：</th>
                        <td><?php echo  Common_Function::decode($user['o_pwd']); ?></td>
                        <th scope="row">二级密码：</th>
                        <td><?php echo Common_Function::decode($user['o_sec_pwd']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">手机号码：</th>
                        <td><?php echo $user['mobile']; ?></td>
                        <th scope="row">性别：</th>
                        <td><?php echo Common_Function::getSexName($user['sex']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">省城区：</th>
                        <td><?php echo implode(' ', Common_Function::getAddress($user['province'],$user['city'],$user['area'])); ?></td>
                        <th scope="row">身份证号码：</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">收货人：</th>
                        <td><?php echo $address['realname']; ?></td>
                        <th scope="row">收货人手机号：</th>
                        <td><?php echo $address['mobile']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">收货人省市区：</th>
                        <td><?php echo implode(' ',Common_Function::getAddress($address['province'],$address['city'],$address['area'])); ?></td>
                        <th scope="row">收货人地址：</th>
                        <td><?php echo $address['address']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">开户银行：</th>
                        <td><?php echo $user['bank_name']; ?></td>
                        <th scope="row">银行卡号：</th>
                        <td><?php echo $user['bank_no']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">开户姓名：</th>
                        <td><?php echo $user['bank_user']; ?></td>
                        <th scope="row">开户行地址：</th>
                        <td><?php echo $user['bank_address']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">支付宝：</th>
                        <td></td>
                        <th scope="row">QQ：</th>
                        <td></td>
                    </tr>

                    <tr>
                    </tr>
                    </tbody></table>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js');?>
<!-- 省市区插件-->

</html>
