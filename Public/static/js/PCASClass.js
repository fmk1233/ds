/* PCAS (Province City Area Selector 省、市、地区联动选择JS封装类) Ver 2.01 完整版 *\

 　制作时间:2005-12-30
 　更新时间:2006-01-24
 　数据修正:2006-08-17
 　文档大小:18KB
 　演示地址:http://www.popub.net/script/pcasunzip.html
 　下载地址:http://www.popub.net/script/pcasunzip.js
 　应用说明:页面包含<script type="text/javascript" src="pcasunzip.js"></script>
 省市联动
 new PCAS("Province","City")
 new PCAS("Province","City","吉林省")
 new PCAS("Province","City","吉林省","吉林市")
 省市地区联动
 new PCAS("Province","City","Area")
 new PCAS("Province","City","Area","吉林省")
 new PCAS("Province","City","Area","吉林省","松原市")
 new PCAS("Province","City","Area","吉林省","松原市","宁江区")
 省、市、地区对象取得的值均为实际值。
 注：省、市、地区提示信息选项的值为""(空字符串)

 　感谢
 　　　网友418528#gmail.com对数据进行的核实工作 2006-08-07

 \*** 程序制作/版权所有:崔永祥(333) E-Mail:zhadan007@21cn.com 网址:http://www.popub.net ***/


SPT = "--请选择省份--";
SCT = "--请选择城市--";
SAT = "--请选择地区--";
ShowT = 1;		//提示文字 0:不显示 1:显示
PCAD = area_data;
if (ShowT) PCAD = SPT + "$" + SCT + "," + SAT + "#" + PCAD;
PCAArea = [];
PCAP = [];
PCAC = [];
PCAA = [];
PCAN = PCAD.split("#");
for (i = 0; i < PCAN.length; i++) {
    PCAA[i] = [];
    TArea = PCAN[i].split("$")[1].split("|");
    for (j = 0; j < TArea.length; j++) {
        PCAA[i][j] = TArea[j].split(",");
        if (PCAA[i][j].length == 1) PCAA[i][j][1] = SAT;
        TArea[j] = TArea[j].split(",")[0]
    }
    PCAArea[i] = PCAN[i].split("$")[0] + "," + TArea.join(",");
    PCAP[i] = PCAArea[i].split(",")[0];
    PCAC[i] = PCAArea[i].split(',')
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
    for (i = 0; i < PCAP.length; i++) {
        PCAPT = PCAPV = PCAP[i];
        if (PCAPT == SPT) PCAPV = "";
        PCA.SelP.options.add(new Option(PCAPT, PCAPV));
        if (PCA.DefP == PCAPV) PCA.SelP[i].selected = true
    }
    PCAS.SetC(PCA)
};
PCAS.SetC = function (PCA) {
    PI = PCA.SelP.selectedIndex;
    PCA.SelC.length = 0;
    for (i = 1; i < PCAC[PI].length; i++) {
        PCACT = PCACV = PCAC[PI][i];
        if (PCACT == SCT) PCACV = "";
        PCA.SelC.options.add(new Option(PCACT, PCACV));
        if (PCA.DefC == PCACV) PCA.SelC[i - 1].selected = true
    }
    if (PCA.SelA) PCAS.SetA(PCA)
};
PCAS.SetA = function (PCA) {
    PI = PCA.SelP.selectedIndex;
    CI = PCA.SelC.selectedIndex;
    PCA.SelA.length = 0;
    for (i = 1; i < PCAA[PI][CI].length; i++) {
        PCAAT = PCAAV = PCAA[PI][CI][i];
        if (PCAAT == SAT) PCAAV = "";
        PCA.SelA.options.add(new Option(PCAAT, PCAAV));
        if (PCA.DefA == PCAAV) PCA.SelA[i - 1].selected = true
    }
}
//-->