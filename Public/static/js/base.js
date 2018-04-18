function alertMsg(data, $timer) {
    if (data.code == 40002) {
        location.href = '?service=UUsers.second';
        return
    }
    confirmClose();
    var msg = data.msg || data || '';
    $.notify(msg, {
        placement: {from: "top", align: "center"},
        type: 'danger',
        delay: $timer || 2500,
        timer: 250,
        allow_dismiss: false
    })
}
var checkMobile = {
    callback: function (value, validator, $field) {
        if (!(/^1[34578]\d{9}$/.test(value))) {
            return {valid: false, message: '请填写正确的手机号码'}
        }
        return true
    }
};
function confirmMsg($msg, $callback, $option) {
    var temp = $.extend({}, {
        title: '提示信息',
        text: $msg,
        showCancelButton: true,
        closeOnConfirm: false,
        cancelButtonText: "取消",
        confirmButtonText: "确定",
        confirmButtonColor: "#1ab394",
        showLoaderOnConfirm: true,
    }, $option);
    swal(temp, $callback)
}
function confirmClose() {
    if (!(typeof swal == "undefined")) {
        swal.close()
    }
}
function successMsg(d, $callback) {
    var msg = d.msg || d || '';
    var url = d.data ? d.data.url : null;
    confirmClose();
    var fuc = $callback || function () {
            if (url) {
                location.href = url
            } else {
                location.reload()
            }
        };
    if (typeof $callback == 'object' && $callback.callback) {
        $callback.callback(d);
        fuc = null
    }
    $.notify(msg, {
        placement: {from: "top", align: "center"},
        type: 'success',
        delay: 2500,
        timer: 250,
        allow_dismiss: false,
        onClosed: fuc
    })
}
function sendButtonAjax(target, params, $success_callback) {
    var button = target;
    if (button.attr('disabled')) {
        return false
    }
    var l = Ladda.create(button[0]);
    l.start();
    ds.sendAjax({
        data: params, complete: function () {
            l.stop()
        }, success: function (data) {
            if (data.code == 40000) {
                successMsg(data, $success_callback)
            } else {
                alertMsg(data)
            }
        }
    })
}
function showTime($time) {
    return '<span style="white-space: nowrap;"  title="' + $.myTime.UnixToDate($time, true) + '">' + $.myTime.UnixToDate($time) + '</span>'
}
+(function ($) {
    $.fn.serializeObject = function () {
        var self = this, json = {}, push_counters = {}, patterns = {
            "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
            "key": /[a-zA-Z0-9_]+|(?=\[\])/g,
            "push": /^$/,
            "fixed": /^\d+$/,
            "named": /^[a-zA-Z0-9_]+$/
        };
        this.build = function (base, key, value) {
            base[key] = value;
            return base
        };
        this.push_counter = function (key) {
            if (push_counters[key] === undefined) {
                push_counters[key] = 0
            }
            return push_counters[key]++
        };
        $.each($(this).serializeArray(), function () {
            if (!patterns.validate.test(this.name)) {
                return
            }
            var k, keys = this.name.match(patterns.key), merge = this.value, reverse_key = this.name;
            while ((k = keys.pop()) !== undefined) {
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');
                if (k.match(patterns.push)) {
                    merge = self.build([], self.push_counter(reverse_key), merge)
                } else if (k.match(patterns.fixed)) {
                    merge = self.build({}, k, merge)
                } else if (k.match(patterns.named)) {
                    merge = self.build({}, k, merge)
                }
            }
            json = $.extend(true, json, merge)
        });
        return json
    }
})(jQuery);
function sendFormAjax($form, $success_callback, $file) {
    var button = $($form).find(':input[type="submit"]');
    var l = Ladda.create(button[0]);
    l.start();
    var succes = $success_callback || function (data) {
            if (data.code == 40000) {
                successMsg(data)
            } else {
                l.stop();
                alertMsg(data)
            }
        };
    if ($file) {
        var params = $($form).serializeObject();
        var params = ds.url(params, true);
        var data = new FormData();
        $($form).find(':input[type="file"]').each(function () {
            if (this.files[0]) {
                data.append(this.name, this.files[0])
            }
        });
        data.append('params', params.params);
        $.ajax({
            url: baseUrl,
            data: data,
            type: 'post',
            dataType: 'json',
            headers: {Sign: params.sign, Token: params.token},
            contentType: false,
            processData: false,
            complete: function () {
                if (!typeof $success_callback != 'undefined') {
                    l.stop();
                    button.removeClass('disabled')
                }
            },
            success: succes,
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                l.stop();
                alertMsg(textStatus);
            }
        })
    } else {
        var data = $($form).serializeObject();
        ds.sendAjax({
            data: data, complete: function () {
                if (typeof $success_callback != 'undefined') {
                    l.stop();
                    button.removeClass('disabled')
                }
            }, success: succes, error: function (XMLHttpRequest, textStatus, errorThrown) {
                l.stop();
                alertMsg(textStatus)
            }
        })
    }
}
function bindFormAjax(target, $success_callback, $file) {
    target.on('submit', function () {
        var button = $(this).find(':input[type="submit"]');
        if (button.attr('disabled')) {
            return false
        }
        sendFormAjax($(this), $success_callback, $file)
    })
}
function promoteMsg($title, $text, $placehodel, $callback) {
    swal({
        title: $title,
        text: $text,
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: $placehodel,
        showLoaderOnConfirm: true,
        confirmButtonText: "确定",
        cancelButtonText: "取消",
    }, $callback)
};function goodsThumb($imagePath) {
    return baseURL + 'static' + $imagePath
}
function ajaxModel(params) {
    var url = ds.url(params);
    $('body').append('<div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button data-dismiss="modal" class="close" type="button">×</button></div><div class="sk-spinner sk-spinner-wave" style="margin-top: 20px;margin-bottom: 20px;"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div></div></div></div>');
    $('#ajaxModel').modal();
    $('#ajaxModel').find('.modal-content').load(url);
    $('#ajaxModel').on('hidden.bs.modal', function (e) {
        $('#ajaxModel').remove()
    })
}
var js = document.scripts;
js = js[js.length - 1].src;
js = js.substring(0, js.lastIndexOf("/") - 16);
baseUrl = js;

if (typeof admin === "boolean") {
    baseUrl += '/admin.php'
} else if (typeof shop === "boolean") {
    baseUrl += '/shop.php'
} else {
    baseUrl += '/';
}
;ds = {
    sendAjax: function ($param, security) {
        var $params = $.extend(true, {}, $param);
        var $data = $params.data;
        if (!$data) {
            return
        }
        if (security) {
            var $ajax = $.extend({}, {
                type: 'post',
                dataType: 'json',
                url: baseUrl,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alertMsg(textStatus)
                }
            }, $params)
        } else {
            var data = ds.url($data, true);
            $params.data = {params: data.params};
            var $ajax = $.extend({}, {
                type: 'post',
                dataType: 'json',
                url: baseUrl,
                headers: {Sign: data.sign, Token: data.token},
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alertMsg(textStatus)
                }
            }, $params)
        }
        $.ajax($ajax)
    }, url: function ($param, data) {
        var $key = '223ce2bfc7a1a14b28d854fbcff07b66';
        var $params = $.extend(true, {}, $param);
        var $data = $params;
        if (!$data) {
            return
        }
        $params = {params: encode(JSON.stringify($data))};
        var $token = md5($params.params);
        var sdic = Object.keys($data).sort();
        var $baseQuery = '';
        for (var ki in sdic) {
            $baseQuery += $baseQuery ? '&' : '';
            if (typeof $data[sdic[ki]] === 'object') {
                $baseQuery += sdic[ki] + '=' + JSON.stringify($data[sdic[ki]])
            } else {
                $baseQuery += sdic[ki] + '=' + $data[sdic[ki]]
            }
        }
        var $sign = md5(md5($baseQuery) + $key);
        if (data) {
            return {params: $params.params, token: $token, sign: $sign}
        }
        return '?params=' + encodeURIComponent($params.params) + '&token=' + $token + '&sign=' + $sign
    }
};
$(function () {
    $().counterUp && $("[data-counter='counterup']").counterUp({delay: 10, time: 1e3});
    $('body').on('click', 'a[data-toggle="url"]', function (e) {
        e.preventDefault();
        var data = $(this).data();
        delete data.toggle;
        var url = ds.url(data);
        var target = this.target;
        if (target == '_blank') {
            window.open(baseUrl + url)
        } else {
            location.href = baseUrl + url
        }
        return false
    })
});
function uploadImage(file, callback, uploadPath) {
    var data = new FormData();
    var params = {service: 'Public.UploadImage'};
    if (uploadPath) {
        params.path = uploadPath
    }
    params = ds.url(params, true);
    for (var key in params) {
        data.append(key, params[key])
    }
    data.append('file', file);
    $.ajax({
        url: baseUrl,
        data: data,
        type: 'post',
        dataType: 'json',
        headers: {Sign: params.sign, Token: params.token},
        contentType: false,
        processData: false,
        complete: function () {
        },
        success: function (d) {
            if (d.code == 40000) {
                callback(d.data)
            } else {
                alertMsg(d)
            }
        }
    })
};+(function ($) {
    $.fn.tableInit = function (option, querystr) {
        var oTableInit = new Object();
        oTableInit.queryParams = function (params) {
            ;
            var temp = $.extend({}, {
                limit: params.limit,
                offset: params.offset,
                sort: params.sort,
                order: params.order,
            }, querystr ? eval('(' + querystr + ')') : {});
            return temp
        };
        var $this = $(this), options = $.extend({}, {
            url: baseUrl,
            method: 'post',
            contentType: "application/x-www-form-urlencoded",
            toolbar: '#toolbar',
            striped: false,
            cache: true,
            pagination: true,
            sortable: true,
            sortName: "id",
            sortOrder: "desc",
            queryParams: oTableInit.queryParams,
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 500],
            search: false,
            strictSearch: false,
            showColumns: true,
            showExport: true,
            showRefresh: false,
            minimumCountColumns: 2,
            clickToSelect: true,
            uniqueId: "id",
            showToggle: false,
            cardView: false,
            detailView: false,
            columns: [],
        }, option);
        oTableInit.table = $this;
        oTableInit.Init = function () {
            $this.bootstrapTable(options)
        };
        oTableInit.load = function (params) {
            var query = $.extend({}, {offset: 0}, params ? params : {});
            $this.bootstrapTable('refresh', {query: query})
        };
        var parseParam = function (param, key) {
            var paramStr = "";
            if (param instanceof String || param instanceof Number || param instanceof Boolean) {
                paramStr += "&" + key + "=" + encodeURIComponent(param)
            } else {
                $.each(param, function (i) {
                    var k = key == null ? i : key + (param instanceof Array ? "[" + i + "]" : "." + i);
                    paramStr += '&' + parseParam(this, k)
                })
            }
            return paramStr.substr(1)
        };
        oTableInit.export = function ($table, $params) {
            var fields = $this.bootstrapTable('getVisibleColumns');
            var columns = [];
            for (var $i = 0, len = fields.length; $i < len; $i++) {
                var column = {};
                column['title'] = fields[$i]['title'];
                column['field'] = fields[$i]['field'];
                columns.push(column)
            }
            columns = columns.concat($params);
            var query = $.extend({}, oTableInit.queryParams({
                limit: 0,
                offset: 0,
                sort: 'id',
                order: 'desc'
            }), {service: 'Export.' + $table, columns: JSON.stringify(columns)});
            delete query.limit;
            delete query.offset;
            delete query.sort;
            delete query.order;
            var b = parseParam(query);
            window.open(baseUrl + '?' + parseParam(query))
        };
        return oTableInit;
    }
})(jQuery);
(function ($) {
    $.extend({
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
                if (isFull == undefined) {
                    isFull = true
                }
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
        }
    })
})(jQuery);
$("#checkZoom").on('click', function () {
    if ($("#explanationZoom").css('display') == 'none') {
        $("#explanation").animate({
            color: "#2CBCA3",
            backgroundColor: "#EDFBF8",
            width: "99%",
            height: "40",
        }, 300, function () {
            $(this).css('height', '100%')
        });
        $("#explanationZoom").show()
    } else {
        $("#explanation").animate({color: "#FFF", backgroundColor: "#4FD6BE", width: "100", height: "40",}, 300);
        $("#explanationZoom").hide()
    }
});