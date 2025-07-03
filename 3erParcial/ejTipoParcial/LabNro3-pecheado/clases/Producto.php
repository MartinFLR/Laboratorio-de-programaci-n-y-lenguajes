<?php
class Producto implements JsonSerializable  {
    private $id_producto;
    private $nombre;
    private $id_supermercado;
    private $precio;
    private $nombreSupermercado;
    private $ubicacionSupermercado;

    public function __construct(
        $id_producto,
        $nombre,
        $id_supermercado,
        $precio,
        $nombreSupermercado,
        $ubicacionSupermercado
        ) {
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->id_supermercado = $id_supermercado;
        $this->precio = $precio;
        $this->nombreSupermercado = $nombreSupermercado;
        $this->ubicacionSupermercado = $ubicacionSupermercado;
    }

    //Serializable
    public function jsonSerialize(): mixed {
        return [
            'id_producto' => $this->id_producto,
            'nombre'    => $this->nombre,
            'id_supermercado' => $this->id_supermercado,
            'precio'    => $this->precio,
            'nombreSupermercado' => $this->nombreSupermercado,
            'ubicacionSupermercado'    => $this->ubicacionSupermercado
        ];
    }


    //Getters y setters
    public function getIdProducto(){
        return $this->id_producto;
    }
    public function getNombre(){
        return $this->nombre;
    }

}