<?php $this->view('common/header'); ?>
<!--顶部样式-->
<?php $this->view('common/top'); ?>
<!--用户中心收货地址-->
<div class="user_style clearfix">
    <div class="user_center">
        <!--左侧菜单栏-->
        <div class="left_style">
            <?php $this->view('user/user_left') ?>
        </div>
        <!--右侧样式-->
        <div class="right_style">
            <div class="info_content">
                <!--地址管理样式-->
                <div class="adderss_style">
                    <div class="title_Section"><span>收货地址管理</span></div>
                    <div class="adderss_list">
                        <!--地址列表-->

                        <div class="Address_List clearfix">
                            <?php foreach ($address_list as $address_item): ?>
                                <ul class="Address_info" data-id="<?php echo $address_item['id']; ?>">
                                    <!--地址类表-->
                                    <div class="address_title">
                                        <a href="javascript:void(-1)"
                                           data-info="<?php echo Common_Function::encode(json_encode($address_item)); ?>"
                                           class="modify iconfont icon-fankui btn btn-primary"></a>地址信息
                                        <a href="javascript:void(-1)"
                                           data-addressid="<?php echo $address_item['id']; ?>"
                                           data-service="User.DelAddress" class="delete"><i
                                                    class="iconfont icon-close2"></i></a>
                                    </div>
                                    <li><?php echo $address_item['realname']; ?></li>
                                    <li><?php $add = Common_Function::getAddress($address_item['province'], $address_item['city'], $address_item['area']);
                                        echo implode(' ', $add) . ' ', $address_item['address']; ?></li>
                                    <li><?php echo $address_item['mobile']; ?>
                                        <?php if ($address_item['is_default'] == 1): ?>
                                            <a style="float: right;color: red;" href="javascript:void(-1)">默认</a>
                                        <?php elseif ($from == 0): ?>
                                            <a style="float: right" data-service="User.SetDefault"
                                               data-addressid="<?php echo $address_item['id']; ?>"
                                               href="javascript:void(-1)" default>设为默认</a>
                                        <?php endif; ?>

                                    </li>

                                </ul>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <form onsubmit="return false" class="layui-form">
                        <input type="hidden" value="User.AddressEdit" name="service"/>
                        <input type="hidden" value="0" name="addressid"/>
                        <div class="Add_Addresss">
                            <div class="title_name"><i></i>添加地址</div>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="label_name">收货区域</td>
                                    <td colspan="3" class="select">
                                        <label> 省份 </label><select class="kitjs-form-suggestselect" lay-ignore
                                                                   name="province"></select>
                                        <label> 市/县 </label><select class="kitjs-form-suggestselect" lay-ignore
                                                                    name="city"></select>
                                        <label> 区/县 </label><select class="kitjs-form-suggestselect" lay-ignore
                                                                    name="area"></select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label_name">详细地址</td>
                                    <td><input name="address" required lay-verify="required" type="text"
                                               class="Add-text"><i>（必填）</i></td>
                                    <td class="label_name">收件人姓名</td>
                                    <td><input name="realname" required lay-verify="required" type="text"
                                               class="Add-text"><i>（必填）</i></td>
                                </tr>
                                <tr>
                                    <td class="label_name">手&nbsp;&nbsp;机</td>
                                    <td><input name="phone" required lay-verify="required|phone" type="text"
                                               class="Add-text"><i>（必填）</i></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="address_Note"><span>注：</span>只能添加5个收货地址信息。请乎用假名填写地址，如造成损失由收货人自己承担。</div>
                            <div class="btn"><input lay-submit lay-filter="demo" type="submit" value="添加地址"
                                                    class="Add_btn"></div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form onsubmit="return false" class="layui-form address_edit adderss_style" style="display: none">
    <input type="hidden" value="User.AddressEdit" name="service"/>
    <input type="hidden" value="0" name="addressid"/>
    <div class="Add_Addresss">
        <div class="title_name"><i></i>编辑地址</div>

        <table style="width: 760px">
            <tbody>
            <tr>
                <td class="label_name">收货区域</td>
                <td colspan="3" class="select">
                    <label> 省份 </label><select class="kitjs-form-suggestselect" lay-ignore
                                               name="province1"></select>
                    <label> 市/县 </label><select class="kitjs-form-suggestselect" lay-ignore
                                                name="city1"></select>
                    <label> 区/县 </label><select class="kitjs-form-suggestselect" lay-ignore
                                                name="area1"></select>
                </td>
            </tr>
            <tr>
                <td class="label_name">详细地址</td>
                <td><input name="address" required lay-verify="required" type="text"
                           class="Add-text" style="width: 158px"><i>（必填）</i></td>
                <td class="label_name">收件人姓名</td>
                <td><input name="realname" style="width: 158px" required lay-verify="required" type="text"
                           class="Add-text"><i>（必填）</i></td>
            </tr>
            <tr>
                <td class="label_name">手&nbsp;&nbsp;机</td>
                <td><input name="phone" required lay-verify="required|phone" style="width: 158px" type="text"
                           class="Add-text"><i>（必填）</i></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <div class="btn"><input lay-submit lay-filter="editor" type="submit" value="编辑地址"
                                class="Add_btn"></div>

    </div>
</form>
<?php $this->view('common/footer'); ?>
<script src="<?php echo Common_Function::GoodsPath('/js/city.js'); ?>"></script>
<script src="<?php echo Common_Function::GoodsPath('/js/area.js'); ?>"></script>
<script type="text/javascript">
    $(function () {
        layui.use('form', function () {
            var form = layui.form();
            var from = <?php echo $from; ?>;
            form.on('submit(demo)', function (data) {
                sendButtonAjax($(data.elem), data.field, {
                    callback: function () {
                        if (from == 1) {
                            history.back();
                        } else {
                            location.reload();
                        }
                    }
                });
                return false;
            });
            new PCAS('province', 'city', 'area');

            if (from == 1) {
                $('.Address_info').on('click', function () {
                    var data = $(this).data();
                    layui.data('address', {key: 'id', value: data.id});
                    history.back();
                });
            }
            $('.Address_List .delete').on('click', function (e) {
                e.stopPropagation();
                var $this = $(this);
                var data = $this.data();
                layer.confirm('您确认要删除该收货地址，删除后无法还原！', function (index) {
                    sendButtonAjax($this, data);
                    layer.close(index);
                });
            });
            $('.Address_info a[default]').on('click', function (e) {
                e.stopPropagation();
                var data = $(this).data();
                sendButtonAjax($(this), data);
            });
            $('.Address_List .modify').on('click', function (e) {
                e.stopPropagation();
                var $this = $(this);
                var data = JSON.parse(decode($this.data('info')));
                layer.open({
                    type: 1,
                    shade: 0.3,
                    area: ['780px', '245px'],
                    title: false, //不显示标题
                    content: $('.address_edit'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                    success: function (layero, index) {
                        $(layero).find('input[name="addressid"]').val(data.id);
                        $(layero).find('input[name="phone"]').val(data.mobile);
                        $(layero).find('input[name="realname"]').val(data.realname);
                        $(layero).find('input[name="address"]').val(data.address);
                        new PCAS('province1', 'city1', 'area1', data.province, data.city, data.area);
                        form.on('submit(editor)', function (data) {
                            data.field.province = data.field.province1;
                            data.field.city = data.field.city1;
                            data.field.area = data.field.area1;
                            sendButtonAjax($(data.elem), data.field, {
                                callback: function () {
                                    if (from == 1) {
                                        layui.data('address', {key: 'id', value: data.id});
                                        history.back();
                                    } else {
                                        location.reload();
                                    }
                                }
                            });
                            return false;
                        });

                    }
                });
            });
        });

    });
</script>