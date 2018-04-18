/**
 * Created by denn on 2017/4/12.
 */
layui.define('form', function (exports) {
    var form = layui.form();
    form.verify({
        username: function (value) {
            if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                return '用户名不能有特殊字符';
            }
            if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                return '用户名首尾不能出现下划线\'_\'';
            }
            if (/^\d+\d+\d$/.test(value)) {
                return '用户名不能全为数字';
            }
        }
        //我们既支持上述函数式的方式，也支持下述数组的形式
        //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
        , pass: [
            /^[\S]{6,12}$/
            , '密码必须6到12位，且不能出现空格'
        ]
    });
    var verify = {
        checkUser: function ($this) {
            var ERROR = 'has-error';
            $this.parents('.form-group').removeClass(ERROR);
            var value = $this.val();
            $this.next().html('');
            if (value == '' && $this.attr('lay-verify').indexOf('required') > -1) {
                layui.layer.tips('必填项不能为空', $this[0], {tips: 3});
                $this.parents('.form-group').addClass(ERROR);
                return;
            }
            ds.sendAjax({
                data: {service: 'Public.CheckUserField', field: 'username', value: value},
                success: function (d) {
                    if (d.code == 40000) {
                        $this.next().html(d.data.true_name);
                    } else {
                        layui.layer.tips('用户不存在', $this[0], {tips: 3});
                        $this.parents('.form-group').addClass(ERROR);
                    }
                }
            });
        },
        checkBdCenter:function ($this) {
            var ERROR = 'has-error';
            $this.parents('.form-group').removeClass(ERROR);
            var value = $this.val();
            $this.next().html('');
            if (value == '' && $this.attr('lay-verify').indexOf('required') > -1) {
                layui.layer.tips('必填项不能为空', $this[0], {tips: 3});
                $this.parents('.form-group').addClass(ERROR);
                return;
            }
            ds.sendAjax({
                data: {service: 'Public.checkBdCenter', zmd_name:  value},
                success: function (d) {
                    if (d.code == 40000) {
                        $this.next().html(d.data.true_name);
                    } else {
                        layui.layer.tips('报单中心填写错误', $this[0], {tips: 3});
                        $this.parents('.form-group').addClass(ERROR);
                    }
                }
            });
        }
    }

    exports('validation', {checkUser: verify.checkUser,checkBdCenter:verify.checkBdCenter});
});