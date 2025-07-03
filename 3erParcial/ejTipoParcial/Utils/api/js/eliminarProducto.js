function eliminarProducto(idProducto, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', `eliminarProducto.php?idProducto=${encodeURIComponent(idProducto)}`);

  xhr.onload = () => {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      callback(null, response);
    } else {
      callback(`Error ${xhr.status}`);
    }
  };

  xhr.send();
}
