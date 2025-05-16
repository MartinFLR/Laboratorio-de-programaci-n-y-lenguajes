
let armaJugador = "";
let armasComputadora = ["Piedra","Papel","Tijeras"];
let armaActualComputadora ="";
let victorias = getDato("victorias")
let derrotas = getDato("derrotas")
let batallasRealizadas = getDato("batallasRealizadas");
let rondas = 0;
let ganador = "";

document.addEventListener("DOMContentLoaded",function(){
    let armaJugadorPiedra = document.getElementById("armaJugadorPiedra");
    let armaJugadorPapel = document.getElementById("armaJugadorPapel");
    let armaJugadorTijeras = document.getElementById("armaJugadorTijeras");

    if(!batallasRealizadas && !victorias && !derrotas){
        setDato("batallasRealizadas",0)
        setDato("victorias",0);
        setDato("derrotas",0)
    }
    victorias = getDato("victorias")
    derrotas = getDato("derrotas")
    batallasRealizadas = getDato("batallasRealizadas");

    armaJugadorPapel.addEventListener("click",function(){
        armaJugador = "Papel";
        iniciarJuego()
    })
    armaJugadorPiedra.addEventListener("click",function(){
        armaJugador = "Piedra";
        iniciarJuego()
    })
    armaJugadorTijeras.addEventListener("click",function(){
        armaJugador = "Tijeras";
        iniciarJuego()
    })

    crearResultados()
    actualizarPantalla()
})

function iniciarJuego(){
    armaActualComputadora = incializarArmaMaquina()[0];
    verificarVictoria()
    verificarFinal();
}

function verificarVictoria() {
    console.log(armaJugador)
    console.log(armaActualComputadora)
    rondas++;
    if (armaJugador === armaActualComputadora) {
        empate();
    } else if (armaJugador === "Papel") {
        if (armaActualComputadora === "Piedra") {
            victoriaJugador();
        } else {
            derrotaJugador();
        }
    } else if (armaJugador === "Piedra") {
        if (armaActualComputadora === "Tijeras") {
            victoriaJugador();
        } else {
            derrotaJugador();
        }
    } else if (armaJugador === "Tijeras") {
        if (armaActualComputadora === "Papel") {
            victoriaJugador();
        } else {
            derrotaJugador();
        }
    }

    actualizarPantalla();

}

function crearResultados(){
    let resultados = document.getElementById("resultados");
    let resultadosReales = document.createElement("div");
    let parrafoVictorias = document.createElement("p");
    let parrafoDerrotas = document.createElement("p");

    parrafoDerrotas.setAttribute("id","parrafoDerrotas");
    parrafoVictorias.setAttribute("id","parrafoVictorias");
    resultadosReales.setAttribute("id","resultadosReales");

    resultadosReales.appendChild(parrafoVictorias);
    resultadosReales.appendChild(parrafoDerrotas);
    resultados.appendChild(resultadosReales);
}

function verificarFinal(){
    if(rondas === 6){
        batallasRealizadas++
        rondas = 0;
        console.log("Se terminó la partida!")
        setDato("batallasRealizadas",batallasRealizadas)
    }
}


function victoriaJugador(){
    victorias++
    ganador = "Jugador!"
    setDato("victorias",victorias)
    console.log("Ganó el jugador!")
}

function derrotaJugador(){
    derrotas++;
    ganador = "Maquina!"
    setDato("derrotas",derrotas)
    console.log("Ganó la maquina!")
}

function empate(){
    ganador = "Hubo un empate!"
    console.log("Empate!")
}

function actualizarPantalla(){
    let parrafoVictorias = document.getElementById("parrafoVictorias");
    let parrafoDerrotas = document.getElementById("parrafoDerrotas");
    let spanRonda = document.getElementById("spanRonda")
    let spanBatallas = document.getElementById("spanBatallas")
    let spanArmaComputadora = document.getElementById("spanArmaComputadora");
    let spanGanador = document.getElementById("spanGanador");

    spanGanador.textContent = ganador;
    spanArmaComputadora.textContent = armaActualComputadora;
    spanRonda.textContent = rondas;
    parrafoDerrotas.textContent = `Has perdido : ${derrotas} veces\n`;
    parrafoVictorias.textContent =  `Has ganado : ${victorias} veces\n`;
    spanBatallas.textContent = batallasRealizadas;
}


//utils
function ocultarElemento(elem) {
    elem.classList.add('oculto');
}

function mostrarElemento(elem) {
    elem.classList.remove('oculto');
}

function incializarArmaMaquina(){
    return armasComputadora.sort(() => Math.random() - 0.5)
}


function setDato(nombre, valor) {
    localStorage.setItem(nombre, JSON.stringify(valor));
}

function getDato(nombre) {
    const item = localStorage.getItem(nombre);
    return item ? JSON.parse(item) : null;
}