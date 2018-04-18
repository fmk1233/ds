<!DOCTYPE html>
<html>

<head>
    <?php $this->view('header'); ?>
    <link href="<?php echo URL_ROOT.'/static/'?>css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo URL_ROOT.'/static/'?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
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
                    <h2>   <?php echo T('留言列表'); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a data-toggle="url" data-service="User.Main"><?php echo T('首页'); ?></a>
                        </li>
                        <li>
                            <a><?php echo T('信息管理'); ?></a>
                        </li>
                        <li class="active">
                            <strong>   <?php echo T('我要留言'); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content sj-box-pad">

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
                                            <button type="submit" class="btn btn-primary"><?php echo T('搜索'); ?></button>
                                            <?php if($type==0): ?>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#myModal"><?php echo T('我要留言'); ?>
                                                </button>
                                            <?php endif;?>
                                        </form>
                                    </div>
                                    <table data-min-width="768" class="table" data-mobile-responsive="true"
                                         >
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
<!--留言弹出框-->
<?php if($type==0): ?>
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog summary-info">
        <div class="modal-content animated bounceInDown portlet light">
            <div class="modal-header portlet-title">
                <div class="caption">
                    <span class="ui-text-blue"><?php echo T('我要留言'); ?></span>
                </div>

                <div class="actions">
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>

            </div>
            <form role="form" id="sendForm" method="post" onsubmit="return false;">
                <div class="modal-body portlet-body">
                    <input type="hidden" value="Msg.addMsg" name="service">

                    <div class="form-group">
                        <label><?php echo T('主题'); ?></label>
                        <input type="text" class="form-control"  style="border: 1px solid rgb(204,204,204)" name="title" placeholder="<?php echo T('输入'),T('主题'); ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo T('内容'); ?>：</label>
                        <div id="eg2">
                            <div class="summernote" style="border: 1px solid rgb(204,204,204)"> </div>
                        </div>
                        <input id="content" style="border: 1px solid rgb(204,204,204)" type="hidden" name="content"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline grey-salsa"
                            data-dismiss="modal"><?php echo T('取消'); ?></button>
                    <button type="submit" class="btn btn-primary mt-clipboard" ><i class="fa fa-check"></i><?php echo T('确认'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif;?>
<?php $this->view('footer_js'); ?>
<script type="text/javascript" src="<?php echo URL_ROOT . '/static/'; ?>js/plugins/laydate/laydate.js"></script>
<script src="<?php echo URL_ROOT.'/static/'?>js/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo URL_ROOT.'/static/'?>js/plugins/summernote/summernote-zh-CN.js"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/validate/bootstrap.js'); ?>"></script>
<!--style="border: 1px solid rgb(204,204,204)"-->
<script>
    $(function () {
        $(".summernote").summernote({lang: "zh-CN",onImageUpload:function (files,d,b) {
            var callback=function (url) {
                d.insertImage(b,url);
            };
            uploadImage(files[0],callback);
        }});
        //获取钱包列表数据
        var replay_names = JSON.parse('<?php echo json_encode(Domain_Msg::replayParams()); ?>');
        //获取充值列表数据
        var $columnsLock = [{
            field: 'id',
            title: 'ID',
        },  {
            field: 'msg_title',
            title: '<?php echo T('标题'); ?>'
        }, {
            field: 'add_time',
            title: '<?php echo T('时间'); ?>',
            formatter: function (value) {
                return showTime(value);
            }
        }, {
            field: 'is_reply',
            title: '<?php echo T('回复'); ?>',
            formatter: function (value) {
                return replay_names[value];
            }
        }, {
            field: 'action',
            title: '<?php echo T('操作'); ?>',
            formatter: function (value, d) {
                value = d.id;
                var $html = '';
                $html += '<a class="btn btn-primary btn-outline btn-xs" refuse data-toggle="url" data-service="Msg.MsgDetail" data-from="<?php echo $type==0?'Msg.MsgList':'Msg.FromMsgList'  ?>" data-msg_id="'+value+'"><i class="fa fa-eye"></i> <?php echo T('查看') ?></a> ';
                return $html;
            }
        }];
        var querystrLock = "{service:'Msg.GetMsgList',qtype:$('#qtype').val(),qvalue:$('#qvalue').val(),s_time:$('#s_time').val(),e_time:$('#e_time').val(),type:<?php echo $type ?>}";
        var optionsLock = {
            columns: $columnsLock,
        };
        var oTableLock = $('.table').tableInit(optionsLock, querystrLock);
        oTableLock.Init();
        $('#toolbar form').on('submit',function () {
            oTableLock.load();
        });
        $('#myModal form').formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            trigger:'blur',
            onSuccess: function (e) {
                e.preventDefault();
                var content = $("#eg2 .summernote").code();
                $('#content').val(content);
                var $form = $(e.target);
                sendFormAjax($form);
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo T('请填写'), T('主题') ?>'
                        },
                    }
                }
            }
        });

    })
</script>
</body>

</html>
