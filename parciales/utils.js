function desordenar(array){
    return array.sort(() => Math.random() - 0.5)
}

function ocultarElemento(elem) {
    elem.classList.add('oculto');
}

function mostrarElemento(elem) {
    elem.classList.remove('oculto');
}


function setDato(nombre, valor) {
    localStorage.setItem(nombre, JSON.stringify(valor));
}

function getDato(nombre) {
    const item = localStorage.getItem(nombre);
    return item ? JSON.parse(item) : null;
}


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

`${i}- 🗓️ ${partida.fecha} — 🏆 ${partida.ganador}\n`


function $id(id) {
    return document.getElementById(id);
}

function $all(selector) {
    return document.querySelectorAll(selector);
}

function crearElemento(tag, id = null, clases = null) {
    const el = document.createElement(tag);
    if (id) {
        el.id = id;
    }
    if (clases) {
        if (Array.isArray(clases)) {
            el.classList.add(...clases);
        } else {
        el.classList.add(clases);
        }
    }
    return el;
}
