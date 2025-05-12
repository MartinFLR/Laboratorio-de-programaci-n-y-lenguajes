let palabraSeleccionada
let inputPalabra
let arrayPalabraSeleccionada = [];
let arrayParaMostrar = [];
let aciertosJugador = 0;
let pistasMostradas = 0;
let pistasRestantes = 3;  // Limita las pistas a un número determinado.

document.addEventListener("DOMContentLoaded", function () {
    let selectOpciones = document.getElementById("selectOpciones");
    let botonAdivinar = document.getElementById("botonAdivinar");

    //esto es para evitar undefined al principio
    palabraSeleccionada = seleccionarPalabraAleatoria(7)
    console.log(palabraSeleccionada)

    selectOpciones.addEventListener("change", function (event) {
        const opcionSeleccionada = selectOpciones.value;

        if (opcionSeleccionada === "7") {
            palabraSeleccionada = seleccionarPalabraAleatoria(7)
        } else if(opcionSeleccionada === "8"){
            palabraSeleccionada = seleccionarPalabraAleatoria(8)
        } else if(opcionSeleccionada === "10"){
            palabraSeleccionada = seleccionarPalabraAleatoria(10)
        }
        console.log(palabraSeleccionada)
    });

    botonAdivinar.addEventListener("click", function (event) {
        event.preventDefault();
        inputPalabra = document.getElementById("inputPalabra").value.trim();
        if(inputPalabra !== "") {
            comenzarPartida()
        }else{
            alert("Debes ingresar una letra o palabra")
        }
    })

})


function comenzarPartida() {
    const formOpciones = document.getElementById("formOpciones");
    const containerResultado = document.getElementById("containerResultado");
    formOpciones.style.display = "none";

    if (arrayPalabraSeleccionada.length === 0) {
        arrayPalabraSeleccionada = palabraSeleccionada.toLowerCase().split("");
        arrayParaMostrar = arrayPalabraSeleccionada.map(() => "_");
    }

    const arrayInputPalabra = inputPalabra.toLowerCase().split("");

    // Un Set es una estructura de datos que guarda valores únicos.
    // A diferencia de un array, no permite duplicados.
    const letrasUsadas = new Set();

    let aciertosEnEsteTurno = 0;  // Variable para contar aciertos en este turno

    arrayInputPalabra.forEach((letraInput) => {
        if (letrasUsadas.has(letraInput)) return; // Salta a la siguiente iteración si ya se ha analizado esta letra.
        letrasUsadas.add(letraInput);

        if (analisisLetraInput(letraInput)) {
            arrayPalabraSeleccionada.forEach((letraReal, i) => {
                if (letraReal === letraInput && arrayParaMostrar[i] === "_") {
                    arrayParaMostrar[i] = letraInput;
                    aciertosJugador++;
                    aciertosEnEsteTurno++;  // Se aumenta los aciertos de este turno
                }
            });
        } else {
            pistasMostradas++;
        }
    });

    // Solo mostrar una pista si no hubo aciertos en este turno
    if (aciertosEnEsteTurno === 0 && pistasRestantes > 0) {
        mostrarPista();
    }

    verificarFinPartida();
    containerResultado.innerHTML = arrayParaMostrar.join(" ");
}

// Función para mostrar una pista
function mostrarPista() {
    // Encuentra todas las posiciones donde la palabra aún tiene "_"
    const indicesDesconocidos = [];
    arrayParaMostrar.forEach((letra, index) => {
        if (letra === "_") {
            indicesDesconocidos.push(index);
        }
    });

    // Si hay letras desconocidas, elige una aleatoria para mostrar
    if (indicesDesconocidos.length > 0) {
        const indiceAleatorio = indicesDesconocidos[Math.floor(Math.random() * indicesDesconocidos.length)];
        const letraPista = arrayPalabraSeleccionada[indiceAleatorio];
        arrayParaMostrar[indiceAleatorio] = letraPista; // Reemplaza el "_" con la letra de la pista
        pistasRestantes--; // Disminuye la cantidad de pistas restantes
    }
}


function analisisLetraInput(letra) {
    return arrayPalabraSeleccionada.includes(letra);
}


function getDato(nombre) {
    return localStorage.getItem(nombre);
}
function setDato(nombre, value) {
    localStorage.setItem(nombre, value);
}

function seleccionarPalabraAleatoria(cantidadSeleccionada) {
    switch (cantidadSeleccionada){
        case 7:{
            let palabras = ["Gaviota","Informe","Revista","Esquema"];
            return palabras[Math.floor(Math.random() * palabras.length)];
        }
        case 8:{
            let palabras = ["Ambiente","Historia","Personas"];
            return palabras[Math.floor(Math.random() * palabras.length)];

        }
        case 10:{
            let palabras = ["Calendario","Transporte","Desarrollo"];
            return palabras[Math.floor(Math.random() * palabras.length)];
        }
    }
}

function verificarFinPartida() {
    // Compara si todos los elementos de arrayPalabraSeleccionada son iguales a los de arrayParaMostrar
    if (arrayPalabraSeleccionada.every((letra, index) => letra === arrayParaMostrar[index])) {
        ganoOPerdio(); // Llama a la función para manejar el resultado del juego
    }
}


function ganoOPerdio(){
    if (pistasMostradas > aciertosJugador){
        alert("Perdiste")
    }else if(pistasMostradas === aciertosJugador){
        alert("Empate")
    }else{
        alert("Ganaste")
    }
}