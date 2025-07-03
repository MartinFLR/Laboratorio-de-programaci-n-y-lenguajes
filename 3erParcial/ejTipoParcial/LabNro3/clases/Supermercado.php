<?php
class Supermercado implements JsonSerializable  {
    private $id_supermercado;
    private $nombre;
    private $ubicacion;

    public function __construct(
        $id_supermercado,
        $nombre,
        $ubicacion
        ) {
        $this->id_supermercado = $id_supermercado;
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
    }

    //Serializable
    public function jsonSerialize(): mixed {
        return [
            'id_supermercado' => $this->id_supermercado,
            'nombre'    => $this->nombre,
            'ubicacion'      => $this->ubicacion
        ];
    }


    //Getters y setters
    public function getIdSupermercado(){
        return $this->id_supermercado;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getUbicacion(){
        return $this->ubicacion;
    }
}