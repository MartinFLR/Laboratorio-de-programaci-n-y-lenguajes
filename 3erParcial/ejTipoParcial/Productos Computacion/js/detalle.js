function mostrarDetalles(id) {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("detalle").innerHTML =
        '<button id="btnVolver" style="margin-bottom: 1rem;">← Volver</button>' +
        xhr.responseText;
      document.getElementById("detalle").style.display = "block";
    }
  };
  xhr.open("GET", "detalleProducto.php?codigo=" + encodeURIComponent(id), true);
  xhr.send();
}
