/**
 * Created by denn on 2017/3/9.
 */

layui.define(function (exports) { //提示：组件也可以依赖其它组件，如：layui.define('layer', callback);
    var services = {};

    function str_repeat(i, m) {
        for (var o = []; m > 0; o[--m] = i);
        return o.join('');
    }
    function sprintf() {
        var i = 0, a, f = arguments[i++], o = [], m, p, c, x, s = '';
        while (f) {
            if (m = /^[^\x25]+/.exec(f)) {
                o.push(m[0]);
            }
            else if (m = /^\x25{2}/.exec(f)) {
                o.push('%');
            }
            else if (m = /^\x25(?:(\d+)\$)?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-fosuxX])/.exec(f)) {
                if (((a = arguments[m[1] || i++]) == null) || (a == undefined)) {
                    throw('Too few arguments.');
                }
                if (/[^s]/.test(m[7]) && (typeof(a) != 'number')) {
                    throw('Expecting number but found ' + typeof(a));
                }
                switch (m[7]) {
                    case 'b': a = a.toString(2); break;
                    case 'c': a = String.fromCharCode(a); break;
                    case 'd': a = parseInt(a); break;
                    case 'e': a = m[6] ? a.toExponential(m[6]) : a.toExponential(); break;
                    case 'f': a = m[6] ? parseFloat(a).toFixed(m[6]) : parseFloat(a); break;
                    case 'o': a = a.toString(8); break;
                    case 's': a = ((a = String(a)) && m[6] ? a.substring(0, m[6]) : a); break;
                    case 'u': a = Math.abs(a); break;
                    case 'x': a = a.toString(16); break;
                    case 'X': a = a.toString(16).toUpperCase(); break;
                }
                a = (/[def]/.test(m[7]) && m[2] && a >= 0 ? '+'+ a : a);
                c = m[3] ? m[3] == '0' ? '0' : m[3].charAt(1) : ' ';
                x = m[5] - String(a).length - s.length;
                p = m[5] ? str_repeat(c, x) : '';
                o.push(s + (m[4] ? a + p : p + a));
            }
            else {
                throw('Huh ?!');
            }
            f = f.substring(m[0].length);
        }
        return o.join('');
    }

    var ds = {
        sendAjax: function ($param, security) {
            var $params = $.extend(true, {}, $param);
            var $data = $params.data;
            if (!$data) {
                return
            }
            var key = md5($data.service);
            if (services[key]) {
                return;
            }
            services[key] = true;
            // $('body').append('<div class="mui-backdrop" style="background: none;text-align: center;" id="'+key+'" ><div class="mui-pull-loading mui-icon mui-spinner mui-visibility" style="height: 100%;"></div></div>');
            $.showIndicator();
            var data = layui.data('2957297735fbf429');
            var $user_token = data.token;
            if (security) {
                var $ajax = $.extend({}, {type: 'post', dataType: 'json', url: baseUrl}, $params);
            } else {
                var data = ds.url($data, true);
                $params.data = {params: data.params};
                var $ajax = $.extend({}, {
                    type: 'post',
                    dataType: 'json',
                    url: baseUrl + '../mobile.php',
                    complete: function () {
                        delete services[key];
                        $.hideIndicator();
                    },
                    headers: {Sign: data.sign, Token: data.token, Usertoken: $user_token, Mobile: 'shop_mobile'}
                }, $params);

            }

            $.ajax($ajax);
        },
        logout: function () {
            layui.data('2957297735fbf429', null);
            layui.data('cart', {key: 'cart_num', value: '0'});
            $.router.stack.back = JSON.stringify([JSON.parse($.router.stack.back)[0]]);
            $.router.loadPage('#login');
        },
        url: function ($param, data) {

            var $key = '223ce2bfc7a1a14b28d854fbcff07b66';
            var $params = $.extend(true, {}, $param);
            var $data = $params;
            if (!$data) {
                return;
            }
            $data.wap = 1;
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
        },
        successMsg: function (d, $callback) {
            var $msg = d.msg || d || '';
            $.toast($msg);
            setTimeout(function () {
                $callback ? $callback(d.data) : '';
            }, 1500)
        },
        errorMsg: function (d) {
            if (d.code == 40003) {//没有登录跳转到登录页
                //清空缓存key值
                ds.logout();
            }
            var $msg = d.msg || d || '';
            $.toast($msg);
        },
        sendFormAjax: function ($form, $callback, $file) {
            var succes = '';
            if ($file) {
                var $data = $($form).serializeObject();
                var key = md5($data.service);
                if (services[key]) {
                    return;
                }
                services[key] = true;
                var params = ds.url($data, true);
                var data = new FormData();
                $($form).find(':input[type="file"]').each(function () {
                    if (this.files[0]) {
                        data.append(this.name, this.files[0]);
                    }
                });
                data.append('params', params.params);
                var user_data = layui.data('2957297735fbf429');
                var $user_token = user_data.token;
                $.ajax({
                    url: baseUrl,
                    data: data,
                    type: 'post',
                    dataType: 'json',
                    headers: {Sign: params.sign, Token: params.token, Usertoken: $user_token, Mobile: 'shop_mobile'},
                    complete: function () {
                        delete  services[key];
                    },
                    contentType: false, processData: false, success: succes
                });
            } else {
                var data = $($form).serializeObject();
                ds.sendAjax({
                    data: data, success: function (d) {
                        if (d.code == 40000) {
                            ds.successMsg(d, $callback);
                        } else {
                            ds.errorMsg(d);
                        }
                    }
                });
            }
        },
        bindFormAjax: function ($form, $callback, $file) {
            $form.on('submit', function () {
                ds.sendFormAjax($form, $callback, $file);
            });
        },
        confirm: function (title, $callback) {
            $.confirm(title, function () {
                $callback ? $callback() : '';
            });
        },
        myTime: {
            CurTime: function () {
                return Date.parse(new Date()) / 1000
            }, DateToUnix: function (string) {
                var f = string.split(' ', 2);
                var d = (f[0] ? f[0] : '').split('-', 3);
                var t = (f[1] ? f[1] : '').split(':', 3);
                return (new Date(parseInt(d[0], 10) || null, (parseInt(d[1], 10) || 1) - 1, parseInt(d[2], 10) || null, parseInt(t[0], 10) || null, parseInt(t[1], 10) || null, parseInt(t[2], 10) || null)).getTime() / 1000
            }, UnixToString: function (unixTime) {
                var curtime = parseInt(this.CurTime());
                var interval = curtime - unixTime;
                if (interval < 60) {
                    return '刚刚'
                } else if (interval < 3600) {
                    return parseInt(interval / 60) + '分钟前'
                } else if (interval < 3600 * 24) {
                    return parseInt(interval / 3600) + '小时前'
                } else if (interval < 3600 * 24 * 7) {
                    return parseInt(interval / (3600 * 24)) + '天前'
                } else {
                    return '7天前'
                }
            }, UnixToDate: function (unixTime, isFull) {
                unixTime = parseFloat(unixTime);
                if (unixTime <= 1000000) {
                    return '-'
                }
                var time = new Date(unixTime * 1000);
                var ymdhis = "";
                ymdhis += time.getFullYear() + "-";
                ymdhis += (time.getMonth() + 1) + "-";
                ymdhis += time.getDate();
                if (isFull === true) {
                    var hour = time.getHours();
                    var minutes = time.getMinutes();
                    var seconds = time.getSeconds();
                    ymdhis += " " + (hour < 10 ? '0' + hour : hour) + ":";
                    ymdhis += (minutes < 10 ? '0' + minutes : minutes) + ":";
                    ymdhis += (seconds < 10 ? '0' + seconds : seconds)
                }
                return ymdhis
            }, Countdown: function (unixTime) {
                var curtime = parseInt(Date.parse(new Date()) / 1000);
                if (unixTime < curtime) {
                    return '00:00:00'
                }
                var inerval = parseInt(unixTime - curtime);
                var hour = parseInt(inerval / 3600);
                var minutes = parseInt((inerval - hour * 3600) / 60);
                var seconds = parseInt(inerval - hour * 3600 - minutes * 60);
                hour = hour >= 10 ? hour : '0' + hour;
                minutes = minutes >= 10 ? minutes : '0' + minutes;
                seconds = seconds >= 10 ? seconds : '0' + seconds;
                return hour + ':' + minutes + ':' + seconds
            }
        },
        goodsThumb: function (path) {
            return baseUrl + 'static' + path;
        },
        getAddress: function ($province, $city, $area) {
            var data = {province: '', city: '', area: ''};
            for (var i = 0; i < cityData3.length; i++) {
                var PCAPT = cityData3[i].text;
                var PCAPV = cityData3[i].value;
                if (PCAPV == $province) {
                    data.province = PCAPT;
                    var PI = i;
                    for (var i = 0; i < cityData3[PI].children.length; i++) {
                        var PCACT = cityData3[PI].children[i].text;
                        var PCACV = cityData3[PI].children[i].value;
                        if ($city == PCACV) {
                            data.city = PCACT;
                            var CI = i;
                            for (var i = 0; i < cityData3[PI].children[CI].children.length; i++) {
                                var PCAAT = cityData3[PI].children[CI].children[i].text;
                                var PCAAV = cityData3[PI].children[CI].children[i].value;
                                if ($area == PCAAV) {
                                    data.area = PCAAT
                                }
                            }
                            break
                        }
                    }
                    break
                }
            }
            return data;
        },
        cart_num: function () {
            var cart = layui.data('cart');
            return parseInt(cart.cart_num);
        },
        sprintf:sprintf,
        searchKey:function (keyword) {
            var keywords = layui.data('keywords');
            keywords.key = keywords.key?JSON.parse(keywords.key):[];
            if(keywords.key.length>=10){
                keywords.key.shift();
            }
            if($.inArray(keyword,keywords.key)==-1){
                keywords.key.push(keyword);
            }
            layui.data('keywords', {key: 'key', value: JSON.stringify(keywords.key)});
            return keywords.key;
        }
    }

    //输出booth_news接口
    exports('base', ds);
});