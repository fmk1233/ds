<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
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
                    <h2><?php echo T('报单中心申请'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('团队管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo T('报单中心申请'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row tdtj">
                        <div class="dol-lg-3 col-md-2">
                            <?php $this->view('user_slide.php');?>
                        </div>
                        <div class="dol-lg-9 col-md-10">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?php echo T('报单中心申请'); ?> </h5>
                                </div>
                                <div class="ibox-content sj-box-pad borderc">
                                    <?php if($user['bd_center']<count(Common_Function::getBdCenterName())-1): ?>
                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <img alt="image" class="img-circle m-t-xs img-responsive "
                                                 src="<?php echo Common_Function::GoodsPath('/image/man.jpg'); ?>"
                                                 width="100" id="headerImg" style="margin: 0 auto;border: 6px solid rgba(0,0,0,.2);
                                        margin-bottom: 20px;">
                                            <div class="user-msgb">
                                            <span
                                                class="user-msgb-level"><?php echo Common_Function::getRankName($user['rank']); ?></span>
                                            </div>
                                            <div class="user-msgb">
                                            <span class="user-msgb-number">
                                                <img
                                                    src="<?php echo Common_Function::GoodsPath('/ds/technology/images/l_icon1.png'); ?>"
                                                    alt="用户"
                                                    style="width: 18px;margin-top: -2px;margin-right: 2px;"><?php echo $user['user_name']; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 b-r">
                                            <form class="form-horizontal" id="form" onsubmit="return false;">
                                                <input type="hidden" value="User.ApplyCenter" name="service"/>
                                                <input type="hidden" value="post" name="action"/>
                                                <input type="hidden" value="<?php echo $user['bd_center']; ?>" name="oldrank"/>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><?php echo T('申请级别'); ?>:</label>
                                                    <div class="col-md-7">
                                                        <select name="newrank" class="form-control">
                                                            <?php $rank_names = Common_Function::getBdCenterName();foreach($rank_names as $key=>$val):if($key<=$user['bd_center']){continue;} ?>
                                                                <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php if($protocol['state'] == 1){?>
                                                    <div class="form-group">
                                                        <label class="col-md-3  control-label"><span
                                                                    class="text-danger">*</span> <?php echo T($protocol['title']); ?></label>
                                                        <div class="col-sm-7">
                                                            <div class="">
                                                                <div class="panel-group" id="accordion">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false"><?php echo T('点击查看协议详情'); ?></a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                            <div class="panel-body">
                                                                                <?= html_entity_decode($protocol['content']);?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"> </label>

                                                        <div class="col-sm-7">
                                                            <input name="agree" type="checkbox" value="1" checked id="agree">
                                                            <?php echo T('我已阅读并同意以上协议'); ?>
                                                        </div>
                                                    </div>
                                                <?php }?>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button class="btn blue mt-clipboard" type="submit" id="submit"><i
                                                                    class="fa fa-check"></i> <?php echo T('确认'); ?>
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                    <?php endif;?>
                                    <div class="alert alert-success">
                                        <?php echo T('报单中心申请'), T('记录') ?>
                                    </div>
                                    <div id="toolbar">
                                        <form class="form-inline" role="form" onsubmit="return false;">
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
                                    <table data-min-width="768" data-mobile-responsive="true" class="table">
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
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<script>
    $(function () {

        //获取钱包列表数据
        var check_names = JSON.parse('<?php echo json_encode(Common_Function::getCheckName()); ?>');
        var bd_names = JSON.parse('<?php echo json_encode(Common_Function::getBdCenterName()); ?>');
        //获取充值列表数据
        var $columnsLock = [{
            field: 'id',
            title: 'ID'
        },{
            field: 'old_rank',
            title: '<?php echo T('原级别')?>',
            formatter: function (value) {
                return bd_names[value];
            }
        }, {
            field: 'new_rank',
            title: '<?php echo T('申请级别')?>',
            formatter: function (value) {
                return bd_names[value];
            }
        },   {
            field: 'status',
            title: '<?php echo T('状态')?>',
            formatter: function (value) {
                var text = check_names[value]
                switch (parseInt(value)) {
                    case 0:
                        return '<span class="label label-warning">' + text + '</span>';
                        break;
                    case 1:
                        return '<span class="label label-success">' + text + '</span>';
                        break;
                    case 2:
                        return '<span class="label label-danger">' + text + '</span>';
                        break;
                }
            }
        }, {
            field: 'add_time',
            title: '<?php echo T('时间')?>',
            formatter: function (value) {
                return $.myTime.UnixToDate(value);
            }
        }];
        var querystrLock = "{service:'User.GetApplyCenterList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val()}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });
        bindFormAjax($('#form'));
        $("#agree").on("change", function () {
           if($(this).prop('checked')==false) {
               $("#submit").prop("disabled", true);
           }else{
               $("#submit").prop("disabled", false);
           }
        });
    })
</script>
</body>

</html>
