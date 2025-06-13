<?php

class Jugador {
    private string $nombre;
    private int $puntaje;
    private int $intentos;
    private array $numerosIngresados;
    private bool $rendido;

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
        $this->puntaje = 10;
        $this->intentos = 0;
        $this->numerosIngresados = [];
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getPuntaje(): int {
        return $this->puntaje;
    }

    public function setPuntaje(int $puntaje): void {
        $this->puntaje = $puntaje;
    }

    public function incrementarIntentos(): void {
        $this->intentos++;
    }

    public function getIntentos(): int {
        return $this->intentos;
    }

    public function agregarNumero(int $numero): void {
        $this->numerosIngresados[] = $numero;
    }

    public function getNumerosIngresados(): array {
        return $this->numerosIngresados;
    }

    public function rendirse(): void {
        $this->rendido = true;
    }

    public function estaRendido(): bool {
        return $this->rendido;
    }

    public function reiniciar(): void {
        $this->puntaje = 10;
        $this->intentos = 0;
        $this->numerosIngresados = [];
        $this->rendido = false;
    }
}
