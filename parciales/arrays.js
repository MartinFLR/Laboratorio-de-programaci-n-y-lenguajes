//El método map() se utiliza para transformar los elementos de un array,
// creando un nuevo array con los resultados.
// Ejemplo de map()
let numeros = [1, 2, 3, 4];
let dobles = numeros.map(x => x * 2);
console.log("map():", dobles);  // [2, 4, 6, 8]

//filter() se utiliza para crear un nuevo array con todos los elementos que pasen una condición.
// Ejemplo de filter()
let numerosFiltrados = numeros.filter(x => x % 2 === 0);
console.log("filter():", numerosFiltrados);  // [2, 4]

//reduce() permite reducir un array a un único valor, aplicando una función de acumulación.
// Ejemplo de reduce()
let suma = numeros.reduce((acumulador, valor) => acumulador + valor, 0);
console.log("reduce():", suma);  // 10

//forEach() itera sobre todos los elementos de un array, pero no retorna nada (no crea un nuevo array).
// Ejemplo de forEach()
numeros.forEach(x => console.log("forEach():", x * 2));
// 2
// 4
// 6
// 8

//find() busca el primer elemento que cumpla con una condición y lo devuelve.
// Si no lo encuentra, retorna undefined.
// Ejemplo de find()
let mayorQueDos = numeros.find(x => x > 2);
console.log("find():", mayorQueDos);  // 3


//some() verifica si al menos un elemento en el array cumple con una condición.
// Ejemplo de some()
let tienePar = numeros.some(x => x % 2 === 0);
console.log("some():", tienePar);  // true

//every() verifica si todos los elementos cumplen con una condición.
// Ejemplo de every()
let todosPares = numeros.every(x => x % 2 === 0);
console.log("every():", todosPares);  // false

//includes() verifica si un array contiene un valor determinado, retornando true o false.
// Ejemplo de includes()
console.log("includes():", numeros.includes(3));  // true
console.log("includes():", numeros.includes(5));  // false

//sort() ordena los elementos de un array.
// Tienes que tener cuidado porque sort() lo hace como si fueran cadenas de texto por defect
// Ejemplo de sort()
let numerosDesordenados = [5, 2, 8, 1, 4];
numerosDesordenados.sort();
console.log("sort() (por defecto):", numerosDesordenados);  // [1, 2, 4, 5, 8]

//// Para ordenar de manera correcta (de menor a mayor numérico)
let numerosOrdenados = [5, 2, 8, 1, 4];
numerosOrdenados.sort((a, b) => a - b);
console.log("sort() (numérico):", numerosOrdenados);  // [1, 2, 4, 5, 8]

//concat() se utiliza para combinar dos o más arrays en uno solo.
// Ejemplo de concat()
let arr1 = [1, 2];
let arr2 = [3, 4];
let combinado = arr1.concat(arr2);
console.log("concat():", combinado);  // [1, 2, 3, 4]

//splice() cambia el contenido de un array eliminando, reemplazando o agregando elementos.
// Ejemplo de splice()
let frutas = ["manzana", "plátano", "cereza"];
frutas.splice(1, 1, "naranja");  // Elimina el índice 1 y agrega "naranja"
console.log("splice():", frutas);  // ["manzana", "naranja", "cereza"]


//slice() devuelve una copia superficial de una porción de un array (sin modificar el original).
// Ejemplo de slice()
let algunasFrutas = frutas.slice(1, 3);
console.log("slice():", algunasFrutas);  // ["naranja", "cereza"]

//join() une todos los elementos de un array en una cadena de texto.
// Ejemplo de join()
let frutasJoin = frutas.join(", ");
console.log("join():", frutasJoin);  // "manzana, naranja, cereza"

//reverse() invierte el orden de los elementos en un array.
// Ejemplo de reverse()
let numerosRevertidos = [1, 2, 3, 4];
numerosRevertidos.reverse();
console.log("reverse():", numerosRevertidos);  // [4, 3, 2, 1]

// Ejemplo de desestructuración en arrays
let colores = ["rojo", "verde", "azul"];
let [primero, segundo] = colores;
console.log("Desestructuración:", primero, segundo);  // "rojo", "verde"



//Métodos de Array para Crear Nuevos Arrays

// Ejemplo de from()
let texto = "Hola";
let arrTexto = Array.from(texto);
console.log("from():", arrTexto);  // ["H", "o", "l", "a"]

// Ejemplo de fill()
let arrRellenado = new Array(5).fill(0);
console.log("fill():", arrRellenado);  // [0, 0, 0, 0, 0]





// Combinando métodos: Filtrar y mapear
const usuarios = [
    { nombre: "Juan", edad: 25 },
    { nombre: "Ana", edad: 17 },
    { nombre: "Luis", edad: 20 }
];

const mayoresDeEdad = usuarios.filter(u => u.edad > 18).map(u => u.nombre);
console.log("Filtrar y mapear:", mayoresDeEdad);  // ["Juan", "Luis"]

// Combinando métodos: Filtrar, reducir
let numerosPositivos = [1, -2, 3, 4, -1];
let sumaPositiva = numerosPositivos.filter(x => x > 0).reduce((acc, num) => acc + num, 0);
console.log("Filtrar y reducir:", sumaPositiva);  // 8

// Combinando métodos: Ordenar y seleccionar
const productos = [
    { nombre: "Camiseta", precio: 20 },
    { nombre: "Pantalón", precio: 50 },
    { nombre: "Zapatos", precio: 30 }
];

const productoBarato = productos.sort((a, b) => a.precio - b.precio)[0];
console.log("Ordenar y seleccionar:", productoBarato);  // { nombre: "Camiseta", precio: 20 }

//Otros utiles pero no de arrays
//split() Convierte un string en un array, dividiéndolo por un separador.
// Separar por espacios
"Hola mundo JS".split(" ");  // ["Hola", "mundo", "JS"]

// Convertir una frase en caracteres
"abc".split("");  // ["a", "b", "c"]

// Dividir por saltos de línea
"línea1\nlínea2\nlínea3".split("\n");  // ["línea1", "línea2", "línea3"]

// Limitar cuántas divisiones hace
"1-2-3-4".split("-", 2);  // ["1", "2"]
