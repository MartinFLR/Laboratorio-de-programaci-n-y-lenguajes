let cantPartidas;

document.addEventListener("DOMContentLoaded",function(){
    let botonIniciar = document.getElementById("botonIniciar");

    botonIniciar.addEventListener("click",iniciarJuego);

})

function iniciarJuego(){
    let contenedorBotones = document.getElementById("contenedorBotones");    
    contenedorBotones.style.display = "none";

    iniciarTablero();
}

function iniciarTablero(){
    let arrayPalabra1Split = "pato".split("")
    let arrayPalabra2Split = "onda".split("")
    let arrayPalabra3Split = "gato".split("")
    let arrayPalabra4Split = "mapa".split("");

    let contenedorJuego = document.getElementById("contenedorJuego");
    
    let contadori3 = 0;
    let contadori7 = 0;
    let contadori10 = 0;
    for(i=0; i<16; i++){
        let celda = document.createElement("div");
        celda.classList.add("celda")
        console.log(i);
        if(i<4){
                console.log("toyaca")
                celda.textContent = arrayPalabra1Split[i]
            }else if(i>3 && i<8){
                celda.textContent = arrayPalabra2Split[contadori3]
                contadori3++;
            }else if(i>7 && i<12){
                celda.textContent = arrayPalabra3Split[contadori7]
                contadori7++;
            }else if(i>10){
                celda.textContent = arrayPalabra4Split[contadori10]
                contadori10++;
            }

            contenedorJuego.appendChild(celda)
        }


    }
