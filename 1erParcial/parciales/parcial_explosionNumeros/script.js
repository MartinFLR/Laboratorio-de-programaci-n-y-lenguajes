let jugador = [];
let maquina = [];
let primeraVez = true;
let ronda = 0;
let victorias = parseInt(getDato("victorias"))
let derrotas = parseInt(getDato("derrotas"))
let ultimas5Partidas = getDato("ultimasPartidas");
let valueOpciones = "";

document.addEventListener("DOMContentLoaded",function(){
    let botonIniciarJuego = document.getElementById("iniciarJuego");
    let botonNuevaTirada = document.getElementById("nuevaTirada");
    let selectOpciones = document.getElementById("selectOpciones");
    let botonRendirse = document.getElementById("rendirse")

    valueOpciones = document.getElementById("selectOpciones").value;

    ocultarElemento(botonNuevaTirada)
    ocultarElemento(botonRendirse)

    if(!victorias && !derrotas && !ultimas5Partidas){
        setDato("victorias",0);
        setDato("derrotas",0);
        setDato("ultimasPartidas", []);
    }
    

    victorias = parseInt(getDato("victorias"))
    derrotas = parseInt(getDato("derrotas"))
    ultimas5Partidas = getDato("ultimasPartidas")

    selectOpciones.addEventListener("change",onChangeSelect)
    botonIniciarJuego.addEventListener("click",iniciarJuego);
    botonNuevaTirada.addEventListener("click",nuevaTirada);
    botonRendirse.addEventListener("click",rendirse)

    actualizarPantalla()
})






function iniciarJuego(){
    let botonNuevaTirada = document.getElementById("nuevaTirada");
    let botonIniciarJuego = document.getElementById("iniciarJuego");
    let botonRendirse = document.getElementById("rendirse");
    let contenedorJuego = document.getElementById("contenedorJuego");
    let contenedorSelectOpciones = document.getElementById("contenedorSelectOpciones")
    let contenedorReal = document.createElement("div");
    contenedorReal.setAttribute("id","contenedorReal");

    mostrarElemento(botonNuevaTirada)
    mostrarElemento(botonRendirse)

    ocultarElemento(contenedorSelectOpciones)
    ocultarElemento(botonIniciarJuego)

    inicializarNumeros()
    ronda++
    
    let contenedorJugador = document.createElement("p");
    contenedorJugador.setAttribute("id","contenedorJugador");
    contenedorJugador.classList.add("jugador")

    let contenedorMaquina = document.createElement("p");
    contenedorMaquina.setAttribute("id","contenedorMaquina");
    contenedorMaquina.classList.add("maquina")

    contenedorReal.appendChild(contenedorJugador);
    contenedorReal.appendChild(contenedorMaquina);
    contenedorJuego.appendChild(contenedorReal)
    actualizarPantalla()
}

function nuevaTirada(){
    ronda++
    restaArray(jugador)
    restaArray(maquina)
    verificarFinal()
    actualizarPantalla();
}

function onChangeSelect(){
    valueOpciones = document.getElementById("selectOpciones").value;
    console.log(valueOpciones)
}

function restaArray(array) {
    for (let i = 0; i < array.length; i++) {
        if (array[i] === 0){
            continue;  
        } else{
            array[i]--;
            break;
        }
    }
}

function verificarFinal() {
    let contadorJugador = 0;
    let contadorMaquina = 0;

    for (let i = 0; i < jugador.length; i++) {
        if (jugador[i] === 0) {
            contadorJugador++;
        }
        if (maquina[i] === 0) {
            contadorMaquina++;
        }
    }

    console.log(contadorJugador, contadorMaquina);

    if (contadorJugador === parseInt(valueOpciones) && contadorMaquina === parseInt(valueOpciones)) {
        alert("¡Empate!");
        victorias++;
        derrotas++;
        ronda = 0;
        agregoAUltimasPartidas("empate")
        actualizarPantalla();
        reiniciarTablero();
        return; // DETIENE la función acá
    }

    if (contadorJugador === parseInt(valueOpciones)) {
        alert("¡Ganó el jugador!");
        victorias++;
        ronda = 0;
        agregoAUltimasPartidas("jugador")
        actualizarPantalla();
        reiniciarTablero();
        return; 
    }

    if (contadorMaquina === parseInt(valueOpciones)) {
        alert("¡Ganó la máquina!");
        derrotas++;
        ronda = 0;
        agregoAUltimasPartidas("maquina")
        actualizarPantalla();
        reiniciarTablero();
        return;
    }
}

function agregoAUltimasPartidas(ganador) {
    const fechaMomento = new Date().toLocaleString();
    ultimas5Partidas = getDato("ultimasPartidas") || [];

    const partida = {
        fecha: fechaMomento,
        ganador: ganador
    };

    ultimas5Partidas.unshift(partida);

    if (ultimas5Partidas.length > 5) {
        ultimas5Partidas.pop();
    }

    setDato("ultimasPartidas", ultimas5Partidas);
}

function actualizarPantalla(){
    
    let contenedorJugador = document.getElementById("contenedorJugador");
    let contenedorMaquina = document.getElementById("contenedorMaquina");

    let spanRonda = document.getElementById("spanRonda")
    let spanVictorias = document.getElementById("spanVictorias")
    let spanDerrotas = document.getElementById("spanDerrotas");
    let span5Partidas = document.getElementById("span5Partidas");

    let partidasAnteriores = document.querySelectorAll(".partidas")
    partidasAnteriores.forEach(elem =>{
        elem.remove()
    })

    for (let i = 0; i < ultimas5Partidas.length && i < 5; i++) {
        const partida = ultimas5Partidas[i];
        let parrafo = document.createElement("p");
        parrafo.classList.add("partidas")
        parrafo.textContent = `${i}- 🗓️ ${partida.fecha} — 🏆 ${partida.ganador}\n`
        span5Partidas.appendChild(parrafo);
    }
    
    spanVictorias.textContent = victorias;
    spanRonda.textContent = ronda;
    spanDerrotas.textContent = derrotas

    
    
    setDato("victorias",victorias);
    setDato("derrotas",derrotas);
    
    if(primeraVez){
        primeraVez = false;
        return
    }else{
        let parrafoJugador = document.createElement("p");
        let parrafoMaquina = document.createElement("p");
        
        parrafoJugador.textContent = jugador;
        parrafoMaquina.textContent = maquina
        contenedorJugador.appendChild(parrafoJugador);
        contenedorMaquina.appendChild(parrafoMaquina);
    }
    
    console.log(primeraVez)
}

function inicializarNumeros(){
    jugador = []
    maquina = []
    for(i=0; i<valueOpciones; i++){
        let randomNumJugador = Math.floor(Math.random() * 10);
        let randomNumMaquina = Math.floor(Math.random() * 10);
        jugador.push(randomNumJugador)
        maquina.push(randomNumMaquina)
    }
}

function rendirse(){
    alert("Te rendiste!, la victoria es de la maquina")
    derrotas++;
    ronda = 0;
    agregoAUltimasPartidas("maquina")
    actualizarPantalla();
    reiniciarTablero();
}

function reiniciarTablero(){
    let contenedorReal = document.getElementById("contenedorReal");
    let botonIniciarJuego = document.getElementById("iniciarJuego");
    let botonNuevaTirada = document.getElementById("nuevaTirada");
    let botonRendirse = document.getElementById("rendirse")

    ocultarElemento(botonNuevaTirada)
    ocultarElemento(botonRendirse)

    mostrarElemento(botonIniciarJuego)
    mostrarElemento(contenedorSelectOpciones)

    contenedorReal.remove();


}



//utils 
function ocultarElemento(elem) {
    elem.classList.add('oculto');
}

function mostrarElemento(elem) {
    elem.classList.remove('oculto');
}


function setDato(nombre, valor) {
    localStorage.setItem(nombre, JSON.stringify(valor));
}

function getDato(nombre) {
    const item = localStorage.getItem(nombre);
    return item ? JSON.parse(item) : null;
}
