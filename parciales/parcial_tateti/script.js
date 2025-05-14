let turnoHumano = "x";
let turnoMaquina = "o";
let turnoActual = turnoHumano;

document.addEventListener("DOMContentLoaded", function() {
    let botonIniciarJuego = document.getElementById("botonIniciarJuego");
    botonIniciarJuego.addEventListener("click", iniciarJuego);
});

function iniciarJuego() {
    let contenedorJuego = document.getElementById("contenedorJuego");
    for (let fila = 0; fila < 3; fila++) {
        for (let col = 0; col < 3; col++) {
            let celda = document.createElement("div");
            celda.classList.add("celda");
            celda.dataset.fila = fila;
            celda.dataset.col = col;
            celda.addEventListener("click", manejarClickCelda);
            contenedorJuego.appendChild(celda);
        }
    }
}

function manejarClickCelda(e) {
    let celda = e.currentTarget;
    manejarClick(celda);
    celda.removeEventListener("click", manejarClickCelda); // Eliminar el evento después de hacer clic
}

function manejarClick(celda) {
    turnoActual = revisarTurno();
    if (turnoActual === turnoHumano) {
        celda.textContent = turnoHumano;
        celda.style.cursor = "default";
        if (!verificarFinalPartida()) {
            turnoMaquinaAleatorio();
        }
    }
}

function revisarTurno() {
    return turnoActual;
}

function turnoMaquinaAleatorio() {
    let celdas = document.querySelectorAll(".celda");
    for (let celda of celdas) {
        if (celda.textContent === turnoHumano || celda.textContent === turnoMaquina) {
            continue;
        } else {
            celda.textContent = turnoMaquina;
            celda.style.cursor = "default";
            celda.removeEventListener("click", manejarClickCelda);
            if (!verificarFinalPartida()) {
                turnoActual = turnoHumano; 
            }
            break;
        }
    }
}

function verificarFinalPartida() {
    let celdas = document.querySelectorAll(".celda");

    // Comprobar filas, columnas y diagonales usando la misma lógica
    let combinaciones = [
        // Filas
        [0, 1, 2], [3, 4, 5], [6, 7, 8],
        // Columnas
        [0, 3, 6], [1, 4, 7], [2, 5, 8],
        // Diagonales
        [0, 4, 8], [2, 4, 6]
    ];

    for (let combinacion of combinaciones) {
        let [a, b, c] = combinacion;
        if (celdas[a].textContent && celdas[a].textContent === celdas[b].textContent && celdas[b].textContent === celdas[c].textContent) {
            mostrarGanador(celdas[a].textContent);
            return true;
        }
    }

    // Verificar empate
    let todasOcupadas = true;
    for (let celda of celdas) {
        if (celda.textContent === "") {
            todasOcupadas = false;
            break;
        }
    }

    if (todasOcupadas) {
        mostrarGanador("Empate");
        return true;
    }

    return false;
}

function mostrarGanador(ganador) {
    let mensaje = ganador === "Empate" ? "El juego ha terminado en empate." : `${ganador} ha ganado!`;
    alert(mensaje);
    
}
