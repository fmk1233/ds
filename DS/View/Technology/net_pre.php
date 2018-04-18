<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <link href="<?php echo URL_ROOT.'/static/';?>css/plugins/ztree/zTreeStyle.css" rel="stylesheet">
    <style type="text/css">
        .Topology-table2{line-height:35px;color:#FFF;text-align:center;height:35px;margin-top:15px;margin-bottom:15px}.Topology-table{text-align:center;overflow:hidden;border-collapse:inherit;box-shadow:0 0 5px #888;background-color:#FFF;margin-top:0;margin-right:auto;margin-bottom:0;margin-left:auto}.Topology-table td{line-height:24px;height:24px;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFF}.center2{margin-top:0;margin-right:auto;margin-bottom:0;margin-left:auto;height:20px;background-color:#999;width:1px;border-top-color:#FFF;border-right-color:#FFF;border-bottom-color:#FFF;border-left-color:#FFF}.Register_a1 a{border:1px solid #3380ce;padding-top:5px;padding-right:20px;padding-bottom:5px;padding-left:20px;color:#3380ce;cursor:pointer;background-color:#d4e7f0;display:block}.Register_a1 a:hover{border:1px solid #ff7d00;color:#FFF;background-color:#ff7d00}.Register_a input{border:1px solid #3380ce;padding-top:7px;padding-right:18px;padding-bottom:7px;padding-left:18px;color:#3380ce;cursor:pointer;background-color:#d4e7f0}.btn-white{color:#333;background:#fff;border:1px solid #e7eaec}.btn-white.active,.btn-white:active,.btn-white:focus,.btn-white:hover,.open .dropdown-toggle.btn-white{color:#333;border:1px solid #d2d2d2}.btn-white.active,.btn-white:active{box-shadow:0 2px 5px rgba(0,0,0,.15) inset}.btn-white.active,.btn-white:active,.open .dropdown-toggle.btn-white{background-image:none}.btn-white.active[disabled],.btn-white.disabled,.btn-white.disabled.active,.btn-white.disabled:active,.btn-white.disabled:focus,.btn-white.disabled:hover,.btn-white[disabled],.btn-white[disabled]:active,.btn-white[disabled]:focus,.btn-white[disabled]:hover,fieldset[disabled] .btn-white,fieldset[disabled] .btn-white.active,fieldset[disabled] .btn-white:active,fieldset[disabled] .btn-white:focus,fieldset[disabled] .btn-white:hover{color:#cacaca}
        .node_name span{
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #e7eaec;
            background: #f5f5f5;
            border-radius: 3px;
            box-sizing: border-box;
            color:#fff;width:250px;display:inline-block;
        }
        .ztree li span.button{
            margin-top:6px ;
        }
        .ztree li a.curSelectedNode{
            background: inherit;
            padding-top:inherit ;
            border: inherit;
            color: inherit;
            height: 35px;
        }
    </style>
</head>

<body class="top-navigation">
<div id="wrapper">
    <div id="page-wrapper" class="linear-gradient">
        <div class="l-bgw">
            <!--导航-->
            <?php $this->view('page_header'); ?>
            <!--导航EEnd-->

            <div class="row wrapper border-bottom  page-heading">
                <div class="ny-top">
                    <h2><?php echo T('安置'),T('网络图'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('网络管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('安置'),T('网络图'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <div class="pull-right">
                                        <div class="btn-group" id="type">
                                            <button type="button" class="btn btn-xs btn-white active" data-type="net"><?php echo T('网络图'); ?></button>
                                            <button type="button" class="btn btn-xs btn-white" data-type="tree"><?php echo T('树状图'); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <form class="form-inline" id="userSearch" role="form" onsubmit="return false;" style="margin-top: 10px">
                                        <input type="hidden" value="Net.Net" name="service"/>
                                        <input type="hidden" value="1" name="type"/>
                                        <div class="form-group">
                                            <div class="input-group">
                                        <span class="input-group-addon" select="">
                                            <select name="qtype" id="qtype">
                                                <option value="user_name"><?php echo T('会员编号'); ?></option>
                                                <option value="id"><?php echo T('会员ID'); ?></option>
                                            </select>
                                        </span>
                                                <input type="text" class="form-control" id="qvalue" name="qvalue"
                                                       placeholder="<?php echo T('搜索相关数据'); ?>...">
                                            </div><!-- /input-group -->
                                        </div>
                                        <button type="submit" class="btn btn-primary"><?php echo T('搜索'); ?></button>
                                    </form>
                                    <table width="100%" class="Topology-table2">
                                        <tr>
                                            <?php
                                            $grade_ary = Common_Function::getRankName();
                                            foreach ($grade_ary as $key=>$grade) {
                                                if($key==0){
                                                    $bg1="#8b8484";$bgcol="#8b8484";$bg2="#8b8484";
                                                    echo '<TD align="center" valign="middle" bgColor="',$bgcol,'"><font color="#FFFFFF">',T('未激活'),'</font></TD>';
                                                }
                                                switch($key+1){
                                                    case 0:$bg1="#8b8484";$bgcol="#8b8484";$bg2="#8b8484";break;
                                                    case 1:$bg1="#009999";$bgcol="#009999";$bg2="#009999";break;
                                                    case 2:$bg1="#8891ed";$bgcol="#8891ed";$bg2="#8891ed";break;
                                                    case 3:$bg1="#ff6700";$bgcol="#ff6700";$bg2="#ff6700";break;
                                                    case 4:$bg1="#aa3939";$bgcol="#aa3939";$bg2="#aa3939";break;
                                                    case 5:$bg1="#336699";$bgcol="#336699";$bg2="#336699";break;
                                                    case 6:$bg1="#FFCC00";$bgcol="#FFCC00";$bg2="#FFCC00";break;
                                                    case 7:$bg1="#FF9900";$bgcol="#FF9900";$bg2="#FF9900";break;
                                                }
                                                echo '<TD align="center" valign="middle" bgColor="',$bgcol,'"><font color="#FFFFFF">',$grade,'</font></TD>';
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                    <div class="net" id="net" style="text-align: center;overflow-x: scroll;">
                                    </div>
                                    <div  class="net"  id="tree" style="display: none;overflow-x: scroll;">
                                        <div class="alert alert-success">
                                            图例注释：所在层数[*] 会员编号[****] 会员级别[****] 开通状态
                                        </div>
                                        <div class="ztree" id="tree_1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php $this->view('footer'); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->view('footer_js'); ?>
<script src="<?php echo URL_ROOT.'/static/';?>js/plugins/ztree/jquery.ztree.core.min.js"></script>
<script type="text/javascript">
    $(function () {
        var member_id = '<?php echo $user['id'];?>';
        var net_type = 'net';
        var data = {service:'Net.Net',type:1,qtype:'id',qvalue:member_id,net_type:net_type};
        loadNet();
        var tree_data =  {service: 'Net.Net', type: 1, qtype: '', qvalue: 0, net_type: 'tree'};
        $('#type').on('click' ,'button',function () {
            $('#type button').removeClass('active');
            $('.net').hide();
            var type = $(this).data('type');
            $('#'+type).show();
            $(this).addClass('active');
        });
        function zTreeOnClick(event, treeId, treeNode) {
            var treeObj = $.fn.zTree.getZTreeObj("tree");
            if(treeObj){
                treeObj.expandNode(treeNode, true, true, true);
            }
        };
        var setting = {
            async: {
                enable: true,
                dataType:'json',
                url:baseUrl,
                autoParam:["id=qvalue"],
                otherParam:tree_data
            },
            view:{
                nameIsHTML:true,
                showIcon: false
            },
            callback:{
                onClick: zTreeOnClick
            }
        };
        $.fn.zTree.init($("#tree_1"), setting);


        function loadNet() {
            var url = ds.url(data);
            $('#net').load(url);
        }
        $('#net').on('click','a[member]',function () {

            var new_member = $(this).data('id');
            member_id = new_member;
            data.qtype ='id';
            data.qvalue = new_member;
            loadNet();
        });
        $('#userSearch').on('submit',function () {
            data.qtype = $('#qtype').val();
            data.qvalue = $('#qvalue').val();
            tree_data.qtype = data.qtype;
            tree_data.qvalue = data.qvalue;
            console.log(tree_data);
            $.fn.zTree.init($("#tree_1"), setting);
            loadNet();
        });
    });
</script>
</body>

</html>
