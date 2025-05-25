function agregarCampos(nombres) {
    const formulario = document.getElementById("miFormulario");
    const boton = formulario.querySelector("button");

    nombres.forEach(nombre => {
        const label = document.createElement("label");
        label.textContent = nombre + ":";

        const input = document.createElement("input");
        input.type = "text";
        input.name = nombre.toLowerCase(); // Ej: 'Nombre' -> 'nombre'

        formulario.insertBefore(label, boton);
        formulario.insertBefore(input, boton);
    });

    // Evento submit para capturar los valores
    formulario.addEventListener("submit", function (e) {
        e.preventDefault(); // Evita que se recargue la página

        nombres.forEach(nombre => {
            const valor = formulario.elements[nombre.toLowerCase()].value;
            console.log(`${nombre}: ${valor}`);
        });
    });
}

// Llamamos a la función con un array de campos deseados
agregarCampos(['Nombre', 'Email', 'Edad']);