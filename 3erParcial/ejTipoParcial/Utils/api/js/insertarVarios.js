function insertarProductos(productosArray, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'insertarProductos.php');
  xhr.setRequestHeader('Content-Type', 'application/json');

  xhr.onload = () => {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      callback(null, response);
    } else {
      callback(`Error ${xhr.status}`);
    }
  };

  xhr.send(JSON.stringify(productosArray));
}
