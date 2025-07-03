<?php
class Producto implements JsonSerializable  {
    private $id_producto;
    private $nombre;
    private $precio;
    private $id_supermercado;
    private $nombreSupermercado;
    private $ubicacionSupermercado;


    public function __construct(
        $id_producto,
        $nombre,
        $precio,
        $id_supermercado,
        $nombreSupermercado,
        $ubicacionSupermercado
        ) {
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->id_supermercado = $id_supermercado;
        $this->nombreSupermercado = $nombreSupermercado;
        $this->ubicacionSupermercado = $ubicacionSupermercado;
    }

    //Serializable
    public function jsonSerialize(): mixed {
        return [
            'id_producto' => $this->id_producto,
            'nombre'    => $this->nombre,
            'precio'      => $this->precio,
            'id_supermercado'       => $this->id_supermercado,
            'nombreSupermercado'      => $this->nombreSupermercado,
            'ubicacionSupermercado' => $this->ubicacionSupermercado,
        ];
    }


    //Getters y setters
    public function getIdProducto(){
        return $this->id_producto;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getIdSupermercado(){
        return $this->id_supermercado;
    }
    public function getNombreSupermercado(){
        return $this->nombreSupermercado;
    }
    public function getNbicacionSupermercado(){
        return $this->ubicacionSupermercado;
    }
}