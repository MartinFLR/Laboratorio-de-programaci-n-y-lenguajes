<?php

class GestorJuego {

    private Jugador $jugador;

    public function __construct(Jugador $jugador){
        $this->jugador = $jugador;
        $this->jugador->reiniciar();  // Reiniciamos el jugador cuando inicia el juego
    }

    public function intentar(int $numero): string {
        $this->jugador->incrementarIntentos();
        $this->jugador->setPuntaje($this->jugador->getPuntaje() - 1);
        $this->jugador->agregarNumero($numero);

        if ($this->esCentroNumerico($numero)) {
            return "Correcto! $numero es un centro numerico";
        } elseif ($this->estaCercaCentro($numero)) {
            return "Estas cerca! $numero, se encuentra cerca";
        } else {
            return "$numero está lejos de un centro numerico";
        }
    }

    public function estaCercaCentro(int $numero): bool {
        for ($i = $numero - 5; $i <= $numero + 5; $i++) {
            if ($i > 0 && $i !== $numero && $this->esCentroNumerico($i)) {
                return true;
            }
        }
        return false;
    }

    public function esCentroNumerico(int $numero): bool {
        $sumaIzquierda = intval((($numero - 1) * $numero) / 2);
        $sumaDerecha = 0;
        $i = $numero + 1;

        while ($sumaDerecha < $sumaIzquierda) {
            $sumaDerecha += $i;
            $i++;
        }

        return $sumaIzquierda === $sumaDerecha;
    }

    public function juegoFinalizado(): bool {
        $numeros = $this->jugador->getNumerosIngresados();
        $ultimo = end($numeros);
        return $this->jugador->getPuntaje() <= 0 || ($ultimo !== false && $this->esCentroNumerico($ultimo));
    }

    public function reiniciar(): void {
        $this->jugador->reiniciar();
    }

    // Getters para información del juego y jugador
    public function getPuntaje(): int {
        return $this->jugador->getPuntaje();
    }

    public function getIntentos(): int {
        return $this->jugador->getIntentos();
    }



    public function getNumerosIngresados(): array {
        return $this->jugador->getNumerosIngresados();
    }

}
