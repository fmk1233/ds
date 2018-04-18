/**
 * Created by denn on 2017/4/12.
 */
$(function () {
    new PCAS('province', 'city', 'area');
    layui.use('validation', function () {
        var form = layui.form();
        var validation = layui.validation;
        $('#p_user_name,#r_user_name').on('blur', function () {
            var $this = $(this);
            validation.checkUser($this);
        });
        $('input[name="zmd_name"]').on('blur',function () {
            var $this = $(this);
            validation.checkBdCenter($this);
        });
        //监听提交
        form.on('submit(formDemo)', function (data) {
            if(typeof isUser != 'undefined' && typeof data.field.agree == 'undefined'){
                layer.msg('请同意此协议');
                return false;
            }
            if($(data.form).find('.has-error').length>0){
                return false;
            }
            sendButtonAjax($(data.elem), data.field);
            return false;
        });
    });

});
