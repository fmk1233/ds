<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<link href="<?php echo URL_ROOT.'/static/';?>css/plugins/switchery/switchery.css" rel="stylesheet">
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title clearfix">
                    <?php if($state==0): ?>
                        <h5>待审核会员管理</h5>
                        <?php else:?>
                        <h5>已审核会员管理</h5>
                        <div class="ibox-tools pull-right">
                            <a href="javascript:void(-1)" data-service="DUser.Userreg" data-toggle="url" class="btn btn-primary"> <i class="fa fa-user-plus"></i> 新增会员</a>
                        </div>
                    <?php endif;?>

                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div class="clearfix">
                        <div id="toolbar">
                            <form class="form-inline" id="userSearch" role="form" onsubmit="return false;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" select="">
                                            <select name="qtype" id="qtype">
                                                <option value="user_name">会员编号</option>
<!--                                                <option value="id">会员ID</option>-->
                                                <option value="mobile">手机号码</option>
                                            </select>
                                        </span>
                                        <input type="text" class="form-control w125" id="qvalue" name="qvalue"
                                               placeholder="搜索相关数据...">
                                    </div><!-- /input-group -->
                                </div>
                                <input type="text" class="form-control w125" id="tjr_name" name="tjr_name"
                                       placeholder="推荐人编号">
                                <?php if(POSNUM>1): ?>
                                    <input type="text" class="form-control w125" id="pre_name" name="pre_name"
                                           placeholder="接点人编号">
                                <?php endif;?>
                                <div class="form-group">
                                    <div class="input-group" style="width: 330px;">
                                        <input type="text" class="laydate-icon form-control " id="s_time" name="s_time"
                                               placeholder="开始时间"
                                               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                        <span class="input-group-addon">到</span>
                                        <input type="text" class="laydate-icon form-control " id="e_time" name="e_time"
                                               placeholder="结束时间"
                                               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">会员等级</label>
                                    <select name="rank" id="rank" class="form-control">
                                        <option value="-1">全部</option>
                                        <?php $ranks = Common_Function::getRankName();
                                        foreach ($ranks as $key => $rank): ?>
                                            <option value="<?php echo $key; ?>"><?php echo $rank; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">搜索</button>
                            </form>
                        </div>
                        <table class="table" data-mobile-responsive="true">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/switchery/switchery.js"></script>
<script type="text/javascript">
    $(function () {
        var rank_names = JSON.parse('<?php echo json_encode(Common_Function::getRankName()); ?>');
        var pos_names = JSON.parse('<?php echo json_encode(Common_Function::getPosName()); ?>');
        var bd_centers = JSON.parse('<?php echo json_encode(Common_Function::getBdCenterName()); ?>');
        var $columnsLock = [ {
            field: 'id',
            title: 'ID'
        },{
            field: 'user_name',
            title: '会员编号'

        },{
            field: 'true_name',
            title: '会员姓名'

        }, {
            field: 'rank',
            title: '会员级别',
            formatter: function (value) {
                return rank_names[value];
            }
        },{
            field: 'bd_center',
            title: '报单中心',
            formatter: function (value) {
                return bd_centers[value];
            }
        }, {
            field: 't_user_name',
            title: '推荐人'
        },<?php if(POSNUM > 1): ?>
            {
                field: 'p_user_name',
                title: '接点人'

            },{
                field: 'pos',
                title: '市场',
                formatter:function (value) {
                    return pos_names[value];
                }

            },
            <?php endif; ?>
       <?php if($state==-10): $bonus_names = Common_Function::getBonusName(); foreach ($bonus_names as $key=>$bonus_name): ?>
            {
            field: '<?php echo BONUS_NAME.$key;?>',
            title: '<?php echo $bonus_name;?>'
            },
         <?php endforeach;endif; ?>
        {
            field: 'state',
            title: '状态',
            formatter: function (value) {
                switch (parseInt(value)) {
                    case 0:
                        return '<span class="text-danger">未激活</span>';
                    case 2:
                        return '<span class="text-danger">冻结</span>';
                    default:
                        return '<span class="text-primary">正常</span>';
                }
            }
        }, {
            field: 'reg_time',
            title: '注册时间',
            formatter: function (value) {
                return showTime(value);
            }
        }, {
            field: 'reg_ip',
            title: '注册ip',visible:false
        }, {
            field: 'mobile',
            title: '手机号'
        },{
                field: 'can_cash',
                title: '提现',
                formatter: function (value,d) {
                    value = d.id;
                    switch (parseInt(d.can_cash)) {
                        case 0:
                            return ' <input type="checkbox" class="js-switch" value="0" data-service="DUser.cashMember" data-userid="' + value + '"  data-cancash="1"/>';
                        default:
                            return ' <input type="checkbox" class="js-switch" value="1" checked  data-service="DUser.cashMember" data-userid="' + value + '"  data-cancash="0"/>';
                    }
                }
            },{
            field: 'action',
            title: '操作',
            formatter: function (value, d) {
                value = d.id;
                var control =  '';
                if(d.state == 1){
                    control += '<a open href="javascript:void(-1)" class="btn btn-danger btn-outline btn-xs" data-service="DUser.openMember" data-userId="' + value + '"  data-isopen="2" >封号</a> ';
                }else if(d.state == 2){
                    control += '<a open href="javascript:void(-1)" class="btn btn-primary btn-outline btn-xs" data-service="DUser.openMember" data-userId="' + value + '" data-isopen="1">解封</a> ';
                }
                control = '<a class="btn btn-primary btn-outline btn-xs" data-toggle="url" data-service="DUser.UserView" data-userid="'+value+'">查看</a> ';
                control += '<a class="btn btn-primary btn-outline btn-xs" data-toggle="url" data-service="DUser.userInfo" data-userid="'+value+'">修改</a> ' + (d.state == '0' ? '<a  del href="javascript:void(-1)" data-service="DUser.DelMember" class="btn btn-danger btn-outline btn-xs" data-userid="' + value + '" >删除</a> <a  active href="javascript:void(-1)" class="btn btn-warning btn-outline btn-xs" data-service="DUser.activateMember" data-userId="' + value + '" >激活</a> ' : '<a class="btn btn-info btn-outline btn-xs" login="true" target="_blank" data-toggle="url" data-service="DUser.loginHome" data-userid="' + value + '" >登入</a>')+' <br/><a  rank href="javascript:void(-1)" data-service="DUser.EditRank" data-action="view" class="btn btn-danger btn-outline btn-xs" data-rank="'+d.rank+'" data-userid="' + value + '" >修改等级</a> ';

                if(d.state>0){
                    control += '<a bdcenter href="javascript:void(-1)" data-service="DUser.EditBdcenter" data-action="view" class="btn btn-warning btn-outline btn-xs" data-userid="' + value + '" >设置报单中心</a>';
                }

                return control;
            }
        }];
        var querystrLock = "{service:'DUser.UserList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),rank:$('#rank').val(),member_state:<?php echo $state;?>,s_time:$('#s_time').val(),e_time:$('#e_time').val(),tjr_name:$('#tjr_name').val(),pre_name:$('#pre_name').val()}";
        var optionsLock = {
            columns: $columnsLock,
            showExport:false,
            showExportAll:true,
            onExportAll:function () {
                var data = eval('('+querystrLock+')');
                data.service = 'Export.UserList';
                window.open(ds.url(data));
            },
            onPostBody:function () {
                $('.js-switch').each(function () {
                    new Switchery(this, {color: "#1AB394"});
                    $(this).on('change', function () {
                        $(this).attr('disabled',true);
                        var data = $(this).data();
                        delete data.switchery;
                        var is_check = $(this).prop('checked');
                        if(is_check === true) {
                            data.cancash = 1;
                        }else{
                            data.cancash = 0;
                        }
                        ds.sendAjax({
                            data: data,
                            success: function (d) {
                                if (d.code == 40000) {
                                    successMsg(d.msg,function () {
                                        var row = $('.table tr[data-uniqueid="' + data.userid+ '"]');
                                        var index = row.data('index');
                                        var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.userid);
                                        rowData.can_cash = data.cancash;
                                        oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                                    });
                                } else {
                                    alertMsg(d);
                                }
                            }
                        });

                    });
                }) ;

            }
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#userSearch').on('submit', function () {
            oTableLock.load();
        });
        $('.table').on('click', 'a[open]', function () {
            var $this = $(this);
            var data = $this.data();
            var tips = '';
            if(data.isopen == 1) {
                tips = '您确认解封此会员？'
            }else{
                tips = '您确认封停此会员？'
            }
            confirmMsg(tips,function(){
                ds.sendAjax({
                    data: data,
                    success: function (d) {
                        if (d.code == 40000) {
                            successMsg(d.msg,function () {
                                var row = $('.table tr[data-uniqueid="' + data.userid+ '"]');
                                var index = row.data('index');
                                var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', data.userid);
                                rowData.state = data.isopen;
                                oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                            });
                        } else {
                            alertMsg(d);
                        }
                    }
                });
            });

        });
        $('.table').on('click', 'a[active]', function () {
            var $this = $(this);
            var data = $this.data();
            confirmMsg('您确认激活此会员',function(){
                ds.sendAjax({
                    data: data,
                    success: function (d) {
                        if (d.code == 40000) {
                            successMsg(d.msg,function () {
                                oTableLock.table.bootstrapTable('removeByUniqueId',data.userid)
                            });
                        } else {
                            alertMsg(d);
                        }
                    }
                });
            });

        });
        $('.table').on('click', 'a[del]', function () {
            var $this = $(this);
            var data = $this.data();
            confirmMsg('您确认删除此会员',function(){
                ds.sendAjax({
                    data: data,
                    success: function (d) {
                        if (d.code == 40000) {
                            successMsg(d.msg,function () {
                                oTableLock.table.bootstrapTable('removeByUniqueId',data.userid)
                            });
                        } else {
                            alertMsg(d);
                        }
                    }
                });
            });
        });
        $('.table').on('click', 'a[rank]', function () {
            var button = $(this);
            var data = $(this).data();
            data.service = 'DUser.EditRank';
            ajaxModel(data);
            $('#ajaxModel').on('shown.bs.modal',function () {
                bindFormAjax( $('#ajaxModel form'),function (d) {
                    if(d.code==40000){
                        var rank = $("#ajaxModel form select[name='rank']").val();
                        $('#ajaxModel').modal('hide');
                        successMsg(d,function () {
                            var row = $('.table tr[data-uniqueid="' + button.data('userid')+ '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', button.data('userid'));
                            rowData.rank = rank;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        });
                    }else{
                        alertMsg(d);
                    }
                });
               
            });

        });
        $('.table').on('click', 'a[bdcenter]', function () {
            var button = $(this);
            var data = $(this).data();
            data.service = 'DUser.EditBdcenter';
            ajaxModel(data);
            $('#ajaxModel').on('shown.bs.modal',function () {
                bindFormAjax( $('#ajaxModel form'),function (d) {
                    if(false){
                        $('#ajaxModel').modal('hide');
                        successMsg(d,function () {
                            var row = $('.table tr[data-uniqueid="' + button.data('userid')+ '"]');
                            var index = row.data('index');
                            var rowData = oTableLock.table.bootstrapTable('getRowByUniqueId', button.data('userid'));
                            rowData.bd_cn = rank;
                            oTableLock.table.bootstrapTable('updateRow', {index: index, row: rowData});
                        });
                    }else{
                        alertMsg(d);
                    }
                });

            });

        });


    });

</script>

</html>
