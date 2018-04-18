<form class="form-horizontal" action="" method="post" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
    <input type="hidden" name="service" value="GoodOrders.sendGoodsAc"/>
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h4 class="modal-title">订单发货</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="col-sm-2 control-label">收 货 人</label>
            <div class="col-sm-9 col-xs-12">
                <div class="form-control-static">
                    联系人: <?php $address=unserialize($order['address']); echo $address['realname']; ?> / <?php echo $address['mobile']; ?> <br>
                    地    址: <?php echo $address['province'],' ',$address['city'],' ',$address['area'],' ',$address['address']?></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">快递公司</label>
            <div class="col-sm-9 col-xs-12">
                <select class="form-control" name="express" id="express">
                    <option value="" data-name="">其他快递</option>
                    <?php foreach($logcoms as $logcom): ?>
                        <option value="<?php echo $logcom['code']; ?>"  data-name="<?php echo $logcom['company']; ?>" ><?php echo $logcom['company']; ?></option>
                    <?php endforeach;?>

                </select>
            </div>
            <input type="hidden" value="" name="expresscom" id="expresscom">
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">快递单号</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" name="expresssn" class="form-control" value="" data-rule-required="true" aria-required="true">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">确认发货</button>
        <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
    </div>
    <script type="application/javascript">

        $("select[name=express]").val('<?php echo $order['delivery_code']; ?>');

        $("#express").change(function () {
            var obj = $(this);
            var sel = obj.find("option:selected").attr("data-name");
            $("#expresscom").val(sel);
        });

    </script>
</form>