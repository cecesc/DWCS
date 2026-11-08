<?php
/**
 * ==============================================================================
 * RESUMEN FUNCIONES PHP
 * ==============================================================================
 * 
 * 1. STRINGS:
 *    - strlen($texto)                 : Cuenta número de caracteres. -> https://www.php.net/manual/en/function.strlen.php
 *    - trim($texto)                   : Quita espacios al inicio y final. -> https://www.php.net/manual/en/function.trim.php
 *    - str_contains($texto)           : busca si la subcadena "x" está presente en el nombre del producto -> https://www.php.net/manual/en/function.str-contains.php
 * 
 * 2. ARRAYS (GESTIÓN):
 *    - count($array)                  : Cuenta elementos del array. -> https://www.php.net/manual/en/function.count.php
 *    - in_array($buscar, $array)      : Busca un valor (devuelve true/false). -> https://www.php.net/manual/en/function.in-array.php
 *    - array_values($array)           : Extrae solo los valores. -> https://www.php.net/manual/en/function.array-values.php
 *    - array_keys($array)             : Extrae solo las claves. -> https://www.php.net/manual/en/function.array-keys.php
 *    - array_unique($array)           : Elimina elementos repetidos. -> https://www.php.net/manual/en/function.array-unique.php
 * 
 * 3. ARRAYS (ORDENACIÓN):
 *    - sort($array)                   : Ordena valores de menor a mayor. -> https://www.php.net/manual/en/function.sort.php
 *    - asort($array)                  : Ordena por VALOR manteniendo claves. -> https://www.php.net/manual/en/function.asort.php
 *    - ksort($array)                  : Ordena por CLAVE. -> https://www.php.net/manual/en/function.ksort.php
 * 
 * 4. DEPURACIÓN:
 *    - print_r($variable)             : Imprime un array de forma legible. -> https://www.php.net/manual/en/function.print-r.php
 *    - var_dump($variable)            : Muestra tipo de dato, tamaño y contenido. -> https://www.php.net/manual/en/function.var-dump.php
 * 
 * 5. MATEMÁTICAS:
 *    - round($numero)                 : Redondea un decimal. -> https://www.php.net/manual/en/function.round.php
 *    - number_format($numero, ...)    : Formatea precios y números con decimales. -> https://www.php.net/manual/en/function.number-format.php
 * 
 * 6. SISTEMA / FORMULARIOS:
 *    - date($formato)                 : Obtiene la fecha/hora actual. -> https://www.php.net/manual/en/function.date.php
 *    - filter_input($tipo, $var, $f)  : Filtra y valida entradas del usuario (POST/GET). -> https://www.php.net/manual/en/function.filter-input.php
 * ==============================================================================
 */


// ==========================================
// 1. FUNCIONES DE STRINGS (CADENAS)
// ==========================================

/*
 * strlen()
 * Qué hace: Devuelve la longitud de una cadena (el número de caracteres).
 */
$texto = "Hola";
// echo strlen($texto); // Devuelve: 4

/*
 * trim()
 * Qué hace: Elimina los espacios en blanco (u otros caracteres) del inicio y del final.
 */
$espacios = "   Hola Mundo   ";
// echo trim($espacios); // Devuelve: "Hola Mundo"


// ==========================================
// 2. FUNCIONES DE ARRAYS
// ==========================================

/*
 * count()
 * Qué hace: Cuenta todos los elementos de un array.
 */
$frutas = ["Manzana", "Pera", "Plátano"];
// echo count($frutas); // Devuelve: 3

/*
 * in_array()
 * Qué hace: Comprueba si un valor existe dentro de un array (true/false).
 */
// if (in_array("Pera", $frutas)) { echo "¡Encontrada!"; }

/*
 * array_values()
 * Qué hace: Devuelve un nuevo array con todos los valores reindexados numéricamente.
 */
$asociativo = ["a" => "Perro", "b" => "Gato"];
// print_r(array_values($asociativo)); // [0 => "Perro", 1 => "Gato"]

/*
 * array_keys()
 * Qué hace: Devuelve todas las claves de un array.
 */
// print_r(array_keys($asociativo)); // [0 => "a", 1 => "b"]

/*
 * array_unique()
 * Qué hace: Elimina los valores duplicados de un array.
 */
$numeros = [1, 2, 2, 3, 4, 4];
// print_r(array_unique($numeros)); // [1, 2, 3, 4]


// ==========================================
// 3. FUNCIONES DE ORDENAMIENTO DE ARRAYS
// ==========================================

/*
 * sort()
 * Qué hace: Ordena un array de menor a mayor (reasigna índices 0, 1, 2...).
 */
$edades = [25, 10, 30];
sort($edades); 
// print_r($edades); // [10, 25, 30]

/*
 * asort()
 * Qué hace: Ordena por VALOR de menor a mayor, manteniendo las claves asociativas.
 */
$edadesAsoc = ["Ana" => 25, "Luis" => 10];
asort($edadesAsoc); 
// print_r($edadesAsoc); // ["Luis" => 10, "Ana" => 25]

/*
 * ksort()
 * Qué hace: Ordena por CLAVE (nombre de la clave) de menor a mayor.
 */
ksort($edadesAsoc); 
// print_r($edadesAsoc); // ["Ana" => 25, "Luis" => 10]


// ==========================================
// 4. FUNCIONES DE DEPURACIÓN
// ==========================================

/*
 * print_r()
 * Qué hace: Muestra la información de una variable o array de forma clara.
 */
// print_r($frutas);

/*
 * var_dump()
 * Qué hace: Muestra información detallada (tipo de dato, longitud y valor).
 */
// var_dump($frutas);


// ==========================================
// 5. FUNCIONES MATEMÁTICAS Y NÚMEROS
// ==========================================

/*
 * round()
 * Qué hace: Redondea un número flotante (decimal).
 */
// echo round(3.75); // Devuelve: 4

/*
 * number_format()
 * Qué hace: Formatea un número con decimales y separadores de millares.
 */
// echo number_format(1234.567, 2, ',', '.'); // Devuelve: "1.234,57"


// ==========================================
// 6. FECHAS Y FORMULARIOS
// ==========================================

/*
 * date()
 * Qué hace: Formatea la fecha y hora actual del servidor.
 */
// echo date('d/m/Y'); // Muestra la fecha actual (ej: 14/09/2026)

/*
 * filter_input()
 * Qué hace: Obtiene una variable externa (POST/GET) y la valida o sanitiza.
 */
// $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

?>