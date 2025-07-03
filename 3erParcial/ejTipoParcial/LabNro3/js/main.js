document.addEventListener("DOMContentLoaded", () => {
 configurarFiltros()
 filtrar();
});


function configurarFiltros() {
  ["producto", "ubicacion"].forEach((id) => {
    document.getElementById(id).addEventListener("keyup", filtrar);
  });
}