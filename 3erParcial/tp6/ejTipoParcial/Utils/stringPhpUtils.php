<?php


function limpiar_espacios($str) {
    return preg_replace('/\s+/', ' ', trim($str));
}

function capitalizar($str) {
    return ucwords(strtolower(limpiar_espacios($str)));
}

function a_minusculas($str) {
    return strtolower(limpiar_espacios($str));
}

function a_mayusculas($str) {
    return strtoupper(limpiar_espacios($str));
}

function contiene($haystack, $needle) {
    return strpos($haystack, $needle) !== false;
}

function empieza_con($haystack, $needle) {
    return str_starts_with($haystack, $needle);
}

function termina_con($haystack, $needle) {
    return str_ends_with($haystack, $needle);
}

function truncar($str, $longitud = 100) {
    $str = limpiar_espacios($str);
    return strlen($str) > $longitud ? substr($str, 0, $longitud) . '...' : $str;
}

function generar_aleatorio($longitud = 10) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $resultado = '';
    for ($i = 0; $i < $longitud; $i++) {
        $resultado .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $resultado;
}

function sanitizar($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function esta_vacio($str) {
    return trim($str) === '';
}

// ==== FUNCIONES NUEVAS ====

// Cuenta la cantidad de letras (solo letras A-Z, sin contar espacios ni símbolos)
function contar_letras($str) {
    return preg_match_all('/[a-zA-ZáéíóúÁÉÍÓÚñÑ]/u', $str);
}

//Función para contar letras (incluye letras con acentos y letras no ASCII)
function contar_letrasTodas($str) {
    preg_match_all('/\p{L}/u', $str, $matches);
    return count($matches[0]);
}


// Cuenta la cantidad de palabras
function contar_palabras($str) {
    return str_word_count($str, 0, 'áéíóúÁÉÍÓÚñÑ');
}

// Cuenta la cantidad de caracteres (incluyendo espacios)
function contar_caracteres($str) {
    return strlen($str);
}

// Invierte el string
function invertir($str) {
    return strrev($str);
}

// Verifica si es palíndromo (sin importar mayúsculas o espacios)
function es_palindromo($str) {
    $str = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $str));
    return $str === strrev($str);
}

// Verifica si es numérico
function es_numerico($str) {
    return is_numeric($str);
}

// Reemplaza una palabra por otra (case-insensitive)
function reemplazar($buscar, $reemplazo, $str) {
    return str_ireplace($buscar, $reemplazo, $str);
}
