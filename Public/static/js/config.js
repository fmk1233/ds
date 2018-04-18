var js=document.scripts;
js=js[js.length-1].src.substring(0,js[js.length-1].src.lastIndexOf("/")-9);
var baseUrl = js;