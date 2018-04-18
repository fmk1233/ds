<div class="ibox actuser-box" style="margin-bottom: 0px">
    <div class="ibox-title">
        <h5>会员充值</h5>
        <div class="ibox-tools">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
    <div class="ibox-content" >
        <div class="alert alert-warning clearfix" style="margin-bottom: 0px;">
            <form class="form-horizontal col-md-12 layui-form" method="post"  id="recharge" action="" onsubmit="return false;">
                <input type="hidden" value="DBonus.DoRecharge" name="service">
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><span class="text-danger"></span><i class="fa fa-user"></i> 会员编号</label>
                    <div class="col-sm-9">

                        <input type="text" name="username" required lay-verify="required" id="username" class="form-control" placeholder="请输入对方会员编号">
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><span class="text-danger"></span><i class="fa fa-money"></i> 充值金额</label>
                    <div class="col-sm-9">
                        <input type="number"  required lay-verify="required|number" min="1" name="amount" class="form-control" placeholder="请输入金额">

                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><span class="text-danger"></span><i class="fa fa-money"></i> 充值类型</label>
                    <div class="col-sm-9">
                        <select name="moneyType" class="form-control">
                            <?php $bonus_names = Common_Function::getBonusName(); foreach($bonus_names as $key=>$bonus_name): ?>
                                <option value="<?php echo $key; ?>"><?php echo $bonus_name; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label hidden-xs"></label>
                    <div class="col-sm-9">
                        <div class="market">
                            <button  class="orange btn btn-warning" type="button" lay-submit lay-filter="formDemo" style="padding: 10px !important; "><i class="fa fa-trophy"></i> 确认充值</button>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
        .market button.btn-warning.dim {
            box-shadow: inset 0 0 0 #ce8f15, 0 2px 0 0 #ce8f15, 0 5px 3px #a9a5a5;
        }
        .market button {
            width: 100%;
            text-align: center;
            padding: 20px !important;
            border-radius: 5px;
            text-align: center;
            font-size: 2rem;
            line-height: normal;
            font-weight: normal !important;
            overflow: hidden;
        }
        button.dim {
            display: inline-block;
            text-decoration: none;
            text-transform: uppercase;
            text-align: center;
            padding-top: 6px;
            margin-right: 10px;
            position: relative;
            cursor: pointer;
            border-radius: 5px;
            font-weight: 600;
            margin-bottom: 20px !important;
        }
        .market .btn-warning {
            background: #fab22a;
            background: -webkit-linear-gradient(#fde30a , #fab22a) !important;
            background: -o-linear-gradient(#fde30a , #fab22a) !important;
            background: -moz-linear-gradient(#fde30a , #fab22a) !important;
            background: linear-gradient(#fde30a , #fab22a) !important;
            border: none;
            color: #FFFFFF;
        }
        @media (min-width: 768px){
            .form-horizontal .control-label {
                padding-top: 10px;
            }
        }
        @media (min-width: 768px){
            .actuser-box .bootstrap-table table tbody tr:nth-child(odd) {
                color: #999;
                background: #f5f5f5;
            }

        }

    </style>
<script type="text/javascript">
    layui.use('validation', function () {
        var form = layui.form();
        var validation = layui.validation;
        $('#username').on('blur', function () {
            var $this = $(this);
            validation.checkUser($this);
        });
        //监听提交
        form.on('submit(formDemo)', function (data) {
            confirmMsg('您确认给会员'+data.field.username+'充值'+data.field.amount,function (isConfirm) {
                confirmClose();
                if(isConfirm){
                    sendButtonAjax($(data.elem), data.field,function () {
                        $('#ajaxModel').modal('hide');
                        location.reload();
                    });
                }
            },{closeOnCancel:false});

            return false;
        });
    });
</script>