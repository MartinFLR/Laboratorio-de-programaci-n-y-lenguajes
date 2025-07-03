document.addEventListener("DOMContentLoaded", () => {
    const inputBusquedaProducto = document.getElementById("busquedaProducto");
    const inputBusquedaUbicacion = document.getElementById("busquedaUbicacion");
    inputBusquedaProducto.addEventListener("keyup", filtrar);
    inputBusquedaUbicacion.addEventListener("keyup", filtrar);
});

function filtrar() {
  const producto = document.getElementById("busquedaProducto").value.trim();
  const ubicacion = document.getElementById("busquedaUbicacion").value.trim();

  // Construir URL con parámetros codificados
  const url = `buscarPorAmbos.php?textoProductos=${encodeURIComponent(producto||"")}&textoUbicacion=${encodeURIComponent(ubicacion||"")}`;

  const xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.withCredentials = true;
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            var objetos = JSON.parse(xhr.responseText);
            const resultados = document.getElementById("resultado");
            var texto = "";
            for (i = 0; i < objetos.length; i++) {
                texto += "<p>";
                texto += "<p>" + objetos[i].nombre + "</p>";
                texto += "<p>" + objetos[i].precio + "</p>";
                texto += "<p>" + objetos[i].nombreSupermercado + "</p>";
                texto += "<p>" + objetos[i].ubicacionSupermercado + "</p>";
            }
            resultados.innerHTML = texto;
}};
  xhr.send();
}




function buscarProducto() {
    //tomo el valor que el usuario escribio
    const texto = document.getElementById("busquedaProducto").value;
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            var objetos = JSON.parse(xhr.responseText);
            const resultados = document.getElementById("resultado");
            var texto = "";
            for (i = 0; i < objetos.length; i++) {
                texto += "<p>";
                texto += "<p>" + objetos[i].nombre + "</p>";
                texto += "<p>" + objetos[i].precio + "</p>";
                texto += "<p>" + objetos[i].nombreSupermercado + "</p>";
                texto += "<p>" + objetos[i].ubicacionSupermercado + "</p>";
            }
            resultados.innerHTML = texto;
        
        }
    };
    xhr.open("GET", "buscarPorParametro.php?texto=" + encodeURIComponent(texto), true);
    xhr.send();
}

