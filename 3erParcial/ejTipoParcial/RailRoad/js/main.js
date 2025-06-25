document.addEventListener("DOMContentLoaded", () => {
  cargarCiudades();
  configurarFiltros();
  filtrar(); // Carga datos al inicio
});

function cargarCiudades() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "api/iniciarPagina.php", true);
  xhr.withCredentials = true;

  xhr.onload = () => {
    if (xhr.status === 200) {
      try {
        const data = JSON.parse(xhr.responseText);
        console.log("Respuesta parseada JSON:", data);

        llenarSelect("ciudadesOrigen", data.ciudadesOrigen);
        llenarSelect("ciudadesDestino", data.ciudadesDestino);
      } catch (e) {
        console.error("Error parseando JSON:", e);
      }
    } else {
      console.error("Error cargando ciudades. Código:", xhr.status);
    }
  };

  xhr.onerror = () => {
    console.error("Error de red cargando ciudades.");
  };

  xhr.send();
}

function configurarFiltros() {
  ["ciudadesOrigen", "ciudadesDestino"].forEach((id) => {
    document.getElementById(id).addEventListener("change", filtrar);
  });
}

function llenarSelect(id, opciones) {
  const select = document.getElementById(id);
  opciones.forEach((op) => {
    const option = document.createElement("option");
    option.value = op;
    option.textContent = op;
    select.appendChild(option);
  });
}

function filtrar() {
  const origen = document.getElementById("ciudadesOrigen").value.trim();
  const destino = document.getElementById("ciudadesDestino").value.trim();

  // Construir URL con parámetros codificados
  const url = `api/buscarSegunFiltros.php?
  ciudadOrigen=${encodeURIComponent(origen)}
  &ciudadDestino=${encodeURIComponent(destino)}`;

  const xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);

  xhr.onload = () => {
    if (xhr.status === 200) {
      try {
        const data = JSON.parse(xhr.responseText);
        console.log("Respuesta parseada JSON:", data);

        if (Array.isArray(data) && data.length > 0) {
          mostrarServicios(data);
        } else {
          mostrarMensaje("No se encontraron servicios.");
        }
      } catch (e) {
        console.error("Error parseando JSON:", e);
        mostrarMensaje("Error procesando la respuesta.");
      }
    } else {
      console.error("Error en filtrar. Código:", xhr.status);
      mostrarMensaje("Error al buscar servicios.");
    }
  };
  xhr.send();
}

function mostrarServicios(data) {
  const contenedor = document.getElementById("resultado");
  contenedor.innerHTML = "";

  data.forEach((item, index) => {
    const div = document.createElement("div");
    div.className = "servicio";

    div.innerHTML = `
      <img src="${
        item.empresa?.logo || ""
      }"alt="Logo" class="logo-empresa" data-index="${index}" style="height:60px; cursor:pointer;">
      <br>
      <span class="ver-web" data-index="${index}" style="color:#06c; cursor:pointer; text-decoration:underline;">
        ${item.empresa?.web || ""}
      </span>
      <p><strong>Empresa:</strong> 
      ${item.empresa?.nombre || "No disponible"}
      </p>
      <p><strong>Nro Servicio:</strong> ${item.nroServicio}</p>
      <p><strong>Origen:</strong> ${item.ciudadOrigenServicio}
       (${item.estacionOrigenServicio})
      </p>
      <p><strong>Destino:</strong> ${item.ciudadDestinoServicio} 
      (${item.estacionDestinoServicio})
      </p>
      <p><strong>Salida:</strong> ${item.horaSalidaServicio}</p>
      <p><strong>Llegada:</strong> ${item.horaLlegadaServicio}</p>
      <p><strong>Precio:</strong> $${item.precioServicio}</p>
      <button class="ver-detalle" data-index="${index}">Ver Detalle</button>
      <div id="detalle-${index}" class="detalle-empresa" style="display:none; background:#f0f0f0; margin-top:10px; padding:10px;"></div>
      <hr>
    `;

    contenedor.appendChild(div);
  });

  // Eventos para mostrar detalle
  document
    .querySelectorAll(".logo-empresa, .ver-web, .ver-detalle")
    .forEach((el) => {
      el.addEventListener("click", (e) => {
        const idx = e.target.dataset.index;
        if (!idx) return;
        mostrarDetalle(data[idx], idx);
      });
    });
}

function mostrarDetalle(item, index) {
  const detalleDiv = document.getElementById(`detalle-${index}`);

  detalleDiv.innerHTML = `
    <p><strong>Nombre Legal:</strong> 
    ${item.empresa?.nombre || "No disponible"}
      </p>
    <p><strong>Sitio Web:</strong> 
    <a href="${item.empresa?.web || "#"}" target="_blank">
    ${item.empresa?.web || "No disponible"}</a></p>
    <p><strong>País:</strong> ${item.empresa?.pais || "No disponible"}</p>
    <p><strong>Servicios de esta empresa:</strong></p>
    <div id="servicios-detalle-${index}">Cargando servicios...</div>
  `;

  detalleDiv.style.display = "block";

  obtenerServiciosEmpresa(
    item.idEmpresa || item.empresa?.idEmpresa,
    (servicios) => {
      const serviciosDiv = document.getElementById(
        `servicios-detalle-${index}`
      );
      if (!servicios || servicios.length === 0) {
        serviciosDiv.textContent = "No hay servicios adicionales.";
        return;
      }
      serviciosDiv.innerHTML = servicios
        .map(
          (srv) => `
      <div style="border:1px solid #ccc; margin-bottom:6px; padding:6px;">
        <p><strong>Nro Servicio:</strong> ${srv.nroServicio}</p>
        <p><strong>Origen:</strong> ${srv.ciudadOrigenServicio} (${srv.estacionOrigenServicio})</p>
        <p><strong>Destino:</strong> ${srv.ciudadDestinoServicio} (${srv.estacionDestinoServicio})</p>
        <p><strong>Salida:</strong> ${srv.horaSalidaServicio}</p>
        <p><strong>Llegada:</strong> ${srv.horaLlegadaServicio}</p>
        <p><strong>Precio:</strong> $${srv.precioServicio}</p>
      </div>
    `
        )
        .join("");
    }
  );
}

function obtenerServiciosEmpresa(idEmpresa, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "api/buscarServiciosEmpresa.php", true);
  xhr.withCredentials = true;
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onload = () => {
    if (xhr.status === 200) {
      try {
        const data = JSON.parse(xhr.responseText);
        console.log("Respuesta parseada JSON:", data);
        callback(data);
      } catch (e) {
        console.error("Error parseando servicios empresa:", e);
        callback(null);
      }
    } else {
      console.error("Error al obtener servicios empresa. Código:", xhr.status);
      callback(null);
    }
  };

  xhr.onerror = () => {
    console.error("Error de red al obtener servicios empresa.");
    callback(null);
  };

  xhr.send(JSON.stringify({ idEmpresa }));
}

function mostrarMensaje(msg) {
  document.getElementById("resultado").textContent = msg;
}
