<?php
class ArrayUtils {

    // Devuelve un valor aleatorio del array o null si está vacío
    public static function randomValue(array $arr) {
        if (empty($arr)) {
            return null;
        }
        return $arr[array_rand($arr)];
    }

    // Elimina la primera ocurrencia de un valor y reindexa el array
    public static function removeValue(array $arr, $value): array {
        $key = array_search($value, $arr, true);
        if ($key !== false) {
            unset($arr[$key]);
            $arr = array_values($arr); // Reindexar claves
        }
        return $arr;
    }

    public static function toString(array $arr): string {
        return implode("-", $arr);
    }


    //Promedio de valores numéricos
    public static function average(array $arr): float {
    if (empty($arr)) return 0;
    return array_sum($arr) / count($arr);
}


    public static function maxValue(array $arr) {
        return empty($arr) ? null : max($arr);
    }

    public static function minValue(array $arr) {
        return empty($arr) ? null : min($arr);
    }



    //Agrupa elementos por un criterio dado, devolviendo un array con claves según el criterio. Muy útil para clasificar datos.
    public static function groupBy(array $arr, callable $callback): array {
        $result = [];
        foreach ($arr as $item) {
            $key = $callback($item);
            $result[$key][] = $item;
        }
        return $result;
    }
    

    // Verifica si un valor existe en el array
    public static function contains(array $arr, $value): bool {
        return in_array($value, $arr, true);
    }

    // Cuenta cuántas veces aparece un valor
    public static function countOccurrences(array $arr, $value): int {
        return count(array_filter($arr, fn($v) => $v === $value));
    }

    // Elimina duplicados
    public static function unique(array $arr): array {
        return array_values(array_unique($arr));
    }

    // Ordena de menor a mayor
    public static function sortAsc(array $arr): array {
        sort($arr);
        return $arr;
    }

    // Ordena de mayor a menor
    public static function sortDesc(array $arr): array {
        rsort($arr);
        return $arr;
    }

    // Devuelve la suma total
    public static function sum(array $arr): float {
        return array_sum($arr);
    }

    // Devuelve el primer valor o null si está vacío
    public static function first(array $arr) {
    if (empty($arr)) return null;
    return $arr[array_key_first($arr)];
    }

    // Devuelve el último valor o null si está vacío
    public static function last(array $arr) {
        return empty($arr) ? null : $arr[array_key_last($arr)];
    }

    // Filtra los valores numéricos
    public static function filterNumeric(array $arr): array {
        return array_filter($arr, 'is_numeric');
    }

    // Devuelve los valores mayores a un número dado
    public static function filterGreaterThan(array $arr, float $threshold): array {
        return array_filter($arr, fn($value) => $value > $threshold);
    }
}
