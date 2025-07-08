<?php
class Servicio implements JsonSerializable{
    private $idServicio;
    private $ciudadOrigenServicio;
    private $ciudadDestinoServicio;
    private $horaSalidaServicio;
    private $horaLlegadaServicio;


    public function __construct(
        $idServicio,
        $ciudadOrigenServicio,
        $ciudadDestinoServicio,
        $horaSalidaServicio,
        $horaLlegadaServicio,
        ) {
        $this->idServicio = $idServicio;
        $this->ciudadOrigenServicio = $ciudadOrigenServicio;
        $this->ciudadDestinoServicio = $ciudadDestinoServicio;
        $this->horaSalidaServicio = $horaSalidaServicio;
        $this->horaLlegadaServicio = $horaLlegadaServicio;
    }

    //Serialiaze
        public function jsonSerialize(): mixed {
        return [
            'idServicio' => $this->idServicio,
            'ciudadOrigen' => $this->ciudadOrigenServicio,
            'ciudadDestino' => $this->ciudadDestinoServicio,
            'horaSalida' => $this->horaSalidaServicio,
            'horaLlegada' => $this->horaLlegadaServicio,
        ];
    }
}