PCAArea = [];
PCAP = [];
PCAC = [];
PCAA = [];
function getAddress($province, $city, $area) {
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
}
function getAddressIndex($province, $city, $area) {
    var data = {province: 0, city: 0, area: 0};
    for (var i = 0; i < cityData3.length; i++) {
        var PCAPT = cityData3[i].text;
        var PCAPV = cityData3[i].value;
        if (PCAPV == $province) {
            data.province = i;
            var PI = i;
            for (var i = 0; i < cityData3[PI].children.length; i++) {
                var PCACT = cityData3[PI].children[i].text;
                var PCACV = cityData3[PI].children[i].value;
                if ($city == PCACV) {
                    data.city = i;
                    var CI = i;
                    for (var i = 0; i < cityData3[PI].children[CI].children.length; i++) {
                        var PCAAT = cityData3[PI].children[CI].children[i].text;
                        var PCAAV = cityData3[PI].children[CI].children[i].value;
                        if ($area == PCAAV) {
                            data.area = i;
                        }
                    }
                    break
                }
            }
            break
        }
    }
    return data;
}
function PCAS() {
    this.SelP = document.getElementsByName(arguments[0])[0];
    this.SelC = document.getElementsByName(arguments[1])[0];
    this.SelA = document.getElementsByName(arguments[2])[0];
    this.DefP = this.SelA ? arguments[3] : arguments[2];
    this.DefC = this.SelA ? arguments[4] : arguments[3];
    this.DefA = this.SelA ? arguments[5] : arguments[4];
    this.SelP.PCA = this;
    this.SelC.PCA = this;
    this.SelP.onchange = function () {
        PCAS.SetC(this.PCA)
    };
    if (this.SelA) this.SelC.onchange = function () {
        PCAS.SetA(this.PCA)
    };
    PCAS.SetP(this)
};PCAS.SetP = function (PCA) {
    for (i = 0; i < cityData3.length; i++) {
        PCAPT = cityData3[i].text;
        PCAPV = cityData3[i].value;
        PCA.SelP.options.add(new Option(PCAPT, PCAPV));
        if (PCA.DefP == PCAPV) PCA.SelP[i].selected = true
    }
    PCAS.SetC(PCA)
};
PCAS.SetC = function (PCA) {
    PI = PCA.SelP.selectedIndex;
    PCA.SelC.length = 0;
    for (i = 0; i < cityData3[PI].children.length; i++) {
        PCACT = cityData3[PI].children[i].text;
        PCACV = cityData3[PI].children[i].value;
        PCA.SelC.options.add(new Option(PCACT, PCACV));
        if (PCA.DefC == PCACV) PCA.SelC[i].selected = true
    }
    if (PCA.SelA) PCAS.SetA(PCA)
};
PCAS.SetA = function (PCA) {
    PI = PCA.SelP.selectedIndex;
    CI = PCA.SelC.selectedIndex;
    PCA.SelA.length = 0;
    for (i = 0; i < cityData3[PI].children[CI].children.length; i++) {
        PCAAT = cityData3[PI].children[CI].children[i].text;
        PCAAV = cityData3[PI].children[CI].children[i].value;
        PCA.SelA.options.add(new Option(PCAAT, PCAAV));
        if (PCA.DefA == PCAAV) PCA.SelA[i].selected = true
    }
}