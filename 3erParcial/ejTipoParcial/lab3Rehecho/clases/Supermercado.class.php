<?php
class Supermercado implements JsonSerializable  {
    private $id;
    private $nombre;
    private $precio;
    private $ubicacion;


    public function __construct(
        $id,
        $nombre,
        $precio,
        $ubicacion,
        ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->ubicacion = $ubicacion;
    }

    //Serializable
    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'nombre'    => $this->nombre,
            'precio'      => $this->precio,
            'ubicacion'       => $this->ubicacion,
        ];
    }


    //Getters y setters
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getUbicacion(){
        return $this->ubicacion;
    }
}