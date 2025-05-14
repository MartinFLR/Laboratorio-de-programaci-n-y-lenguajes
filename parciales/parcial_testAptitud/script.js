

document.addEventListener("DOMContentLoaded", function (){
    //Form data personal
    let nombreValue
    let edadValue
    let domicilioValue

    //Form preguntas
    let primeraPreguntaValue
    let segundaPreguntaValue
    let terceraPreguntaValue
    let CuartaPreguntaValue
    let quintaPreguntaValue

    //Botones inicializacion
    let botonComenzarTest = document.getElementById("comenzarButton")
    let botonFinalizarTest = document.getElementById("finalizarButton")


    botonComenzarTest.addEventListener("click",function(e){
        comenzarTest(e)
        let nombre = document.getElementById("nombre")
        let edad = document.getElementById("edad")
        let domicilio = document.getElementById("domicilio")
        nombreValue = nombre.value;
        edadValue = edad.value;
        domicilioValue = domicilio.value;

        console.log(nombreValue,edadValue,domicilioValue);
    });

    botonFinalizarTest.addEventListener("click",function(e){
        finalizarTest(e);

    })


})

function comenzarTest(e){
    e.preventDefault();
    let formDatosPersonales = document.getElementById("formDatosPersonales");
    let formPreguntas = document.getElementById("formPreguntas");

    formDatosPersonales.style.display = "none";
    formPreguntas.style.display = "block";
}


function finalizarTest(e){
    e.preventDefault();
    let formPreguntas = document.getElementById("formPreguntas");
    let resultado = document.getElementById("resultado")

    resultado.style.display = "block";
    formPreguntas.style.display = "none";



}