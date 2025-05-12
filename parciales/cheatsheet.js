// Métodos comunes de Array
let arr = [1, 2, 3, 4, 5];

arr.push(6);      // Agregar al final
arr.pop();        // Eliminar del final
arr.shift();      // Eliminar del inicio
arr.unshift(0);   // Agregar al inicio

// Mapear un array
let nuevoArr = arr.map(x => x * 2);  // [2, 4, 6, 8, 10]

let filtroArr = arr.filter(x => x > 2);  // [3, 4, 5]



// Spread (expande elementos de un array o objeto)
const arr1 = [1, 2];
const arr2 = [...arr1, 3, 4];  // [1, 2, 3, 4]

const persona = { nombre: "Juan", edad: 30 };
const nuevaPersona = { ...persona, ciudad: "Comodoro" };

// Rest (captura elementos)
const [primero, ...resto] = [1, 2, 3, 4];  // primero = 1, resto = [2, 3, 4]




// Set (sin duplicados)
let conjunto = new Set([1, 2, 3, 4, 4]);
console.log(conjunto);  // Set { 1, 2, 3, 4 }

// Map (pares clave-valor)
let mapa = new Map();
mapa.set('nombre', 'Juan');
mapa.set('edad', 30);
console.log(mapa.get('nombre'));  // "Juan"


let texto = "Hola Mundo";
console.log(texto.toUpperCase());    // "HOLA MUNDO"
console.log(texto.toLowerCase());    // "hola mundo"
console.log(texto.includes("Mundo"));  // true
console.log(texto.slice(0, 4));      // "Hola"
