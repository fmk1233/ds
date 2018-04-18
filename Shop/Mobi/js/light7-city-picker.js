+function ($) {
    "use strict";
    $.fn.cityPicker = function (params) {
        return this.each(function () {
            if (!this)return;
            var format = function (data) {
                var result = {text: [], value: []};
                for (var i = 0; i < data.length; i++) {
                    var d = data[i];
                    if (d.text === "请选择")continue;
                    result.text.push(d.text);
                    result.value.push(d.value)
                }
                if (result.value.length)return result;
                return {text: [""], value: [""]}
            };
            var sub = function (data) {
                if (!data.children)return [""];
                return format(data.children)
            };
            var getCities = function (d) {
                for (var i = 0; i < raw.length; i++) {
                    if (raw[i].value === d.value)return sub(raw[i])
                }
                return {text: [""], value: [""]}
            };
            var getDistricts = function (p, c) {
                for (var i = 0; i < raw.length; i++) {
                    if (raw[i].value === p.value) {

                        for (var j = 0; j < raw[i].children.length; j++) {
                            if (raw[i].children[j].value === c.value) {
                                return sub(raw[i].children[j])
                            }
                        }
                    }
                }
                return {text: [""], value: [""]}
            };
            var raw = cityData3;
            var provinces = format(raw);
            var currentProvince = {text: provinces.text[0], value: provinces.value[0]};
            var initCities = getCities(currentProvince);
            var currentCity = {text: initCities.text[0], value: initCities.value[0]};
            var initDistricts = getDistricts(currentProvince, currentCity);
            var currentDistrict = {text: initDistricts.text[0], value: initDistricts.value[0]};
            var defaults = {
                cssClass: "city-picker",
                rotateEffect: false,
                onChange: function (picker, values, displayValues) {
                    var newProvince = {value: values[0], text: displayValues[0]};
                    var newCity;
                    if (newProvince.value !== currentProvince.value) {
                        var newCities = getCities(newProvince);
                        newCity = {text: newCities.text[0], value: newCities.value[0]};
                        var newDistricts = getDistricts(newProvince, newCity);
                        picker.cols[1].replaceValues(newCities.value, newCities.text);
                        picker.cols[2].replaceValues(newDistricts.value, newDistricts.text);
                        currentProvince = newProvince;
                        currentCity = newCity;
                        picker.updateValue();
                        return
                    }
                    newCity = {value: values[1], text: displayValues[1]};
                    if (newCity.value !== currentCity.value) {
                        var newDistricts = getDistricts(newProvince, newCity);
                        picker.cols[2].replaceValues(newDistricts.value, newDistricts.text);
                        currentCity = newCity;
                        picker.updateValue()
                    }
                },
                cols: [{
                    values: provinces.value,
                    displayValues: provinces.text,
                    cssClass: "col-province"
                }, {
                    values: initCities.value,
                    displayValues: initCities.text,
                    cssClass: "col-city"
                }, {values: initDistricts.value, displayValues: initDistricts.text, cssClass: "col-district"}],
                formatValue: function (p, values, displayvalues) {
                    return displayvalues.join(' ');
                }
            };
            var p = $.extend(defaults, params);
            var val = $(this).data('value');
            if (val) {
                var values = val.split(' ');
                if (values[0] <= 0) {
                    return;
                }
                var newCities={text:[],value:[]}, newDistricts={text:[],value:[]};
                if (values[0]) {
                    for (var i = 0, len = provinces.value.length; i < len; i++) {
                        if (provinces.value[i] == values[0]) {
                            currentProvince = {value: provinces.value[i], text: provinces.text[i]};
                            newCities = getCities(currentProvince);
                            p.cols[1].values = newCities.value;
                            p.cols[1].displayValues = newCities.text;
                            break
                        }
                    }
                }
                if (values[1]) {
                    for (var i = 0, len = newCities.value.length; i < len; i++) {
                        if (newCities.value[i] == values[1]) {
                            currentCity = {value: newCities.value[i], text: newCities.text[i]};
                            newDistricts = getDistricts(currentProvince, currentCity);
                            p.cols[2].values = newDistricts.value;
                            p.cols[2].displayValues = newDistricts.text;
                            for (var i = 0, len = newDistricts.value.length; i < len; i++) {
                                if (newDistricts.value[i] == values[2]) {
                                    currentDistrict = {value: newDistricts.value[i], text: newDistricts.text[i]};
                                    break
                                }
                            }
                            break
                        }
                    }
                } else {
                    currentCity = {text: p.cols[1].displayValues[0], value: p.cols[1].values[0]};
                    newDistricts = getDistricts(currentProvince, currentCity);
                    p.cols[2].values = newDistricts.value;
                    p.cols[2].displayValues = newDistricts.text;
                    for (var i = 0, len = newDistricts.value.length; i < len; i++) {
                        if (newDistricts.value[i] == values[2]) {
                            currentDistrict = {value: newDistricts.value[i], text: newDistricts.text[i]};
                            break
                        }
                    }
                }
                var value = currentProvince.text + ' ' + currentCity.text +  ' ' + currentDistrict.text;
                p.value = [currentProvince.value,currentCity.value,currentDistrict.value];
                $(this).val(value)
            }
            $(this).picker(p)
        })
    }
}($);