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

function resultadoPartida(pistasMostradas,aciertosJugador){
    if (pistasMostradas > aciertosJugador){
        alert("Perdiste")
    }else if(pistasMostradas === aciertosJugador){
        alert("Empate")
    }else{
        alert("Ganaste")
    }
}

function comenzarPartida(){
    let formOpciones = document.getElementById("formOpciones");
    formOpciones.style.display = "none";


}

document.addEventListener("DOMContentLoaded", function () {
    let selectOpciones = document.getElementById("selectOpciones");
    let inputPalabra = document.getElementById("inputPalabra");
    let botonAdivinar = document.getElementById("botonAdivinar")
    let palabraSeleccionada
    let pistasMostradas, aciertosJugador;

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

    botonAdivinar.addEventListener("submit", function (event) {
        event.preventDefault();
        comenzarPartida()
    })

})