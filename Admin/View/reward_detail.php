<!DOCTYPE html>
<html>


<?php $this->view('header'); ?>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title clearfix">
                    <div class="pull-right" id="group">
                    </div>
                    <h5>奖金明细管理</h5>
                </div>
                <div class="ibox-content padding-top">
                    <?php $this->view('tips'); ?>
                    <div class="clearfix">
                        <div id="toolbar">
                            <form class="form-inline hidden" id="userSearch" role="form" onsubmit="return false;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" select="">
                                            <select name="qtype" id="qtype">
                                                <option value="user_name" selected>会员编号</option>
                                                <option value="true_name">会员姓名</option>
                                                <option value="user_id">会员ID</option>
                                            </select>
                                        </span>
                                        <input type="text" class="form-control" id="qvalue" name="qvalue"  value="<?= $username;?>"
                                               placeholder="搜索相关数据...">
                                    </div><!-- /input-group -->
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="laydate-icon form-control " id="s_time" name="s_time" value="<?= $s_time;?>"
                                               placeholder="开始时间"
                                               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                        <span class="input-group-addon">到</span>
                                        <input type="text" class="laydate-icon form-control " id="e_time" name="e_time" value="<?= $e_time;?>"
                                               placeholder="结束时间"
                                               onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                    </div>
                                </div>
                                <input type="hidden" value="1" id="search_type"/>
                                <input type="hidden" value="day" name="group"/>
                                <button type="submit" class="btn btn-primary">搜索</button>
                            </form>
                            <button type="button" class="btn btn-white" id="back" onclick="javascript:history.go(-1);"><i class="fa fa-reply"></i> 返回</button>
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
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/tooltips.js"></script>
<script type="text/javascript">
    $(function () {
        var group = '';
        var is_visible = false;
        var $columnsLock = [{
            field: 'id',
            title: 'ID',
        }, {
            field: 'periods',
            title: '<?php echo T('期数')?>'
        }, {
            field: 'user_name',
            title: '会员编号'

        }, {
            field: 'true_name',
            title: '会员姓名',
            formatter:function (value,d) {
                return value + (d.memo?'<span class="memo" style="display:none;"><div style="position:relative;line-height:22px;min-width:12px;padding:5px 10px;font-size:14px;_float:left;border-radius:2px;box-shadow:1px 1px 3px rgba(0,0,0,.2);background-color:#000;color:#fff">'+d.memo+'</div></span>':'');
            }

        },<?php $prices = Domain_Reward::rewardPrice(); foreach ($prices as $key=>$price):?>
            {
                field: '<?php echo $price ?>',
                title: '<?php echo T($key)?>'
            },
            <?php endforeach;?>
            <?php $fees = Domain_Reward::rewardFee(); foreach ($fees as $key=>$fee):?>
            {
                field: '<?php echo $fee ?>',
                title: '<?php echo T($key)?>'
            }, <?php endforeach;?>
            {
                field: 'money',
                title: '<?php echo T('实得')?>'
            },
            {
                field: 'add_time',
                title: '<?php echo T('时间')?>',
                formatter: function (value, d) {
                    if (group != '') {
                        return d.days;
                    }
                    return showTime(value);
                }
            },{
                field: 'control',
                title: '操作',
                visible: is_visible,
                formatter: function (value, d) {
                    if (group == 'day') {
                        return ' <a class="btn btn-primary btn-outline btn-xs" data-toggle="url" data-service="DUser.userInfo" data-userid="'+value+'">查看详情</a> ';
                    }else{
                        return '-';
                    }
                }
            }];
        var querystrLock = "{service:'Reward.GetRewardList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),group:$('#group').val(),search_type:$('#search_type').val()}";
        var optionsLock = {
            columns: $columnsLock,
            showColumns: true,
            exportOptions: {fileName: '奖金明细'}
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#userSearch').on('submit', function () {
            oTableLock.load();
        });
        $('.table').on('mouseover mouseout','tr[data-index]',function (e) {
            var memo = $(this).find('.memo');
            if(memo.length>0){
                if(e.type=='mouseover'){
                    toolTip(memo.html());
                }else{
                    toolTip();
                }
            }
        });
        $('#group .btn-group button').on('click', function () {
            var button = $(this);
            if (button.hasClass('active')) {
                return;
            }
            $('.btn-group button').removeClass('active');
            button.addClass('active');
            group = button.data('group');
            $('#group').val(group);
            is_visible = group == 'day';
            console.log(group);
            oTableLock.load();

        });


    });

</script>

</html>
