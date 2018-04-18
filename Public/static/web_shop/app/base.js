var js = document.scripts;
var js = js[js.length - 1].src.substring(0, js[js.length - 1].src.lastIndexOf("/") - 26);
var baseUrl = js + 'shop.php';
;ds = {
    sendAjax: function ($param, security) {
        var $params = $.extend(true, {}, $param);
        var services = {};
        var $data = $params.data;
        if (!$data) {
            return
        }
        var key = md5($data.service);
        if (services[key]) {
            return;
        }
        services[key] = true;
        if (security) {
            var $ajax = $.extend({}, {
                type: 'post', dataType: 'json', url: baseUrl, complete: function () {
                    delete services[key];
                }
            }, $params);
        } else {
            var data = ds.url($data, true);
            $params.data = {params: data.params};
            var $ajax = $.extend({}, {
                type: 'post',
                dataType: 'json',
                url: baseUrl, complete: function () {
                    delete services[key];
                },
                headers: {Sign: data.sign, Token: data.token}
            }, $params);

        }

        $.ajax($ajax);
    },
    url: function ($param, data) {

        var $key = '223ce2bfc7a1a14b28d854fbcff07b66';
        var $params = $.extend(true, {}, $param);
        var $data = $params;
        if (!$data) {
            return;
        }
        $params = {params: encode(JSON.stringify($data))};
        var $token = md5($params.params);
        var sdic = Object.keys($data).sort();
        var $baseQuery = '';
        for (var ki in sdic) {
            $baseQuery += $baseQuery ? '&' : '';
            if (typeof  $data[sdic[ki]] === 'object') {
                $baseQuery += sdic[ki] + '=' + JSON.stringify($data[sdic[ki]]);
            } else {
                $baseQuery += sdic[ki] + '=' + $data[sdic[ki]]
            }
        }
        var $sign = md5(md5($baseQuery) + $key);
        if (data) {
            return {params: $params.params, token: $token, sign: $sign}
        }
        return '?params=' + encodeURIComponent($params.params) + '&token=' + $token + '&sign=' + $sign;
    }
}
function sendButtonAjax(target, params, $success_callback) {
    var button = $(target);
    if (button.attr('disabled')) {
        return false
    }
    var l = Ladda.create(button[0]);
    l.start();
    ds.sendAjax({
        data: params, success: function (data) {
            l.stop();
            if (data.code == 40000) {
                successMsg(data, $success_callback)
            } else {
                alertMsg(data)
            }
        }, error: function () {
            l.stop();
        }
    });
}
layui.use('layer', function () {
    var layer = layui.layer;
    alertMsg = function (data, $timer) {
        if (data.code == 40003) {
            login_box();
            return false;
        }
        var msg = data.msg || data || '';
        layer.msg(msg, {time: $timer || 2000});
    }
    successMsg = function (d, $callback) {
        var msg = d.msg || d || '';
        var url = d.data ? d.data.url : null;
        var fuc = $callback || function () {
                if (url) {
                    location.href = url
                } else {
                    location.reload()
                }
            };
        if (typeof $callback == 'object' && $callback.callback) {
            $callback.callback(d);
            fuc = null;
            if (typeof  msg == 'object' || msg == '') {
                return;
            }
        }
        layer.msg(msg, {time: 2000}, fuc);
    }
});
$(function () {
    $('body').on('click', 'a[data-toggle="url"]', function (e) {
        e.preventDefault();
        var data = $(this).data();
        delete data.toggle;
        var url = ds.url(data);
        var target = this.target;
        if (target == '_blank') {
            window.open(baseUrl + url);
        } else {
            location.href = baseUrl + url;
        }

        return false;
    });
});




