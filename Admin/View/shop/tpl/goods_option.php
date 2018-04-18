<div class="form-group">
    <label class="col-sm-1 control-label">编码</label>
    <div class="col-sm-5">
        <input type="text" name="goods_sn" id="goods_sn"
               class="form-control hasoption" <?php echo $goods['has_option'] ? 'readonly' : ''; ?>
               value="<?php echo $goods['goods_sn']; ?>">
    </div>

    <label class=" col-sm-1 control-label">条码</label>
    <div class="col-sm-5">
        <input type="text" name="product_sn" id="product_sn"
               class="form-control hasoption" <?php echo $goods['has_option'] ? 'readonly' : ''; ?>
               value="<?php echo $goods['product_sn']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-1 control-label">重量</label>
    <div class="col-sm-11">
        <div class="input-group">
            <input type="text" name="weight" id="weight"
                   class="form-control hasoption" <?php echo $goods['has_option'] == 1 ? 'readonly' : ''; ?>
                   value="<?php echo $goods['weight']; ?>">
            <span class="input-group-addon">克</span>
        </div>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label">库存</label>
    <div class="col-sm-11">
        <input type="text" name="stock" id="stock"
               class="form-control hasoption" <?php echo $goods['has_option'] == 1 ? 'readonly' : ''; ?>
               value="<?php echo $goods['stock']; ?>"
               style="width:150px;display: inline;margin-right: 20px;">
        <span class="help-block">商品的剩余数量, 如启用多规格，则此处设置无效.</span>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-11" style="padding-left:30px;">
        <label class="checkbox-inline">
            <input type="checkbox" id="hasoption"
                   value="1" <?php echo $goods['has_option'] == 1 ? 'checked' : ''; ?>
                   name="has_option">启用商品规格
        </label>
        <span class="help-block">启用商品规格后，商品的价格及库存以商品规格为准,库存设置为0则会到”已售罄“中，手机也不会显示, -1为不限制</span>

    </div>
</div>

<div id="tboption" style="padding-left:15px;<?php echo $goods['has_option'] != 1 ? 'display:none' : '' ?>">
    <div class="alert alert-info">
        1. 拖动规格可调整规格显示顺序, 更改规格及规格项后请点击下方的【刷新规格项目表】来更新数据。<br>
        2. 每一种规格代表不同型号，例如颜色为一种规格，尺寸为一种规格，如果设置多规格，手机用户必须每一种规格都选择一个规格项，才能添加购物车或购买。
    </div>
    <div id="specs">
        <?php foreach ($goods['option_title'] as $title) {
            $this->assign('spec', $title);
            $this->view('shop/tpl/goods_spec');
        } ?>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td>
                <h4><a href="javascript:;" class="btn btn-primary" id="add-spec" onclick="addSpec()"
                       style="margin-top:10px;margin-bottom:10px;" title="添加规格"><i class="fa fa-plus"></i> 添加规格</a>
                    <a href="javascript:;" onclick="refreshOptions();" title="刷新规格项目表" class="btn btn-primary"><i
                                class="fa fa-refresh"></i> 刷新规格项目表</a></h4>
            </td>
        </tr>
        </tbody>
    </table>
    <div id="options" style="padding:0;"></div>
</div>


<input type="hidden" name="optionArray" value="">
<script type="text/javascript" src="<?php echo URL_ROOT; ?>/static/js/jquery-ui.custom.min.js"></script>
<script type="text/javascript">
    $('#specs').sortable({
        stop: function () {
            refreshOptions();
        }
    });
    $('.spec_item_items').sortable(
        {
            handle: '.fa-arrows',
            stop: function () {
                refreshOptions();
            }
        }
    );
    $(function () {
        var data = JSON.parse('<?php echo $goods_option?>');
        if(data.length>0){
            refreshOptions(data);
        }
        $("#hasoption").click(function () {
            var obj = $(this);
            if (obj.get(0).checked) {
                refreshOptions();
                $('.hasoption').attr('readonly', true);
                $("#tboption").show();
            } else {
                $("#tboption").hide();
                refreshOptions();
                $('.hasoption').removeAttr('readonly');

            }
        });
    });

    function addSpec() {
        var len = $(".spec_item").length;


        $("#add-spec").html("正在处理...").attr("disabled", "true").toggleClass("btn-primary");
        var data = ds.url({service:'Goods.addGoods',tpl:'spec'},true);
        $.ajax({
            url: baseUrl,
            data:{params:data.params},
            dataType: 'text',
            type: 'post',
            headers:{Sign:data.sign,Token:data.token},
            success: function (data) {
                $("#add-spec").html('<i class="fa fa-plus"></i> 添加规格').removeAttr("disabled").toggleClass("btn-primary");
                ;
                $('#specs').append(data);
                var len = $(".add-specitem").length - 1;
                $(".add-specitem:eq(" + len + ")").focus();
                refreshOptions();
            }
        });
    }
    function removeSpec(specid) {
        if (confirm('确认要删除此规格?')) {
            $("#spec_" + specid).remove();
            refreshOptions();
        }
    }
    function addSpecItem(specid) {
        $("#add-specitem-" + specid).html("正在处理...").attr("disabled", "true");
        var data = ds.url({service:'Goods.addGoods',tpl:'specItem',spec_id:specid},true);
        $.ajax({
            url: baseUrl,
            data:{params:data.params},
            dataType: 'text',
            type: 'post',
            headers:{Sign:data.sign,Token:data.token},
            success: function (data) {
                $("#add-specitem-" + specid).html('<i class="fa fa-plus"></i> 添加规格项').removeAttr("disabled");
                $('#spec_item_' + specid).append(data);
                var len = $("#spec_" + specid + " .spec_item_title").length - 1;
                $("#spec_" + specid + " .spec_item_title:eq(" + len + ")").focus();
                refreshOptions();
            }
        });
    }
    function removeSpecItem(obj) {
        $(obj).closest('.spec_item_item').remove();
        refreshOptions();
    }

    function refreshOptions($data) {
        var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
        var specs = [];
        if ($('.spec_item').length <= 0) {
            $("#options").html('');
//            isdiscount_change();
            return;
        }
        $(".spec_item").each(function (i) {
            var _this = $(this);
            var spec = {
                id: _this.find(".spec_id").val(),
                title: _this.find(".spec_title").val()
            };

            var items = [];
            _this.find(".spec_item_item").each(function () {
                var __this = $(this);
                var item = {
                    id: __this.find(".spec_item_id").val(),
                    title: __this.find(".spec_item_title").val(),
                    show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
                }
                items.push(item);
            });
            spec.items = items;
            specs.push(spec);
        });
        specs.sort(function (x, y) {
            if (x.items.length > y.items.length) {
                return 1;
            }
            if (x.items.length < y.items.length) {
                return -1;
            }
        });

        var len = specs.length;
        var newlen = 1;
        var h = new Array(len);
        var rowspans = new Array(len);

        for (var i = 0; i < len; i++) {
            html += "<th>" + specs[i].title + "</th>";
            var itemlen = specs[i].items.length;
            if (itemlen <= 0) {
                itemlen = 1
            }
            ;
            newlen *= itemlen;

            h[i] = new Array(newlen);
            for (var j = 0; j < newlen; j++) {
                h[i][j] = new Array();
            }
            var l = specs[i].items.length;
            rowspans[i] = 1;
            for (j = i + 1; j < len; j++) {
                rowspans[i] *= specs[j].items.length;
            }
        }

        html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">库存</div><div class="input-group"><input type="text" class="form-control  input-sm option_stock_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_stock\');"></a></span></div></div></th>';
        html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">现价</div><div class="input-group"><input type="text" class="form-control  input-sm option_marketprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_marketprice\');"></a></span></div></div></th>';
        html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">原价</div><div class="input-group"><input type="text" class="form-control  input-sm option_productprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_productprice\');"></a></span></div></div></th>';
        html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">编码</div><div class="input-group"><input type="text" class="form-control  input-sm option_goodssn_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_goodssn\');"></a></span></div></div></th>';
        html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">条码</div><div class="input-group"><input type="text" class="form-control  input-sm option_productsn_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_productsn\');"></a></span></div></div></th>';
        html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">重量（克）</div><div class="input-group"><input type="text" class="form-control  input-sm option_weight_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_weight\');"></a></span></div></div></th>';
        html += '</tr></thead>';
        for (var m = 0; m < len; m++) {
            var k = 0, kid = 0, n = 0;
            for (var j = 0; j < newlen; j++) {
                var rowspan = rowspans[m];
                if (specs[m].items[kid] == undefined) {
                    specs[m].items[kid] = {id: '', title: ''}
                }
                if (j % rowspan == 0) {
                    h[m][j] = {
                        title: specs[m].items[kid].title,
                        html: "<td class='full' rowspan='" + rowspan + "'>" + specs[m].items[kid].title + "</td>\r\n",
                        id: specs[m].items[kid].id
                    };
                }
                else {
                    h[m][j] = {
                        title: specs[m].items[kid].title,
                        html: "",
                        id: specs[m].items[kid].id
                    };
                }
                n++;
                if (n == rowspan) {
                    kid++;
                    if (kid > specs[m].items.length - 1) {
                        kid = 0;
                    }
                    n = 0;
                }
            }
        }
        var hh = "";
        for (var i = 0; i < newlen; i++) {
            hh += "<tr>";
            var ids = [];
            var titles = [];
            for (var j = 0; j < len; j++) {
                hh += h[j][i].html;
                ids.push(h[j][i].id);
                titles.push(h[j][i].title);
            }
            ids = ids.join('_');
            titles = titles.join('+');
            var val = {
                id: "",
                title: titles,
                stock: "",
                costprice: "",
                productprice: "",
                marketprice: "",
                weight: "",
                productsn: "",
                goodssn: "",
            };
            if ($(".option_id_" + ids).length > 0) {
                val = {
                    id: $(".option_id_" + ids + ":eq(0)").val(),
                    title: titles,
                    stock: $(".option_stock_" + ids + ":eq(0)").val(),
                    costprice: $(".option_costprice_" + ids + ":eq(0)").val(),
                    productprice: $(".option_productprice_" + ids + ":eq(0)").val(),
                    marketprice: $(".option_marketprice_" + ids + ":eq(0)").val(),
                    goodssn: $(".option_goodssn_" + ids + ":eq(0)").val(),
                    productsn: $(".option_productsn_" + ids + ":eq(0)").val(),
                    weight: $(".option_weight_" + ids + ":eq(0)").val(),
                }
            }

            if($data){
                val = {
                    id: $data[i].option_id,
                    title: $data[i].option_title,
                    stock: $data[i].option_stock,
                    costprice: '',
                    productprice: $data[i].option_marketprice,
                    marketprice: $data[i].option_price,
                    weight: $data[i].option_weight,
                    productsn: $data[i].option_goodssn,
                    goodssn: $data[i].option_productsn,
                }
            }


            hh += '<td>'
            hh += '<input data-name="option_stock_' + ids + '" type="text" class="form-control option_stock option_stock_' + ids + '" value="' + (val.stock == 'undefined' ? '' : val.stock ) + '"/></td>';
            hh += '<input data-name="option_id_' + ids + '" type="hidden" class="form-control option_id option_id_' + ids + '" value="' + (val.id == 'undefined' ? '' : val.id ) + '"/>';
            hh += '<input data-name="option_ids" type="hidden" class="form-control option_ids option_ids_' + ids + '" value="' + ids + '"/>';
            hh += '<input data-name="option_title_' + ids + '" type="hidden" class="form-control option_title option_title_' + ids + '" value="' + (val.title == 'undefined' ? '' : val.title ) + '"/></td>';
            hh += '<input data-name="option_virtual_' + ids + '" type="hidden" class="form-control option_virtual option_virtual_' + ids + '" value="' + (val.virtual == 'undefined' ? '' : val.virtual ) + '"/></td>';
            hh += '</td>';
            hh += '<td><input data-name="option_marketprice_' + ids + '" type="text" class="form-control option_marketprice option_marketprice_' + ids + '" value="' + (val.marketprice == 'undefined' ? '' : val.marketprice ) + '"/></td>';
            hh += '<td><input data-name="option_productprice_' + ids + '" type="text" class="form-control option_productprice option_productprice_' + ids + '" " value="' + (val.productprice == 'undefined' ? '' : val.productprice ) + '"/></td>';
//            hh += '<td><input data-name="option_costprice_' + ids + '" type="text" class="form-control option_costprice option_costprice_' + ids + '" " value="' + (val.costprice == 'undefined' ? '' : val.costprice ) + '"/></td>';
            hh += '<td><input data-name="option_goodssn_' + ids + '" type="text" class="form-control option_goodssn option_goodssn_' + ids + '" " value="' + (val.goodssn == 'undefined' ? '' : val.goodssn ) + '"/></td>';
            hh += '<td><input data-name="option_productsn_' + ids + '" type="text" class="form-control option_productsn option_productsn_' + ids + '" " value="' + (val.productsn == 'undefined' ? '' : val.productsn ) + '"/></td>';
            hh += '<td><input data-name="option_weight_' + ids + '" type="text" class="form-control option_weight option_weight_' + ids + '" " value="' + (val.weight == 'undefined' ? '' : val.weight ) + '"/></td>';
            hh += "</tr>";
        }
        html += hh;
        html += "</table>";
        $("#options").html(html);
//        refreshDiscount();
//        refreshIsDiscount();
//        isdiscount_change();
    }

    function refreshDiscount() {
        var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
        var specs = [];

        $(".spec_item").each(function (i) {
            var _this = $(this);

            var spec = {
                id: _this.find(".spec_id").val(),
                title: _this.find(".spec_title").val()
            };

            var items = [];
            _this.find(".spec_item_item").each(function () {
                var __this = $(this);
                var item = {
                    id: __this.find(".spec_item_id").val(),
                    title: __this.find(".spec_item_title").val(),
                    virtual: __this.find(".spec_item_virtual").val(),
                    show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
                }
                items.push(item);
            });
            spec.items = items;
            specs.push(spec);
        });
        specs.sort(function (x, y) {
            if (x.items.length > y.items.length) {
                return 1;
            }
            if (x.items.length < y.items.length) {
                return -1;
            }
        });

        var len = specs.length;
        var newlen = 1;
        var h = new Array(len);
        var rowspans = new Array(len);
        for (var i = 0; i < len; i++) {
            html += "<th>" + specs[i].title + "</th>";
            var itemlen = specs[i].items.length;
            if (itemlen <= 0) {
                itemlen = 1
            }
            ;
            newlen *= itemlen;

            h[i] = new Array(newlen);
            for (var j = 0; j < newlen; j++) {
                h[i][j] = new Array();
            }
            var l = specs[i].items.length;
            rowspans[i] = 1;
            for (j = i + 1; j < len; j++) {
                rowspans[i] *= specs[j].items.length;
            }
        }

        html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">默认会员</div><div class="input-group"><input type="text" class="form-control  input-sm discount_default_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'discount_default\');"></a></span></div></div></th>';
        html += '</tr></thead>';

        for (var m = 0; m < len; m++) {
            var k = 0, kid = 0, n = 0;
            for (var j = 0; j < newlen; j++) {
                var rowspan = rowspans[m];

                if (j % rowspan == 0) {
                    h[m][j] = {
                        title: specs[m].items[kid].title,
                        virtual: specs[m].items[kid].virtual,
                        html: "<td class='full' rowspan='" + rowspan + "'>" + specs[m].items[kid].title + "</td>\r\n",
                        id: specs[m].items[kid].id
                    };
                }
                else {
                    h[m][j] = {
                        title: specs[m].items[kid].title,
                        virtual: specs[m].items[kid].virtual,
                        html: "",
                        id: specs[m].items[kid].id
                    };
                }
                n++;
                if (n == rowspan) {
                    kid++;
                    if (kid > specs[m].items.length - 1) {
                        kid = 0;
                    }
                    n = 0;
                }
            }
        }

        var hh = "";
        for (var i = 0; i < newlen; i++) {
            hh += "<tr>";
            var ids = [];
            var titles = [];
            var virtuals = [];
            for (var j = 0; j < len; j++) {
                hh += h[j][i].html;
                ids.push(h[j][i].id);
                titles.push(h[j][i].title);
                virtuals.push(h[j][i].virtual);
            }
            ids = ids.join('_');
            titles = titles.join('+');
            var val = {
                id: "",
                title: titles,
                leveldefault: '',
                costprice: "",
                productprice: "",
                marketprice: "",
                weight: "",
                productsn: "",
                goodssn: "",
                virtual: virtuals
            };

            var val = {
                id: "",
                title: titles,
                leveldefault: '',
                costprice: "",
                productprice: "",
                marketprice: "",
                weight: "",
                productsn: "",
                goodssn: "",
                virtual: virtuals
            };
            if ($(".discount_id_" + ids).length > 0) {
                val = {
                    id: $(".discount_id_" + ids + ":eq(0)").val(),
                    title: titles,
                    leveldefault: $(".discount_default_" + ids + ":eq(0)").val(),
                    costprice: $(".discount_costprice_" + ids + ":eq(0)").val(),
                    productprice: $(".discount_productprice_" + ids + ":eq(0)").val(),
                    marketprice: $(".discount_marketprice_" + ids + ":eq(0)").val(),
                    goodssn: $(".discount_goodssn_" + ids + ":eq(0)").val(),
                    productsn: $(".discount_productsn_" + ids + ":eq(0)").val(),
                    weight: $(".discount_weight_" + ids + ":eq(0)").val(),
                    virtual: virtuals
                }
            }

            hh += '<td>'
            hh += '<input data-name="discount_level_default_' + ids + '"type="text" class="form-control discount_default discount_default_' + ids + '" value="' + (val.leveldefault == 'undefined' ? '' : val.leveldefault ) + '"/>';
            hh += '</td>';
            hh += '<input data-name="discount_id_' + ids + '"type="hidden" class="form-control discount_id discount_id_' + ids + '" value="' + (val.id == 'undefined' ? '' : val.id ) + '"/>';
            hh += '<input data-name="discount_ids"type="hidden" class="form-control discount_ids discount_ids_' + ids + '" value="' + ids + '"/>';
            hh += '<input data-name="discount_title_' + ids + '"type="hidden" class="form-control discount_title discount_title_' + ids + '" value="' + (val.title == 'undefined' ? '' : val.title ) + '"/></td>';
            hh += '<input data-name="discount_virtual_' + ids + '"type="hidden" class="form-control discount_virtual discount_virtual_' + ids + '" value="' + (val.virtual == 'undefined' ? '' : val.virtual ) + '"/></td>';
            hh += "</tr>";
        }
        html += hh;
        html += "</table>";
        $("#discount").html(html);
    }

    function refreshIsDiscount() {
        var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
        var specs = [];

        $(".spec_item").each(function (i) {
            var _this = $(this);

            var spec = {
                id: _this.find(".spec_id").val(),
                title: _this.find(".spec_title").val()
            };

            var items = [];
            _this.find(".spec_item_item").each(function () {
                var __this = $(this);
                var item = {
                    id: __this.find(".spec_item_id").val(),
                    title: __this.find(".spec_item_title").val(),
                    virtual: __this.find(".spec_item_virtual").val(),
                    show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
                }
                items.push(item);
            });
            spec.items = items;
            specs.push(spec);
        });
        specs.sort(function (x, y) {
            if (x.items.length > y.items.length) {
                return 1;
            }
            if (x.items.length < y.items.length) {
                return -1;
            }
        });

        var len = specs.length;
        var newlen = 1;
        var h = new Array(len);
        var rowspans = new Array(len);
        for (var i = 0; i < len; i++) {
            html += "<th>" + specs[i].title + "</th>";
            var itemlen = specs[i].items.length;
            if (itemlen <= 0) {
                itemlen = 1
            }
            ;
            newlen *= itemlen;

            h[i] = new Array(newlen);
            for (var j = 0; j < newlen; j++) {
                h[i][j] = new Array();
            }
            var l = specs[i].items.length;
            rowspans[i] = 1;
            for (j = i + 1; j < len; j++) {
                rowspans[i] *= specs[j].items.length;
            }
        }

        html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">默认会员</div><div class="input-group"><input type="text" class="form-control  input-sm isdiscount_discounts_default_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'isdiscount_discounts_default\');"></a></span></div></div></th>';
        html += '</tr></thead>';

        for (var m = 0; m < len; m++) {
            var k = 0, kid = 0, n = 0;
            for (var j = 0; j < newlen; j++) {
                var rowspan = rowspans[m];

                if (j % rowspan == 0) {
                    h[m][j] = {
                        title: specs[m].items[kid].title,
                        virtual: specs[m].items[kid].virtual,
                        html: "<td class='full' rowspan='" + rowspan + "'>" + specs[m].items[kid].title + "</td>\r\n",
                        id: specs[m].items[kid].id
                    };
                }
                else {
                    h[m][j] = {
                        title: specs[m].items[kid].title,
                        virtual: specs[m].items[kid].virtual,
                        html: "",
                        id: specs[m].items[kid].id
                    };
                }
                n++;
                if (n == rowspan) {
                    kid++;
                    if (kid > specs[m].items.length - 1) {
                        kid = 0;
                    }
                    n = 0;
                }
            }
        }

        var hh = "";
        for (var i = 0; i < newlen; i++) {
            hh += "<tr>";
            var ids = [];
            var titles = [];
            var virtuals = [];
            for (var j = 0; j < len; j++) {
                hh += h[j][i].html;
                ids.push(h[j][i].id);
                titles.push(h[j][i].title);
                virtuals.push(h[j][i].virtual);
            }
            ids = ids.join('_');
            titles = titles.join('+');
            var val = {
                id: "",
                title: titles,
                leveldefault: '',
                costprice: "",
                productprice: "",
                marketprice: "",
                weight: "",
                productsn: "",
                goodssn: "",
                virtual: virtuals
            };

            var val = {
                id: "",
                title: titles,
                leveldefault: '',
                costprice: "",
                productprice: "",
                marketprice: "",
                weight: "",
                productsn: "",
                goodssn: "",
                virtual: virtuals
            };
            if ($(".isdiscount_discounts_id_" + ids).length > 0) {
                val = {
                    id: $(".isdiscount_discounts_id_" + ids + ":eq(0)").val(),
                    title: titles,
                    leveldefault: $(".isdiscount_discounts_default_" + ids + ":eq(0)").val(),
                    costprice: $(".isdiscount_discounts_costprice_" + ids + ":eq(0)").val(),
                    productprice: $(".isdiscount_discounts_productprice_" + ids + ":eq(0)").val(),
                    marketprice: $(".isdiscount_discounts_marketprice_" + ids + ":eq(0)").val(),
                    goodssn: $(".isdiscount_discounts_goodssn_" + ids + ":eq(0)").val(),
                    productsn: $(".isdiscount_discounts_productsn_" + ids + ":eq(0)").val(),
                    weight: $(".isdiscount_discounts_weight_" + ids + ":eq(0)").val(),
                    virtual: virtuals
                }
            }

            hh += '<td>'
            hh += '<input data-name="isdiscount_discounts_level_default_' + ids + '"type="text" class="form-control isdiscount_discounts_default isdiscount_discounts_default_' + ids + '" value="' + (val.leveldefault == 'undefined' ? '' : val.leveldefault ) + '"/>';
            hh += '</td>';
            hh += '<input data-name="isdiscount_discounts_id_' + ids + '"type="hidden" class="form-control isdiscount_discounts_id isdiscount_discounts_id_' + ids + '" value="' + (val.id == 'undefined' ? '' : val.id ) + '"/>';
            hh += '<input data-name="isdiscount_discounts_ids"type="hidden" class="form-control isdiscount_discounts_ids isdiscount_discounts_ids_' + ids + '" value="' + ids + '"/>';
            hh += '<input data-name="isdiscount_discounts_title_' + ids + '"type="hidden" class="form-control isdiscount_discounts_title isdiscount_discounts_title_' + ids + '" value="' + (val.title == 'undefined' ? '' : val.title ) + '"/></td>';
            hh += '<input data-name="isdiscount_discounts_virtual_' + ids + '"type="hidden" class="form-control isdiscount_discounts_virtual isdiscount_discounts_virtual_' + ids + '" value="' + (val.virtual == 'undefined' ? '' : val.virtual ) + '"/></td>';
            hh += "</tr>";
        }
        html += hh;
        html += "</table>";
        $("#isdiscount_discounts").html(html);
    }

    function refreshCommission() {
        var commission_level = [{"key": "default", "levelname": "\u94dc\u5361"}, {
            "id": "11",
            "uniacid": "1",
            "levelname": "\u94f6\u5361",
            "commission1": "10.00",
            "commission2": "5.00",
            "commission3": "5.00",
            "ordermoney": "1000.00",
            "ordercount": "0",
            "downcount": "0",
            "commissionmoney": "0.00",
            "commission3_num": "0",
            "commission2_num": "0",
            "commission1_num": "0",
            "level": "1",
            "memlevel": "23",
            "key": "level11"
        }, {
            "id": "12",
            "uniacid": "1",
            "levelname": "\u91d1\u5361",
            "commission1": "10.00",
            "commission2": "5.00",
            "commission3": "5.00",
            "ordermoney": "3000.00",
            "ordercount": "0",
            "downcount": "0",
            "commissionmoney": "0.00",
            "commission3_num": "0",
            "commission2_num": "0",
            "commission1_num": "0",
            "level": "2",
            "memlevel": "24",
            "key": "level12"
        }];
        var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
        var specs = [];

        $(".spec_item").each(function (i) {
            var _this = $(this);

            var spec = {
                id: _this.find(".spec_id").val(),
                title: _this.find(".spec_title").val()
            };

            var items = [];
            _this.find(".spec_item_item").each(function () {
                var __this = $(this);
                var item = {
                    id: __this.find(".spec_item_id").val(),
                    title: __this.find(".spec_item_title").val(),
                    virtual: __this.find(".spec_item_virtual").val(),
                    show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
                }
                items.push(item);
            });
            spec.items = items;
            specs.push(spec);
        });
        specs.sort(function (x, y) {
            if (x.items.length > y.items.length) {
                return 1;
            }
            if (x.items.length < y.items.length) {
                return -1;
            }
        });

        var len = specs.length;
        var newlen = 1;
        var h = new Array(len);
        var rowspans = new Array(len);
        for (var i = 0; i < len; i++) {
            html += "<th>" + specs[i].title + "</th>";
            var itemlen = specs[i].items.length;
            if (itemlen <= 0) {
                itemlen = 1
            }
            ;
            newlen *= itemlen;

            h[i] = new Array(newlen);
            for (var j = 0; j < newlen; j++) {
                h[i][j] = new Array();
            }
            var l = specs[i].items.length;
            rowspans[i] = 1;
            for (j = i + 1; j < len; j++) {
                rowspans[i] *= specs[j].items.length;
            }
        }

        $.each(commission_level, function (key, level) {
            html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">' + level.levelname + '</div></div></th>';
        })
        html += '</tr></thead>';

        for (var m = 0; m < len; m++) {
            var k = 0, kid = 0, n = 0;
            for (var j = 0; j < newlen; j++) {
                var rowspan = rowspans[m];
                if (j % rowspan == 0) {
                    h[m][j] = {
                        title: specs[m].items[kid].title,
                        virtual: specs[m].items[kid].virtual,
                        html: "<td class='full' rowspan='" + rowspan + "'>" + specs[m].items[kid].title + "</td>\r\n",
                        id: specs[m].items[kid].id
                    };
                }
                else {
                    h[m][j] = {
                        title: specs[m].items[kid].title,
                        virtual: specs[m].items[kid].virtual,
                        html: "",
                        id: specs[m].items[kid].id
                    };
                }
                n++;
                if (n == rowspan) {
                    kid++;
                    if (kid > specs[m].items.length - 1) {
                        kid = 0;
                    }
                    n = 0;
                }
            }
        }
        var hh = "";
        for (var i = 0; i < newlen; i++) {
            hh += "<tr>";
            var ids = [];
            var titles = [];
            var virtuals = [];
            for (var j = 0; j < len; j++) {
                hh += h[j][i].html;
                ids.push(h[j][i].id);
                titles.push(h[j][i].title);
                virtuals.push(h[j][i].virtual);
            }
            ids = ids.join('_');
            titles = titles.join('+');

            var val = {
                id: "",
                title: titles,
                leveldefault: '',
                level11: '',
                level12: '',
                costprice: "",
                productprice: "",
                marketprice: "",
                weight: "",
                productsn: "",
                goodssn: "",
                virtual: virtuals
            };

            var val = {
                id: "",
                title: titles,
                leveldefault: '',
                level11: '',
                level12: '',
                costprice: "",
                productprice: "",
                marketprice: "",
                weight: "",
                productsn: "",
                goodssn: "",
                virtual: virtuals
            };
            var leveldefault = new Array(3);
            $(".commission_default_" + ids).each(function (index, val) {
                leveldefault[index] = val;
            })
            var level11 = new Array(3);
            $(".commission_level11_" + ids).each(function (index, val) {
                level11[index] = val;
            })
            var level12 = new Array(3);
            $(".commission_level12_" + ids).each(function (index, val) {
                level12[index] = val;
            })
            if ($(".commission_id_" + ids).length > 0) {
                val = {
                    id: $(".commission_id_" + ids + ":eq(0)").val(),
                    title: titles,
                    costprice: $(".commission_costprice_" + ids + ":eq(0)").val(),
                    productprice: $(".commission_productprice_" + ids + ":eq(0)").val(),
                    marketprice: $(".commission_marketprice_" + ids + ":eq(0)").val(),
                    goodssn: $(".commission_goodssn_" + ids + ":eq(0)").val(),
                    productsn: $(".commission_productsn_" + ids + ":eq(0)").val(),
                    weight: $(".commission_weight_" + ids + ":eq(0)").val(),
                    virtual: virtuals
                }
            }
            hh += '<td>';
            var level_temp = leveldefault;
            if (len >= i && typeof (level_temp) != 'undefined') {
                if ('default' == 'default') {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_default_' + ids + '"  type="text" class="form-control commission_default commission_default_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_default_' + ids + '"  type="text" class="form-control commission_default commission_default_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
                else {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level__' + ids + '"  type="text" class="form-control commission_level commission_level_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level__' + ids + '"  type="text" class="form-control commission_level commission_level_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
            }
            else {
                if ('default' == 'default') {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_default_' + ids + '"  type="text" class="form-control commission_default commission_default_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_default_' + ids + '"  type="text" class="form-control commission_default commission_default_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
                else {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level__' + ids + '"  type="text" class="form-control commission_level commission_level_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level__' + ids + '"  type="text" class="form-control commission_level commission_level_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
            }
            hh += '</td>';
            hh += '<td>';
            var level_temp = level11;
            if (len >= i && typeof (level_temp) != 'undefined') {
                if ('level11' == 'default') {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_level11_' + ids + '"  type="text" class="form-control commission_level11 commission_level11_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_level11_' + ids + '"  type="text" class="form-control commission_level11 commission_level11_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
                else {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_11_' + ids + '"  type="text" class="form-control commission_level11 commission_level11_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_11_' + ids + '"  type="text" class="form-control commission_level11 commission_level11_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
            }
            else {
                if ('level11' == 'default') {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_level11_' + ids + '"  type="text" class="form-control commission_level11 commission_level11_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_level11_' + ids + '"  type="text" class="form-control commission_level11 commission_level11_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
                else {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_11_' + ids + '"  type="text" class="form-control commission_level11 commission_level11_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_11_' + ids + '"  type="text" class="form-control commission_level11 commission_level11_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
            }
            hh += '</td>';
            hh += '<td>';
            var level_temp = level12;
            if (len >= i && typeof (level_temp) != 'undefined') {
                if ('level12' == 'default') {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_level12_' + ids + '"  type="text" class="form-control commission_level12 commission_level12_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_level12_' + ids + '"  type="text" class="form-control commission_level12 commission_level12_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
                else {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_12_' + ids + '"  type="text" class="form-control commission_level12 commission_level12_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_12_' + ids + '"  type="text" class="form-control commission_level12 commission_level12_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
            }
            else {
                if ('level12' == 'default') {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_level12_' + ids + '"  type="text" class="form-control commission_level12 commission_level12_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_level12_' + ids + '"  type="text" class="form-control commission_level12 commission_level12_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
                else {
                    for (var li = 0; li < 0; li++) {
                        if (typeof (level_temp[li]) != "undefined") {
                            hh += '<input data-name="commission_level_12_' + ids + '"  type="text" class="form-control commission_level12 commission_level12_' + ids + '" value="' + $(level_temp[li]).val() + '" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                        else {
                            hh += '<input data-name="commission_level_12_' + ids + '"  type="text" class="form-control commission_level12 commission_level12_' + ids + '" value="" style="display:inline;width: ' + 96 / parseInt(0) + '%;"/> ';
                        }
                    }
                }
            }
            hh += '</td>';
            hh += '<input data-name="commission_id_' + ids + '"type="hidden" class="form-control commission_id commission_id_' + ids + '" value="' + (val.id == 'undefined' ? '' : val.id ) + '"/>';
            hh += '<input data-name="commission_ids"type="hidden" class="form-control commission_ids commission_ids_' + ids + '" value="' + ids + '"/>';
            hh += '<input data-name="commission_title_' + ids + '"type="hidden" class="form-control commission_title commission_title_' + ids + '" value="' + (val.title == 'undefined' ? '' : val.title ) + '"/></td>';
            hh += '<input data-name="commission_virtual_' + ids + '"type="hidden" class="form-control commission_virtual commission_virtual_' + ids + '" value="' + (val.virtual == 'undefined' ? '' : val.virtual ) + '"/></td>';
            hh += "</tr>";
        }
        html += hh;
        html += "</table>";
        $("#commission").html(html);
    }

    function setCol(cls) {
        $("." + cls).val($("." + cls + "_all").val());
    }
    function showItem(obj) {
        var show = $(obj).get(0).checked ? "1" : "0";
        $(obj).parents('.spec_item_item').find('.spec_item_show:eq(0)').val(show);
    }
    function nofind() {
        var img = event.srcElement;
        img.src = "./resource/image/module-nopic-small.jpg";
        img.onerror = null;
    }

    function choosetemp(id) {
        $('#modal-module-chooestemp').modal();
        $('#modal-module-chooestemp').data("temp", id);
    }
    function addtemp() {
        var id = $('#modal-module-chooestemp').data("temp");
        var temp_id = $('#modal-module-chooestemp').find("select").val();
        var temp_name = $('#modal-module-chooestemp option[value=' + temp_id + ']').text();
        //alert(temp_id+":"+temp_name);
        $("#temp_name_" + id).val(temp_name);
        $("#temp_id_" + id).val(temp_id);
        $('#modal-module-chooestemp .close').click();
        refreshOptions()
    }
</script>