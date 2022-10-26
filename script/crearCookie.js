function aplicar(usuario, modo){
    setCookie(usuario+'-mode', modo, 10);
    location.reload();
}

function setCookie(nombre, valor, expira){
    var d = new Date();
    d.setTime(d.getTime()+expira*24*60*60*1000);
    var expira = "expires="+d.toUTCString();
    document.cookie = nombre+"="+valor+";"+expira;
}

function deleteCookie(nombre){
    setCookie(nombre,"",0);
    location.reload();
}