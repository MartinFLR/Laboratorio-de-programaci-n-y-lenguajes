
let turnoHumano = "x";
let turnoMaquina = "o";
let turnoActual = turnoHumano;
let contadorPartidas;
let contadorVictorias;
let contadorDerrotas;

let contadorPartidas = parseInt(getCookie("contadorPartidas"));
let contadorVictorias = parseInt(getCookie("contadorVictorias"));
let contadorDerrotas = parseInt(getCookie("contadorDerrotas"));


document.addEventListener("DOMContentLoaded", function() {
    let botonRendirse = document.getElementById("botonRendirse")
    let botonIniciarJuego = document.getElementById("botonIniciarJuego");
<<<<<<< Updated upstream
    let spanContadorPartidas = document.getElementById("contadorPartidas")
    let spanContadorDerrotas = document.getElementById("contadorDerrotas");
    let spanContadorVictorias = document.getElementById("contadorVictorias");


    contadorPartidas = parseInt(getCookie("contadorPartidas"));
    contadorVictorias = parseInt(getCookie("contadorVictorias"));
    contadorDerrotas = parseInt(getCookie("contadorDerrotas"));

    if(contadorPartidas === ""){
=======

    if(!contadorPartidas){
>>>>>>> Stashed changes
        setCookie("contadorPartidas",0,10)
        setCookie("contadorDerrotas",0,10);
        setCookie("contadorVictorias",0,10);
    }
<<<<<<< Updated upstream

    spanContadorPartidas.textContent = contadorPartidas;
    spanContadorDerrotas.textContent = contadorDerrotas;
    spanContadorVictorias.textContent = contadorVictorias

    botonIniciarJuego.addEventListener("click", iniciarJuego);
    botonRendirse.addEventListener("click",)
=======
    contadorPartidas = parseInt(getCookie("contadorPartidas"));
    contadorVictorias = parseInt(getCookie("contadorVictorias"));
    contadorDerrotas = parseInt(getCookie("contadorDerrotas"));

    actualizarPantalla()

    botonIniciarJuego.addEventListener("click", iniciarJuego);
    botonRendirse.addEventListener("click",rendirse)
>>>>>>> Stashed changes
});

function iniciarJuego() {
    contadorPartidas++;
    setCookie("contadorPartidas",contadorPartidas,10)
    
    let botonRendirse = document.getElementById("botonRendirse")
    botonRendirse.style.display = "block";

    let botonIniciarJuego = document.getElementById("botonIniciarJuego")
    botonIniciarJuego.style.display = "none";

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
    actualizarPantalla()
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
    if(ganador === turnoHumano){
<<<<<<< Updated upstream
        
    }
=======
        contadorVictorias++
        setCookie("contadorVictorias",contadorVictorias,10)
        actualizarPantalla()
        eliminarTablero()
    }else{
        contadorDerrotas++
        setCookie("contadorDerrotas",contadorDerrotas,10)
        actualizarPantalla()
        eliminarTablero()
    }
    let botonRendirse = document.getElementById("botonRendirse")
    botonRendirse.style.display = "none";

    let botonIniciarJuego = document.getElementById("botonIniciarJuego")
    botonIniciarJuego.style.display = "block";

>>>>>>> Stashed changes
    alert(mensaje);
    
}
function rendirse(){
<<<<<<< Updated upstream

}



=======
        let botonRendirse = document.getElementById("botonRendirse")
    botonRendirse.style.display = "none";

    let botonIniciarJuego = document.getElementById("botonIniciarJuego")
    botonIniciarJuego.style.display = "block";

        eliminarTablero()
        contadorDerrotas++
        setCookie("contadorDerrotas",contadorDerrotas,10)
        actualizarPantalla()
}


function actualizarPantalla(){
    let spanContadorPartidas = document.getElementById("contadorPartidas")
    let spanContadorDerrotas = document.getElementById("contadorDerrotas");
    let spanContadorVictorias = document.getElementById("contadorVictorias");

    
    spanContadorPartidas.textContent = contadorPartidas;
    spanContadorDerrotas.textContent = contadorDerrotas;
    spanContadorVictorias.textContent = contadorVictorias

}

function eliminarTablero(){
    let todasLasCeldas = document.querySelectorAll(".celda");
    todasLasCeldas.forEach(celda =>{
        celda.remove()
    })
}


//Cookies
>>>>>>> Stashed changes
function setCookie(nombre, valor, dias) {
    const fecha = new Date();
    fecha.setTime(fecha.getTime() + (dias * 24 * 60 * 60 * 1000));
    const cookieStr = `${nombre}=${encodeURIComponent(valor)};expires=${fecha.toUTCString()};path=/`;
    console.log("Set cookie:", cookieStr);
    document.cookie = cookieStr;
}


function getCookie(nombre) {
    const cookies = document.cookie.split("; ");
    for (let cookie of cookies) {
        const [key, value] = cookie.split("=");
        if (key === nombre) {
            console.log(value)
            return decodeURIComponent(value);
        }
    }
    return null;
}