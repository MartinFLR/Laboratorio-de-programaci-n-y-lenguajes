document.addEventListener("DOMContentLoaded", () => {
  buscarProductos();

  // Al hacer click en un producto en la lista
  document.getElementById("productos").addEventListener("click", (e) => {
    const link = e.target.closest("a.producto");
    if (link) {
      e.preventDefault();
      const id = link.dataset.id;
      mostrarDetalles(id);

      // Guardar el código actual en atributo data del contenedor detalle
      const detalle = document.getElementById("detalle");
      detalle.dataset.codigoActual = id;

      document.getElementById("productos").style.display = "none";
      detalle.style.display = "block";
    }
  });

  // Eventos en la zona detalle (para agregar stock y demás)
  document.getElementById("detalle").addEventListener("click", (e) => {
    const btnAgregar = e.target.closest(".btnAgregarStock");
    if (btnAgregar) {
      const sucursal = btnAgregar.getAttribute("data-sucursal");
      const codigo =
        document.getElementById("detalle").dataset.codigoActual || "";

      mostrarFormAgregarStock(sucursal, codigo);
    }

    if (e.target.id === "btnVolver") {
      document.getElementById("detalle").style.display = "none";
      document.getElementById("productos").style.display = "block";
      ocultarFormAgregarStock();
      document.getElementById("detalle").innerHTML = "";
      delete document.getElementById("detalle").dataset.codigoActual;
    }

    if (e.target.id === "btnCancelar") {
      ocultarFormAgregarStock();
    }
  });

  // Escuchar el submit del formulario agregar stock
  const formAgregar = document.getElementById("formAgregarStockForm");
  if (formAgregar) {
    formAgregar.addEventListener("submit", (e) => {
      e.preventDefault();

      const codigo = formAgregar.querySelector('input[name="codigo"]').value;
      const sucursal = formAgregar.querySelector(
        'input[name="sucursal"]'
      ).value;
      const cantidad = formAgregar.querySelector(
        'input[name="cantidad"]'
      ).value;

      agregarStock(codigo, sucursal, cantidad, () => {
        mostrarDetalles(codigo);
        ocultarFormAgregarStock();
      });
    });
  }
});
