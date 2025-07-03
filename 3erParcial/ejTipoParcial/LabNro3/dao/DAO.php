<?php
require_once __DIR__ . '/../baseDatos.php';
require_once __DIR__ . '/../clases/Producto.php';

class DAO {

public static function buscarProductosPorParametro($texto){
 $conn = Database::getConnection();
     $stmt = $conn->prepare(
        "SELECT p.id_producto, p.nombre AS nombreProducto, pre.id_supermercado, pre.precio, s.nombre, s.ubicacion
        FROM producto AS p 
        JOIN precios as pre ON p.id_producto = pre.id_producto
        JOIN supermercado as s ON pre.id_supermercado = s.id_supermercado  
        WHERE p.nombre LIKE ?");
    
    $like = "%$texto%";
    $stmt->bind_param("s", $like);

    $stmt->execute();
    $result = $stmt->get_result();
    $productos = [];

    while ($row = $result->fetch_assoc()) {
    $producto = new Producto(
            $row['id_producto'],
            $row['nombreProducto'],
            $row['id_supermercado'],
            $row['precio'],
            $row['nombre'],
            $row['ubicacion'],
        );
        $productos[] = $producto;
    }

    return $productos;
}

public static function buscarProductosPorAmbos($textoProducto, $textoUbicacion){
 $conn = Database::getConnection();
     $stmt = $conn->prepare(
        "SELECT p.id_producto, p.nombre AS nombreProducto, pre.id_supermercado, pre.precio, s.nombre, s.ubicacion
        FROM producto AS p 
        JOIN precios as pre ON p.id_producto = pre.id_producto
        JOIN supermercado as s ON pre.id_supermercado = s.id_supermercado  
        WHERE p.nombre LIKE ? OR s.ubicacion LIKE ?");
    
    $like1 = "%$textoProducto%";
    $like2 = "%$textoUbicacion%";
    $stmt->bind_param("ss", $like1, $like2);

    $stmt->execute();
    $result = $stmt->get_result();
    $productos = [];

    while ($row = $result->fetch_assoc()) {
    $producto = new Producto(
            $row['id_producto'],
            $row['nombreProducto'],
            $row['id_supermercado'],
            $row['precio'],
            $row['nombre'],
            $row['ubicacion'],
        );
        $productos[] = $producto;
    }

    return $productos;
}


public static function buscarProductosPorUbicacion($texto){
 $conn = Database::getConnection();
     $stmt = $conn->prepare(
        "SELECT p.id_producto, p.nombre, pre.id_supermercado, pre.precio, s.nombre, s.ubicacion
        FROM producto AS p 
        JOIN precios as pre ON p.id_producto = pre.id_producto
        JOIN supermercado as s ON pre.id_supermercado = s.id_supermercado  
        WHERE s.ubicacion LIKE ?");
    
    $like = "%$texto%";
    $stmt->bind_param("s", $like);

    $stmt->execute();
    $result = $stmt->get_result();
    $productos = [];

    while ($row = $result->fetch_assoc()) {
    $producto = new Producto(
            $row['id_producto'],
            $row['nombre'],
            $row['id_supermercado'],
            $row['precio'],
            $row['nombre'],
            $row['ubicacion'],
        );
        $productos[] = $producto;
    }

    return $productos;
}


public static function buscarUbicacion(){
 $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT * FROM producto");
    $stmt->execute();
    $result = $stmt->get_result();
    $productos = [];

    while ($row = $result->fetch_assoc()) {
    $producto = new Producto(
            $row['id_producto'],
            $row['nombre'],
        );
        $productos[] = $producto;
    }

    return $productos;
}



}