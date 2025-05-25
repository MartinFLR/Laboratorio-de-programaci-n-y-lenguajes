// Funciones para manejar cookies
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

function mostrarRegistro() {
    document.getElementById("contenido").innerHTML = `
        <h2>Registro de usuario</h2>
        <form id="registro">
          <label>Nombre: <input type="text" id="nombre" required></label><br><br>
          <label>Apellido: <input type="text" id="apellido" required></label><br><br>
          <button type="submit">Registrarse</button>
        </form>
      `;

    document.getElementById("registro").addEventListener("submit", function(e) {
        e.preventDefault();
        const nombre = document.getElementById("nombre").value.trim();
        const apellido = document.getElementById("apellido").value.trim();
        const ahora = new Date().toLocaleString();

        setCookie("nombre", nombre, 30);
        setCookie("apellido", apellido, 30);
        setCookie("visitas", 1, 30);
        setCookie("ultimoAcceso", ahora, 30);

        mostrarDatos(nombre, apellido, 1, ahora);
    });
}

function mostrarDatos(nombre, apellido, visitas, ultimoAcceso) {
    const ahora = new Date().toLocaleString();
    visitas++;

    setCookie("visitas", visitas, 30);
    setCookie("ultimoAcceso", ahora, 30);

    document.getElementById("contenido").innerHTML = `
        <h2>Bienvenido nuevamente, ${nombre} ${apellido}</h2>
        <p>Has visitado esta página <strong>${visitas}</strong> veces.</p>
        <p>Tu último acceso fue el <strong>${ultimoAcceso}</strong>.</p>
      `;
}

// Lógica al cargar la página
const nombre = getCookie("nombre");
const apellido = getCookie("apellido");
const visitas = parseInt(getCookie("visitas"));
const ultimoAcceso = getCookie("ultimoAcceso");

if (nombre && apellido && visitas && ultimoAcceso) {
    mostrarDatos(nombre, apellido, visitas, ultimoAcceso);
} else {
    mostrarRegistro();
}