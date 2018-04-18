function showXingqi(time){
    var thisDate = new Date(time*1000);
    var xingqi =  "日一二三四五六".charAt(thisDate.getDay());
    $("#xingqi").html("星期"+xingqi);
    var now = thisDate;
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var shijian = '';
    if(hours >= 12&&hours < 18){
        shijian = '下午';
    }else if(hours >= 6&&hours < 12){
        shijian = '上午';
    }else{
        shijian = '晚上';
    }
    var timeValue = "" +shijian;
    timeValue += ((hours >12) ? hours -12 :hours);
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
    <!--timeValue += ((seconds < 10) ? ":0" : ":") + seconds;-->
    $("#shijian").html(timeValue);
}
function printdiv(printpage)
{
    var headstr = "<html><head><title></title></head><body>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
}