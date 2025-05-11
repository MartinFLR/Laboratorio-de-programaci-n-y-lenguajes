function init(){
        const input = prompt("Ingrese un número entero:");
        const numero = parseInt(input);

        // Validación
        if (isNaN(numero)) {
            alert("Por favor, ingrese un número válido.");
            return;
        }

        // Verificar divisibilidad
        const divisores = [];
        // % calcula el resto de dividir numero entre 2, 3 y 5
        if (numero % 2 === 0) divisores.push(2);
        if (numero % 3 === 0) divisores.push(3);
        if (numero % 5 === 0) divisores.push(5);

        // Mostrar resultado
        const resultado = divisores.length > 0
            // El join crea una coma por cada elemento
            ? `✅ El número ${numero} es divisible por: ${divisores.join(', ')}.`
            : `❌ El número ${numero} no es divisible ni por 2, ni por 3, ni por 5.`;

        document.getElementById("resultado").textContent = resultado;
}