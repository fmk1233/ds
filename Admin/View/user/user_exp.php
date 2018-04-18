<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title clearfix">
                    <h5>异常会员管理</h5>
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
                                                <option value="member-user_name">会员编号</option>
                                                <option value="member-id">会员ID</option>
                                                <option value="member-pid">推荐人ID</option>
                                                <option value="member-mobile">手机号</option>
                                            </select>
                                        </span>
                                        <input type="text" class="form-control" id="qvalue" name="qvalue"
                                               placeholder="搜索相关数据...">
                                    </div><!-- /input-group -->
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
<script type="text/javascript">
    $(function () {
        var rank_names = JSON.parse('<?php echo json_encode(Common_Function::getRankName()); ?>');
        var pos_names = JSON.parse('<?php echo json_encode(Common_Function::getPosName()); ?>');
        var $columnsLock = [ {
            field: 'id',
            title: 'ID',
        }, {
            field: 't_user_name',
            title: '推荐人编号'
        },<?php if(POSNUM > 1): ?>
            {
                field: 'p_user_name',
                title: '接点人编号'

            },{
                field: 'pos',
                title: '市场位置',
                formatter:function (value) {
                    return pos_names[value];
                }

            },
            <?php endif; ?>
            {
                field: 'user_name',
                title: '会员编号'

            }, {
                field: 'rank',
                title: '会员级别',
                formatter: function (value) {
                    return rank_names[value];
                }
            },
            <?php  $bonus_names = Common_Function::getBonusName(); foreach ($bonus_names as $key=>$bonus_name): ?>
            {
                field: '<?php echo BONUS_NAME.$key;?>',
                title: '<?php echo $bonus_name;?>'
            },
            <?php endforeach;?>
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
                    return $.myTime.UnixToDate(value, true);
                }
            }, {
                field: 'reg_ip',
                title: '注册ip'
            }, {
                field: 'mobile',
                title: '手机号'
            },{
                field: 'action',
                title: '操作',
                formatter: function (value, d) {
                    value = d.id;
                    var $html = '';
                    $html +='<a  del href="javascript:void(-1)" data-service="DUser.DelMember" class="btn btn-danger btn-outline btn-xs" data-userId="' + value + '" >删除</a> ';
                    return  $html;
                }
            }];
        var querystrLock = "{service:'DUser.ExpUserList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),rank:$('#rank').val()}";
        var optionsLock = {
            columns: $columnsLock,
            showExport: true,
            showColumns: true,
            exportOptions: {fileName: '异常会员信息'}
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#userSearch').on('submit', function () {
            oTableLock.load();
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


    });

</script>

</html>
