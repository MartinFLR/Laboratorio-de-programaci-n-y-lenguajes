function actualizarProducto(idProducto, nombre, precio, ubicacion, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'actualizarProducto.php');
  xhr.setRequestHeader('Content-Type', 'application/json');

  xhr.onload = () => {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      callback(null, response);
    } else {
      callback(`Error ${xhr.status}`);
    }
  };

  const data = JSON.stringify({ idProducto, nombre, precio, ubicacion });
  xhr.send(data);
}
