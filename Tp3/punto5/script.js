document.getElementById("formulario").addEventListener("submit", function(e) {
    e.preventDefault();

    // Obtenemos la frase ingresada
    //trim para eliminar espacios en blancos al principio y al final
    const frase = document.getElementById("frase").value.trim();

    // Verificamos que la frase tenga al menos 3 palabras
    //split divide la cadena frase en un array de palabras, usando el espacio " " como separador
    //me quedaria por ejemplo ["hola","soy","martin"]-> usando el "" como caracter o patron de separacion
    // de forma sencilla, en donde encuentre un " " va a cortar ahi y meterlo a un array
    if (frase.split(" ").length < 3) {
        alert("La frase debe tener al menos 3 palabras.");
        return;
    }

    // a) Longitud de la frase (cantidad de caracteres)
    const longitud = frase.length;

    // b) La frase en mayúsculas
    const mayusculas = frase.toUpperCase();

    // c) La cantidad de veces que se repite la letra "a"
    const letraA = (frase.match(/a/gi) || []).length;

    // d) La frase invertida
    const fraseInvertida = frase.split("").reverse().join("");

    // Mostrar los resultados
    const resultadoHTML = `
        <h3>Resultados:</h3>
        <p><strong>Longitud de la frase:</strong> ${longitud} caracteres</p>
        <p><strong>Frase en mayúsculas:</strong> ${mayusculas}</p>
        <p><strong>Cantidad de veces que se repite la letra "a":</strong> ${letraA}</p>
        <p><strong>Frase invertida:</strong> ${fraseInvertida}</p>
    `;

    document.getElementById("resultado").innerHTML = resultadoHTML;
});
