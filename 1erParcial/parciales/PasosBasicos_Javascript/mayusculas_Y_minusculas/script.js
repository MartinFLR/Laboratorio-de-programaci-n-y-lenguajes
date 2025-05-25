function init() {
    const cadena = prompt("Hola, ingresa una palabra:");

    if (!cadena) {
        alert("No ingresaste ninguna palabra.");
        return;
    }

    //reemplaza todas las letras que no son del alfabeto por un espacio en blanco
    const soloLetras = cadena.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]/g, '');

    alert(soloLetras);

    if (soloLetras.length === 0) {
        alert("La cadena no contiene letras.");
        return;
    }

    if (soloLetras === soloLetras.toUpperCase()) {
        alert("La cadena contiene solo letras mayúsculas.");
    } else if (soloLetras === soloLetras.toLowerCase()) {
        alert("La cadena contiene solo letras minúsculas.");
    } else {
        alert("La cadena contiene una mezcla de mayúsculas y minúsculas.");
    }
}
