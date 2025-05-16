
let contadorPartidas = parseInt(getCookie("contadorPartidas"));
let contadorVictorias = parseInt(getCookie("contadorVictorias"));
let contadorDerrotas = parseInt(getCookie("contadorDerrotas"));

document.addEventListener("DOMContentLoaded", function (){
    if(!contadorPartidas && !contadorVictorias && !contadorDerrotas){
        setCookie("contadorPartidas",0,10)
        setCookie("contadorDerrotas",0,10);
        setCookie("contadorVictorias",0,10);
    }
    contadorPartidas = parseInt(getCookie("contadorPartidas"));
    contadorVictorias = parseInt(getCookie("contadorVictorias"));
    contadorDerrotas = parseInt(getCookie("contadorDerrotas"));

})







function actualizarPantalla(){
    let spanContadorPartidas = document.getElementById("contadorPartidas")
    let spanContadorDerrotas = document.getElementById("contadorDerrotas");
    let spanContadorVictorias = document.getElementById("contadorVictorias");

    
    spanContadorPartidas.textContent = contadorPartidas;
    spanContadorDerrotas.textContent = contadorDerrotas;
    spanContadorVictorias.textContent = contadorVictorias

}


//Cookies
function setCookie(nombre, valor, dias) {
    const fecha = new Date();
    fecha.setTime(fecha.getTime() + (dias * 24 * 60 * 60 * 1000));
    const cookieStr = `${nombre}=${encodeURIComponent(valor)};expires=${fecha.toUTCString()};path=/`;
    console.log("Set cookie:", cookieStr);
    document.cookie = cookieStr;
}


function getCookie(nombre) {
    const cookies = document.cookie.split("; ");
    for (let cookie of cookies) {
        const [key, value] = cookie.split("=");
        if (key === nombre) {
            console.log(value)
            return decodeURIComponent(value);
        }
    }
    return null;
}


//LocalStorage
function setDato(nombre, valor) {
    localStorage.setItem(nombre, valor);
}

function getDato(nombre) {
    return localStorage.getItem(nombre);
}