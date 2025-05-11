function init(){
    const input = prompt("Ingrese un número entero positivo:");
    const numero = parseInt(input);

    // Validación
    if (isNaN(numero) || numero < 1) {
        alert("Por favor, ingrese un número entero mayor que 0.");
        return;
    }

    // Determinar si es primo
    let esPrimo = true;

    if (numero === 1) {
        esPrimo = false; // 1 no es primo
    } else {
        for (let i = 2; i <= Math.sqrt(numero); i++) {
            if (numero % i === 0) {
                esPrimo = false;
                break;
            }
        }
    }

    // Mostrar resultado
    const mensaje = esPrimo
        ? `✅ El número ${numero} es primo.`
        : `❌ El número ${numero} no es primo.`;

    document.getElementById("resultado").textContent = mensaje;
}
