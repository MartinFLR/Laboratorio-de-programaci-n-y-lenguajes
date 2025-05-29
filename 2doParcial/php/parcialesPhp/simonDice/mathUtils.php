<?php
class MathUtils {

    // Promedio de un array de números
    public static function average(array $numbers): float {
        if (empty($numbers)) return 0;
        return array_sum($numbers) / count($numbers);
    }

    // Devuelve el mínimo de un array
    public static function min(array $numbers): float {
        return min($numbers);
    }

    // Devuelve el máximo de un array
    public static function max(array $numbers): float {
        return max($numbers);
    }

    // Verifica si es par
    public static function isEven(int $number): bool {
        return $number % 2 === 0;
    }

    // Verifica si es primo
    public static function isPrime(int $number): bool {
        if ($number <= 1) return false;
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i === 0) return false;
        }
        return true;
    }

    // Factorial (iterativo)
    public static function factorial(int $n): int {
        if ($n < 0) return 0;
        $result = 1;
        for ($i = 2; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }

    // Generar un número aleatorio entre min y max
    public static function random(int $min = 0, int $max = 100): int {
        return rand($min, $max);
    }

    // Redondeo con precisión
    public static function round(float $number, int $precision = 2): float {
        return round($number, $precision);
    }
}
