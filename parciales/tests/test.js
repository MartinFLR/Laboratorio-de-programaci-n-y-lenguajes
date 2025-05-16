

document.addEventListener("DOMContentLoaded",function(){
    let texto = "pero";
    let parrafo = document.getElementById("test");

    matchAll(texto);
    match(texto);
})

function matchAll(texto){
    console.log("MATCH ALL");

    //Ejemplo de uso de matchAll con forOf
    //devuelve un iterador
    let iterador = texto.matchAll(/r/g)

    for (const elem of iterador) {
        console.log(elem[0])
    }


    //Ejemplo de uso de matchAll con array

    console.log("CON ARRAYS")
    let arrayIterador = Array.from(texto.matchAll(/r/g));
    arrayIterador.forEach((elem) => {
        console.log(elem[0])
    })
}

function match(texto){
    console.log("MATCH");

    //Ejemplo de uso de match
    //devuelve un array
    let array = texto.match(/r/g);

    if(!array){
        console.log("no hay coincidencias")
    }else{
        console.log(array)
    }
}

