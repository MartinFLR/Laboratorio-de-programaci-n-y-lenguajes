<?php
class Precios implements JsonSerializable  {
    private $id_producto;
    private $id_supermercado;
    private $precio;

    public function __construct(
        $id_producto,
        $id_supermercado,
        $precio
        ) {
        $this->id_producto = $id_producto;
        $this->id_supermercado = $id_supermercado;
        $this->precio = $precio;
    }

    //Serializable
    public function jsonSerialize(): mixed {
        return [
            'id_producto' => $this->id_producto,
            'id_supermercado'    => $this->id_supermercado,
            'pais'      => $this->precio
        ];
    }


    //Getters y setters
    public function getIdProducto(){
        return $this->id_producto;
    }
    public function getIdSupermercado(){
        return $this->id_supermercado;
    }
    public function getPrecio(){
        return $this->precio;
    }
}