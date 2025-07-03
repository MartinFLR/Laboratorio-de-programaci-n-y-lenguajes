function buscarProductoPorId(idProducto, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', `buscarProducto.php?idProducto=${encodeURIComponent(idProducto)}`);

  xhr.onload = () => {
    if (xhr.status === 200) {
      const producto = JSON.parse(xhr.responseText);
      callback(null, producto);
    } else {
      callback(`Error ${xhr.status}`);
    }
  };

  xhr.send();
}
