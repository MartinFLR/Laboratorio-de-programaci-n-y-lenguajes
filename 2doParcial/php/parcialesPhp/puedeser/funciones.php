<?php

function esCentroNumerico($n) {
    $sumaIzq = 0;
    for ($i = 1; $i < $n; $i++) {
        $sumaIzq += $i;
    }

    $sumaDer = 0;
    $i = $n + 1;
    while ($sumaDer < $sumaIzq) {
        $sumaDer += $i;
        $i++;
    }

    return $sumaIzq == $sumaDer;
}

//Número abundante / deficiente / perfecto – Comparación con suma de divisores.
function esPerfecto($n) {
    $suma = 0;
    for ($i = 1; $i < $n; $i++) {
        if ($n % $i == 0) $suma += $i;
    }
    return $suma == $n;
}

echo esPerfecto(28) ? "Perfecto" : "No perfecto";




function esPrimo($n) {
    if ($n <= 1) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

echo esPrimo(17) ? "Primo" : "No primo";



function esCapicua($n) {
    return strval($n) === strrev($n);
}

echo esCapicua(12321) ? "Capicúa" : "No capicúa";



function esPalindromoBinario($n) {
    $bin = decbin($n);
    return $bin === strrev($bin);
}

// Ejemplo
echo esPalindromoBinario(9) ? "Sí" : "No"; // Sí (1001)



function esHarshad($n) {
    $suma = array_sum(str_split($n));
    return $n % $suma === 0;
}

echo esHarshad(18) ? "Sí" : "No"; // Sí





//Número amigo – Dos números que son suma de los divisores del otro.
function sumaDivisores($n) {
    $suma = 0;
    for ($i = 1; $i < $n; $i++) {
        if ($n % $i == 0) $suma += $i;
    }
    return $suma;
}

function sonAmigos($a, $b) {
    return sumaDivisores($a) == $b && sumaDivisores($b) == $a;
}

echo sonAmigos(220, 284) ? "Son amigos" : "No son amigos";


//Número Curioso (eliminar un dígito, sigue siendo primo)
function esCurioso($n) {
    $str = strval($n);
    $len = strlen($str);

    for ($i = 0; $i < $len; $i++) {
        $nuevo = substr($str, 0, $i) . substr($str, $i + 1);
        if ($nuevo && esPrimo(intval($nuevo))) return true;
    }

    return false;
}

echo esCurioso(137) ? "Sí" : "No"; // 17 es primo




function tipoNumero($n) {
    $suma = 0;
    for ($i = 1; $i < $n; $i++) {
        if ($n % $i == 0) $suma += $i;
    }

    if ($suma == $n) return "Perfecto";
    elseif ($suma > $n) return "Abundante";
    else return "Deficiente";
}

echo tipoNumero(12); // Ej: Abundante



//Número automórfico – Su cuadrado termina en él mismo.
function esAutomorfico($n) {
    $cuadrado = $n * $n;
    return str_ends_with(strval($cuadrado), strval($n));
}

echo esAutomorfico(76) ? "Automórfico" : "No automórfico";


//Número feliz – Repetir suma de cuadrados de dígitos hasta llegar a 1 o ciclo.
function esFeliz($n) {
    $vistos = [];
    while ($n != 1 && !in_array($n, $vistos)) {
        $vistos[] = $n;
        $n = sumaCuadradosDigitos($n);
    }
    return $n == 1;
}

function sumaCuadradosDigitos($n) {
    $suma = 0;
    while ($n > 0) {
        $d = $n % 10;
        $suma += $d * $d;
        $n = intdiv($n, 10);
    }
    return $suma;
}

echo esFeliz(19) ? "Feliz" : "Infeliz";


function esNarcisista($n) {
    $str = strval($n);
    $digitos = strlen($str);
    $suma = 0;
    foreach (str_split($str) as $d) {
        $suma += pow(intval($d), $digitos);
    }
    return $suma == $n;
}

echo esNarcisista(153) ? "Narcisista" : "No lo es";




//Suma de dígitos – Total de la suma de todos los dígitos de un número.
function sumaDigitos($n) {
    $suma = 0;
    foreach (str_split(strval($n)) as $d) {
        $suma += intval($d);
    }
    return $suma;
}

echo "Suma de dígitos de 12345 = " . sumaDigitos(12345);





//Matrices
//Verificar Sudoku (9x9): reglas básicas
function esSudokuValido(array $tablero) {
    for ($i = 0; $i < 9; $i++) {
        $fila = $col = [];

        for ($j = 0; $j < 9; $j++) {
            $fila[] = $tablero[$i][$j];
            $col[] = $tablero[$j][$i];
        }

        if (!valido($fila) || !valido($col)) return false;
    }

    // Validar subcuadrantes 3x3
    for ($fila = 0; $fila < 9; $fila += 3) {
        for ($col = 0; $col < 9; $col += 3) {
            $bloque = [];
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    $bloque[] = $tablero[$fila + $i][$col + $j];
                }
            }
            if (!valido($bloque)) return false;
        }
    }

    return true;
}

function valido(array $grupo) {
    $grupo = array_filter($grupo); // eliminamos ceros (vacíos)
    return count($grupo) === count(array_unique($grupo));
}



//Suma diagonales
function sumaDiagonales(array $matriz) {
    $n = count($matriz);
    $sumaPrincipal = $sumaSecundaria = 0;

    for ($i = 0; $i < $n; $i++) {
        $sumaPrincipal += $matriz[$i][$i];
        $sumaSecundaria += $matriz[$i][$n - 1 - $i];
    }

    return ["principal" => $sumaPrincipal, "secundaria" => $sumaSecundaria];
}



//transposicion matriz
function transponerMatriz(array $matriz) {
    $filas = count($matriz);
    $columnas = count($matriz[0]);
    $transpuesta = [];

    for ($i = 0; $i < $columnas; $i++) {
        for ($j = 0; $j < $filas; $j++) {
            $transpuesta[$i][$j] = $matriz[$j][$i];
        }
    }

    return $transpuesta;
}


//Elemento mayor y menor de una matriz
function mayorYMenor(array $matriz) {
    $mayor = PHP_INT_MIN;
    $menor = PHP_INT_MAX;

    foreach ($matriz as $fila) {
        foreach ($fila as $valor) {
            if ($valor > $mayor) $mayor = $valor;
            if ($valor < $menor) $menor = $valor;
        }
    }

    return ["mayor" => $mayor, "menor" => $menor];
}


//Matriz identidad
function esIdentidad(array $matriz) {
    $n = count($matriz);
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            if ($i == $j && $matriz[$i][$j] != 1) return false;
            if ($i != $j && $matriz[$i][$j] != 0) return false;
        }
    }
    return true;
}


//Es simetrica
function esSimetrica(array $matriz) {
    $n = count($matriz);
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            if ($matriz[$i][$j] !== $matriz[$j][$i]) return false;
        }
    }
    return true;
}


//cuadrado magico
function esMagica(array $matriz) {
    $n = count($matriz);
    $sumaObjetivo = array_sum($matriz[0]);

    // Filas y columnas
    for ($i = 0; $i < $n; $i++) {
        if (array_sum($matriz[$i]) != $sumaObjetivo) return false;

        $sumaCol = 0;
        for ($j = 0; $j < $n; $j++) {
            $sumaCol += $matriz[$j][$i];
        }
        if ($sumaCol != $sumaObjetivo) return false;
    }

    // Diagonales
    $diag1 = $diag2 = 0;
    for ($i = 0; $i < $n; $i++) {
        $diag1 += $matriz[$i][$i];
        $diag2 += $matriz[$i][$n - $i - 1];
    }

    return $diag1 == $sumaObjetivo && $diag2 == $sumaObjetivo;
}





// SERIES

function serieFibonacci($cantidad) {
    $fibo = [0, 1];
    for ($i = 2; $i < $cantidad; $i++) {
        $fibo[] = $fibo[$i - 1] + $fibo[$i - 2];
    }
    return array_slice($fibo, 0, $cantidad);
}

print_r(serieFibonacci(10)); // [0, 1, 1, 2, 3, 5, 8, 13, 21, 34]


function serieFactoriales($hasta) {
    $resultado = [];
    $fact = 1;

    for ($i = 1; $i <= $hasta; $i++) {
        $fact *= $i;
        $resultado[] = $fact;
    }

    return $resultado;
}

print_r(serieFactoriales(6)); // [1, 2, 6, 24, 120, 720]



function serieAritmetica($a1, $r, $n) {
    $serie = [];
    for ($i = 0; $i < $n; $i++) {
        $serie[] = $a1 + $i * $r;
    }
    return $serie;
}

print_r(serieAritmetica(2, 3, 5)); // [2, 5, 8, 11, 14]


function serieGeometrica($a1, $r, $n) {
    $serie = [];
    for ($i = 0; $i < $n; $i++) {
        $serie[] = $a1 * pow($r, $i);
    }
    return $serie;
}

print_r(serieGeometrica(2, 3, 5)); // [2, 6, 18, 54, 162]



function sucesionCollatz($n) {
    $secuencia = [$n];
    while ($n != 1) {
        if ($n % 2 == 0) {
            $n = $n / 2;
        } else {
            $n = 3 * $n + 1;
        }
        $secuencia[] = $n;
    }
    return $secuencia;
}

print_r(sucesionCollatz(7)); // [7, 22, 11, 34, 17, 52, ..., 1]




function cribaEratostenes($limite) {
    $primos = array_fill(0, $limite + 1, true);
    $primos[0] = $primos[1] = false;

    for ($i = 2; $i * $i <= $limite; $i++) {
        if ($primos[$i]) {
            for ($j = $i * $i; $j <= $limite; $j += $i) {
                $primos[$j] = false;
            }
        }
    }

    $resultado = [];
    foreach ($primos as $i => $esPrimo) {
        if ($esPrimo) $resultado[] = $i;
    }

    return $resultado;
}

print_r(cribaEratostenes(50)); // [2, 3, 5, 7, 11, ..., 47]
