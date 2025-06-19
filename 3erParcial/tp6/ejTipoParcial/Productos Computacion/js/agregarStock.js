function agregarStock(codigo, sucursal, cantidad, onSuccess) {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        alert("Stock agregado correctamente");
        if (typeof onSuccess === "function") {
          onSuccess();
        }
      } else {
        alert("Error al agregar stock");
      }
    }
  };

  xhr.open("POST", "agregarStock.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  const params = `codigo=${encodeURIComponent(
    codigo
  )}&sucursal=${encodeURIComponent(sucursal)}&cantidad=${encodeURIComponent(
    cantidad
  )}`;
  xhr.send(params);
}
