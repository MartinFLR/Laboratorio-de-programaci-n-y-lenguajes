function init(){
    const entrada = prompt("Ingrese un número entero:");
    const numero = parseInt(entrada);

    if (isNaN(numero)) {
        alert("Por favor, ingrese un número válido.");
        return;
    }

    const esPar = numero % 2 === 0;

    const mensaje = esPar
        ? `✅ El número ${numero} es PAR.`
        : `🔢 El número ${numero} es IMPAR.`;

    document.getElementById("resultado").textContent = mensaje;
}