function buscarProductos() {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("productos").innerHTML = xhr.responseText;
    }
  };
  xhr.open("GET", "buscarProductos.php", true);
  xhr.send();
}
