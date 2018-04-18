/*选中输入框*/
function searchOpen() {
    $('#newinput').focus();
    /*$('#newinput').css("background-color","#dd4b39");*/

}
/*点击返回顶部*/
$('.page-current .content').scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('#scrollUp').fadeIn();
    } else {
        $('#scrollUp').fadeOut();
    }
});
function scrollUp() {
    //$('#scrollUp').tooltip('hide');
    $('.page-current .content').animate({
        scrollTop: 0
    }, 200);
}

/*三种模式商品列表切换*/
var sequence = ["icon-electronics", "icon-viewgallery", "icon-viewlist"];
var p_l_product = ["product-list-big", "product-list-medium", "product-list-small"];

function jSequence(obj) {
    var icon_sequence = $(obj).find("i").attr("data");
    var len = sequence.length;
    var key = icon_sequence;
    icon_sequence++;
    if (icon_sequence >= len) {
        icon_sequence = 0;
    }
    /*更换排序列表图标class*/
    $(obj).find(".iconfont").removeClass(sequence[key]).addClass(sequence[icon_sequence]);
    $(obj).find(".iconfont").attr("data", icon_sequence);
    /*更换商品列表class*/
    $(".j-product-list").removeClass(p_l_product[key]).addClass(p_l_product[icon_sequence]);
    $(".j-product-list").attr("data", icon_sequence);
}
/*单选样式*/
/*$(document).on('keydown', function (event) {
    if (event.keyCode == 116) {
        event.keyCode = 0;
        event.cancelBubble = true;
        return false;
    }
}).on('contextmenu',function () {
    return false;
});*/
var hash = location.hash;
if($.inArray(hash, ['#index','#category','#cart','#user'])==-1){
    location.hash = '#index';
}
$(function () {
    layui.use(['index','product_detail','cart','category','login','add_address','address','product','order','order_detail','user','user_info','wallet','account_detail','account_raply','cash_detail','recharge_list','recharge','pwd_edit','message','message_detail','order_number'],function () {
        $.init();
    });
});


