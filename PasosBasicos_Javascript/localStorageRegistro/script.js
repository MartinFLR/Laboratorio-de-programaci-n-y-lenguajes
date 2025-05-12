function setDato(nombre, valor) {
    localStorage.setItem(nombre, valor);
}

function getDato(nombre) {
    return localStorage.getItem(nombre);
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

        setDato("nombre", nombre);
        setDato("apellido", apellido);
        setDato("visitas", "1"); // primera vez
        setDato("ultimoAcceso", ahora);

        mostrarDatos(nombre, apellido, 1, ahora);
    });
}

function mostrarDatos(nombre, apellido, visitas, ultimoAcceso) {
    document.getElementById("contenido").innerHTML = `
        <h2>Bienvenido nuevamente, ${nombre} ${apellido}</h2>
        <p>Has visitado esta página <strong>${visitas}</strong> veces.</p>
        <p>Tu último acceso fue el <strong>${ultimoAcceso}</strong>.</p>
    `;
}

// Lógica al cargar la página
const nombre = getDato("nombre");
const apellido = getDato("apellido");
let visitas = parseInt(getDato("visitas"));
const ultimoAcceso = getDato("ultimoAcceso");

if (nombre && apellido && !isNaN(visitas) && ultimoAcceso) {
    visitas++; // ✅ solo se incrementa si ya hay datos guardados
    const ahora = new Date().toLocaleString();

    setDato("visitas", visitas);
    setDato("ultimoAcceso", ahora);

    mostrarDatos(nombre, apellido, visitas, ultimoAcceso);
} else {
    mostrarRegistro();
}
