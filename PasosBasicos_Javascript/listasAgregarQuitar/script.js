function setDato(nombre, valor) {
    localStorage.setItem(nombre, JSON.stringify(valor));
}

function getDato(nombre) {
    const dato = localStorage.getItem(nombre);
    return dato ? JSON.parse(dato) : null;
}

function mostrarRegistro() {
    document.getElementById("contenido").innerHTML = `
        <h2>Bienvenido al Jardín Peppa Pig</h2>
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
        setDato("visitas", 1);
        setDato("ultimoAcceso", ahora);
        setDato("utiles", []);

        mostrarPanel(nombre, apellido, 1, ahora);
    });
}

function mostrarPanel(nombre, apellido, visitas, ultimoAcceso) {
    const ahora = new Date().toLocaleString();
    visitas++;
    setDato("visitas", visitas);
    setDato("ultimoAcceso", ahora);

    const utiles = getDato("utiles") || [];

    document.getElementById("contenido").innerHTML = `
        <h2>¡Hola ${nombre} ${apellido}!</h2>
        <p>Visitas: <strong>${visitas}</strong></p>
        <p>Último acceso: <strong>${ultimoAcceso}</strong></p>

        <h3>Lista de útiles escolares</h3>
        <ul id="lista-utiles">
            ${utiles.map((item, i) => `<li>${item} <button onclick="eliminarUtil(${i})">Eliminar</button></li>`).join("") || "<li>No hay útiles cargados.</li>"}
        </ul>

        <input type="text" id="nuevo-util" placeholder="Ej: Lápices de colores">
        <button onclick="agregarUtil()">Agregar útil</button>
        <br><br>
        <button onclick="borrarLista()">🗑 Borrar toda la lista</button>
    `;
}

function agregarUtil() {
    const input = document.getElementById("nuevo-util");
    const valor = input.value.trim();
    if (valor !== "") {
        const utiles = getDato("utiles") || [];
        utiles.push(valor);
        setDato("utiles", utiles);
        input.value = "";
        recargarPanel();
    }
}

function eliminarUtil(index) {
    const utiles = getDato("utiles") || [];
    utiles.splice(index, 1);
    setDato("utiles", utiles);
    recargarPanel();
}

function borrarLista() {
    if (confirm("¿Estás seguro de que querés borrar toda la lista?")) {
        setDato("utiles", []);
        recargarPanel();
    }
}

function recargarPanel() {
    const nombre = getDato("nombre");
    const apellido = getDato("apellido");
    const visitas = getDato("visitas");
    const ultimoAcceso = getDato("ultimoAcceso");
    mostrarPanel(nombre, apellido, visitas - 1, ultimoAcceso);
}

// Al iniciar
const nombre = getDato("nombre");
const apellido = getDato("apellido");
const visitas = getDato("visitas");
const ultimoAcceso = getDato("ultimoAcceso");

if (nombre && apellido && visitas && ultimoAcceso) {
    mostrarPanel(nombre, apellido, visitas, ultimoAcceso);
} else {
    mostrarRegistro();
}
