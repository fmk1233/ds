<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <style>
        .note-editor{
            border: 1px solid rgb(204,204,204);
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
                    <h2>   <?php echo $state == 0 ? T('未激活会员') : T('已激活会员'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('团队管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong>  <?php echo $state == 0 ? T('未激活会员') : T('已激活会员'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-sm-12 jhhy-border">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content sj-box-pad borderc">

                                    <div id="toolbar">
                                        <form class="form-inline" role="form" onsubmit="return false;">
                                            <div class="form-group">
                                                <div class="input-group">
                                                        <span class="input-group-addon" select="">
                                                            <select name="qtype" id="qtype">
                                                                <option value="username"><?php echo T('会员编号'); ?></option>
                                                                <option value="realname"><?php echo T('会员姓名'); ?></option>
                                                            </select>
                                                        </span>
                                                    <input type="text" class="form-control" id="qvalue"
                                                           name="qvalue"
                                                           placeholder="<?php echo T('搜索相关数据'); ?>...">
                                                </div><!-- /input-group -->
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="laydate-icon form-control "
                                                           id="s_time" name="s_time"
                                                           placeholder="<?php echo T('开始时间'); ?>"
                                                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                                    <span class="input-group-addon"><?php echo T('到'); ?></span>
                                                    <input type="text" class="laydate-icon form-control "
                                                           id="e_time" name="e_time"
                                                           placeholder="<?php echo T('结束时间'); ?>"
                                                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                                </div>
                                            </div>
                                            <button type="submit"
                                                    class="btn btn-primary"><?php echo T('搜索'); ?></button>
                                        </form>
                                    </div>
                                    <table data-min-width="768" class="table" data-mobile-responsive="true">
                                    </table>
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
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script type="text/javascript">
    $(function () {
        var rank_names = JSON.parse('<?php echo json_encode(Common_Function::getRankName()); ?>');
        var pos_names = JSON.parse('<?php echo json_encode(Common_Function::getPosName()); ?>');
        var $columnsLock = [{
            field: 'id',
            title: '<?php echo T('ID')?>'
        }, {
            field: 'user_name',
            title: '<?php echo T('会员编号');?>'
        }, {
            field: 'true_name',
            title: '<?php echo T('会员姓名');?>'
        }, {
            field: 'rank',
            title: '<?php echo T('会员级别')?>',
            formatter: function (value) {
                return rank_names[value];
            }
        }, {
            field: 't_user_name',
            title: '<?php echo T('推荐人')?>'
        },
                <?php if(POSNUM > 1): ?>{
                field: 'p_user_name',
                title: '<?php echo T('接点人')?>'
            }, {
                field: 'pos',
                title: '<?php echo T('市场位置')?>',
                formatter: function (value) {
                    return pos_names[value];
                }
            }, <?php endif;?> {
                field: 'reg_time',
                title: '<?php echo T('注册时间')?>',
                formatter: function (value) {
                    return showTime(value);
                }
            }, {
                field: 'action',
                title: '操作',
                formatter: function (value, d) {
                    value = d.id;
                    return '<a class="btn btn-primary btn-outline btn-xs" data-service="User.EditUser"data-userid="'+value+'" data-toggle="url"><?php echo T('修改');?></a> ' + (d.state == '0' ? ' <a  del href="javascript:void(-1)" data-service="User.DelMember" class="btn btn-danger btn-outline btn-xs" data-userId="' + value + '" ><?php echo T('删除');?></a> <a  active href="javascript:void(-1)" class="btn btn-warning btn-outline btn-xs" data-service="User.activateMember" data-userId="' + value + '" ><?php echo T('激活');?></a> ' : '');
                }
            }];
        var querystrLock = "{service:'User.GetUserList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),state:<?php echo $state; ?>}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });
        $('.table').on('click', 'a[active]', function () {
            var $this = $(this);
            var data = $this.data();
            confirmMsg('<?php echo T('您确认激活此会员') ?>',function(){
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
            confirmMsg('<?php echo T('您确认删除此会员') ?>',function(){
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
</body>

</html>
