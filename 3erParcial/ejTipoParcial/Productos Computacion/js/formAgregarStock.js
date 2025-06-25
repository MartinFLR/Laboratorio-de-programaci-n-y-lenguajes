function mostrarFormAgregarStock(sucursal, codigo) {
  console.log("mostrarFormAgregarStock llamado con:", sucursal, codigo);

  const nombreSucursal = document.getElementById("nombreSucursal");
  const inputSucursal = document.getElementById("inputSucursal");
  const inputCodigo = document.getElementById("inputCodigo");
  const cantidadAgregar = document.getElementById("cantidadAgregar");
  const formAgregarStock = document.getElementById("formAgregarStock");

  if (
    !nombreSucursal ||
    !inputSucursal ||
    !inputCodigo ||
    !cantidadAgregar ||
    !formAgregarStock
  ) {
    console.error("Uno o más elementos no se encontraron en el DOM");
    return;
  }

  nombreSucursal.textContent = sucursal;
  inputSucursal.value = sucursal;
  inputCodigo.value = codigo;
  cantidadAgregar.value = "";

  formAgregarStock.style.display = "block";
  formAgregarStock.scrollIntoView({ behavior: "smooth" });
}
