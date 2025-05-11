function init() {
    const input = prompt("Ingrese un número entero positivo:");
    const numero = parseInt(input);

    // Validación
    if (isNaN(numero) || numero < 0) {
        alert("Por favor, ingrese un número entero válido mayor o igual a 0.");
        return;
    }

    // Cálculo del factorial
    let factorial = 1;
    for (let i = 2; i <= numero; i++) {
        factorial *= i;
    }

    // Mostrar resultado
    document.getElementById("resultado").textContent = `El factorial de ${numero} es ${factorial}`;
}