// 🔤 Métodos de los Strings en JavaScript

// 📏 Métodos de longitud y extracción
let str = "Hola Mundo";

console.log(str.length);                // Propiedad que indica la cantidad de caracteres
console.log(str.charAt(1));            // Devuelve el carácter en la posición indicada
console.log(str.charCodeAt(1));        // Código UTF-16 del carácter en la posición dada
console.log(str.codePointAt(1));       // Código Unicode del carácter (soporta caracteres fuera del BMP)
console.log(str.slice(0, 4));          // Extrae una parte del string
console.log(str.substring(0, 4));      // Similar a slice pero no acepta índices negativos
console.log(str.substr(0, 4));         // Obsoleto, pero aún usable en algunos entornos
console.log(str.at(-1));               // Permite índices negativos para acceder desde el final

// 🔍 Métodos de búsqueda y verificación
console.log(str.indexOf("M"));         // Primera aparición
console.log(str.lastIndexOf("o"));     // Última aparición
console.log(str.includes("Mun"));      // true si contiene la subcadena
console.log(str.startsWith("Hola"));   // true si empieza con esa subcadena
console.log(str.endsWith("Mundo"));    // true si termina con esa subcadena
console.log(str.match(/o/g));          // Busca coincidencias con una expresión regular
console.log([...str.matchAll(/o/g)]);  // Retorna un iterador con todas las coincidencias

// 🔁 Métodos de modificación o creación de nuevos strings
console.log(str.concat("!!!"));        // Une varios strings
console.log(str.replace("Mundo", "ChatGPT"));    // Reemplaza una ocurrencia
console.log(str.replaceAll("o", "0"));           // Reemplaza todas
console.log(str.padStart(15, "*"));    // Añade caracteres al inicio
console.log(str.padEnd(15, "."));      // Añade caracteres al final
console.log(str.repeat(2));            // Repite el string
console.log(str.split(" "));           // Divide el string en un array

// 🔡 Métodos de transformación
console.log(str.toLowerCase());        // A minúsculas
console.log(str.toUpperCase());        // A mayúsculas
console.log(str.toLocaleLowerCase());  // Minúsculas con configuración regional
console.log(str.toLocaleUpperCase());  // Mayúsculas con configuración regional
console.log("  Hola  ".trim());        // Quita espacios al principio y al final
console.log("  Hola  ".trimStart());   // Quita espacios al inicio
console.log("  Hola  ".trimEnd());     // Quita espacios al final
console.log("café".normalize("NFD"));  // Normaliza caracteres Unicode

// 🧪 Otros métodos útiles
console.log(str.valueOf());            // Devuelve el valor primitivo del string
console.log(str.toString());           // Convierte un objeto a string
console.log("a".localeCompare("b"));   // Compara dos strings según el orden local
