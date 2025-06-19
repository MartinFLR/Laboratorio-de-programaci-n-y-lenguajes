document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("busqueda");
    input.addEventListener("keyup", buscarProducto);
});

function buscarProducto() {
    //tomo el valor que el usuario escribio
    const descripcion = document.getElementById("busqueda").value;

    //creo el objeto Ajax(XMLHttpRequest)
    //permite hacer una petición al servidor sin recargar la página
    const xhr = new XMLHttpRequest();

    //Define lo que debe hacer cuando cambie el estado de la solicitud (readyState)
    //Solo nos interesa cuando llega al estado 4 (completado) y con status 200 (OK)
    xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById("resultado").innerHTML = xhr.responseText;
        }
    };

    // Prepara la solicitud GET
    //Le pasa como parámetro nombre en la URL
    //encodeURIComponent(descripcion) asegura que el texto vaya bien codificado (por ejemplo si hay espacios o acentos)
    xhr.open("GET", "buscar.php?descripcion=" + encodeURIComponent(descripcion), true);
    xhr.send();
}
