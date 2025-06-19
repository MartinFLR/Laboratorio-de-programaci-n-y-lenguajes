<?php
// ayuda.php

// Datos para la conexión a la base de datos
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'chocolates';

// Crear conexión MySQLi (orientada a objetos)
$connection = new mysqli($host, $user, $pass, $db);

// Verificar si la conexión falló
if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}

// Título principal
echo "<h2>Ejemplos de funciones MySQLi</h2>";

/* 1. change_user
    Cambia el usuario y/o la base de datos en la conexión activa, sin cerrar la conexión.
    Útil para cambiar permisos o base sin reiniciar la conexión.
*/
echo "<h3>1. change_user()</h3>";

// Intentamos cambiar a usuario 'root', sin contraseña, y base 'information_schema' (base sistema)
if ($connection->change_user('root', '', 'information_schema')) {
    echo "Cambio de usuario/base de datos exitoso.<br>";
} else {
    // Si falla, mostrar error
    echo "Error al cambiar usuario/base: " . $connection->error . "<br>";
}

// Volvemos a la base original para seguir con otros ejemplos
$connection->change_user($user, $pass, $db);

/* 2. ping
    Verifica si la conexión con el servidor MySQL sigue activa.
    Si no está activa, intenta reconectarse automáticamente.
*/
echo "<h3>2. ping()</h3>";
if ($connection->ping()) {
    echo "La conexión está activa.<br>";
} else {
    echo "La conexión está caída.<br>";
}

/* 3. fetch_row
    Devuelve una fila del resultado como un array indexado numéricamente.
    Por ejemplo: [0 => valor_col1, 1 => valor_col2, ...]
*/
echo "<h3>3. fetch_row()</h3>";

// Ejecutamos una consulta que trae 1 producto
$result = $connection->query("SELECT descripcion, precio FROM productos LIMIT 1");

if ($result) {
    // Traemos la primera fila como array indexado
    $row = $result->fetch_row();

    if ($row) {
        echo "fetch_row devuelve array indexado: ";
        print_r($row);  // Mostrar el array
        echo "<br>";
    }
    $result->free(); // Liberar memoria del resultado
}

/* 4. fetch_assoc
    Devuelve una fila como un array asociativo, donde las claves son los nombres de las columnas.
    Por ejemplo: ['descripcion' => valor, 'precio' => valor]
*/
echo "<h3>4. fetch_assoc()</h3>";

$result = $connection->query("SELECT descripcion, precio FROM productos LIMIT 1");

if ($result) {
    // Traemos la primera fila como array asociativo
    $row = $result->fetch_assoc();

    if ($row) {
        echo "fetch_assoc devuelve array asociativo: ";
        print_r($row); // Mostrar el array
        echo "<br>";
    }
    $result->free();
}

/* 5. fetch_object
    Devuelve una fila como un objeto PHP.
    Los campos de la fila serán propiedades del objeto.
*/
echo "<h3>5. fetch_object()</h3>";

$result = $connection->query("SELECT descripcion, precio FROM productos LIMIT 1");

if ($result) {
    // Traemos la primera fila como objeto
    $obj = $result->fetch_object();

    if ($obj) {
        echo "fetch_object devuelve objeto con propiedades:<br>";
        echo "Descripción: " . $obj->descripcion . "<br>";
        echo "Precio: " . $obj->precio . "<br>";
    }
    $result->free();
}

/* 6. data_seek
    Permite mover el puntero del conjunto de resultados a una fila específica (basado en índice 0).
    Por ejemplo, para saltar a la fila 2, se usa data_seek(1).
*/
echo "<h3>6. data_seek()</h3>";

// Traemos 3 productos para poder movernos entre filas
$result = $connection->query("SELECT descripcion, precio FROM productos LIMIT 3");

if ($result) {
    // Movernos a la segunda fila (índice 1)
    if ($result->data_seek(1)) {
        // Traemos la fila actual (la segunda)
        $row = $result->fetch_assoc();

        echo "Fila 2 (índice 1) con data_seek: ";
        print_r($row); // Mostrar la fila
        echo "<br>";
    } else {
        echo "No se pudo posicionar en la fila 2.<br>";
    }
    $result->free();
}

// Cerramos la conexión
$connection->close();

?>
