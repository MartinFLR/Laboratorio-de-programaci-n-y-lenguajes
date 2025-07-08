document.addEventListener("DOMContentLoaded", () => {
 configurarFiltros();
 cargarCiudades();
});

function mostrarMensaje(msg){
const contenedor = document.getElementById("resultado");
  contenedor.innerHTML = msg;
  
}
function cargarCiudades() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "api/buscarTodasEmpresas.php", true);
  xhr.withCredentials = true;

  xhr.onload = () => {
    if (xhr.status === 200) {
      try {
        const data = JSON.parse(xhr.responseText);
        console.log("Respuesta parseada JSON:", data);
        llenarSelect("empresa", data);
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
  const empresa = document.getElementById("empresa").value.trim();
  const dia = document.getElementById("dia").value.trim();
  console.log("dia: " +dia)
  console.log("empresa: "+ empresa)
  const url = `api/buscarSegunFiltros.php?nombreEmpresa=${encodeURIComponent(empresa||"")}&dia=${encodeURIComponent(dia||"")}`;

  const xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.withCredentials = true;

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

  data.forEach((servicio, index) => {
    const div = document.createElement("div");
    div.className = "servicio";
 div.innerHTML = `
      <p><strong>idServicio:</strong> ${servicio.idServicio}</p>
      <p><strong>ciudadOrigen: ${servicio.ciudadOrigen}</strong></p>
    <p><strong>ciudadDestino:</strong> ${servicio.ciudadDestino} </p>

      <p><strong>horaSalida:</strong> ${servicio.horaSalida} </p>
      <p><strong>horaLlegada:</strong> ${servicio.horaLlegada} </p>

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
        const idx = e.target.dataset.index;
        //if (!idx) return;
        buscarServicioPorId(data[idx],idx)
      });
    });
}

function buscarServicioPorId(data,idx) {
  const url = `api/buscarServicioPorId.php?idServicio=${encodeURIComponent(data.idServicio)}`;

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
    detalleDiv.innerHTML = "<p>No hay detalles disponibles para este servicio.</p>";
    detalleDiv.style.display = "block";
    return;
  }

  let tabla = `
    <table border="1" cellpadding="5" cellspacing="0">
      <thead>
        <tr>
          <th>Dias</th>
          <th>Cantidad asientos en servicio cama</th>
          <th>Precio pasaje en servicio cama</th>
          <th>Cantidad asientos en servicio semi cama</th>
          <th>Precio pasaje en servicio semi cama</th>
          <th>Web de la empresa</th>
        </tr>
      </thead>
      <tbody>
  `;

  data.forEach(item => {
    let textoDias ="";
    if(item.operaLU === "True"){
      textoDias +=`Lunes`
    }
    if(item.operaMA === "True"){
      textoDias +=`Martes`
    }
    if(item.operaMI === "True"){
      textoDias +=`Miercoles`
    }
    if(item.operaJU === "True"){
      textoDias +=`Jueves`
    }
    if(item.operaVI === "True"){
      textoDias +=`Viernes`
    }
    if(item.operaSA === "True"){
      textoDias +=`Sabado`
    }
     if(item.operaDO === "True"){
      textoDias +=`Domingo`
    }

    tabla += `
      <tr>
        <td>${textoDias}</td>
        <td>${item.asientosCama}</td>
        <td>${item.precioPasajeCama}</td>
        <td>${item.asientosSemicama}</td>
        <td>${item.precioPasajeSemicama}</td>
        <td>${item.webEmpresa}</td>
      </tr>
    `;
  });

  detalleDiv.innerHTML = tabla;
  detalleDiv.style.display = "block";
}


function configurarFiltros() {
  ["empresa","dia"].forEach((id) => {
    document.getElementById(id).addEventListener("change", filtrar);
  });



}