document.addEventListener("DOMContentLoaded", () => {
 configurarFiltros()
 filtrar();
});


function configurarFiltros() {
  ["producto", "ubicacion"].forEach((id) => {
    document.getElementById(id).addEventListener("keyup", filtrar);
  });
}



function filtrar() {
  const textoProducto = document.getElementById("producto").value.trim();
  const textoUbicacion = document.getElementById("ubicacion").value.trim();

  // Construir URL con parámetros codificados
  const url = `api/buscarSegunFiltros.php?textoProducto=${encodeURIComponent(textoProducto||"")}&textoUbicacion=${encodeURIComponent(textoUbicacion||"")}`;

  const xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.withCredentials = true;

  xhr.onload = () => {
    if (xhr.status === 200) {
      try {
        const data = JSON.parse(xhr.responseText);
        console.log("Respuesta parseada JSON:", data);

        if (Array.isArray(data) && data.length > 0) {
          mostrarProductos(data);
        } else {
          mostrarMensaje("No se encontraron productos.");
        }
      } catch (e) {
        console.error("Error parseando JSON:", e);
        mostrarMensaje("Error procesando la respuesta.");
      }
    } else {
      console.error("Error en filtrar. Código:", xhr.status);
      mostrarMensaje("Error al buscar productos.");
    }
  };
  xhr.send();
}



function mostrarProductos(data) {
  const contenedor = document.getElementById("resultado");
  contenedor.innerHTML = "";

  data.forEach((producto, index) => {
    const div = document.createElement("div");
    div.className = "producto";
 div.innerHTML = `
      <p><strong>Id producto:</strong> ${producto.id_producto}</p>
      <p><strong>Producto: ${producto.nombre}</strong></p>
    <p><strong>Precio:</strong> ${producto.precio} </p>

      <p><strong>Nombre Supermercado:</strong> ${producto.nombreSupermercado} </p>
      <p><strong>Ubicacion:</strong> ${producto.ubicacionSupermercado} </p>

      <button class="ver-detalle" data-index="${index}">Ver Detalle</button>
      <div id="detalle-${index}" class="detalle-empresa" style="display:none; background:#f0f0f0; margin-top:10px; padding:10px;"></div>
      <hr>
    `;
    contenedor.appendChild(div);
    });

      // Eventos para mostrar detalle
  document
    .querySelectorAll(".ver-detalle")
    .forEach((el) => {
      el.addEventListener("click", (e) => {
        //aca veo el index del dataset que puse antes
        const idx = e.target.dataset.index;
        //if (!idx) return;
        buscarPorIdProducto(data[idx],idx)
      });
    });
}


function buscarPorIdProducto(data,idx) {
  // Construir URL con parámetros codificados
  const url = `api/buscarPorId.php?idProducto=${encodeURIComponent(data.id_producto)}`;

  const xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.withCredentials = true;

  xhr.onload = () => {
    if (xhr.status === 200) {
      try {
        const data = JSON.parse(xhr.responseText);
        console.log("Respuesta parseada JSON:", data);
        if (Array.isArray(data) && data.length > 0) {
          mostrarDetalle(data,idx)
        } 
      } catch (e) {
        console.error("Error parseando JSON:", e);
      }
    } else {
      console.error("Error en filtrar. Código:", xhr.status);
    }
  };
  xhr.send();
}

function mostrarDetalle(data, index) {
  const detalleDiv = document.getElementById(`detalle-${index}`);
  console.log("Mostrando detalle de", data);

  if (!Array.isArray(data) || data.length === 0) {
    detalleDiv.innerHTML = "<p>No hay supermercados disponibles para este producto.</p>";
    detalleDiv.style.display = "block";
    return;
  }

  // Armar tabla HTML
  let tabla = `
    <table border="1" cellpadding="5" cellspacing="0">
      <thead>
        <tr>
          <th>Supermercado</th>
          <th>Precio</th>
          <th>Ubicación</th>
        </tr>
      </thead>
      <tbody>
  `;

  let precioMin = Number.MAX_VALUE;
  let precioMax = Number.MIN_VALUE;
  let supermercadoMin = null;

  data.forEach(item => {
    tabla += `
      <tr>
        <td>${item.nombre}</td>
        <td>${item.precio}</td>
        <td>${item.ubicacion}</td>
      </tr>
    `;

    // Calcular mínimo y máximo
    const precio = parseFloat(item.precio);
    if (precio < precioMin) {
      precioMin = precio;
      supermercadoMin = `${item.nombre} - ${item.ubicacion}`;
    }
    if (precio > precioMax) {
      precioMax = precio;
    }
  });

  tabla += `
      </tbody>
    </table>
    <p><strong>Precio más bajo:</strong> ${supermercadoMin}</p>
    <p><strong>Diferencia entre el más bajo y el más alto:</strong> $${(precioMax - precioMin).toFixed(2)}</p>
  `;

  detalleDiv.innerHTML = tabla;
  detalleDiv.style.display = "block";
}





function mostrarMensaje(msg){
const contenedor = document.getElementById("resultado");
  contenedor.innerHTML = msg;
  
}