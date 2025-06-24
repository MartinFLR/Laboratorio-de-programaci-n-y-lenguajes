// Variables globales
let palabraActual = null;
let pistasMostradas = [];
let puntajeActual = 80;

document.addEventListener("DOMContentLoaded", () => {
  iniciarPartida();
});

function iniciarPartida() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "api/iniciarPartida.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      console.log("Respuesta del servidor:", xhr.responseText);

      if (xhr.status === 200) {
        try {
          //aca la api nos devuelve la palabra nomas, y bueno un mensaje pero no lo uso al mensaje,
          //solo para debug en el log de arriba
          const data = JSON.parse(xhr.responseText);
          palabraActual = data.palabra;
          pistasMostradas = [];
          puntajeActual = 80;
          mostrarInfoInicial();
          actualizarPuntaje();
          limpiarPistas();
          limpiarResultado();
          limpiarInput();
        } catch (e) {
          console.error("Error parseando JSON:", e);
        }
      } else {
        console.error("Error en la respuesta. Código HTTP:", xhr.status);
      }
    }
  };
  xhr.send();
}

//tiene acceso a palabraActual porque los llamamos todos juntitos
function mostrarInfoInicial() {
  const infoDiv = document.getElementById("informacion");
  infoDiv.innerHTML = `
    <p>Longitud: ${palabraActual.longitud} letras</p>
    <p>Dificultad: ${palabraActual.dificultad}</p>
    <p>Veces acertada: ${palabraActual.acertada}</p>
  `;
}

function pedirPista() {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "api/darPista.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);
      if (data.pista) {
        //como traemos una pista que es un objeto, tenemos que aclarar que usamos {data.pista}
        //Si usaramos data nomas le pasamos todo el objeto y no va a funcar
        pistasMostradas.push({ pista: data.pista });

        mostrarPistas();
        puntajeActual -= 15;
        actualizarPuntaje();
      } else {
        mostrarResultado("No hay más pistas disponibles");
      }
    }
  };
  xhr.send(JSON.stringify({ idPalabra: palabraActual.id }));
}

function mostrarPistas() {
  const pistasDiv = document.getElementById("pistas");
  pistasDiv.innerHTML = pistasMostradas
    .map((p, i) => `<p>Pista ${i + 1}: ${p.pista}</p>`)
    .join("");
}

function arriesgarPalabra() {
  const input = document.getElementById("input-intento"); // obtenemos el input
  const intento = input.value.trim(); // definimos la variable intento

  if (!intento) {
    alert("Por favor, ingresa una palabra antes de arriesgar.");
    return;
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "api/procesarIntento.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      console.log("Respuesta del servidor:", xhr.responseText); // Mostrar texto crudo

      if (xhr.status === 200) {
        try {
          const data = JSON.parse(xhr.responseText);
          console.log("Respuesta parseada:", data); // Mostrar objeto JS

          if (data.resultado) {
            mostrarResultado(`¡Ganaste! Puntaje: ${data.puntaje}`);
            iniciarPartida();
          } else {
            mostrarResultado("Incorrecto, intenta de nuevo o pide más pistas.");
          }
        } catch (e) {
          console.error("Error parseando JSON:", e);
          mostrarResultado("Error en respuesta del servidor.");
        }
      } else {
        console.error("Error en la respuesta. Código HTTP:", xhr.status);
        mostrarResultado("Error en la comunicación con el servidor.");
      }

      input.value = ""; // limpia input siempre, aunque error o no
    }
  };
  xhr.send(JSON.stringify({ idPalabra: palabraActual.id, intento }));
}

function rendirse() {
  alert("Te has rendido. La palabra correcta era: " + palabraActual.palabra);
  iniciarPartida();
}

function actualizarPuntaje() {
  document.getElementById("puntaje").innerText = `Puntaje: ${puntajeActual}`;
}

function limpiarPistas() {
  document.getElementById("pistas").innerHTML = "";
}

function mostrarResultado(msg) {
  document.getElementById("resultado").innerText = msg;
}

function limpiarResultado() {
  document.getElementById("resultado").innerText = "";
}

function limpiarInput() {
  document.getElementById("input-intento").value = "";
}
