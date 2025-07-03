function insertarProducto(nombre, precio, ubicacion, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'insertarProducto.php');
  xhr.setRequestHeader('Content-Type', 'application/json');

  xhr.onload = () => {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      callback(null, response);
    } else {
      callback(`Error ${xhr.status}`);
    }
  };

  const data = JSON.stringify({ nombre, precio, ubicacion });
  xhr.send(data);
}
